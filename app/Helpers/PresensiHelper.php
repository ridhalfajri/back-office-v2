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
use App\Models\PreTubel;
use Barryvdh\Debugbar\Facades\Debugbar;

use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Date;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Log;

class PresensiHelper {

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

    private static function UpdateAdms($id)
    {
        try {
            // DB::connection('adms')->table('checkinout')
            // ->where('id', $id)
            // ->update(['Reserved' => '1']);

        } catch (\Throwable $th) {

        }

    }

    public static function get_DataPresensi() {

        $todayDate = now()->format('Y-m-d');
        $todayYear = now()->format('Y');
        $todayMonth = now()->format('m');

        $inOut = DB::connection('adms')->table('checkinout')
            //->whereDate('checktime', $todayDate)
            ->whereYear('checktime','=',$todayYear)
            ->whereMonth('checktime','=',$todayMonth)
            ->where('Reserved', '0')
            ->orderBy('id')
            ->get();

        $jamKerja = PreJamKerja::Where('is_active', 'Y')->first();

        foreach ($inOut as $row) {
            //echo "ID: " . $row->id . ", userId: " . $row->userid . ", tanggal: " . $row->checktime . "\n";
            $dateTime = $row->checktime;

            $tglPresensi = Carbon::parse($dateTime)->format('Y-m-d');
            $jamPresensi = Carbon::parse($dateTime)->format('H:i:s');

            $typePresensi = strtotime('12:00:01') > strtotime($jamPresensi);

            $dayOfWeekIndex = Carbon::parse($tglPresensi)->format('N');

            //Ambil Data Presensi hari senin-jum'at
            if ($dayOfWeekIndex<6)
            {
                $pegawai = Pegawai::Where('no_enroll',$row->userid)->first();

                if ($pegawai) {

                    try {
                        $presensi = Presensi::whereDate('tanggal_presensi',  $tglPresensi)->Where('no_enroll',$row->userid)->first();
                        $blnSavePresensi = false;
                        $blnUpdatePresensi = false;

                        if ($presensi) {

                            if ($typePresensi){
                                // Jam Masuk
                                if (!empty($presensi->jam_masuk) && $presensi->jam_masuk != "00:00:00") {

                                    // Syarat jam masuk awal harus lebih besar dari jam masuk akhir
                                    if (strtotime($jamPresensi) > strtotime($presensi->jam_masuk))
                                    {
                                        //====================================================================================================
                                        //Jika Pegawai Izin pulang Awal atau Izin datang terlambat dan Pulang awal, jika tidak izin maka presensi akan di skip
                                        if ($presensi->is_ijin==2 || $presensi->is_ijin==3 ){
                                            //Ubah menjadi jam Pulang karena jam masuk sudah tersimpan sebelumnya
                                            //Hal ini dilakukan karena Pegawai bisa melakukan izin pulang awal sebelum jam 12:00:00
                                            // jika pegawai tidak izin maka tidak perlu ada update jam pulang untuk menghindari jam pulang terisi jika pegawai melakukan presensi 2 kali dan tidak izin pulang awal
                                            $typePresensi = false;
                                            $blnUpdatePresensi = true;
                                        }
                                        //======================================================================================================
                                    }
                                }else
                                {
                                    // Jika Jam masuk null atau "00:00:00" maka update presensi
                                    $blnUpdatePresensi = true;
                                }
                            }
                            else{

                                //Jika jam masuk kosong dan ada ijin datang terlambat maka ubah typresensi menjadi jam masuk
                                if ((empty($presensi->jam_masuk) || $presensi->jam_masuk == "00:00:00") && ($presensi->is_ijin == 1 || $presensi->is_ijin==3)) {
                                    $typePresensi = true;
                                    $blnUpdatePresensi = true;
                                    Debugbar::info('Ubah ke Jam masuk');
                                }else{
                                     //Jam Pulang
                                     if (empty($presensi->jam_masuk) || $presensi->jam_masuk == "00:00:00") {
                                        // Jika Jam Pulang null maka update presensi
                                        $blnUpdatePresensi = true;
                                    }
                                    else
                                    {
                                        $jamPulandDB = strtotime($presensi->jam_pulang);
                                        $jamPulangPresensi = strtotime($jamPresensi);

                                        if ($jamPulangPresensi>$jamPulandDB){
                                            //Jika Jam Pulang di presensi lebih akhir dari pada jam pulang di db maka update jam pulang
                                            $blnUpdatePresensi = true;
                                        }
                                    }
                                }

                            }

                        }else
                        {
                            $blnSavePresensi = true;
                        }

                        if ($blnUpdatePresensi)
                        {
                            try {

                                $presensi->jam_kerja_id = $jamKerja->id;
                                if ($typePresensi){
                                    // Jam Masuk
                                    $presensi->jam_masuk = $jamPresensi;

                                }
                                else{
                                    //Jam Pulang
                                    $presensi->jam_pulang = $jamPresensi;
                                }

                                $presensi->is_jk_normal = $jamKerja->is_jk_normal;

                                //=======================================
                                //'DINAS LUAR', 'TUGAS BELAJAR'
                                if ($presensi->status_kehadiran !='DINAS LUAR' && $presensi->status_kehadiran != 'TUGAS BELAJAR')
                                {
                                    $presensi->status_kehadiran = 'HADIR';
                                }
                                //=======================================
                                $presensi->save();
                                self::UpdateAdms($row->id);
                                // sleep(2);

                            } catch (\Exception $e) {
                                // Handle any exceptions that may occur during the update
                                Log::error('(1) Save Data Presensi and Update ADMS Error :' . $e->getMessage() . "\n=> Pegawai No_Enroll:". $pegawai->no_enroll . "|Nip:". $pegawai->nip . "|Nama:". $pegawai->nama_depan . " " . $pegawai->nama_belakang . "\n" . " Presensi :" . "ID: " . $row->id . ", no_enroll: " . $row->userid . ", tanggal: " . $row->checktime . "\n=======================================" );
                            }

                        }else
                        {
                            if ($blnSavePresensi){
                                try {

                                    $presensi = new Presensi();
                                    $presensi->no_enroll = $row->userid;
                                    $presensi->jam_kerja_id = $jamKerja->id;
                                    $presensi->tanggal_presensi = $tglPresensi;

                                    if ($typePresensi){
                                        // Jam Masuk
                                        $presensi->jam_masuk = $jamPresensi;
                                    }
                                    else{
                                        //Jam Pulang
                                        $presensi->jam_pulang = $jamPresensi;
                                    }

                                    //default is_ijin adalah 0
                                    $presensi->is_ijin = 0;
                                    $presensi->is_jk_normal = $jamKerja->is_jk_normal;
                                    //Default StatusKehadiran => Hadir
                                    $presensi->status_kehadiran = 'HADIR';
                                    $presensi->save();
                                    self::UpdateAdms($row->id);
                                    // sleep(1);


                                } catch (\Exception $e) {
                                    // Handle any exceptions that may occur during the update
                                    Log::error('(2) Save Data Presensi and Update ADMS Error :' . $e->getMessage() . "\n=> Pegawai No_Enroll:". $pegawai->no_enroll . "|Nip:". $pegawai->nip . "|Nama:". $pegawai->nama_depan . " " . $pegawai->nama_belakang . "\n" . " Presensi :" . "ID: " . $row->id . ", no_enroll: " . $row->userid . ", tanggal: " . $row->checktime . "\n=======================================" );
                                }
                            }else{

                                self::UpdateAdms($row->id);
                            }
                        }

                        self::fncCalculatePresensi($pegawai,$presensi);
                        // sleep(1);

                    } catch (\Throwable $th) {
                        Log::error("error Data-Presensi :" . $th->getMessage() . "\n=======================================" );
                    }
                }
            }else{

                self::UpdateAdms($row->id);
            }
        }

    }


