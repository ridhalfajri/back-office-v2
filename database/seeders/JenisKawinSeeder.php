<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKawinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_kawin = [
            ["nama"=>"Menikah","bkn_id"=>"1","created_at" =>date("Y-m-d H:i:s"),"updated_at" =>date("Y-m-d H:i:s")],
            ["nama"=>"Cerai","bkn_id"=>"2","created_at" =>date("Y-m-d H:i:s"),"updated_at" =>date("Y-m-d H:i:s")],
            ["nama"=>"Janda / Duda","bkn_id"=>"3","created_at" =>date("Y-m-d H:i:s"),"updated_at" =>date("Y-m-d H:i:s")],
            ["nama"=>"Belum Kawin","bkn_id"=>"4","created_at" =>date("Y-m-d H:i:s"),"updated_at" =>date("Y-m-d H:i:s")],
        ];
        DB::table('jenis_kawin')->insert($jenis_kawin);
    }
}
