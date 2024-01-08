<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Date;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\JabatanTukin;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;
use App\Models\JabatanUnitKerja;
use App\Models\VhirarkiUnitKerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Query\Expression;
use App\Helpers\PresensiHelper;
use App\Models\Pegawai;
use App\Models\PreIjin;
use App\Models\PreJamKerja;
use App\Models\Presensi;
use App\Models\PreTakTercatat;
use Illuminate\Support\Carbon;

class PegawaiHelper {

    public static function getPegawaiData($pegawaiId)
    {
        return DB::table('pegawai as p')
                    ->select('p.id', 'p.nip', 'p.nama_depan', 'p.nama_belakang', 'p.tempat_lahir', 'p.tanggal_lahir', 'p.email_kantor','p.no_enroll',
                            'x.id as jabatan_id', 'x.jabatan_tukin_id', 'q.jabatan_unit_kerja_id', 's.nama as nama_golongan',
                            's.nama_pangkat', 'z.jenis_jabatan', 'z.nama_jabatan', 'z.grade', 'z.nominal', 'y.nama_unit_kerja',
                            'x.hirarki_unit_kerja_id', 'y.nama_jenis_unit_kerja', 'y.nama_parent_unit_kerja','q.is_plt')
                    ->join('pegawai_riwayat_jabatan as q', function ($join) use ($pegawaiId) {
                        $join->on('p.id', '=', 'q.pegawai_id')
                            ->where('q.is_now', '=', 1)
                            ->where('p.id', $pegawaiId);
                    })
                    ->join('pegawai_riwayat_golongan as r', function ($join) {
                        $join->on('p.id', '=', 'r.pegawai_id')
                            ->where('r.is_active', '=', 1);
                    })
                    ->join('golongan as s', 'r.golongan_id', '=', 's.id')
                    ->join('jabatan_unit_kerja as x', 'q.jabatan_unit_kerja_id', '=', 'x.id')
                    ->join(DB::raw('(SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, b.nama as nama_unit_kerja, c.nama_jenis_unit_kerja, c.nama_parent_unit_kerja
                                    FROM hirarki_unit_kerja as a
                                    INNER JOIN unit_kerja as b ON a.child_unit_kerja_id = b.id
                                    INNER JOIN (SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, c.nama as nama_jenis_unit_kerja, b.nama as nama_parent_unit_kerja
                                                FROM hirarki_unit_kerja as a
                                                INNER JOIN unit_kerja as b ON a.parent_unit_kerja_id = b.id
                                                INNER JOIN jenis_unit_kerja as c ON c.id = b.jenis_unit_kerja_id) as c ON a.id = c.id) as y'), function ($join) {
                        $join->on('x.hirarki_unit_kerja_id', '=', 'y.id');
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
                                    LEFT JOIN jabatan_fungsional_umum as f ON f.id = a.jabatan_id) as z'), 'x.jabatan_tukin_id', '=', 'z.id')
                    ->where('p.id','=', $pegawaiId)
                    ->orderBy('q.is_plt', 'asc')
                    ->get();



    }


