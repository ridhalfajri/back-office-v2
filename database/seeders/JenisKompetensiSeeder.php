<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKompetensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kompetensi = array(
            array(
                "bkn_id" => "1",
                "nama" => "Adaptasi terhadap Perubahan (AtP)"),
            array(
                "bkn_id" => "2",
                "nama" => "Analisis  Strategis (AS)"),
            array(
                "bkn_id" => "3",
                "nama" => "Berpikir Analisis (BA)"),
            array(
                "bkn_id" => "4",
                "nama" => "Berpikir Konseptual (BK)"),
            array(
                "bkn_id" => "5",
                "nama" => "Berorientasi pada Hasil (BpH)"),
            array(
                "bkn_id" => "6",
                "nama" => "Berorientasi pada Kualitas (BpK)"),
            array(
                "bkn_id" => "7",
                "nama" => "Berorientasi pada Pelayanan (BpP)"),
            array(
                "bkn_id" => "8",
                "nama" => "Fleksibilitas Berpikir (FB)"),
            array(
                "bkn_id" => "9",
                "nama" => "Inisiatif (Ini)"),
            array(
                "bkn_id" => "10",
                "nama" => "Inovasi (Inov)"),
            array(
                "bkn_id" => "11",
                "nama" => "Integritas (Int)"),
            array(
                "bkn_id" => "12",
                "nama" => "Kegigihan (Kgg)"),
            array(
                "bkn_id" => "13",
                "nama" => "Kepemimpinan (Kp)"),
            array(
                "bkn_id" => "14",
                "nama" => "Kepemimpinan Strategis (KpS)"),
            array(
                "bkn_id" => "15",
                "nama" => "Kerja Sama (KS)"),
            array(
                "bkn_id" => "16",
                "nama" => "Ketabahan (Resilience)"),
            array(
                "bkn_id" => "17",
                "nama" => "Komitmen terhadap Organisasi (KtO)"),
            array(
                "bkn_id" => "18",
                "nama" => "Komunikasi (Kom)"),
            array(
                "bkn_id" => "19",
                "nama" => "Komunikasi Lisan (Komlis)"),
            array(
                "bkn_id" => "20",
                "nama" => "Komunikasi Tertulis (Komtul)"),
            array(
                "bkn_id" => "21",
                "nama" => "Kreativitas (Kre)"),
            array(
                "bkn_id" => "22",
                "nama" => "Manajemen Waktu (MW)"),
            array(
                "bkn_id" => "23",
                "nama" => "Membangun Hubungan Kerja (MHK)"),
            array(
                "bkn_id" => "24",
                "nama" => "Membangun Hubungan Kerjasama Strategis (MHKS)"),
            array(
                "bkn_id" => "25",
                "nama" => "Mengambil Resiko (BilRis)"),
            array(
                "bkn_id" => "26",
                "nama" => "Mengarahkan/Memberikan Perintah (MMP)"),
            array(
                "bkn_id" => "27",
                "nama" => "Mengelola Konflik (MK)"),
            array(
                "bkn_id" => "28",
                "nama" => "Mengembangkan Orang Lain (MOL)"),
            array(
                "bkn_id" => "29",
                "nama" => "Memfasilitasi Perubahan (MP)"),
            array(
                "bkn_id" => "30",
                "nama" => "Negosiasi (Nego)"),
            array(
                "bkn_id" => "31",
                "nama" => "Pembelajaran Berkelanjutan (PB)"),
            array(
                "bkn_id" => "32",
                "nama" => "Pencarian Informasi (PI)"),
            array(
                "bkn_id" => "33",
                "nama" => "Pendelegasian Wewenang (PW)"),
            array(
                "bkn_id" => "34",
                "nama" => "Pengambilan Keputusan (PK)"),
            array(
                "bkn_id" => "35",
                "nama" => "Pengambilan Keputusan Strategis (PKS)"),
            array(
                "bkn_id" => "36",
                "nama" => "Pengaturan Kerja (PkJ)"),
            array(
                "bkn_id" => "37",
                "nama" => "Perbaikan Terus-menerus (PTM)"),
            array(
                "bkn_id" => "38",
                "nama" => "Perencanaan dan Pengorganisasian (PP)"),
            array(
                "bkn_id" => "39",
                "nama" => "Semangat Berprestasi (SB)"),
            array(
                "bkn_id" => "40",
                "nama" => "Berpikir Analitis (BAt)"),
            array(
                "bkn_id" => "41",
                "nama" => "Keuletan (Keut)"),
            array(
                "bkn_id" => "42",
                "nama" => "Pengendalian Diri (PDr)"),
            array(
                "bkn_id" => "43",
                "nama" => "Membimbing (Mbbg)"),
            array(
                "bkn_id" => "44",
                "nama" => "Kesadaran akan Keselamatan Kerja (KKK)"),
            array(
                "bkn_id" => "45",
                "nama" => "Kewirausahaan(Kwk)"),
            array(
                "bkn_id" => "46",
                "nama" => "Perhatian terhadap Keteraturan (PtK)"),
            array(
                "bkn_id" => "47",
                "nama" => "Pengorganisasian (Porg)"),
            array(
                "bkn_id" => "48",
                "nama" => "Perencanaan (Prcn)"),
            array(
                "bkn_id" => "49",
                "nama" => "Manajemen Konflik (MKf)"),
            array(
                "bkn_id" => "50",
                "nama" => "Manajemen Perubahan (MPrb)"),
            array(
                "bkn_id" => "51",
                "nama" => "Tanggap terhadap Pengaruh Budaya (TtPBdy)"),
            array(
                "bkn_id" => "52",
                "nama" => "Empati (Ept)"),
            array(
                "bkn_id" => "53",
                "nama" => "Interaksi Sosial (Isos)"),
            array(
                "bkn_id" => "54",
                "nama" => "Visioning (Penetapan Visi)"),
            array(
                "bkn_id" => "55",
                "nama" => "Innovation (Inovasi)"),
            array(
                "bkn_id" => "56",
                "nama" => "In-Depth Problem Solving And Analysis and Decision Making (Analisa dan Pemecahan Masalah serta Pengambilan Keputusan)"),
            array(
                "bkn_id" => "57",
                "nama" => "Championing Change (Memimpin Perubahan)"),
            array(
                "bkn_id" => "58",
                "nama" => "Integrity (Integritas) dan Courage of Conviction (Keberanian berdasarkan Keyakinan)"),
            array(
                "bkn_id" => "59",
                "nama" => "Planning And Organizing (Perencanaan dan Pengroganisasian)"),
            array(
                "bkn_id" => "60",
                "nama" => "Stakeholder Focus (Fokus Kepada Pemangku Kepentingan)"),
            array(
                "bkn_id" => "61",
                "nama" => "Team Leadership (Kepemimpinan Tim)"),
            array(
                "bkn_id" => "62",
                "nama" => "Managing Diversity (Mengelola Keberagaman)"),
            array(
                "bkn_id" => "63",
                "nama" => "Driving For Results (Mendorong Hasil)"),
            array(
                "bkn_id" => "64",
                "nama" => "Conflict Management (Pengelolaan Konflik)"),
            array(
                "bkn_id" => "65",
                "nama" => "Communication (Komunikasi Lisan)"),
            array(
                "bkn_id" => "66",
                "nama" => "Negotiation (Negosiasi)"),
            array(
                "bkn_id" => "67",
                "nama" => "Developing Networking (Membangun Hubungan Kerjasama)")
        );
        foreach ($kompetensi as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('jenis_kompetensi')->insert($data);
        }
    }
}
