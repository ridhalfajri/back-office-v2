<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unit_kerja = array(
            array(
                "id" => 1,
                "nama" => "Badan Standardisasi Nasional",
                "jenis_unit_kerja_id" => 1),
            array(
                "id" => 2,
                "nama" => "Sekretaris Utama",
                "jenis_unit_kerja_id" => 2),
            array(
                "id" => 3,
                "nama" => "Kedeputian Bidang Pengembangan Standar",
                "jenis_unit_kerja_id" => 2),
            array(
                "id" => 4,
                "nama" => "Kedeputian Bidang Penerapan Standar dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 2),
            array(
                "id" => 5,
                "nama" => "Kedeputian Bidang Akreditasi",
                "jenis_unit_kerja_id" => 2),
            array(
                "id" => 6,
                "nama" => "Kedeputian Bidang Standar Nasional Satuan Ukuran",
                "jenis_unit_kerja_id" => 2),
            array(
                "id" => 7,
                "nama" => "Inspektorat",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 8,
                "nama" => "Biro Perencanaan, Keuangan, Umum, dan Pengadaan",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 9,
                "nama" => "Biro Sumber Daya Manusia, Organisasi, dan Hukum",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 10,
                "nama" => "Biro Humas, Kerjasama, dan Layanan Informasi",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 11,
                "nama" => "Pusat Riset dan Pengembangan Sumber Daya Manusia",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 12,
                "nama" => "Pusat Data dan Sistem Informasi",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 13,
                "nama" => "Direktorat Pengembangan Standar Agro, Kimia, Kesehatan, dan Halal",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 14,
                "nama" => "Direktorat Pengembangan Standar Mekanika, Energi, Elektronika, Transportasi, dan Teknologi Informasi",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 15,
                "nama" => "Direktorat Pengembangan Standar Infrastruktur, Penilaian Kesesuaian, Personal, dan Ekonomi Kreatif",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 16,
                "nama" => "Direktorat Sistem Penerapan Standar dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 17,
                "nama" => "Direktorat Penguatan Penerapan Standar dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 18,
                "nama" => "Direktorat Sistem dan Harmonisasi Akreditasi",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 19,
                "nama" => "Direktorat Akreditasi Laboratorium",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 20,
                "nama" => "Direktorat Akreditasi Lembaga Inspeksi dan Lembaga Sertifikasi",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 21,
                "nama" => "Direktorat Standar Nasional, Satuan Ukuran Mekanika, Radiasi, dan Biologi",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 22,
                "nama" => "Direktorat Standar Nasional, Satuan Ukuran Termoelektrik dan Kimia",
                "jenis_unit_kerja_id" => 3),
            array(
                "id" => 23,
                "nama" => "Bagian Perencanaan",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 24,
                "nama" => "Bagian Keuangan",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 25,
                "nama" => "Bagian Umum",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 26,
                "nama" => "Bagian Sumber Daya Manusia",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 27,
                "nama" => "Bagian Organisasi dan Tata Laksana",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 28,
                "nama" => "Bagian Hukum",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 29,
                "nama" => "Bagian Hubungan Masyarakat",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 30,
                "nama" => "Bagian Kerjasama",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 31,
                "nama" => "Bagian Layanan Informasi dan Perpustakaan",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 32,
                "nama" => "Bidang Riset dan Standardisasi dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 33,
                "nama" => "Bidang Diseminasi Hasil Riset Standardisasi dan Penilaiain Kesesuaian",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 34,
                "nama" => "Bidang Pengembangan Sumber Daya Manusia Standardisasi dan Penilaiain Kesesuaian",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 35,
                "nama" => "Bidang Infrastruktur dan Keamanan Informasi",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 36,
                "nama" => "Bidang Sistem Informasi dan Tata Kelola Data",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 37,
                "nama" => "Subdirektorat Pengembangan Standar Pertanian dan Halal",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 38,
                "nama" => "Subdirektorat Pengembangan Standar Lingkungan, Kehutanan, Perikanan, dan Kelautan",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 39,
                "nama" => "Subdirektorat Pengembangan Standar Kimia",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 40,
                "nama" => "Subdirektorat Pengembangan Standar Kesehatan",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 41,
                "nama" => "Subdirektorat Pengembangan Standar Mekanika dan Material",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 42,
                "nama" => "Subdirektorat Pengembangan Standar Energi",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 43,
                "nama" => "Subdirektorat Pengembangan Standar Elektroteknika",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 44,
                "nama" => "Subdirektorat Pengembangan Standar Transportasi dan Teknologi Informasi",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 45,
                "nama" => "Subdirektorat Pengembangan Standar Infrastruktur, Kebumian, Kebencanaan",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 46,
                "nama" => "Subdirektorat Pengembangan Standar Sistem Manajemen dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 47,
                "nama" => "Subdirektorat Pengembangan Standar Jasa, Personal, dan Ekonomi Kreatif",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 48,
                "nama" => "Subdirektorat Pengembangan Standar Teknologi Khusus dan Inovasi Baru",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 49,
                "nama" => "Subdirektorat Pengembangan Skema Penerapan Standar Sukarela dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 50,
                "nama" => "Subdirektorat Sistem Pemberlakuan Standar Wajib dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 51,
                "nama" => "Subdirektorat Pengendalian dan Penerapan Standar dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 52,
                "nama" => "Subdirektorat Pemenuhan Kewajiban Internasional Bidang Standar dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 53,
                "nama" => "Subdirektorat Diseminisasi Standar dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 54,
                "nama" => "Subdirektorat Fasilitasi Pelaku Usaha",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 55,
                "nama" => "Subdirektorat Fasilitasi Lembaga Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 56,
                "nama" => "Subdirektorat Sistem dan Harmonisasi Akreditasi Laboratorium",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 57,
                "nama" => "Subdirektorat Sistem dan Harmonisasi Akreditasi Lembaga Inspeksi dan Lembaga Sertifikasi",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 58,
                "nama" => "Subdirektorat Akreditasi Lab Pengujian Pangan, Pertanian, Perikanan, Kehutanan, Kesehatan, dan Lingkungan",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 59,
                "nama" => "Subdirektorat Akreditasi Laboratorium Pengujian, Mekanika, Energi, Elektronika, Konstruksi, dan Teknologi Khusus",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 60,
                "nama" => "Subdirektorat Akreditasi Laboratorium Medik, Penyelenggara Uji Profisiensi, dan Produsen Bahan Acuan",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 61,
                "nama" => "Subdirektorat Akreditasi Laboratorium Kalibrasi",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 62,
                "nama" => "Subdirektorat Akreditasi Lembaga Sertifikasi Sistem Manajemen",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 63,
                "nama" => "Subdirektorat Akreditasi Lembaga Sertifikasi Produk,  Proses, dan Jasa",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 64,
                "nama" => "Subdirektorat Akreditasi Lembaga Inspeksi, Lembaga Verifikasi, dan Lembaga Validasi",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 65,
                "nama" => "Subdirektorat Akreditasi Lembaga Sertifikasi Personal, dan Pembangunan Berkelanjutan",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 66,
                "nama" => "Subdirektorat Standar Nasional Satuan Ukuran Massa",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 67,
                "nama" => "Subdirektorat Standar Nasional Satuan Ukuran Panjang",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 68,
                "nama" => "Subdirektorat Standar Nasional Satuan Ukuran Akustik dan Vibrasi",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 69,
                "nama" => "Subdirektorat Standar Nasional Satuan Ukuran Radiasi dan Biologi",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 70,
                "nama" => "Subdirektorat Standar Nasional Satuan Ukuran SUHU",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 71,
                "nama" => "Subdirektorat Standar Nasional Satuan Ukuran Fotometri dan Radiometri",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 72,
                "nama" => "Subdirektorat Standar Nasional Satuan Ukuran Kelistrikan dan Waktu",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 73,
                "nama" => "Subdirektorat Standar Nasional Satuan Ukuran Kimia",
                "jenis_unit_kerja_id" => 4),
            array(
                "id" => 74,
                "nama" => "Subbagian Tata Usaha",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 75,
                "nama" => "Subbagian Perencanaan Program",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 76,
                "nama" => "Subbagian Penganggaraan",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 77,
                "nama" => "Subbagian Evaluasi dan Pelaporan Kinerja",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 78,
                "nama" => "Subbagian Perbendaharaan",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 79,
                "nama" => "Subbagian Verifikasi dan Akuntansi",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 80,
                "nama" => "Subbagian Penerimaan Negara bukan Pajak",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 81,
                "nama" => "Subbagian Tata Usaha Kepala dan Protokol",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 82,
                "nama" => "Subbagian Tata Usaha Sekretaris Utama",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 83,
                "nama" => "Subbagian Tata Usaha Deputi Bidang Pengembangan Standar",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 84,
                "nama" => "Subbagian Tata Usaha Deputi Bidang Penerapan Standar dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 85,
                "nama" => "Subbagian Tata Usaha Deputi Bidang Akreditasi",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 86,
                "nama" => "Subbagian Tata Usaha Deputi Bidang Standar Nasional Satuan Ukuran",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 87,
                "nama" => "Subbagian Rumah Tangga",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 88,
                "nama" => "Subbagian Kearsipan ",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 89,
                "nama" => "Subbagian Pengelolaan Barang Milik Negara",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 90,
                "nama" => "Subbagian Layanan Pengadaan Barang/Jasa",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 91,
                "nama" => "Subbagian Perencanaan dan pengembangan Sumber Daya Manusia",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 92,
                "nama" => "Subbagian Administrasi dan Kesejahteraan Sumber Daya Manusia",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 93,
                "nama" => "Subbagian Organisasi",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 94,
                "nama" => "Subbagian Tata Laksana dan Reformasi Birokrasi  ",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 95,
                "nama" => "Subbagian Peraturan Perundang-undangan",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 96,
                "nama" => "Subbagian Advokasi Hukum",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 97,
                "nama" => "Subbagian Dokumentasi dan Informasi Hukum",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 98,
                "nama" => "Subbagian Pemberitaan dan Publikasi",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 99,
                "nama" => "Subbagian Hubungan Antar Lembaga",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 100,
                "nama" => "Subbagian Kerja Sama Dalam Negeri",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 101,
                "nama" => "Subbagian Kerja Sama Luar Negeri",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 102,
                "nama" => "Subbagian Layanan Informasi dan Pengaduan Masyarakat",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 103,
                "nama" => "Subbagian Perpustakaan",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 104,
                "nama" => "Subbidang Program dan Evaluasi Pengembangan Sumber Daya Manusia",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 105,
                "nama" => "Subbidang Penyelenggaraan Pengembangan Sumber Daya Manusia",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 106,
                "nama" => "Subbagian Sumber Daya Manusia dan Tata Usaha",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 107,
                "nama" => "Subbagian Keuangan dan Rumah Tangga",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 108,
                "nama" => "Subbagian Tata Usaha",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 109,
                "nama" => "Seksi Pengembangan Skema Barang dan Proses",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 110,
                "nama" => "Seksi Pengembangan Skema Jasa, Personal, dan Sistem",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 111,
                "nama" => "Seksi Tata Kelola Pemberlakuan Standar Wajib dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 112,
                "nama" => "Seksi Notifikasi dan Analisis Hambatan Teknis",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 113,
                "nama" => "Seksi Lisensi Tanda Standar Nasional Indonesia",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 114,
                "nama" => "Seksi Monitoring Penerapan Standar dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 115,
                "nama" => "Seksi Pemenuhan Kewajiban Bilateral dan Multilateral",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 116,
                "nama" => "Seksi Pemenuhan Kewajiban Regional",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 117,
                "nama" => "Seksi Promosi Standar dan Penilaian Kesesuaian",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 118,
                "nama" => "Seksi Partisipasi Masyarakat",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 119,
                "nama" => "Seksi Fasilitasi Industri dan Organsisasi Publik",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 120,
                "nama" => "Seksi Fasilitasi Usaha Mikro Kecil",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 121,
                "nama" => "Seksi Fasilitasi Laboratorium",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 122,
                "nama" => "Seksi Fasilitasi Lembaga Inspeksi dan Lembaga Sertifikasi",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 123,
                "nama" => "Seksi Sistem Akreditasi Laboratorium",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 124,
                "nama" => "Seksi Harmonisasi Akreditasi Laboratorium",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 125,
                "nama" => "Seksi Sistem Akreditasi Lembaga Inspeksi dan Lembaga Sertifikasi",
                "jenis_unit_kerja_id" => 5),
            array(
                "id" => 126,
                "nama" => "Seksi Harmonisasi Akreditasi Lembaga Inspeksi dan Lembaga Sertifikasi",
                "jenis_unit_kerja_id" => 5)
        );
        foreach ($unit_kerja as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('unit_kerja')->insert($data);
        }
    }
}
