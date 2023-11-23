<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satuan_kerja = [
            ["nama" => "Badan Standardisasi Nasional", "bkn_id" => "A5EB03E24106F6A0E040640A040252AD", "instansi_id" => 59, "created_at"=> date('Y-m-d H:i:s'), "updated_at"=> date('Y-m-d H:i:s')]
        ];
        DB::table('satuan_kerja')->insert($satuan_kerja);
    }
}
