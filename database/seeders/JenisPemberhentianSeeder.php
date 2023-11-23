<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPemberhentianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_pemberhentian = array(
            array(
                "bkn_id" => "1",
                "nama" => "Pemberhentian Karena BUP"),
            array(
                "bkn_id" => "2",
                "nama" => "Pemberhentian Karena Meninggal Dunia"),
            array(
                "bkn_id" => "3",
                "nama" => "Pemberhentian Karena Atas Permintaan Sendiri"),
            array(
                "bkn_id" => "4",
                "nama" => "Pemberhentian Karena Cacat"),
            array(
                "bkn_id" => "5",
                "nama" => "Pemberhentian Karena Keuzuran Jasmani"),
            array(
                "bkn_id" => "6",
                "nama" => "Pemberhentian Karena Tewas"),
            array(
                "bkn_id" => "7",
                "nama" => "Pemberhentian Karena Hukuman Disiplin"),
            array(
                "bkn_id" => "11",
                "nama" => "Pemberhentian Krn Pelanggaran Sumpah/Janji Jabatan"),
            array(
                "bkn_id" => "8",
                "nama" => "Pemberhentian Karena menjadi Anggota Parpol"),
            array(
                "bkn_id" => "9",
                "nama" => "Pemberhentian Karena Penyederhanaan Organisasi"),
            array(
                "bkn_id" => "10",
                "nama" => "Pemberhentian Karena Pelanggaran Sumpah/Janji PNS"),
            array(
                "bkn_id" => "12",
                "nama" => "Pemberhentian Karena Melakukan Tindak Pidana"),
            array(
                "bkn_id" => "13",
                "nama" => "Pemberhentian Karena Meninggalkan Tugas"),
            array(
                "bkn_id" => "14",
                "nama" => "Pemberhentian Karena Dinyatakan Hilang"),
            array(
                "bkn_id" => "15",
                "nama" => "Pemberhentian Krn > 6 Bulan stlh CLTN tdk melapor"),
            array(
                "bkn_id" => "16",
                "nama" => "Pemberhentian Karena Kasus Tipikor")
        );
        foreach ($jenis_pemberhentian as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('jenis_pemberhentian')->insert($data);
        }
    }
}
