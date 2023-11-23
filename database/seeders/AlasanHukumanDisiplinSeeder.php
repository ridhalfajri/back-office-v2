<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlasanHukumanDisiplinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alasan = array(
            array(
                "bkn_id" => "A4689E6D5CA78920E050640A29032EE8",
                "nama" => "MELAKUKAN KEGIATAN BEPERGIAN KE LUAR DAERAH DAN/ATAU KEGIATAN MUDIK TMT 30 MARET 2020 ATAU PADA SAAT DITERBITKANNYA SE MENPAN RB NOMOR 36 TAHUN 2020 SESUAI DENGAN SE BKN NO 11/SE/IV/2020 (KATEGORI I)",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "A4689E6D5CA88920E050640A29032EE8",
                "nama" => "MELAKUKAN KEGIATAN BEPERGIAN KE LUAR DAERAH DAN/ATAU KEGIATAN MUDIK TMT 6 APRIL 2020 ATAU PADA SAAT DITERBITKANNYA SE MENPAN RB NOMOR 41 TAHUN 2020 SESUAI DENGAN SE BKN NO 11/SE/IV/2020 (KATEGORI II)",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "A4689E6D5CA98920E050640A29032EE8",
                "nama" => "MELAKUKAN KEGIATAN BEPERGIAN KE LUAR DAERAH DAN/ATAU KEGIATAN MUDIK TMT 9 APRIL 2020 ATAU PADA SAAT DITERBITKANNYA SE MENPAN RB NOMOR 46 TAHUN 2020 SESUAI DENGAN SE BKN NO 11/SE/IV/2020 (KATEGORI III)",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B39457B1E050640A15026590",
                "nama" => "TIDAK MENGUCAPKAN SUMPAH/JANJI PNS",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B39557B1E050640A15026590",
                "nama" => "TIDAK MENGUCAPKAN SUMPAH/JANJI JABATAN",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B39657B1E050640A15026590",
                "nama" => "TIDAK SETIA DAN TAAT SEPENUHNYA KEPADA PANCASILA, UNDANG-UNDANG DASAR NEGARA REPUPLIK INDONESIA TAHUN 1945, NEGARA KESATUAN REPUBLIK INDONESIA, DAN PEMERINTAH",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B39757B1E050640A15026590",
                "nama" => "TIDAK MENAATI SEGALA KETENTUAN PERATURAN PERUNDANGUNDANGAN",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B39857B1E050640A15026590",
                "nama" => "TIDAK MELAKSANAKAN TUGAS KEDINASAN YANG DIPERCAYAKAN KEPADA PNS DENGAN PENUH PENGABDIAN, KESADARAN, DAN TANGGUNG JAWAB",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B39957B1E050640A15026590",
                "nama" => "TIDAK MENJUNJUNG TINGGI KEHORMATAN NEGARA, PEMERINTAH, DAN MARTABAT PNS",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B39A57B1E050640A15026590",
                "nama" => "TIDAK MENGUTAMAKAN KEPENTINGAN NEGARA DARIPADA KEPENTINGAN SENDIRI, SESEORANG,DAN/ATAU GOLONGAN",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B39B57B1E050640A15026590",
                "nama" => "TIDAK MEMEGANG RAHASIA JABATAN YANG MENURUT SIFATNYA ATAU MENURUT PERINTAH HARUS DIRAHASIAKAN",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B39C57B1E050640A15026590",
                "nama" => "TIDAK BEKERJA DENGAN JUJUR, TERTIB, CERMAT, DAN BERSEMANGAT UNTUK KEPENTINGAN NEGARA",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B39D57B1E050640A15026590",
                "nama" => "TIDAK MELAPORKAN DENGAN SEGERA KEPADA ATASANNYA APABILA MENGETAHUI ADA HAL YANG DAPAT MEMBAHAYAKAN ATAU MERUGIKAN NEGARA ATAU PEMERINTAH TERUTAMA DI BIDANG KEAMANAN, KEUANGAN, DAN MATERIIL",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B39E57B1E050640A15026590",
                "nama" => "TIDAK MASUK KERJA DAN MENAATI KETENTUAN JAM KERJA",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B39F57B1E050640A15026590",
                "nama" => "TIDAK MENCAPAI SASARAN KERJA PEGAWAI YANG DITETAPKAN",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B3A057B1E050640A15026590",
                "nama" => "TIDAK MENGGUNAKAN DAN MEMELIHARA BARANG-BARANG MILIK NEGARA DENGAN SEBAIK-BAIKNYA",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B3A157B1E050640A15026590",
                "nama" => "TIDAK MEMBERIKAN PELAYANAN SEBAIK-BAIKNYA KEPADA MASYARAKAT",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B3A257B1E050640A15026590",
                "nama" => "TIDAK MEMBIMBING BAWAHAN DALAM MELAKSANAKAN TUGAS",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B3A357B1E050640A15026590",
                "nama" => "TIDAK MEMBERIKAN KESEMPATAN KEPADA BAWAHAN UNTUK MENGEMBANGKAN KARIER DAN;",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B3A457B1E050640A15026590",
                "nama" => "TIDAK MENAATI PERATURAN KEDINASAN YANG DITETAPKAN OLEH PEJABAT YANG BERWENANG.",
                "keterangan" => "KEWAJIBAN"),
            array(
                "bkn_id" => "11EC54D9B3A557B1E050640A15026590",
                "nama" => "MENYALAHGUNAKAN WEWENANG",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3A657B1E050640A15026590",
                "nama" => "MENJADI PERANTARA UNTUK MENDAPATKAN KEUNTUNGAN PRIBADI DAN/ ATAU ORANG LAIN DENGAN MENGGUNAKAN KEWENANGAN ORANG LAIN",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3A757B1E050640A15026590",
                "nama" => "TANPA IZIN PEMERINTAH MENJADI PEGAWAI ATAU BEKERJA UNTUK NEGARA LAIN DAN/ ATAU LEMBAGA ATAU ORGANISASI INTERNASIONAL",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3A857B1E050640A15026590",
                "nama" => "BEKERJA PADA PERUSAHAAN ASING, KONSULTAN ASING, ATAU LEMBAGA SWADAYA MASYARAKAT ASING",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3A957B1E050640A15026590",
                "nama" => "MEMILIKI, MENJUAL, MEMBELI, MENGGADAIKAN, MENYEWAKAN, ATAU MEMINJAMKAN BARANG-BARANG BAIK BERGERAK ATAU TIDAK BERGERAK, DOKUMEN ATAU SURAT BERHARGA MILIK NEGARA SECARA TIDAK SAH",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3AA57B1E050640A15026590",
                "nama" => "MELAKUKAN KEGIATAN BERSAMA DENGAN ATASAN, TEMAN SEJAWAT, BAWAHAN, ATAU ORANG LAIN DI DALAM MAUPUN DI LUAR LINGKUNGAN KERJANYA DENGAN TUJUAN UNTUK KEUNTUNGAN PRIBADI, GOLONGAN, ATAU PIHAK LAIN, YANG SECARA LANGSUNG ATAU TIDAK LANGSUNG MERUGIKAN NEGARA.",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3AB57B1E050640A15026590",
                "nama" => "MEMBERI ATAU MENYANGGUPI AKAN MEMBERI SESUATU KEPADA SIAPAPUN BAIK SECARA LANGSUNG ATAU TIDAK LANGSUNG DAN DENGAN DALIH APAPUN UNTUK DIANGKAT DALAM JABATAN",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3AC57B1E050640A15026590",
                "nama" => "MENERIMA HADIAH ATAU SESUATU PEMBERIAN APA SAJA DARI SIAPAPUN JUGA YANG BERHUBUNGAN DENGAN JABATAN DAN/ ATAU PEKERJAANNYA",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3AD57B1E050640A15026590",
                "nama" => "BERTINDAK SEWENANG-WENANG TERHADAP BAWAHANNYA",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3AE57B1E050640A15026590",
                "nama" => "MELAKUKAN SUATU TINDAKAN ATAU TIDAK MELAKUKAN SUATU TINDAKAN YANG DAPAT MENGHALANGI ATAU MEMPERSULIT SALAH SATU PIHAK YANG DILAYANI SEHINGGA MENGAKIBATKAN KERUGIAN BAGI YANG DILAYANI",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3AF57B1E050640A15026590",
                "nama" => "MENGHALANGI BERJALANNYA TUGAS KEDINASAN",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3B057B1E050640A15026590",
                "nama" => "IKUT SERTA SEBAGAI PELAKSANA KAMPANYE",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3B157B1E050640A15026590",
                "nama" => "MENJADI PESERTA KAMPANYE DENGAN MENGGUNAKAN ATRIBUT PARTAI ATAU ATRIBUT PNS",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3B257B1E050640A15026590",
                "nama" => "SEBAGAI PESERTA KAMPANYE DENGAN MENGERAHKAN PNS LAIN; DAN/ATAU",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3B357B1E050640A15026590",
                "nama" => "SEBAGAI PESERTA KAMPANYE DENGAN MENGGUNAKAN FASILITAS NEGARA.",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3B457B1E050640A15026590",
                "nama" => "MEMBUAT KEPUTUSAN DAN/ATAU TINDAKAN YANG MENGUNTUNGKAN ATAU MERUGIKAN SALAH SATU PASANGAN CALON SELAMA MASA KAMPANYE",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3B557B1E050640A15026590",
                "nama" => "MENGADAKAN KEGIATAN YANG MENGARAH KEPADA KEPERPIHAKAN TERHADAP PASANGAN CALON YANG MENJADI PESERTA PEMILU SEBELUM, SELAMA, DAN SESUDAH MASA KAMPANYE MELIPUTI PERTEMUAN, AJAKAN, HIMBAUAN, SERUAN, ATAU PEMBERIAN BARANG KEPADA PNS DALAM LINGKUNGAN UNIT KERJANYA, ANGGOTA KELUARGA, DAN MASYARAKAT",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3B657B1E050640A15026590",
                "nama" => "MEMBERIKAN DUKUNGAN KEPADA CALON ANGGOTA DEWAN PERWAKILAN DAERAH ATAU CALON KEPALA DAERAH/WAKIL KEPALA DAERAH DENGAN CARA MEMBERIKAN SURAT DUKUNGAN DISERTAI FOTO KOPI KARTU TANDA PENDUDUK ATAU SURAT KETERANGAN TANDA PENDUDUK SESUAI PERATURAN PERUNDANGUNDANGAN",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3B757B1E050640A15026590",
                "nama" => "TERLIBAT DALAM KEGIATAN KAMPANYE UNTUK MENDUKUNG CALON KEPALA DAERAH/WAKIL KEPALA DAERAH",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3B857B1E050640A15026590",
                "nama" => "MENGGUNAKAN FASILITAS YANG TERKAIT DENGAN JABATAN DALAM KEGIATAN KAMPANYE",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3B957B1E050640A15026590",
                "nama" => "MEMBUAT KEPUTUSAN DAN/ATAU TINDAKAN YANG MENGUNTUNGKAN ATAU MERUGIKAN SALAH SATU PASANGAN CALON SELAMA MASA KAMPANYE",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "11EC54D9B3BA57B1E050640A15026590",
                "nama" => "MENGADAKAN KEGIATAN YANG MENGARAH KEPADA KEPERPIHAKAN TERHADAP PASANGAN CALON YANG MENJADI PESERTA PEMILU SEBELUM, SELAMA, DAN SESUDAH MASA KAMPANYE MELIPUTI PERTEMUAN, AJAKAN, HIMBAUAN, SERUAN, ATAU PEMBERIAN BARANG KEPADA PNS DALAM LINGKUNGAN UNIT KERJA LINGKUNGAN UNIT KERJANYA, ANGGOTA KELUARGA, DAN MASYARAKAT.",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "C7730BC4BB20B892E050640AF2084D0C",
                "nama" => "MELAKUKAN TINDAK PIDANA",
                "keterangan" => "LARANGAN"),
            array(
                "bkn_id" => "C7730BC4BB21B892E050640AF2084D0C",
                "nama" => "MENGGUNAKAN ATAU MENGEDARKAN NARKOBA")
        );
        foreach ($alasan as $data)
        {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('alasan_hukuman_disiplin')->insert($data);
        }
    }
}
