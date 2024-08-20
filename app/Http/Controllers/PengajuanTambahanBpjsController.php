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
        $title = 'Pengajuan BPJS Keluarga Lain';

        return view('pengajuan-tambahan-bpjs.index', compact('title'));
    }

    public function datatable(Request $request)
    {
        $data = PegawaiBpjsLainnya::select('*')
            ->where('pegawai_id', '=', Auth::user()->pegawai_id)
            ->orderBy('created_at', 'DESC');

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    return 'Pengajuan';
                }
                if ($data->status == 2) {
                    return 'Ditolak';
                }
                if ($data->status == 3) {
                    return 'Disetujui';
                }
                if ($data->status == 4) {
                    return 'Daftar Ke BPJS';
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
        $title = 'Buat Pengajuan BPJS Keluarga Lain';

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

        $this->validate(
            $request,
            [
                'nama_keluarga' => ['required'],
                'nik_keluarga' => ['required'],
                'no_kk_keluarga' => ['required'],
                'status_keluarga' => ['required'],

                'file_pengajuan_bpjs' => ['required', 'file', 'mimes:rar,zip', 'max:51200'],
            ],
            [
                'nama_keluarga.required' => 'data nama keluarga harus diisi!',
                'nik_keluarga.required' => 'data nik keluarga harus diisi!',
                'no_kk_keluarga.required' => 'data no kk keluarga harus diisi!',
                'status_keluarga.required' => 'data status keluarga harus diisi!',

                'file_pengajuan_bpjs.required' => 'data file harus di-upload!',
                'file_pengajuan_bpjs.mimes' => 'format file harus rar/zip!',
                'file_pengajuan_bpjs.max' => 'ukuran file terlalu besar (maksimal file 50Mb)!',
                'file_pengajuan_bpjs.file' => 'upload data harus berupa file!',
            ]
        );

        try {
            //validasi pegawai_id, golongan_id
            $cekDataExist = PegawaiBpjsLainnya::where('pegawai_id', Auth::user()->pegawai_id)
                ->where('nama_keluarga', $request->nama_keluarga)
                ->where('nik_keluarga', $request->nik_keluarga)
                ->get();

            if ($cekDataExist->isNotEmpty()) {
                session()->flash('message', 'Data pengajuan bpjs keluarga lain sudah ada!');

                return redirect()->back();
            } else {
                //insert
                $bpjs = new PegawaiBpjsLainnya();
                $bpjs->pegawai_id = Auth::user()->pegawai_id;

                $bpjs->nama_keluarga = $request->nama_keluarga;
                $bpjs->nik_keluarga = $request->nik_keluarga;
                $bpjs->no_kk_keluarga = $request->no_kk_keluarga;
                $bpjs->status_keluarga = $request->status_keluarga;
                //$bpjs->daftar_ke_bpjs = 'N';
                $bpjs->status = 1;

                $bpjs->save();

                if ($request->file_pengajuan_bpjs) {
                    $bpjs->addMediaFromRequest('file_pengajuan_bpjs')->toMediaCollection('file_pengajuan_bpjs');
                }

                DB::commit();
                Log::info('Data berhasil di-insert di method store pada PengajuanTambahanBpjsController!');

                return redirect()->route('pengajuan-tambahan-bpjs.index')
                    ->with('success', 'Data Pengajuan BPJS Keluarga Lain berhasil disimpan');
            }
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

        // $cek_media = $bpjs->getMedia("file_kartu_bpjs")->count();
        // if ($cek_media) {
        //     $bpjs->file_kartu_bpjs = $bpjs->getMedia("file_kartu_bpjs")[0]->getUrl();
        // }

        $cek_media = $bpjs->getMedia("file_pengajuan_bpjs")->count();
        if ($cek_media) {
            $bpjs->file_pengajuan_bpjs = $bpjs->getFirstMediaUrl("file_pengajuan_bpjs");
        }

        return view('pengajuan-tambahan-bpjs.show', compact('title', 'bpjs'));
    }

    public function edit(PegawaiBpjsLainnya $pengajuan_tambahan_bpj)
    {
        $title = 'Ubah Pengajuan BPJS Keluarga Lain';

        $bpjs = $pengajuan_tambahan_bpj;

        $cek_media = $bpjs->getMedia("file_pengajuan_bpjs")->count();
        if ($cek_media) {
            $bpjs->file_pengajuan_bpjs = $bpjs->getFirstMediaUrl("file_pengajuan_bpjs");
        }

        return view('pengajuan-tambahan-bpjs.edit', compact('title', 'bpjs'));
    }

    public function update(Request $request, PegawaiBpjsLainnya $pengajuan_tambahan_bpj)
    {
        DB::beginTransaction();

        $this->validate(
            $request,
            [
                'nama_keluarga' => ['required'],
                'nik_keluarga' => ['required'],
                'no_kk_keluarga' => ['required'],
                'status_keluarga' => ['required'],

                'file_pengajuan_bpjs' => ['nullable', 'file', 'mimes:rar,zip', 'max:51200'],
            ],
            [
                'nama_keluarga.required' => 'data nama keluarga harus diisi!',
                'nik_keluarga.required' => 'data nik keluarga harus diisi!',
                'no_kk_keluarga.required' => 'data no kk keluarga harus diisi!',
                'status_keluarga.required' => 'data status keluarga harus diisi!',

                'file_pengajuan_bpjs.mimes' => 'format file harus rar/zip!',
                'file_pengajuan_bpjs.max' => 'ukuran file terlalu besar (maksimal file 50Mb)!',
                'file_pengajuan_bpjs.file' => 'upload data harus berupa file!',
            ]
        );

        try {
            //validasi nama
            $cekDataExist = PegawaiBpjsLainnya::where('pegawai_id', $pengajuan_tambahan_bpj->pegawai_id)
                ->where('nama_keluarga', $request->nama_keluarga)
                ->where('nik_keluarga', $request->nik_keluarga)
                ->where('id', '!=', $pengajuan_tambahan_bpj->id)
                ->get();

            if ($cekDataExist->isNotEmpty()) {
                session()->flash('message', 'Data pengajuan bpjs keluarga lain sudah ada!');

                return redirect()->back();
            } else {
                //update
                //$pegawai_riwayat_golongan->pegawai_id = $request->pegawai_id;
                $pengajuan_tambahan_bpj->nama_keluarga = $request->nama_keluarga;
                $pengajuan_tambahan_bpj->nik_keluarga = $request->nik_keluarga;
                $pengajuan_tambahan_bpj->no_kk_keluarga = $request->no_kk_keluarga;
                $pengajuan_tambahan_bpj->status_keluarga = $request->status_keluarga;

                //$pengajuan_tambahan_bpj->daftar_ke_bpjs = 'N';
                $pengajuan_tambahan_bpj->status = 1;
                $pengajuan_tambahan_bpj->update();

                if ($request->file('file_pengajuan_bpjs')) {
                    $pengajuan_tambahan_bpj->clearMediaCollection('file_pengajuan_bpjs');
                    $pengajuan_tambahan_bpj->addMediaFromRequest('file_pengajuan_bpjs')->toMediaCollection('file_pengajuan_bpjs');
                }

                DB::commit();
                Log::info('Data berhasil di-update di method update pada PegawaiPengajuanTambahanBpjsController!');

                return redirect()->route('pengajuan-tambahan-bpjs.index')
                    ->with('success', 'Data Pengajuan BPJS Keluarga Lain berhasil diupdate');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada PegawaiPengajuanTambahanBpjsController!']);

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
    public function destroy(PegawaiBpjsLainnya $pengajuan_tambahan_bpj)
    {
        DB::beginTransaction();
        try {
            $pengajuan_tambahan_bpj->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan BPJS Keluarga Lain berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PengajuanTambahanBpjsController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan BPJS Keluarga Lain gagal ditolak!',
                'error' => true,
                'error_message' => 'Data Pengajuan BPJS Keluarga Lain gagal ditolak!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PengajuanTambahanBpjsController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
