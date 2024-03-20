<?php

namespace App\Helpers;

use App\Models\HariLibur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Pegawai;
use App\Models\PreIjin;
use App\Models\Presensi;
use App\Models\PreJamKerja;
use App\Models\PrePotonganTukin;
use App\Models\PegawaiRiwayatJabatan;
use App\Models\PreDinasLuar;
use App\Models\PreTubel;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Date;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;

class PresensiHelper
{

    private static function get_Ijin($no_enroll)
    {
        return PreIjin::Where('no_enroll', $no_enroll)->first();
    }

    private static function get_ConvertDateTime($totalSeconds)
    {
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;
        $convertedTime = Carbon::createFromTime($hours, $minutes, $seconds);
        $formattedTime = $convertedTime->format('H:i:s');
        return $formattedTime;
    }

    private static function get_Second_Diff($JamAwal, $JamAkhir)
    {

        $jamMasuk = Carbon::parse($JamAwal);
        $jamPulang = Carbon::parse($JamAkhir);
        $totalSeconds = $jamPulang->diffInSeconds($jamMasuk);

        return $totalSeconds;
    }

    private static function get_Tubel($no_enroll, $datePresensi)
    {
        $dataTubel = PreTubel::Where('no_enroll', $no_enroll)->first();
        if ($dataTubel) {
            $checkDate = Carbon::parse($datePresensi);
            $startDate = Carbon::parse($dataTubel->tanggal_awal);
            $endDate = Carbon::parse($dataTubel->tanggal_akhir);
            if ($checkDate->between($startDate, $endDate)) {
                return $dataTubel;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    //=======================================
    public static function get_DataPresensiHadirRoutine($dateAwal, $dateAkhir)
    {

        set_time_limit(3600);

        //Jalankan Function ini pada cronjob setiap sehari sekali

        // Get tanggal,jam_masuk,jam_pulang yang diperbolehkan Presensi Online
        $pegawaiOnline = Pegawai::where('is_online', 'Y')->get();


        $jamKerja = PreJamKerja::Where('is_active', 'Y')->first();

        foreach ($pegawaiOnline as  $pegawai) {

            $inOut = DB::connection('hadir')->table('v_presensi')
            ->select('nip', 'nama', 'email', 'tanggal', 'jam_masuk', 'jam_pulang')
            ->where('tanggal', '>=', $dateAwal)
            ->where('tanggal', '<=', $dateAkhir)
            ->where('nip', $pegawaiOnline->nip)
            ->orderBy('tanggal')
            ->orderBy('jam_masuk')
            ->get();

            foreach ($inOut as $row) {

                $dateTime = $row->tanggal;
                $tglPresensi = Carbon::parse($dateTime)->format('Y-m-d');
                //App Hadir Jam Maasuk dan Jam Pulang ada di 1 row
                for ($i = 0; $i <= 1; $i++) {
                    if ($i == 0) {
                        $jamPresensi = $row->jam_masuk;
                    } else {
                        $jamPresensi = $row->jam_pulang;
                    }

                    if (!empty($jamPresensi)) {
                        $typePresensi = strtotime('12:00:01') > strtotime($jamPresensi);
                        $dayOfWeekIndex = Carbon::parse($tglPresensi)->format('N');

                        if ($pegawai) {

                            $noEnroll = $pegawai->no_enroll;

                            //================================================================================================
                            // Start Data Presensi
                            //================================================================================================
                            try {
                                $presensi = Presensi::whereDate('tanggal_presensi',  $tglPresensi)->Where('no_enroll', $noEnroll)->first();
                                $blnSavePresensi = false;
                                $blnUpdatePresensi = false;

                                if ($presensi) {

                                    if ($typePresensi) {
                                        //=========================
                                        // Jam Masuk
                                        //==========================
                                        if (!empty($presensi->jam_masuk) && $presensi->jam_masuk != "00:00:00") {

                                            // Syarat jam masuk Presensi harus lebih besar dari jam masuk di db
                                            if (strtotime($jamPresensi) > strtotime($presensi->jam_masuk)) {
                                                //====================================================================================================
                                                //Jika Pegawai Izin pulang Awal atau Izin datang terlambat dan Pulang awal atau Pegawai masuk hari sabtu-minggu (Lembur), jika tidak izin maka presensi akan di skip
                                                if ($presensi->is_ijin == 2 || $presensi->is_ijin == 3 || $dayOfWeekIndex > 5) {
                                                    //Ubah menjadi jam Pulang karena jam masuk sudah tersimpan sebelumnya
                                                    //Hal ini dilakukan karena Pegawai bisa melakukan izin pulang awal sebelum jam 12:00:00
                                                    // jika pegawai tidak izin maka tidak perlu ada update jam pulang untuk menghindari jam pulang terisi jika pegawai melakukan presensi 2 kali dibawah jam 12.00.00 dan tidak izin pulang awal jamk masuk yang disimpan adalah jam presensi yang pertama
                                                    $typePresensi = false;
                                                    $blnUpdatePresensi = true;
                                                }
                                                //======================================================================================================
                                            }
                                        } else {
                                            //Jika jam masuk kosong dan ada ijin datang terlambat maka ubah typresensi menjadi jam masuk
                                            if ((empty($presensi->jam_masuk) || $presensi->jam_masuk == "00:00:00") && ($presensi->is_ijin == 1 || $presensi->is_ijin == 3)) {
                                                $typePresensi = true;
                                                $blnUpdatePresensi = true;
                                            }else if (empty($presensi->jam_masuk) || $presensi->jam_masuk == "00:00:00") {
                                                $blnUpdatePresensi = true;
                                            }
                                        }
                                    } else {
                                        //=========================
                                        //Jam Pulang
                                        //=========================

                                        //Jika jam masuk kosong dan ada ijin datang terlambat maka ubah typresensi menjadi jam masuk
                                        if ((empty($presensi->jam_masuk) || $presensi->jam_masuk == "00:00:00") && ($presensi->is_ijin == 1 || $presensi->is_ijin == 3)) {
                                            $typePresensi = true;
                                            $blnUpdatePresensi = true;
                                        } else {
                                            //Jam Pulang
                                            if (empty($presensi->jam_pulang) || $presensi->jam_pulang == "00:00:00") {
                                                // Jika Jam Pulang null maka update presensi
                                                $blnUpdatePresensi = true;
                                            } else {
                                                $jamPulandDB = strtotime($presensi->jam_pulang);
                                                $jamPulangPresensi = strtotime($jamPresensi);

                                                if ($jamPulangPresensi > $jamPulandDB) {
                                                    //Jika Jam Pulang di presensi lebih akhir dari pada jam pulang di db maka update jam pulang
                                                    $blnUpdatePresensi = true;
                                                }
                                            }
                                        }
                                    }
                                } else {
                                    $blnSavePresensi = true;
                                    //Jika data DB presensi tidak ada maka check apakah tanggal presensi yang baru hari sabtu/minggu
                                    if ($dayOfWeekIndex > 5) {
                                        //Ubah tipe presensi menjadi jam masuk jika hari sabtu/minggu karena jam lembur tidak berdasarkan pada jam kerja normal
                                        $typePresensi = true;
                                    }
                                }

                                if ($blnUpdatePresensi) {
                                    try {

                                        $presensi->jam_kerja_id = $jamKerja->id;
                                        if ($typePresensi) {
                                            // Jam Masuk
                                            $presensi->jam_masuk = $jamPresensi;
                                        } else {
                                            //Jam Pulang
                                            $presensi->jam_pulang = $jamPresensi;
                                        }

                                        $presensi->is_jk_normal = $jamKerja->is_jk_normal;

                                        //=======================================
                                        //'DINAS LUAR', 'TUGAS BELAJAR'
                                        if ($presensi->status_kehadiran != 'DINAS LUAR' && $presensi->status_kehadiran != 'TUGAS BELAJAR') {
                                            if ($dayOfWeekIndex > 5) {
                                                $presensi->status_kehadiran = 'HADIR LEMBUR';
                                            } else {
                                                $presensi->status_kehadiran = 'HADIR';
                                            }
                                        }
                                        //=======================================
                                        $presensi->save();
                                    } catch (\Exception $e) {
                                        // Handle any exceptions that may occur during the update
                                        Log::error('(1) Save Data Presensi dari db Hadir Error :' . $e->getMessage() . "\n=> Pegawai No_Enroll:" . $pegawai->no_enroll . "|Nip:" . $pegawai->nip . "|Nama:" . $pegawai->nama_depan . " " . $pegawai->nama_belakang . "\n" . " Presensi :" . "no_enroll: " . $noEnroll . ", tanggal: " . $row->tanggal . '|'. $jamPresensi . "\n=======================================");
                                    }
                                } else {
                                    if ($blnSavePresensi) {
                                        try {

                                            $presensi = new Presensi();
                                            $presensi->no_enroll = $noEnroll;
                                            $presensi->jam_kerja_id = $jamKerja->id;
                                            $presensi->tanggal_presensi = $tglPresensi;

                                            if ($typePresensi) {
                                                // Jam Masuk
                                                $presensi->jam_masuk = $jamPresensi;
                                            } else {
                                                //Jam Pulang
                                                $presensi->jam_pulang = $jamPresensi;
                                            }

                                            //default is_ijin adalah 0
                                            $presensi->is_ijin = 0;
                                            $presensi->is_jk_normal = $jamKerja->is_jk_normal;
                                            //Default StatusKehadiran => Hadir
                                            if ($dayOfWeekIndex > 5) {
                                                $presensi->status_kehadiran = 'HADIR LEMBUR';
                                                $presensi->keterangan = '';
                                            } else {
                                                $presensi->status_kehadiran = 'HADIR';
                                            }
                                            $presensi->save();
                                        } catch (\Exception $e) {
                                            // Handle any exceptions that may occur during the update
                                            Log::error('(2) Save Data Presensi db Hadir Error :' . $e->getMessage() . "\n=> Pegawai No_Enroll:" . $pegawai->no_enroll . "|Nip:" . $pegawai->nip . "|Nama:" . $pegawai->nama_depan . " " . $pegawai->nama_belakang . "\n" . " Presensi :" .  "no_enroll: " . $noEnroll . ", tanggal: " . $tglPresensi . '_' . $jamPresensi . "\n=======================================");
                                        }
                                    }
                                }

                                if ($dayOfWeekIndex < 6) {
                                    //Kalkulasi jam keterlambatan hanya pada jam kerja normal senin-jum'at
                                    self::fncCalculatePresensi($pegawai, $presensi);
                                }
                            } catch (\Throwable $th) {
                                Log::error("error Get Data-Presensi Hadir:" . $th . "\n=======================================");
                            }
                            //================================================================================================
                            // END Data Presensi
                            //================================================================================================
                        }
                    }
                }
            }
        }
    }

    //======================================

    private static function UpdateAdms($id)
    {
        try {
            DB::connection('adms')->table('checkinout')
                ->where('id', $id)
                ->update(['Reserved' => '1']);
        } catch (\Throwable $th) {
        }
    }

    public static function SaveInfo($info)
    {

        Log::channel('presensi')
            ->info($info);
    }

    public static function get_DataPresensi()
    {

        self::SaveInfo('Mulai Get data presensi adms');

        set_time_limit(3600);

        $OK = 0;
        $NG = 0;
        $todayDate = now()->format('Y-m-d');
        $todayYear = now()->format('Y');
        $todayMonth = now()->format('m');

        $inOut = DB::connection('adms')
            ->table('checkinout')
            ->join('userinfo', 'checkinout.userid', '=', 'userinfo.userid')
            ->select('checkinout.id as id', 'checkinout.userid as userid', 'checkinout.checktime as checktime', 'checkinout.Reserved as Reserved', DB::raw('CAST(userinfo.badgenumber AS UNSIGNED) AS badgenumber'))
            // ->whereDate('checkinout.checktime', $todayDate)
            ->whereYear('checkinout.checktime', '=', $todayYear)
            ->whereMonth('checkinout.checktime', '=', $todayMonth)
            ->where('checkinout.Reserved', '0')
            ->orderBy('checkinout.checktime')
            ->limit(100)
            ->get();


        $jamKerja = PreJamKerja::Where('is_active', 'Y')->first();

        foreach ($inOut as $row) {
            // var_dump("ID: " . $row->id . ", noEnroll: " . $row->badgenumber . ", tanggal: " . $row->checktime . "\n");

            $dateTime = $row->checktime;

            $tglPresensi = Carbon::parse($dateTime)->format('Y-m-d');
            $jamPresensi = Carbon::parse($dateTime)->format('H:i:s');

            $typePresensi = strtotime('12:00:01') > strtotime($jamPresensi);

            $dayOfWeekIndex = Carbon::parse($tglPresensi)->format('N');
            $noEnroll = $row->badgenumber;

            //Ambil Data Presensi hari senin-jum'at

            $pegawai = Pegawai::Where('no_enroll', $noEnroll)->first();

            if ($pegawai) {

                //================================================================================================
                // Start Data Presensi
                //================================================================================================
                try {
                    $presensi = Presensi::whereDate('tanggal_presensi',  $tglPresensi)->Where('no_enroll', $noEnroll)->first();
                    $blnSavePresensi = false;
                    $blnUpdatePresensi = false;

                    if ($presensi) {

                        if ($typePresensi) {
                            //=========================
                            // Jam Masuk
                            //==========================
                            if (!empty($presensi->jam_masuk) && $presensi->jam_masuk != "00:00:00") {

                                // Syarat jam masuk Presensi harus lebih besar dari jam masuk di db
                                if (strtotime($jamPresensi) > strtotime($presensi->jam_masuk)) {
                                    //====================================================================================================
                                    //Jika Pegawai Izin pulang Awal atau Izin datang terlambat dan Pulang awal atau Pegawai masuk hari sabtu-minggu (Lembur), jika tidak izin maka presensi akan di skip
                                    if ($presensi->is_ijin == 2 || $presensi->is_ijin == 3 || $dayOfWeekIndex > 5) {
                                        //Ubah menjadi jam Pulang karena jam masuk sudah tersimpan sebelumnya
                                        $typePresensi = false;
                                        $blnUpdatePresensi = true;
                                    }else{
                                        //Pegawai Pulang lebih Awal
                                        $typePresensi = false;
                                        $blnUpdatePresensi = true;
                                    }
                                    //======================================================================================================
                                }
                            } else {
                                //Jika jam masuk kosong dan ada ijin datang terlambat maka ubah typresensi menjadi jam masuk
                                if ((empty($presensi->jam_masuk) || $presensi->jam_masuk == "00:00:00") && ($presensi->is_ijin == 1 || $presensi->is_ijin == 3)) {
                                    $typePresensi = true;
                                    $blnUpdatePresensi = true;
                                }else if (empty($presensi->jam_masuk) || $presensi->jam_masuk == "00:00:00") {

                                    $blnUpdatePresensi = true;
                                }
                            }
                        } else {
                            //=========================
                            //Jam Pulang
                            //=========================

                            //Jika jam masuk kosong dan ada ijin datang terlambat maka ubah typresensi menjadi jam masuk
                            if ((empty($presensi->jam_masuk) || $presensi->jam_masuk == "00:00:00") && ($presensi->is_ijin == 1 || $presensi->is_ijin == 3)) {
                                $typePresensi = true;
                                $blnUpdatePresensi = true;
                            } else {
                                //Jam Pulang
                                if (empty($presensi->jam_pulang) || $presensi->jam_pulang == "00:00:00") {
                                    // Jika Jam Pulang null maka update presensi
                                    $blnUpdatePresensi = true;
                                } else {
                                    $jamPulandDB = strtotime($presensi->jam_pulang);
                                    $jamPulangPresensi = strtotime($jamPresensi);

                                    if ($jamPulangPresensi > $jamPulandDB) {
                                        //Jika Jam Pulang di presensi lebih akhir dari pada jam pulang di db maka update jam pulang
                                        $blnUpdatePresensi = true;
                                    }
                                }
                            }
                        }
                    } else {
                        $blnSavePresensi = true;
                        //Jika data DB presensi tidak ada maka check apakah tanggal presensi yang baru apakah hari sabtu/minggu
                        if ($dayOfWeekIndex > 5) {
                            //Ubah tipe presensi menjadi jam masuk jika hari sabtu/minggu karena jam lembur tidak berdasarkan pada jam kerja normal
                            $typePresensi = true;
                        }
                    }

                    if ($blnUpdatePresensi) {
                        try {

                            $presensi->jam_kerja_id = $jamKerja->id;
                            if ($typePresensi) {
                                // Jam Masuk
                                $presensi->jam_masuk = $jamPresensi;
                            } else {
                                //Jam Pulang
                                $presensi->jam_pulang = $jamPresensi;
                            }

                            $presensi->is_jk_normal = $jamKerja->is_jk_normal;

                            //=======================================
                            //'DINAS LUAR', 'TUGAS BELAJAR'
                            if ($presensi->status_kehadiran != 'DINAS LUAR' && $presensi->status_kehadiran != 'TUGAS BELAJAR') {
                                if ($dayOfWeekIndex > 5) {
                                    $presensi->status_kehadiran = 'HADIR LEMBUR';
                                    $presensi->keterangan = '';
                                } else {
                                    $presensi->status_kehadiran = 'HADIR';
                                }
                            }
                            //=======================================
                            $presensi->save();

                          //  self::SaveInfo('Presensi di Update, No_Enroll:' . $presensi->no_enroll . '|' . $presensi->tanggal_presensi . '|' . $jamPresensi);

                            self::UpdateAdms($row->id);
                            // sleep(2);
                            $OK++;
                        } catch (\Exception $e) {
                            // Handle any exceptions that may occur during the update
                            $NG++;
                            self::SaveInfo('Error Update data presensi, No_Enroll:' . $presensi->no_enroll . '|' . $presensi->tanggal_presensi . '|' . $jamPresensi);

                            Log::error('(1) Save Data Presensi and Update ADMS Error :' . $e->getMessage() . "\n=> Pegawai No_Enroll:" . $pegawai->no_enroll . "|Nip:" . $pegawai->nip . "|Nama:" . $pegawai->nama_depan . " " . $pegawai->nama_belakang . "\n" . " Presensi :" . "ID: " . $row->id . ", no_enroll: " . $row->userid . ", tanggal: " . $row->checktime . "\n=======================================");
                        }
                    } else {
                        if ($blnSavePresensi) {
                            try {

                                $presensi = new Presensi();
                                $presensi->no_enroll = $noEnroll;
                                $presensi->jam_kerja_id = $jamKerja->id;
                                $presensi->tanggal_presensi = $tglPresensi;

                                if ($typePresensi) {
                                    // Jam Masuk
                                    $presensi->jam_masuk = $jamPresensi;
                                } else {
                                    //Jam Pulang
                                    $presensi->jam_pulang = $jamPresensi;
                                }

                                //default is_ijin adalah 0
                                $presensi->is_ijin = 0;
                                $presensi->is_jk_normal = $jamKerja->is_jk_normal;
                                //Default StatusKehadiran => Hadir
                                if ($dayOfWeekIndex > 5) {
                                    $presensi->status_kehadiran = 'HADIR LEMBUR';
                                    $presensi->keterangan = '';
                                } else {
                                    $presensi->status_kehadiran = 'HADIR';
                                }
                                $presensi->save();
                               //  self::SaveInfo('New Presensi, No_Enroll:' . $presensi->no_enroll . '|' . $presensi->nip . '|' . $presensi->nama_belakang . '|' . $presensi->tanggal_presensi . '|' . $jamPresensi);
                                self::UpdateAdms($row->id);
                                $OK++;
                            } catch (\Exception $e) {
                                $NG++;
                                self::SaveInfo('Error Save data presensi, No_Enroll:' . $presensi->no_enroll . '|' . $presensi->tanggal_presensi . '|' . $jamPresensi);

                                // Handle any exceptions that may occur during the update
                                Log::error('(2) Save Data Presensi and Update ADMS Error :' . $e . "\n=> Pegawai No_Enroll:" . $pegawai->no_enroll . "|Nip:" . $pegawai->nip . "|Nama:" . $pegawai->nama_depan . " " . $pegawai->nama_belakang . "\n" . " Presensi :" . "ID: " . $row->id . ", no_enroll: " . $noEnroll . ", tanggal: " . $tglPresensi . '_' . $jamPresensi . "\n=======================================");
                            }
                        } else {

                            self::UpdateAdms($row->id);
                            $OK++;
                        }
                    }

                    if ($dayOfWeekIndex < 6) {
                        //Kalkulasi jam keterlambatan hanya pada jam kerja normal senin-jum'at
                        self::fncCalculatePresensi($pegawai, $presensi);
                    }
                } catch (\Throwable $th) {
                    self::SaveInfo('error Get Data-Presensi Finger:' . $th);

                    Log::error("error Get Data-Presensi Finger:" . $th . "\n=======================================");
                    $NG++;
                }
                //================================================================================================
                // END Data Presensi
                //================================================================================================
            } else {
                self::SaveInfo('Data Pegawai dengan No Enroll :' . $noEnroll . ' tidak ditemukan: ');
            }
        }

        self::SaveInfo('Selesai Get data presensi adms, Status NG: ' . $NG . ' OK: ' . $OK);

        return $NG;
    }


    public static function fncCalculatePresensi($pegawai,$presensi)
    {

        try {

            $jamKerja = PreJamKerja::Where('is_active', 'Y')->first();

            if ($presensi && $jamKerja) {

                $tglPresensi = Carbon::parse($presensi->tanggal_presensi)->format('Y-m-d');

                $jamMasuk = $presensi->jam_masuk;
                $jamPulang = $presensi->jam_pulang;

                $dayOfWeekIndex = Carbon::parse($tglPresensi)->format('N');

                if ($dayOfWeekIndex == 5) {
                    //Master Jam Kerja Hari Jum'at
                    $MasterJamMasuk = Carbon::parse($jamKerja->jam_masuk_khusus)->format('H:i:s');
                    $MasterJamPulang = Carbon::parse($jamKerja->jam_pulang_khusus)->format('H:i:s');

                    $jamIstirahatStart = Carbon::parse($jamKerja->mulai_jam_istirahat_khusus)->format('H:i:s');
                    $jamIstirahatEnd = Carbon::parse($jamKerja->akhir_jam_istirahat_khusus)->format('H:i:s');
                } else {
                    //Master Jam Kerja Hari Senin-Selasa atau sabtu dan mingggu
                    $MasterJamMasuk = Carbon::parse($jamKerja->jam_masuk)->format('H:i:s');
                    $MasterJamPulang = Carbon::parse($jamKerja->jam_pulang)->format('H:i:s');

                    $jamIstirahatStart = Carbon::parse($jamKerja->mulai_jam_istirahat)->format('H:i:s');
                    $jamIstirahatEnd = Carbon::parse($jamKerja->akhir_jam_istirahat)->format('H:i:s');
                }

                $jamFloating = Carbon::parse($jamKerja->waktu_floating)->format('H');
                $MenitFloating = Carbon::parse($jamKerja->waktu_floating)->format('i');

                $totalJamKerjaSeconds = self::get_Second_Diff($MasterJamMasuk, $MasterJamPulang);
                $totalFloatingSeconds = (60 * 60 * $jamFloating) + (60 * $MenitFloating);
                $totalIstirahatSeconds = self::get_Second_Diff($jamIstirahatStart, $jamIstirahatEnd);

                $kelebihanJamKerja = 0;

                if ((empty($jamMasuk) || $jamMasuk == "00:00:00") && (empty($jamPulang) || $jamPulang == "00:00:00") && ($presensi->status_kehadiran == 'ALPHA' || $presensi->status_kehadiran == 'HADIR')) {

                    // Jika tidak melakukan presensi Masuk/Pulang serta tidak melakukan Ijin,DL ataupun cuti
                    //====================================================================================================================

                    // Jam Masuk
                    $presensi->jam_masuk = '00:00:00';

                    //Jam Pulang
                    $presensi->jam_pulang = '00:00:00';

                    //default is_ijin adalah 0
                    $presensi->is_ijin = 0;
                    $presensi->is_jk_normal = $jamKerja->is_jk_normal;
                    //Default StatusKehadiran => Hadir
                    $presensi->status_kehadiran = 'ALPHA';
                    $presensi->kekurangan_jam = self::get_ConvertDateTime($totalJamKerjaSeconds - $totalIstirahatSeconds);
                    $presensi->kelebihan_jam = "00:00:00";
                    $presensi->keterangan = '-';
                    $kekurangan_jam  = $presensi->kekurangan_jam;

                    $potong = self::_hitung_potongan($pegawai, $kekurangan_jam, $presensi->status_kehadiran);
                    $presensi->nominal_potongan =  $potong;

                    $presensi->save();
                } elseif ((!empty($jamMasuk) && $jamMasuk != "00:00:00") && (empty($jamPulang) || $jamPulang == "00:00:00") && $presensi->status_kehadiran == 'HADIR') {
                    // Presensi Masuk
                    //====================================================================================================================

                        // Jam Masuk ada dan jam pulang kosong (Normal Case 1)
                        if (strtotime($jamMasuk) > strtotime($MasterJamMasuk)) {

                            $MasterJamPulang = Carbon::createFromTimeString($MasterJamPulang);
                            $kurangSecond = self::get_Second_Diff($MasterJamMasuk, $jamMasuk);

                            if ($kurangSecond > $totalFloatingSeconds) {
                                $JamPulangMinimal = $MasterJamPulang->addSecond($totalFloatingSeconds);
                                $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                                $kurangSecond = $kurangSecond - $totalFloatingSeconds;
                                $presensi->keterangan = 'Datang terlambat, Jam Pulang : ' . $JamPulangMinimal . ', Kekurangan Jam Kerja : ' . self::get_ConvertDateTime($kurangSecond);
                                $Terlambat = self::get_ConvertDateTime($kurangSecond);

                                if ($presensi->is_ijin == 1) {
                                    $presensi->keterangan = 'Ijin datang terlambat, Jam Pulang : ' . $MasterJamPulang;
                                    $presensi->nominal_potongan = self::_hitung_potongan($pegawai,'','ITM');
                                } else if ($presensi->is_ijin == 3) {
                                    $presensi->keterangan = 'Ijin datang terlambat dan Pulang Awal';
                                    $presensi->nominal_potongan = self::_hitung_potongan($pegawai,'','ITMIPC');
                                }
                                else{
                                    $presensi->nominal_potongan = self::_hitung_potongan($pegawai,$Terlambat,'TM');
                                }

                            } elseif ($kurangSecond == $totalFloatingSeconds) {
                                $JamPulangMinimal = $MasterJamPulang->addSecond($totalFloatingSeconds);
                                $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                                $kurangSecond = 0;
                                $presensi->keterangan = 'Datang terlambat, Jam Pulang : ' . $JamPulangMinimal;
                            } else {
                                $JamPulangMinimal = $MasterJamPulang->addSecond($kurangSecond);
                                $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                                $presensi->keterangan = 'Datang terlambat, Jam Pulang : ' . $JamPulangMinimal;
                            }
                        } elseif (strtotime($jamMasuk) == strtotime($MasterJamMasuk)) {
                            $presensi->keterangan = 'Datang tepat waktu, Jam Pulang : ' . $MasterJamPulang;
                        } else {
                            $presensi->keterangan = 'Datang lebih awal, Jam Pulang : ' . $MasterJamPulang;
                            $kelebihanJamKerja  = self::get_Second_Diff($MasterJamMasuk, $jamMasuk);
                        }


                    $presensi->save();
                } elseif ((!empty($jamMasuk) && $jamMasuk != "00:00:00") && (!empty($jamPulang) && $jamPulang != "00:00:00") && $presensi->status_kehadiran == 'HADIR') {

                    // Jam Masuk dan Jam Pulang terisi (Normal Case 2)
                    //====================================================================================================================

                    //penghitungan jam kerja
                    $jamMasuk = $presensi->jam_masuk;
                    $jamPulang = $presensi->jam_pulang;
                    //===================================================
                    $kurangJamKerja = 0;
                    $kurangSecondAkhir = 0;
                    $kelebihanJamKerja = 0;

                    $JumlahJamTM = 0; // Terlambat Masuk
                    $PotonganTM = 0;
                    $JumlahJamPC = 0; // Pulang Cepat
                    $PotonganPC = 0;
                    //===================================================================================
                    //Jika Ijin datang terlambat
                    //===================================================================================
                    // if ($presensi->is_ijin == 1 || $presensi->is_ijin == 3) {
                    //     $jamMasuk = $MasterJamMasuk;
                    // }

                    //====================================================================================
                    // Kalkulasi Jam Masuk
                    //====================================================================================
                    if (strtotime($jamMasuk) > strtotime($MasterJamMasuk)) {
                        //datang terlambat
                        $kurangJamKerja = self::get_Second_Diff($MasterJamMasuk, $jamMasuk);
                    } else {
                        if (strtotime($jamPulang) > strtotime($MasterJamMasuk)) {
                            $kelebihanJamKerja  = self::get_Second_Diff($MasterJamMasuk, $jamMasuk);
                        }
                    }

                    $JamPulangMinimal =  Carbon::createFromTimeString($MasterJamPulang);

                    if ($kurangJamKerja > 0) {
                        if ($kurangJamKerja > $totalFloatingSeconds) {
                            //Kekurangan karena melebihi floating time
                            $JamPulangMinimal = $JamPulangMinimal->addSecond($totalFloatingSeconds);
                            $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');

                            //Karena Kurang Jam Kerja lebih dari floating maka dikurangi floating time
                            // sisa kekurangan jam akan diakumulasi di penghitungan jam pulang
                            $kurangJamKerja = $kurangJamKerja - $totalFloatingSeconds;
                        } elseif ($kurangJamKerja <= $totalFloatingSeconds) {
                            //Datang terlambat dibawah floating time
                            $JamPulangMinimal = $JamPulangMinimal->addSecond($kurangJamKerja);
                            $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                            //Karena Kurang Jam Kerja dibawah floating maka kurang jam = 0
                            $kurangJamKerja = 0;
                        }
                    } else {
                        //pulang sesuai jam pulang
                        $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                    }

                    if ($kurangJamKerja>0){
                        $JumlahJamTM = $kurangJamKerja;
                        if ($presensi->is_ijin == 1 || $presensi->is_ijin == 3) {
                            $PotonganTM = self::_hitung_potongan($pegawai,'','ITM'); // bisa ITM => Ijin Telat masuk / ITMIPC
                        }else{
                            $Terlambat = self::get_ConvertDateTime($JumlahJamTM);
                            $PotonganTM = self::_hitung_potongan($pegawai,$Terlambat,'TM');
                        }
                    }

                    //===================================================================================
                    //Ijin Pulang Awal
                    //===================================================================================
                    // if ($presensi->is_ijin == 2 || $presensi->is_ijin == 3) {
                    //     $jamPulang = $JamPulangMinimal;
                    // }

                    //====================================================================================
                    // Kalkulasi Jam Pulang
                    //====================================================================================
                    if (strtotime($jamPulang) < strtotime($JamPulangMinimal)) {
                        //Pulang Awal
                        //Jika Jam Pulang lebih besar jam 12 siang maka
                        $JamIstirahat = 0;
                        if (strtotime($jamPulang) <= strtotime($jamIstirahatStart))
                        {
                            $JamIstirahat = $totalIstirahatSeconds;
                        }
                        else if (strtotime($jamPulang) > strtotime($jamIstirahatStart) && strtotime($jamPulang) <= strtotime($jamIstirahatEnd)) {
                            $SelisihIstirahat = 0;
                            $SelisihIstirahat =  self::get_Second_Diff($jamPulang,$jamIstirahatStart);
                            $JamIstirahat = self::get_Second_Diff($jamIstirahatStart,$jamIstirahatEnd);
                            $JamIstirahat = $JamIstirahat - $SelisihIstirahat;
                        }

                        $JumlahJamPC = self::get_Second_Diff($JamPulangMinimal,$jamPulang);
                        $kurangJamKerja += self::get_Second_Diff($JamPulangMinimal,$jamPulang);

                        $JumlahJamPC = $JumlahJamPC - $JamIstirahat ;
                        $kurangJamKerja = $kurangJamKerja - $JamIstirahat;

                        // var_dump($jamPulang);
                        // var_dump($JamPulangMinimal);
                        // var_dump(self::get_ConvertDateTime($JamIstirahat));
                        // dd(self::get_ConvertDateTime($kurangJamKerja));

                    }
                    elseif (strtotime($jamPulang)>strtotime($JamPulangMinimal))
                    {
                        $kelebihanJamKerja  +=  self::get_Second_Diff($JamPulangMinimal,$jamPulang);
                        // Jika masih ada sisa kekurangan jam sebelumnya maka saat ini masih dipisah antara kelebihan jam dan kekurangan jam
                        //==========================================================================================
                        //Hilangkan Remark Code dibawah ini jika ingin mengakumulasi kelebihan jam kerja dan kekurangan jam kerja
                        // if ($kelebihanJamKerja>$kurangJamKerja){
                        //     $kelebihanJamKerja = $kelebihanJamKerja - $kurangJamKerja;
                        //     $kurangJamKerja = 0;
                        // }else{
                        //     $kurangJamKerja = $kurangJamKerja - $kelebihanJamKerja;
                        //     $kelebihanJamKerja = 0;
                        // }
                        //============================================================================================
                    }

                    if ($JumlahJamPC>0){
                        //====================================================================================
                        // Jika ada Ijin datang terlmabat dan pulang awal maka potongan 0.5%
                        //=====================================================================================
                        //0= tidak ijin, 1=ijin datang_terlambat, 2=ijin pulang awal, 3=ijin datang terlambat dan pulang awal, 4 = tidak tercatat jam masuk, 5 = tidak tercatat jam pulang

                        if ($presensi->is_ijin == 2 || $presensi->is_ijin == 3) {
                            $PotonganPC = self::_hitung_potongan($pegawai,'','IPC');
                        }else{
                            $PulangAwal = self::get_ConvertDateTime($JumlahJamPC);
                            $PotonganPC = self::_hitung_potongan($pegawai,$PulangAwal,'PC');
                        }
                    }
                    //====================================================================================
                    // Kalkulasi Jam Pulang dan kekurangan jam kerja
                    //====================================================================================
                    //Final
                    $keterangan = "";

                    if ($presensi->is_ijin == 1) {
                        $keterangan = 'Ijin datang terlambat';
                    } elseif ($presensi->is_ijin == 2) {
                        $keterangan = 'Ijin pulang lebih awal';
                    } elseif ($presensi->is_ijin == 3) {
                        $keterangan = 'Ijin datang terlambat dan Pulang lebih awal';
                    }

                    // //Kelebihan jam kerja dikurangi kekurangan jam kerja
                    // //====================================================
                    // if ($kelebihanJamKerja >0 ){
                    //     if ( $kelebihanJamKerja > $kurangJamKerja ){
                    //         $kelebihanJamKerja = $kelebihanJamKerja - $kurangJamKerja;
                    //         $kurangJamKerja = 0;
                    //     }else{
                    //         $kelebihanJamKerja = 0;
                    //         $kurangJamKerja = $kurangJamKerja - $kelebihanJamKerja;
                    //     }
                    // }
                    // //=====================================================

                    if ($kurangJamKerja <= 0) {
                        $presensi->kekurangan_jam = "00:00:00";
                        $presensi->nominal_potongan = 0;
                        $presensi->keterangan = $keterangan;
                    } else {
                        if ($keterangan == "") {
                            //Keterangan Akhir di isi ketika ada kekurangan jam kerja
                            $keterangan = self::GetKeteranganKehadiran($JumlahJamTM, $JumlahJamPC);
                        }

                        //Jika kekurangan jam kerja melebihi 7.5/total jam kerja maka kekurangan yang diambil adalah 7,5/mak jam kerja jam
                        if ($kurangJamKerja > $totalJamKerjaSeconds - $totalIstirahatSeconds) {
                            $kurangJamKerja = $totalJamKerjaSeconds - $totalIstirahatSeconds;
                        }

                        // var_dump(self::get_ConvertDateTime($kurangJamKerja));
                        // dd(self::get_ConvertDateTime($totalJamKerjaSeconds - $totalIstirahatSeconds));

                        $presensi->kekurangan_jam = self::get_ConvertDateTime($kurangJamKerja);
                        if ($presensi->status_kehadiran == 'HADIR' &&  $presensi->is_ijin == 0) {
                            $presensi->keterangan = $keterangan;
                        }

                        $presensi->nominal_potongan = $PotonganTM + $PotonganPC;
                    }

                    if ($kelebihanJamKerja <= 0) {
                        $presensi->kelebihan_jam = "00:00:00";
                    } else {
                        if ($presensi->is_ijin != 0) {
                            $presensi->kelebihan_jam = "00:00:00";
                        } else {
                            $presensi->kelebihan_jam = self::get_ConvertDateTime($kelebihanJamKerja);
                        }
                    }
                    $presensi->save();
                } elseif ((empty($jamMasuk) || $jamMasuk == "00:00:00") && (!empty($jamPulang) && $jamPulang != "00:00:00") && $presensi->status_kehadiran == 'HADIR') {
                    //Jika Pegawai hanya melakukan presensi cuma pulang saja maka keterlambatan di set sebagai keterlmbatan maksimal yaitu 7,5 jam
                    //==============================================================================================================================

                    $presensi->kekurangan_jam = self::get_ConvertDateTime($totalJamKerjaSeconds-$totalIstirahatSeconds);
                    $presensi->kelebihan_jam = "00:00:00";
                    $presensi->nominal_potongan = self::_hitung_potongan($pegawai, $presensi->kekurangan_jam, 'PC'); // Pulan Cepat atai TM lebih dari 7,5 Jam Potongannya sama
                    $presensi->keterangan = 'Tidak melakukan presensi Jam Masuk';
                    $presensi->save();
                }

                return true;
            }
        } catch (\Throwable $th) {

            Log::error("error Kalkulasi-Data-Presensi :" . $th . "\n=======================================" . '|' . $pegawai->id . $pegawai->nip);
            return false;
        }
    }

    private static function GetKeteranganKehadiran($JamTM, $JamPC)
    {

        $retValue = "";
        $retAwal = "";
        $retAkhir = "";

        if ($JamTM>0){
            $retAwal = 'Datang terlambat  ';
        }

        if ($JamPC>0){
            $retAkhir = 'Pulang lebih awal';
        }

        $retValue = $retAwal;
        if ($retAwal != "") {
            $retValue = $retAwal . ' dan ' . $retAkhir;
        } else {
            $retValue =  $retAkhir;
        }

        return $retValue;
    }

    private static function GetKeterangan($jamMasuk, $MasterJamMasuk, $jamPulang, $JamPulangMinimal)
    {

        $retValue = "";
        $retAwal = "";
        $retAkhir = "";

        if (strtotime($jamMasuk) > strtotime($MasterJamMasuk)) {
            $retAwal = 'Datang terlambat  ';
        } elseif (strtotime($jamMasuk) < strtotime($MasterJamMasuk)) {
            // $retAwal = 'Datang lebih awal';
        } elseif (strtotime($jamMasuk) == strtotime($MasterJamMasuk)) {
            // $retAwal = 'Datang tepat waktu';
        }

        if (strtotime($jamPulang) > strtotime($JamPulangMinimal)) {
            // $retAkhir = 'Pulang akhir';
        } elseif (strtotime($jamPulang) < strtotime($JamPulangMinimal)) {
            $retAkhir = 'Pulang lebih awal';
        } elseif (strtotime($jamPulang) == strtotime($JamPulangMinimal)) {
            // $retAkhir = 'Pulang tepat waktu';
        }

        $retValue = $retAwal;
        if ($retAwal != "" && $retAkhir!="") {
            $retValue = $retAwal . ' dan ' . $retAkhir;
        } else if ($retAwal == "" && $retAkhir!="") {
            $retValue =  $retAkhir;
        }

        return $retValue;
    }

    private static function GetKeteranganIjin($isIjin)
    {
        //0= tidak ijin, 1=ijin datang_terlambat, 2=ijin pulang awal, 3=ijin datang terlambat dan pulang awal, 4 = tidak tercatat jam masuk, 5 = tidak tercatat jam pulang
        $retValue = "";
        if ($isIjin == 1) {
            $retValue = 'Ijin datang terlambat';
        } elseif ($isIjin == 2) {
            $retValue = 'Ijin pulang lebih awal';
        } elseif ($isIjin == 3) {
            $retValue = 'Ijin datang terlambat dan pulang lebih awal';
        } elseif ($isIjin == 4) {
            $retValue = 'Ijin jam masuk tidak tercatat';
        } elseif ($isIjin == 5) {
            $retValue = 'Ijin jam pulang tidak tercatat';
        }

        return $retValue;
    }

    public static function CronJobRunGetPresensi()
    {
        try {
            self::get_DataPresensi();
        } catch (\Throwable $th) {
            Log::error('(1) Error cronJob fnc_CheckAbsenRoutine :' . $th . "\n=======================================");
        }

        //=============================
        // Get Presensi DB Hadir
        //=============================

        try {
            $date = now()->format('Y-m-d ');
            self::get_DataPresensiHadirRoutine($date, $date);
        } catch (\Throwable $th) {
            Log::error('(2) Error cronJob Get Data Presensi Hadir Routine :' . $th . "\n=> \n=======================================");
        }

    }

    //Jalankan setiap jam 20:00 / Jam delapan malam
    public static function CronJobRunNoAbsenOrHoliday()
    {
        try {
            self::fnc_CheckAbsenRoutine();
        } catch (\Throwable $th) {
            Log::error('(2) Error cronJob fnc_CheckAbsenRoutine :' . $th . "\n=======================================");
        }

        try {
            self::fnc_CheckDLRoutine();
        } catch (\Throwable $th) {
            Log::error('(2) Error cronJob get_Data_Dinas_Luar :' . $th . "\n=> \n=======================================");
        }
    }

    //Jalankan per jam 12 malam atau manual dan check Hari Libur serta
    public static function fnc_CheckAbsenRoutine()
    {
        //disini check pegawai aktif yang tidak melakukan Presensi kemarin jalankan function ini setiap jam tertentu

        $pegawai = PegawaiHelper::getPegawaiDataActiveAll();

        $jamKerja = PreJamKerja::Where('is_active', 'Y')->first();

        $dateNow = now();
        //Tanggal Kemarin
        $tglPresensiCheck = Carbon::parse($dateNow)->format('Y-m-d');
        $dayOfWeekIndex = Carbon::parse($tglPresensiCheck)->format('N');

        //===================================================
        //Check Apakah Tanggal Tersebut hari libur atau Bukan
        //===================================================

        $tglPresensi = $tglPresensiCheck;
        $harilibur = HariLibur::where('tanggal', '=', $tglPresensi)->where('is_libur', '=', 1)->first();

        $dayOfWeekIndex = Carbon::parse($tglPresensi)->format('N');
        if ($dayOfWeekIndex == 5) {
            //Master Jam Kerja Hari Jum'at
            $MasterJamMasuk = Carbon::parse($jamKerja->jam_masuk_khusus)->format('H:i:s');
            $MasterJamPulang = Carbon::parse($jamKerja->jam_pulang_khusus)->format('H:i:s');

            $jamIstirahatStart = Carbon::parse($jamKerja->mulai_jam_istirahat_khusus)->format('H:i:s');
            $jamIstirahatEnd = Carbon::parse($jamKerja->akhir_jam_istirahat_khusus)->format('H:i:s');
        } else {
            //Master Jam Kerja Hari Senin-Selasa atau sabtu dan mingggu
            $MasterJamMasuk = Carbon::parse($jamKerja->jam_masuk)->format('H:i:s');
            $MasterJamPulang = Carbon::parse($jamKerja->jam_pulang)->format('H:i:s');

            $jamIstirahatStart = Carbon::parse($jamKerja->mulai_jam_istirahat)->format('H:i:s');
            $jamIstirahatEnd = Carbon::parse($jamKerja->akhir_jam_istirahat)->format('H:i:s');
        }

        $totalIstirahatSeconds = self::get_Second_Diff($jamIstirahatStart, $jamIstirahatEnd);
        $totalJamKerjaSeconds = self::get_Second_Diff($MasterJamMasuk, $MasterJamPulang);

        $totalJamKerjaSeconds = $totalJamKerjaSeconds - $totalIstirahatSeconds;

        if ($harilibur) {
            //=================================================
            //Jika Hari Libur
            //=================================================

            $jamKerja = PreJamKerja::Where('is_active', 'Y')->first();
            $dayOfWeekIndex = Carbon::parse($tglPresensi)->format('N');

            foreach ($pegawai as $pegawaiItem) {
                try {
                    //get Presensi
                    $presensi = Presensi::whereDate('tanggal_presensi',  $tglPresensi)->Where('no_enroll', $pegawaiItem->no_enroll)->first();

                    if (!$presensi) {
                        // 2. masukkan ke presensi jika libur
                        $presensi = new Presensi();
                        $presensi->no_enroll = $pegawaiItem->no_enroll;
                        $presensi->jam_kerja_id = $jamKerja->id;
                        $presensi->tanggal_presensi = $tglPresensi;

                        // Jam Masuk
                        $presensi->jam_masuk = '00:00:00';
                        //Jam Pulang
                        $presensi->jam_pulang = '00:00:00';

                        //default is_ijin adalah 0
                        $presensi->is_ijin = 0;
                        $presensi->is_jk_normal = $jamKerja->is_jk_normal;

                        //Hari libur
                        $presensi->status_kehadiran = 'LIBUR';
                        $presensi->kekurangan_jam = "00:00:00";
                        $presensi->kelebihan_jam = "00:00:00";

                        $presensi->nominal_potongan = 0;
                        $presensi->keterangan = '';

                        $presensi->save();
                    }
                } catch (\Throwable $th) {
                    Log::error("error fnc_CheckAbsenRoutine 1:" . $th . "\n=======================================" . '|' . $pegawaiItem->id . $pegawaiItem->nip);
                }
            }
        } else {

            //============================================================
            //Jika Bukan Hari Libur
            //============================================================
            foreach ($pegawai as $pegawaiItem) {

                try {

                    //get Presensi
                    $presensi = Presensi::whereDate('tanggal_presensi',  $tglPresensiCheck)->Where('no_enroll', $pegawaiItem->no_enroll)->first();

                    //Check Jika Pegawai ditemukan
                    if ($presensi) {

                        if ($presensi->status_kehadiran != 'LIBUR') {
                            try {
                                if ($presensi->status_kehadiran == 'HADIR') {
                                    $jamMasuk = $presensi->jam_masuk;
                                    $jamPulang = $presensi->jam_pulang;
                                    if ((empty($jamMasuk) || $jamMasuk == "00:00:00") && (empty($jamPulang) || $jamPulang == "00:00:00")) {
                                        $presensi->kekurangan_jam = self::get_ConvertDateTime($totalJamKerjaSeconds);
                                        $presensi->status_kehadiran = 'ALPHA';
                                        $presensi->nominal_potongan = self::_hitung_potongan($pegawaiItem, $presensi->kekurangan_jam, 'ALPHA');
                                        $presensi->keterangan = 'Tidak melakukan presensi';
                                        $presensi->save();
                                    }
                                    elseif ((!empty($jamMasuk) || $jamMasuk != "00:00:00") && (empty($jamPulang) || $jamPulang == "00:00:00")) {
                                        $presensi->kekurangan_jam = self::get_ConvertDateTime($totalJamKerjaSeconds);
                                        $presensi->status_kehadiran = 'HADIR';
                                        $presensi->nominal_potongan = self::_hitung_potongan($pegawaiItem, $presensi->kekurangan_jam, 'TM');
                                        $presensi->keterangan = 'Tidak melakukan presensi jam pulang';
                                        $presensi->save();
                                    }
                                        elseif ((empty($jamMasuk) || $jamMasuk == "00:00:00") && (!empty($jamPulang) || $jamPulang != "00:00:00")) {
                                        $presensi->kekurangan_jam = self::get_ConvertDateTime($totalJamKerjaSeconds);
                                        $presensi->status_kehadiran = 'HADIR';
                                        $presensi->nominal_potongan = self::_hitung_potongan($pegawaiItem, $presensi->kekurangan_jam, 'PC');
                                        $presensi->keterangan = 'Tidak melakukan presensi jam masuk';
                                        $presensi->save();
                                    }
                                    else {
                                        //Jika jam masuk dan jam pulang tidak sama dengan kosong
                                        $result = self::fncCalculatePresensi($pegawaiItem, $presensi);
                                    }

                                }

                            } catch (\Throwable $th) {
                                Log::error("error fnc_CheckAbsenRoutine 4:" . $th. "\n=======================================" . '|' . $pegawaiItem->id .'|' . $pegawaiItem->nip);
                            }

                        }
                    } else {
                        // 2. masukkan ke presensi jika tidak melakukan presensi dengan jam masuk dan jam pulang 00:00:00 dan keterlambatan 7,30
                        $presensi = new Presensi();
                        $presensi->no_enroll = $pegawaiItem->no_enroll;
                        $presensi->jam_kerja_id = $jamKerja->id;
                        $presensi->tanggal_presensi = $tglPresensiCheck;

                        // Jam Masuk
                        $presensi->jam_masuk = '00:00:00';

                        //Jam Pulang
                        $presensi->jam_pulang = '00:00:00';

                        //default is_ijin adalah 0
                        $presensi->is_ijin = 0;
                        $presensi->is_jk_normal = $jamKerja->is_jk_normal;

                        //Default StatusKehadiran => Hadir
                        if ($dayOfWeekIndex > 5) {
                            //Hari libur
                            $presensi->status_kehadiran = 'LIBUR';
                            $presensi->kekurangan_jam = "00:00:00";
                            $presensi->kelebihan_jam = "00:00:00";
                            $presensi->nominal_potongan = 0;
                        } else {
                            //===========================
                            //Check Apakah ada Tubel
                            //===========================
                            $tubel = PreTubel::where('tanggal_awal', '>=', $tglPresensiCheck)
                                ->where('tanggal_akhir', '<=', $tglPresensiCheck)
                                ->where('no_enroll',$pegawaiItem->no_enroll)
                                ->where('is_active','Y')
                                ->first();

                            if ($tubel) {
                                $presensi->status_kehadiran = 'TUGAS BELAJAR';
                                $presensi->kekurangan_jam = "00:00:00";
                                $presensi->kelebihan_jam = "00:00:00";
                                $presensi->nominal_potongan = 0;
                            } else {
                                $presensi->status_kehadiran = 'ALPHA';
                                $presensi->kekurangan_jam = self::get_ConvertDateTime($totalJamKerjaSeconds);
                                $presensi->kelebihan_jam = "00:00:00";
                                $presensi->nominal_potongan = self::_hitung_potongan($pegawaiItem, $presensi->kekurangan_jam, $presensi->status_kehadiran);
                            }
                        }

                        $presensi->keterangan = '-';
                        $presensi->save();
                    }
                } catch (\Throwable $th) {
                    Log::error("error fnc_CheckAbsenRoutine 5:" . $th . '|' . $pegawaiItem->id . $pegawaiItem->nip);
                }
            }
        }
    }


    public static function fnc_CheckDLRoutine()
    {

        $dateNow = now(); // Assuming dateNow is the current date
        //Tanggal
        $tglPresensi = Carbon::parse($dateNow)->format('Y-m-d');

        $DinasLuar = PreDinasLuar::where('tanggal_dinas_awal', '>=', $tglPresensi)->where('tanggal_dinas_akhir', '<=', $tglPresensi)->where('jenis_dinas', '=', 'DINAS LUAR KOTA')->where('status_approve','=',2)->get();

        $jamKerja = PreJamKerja::Where('is_active', 'Y')->first();


        $dayOfWeekIndex = Carbon::parse($tglPresensi)->format('N');

        foreach ($DinasLuar as $dinasLuar) {

            $pegawaiItem = Pegawai::where('no_enroll', $dinasLuar->no_enroll)->first();

            if ($pegawaiItem) {
                try {
                    //get Presensi
                    $presensi = Presensi::whereDate('tanggal_presensi',  $tglPresensi)->Where('no_enroll', $pegawaiItem->no_enroll)->first();

                    if (!$presensi) {
                        // 2. masukkan ke presensi jika DL
                        $presensi = new Presensi();
                        $presensi->no_enroll = $pegawaiItem->no_enroll;
                        $presensi->jam_kerja_id = $jamKerja->id;
                        $presensi->tanggal_presensi = $tglPresensi;

                        // Jam Masuk
                        $presensi->jam_masuk = '00:00:00';
                        //Jam Pulang
                        $presensi->jam_pulang = '00:00:00';

                        //default is_ijin adalah 0
                        $presensi->is_ijin = 0;
                        $presensi->is_jk_normal = $jamKerja->is_jk_normal;


                        $presensi->status_kehadiran = 'DINAS LUAR';
                        $presensi->kekurangan_jam = "00:00:00";
                        $presensi->kelebihan_jam = "00:00:00";

                        $presensi->nominal_potongan = 0;
                        $presensi->keterangan = '';

                        $presensi->save();
                    } else {
                        //Jika Dinas Luar Kota tidak boleh melakukan presensi
                        if ($dinasLuar->jenis_dinas == 'DINAS LUAR KOTA') {
                            // Jam Masuk
                            $presensi->jam_masuk = '00:00:00';
                            //Jam Pulang
                            $presensi->jam_pulang = '00:00:00';

                            //default is_ijin adalah 0
                            $presensi->is_ijin = 0;
                            $presensi->is_jk_normal = $jamKerja->is_jk_normal;


                            $presensi->status_kehadiran = 'DINAS LUAR';
                            $presensi->kekurangan_jam = "00:00:00";
                            $presensi->kelebihan_jam = "00:00:00";

                            $presensi->nominal_potongan = 0;
                            $presensi->keterangan = '';

                            $presensi->save();
                        }
                    }
                } catch (\Throwable $th) {
                }
            }
        }
    }

    //* KALKULASI POTONGAN TUNJANGAN KINERJA
    public static function _hitung_potongan($pegawai, $jam, $status_kehadiran)
    {
        // \\Note :
        // Jika Jabatan_unit_kerja dan Jabatan Tukin tidak ditemukan / kosong maka akan error
        try {
            $jabatan = PegawaiRiwayatJabatan::where('pegawai_id', $pegawai->id)->where('is_now', true)->where('is_plt', false)->first();
            if($jabatan)
            {
                $tukin = $jabatan->jabatan_unit_kerja->jabatan_tukin->tukin->nominal ?? 0;
                if ($tukin!=0){

                    $nominal_tukin = $tukin * 0.25;

                    if ($status_kehadiran == 'TM') {
                        $TM1 = PrePotonganTukin::where('status_kehadiran', 'TM1')->first();
                        $TM2 = PrePotonganTukin::where('status_kehadiran', 'TM2')->first();
                        $TM3 = PrePotonganTukin::where('status_kehadiran', 'TM3')->first();
                        if ($jam > 0 && $jam <= $TM1->lama_waktu_keterlambatan) {
                            return $TM1->prosentase_pemotongan * $nominal_tukin;
                        } elseif ($jam > $TM1->lama_waktu_keterlambatan && $jam <= $TM2->lama_waktu_keterlambatan) {
                            return $TM2->prosentase_pemotongan * $nominal_tukin;
                        } elseif ($jam > $TM2->lama_waktu_keterlambatan) {
                            return $TM3->prosentase_pemotongan * $nominal_tukin;
                        } else {
                            return 0;
                        }
                    }
                    if ($status_kehadiran == 'PC') {
                        $PC1 = PrePotonganTukin::where('status_kehadiran', 'PC1')->first();
                        $PC2 = PrePotonganTukin::where('status_kehadiran', 'PC2')->first();
                        $PC3 = PrePotonganTukin::where('status_kehadiran', 'PC3')->first();
                        if ($jam > 0 && $jam <= $PC1->lama_waktu_keterlambatan) {
                            return $PC1->prosentase_pemotongan * $nominal_tukin;
                        } elseif ($jam > $PC1->lama_waktu_keterlambatan && $jam <= $PC2->lama_waktu_keterlambatan) {
                            return $PC2->prosentase_pemotongan * $nominal_tukin;
                        } elseif ($jam > $PC2->lama_waktu_keterlambatan) {
                            return $PC3->prosentase_pemotongan * $nominal_tukin;
                        } else {
                            return 0;
                        }
                    }
                    if ($status_kehadiran == 'ITM') {
                        $ITM = PrePotonganTukin::where('status_kehadiran', 'ITM')->first();
                        return $ITM->prosentase_pemotongan * $nominal_tukin;
                    }
                    if ($status_kehadiran == 'IPC') {
                        $IPC = PrePotonganTukin::where('status_kehadiran', 'IPC')->first();
                        return $IPC->prosentase_pemotongan * $nominal_tukin;
                    }
                    if ($status_kehadiran == 'ITMIPC') {
                        $ITMIPC = PrePotonganTukin::where('status_kehadiran', 'ITMIPC')->first();
                        return $ITMIPC->prosentase_pemotongan * $nominal_tukin;
                    }
                    if ($status_kehadiran == 'ALPHA') {
                        $ALPHA = PrePotonganTukin::where('status_kehadiran', 'ALPHA')->first();
                        return $ALPHA->prosentase_pemotongan * $nominal_tukin;
                    }
                }else{
                    self::SaveInfo("Err: Jabatan Unit Kerja dan Tukin tidak ditemukan=>" . $pegawai->id .'|'. $pegawai->nama_depan . ' ' . $pegawai->nama_belakang);
                    return -1;
                }
            }else{
                self::SaveInfo("Err: Jabatan tidak ditemukan=>" . $pegawai->id .'|'. $pegawai->nama_depan . ' ' . $pegawai->nama_belakang);
                return -1;
            }


        } catch (\Throwable $th) {
            Log::error('Error kalkulasi Potongan : ' . $th . ' | ' . $pegawai->id .'|'. $pegawai->nama_depan . ' ' . $pegawai->nama_belakang .'|'. $jam . '|' . $status_kehadiran);
            return -1;
        }
    }
}
