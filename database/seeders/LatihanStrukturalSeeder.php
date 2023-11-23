<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LatihanStrukturalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $latihan = $arr = array(
            array(
                "bkn_id" => "8",
                "nama" => "Diklat Struktural Lainnya"),
            array(
                "bkn_id" => "1",
                "nama" => "SEPADA",
                "eselon_level" => "5"),
            array(
                "bkn_id" => "2",
                "nama" => "SEPALA/ADUM/DIKLAT PIM TK.IV",
                "eselon_level" => "4"),
            array(
                "bkn_id" => "3",
                "nama" => "SEPADYA/SPAMA/DIKLAT PIM TK. III",
                "eselon_level" => "3"),
            array(
                "bkn_id" => "4",
                "nama" => "SPAMEN/SESPA/SESPANAS/DIKLAT PIM TK. II",
                "eselon_level" => "2"),
            array(
                "bkn_id" => "5",
                "nama" => "SEPATI/DIKLAT PIM TK. I",
                "eselon_level" => "1"),
            array(
                "bkn_id" => "6",
                "nama" => "SESPIM"),
            array(
                "bkn_id" => "7",
                "nama" => "SESPATI")
        );
        foreach ($latihan as $data)
        {
            {
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                DB::table('latihan_struktural')->insert($data);
            }
        }
    }
}
