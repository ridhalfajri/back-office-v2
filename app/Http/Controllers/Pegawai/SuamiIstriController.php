<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\JenisKawin;
use App\Models\Pegawai;
use App\Models\PegawaiSuamiIstri;
use App\Models\Pendidikan;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SuamiIstriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($pegawai_id)
    {
        $title = "Pasangan";
        $pegawai = Pegawai::select('id', 'nama_depan', 'nama_belakang')->where('id', $pegawai_id)->first();
        $pendidikan = Pendidikan::select('id', 'nama')->get();
        $jenis_kawin = JenisKawin::select('id', 'nama')->get();
        return view('pegawai.keluarga.create-pasangan', compact('title', 'pegawai', 'pendidikan', 'jenis_kawin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'pegawai_id' => ['required', 'exists:pegawai,id'],
                'nama' => ['required', 'max:100'],
                'nik' => ['required', 'numeric', 'digits:16'],
                'tempat_lahir' => ['required', 'max:50'],
                'tanggal_lahir' => ['required', 'date_format:d-m-Y'],
                'tanggal_kawin' => ['required', 'date_format:d-m-Y'],
                'no_kartu' => ['required', 'max:50'],
                'is_pns' => ['required', 'boolean', 'max:1'],
                'pendidikan_id' => ['required', 'exists:pendidikan,id'],
                'pekerjaan' => ['required', 'max:50'],
                'status_tunjangan' => ['required', 'boolean', 'max:1'],
                'no_sk_cerai' => ['nullable', 'max:50'],
                'tmt_sk_cerai' => ['nullable', 'date_format:d-m-Y'],
                'jenis_kawin_id' => ['required', 'exists:jenis_kawin,id'],
                'no_buku_nikah' => ['required', 'max:50'],
                'media_foto_pasangan' => ['nullable', 'mimes:jpg,jpeg,png', 'file', 'max:1024'],
                'media_buku_nikah' => ['nullable', 'mimes:pdf', 'file', 'max:1024']
            ],
            [
                'pegawai_id.required' => 'pegawai harus diisi',
                'pegawai_id.exists' => 'pegawai tidak valid',
                'pendidikan_id.required' => 'pendidikan harus diisi',
                'pendidikan_id.exists' => 'pendidikan tidak valid',
                'nama.required' => 'nama harus diisi',
                'nama.max' => 'nama maksimal 100 karakter',
                'nik.required' => 'nik harus diisi',
                'nik.numeric' => 'nik harus berupa angka',
                'nik.digits' => 'nik harus 16 digit',
                'tempat_lahir.required' => 'tempat lahir harus diiisi',
                'tempat_lahir.max' => 'tempat lahir maksimal 50 karakter',
                'tanggal_lahir.required' => 'tempat lahir harus diiisi',
                'tanggal_lahir.date_format' => 'tanggal harus dalam bentuk format yang valid',
                'tanggal_kawin.required' => 'tempat kawin harus diiisi',
                'tanggal_kawin.date_format' => 'tanggal harus dalam bentuk format yang valid',
                'no_kartu.required' => 'no kartu harus diiisi',
                'no_kartu.max' => 'no kartu maksimal 50 karakter',
                'is_pns.required' => 'pns harus diiisi',
                'is_pns.boolean' => 'pns tidak valid',
                'status_tunjangan.required' => 'status tunjangan harus diiisi',
                'status_tunjangan.boolean' => 'status tunjangan tidak valid',
                'no_sk_cerai.max' => 'no sk cerai maksimal 50 karakter',
                'tmt_sk_cerai.date_format' => 'tanggal harus dalam bentuk format yang valid',
                'jenis_kawin_id.required' => 'jenis kawin harus diisi',
                'jenis_kawin_id.exists' => 'jenis kawin tidak valid',
                'no_buku_nikah.required' => 'no kartu harus diiisi',
                'no_buku_nikah.max' => 'no kartu maksimal 50 karakter',
                'media_buku_nikah.mimes' => 'format file buku nikah harus pdf',
                'media_buku_nikah.max' => 'ukuran file terlalu besar (maksimal file 1MB)',
                'media_foto_pasangan.mimes' => 'format foto pasangan harus jpg, jpeg, png',
                'media_foto_pasangan.max' => 'ukuran file terlalu besar (maksimal file 1MB)',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            $pasangan = new PegawaiSuamiIstri();
            $pasangan->pegawai_id = $request->pegawai_id;
            $pasangan->nama = $request->nama;
            $pasangan->nik = $request->nik;
            $pasangan->tempat_lahir = $request->tempat_lahir;
            $pasangan->tanggal_lahir = Carbon::parse($request->tanggal_lahir)->translatedFormat('Y-m-d');
            $pasangan->tanggal_kawin = Carbon::parse($request->tanggal_kawin)->translatedFormat('Y-m-d');
            $pasangan->no_kartu = $request->no_kartu;
            $pasangan->is_pns = $request->is_pns;
            $pasangan->pendidikan_id = $request->pendidikan_id;
            $pasangan->pekerjaan = $request->pekerjaan;
            $pasangan->status_tunjangan = $request->status_tunjangan;
            $pasangan->no_sk_cerai = $request->no_sk_cerai;
            $pasangan->tmt_sk_cerai = Carbon::parse($request->tmt_sk_cerai)->translatedFormat('Y-m-d');
            $pasangan->jenis_kawin_id = $request->jenis_kawin_id;
            $pasangan->no_buku_nikah = $request->no_buku_nikah;
            try {
                DB::transaction(function () use ($request, $pasangan) {
                    $pasangan->save();
                    if ($request->file('media_foto_pasangan')) {
                        $pasangan->addMediaFromRequest('media_foto_pasangan')->toMediaCollection('media_foto_pasangan');
                    }
                    if ($request->file('media_buku_nikah')) {
                        $pasangan->addMediaFromRequest('media_buku_nikah')->toMediaCollection('media_buku_nikah');
                    }
                });
                return response()->json(['success' => 'Pasangan Berhasil Disimpan']);
            } catch (QueryException $e) {
                return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $pasangan = PegawaiSuamiIstri::select(
                'id',
                'pegawai_id',
                'nama',
                'nik',
                'tempat_lahir',
                'tanggal_lahir',
                'tanggal_kawin',
                'no_kartu',
                'is_pns',
                'pendidikan_id',
                'pekerjaan',
                'status_tunjangan',
                'no_sk_cerai',
                'tmt_sk_cerai',
                'jenis_kawin_id',
                'no_buku_nikah'
            )->where('id', $id)->first();

            if ($pasangan == null) {
                return response()->json(['errors' => ['data' => 'Data tidak ditemukan']]);
            }
            $pasangan->tanggal_lahir = Carbon::parse($pasangan->tanggal_lahir)->translatedFormat('d-m-Y');
            $pasangan->tanggal_kawin = Carbon::parse($pasangan->tanggal_kawin)->translatedFormat('d-m-Y');
            if ($pasangan->tmt_sk_cerai != null) {
                $pasangan->tmt_sk_cerai = Carbon::parse($pasangan->tmt_sk_cerai)->translatedFormat('d-m-Y');
            }
            $pasangan->media_buku_nikah = $pasangan->getMedia("media_buku_nikah")[0]->getUrl();
            $pasangan->media_foto_pasangan = $pasangan->getMedia("media_foto_pasangan")[0]->getUrl();
            $pasangan->jenis_kawin;
            $pasangan->pendidikan;
            return response()->json(['result' => $pasangan]);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Pasangan";
        $pasangan = PegawaiSuamiIstri::select(
            'id',
            'pegawai_id',
            'nama',
            'nik',
            'tempat_lahir',
            'tanggal_lahir',
            'tanggal_kawin',
            'no_kartu',
            'is_pns',
            'pendidikan_id',
            'pekerjaan',
            'status_tunjangan',
            'no_sk_cerai',
            'tmt_sk_cerai',
            'jenis_kawin_id',
            'no_buku_nikah'
        )->where('id', $id)->first();
        $pasangan->tanggal_lahir = Carbon::parse($pasangan->tanggal_lahir)->translatedFormat('d-m-Y');
        $pasangan->tanggal_kawin = Carbon::parse($pasangan->tanggal_kawin)->translatedFormat('d-m-Y');
        if ($pasangan->tmt_sk_cerai != null) {
            $pasangan->tmt_sk_cerai = Carbon::parse($pasangan->tmt_sk_cerai)->translatedFormat('d-m-Y');
        }
        $pasangan->media_buku_nikah = $pasangan->getMedia("media_buku_nikah")[0];
        $pasangan->media_foto_pasangan = $pasangan->getMedia("media_foto_pasangan")[0];
        $pendidikan = Pendidikan::select('id', 'nama')->get();
        $jenis_kawin = JenisKawin::select('id', 'nama')->get();
        return view('pegawai.keluarga.edit-pasangan', compact('title', 'pasangan', 'pendidikan', 'jenis_kawin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'pegawai_id' => ['required', 'exists:pegawai,id'],
                'nama' => ['required', 'max:100'],
                'nik' => ['required', 'numeric', 'digits:16'],
                'tempat_lahir' => ['required', 'max:50'],
                'tanggal_lahir' => ['required', 'date_format:d-m-Y'],
                'tanggal_kawin' => ['required', 'date_format:d-m-Y'],
                'no_kartu' => ['required', 'max:50'],
                'is_pns' => ['required', 'boolean', 'max:1'],
                'pendidikan_id' => ['required', 'exists:pendidikan,id'],
                'pekerjaan' => ['required', 'max:50'],
                'status_tunjangan' => ['required', 'boolean', 'max:1'],
                'no_sk_cerai' => ['nullable', 'max:50'],
                'tmt_sk_cerai' => ['nullable', 'date_format:d-m-Y'],
                'jenis_kawin_id' => ['required', 'exists:jenis_kawin,id'],
                'no_buku_nikah' => ['required', 'max:50'],
                'media_foto_pasangan' => ['nullable', 'mimes:jpg,jpeg,png', 'file', 'max:1024'],
                'media_buku_nikah' => ['nullable', 'mimes:pdf', 'file', 'max:1024']
            ],
            [
                'pegawai_id.required' => 'pegawai harus diisi',
                'pegawai_id.exists' => 'pegawai tidak valid',
                'pendidikan_id.required' => 'pendidikan harus diisi',
                'pendidikan_id.exists' => 'pendidikan tidak valid',
                'nama.required' => 'nama harus diisi',
                'nama.max' => 'nama maksimal 100 karakter',
                'nik.required' => 'nik harus diisi',
                'nik.numeric' => 'nik harus berupa angka',
                'nik.digits' => 'nik harus 16 digit',
                'tempat_lahir.required' => 'tempat lahir harus diiisi',
                'tempat_lahir.max' => 'tempat lahir maksimal 50 karakter',
                'tanggal_lahir.required' => 'tempat lahir harus diiisi',
                'tanggal_lahir.date_format' => 'tanggal harus dalam bentuk format yang valid',
                'tanggal_kawin.required' => 'tempat kawin harus diiisi',
                'tanggal_kawin.date_format' => 'tanggal harus dalam bentuk format yang valid',
                'no_kartu.required' => 'no kartu harus diiisi',
                'no_kartu.max' => 'no kartu maksimal 50 karakter',
                'is_pns.required' => 'pns harus diiisi',
                'is_pns.boolean' => 'pns tidak valid',
                'status_tunjangan.required' => 'status tunjangan harus diiisi',
                'status_tunjangan.boolean' => 'status tunjangan tidak valid',
                'no_sk_cerai.max' => 'no sk cerai maksimal 50 karakter',
                'tmt_sk_cerai.date_format' => 'tanggal harus dalam bentuk format yang valid',
                'jenis_kawin_id.required' => 'jenis kawin harus diisi',
                'jenis_kawin_id.exists' => 'jenis kawin tidak valid',
                'no_buku_nikah.required' => 'no kartu harus diiisi',
                'no_buku_nikah.max' => 'no kartu maksimal 50 karakter',
                'media_buku_nikah.mimes' => 'format file buku nikah harus pdf',
                'media_buku_nikah.max' => 'ukuran file terlalu besar (maksimal file 1MB)',
                'media_foto_pasangan.mimes' => 'format foto pasangan harus jpg, jpeg, png',
                'media_foto_pasangan.max' => 'ukuran file terlalu besar (maksimal file 1MB)',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            $pasangan = PegawaiSuamiIstri::where('id', $id)->first();
            $pasangan->pegawai_id = $request->pegawai_id;
            $pasangan->nama = $request->nama;
            $pasangan->nik = $request->nik;
            $pasangan->tempat_lahir = $request->tempat_lahir;
            $pasangan->tanggal_lahir = Carbon::parse($request->tanggal_lahir)->translatedFormat('Y-m-d');
            $pasangan->tanggal_kawin = Carbon::parse($request->tanggal_kawin)->translatedFormat('Y-m-d');
            $pasangan->no_kartu = $request->no_kartu;
            $pasangan->is_pns = $request->is_pns;
            $pasangan->pendidikan_id = $request->pendidikan_id;
            $pasangan->pekerjaan = $request->pekerjaan;
            $pasangan->status_tunjangan = $request->status_tunjangan;
            $pasangan->no_sk_cerai = $request->no_sk_cerai;
            $pasangan->tmt_sk_cerai = Carbon::parse($request->tmt_sk_cerai)->translatedFormat('Y-m-d');
            $pasangan->jenis_kawin_id = $request->jenis_kawin_id;
            $pasangan->no_buku_nikah = $request->no_buku_nikah;
            try {
                DB::transaction(function () use ($pasangan, $request) {
                    $pasangan->save();
                    if ($request->file('media_foto_pasangan')) {
                        $pasangan->clearMediaCollection('media_foto_pasangan');
                        $pasangan->addMediaFromRequest('media_foto_pasangan')->toMediaCollection('media_foto_pasangan');
                    }
                    if ($request->file('media_buku_nikah')) {
                        $pasangan->clearMediaCollection('media_buku_nikah');
                        $pasangan->addMediaFromRequest('media_buku_nikah')->toMediaCollection('media_buku_nikah');
                    }
                });
                return response()->json(['success' => 'Pasangan Berhasil Disimpan']);
            } catch (QueryException $e) {
                return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasangan = PegawaiSuamiIstri::where('id', $id)->first();

        if ($pasangan == null) {
            return response()->json(['errors' => ['connection' => 'Tidak menemukan data yang dihapus']]);
        }
        try {
            DB::transaction(function () use ($pasangan) {
                if ($pasangan->hasMedia("media_buku_nikah")) {
                    $pasangan->getMedia("media_buku_nikah")[0]->delete();
                }
                if ($pasangan->hasMedia("media_foto_pasangan")) {
                    $pasangan->getMedia("media_foto_pasangan")[0]->delete();
                }
                $pasangan->delete();
            });
            return response()->json(['success' => 'Sukses Mengubah Data']);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['connection' => 'Data gagal dihapus']]);
        }
    }

    /**
     * Datatable Pasangan
     */
    public function datatable(Request $request)
    {
        $pasangan = PegawaiSuamiIstri::select('id', 'nama', 'nik', 'status_tunjangan')
            ->where('pegawai_id', $request->pegawai_id)->orderBy('created_at', 'ASC');
        return DataTables::of($pasangan)
            ->addColumn('no', '')
            ->addColumn('aksi', 'pegawai.keluarga.aksi-pasangan')
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function getPasanganById(Request $request)
    {
    }
}