    public static function fncCalculatePresensi(Pegawai $pegawai, Presensi $presensi){

        try {

            Debugbar::log($presensi->tanggal_presensi);
            Debugbar::log($presensi->jam_masuk);
            Debugbar::log($presensi->jam_pulang);


            $jamKerja = PreJamKerja::Where('is_active','Y')->first();

            if ($presensi && $jamKerja)
            {
                Debugbar::log('Lanjut');

                $tglPresensi = Carbon::parse($presensi->tanggal_presensi)->format('Y-m-d');

                $jamMasuk = $presensi->jam_masuk;
                $jamPulang = $presensi->jam_pulang;

                $dayOfWeekIndex = Carbon::parse($tglPresensi)->format('N');

                // if ($dayOfWeekIndex<6){
                    if ($dayOfWeekIndex==5){
                        //Master Jam Kerja Hari Jum'at
                        $MasterJamMasuk = Carbon::parse($jamKerja->jam_masuk_khusus)->format('H:i:s');
                        $MasterJamPulang = Carbon::parse($jamKerja->jam_pulang_khusus)->format('H:i:s');
                    }else{
                        //Master Jam Kerja Hari Senin-Selasa atau sabtu dan mingggu
                        $MasterJamMasuk = Carbon::parse($jamKerja->jam_masuk)->format('H:i:s');
                        $MasterJamPulang = Carbon::parse($jamKerja->jam_pulang)->format('H:i:s');
                    }

                    $jamFloating = Carbon::parse($jamKerja->waktu_floating)->format('H');
                    $MenitFloating = Carbon::parse($jamKerja->waktu_floating)->format('i');

                    $totalJamKerjaSeconds = self::get_Second_Diff($MasterJamMasuk,$MasterJamPulang);
                    $totalFloatingSeconds = (60 * 60 * $jamFloating ) + (60 * $MenitFloating );
                    $kelebihanJamKerja = 0;

                    Debugbar::log('Lanjut disini ' . $presensi->status_kehadiran);
                    if ( (empty($jamMasuk) || $jamMasuk =="00:00:00") && (empty($jamPulang) || $jamPulang =="00:00:00") && ($presensi->status_kehadiran == 'ALPHA' || $presensi->status_kehadiran == 'HADIR' ) ) {
                        // tidak melakukan presensi Masuk/Pulang serta tidak melakukan Ijin,DL ataupun cuti
                        Debugbar::info('2. Tidak melakukan presensi / Alpha' );
                        // Jam Masuk
                        $presensi->jam_masuk = '00:00:00';

                        //Jam Pulang
                        $presensi->jam_pulang = '00:00:00';

                        //default is_ijin adalah 0
                        $presensi->is_ijin = 0;
                        $presensi->is_jk_normal = $jamKerja->is_jk_normal;
                        //Default StatusKehadiran => Hadir
                        $presensi->status_kehadiran = 'ALPHA';
                        $presensi->kekurangan_jam ="07:30:00";
                        $presensi->kelebihan_jam ="00:00:00";
                        $presensi->keterangan = '-';
                        $kekurangan_jam  = $presensi->kekurangan_jam;

                        $potong = self::_hitung_potongan($pegawai, $kekurangan_jam, $presensi->status_kehadiran);
                        $presensi->nominal_potongan =  $potong ;

                        $presensi->save();

                    }
                    elseif ( (!empty($jamMasuk) && $jamMasuk !="00:00:00") && (empty($jamPulang) || $jamPulang =="00:00:00") && $presensi->status_kehadiran == 'HADIR' )
                    {
                        Debugbar::info('3. Kalkulasi Jam masuk saja');
                        //=====================================================================================
                        // Presensi Masuk
                        //Jika Ijindatang terlambat
                        if ($presensi->is_ijin == 1 || $presensi->is_ijin == 3 ){
                            if ($presensi->is_ijin == 1){
                                $presensi->keterangan = 'Ijin datang terlambat, Jam Pulang :' . $MasterJamPulang;
                            }else{
                                $presensi->keterangan = 'Ijin datang terlambat dan Pulang Awal';
                            }
                        }else{

                            // Jam Masuk ada dan jam pulang kosong (Normal Case 1)
                            if (strtotime($jamMasuk)>strtotime($MasterJamMasuk)){

                                $MasterJamPulang = Carbon::createFromTimeString($MasterJamPulang);
                                $kurangSecond = self::get_Second_Diff($MasterJamMasuk,$jamMasuk);

                                if($kurangSecond>$totalFloatingSeconds){
                                    $JamPulangMinimal = $MasterJamPulang->addSecond($totalFloatingSeconds);
                                    $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                                    $kurangSecond = $kurangSecond-$totalFloatingSeconds;
                                    $presensi->keterangan = 'Datang terlambat, Jam Pulang :' . $JamPulangMinimal . ', Kekurangan Jam Kerja :' . self::get_ConvertDateTime($kurangSecond);

                                }
                                elseif($kurangSecond==$totalFloatingSeconds)
                                {
                                    $JamPulangMinimal = $MasterJamPulang->addSecond($totalFloatingSeconds);
                                    $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                                    $kurangSecond = 0;
                                    $presensi->keterangan = 'Datang terlambat, Jam Pulang :' . $JamPulangMinimal;
                                }
                                else
                                {
                                    $JamPulangMinimal = $MasterJamPulang->addSecond($kurangSecond);
                                    $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                                    $presensi->keterangan = 'Datang terlambat, Jam Pulang :' . $JamPulangMinimal;
                                }

                            }
                            elseif (strtotime($jamMasuk)==strtotime($MasterJamMasuk))
                            {
                                $presensi->keterangan = 'Datang tepat waktu, Jam Pulang :' . $MasterJamPulang;
                            }
                            else
                            {
                                $presensi->keterangan = 'Datang lebih awal, Jam Pulang :' . $MasterJamPulang;
                                $kelebihanJamKerja  = self::get_Second_Diff($MasterJamMasuk,$jamMasuk);
                            }
                        }

                        $presensi->save();
                    }
                    elseif ( (!empty($jamMasuk) && $jamMasuk !="00:00:00") && (!empty($jamPulang) && $jamPulang !="00:00:00") && $presensi->status_kehadiran == 'HADIR' )
                    {
                        Debugbar::log('Lanjut lagi disini');
                        Debugbar::info('4. Kalkulasi Jam masuk dan Pulang');

                        // Jam Masuk dan Jam Pulang terisi (Normal Case 2)
                        //====================================================================================================================

                        //penghitungan jam kerja
                        $jamMasuk = $presensi->jam_masuk;
                        $jamPulang = $presensi->jam_pulang;
                        //===================================================
                        $kurangJamKerja = 0;
                        $kurangSecondAkhir = 0;
                        $kelebihanJamKerja = 0;

                        //===================================================================================
                        //Jika Ijin datang terlambat
                        //===================================================================================
                        if ($presensi->is_ijin == 1 || $presensi->is_ijin == 3 ){
                            $jamMasuk = $MasterJamMasuk;
                        }

                        Debugbar::info('Ijin ' . $presensi->is_ijin);

                        //====================================================================================
                        // Kalkulasi Jam Masuk
                        //====================================================================================
                        if (strtotime($jamMasuk)>strtotime($MasterJamMasuk)){
                            //datang terlambat
                            $kurangJamKerja = self::get_Second_Diff($MasterJamMasuk,$jamMasuk);
                        }else{
                            $kelebihanJamKerja  = self::get_Second_Diff($MasterJamMasuk,$jamMasuk);
                        }

                        $JamPulangMinimal =  Carbon::createFromTimeString($MasterJamPulang);

                        if($kurangJamKerja>0){
                            if($kurangJamKerja > $totalFloatingSeconds){
                                //Kekurangan karena melebihi floating time
                                $JamPulangMinimal = $JamPulangMinimal->addSecond($totalFloatingSeconds);
                                $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');

                                //Karena Kurang Jam Kerja lebih dari floating maka dikurangi floating time
                                // sisa kekurangan jam akan diakumulasi di penghitungan jam pulang
                                $kurangJamKerja = $kurangJamKerja - $totalFloatingSeconds;
                            }
                            elseif ($kurangJamKerja <= $totalFloatingSeconds)
                            {
                                //Datang terlambat dibawah floating time
                                $JamPulangMinimal = $JamPulangMinimal->addSecond($kurangJamKerja);
                                $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                                 //Karena Kurang Jam Kerja dibawah floating maka kurang jam = 0
                                 $kurangJamKerja = 0 ;
                            }
                        }
                        else{
                            //pulang sesuai jam pulang
                            $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                        }

                        //===================================================================================
                        //Ijin Pulang Awal
                        //===================================================================================
                        if ($presensi->is_ijin == 2 || $presensi->is_ijin == 3 ){
                            $jamPulang = $JamPulangMinimal;
                        }

                        //====================================================================================
                        // Kalkulasi Jam Pulang
                        //====================================================================================
                        if (strtotime($jamPulang)<strtotime($JamPulangMinimal))
                        {
                            //Pulang Awal
                            //Jika Jam Pulang lebih kecil jam 12 siang maka
                            $JamIstirahat = 0;
                            if (strtotime($jamPulang)<=strtotime('12:00:00')){
                                $JamIstirahat = 3600;
                            }
                            elseif (strtotime($jamPulang)>strtotime('12:00:00') && strtotime($jamPulang)>strtotime('13:00:00') ){
                                $JamIstirahat = self::get_Second_Diff('13:00:00',$jamPulang);
                            }

                            $kurangJamKerja += self::get_Second_Diff($JamPulangMinimal,$jamPulang);


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


                        Debugbar::info('Jam Masuk ' . $jamMasuk);
                        Debugbar::info('Jam Pulang ' . $jamPulang);

                        Debugbar::info('Kurang Jam ' . $kurangJamKerja);


                        //====================================================================================
                        // Kalkulasi Jam Pulang dan kekurangan jam kerja
                        //====================================================================================
                        //Final
                        $keterangan = "";

                        if ($presensi->is_ijin == 1){
                            $keterangan = 'Ijin datang terlambat';
                        }elseif($presensi->is_ijin == 2){
                            $keterangan = 'Ijin pulang lebih awal';
                        }elseif($presensi->is_ijin == 3){
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

                        Debugbar::info('OK Jam ' . $kurangJamKerja);

                        if ($kurangJamKerja <= 0)
                        {
                            $presensi->kekurangan_jam ="00:00:00";
                            $presensi->nominal_potongan = 0;
                            $presensi->keterangan = $keterangan;
                        }
                        else
                        {
                            Debugbar::info('lanjut ');
                            if ($keterangan == ""){
                                //Keterangan Akhir di isi ketika ada kekurangan jam kerja
                                $keterangan= self::GetKeterangan($jamMasuk,$MasterJamMasuk,$jamPulang,$JamPulangMinimal);
                            }

                            // var_dump('ISI');
                            // var_dump($keterangan);
                            // var_dump($jamMasuk . ' ' . $MasterJamMasuk . ' ' .  $jamPulang . ' ' . $JamPulangMinimal);

                            //Jika kekurangan jam kerja melebihi 7.5 maka kekurangan yang diambil adalah 7,5 jam
                            if ($kurangJamKerja>$totalJamKerjaSeconds){
                                $kurangJamKerja=$totalJamKerjaSeconds;
                            }

                            $presensi->kekurangan_jam = self::get_ConvertDateTime($kurangJamKerja);
                            if ( $presensi->status_kehadiran = 'HADIR' &&  $presensi->is_ijin == 0 ){
                                $presensi->keterangan = $keterangan;
                            }

                            //=========================================================
                            // Jika ada Ijin datang terlmabat dan pulang awal maka potongan sama dengan 0
                            //=========================================================
                            //=====================================================================================
                            //0= tidak ijin, 1=ijin datang_terlambat, 2=ijin pulang awal, 3=ijin datang terlambat dan pulang awal, 4 = tidak tercatat jam masuk, 5 = tidak tercatat jam pulang
                            if ($presensi->is_ijin == 3 ){
                                //check lagi disini jika ada ijin maka penghitungan potongan berubah
                                Debugbar::info('Disini A ');
                                $presensi->nominal_potongan = 0;
                                $presensi->kekurangan_jam = "00:00:00";
                                $presensi->keterangan = self::GetKeteranganIjin($presensi->is_ijin);
                            }else{
                                Debugbar::info('Disini B');
                                $presensi->nominal_potongan = self::_hitung_potongan($pegawai, $presensi->kekurangan_jam, $presensi->status_kehadiran);
                            }

                        }

                        if ($kelebihanJamKerja<=0){
                            $presensi->kelebihan_jam ="00:00:00";
                        }else{
                            if ($presensi->is_ijin != 0 ){
                                $presensi->kelebihan_jam = "00:00:00";
                            }else{
                                $presensi->kelebihan_jam = self::get_ConvertDateTime($kelebihanJamKerja);
                            }
                        }

                        // dd($presensi);
                        $presensi->save();


                        //====================================================================================================================
                    }
                    elseif ( (empty($jamMasuk) || $jamMasuk=="00:00:00") && (!empty($jamPulang) && $jamPulang !="00:00:00") && $presensi->status_kehadiran == 'HADIR' )
                    {
                        Debugbar::info('5. Kalkulasi Jam Pulang saja');
                        //Jika Pegawai hanya melakukan presensi cuma pulang saja maka keterlambatan di set sebagai keterlmbatan maksimal yaitu 7,5 jam
                        $presensi->kekurangan_jam ="07:30:00";

                        $presensi->nominal_potongan = self::_hitung_potongan($pegawai, $presensi->kekurangan_jam, $presensi->status_kehadiran);
                        $presensi->keterangan = 'Tidak melakukan presensi Jam Masuk';
                        $presensi->save();
                    }

                // }
                Debugbar::log('Finish ' . (!empty($jamMasuk) && $jamMasuk !="00:00:00") . ' ... ' . (!empty($jamPulang) && $jamPulang !="00:00:00"));
                return true;
            }

        } catch (\Throwable $th) {

            Log::error("error Kalkulasi-Data-Presensi :" . $th->getMessage() . "\n=======================================" );
            return false;
        }

    }

    private static function GetKeterangan($jamMasuk,$MasterJamMasuk,$jamPulang,$JamPulangMinimal){

        $retValue ="";
        $retAwal ="";
        $retAkhir ="";

        if (strtotime($jamMasuk)>strtotime($MasterJamMasuk)){
            $retAwal = 'Datang terlambat  ';
        }
        elseif (strtotime($jamMasuk)<strtotime($MasterJamMasuk)){
            // $retAwal = 'Datang lebih awal';
        }
        elseif (strtotime($jamMasuk)==strtotime($MasterJamMasuk)){
            // $retAwal = 'Datang tepat waktu';
        }

        if (strtotime($jamPulang)>strtotime($JamPulangMinimal)){
            // $retAkhir = 'Pulang akhir';
        }
        elseif (strtotime($jamPulang)<strtotime($JamPulangMinimal)){
            $retAkhir = 'Pulang lebih awal';
        }
        elseif (strtotime($jamPulang)==strtotime($JamPulangMinimal)){
            // $retAkhir = 'Pulang tepat waktu';
        }

        $retValue = $retAwal ;
        if ($retAwal!=""){
            $retValue = $retAwal . ' dan ' . $retAkhir;
        }
        else
        {
            $retValue =  $retAkhir;
        }

        return $retValue;

    }

    private static function GetKeteranganIjin($isIjin){
        //0= tidak ijin, 1=ijin datang_terlambat, 2=ijin pulang awal, 3=ijin datang terlambat dan pulang awal, 4 = tidak tercatat jam masuk, 5 = tidak tercatat jam pulang
        $retValue = "";
        if ($isIjin == 1){
            $retValue = 'Ijin datang terlambat';
        }elseif($isIjin == 2){
            $retValue = 'Ijin pulang lebih awal';
        }elseif($isIjin == 3){
            $retValue = 'Ijin datang terlambat dan pulang lebih awal';
        }elseif($isIjin == 4){
            $retValue = 'Ijin jam masuk tidak tercatat';
        }elseif($isIjin == 5){
            $retValue = 'Ijin jam pulang tidak tercatat';
        }

        return $retValue;
    }

    public function CronJobRun(){
        try {
            self::fnc_CheckAbsenRoutine();
        } catch (\Throwable $th) {
        }

        try {
           self::fnc_CheckHariLiburRoutine();
        } catch (\Throwable $th) {
        }
    }

    //Jalankan per jam 11 malam atau manual
    public static function fnc_CheckAbsenRoutine(){
        //disini check pegawai aktif yang tidak melakukan Presensi kemarin jalankan function ini setipa pergantian hari jam 00:00:01 (jam dua belas malam lewat satu detik)

        $pegawai = PegawaiHelper::getPegawaiDataActiveAll();

        $jamKerja = PreJamKerja::Where('is_active','Y')->first();

        $dateNow = now(); // Assuming dateNow is the current date
        //Tanggal Kemarin
        $tglPresensiKemarin = Carbon::parse($dateNow)->subDays(1)->format('Y-m-d');
        $dayOfWeekIndex = Carbon::parse($tglPresensiKemarin)->format('N');

        foreach ($pegawai as $pegawaiItem) {

            try {

                //get Presensi
                $presensi = Presensi::whereDate('tanggal_presensi',  $tglPresensiKemarin)->Where('no_enroll',$pegawaiItem->no_enroll)->first();
                //Check Jika Pegawai ditemukan
                if ($presensi)
                {
                    if ( $presensi->status_kehadiran != 'LIBUR' ) {
                        try {
                            if ($presensi->status_kehadiran == 'HADIR'){
                                $jamMasuk = $presensi->jam_masuk;
                                $jamPulang = $presensi->jam_pulang;
                                if ((empty($jamMasuk) || $jamMasuk == "00:00:00") && (empty($jamPulang) && $jamPulang =="00:00:00") )
                                {
                                    $presensi->kekurangan_jam ="07:30:00";
                                    $presensi->status_kehadiran = 'ALPHA';
                                    $presensi->nominal_potongan = self::_hitung_potongan($pegawai, $presensi->kekurangan_jam, $presensi->status_kehadiran);
                                    $presensi->keterangan = 'Tidak melakukan presensi';
                                    $presensi->save();
                                }
                                elseif ((!empty($jamMasuk) || $jamMasuk !="00:00:00") && (empty($jamPulang) && $jamPulang =="00:00:00"))
                                {
                                    $presensi->kekurangan_jam ="07:30:00";
                                    $presensi->status_kehadiran = 'ALPHA';
                                    $presensi->nominal_potongan = self::_hitung_potongan($pegawai, $presensi->kekurangan_jam, $presensi->status_kehadiran);
                                    $presensi->keterangan = 'Tidak melakukan presensi jam pulang';
                                    $presensi->save();
                                }
                                elseif ((empty($jamMasuk) || $jamMasuk =="00:00:00") && (!empty($jamPulang) && $jamPulang !="00:00:00"))
                                {
                                    $presensi->kekurangan_jam ="07:30:00";
                                    $presensi->status_kehadiran = 'ALPHA';
                                    $presensi->nominal_potongan = self::_hitung_potongan($pegawai, $presensi->kekurangan_jam, $presensi->status_kehadiran);
                                    $presensi->keterangan = 'Tidak melakukan presensi jam masuk';
                                    $presensi->save();
                                }
                                else
                                {
                                    //Jika jam masuk dan jam pulang tidak sama dengan kosong
                                    $mpegawai = Pegawai::where('id',$pegawaiItem->id)->first();
                                    $result = self::fncCalculatePresensi($mpegawai,$presensi);
                                }
                            }

                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                }else
                {
                    // 2. masukkan ke presensi jika tidak melakukan presensi dengan jam masuk dan jam pulang 00:00:00 dan keterlambatan 7,30
                    $presensi = new Presensi();
                    $presensi->no_enroll = $pegawaiItem->no_enroll;
                    $presensi->jam_kerja_id = $jamKerja->id;
                    $presensi->tanggal_presensi = $tglPresensiKemarin;

                    // Jam Masuk
                    $presensi->jam_masuk = '00:00:00';

                    //Jam Pulang
                    $presensi->jam_pulang = '00:00:00';

                    //default is_ijin adalah 0
                    $presensi->is_ijin = 0;
                    $presensi->is_jk_normal = $jamKerja->is_jk_normal;

                    //Default StatusKehadiran => Hadir
                    if ($dayOfWeekIndex>5){
                        //Hari libur
                        $presensi->status_kehadiran = 'LIBUR';
                        $presensi->kekurangan_jam ="00:00:00";
                        $presensi->kelebihan_jam ="00:00:00";
                        $presensi->nominal_potongan = 0;
                    }else{
                        $presensi->status_kehadiran = 'ALPHA';
                        $presensi->kekurangan_jam ="07:30:00";
                        $presensi->kelebihan_jam ="00:00:00";
                        $presensi->nominal_potongan = self::_hitung_potongan($pegawaiItem, $presensi->kekurangan_jam, $presensi->status_kehadiran);
                    }



                    $presensi->keterangan = '-';
                    $presensi->save();

                }

            } catch (\Throwable $th) {

            }
        }


    }

    //Jalankan setiap pergantian tanggal atau jam 00:00:01
    public static function fnc_CheckHariLiburRoutine(){
        //disini check pegawai aktif yang tidak melakukan Presensi kemarin jalankan function ini setipa pergantian hari jam 00:00:01 (jam dua belas malam lewat satu detik)

        $dateNow = now(); // Assuming dateNow is the current date
        //Tanggal
        $tglPresensi = Carbon::parse($dateNow)->format('Y-m-d');

        $HariLibur = HariLibur::where('tanggal','=',$tglPresensi)->where('is_libur','=',1)->get();

        $pegawai = PegawaiHelper::getPegawaiDataActiveAll();

        $jamKerja = PreJamKerja::Where('is_active','Y')->first();


        $dayOfWeekIndex = Carbon::parse($tglPresensi)->format('N');

        foreach ($HariLibur as $harilibur) {
            foreach ($pegawai as $pegawaiItem) {
                try {
                    //get Presensi
                    $presensi = Presensi::whereDate('tanggal_presensi',  $tglPresensi)->Where('no_enroll',$pegawaiItem->no_enroll)->first();

                    if (!$presensi)
                    {
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
                        $presensi->kekurangan_jam ="00:00:00";
                        $presensi->kelebihan_jam ="00:00:00";

                        $presensi->nominal_potongan = 0;
                        $presensi->keterangan = '';

                        $presensi->save();

                    }

                } catch (\Throwable $th) {

                }
            }
        }

    }

    //* KALKULASI POTONGAN TUNJANGAN KINERJA
    public static function _hitung_potongan($pegawai, $kekurangan_jam, $statusKehadiran)
    {
        // \\Note :
        // Jika Jabatan_unit_kerja dan Jabatan Tukin tidak ditemukan / kosong maka akan error
        try {


            $jabatan = PegawaiRiwayatJabatan::where('pegawai_id', $pegawai->id)->where('is_now', true)->where('is_plt', false)->first();
            $nominal_tukin = $jabatan->jabatan_unit_kerja->jabatan_tukin->tukin->nominal;

            $TL1 = PrePotonganTukin::where('id', 1)->first();
            $TL2 = PrePotonganTukin::where('id', 2)->first();
            $TL3 = PrePotonganTukin::where('id', 3)->first();
            $TL4 = PrePotonganTukin::where('id', 4)->first();
            $TL5 = PrePotonganTukin::where('id', 5)->first(); //ALPHA

            if ($statusKehadiran=='ALPHA'){
                return $TL5->prosentase_pemotongan * $nominal_tukin;
            }
            elseif($kekurangan_jam > 0 && $kekurangan_jam < $TL1->lama_waktu_keterlambatan){
                return $TL1->prosentase_pemotongan * $nominal_tukin;
            }
            elseif($kekurangan_jam >= $TL1->lama_waktu_keterlambatan && $kekurangan_jam < $TL2->lama_waktu_keterlambatan){
                return $TL2->prosentase_pemotongan * $nominal_tukin;
            }
            elseif($kekurangan_jam >= $TL2->lama_waktu_keterlambatan && $kekurangan_jam < $TL3->lama_waktu_keterlambatan){
                return $TL3->prosentase_pemotongan * $nominal_tukin;
            }
            elseif(($kekurangan_jam >= $TL3->lama_waktu_keterlambatan && $kekurangan_jam <= $TL4->lama_waktu_keterlambatan) || $kekurangan_jam > $TL4->lama_waktu_keterlambatan){
                return $TL4->prosentase_pemotongan * $nominal_tukin;
            }else{
                return 0;
            }


            // if ($kekurangan_jam <= $TL1->lama_waktu_keterlambatan) {
            //     return $TL1->prosentase_pemotongan * $nominal_tukin;
            // } else if ($kekurangan_jam > $TL1->prosentase_pemotongan && $kekurangan_jam <= $TL2->prosentase_pemotongan) {
            //     return $TL2->prosentase_pemotongan * $nominal_tukin;
            // } else if ($kekurangan_jam > $TL2->prosentase_pemotongan && $kekurangan_jam <= $TL3->prosentase_pemotongan) {
            //     return $TL3->prosentase_pemotongan * $nominal_tukin;
            // } else if ($kekurangan_jam > $TL3->prosentase_pemotongan) {
            //     return $TL4->prosentase_pemotongan * $nominal_tukin;
            // }

            // if ($kekurangan_jam <= $TL1->lama_waktu_keterlambatan) {
            //     echo $TL1;
            //     return $TL1->prosentase_pemotongan * $nominal_tukin;
            // } else if ($kekurangan_jam > $TL1->lama_waktu_keterlambatan && $kekurangan_jam <= $TL2->lama_waktu_keterlambatan) {
            //     echo $TL2;
            //     return $TL2->prosentase_pemotongan * $nominal_tukin;
            // } else if ($kekurangan_jam > $TL2->lama_waktu_keterlambatan && $kekurangan_jam <= $TL3->lama_waktu_keterlambatan) {
            //     echo $TL3;
            //     return $TL3->prosentase_pemotongan * $nominal_tukin;
            // } else if ($kekurangan_jam > $TL3->lama_waktu_keterlambatan) {
            //     echo $TL3  . ' ' . $TL3->prosentase_pemotongan * $nominal_tukin;
            //     return $TL4->prosentase_pemotongan * $nominal_tukin;
            // }

        } catch (\Throwable $th) {
            Log::error('Error kalkulasi Potongan : ' . $th->getMessage() . ' | ' . $pegawai);
            return -1;
        }

    }


}
