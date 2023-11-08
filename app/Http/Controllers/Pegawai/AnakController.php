<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\PegawaiAnak;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AnakController extends Controller
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
        //
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
    /**
     * Datatable Anak
     */
    public function datatable(Request $request)
    {
        $anak = PegawaiAnak::select('nama', 'nik', 'status_tunjangan')
            ->where('pegawai_id', $request->pegawai_id)->orderBy('created_at', 'ASC');
        return DataTables::of($anak)
            ->addColumn('no', '')
            ->addColumn('aksi', 'pegawai.keluarga.aksi-anak')
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
