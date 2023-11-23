<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendidikan = array(
            array(
                "bkn_id" => "A5EB03E2170EF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SEKOLAH MENENGAH PELAYARAN PERTAMA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E2170FF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "MUALIM PELAYARAN TERBATAS",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E21710F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SEKOLAH PELAUT",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E21712F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SEKOLAH PELAUT MD",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E21713F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SEKOLAH PELAUT MOTOR DIESEL KAPAL",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E21714F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SEKOLAH PELAUT JURU MOTOR",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E21715F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SEKOLAH PELAUT JURU MESIN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E21716F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 3,
                "nama" => "SEKOLAH TEKNIK",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E2197BF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "PERSAMAAN SLTP (PAKET B)",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20ED1F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SLTP UMUM",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20ED2F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SMP",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20ED3F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "MADRASAH TSANAWIYAH",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20ED4F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "TAMAN DEWASA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20ED5F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 3,
                "nama" => "SLTP KEJURUAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20ED6F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 3,
                "nama" => "SMEP",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20ED7F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SMPP",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20ED8F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SKKP",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20ED9F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SKKP UMUM",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20EDAF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SKKP RUMAH TANGGA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20EDBF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SKKP TATALAKSANA RUMAH TANGGA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20EDCF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SKKP MEMASAK",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E20EDEF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 2,
                "nama" => "SKKP TATALAKSANA MAKANAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215B5F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215B6F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMA A.1/FISIKA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215B7F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMA A.2/BIOLOGI",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215B9F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMA A.4/BAHASA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215BAF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "MADRASAH ALIYAH",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215BBF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "MADRASAH ALIYAH A.1/FISIKA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215BCF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "MADRASAH ALIYAH A.2/BIOLOGI",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215BEF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "MADRASAH ALIYAH A.4/BAHASA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215BFF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SLTA KEJURUAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215C0F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SEKOLAH KOPERASI MENENGAH ATAS",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215C1F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "KURSUS PENILIK PERBENDAHARAAN NEGARA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215C2F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SEKOLAH KEPEMIMPINAN ADM PERUSAHAAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215C3F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "KPAA/KKPA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215C4F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SEKOLAH MENENGAH EKONOMI ATAS",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215C5F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA TATA USAHA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215C7F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA TATA KESEKRETARIATAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215C9F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA TATA PERUSAHAAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215CAF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA TATA BUKU",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215CBF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA TATA LAKSANA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215CCF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA TATA PERSURATAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215CDF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA KESEKRETARIATAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215CEF6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA KOPERASI",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215D0F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA ADMINISTRASI",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215D1F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA ADMINISTRASI PERKANTORAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215D3F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA KEUANGAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215D4F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA PERDAGANGAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215D5F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SMEA PERKANTORAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215D6F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SKKA TATA BOGA",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215D7F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SKKA TATA LAKSANA MAKANAN",
                "status" => 1),
            array(
                "bkn_id" => "A5EB03E215D8F6A0E040640A040252AD",
                "tingkat_pendidikan_id" => 4,
                "nama" => "SKKA MASAK",
                "status" => 1)
        );
        foreach ($pendidikan as $data)
        {
            {
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                DB::table('pendidikan')->insert($data);
            }
        }
    }
}
