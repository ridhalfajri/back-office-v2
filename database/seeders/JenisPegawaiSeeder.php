<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_pegawai  = $arr = array(
            array(
                "bkn_id" => 1,
                "nama" => "PNS Pusat yang bekerja pada Departemen/Lembaga"),
            array(
                "bkn_id" => 2,
                "nama" => "PNS Pusat DPB pada Instansi lain"),
            array(
                "bkn_id" => 3,
                "nama" => "PNS Pusat DPK pada Instansi lain"),
            array(
                "bkn_id" => 4,
                "nama" => "PNS Pusat DPB pada Pemerintah Propinsi"),
            array(
                "bkn_id" => 5,
                "nama" => "PNS Pusat DPK pada Pemerintah Propinsi"),
            array(
                "bkn_id" => 6,
                "nama" => "PNS Pusat DPB pada Pemerintah Kabupaten/Kota"),
            array(
                "bkn_id" => 7,
                "nama" => "PNS Pusat DPK pada Pemerintah Kabupaten/Kota"),
            array(
                "bkn_id" => 8,
                "nama" => "PNS Pusat DPB pada BUMN/Badan lain"),
            array(
                "bkn_id" => 9,
                "nama" => "PNS Pusat DPK pada BUMN/Badan lain"),
            array(
                "bkn_id" => 10,
                "nama" => "PNS Daerah Propinsi yang bekerja pada Propinsi"),
            array(
                "bkn_id" => 11,
                "nama" => "PNS Daerah Propinsi DPB pada Instansi lain"),
            array(
                "bkn_id" => 12,
                "nama" => "PNS Daerah Propinsi DPK pada Instansi lain"),
            array(
                "bkn_id" => 13,
                "nama" => "PNS Daerah Propinsi DPB pada BUMN/BUMD"),
            array(
                "bkn_id" => 14,
                "nama" => "PNS Daerah Propinsi DPK pada BUMN/BUMD"),
            array(
                "bkn_id" => 15,
                "nama" => "PNS Daerah Kab./Kota yang bekerja pada Kab./Kota"),
            array(
                "bkn_id" => 16,
                "nama" => "PNS Daerah Kab./Kota DPB pada Instansi lain"),
            array(
                "bkn_id" => 17,
                "nama" => "PNS Daerah Kab./Kota DPK pada Instansi lain"),
            array(
                "bkn_id" => 18,
                "nama" => "PNS Daerah Kab./Kota DPB pada BUMN/BUMD"),
            array(
                "bkn_id" => 19,
                "nama" => "PNS Daerah Kab./Kota DPK pada BUMN/BUMD")
        );
        foreach ($jenis_pegawai as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('jenis_pegawai')->insert($data);
        }
    }
}
