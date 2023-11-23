<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPensiunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pensiun = array(
            array(
                "bkn_id" => "8",
                "nama" => "Pemberhentian Dengan Hormat"),
            array(
                "bkn_id" => "9",
                "nama" => "Pemberhentian Tidak Hormat"),
            array(
                "bkn_id" => "4",
                "nama" => "Non BUP Janda/Duda KPP"),
            array(
                "bkn_id" => "1",
                "nama" => "BUP non KPP"),
            array(
                "bkn_id" => "7",
                "nama" => "Berhenti Atas Permintaan Sendiri"),
            array(
                "bkn_id" => "2",
                "nama" => "BUP KPP"),
            array(
                "bkn_id" => "3",
                "nama" => "Non BUP Janda/Duda non KPP"),
            array(
                "bkn_id" => "5",
                "nama" => "Non BUP Anumerta"),
            array(
                "bkn_id" => "6",
                "nama" => "Non BUP Cacat Karena Dinas"),
            array(
                "bkn_id" => "10",
                "nama" => "Uzur")
        );
        foreach ($pensiun as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('jenis_pensiun')->insert($data);
        }
    }
}
