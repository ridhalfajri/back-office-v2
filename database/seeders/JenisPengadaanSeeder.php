<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPengadaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_pengadaan = array(
            array(
                "bkn_id" => "1",
                "nama" => "UMUM"),
            array(
                "bkn_id" => "2",
                "nama" => "HONORER"),
            array(
                "bkn_id" => "3",
                "nama" => "SEKDES"),
            array(
                "bkn_id" => "4",
                "nama" => "ALIH STATUS"),
            array(
                "bkn_id" => "5",
                "nama" => "KHUSUS DOKTER"),
            array(
                "bkn_id" => "6",
                "nama" => "TENAGA AHLI TERTENTU/KHUSUS"),
            array(
                "bkn_id" => "7",
                "nama" => "KHUSUS SM-3T"),
            array(
                "bkn_id" => "8",
                "nama" => "KHUSUS DISABILITAS"),
            array(
                "bkn_id" => "9",
                "nama" => "KHUSUS PUTRA PUTRI TERBAIK"),
            array(
                "bkn_id" => "A",
                "nama" => "D1 STAN"),
            array(
                "bkn_id" => "B",
                "nama" => "DIASPORA"),
            array(
                "bkn_id" => "C",
                "nama" => "PPPK"),
            array(
                "bkn_id" => "D",
                "nama" => "GURU GARIS DEPAN"),
            array(
                "bkn_id" => "G",
                "nama" => "TENAGA GURU"),
            array(
                "bkn_id" => "I",
                "nama" => "IKATAN DINAS"),
            array(
                "bkn_id" => "K",
                "nama" => "PTT KEMENKES"),
            array(
                "bkn_id" => "L",
                "nama" => "THLTB PENYULUH PERTANIAN"),
            array(
                "bkn_id" => "O",
                "nama" => "UNTUK OLAHRAGAWAN BERPRESTASI DAN PELATIH BERPRESTASI"),
            array(
                "bkn_id" => "P",
                "nama" => "KHUSUS PUTRA/I PAPUA"),
            array(
                "bkn_id" => "S",
                "nama" => "STTD KEMENTRIAN PERHUBUNGAN")
        );
        foreach ($jenis_pengadaan as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('jenis_pengadaan')->insert($data);
        }
    }
}
