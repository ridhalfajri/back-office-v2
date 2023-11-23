<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agama = [
            ["nama"=>"Islam", "bkn_id"=>"1", "created_at"=> date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["nama"=>"Kristen", "bkn_id"=>"2" , "created_at"=> date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["nama"=>"Katholik", "bkn_id"=>"3", "created_at"=> date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["nama"=>"Hindu", "bkn_id"=>"4", "created_at"=> date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["nama"=>"Budha", "bkn_id"=>"5", "created_at"=> date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["nama"=>"Konghucu", "bkn_id"=>"6", "created_at"=> date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["nama"=>"Lainnya", "bkn_id"=>"7", "created_at"=> date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')]
        ];
        DB::table('agama')->insert($agama);
    }
}
