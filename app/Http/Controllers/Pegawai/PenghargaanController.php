<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\PegawaiRiwayatPenghargaan;
use App\Models\Penghargaan;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PenghargaanController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'pegawai_id' => ['required'],
                'penghargaan_id' => ['required'],
                'no_sk' => ['required'],
                'tanggal_sk' => ['required', 'date_format:d-m-Y'],
                'tahun' => ['required', 'digits:4'],
                'media_sk' => ['nullable', 'mimes:jpg,png,jpeg,pdf'],
            ],
            [
                'pegawai_id.required' => 'pegawai harus diisi',
                'penghargaan_id.required' => 'penghargaan harus diisi',
                'no_sk.required' => 'No SK harus diisi',
                'tanggal_sk.required' => 'Tanggal SK harus diiisi',
                'tanggal.date_format' => 'Format tidak valid',
                'tahun.required' => 'Tahun harus diisi',
                'tahun.digits' => 'Tahun berupa 4 digit',
                'media_sk_penghargaan.mimes' => 'SK harus dalam format jpg, png, jpeg,pdf',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            if ($request->id_penghargaan != null) {
                $penghargaan = PegawaiRiwayatPenghargaan::where('id', $request->id_penghargaan)->first();
            } else {
                $penghargaan = new PegawaiRiwayatPenghargaan();
            }
            $penghargaan->pegawai_id = $request->pegawai_id;
            $penghargaan->penghargaan_id = $request->penghargaan_id;
            $penghargaan->no_sk = $request->no_sk;
            $penghargaan->tanggal_sk = Carbon::parse($request->tanggal_sk)->translatedFormat('Y-m-d');
            $penghargaan->tahun = $request->tahun;
            DB::transaction(function () use ($penghargaan, $request) {
                if ($request->id_penghargaan != null) {
                    if ($request->file('media_sk_penghargaan') != null) {
                        $penghargaan->clearMediaCollection('media_sk_penghargaan');
                    }
                }
                $penghargaan->save();
                $penghargaan->addMediaFromRequest('media_sk_penghargaan')->toMediaCollection('media_sk_penghargaan');
            });
            return response()->json(['success' => 'Tmt Gaji Berhasil Disimpan']);
            try {
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $penghargaan = PegawaiRiwayatPenghargaan::where('id', $id)->first();
            if ($penghargaan == null) {
                return response()->json(['errors' => ['data' => 'Data tidak ditemukan']]);
            }
            $penghargaan->tanggal_sk = Carbon::parse($penghargaan->tanggal_sk)->translatedFormat('d-m-Y');
            $penghargaan->penghargaan;
            try {
                $penghargaan->media_sk_penghargaan = $penghargaan->getMedia("media_sk_penghargaan")[0]->getUrl();
            } catch (\Throwable $th) {
            }
            return response()->json(['result' => $penghargaan]);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penghargaan = PegawaiRiwayatPenghargaan::where('id', $id)->first();

        if ($penghargaan == null) {
            return response()->json(['errors' => ['connection' => 'Tidak menemukan data yang dihapus']]);
        }
        try {
            DB::transaction(function () use ($penghargaan) {
                if ($penghargaan->hasMedia("media_sk_penghargaan")) {
                    $penghargaan->getMedia("media_sk_penghargaan")[0]->delete();
                }
                $penghargaan->delete();
            });
            return response()->json(['success' => 'Sukses Mengubah Data']);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['connection' => 'Data gagal dihapus']]);
        }
    }

    /**
     * Datatable Penghargaan
     */
    public function datatable(Request $request)
    {
        $penghargaan = PegawaiRiwayatPenghargaan::select('pegawai_riwayat_penghargaan.id', 'penghargaan_id', 'penghargaan.nama as nama', 'no_sk', 'tanggal_sk', 'tahun')
            ->join('penghargaan', 'penghargaan.id', '=', 'pegawai_riwayat_penghargaan.penghargaan_id')
            ->where('pegawai_id', $request->pegawai_id)->orderBy('pegawai_riwayat_penghargaan.created_at', 'ASC');
        return DataTables::of($penghargaan)
            ->addColumn('no', '')
            ->addColumn('aksi', 'pegawai.penghargaan.aksi-penghargaan')
            ->editColumn('tanggal_sk', function ($penghargaan) {
                return $penghargaan->tanggal_sk ? with(new Carbon($penghargaan->tanggal_sk))->format('d/m/Y') : '';
            })
            ->filterColumn('tanggal_sk', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_sk, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function get_penghargaan(Request $request)
    {
        try {
            $penghargaan = Penghargaan::select('id', 'nama')->get();
            echo "<option value=''>-- Pilih Penghargaan --</option>";
            foreach ($penghargaan as $item) {
                if ($request->penghargaan_id != null && $request->penghargaan_id == $item->id) {
                    echo "<option value='" . $item->id . "' selected> " . $item->nama . "</option>";
                } else {
                    echo "<option value='" . $item->id . "'> " . $item->nama . "</option>";
                }
            }
        } catch (QueryException $e) {
            //throw $th;
        }
    }
    public function sk_penghargaan(Request $request)
    {
        try {
            $penghargaan = PegawaiRiwayatPenghargaan::where('id', $request->id)->first();
            if ($penghargaan != null) {
                $penghargaan->media_sk_penghargaan = $penghargaan->getMedia("media_sk_penghargaan")[0]->getUrl();
                return response()->json(['result' => $penghargaan->media_sk_penghargaan]);
            } else {
                return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
            }
        } catch (\Throwable $th) {
            return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
        }
    }
}
