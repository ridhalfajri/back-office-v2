<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EselonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eselon = array(
            array(
                "bkn_id" => "10",
                "nama" => "I.a",
                "jabatan_asn" => "JPT UTAMA"),
            array(
                "bkn_id" => "11",
                "nama" => "I.a",
                "jabatan_asn" => "JPT MADYA"),
            array(
                "bkn_id" => "12",
                "nama" => "I.b",
                "jabatan_asn" => "JPT MADYA"),
            array(
                "bkn_id" => "21",
                "nama" => "II.a",
                "jabatan_asn" => "JPT PRATAMA"),
            array(
                "bkn_id" => "22",
                "nama" => "II.b",
                "jabatan_asn" => "JPT PRATAMA"),
            array(
                "bkn_id" => "31",
                "nama" => "III.a",
                "jabatan_asn" => "ADMINISTRATOR"),
            array(
                "bkn_id" => "32",
                "nama" => "III.b",
                "jabatan_asn" => "ADMINISTRATOR"),
            array(
                "bkn_id" => "41",
                "nama" => "IV.a",
                "jabatan_asn" => "PENGAWAS"),
            array(
                "bkn_id" => "42",
                "nama" => "IV.b",
                "jabatan_asn" => "PENGAWAS"),
            array(
                "bkn_id" => "51",
                "nama" => "V.a"),
            array(
                "bkn_id" => "52",
                "nama" => "V.b"),
            array(
                "bkn_id" => "99",
                "nama" => "NON")
        );
        foreach ($eselon as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('eselon')->insert($data);
        }
    }
}
