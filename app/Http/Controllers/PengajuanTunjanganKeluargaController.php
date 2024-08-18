<?php

namespace App\Http\Controllers;

use App\Models\PegawaiTunjanganKeluarga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PengajuanTunjanganKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pengajuan Tunjangan Keluarga';

        return view('pengajuan-tunjangan-keluarga.index', compact('title'));
    }

    public function datatable(Request $request)
    {
        $data = PegawaiTunjanganKeluarga::select('*')
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
            })

            ->addColumn('aksi', 'pengajuan-tunjangan-keluarga.aksi')
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
        $title = 'Buat Pengajuan Tunjangan Keluarga';

        return view('pengajuan-tunjangan-keluarga.create', compact('title'));
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
                'nama' => ['required'],
                'nik' => ['required'],
                'no_kk' => ['required'],
                'status_keluarga' => ['required'],
                'tgl_lahir' => ['required'],

                'tgl_perkawinan' => ['required_if:status_keluarga,Suami,Istri'],

                'file_pengajuan_kp' => ['required', 'file', 'mimes:rar,zip', 'max:51200'],
            ],
            [
                'nama.required' => 'data nama harus diisi!',
                'nik.required' => 'data nik harus diisi!',
                'no_kk.required' => 'data no kk harus diisi!',
                'status_keluarga.required' => 'data status keluarga harus diisi!',

                'tgl_perkawinan.required_if' => 'Tanggal perkawinan harus diisi!',

                'file_pengajuan_kp.required' => 'data file harus di-upload!',
                'file_pengajuan_kp.mimes' => 'format file sk harus rar/zip!',
                'file_pengajuan_kp.max' => 'ukuran file terlalu besar (maksimal file 50Mb)!',
                'file_pengajuan_kp.file' => 'upload data harus berupa file!',
            ]
        );

        try {
            //validasi pegawai_id, golongan_id
            $cekDataExist = PegawaiTunjanganKeluarga::where('pegawai_id', Auth::user()->pegawai_id)
                ->where('nama', $request->nama)
                ->where('nik', $request->nik)
                ->get();

            if ($cekDataExist->isNotEmpty()) {
                session()->flash('message', 'Data pengajuan tunjangan keluarga sudah ada!');

                return redirect()->back();
            } else {
                //insert
                $ptk = new PegawaiTunjanganKeluarga();
                $ptk->pegawai_id = Auth::user()->pegawai_id;

                $ptk->nama = $request->nama;
                $ptk->nik = $request->nik;
                $ptk->no_kk = $request->no_kk;
                $ptk->status_keluarga = $request->status_keluarga;

                $ptk->tgl_lahir = $request->tgl_lahir;

                if ($request->status_keluarga == 'Anak') {
                    $ptk->tgl_perkawinan = null;
                } else {
                    $ptk->tgl_perkawinan = $request->tgl_perkawinan;
                }

                //$bpjs->daftar_ke_bpjs = 'N';
                $ptk->status = 1;

                $ptk->save();

                if ($request->file_pengajuan_kp) {
                    $ptk->addMediaFromRequest('file_pengajuan_kp')->toMediaCollection('file_pengajuan_kp');
                }

                DB::commit();
                Log::info('Data berhasil di-insert di method store pada PengajuanTunjanganKeluargaController!');

                return redirect()->route('pengajuan-tunjangan-keluarga.index')
                    ->with('success', 'Data Pengajuan Tunjangan Keluarga berhasil disimpan');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada PengajuanTunjanganKeluargaController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }
    }

    public function show(PegawaiTunjanganKeluarga $pengajuan_tunjangan_keluarga)
    {
        $title = 'Lihat File';

        $ptk = $pengajuan_tunjangan_keluarga;

        $cek_media = $ptk->getMedia("file_kp_ttd")->count();
        if ($cek_media) {
            $ptk->file_kp4_ttd = $ptk->getMedia("file_kp_ttd")[0]->getUrl();
        }

        $cek_media = $ptk->getMedia("file_pengajuan_kp")->count();
        if ($cek_media) {
            $ptk->file_pengajuan_kp = $ptk->getFirstMediaUrl("file_pengajuan_kp");
        }

        return view('pengajuan-tunjangan-keluarga.show', compact('title', 'ptk'));
    }

    public function edit(PegawaiTunjanganKeluarga $pengajuan_tunjangan_keluarga)
    {
        $title = 'Ubah Pengajuan Tunjangan Keluarga';

        $ptk = $pengajuan_tunjangan_keluarga;

        $cek_media = $ptk->getMedia("file_pengajuan_kp")->count();
        if ($cek_media) {
            $ptk->file_pengajuan_kp = $ptk->getFirstMediaUrl("file_pengajuan_kp");
        }

        return view('pengajuan-tunjangan-keluarga.edit', compact('title', 'ptk'));
    }

    public function update(Request $request, PegawaiTunjanganKeluarga $pengajuan_tunjangan_keluarga)
    {
        DB::beginTransaction();

        $this->validate(
            $request,
            [
                'nama' => ['required'],
                'nik' => ['required'],
                'no_kk' => ['required'],
                'status_keluarga' => ['required'],
                'tgl_lahir' => ['required'],

                'tgl_perkawinan' => ['required_if:status_keluarga,Suami,Istri'],

                'file_pengajuan_kp' => ['nullable', 'file', 'mimes:rar,zip', 'max:51200'],
            ],
            [
                'nama.required' => 'data nama harus diisi!',
                'nik.required' => 'data nik harus diisi!',
                'no_kk.required' => 'data no kk harus diisi!',
                'status_keluarga.required' => 'data status keluarga harus diisi!',

                'tgl_perkawinan.required_if' => 'Tanggal perkawinan harus diisi!',

                'file_pengajuan_kp.mimes' => 'format file sk harus rar/zip!',
                'file_pengajuan_kp.max' => 'ukuran file terlalu besar (maksimal file 50Mb)!',
                'file_pengajuan_kp.file' => 'upload data harus berupa file!',
            ]
        );

        try {
            //validasi nama
            $cekDataExist = PegawaiTunjanganKeluarga::where('pegawai_id', $pengajuan_tunjangan_keluarga->pegawai_id)
                ->where('nama', $request->nama)
                ->where('nik', $request->nik)
                ->where('id', '!=', $pengajuan_tunjangan_keluarga->id)
                ->get();

            if ($cekDataExist->isNotEmpty()) {
                session()->flash('message', 'Data pengajuan tunjangan keluarga sudah ada!');

                return redirect()->back();
            } else {
                //update
                //$pegawai_riwayat_golongan->pegawai_id = $request->pegawai_id;
                $pengajuan_tunjangan_keluarga->nama = $request->nama;
                $pengajuan_tunjangan_keluarga->nik = $request->nik;
                $pengajuan_tunjangan_keluarga->no_kk = $request->no_kk;
                $pengajuan_tunjangan_keluarga->status_keluarga = $request->status_keluarga;

                $pengajuan_tunjangan_keluarga->tgl_lahir = $request->tgl_lahir;

                if ($request->status_keluarga == 'Anak') {
                    $pengajuan_tunjangan_keluarga->tgl_perkawinan = null;
                } else {
                    $pengajuan_tunjangan_keluarga->tgl_perkawinan = $request->tgl_perkawinan;
                }
                //$pengajuan_tambahan_bpj->daftar_ke_bpjs = 'N';
                $pengajuan_tunjangan_keluarga->status = 1;
                $pengajuan_tunjangan_keluarga->update();

                if ($request->file('file_pengajuan_kp')) {
                    $pengajuan_tunjangan_keluarga->clearMediaCollection('file_pengajuan_kp');
                    $pengajuan_tunjangan_keluarga->addMediaFromRequest('file_pengajuan_kp')->toMediaCollection('file_pengajuan_kp');
                }

                DB::commit();
                Log::info('Data berhasil di-update di method update pada PegawaiPengajuanTunjanganKeluargaController!');

                return redirect()->route('pengajuan-tunjangan-keluarga.index')
                    ->with('success', 'Data Pengajuan Tunjangan Keluarga berhasil diupdate');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada PegawaiPengajuanTunjanganKeluargaController!']);

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
    public function destroy(PegawaiTunjanganKeluarga $pengajuan_tunjangan_keluarga)
    {
        DB::beginTransaction();
        try {
            $pengajuan_tunjangan_keluarga->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan Tunjangan Keluarga berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PengajuanTunjanganKeluargaController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan Tunjangan Keluarga gagal ditolak!',
                'error' => true,
                'error_message' => 'Data Pengajuan Tunjangan Keluarga gagal ditolak!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PengajuanTunjanganKeluargaController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
