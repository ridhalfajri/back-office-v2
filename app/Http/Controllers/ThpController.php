<?php

namespace App\Http\Controllers;

use App\Models\PegawaiRiwayatThp;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ThpController extends Controller
{
    public function index()
    {
        $title = 'THP';
        $unit_kerja = UnitKerja::select('id', 'nama')->get();
        return view('thp.index', compact('title', 'unit_kerja'));
    }
    public function datatable(Request $request)
    {
        $riwayat_thp = PegawaiRiwayatThp::select('pegawai_riwayat_thp.total_thp', 'pegawai_riwayat_thp.bulan', 'pegawai_riwayat_thp.tahun', 'pegawai.nama_depan', 'pegawai.nama_belakang', DB::raw('CONCAT(nama_depan," " ,nama_belakang) AS nama_lengkap'))
            ->join('pegawai', 'pegawai.id', '=', 'pegawai_riwayat_thp.pegawai_id');
        return DataTables::of($riwayat_thp)
            ->addColumn('no', '')
            ->addColumn('aksi', 'pegawai.thp.aksi')
            ->filterColumn('nama_lengkap', function ($query, $keyword) {
                $query->whereRaw("CONCAT(nama_depan,' ',nama_belakang) like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
