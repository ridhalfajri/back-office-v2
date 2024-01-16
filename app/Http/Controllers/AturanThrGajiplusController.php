<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\AturanThrGajiplus;
use App\Models\PegawaiRiwayatJabatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AturanThrGajiplusController extends Controller
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

        $title = 'Aturan THR dan Gaji-13';

        return view('aturan-thr-gajiplus.index', compact('title'));
    }
     
    public function datatable(Request $request)
    {        
        $isAktif = $request->isAktif;

        $data = DB::table('aturan_thr_gajiplus as atg')
            ->select('atg.*')
            ->orderBy('atg.is_active','asc')
            ;

            if(null != $isAktif || '' != $isAktif){
                $data->where('atg.is_active', '=', $isAktif);
            }

        return Datatables::of($data)
        ->addColumn('no', '')
        ->addColumn('persentase_tukin', function ($data) {
            return $data->persentase_tukin.' %';
        })
        ->addColumn('persentase_lainnya', function ($data) {
            return $data->persentase_lainnya.' %';
        })
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

        ->addColumn('aksi', 'aturan-thr-gajiplus.aksi')
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

        $title = 'Buat Aturan THR dan Gaji-13';

        return view('aturan-thr-gajiplus.create', compact('title'));
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
            'persentase_tukin' => ['required'],
            'persentase_lainnya' => ['required'],
            'is_active' => ['required'],
        ],
        [
            'persentase_tukin.required'=>'data persentase tukin harus diisi!',
            'persentase_lainnya.required'=>'data persentase lainnya harus diisi!',
            'is_active.required'=>'data status harus diisi!',
        ]);

        try {
            //validasi pegawai_id, golongan_id
            $cekDataExist = AturanThrGajiplus::where('persentase_tukin',$request->persentase_tukin)
            ->where('persentase_lainnya', '=', $request->persentase_lainnya)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data aturan thr dan gaji-13 sudah ada!');

                return redirect()->back();
            } else {
                //update data lain is_active = 0
                if('Y' == $request->is_active){
                    DB::table('aturan_thr_gajiplus')
                    ->update([
                        'is_active' => 'N',
                        'updated_at' => now(),
                    ]);
                }

                //insert
                $atg = new AturanThrGajiplus();
                $atg->persentase_tukin = $request->persentase_tukin;
                $atg->persentase_lainnya = $request->persentase_lainnya;
                $atg->is_active = $request->is_active;

                $atg->save();

                DB::commit();
                Log::info('Data berhasil di-insert di method store pada AturanThrGajiplusController!');

                return redirect()->route('aturan-thr-gajiplus.index')
                    ->with('success', 'Data Aturan THR dan Gaji-13 berhasil disimpan');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada AturanThrGajiplusController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }  
        
    }

    public function edit(AturanThrGajiplus $aturan_thr_gajiplu)
    {               
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Ubah Aturan THR dan Gaji-13';

        $atg = $aturan_thr_gajiplu;

        return view('aturan-thr-gajiplus.edit', compact('title','atg'));
    }

    public function update(Request $request, AturanThrGajiplus $aturan_thr_gajiplu)
    {  
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate($request, [
            'persentase_tukin' => ['required'],
            'persentase_lainnya' => ['required'],
            'is_active' => ['required'],
        ],
        [
            'persentase_tukin.required'=>'data persentase tukin harus diisi!',
            'persentase_lainnya.required'=>'data persentase lainnya harus diisi!',
            'is_active.required'=>'data status harus diisi!',
        ]);

        try {
            //validasi
            $cekDataExist = AturanThrGajiplus::where('persentase_tukin',$request->persentase_tukin)
            ->where('persentase_lainnya', '=', $request->persentase_lainnya)
            ->where('id','!=',$aturan_thr_gajiplu->id)
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Data Aturan THR dan Gaji-13 sudah ada!');

                return redirect()->back();
            } else {
                //update data lain is_active = 0
                if('Y' == $request->is_active){
                    DB::table('aturan_thr_gajiplus')
                    ->where('id','!=',$aturan_thr_gajiplu->id)
                    ->update([
                        'is_active' => 'N',
                        'updated_at' => now(),
                    ]);
                }

                //update
                $aturan_thr_gajiplu->persentase_tukin = $request->persentase_tukin;
                $aturan_thr_gajiplu->persentase_lainnya = $request->persentase_lainnya;
                $aturan_thr_gajiplu->is_active = $request->is_active;

                $aturan_thr_gajiplu->update();

                DB::commit();
                Log::info('Data berhasil di-update di method update pada AturanThrGajiplusController!');

                return redirect()->route('aturan-thr-gajiplus.index')
                    ->with('success', 'Data Aturan THR dan Gaji-13 berhasil diupdate');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada AturanThrGajiplusController!']);

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
    public function destroy(AturanThrGajiplus $aturan_thr_gajiplu)
    {           
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        
        DB::beginTransaction();
        try {
            $aturan_thr_gajiplu->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Aturan THR dan Gaji-13 berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada AturanThrGajiplusController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Aturan THR dan Gaji-13 gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Aturan THR dan Gaji-13 gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada AturanThrGajiplusController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
