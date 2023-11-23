<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golongan = array(
            array(
                "bkn_id" => "11",
                "nama" => "I/a",
                "nama_pangkat" => "Juru Muda"),
            array(
                "bkn_id" => "12",
                "nama" => "I/b",
                "nama_pangkat" => "Juru Muda Tingkat I"),
            array(
                "bkn_id" => "13",
                "nama" => "I/c",
                "nama_pangkat" => "Juru"),
            array(
                "bkn_id" => "14",
                "nama" => "I/d",
                "nama_pangkat" => "Juru Tingkat I"),
            array(
                "bkn_id" => "21",
                "nama" => "II/a",
                "nama_pangkat" => "Pengatur Muda"),
            array(
                "bkn_id" => "22",
                "nama" => "II/b",
                "nama_pangkat" => "Pengatur Muda Tingkat I"),
            array(
                "bkn_id" => "23",
                "nama" => "II/c",
                "nama_pangkat" => "Pengatur"),
            array(
                "bkn_id" => "24",
                "nama" => "II/d",
                "nama_pangkat" => "Pengatur Tingkat I"),
            array(
                "bkn_id" => "31",
                "nama" => "III/a",
                "nama_pangkat" => "Penata Muda"),
            array(
                "bkn_id" => "32",
                "nama" => "III/b",
                "nama_pangkat" => "Penata Muda Tingkat I"),
            array(
                "bkn_id" => "33",
                "nama" => "III/c",
                "nama_pangkat" => "Penata"),
            array(
                "bkn_id" => "34",
                "nama" => "III/d",
                "nama_pangkat" => "Penata Tingkat I"),
            array(
                "bkn_id" => "41",
                "nama" => "IV/a",
                "nama_pangkat" => "Pembina"),
            array(
                "bkn_id" => "42",
                "nama" => "IV/b",
                "nama_pangkat" => "Pembina Tingkat I"),
            array(
                "bkn_id" => "43",
                "nama" => "IV/c",
                "nama_pangkat" => "Pembina Utama Muda"),
            array(
                "bkn_id" => "44",
                "nama" => "IV/d",
                "nama_pangkat" => "Pembina Utama Madya"),
            array(
                "bkn_id" => "45",
                "nama" => "IV/e",
                "nama_pangkat" => "Pembina Utama")
        );
        foreach ($golongan as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('golongan')->insert($data);
        }
    }
}
