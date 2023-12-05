<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrePotonganTukinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pre_potongan_tukin = [
            ["keterlambatan" => "TL1", "lama_waktu_keterlambatan" => Carbon::createFromFormat('H:i:s', '00:31:00'), "prosentase_pemotongan" => 0.005, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["keterlambatan" => "TL2", "lama_waktu_keterlambatan" => Carbon::createFromFormat('H:i:s', '01:01:00'), "prosentase_pemotongan" => 0.01, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["keterlambatan" => "TL3", "lama_waktu_keterlambatan" => Carbon::createFromFormat('H:i:s', '01:31:00'), "prosentase_pemotongan" => 0.015, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["keterlambatan" => "TL4", "lama_waktu_keterlambatan" => Carbon::createFromFormat('H:i:s', '07:30:00'), "prosentase_pemotongan" => 0.025, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["keterlambatan" => "A", "lama_waktu_keterlambatan" => null, "prosentase_pemotongan" => 0.05, "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],

        ];
        DB::table('pre_potongan_tukin')->insert($pre_potongan_tukin);
    }
}
