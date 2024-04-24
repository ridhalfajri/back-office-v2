<?php

namespace App\Http\Controllers;

use App\Models\PegawaiBpjsLainnya;
use App\Models\PegawaiRiwayatJabatan;
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

class PegawaiTambahanBpjsController extends Controller
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

        $title = 'Approval Tambahan BPJS Pegawai';

        $dataUnitKerja = DB::table('unit_kerja')
        ->select('*')
        ->whereIn('jenis_unit_kerja_id', array(1, 2, 3))
        ->where('is_active','Y')
        ->get();

        return view('pegawai-tambahan-bpjs.index', compact('title', 'dataUnitKerja'));
    }
     
    public function datatable(Request $request)
    {        
        $unitKerja = $request->unitKerja;
        $status = $request->status;

        $data = DB::table('pegawai_bpjs_lainnya as ptm')
        ->select('ptm.*', 'p.nama_depan', 'p.nama_belakang',
        DB::raw('CONCAT(p.nama_depan," " ,p.nama_belakang) AS nama_pegawai'),
        'p.nip',
        'uk.nama as unit_kerja', 'uk.singkatan as singkatan_unit_kerja')
        ->join('pegawai as p','p.id','=','ptm.pegawai_id')
            //->join('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai_riwayat_umak.pegawai_id')
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id','=','ptm.pegawai_id')
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
            ;

            if(null != $status || '' != $status){
                $data->where('ptm.status', '=', $status);
            }

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

            ->addColumn('aksi', 'pegawai-tambahan-bpjs.aksi')
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show(PegawaiBpjsLainnya $pegawai_tambahan_bpj)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Lihat File';

        $bpjs = $pegawai_tambahan_bpj;

        $cek_media = $bpjs->getMedia("file_pengajuan_bpjs")->count();
        if ($cek_media) {
            $bpjs->file_pengajuan_bpjs = $bpjs->getMedia("file_pengajuan_bpjs")[0]->getUrl();
        }

        $cek_media = $bpjs->getMedia("file_kartu_bpjs")->count();
        if ($cek_media) {
            $bpjs->file_kartu_bpjs = $bpjs->getMedia("file_kartu_bpjs")[0]->getUrl();
        }

        return view('pegawai-tambahan-bpjs.show', compact('title', 'bpjs'));
    }

    public function edit(PegawaiBpjsLainnya $pegawai_tambahan_bpj)
    {               
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Setujui Tambahan BPJS Pegawai';
        
        $pegawai = DB::table('pegawai_bpjs_lainnya as ptm')
        ->select('ptm.*', 'p.nama_depan', 'p.nama_belakang', 'p.nip',
        'uk.nama as unit_kerja', 'uk.singkatan as singkatan_unit_kerja')
        ->join('pegawai as p','p.id','=','ptm.pegawai_id')
            //->join('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai_riwayat_umak.pegawai_id')
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id','=','ptm.pegawai_id')
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
            ->where('ptm.pegawai_id', '=', $pegawai_tambahan_bpj->pegawai_id)
            ->first()
            ;

        $bpjs = $pegawai_tambahan_bpj;

        $cek_media = $bpjs->getMedia("file_kartu_bpjs")->count();
        if ($cek_media) {
            $bpjs->file_kartu_bpjs = $bpjs->getMedia("file_kartu_bpjs")[0]->getUrl();
        }

        return view('pegawai-tambahan-bpjs.edit', compact('title','bpjs', 'pegawai'));
    }

    public function update(Request $request, PegawaiBpjsLainnya $pegawai_tambahan_bpj)
    {  
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate($request, [
            'file_kartu_bpjs' => ['required', 'file', 'mimes:pdf,doc,docx,rar,zip', 'max:20480'],
        ],
        [
            'file_kartu_bpjs.mimes' => 'format file sk harus pdf/doc/docx/rar/zip!',
            'file_kartu_bpjs.max' => 'ukuran file terlalu besar (maksimal file 20Mb)!',
            'file_kartu_bpjs.file' => 'upload data harus berupa file!',
        ]);

        try {
            //update
            $pegawai_tambahan_bpj->status = 3;
            $pegawai_tambahan_bpj->is_active = 1;

            $pegawai_tambahan_bpj->update();

            if ($request->file('file_kartu_bpjs')) {
                $pegawai_tambahan_bpj->clearMediaCollection('file_kartu_bpjs');
                $pegawai_tambahan_bpj->addMediaFromRequest('file_kartu_bpjs')->toMediaCollection('file_kartu_bpjs');
            }

            DB::commit();
            Log::info('Data berhasil di-update di method update pada PegawaiTambahanBpjsController!');

            return redirect()->route('pegawai-tambahan-bpjs.index')
                ->with('success', 'Data Persetujuan Tambahan BPJS Pegawai berhasil diupdate');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada PegawaiTambahanBpjsController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }  
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Models\PegawaiTambahanMk  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */        
    public function destroy(PegawaiBpjsLainnya $pegawai_tambahan_bpj)
    {           
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        
        DB::beginTransaction();
        try {
            $pegawai_tambahan_bpj->status = 2;
            $pegawai_tambahan_bpj->is_active = 0;

            $pegawai_tambahan_bpj->update();

            $pegawai_tambahan_bpj->clearMediaCollection('file_kartu_bpjs');

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan Tambahan BPJS berhasil dibatalkan!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PegawaiTambahanBpjsController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan Tambahan BPJS gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Pengajuan Tambahan BPJS gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PegawaiTambahanBpjsController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
