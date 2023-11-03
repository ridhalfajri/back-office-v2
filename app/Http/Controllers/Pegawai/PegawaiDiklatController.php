<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\JenisDiklat;
use App\Models\Pegawai;
use App\Models\PegawaiRiwayatDiklat;
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
    public function create($id)
    {
        $title = 'Diklat';
        try {
            $jenis_diklat = JenisDiklat::select('id', 'nama')->get();
            $pegawai = Pegawai::select('id', 'nama_depan', 'nama_belakang')->where('id', $id)->first();
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
        //
    }
    public function datatable(Request $request)
    {
        $diklat = PegawaiRiwayatDiklat::select('pegawai_riwayat_diklat.id', 'pegawai_id', 'jenis_diklat.nama as nama', 'jenis_diklat_id', 'tanggal_mulai', 'tanggal_akhir', 'penyelenggaran')
            ->join('jenis_diklat', 'pegawai_riwayat_diklat.jenis_diklat_id', '=', 'jenis_diklat.id')
            ->where('pegawai_id', $request->pegawai_id)->get();
        return DataTables::of($diklat)
            ->addColumn('no', '')
            ->addColumn('aksi', 'pegawai.aksi-diklat')
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
