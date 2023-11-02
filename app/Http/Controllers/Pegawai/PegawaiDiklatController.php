<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\JenisDiklat;
use App\Models\Pegawai;
use App\Models\PegawaiRiwayatDiklat;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

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
        dd($request);
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
