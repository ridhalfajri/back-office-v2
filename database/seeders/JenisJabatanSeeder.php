<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_jabatan = [
            ["nama"=>"Jabatan Struktural","bkn_id"=>"1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["nama"=>"Jabatan Fungsional Tertentu","bkn_id"=>"2", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["nama"=>"Jabatan Rangkap (Struktural dan Fungsional)","bkn_id"=>"3", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["nama"=>"Jabatan Fungsional Umum","bkn_id"=>"4", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
        ];
        DB::table('jenis_jabatan')->insert($jenis_jabatan);
    }
}
