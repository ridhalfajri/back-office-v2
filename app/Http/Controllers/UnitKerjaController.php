<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\UnitKerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UnitKerjaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        $title = 'Unit Kerja';

        return view('unit-kerja.index', compact('title'));
    }
     
    public function datatable(UnitKerja $unitKerja)
    {        
        $data = UnitKerja::select('unit_kerja.*', 'jenis_unit_kerja.nama as nama_jenis_unit')
        ->join('jenis_unit_kerja','jenis_unit_kerja.id','=','unit_kerja.jenis_unit_kerja_id')
        ->orderBy('unit_kerja.jenis_unit_kerja_id','asc');

        //dd($data);

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('aksi', 'unit-kerja.aksi')
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
        $title = 'Buat Unit Kerja';

        $jenisUnit = DB::table('jenis_unit_kerja')
        ->select('jenis_unit_kerja.*')
        ->get();

        return view('unit-kerja.create', compact('title', 'jenisUnit'));
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
            'nama' => ['required', 'string', 'min:1', 'max:255'],
            'jenis_unit_kerja_id' => ['required', 'integer', 'min:1', 'max:999'],
            'singkatan' => ['max:18'],
            'keterangan' => ['max:100'],
        ],
        [
            'nama.required'=>'data golongan harus diisi!',
            'nama.string'=>'data golongan harus tipe string!',
            'jenis_unit_kerja_id.required'=>'data jenis unit kerja harus diisi!',
            'jenis_unit_kerja_id.integer'=>'data jenis unit kerja harus bilangan bulat positif!',
        ]);

        try {
            //validasi golongan
            $cekDataExist = UnitKerja::where('nama',$request->nama)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data unit kerja sudah ada!');

                return redirect()->back();
                //return redirect()->route('unit-kerja.create');
            } else {
                $request['nama'] = $request->nama;
                $request['jenis_unit_kerja_id'] = $request->jenis_unit_kerja_id;
                $request['singkatan'] = $request->singkatan;
                $request['keterangan'] = $request->keterangan;
    
                UnitKerja::create($request->all());
                DB::commit();
                Log::info('Data berhasil di-insert di method store pada UnitKerjaController!');

                return redirect()->route('unit-kerja.index')
                    ->with('success', 'Data Unit Kerja berhasil disimpan');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada UnitKerjaController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('unit-kerja.create');
            return redirect()->back();
        }  
        
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function show(UnitKerja $unitKerja)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function edit(UnitKerja $unitKerja)
    {               
        $title = 'Ubah Unit Kerja';

        $unit = $unitKerja;

        $jenisUnit = DB::table('jenis_unit_kerja')
        ->select('jenis_unit_kerja.*')
        ->get();

        return view('unit-kerja.edit', compact('title','unit', 'jenisUnit'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, UnitKerja $unitKerja)
    {  
        DB::beginTransaction();

        $this->validate($request, [
            'nama' => ['required', 'string', 'min:1', 'max:255'],
            'jenis_unit_kerja_id' => ['required', 'integer', 'min:1', 'max:999'],
            'singkatan' => ['max:18'],
            'keterangan' => ['max:100'],
        ],
        [
            'nama.required'=>'data golongan harus diisi!',
            'nama.string'=>'data golongan harus tipe string!',
            'jenis_unit_kerja_id.required'=>'data jenis unit kerja harus diisi!',
            'jenis_unit_kerja_id.integer'=>'data jenis unit kerja harus bilangan bulat positif!',
        ]);

        try {
            //validasi golongan
            $cekDataExist = UnitKerja::where('nama',$request->nama)
                ->where('id','!=',$unitKerja->id)
                ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data unit kerja sudah ada!');

                return redirect()->back();
            } else {
                $unitKerja->nama = $request->nama;
                $unitKerja->jenis_unit_kerja_id = $request->jenis_unit_kerja_id;
                $unitKerja->singkatan = $request->singkatan;
                $unitKerja->keterangan = $request->keterangan;
                
                $unitKerja->update();
                DB::commit();
                Log::info('Data berhasil di-update di method update pada UnitKerjaController!');

                return redirect()->route('unit-kerja.index')
                    ->with('success', 'Data Unit Kerja berhasil diupdate');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada UnitKerjaController!']);

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
    public function destroy(UnitKerja $unitKerja)
    {           
        DB::beginTransaction();
        try {
            //$profisiensiMSampelUp->deleted_by = Auth::user()->username;
            $unitKerja->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Unit Kerja berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada UnitKerjaController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Unit Kerja gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Unit Kerja gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada UnitKerjaController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
