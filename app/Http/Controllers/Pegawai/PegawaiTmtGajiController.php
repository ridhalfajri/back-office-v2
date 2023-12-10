<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\PegawaiTmtGaji;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PegawaiTmtGajiController extends Controller
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
                'pegawai_id' => ['required', 'exists:pegawai,id'],
                'gaji_id' => ['required', 'exists:gaji,id'],
                'tmt_gaji' => ['required'],
                'is_active' => ['required'],
                'media_tmt_gaji' => ['nullable'],
            ],
            [
                'pegawai_id' => 'pegawai harus diisi',
                'gaji_id' => 'gaji harus diisi',
                'tmt_gaji' => 'tmt gaji harus diisi',
                'is_active' => 'status harus diisi',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            $tmt_aktif = null;
            if ($request->is_active == 1) {
                //Cari TMT Gaji yang aktif
                $tmt_aktif = PegawaiTmtGaji::where('pegawai_id', $request->pegawai_id)->where('is_active', true)->first();

                if ($tmt_aktif != null) {
                    $tmt_aktif->is_active = false;
                }
            }
            if ($request->tmt_gaji_id != null) {
                $tmt_gaji = PegawaiTmtGaji::where('id', $request->tmt_gaji_id)->first();
            } else {
                $tmt_gaji = new PegawaiTmtGaji();
            }
            $tmt_gaji->pegawai_id = $request->pegawai_id;
            $tmt_gaji->gaji_id = $request->gaji_id;
            $tmt_gaji->is_active = $request->is_active;

            $tmt_gaji->tmt_gaji = date("Y-m-d", strtotime($request->tmt_gaji));
            try {
                DB::transaction(function () use ($tmt_aktif, $tmt_gaji, $request) {
                    if ($tmt_aktif != null) {
                        $tmt_aktif->save();
                    }
                    $tmt_gaji->save();
                    if ($request->file('media_tmt_gaji')) {
                        $tmt_gaji->clearMediaCollection('media_tmt_gaji');
                        $tmt_gaji->addMediaFromRequest('media_tmt_gaji')->toMediaCollection('media_tmt_gaji');
                    }
                });
                return response()->json(['success' => 'Tmt Gaji Berhasil Disimpan']);
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
        //
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
        $pegawai_tmt_gaji = PegawaiTmtGaji::where('id', $id)->first();

        if ($pegawai_tmt_gaji == null) {
            return response()->json(['errors' => ['connection' => 'Tidak menemukan data yang dihapus']]);
        }
        try {
            if ($pegawai_tmt_gaji->hasMedia("media_tmt_gaji")) {
                $pegawai_tmt_gaji->getMedia("media_tmt_gaji")[0]->delete();
            }
            $pegawai_tmt_gaji->delete();
            return response()->json(['success' => 'Sukses Mengubah Data']);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['connection' => 'Data gagal dihapus']]);
        }
    }
    /**
     * Datatable TmtGaji
     */
    public function datatable(Request $request)
    {
        $tmt_gaji = PegawaiTmtGaji::select('pegawai_tmt_gaji.id', 'tmt_gaji', 'gaji.nominal as nominal', 'is_active')
            ->join('gaji', 'pegawai_tmt_gaji.gaji_id', '=', 'gaji.id')
            ->where('pegawai_id', $request->pegawai_id)->orderBy('pegawai_tmt_gaji.is_active', 'DESC');
        return DataTables::of($tmt_gaji)
            ->addColumn('no', '')
            ->addColumn('aksi', 'pegawai.tmt_gaji.aksi-tmt-gaji')
            ->editColumn('tmt_gaji', function ($tmt_gaji) {
                return $tmt_gaji->tmt_gaji ? with(new Carbon($tmt_gaji->tmt_gaji))->format('d/m/Y') : '';
            })
            ->filterColumn('tmt_gaji', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tmt_gaji, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->editColumn('nominal', function ($tmt_gaji) {
                return "Rp. " . number_format($tmt_gaji->nominal, 2, ',', '.');
            })
            ->filterColumn('nominal', function ($query, $keyword) {
                $query->whereRaw("CONCAT('Rp. ', FORMAT(nominal, 0))) like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function getTmtGajiById(Request $request)
    {
        try {
            $tmt_gaji = PegawaiTmtGaji::select('id', 'pegawai_id', 'tmt_gaji', 'gaji_id')->where('id', $request->id)->first();
            $tmt_gaji->media_tmt_gaji = $tmt_gaji->getMedia("media_tmt_gaji")[0]->getUrl();
            $tmt_gaji->tmt_gaji = Carbon::parse($tmt_gaji->tmt_gaji)->translatedFormat('d/m/Y');
            return response()->json(['result' => $tmt_gaji]);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
        }
    }
}
