<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisHukumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_hukuman = array(
            array(
                "bkn_id" => "1",
                "nama" => "TEGURAN LISAN",
                "jenis_tingkat_hukuman" => "R"),
            array(
                "bkn_id" => "2",
                "nama" => "TEGURAN TERTULIS",
                "jenis_tingkat_hukuman" => "R"),
            array(
                "bkn_id" => "3",
                "nama" => "PERNYATAAN TIDAK PUAS SECARA TERTULIS",
                "jenis_tingkat_hukuman" => "R"),
            array(
                "bkn_id" => "4",
                "nama" => "PENUNDAAN KGB SELAMA 1 THN",
                "jenis_tingkat_hukuman" => "S"),
            array(
                "bkn_id" => "5",
                "nama" => "PENURUNAN GAJI MAX 1 TH",
                "jenis_tingkat_hukuman" => "S"),
            array(
                "bkn_id" => "6",
                "nama" => "PENUNDAAN GAJI MAX 1 THN",
                "jenis_tingkat_hukuman" => "S"),
            array(
                "bkn_id" => "7",
                "nama" => "PENUNDAAN KP SELAMA 1 THN",
                "jenis_tingkat_hukuman" => "S"),
            array(
                "bkn_id" => "8",
                "nama" => "PENURUNAN PANGKAT 1 TINGKAT 1 THN",
                "jenis_tingkat_hukuman" => "S"),
            array(
                "bkn_id" => "9",
                "nama" => "PEMBEBASAN DARI JABATAN",
                "jenis_tingkat_hukuman" => "B"),
            array(
                "bkn_id" => "10",
                "nama" => "PEMBERHENTIAN DENGAN HORMAT TIDAK ATAS PERMINTAAN SENDIRI",
                "jenis_tingkat_hukuman" => "B"),
            array(
                "bkn_id" => "11",
                "nama" => "PEMBERHENTIAN TIDAK DENGAN HORMAT SEBAGAI PNS",
                "jenis_tingkat_hukuman" => "B"),
            array(
                "bkn_id" => "12",
                "nama" => "PENGAKTIFAN HUKUMAN DISIPLIN",
                "jenis_tingkat_hukuman" => "B"),
            array(
                "bkn_id" => "13",
                "nama" => "PEMINDAHAN DLM RANGKA PENURUNAN JABATAN 1 TINGKAT",
                "jenis_tingkat_hukuman" => "B"),
            array(
                "bkn_id" => "14",
                "nama" => "PENURUNAN PANGKAT 1 TINGKAT 3 THN",
                "jenis_tingkat_hukuman" => "B"),
            array(
                "bkn_id" => "21",
                "nama" => "SANKSI MORAL TERBUKA",
                "jenis_tingkat_hukuman" => "R"),
            array(
                "bkn_id" => "22",
                "nama" => "SANKSI MORAL TERTUTUP",
                "jenis_tingkat_hukuman" => "R"),
            array(
                "bkn_id" => "23",
                "nama" => "PEMOTONGAN TUNKIN 25% 6 BLN",
                "jenis_tingkat_hukuman" => "S"),
            array(
                "bkn_id" => "24",
                "nama" => "PEMOTONGAN TUNKIN 25% 9 BLN",
                "jenis_tingkat_hukuman" => "S"),
            array(
                "bkn_id" => "25",
                "nama" => "PEMOTONGAN TUNKIN 25% 12 BLN",
                "jenis_tingkat_hukuman" => "S"),
            array(
                "bkn_id" => "27",
                "nama" => "PENURUNAN DARI JABATAN SETINGKAT LEBIH RENDAH SELAMA 12 BLN",
                "jenis_tingkat_hukuman" => "B"),
            array(
                "bkn_id" => "28",
                "nama" => "PEMBEBASAN DARI JABATAN MENJADI PELAKSANA SELAMA 12 BLN",
                "jenis_tingkat_hukuman" => "B")
        );
        foreach ($jenis_hukuman as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('jenis_hukuman')->insert($data);
        }
    }
}
