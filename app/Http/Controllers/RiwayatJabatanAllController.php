<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RiwayatJabatanAllController extends Controller
{
    public function index()
    {
        $title = 'Riwayat Jabatan';

        return view('riwayat_jabatan.index', compact('title'));
    }

    public function datatable(Request $request)
    {
        $riwayat_jabatan_all = DB::table('pegawai AS p')
            ->select(
                'p.id',
                'p.nama_depan',
                'p.nama_belakang',
                'q.is_plt',
                'z.nama_jabatan',
                DB::raw('CONCAT(nama_depan, " ", nama_belakang) AS nama_lengkap')
            )
            ->join('pegawai_riwayat_jabatan AS q', 'p.id', '=', 'q.pegawai_id')
            ->join('jabatan_unit_kerja AS r', 'q.jabatan_unit_kerja_id', '=', 'r.id')
            ->join(DB::raw('(SELECT a.id, a.jabatan_id, a.jenis_jabatan_id, b.nama as jenis_jabatan, c.grade, c.nominal,
                                CASE
                                    WHEN a.jenis_jabatan_id = 1 THEN d.nama
                                    WHEN a.jenis_jabatan_id = 2 THEN e.nama
                                    WHEN a.jenis_jabatan_id = 4 THEN f.nama
                                    ELSE NULL
                                END AS nama_jabatan
                                FROM jabatan_tukin as a
                                INNER JOIN jenis_jabatan as b ON a.jenis_jabatan_id = b.id
                                INNER JOIN tukin as c ON a.tukin_id = c.id
                                LEFT JOIN jabatan_struktural as d ON d.id = a.jabatan_id
                                LEFT JOIN jabatan_fungsional as e ON e.id = a.jabatan_id
                                LEFT JOIN jabatan_fungsional_umum as f ON f.id = a.jabatan_id) as z'), 'r.jabatan_tukin_id', '=', 'z.id')
            ->where('q.is_now', 1);

        return DataTables::of($riwayat_jabatan_all)
            ->addColumn('no', '')
            ->addColumn('aksi', 'riwayat_jabatan.aksi')
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
