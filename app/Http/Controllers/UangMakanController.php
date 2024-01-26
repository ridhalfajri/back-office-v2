<?php

namespace App\Http\Controllers;

use App\Models\PegawaiRiwayatJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\UangMakan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UangMakanController extends Controller
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

        $title = 'Uang Makan';

        return view('uang-makan.index', compact('title'));
    }
     
    public function datatable(Request $request)
    {        
        $isAktif = $request->isAktif;

        $data = UangMakan::select('uang_makan.*', 'golongan.nama as nama_golongan')
        ->join('golongan','golongan.id','=','uang_makan.golongan_id')
        ->orderBy('uang_makan.is_active','asc')
        ->orderBy('golongan.nama','asc');

        //dd($data);
        if(null != $isAktif || '' != $isAktif){
            $data->where('uang_makan.is_active', '=', $isAktif);
        }

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('status', function ($data) {
                if($data->is_active == 'Y'){
                    return 'Aktif';
                }
                if($data->is_active == 'N'){
                    return 'Tidak Aktif';
                }
            })

            ->addColumn('aksi', 'uang-makan.aksi')
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

        $title = 'Buat Uang Makan';

        $golongan = DB::table('golongan')
        ->select('golongan.*')
        ->get();

        return view('uang-makan.create', compact('title', 'golongan'));
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
            'golongan_id' => ['required', 'integer', 'min:1', 'max:999'],
            'nominal' => ['required', 'integer', 'min:1', 'max:999999999999999'],
            'is_active' => ['required'],
        ],
        [
            'golongan_id.required'=>'data golongan harus diisi!',
            'golongan_id.integer'=>'data golongan harus bilangan bulat positif!',
            'nominal.required'=>'data nominal harus diisi!',
            'nominal.integer'=>'data nominal harus bilangan bulat positif!',
            'is_active.required'=>'data status harus diisi!',
        ]);

        try {
            //validasi golongan
            $cekDataExist = UangMakan::where('golongan_id',$request->golongan_id)
            ->where('nominal',$request->nominal)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data golongan sudah ada!');

                return redirect()->back();
            } else {
                $request['golongan_id'] = $request->golongan_id;
                $request['nominal'] = $request->nominal;
                $request['is_active'] = $request->is_active;
    
                UangMakan::create($request->all());
                DB::commit();
                Log::info('Data berhasil di-insert di method store pada UangMakanController!');

                return redirect()->route('uang-makan.index')
                    ->with('success', 'Data Uang Makan berhasil disimpan');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada UangMakanController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }  
        
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function show(UangMakan $uangMakan)
    {
        //
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function edit(UangMakan $uangMakan)
    {               
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Ubah Uang Makan';

        $umak = $uangMakan;

        $golongan = DB::table('golongan')
        ->select('golongan.*')
        ->get();

        return view('uang-makan.edit', compact('title','umak', 'golongan'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, UangMakan $uangMakan)
    {  
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate($request, [
            'golongan_id' => ['required', 'integer', 'min:1', 'max:999'],
            'nominal' => ['required', 'integer', 'min:1', 'max:999999999999999'],
            'is_active' => ['required'],
        ],
        [
            'golongan_id.required'=>'data golongan harus diisi!',
            'golongan_id.integer'=>'data golongan harus bilangan bulat positif!',
            'nominal.required'=>'data nominal harus diisi!',
            'nominal.integer'=>'data nominal harus bilangan bulat positif!',
            'is_active.required'=>'data status harus diisi!',
        ]);

        try {
            //validasi golongan
            $cekDataExist = UangMakan::where('golongan_id',$request->golongan_id)
                ->where('nominal',$request->nominal)
                ->where('id','!=',$uangMakan->id)
                ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data golongan sudah ada!');

                return redirect()->back();
            } else {
                $uangMakan->golongan_id = $request->golongan_id;
                $uangMakan->nominal = $request->nominal;
                $uangMakan->is_active = $request->is_active;
                
                $uangMakan->update();
                DB::commit();
                Log::info('Data berhasil di-update di method update pada UangMakanController!');

                return redirect()->route('uang-makan.index')
                    ->with('success', 'Data Uang Makan berhasil diupdate');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada UangMakanController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }  
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */        
    public function destroy(UangMakan $uangMakan)
    {           
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        
        DB::beginTransaction();
        try {
            //$profisiensiMSampelUp->deleted_by = Auth::user()->username;;
            $uangMakan->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Uang Makan berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada UangMakanController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Uang Makan gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Uang Makan gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada UangMakanController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
