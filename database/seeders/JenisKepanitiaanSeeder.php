<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKepanitiaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = array(
            array(
                "bkn_id" => "0",
                "nama" => "Tidak ikut dalam organisasi"),
            array(
                "bkn_id" => "1",
                "nama" => "Politik"),
            array(
                "bkn_id" => "2",
                "nama" => "Ekonomi, termasuk Badan Usaha Negara"),
            array(
                "bkn_id" => "3",
                "nama" => "Sosial"),
            array(
                "bkn_id" => "4",
                "nama" => "Kebudayaan"),
            array(
                "bkn_id" => "5",
                "nama" => "Pendidikan"),
            array(
                "bkn_id" => "6",
                "nama" => "Keagamaan"),
            array(
                "bkn_id" => "7",
                "nama" => "Olah raga"),
            array(
                "bkn_id" => "8",
                "nama" => "Golongan Karya"),
            array(
                "bkn_id" => "9",
                "nama" => "Organisasi Masa"),
            array(
                "bkn_id" => "A",
                "nama" => "Lain - Lain"),
            array(
                "bkn_id" => "B",
                "nama" => "Dharma Wanita"),
            array(
                "bkn_id" => "C",
                "nama" => "KORPRI")
        );
        foreach ($arr as $data)
        {
            $data['created_at'] = date("Y-m-d H:i:s");
            $data['updated_at'] = date("Y-m-d H:i:s");
            DB::table('jenis_kepanitiaan')->insert($data);
        }
    }
}
