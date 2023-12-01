<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TxTipePegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tx_tipe_pegawai = [
            ["tipe_jabatan" => "Eselon1", "keterangan" => "-", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["tipe_jabatan" => "Eselon2", "keterangan" => "-", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["tipe_jabatan" => "Eselon3", "keterangan" => "-", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["tipe_jabatan" => "Eselon4", "keterangan" => "-", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["tipe_jabatan" => "Kabiro", "keterangan" => "-", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["tipe_jabatan" => "Staff", "keterangan" => "-", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
        ];
        DB::table('tx_tipe_pegawai')->insert($tx_tipe_pegawai);
    }
}
