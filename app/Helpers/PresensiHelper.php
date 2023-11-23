<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Pegawai;
use App\Models\PreIjin;
use App\Models\Presensi;
use App\Models\PreJamKerja;
use App\Models\PreTubel;
use Illuminate\Support\Facades\Date;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;

class PresensiHelper {
    public static function get_datetime() {
        $inOut = DB::connection('adms')->table('checkinout')->get();
        foreach ($inOut as $row) {
            echo "ID: " . $row->id . ", userId: " . $row->userid . ", tanggal: " . $row->checktime . "\n";
        }
        dd($inOut);

    }

    private static function get_Ijin($no_enroll) {
        return PreIjin::Where('no_enroll',$no_enroll)->first();
    }

    private static function get_ConvertDateTime($totalSeconds) {
        $hours = floor($totalSeconds / 3600);
        $minutes = floor(($totalSeconds % 3600) / 60);
        $seconds = $totalSeconds % 60;
        $convertedTime = Carbon::createFromTime($hours, $minutes, $seconds);
        $formattedTime = $convertedTime->format('H:i:s');
        return $formattedTime;
    }

    private static function get_Tubel($no_enroll,$datePresensi) {
        $dataTubel = PreTubel::Where('no_enroll',$no_enroll)->first();
        if ($dataTubel) {
            $checkDate = Carbon::parse($datePresensi);
            $startDate = Carbon::parse($dataTubel->tanggal_awal);
            $endDate = Carbon::parse($dataTubel->tanggal_akhir);
            if ($checkDate->between($startDate, $endDate)) {
                return $dataTubel;
            } else {
                return null;
            }
        }else{
           return null;
        }
    }

    public static function get_DataPresensi() {

        $todayDate = now()->format('Y-m-d');
        $inOut = DB::connection('adms')->table('checkinout')
                ->whereDate('checktime', $todayDate)
                ->get();

        $jamKerja = PreJamKerja::Where('is_active','Y')->first();

        foreach ($inOut as $row) {
            //echo "ID: " . $row->id . ", userId: " . $row->userid . ", tanggal: " . $row->checktime . "\n";
            $dateTime = $row->checktime;

            $tgl = Carbon::parse($dateTime)->format('Y-m-d');
            $jam = Carbon::parse($dateTime)->format('H:i:s');

            $dayOfWeekIndex = Carbon::parse($tgl)->format('N');

            $pegawai = Pegawai::Where('no_enroll',$row->userid)->first();

            if ($pegawai) {
                $IjinPegawai = self::get_Ijin($pegawai->no_enroll);
                $IjinTubel = self::get_Tubel($pegawai->no_enroll,$tgl);

                try {
                    $presensi = Presensi::whereDate('tanggal_presensi', $todayDate)->Where('no_enroll',$row->userid)->first();
                    if ($presensi) {

                        $blnUpdate = false;
                        $strNote = "";
                        if (!empty($presensi->jam_pulang)) {
                            $jamPulandDB = strtotime($presensi->jam_pulang);
                            $jamPulangPresensi = strtotime($jam);
                            if ($jamPulangPresensi>$jamPulandDB){
                                //Jika Jam Pulang di presensi lebih akhir dari pada jam pulang di db maka update jam pulang
                                $blnUpdate = true;
                            }
                        }else{
                            $blnUpdate = true;
                        }

                        if ($blnUpdate){

                            //penghitungan jam kerja
                            $jamPesensiMasuk = strtotime($presensi->jam_masuk);
                            $jamPesensiPulang = strtotime($jam);

                            //Master Jam Kerja
                            $MasterJamMasuk = strtotime($jamKerja->jam_masuk);
                            $MasterJamPulang = strtotime($jamKerja->jam_pulang);

                            if ($jamPesensiMasuk<=$MasterJamMasuk){
                                $JamMasukKerja = $jamKerja->jam_masuk;
                            }
                            else
                            {
                                //terlambat datang
                                $JamMasukKerja = $presensi->jam_masuk;
                            }

                            if ($jamPesensiPulang>=$MasterJamPulang){
                                $JamPulangKerja = $jam;
                            }
                            else{
                                //Pulang lebih awal
                                $JamPulangKerja = $jam;
                            }

                            // if ($jampresensiMasuk<=$MasterJamMasuk){
                            //     $JamMasukNormal = $jamKerja->jam_masuk
                            // }elseif ($jampresensi=$jamMasterMasuk)
                            // {
                            //     $presensi->keterangan = 'Datang tepat waktu';
                            // } else
                            // {
                            //     $presensi->keterangan = 'Datang lebih awal';
                            // }


                            $presensi->jam_pulang = $jam;
                            $totalSeconds = $jamPulang->diffInSeconds($jamMasuk);
                            $presensi->kekurangan_jam = self::get_ConvertDateTime($totalSeconds);
                            $presensi->save();
                        }

                    }else
                    {
                        try {
                            $presensi = new Presensi;
                            $presensi->no_enroll = $row->userid;
                            $presensi->jam_kerja_id = $jamKerja->id;
                            $presensi->tanggal_presensi = $tgl;
                            $presensi->jam_masuk = $jam;

                            //0= tidak ijin, 1=ijin datang_terlambat, 2=ijin pulang awal,
                            //3=ijin datang terlambat dan pulang awal, 4 = tidak tercatat jam masuk,
                            //5 = tidak tercatat jam pulang
                            if ($IjinPegawai) {
                                $presensi->is_ijin = $IjinPegawai->jenis_ijin;
                            }else{
                                $presensi->is_ijin = 0;
                            }
                            // $presensi->kekurangan_jam = $request->kekurangan_jam;
                            //Y: Jam kerja Normal N: Jam kerja Ramadhan belum tahu ambil dari mana
                            if (strpos($jamKerja->keterangan, 'ramadhan') !== false) {
                                $presensi->is_jk_normal = 'N';
                            } else {
                                $presensi->is_jk_normal = 'Y';
                            }

                            //Ini untuk check jika Pegawai yang Tubel melakukan presensi
                            if ($IjinTubel) {
                                $presensi->is_tubel = 'Y';
                            }else{
                                $presensi->is_tubel = 'N';
                            }

                            $jampresensi = strtotime($jam);
                            $jamMasterMasuk = strtotime($jamKerja->jam_masuk);
                            // var_dump( $jam . ' ' . $jampresensi . "| " . $jamKerja->jam_masuk . '  ' . $jamMasterMasuk);

                            if ($jampresensi>$jamMasterMasuk){
                                $presensi->keterangan = 'Datang terlambat';
                            }elseif ($jampresensi=$jamMasterMasuk)
                            {
                                $presensi->keterangan = 'Datang tepat waktu';
                            } else
                            {
                                $presensi->keterangan = 'Datang lebih awal';
                            }
                            $presensi->save();

                        } catch (\Throwable $th) {
                            Log::error("error Get Data-Presensi :" . $th->getMessage() . "\n=> Pegawai No_Enroll:". $pegawai->no_enroll . "|Nip:". $pegawai->nip . "|Nama:". $pegawai->nama_depan . " " . $pegawai->nama_belakang . "\n" . " Presensi :" . "ID: " . $row->id . ", no_enroll: " . $row->userid . ", tanggal: " . $row->checktime . "\n=======================================" );
                        }

                    }
                 //code...
                } catch (\Throwable $th) {
                    dd($th);
                }
            }
        }
        dd($inOut);
    }
}
