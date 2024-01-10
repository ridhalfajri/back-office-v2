<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\JenisDiklat;
use App\Models\Pegawai;
use App\Models\PegawaiRiwayatDiklat;
use App\Models\PegawaiRiwayatJabatan;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PegawaiDiklatController extends Controller
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
        $title = 'Diklat';
        try {
            $jenis_diklat = JenisDiklat::select('id', 'nama')->get();
            $pegawai = Pegawai::select('id', 'nama_depan', 'nama_belakang')->where('id', $pegawai_id)->first();
        } catch (\Throwable $th) {
            abort(500);
        }
        return view('pegawai.diklat.create', compact('title', 'jenis_diklat', 'pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => ['nullable'],
                'pegawai_id' => ['required', 'exists:pegawai,id'],
                'jenis_diklat_id' => ['required', 'exists:jenis_diklat,id'],
                'tanggal_mulai' => ['required', 'date_format:d-m-Y'],
                'tanggal_akhir' => ['required', 'date_format:d-m-Y'],
                'jam_pelajaran' => ['required', 'numeric'],
                'lokasi' => ['required'],
                'penyelenggaran' => ['required', 'max:100'],
                'no_sertifikat' => ['required', 'max:100'],
                'tanggal_sertifikat' => ['required', 'date_format:d-m-Y'],
                'media_sertifikat' => ['required_without:id', 'nullable', 'mimes:pdf,jpg,jpeg,png', 'file', 'max:1024',],
            ],
            [
                'pegawai_id.required' => 'pegawai harus diisi',
                'pegawai_id.exists' => 'pegawai tidak valid',
                'jenis_diklat_id.required' => 'jenis diklat harus diisi',
                'jenis_diklat_id.exists' => 'jenis diklat tidak valid',
                'tanggal_mulai.required' => 'tanggal mulai harus diisi ',
                'tanggal_mulai.date_format' => 'tanggal harus dalam bentuk format yang valid ',
                'tanggal_akhir.required' => 'tanggal akhir harus diisi ',
                'tanggal_akhir.date_format' => 'tanggal harus dalam bentuk format yang valid ',
                'jam_pelajaran.required' => 'jam pelajaran harus diisi ',
                'jam_pelajaran.numeric' => 'jam pelajaran harus dalam bentuk angka',
                'lokasi.required' => 'lokasi harus diisi',
                'penyelenggaran.required' => 'penyelenggaran harus diisi',
                'penyelenggaran.max' => 'penyelnggaran terlalu panjang',
                'no_sertifikat.required' => 'no sertifikat harus diisi',
                'no_sertifikat.max' => 'penyelnggaran terlalu panjang',
                'tanggal_sertifikat.required' => 'tanggal sertifikat harus diisi ',
                'tanggal_sertifikat.date_format' => 'tanggal harus dalam bentuk format yang valid ',
                'media_sertifikat.required_without' => 'file sertifikat harus diisi',
                'media_sertifikat.mimes' => 'format file sertifikat harus pdf, jpg, jpeg, png',
                'media_sertifikat.max' => 'ukuran file terlalu besar (maksimal file 1MB)',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            $diklat = new PegawaiRiwayatDiklat();
            $diklat->pegawai_id = $request->pegawai_id;
            $diklat->jenis_diklat_id = $request->jenis_diklat_id;
            $diklat->tanggal_mulai = date('Y-m-d', strtotime($request->tanggal_mulai));
            $diklat->tanggal_akhir = date('Y-m-d', strtotime($request->tanggal_akhir));
            $diklat->jam_pelajaran = $request->jam_pelajaran;
            $diklat->lokasi = $request->lokasi;
            $diklat->penyelenggaran = $request->penyelenggaran;
            $diklat->no_sertifikat = $request->no_sertifikat;
            $diklat->tanggal_sertifikat = date('Y-m-d', strtotime($request->tanggal_sertifikat));
            try {
                DB::transaction(function () use ($diklat) {
                    $diklat->save();
                    $diklat->addMediaFromRequest('media_sertifikat')->toMediaCollection('media_sertifikat');
                });
                return response()->json(['success' => 'Sukses Mengubah Data']);
            } catch (\Throwable $th) {
                return response()->json(['errors' => ['connection' => 'Data gagal disimpan']]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $diklat = PegawaiRiwayatDiklat::select('id', 'jenis_diklat_id', 'tanggal_mulai', 'tanggal_akhir', 'jam_pelajaran', 'lokasi', 'penyelenggaran', 'no_sertifikat', 'tanggal_sertifikat')
                ->where('id', $id)->first();
            if ($diklat == null) {
                return response()->json(['errors' => ['data' => 'Data tidak ditemukan']]);
            }
            $diklat->media_sertifikat = $diklat->getMedia("media_sertifikat")[0]->getUrl();
            $diklat->tanggal_mulai = Carbon::parse($diklat->tanggal_mulai)->translatedFormat('d F Y');
            $diklat->tanggal_akhir = Carbon::parse($diklat->tanggal_akhir)->translatedFormat('d F Y');
            $diklat->tanggal_sertifikat = Carbon::parse($diklat->tanggal_sertifikat)->translatedFormat('d F Y');
            $diklat->jenis_diklat->nama;
            return response()->json(['result' => $diklat]);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $title = "Diklat";
        $diklat = PegawaiRiwayatDiklat::select('id', 'pegawai_id', 'jenis_diklat_id', 'tanggal_mulai', 'tanggal_akhir', 'jam_pelajaran', 'lokasi', 'penyelenggaran', 'no_sertifikat', 'tanggal_sertifikat')->where('id', $id)->first();
        $diklat->tanggal_mulai = Carbon::parse($diklat->tanggal_mulai)->translatedFormat('d-m-Y');
        $diklat->tanggal_akhir = Carbon::parse($diklat->tanggal_akhir)->translatedFormat('d-m-Y');
        $diklat->tanggal_sertifikat = Carbon::parse($diklat->tanggal_sertifikat)->translatedFormat('d-m-Y');
        $diklat->media_sertifikat = $diklat->getMedia("media_sertifikat")[0];
        $jenis_diklat = JenisDiklat::select('id', 'nama')->get();
        if ($diklat == null) {
            abort(404);
        } else {
            return view('pegawai.diklat.edit', compact('title', 'diklat', 'jenis_diklat'));
        }
        try {
        } catch (QueryException $e) {
            abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => ['nullable'],
                'pegawai_id' => ['required', 'exists:pegawai,id'],
                'jenis_diklat_id' => ['required', 'exists:jenis_diklat,id'],
                'tanggal_mulai' => ['required', 'date_format:d-m-Y'],
                'tanggal_akhir' => ['required', 'date_format:d-m-Y'],
                'jam_pelajaran' => ['required', 'numeric'],
                'lokasi' => ['required'],
                'penyelenggaran' => ['required', 'max:100'],
                'no_sertifikat' => ['required', 'max:100'],
                'tanggal_sertifikat' => ['required', 'date_format:d-m-Y'],
                'media_sertifikat' => ['nullable', 'mimes:pdf,jpg,jpeg,png', 'file', 'max:1024',],
            ],
            [
                'pegawai_id.required' => 'pegawai harus diisi',
                'pegawai_id.exists' => 'pegawai tidak valid',
                'jenis_diklat_id.required' => 'jenis diklat harus diisi',
                'jenis_diklat_id.exists' => 'jenis diklat tidak valid',
                'tanggal_mulai.required' => 'tanggal mulai harus diisi ',
                'tanggal_mulai.date_format' => 'tanggal harus dalam bentuk format yang valid ',
                'tanggal_akhir.required' => 'tanggal akhir harus diisi ',
                'tanggal_akhir.date_format' => 'tanggal harus dalam bentuk format yang valid ',
                'jam_pelajaran.required' => 'jam pelajaran harus diisi ',
                'jam_pelajaran.numeric' => 'jam pelajaran harus dalam bentuk angka',
                'lokasi.required' => 'lokasi harus diisi',
                'penyelenggaran.required' => 'penyelenggaran harus diisi',
                'penyelenggaran.max' => 'penyelnggaran terlalu panjang',
                'no_sertifikat.required' => 'no sertifikat harus diisi',
                'no_sertifikat.max' => 'penyelnggaran terlalu panjang',
                'tanggal_sertifikat.required' => 'tanggal sertifikat harus diisi ',
                'tanggal_sertifikat.date_format' => 'tanggal harus dalam bentuk format yang valid ',
                'media_sertifikat.mimes' => 'format file sertifikat harus pdf, jpg, jpeg, png',
                'media_sertifikat.max' => 'ukuran file terlalu besar (maksimal file 1MB)',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            try {
                $diklat = PegawaiRiwayatDiklat::where('id', $id)->first();
                if ($diklat != null) {
                    $diklat->pegawai_id = $request->pegawai_id;
                    $diklat->jenis_diklat_id = $request->jenis_diklat_id;
                    $diklat->tanggal_mulai = Carbon::parse($diklat->tanggal_mulai)->translatedFormat('Y-m-d');
                    $diklat->tanggal_akhir = Carbon::parse($diklat->tanggal_akhir)->translatedFormat('Y-m-d');
                    $diklat->lokasi = $request->lokasi;
                    $diklat->jam_pelajaran = $request->jam_pelajaran;
                    $diklat->no_sertifikat = $request->no_sertifikat;
                    $diklat->is_verified = FALSE;
                    $diklat->tanggal_sertifikat = Carbon::parse($diklat->tanggal_sertifikat)->translatedFormat('Y-m-d');
                    $diklat->penyelenggaran = $request->penyelenggaran;

                    DB::transaction(function () use ($diklat, $request) {
                        $diklat->save();
                        if ($request->file('media_sertifikat')) {
                            $diklat->clearMediaCollection('media_sertifikat');
                            $diklat->addMediaFromRequest('media_sertifikat')->toMediaCollection('media_sertifikat');
                        }
                    });
                } else {
                    return response()->json(['errors' => ['connection' => 'Tidak menemukan data yang diubah']]);
                }
                return response()->json(['success' => 'Sukses Mengubah Data']);
            } catch (QueryException $e) {
                abort(500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $diklat = PegawaiRiwayatDiklat::where('id', $id)->first();

        if ($diklat == null) {
            return response()->json(['errors' => ['connection' => 'Tidak menemukan data yang dihapus']]);
        }
        try {
            DB::transaction(function () use ($diklat) {
                if ($diklat->hasMedia("media_sertifikat")) {
                    $diklat->getMedia("media_sertifikat")[0]->delete();
                }
                $diklat->delete();
            });
            return response()->json(['success' => 'Sukses Mengubah Data']);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['connection' => 'Data gagal dihapus']]);
        }
    }
    public function datatable(Request $request)
    {
        $diklat = PegawaiRiwayatDiklat::select('pegawai_riwayat_diklat.id', 'pegawai_id', 'jenis_diklat.nama as nama', 'jenis_diklat_id', 'tanggal_mulai', 'tanggal_akhir', 'penyelenggaran', 'is_verified')
            ->join('jenis_diklat', 'pegawai_riwayat_diklat.jenis_diklat_id', '=', 'jenis_diklat.id')
            ->where('pegawai_id', $request->pegawai_id)->orderBy('pegawai_riwayat_diklat.created_at', 'ASC');
        return DataTables::of($diklat)
            ->addColumn('no', '')
            ->addColumn('aksi', 'pegawai.aksi-diklat')
            ->editColumn('tanggal_mulai', function ($diklat) {
                return $diklat->tanggal_mulai ? with(new Carbon($diklat->tanggal_mulai))->format('d/m/Y') : '';
            })
            ->filterColumn('tanggal_mulai', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_mulai, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function verifikasi_sdmoh($id)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        $diklat = PegawaiRiwayatDiklat::where('id', $id)->first();
        $diklat->is_verified = TRUE;
        $diklat->save();
        return back();
    }
}
