<?php

namespace App\Http\Controllers;

use App\Models\PegawaiBpjsLainnya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\PegawaiRiwayatGolongan;
use App\Models\PegawaiRiwayatJabatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PegawaiBpjsLainnyaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Tambahan BPJS Pegawai';

        $dataUnitKerja = DB::table('unit_kerja')
        ->select('*')
        ->whereIn('jenis_unit_kerja_id', array(1, 2, 3))
        ->where('is_active','Y')
        ->get();

        return view('pegawai-bpjs-lainnya.index', compact('title', 'dataUnitKerja'));
    }
     
    public function datatable(Request $request)
    {        
        $unitKerja = $request->unitKerja;
        $isAktif = $request->isAktif;

        $data = DB::table('pegawai_bpjs_lainnya as pbl')
            ->select('pbl.id', 'p.nama_depan', 'p.nama_belakang', 'p.nip', 'uk.nama as unit_kerja',
            'pbl.total_mertua', 'pbl.total_orang_tua', 'pbl.total_kelebihan_anak', 'pbl.is_active')
            ->join('pegawai as p','p.id','=','pbl.pegawai_id')
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id','=','pbl.pegawai_id')
                    ->where('prj.is_now','=',1)
                    ->where('prj.is_plt', '=', 0)
                    ;
            })
            ->join('jabatan_unit_kerja as juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja as huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->leftJoin('unit_kerja as uk', function ($join) {
                $join->on('uk.id', '=', 'huk.child_unit_kerja_id')
                    ->where('uk.is_active','=','Y')
                    ;
            })
            //
            //->where('is_active','=',1)
            ->orderBy('uk.id','asc')
            ->orderBy('p.nama_depan','asc')
            ->orderBy('pbl.is_active','desc')
            ;

            if(null != $unitKerja || '' != $unitKerja){
                $data->where('uk.id', '=', $unitKerja);
            }

            if(null != $isAktif || '' != $isAktif){
                $data->where('pbl.is_active', '=', $isAktif);
            }

        return Datatables::of($data)
        ->addColumn('no', '')
        ->addColumn('nama_pegawai', function ($data) {
            return $data->nama_depan.' '.$data->nama_belakang;
        })
        ->addColumn('status', function ($data) {
            if($data->is_active == 1){
                return 'Aktif';
            }
            if($data->is_active == 0){
                return 'Tidak Aktif';
            }
        })
        // ->addColumn('aktif', function ($data) {
        //     if($data)
        // })

        ->addColumn('aksi', 'pegawai-bpjs-lainnya.aksi')
        ->rawColumns(['aksi'])

        ->make(true);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {            
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Buat Tambahan BPJS Pegawai';

        //nama pegawai
        $pegawai = DB::table('pegawai as p')
            ->select('p.id', DB::raw('CONCAT(p.nama_depan," ",p.nama_belakang," | ",p.nip," | ",uk.singkatan) AS nama_pegawai'))
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id','=','p.id')
                    ->where('prj.is_now','=',1)
                    ->where('prj.is_plt', '=', 0)
                    ;
            })
            ->join('jabatan_unit_kerja as juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja as huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->leftJoin('unit_kerja as uk', function ($join) {
                $join->on('uk.id', '=', 'huk.child_unit_kerja_id')
                    ->where('uk.is_active','=','Y')
                    ;
            })
            
            ->orderBy('uk.id','asc')
            ->orderBy('p.nama_depan','asc')
            ->get();

        return view('pegawai-bpjs-lainnya.create', compact('title', 'pegawai'));
    }
        
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate($request, [
            'pegawai_id' => ['required'],
            'total_ortu' => ['required'],
            'total_mertua' => ['required'],
            'total_anak' => ['required'],
            'ket_ortu' => ['nullable'],
            'ket_mertua' => ['nullable'],
            'ket_anak' => ['nullable'],
            'is_active' => ['required'],
            'file_tambahan_bpjs' => ['nullable', 'file', 'mimes:pdf,rar,zip', 'max:2048'],
        ],
        [
            'pegawai_id.required'=>'data pegawai harus diisi!',
            'total_ortu.required'=>'data total orang tua harus diisi!',
            'total_mertua.required'=>'data total mertua harus diisi!',
            'total_anak.required'=>'data total anak harus diisi!',
            'is_active.required'=>'data status harus diisi!',
            'file_tambahan_bpjs.mimes' => 'format file sk harus pdf/rar/zip!',
            'file_tambahan_bpjs.max' => 'ukuran file terlalu besar (maksimal file 2Mb)!',
            'file_tambahan_bpjs.file' => 'upload data harus berupa file!',
        ]);

        try {
            //validasi pegawai_id, golongan_id
            $cekDataExist = PegawaiBpjsLainnya::where('pegawai_id',$request->pegawai_id)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data tambahan bpjs pegawai sudah ada!');

                return redirect()->back();
            } else {
                //update data lain is_active = 0
                if(1 == $request->is_active){
                    DB::table('pegawai_bpjs_lainnya')
                    ->where('pegawai_id', $request->pegawai_id)
                    ->update([
                        'is_active' => 0,
                        'updated_at' => now(),
                    ]);
                }

                //insert
                $pbl = new PegawaiBpjsLainnya();
                $pbl->pegawai_id = $request->pegawai_id;
                $pbl->total_orang_tua = $request->total_ortu;
                $pbl->total_mertua = $request->total_mertua;
                $pbl->total_kelebihan_anak = $request->total_anak;
                $pbl->keterangan_orang_tua = $request->ket_ortu;
                $pbl->keterangan_mertua = $request->ket_mertua;
                $pbl->keterangan_kelebihan_anak = $request->ket_anak;
                $pbl->is_active = $request->is_active;

                $pbl->save();

                if ($request->file_tambahan_bpjs) {
                    $pbl->addMediaFromRequest('file_tambahan_bpjs')->toMediaCollection('file_tambahan_bpjs');
                }

                DB::commit();
                Log::info('Data berhasil di-insert di method store pada PegawaiBpjsLainnyaController!');

                return redirect()->route('pegawai-bpjs-lainnya.index')
                    ->with('success', 'Data Tambahan BPJS Lainnya berhasil disimpan');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada PegawaiBpjsLainnyaController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }  
        
    }

    public function edit(PegawaiBpjsLainnya $pegawai_bpjs_lainnya)
    {               
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Ubah Tambahan BPJS Pegawai';

        $pbl = $pegawai_bpjs_lainnya;

        $cek_media = $pbl->getMedia("file_tambahan_bpjs")->count();
        if ($cek_media) {
            $pbl->file_tambahan_bpjs = $pbl->getMedia("file_tambahan_bpjs")[0]->getUrl();
        }

        //nama pegawai
        $pegawai = DB::table('pegawai as p')
        ->select('p.id', DB::raw('CONCAT(p.nama_depan," ",p.nama_belakang," | ",p.nip," | ",uk.singkatan) AS nama_pegawai'))
        ->join('pegawai_riwayat_jabatan as prj', function ($join) {
            $join->on('prj.pegawai_id','=','p.id')
                ->where('prj.is_now','=',1)
                ->where('prj.is_plt', '=', 0)
                ;
        })
        ->join('jabatan_unit_kerja as juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
        ->join('hirarki_unit_kerja as huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
        ->leftJoin('unit_kerja as uk', function ($join) {
            $join->on('uk.id', '=', 'huk.child_unit_kerja_id')
                ->where('uk.is_active','=','Y')
                ;
        })
        
        ->orderBy('uk.id','asc')
        ->orderBy('p.nama_depan','asc')
        ->get();

        return view('pegawai-bpjs-lainnya.edit', compact('title','pbl', 'pegawai'));
    }

    public function update(Request $request, PegawaiBpjsLainnya $pegawai_bpjs_lainnya)
    {  
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate($request, [
            'pegawai_id' => ['required'],
            'total_ortu' => ['required'],
            'total_mertua' => ['required'],
            'total_anak' => ['required'],
            'ket_ortu' => ['nullable'],
            'ket_mertua' => ['nullable'],
            'ket_anak' => ['nullable'],
            'is_active' => ['required'],
            'file_tambahan_bpjs' => ['nullable', 'file', 'mimes:pdf,rar,zip', 'max:2048'],
        ],
        [
            'pegawai_id.required'=>'data pegawai harus diisi!',
            'total_ortu.required'=>'data total orang tua harus diisi!',
            'total_mertua.required'=>'data total mertua harus diisi!',
            'total_anak.required'=>'data total anak harus diisi!',
            'is_active.required'=>'data status harus diisi!',
            'file_tambahan_bpjs.mimes' => 'format file sk harus pdf/rar/zip!',
            'file_tambahan_bpjs.max' => 'ukuran file terlalu besar (maksimal file 2Mb)!',
            'file_tambahan_bpjs.file' => 'upload data harus berupa file!',
        ]);

        try {
            //validasi nama
            $cekDataExist = PegawaiBpjsLainnya::where('pegawai_id',$request->pegawai_id)
            ->where('id','!=',$pegawai_bpjs_lainnya->id)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data Tambahan BPJS Pegawai sudah ada!');

                return redirect()->back();
            } else {
                //update data lain is_active = 0
                if(1 == $request->is_active){
                    DB::table('pegawai_bpjs_lainnya')
                    ->where('pegawai_id', $request->pegawai_id)
                    ->where('id','!=',$pegawai_bpjs_lainnya->id)
                    ->update([
                        'is_active' => 0,
                        'updated_at' => now(),
                    ]);
                }

                //update
                $pegawai_bpjs_lainnya->pegawai_id = $request->pegawai_id;
                $pegawai_bpjs_lainnya->total_orang_tua = $request->total_ortu;
                $pegawai_bpjs_lainnya->total_mertua = $request->total_mertua;
                $pegawai_bpjs_lainnya->total_kelebihan_anak = $request->total_anak;
                $pegawai_bpjs_lainnya->keterangan_orang_tua = $request->ket_ortu;
                $pegawai_bpjs_lainnya->keterangan_mertua = $request->ket_mertua;
                $pegawai_bpjs_lainnya->keterangan_kelebihan_anak = $request->ket_anak;
                $pegawai_bpjs_lainnya->is_active = $request->is_active;

                $pegawai_bpjs_lainnya->update();

                if ($request->file('file_tambahan_bpjs')) {
                    $pegawai_bpjs_lainnya->clearMediaCollection('file_tambahan_bpjs');
                    $pegawai_bpjs_lainnya->addMediaFromRequest('file_tambahan_bpjs')->toMediaCollection('file_tambahan_bpjs');
                }

                DB::commit();
                Log::info('Data berhasil di-update di method update pada PegawaiBpjsLainnyaController!');

                return redirect()->route('pegawai-bpjs-lainnya.index')
                    ->with('success', 'Data Tambahan BPJS Pegawai berhasil diupdate');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada PegawaiBpjsLainnyaController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }  
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Models\PegawaiRiwayatGolongan  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */        
    public function destroy(PegawaiBpjsLainnya $pegawai_bpjs_lainnya)
    {           
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        
        DB::beginTransaction();
        try {
            $pegawai_bpjs_lainnya->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Tambahan BPJS Pegawai berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PegawaiBpjsLainnyaController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Tambahan BPJS Pegawai gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Tambahan BPJS Pegawai gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PegawaiBpjsLainnyaController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
