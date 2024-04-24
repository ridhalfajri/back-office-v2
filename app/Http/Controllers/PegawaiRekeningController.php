<?php

namespace App\Http\Controllers;

use App\Models\PegawaiRekening;
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

class PegawaiRekeningController extends Controller
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

        $title = 'Rekening Pegawai';

        $dataUnitKerja = DB::table('unit_kerja')
        ->select('*')
        ->whereIn('jenis_unit_kerja_id', array(1, 2, 3))
        ->where('is_active','Y')
        ->get();

        return view('pegawai-rekening.index', compact('title', 'dataUnitKerja'));
    }
     
    public function datatable(Request $request)
    {        
        $unitKerja = $request->unitKerja;

        $data = DB::table('pegawai_rekening as pr')
            ->select('pr.id', 'p.nama_depan', 'p.nama_belakang',
            DB::raw('CONCAT(p.nama_depan," " ,p.nama_belakang) AS nama_pegawai'),
            'p.nip', 'uk.nama as unit_kerja',
            'b.nama as nama_bank', 'pr.no_rekening', 'pr.tipe_rekening')
            ->join('bank as b','b.id','=','pr.bank_id')
            ->join('pegawai as p','p.id','=','pr.pegawai_id')
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id','=','pr.pegawai_id')
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
            ;

            if(null != $unitKerja || '' != $unitKerja){
                $data->where('uk.id', '=', $unitKerja);
            }

        return Datatables::of($data)
        ->addColumn('no', '')
        // ->addColumn('nama_pegawai', function ($data) {
        //     return $data->nama_depan.' '.$data->nama_belakang;
        // })
        ->filterColumn('nama_pegawai', function ($query, $keyword) {
            $query->whereRaw("CONCAT(p.nama_depan,' ',p.nama_belakang) like ?", ["%$keyword%"]);
        })

        ->addColumn('aksi', 'pegawai-rekening.aksi')
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

        $title = 'Buat Rekening Pegawai';

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

        //nama bank
        $bank = DB::table('bank as b')
        ->select('b.*')
        ->get();

        return view('pegawai-rekening.create', compact('title', 'bank', 'pegawai'));
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
            'bank_id' => ['required'],
            'no_rek' => ['required'],
            'tipe_rek' => ['required'],
        ],
        [
            'pegawai_id.required'=>'data pegawai harus diisi!',
            'bank_id.required'=>'data bank harus diisi!',
            'no_rek.required'=>'data no. rekening harus diisi!',
            'tipe_rek.required'=>'data tipe rekening harus diisi!',
        ]);

        try {
            //validasi
            $cekDataExist = PegawaiRekening::where('pegawai_id',$request->pegawai_id)
            ->where('tipe_rekening',$request->tipe_rek)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data tipe rekening sudah ada!');

                return redirect()->back();
            } else {
                //insert
                $prg = new PegawaiRekening();
                $prg->pegawai_id = $request->pegawai_id;
                $prg->bank_id = $request->bank_id;
                $prg->no_rekening = $request->no_rek;
                $prg->tipe_rekening = $request->tipe_rek;

                $prg->save();

                DB::commit();
                Log::info('Data berhasil di-insert di method store pada PegawaiRekeningController!');

                return redirect()->route('pegawai-rekening.index')
                    ->with('success', 'Data Rekening Pegawai berhasil disimpan');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada PegawaiRekeningController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }  
        
    }

    public function edit(PegawaiRekening $pegawai_rekening)
    {               
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        
        $title = 'Ubah Rekening Pegawai';

        $prg = $pegawai_rekening;

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

        //nama bank
        $bank = DB::table('bank as b')
        ->select('b.*')
        ->get();

        return view('pegawai-rekening.edit', compact('title','prg', 'pegawai', 'bank'));
    }

    public function update(Request $request, PegawaiRekening $pegawai_rekening)
    {  
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate($request, [
            'pegawai_id' => ['required'],
            'bank_id' => ['required'],
            'no_rek' => ['required'],
            'tipe_rek' => ['required'],
        ],
        [
            'pegawai_id.required'=>'data pegawai harus diisi!',
            'bank_id.required'=>'data bank harus diisi!',
            'no_rek.required'=>'data no. rekening harus diisi!',
            'tipe_rek.required'=>'data tipe rekening harus diisi!',
        ]);

        try {
            //validasi
            $cekDataExist = PegawaiRekening::where('pegawai_id',$pegawai_rekening->pegawai_id)
            ->where('tipe_rekening',$request->tipe_rekening)
            ->where('id','!=',$pegawai_rekening->id)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data Tipe Rekening sudah ada!');

                return redirect()->back();
            } else {
                //update
                //$pegawai_rekening->pegawai_id = $request->pegawai_id;
                $pegawai_rekening->bank_id = $request->bank_id;
                $pegawai_rekening->no_rekening = $request->no_rek;
                $pegawai_rekening->tipe_rekening = $request->tipe_rek;

                $pegawai_rekening->update();

                DB::commit();
                Log::info('Data berhasil di-update di method update pada PegawaiRekeningController!');

                return redirect()->route('pegawai-rekening.index')
                    ->with('success', 'Data Rekening Pegawai berhasil diupdate');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada PegawaiRekeningController!']);

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
    public function destroy(PegawaiRekening $pegawai_rekening)
    {           
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        
        DB::beginTransaction();
        try {
            $pegawai_rekening->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Rekening Pegawai berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PegawaiRekeningController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Rekening Pegawai gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Rekening Pegawai gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PegawaiRekeningController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
