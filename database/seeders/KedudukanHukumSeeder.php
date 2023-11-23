<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KedudukanHukumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kedudukan_hukum = array(
            array(
                "bkn_id" => "1",
                "nama" => "Aktif"),
            array(
                "bkn_id" => "2",
                "nama" => "CLTN"),
            array(
                "bkn_id" => "3",
                "nama" => "Tugas Belajar"),
            array(
                "bkn_id" => "4",
                "nama" => "Pemberhentian Sementara"),
            array(
                "bkn_id" => "5",
                "nama" => "Penerima Uang Tunggu"),
            array(
                "bkn_id" => "6",
                "nama" => "Prajurit Wajib"),
            array(
                "bkn_id" => "7",
                "nama" => "Pejabat Negara"),
            array(
                "bkn_id" => "8",
                "nama" => "Kepala Desa"),
            array(
                "bkn_id" => "9",
                "nama" => "Sedang dlm Proses Banding BAPEK"),
            array(
                "bkn_id" => "11",
                "nama" => "Pegawai Titipan"),
            array(
                "bkn_id" => "12",
                "nama" => "Pengungsi"),
            array(
                "bkn_id" => "13",
                "nama" => "Perpanjangan CLTN"),
            array(
                "bkn_id" => "14",
                "nama" => "PNS yang dinyatakan hilang"),
            array(
                "bkn_id" => "15",
                "nama" => "PNS kena hukuman disiplin"),
            array(
                "bkn_id" => "16",
                "nama" => "Pemindahan dalam rangka penurunan Jabatan"),
            array(
                "bkn_id" => "20",
                "nama" => "Masa Persiapan Pensiun"),
            array(
                "bkn_id" => "51",
                "nama" => "CPNS yang belum menerima SK CPNS"),
            array(
                "bkn_id" => "52",
                "nama" => "Tidak Aktif"),
            array(
                "bkn_id" => "66",
                "nama" => "Diberhentikan"),
            array(
                "bkn_id" => "67",
                "nama" => "Punah"),
            array(
                "bkn_id" => "68",
                "nama" => "Eks PNS Timor Timur"),
            array(
                "bkn_id" => "69",
                "nama" => "TMS Dari Pengadaan"),
            array(
                "bkn_id" => "70",
                "nama" => "Pembatalan NIP"),
            array(
                "bkn_id" => "77",
                "nama" => "Pemberhentian tanpa hak pensiun"),
            array(
                "bkn_id" => "88",
                "nama" => "Pemberhentian dengan hak pensiun"),
            array(
                "bkn_id" => "89",
                "nama" => "Tidak aktif tetapi diusulkan Pensiun"),
            array(
                "bkn_id" => "90",
                "nama" => "Tidak Ikut PUPNS 2015"),
            array(
                "bkn_id" => "91",
                "nama" => "Tindak Pidana/ Tindak Pidana Jabatan"),
            array(
                "bkn_id" => "92",
                "nama" => "Pemblokiran Data PNS"),
            array(
                "bkn_id" => "98",
                "nama" => "Mencapai BUP"),
            array(
                "bkn_id" => "99",
                "nama" => "Pensiun")
        );
        foreach ($kedudukan_hukum as $data)
        {
            {
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                DB::table('kedudukan_hukum')->insert($data);
            }
        }
    }
}
