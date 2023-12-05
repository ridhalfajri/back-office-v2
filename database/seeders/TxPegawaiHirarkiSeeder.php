<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TxPegawaiHirarkiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tx_hirarki_pegawai = [
            ["pegawai_id" => "197", "pegawai_pimpinan_id" => "154", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["pegawai_id" => "493", "pegawai_pimpinan_id" => "197", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["pegawai_id" => "570", "pegawai_pimpinan_id" => "154", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["pegawai_id" => "590", "pegawai_pimpinan_id" => "197", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
        ];
        DB::table('tx_hirarki_pegawai')->insert($tx_hirarki_pegawai);
    }
}
