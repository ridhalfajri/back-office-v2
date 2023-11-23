<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_cuti = [
            ['jenis'=>'Cuti Tahunan','keterangan'=>'12 hari pertahun','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['jenis'=>'Cuti Besar','keterangan'=>'Bisa didapatkan setelah 5 tahun kerja, selama .. hari','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['jenis'=>'Cuti Sakit','keterangan'=>'Bisa didapatkan sesuai dengan anjuran dokter dan didukung oleh bukti dokter','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['jenis'=>'Cuti Melahirkan','keterangan'=>'Bisa didapatkan ketika hamil bagi istri selama 3 bulan atau 2 minggu bagi suami','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['jenis'=>'Cuti Karen Alasan Penting','keterangan'=>'-','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
            ['jenis'=>'Cuti di Luar Tanggungan Negara','keterangan'=>'-','created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')],
        ];
        DB::table('jenis_cuti')->insert($jenis_cuti);
    }
}
