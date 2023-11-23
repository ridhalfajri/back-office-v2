<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisUnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_unit = array(
            array(
                "id" => 1,
                "nama" => "kepala Badan"),
            array(
                "id" => 2,
                "nama" => "kedeputian"),
            array(
                "id" => 3,
                "nama" => "pusat_biro"),
            array(
                "id" => 4,
                "nama" => "bidang"),
            array(
                "id" => 5,
                "nama" => "sub_bidang"),
            array(
                "id" => 7,
                "nama" => "lainnya")
        );
        foreach ($jenis_unit as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('jenis_unit_kerja')->insert($data);
        }
    }
}
