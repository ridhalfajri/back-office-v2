<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaspenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taspen = array(
            array(
                "bkn_id" => "0",
                "ktua_id" => "A5EB03E21EF0F6A0E040640A040252AD",
                "nama" => "Kantor Pusat"),
            array(
                "bkn_id" => "1",
                "ktua_id" => "A5EB03E21EF4F6A0E040640A040252AD",
                "nama" => "Malang"),
            array(
                "bkn_id" => "5",
                "ktua_id" => "A5EB03E21EF1F6A0E040640A040252AD",
                "nama" => "Bekasi"),
            array(
                "bkn_id" => "6",
                "ktua_id" => "A5EB03E21EF1F6A0E040640A040252AD",
                "nama" => "Depok"),
            array(
                "bkn_id" => "100",
                "ktua_id" => "A5EB03E21EF0F6A0E040640A040252AD",
                "nama" => "Jakarta"),
            array(
                "bkn_id" => "101",
                "ktua_id" => "A5EB03E21EEFF6A0E040640A040252AD",
                "nama" => "Bandar Lampung"),
            array(
                "bkn_id" => "102",
                "ktua_id" => "A5EB03E21EEEF6A0E040640A040252AD",
                "nama" => "Bengkulu"),
            array(
                "bkn_id" => "103",
                "ktua_id" => "A5EB03E21EEDF6A0E040640A040252AD",
                "nama" => "Palembang"),
            array(
                "bkn_id" => "104",
                "ktua_id" => "A5EB03E21EF6F6A0E040640A040252AD",
                "nama" => "Palangkaraya"),
            array(
                "bkn_id" => "105",
                "ktua_id" => "A5EB03E21EF5F6A0E040640A040252AD",
                "nama" => "Pontianak"),
            array(
                "bkn_id" => "106",
                "ktua_id" => "A5EB03E21F02F6A0E040640A040252AD",
                "nama" => "Pangkal Pinang"),
            array(
                "bkn_id" => "107",
                "ktua_id" => "ff8080813196bb4c0131999452280b5b",
                "nama" => "Tangerang"),
            array(
                "bkn_id" => "108",
                "ktua_id" => "A5EB03E21EF1F6A0E040640A040252AD",
                "nama" => "Tangerang Selatan"),
            array(
                "bkn_id" => "111",
                "ktua_id" => "A5EB03E21EF0F6A0E040640A040252AD",
                "nama" => "."),
            array(
                "bkn_id" => "200",
                "ktua_id" => "A5EB03E21EE9F6A0E040640A040252AD",
                "nama" => "Medan"),
            array(
                "bkn_id" => "201",
                "ktua_id" => "A5EB03E21EE8F6A0E040640A040252AD",
                "nama" => "Banda Aceh"),
            array(
                "bkn_id" => "202",
                "ktua_id" => "A5EB03E21EEDF6A0E040640A040252AD",
                "nama" => "Lubuk Linggau"),
            array(
                "bkn_id" => "203",
                "ktua_id" => "A5EB03E21EEAF6A0E040640A040252AD",
                "nama" => "Bukittinggi"),
            array(
                "bkn_id" => "204",
                "ktua_id" => "A5EB03E21EEAF6A0E040640A040252AD",
                "nama" => "Padang"),
            array(
                "bkn_id" => "205",
                "ktua_id" => "A5EB03E21EEBF6A0E040640A040252AD",
                "nama" => "Pekanbaru"),
            array(
                "bkn_id" => "206",
                "ktua_id" => "A5EB03E21EECF6A0E040640A040252AD",
                "nama" => "Jambi"),
            array(
                "bkn_id" => "207",
                "ktua_id" => "ff80808134f5f9b30134fa16928d52f5",
                "nama" => "Tanjung Pinang"),
            array(
                "bkn_id" => "208",
                "ktua_id" => "A5EB03E21EE9F6A0E040640A040252AD",
                "nama" => "Pematang Siantar"),
            array(
                "bkn_id" => "300",
                "ktua_id" => "A5EB03E21EF1F6A0E040640A040252AD",
                "nama" => "Bandung"),
            array(
                "bkn_id" => "301",
                "ktua_id" => "A5EB03E21EF1F6A0E040640A040252AD",
                "nama" => "Bogor"),
            array(
                "bkn_id" => "302",
                "ktua_id" => "A5EB03E21EF1F6A0E040640A040252AD",
                "nama" => "Tasikmalaya"),
            array(
                "bkn_id" => "303",
                "ktua_id" => "A5EB03E21EF1F6A0E040640A040252AD",
                "nama" => "Cirebon"),
            array(
                "bkn_id" => "304",
                "ktua_id" => "A5EB03E21EF1F6A0E040640A040252AD",
                "nama" => "Serang"),
            array(
                "bkn_id" => "400",
                "ktua_id" => "A5EB03E21EF3F6A0E040640A040252AD",
                "nama" => "Semarang"),
            array(
                "bkn_id" => "401",
                "ktua_id" => "A5EB03E21EF3F6A0E040640A040252AD",
                "nama" => "Purwokerto"),
            array(
                "bkn_id" => "402",
                "ktua_id" => "A5EB03E21EF3F6A0E040640A040252AD",
                "nama" => "Surakarta"),
            array(
                "bkn_id" => "403",
                "ktua_id" => "A5EB03E21EF2F6A0E040640A040252AD",
                "nama" => "Yogyakarta"),
            array(
                "bkn_id" => "404",
                "ktua_id" => "A5EB03E21EF3F6A0E040640A040252AD",
                "nama" => "Pekalongan"),
            array(
                "bkn_id" => "500",
                "ktua_id" => "A5EB03E21EF4F6A0E040640A040252AD",
                "nama" => "Surabaya"),
            array(
                "bkn_id" => "501",
                "ktua_id" => "A5EB03E21EF4F6A0E040640A040252AD",
                "nama" => "Malang"),
            array(
                "bkn_id" => "502",
                "ktua_id" => "A5EB03E21EF4F6A0E040640A040252AD",
                "nama" => "Madiun"),
            array(
                "bkn_id" => "503",
                "ktua_id" => "A5EB03E21EF4F6A0E040640A040252AD",
                "nama" => "Kediri"),
            array(
                "bkn_id" => "504",
                "ktua_id" => "A5EB03E21EF7F6A0E040640A040252AD",
                "nama" => "Banjarmasin"),
            array(
                "bkn_id" => "505",
                "ktua_id" => "A5EB03E21EF8F6A0E040640A040252AD",
                "nama" => "Samarinda"),
            array(
                "bkn_id" => "60",
                "ktua_id" => "A5EB03E21EFBF6A0E040640A040252AD",
                "nama" => "Mamuju (lama)"),
            array(
                "bkn_id" => "600",
                "ktua_id" => "A5EB03E21EFBF6A0E040640A040252AD",
                "nama" => "Makassar"),
            array(
                "bkn_id" => "601",
                "ktua_id" => "A5EB03E21EF9F6A0E040640A040252AD",
                "nama" => "Manado"),
            array(
                "bkn_id" => "602",
                "ktua_id" => "A5EB03E21EFAF6A0E040640A040252AD",
                "nama" => "Palu"),
            array(
                "bkn_id" => "603",
                "ktua_id" => "A5EB03E21EFCF6A0E040640A040252AD",
                "nama" => "Kendari"),
            array(
                "bkn_id" => "604",
                "ktua_id" => "A5EB03E21F00F6A0E040640A040252AD",
                "nama" => "Ambon"),
            array(
                "bkn_id" => "605",
                "ktua_id" => "A5EB03E21F01F6A0E040640A040252AD",
                "nama" => "Jayapura"),
            array(
                "bkn_id" => "606",
                "ktua_id" => "A5EB03E21EE8F6A0E040640A040252AD",
                "nama" => "Gorontalo"),
            array(
                "bkn_id" => "607",
                "ktua_id" => "A5EB03E21EE8F6A0E040640A040252AD",
                "nama" => "Ternate"),
            array(
                "bkn_id" => "608",
                "ktua_id" => "A5EB03E21EFBF6A0E040640A040252AD",
                "nama" => "Mamuju"),
            array(
                "bkn_id" => "609",
                "ktua_id" => "A5EB03E21F01F6A0E040640A040252AD",
                "nama" => "Manokwari"),
            array(
                "bkn_id" => "610",
                "ktua_id" => "A5EB03E21EFBF6A0E040640A040252AD",
                "nama" => "Kolaka"),
            array(
                "bkn_id" => "611",
                "ktua_id" => "A5EB03E21EFBF6A0E040640A040252AD",
                "nama" => "Bone"),
            array(
                "bkn_id" => "612",
                "ktua_id" => "A5EB03E21EFBF6A0E040640A040252AD",
                "nama" => "Palopo"),
            array(
                "bkn_id" => "700",
                "ktua_id" => "A5EB03E21EFDF6A0E040640A040252AD",
                "nama" => "Denpasar"),
            array(
                "bkn_id" => "701",
                "ktua_id" => "A5EB03E21EFFF6A0E040640A040252AD",
                "nama" => "Kupang"),
            array(
                "bkn_id" => "703",
                "ktua_id" => "A5EB03E21EFEF6A0E040640A040252AD",
                "nama" => "Mataram"),
            array(
                "bkn_id" => "704",
                "ktua_id" => "A5EB03E21EF4F6A0E040640A040252AD",
                "nama" => "Jember"),
            array(
                "bkn_id" => "705",
                "ktua_id" => "A5EB03E21EE8F6A0E040640A040252AD",
                "nama" => "PT ASABRI"),
            array(
                "bkn_id" => "706",
                "ktua_id" => "ff8080813ef4d8b6013ef99ec862000d",
                "nama" => "Sorong"),
            array(
                "bkn_id" => "707",
                "ktua_id" => "A5EB03E21EF7F6A0E040640A040252AD",
                "nama" => "Tarakan"),
            array(
                "bkn_id" => "708",
                "ktua_id" => "A5EB03E21EE8F6A0E040640A040252AD",
                "nama" => "Lhokseumawe"),
            array(
                "bkn_id" => "709",
                "ktua_id" => "ff80808154dda4bf0154e0a0b6867f05",
                "nama" => "Ende"),
            array(
                "bkn_id" => "710",
                "ktua_id" => "A5EB03E21EEAF6A0E040640A040252AD",
                "nama" => "Lubuk Linggau"),
            array(
                "bkn_id" => "711",
                "ktua_id" => "A5EB03E21EE9F6A0E040640A040252AD",
                "nama" => "Kepulauan Nias"),
            array(
                "bkn_id" => "999",
                "ktua_id" => "A5EB03E21EE8F6A0E040640A040252AD",
                "nama" => "Semua Kancab")
        );
        foreach ($taspen as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('taspen')->insert($data);
        }
    }
}
