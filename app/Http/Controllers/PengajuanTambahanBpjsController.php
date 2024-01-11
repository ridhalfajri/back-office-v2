<?php

namespace App\Http\Controllers;

use App\Models\PegawaiBpjsLainnya;
use App\Models\PegawaiTambahanMk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PengajuanTambahanBpjsController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        $title = 'Pengajuan Tambahan BPJS';

        return view('pengajuan-tambahan-bpjs.index', compact('title'));
    }
     
    public function datatable(Request $request)
    {        
        $data = PegawaiBpjsLainnya::select('*')
            ->where('pegawai_id', '=', Auth::user()->pegawai_id)
            ;

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('status', function ($data) {
                if($data->status == 1){
                    return 'Pengajuan';
                }
                if($data->status == 2){
                    return 'Dibatalkan';
                }
                if($data->status == 3){
                    return 'Disetujui';
                }
            })

            // ->addColumn('file_pengajuan_pmk', function ($data) {
            //     $cek_media = $data->getMedia("file_pengajuan_pmk")->count();
            //     dd($cek_media);
            //     if ($cek_media) {
            //         $data->file_pengajuan_pmk = $data->getMedia("file_pengajuan_pmk")[0]->getUrl();
            //         return $data->file_pengajuan_pmk;
            //     } else {
            //         return null;
            //     }
            // })

            ->addColumn('aksi', 'pengajuan-tambahan-bpjs.aksi')
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
        $title = 'Buat Pengajuan Tambahan BPJS';

        return view('pengajuan-tambahan-bpjs.create', compact('title'));
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
            'total_mertua' => ['required'],
            'total_orang_tua' => ['required'],
            'total_kelebihan_anak' => ['required'],
            'keterangan_mertua' => ['required'],
            'keterangan_orang_tua' => ['required'],
            'keterangan_kelebihan_anak' => ['required'],
            'file_pengajuan_bpjs' => ['required', 'file', 'mimes:rar,zip', 'max:51200'],
        ],
        [
            'total_mertua.required'=>'data total mertua harus diisi!',
            'total_orang_tua.required'=>'data total orang tua harus diisi!',
            'total_kelebihan_anak.required'=>'data total anak harus diisi!',

            'keterangan_mertua.required'=>'data keterangan mertua harus diisi!',
            'keterangan_orang_tua.required'=>'data keterangan orang tua harus diisi!',
            'keterangan_kelebihan_anak.required'=>'data keterangan anak harus diisi!',
            
            'file_pengajuan_bpjs.mimes' => 'format file sk harus rar/zip!',
            'file_pengajuan_bpjs.max' => 'ukuran file terlalu besar (maksimal file 50Mb)!',
            'file_pengajuan_bpjs.file' => 'upload data harus berupa file!',
        ]);

        try {
            //insert
            $bpjs = new PegawaiBpjsLainnya();
            $bpjs->pegawai_id = Auth::user()->pegawai_id;

            $bpjs->total_mertua = $request->total_mertua;
            $bpjs->total_orang_tua = $request->total_orang_tua;
            $bpjs->total_kelebihan_anak = $request->total_kelebihan_anak;
            $bpjs->keterangan_mertua = $request->keterangan_mertua;
            $bpjs->keterangan_orang_tua = $request->keterangan_orang_tua;
            $bpjs->keterangan_kelebihan_anak = $request->keterangan_kelebihan_anak;

            $bpjs->status = 1;

            $bpjs->save();

            if ($request->file_pengajuan_bpjs) {
                $bpjs->addMediaFromRequest('file_pengajuan_bpjs')->toMediaCollection('file_pengajuan_bpjs');
            }

            DB::commit();
            Log::info('Data berhasil di-insert di method store pada PengajuanTambahanBpjsController!');

            return redirect()->route('pengajuan-tambahan-bpjs.index')
                ->with('success', 'Data Pengajuan Tambahan BPJS berhasil disimpan');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada PengajuanTambahanBpjsController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }  
        
    }

    public function show(PegawaiBpjsLainnya $pengajuan_tambahan_bpj)
    {
        $title = 'Lihat File';

        $bpjs = $pengajuan_tambahan_bpj;

        $cek_media = $bpjs->getMedia("file_kartu_bpjs")->count();
        if ($cek_media) {
            $bpjs->file_kartu_bpjs = $bpjs->getMedia("file_kartu_bpjs")[0]->getUrl();
        }

        $cek_media = $bpjs->getMedia("file_pengajuan_bpjs")->count();
        if ($cek_media) {
            $bpjs->file_pengajuan_bpjs = $bpjs->getMedia("file_pengajuan_bpjs")[0]->getUrl();
        }

        return view('pengajuan-tambahan-bpjs.show', compact('title', 'bpjs'));
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Models\PegawaiTambahanMk  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */        
    public function destroy(PegawaiBpjsLainnya $pengajuan_tambahan_bpj)
    {           
        DB::beginTransaction();
        try {
            $pengajuan_tambahan_bpj->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan Tambahan BPJS berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PengajuanTambahanBpjsController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan Tambahan BPJS gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Pengajuan Tambahan BPJS gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PengajuanTambahanBpjsController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
