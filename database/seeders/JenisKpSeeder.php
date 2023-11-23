<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_kp = array(
            array(
                "bkn_id" => "101",
                "nama" => "Reguler"),
            array(
                "bkn_id" => "201",
                "nama" => "Pilihan  (Jabatan Struktural)"),
            array(
                "bkn_id" => "202",
                "nama" => "Pilihan  (Jabatan Fungsional Tertentu)"),
            array(
                "bkn_id" => "203",
                "nama" => "Pilihan  (Penyesuaian Ijazah)"),
            array(
                "bkn_id" => "204",
                "nama" => "Pilihan  (Sedang Melaksanakan Tugas Belajar)"),
            array(
                "bkn_id" => "205",
                "nama" => "Pilihan  (Setelah Selesai Tugas Belajar)"),
            array(
                "bkn_id" => "206",
                "nama" => "Pilihan  (Diperbantukan/Diperkerjakan Instansi Lain)"),
            array(
                "bkn_id" => "207",
                "nama" => "Pilihan  (Penemuan Baru)"),
            array(
                "bkn_id" => "208",
                "nama" => "Pilihan  (Prestasi Luar Biasa)"),
            array(
                "bkn_id" => "209",
                "nama" => "Pilihan  (Pejabat Negara)"),
            array(
                "bkn_id" => "210",
                "nama" => "Pilihan  (Selama DPK/DPB)"),
            array(
                "bkn_id" => "211",
                "nama" => "Gol. dari Pengadaan CPNS/PNS")
        );
        foreach ($jenis_kp as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('jenis_kp')->insert($data);
        }
    }
}
