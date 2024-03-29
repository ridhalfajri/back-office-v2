<?php

namespace App\Http\Controllers;

use App\Models\PegawaiRiwayatJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\Tukin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TukinController extends Controller
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

        $title = 'Grade Tukin';

        return view('tukin.index', compact('title'));
    }
     
    public function datatable(Request $request)
    {        
        $isAktif = $request->isAktif;

        $data = Tukin::select('*')
        ->orderBy('is_active','asc')
        ->orderBy('grade','asc');

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

            ->addColumn('aksi', 'tukin.aksi')
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

        $title = 'Buat Grade Tukin';

        return view('tukin.create', compact('title'));
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
            'grade' => ['required', 'integer', 'max:9999'],
            'nominal' => ['required', 'integer', 'max:9999999999'],
            'keterangan' => ['max:255'],
            'is_active' => ['required'],
        ],
        [
            'grade.required'=>'data grade harus diisi!',
            'grade.integer'=>'data grade harus bilangan bulat positif!',
            'nominal.required'=>'data nominal harus diisi!',
            'nominal.integer'=>'data nominal harus bilangan bulat positif!',
            'is_active.required'=>'data status harus diisi!',
        ]);

        try {
            //validasi nama
            $cekDataExist = Tukin::where('grade',$request->grade)
            ->where('nominal',$request->nominal)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data grade tukin sudah ada!');

                return redirect()->back();
            } else {
                $request['grade'] = $request->grade;
                $request['nominal'] = $request->nominal;
                $request['keterangan'] = $request->keterangan;
                $request['is_active'] = $request->is_active;
    
                Tukin::create($request->all());
                DB::commit();
                Log::info('Data berhasil di-insert di method store pada TukinController!');

                return redirect()->route('tukin.index')
                    ->with('success', 'Data Tunjangan Kinerja berhasil disimpan');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada TukinController!']);

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
    public function show(Tukin $tukin)
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
    public function edit(Tukin $tukin)
    {               
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Ubah Grade Tukin';

        $tukin = $tukin;

        return view('tukin.edit', compact('title','tukin'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Tukin $tukin)
    {  
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate($request, [
            'grade' => ['required', 'integer', 'max:9999'],
            'nominal' => ['required', 'integer', 'max:9999999999'],
            'keterangan' => ['max:255'],
            'is_active' => ['required'],
        ],
        [
            'grade.required'=>'data grade harus diisi!',
            'grade.integer'=>'data grade harus bilangan bulat positif!',
            'nominal.required'=>'data nominal harus diisi!',
            'nominal.integer'=>'data nominal harus bilangan bulat positif!',
            'is_active.required'=>'data status harus diisi!',
        ]);

        try {
            //validasi nama
            $cekDataExist = Tukin::where('grade',$request->grade)
                ->where('nominal',$request->nominal)
                ->where('id','!=',$tukin->id)
                ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data Tunjangan Kinerja sudah ada!');

                return redirect()->back();
            } else {
                $tukin->grade = $request->grade;
                $tukin->nominal = $request->nominal;
                $tukin->keterangan = $request->keterangan;
                $tukin->is_active = $request->is_active;
                
                $tukin->update();
                DB::commit();
                Log::info('Data berhasil di-update di method update pada TukinController!');

                return redirect()->route('tukin.index')
                    ->with('success', 'Data Tunjangan Kinerja berhasil diupdate');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada TukinController!']);

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
    public function destroy(Tukin $tukin)
    {           
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        
        DB::beginTransaction();
        try {
            //$profisiensiMSampelUp->deleted_by = Auth::user()->username;;
            $tukin->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Status Pegawai berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada TukinController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Tunjangan Kinerja gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Tunjangan Kinerja gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada TukinController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
