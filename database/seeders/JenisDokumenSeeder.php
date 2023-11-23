<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_dokumen = [
            ["nama"=>"Kartu Tanda Penduduk" ,"bkn_id"=>"1", "created_at"=>date('Y-m-d H:i:s'),"updated_at"=>date('Y-m-d H:i:s')],
            ["nama"=>"Pasport" ,"bkn_id"=>"2", "created_at"=>date('Y-m-d H:i:s'),"updated_at"=>date('Y-m-d H:i:s')],
            ["nama"=>"Surat Izin Mengemudi" ,"bkn_id"=>"3", "created_at"=>date('Y-m-d H:i:s'),"updated_at"=>date('Y-m-d H:i:s')]
        ];
        DB::table('jenis_dokumen')->insert($jenis_dokumen);
    }
}