    public static function getPegawaiDataActiveAll()
    {
        $pegawaiId = 0;
        return DB::table('pegawai as p')
                    ->select('p.id', 'p.nip', 'p.nama_depan', 'p.nama_belakang', 'p.tempat_lahir', 'p.tanggal_lahir', 'p.email_kantor','p.no_enroll',
                            'x.id as jabatan_id', 'x.jabatan_tukin_id', 'q.jabatan_unit_kerja_id', 's.nama as nama_golongan',
                            's.nama_pangkat', 'z.jenis_jabatan', 'z.nama_jabatan', 'z.grade', 'z.nominal', 'y.nama_unit_kerja',
                            'x.hirarki_unit_kerja_id', 'y.nama_jenis_unit_kerja', 'y.nama_parent_unit_kerja','q.is_plt')
                    ->join('pegawai_riwayat_jabatan as q', function ($join) use ($pegawaiId) {
                        $join->on('p.id', '=', 'q.pegawai_id')
                            ->where('q.is_now', '=', 1)
                            ->where('p.id','>', $pegawaiId);
                    })
                    ->join('pegawai_riwayat_golongan as r', function ($join) {
                        $join->on('p.id', '=', 'r.pegawai_id')
                            ->where('r.is_active', '=', 1);
                    })
                    ->join('golongan as s', 'r.golongan_id', '=', 's.id')
                    ->join('jabatan_unit_kerja as x', 'q.jabatan_unit_kerja_id', '=', 'x.id')
                    ->join(DB::raw('(SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, b.nama as nama_unit_kerja, c.nama_jenis_unit_kerja, c.nama_parent_unit_kerja
                                    FROM hirarki_unit_kerja as a
                                    INNER JOIN unit_kerja as b ON a.child_unit_kerja_id = b.id
                                    INNER JOIN (SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, c.nama as nama_jenis_unit_kerja, b.nama as nama_parent_unit_kerja
                                                FROM hirarki_unit_kerja as a
                                                INNER JOIN unit_kerja as b ON a.parent_unit_kerja_id = b.id
                                                INNER JOIN jenis_unit_kerja as c ON c.id = b.jenis_unit_kerja_id) as c ON a.id = c.id) as y'), function ($join) {
                        $join->on('x.hirarki_unit_kerja_id', '=', 'y.id');
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
                                    LEFT JOIN jabatan_fungsional_umum as f ON f.id = a.jabatan_id) as z'), 'x.jabatan_tukin_id', '=', 'z.id')
                    ->where('p.id','>', $pegawaiId)
                    ->where(function ($query) {
                        $query->where('tanggal_berhenti', null)
                              ->orWhere('tanggal_berhenti', '');
                    })
                    ->orderBy('q.is_plt', 'asc')
                    ->get();

    }

    public static function getKuotaIjin()
    {

        $pegawai = Pegawai::find(auth()->user()->pegawai->id);
        $currYear = Carbon::now()->format('Y');
        $currMonth = Carbon::now()->format('m');
        $total = 0;

        //Status 3 => ditolak
        $preIjin = PreIjin::whereYear('tanggal', $currYear)
                    ->whereMonth('tanggal',$currMonth)
                    ->where('no_enroll','=',$pegawai->no_enroll)
                    ->where('status','<>', 3)
                    ->get();

        $takTercatat = PreTakTercatat::whereYear('tanggal_pengajuan', $currYear)
                    ->whereMonth('tanggal_pengajuan',$currMonth)
                    ->where('no_enroll','=',$pegawai->no_enroll)
                    ->where('status','<>', 3)
                    ->get();

        if ($preIjin->count() > 0) {
            $total = $preIjin->count();
        }

        if ($takTercatat->count() > 0) {
            $total = $total + $takTercatat->count();
        }

        return $total;
    }


