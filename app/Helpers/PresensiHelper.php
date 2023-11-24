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

    private static function get_Second_Diff($JamAwal, $JamAkhir) {

        $jamMasuk = Carbon::parse($JamAwal);
        $jamPulang = Carbon::parse($JamAkhir);
        $totalSeconds = $jamPulang->diffInSeconds($jamMasuk);

        return $totalSeconds;
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

    private static function UpdateAdms($id){
        DB::connection('adms')->table('checkinout')
        ->where('id', $id)
        ->update(['Reserved' => '1']);
    }
    public static function get_DataPresensi() {

        $todayDate = now()->format('Y-m-d');
        $inOut = DB::connection('adms')->table('checkinout')
                // ->whereDate('checktime', $todayDate)
                ->where('Reserved','0')
                ->orderBy('id')
                ->get();

        $jamKerja = PreJamKerja::Where('is_active','Y')->first();

        foreach ($inOut as $row) {
            //echo "ID: " . $row->id . ", userId: " . $row->userid . ", tanggal: " . $row->checktime . "\n";
            $dateTime = $row->checktime;

            $tgl = Carbon::parse($dateTime)->format('Y-m-d');
            $jam = Carbon::parse($dateTime)->format('H:i:s');

            $dayOfWeekIndex = Carbon::parse($tgl)->format('N');

            if ($dayOfWeekIndex<5){
                //Master Jam Kerja Hari Senin-Selasa
                $MasterJamMasuk = Carbon::parse($jamKerja->jam_masuk)->format('H:i:s');
                $MasterJamPulang = Carbon::parse($jamKerja->jam_pulang)->format('H:i:s');
            }else{
                //Master Jam Kerja Hari Jum'at
                $MasterJamMasuk = Carbon::parse($jamKerja->jam_masuk_khusus)->format('H:i:s');
                $MasterJamPulang = Carbon::parse($jamKerja->jam_pulang_khusus)->format('H:i:s');
            }

            $totalJamKerjaSeconds = self::get_Second_Diff($MasterJamMasuk,$MasterJamPulang);
            $totalFloatingSeconds = (1 * 3600) + (30 * 60);

            $pegawai = Pegawai::Where('no_enroll',$row->userid)->first();

            if ($pegawai) {
                $IjinPegawai = self::get_Ijin($pegawai->no_enroll);
                $IjinTubel = self::get_Tubel($pegawai->no_enroll,$tgl);

                try {
                    $presensi = Presensi::whereDate('tanggal_presensi', $todayDate)->Where('no_enroll',$row->userid)->first();
                    if ($presensi) {

                        $blnUpdate = false;
                        $blnKurangJamTotal = false;
                        $strNote = "";

                        if (!empty($presensi->jam_masuk)) {
                            if (!empty($presensi->jam_pulang)) {
                                if (strtotime($jam)>strtotime($presensi->jam_masuk)){
                                    $jamPulandDB = strtotime($presensi->jam_pulang);
                                    $jamPulangPresensi = strtotime($jam);
                                    if ($jamPulangPresensi>$jamPulandDB){
                                        //Jika Jam Pulang di presensi lebih akhir dari pada jam pulang di db maka update jam pulang
                                        $blnUpdate = true;
                                    }
                                }else{
                                    //Jam masuk lebih besar dari Jam Pulang
                                    //langsung update kekurangan jam kerja 7.5 jam
                                    $blnKurangJamTotal = true;
                                    // var_dump('Jam pulang lebih kecil');
                                }

                            }elseif (strtotime($jam)>strtotime($presensi->jam_masuk)){
                                $blnUpdate = true;
                                // var_dump('Jam masuk OK') ;
                            }else{
                                // var_dump('Jam masuk lebih besar') ;
                            }

                        }else{
                           //Jam masuk tidak ada nilainya
                            //langsung update kekurangan jam kerja 7.5 jam
                            $blnKurangJamTotal = true;
                            // var_dump('Jam masuk kosong');
                        }

                        if ($blnUpdate){

                            //penghitungan jam kerja
                            $jamPesensiMasuk = $presensi->jam_masuk;
                            $jamPesensiPulang = $jam;
                            //===================================================
                            $kurangJamKerja = 0;
                            $kurangSecondAkhir = 0;
                            if (strtotime($jamPesensiMasuk)>strtotime($MasterJamMasuk)){
                                //datang terlambat
                                $kurangJamKerja = self::get_Second_Diff($MasterJamMasuk,$jamPesensiMasuk);

                            }

                            $JamPulangMinimal =  Carbon::createFromTimeString($MasterJamPulang);

                            if($kurangJamKerja > $totalFloatingSeconds){
                                //Kekurangan karena melebihi floating time
                                $kurangJamKerja = $kurangJamKerja - $totalFloatingSeconds;

                                $JamPulangMinimal = $JamPulangMinimal->addSecond($totalFloatingSeconds);
                                $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');

                            }
                            elseif ($kurangJamKerja>0 && $kurangJamKerja < $totalFloatingSeconds)
                            {
                                //Datang terlambat dibawah floating time
                                $JamPulangMinimal = $JamPulangMinimal->addSecond($kurangJamKerja);
                                $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                            }
                            elseif ($kurangJamKerja>0 && $kurangJamKerja == $totalFloatingSeconds)
                            {
                                //Datang terlambat dibawah floating time
                                $JamPulangMinimal = $JamPulangMinimal->addSecond($kurangJamKerja);
                                $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');

                            }
                            else{
                                //datang tepat waktu
                                $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                            }

                            //Final
                            if (strtotime($jamPesensiPulang) < strtotime($JamPulangMinimal)){

                                //Pulang Awal
                                if($kurangJamKerja>0){

                                    $kurangJamKerja += self::get_Second_Diff($jamPesensiPulang,$JamPulangMinimal);
                                    $presensi->keterangan = 'Datang terlambat dan pulang lebih awal';
                                    if ($kurangJamKerja>$totalJamKerjaSeconds){
                                        $kurangJamKerja=$totalJamKerjaSeconds;
                                    }

                                }else{
                                    $kurangJamKerja = self::get_Second_Diff($jamPesensiPulang,$JamPulangMinimal);
                                    $presensi->keterangan = 'Datang tepat waktu dan pulang lebih awal';
                                }

                            } elseif ( $kurangJamKerja>0 && strtotime($jamPesensiPulang) > strtotime($JamPulangMinimal))
                            {
                                //Pulang Diatas Jam Pulang tetapi melebihi floating time
                                $presensi->keterangan = 'Datang terlambat melebihi floating time dan pulang paling akhir';

                            } elseif ( $kurangJamKerja>0 && strtotime($jamPesensiPulang) == strtotime($JamPulangMinimal))
                            {
                                //Datang terlambat tetapi pulang sesuai floating time
                                $presensi->keterangan = 'Datang terlambat tetapi pulang sesuai floating time';
                                $kurangJamKerja=0;
                            }
                            elseif (strtotime($jamPesensiPulang) > strtotime($JamPulangMinimal))
                            {
                                //Pulang Diatas Jam Pulang
                                $kurangJamKerja = 0;
                                $presensi->keterangan = 'Datang terlambat dan pulang paling akhir';

                            }else{
                                //Pulang tepat waktu
                                $kurangJamKerja = 0;
                                $presensi->keterangan = 'Datang tepat waktu dan pulang tepat waktu';
                            }

                            //====================================================

                            $presensi->jam_pulang = $jam;

                            if ($kurangJamKerja==0)
                            {
                                $presensi->kekurangan_jam ="00:00:00";
                            }
                            else
                            {
                                $presensi->kekurangan_jam = self::get_ConvertDateTime($kurangJamKerja);
                            }
                            // dd($presensi->kekurangan_jam);
                            $presensi->save();
                            self::UpdateAdms($row->id);
                        }else{
                            if ($blnKurangJamTotal == true){
                                //Update kekurangan jam kerja 7,5

                            }
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

                            $jampresensi = $jam;

                            if (strtotime($jampresensi)>strtotime($MasterJamMasuk)){

                                $MasterJamPulang = Carbon::createFromTimeString($MasterJamPulang);
                                $kurangSecond = self::get_Second_Diff($MasterJamMasuk,$jampresensi);
                                // var_dump($MasterJamMasuk);
                                // var_dump($jampresensi);
                                // var_dump($kurangSecond);
                                // var_dump(strtotime($jampresensi)>strtotime($MasterJamMasuk));

                                if($kurangSecond>$totalFloatingSeconds){
                                    $JamPulangMinimal = $MasterJamPulang->addSecond($totalFloatingSeconds);
                                    $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                                    $kurangSecond = $kurangSecond-$totalFloatingSeconds;
                                    $presensi->keterangan = 'Datang terlambat, Estimasi Jam Pulang :' . $JamPulangMinimal . ', Kekurangan Jam Kerja :' . self::get_ConvertDateTime($kurangSecond);

                                }else{
                                    $JamPulangMinimal = $MasterJamPulang->addSecond($kurangSecond);
                                    $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                                    $presensi->keterangan = 'Datang terlambat, Estimasi Jam Pulang :' . $JamPulangMinimal;

                                }

                            }elseif (strtotime($jampresensi)==strtotime($MasterJamMasuk))
                            {
                                $presensi->keterangan = 'Datang tepat waktu, Estimasi Jam Pulang :' . $MasterJamPulang;
                            } else
                            {
                                $presensi->keterangan = 'Datang lebih awal, Estimasi Jam Pulang :' . $MasterJamPulang;
                            }

                            $presensi->save();
                            self::UpdateAdms($row->id);
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
