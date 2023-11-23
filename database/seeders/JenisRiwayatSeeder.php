<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisRiwayatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_riwayat = array(
            array(
                "bkn_id" => "1",
                "nama" => "DATA UTAMA"),
            array(
                "bkn_id" => "4",
                "nama" => "CPNS/PNS"),
            array(
                "bkn_id" => "5",
                "nama" => "GOLONGAN"),
            array(
                "bkn_id" => "6",
                "nama" => "PMK"),
            array(
                "bkn_id" => "7",
                "nama" => "PENDIDIKAN"),
            array(
                "bkn_id" => "8",
                "nama" => "JABATAN"),
            array(
                "bkn_id" => "9",
                "nama" => "DIKLAT"),
            array(
                "bkn_id" => "10",
                "nama" => "ORANG TUA"),
            array(
                "bkn_id" => "11",
                "nama" => "SUAMI/ISTRI"),
            array(
                "bkn_id" => "12",
                "nama" => "ANAK"),
            array(
                "bkn_id" => "13",
                "nama" => "KURSUS"),
            array(
                "bkn_id" => "14",
                "nama" => "PENGHARGAAN"),
            array(
                "bkn_id" => "15",
                "nama" => "DP3"),
            array(
                "bkn_id" => "16",
                "nama" => "HUKUMAN DISIPLIN"),
            array(
                "bkn_id" => "17",
                "nama" => "PWK"),
            array(
                "bkn_id" => "18",
                "nama" => "PINDAH INSTANSI"),
            array(
                "bkn_id" => "19",
                "nama" => "CLTN"),
            array(
                "bkn_id" => "20",
                "nama" => "PROFESI"),
            array(
                "bkn_id" => "21",
                "nama" => "PNS UNOR"),
            array(
                "bkn_id" => "22",
                "nama" => "PEMBERHENTIAN"),
            array(
                "bkn_id" => "23",
                "nama" => "ANGKA KREDIT"),
            array(
                "bkn_id" => "24",
                "nama" => "PEMBATALAN"),
            array(
                "bkn_id" => "25",
                "nama" => "SKP"),
            array(
                "bkn_id" => "26",
                "nama" => "PROFILE HONORER"),
            array(
                "bkn_id" => "27",
                "nama" => "KONVERSI NIP"),
            array(
                "bkn_id" => "28",
                "nama" => "KESEHATAN")
        );
        foreach ($jenis_riwayat as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('jenis_riwayat')->insert($data);
        }
    }
}
