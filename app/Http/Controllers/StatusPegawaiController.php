<?php

namespace App\Http\Controllers;

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
        $title = 'Status Pegawai';

        return view('status-pegawai.index', compact('title'));
    }
     
    public function datatable(StatusPegawai $statusPegawai)
    {        
        $data = StatusPegawai::all();

        //dd($data);

        return Datatables::of($data)
            ->addColumn('no', '')
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
        DB::beginTransaction();

        $this->validate($request, [
            'nama' => ['required', 'string', 'max:30'],
        ],
        [
            'nama.required'=>'data nama status pegawai harus diisi!',
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
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function edit(StatusPegawai $statusPegawai)
    {               
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
        DB::beginTransaction();

        $this->validate($request, [
            'nama' => ['required', 'string', 'max:30'],
        ],
        [
            'nama.required'=>'data golongan harus diisi!',
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
