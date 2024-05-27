<?php

namespace App\Http\Controllers;

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

class PegawaiTambahanMkController extends Controller
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

        $title = 'Approval Peninjauan Masa Kerja Pegawai';

        $dataUnitKerja = DB::table('unit_kerja')
        ->select('*')
        ->whereIn('jenis_unit_kerja_id', array(1, 2, 3))
        ->where('is_active','Y')
        ->get();

        return view('pegawai-tambahan-mk.index', compact('title', 'dataUnitKerja'));
    }
     
    public function datatable(Request $request)
    {        
        $unitKerja = $request->unitKerja;
        $status = $request->status;

        $data = DB::table('pegawai_tambahan_mk as ptm')
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

            ->addColumn('aksi', 'pegawai-tambahan-mk.aksi')
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show(PegawaiTambahanMk $pegawai_tambahan_mk)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Lihat File';

        $pmk = $pegawai_tambahan_mk;

        $cek_media = $pmk->getMedia("file_pengajuan_pmk")->count();
        if ($cek_media) {
            $pmk->file_pengajuan_pmk = $pmk->getMedia("file_pengajuan_pmk")[0]->getUrl();
        }

        $cek_media = $pmk->getMedia("file_sk_pmk")->count();
        if ($cek_media) {
            $pmk->file_sk_pmk = $pmk->getMedia("file_sk_pmk")[0]->getUrl();
        }

        return view('pegawai-tambahan-mk.show', compact('title', 'pmk'));
    }

    public function edit(PegawaiTambahanMk $pegawai_tambahan_mk)
    {               
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Setujui Peninjauan Masa Kerja Pegawai';
        
        $pegawai = DB::table('pegawai_tambahan_mk as ptm')
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
            ->where('ptm.pegawai_id', '=', $pegawai_tambahan_mk->pegawai_id)
            ->first()
            ;

        $pmk = $pegawai_tambahan_mk;

        $cek_media = $pmk->getMedia("file_sk_pmk")->count();
        if ($cek_media) {
            $pmk->file_sk_pmk = $pmk->getMedia("file_sk_pmk")[0]->getUrl();
        }

        return view('pegawai-tambahan-mk.edit', compact('title','pmk', 'pegawai'));
    }

    public function update(Request $request, PegawaiTambahanMk $pegawai_tambahan_mk)
    {  
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate($request, [
            'tahun_plus_disetujui' => ['required'],
            'bulan_plus_disetujui' => ['required'],
            'tanggal_sk' => ['required'],
            'no_sk' => ['required'],
            'pejabat_penetap' => ['required'],
            'file_sk_pmk' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
        ],
        [
            'tahun_plus_disetujui.required'=>'data tahun plus disetujui harus diisi!',
            'bulan_plus_disetujui.required'=>'data bulan plus disetujui harus diisi!',
            'tanggal_sk.required'=>'data tanggal sk harus diisi!',
            'no_sk.required'=>'data no sk harus diisi!',
            'pejabat_penetap.required'=>'data pejabat penetap harus diisi!',
            'file_sk_pmk.mimes' => 'format file sk harus pdf/doc/docx!',
            'file_sk_pmk.max' => 'ukuran file terlalu besar (maksimal file 2Mb)!',
            'file_sk_pmk.file' => 'upload data harus berupa file!',
        ]);

        try {
            //update
            $pegawai_tambahan_mk->tahun_plus_disetujui = $request->tahun_plus_disetujui;
            $pegawai_tambahan_mk->bulan_plus_disetujui = $request->bulan_plus_disetujui;
            $pegawai_tambahan_mk->tanggal_sk = $request->tanggal_sk;
            $pegawai_tambahan_mk->no_sk = $request->no_sk;
            $pegawai_tambahan_mk->pejabat_penetap = $request->pejabat_penetap;
            $pegawai_tambahan_mk->status = 3;

            $pegawai_tambahan_mk->update();

            if ($request->file('file_sk_pmk')) {
                $pegawai_tambahan_mk->clearMediaCollection('file_sk_pmk');
                $pegawai_tambahan_mk->addMediaFromRequest('file_sk_pmk')->toMediaCollection('file_sk_pmk');
            }

            DB::commit();
            Log::info('Data berhasil di-update di method update pada PegawaiTambahanMkController!');

            return redirect()->route('pegawai-tambahan-mk.index')
                ->with('success', 'Data Persetujuan PMK Pegawai berhasil diupdate');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada PegawaiTambahanMkController!']);

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
    public function destroy(PegawaiTambahanMk $pegawai_tambahan_mk)
    {           
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        
        DB::beginTransaction();
        try {
            $pegawai_tambahan_mk->tahun_plus_disetujui = null;
            $pegawai_tambahan_mk->bulan_plus_disetujui = null;
            $pegawai_tambahan_mk->tanggal_sk = null;
            $pegawai_tambahan_mk->no_sk = null;
            $pegawai_tambahan_mk->pejabat_penetap = null;
            $pegawai_tambahan_mk->status = 2;

            $pegawai_tambahan_mk->update();

            $pegawai_tambahan_mk->clearMediaCollection('file_sk_pmk');

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan PMK berhasil dibatalkan!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PegawaiTambahanMkController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan PMK gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Pengajuan PMK gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PegawaiTambahanMkController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
