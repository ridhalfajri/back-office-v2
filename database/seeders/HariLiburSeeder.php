<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HariLiburSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hari_libur = [
            [
                "tahun"=>'2023',
                "tanggal" => "2023-12-25",
                "keterangan" => "Hari Raya Natal",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-12-16",
                "keterangan" => "Hari Saraswati",
                "is_libur" => false
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-09-28",
                "keterangan" => "Maulid Nabi Muhammad SAW",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-08-17",
                "keterangan" => "Hari Proklamasi Kemerdekaan RI",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-08-12",
                "keterangan" => "Hari Raya Kuningan",
                "is_libur" => false
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-08-3",
                "keterangan" => "Umanis Galungan",
                "is_libur" => false
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-08-2",
                "keterangan" => "Hari Raya Galungan",
                "is_libur" => false
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-08-1",
                "keterangan" => "Penampahan Galungan",
                "is_libur" => false
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-07-19",
                "keterangan" => "Tahun Baru Islam 1445 Hijriyah",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-06-29",
                "keterangan" => "Hari Raya Idul Adha 1444 Hijriyah",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-06-4",
                "keterangan" => "Hari Raya Waisak 2567",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-06-1",
                "keterangan" => "Hari Lahirnya Pancasila",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-05-20",
                "keterangan" => "Hari Saraswati",
                "is_libur" => false
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-05-18",
                "keterangan" => "Kenaikan Isa Al Masih",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-05-1",
                "keterangan" => "Hari Buruh Internasional",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-04-23",
                "keterangan" => "Hari Raya Idul Fitri 1444 Hijriyah",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-04-22",
                "keterangan" => "Hari Raya Idul Fitri 1444 Hijriyah",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-04-7",
                "keterangan" => "Wafat Isa Al Masih",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-03-22",
                "keterangan" => "Hari Raya Nyepi",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-02-18",
                "keterangan" => "Isra Mikraj Nabi Muhammad SAW",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-01-22",
                "keterangan" => "Tahun Baru Imlek 2574 Kongzili",
                "is_libur" => true
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-01-20",
                "keterangan" => "Hari Siwa Ratri",
                "is_libur" => false
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-01-14",
                "keterangan" => "Hari Raya Kuningan",
                "is_libur" => false
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-01-5",
                "keterangan" => "Umanis Galungan",
                "is_libur" => false
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-01-4",
                "keterangan" => "Hari Raya Galungan",
                "is_libur" => false
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-01-3",
                "keterangan" => "Penampahan Galungan",
                "is_libur" => false
            ],
            [
                "tahun"=>'2023',
                "tanggal" => "2023-01-1",
                "keterangan" => "Tahun Baru Masehi",
                "is_libur" => true
            ]
        ];
        DB::table('hari_libur')->insert($hari_libur);
    }
}
