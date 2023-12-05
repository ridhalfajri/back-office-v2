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

            $tglPresensi = Carbon::parse($dateTime)->format('Y-m-d');
            $jamPresensi = Carbon::parse($dateTime)->format('H:i:s');

            $typePresensi = strtotime('12:00:00') > strtotime($jamPresensi);

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
                                        //Jika Pegawai Izin pulang Awal atau Izin datang terlambat dan Pulang awal jika tidak izin maka presensi akan di skip
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

                        }else
                        {
                            $blnSavePresensi = true;
                        }

                        if ($blnUpdatePresensi)
                        {
                            try {
                                // Start a database transaction
                                DB::beginTransaction();

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
                                if(!empty($presensi->status_kehadiran) && ($presensi->status_kehadiran !='DINAS LUAR' || $presensi->status_kehadiran != 'TUGAS BELAJAR'))
                                {
                                    $presensi->status_kehadiran = 'HADIR';
                                }
                                //=======================================
                                $presensi->save();
                                self::UpdateAdms($row->id);

                                self::fncCalculatePresensi($presensi);

                                DB::commit();

                            } catch (\Exception $e) {
                                // Handle any exceptions that may occur during the update
                                DB::rollback();
                                Log::error('(1) Save Data Presensi and Update ADMS Error :' . $e->getMessage() . "\n=> Pegawai No_Enroll:". $pegawai->no_enroll . "|Nip:". $pegawai->nip . "|Nama:". $pegawai->nama_depan . " " . $pegawai->nama_belakang . "\n" . " Presensi :" . "ID: " . $row->id . ", no_enroll: " . $row->userid . ", tanggal: " . $row->checktime . "\n=======================================" );
                            }

                        }else
                        {
                            if ($blnSavePresensi){
                                try {
                                    // Start a database transaction
                                    DB::beginTransaction();

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

                                   self::fncCalculatePresensi($presensi);

                                    DB::commit();

                                } catch (\Exception $e) {
                                    // Handle any exceptions that may occur during the update
                                    DB::rollback();
                                    Log::error('(2) Save Data Presensi and Update ADMS Error :' . $e->getMessage() . "\n=> Pegawai No_Enroll:". $pegawai->no_enroll . "|Nip:". $pegawai->nip . "|Nama:". $pegawai->nama_depan . " " . $pegawai->nama_belakang . "\n" . " Presensi :" . "ID: " . $row->id . ", no_enroll: " . $row->userid . ", tanggal: " . $row->checktime . "\n=======================================" );
                                }
                            }else{

                                self::UpdateAdms($row->id);
                            }
                        }

                    } catch (\Throwable $th) {
                        Log::error("error Data-Presensi :" . $th->getMessage() . "\n=======================================" );
                    }
                }
            }else{

                self::UpdateAdms($row->id);
            }
        }

    }


    public static function fncCalculatePresensi(Presensi $presensi){

        $jamKerja = PreJamKerja::Where('is_active','Y')->first();
        var_dump('masuk');

        if ($presensi && $jamKerja)
        {
            var_dump('masuk ok');

            $tglPresensi = Carbon::parse($presensi->tanggal_presensi)->format('Y-m-d');

            $jamMasuk = $presensi->jam_masuk;
            $jamPulang = $presensi->jam_pulang;

            $dayOfWeekIndex = Carbon::parse($tglPresensi)->format('N');

            if ($dayOfWeekIndex<6){
                if ($dayOfWeekIndex<5){
                    //Master Jam Kerja Hari Senin-Selasa
                    $MasterJamMasuk = Carbon::parse($jamKerja->jam_masuk)->format('H:i:s');
                    $MasterJamPulang = Carbon::parse($jamKerja->jam_pulang)->format('H:i:s');
                }else{
                    //Master Jam Kerja Hari Jum'at
                    $MasterJamMasuk = Carbon::parse($jamKerja->jam_masuk_khusus)->format('H:i:s');
                    $MasterJamPulang = Carbon::parse($jamKerja->jam_pulang_khusus)->format('H:i:s');
                }

                $jamFloating = Carbon::parse($jamKerja->waktu_floating)->format('H');
                $MenitFloating = Carbon::parse($jamKerja->waktu_floating)->format('i');

                $totalJamKerjaSeconds = self::get_Second_Diff($MasterJamMasuk,$MasterJamPulang);
                $totalFloatingSeconds = (60 * 60 * $jamFloating ) + (60 * $MenitFloating );


                if ( (!empty($jamMasuk) || $jamMasuk !="00:00:00") && (empty($jamPulang) || $jamPulang =="00:00:00") && $presensi->status_kehadiran == 'HADIR' )
                {
                    // Jam Masuk ada dan jam pulang kosong (Normal Case)
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
                    }

                    $presensi->save();
                }
                elseif ( (!empty($jamMasuk) || $jamMasuk !="00:00:00") && (!empty($jamPulang) || $jamPulang !="00:00:00") && $presensi->status_kehadiran == 'HADIR' )
                {
                    // Jam Masuk dan Jam Pulang terisi (Normal Case)
                    //====================================================================================================================
                    //penghitungan jam kerja
                    $jamMasuk = $presensi->jam_masuk;
                    $jamPulang = $presensi->jam_pulang;
                    //===================================================
                    $kurangJamKerja = 0;
                    $kurangSecondAkhir = 0;

                    //====================================================================================
                    // Kalkulasi Jam Masuk dan kekurangan jam kerja
                    //====================================================================================
                    if (strtotime($jamMasuk)>strtotime($MasterJamMasuk)){
                        //datang terlambat
                        $kurangJamKerja = self::get_Second_Diff($MasterJamMasuk,$jamMasuk);
                    }

                    $JamPulangMinimal =  Carbon::createFromTimeString($MasterJamPulang);

                    if($kurangJamKerja>0 && $kurangJamKerja > $totalFloatingSeconds){
                        //Kekurangan karena melebihi floating time
                        $JamPulangMinimal = $JamPulangMinimal->addSecond($totalFloatingSeconds);
                        $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                    }
                    elseif ($kurangJamKerja>0 && $kurangJamKerja <= $totalFloatingSeconds)
                    {
                        //Datang terlambat dibawah floating time
                        $JamPulangMinimal = $JamPulangMinimal->addSecond($kurangJamKerja);
                        $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                    }
                    else{
                        //pulang sesuai jam pulang
                        $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                    }

                    //====================================================================================
                    // Kalkulasi Jam Pulang dan kekurangan jam kerja
                    //====================================================================================
                    // dd($kurangJamKerja . $totalFloatingSeconds . strtotime($jamPulang) < strtotime($JamPulangMinimal));
                    //Final
                    $keterangan='';

                    if ($kurangJamKerja>0 && $kurangJamKerja > $totalFloatingSeconds && strtotime($jamPulang) < strtotime($JamPulangMinimal)){
                        //Datang terlambat melebihi floating time dan pulang awal
                        $kurangJamKerja += self::get_Second_Diff($jamPulang,$JamPulangMinimal);
                        // $keterangan = 'Datang terlambat melebihi floating time dan pulang lebih awal';
                        $keterangan = 'Datang terlambat ';

                        $kurangJamKerja = $kurangJamKerja - $totalFloatingSeconds;

                    }
                    elseif ( $kurangJamKerja>0 && $kurangJamKerja <= $totalFloatingSeconds && strtotime($jamPulang) == strtotime($JamPulangMinimal))
                    {
                        //datang terlambat tetapi tidak melebihi floating time dan pulang akhir
                        // $keterangan = 'Datang terlambat tidak melebihi floating dan pulang sesuai floating time';
                        $keterangan = 'Datang terlambat  ';

                        $kurangJamKerja=0;
                        // var_dump('disini');
                    }
                    elseif ($kurangJamKerja>0 && $kurangJamKerja <= $totalFloatingSeconds && strtotime($jamPulang) < strtotime($JamPulangMinimal)){
                        //Datang terlambat tidak melebihi floating time dan pulang awal
                        $kurangJamKerja += self::get_Second_Diff($jamPulang,$JamPulangMinimal);
                        // $keterangan = 'Datang terlambat tidak melebihi floating time dan pulang lebih awal';
                        $keterangan = 'Datang terlambat   ';

                        $kurangJamKerja = $kurangJamKerja - $totalFloatingSeconds;

                    }
                    elseif ( $kurangJamKerja>0 && $kurangJamKerja > $totalFloatingSeconds && strtotime($jamPulang) > strtotime($JamPulangMinimal))
                    {
                        //Datang terlambat melebihi floating time dan Pulang akhir
                        $kurangJamKerja = $kurangJamKerja - $totalFloatingSeconds;
                        // $keterangan = 'Datang terlambat melebihi floating time dan pulang paling akhir';
                        $keterangan = 'Datang terlambat    ';
                    }
                    elseif ( $kurangJamKerja>0 && $kurangJamKerja <= $totalFloatingSeconds && strtotime($jamPulang) > strtotime($JamPulangMinimal))
                    {
                        //datang terlambat tetapi tidak melebihi floating time dan pulang akhir
                        // $keterangan = 'Datang terlambat tidak melebihi floating time dan pulang akhir';
                        $keterangan = 'Datang terlambat     ';
                        $kurangJamKerja=0;

                    }

                    elseif ($kurangJamKerja==0 && strtotime($jamMasuk)<strtotime($MasterJamMasuk) && strtotime($jamPulang) < strtotime($JamPulangMinimal)){
                        //Datang tepat waktu dan pulang lebih awal
                        $kurangJamKerja += self::get_Second_Diff($jamPulang,$JamPulangMinimal);
                        $keterangan = 'Datang lebih awal dan pulang lebih awal';
                    }
                    elseif ($kurangJamKerja==0 && strtotime($jamMasuk)==strtotime($MasterJamMasuk) && strtotime($jamPulang) < strtotime($JamPulangMinimal)){
                        //Datang tepat waktu dan pulang lebih awal
                        $kurangJamKerja += self::get_Second_Diff($jamPulang,$JamPulangMinimal);
                        $keterangan = 'Datang tepat waktu dan pulang lebih awal';

                    }
                    elseif ( $kurangJamKerja==0 && strtotime($jamMasuk)<strtotime($MasterJamMasuk) && strtotime($jamPulang) > strtotime($JamPulangMinimal))
                    {
                        //datang tepat waktu dan pulang akhir
                        $keterangan = 'Datang lebih awal dan pulang akhir';
                        $kurangJamKerja=0;
                        // var_dump('disini');
                    }
                    elseif ( $kurangJamKerja==0 && strtotime($jamMasuk)==strtotime($MasterJamMasuk) && strtotime($jamPulang) > strtotime($JamPulangMinimal))
                    {
                        //datang tepat waktu dan pulang akhir
                        $keterangan = 'Datang tepat waktu dan pulang akhir';
                        $kurangJamKerja=0;
                        // var_dump('disini');
                    }
                    elseif ( $kurangJamKerja==0 && strtotime($jamMasuk)<strtotime($MasterJamMasuk) && strtotime($jamPulang) == strtotime($JamPulangMinimal))
                    {
                        //datang tepat waktu dan pulang akhir
                        $keterangan = 'Datang lebih awal dan pulang tepat waktu';
                        $kurangJamKerja=0;

                    }
                    else{
                        //Pulang tepat waktu
                        $kurangJamKerja = 0;
                        $keterangan = 'Datang tepat waktu dan pulang tepat waktu';

                    }

                    if ($kurangJamKerja<=0)
                    {
                        $presensi->kekurangan_jam ="00:00:00";
                        $presensi->keterangan = $keterangan;
                    }
                    else
                    {
                        //Jika kekurangan jam kerja melebihi 7.5 maka kekurangan yang diambil adalah 7,5 jam
                        if ($kurangJamKerja>$totalJamKerjaSeconds){
                            $kurangJamKerja=$totalJamKerjaSeconds;
                        }

                        $presensi->kekurangan_jam = self::get_ConvertDateTime($kurangJamKerja);
                        if ( $presensi->status_kehadiran = 'HADIR' &&  $presensi->is_ijin == 0 ){
                            $presensi->keterangan = $keterangan;
                        }
                        var_dump('OK');
                    }

                    $presensi->save();
                    //====================================================================================================================
                }
                elseif (
                    ((!empty($jamMasuk) || $jamMasuk !="00:00:00") && (empty($jamPulang) || $jamPulang =="00:00:00") ||
                    (empty($jamMasuk) || $jamMasuk =="00:00:00") && (!empty($jamPulang) || $jamPulang !="00:00:00"))
                    && $presensi->status_kehadiran == 'HADIR' && $presensi->is_ijin<>0 )
                {
                    //Jika Pegawai hanya melakukan presensi cuma satu saja masuk/pulang maka keterlambatan di set sebagai keterlmbatan maksimal yaitu 7,5 jam
                    $presensi->kekurangan_jam ="07:30:00";
                    $presensi->save();
                }

            }

            return 1;
        }

    }

    public static function get_DataPresensi2() {

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

            $tglPresensi = Carbon::parse($dateTime)->format('Y-m-d');
            $jamPresensi = Carbon::parse($dateTime)->format('H:i:s');

            $dayOfWeekIndex = Carbon::parse($tglPresensi)->format('N');

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
                $IjinTubel = self::get_Tubel($pegawai->no_enroll,$tglPresensi);

                try {
                    $presensi = Presensi::whereDate('tanggal_presensi',  $tglPresensi)->Where('no_enroll',$row->userid)->first();

                    if ($presensi) {

                        $blnUpdate = false;
                        $blnKurangJamTotal = false;
                        $strNote = "";

                        if (!empty($presensi->jam_masuk)) {
                            if (!empty($presensi->jam_pulang)) {
                                if (strtotime($jamPresensi)>strtotime($presensi->jam_masuk)){
                                    $jamPulandDB = strtotime($presensi->jam_pulang);
                                    $jamPulangPresensi = strtotime($jamPresensi);
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

                            }elseif (strtotime($jamPresensi)>strtotime($presensi->jam_masuk)){
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
                            $jamPresensiMasuk = $presensi->jam_masuk;
                            $jamPesensiPulang = $jamPresensi;
                            //===================================================
                            $kurangJamKerja = 0;
                            $kurangSecondAkhir = 0;

                            //====================================================================================
                            // Kalkulasi Jam Masuk dan kekurangan jam kerja
                            //====================================================================================
                            if (strtotime($jamPresensiMasuk)>strtotime($MasterJamMasuk)){
                                //datang terlambat
                                $kurangJamKerja = self::get_Second_Diff($MasterJamMasuk,$jamPresensiMasuk);
                            }

                            $JamPulangMinimal =  Carbon::createFromTimeString($MasterJamPulang);
                            if($kurangJamKerja>0 && $kurangJamKerja > $totalFloatingSeconds){
                                //Kekurangan karena melebihi floating time

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

                            //====================================================================================
                            // Kalkulasi Jam Pulang dan kekurangan jam kerja
                            //====================================================================================
                            // dd($kurangJamKerja . $totalFloatingSeconds . strtotime($jamPesensiPulang) < strtotime($JamPulangMinimal));
                            //Final
                            if ($kurangJamKerja>0 && $kurangJamKerja > $totalFloatingSeconds && strtotime($jamPesensiPulang) < strtotime($JamPulangMinimal)){
                                //Datang terlambat melebihi floating time dan pulang awal
                                $kurangJamKerja += self::get_Second_Diff($jamPesensiPulang,$JamPulangMinimal);
                                $presensi->keterangan = 'Datang terlambat melebihi floating time dan pulang lebih awal';
                                $kurangJamKerja = $kurangJamKerja - $totalFloatingSeconds;

                            }
                            elseif ( $kurangJamKerja>0 && $kurangJamKerja <= $totalFloatingSeconds && strtotime($jamPesensiPulang) == strtotime($JamPulangMinimal))
                            {
                                //datang terlambat tetapi tidak melebihi floating time dan pulang akhir
                                $presensi->keterangan = 'Datang terlambat tidak melebihi floating dan pulang sesuai floating time';
                                $kurangJamKerja=0;
                                // var_dump('disini');
                            }
                            elseif ($kurangJamKerja>0 && $kurangJamKerja <= $totalFloatingSeconds && strtotime($jamPesensiPulang) < strtotime($JamPulangMinimal)){
                                //Datang terlambat tidak melebihi floating time dan pulang awal
                                $kurangJamKerja += self::get_Second_Diff($jamPesensiPulang,$JamPulangMinimal);
                                $presensi->keterangan = 'Datang terlambat tidak melebihi floating time dan pulang lebih awal';
                                $kurangJamKerja = $kurangJamKerja - $totalFloatingSeconds;

                            }
                            elseif ( $kurangJamKerja>0 && $kurangJamKerja > $totalFloatingSeconds && strtotime($jamPesensiPulang) > strtotime($JamPulangMinimal))
                            {
                                //Datang terlambat melebihi floating time dan Pulang akhir
                                $kurangJamKerja = $kurangJamKerja - $totalFloatingSeconds;
                                $presensi->keterangan = 'Datang terlambat melebihi floating time dan pulang paling akhir';

                            }
                            elseif ( $kurangJamKerja>0 && $kurangJamKerja <= $totalFloatingSeconds && strtotime($jamPesensiPulang) > strtotime($JamPulangMinimal))
                            {
                                //datang terlambat tetapi tidak melebihi floating time dan pulang akhir
                                $presensi->keterangan = 'Datang terlambat tidak melebihi floating time dan pulang akhir';
                                $kurangJamKerja=0;

                            }

                            elseif ($kurangJamKerja==0 && strtotime($jamPresensiMasuk)<strtotime($MasterJamMasuk) && strtotime($jamPesensiPulang) < strtotime($JamPulangMinimal)){
                                //Datang tepat waktu dan pulang lebih awal
                                $kurangJamKerja += self::get_Second_Diff($jamPesensiPulang,$JamPulangMinimal);
                                $presensi->keterangan = 'Datang lebih awal dan pulang lebih awal';
                            }
                            elseif ($kurangJamKerja==0 && strtotime($jamPresensiMasuk)==strtotime($MasterJamMasuk) && strtotime($jamPesensiPulang) < strtotime($JamPulangMinimal)){
                                //Datang tepat waktu dan pulang lebih awal
                                $kurangJamKerja += self::get_Second_Diff($jamPesensiPulang,$JamPulangMinimal);
                                $presensi->keterangan = 'Datang tepat waktu dan pulang lebih awal';

                            }
                            elseif ( $kurangJamKerja==0 && strtotime($jamPresensiMasuk)<strtotime($MasterJamMasuk) && strtotime($jamPesensiPulang) > strtotime($JamPulangMinimal))
                            {
                                //datang tepat waktu dan pulang akhir
                                $presensi->keterangan = 'Datang lebih awal dan pulang akhir';
                                $kurangJamKerja=0;
                                // var_dump('disini');
                            }
                            elseif ( $kurangJamKerja==0 && strtotime($jamPresensiMasuk)==strtotime($MasterJamMasuk) && strtotime($jamPesensiPulang) > strtotime($JamPulangMinimal))
                            {
                                //datang tepat waktu dan pulang akhir
                                $presensi->keterangan = 'Datang tepat waktu dan pulang akhir';
                                $kurangJamKerja=0;
                                // var_dump('disini');
                            }
                            elseif ( $kurangJamKerja==0 && strtotime($jamPresensiMasuk)<strtotime($MasterJamMasuk) && strtotime($jamPesensiPulang) == strtotime($JamPulangMinimal))
                            {
                                //datang tepat waktu dan pulang akhir
                                $presensi->keterangan = 'Datang lebih awal dan pulang tepat waktu';
                                $kurangJamKerja=0;

                            }
                            else{
                                //Pulang tepat waktu
                                $kurangJamKerja = 0;
                                $presensi->keterangan = 'Datang tepat waktu dan pulang tepat waktu';

                            }

                            // var_dump($kurangJamKerja);
                            // dd($jamPesensiPulang);
                            //====================================================

                            $presensi->jam_pulang = $jamPresensi;

                            if ($kurangJamKerja==0)
                            {
                                $presensi->kekurangan_jam ="00:00:00";
                            }
                            else
                            {
                                //Jika kekurangan jam kerja melebihi 7.5 maka kekurangan yang diambil adalah 7,5 jam
                                if ($kurangJamKerja>$totalJamKerjaSeconds){
                                    $kurangJamKerja=$totalJamKerjaSeconds;
                                }

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
                            $presensi->tanggal_presensi = $tglPresensi;
                            $presensi->jam_masuk = $jamPresensi;

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

                            $jampresensi = $jamPresensi;

                            if (strtotime($jampresensi)>strtotime($MasterJamMasuk)){

                                $MasterJamPulang = Carbon::createFromTimeString($MasterJamPulang);
                                $kurangSecond = self::get_Second_Diff($MasterJamMasuk,$jampresensi);

                                if($kurangSecond>$totalFloatingSeconds){
                                    $JamPulangMinimal = $MasterJamPulang->addSecond($totalFloatingSeconds);
                                    $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                                    $kurangSecond = $kurangSecond-$totalFloatingSeconds;
                                    $presensi->keterangan = 'Datang terlambat, Estimasi Jam Pulang :' . $JamPulangMinimal . ', Kekurangan Jam Kerja :' . self::get_ConvertDateTime($kurangSecond);

                                }
                                elseif($kurangSecond==$totalFloatingSeconds)
                                {
                                    $JamPulangMinimal = $MasterJamPulang->addSecond($totalFloatingSeconds);
                                    $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                                    $kurangSecond = 0;
                                    $presensi->keterangan = 'Datang terlambat, Estimasi Jam Pulang :' . $JamPulangMinimal;
                                }
                                else
                                {
                                    $JamPulangMinimal = $MasterJamPulang->addSecond($kurangSecond);
                                    $JamPulangMinimal = Carbon::parse($JamPulangMinimal)->format('H:i:s');
                                    $presensi->keterangan = 'Datang terlambat, Estimasi Jam Pulang :' . $JamPulangMinimal;
                                }

                            }
                            elseif (strtotime($jampresensi)==strtotime($MasterJamMasuk))
                            {
                                $presensi->keterangan = 'Datang tepat waktu, Estimasi Jam Pulang :' . $MasterJamPulang;
                            }
                            else
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
                    Log::error("error Data-Presensi :" . $th->getMessage() . "\n=======================================" );
                }
            }
        }

    }
}
