<?php

namespace App\Http\Controllers;

use App\Models\PegawaiBpjsLainnya;
use App\Models\PegawaiBpjsRegular;
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

class PengajuanRegularBpjsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pengajuan BPJS Regular';

        return view('pengajuan-regular-bpjs.index', compact('title'));
    }

    public function datatable(Request $request)
    {
        $data = PegawaiBpjsRegular::select('*')
            ->where('pegawai_id', '=', Auth::user()->pegawai_id)
            ->orderBy('created_at', 'DESC');

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('status_hubungan', function ($data) {
                if ($data->kode_hub_keluarga == 1) {
                    return 'Peserta';
                }
                if ($data->kode_hub_keluarga == 2) {
                    return 'Istri';
                }
                if ($data->kode_hub_keluarga == 3) {
                    return 'Suami';
                }
                if ($data->kode_hub_keluarga == 4) {
                    return 'Anak';
                }
            })
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

            ->addColumn('aksi', 'pengajuan-regular-bpjs.aksi')
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
        $title = 'Buat Pengajuan BPJS Regular';

        return view('pengajuan-regular-bpjs.create', compact('title'));
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
                'kode_hub_keluarga' => ['required'],
                'nama' => ['required'],
                'nik' => ['required'],
                'no_kk' => ['required'],
                'tgl_lahir' => ['required'],
                'alamat' => ['required'],
                'email' => ['required', 'email'],
                'no_telepon' => ['required'],
                'kode_faskes' => ['required'],
                'nama_faskes' => ['required'],
                'nama_ibu_kandung' => ['required'],

                'file_pengajuan_bpjs_regular' => ['required', 'file', 'mimes:rar,zip', 'max:51200'],
            ],
            [
                'kode_hub_keluarga.required' => 'data hubungan keluarga harus diisi!',
                'nama.required' => 'data nama harus diisi!',
                'nik.required' => 'data nik harus diisi!',
                'no_kk.required' => 'data no. kk harus diisi!',

                'tgl_lahir.required' => 'data tanggal lahir harus diisi!',
                'alamat.required' => 'data alamat harus diisi!',
                'email.required' => 'data email harus diisi!',
                'email.email' => 'data email harus sesuai!',
                'no_telepon.required' => 'data no. telepon harus diisi!',
                'kode_faskes.required' => 'data kode faskes harus diisi!',
                'nama_faskes.required' => 'data nama faskes harus diisi!',
                'nama_ibu_kandung.required' => 'data nama ibu kandung harus diisi!',

                'file_pengajuan_bpjs_regular.required' => 'data file harus di-upload!',
                'file_pengajuan_bpjs_regular.mimes' => 'format file sk harus rar/zip!',
                'file_pengajuan_bpjs_regular.max' => 'ukuran file terlalu besar (maksimal file 50Mb)!',
                'file_pengajuan_bpjs_regular.file' => 'upload data harus berupa file!',
            ]
        );

        try {
            //validasi pegawai_id, golongan_id
            $cekDataExist = PegawaiBpjsRegular::where('pegawai_id', Auth::user()->pegawai_id)
                ->where('nama', $request->nama)
                ->where('nik', $request->nik)
                ->get();

            if ($cekDataExist->isNotEmpty()) {
                session()->flash('message', 'Data pengajuan bpjs regular sudah ada!');

                return redirect()->back();
            } else {
                //insert
                $bpjs = new PegawaiBpjsRegular();
                $bpjs->pegawai_id = Auth::user()->pegawai_id;

                $bpjs->kode_hub_keluarga = $request->kode_hub_keluarga;
                $bpjs->nama = $request->nama;
                $bpjs->nik = $request->nik;
                $bpjs->no_kk = $request->no_kk;

                $bpjs->tgl_lahir = $request->tgl_lahir;
                $bpjs->alamat = $request->alamat;
                $bpjs->email = $request->email;
                $bpjs->no_telepon = $request->no_telepon;
                $bpjs->kode_faskes = $request->kode_faskes;
                $bpjs->nama_faskes = $request->nama_faskes;
                $bpjs->nama_ibu_kandung = $request->nama_ibu_kandung;

                $bpjs->daftar_ke_bpjs = 'N';
                $bpjs->status = 1;

                $bpjs->save();

                if ($request->file_pengajuan_bpjs_regular) {
                    $bpjs->addMediaFromRequest('file_pengajuan_bpjs_regular')->toMediaCollection('file_pengajuan_bpjs_regular');
                }

                DB::commit();
                Log::info('Data berhasil di-insert di method store pada PengajuanRegularBpjsController!');

                return redirect()->route('pengajuan-regular-bpjs.index')
                    ->with('success', 'Data Pengajuan BPJS Regular berhasil disimpan');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada PengajuanRegularBpjsController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }
    }

    public function show(PegawaiBpjsRegular $pengajuan_regular_bpj)
    {
        $title = 'Lihat File';

        $bpjs = $pengajuan_regular_bpj;

        // $cek_media = $bpjs->getMedia("file_kartu_bpjs")->count();
        // if ($cek_media) {
        //     $bpjs->file_kartu_bpjs = $bpjs->getMedia("file_kartu_bpjs")[0]->getUrl();
        // }

        $cek_media = $bpjs->getMedia("file_pengajuan_bpjs_regular")->count();
        if ($cek_media) {
            $bpjs->file_pengajuan_bpjs_regular = $bpjs->getFirstMediaUrl("file_pengajuan_bpjs_regular");
        }

        return view('pengajuan-regular-bpjs.show', compact('title', 'bpjs'));
    }

    public function edit(PegawaiBpjsRegular $pengajuan_regular_bpj)
    {
        $title = 'Ubah Pengajuan BPJS Regular';

        $bpjs = $pengajuan_regular_bpj;

        $cek_media = $bpjs->getMedia("file_pengajuan_bpjs_regular")->count();
        if ($cek_media) {
            $bpjs->file_pengajuan_bpjs_regular = $bpjs->getFirstMediaUrl("file_pengajuan_bpjs_regular");
        }

        return view('pengajuan-regular-bpjs.edit', compact('title', 'bpjs'));
    }

    public function update(Request $request, PegawaiBpjsRegular $pengajuan_regular_bpj)
    {
        DB::beginTransaction();

        $this->validate(
            $request,
            [
                'kode_hub_keluarga' => ['required'],
                'nama' => ['required'],
                'nik' => ['required'],
                'no_kk' => ['required'],
                'tgl_lahir' => ['required'],
                'alamat' => ['required'],
                'email' => ['required', 'email'],
                'no_telepon' => ['required'],
                'kode_faskes' => ['required'],
                'nama_faskes' => ['required'],
                'nama_ibu_kandung' => ['required'],

                'file_pengajuan_bpjs_regular' => ['nullable', 'file', 'mimes:rar,zip', 'max:51200'],
            ],
            [
                'kode_hub_keluarga.required' => 'data hubungan keluarga harus diisi!',
                'nama.required' => 'data nama harus diisi!',
                'nik.required' => 'data nik harus diisi!',
                'no_kk.required' => 'data no. kk harus diisi!',

                'tgl_lahir.required' => 'data tanggal lahir harus diisi!',
                'alamat.required' => 'data alamat harus diisi!',
                'email.required' => 'data email harus diisi!',
                'email.email' => 'data email harus sesuai!',
                'no_telepon.required' => 'data no. telepon harus diisi!',
                'kode_faskes.required' => 'data kode faskes harus diisi!',
                'nama_faskes.required' => 'data nama faskes harus diisi!',
                'nama_ibu_kandung.required' => 'data nama ibu kandung harus diisi!',

                'file_pengajuan_bpjs_regular.mimes' => 'format file sk harus rar/zip!',
                'file_pengajuan_bpjs_regular.max' => 'ukuran file terlalu besar (maksimal file 50Mb)!',
                'file_pengajuan_bpjs_regular.file' => 'upload data harus berupa file!',
            ]
        );

        try {
            //validasi nama
            $cekDataExist = PegawaiBpjsRegular::where('pegawai_id', $pengajuan_regular_bpj->pegawai_id)
                ->where('nama', $request->nama)
                ->where('nik', $request->nik)
                ->where('id', '!=', $pengajuan_regular_bpj->id)
                ->get();

            if ($cekDataExist->isNotEmpty()) {
                session()->flash('message', 'Data pengajuan bpjs regular sudah ada!');

                return redirect()->back();
            } else {
                //update
                //$pegawai_riwayat_golongan->pegawai_id = $request->pegawai_id;
                $pengajuan_regular_bpj->kode_hub_keluarga = $request->kode_hub_keluarga;
                $pengajuan_regular_bpj->nama = $request->nama;
                $pengajuan_regular_bpj->nik = $request->nik;
                $pengajuan_regular_bpj->no_kk = $request->no_kk;

                $pengajuan_regular_bpj->tgl_lahir = $request->tgl_lahir;
                $pengajuan_regular_bpj->alamat = $request->alamat;
                $pengajuan_regular_bpj->email = $request->email;
                $pengajuan_regular_bpj->no_telepon = $request->no_telepon;
                $pengajuan_regular_bpj->kode_faskes = $request->kode_faskes;
                $pengajuan_regular_bpj->nama_faskes = $request->nama_faskes;
                $pengajuan_regular_bpj->nama_ibu_kandung = $request->nama_ibu_kandung;
                $pengajuan_regular_bpj->daftar_ke_bpjs = 'N';

                $pengajuan_regular_bpj->status = 1;
                $pengajuan_regular_bpj->update();

                if ($request->file('file_pengajuan_bpjs_regular')) {
                    $pengajuan_regular_bpj->clearMediaCollection('file_pengajuan_bpjs_regular');
                    $pengajuan_regular_bpj->addMediaFromRequest('file_pengajuan_bpjs_regular')->toMediaCollection('file_pengajuan_bpjs_regular');
                }

                DB::commit();
                Log::info('Data berhasil di-update di method update pada PegawaiPengajuanRegularBpjsController!');

                return redirect()->route('pengajuan-regular-bpjs.index')
                    ->with('success', 'Data Pengajuan BPJS Regular berhasil diupdate');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada PegawaiPengajuanRegularBpjsController!']);

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
    public function destroy(PegawaiBpjsRegular $pengajuan_regular_bpj)
    {
        DB::beginTransaction();
        try {
            $pengajuan_regular_bpj->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan BPJS Regular berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PengajuanRegularBpjsController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan BPJS Regular gagal ditolak!',
                'error' => true,
                'error_message' => 'Data Pengajuan BPJS Regular gagal ditolak!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PengajuanRegularBpjsController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
