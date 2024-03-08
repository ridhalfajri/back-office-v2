<?php

namespace App\Http\Controllers;

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

class PegawaiRiwayatGolonganController extends Controller
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

        $title = 'Riwayat Golongan Pegawai';

        $dataUnitKerja = DB::table('unit_kerja')
        ->select('*')
        ->whereIn('jenis_unit_kerja_id', array(1, 2, 3))
        ->where('is_active','Y')
        ->get();

        return view('pegawai-riwayat-golongan.index', compact('title', 'dataUnitKerja'));
    }
     
    public function datatable(Request $request)
    {        
        $unitKerja = $request->unitKerja;
        $isAktif = $request->isAktif;

        $data = DB::table('pegawai_riwayat_golongan as prg')
            ->select('prg.id', 'p.nama_depan', 'p.nama_belakang', 'p.nip', 'uk.nama as unit_kerja',
            'g.nama as nama_golongan','prg.no_sk', 'prg.is_active')
            ->join('golongan as g','g.id','=','prg.golongan_id')
            ->join('pegawai as p','p.id','=','prg.pegawai_id')
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id','=','prg.pegawai_id')
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
            ->orderBy('prg.is_active','desc')
            ->orderBy('g.id','desc')
            ;

            if(null != $unitKerja || '' != $unitKerja){
                $data->where('uk.id', '=', $unitKerja);
            }

            if(null != $isAktif || '' != $isAktif){
                $data->where('prg.is_active', '=', $isAktif);
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

        ->addColumn('aksi', 'pegawai-riwayat-golongan.aksi')
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

        $title = 'Buat Riwayat Golongan Pegawai';

        //nama pegawai
        $pegawai = DB::table('pegawai as p')
        //->select('p.id', DB::raw('CONCAT(p.nama_depan," ",p.nama_belakang," | ",p.nip," | ") AS nama_pegawai'))
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

        //nama golongan
        $golongan = DB::table('golongan as g')
        ->select('g.*')
        ->get();

        return view('pegawai-riwayat-golongan.create', compact('title', 'golongan', 'pegawai'));
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
            'golongan_id' => ['required'],
            'tmt_golongan' => ['required'],
            'no_sk' => ['required'],
            'tanggal_sk' => ['required'],
            'is_active' => ['required'],
            'sk_golongan' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ],
        [
            'pegawai_id.required'=>'data pegawai harus diisi!',
            'golongan_id.required'=>'data golongan harus diisi!',
            'tmt_golongan.required'=>'data tmt golongan harus diisi!',
            'no_sk.required'=>'data no. sk harus diisi!',
            'tanggal_sk.required'=>'data tanggal sk harus diisi!',
            'is_active.required'=>'data status harus diisi!',
            'sk_golongan.mimes' => 'format file sk harus pdf/jpg/jpeg/png!',
            'sk_golongan.max' => 'ukuran file terlalu besar (maksimal file 2Mb)!',
            'sk_golongan.file' => 'upload data harus berupa file!',
        ]);

        try {
            //validasi pegawai_id, golongan_id
            $cekDataExist = PegawaiRiwayatGolongan::where('pegawai_id',$request->pegawai_id)
            ->where('golongan_id',$request->golongan_id)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data riwayat golongan sudah ada!');

                return redirect()->back();
            } else {
                //update data lain is_active = 0
                if(1 == $request->is_active){
                    DB::table('pegawai_riwayat_golongan')
                    ->where('pegawai_id', $request->pegawai_id)
                    ->update([
                        'is_active' => 0,
                        'updated_at' => now(),
                    ]);
                }

                //insert
                $prg = new PegawaiRiwayatGolongan();
                $prg->pegawai_id = $request->pegawai_id;
                $prg->golongan_id = $request->golongan_id;
                $prg->tmt_golongan = $request->tmt_golongan;
                $prg->no_sk = $request->no_sk;
                $prg->tanggal_sk = $request->tanggal_sk;
                $prg->is_active = $request->is_active;

                $prg->save();

                if ($request->sk_golongan) {
                    $prg->addMediaFromRequest('sk_golongan')->toMediaCollection('sk_golongan');
                }

                DB::commit();
                Log::info('Data berhasil di-insert di method store pada PegawaiRiwayatGolonganController!');

                return redirect()->route('pegawai-riwayat-golongan.index')
                    ->with('success', 'Data Riwayat Golongan berhasil disimpan');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada PegawaiRiwayatGolonganController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }  
        
    }

    public function edit(PegawaiRiwayatGolongan $pegawai_riwayat_golongan)
    {               
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        
        $title = 'Ubah Riwayat Golongan Pegawai';

        $prg = $pegawai_riwayat_golongan;

        $cek_media = $prg->getMedia("sk_golongan")->count();
        if ($cek_media) {
            $prg->sk_golongan = $prg->getMedia("sk_golongan")[0]->getUrl();
        }

        //nama pegawai
        $pegawai = DB::table('pegawai as p')
        //->select('p.id', DB::raw('CONCAT(p.nama_depan," ",p.nama_belakang," | ",p.nip," | ") AS nama_pegawai'))
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

        //nama golongan
        $golongan = DB::table('golongan as g')
        ->select('g.*')
        ->get();

        return view('pegawai-riwayat-golongan.edit', compact('title','prg', 'pegawai', 'golongan'));
    }

    public function update(Request $request, PegawaiRiwayatGolongan $pegawai_riwayat_golongan)
    {  
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate($request, [
            'pegawai_id' => ['required'],
            'golongan_id' => ['required'],
            'tmt_golongan' => ['required'],
            'no_sk' => ['required'],
            'tanggal_sk' => ['required'],
            'is_active' => ['required'],
            'sk_golongan' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
        ],
        [
            'pegawai_id.required'=>'data pegawai harus diisi!',
            'golongan_id.required'=>'data golongan harus diisi!',
            'tmt_golongan.required'=>'data tmt golongan harus diisi!',
            'no_sk.required'=>'data no. sk harus diisi!',
            'tanggal_sk.required'=>'data tanggal sk harus diisi!',
            'is_active.required'=>'data status harus diisi!',
            'sk_golongan.mimes' => 'format file sk harus pdf/jpg/jpeg/png!',
            'sk_golongan.max' => 'ukuran file terlalu besar (maksimal file 2Mb)!',
            'sk_golongan.file' => 'upload data harus berupa file!',
        ]);

        try {
            //validasi nama
            $cekDataExist = PegawaiRiwayatGolongan::where('pegawai_id',$pegawai_riwayat_golongan->pegawai_id)
            ->where('golongan_id',$request->golongan_id)
            ->where('id','!=',$pegawai_riwayat_golongan->id)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data Riwayat Golongan sudah ada!');

                return redirect()->back();
            } else {
                //update data lain is_active = 0
                if(1 == $request->is_active){
                    DB::table('pegawai_riwayat_golongan')
                    ->where('pegawai_id', $pegawai_riwayat_golongan->pegawai_id)
                    ->where('id','!=',$pegawai_riwayat_golongan->id)
                    ->update([
                        'is_active' => 0,
                        'updated_at' => now(),
                    ]);
                }

                //update
                //$pegawai_riwayat_golongan->pegawai_id = $request->pegawai_id;
                $pegawai_riwayat_golongan->golongan_id = $request->golongan_id;
                $pegawai_riwayat_golongan->tmt_golongan = $request->tmt_golongan;
                $pegawai_riwayat_golongan->no_sk = $request->no_sk;
                $pegawai_riwayat_golongan->tanggal_sk = $request->tanggal_sk;
                $pegawai_riwayat_golongan->is_active = $request->is_active;

                $pegawai_riwayat_golongan->update();

                if ($request->file('sk_golongan')) {
                    $pegawai_riwayat_golongan->clearMediaCollection('sk_golongan');
                    $pegawai_riwayat_golongan->addMediaFromRequest('sk_golongan')->toMediaCollection('sk_golongan');
                }

                DB::commit();
                Log::info('Data berhasil di-update di method update pada PegawaiRiwayatGolonganController!');

                return redirect()->route('pegawai-riwayat-golongan.index')
                    ->with('success', 'Data Riwayat Golongan berhasil diupdate');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada PegawaiRiwayatGolonganController!']);

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
    public function destroy(PegawaiRiwayatGolongan $pegawai_riwayat_golongan)
    {           
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        
        DB::beginTransaction();
        try {
            $pegawai_riwayat_golongan->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Riwayat Golongan berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PegawaiRiwayatGolonganController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Riwayat Golongan gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Riwayat Golongan gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PegawaiRiwayatGolonganController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
