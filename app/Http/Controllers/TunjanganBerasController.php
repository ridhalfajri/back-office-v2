<?php

namespace App\Http\Controllers;

use App\Models\PegawaiRiwayatJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\TunjanganBeras;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TunjanganBerasController extends Controller
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

        $title = 'Tunjangan Beras';

        return view('tunjangan-beras.index', compact('title'));
    }
     
    public function datatable(Request $request)
    {        
        $isAktif = $request->isAktif;

        $data = DB::table('tunjangan_beras as tb')
            ->select('tb.*')
            ->orderBy('tb.is_active','asc')
            ->orderBy('tb.total','desc')
            ;

            if(null != $isAktif || '' != $isAktif){
                $data->where('tb.is_active', '=', $isAktif);
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
        // ->addColumn('aktif', function ($data) {
        //     if($data)
        // })

        ->addColumn('aksi', 'tunjangan-beras.aksi')
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

        $title = 'Buat Tunjangan Beras';

        return view('tunjangan-beras.create', compact('title'));
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
            'nominal' => ['required'],
            'berat' => ['required'],
            'is_active' => ['required'],
        ],
        [
            'nominal.required'=>'data nominal harus diisi!',
            'berat.required'=>'data berat harus diisi!',
            'is_active.required'=>'data status harus diisi!',
        ]);

        try {
            //validasi pegawai_id, golongan_id
            $cekDataExist = TunjanganBeras::where('nominal',$request->nominal)
            ->where('berat', '=', $request->berat)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data tunjangan beras sudah ada!');

                return redirect()->back();
            } else {
                //update data lain is_active = 0
                if('Y' == $request->is_active){
                    DB::table('tunjangan_beras')
                    ->update([
                        'is_active' => 'N',
                        'updated_at' => now(),
                    ]);
                }

                //insert
                $tb = new TunjanganBeras();
                $tb->nominal = $request->nominal;
                $tb->berat = $request->berat;
                $tb->total = $request->nominal*$request->berat;
                $tb->is_active = $request->is_active;

                $tb->save();

                DB::commit();
                Log::info('Data berhasil di-insert di method store pada TunjanganBerasController!');

                return redirect()->route('tunjangan-beras.index')
                    ->with('success', 'Data Tunjangan Beras berhasil disimpan');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada TunjanganBerasController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }  
        
    }

    public function edit(TunjanganBeras $tunjangan_bera)
    {               
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Ubah Tunjangan Beras';

        $tb = $tunjangan_bera;

        return view('tunjangan-beras.edit', compact('title','tb'));
    }

    public function update(Request $request, TunjanganBeras $tunjangan_bera)
    {  
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate($request, [
            'nominal' => ['required'],
            'berat' => ['required'],
            'is_active' => ['required'],
        ],
        [
            'nominal.required'=>'data nominal harus diisi!',
            'berat.required'=>'data berat harus diisi!',
            'is_active.required'=>'data status harus diisi!',
        ]);

        try {
            //validasi
            $cekDataExist = TunjanganBeras::where('nominal',$request->nominal)
            ->where('berat', '=', $request->berat)
            ->where('id','!=',$tunjangan_bera->id)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data Tunjangan Beras sudah ada!');

                return redirect()->back();
            } else {
                //update data lain is_active = 0
                if('Y' == $request->is_active){
                    DB::table('tunjangan_beras')
                    ->where('id','!=',$tunjangan_bera->id)
                    ->update([
                        'is_active' => 'N',
                        'updated_at' => now(),
                    ]);
                }

                //update
                $tunjangan_bera->nominal = $request->nominal;
                $tunjangan_bera->berat = $request->berat;
                $tunjangan_bera->total = $request->nominal*$request->berat;
                $tunjangan_bera->is_active = $request->is_active;

                $tunjangan_bera->update();

                DB::commit();
                Log::info('Data berhasil di-update di method update pada TunjanganBerasController!');

                return redirect()->route('tunjangan-beras.index')
                    ->with('success', 'Data Tunjangan Beras berhasil diupdate');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada TunjanganBerasController!']);

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
    public function destroy(TunjanganBeras $tunjangan_bera)
    {           
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        
        DB::beginTransaction();
        try {
            $tunjangan_bera->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Tunjangan Beras berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada TunjanganBerasController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Tunjangan Beras gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Tunjangan Beras gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada TunjanganBerasController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
