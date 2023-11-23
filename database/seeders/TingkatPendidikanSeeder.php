<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TingkatPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tk_pendidikan = array(
            array(
                "bkn_id" => "5",
                "nama" => "Sekolah Dasar",
                "group_tk_pend_nm" => "SD/MI"),
            array(
                "bkn_id" => "10",
                "nama" => "SLTP",
                "group_tk_pend_nm" => "SLTP/MTs"),
            array(
                "bkn_id" => "12",
                "nama" => "SLTP Kejuruan",
                "group_tk_pend_nm" => "SLTP/MTs"),
            array(
                "bkn_id" => "15",
                "nama" => "SLTA",
                "group_tk_pend_nm" => "SLTA/SMK/MA/D-I"),
            array(
                "bkn_id" => "17",
                "nama" => "SLTA Kejuruan",
                "group_tk_pend_nm" => "SLTA/SMK/MA/D-I"),
            array(
                "bkn_id" => "18",
                "nama" => "SLTA Keguruan",
                "group_tk_pend_nm" => "SLTA/SMK/MA/D-I"),
            array(
                "bkn_id" => "20",
                "nama" => "Diploma I",
                "group_tk_pend_nm" => "SLTA/SMK/MA/D-I"),
            array(
                "bkn_id" => "25",
                "nama" => "Diploma II",
                "group_tk_pend_nm" => "D-II"),
            array(
                "bkn_id" => "30",
                "nama" => "Diploma III/Sarjana Muda",
                "group_tk_pend_nm" => "D-III"),
            array(
                "bkn_id" => "35",
                "nama" => "Diploma IV",
                "group_tk_pend_nm" => "S-1/D-IV"),
            array(
                "bkn_id" => "40",
                "nama" => "S-1/Sarjana",
                "group_tk_pend_nm" => "S-1/D-IV"),
            array(
                "bkn_id" => "45",
                "nama" => "S-2",
                "group_tk_pend_nm" => "S-2"),
            array(
                "bkn_id" => "50",
                "nama" => "S-3/Doktor",
                "group_tk_pend_nm" => "S-3")
        );
        foreach ($tk_pendidikan as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('tingkat_pendidikan')->insert($data);
        }
    }
}
