<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\AturanThrGajiplus;
use App\Models\RuangRapat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RuangRapatController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        $title = 'Ruang Rapat';

        return view('ruang-rapat.index', compact('title'));
    }
     
    public function datatable(Request $request)
    {        
        $isAktif = $request->isAktif;

        $data = DB::table('ruang_rapat as atg')
            ->select('atg.*')
            ->orderBy('atg.is_active','asc')
            ;

            if(null != $isAktif || '' != $isAktif){
                $data->where('atg.is_active', '=', $isAktif);
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

        ->addColumn('aksi', 'ruang-rapat.aksi')
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
        $title = 'Buat Ruang Rapat';

        return view('ruang-rapat.create', compact('title'));
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
            'nama' => ['required'],
            'is_active' => ['required'],
        ],
        [
            'nama.required'=>'data nama ruang rapat harus diisi!',
            'is_active.required'=>'data status harus diisi!',
        ]);

        try {
            //validasi pegawai_id, golongan_id
            $cekDataExist = RuangRapat::where('nama',$request->nama)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data ruang rapat sudah ada!');

                return redirect()->back();
            } else {
                //insert
                $atg = new RuangRapat();
                $atg->nama = $request->nama;
                $atg->is_active = $request->is_active;

                $atg->save();

                DB::commit();
                Log::info('Data berhasil di-insert di method store pada RuangRapatController!');

                return redirect()->route('ruang-rapat.index')
                    ->with('success', 'Data Ruang Rapat berhasil disimpan');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada RuangRapatController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }  
        
    }

    public function edit(RuangRapat $ruang_rapat)
    {               
        $title = 'Ubah Ruang Rapat';

        $atg = $ruang_rapat;

        return view('ruang-rapat.edit', compact('title','atg'));
    }

    public function update(Request $request, RuangRapat $ruang_rapat)
    {  
        DB::beginTransaction();

        $this->validate($request, [
            'nama' => ['required'],
            'is_active' => ['required'],
        ],
        [
            'nama.required'=>'data nama ruang rapat harus diisi!',
            'is_active.required'=>'data status harus diisi!',
        ]);

        try {
            //validasi
            $cekDataExist = RuangRapat::where('nama',$request->nama)
            ->where('id','!=',$ruang_rapat->id)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data Ruang Rapat sudah ada!');

                return redirect()->back();
            } else {
                //update
                $ruang_rapat->nama = $request->nama;
                $ruang_rapat->is_active = $request->is_active;

                $ruang_rapat->update();

                DB::commit();
                Log::info('Data berhasil di-update di method update pada RuangRapatController!');

                return redirect()->route('ruang-rapat.index')
                    ->with('success', 'Data Ruang Rapat berhasil diupdate');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada RuangRapatController!']);

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
    public function destroy(RuangRapat $ruang_rapat)
    {           
        DB::beginTransaction();
        try {
            $ruang_rapat->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Ruang Rapat berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada RuangRapatController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Ruang Rapat gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Ruang Rapat gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada RuangRapatController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
