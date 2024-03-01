<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\HirarkiUnitKerja;
use App\Models\JabatanFungsional;
use App\Models\JabatanFungsionalUmum;
use App\Models\JabatanStruktural;
use App\Models\Pegawai;
use App\Models\PegawaiAnak;
use App\Models\PegawaiBpjsLainnya;
use App\Models\PegawaiCuti;
use App\Models\PegawaiRiwayatJabatan;
use App\Models\PegawaiRiwayatThp;
use App\Models\PegawaiRiwayatUmak;
use App\Models\PegawaiSuamiIstri;
use App\Models\PegawaiTmtGaji;
use App\Models\PrePotonganTukin;
use App\Models\Presensi;
use App\Models\PreTubel;
use App\Models\TunjanganBeras;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PegawaiRiwayatThpController extends Controller
{

    public function index()
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        $title = 'Pegawai';
        $unit_kerja = UnitKerja::select('id', 'nama')->limit(22)->get();
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
        $cek_pegawai = Pegawai::where('id', $id)->first();
        $this->authorize('personal', $cek_pegawai);

        $pegawai = Pegawai::where('id', $id)->first();
        $title = 'Detail THP Pegawai';
        return view('penghasilan.show', compact('title', 'pegawai'));
    }
    public function datatable_show(Request $request)
    {
        $pegawai = PegawaiRiwayatThp::select(
            'pegawai_riwayat_thp.*',
            'pegawai_riwayat_thp.id AS id_thp',
            'pegawai_riwayat_umak.id AS id_umak',
            DB::raw('SUM(pegawai_riwayat_umak.total) as total')
        )
            ->leftJoin('pegawai_riwayat_umak', function ($join) {
                // $join->on(DB::raw('pegawai_riwayat_umak.bulan COLLATE utf8mb4_unicode_ci'), '=', DB::raw('pegawai_riwayat_thp.bulan COLLATE utf8mb4_unicode_ci'))
                //     ->where(DB::raw('pegawai_riwayat_umak.tahun COLLATE utf8mb4_unicode_ci'), '=', DB::raw('pegawai_riwayat_thp.tahun COLLATE utf8mb4_unicode_ci'))
                //     ->where(DB::raw('pegawai_riwayat_umak.pegawai_id COLLATE utf8mb4_unicode_ci'), '=', DB::raw('pegawai_riwayat_thp.pegawai_id COLLATE utf8mb4_unicode_ci'));
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
        $pegawai = PegawaiRiwayatThp::where('id', $id)->select('pegawai_id')->first();
        $cek_pegawai = Pegawai::where('id', $pegawai->pegawai_id)->first();
        $this->authorize('personal', $cek_pegawai);
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
                'pegawai.id AS pegawai_id',
                'pegawai.nama_depan',
                'pegawai.nama_belakang',
                'pegawai.nip',
                'pegawai.email_kantor'
            )->join('pegawai', 'pegawai.id', 'pegawai_riwayat_thp.pegawai_id')
            ->first();
        $monthName = date("F", strtotime("$gaji->tahun-$gaji->bulan-01"));
        $gaji->periode = Carbon::parse($monthName)->translatedFormat('F') . ' - ' . $gaji->tahun;
        $gaji->total_tunjangan = $gaji->nominal_gaji_pokok + $gaji->tunjangan_beras + $gaji->tunjangan_jabatan + $gaji->tunjangan_pasangan + $gaji->tunjangan_anak + $gaji->tunjangan_pajak;
        $gaji->total_potongan = $gaji->potongan_simpanan_wajib + $gaji->potongan_iwp + $gaji->potongan_bpjs + $gaji->potongan_bpjs_lainnya + $gaji->potongan_pajak + $gaji->potongan_tapera;
        $gaji->total_pendapatan = $gaji->total_tunjangan - $gaji->total_potongan;
        return view('penghasilan.gaji-detail', compact('title', 'gaji'));
    }
    public function tukin_detail($id)
    {
        $pegawai = PegawaiRiwayatThp::where('id', $id)->select('pegawai_id')->first();
        $cek_pegawai = Pegawai::where('id', $pegawai->pegawai_id)->first();
        $this->authorize('personal', $cek_pegawai);

        $title = "Tukin Detail";
        $tukin = PegawaiRiwayatThp::where('pegawai_riwayat_thp.id', $id)->select('tunjangan_kinerja', 'potongan_tukin', 'bulan', 'tahun', 'p.nama_depan', 'p.nama_belakang', 'p.nip', 'p.email_kantor')
            ->join('pegawai AS p', 'p.id', '=', 'pegawai_riwayat_thp.pegawai_id')
            ->first();
        $monthName = date("F", strtotime("$tukin->tahun-$tukin->bulan-01"));
        $tukin->periode = Carbon::parse($monthName)->translatedFormat('F') . ' - ' . $tukin->tahun;
        //TODO: ambil semua data presensi lalu tampilkan pada detail
        //? jika data nominal perhitungan 0 bagaimana? tampilkan atau tidak?
        //?

        return view('penghasilan.tukin-detail', compact('title', 'tukin'));
    }

    //indrawan
    public function umak_detail($id)
    {
        $pegawai = PegawaiRiwayatUmak::where('id', $id)->select('pegawai_id')->first();
        $cek_pegawai = Pegawai::where('id', $pegawai->pegawai_id)->first();
        $this->authorize('personal', $cek_pegawai);
        //where('pegawai_riwayat_umak.id', $id)
        $title = "Uang Makan Detail";

        //cek period
        $cekPeriodUmak = PegawaiRiwayatUmak::where('id', $id)->first();

        //cek double/tidak
        $rowUmak = PegawaiRiwayatUmak::where('bulan', $cekPeriodUmak->bulan)
            ->where('tahun', $cekPeriodUmak->tahun)
            ->count();

        $umak = [];
        if ($rowUmak == 1) {
            $umak = PegawaiRiwayatUmak::where('pegawai_riwayat_umak.bulan', $cekPeriodUmak->bulan)
                ->where('pegawai_riwayat_umak.tahun', $cekPeriodUmak->tahun)
                ->select(
                    'p.nama_depan',
                    'p.nama_belakang',
                    'p.nip',
                    'p.email_kantor',
                    'um.nominal',
                    DB::raw('SUM(pegawai_riwayat_umak.jumlah_hari_masuk) as jumlah_hari_masuk'),
                    DB::raw('SUM(pegawai_riwayat_umak.total) as total')
                )
                ->leftJoin('pegawai AS p', 'p.id', '=', 'pegawai_riwayat_umak.pegawai_id')
                ->leftJoin('uang_makan AS um', 'um.id', '=', 'pegawai_riwayat_umak.uang_makan_id')
                ->first();
        }

        if ($rowUmak == 2) {
            $umak = PegawaiRiwayatUmak::where('pegawai_riwayat_umak.bulan', $cekPeriodUmak->bulan)
                ->where('pegawai_riwayat_umak.tahun', $cekPeriodUmak->tahun)
                ->select(
                    'p.nama_depan',
                    'p.nama_belakang',
                    'p.nip',
                    'p.email_kantor',
                    DB::raw('SUM(um.nominal)/2 as nominal'),
                    DB::raw('SUM(pegawai_riwayat_umak.jumlah_hari_masuk) as jumlah_hari_masuk'),
                    DB::raw('SUM(pegawai_riwayat_umak.total) as total')
                )
                ->leftJoin('pegawai AS p', 'p.id', '=', 'pegawai_riwayat_umak.pegawai_id')
                ->leftJoin('uang_makan AS um', 'um.id', '=', 'pegawai_riwayat_umak.uang_makan_id')
                ->first();
        }

        $monthName = date("F", strtotime("$cekPeriodUmak->tahun-$cekPeriodUmak->bulan-01"));
        $umak->periode = Carbon::parse($monthName)->translatedFormat('F') . ' - ' . $cekPeriodUmak->tahun;

        return view('penghasilan.umak-detail', compact('title', 'umak'));
    }
    //

    public function generate_tukin(Request $request)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $split_tanggal = explode(" - ", $request->tanggal);
        $tanggal_mulai = $split_tanggal[0];
        $tanggal_akhir = $split_tanggal[1];
        $waktu = date('Y-m-d', strtotime($tanggal_akhir . ' +1 month'));
        $cek_tukin = PegawaiRiwayatThp::where('bulan', Carbon::parse($waktu)->translatedFormat('m'))->where('tahun', Carbon::parse($waktu)->translatedFormat('Y'))->count();
        if ($cek_tukin != 0) {
            return response()->json(['errors' => ['exists' => 'Tukin pada bulan ' . Carbon::parse($waktu)->translatedFormat('F') . ' sudah ada']]);
        }
//        try {
            //validasi tanggal awal 21 dan akhir 20
            $tglAwal = date('d', strtotime($tanggal_mulai));
            $tglAkhir = date('d', strtotime($tanggal_akhir));
            if ($tglAwal != 21 || $tglAkhir != 20) {
                //keluarkan pop up warning
                return response()->json(['errors' => ['exists' => 'Tanggal awal tidak 20 atau Tanggal akhir tidak 21!']]);
            }

            //!DATA DUMMY
            $all_pegawai = Pegawai::where('pegawai.status_dinas', 1)
                ->select('pegawai.*')
                ->leftJoin('status_pegawai as sp', function ($join) {
                    $join->on('sp.id', '=', 'pegawai.status_pegawai_id')
                        ->whereIn('sp.nama', array('PNS', 'CPNS'));
                })
                ->whereNull('pegawai.tanggal_berhenti')
                ->whereNull('pegawai.tanggal_wafat')
                ->where('pegawai.id', 492)
                ->get();
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

                //* TUNJANGAN KINERJA
                $TUNJANGAN_KINERJA = $jabatan->jabatan_unit_kerja->jabatan_tukin->tukin->nominal;
                $jabatan_plt = PegawaiRiwayatJabatan::where('pegawai_id', $pegawai->id)->where('is_now', true)->where('is_plt', true)->first();
                if ($jabatan_plt != null) {
                    //!INI ADA PERUBAHAN NANTINYA LAGI MENUNGGU
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

                //untuk yang tubel
                $cekTubel = PreTubel::where(function ($query) use ($tanggal_mulai, $tanggal_akhir) {
                    $query->where('tanggal_awal', '<=', $tanggal_akhir)
                        ->where('tanggal_akhir', '>=', $tanggal_mulai);
                })
                    ->where('is_active', '=', 'Y')
                    ->where('no_enroll', '=', $pegawai->no_enroll)
                    ->first();
                if ($cekTubel != null) {
                    $PERSEN_TUBEL = 0.8;

                    $NOMINAL_GAJI_POKOK = $PERSEN_TUBEL * $NOMINAL_GAJI_POKOK;
                    $TUNJANGAN_PASANGAN = $PERSEN_TUBEL * $TUNJANGAN_PASANGAN;
                    $TUNJANGAN_ANAK = $PERSEN_TUBEL * $TUNJANGAN_ANAK;
                    $TUNJANGAN_JABATAN = $PERSEN_TUBEL * $TUNJANGAN_JABATAN;
                    $TUNJANGAN_KINERJA = $PERSEN_TUBEL * $TUNJANGAN_KINERJA;
                    $TUNJANGAN_BERAS = $PERSEN_TUBEL * $TUNJANGAN_BERAS;
                }

                $SUM_THP = $NOMINAL_GAJI_POKOK + $TUNJANGAN_PASANGAN + $TUNJANGAN_ANAK + $TUNJANGAN_JABATAN + $TUNJANGAN_KINERJA + $TUNJANGAN_BERAS + $TUNJANGAN_PAJAK;

                //* POTONGAN BPJS LAINNYA
                //? BAGAIMANA MENGELOLA BPJS LAINNYA?
                $bpjs_lainnya = PegawaiBpjsLainnya::where('pegawai_id', $pegawai->id)
                ->where('status', '=', 3)
                ->select(
                    DB::raw('SUM(pegawai_bpjs_lainnya.total_mertua) as total_mertua'),
                    DB::raw('SUM(pegawai_bpjs_lainnya.total_orang_tua) as total_orang_tua'),
                    DB::raw('SUM(pegawai_bpjs_lainnya.total_kelebihan_anak) as total_kelebihan_anak')
                )
                ->first();

                //dikomen indrawan dulu
                // $bpjs_lainnya = PegawaiBpjsLainnya::where('pegawai_id', $pegawai->id)
                //     ->where('is_active', true)
                //     ->first();
                if ($bpjs_lainnya != null) {
                    $count_bpjs_lainnya = $bpjs_lainnya->total_mertua + $bpjs_lainnya->total_orang_tua + $bpjs_lainnya->total_kelebihan_anak;
                    $POTONGAN_BPJS_LAINNYA = $count_bpjs_lainnya * 0.01 * $SUM_THP;
                } else {
                    $POTONGAN_BPJS_LAINNYA = 0;
                }

                //* POTONGAN IWP
                $POTONGAN_IWP = 0.1 * $NOMINAL_GAJI_POKOK;
                //* POTONGAN TUKIN
                //TODO: LOGIC POTONGAN TUKIN

                // $tanggal_mulai = '2023-11-21';
                // $tanggal_akhir = '2023-12-21';
                $presensi = Presensi::whereBetween('tanggal_presensi', [$tanggal_mulai, $tanggal_akhir])->where('no_enroll', $pegawai->no_enroll)->select('nominal_potongan')->where('nominal_potongan', '<>', 0)->get();
                $POTONGAN_TUKIN = $presensi->sum('nominal_potongan');
                $_POTONGAN_MAX_TUKIN = $TUNJANGAN_KINERJA * 0.25;
                if ($POTONGAN_TUKIN > $_POTONGAN_MAX_TUKIN){
                    $POTONGAN_TUKIN = $_POTONGAN_MAX_TUKIN;
                }
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
                $waktu = date('Y-m-d', strtotime($tanggal_akhir . ' +1 month'));
                $BULAN = Carbon::parse($waktu)->translatedFormat('m');
                $TAHUN = Carbon::parse($waktu)->translatedFormat('Y');

                $cekCltn = PegawaiCuti::where('pegawai_id', '=', $pegawai->id)
                    ->whereDate('tanggal_awal_cuti', '<=', $tanggal_akhir)
                    ->whereDate('tanggal_akhir_cuti', '>=', $tanggal_mulai)
                    ->where('jenis_cuti_id', '=', 6)
                    ->where('status_pengajuan_cuti_id', '=', 3)
                    ->first();

                $riwayat_thp = new PegawaiRiwayatThp();
                if ($cekCltn != null) {
                    $riwayat_thp->nominal_gaji_pokok = 0;
                    $riwayat_thp->tunjangan_pasangan = 0;
                    $riwayat_thp->tunjangan_anak = 0;
                    $riwayat_thp->tunjangan_jabatan = 0;
                    $riwayat_thp->tunjangan_kinerja = 0;
                    $riwayat_thp->tunjangan_pajak = 0;
                    $riwayat_thp->tunjangan_beras = 0;
                    $riwayat_thp->potongan_bpjs_lainnya = 0;
                    $riwayat_thp->potongan_bpjs = 0;
                    $riwayat_thp->potongan_iwp = 0;
                    $riwayat_thp->potongan_tukin = 0;
                    $riwayat_thp->potongan_pajak = 0;
                    $riwayat_thp->potongan_tapera = 0;
                    $riwayat_thp->potongan_simpanan_wajib = 0;
                    $riwayat_thp->total_thp = 0;
                } else {
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
                }

                $riwayat_thp->pegawai_id = $pegawai->id;
                $riwayat_thp->tahun = $TAHUN;
                $riwayat_thp->bulan = $BULAN;
                $riwayat_thp->save();
            }
            DB::commit();
            return response()->json(['success' => 'Sukses Generate Tukin']);
//        } catch (\Throwable $th) {
//            DB::rollBack();
//            return response()->json(['errors' => ['connection' => 'Generate Tukin Gagal Harap Ulangi']]);
//        }
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
            return $gaji->gaji->nominal_tunjangan_jabatan;
        } else if ($jabatan->jabatan_unit_kerja->jabatan_tukin->jenis_jabatan_id == 2) {
            //JFT
            if ($pegawai->status_pegawai_id == 4) {
                //CPNS JFT
                return $gaji->gaji->nominal_tunjangan_jabatan;
            } else {
                $nominal = JabatanFungsional::select('nominal_tunjangan')->where('id', $jabatan->jabatan_unit_kerja->jabatan_tukin->jabatan_id)->first();
                return $nominal->nominal_tunjangan;
            }
        } else if ($jabatan->jabatan_unit_kerja->jabatan_tukin->jenis_jabatan_id == 1) {
            //STRUKTURAL
            $nominal = JabatanStruktural::select('nominal_tunjangan')->where('id', $jabatan->jabatan_unit_kerja->jabatan_tukin->jabatan_id)->first();
            return $nominal->nominal_tunjangan;
        } else if ($jabatan->jabatan_unit_kerja->jabatan_tukin->jenis_jabatan_id == 4) {
            //JFU
            return $gaji->gaji->nominal_tunjangan_jabatan;
        }
    }
    protected function _tunjangan_beras($pasangan, $count_anak)
    {
        //$HARGA_BERAS = 72420; // HARUSNYA DIMASUKIN KE DALAM TABEL MASTER HARGA BERAS
        //
        $cekTuber = TunjanganBeras::where('is_active', '=', 'Y')
            ->first();

        $keluarga = 1;
        if ($pasangan != null) {
            $keluarga++;
        }
        if ($count_anak >= 2) {
            $keluarga += 2;
        } else if ($count_anak == 1) {
            $keluarga++;
        }
        //return $keluarga * $HARGA_BERAS;
        return $keluarga * $cekTuber->total;
    }

    public function index_esselon()
    {
        $atasan_langsung = PegawaiRiwayatJabatan::select('pegawai_id')->whereIn('tx_tipe_jabatan_id', [2, 5])->where('pegawai_id', auth()->user()->pegawai_id)->first();
        $this->authorize('atasan_langsung', $atasan_langsung);
        $title = 'Pegawai';
        $riwayat_jabatan = PegawaiRiwayatJabatan::where('pegawai_id', auth()->user()->pegawai_id)->where('is_now', 1)->get();
        if ($riwayat_jabatan[0]->tx_tipe_jabatan_id == 1) {
            $unit_kerja = HirarkiUnitKerja::select('*')->join('unit_kerja', 'unit_kerja.id', '=', 'hirarki_unit_kerja.child_unit_kerja_id')->where('parent_unit_kerja_id', 2)->get();
        } else {
            foreach ($riwayat_jabatan as $key) {
                $unit_kerja[] = [
                    'id' => $key->jabatan_unit_kerja->hirarki_unit_kerja->child->id,
                    'nama' => $key->jabatan_unit_kerja->hirarki_unit_kerja->child->nama,

                ];
            }
        }
        return view('penghasilan-esselon2.index', compact('title', 'unit_kerja'));
    }
    public function datatable_esselon(Request $request)
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
            ->addColumn('aksi', 'penghasilan-esselon2.aksi')
            ->filterColumn('nama_lengkap', function ($query, $keyword) {
                $query->whereRaw("CONCAT(nama_depan,' ',nama_belakang) like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function  show_esselon($id)
    {
        $atasan_langsung = PegawaiRiwayatJabatan::select('pegawai_id')->whereIn('tx_tipe_jabatan_id', [2, 5])->where('pegawai_id', auth()->user()->pegawai_id)->first();
        $this->authorize('atasan_langsung', $atasan_langsung);

        $pegawai = Pegawai::where('id', $id)->first();
        $title = 'Detail THP Pegawai';
        return view('penghasilan-esselon2.show', compact('title', 'pegawai'));
    }
    public function datatable_show_esselon(Request $request)
    {
        $pegawai = PegawaiRiwayatThp::select(
            'pegawai_riwayat_thp.*',
            'pegawai_riwayat_thp.id AS id_thp',
            'pegawai_riwayat_umak.id AS id_umak',
            DB::raw('SUM(pegawai_riwayat_umak.total) as total')
        )
            ->leftJoin('pegawai_riwayat_umak', function ($join) {
                // $join->on(DB::raw('pegawai_riwayat_umak.bulan COLLATE utf8mb4_unicode_ci'), '=', DB::raw('pegawai_riwayat_thp.bulan COLLATE utf8mb4_unicode_ci'))
                //     ->where(DB::raw('pegawai_riwayat_umak.tahun COLLATE utf8mb4_unicode_ci'), '=', DB::raw('pegawai_riwayat_thp.tahun COLLATE utf8mb4_unicode_ci'))
                //     ->where(DB::raw('pegawai_riwayat_umak.pegawai_id COLLATE utf8mb4_unicode_ci'), '=', DB::raw('pegawai_riwayat_thp.pegawai_id COLLATE utf8mb4_unicode_ci'));
                $join->on('pegawai_riwayat_umak.bulan', '=', 'pegawai_riwayat_thp.bulan');
                $join->on('pegawai_riwayat_umak.tahun', '=', 'pegawai_riwayat_thp.tahun');
                $join->on('pegawai_riwayat_umak.pegawai_id', '=', 'pegawai_riwayat_thp.pegawai_id');
            })->where('pegawai_riwayat_thp.pegawai_id', $request->pegawai_id)
            ->where('pegawai_riwayat_thp.bulan', $request->bulan)
            ->where('pegawai_riwayat_thp.tahun', $request->tahun)->get();
        return DataTables::of($pegawai)
            ->addColumn('no', '')
            ->addColumn('aksi', 'penghasilan-esselon2.show_aksi')
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

    public function gaji_detail_esselon($id)
    {
        $atasan_langsung = PegawaiRiwayatJabatan::select('pegawai_id')->whereIn('tx_tipe_jabatan_id', [2, 5])->where('pegawai_id', auth()->user()->pegawai_id)->first();
        $this->authorize('atasan_langsung', $atasan_langsung);
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
        $monthName = date("F", strtotime("$gaji->tahun-$gaji->bulan-01"));
        $gaji->periode = Carbon::parse($monthName)->translatedFormat('F') . ' - ' . $gaji->tahun;
        $gaji->total_tunjangan = $gaji->nominal_gaji_pokok + $gaji->tunjangan_beras + $gaji->tunjangan_jabatan + $gaji->tunjangan_pasangan + $gaji->tunjangan_anak + $gaji->tunjangan_pajak;
        $gaji->total_potongan = $gaji->potongan_simpanan_wajib + $gaji->potongan_iwp + $gaji->potongan_bpjs + $gaji->potongan_bpjs_lainnya + $gaji->potongan_pajak + $gaji->potongan_tapera;
        $gaji->total_pendapatan = $gaji->total_tunjangan - $gaji->total_potongan;
        return view('penghasilan-esselon2.gaji-detail', compact('title', 'gaji'));
    }
    public function tukin_detail_esselon($id)
    {
        $atasan_langsung = PegawaiRiwayatJabatan::select('pegawai_id')->whereIn('tx_tipe_jabatan_id', [2, 5])->where('pegawai_id', auth()->user()->pegawai_id)->first();
        $this->authorize('atasan_langsung', $atasan_langsung);

        $title = "Tukin Detail";
        $tukin = PegawaiRiwayatThp::where('pegawai_riwayat_thp.id', $id)->select('tunjangan_kinerja', 'potongan_tukin', 'bulan', 'tahun', 'p.nama_depan', 'p.nama_belakang', 'p.nip', 'p.email_kantor')
            ->join('pegawai AS p', 'p.id', '=', 'pegawai_riwayat_thp.pegawai_id')
            ->first();
        $monthName = date("F", strtotime("$tukin->tahun-$tukin->bulan-01"));
        $tukin->periode = Carbon::parse($monthName)->translatedFormat('F') . ' - ' . $tukin->tahun;
        //TODO: ambil semua data presensi lalu tampilkan pada detail
        //? jika data nominal perhitungan 0 bagaimana? tampilkan atau tidak?
        //?

        return view('penghasilan-esselon2.tukin-detail', compact('title', 'tukin'));
    }

    //indrawan
    public function umak_detail_esselon($id)
    {
        $atasan_langsung = PegawaiRiwayatJabatan::select('pegawai_id')->whereIn('tx_tipe_jabatan_id', [2, 5])->where('pegawai_id', auth()->user()->pegawai_id)->first();
        $this->authorize('atasan_langsung', $atasan_langsung);
        //where('pegawai_riwayat_umak.id', $id)
        $title = "Uang Makan Detail";

        //cek period
        $cekPeriodUmak = PegawaiRiwayatUmak::where('id', $id)->first();

        //cek double/tidak
        $rowUmak = PegawaiRiwayatUmak::where('bulan', $cekPeriodUmak->bulan)
            ->where('tahun', $cekPeriodUmak->tahun)
            ->count();

        $umak = [];
        if ($rowUmak == 1) {
            $umak = PegawaiRiwayatUmak::where('pegawai_riwayat_umak.bulan', $cekPeriodUmak->bulan)
                ->where('pegawai_riwayat_umak.tahun', $cekPeriodUmak->tahun)
                ->select(
                    'p.nama_depan',
                    'p.nama_belakang',
                    'p.nip',
                    'p.email_kantor',
                    'um.nominal',
                    DB::raw('SUM(pegawai_riwayat_umak.jumlah_hari_masuk) as jumlah_hari_masuk'),
                    DB::raw('SUM(pegawai_riwayat_umak.total) as total')
                )
                ->leftJoin('pegawai AS p', 'p.id', '=', 'pegawai_riwayat_umak.pegawai_id')
                ->leftJoin('uang_makan AS um', 'um.id', '=', 'pegawai_riwayat_umak.uang_makan_id')
                ->first();
        }

        if ($rowUmak == 2) {
            $umak = PegawaiRiwayatUmak::where('pegawai_riwayat_umak.bulan', $cekPeriodUmak->bulan)
                ->where('pegawai_riwayat_umak.tahun', $cekPeriodUmak->tahun)
                ->select(
                    'p.nama_depan',
                    'p.nama_belakang',
                    'p.nip',
                    'p.email_kantor',
                    DB::raw('SUM(um.nominal)/2 as nominal'),
                    DB::raw('SUM(pegawai_riwayat_umak.jumlah_hari_masuk) as jumlah_hari_masuk'),
                    DB::raw('SUM(pegawai_riwayat_umak.total) as total')
                )
                ->leftJoin('pegawai AS p', 'p.id', '=', 'pegawai_riwayat_umak.pegawai_id')
                ->leftJoin('uang_makan AS um', 'um.id', '=', 'pegawai_riwayat_umak.uang_makan_id')
                ->first();
        }

        $monthName = date("F", strtotime("$cekPeriodUmak->tahun-$cekPeriodUmak->bulan-01"));
        $umak->periode = Carbon::parse($monthName)->translatedFormat('F') . ' - ' . $cekPeriodUmak->tahun;

        return view('penghasilan-esselon2.umak-detail', compact('title', 'umak'));
    }
    //
}
