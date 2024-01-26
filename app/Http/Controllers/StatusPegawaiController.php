<?php

namespace App\Http\Controllers;

use App\Models\PegawaiRiwayatJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\StatusPegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StatusPegawaiController extends Controller
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

        $title = 'Status Pegawai';

        return view('status-pegawai.index', compact('title'));
    }
     
    public function datatable(Request $request)
    {        
        $isAktif = $request->isAktif;

        $data = StatusPegawai::select('*')
        ->orderBy('is_active','asc')
        ->orderBy('id','asc');

        if(null != $isAktif || '' != $isAktif){
            $data->where('is_active', '=', $isAktif);
        }

        //dd($data);

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
            
            ->addColumn('aksi', 'status-pegawai.aksi')
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

        $title = 'Buat Status Pegawai';

        return view('status-pegawai.create', compact('title'));
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
            'nama' => ['required', 'string', 'max:30'],
            'is_active' => ['required'],
        ],
        [
            'nama.required'=>'data nama status pegawai harus diisi!',
            'is_active.required'=>'data status aktif harus diisi!',
        ]);

        try {
            //validasi nama
            $cekDataExist = StatusPegawai::where('nama',$request->nama)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data status pegawai sudah ada!');

                return redirect()->back();
            } else {
                $request['nama'] = $request->nama;
                $request['is_active'] = $request->is_active;
    
                StatusPegawai::create($request->all());
                DB::commit();
                Log::info('Data berhasil di-insert di method store pada StatusPegawaiController!');

                return redirect()->route('status-pegawai.index')
                    ->with('success', 'Data Status Pegawai berhasil disimpan');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada StatusPegawaiController!']);

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
    public function show(StatusPegawai $statusPegawai)
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
    public function edit(StatusPegawai $statusPegawai)
    {               
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Ubah Status Pegawai';

        $stat = $statusPegawai;

        return view('status-pegawai.edit', compact('title','stat'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, StatusPegawai $statusPegawai)
    {  
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate($request, [
            'nama' => ['required', 'string', 'max:30'],
            'is_active' => ['required'],
        ],
        [
            'nama.required'=>'data golongan harus diisi!',
            'is_active.required'=>'data status aktif harus diisi!',
        ]);

        try {
            //validasi nama
            $cekDataExist = StatusPegawai::where('nama',$request->nama)
                ->where('id','!=',$statusPegawai->id)
                ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data status pegawai sudah ada!');

                return redirect()->back();
            } else {
                $statusPegawai->nama = $request->nama;
                $statusPegawai->is_active = $request->is_active;
                
                $statusPegawai->update();
                DB::commit();
                Log::info('Data berhasil di-update di method update pada StatusPegawaiController!');

                return redirect()->route('status-pegawai.index')
                    ->with('success', 'Data Status Pegawai berhasil diupdate');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada StatusPegawaiController!']);

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
    public function destroy(StatusPegawai $statusPegawai)
    {           
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        
        DB::beginTransaction();
        try {
            //$profisiensiMSampelUp->deleted_by = Auth::user()->username;;
            $statusPegawai->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Status Pegawai berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada StatusPegawaiController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Status Pegawai gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Status Pegawai gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada StatusPegawaiController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
