<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\PegawaiRiwayatJabatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RiwayatJabatanController extends Controller
{
    public function index()
    {
        $cek_pegawai = Pegawai::where('id', auth()->user()->pegawai_id)->first();
        $this->authorize('personal', $cek_pegawai);
        $title = 'Riwayat Jabatan';
        return view('riwayat_jabatan.index', compact('title'));
    }
    public function datatable(Request $request)
    {

        $riwayat_jabatan = PegawaiRiwayatJabatan::select('pegawai_riwayat_jabatan.id', 'ttj.tipe_jabatan', 'uk.nama AS nama_unit_kerja', 'tanggal_sk', 'tanggal_pelantikan', 'tmt_jabatan', 'is_plt', 'is_now')
            ->where('pegawai_id', auth()->user()->pegawai_id)
            ->join('tx_tipe_jabatan AS ttj', 'ttj.id', '=', 'pegawai_riwayat_jabatan.tx_tipe_jabatan_id')
            ->join('jabatan_unit_kerja AS juk', 'juk.id', '=', 'pegawai_riwayat_jabatan.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja AS huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->join('unit_kerja AS uk', 'uk.id', '=', 'huk.child_unit_kerja_id');

        return DataTables::of($riwayat_jabatan)
            ->addColumn('no', '')
            ->addColumn('aksi', 'riwayat_jabatan.aksi')
            ->editColumn('tanggal_sk', function ($riwayat_jabatan) {
                return $riwayat_jabatan->tanggal_sk ? with(new Carbon($riwayat_jabatan->tanggal_sk))->format('d/m/Y') : '';
            })
            ->filterColumn('tanggal_sk', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_sk, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->editColumn('tanggal_pelantikan', function ($riwayat_jabatan) {
                return $riwayat_jabatan->tanggal_pelantikan ? with(new Carbon($riwayat_jabatan->tanggal_pelantikan))->format('d/m/Y') : '';
            })
            ->filterColumn('tanggal_pelantikan', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_pelantikan, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->editColumn('tmt_jabatan', function ($riwayat_jabatan) {
                return $riwayat_jabatan->tmt_jabatan ? with(new Carbon($riwayat_jabatan->tmt_jabatan))->format('d/m/Y') : '';
            })
            ->filterColumn('tmt_jabatan', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tmt_jabatan, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function show($id)
    {
        $jabatan = PegawaiRiwayatJabatan::where('id', $id)->first();
        if ($jabatan == null) {
            abort(404);
        }
        $this->authorize('personal', $jabatan->pegawai);

        $title = 'Detail Jabatan';
        return view('riwayat_jabatan.show', compact('title', 'jabatan'));
    }
}
