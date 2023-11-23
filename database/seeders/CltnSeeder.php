<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CltnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cltn = array(
            array(
                "bkn_id" => "1",
                "nama" => "CLTN"),
            array(
                "bkn_id" => "2",
                "nama" => "Prajurit Wajib"),
            array(
                "bkn_id" => "3",
                "nama" => "Pengaktifan kembali dari CLTN"),
            array(
                "bkn_id" => "4",
                "nama" => "Pengaktifan kembali dari Prajurit Wajib"),
            array(
                "bkn_id" => "5",
                "nama" => "Perpanjangan CLTN"),
            array(
                "bkn_id" => "6",
                "nama" => "Tugas Belajar"),
            array(
                "bkn_id" => "7",
                "nama" => "Perpanjangan Tugas Belajar"),
            array(
                "bkn_id" => "8",
                "nama" => "Pengaktifan dari Tugas Belajar"),
            array(
                "bkn_id" => "9",
                "nama" => "Pejabat Negara"),
            array(
                "bkn_id" => "10",
                "nama" => "Kepala Desa"),
            array(
                "bkn_id" => "11",
                "nama" => "Pengaktifan kembali Pejabat Negara"),
            array(
                "bkn_id" => "12",
                "nama" => "Pengaktifan kembali Kepala Desa")
        );
        foreach ($cltn as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('cltn')->insert($data);
        }
    }
}
