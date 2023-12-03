<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\JabatanFungsional;
use App\Models\JabatanFungsionalUmum;
use App\Models\JabatanStruktural;
use App\Models\Pegawai;
use App\Models\PegawaiAnak;
use App\Models\PegawaiRiwayatJabatan;
use App\Models\PegawaiRiwayatThp;
use App\Models\PegawaiSuamiIstri;
use App\Models\PegawaiTmtGaji;
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
            ->where('prj.is_now', 1)
            ->groupBy('nip')
            ->orderBy('nama_lengkap', 'ASC');
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
        $pegawai = PegawaiRiwayatThp::select('pegawai_riwayat_thp.*', 'pegawai_riwayat_thp.id AS id_thp', 'pegawai_riwayat_umak.total', 'pegawai_riwayat_umak.potongan', 'pegawai_riwayat_umak.id AS id_umak')
            ->leftJoin('pegawai_riwayat_umak', function ($join) {
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
    public function generate_tukin(Request $request)
    {
        try {

            //!DATA DUMMY
            $all_pegawai = Pegawai::where('status_dinas', 1)->where('id', 492)->get();
            // $all_pegawai = Pegawai::where('status_dinas', 1)->get();
            DB::beginTransaction();
            foreach ($all_pegawai as $pegawai) {
                //*NOMINAL GAJI POKOK
                $gaji = PegawaiTmtGaji::where('pegawai_id', $pegawai->id)->where('is_active', 1)->first();
                $NOMINAL_GAJI_POKOK = $gaji->gaji->nominal;

                //* TUNJANGAN PASANGAN
                $pasangan = PegawaiSuamiIstri::where('pegawai_id', $pegawai->id)->where('status_tunjangan', true)->first();
                $TUNJANGAN_PASANGAN = $this->_tunjangan_pasangan($pegawai, $NOMINAL_GAJI_POKOK, $pasangan);

                //* TUNJANGAN ANAK
                $count_anak = PegawaiAnak::where('pegawai_id', $pegawai->id)->where('status_tunjangan', 1)->count();
                $TUNJANGAN_ANAK = $this->_tunjangan_anak($NOMINAL_GAJI_POKOK, $count_anak);

                //*TUNJANGAN JABATAN

                $jabatan = PegawaiRiwayatJabatan::where('pegawai_id', $pegawai->id)->where('is_now', true)->where('is_plt', false)->first();
                $TUNJANGAN_JABATAN = $this->_tunjangan_jabatan($pegawai, $gaji, $jabatan);

                $jabatan_plt = PegawaiRiwayatJabatan::where('pegawai_id', $pegawai->id)->where('is_now', true)->where('is_plt', true)->first();
                if ($jabatan_plt != null) {
                    $nominal = JabatanStruktural::select('nominal_tunjangan')->where('id', $jabatan_plt->jabatan_unit_kerja->jabatan_tukin->jabatan_id)->first();
                    $TUNJANGAN_JABATAN += 0.5 * $nominal;
                }

                //* TUNJANGAN KINERJA
                $TUNJANGAN_KINERJA = $jabatan->jabatan_unit_kerja->jabatan_tukin->tukin->nominal;
                if ($jabatan_plt != null) {
                    $TUNJANGAN_KINERJA += 0.2 * $jabatan_plt->jabatan_unit_kerja->jabatan_tukin->tukin->nominal;
                }
                //? TUNJANGAN PAJAK DEFAULT 0
                $TUNJANGAN_PAJAK = 0;

                //*TUNJANGAN BERAS
                $TUNJANGAN_BERAS = $this->_tunjangan_beras($pasangan, $count_anak);

                //** JIKA CPNS*/

                if ($pegawai->status_pegawai_id == 4) {
                    $PERSEN_CPNS = 0.8;

                    $NOMINAL_GAJI_POKOK = $PERSEN_CPNS * $NOMINAL_GAJI_POKOK;
                    $TUNJANGAN_PASANGAN = $PERSEN_CPNS * $TUNJANGAN_PASANGAN;
                    $TUNJANGAN_ANAK = $PERSEN_CPNS * $TUNJANGAN_ANAK;
                    $TUNJANGAN_JABATAN = $PERSEN_CPNS * $TUNJANGAN_JABATAN;
                    $TUNJANGAN_KINERJA = $PERSEN_CPNS * $TUNJANGAN_KINERJA;
                    $TUNJANGAN_BERAS = $PERSEN_CPNS * $TUNJANGAN_BERAS;
                }
                $SUM_THP = $NOMINAL_GAJI_POKOK + $TUNJANGAN_PASANGAN + $TUNJANGAN_ANAK + $TUNJANGAN_JABATAN + $TUNJANGAN_KINERJA + $TUNJANGAN_BERAS + $TUNJANGAN_PAJAK;

                //* POTONGAN BPJS LAINNYA
                //? BAGAIMANA MENGELOLA BPJS LAINNYA?
                $POTONGAN_BPJS_LAINNYA = 0;

                //* POTONGAN IWP
                $POTONGAN_IWP = 0.1 * $NOMINAL_GAJI_POKOK;
                //* POTONGAN TUKIN
                //TODO: LOGIC POTONGAN TUKIN
                $split_tanggal = explode(" - ", $request->tanggal);
                $tanggal_mulai = $split_tanggal[0];
                $tanggal_akhir = $split_tanggal[1];
                $tanggal_mulai = '2023-11-21';
                $tanggal_akhir = '2023-12-21';
                $presensi = Presensi::whereBetween('tanggal_presensi', [$tanggal_mulai, $tanggal_akhir])->where('no_enroll', $pegawai->no_enroll)->select('nominal_potongan')->where('nominal_potongan', '<>', 0)->get();
                $POTONGAN_TUKIN = $presensi->sum('nominal_potongan');

                //* POTONGAN BPJS
                $POTONGAN_BPJS = 0.01 * $SUM_THP;

                //*POTONGAN PAJAK
                //? BELUM ADA KONFIRMASI DARI SYUKRI -> DEFAULT 0
                $POTONGAN_PAJAK = 0;

                //*POTONGAN_TAPERA
                //? BELUM ADA KOPNFIRMASI -> DEFAULT 0

                $POTONGAN_TAPERA = 0;

                //*POTONGAN SIMPANAN WAJIB
                //? BELUM ADA KOPNFIRMASI -> DEFAULT 0

                $POTONGAN_SIMPANAN_WAJIB = 0;

                $SUM_POTONGAN = $POTONGAN_BPJS_LAINNYA + $POTONGAN_BPJS + $POTONGAN_IWP + $POTONGAN_PAJAK + $POTONGAN_TAPERA + $POTONGAN_TUKIN;

                $TOTAL_THP = $SUM_THP - $SUM_POTONGAN;
                $BULAN = Carbon::parse($tanggal_akhir)->translatedFormat('n');
                $TAHUN = Carbon::parse($tanggal_akhir)->translatedFormat('Y');

                $riwayat_thp = new PegawaiRiwayatThp();
                $riwayat_thp->pegawai_id = $pegawai->id;
                $riwayat_thp->nominal_gaji_pokok = $NOMINAL_GAJI_POKOK;
                $riwayat_thp->tunjangan_pasangan = $TUNJANGAN_PASANGAN;
                $riwayat_thp->tunjangan_anak = $TUNJANGAN_ANAK;
                $riwayat_thp->tunjangan_jabatan = $TUNJANGAN_JABATAN;
                $riwayat_thp->tunjangan_kinerja = $TUNJANGAN_KINERJA;
                $riwayat_thp->tunjangan_pajak = $TUNJANGAN_PAJAK;
                $riwayat_thp->tunjangan_beras = $TUNJANGAN_BERAS;
                $riwayat_thp->potongan_bpjs_lainnya = $POTONGAN_BPJS_LAINNYA;
                $riwayat_thp->potongan_bpjs = $POTONGAN_BPJS;
                $riwayat_thp->potongan_iwp = $POTONGAN_IWP;
                $riwayat_thp->potongan_tukin = $POTONGAN_TUKIN;
                $riwayat_thp->potongan_pajak = $POTONGAN_PAJAK;
                $riwayat_thp->potongan_tapera = $POTONGAN_TAPERA;
                $riwayat_thp->potongan_simpanan_wajib = $POTONGAN_SIMPANAN_WAJIB;
                $riwayat_thp->total_thp = $TOTAL_THP;
                $riwayat_thp->tahun = $TAHUN;
                $riwayat_thp->bulan = $BULAN;
                $riwayat_thp->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
        // $all_pegawai = Pegawai::where('status_dinas', 1)->get();


    }
    protected function _tunjangan_pasangan($pegawai, $nominal_gaji_pokok, $pasangan)
    {
        if ($pegawai->jenis_kawin_id == 1 || $pegawai->jenis_kawin_id == 3) {
            if ($pasangan != null) {
                return 0.1 * $nominal_gaji_pokok;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    protected function _tunjangan_anak($nominal_gaji_pokok, $count_anak)
    {
        if ($count_anak >= 2) {
            return 2 * 0.02 * $nominal_gaji_pokok;
        } else if ($count_anak == 1) {
            return 0.02 * $nominal_gaji_pokok;
        } else {
            return 0;
        }
    }
    protected function _tunjangan_jabatan($pegawai, $gaji, $jabatan)
    {
        /**
         *      [ ] jabatan JFU / CPNS -> tabel gaji
         *      [ ] jabatan JFT -> tabel jabatan_fungsional
         *      [ ] jabatan struktural -> tabel jabatan_struktural
         *      [ ] check is_plt -> jika ada
         */
        if ($pegawai->status_pegawai_id == 4) {
            //CPNS
            return 0.8 * $gaji->gaji->nominal_tunjangan_jabatan;
        } else if ($jabatan->jabatan_unit_kerja->jabatan_tukin->jenis_jabatan_id == 2) {
            //JFT
            $nominal = JabatanFungsional::select('nominal_tunjangan')->where('id', $jabatan->jabatan_unit_kerja->jabatan_tukin->jabatan_id)->first();
            return $nominal;
        } else if ($jabatan->jabatan_unit_kerja->jabatan_tukin->jenis_jabatan_id == 1) {
            //STRUKTURAL
            $nominal = JabatanStruktural::select('nominal_tunjangan')->where('id', $jabatan->jabatan_unit_kerja->jabatan_tukin->jabatan_id)->first();
            return $nominal;
        } else if ($jabatan->jabatan_unit_kerja->jabatan_tukin->jenis_jabatan_id == 4) {
            //JFU
            return $gaji->gaji->nominal_tunjangan_jabatan;
        }
    }
    protected function _tunjangan_beras($pasangan, $count_anak)
    {
        $HARGA_BERAS = 72420; // HARUSNYA DIMASUKIN KE DALAM TABEL MASTER HARGA BERAS
        $keluarga = 1;
        if ($pasangan != null) {
            $keluarga++;
        }
        if ($count_anak >= 2) {
            $keluarga += 2;
        } else if ($count_anak == 1) {
            $keluarga++;
        }
        return $keluarga * $HARGA_BERAS;
    }
}
