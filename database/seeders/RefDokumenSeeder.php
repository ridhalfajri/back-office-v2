<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RefDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ref_dokumen = [
            [
                "bkn_id" => "1179",
                "detail_layanan_nama" => "Riwayat Kinerja",
                "document" => "Dokumen Evaluasi Kinerja",
                "file_type" => "PDF",
                "mandatory" => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                "bkn_id" => "890",
                "detail_layanan_nama" => "Riwayat Kinerja",
                "document" => "Dokumen Evaluasi Kinerja",
                "file_type" => "PDF",
                "mandatory" => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                "bkn_id" => "874",
                "detail_layanan_nama" => "Riwayat Diklat",
                "document" => "Dok Sertifikat Diklat",
                "file_type" => "PDF",
                "mandatory" => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                "bkn_id" => "879",
                "detail_layanan_nama" => "Riwayat Angka Kredit",
                "document" => "Dok PAK",
                "file_type" => "PDF",
                "mandatory" => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                "bkn_id" => "880",
                "detail_layanan_nama" => "Riwayat Angka Kredit",
                "document" => "SK PAK",
                "file_type" => "PDF",
                "mandatory" => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                "bkn_id" => "891",
                "detail_layanan_nama" => "Riwayat SKP",
                "document" => "Dok Realisasi SKP",
                "file_type" => "PDF",
                "mandatory" => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                "bkn_id" => "881",
                "detail_layanan_nama" => "Riwayat Kursus",
                "document" => "Dok Sertifikat Kursus",
                "file_type" => "PDF",
                "mandatory" => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                "bkn_id" => "882",
                "detail_layanan_nama" => "Hukuman Disiplin",
                "document" => "Dok SK Hukuman Disiplin",
                "file_type" => "PDF",
                "mandatory" => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                "bkn_id" => "872",
                "detail_layanan_nama" => "Riwayat Jabatan",
                "document" => "Dok SK Jabatan",
                "file_type" => "PDF",
                "mandatory" => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                "bkn_id" => "873",
                "detail_layanan_nama" => "Riwayat Jabatan",
                "document" => "Dok Surat Pelantikan",
                "file_type" => "PDF",
                "mandatory" => false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];
        DB::table('ref_dokumen')->insert($ref_dokumen);
    }
}
