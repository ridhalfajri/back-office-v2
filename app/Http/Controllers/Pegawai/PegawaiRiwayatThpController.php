<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\PegawaiRiwayatThp;
use App\Models\Presensi;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PegawaiRiwayatThpController extends Controller
{
    public function index()
    {
        $title = 'Pegawai';
        $unit_kerja = UnitKerja::select('id', 'nama')->get();
        return view('penghasilan.index', compact('title', 'unit_kerja'));
    }
    public function datatable(Request $request)
    {
        $pegawai = Pegawai::select('pegawai.id', 'nama_depan', 'nama_belakang', 'nip', DB::raw('CONCAT(nama_depan," " ,nama_belakang) AS nama_lengkap'), 'uk.nama as unit_kerja', 'ttj.tipe_jabatan AS jabatan')
            ->join('pegawai_riwayat_jabatan AS prj', 'pegawai.id', '=', 'prj.pegawai_id')
            ->join('tx_tipe_jabatan AS ttj', 'prj.tx_tipe_jabatan_id', '=', 'ttj.id')
            ->join('jabatan_unit_kerja AS juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja AS huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->join('unit_kerja AS uk', 'uk.id', '=', 'huk.child_unit_kerja_id')
            ->where('prj.is_now', 1)->orderBy('nama_lengkap', 'ASC');
        if ($request->unit_kerja != null) {
            $pegawai->where('huk.child_unit_kerja_id', $request->unit_kerja);
        }
        return DataTables::of($pegawai)
            ->addColumn('no', '')
            ->addColumn('aksi', 'penghasilan.aksi')
            ->filterColumn('nama_lengkap', function ($query, $keyword) {
                $query->whereRaw("CONCAT(nama_depan,' ',nama_belakang) like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function  show($id)
    {
        $pegawai = Pegawai::where('id', $id)->first();
        $title = 'Detail THP Pegawai';
        return view('penghasilan.show', compact('title', 'pegawai'));
    }
    public function datatable_show(Request $request)
    {
        $pegawai = PegawaiRiwayatThp::select('pegawai_riwayat_thp.*', 'pegawai_riwayat_thp.id AS id_thp', 'pegawai_riwayat_umak.*', 'pegawai_riwayat_umak.id AS id_umak')
            ->join('pegawai_riwayat_umak', function ($join) {
                $join->on('pegawai_riwayat_umak.bulan', '=', 'pegawai_riwayat_thp.bulan');
                $join->on('pegawai_riwayat_umak.tahun', '=', 'pegawai_riwayat_thp.tahun');
                $join->on('pegawai_riwayat_umak.pegawai_id', '=', 'pegawai_riwayat_thp.pegawai_id');
            })->where('pegawai_riwayat_thp.pegawai_id', $request->pegawai_id)
            ->where('pegawai_riwayat_thp.bulan', $request->bulan)
            ->where('pegawai_riwayat_thp.tahun', $request->tahun)->get();
        return DataTables::of($pegawai)
            ->addColumn('no', '')
            ->addColumn('aksi', 'penghasilan.show_aksi')
            ->addColumn('periode', function ($pegawai) {
                switch ($pegawai->bulan) {
                    case '01':
                        return 'Januari - ' . $pegawai->tahun;
                        break;
                    case '02':
                        return 'Februari - ' . $pegawai->tahun;
                        break;
                    case '03':
                        return 'Maret - ' . $pegawai->tahun;
                        break;
                    case '04':
                        return 'April - ' . $pegawai->tahun;
                        break;
                    case '05':
                        return 'Mei - ' . $pegawai->tahun;
                        break;
                    case '06':
                        return 'Juni - ' . $pegawai->tahun;
                        break;
                    case '07':
                        return 'Juli - ' . $pegawai->tahun;
                        break;
                    case '08':
                        return 'Agustus - ' . $pegawai->tahun;
                        break;
                    case '09':
                        return 'September - ' . $pegawai->tahun;
                        break;
                    case '10':
                        return 'Oktober - ' . $pegawai->tahun;
                        break;
                    case '11':
                        return 'November - ' . $pegawai->tahun;
                        break;
                    case '12':
                        return 'Desember - ' . $pegawai->tahun;
                        break;
                }
            })
            ->addColumn('gaji', function ($pegawai) {
                return (
                    $pegawai->nominal_gaji_pokok +
                    $pegawai->tunjangan_beras +
                    $pegawai->tunjangan_pasangan +
                    $pegawai->tunjangan_anak +
                    $pegawai->tunjangan_jabatan +
                    $pegawai->tunjangan_pajak
                ) - (
                    $pegawai->potongan_simpanan_wajib +
                    $pegawai->potongan_iwp +
                    $pegawai->potongan_bpjs +
                    $pegawai->potongan_bpjs_lainnya +
                    $pegawai->potongan_pajak +
                    $pegawai->potongan_taper
                );
            })
            ->addColumn('tukin', function ($pegawai) {
                return $pegawai->tunjangan_kinerja - $pegawai->potongan_tukin;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function gaji_detail($id)
    {
        $title = 'Gaji';
        $gaji = PegawaiRiwayatThp::where('pegawai_riwayat_thp.id', $id)
            ->select(
                'nominal_gaji_pokok',
                'tunjangan_beras',
                'tunjangan_pasangan',
                'tunjangan_anak',
                'tunjangan_jabatan',
                'tunjangan_pajak',
                'potongan_simpanan_wajib',
                'potongan_iwp',
                'potongan_bpjs',
                'potongan_bpjs_lainnya',
                'potongan_pajak',
                'potongan_tapera',
                'bulan',
                'tahun',
                'pegawai.nama_depan',
                'pegawai.nama_belakang',
                'pegawai.nip',
                'pegawai.email_kantor'
            )->join('pegawai', 'pegawai.id', 'pegawai_riwayat_thp.pegawai_id')
            ->first();
        switch ($gaji->bulan) {
            case '01':
                $gaji->periode =  'Januari - ' . $gaji->tahun;
                break;
            case '02':
                $gaji->periode =  'Februari - ' . $gaji->tahun;
                break;
            case '03':
                $gaji->periode =  'Maret - ' . $gaji->tahun;
                break;
            case '04':
                $gaji->periode =  'April - ' . $gaji->tahun;
                break;
            case '05':
                $gaji->periode =  'Mei - ' . $gaji->tahun;
                break;
            case '06':
                $gaji->periode =  'Juni - ' . $gaji->tahun;
                break;
            case '07':
                $gaji->periode =  'Juli - ' . $gaji->tahun;
                break;
            case '08':
                $gaji->periode =  'Agustus - ' . $gaji->tahun;
                break;
            case '09':
                $gaji->periode =  'September - ' . $gaji->tahun;
                break;
            case '10':
                $gaji->periode =  'Oktober - ' . $gaji->tahun;
                break;
            case '11':
                $gaji->periode =  'November - ' . $gaji->tahun;
                break;
            case '12':
                $gaji->periode =  'Desember - ' . $gaji->tahun;
                break;
        }
        $gaji->total_tunjangan = $gaji->nominal_gaji_pokok + $gaji->tunjangan_beras + $gaji->tunjangan_jabatan + $gaji->tunjangan_pasangan + $gaji->tunjangan_anak + $gaji->tunjangan_pajak;
        $gaji->total_potongan = $gaji->potongan_simpanan_wajib + $gaji->potongan_iwp + $gaji->potongan_bpjs + $gaji->potongan_bpjs_lainnya + $gaji->potongan_pajak + $gaji->potongan_tapera;
        $gaji->total_pendapatan = $gaji->total_tunjangan - $gaji->total_potongan;
        return view('penghasilan.gaji-detail', compact('title', 'gaji'));
    }
    public function tukin_detail($id)
    {
        $title = "Tukin Detail";
        $tukin = PegawaiRiwayatThp::where('pegawai_riwayat_thp.id', $id)->select('tunjangan_kinerja', 'potongan_tukin', 'bulan', 'tahun', 'p.no_enroll')
            ->join('pegawai AS p', 'p.id', '=', 'pegawai_riwayat_thp.pegawai_id')
            ->first();
        switch ($tukin->bulan) {
            case '01':
                $bln_mulai = '12';
                break;
            case '02':
                $bln_mulai = '01';
                break;
            case '03':
                $bln_mulai = '02';
                break;
            case '04':
                $bln_mulai = '03';
                break;
            case '05':
                $bln_mulai = '04';
                break;
            case '06':
                $bln_mulai = '05';
                break;
            case '07':
                $bln_mulai = '06';
                break;
            case '08':
                $bln_mulai = '07';
                break;
            case '09':
                $bln_mulai = '08';
                break;
            case '10':
                $bln_mulai = '09';
                break;
            case '11':
                $bln_mulai = '10';
                break;
            case '12':
                $bln_mulai = '11';
                break;
        }
        $tgl_mulai = $tukin->tahun . '-' . $bln_mulai . '-21';
        $tgl_akhir = $tukin->tahun . '-' . $tukin->bulan . '-20';
        $presensi = Presensi::whereBetween('tanggal_presensi', [$tgl_mulai, $tgl_akhir])->where('no_enroll', $tukin->no_enroll)->select('tanggal_presensi', 'nominal_potongan')->where('nominal_potongan', '<>', 0)->get();
        //TODO: ambil semua data presensi lalu tampilkan pada detail
        //? jika data nominal perhitungan 0 bagaimana? tampilkan atau tidak?
        //?

        return view('penghasilan.tukin-detail', compact('title'));
    }
}