    public static function UpdatePresensiForIjin(PreIjin $preIjin)
    {

        $presensi = Presensi::where('no_enroll','=',$preIjin->no_enroll)
            ->where('tanggal_presensi','=',$preIjin->tanggal)
            ->first();

        $jamKerja = PreJamKerja::where('is_active','=','Y')
        ->first();

        //Status Persetujuan di batalkan
        if($preIjin->status == 1)
        {
            // if ($presensi == null) {
            //     $presensi = new Presensi();
            // }
            // $presensi->no_enroll = $preIjin->no_enroll;
            // $presensi->jam_kerja_id = $jamKerja->id;
            // $presensi->tanggal_presensi = $preIjin->tanggal;
            // $presensi->is_ijin = 0;
            // $presensi->is_jk_normal = $jamKerja->is_jk_normal;
            // // ENUM('HADIR', 'ALPHA', 'DINAS LUAR', 'TUGAS BELAJAR')
            // $presensi->status_kehadiran = 'HADIR';

            // $presensi->keterangan = 'Ijin dibatalkan';

            // $presensi->save();

        }
        elseif ($preIjin->status == 2)
        {
            //Ijin di setujui

            if ($presensi == null) {
                $presensi = new Presensi();

                $presensi->no_enroll = $preIjin->no_enroll;
                $presensi->jam_kerja_id = $jamKerja->id;
                $presensi->is_ijin = $preIjin->jenis_ijin;
                $presensi->is_jk_normal = $jamKerja->is_jk_normal;
                $presensi->jam_masuk = "00:00:00";
                $presensi->jam_pulang = "00:00:00";
            }

            $presensi->tanggal_presensi = $preIjin->tanggal;
            // ENUM('HADIR', 'ALPHA', 'DINAS LUAR', 'TUGAS BELAJAR')
            $presensi->status_kehadiran = 'HADIR';

            if ($preIjin->jenis_ijin == 1){
                //Ijin Datang Terlambat
                $presensi->keterangan = 'Ijin datang terlambat';

           }elseif ($preIjin->jenis_ijin == 2){
                 //Ijin Pulang Awal
                 $presensi->keterangan = 'Ijin pulang awal';

            }elseif ($preIjin->jenis_ijin == 3){
                 //Ijin Datang terlambat dan Pulang Awal
                 $presensi->keterangan = 'Ijin datang terlambat dan pulang awal';
            }

            $presensi->save();

            if ( (!empty($presensi->jam_masuk) && $presensi->jam_masuk !="00:00:00") && (!empty($presensi->jam_pulang) && $presensi->jam_pulang !="00:00:00")) {
                $pegawai = Pegawai::where('no_enroll',$presensi->no_enroll)->first();
                PresensiHelper::fncCalculatePresensi($pegawai,$presensi);
            }

        }elseif ($preIjin->status == 3){
            //Status ditolak => tidak ada yang perlu diupdate
        }
    }

    public static function UpdatePresensiTidakTercatat(PreTakTercatat $preTakTercatat)
    {

        $Value = 0;

        $presensi = Presensi::where('no_enroll','=',$preTakTercatat->no_enroll)
        ->where('tanggal_presensi','=',$preTakTercatat->tanggal_pengajuan)
        ->first();
        if ($presensi == null) {
           $Value = 1;
        }else
        {
            $jamKerja = PreJamKerja::where('is_active','=','Y')
                    ->first();

            // 1=jam_masuk, 2=Jam_Pulang
            $presensi->no_enroll = $preTakTercatat->no_enroll;
            $presensi->jam_kerja_id = $jamKerja->id;
            $presensi->tanggal_presensi = $preTakTercatat->tanggal_pengajuan;
            if ($preTakTercatat->jenis==1){
                // 0= tidak ijin, 1=ijin datang_terlambat, 2=ijin pulang awal, 3=ijin datang terlambat dan pulang awal, 4 = tidak tercatat jam masuk, 5 = tidak tercatat jam pulang
                $presensi->is_ijin = 4;
            }else{
                // 0= tidak ijin, 1=ijin datang_terlambat, 2=ijin pulang awal, 3=ijin datang terlambat dan pulang awal, 4 = tidak tercatat jam masuk, 5 = tidak tercatat jam pulang
                $presensi->is_ijin = 5;
            }

            $dayOfWeekIndex = Carbon::parse($preTakTercatat->tanggal_pengajuan)->format('N');
            if($dayOfWeekIndex!=5){
                $presensi->jam_masuk = $jamKerja->jam_masuk;
                $presensi->jam_pulang = $jamKerja->jam_pulang;
            }else{
                $presensi->jam_masuk = $jamKerja->jam_masuk_khusus;
                $presensi->jam_pulang = $jamKerja->jam_pulang_khusus;
            }

            $presensi->kekurangan_jam = '00:00:00';

            $presensi->is_jk_normal = $jamKerja->is_jk_normal;
            // ENUM('HADIR', 'ALPHA', 'DINAS LUAR', 'TUGAS BELAJAR')
            $presensi->status_kehadiran = 'HADIR';

            $presensi->keterangan = 'Presensi tidak tercatat';
            $presensi->save();

            $pegawai = Pegawai::where('no_enroll',$presensi->no_enroll)->first();

            PresensiHelper::fncCalculatePresensi($pegawai,$presensi);

            $Value = 2;
        }

        return $Value;

    }
}

