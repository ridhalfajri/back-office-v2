<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\TxTipeJabatan;
use App\Models\Tukin;
use Illuminate\Support\Facades\Auth;

class RiwayatJabatanAllController extends Controller
{
    public function index()
    {
        $check = DB::table('users AS a')
            ->join('pegawai AS b', 'a.pegawai_id', '=', 'b.id')
            ->join('pegawai_riwayat_jabatan AS c', 'c.pegawai_id', 'b.id')
            ->select('c.tx_tipe_jabatan_id')
            ->where('a.id', Auth::user()->id)
            ->first();

        $title = 'Riwayat Jabatan';

        if ($check->tx_tipe_jabatan_id == 7) {
            return view('riwayat_jabatan.index', compact('title'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function datatable(Request $request)
    {
        $riwayat_jabatan_all = DB::table('pegawai AS p')
            ->select(
                'p.id',
                'p.nama_depan',
                'p.nama_belakang',
                'z.nama_jabatan',
                'y.nama_unit_kerja',
                DB::raw('CONCAT(p.nama_depan, " ", p.nama_belakang) AS nama_lengkap'),
            )
            ->join('pegawai_riwayat_jabatan AS q', 'p.id', '=', 'q.pegawai_id')
            ->join('jabatan_unit_kerja AS r', 'q.jabatan_unit_kerja_id', '=', 'r.id')
            ->join(DB::raw('(SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, b.nama as nama_unit_kerja, c.nama_jenis_unit_kerja, c.nama_parent_unit_kerja
                                FROM hirarki_unit_kerja as a
                                INNER JOIN unit_kerja as b ON a.child_unit_kerja_id = b.id
                                INNER JOIN (SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, c.nama as nama_jenis_unit_kerja, b.nama as nama_parent_unit_kerja
                                            FROM hirarki_unit_kerja as a
                                            INNER JOIN unit_kerja as b ON a.parent_unit_kerja_id = b.id
                                            INNER JOIN jenis_unit_kerja as c ON c.id = b.jenis_unit_kerja_id) as c ON a.id = c.id) as y'), function ($join) {
                $join->on('r.hirarki_unit_kerja_id', '=', 'y.id');
            })
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

    public function create()
    {
        $title = 'Tambah Riwayat Jabatan';

        $tx_tipe_jabatan = TxTipeJabatan::all();

        $grade_tukin = Tukin::all();

        $unit_kerja = DB::table('unit_kerja as a')
            ->join('hirarki_unit_kerja as b', 'a.id', '=', 'b.child_unit_kerja_id')
            ->select('a.nama', 'b.id')
            ->get();

        return view('riwayat_jabatan.create', compact('title', 'tx_tipe_jabatan', 'grade_tukin', 'unit_kerja'));
    }
}
