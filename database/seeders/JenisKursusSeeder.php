<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKursusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenis_kursus =
            array(
                array(
                    'bkn_id' => 'A5EB03E201F8F6A0E040640A040252AD',
                    'cepat_kode' => 2001,
                    'nama' => 'ADMINISTRASI KEUANGAN DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E201F9F6A0E040640A040252AD',
                    'cepat_kode' => 2002,
                    'nama' => 'ADMINISTRASI PERKANTORAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201FAF6A0E040640A040252AD',
                    'cepat_kode' => 2003,
                    'nama' => 'AIR LIMBAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E201FBF6A0E040640A040252AD',
                    'cepat_kode' => 2004,
                    'nama' => 'ALIH TEKNOLOGI'
                ),
                array(
                    'bkn_id' => 'A5EB03E201FCF6A0E040640A040252AD',
                    'cepat_kode' => 2005,
                    'nama' => 'AMDAL A DAN B'
                ),
                array(
                    'bkn_id' => 'A5EB03E201FDF6A0E040640A040252AD',
                    'cepat_kode' => 2006,
                    'nama' => 'ANALISA STATISTIK/DEMOGRAFI'
                ),
                array(
                    'bkn_id' => 'A5EB03E201FEF6A0E040640A040252AD',
                    'cepat_kode' => 2007,
                    'nama' => 'ANALISIS JABATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201FFF6A0E040640A040252AD',
                    'cepat_kode' => 2008,
                    'nama' => 'ANIMAL NATION'
                ),
                array(
                    'bkn_id' => 'A5EB03E20200F6A0E040640A040252AD',
                    'cepat_kode' => 2009,
                    'nama' => 'APLIKASI KEPEGAWAIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20201F6A0E040640A040252AD',
                    'cepat_kode' => 2010,
                    'nama' => 'ARGONOMI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20202F6A0E040640A040252AD',
                    'cepat_kode' => 2011,
                    'nama' => 'ASPAL BUTAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20203F6A0E040640A040252AD',
                    'cepat_kode' => 2012,
                    'nama' => 'ASPAL HOTMIX'
                ),
                array(
                    'bkn_id' => 'A5EB03E20204F6A0E040640A040252AD',
                    'cepat_kode' => 2013,
                    'nama' => 'ATR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20205F6A0E040640A040252AD',
                    'cepat_kode' => 2014,
                    'nama' => 'BAHASA DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E201F6F6A0E040640A040252AD',
                    'cepat_kode' => 2875,
                    'nama' => 'BAHASA INGGRIS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20206F6A0E040640A040252AD',
                    'cepat_kode' => 2015,
                    'nama' => 'BALI GETTLE BREADING PROGRAM'
                ),
                array(
                    'bkn_id' => 'A5EB03E20207F6A0E040640A040252AD',
                    'cepat_kode' => 2016,
                    'nama' => 'BENDAHARAWAN B'
                ),
                array(
                    'bkn_id' => 'A5EB03E20208F6A0E040640A040252AD',
                    'cepat_kode' => 2017,
                    'nama' => 'BENDAHARAWAN BARANG'
                ),
                array(
                    'bkn_id' => 'A5EB03E20209F6A0E040640A040252AD',
                    'cepat_kode' => 2018,
                    'nama' => 'BENDAHARAWAN PROYEK IPJK/IBRD'
                ),
                array(
                    'bkn_id' => 'A5EB03E2020CF6A0E040640A040252AD',
                    'cepat_kode' => 2021,
                    'nama' => 'BID. PENYEHATAN PEMUKIMAN LING'
                ),
                array(
                    'bkn_id' => 'A5EB03E2020AF6A0E040640A040252AD',
                    'cepat_kode' => 2019,
                    'nama' => 'BIDANG PEMUKIMAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2020BF6A0E040640A040252AD',
                    'cepat_kode' => 2020,
                    'nama' => 'BIDANG PERSAMPAHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2020DF6A0E040640A040252AD',
                    'cepat_kode' => 2022,
                    'nama' => 'BIMB. EKONOMI PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2020EF6A0E040640A040252AD',
                    'cepat_kode' => 2023,
                    'nama' => 'BIMB. MASYARAKAT PROG.PERBAIKAN KAMPUNG'
                ),
                array(
                    'bkn_id' => 'A5EB03E2020FF6A0E040640A040252AD',
                    'cepat_kode' => 2024,
                    'nama' => 'BIMB. PERENCANAAN TENAGA KERJA DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20212F6A0E040640A040252AD',
                    'cepat_kode' => 2027,
                    'nama' => 'BIMB. TEHNIS PENYELESAIAN HUKUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E20211F6A0E040640A040252AD',
                    'cepat_kode' => 2026,
                    'nama' => 'BIMB. TEKNIK PEMBANGUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20210F6A0E040640A040252AD',
                    'cepat_kode' => 2025,
                    'nama' => 'BIMB. TEKNIS MASALAH SOSPOL'
                ),
                array(
                    'bkn_id' => 'D834501E63B03A8CE050640AF10824F4',
                    'cepat_kode' => 3138,
                    'nama' => 'BIMTEK MEDIA SOSIAL'
                ),
                array(
                    'bkn_id' => 'D834501E63A93A8CE050640AF10824F4',
                    'cepat_kode' => 3131,
                    'nama' => 'BIMTEK PENGEMBANGAN SERTIFIKASI (BNSP)'
                ),
                array(
                    'bkn_id' => 'D834501E63C23A8CE050640AF10824F4',
                    'cepat_kode' => 3156,
                    'nama' => 'BIMTEK PENYUSUNAN PR'
                ),
                array(
                    'bkn_id' => 'D834501E63B13A8CE050640AF10824F4',
                    'cepat_kode' => 3139,
                    'nama' => 'BIMTEK PRODUSER TV/PRODUSER'
                ),
                array(
                    'bkn_id' => 'A5EB03E20213F6A0E040640A040252AD',
                    'cepat_kode' => 2028,
                    'nama' => 'BINA MUTU PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20214F6A0E040640A040252AD',
                    'cepat_kode' => 2029,
                    'nama' => 'BINA WISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20215F6A0E040640A040252AD',
                    'cepat_kode' => 2030,
                    'nama' => 'BKP'
                ),
                array(
                    'bkn_id' => 'A5EB03E20216F6A0E040640A040252AD',
                    'cepat_kode' => 2031,
                    'nama' => 'BRIDGE ENGINER ENG COURSE'
                ),
                array(
                    'bkn_id' => 'A5EB03E20217F6A0E040640A040252AD',
                    'cepat_kode' => 2032,
                    'nama' => 'BUDIDAYA PADI,PALAWIJA,HORTIKULTURA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20218F6A0E040640A040252AD',
                    'cepat_kode' => 2033,
                    'nama' => 'BUDIDAYA TANAMAN HIAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20219F6A0E040640A040252AD',
                    'cepat_kode' => 2034,
                    'nama' => 'CALON PENYULUH P2DT'
                ),
                array(
                    'bkn_id' => 'A5EB03E2021AF6A0E040640A040252AD',
                    'cepat_kode' => 2035,
                    'nama' => 'COACHING KEUANGAN DAN BENDAHARAWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2021BF6A0E040640A040252AD',
                    'cepat_kode' => 2036,
                    'nama' => 'CONTRUKTION MANAJEMEN COURSE IN JAPAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2021CF6A0E040640A040252AD',
                    'cepat_kode' => 2037,
                    'nama' => 'CROPING SISTEM'
                ),
                array(
                    'bkn_id' => 'A5EB03E2049FF6A0E040640A040252AD',
                    'cepat_kode' => 2598,
                    'nama' => 'DAL HAMA ORYETES SP SECARA BIOLOGIS'
                ),
                array(
                    'bkn_id' => 'A5EB03E2021DF6A0E040640A040252AD',
                    'cepat_kode' => 2038,
                    'nama' => 'DEMOGRAFI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2021EF6A0E040640A040252AD',
                    'cepat_kode' => 2039,
                    'nama' => 'DIARE'
                ),
                array(
                    'bkn_id' => 'D834501E63AD3A8CE050640AF10824F4',
                    'cepat_kode' => 3135,
                    'nama' => 'DIKAT PERENCANAAN ANGGARAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20234F6A0E040640A040252AD',
                    'cepat_kode' => 2061,
                    'nama' => 'DIKL PENINGK.TRAMP.TEK.KERAJINAN PERKOP.'
                ),
                array(
                    'bkn_id' => 'D834501E63AB3A8CE050640AF10824F4',
                    'cepat_kode' => 3133,
                    'nama' => 'DIKLAT ACCOUNT EXECUTIVE'
                ),
                array(
                    'bkn_id' => 'A5EB03E2022BF6A0E040640A040252AD',
                    'cepat_kode' => 2052,
                    'nama' => 'DIKLAT ADMINISTRASI KESOSIALAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2021FF6A0E040640A040252AD',
                    'cepat_kode' => 2040,
                    'nama' => 'DIKLAT APARATUR TEKNIS FUNGSIONAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E20220F6A0E040640A040252AD',
                    'cepat_kode' => 2041,
                    'nama' => 'DIKLAT BINA MARGA'
                ),
                array(
                    'bkn_id' => 'D834501E63B73A8CE050640AF10824F4',
                    'cepat_kode' => 3145,
                    'nama' => 'DIKLAT DASAR KAMERAMEN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2022CF6A0E040640A040252AD',
                    'cepat_kode' => 2053,
                    'nama' => 'DIKLAT DASAR KLH'
                ),
                array(
                    'bkn_id' => 'D834501E63B23A8CE050640AF10824F4',
                    'cepat_kode' => 3140,
                    'nama' => 'DIKLAT DRONE'
                ),
                array(
                    'bkn_id' => 'D834501E63AE3A8CE050640AF10824F4',
                    'cepat_kode' => 3136,
                    'nama' => 'DIKLAT DVBT2'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7F12E5E050640A29034DA5',
                    'cepat_kode' => 2907,
                    'nama' => 'DIKLAT FUNGSIONAL ADMINISTRATOR DATABASE KEPENDUDUKAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BAC12E5E050640A29034DA5',
                    'cepat_kode' => 2952,
                    'nama' => 'DIKLAT FUNGSIONAL ADMINISTRATOR KESEHATAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0012E5E050640A29034DA5',
                    'cepat_kode' => 3036,
                    'nama' => 'DIKLAT FUNGSIONAL AGEN'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0D12E5E050640A29034DA5',
                    'cepat_kode' => 3049,
                    'nama' => 'DIKLAT FUNGSIONAL ANALIS APBN'
                ),
                array(
                    'bkn_id' => 'D38B303C229D0BACE050640AF1087680',
                    'cepat_kode' => 3130,
                    'nama' => 'DIKLAT FUNGSIONAL ANALIS HUKUM'
                ),
                array(
                    'bkn_id' => '8B91B70E3BFD12E5E050640A29034DA5',
                    'cepat_kode' => 3033,
                    'nama' => 'DIKLAT FUNGSIONAL ANALIS KEBIJAKAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BFA12E5E050640A29034DA5',
                    'cepat_kode' => 3030,
                    'nama' => 'DIKLAT FUNGSIONAL ANALIS KEPEGAWAIAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9212E5E050640A29034DA5',
                    'cepat_kode' => 2926,
                    'nama' => 'DIKLAT FUNGSIONAL ANALIS KETAHANAN PANGAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9312E5E050640A29034DA5',
                    'cepat_kode' => 2927,
                    'nama' => 'DIKLAT FUNGSIONAL ANALIS PERKARANTINAAN TUMBUHAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BA312E5E050640A29034DA5',
                    'cepat_kode' => 2943,
                    'nama' => 'DIKLAT FUNGSIONAL ANALIS PERTAHANAN NEGARA'
                ),
                array(
                    'bkn_id' => '8B91B70E3C1012E5E050640A29034DA5',
                    'cepat_kode' => 3052,
                    'nama' => 'DIKLAT FUNGSIONAL ANALIS TRANSAKSI KEUANGAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7312E5E050640A29034DA5',
                    'cepat_kode' => 2895,
                    'nama' => 'DIKLAT FUNGSIONAL ANALISIS ANGGARAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B6A12E5E050640A29034DA5',
                    'cepat_kode' => 2886,
                    'nama' => 'DIKLAT FUNGSIONAL ANALISIS KEIMIGRASIAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7412E5E050640A29034DA5',
                    'cepat_kode' => 2896,
                    'nama' => 'DIKLAT FUNGSIONAL ANALISIS KEUANGAN PUSAT DAN DAERAH'
                ),
                array(
                    'bkn_id' => '8B91B70E3BDD12E5E050640A29034DA5',
                    'cepat_kode' => 3001,
                    'nama' => 'DIKLAT FUNGSIONAL ANALISIS PASAR HASIL PERIKANAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8812E5E050640A29034DA5',
                    'cepat_kode' => 2916,
                    'nama' => 'DIKLAT FUNGSIONAL ANALISIS PASAR HASIL PERTANIAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BAD12E5E050640A29034DA5',
                    'cepat_kode' => 2953,
                    'nama' => 'DIKLAT FUNGSIONAL APOTEKER'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0712E5E050640A29034DA5',
                    'cepat_kode' => 3043,
                    'nama' => 'DIKLAT FUNGSIONAL ARSIPARIS'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8712E5E050640A29034DA5',
                    'cepat_kode' => 2915,
                    'nama' => 'DIKLAT FUNGSIONAL ASESOR MANAJEMEN MUTU INDUSTRI'
                ),
                array(
                    'bkn_id' => '8B91B70E3B6B12E5E050640A29034DA5',
                    'cepat_kode' => 2887,
                    'nama' => 'DIKLAT FUNGSIONAL ASISTEM PEMBIMBING KEMASYARAKATAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BAE12E5E050640A29034DA5',
                    'cepat_kode' => 2954,
                    'nama' => 'DIKLAT FUNGSIONAL ASISTEN APOTEKER'
                ),
                array(
                    'bkn_id' => '8B91B70E3BE212E5E050640A29034DA5',
                    'cepat_kode' => 3006,
                    'nama' => 'DIKLAT FUNGSIONAL ASISTEN INSPEKTUR MUTU HASIL PERIKANAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BEF12E5E050640A29034DA5',
                    'cepat_kode' => 3019,
                    'nama' => 'DIKLAT FUNGSIONAL ASISTEN PELATIH OLAHRAGA'
                ),
                array(
                    'bkn_id' => '8B91B70E3BE312E5E050640A29034DA5',
                    'cepat_kode' => 3007,
                    'nama' => 'DIKLAT FUNGSIONAL ASISTEN PEMBINA MUTU HASIL KELAUTAN DAN PERIKANAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BC812E5E050640A29034DA5',
                    'cepat_kode' => 2980,
                    'nama' => 'DIKLAT FUNGSIONAL ASISTEN PENATA ANESTESI'
                ),
                array(
                    'bkn_id' => '8B91B70E3BDF12E5E050640A29034DA5',
                    'cepat_kode' => 3003,
                    'nama' => 'DIKLAT FUNGSIONAL ASISTEN PENGELOLA PRODUKSI PERIKANAN TANGKAP'
                ),
                array(
                    'bkn_id' => '8B91B70E3BEC12E5E050640A29034DA5',
                    'cepat_kode' => 3016,
                    'nama' => 'DIKLAT FUNGSIONAL ASISTEN PENGUJI PERANGKAT TELEKOMUNIKASI'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7B12E5E050640A29034DA5',
                    'cepat_kode' => 2903,
                    'nama' => 'DIKLAT FUNGSIONAL ASISTEN PENILAI PAJAK'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0F12E5E050640A29034DA5',
                    'cepat_kode' => 3051,
                    'nama' => 'DIKLAT FUNGSIONAL ASISTEN PERISALAH LEGISLATIF'
                ),
                array(
                    'bkn_id' => '8B91B70E3BE612E5E050640A29034DA5',
                    'cepat_kode' => 3010,
                    'nama' => 'DIKLAT FUNGSIONAL ASISTEN PRANATA SIARAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BE712E5E050640A29034DA5',
                    'cepat_kode' => 3011,
                    'nama' => 'DIKLAT FUNGSIONAL ASISTEN TEKNISI SIARAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BFB12E5E050640A29034DA5',
                    'cepat_kode' => 3031,
                    'nama' => 'DIKLAT FUNGSIONAL ASSESSOR SDM APARATUR'
                ),
                array(
                    'bkn_id' => '8B91B70E3BF712E5E050640A29034DA5',
                    'cepat_kode' => 3027,
                    'nama' => 'DIKLAT FUNGSIONAL AUDITOR'
                ),
                array(
                    'bkn_id' => '8B91B70E3BFC12E5E050640A29034DA5',
                    'cepat_kode' => 3032,
                    'nama' => 'DIKLAT FUNGSIONAL AUDITOR KEPEGAWAIAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BAF12E5E050640A29034DA5',
                    'cepat_kode' => 2955,
                    'nama' => 'DIKLAT FUNGSIONAL BIDAN'
                ),
                array(
                    'bkn_id' => '8B8231F908BC414AE050640A2903466B',
                    'cepat_kode' => 2880,
                    'nama' => 'DIKLAT FUNGSIONAL DIPLOMAT'
                ),
                array(
                    'bkn_id' => '8B91B70E3BB012E5E050640A29034DA5',
                    'cepat_kode' => 2956,
                    'nama' => 'DIKLAT FUNGSIONAL DOKTER'
                ),
                array(
                    'bkn_id' => '8B91B70E3BB112E5E050640A29034DA5',
                    'cepat_kode' => 2957,
                    'nama' => 'DIKLAT FUNGSIONAL DOKTER GIGI'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9512E5E050640A29034DA5',
                    'cepat_kode' => 2929,
                    'nama' => 'DIKLAT FUNGSIONAL DOKTER HEWAN KARANTINA'
                ),
                array(
                    'bkn_id' => '8B91B70E3BB212E5E050640A29034DA5',
                    'cepat_kode' => 2958,
                    'nama' => 'DIKLAT FUNGSIONAL DOKTER PENDIDIK KLINIS'
                ),
                array(
                    'bkn_id' => '8B91B70E3BAB12E5E050640A29034DA5',
                    'cepat_kode' => 2951,
                    'nama' => 'DIKLAT FUNGSIONAL DOSEN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BB412E5E050640A29034DA5',
                    'cepat_kode' => 2960,
                    'nama' => 'DIKLAT FUNGSIONAL ENTOMOLOG KESEHATAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BB312E5E050640A29034DA5',
                    'cepat_kode' => 2959,
                    'nama' => 'DIKLAT FUNGSIONAL EPIDEMIOLOG KESEHATAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BB612E5E050640A29034DA5',
                    'cepat_kode' => 2962,
                    'nama' => 'DIKLAT FUNGSIONAL FISIKAWAN MEDIS'
                ),
                array(
                    'bkn_id' => '8B91B70E3BB512E5E050640A29034DA5',
                    'cepat_kode' => 2961,
                    'nama' => 'DIKLAT FUNGSIONAL FISIOTERAPIS'
                ),
                array(
                    'bkn_id' => '8B91B70E3BA412E5E050640A29034DA5',
                    'cepat_kode' => 2944,
                    'nama' => 'DIKLAT FUNGSIONAL GURU'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9712E5E050640A29034DA5',
                    'cepat_kode' => 2931,
                    'nama' => 'DIKLAT FUNGSIONAL INSPEKTUR KETENAGALISTRIKAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9812E5E050640A29034DA5',
                    'cepat_kode' => 2932,
                    'nama' => 'DIKLAT FUNGSIONAL INSPEKTUR MINYAK DAN GAS BUMI'
                ),
                array(
                    'bkn_id' => '8B91B70E3BE412E5E050640A29034DA5',
                    'cepat_kode' => 3008,
                    'nama' => 'DIKLAT FUNGSIONAL INSPEKTUR MUTU HASIL PERIKANAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9912E5E050640A29034DA5',
                    'cepat_kode' => 2933,
                    'nama' => 'DIKLAT FUNGSIONAL INSPEKTUR TAMBANG'
                ),
                array(
                    'bkn_id' => '8B91B70E3BCC12E5E050640A29034DA5',
                    'cepat_kode' => 2984,
                    'nama' => 'DIKLAT FUNGSIONAL INSTRUKTUR'
                ),
                array(
                    'bkn_id' => '8B91B70E3BF012E5E050640A29034DA5',
                    'cepat_kode' => 3020,
                    'nama' => 'DIKLAT FUNGSIONAL JAKSA'
                ),
                array(
                    'bkn_id' => '8B91B70E3BA212E5E050640A29034DA5',
                    'cepat_kode' => 2942,
                    'nama' => 'DIKLAT FUNGSIONAL KATALOGER'
                ),
                array(
                    'bkn_id' => '8B91B70E3BCF12E5E050640A29034DA5',
                    'cepat_kode' => 2987,
                    'nama' => 'DIKLAT FUNGSIONAL MEDIATOR HUBUNGAN INDUSTRIAL'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8912E5E050640A29034DA5',
                    'cepat_kode' => 2917,
                    'nama' => 'DIKLAT FUNGSIONAL MEDIK VETERINER'
                ),
                array(
                    'bkn_id' => '8B91B70E3BB712E5E050640A29034DA5',
                    'cepat_kode' => 2963,
                    'nama' => 'DIKLAT FUNGSIONAL NUTRISIONIS'
                ),
                array(
                    'bkn_id' => '8B91B70E3BB812E5E050640A29034DA5',
                    'cepat_kode' => 2964,
                    'nama' => 'DIKLAT FUNGSIONAL OKUPASI TERAPIS'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8012E5E050640A29034DA5',
                    'cepat_kode' => 2908,
                    'nama' => 'DIKLAT FUNGSIONAL OPERATOR SIAK'
                ),
                array(
                    'bkn_id' => '8B91B70E3BF112E5E050640A29034DA5',
                    'cepat_kode' => 3021,
                    'nama' => 'DIKLAT FUNGSIONAL OPERATOR TRANSMISI SANDI'
                ),
                array(
                    'bkn_id' => '8B91B70E3BB912E5E050640A29034DA5',
                    'cepat_kode' => 2965,
                    'nama' => 'DIKLAT FUNGSIONAL ORTHOTIS PROSTETIS'
                ),
                array(
                    'bkn_id' => '8B91B70E3BA512E5E050640A29034DA5',
                    'cepat_kode' => 2945,
                    'nama' => 'DIKLAT FUNGSIONAL PAMONG BELAJAR'
                ),
                array(
                    'bkn_id' => '8B91B70E3BA612E5E050640A29034DA5',
                    'cepat_kode' => 2946,
                    'nama' => 'DIKLAT FUNGSIONAL PAMONG BUDAYA'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9612E5E050640A29034DA5',
                    'cepat_kode' => 2930,
                    'nama' => 'DIKLAT FUNGSIONAL PARAMEDIK KARANTINA HEWAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8A12E5E050640A29034DA5',
                    'cepat_kode' => 2918,
                    'nama' => 'DIKLAT FUNGSIONAL PARAMEDIK VETERINER'
                ),
                array(
                    'bkn_id' => '8B91B70E3BD212E5E050640A29034DA5',
                    'cepat_kode' => 2990,
                    'nama' => 'DIKLAT FUNGSIONAL PEKERJA SOSIAL'
                ),
                array(
                    'bkn_id' => '8B91B70E3BEE12E5E050640A29034DA5',
                    'cepat_kode' => 3018,
                    'nama' => 'DIKLAT FUNGSIONAL PELATIH OLAHRAGA'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7512E5E050640A29034DA5',
                    'cepat_kode' => 2897,
                    'nama' => 'DIKLAT FUNGSIONAL PELELANG'
                ),
                array(
                    'bkn_id' => '8B91B70E3B6C12E5E050640A29034DA5',
                    'cepat_kode' => 2888,
                    'nama' => 'DIKLAT FUNGSIONAL PEMBIMBING KEMASYARAKATAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BBA12E5E050640A29034DA5',
                    'cepat_kode' => 2966,
                    'nama' => 'DIKLAT FUNGSIONAL PEMBIMBING KESEHATAN KERJA'
                ),
                array(
                    'bkn_id' => '8B91B70E3BA112E5E050640A29034DA5',
                    'cepat_kode' => 2941,
                    'nama' => 'DIKLAT FUNGSIONAL PEMBINA JASA KONSTRUKSI'
                ),
                array(
                    'bkn_id' => '8B91B70E3BE512E5E050640A29034DA5',
                    'cepat_kode' => 3009,
                    'nama' => 'DIKLAT FUNGSIONAL PEMBINA MUTU HASIL KELAUTAN DAN PERIKANAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0812E5E050640A29034DA5',
                    'cepat_kode' => 3044,
                    'nama' => 'DIKLAT FUNGSIONAL PEMERIKSA'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7612E5E050640A29034DA5',
                    'cepat_kode' => 2898,
                    'nama' => 'DIKLAT FUNGSIONAL PEMERIKSA BEA DAN CUKAI'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7112E5E050640A29034DA5',
                    'cepat_kode' => 2893,
                    'nama' => 'DIKLAT FUNGSIONAL PEMERIKSA DESAIN INDUSTRI'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9412E5E050640A29034DA5',
                    'cepat_kode' => 2928,
                    'nama' => 'DIKLAT FUNGSIONAL PEMERIKSA KARANTINA TUMBUHAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B6D12E5E050640A29034DA5',
                    'cepat_kode' => 2889,
                    'nama' => 'DIKLAT FUNGSIONAL PEMERIKSA KEIMIGRASIAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B6E12E5E050640A29034DA5',
                    'cepat_kode' => 2890,
                    'nama' => 'DIKLAT FUNGSIONAL PEMERIKSA MEREK'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7712E5E050640A29034DA5',
                    'cepat_kode' => 2899,
                    'nama' => 'DIKLAT FUNGSIONAL PEMERIKSA PAJAK'
                ),
                array(
                    'bkn_id' => '8B91B70E3B6F12E5E050640A29034DA5',
                    'cepat_kode' => 2891,
                    'nama' => 'DIKLAT FUNGSIONAL PEMERIKSA PATEN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9112E5E050640A29034DA5',
                    'cepat_kode' => 2925,
                    'nama' => 'DIKLAT FUNGSIONAL PEMERIKSA PVT'
                ),
                array(
                    'bkn_id' => '8B91B70E3BC912E5E050640A29034DA5',
                    'cepat_kode' => 2981,
                    'nama' => 'DIKLAT FUNGSIONAL PENATA ANESTESI'
                ),
                array(
                    'bkn_id' => '8B91B70E3B6512E5E050640A29034DA5',
                    'cepat_kode' => 2881,
                    'nama' => 'DIKLAT FUNGSIONAL PENATA KONSELERAI'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7C12E5E050640A29034DA5',
                    'cepat_kode' => 2904,
                    'nama' => 'DIKLAT FUNGSIONAL PENATA LAKSANA BARANG'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9C12E5E050640A29034DA5',
                    'cepat_kode' => 2936,
                    'nama' => 'DIKLAT FUNGSIONAL PENATA RUANG'
                ),
                array(
                    'bkn_id' => '8B91B70E3BFF12E5E050640A29034DA5',
                    'cepat_kode' => 3035,
                    'nama' => 'DIKLAT FUNGSIONAL PENELITI'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8112E5E050640A29034DA5',
                    'cepat_kode' => 2909,
                    'nama' => 'DIKLAT FUNGSIONAL PENERA'
                ),
                array(
                    'bkn_id' => '8B91B70E3BD412E5E050640A29034DA5',
                    'cepat_kode' => 2992,
                    'nama' => 'DIKLAT FUNGSIONAL PENERJEMAH'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9A12E5E050640A29034DA5',
                    'cepat_kode' => 2934,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAMAT GUNUNG API'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0212E5E050640A29034DA5',
                    'cepat_kode' => 3038,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAMAT METEREOLOGI DAN GEOFISIKA'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8312E5E050640A29034DA5',
                    'cepat_kode' => 2911,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAMAT TERA'
                ),
                array(
                    'bkn_id' => '8B91B70E3BCD12E5E050640A29034DA5',
                    'cepat_kode' => 2985,
                    'nama' => 'DIKLAT FUNGSIONAL PENGANTAR KERJA'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8B12E5E050640A29034DA5',
                    'cepat_kode' => 2919,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS BENIH TANAMAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8C12E5E050640A29034DA5',
                    'cepat_kode' => 2920,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS BIBIT TERNAK'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0312E5E050640A29034DA5',
                    'cepat_kode' => 3039,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS FARMASI DAN MAKANAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8412E5E050640A29034DA5',
                    'cepat_kode' => 2912,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS KEMETROLOGIAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B6712E5E050640A29034DA5',
                    'cepat_kode' => 2883,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS KESELAMATAN PELAYARAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BCE12E5E050640A29034DA5',
                    'cepat_kode' => 2986,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS KETENAGAKERJAAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BD912E5E050640A29034DA5',
                    'cepat_kode' => 2997,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS LINGKUNGAN HIDUP'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8D12E5E050640A29034DA5',
                    'cepat_kode' => 2921,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS MUTU HASIL PANGAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8E12E5E050640A29034DA5',
                    'cepat_kode' => 2922,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS MUTU PAKAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7D12E5E050640A29034DA5',
                    'cepat_kode' => 2905,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS PENYELENGGARAAN URUSAN PEMERINTAHAN DI DAERAH (PENGAWAS PEMERINTAHAN)'
                ),
                array(
                    'bkn_id' => '8B91B70E3BDA12E5E050640A29034DA5',
                    'cepat_kode' => 2998,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS PERIKANAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BF912E5E050640A29034DA5',
                    'cepat_kode' => 3029,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS RADIASI'
                ),
                array(
                    'bkn_id' => '8B91B70E3BA712E5E050640A29034DA5',
                    'cepat_kode' => 2947,
                    'nama' => 'DIKLAT FUNGSIONAL PENGAWAS SEKOLAH'
                ),
                array(
                    'bkn_id' => '8B91B70E3BDE12E5E050640A29034DA5',
                    'cepat_kode' => 3002,
                    'nama' => 'DIKLAT FUNGSIONAL PENGELOLA EKOSISTEM LAUT DAN PESISIR'
                ),
                array(
                    'bkn_id' => '8B91B70E3BE112E5E050640A29034DA5',
                    'cepat_kode' => 3005,
                    'nama' => 'DIKLAT FUNGSIONAL PENGELOLA KESEHATAN IKAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0912E5E050640A29034DA5',
                    'cepat_kode' => 3045,
                    'nama' => 'DIKLAT FUNGSIONAL PENGELOLA PENGADAAN BARANG/JASA'
                ),
                array(
                    'bkn_id' => '8B91B70E3BE012E5E050640A29034DA5',
                    'cepat_kode' => 3004,
                    'nama' => 'DIKLAT FUNGSIONAL PENGELOLA PRODUKSI PERIKANAN TANGKAP'
                ),
                array(
                    'bkn_id' => '8B91B70E3BA912E5E050640A29034DA5',
                    'cepat_kode' => 2949,
                    'nama' => 'DIKLAT FUNGSIONAL PENGEMBANG TEKNOLOGI PEMBELAJARAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BD812E5E050640A29034DA5',
                    'cepat_kode' => 2996,
                    'nama' => 'DIKLAT FUNGSIONAL PENGENDALI DAMPAK LINGKUNGAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BD512E5E050640A29034DA5',
                    'cepat_kode' => 2993,
                    'nama' => 'DIKLAT FUNGSIONAL PENGENDALI EKOSISTEM HUKUM'
                ),
                array(
                    'bkn_id' => 'DFCEE247A4A19AF2E050640AF10829CF',
                    'cepat_kode' => 3158,
                    'nama' => 'DIKLAT FUNGSIONAL PENGENDALI EKOSISTEM HUTAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BEA12E5E050640A29034DA5',
                    'cepat_kode' => 3014,
                    'nama' => 'DIKLAT FUNGSIONAL PENGENDALI FREKUENSI RADIO'
                ),
                array(
                    'bkn_id' => '8B91B70E3BDB12E5E050640A29034DA5',
                    'cepat_kode' => 2999,
                    'nama' => 'DIKLAT FUNGSIONAL PENGENDALI HAMA DAN PENYAKIT IKAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8F12E5E050640A29034DA5',
                    'cepat_kode' => 2923,
                    'nama' => 'DIKLAT FUNGSIONAL PENGENDALI OPT'
                ),
                array(
                    'bkn_id' => '8B91B70E3BD112E5E050640A29034DA5',
                    'cepat_kode' => 2989,
                    'nama' => 'DIKLAT FUNGSIONAL PENGGERAK SWADAYA MASYARAKAT'
                ),
                array(
                    'bkn_id' => '8B91B70E3BCA12E5E050640A29034DA5',
                    'cepat_kode' => 2982,
                    'nama' => 'DIKLAT FUNGSIONAL PENGHULU'
                ),
                array(
                    'bkn_id' => '8B91B70E3B6812E5E050640A29034DA5',
                    'cepat_kode' => 2884,
                    'nama' => 'DIKLAT FUNGSIONAL PENGUJI KENDARAAN BERMOTOR'
                ),
                array(
                    'bkn_id' => '8B91B70E3BD012E5E050640A29034DA5',
                    'cepat_kode' => 2988,
                    'nama' => 'DIKLAT FUNGSIONAL PENGUJI KESELAMATAN DAN KESEHATAN KERJA (PENGUJI K3)'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8212E5E050640A29034DA5',
                    'cepat_kode' => 2910,
                    'nama' => 'DIKLAT FUNGSIONAL PENGUJI MUTU BARANG'
                ),
                array(
                    'bkn_id' => '8B91B70E3BED12E5E050640A29034DA5',
                    'cepat_kode' => 3017,
                    'nama' => 'DIKLAT FUNGSIONAL PENGUJI PERANGKAT TELEKOMUNIKASI'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7A12E5E050640A29034DA5',
                    'cepat_kode' => 2902,
                    'nama' => 'DIKLAT FUNGSIONAL PENILAI PAJAK'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7812E5E050640A29034DA5',
                    'cepat_kode' => 2900,
                    'nama' => 'DIKLAT FUNGSIONAL PENILAI PEMERINTAH'
                ),
                array(
                    'bkn_id' => '8B91B70E3BA812E5E050640A29034DA5',
                    'cepat_kode' => 2948,
                    'nama' => 'DIKLAT FUNGSIONAL PENILIK'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9B12E5E050640A29034DA5',
                    'cepat_kode' => 2935,
                    'nama' => 'DIKLAT FUNGSIONAL PENYELIDIK BUMI'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0C12E5E050640A29034DA5',
                    'cepat_kode' => 3048,
                    'nama' => 'DIKLAT FUNGSIONAL PENYIDIK BNN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BCB12E5E050640A29034DA5',
                    'cepat_kode' => 2983,
                    'nama' => 'DIKLAT FUNGSIONAL PENYULUH AGAMA'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7212E5E050640A29034DA5',
                    'cepat_kode' => 2894,
                    'nama' => 'DIKLAT FUNGSIONAL PENYULUH HUKUM'
                ),
                array(
                    'bkn_id' => '8B91B70E3BD612E5E050640A29034DA5',
                    'cepat_kode' => 2994,
                    'nama' => 'DIKLAT FUNGSIONAL PENYULUH KEHUTANAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BF412E5E050640A29034DA5',
                    'cepat_kode' => 3024,
                    'nama' => 'DIKLAT FUNGSIONAL PENYULUH KELUARGA BERENCANA'
                ),
                array(
                    'bkn_id' => '8B91B70E3BBB12E5E050640A29034DA5',
                    'cepat_kode' => 2967,
                    'nama' => 'DIKLAT FUNGSIONAL PENYULUH KESEHATAN MASYARAKAT'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0B12E5E050640A29034DA5',
                    'cepat_kode' => 3047,
                    'nama' => 'DIKLAT FUNGSIONAL PENYULUH NARKOBA'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7912E5E050640A29034DA5',
                    'cepat_kode' => 2901,
                    'nama' => 'DIKLAT FUNGSIONAL PENYULUH PAJAK'
                ),
                array(
                    'bkn_id' => '8B91B70E3BDC12E5E050640A29034DA5',
                    'cepat_kode' => 3000,
                    'nama' => 'DIKLAT FUNGSIONAL PENYULUH PERIKANAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8612E5E050640A29034DA5',
                    'cepat_kode' => 2914,
                    'nama' => 'DIKLAT FUNGSIONAL PENYULUH PERINDUSTRIAN DAN PERDAGANGAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9012E5E050640A29034DA5',
                    'cepat_kode' => 2924,
                    'nama' => 'DIKLAT FUNGSIONAL PENYULUH PERTANIAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BD312E5E050640A29034DA5',
                    'cepat_kode' => 2991,
                    'nama' => 'DIKLAT FUNGSIONAL PENYULUH SOSIAL'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7012E5E050640A29034DA5',
                    'cepat_kode' => 2892,
                    'nama' => 'DIKLAT FUNGSIONAL PERANCANG PERATURAN PERUNDANG-UNDANGAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BBC12E5E050640A29034DA5',
                    'cepat_kode' => 2968,
                    'nama' => 'DIKLAT FUNGSIONAL PERAWAT'
                ),
                array(
                    'bkn_id' => '8B91B70E3BBD12E5E050640A29034DA5',
                    'cepat_kode' => 2969,
                    'nama' => 'DIKLAT FUNGSIONAL PERAWAT GIGI'
                ),
                array(
                    'bkn_id' => '8B91B70E3BBE12E5E050640A29034DA5',
                    'cepat_kode' => 2970,
                    'nama' => 'DIKLAT FUNGSIONAL PEREKAM MEDIS'
                ),
                array(
                    'bkn_id' => '8B91B70E3BF512E5E050640A29034DA5',
                    'cepat_kode' => 3025,
                    'nama' => 'DIKLAT FUNGSIONAL PEREKAYASA'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0612E5E050640A29034DA5',
                    'cepat_kode' => 3042,
                    'nama' => 'DIKLAT FUNGSIONAL PERENCANA'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0E12E5E050640A29034DA5',
                    'cepat_kode' => 3050,
                    'nama' => 'DIKLAT FUNGSIONAL PERISALAH LEGISLATIF'
                ),
                array(
                    'bkn_id' => '8B91B70E3BD712E5E050640A29034DA5',
                    'cepat_kode' => 2995,
                    'nama' => 'DIKLAT FUNGSIONAL POLISI KEHUTANAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B7E12E5E050640A29034DA5',
                    'cepat_kode' => 2906,
                    'nama' => 'DIKLAT FUNGSIONAL POLISI PAMONG PRAJA (POL PP)'
                ),
                array(
                    'bkn_id' => '8B91B70E3BE912E5E050640A29034DA5',
                    'cepat_kode' => 3013,
                    'nama' => 'DIKLAT FUNGSIONAL PRANATA HUBUNGAN MASYARAKAT'
                ),
                array(
                    'bkn_id' => '8B91B70E3B6612E5E050640A29034DA5',
                    'cepat_kode' => 2882,
                    'nama' => 'DIKLAT FUNGSIONAL PRANATA INFORMASI DIPLOMATIK'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0412E5E050640A29034DA5',
                    'cepat_kode' => 3040,
                    'nama' => 'DIKLAT FUNGSIONAL PRANATA KOMPUTER'
                ),
                array(
                    'bkn_id' => '8B91B70E3B8512E5E050640A29034DA5',
                    'cepat_kode' => 2913,
                    'nama' => 'DIKLAT FUNGSIONAL PRANATA LABORATORIUM KEMETROLOGIAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BBF12E5E050640A29034DA5',
                    'cepat_kode' => 2971,
                    'nama' => 'DIKLAT FUNGSIONAL PRANATA LABORATORIUM KESEHATAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BAA12E5E050640A29034DA5',
                    'cepat_kode' => 2950,
                    'nama' => 'DIKLAT FUNGSIONAL PRANATA LABORATORIUM PENDIDIKAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0112E5E050640A29034DA5',
                    'cepat_kode' => 3037,
                    'nama' => 'DIKLAT FUNGSIONAL PRANATA NUKLIR'
                ),
                array(
                    'bkn_id' => '8B91B70E3BE812E5E050640A29034DA5',
                    'cepat_kode' => 3012,
                    'nama' => 'DIKLAT FUNGSIONAL PRANATA SIARAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BC012E5E050640A29034DA5',
                    'cepat_kode' => 2972,
                    'nama' => 'DIKLAT FUNGSIONAL PSIKOLOG KLINIS'
                ),
                array(
                    'bkn_id' => '8B91B70E3BF812E5E050640A29034DA5',
                    'cepat_kode' => 3028,
                    'nama' => 'DIKLAT FUNGSIONAL PUSTAKAWAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BC112E5E050640A29034DA5',
                    'cepat_kode' => 2973,
                    'nama' => 'DIKLAT FUNGSIONAL RADIOGRAFER'
                ),
                array(
                    'bkn_id' => '8B91B70E3BC212E5E050640A29034DA5',
                    'cepat_kode' => 2974,
                    'nama' => 'DIKLAT FUNGSIONAL REFRAKSIONIS OPTISIEN'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0A12E5E050640A29034DA5',
                    'cepat_kode' => 3046,
                    'nama' => 'DIKLAT FUNGSIONAL RESCUER'
                ),
                array(
                    'bkn_id' => '8B91B70E3BF212E5E050640A29034DA5',
                    'cepat_kode' => 3022,
                    'nama' => 'DIKLAT FUNGSIONAL SANDIMAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BC312E5E050640A29034DA5',
                    'cepat_kode' => 2975,
                    'nama' => 'DIKLAT FUNGSIONAL SANITARIAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3C0512E5E050640A29034DA5',
                    'cepat_kode' => 3041,
                    'nama' => 'DIKLAT FUNGSIONAL STATISTISI'
                ),
                array(
                    'bkn_id' => '8B91B70E3BF312E5E050640A29034DA5',
                    'cepat_kode' => 3023,
                    'nama' => 'DIKLAT FUNGSIONAL SURVEYOR PEMETAAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9D12E5E050640A29034DA5',
                    'cepat_kode' => 2937,
                    'nama' => 'DIKLAT FUNGSIONAL TEKNIK JALAN DAN JEMBATAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9E12E5E050640A29034DA5',
                    'cepat_kode' => 2938,
                    'nama' => 'DIKLAT FUNGSIONAL TEKNIK PENGAIRAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BA012E5E050640A29034DA5',
                    'cepat_kode' => 2940,
                    'nama' => 'DIKLAT FUNGSIONAL TEKNIK PENYEHATAN LINGKUNGAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B9F12E5E050640A29034DA5',
                    'cepat_kode' => 2939,
                    'nama' => 'DIKLAT FUNGSIONAL TEKNIK TATA BANGUNAN DAN PERUMAHAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BC412E5E050640A29034DA5',
                    'cepat_kode' => 2976,
                    'nama' => 'DIKLAT FUNGSIONAL TEKNISI ELEKTROMEDIS'
                ),
                array(
                    'bkn_id' => '8B91B70E3BC512E5E050640A29034DA5',
                    'cepat_kode' => 2977,
                    'nama' => 'DIKLAT FUNGSIONAL TEKNISI GIGI'
                ),
                array(
                    'bkn_id' => '8B91B70E3BF612E5E050640A29034DA5',
                    'cepat_kode' => 3026,
                    'nama' => 'DIKLAT FUNGSIONAL TEKNISI PENELITIAN DAN PEREKAYASAAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3B6912E5E050640A29034DA5',
                    'cepat_kode' => 2885,
                    'nama' => 'DIKLAT FUNGSIONAL TEKNISI PENERBANGAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BEB12E5E050640A29034DA5',
                    'cepat_kode' => 3015,
                    'nama' => 'DIKLAT FUNGSIONAL TEKNISI SIARAN'
                ),
                array(
                    'bkn_id' => '8B91B70E3BC612E5E050640A29034DA5',
                    'cepat_kode' => 2978,
                    'nama' => 'DIKLAT FUNGSIONAL TEKNISI TRANSFUSI DARAH'
                ),
                array(
                    'bkn_id' => '8B91B70E3BC712E5E050640A29034DA5',
                    'cepat_kode' => 2979,
                    'nama' => 'DIKLAT FUNGSIONAL TERAPIS WICARA'
                ),
                array(
                    'bkn_id' => '8B91B70E3BFE12E5E050640A29034DA5',
                    'cepat_kode' => 3034,
                    'nama' => 'DIKLAT FUNGSIONAL WIDYAISWARA'
                ),
                array(
                    'bkn_id' => 'D834501E63B63A8CE050640AF10824F4',
                    'cepat_kode' => 3144,
                    'nama' => 'DIKLAT HUMAS'
                ),
                array(
                    'bkn_id' => 'D834501E63AC3A8CE050640AF10824F4',
                    'cepat_kode' => 3134,
                    'nama' => 'DIKLAT INFORMATION COMMUNICATION TECHNOLOGY'
                ),
                array(
                    'bkn_id' => 'A5EB03E2022DF6A0E040640A040252AD',
                    'cepat_kode' => 2054,
                    'nama' => 'DIKLAT KADER PEMBIBITAN UDANG'
                ),
                array(
                    'bkn_id' => 'A5EB03E2022EF6A0E040640A040252AD',
                    'cepat_kode' => 2055,
                    'nama' => 'DIKLAT KEPEMIMPINAN SERIKAT BURUH'
                ),
                array(
                    'bkn_id' => 'A5EB03E2022FF6A0E040640A040252AD',
                    'cepat_kode' => 2056,
                    'nama' => 'DIKLAT KEPENDUDUKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20230F6A0E040640A040252AD',
                    'cepat_kode' => 2057,
                    'nama' => 'DIKLAT LANJUTAN PETUGAS OPERATOR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20221F6A0E040640A040252AD',
                    'cepat_kode' => 2042,
                    'nama' => 'DIKLAT LLD/PKB'
                ),
                array(
                    'bkn_id' => 'A5EB03E20222F6A0E040640A040252AD',
                    'cepat_kode' => 2043,
                    'nama' => 'DIKLAT MANTRI HEWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20223F6A0E040640A040252AD',
                    'cepat_kode' => 2044,
                    'nama' => 'DIKLAT MASTER OF CEREMONY (MC)'
                ),
                array(
                    'bkn_id' => 'A5EB03E20224F6A0E040640A040252AD',
                    'cepat_kode' => 2045,
                    'nama' => 'DIKLAT MONITORING & PELAPORAN PEMBANG.'
                ),
                array(
                    'bkn_id' => 'D834501E63BB3A8CE050640AF10824F4',
                    'cepat_kode' => 3149,
                    'nama' => 'DIKLAT MULTICAMERA MUSIK'
                ),
                array(
                    'bkn_id' => 'D834501E63C03A8CE050640AF10824F4',
                    'cepat_kode' => 3154,
                    'nama' => 'DIKLAT MULTIPLEXING'
                ),
                array(
                    'bkn_id' => 'D834501E63B53A8CE050640AF10824F4',
                    'cepat_kode' => 3143,
                    'nama' => 'DIKLAT OPERATOR AC NIELSON'
                ),
                array(
                    'bkn_id' => 'A5EB03E20231F6A0E040640A040252AD',
                    'cepat_kode' => 2058,
                    'nama' => 'DIKLAT OPERATOR KOMPUTER'
                ),
                array(
                    'bkn_id' => 'A5EB03E20225F6A0E040640A040252AD',
                    'cepat_kode' => 2046,
                    'nama' => 'DIKLAT PENANGGULANGAN BAHAYA KEBAKARAN'
                ),
                array(
                    'bkn_id' => 'D834501E63B93A8CE050640AF10824F4',
                    'cepat_kode' => 3147,
                    'nama' => 'DIKLAT PENDAHULUAN JURNALISTIK TV'
                ),
                array(
                    'bkn_id' => 'D834501E63B83A8CE050640AF10824F4',
                    'cepat_kode' => 3146,
                    'nama' => 'DIKLAT PENDAHULUAN PRODUKSI'
                ),
                array(
                    'bkn_id' => 'D834501E63BA3A8CE050640AF10824F4',
                    'cepat_kode' => 3148,
                    'nama' => 'DIKLAT PENDAHULUAN TOS (TEKNIK OPERASIONAL STUDIO)'
                ),
                array(
                    'bkn_id' => 'A5EB03E20232F6A0E040640A040252AD',
                    'cepat_kode' => 2059,
                    'nama' => 'DIKLAT PENGAMANAN KESEHATAN HAJI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20233F6A0E040640A040252AD',
                    'cepat_kode' => 2060,
                    'nama' => 'DIKLAT PENILAIAN HARTA TETAP'
                ),
                array(
                    'bkn_id' => 'A5EB03E20236F6A0E040640A040252AD',
                    'cepat_kode' => 2063,
                    'nama' => 'DIKLAT PENYULUH PERIKANAN TK.II'
                ),
                array(
                    'bkn_id' => 'A5EB03E20235F6A0E040640A040252AD',
                    'cepat_kode' => 2062,
                    'nama' => 'DIKLAT PENYULUH PERTANIAN/PERIKANAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EEBFEB31E050640AF10844ED',
                    'cepat_kode' => 3159,
                    'nama' => 'DIKLAT PENYUSUNAN KURIKULUM'
                ),
                array(
                    'bkn_id' => 'E67F0157EEC0EB31E050640AF10844ED',
                    'cepat_kode' => 3160,
                    'nama' => 'DIKLAT PENYUSUNAN MODUL'
                ),
                array(
                    'bkn_id' => 'A5EB03E20226F6A0E040640A040252AD',
                    'cepat_kode' => 2047,
                    'nama' => 'DIKLAT PERPUSTAKAAN KELILING'
                ),
                array(
                    'bkn_id' => 'A5EB03E20227F6A0E040640A040252AD',
                    'cepat_kode' => 2048,
                    'nama' => 'DIKLAT PROYEK MANAGEMENT SISTEM'
                ),
                array(
                    'bkn_id' => 'D834501E63AF3A8CE050640AF10824F4',
                    'cepat_kode' => 3137,
                    'nama' => 'DIKLAT REPORTER OLAHRAGA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20237F6A0E040640A040252AD',
                    'cepat_kode' => 2064,
                    'nama' => 'DIKLAT SANDI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20238F6A0E040640A040252AD',
                    'cepat_kode' => 2065,
                    'nama' => 'DIKLAT SJDI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20228F6A0E040640A040252AD',
                    'cepat_kode' => 2049,
                    'nama' => 'DIKLAT TEK. & MANAG. PERENC. PEMBANG.'
                ),
                array(
                    'bkn_id' => 'CEB02F55C44C5BA2E050640AF1085889',
                    'cepat_kode' => 3078,
                    'nama' => 'DIKLAT TEKNIS ANALIS ANGGARAN'
                ),
                array(
                    'bkn_id' => 'CEB02F55C45C5BA2E050640AF1085889',
                    'cepat_kode' => 3094,
                    'nama' => 'DIKLAT TEKNIS ANALIS HUKUM'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4545BA2E050640AF1085889',
                    'cepat_kode' => 3086,
                    'nama' => 'DIKLAT TEKNIS ANALIS KEBIJAKAN'
                ),
                array(
                    'bkn_id' => 'CF556584FA51276BE050640AF108582B',
                    'cepat_kode' => 3119,
                    'nama' => 'DIKLAT TEKNIS ANALIS KETATALAKSANAAN'
                ),
                array(
                    'bkn_id' => 'CF556584FA52276BE050640AF108582B',
                    'cepat_kode' => 3120,
                    'nama' => 'DIKLAT TEKNIS ANALIS SDM APARATUR'
                ),
                array(
                    'bkn_id' => 'CEB02F55C44D5BA2E050640AF1085889',
                    'cepat_kode' => 3079,
                    'nama' => 'DIKLAT TEKNIS ARSIPARIS'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4515BA2E050640AF1085889',
                    'cepat_kode' => 3083,
                    'nama' => 'DIKLAT TEKNIS ASESOR SDM'
                ),
                array(
                    'bkn_id' => 'CF556584FA53276BE050640AF108582B',
                    'cepat_kode' => 3121,
                    'nama' => 'DIKLAT TEKNIS ASESOR SDM APARATUR'
                ),
                array(
                    'bkn_id' => 'CF556584FA54276BE050640AF108582B',
                    'cepat_kode' => 3122,
                    'nama' => 'DIKLAT TEKNIS AUDITOR'
                ),
                array(
                    'bkn_id' => 'CEB02F55C44F5BA2E050640AF1085889',
                    'cepat_kode' => 3081,
                    'nama' => 'DIKLAT TEKNIS AUDITOR'
                ),
                array(
                    'bkn_id' => 'CEB02F55C45D5BA2E050640AF1085889',
                    'cepat_kode' => 3095,
                    'nama' => 'DIKLAT TEKNIS PELAKSANA'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4535BA2E050640AF1085889',
                    'cepat_kode' => 3085,
                    'nama' => 'DIKLAT TEKNIS PENATA LAKSANA BARANG'
                ),
                array(
                    'bkn_id' => 'CF556584FA55276BE050640AF108582B',
                    'cepat_kode' => 3123,
                    'nama' => 'DIKLAT TEKNIS PENELAAH HUKUM'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4495BA2E050640AF1085889',
                    'cepat_kode' => 3075,
                    'nama' => 'DIKLAT TEKNIS PENGAWAS FARMASI DAN MAKANAN'
                ),
                array(
                    'bkn_id' => 'CF556584FA56276BE050640AF108582B',
                    'cepat_kode' => 3124,
                    'nama' => 'DIKLAT TEKNIS PENGELOLA BARANG MILIK NEGARA'
                ),
                array(
                    'bkn_id' => 'CEB02F55C44A5BA2E050640AF1085889',
                    'cepat_kode' => 3076,
                    'nama' => 'DIKLAT TEKNIS PENGELOLA KEUANGAN APBN'
                ),
                array(
                    'bkn_id' => 'CEB02F55C44B5BA2E050640AF1085889',
                    'cepat_kode' => 3077,
                    'nama' => 'DIKLAT TEKNIS PENGELOLA PENGADAAN BARANG DAN JASA'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4525BA2E050640AF1085889',
                    'cepat_kode' => 3084,
                    'nama' => 'DIKLAT TEKNIS PENGELOLA SDM APARATUR'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4555BA2E050640AF1085889',
                    'cepat_kode' => 3087,
                    'nama' => 'DIKLAT TEKNIS PENGEMBANGAN TEKNOLOGI PEMBELAJARAN'
                ),
                array(
                    'bkn_id' => 'CEB02F55C44E5BA2E050640AF1085889',
                    'cepat_kode' => 3080,
                    'nama' => 'DIKLAT TEKNIS PERANCANG UNDANG-UNDANG'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4575BA2E050640AF1085889',
                    'cepat_kode' => 3089,
                    'nama' => 'DIKLAT TEKNIS PERENCANA'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4565BA2E050640AF1085889',
                    'cepat_kode' => 3088,
                    'nama' => 'DIKLAT TEKNIS PRANATA HUMAS'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4505BA2E050640AF1085889',
                    'cepat_kode' => 3082,
                    'nama' => 'DIKLAT TEKNIS PRANATA KOMPUTER'
                ),
                array(
                    'bkn_id' => 'CF556584FA58276BE050640AF108582B',
                    'cepat_kode' => 3126,
                    'nama' => 'DIKLAT TEKNIS PRANATA SDM APARATUR'
                ),
                array(
                    'bkn_id' => 'D8BE940B5EAB87A4E050640AF1080D2C',
                    'cepat_kode' => 3157,
                    'nama' => 'DIKLAT TEKNIS PRANATA SIARAN'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4585BA2E050640AF1085889',
                    'cepat_kode' => 3090,
                    'nama' => 'DIKLAT TEKNIS PSIKOLOGI KLINIS'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4595BA2E050640AF1085889',
                    'cepat_kode' => 3091,
                    'nama' => 'DIKLAT TEKNIS PUSTAKAWAN'
                ),
                array(
                    'bkn_id' => 'CF556584FA59276BE050640AF108582B',
                    'cepat_kode' => 3127,
                    'nama' => 'DIKLAT TEKNIS SEKRETARIS'
                ),
                array(
                    'bkn_id' => 'CEB02F55C45A5BA2E050640AF1085889',
                    'cepat_kode' => 3092,
                    'nama' => 'DIKLAT TEKNIS STATISTISI'
                ),
                array(
                    'bkn_id' => 'CEB02F55C45E5BA2E050640AF1085889',
                    'cepat_kode' => 3096,
                    'nama' => 'DIKLAT TEKNIS STRUKTURAL'
                ),
                array(
                    'bkn_id' => 'D07CD28E524AC8B3E050640AF1084D6F',
                    'cepat_kode' => 3129,
                    'nama' => 'DIKLAT TEKNIS TELEKOMUNIKASI'
                ),
                array(
                    'bkn_id' => 'CF556584FA5A276BE050640AF108582B',
                    'cepat_kode' => 3128,
                    'nama' => 'DIKLAT TEKNIS VERIFIKATUR KEUANGAN'
                ),
                array(
                    'bkn_id' => 'CEB02F55C45B5BA2E050640AF1085889',
                    'cepat_kode' => 3093,
                    'nama' => 'DIKLAT TEKNIS WIDYAISWARA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20239F6A0E040640A040252AD',
                    'cepat_kode' => 2066,
                    'nama' => 'DIKLAT TEKNOLOGI PERIKANAN AIR PAYAU'
                ),
                array(
                    'bkn_id' => 'A5EB03E2023AF6A0E040640A040252AD',
                    'cepat_kode' => 2067,
                    'nama' => 'DIKLAT TEKNOLOGI PERIKANAN AIR TAWAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20229F6A0E040640A040252AD',
                    'cepat_kode' => 2050,
                    'nama' => 'DIKLAT TENAGA PENELITI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2023BF6A0E040640A040252AD',
                    'cepat_kode' => 2068,
                    'nama' => 'DIKLAT TENAGA SOSIAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E2022AF6A0E040640A040252AD',
                    'cepat_kode' => 2051,
                    'nama' => 'DIKLAT TERNAK BABI'
                ),
                array(
                    'bkn_id' => 'D834501E63AA3A8CE050640AF10824F4',
                    'cepat_kode' => 3132,
                    'nama' => 'DIKLAT TRAINING OF TRAINER'
                ),
                array(
                    'bkn_id' => 'D834501E63B33A8CE050640AF10824F4',
                    'cepat_kode' => 3141,
                    'nama' => 'DIKLAT UMUM VIDEO EDITOR (ONLINE - PERHUBUNGAN)'
                ),
                array(
                    'bkn_id' => 'A5EB03E2023CF6A0E040640A040252AD',
                    'cepat_kode' => 2069,
                    'nama' => 'DRAINASE JALAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2023DF6A0E040640A040252AD',
                    'cepat_kode' => 2070,
                    'nama' => 'EKONOMI PERTANIAN'
                ),
                array(
                    'bkn_id' => 'D834501E63B43A8CE050640AF10824F4',
                    'cepat_kode' => 3142,
                    'nama' => 'ELECTRICAL GROUNDING'
                ),
                array(
                    'bkn_id' => 'A5EB03E2023EF6A0E040640A040252AD',
                    'cepat_kode' => 2071,
                    'nama' => 'ENGINE/MESIN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2023FF6A0E040640A040252AD',
                    'cepat_kode' => 2072,
                    'nama' => 'FORUM KONST. BIDANG PENANAMAN MODAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E20240F6A0E040640A040252AD',
                    'cepat_kode' => 2073,
                    'nama' => 'FRAMBUSIA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20241F6A0E040640A040252AD',
                    'cepat_kode' => 2074,
                    'nama' => 'FUNGSI ADMINISTRASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20432F6A0E040640A040252AD',
                    'cepat_kode' => 2759,
                    'nama' => 'GAS PENYULUHAN BIN TERPADU DESA TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20242F6A0E040640A040252AD',
                    'cepat_kode' => 2075,
                    'nama' => 'GAS REGISTER'
                ),
                array(
                    'bkn_id' => 'A5EB03E20243F6A0E040640A040252AD',
                    'cepat_kode' => 2076,
                    'nama' => 'GENERAL GUIDE'
                ),
                array(
                    'bkn_id' => 'A5EB03E20244F6A0E040640A040252AD',
                    'cepat_kode' => 2077,
                    'nama' => 'HAMA DAN PENYAKIT'
                ),
                array(
                    'bkn_id' => 'A5EB03E20245F6A0E040640A040252AD',
                    'cepat_kode' => 2078,
                    'nama' => 'HANDLUS SEMEN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20246F6A0E040640A040252AD',
                    'cepat_kode' => 2079,
                    'nama' => 'HIJAUAN MAKANAN TERNAK'
                ),
                array(
                    'bkn_id' => 'A5EB03E20247F6A0E040640A040252AD',
                    'cepat_kode' => 2080,
                    'nama' => 'HIMPUNAN PETUGAS PETERNAK SAPI PERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20248F6A0E040640A040252AD',
                    'cepat_kode' => 2081,
                    'nama' => 'HMT/KONSENTRAT'
                ),
                array(
                    'bkn_id' => 'A5EB03E20249F6A0E040640A040252AD',
                    'cepat_kode' => 2082,
                    'nama' => 'HUMAS INDUSTRI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2024BF6A0E040640A040252AD',
                    'cepat_kode' => 2084,
                    'nama' => 'IB. (KETRAMPILAN KAWIN SUNTIK)'
                ),
                array(
                    'bkn_id' => 'A5EB03E2024AF6A0E040640A040252AD',
                    'cepat_kode' => 2083,
                    'nama' => 'IBEC'
                ),
                array(
                    'bkn_id' => 'E67F0157EEC1EB31E050640AF10844ED',
                    'cepat_kode' => 3161,
                    'nama' => 'IDEOLOGI PANCASILA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2024CF6A0E040640A040252AD',
                    'cepat_kode' => 2085,
                    'nama' => 'INDUCTION TRAIN. BI&G TNMN KOPI & KELAPA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2024DF6A0E040640A040252AD',
                    'cepat_kode' => 2086,
                    'nama' => 'INPACT POIN SUB SEKTOR PETERNAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2024EF6A0E040640A040252AD',
                    'cepat_kode' => 2087,
                    'nama' => 'INSEMINATOR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20254F6A0E040640A040252AD',
                    'cepat_kode' => 2093,
                    'nama' => 'INSEMINATOR STERILISASI KEBIDANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2024FF6A0E040640A040252AD',
                    'cepat_kode' => 2088,
                    'nama' => 'INSERI IUD'
                ),
                array(
                    'bkn_id' => 'A5EB03E20250F6A0E040640A040252AD',
                    'cepat_kode' => 2089,
                    'nama' => 'INSERVE TRAINING KEPALA SD'
                ),
                array(
                    'bkn_id' => 'A5EB03E20251F6A0E040640A040252AD',
                    'cepat_kode' => 2090,
                    'nama' => 'INSTRUKTUR CIPTA KARYA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20252F6A0E040640A040252AD',
                    'cepat_kode' => 2091,
                    'nama' => 'INTEG.ASPEK KEPEND.DLM PERENC.PEMBANG.'
                ),
                array(
                    'bkn_id' => 'A5EB03E20253F6A0E040640A040252AD',
                    'cepat_kode' => 2092,
                    'nama' => 'IPTEK'
                ),
                array(
                    'bkn_id' => 'A5EB03E20255F6A0E040640A040252AD',
                    'cepat_kode' => 2094,
                    'nama' => 'JOB TRAINING ADMINISTRASI KEPENDUDUKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20257F6A0E040640A040252AD',
                    'cepat_kode' => 2096,
                    'nama' => 'JOB TRAINING CATATAN SIPIL'
                ),
                array(
                    'bkn_id' => 'A5EB03E20256F6A0E040640A040252AD',
                    'cepat_kode' => 2095,
                    'nama' => 'JOB TRAINING PETUGAS PERPUSTAKAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20258F6A0E040640A040252AD',
                    'cepat_kode' => 2097,
                    'nama' => 'JURU PENGAIRAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20259F6A0E040640A040252AD',
                    'cepat_kode' => 2098,
                    'nama' => 'JURU PERIKSA DAGING'
                ),
                array(
                    'bkn_id' => 'A5EB03E2025AF6A0E040640A040252AD',
                    'cepat_kode' => 2099,
                    'nama' => 'JURU PERIKSA HEWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2025BF6A0E040640A040252AD',
                    'cepat_kode' => 2100,
                    'nama' => 'JURU SITA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2025CF6A0E040640A040252AD',
                    'cepat_kode' => 2101,
                    'nama' => 'KADER PETERNAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2025DF6A0E040640A040252AD',
                    'cepat_kode' => 2102,
                    'nama' => 'KASI PENYULUHAN PERTANIAN KABUPATEN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2025EF6A0E040640A040252AD',
                    'cepat_kode' => 2103,
                    'nama' => 'KB KESEHATAN'
                ),
                array(
                    'bkn_id' => '203EC71A5EE7556AE050640A02020497',
                    'cepat_kode' => 2878,
                    'nama' => 'KELOMPOK KERJA GURU'
                ),
                array(
                    'bkn_id' => '315A64AF2ACBE9EDE050640A29020F6C',
                    'cepat_kode' => 2879,
                    'nama' => 'KEPEMIMPINAN DAN SUMBER DAYA MANUSIA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2025FF6A0E040640A040252AD',
                    'cepat_kode' => 2104,
                    'nama' => 'KEPROTOKOLAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20260F6A0E040640A040252AD',
                    'cepat_kode' => 2105,
                    'nama' => 'KEPUSTAKAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20261F6A0E040640A040252AD',
                    'cepat_kode' => 2106,
                    'nama' => 'KESEHATAN HEWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20262F6A0E040640A040252AD',
                    'cepat_kode' => 2107,
                    'nama' => 'KESEHATAN LINGKUNGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2026CF6A0E040640A040252AD',
                    'cepat_kode' => 2117,
                    'nama' => 'KET KHUSUS PEMASARAN PETERNAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20263F6A0E040640A040252AD',
                    'cepat_kode' => 2108,
                    'nama' => 'KETERAMPILAN BUDUDAYA UDANG'
                ),
                array(
                    'bkn_id' => 'A5EB03E20264F6A0E040640A040252AD',
                    'cepat_kode' => 2109,
                    'nama' => 'KETERAMPILAN LABORATORIUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E20266F6A0E040640A040252AD',
                    'cepat_kode' => 2111,
                    'nama' => 'KETERAMPILAN PENANGGULANGAN HAMA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20268F6A0E040640A040252AD',
                    'cepat_kode' => 2113,
                    'nama' => 'KETRAMPILAN PERTAMANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20269F6A0E040640A040252AD',
                    'cepat_kode' => 2114,
                    'nama' => 'KETRAMPILAN PETUGAS TEKNIS PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2026AF6A0E040640A040252AD',
                    'cepat_kode' => 2115,
                    'nama' => 'KETRAMPILAN TEKNIK BIDANG PENGAMAT'
                ),
                array(
                    'bkn_id' => 'A5EB03E20265F6A0E040640A040252AD',
                    'cepat_kode' => 2110,
                    'nama' => 'KETRAMP.LABORATORIUM KESEHATAN HEWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2026DF6A0E040640A040252AD',
                    'cepat_kode' => 2118,
                    'nama' => 'KIPI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2026EF6A0E040640A040252AD',
                    'cepat_kode' => 2119,
                    'nama' => 'KKD'
                ),
                array(
                    'bkn_id' => 'E67F0157EEC2EB31E050640AF10844ED',
                    'cepat_kode' => 3162,
                    'nama' => 'KOMUNIKASI PUBLIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2026FF6A0E040640A040252AD',
                    'cepat_kode' => 2120,
                    'nama' => 'KOMUNIKASI TENAGA KES TK.KECAMATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20270F6A0E040640A040252AD',
                    'cepat_kode' => 2121,
                    'nama' => 'KONSTRUKSI TAHAN GEMPA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20271F6A0E040640A040252AD',
                    'cepat_kode' => 2122,
                    'nama' => 'KOPERASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20272F6A0E040640A040252AD',
                    'cepat_kode' => 2123,
                    'nama' => 'KPD'
                ),
                array(
                    'bkn_id' => 'A5EB03E20273F6A0E040640A040252AD',
                    'cepat_kode' => 2124,
                    'nama' => 'KUBADA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20274F6A0E040640A040252AD',
                    'cepat_kode' => 2125,
                    'nama' => 'KUP'
                ),
                array(
                    'bkn_id' => '203EC71A5EE6556AE050640A02020497',
                    'cepat_kode' => 2877,
                    'nama' => 'KURIKULUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E20281F6A0E040640A040252AD',
                    'cepat_kode' => 2138,
                    'nama' => 'KURSUS  BID PEM DAN PEMBANGUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20345F6A0E040640A040252AD',
                    'cepat_kode' => 2250,
                    'nama' => 'KURSUS  PKB'
                ),
                array(
                    'bkn_id' => 'A5EB03E20276F6A0E040640A040252AD',
                    'cepat_kode' => 2127,
                    'nama' => 'KURSUS ADMINISTRASI KEPEGAWAIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20277F6A0E040640A040252AD',
                    'cepat_kode' => 2128,
                    'nama' => 'KURSUS ADMINISTRASI PENGAWASAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20278F6A0E040640A040252AD',
                    'cepat_kode' => 2129,
                    'nama' => 'KURSUS ALSISIS PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20279F6A0E040640A040252AD',
                    'cepat_kode' => 2130,
                    'nama' => 'KURSUS AMDAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E2027BF6A0E040640A040252AD',
                    'cepat_kode' => 2132,
                    'nama' => 'KURSUS ASISTENSI REPRODUKSI TERNAK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2027AF6A0E040640A040252AD',
                    'cepat_kode' => 2131,
                    'nama' => 'KURSUS ASPAL BUTON'
                ),
                array(
                    'bkn_id' => 'A5EB03E2027CF6A0E040640A040252AD',
                    'cepat_kode' => 2133,
                    'nama' => 'KURSUS A.V 1941'
                ),
                array(
                    'bkn_id' => 'A5EB03E2027DF6A0E040640A040252AD',
                    'cepat_kode' => 2134,
                    'nama' => 'KURSUS BANTUAN HUKUM'
                ),
                array(
                    'bkn_id' => 'E67F0157EEC3EB31E050640AF10844ED',
                    'cepat_kode' => 3163,
                    'nama' => 'KURSUS BENDAHARAWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2027EF6A0E040640A040252AD',
                    'cepat_kode' => 2135,
                    'nama' => 'KURSUS BENDAHARAWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2027FF6A0E040640A040252AD',
                    'cepat_kode' => 2136,
                    'nama' => 'KURSUS BENDAHARAWAN A PARALEL'
                ),
                array(
                    'bkn_id' => 'A5EB03E20275F6A0E040640A040252AD',
                    'cepat_kode' => 2126,
                    'nama' => 'KURSUS BON A'
                ),
                array(
                    'bkn_id' => 'A5EB03E20283F6A0E040640A040252AD',
                    'cepat_kode' => 2140,
                    'nama' => 'KURSUS DAERAH RAWAN UPGK'
                ),
                array(
                    'bkn_id' => 'A5EB03E20284F6A0E040640A040252AD',
                    'cepat_kode' => 2141,
                    'nama' => 'KURSUS DASAR-DASAR AMDAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E20286F6A0E040640A040252AD',
                    'cepat_kode' => 2143,
                    'nama' => 'KURSUS DENITAS TEPAT GUNA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20287F6A0E040640A040252AD',
                    'cepat_kode' => 2144,
                    'nama' => 'KURSUS DESIGN JALAN/JEMBATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2028AF6A0E040640A040252AD',
                    'cepat_kode' => 2147,
                    'nama' => 'KURSUS HIJAUAN MAKAN TERNAK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2028BF6A0E040640A040252AD',
                    'cepat_kode' => 2148,
                    'nama' => 'KURSUS INSTRUKTUR PENYULUH INDUSTRI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2028CF6A0E040640A040252AD',
                    'cepat_kode' => 2149,
                    'nama' => 'KURSUS INVENTORY JALAN LOKAL KABUPATEN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2028DF6A0E040640A040252AD',
                    'cepat_kode' => 2150,
                    'nama' => 'KURSUS IRIGASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2028EF6A0E040640A040252AD',
                    'cepat_kode' => 2151,
                    'nama' => 'KURSUS JABATAN PENGAMAT PAJAK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2028FF6A0E040640A040252AD',
                    'cepat_kode' => 2152,
                    'nama' => 'KURSUS JURU GAMBAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20290F6A0E040640A040252AD',
                    'cepat_kode' => 2153,
                    'nama' => 'KURSUS JURU RUNDING'
                ),
                array(
                    'bkn_id' => 'A5EB03E20291F6A0E040640A040252AD',
                    'cepat_kode' => 2154,
                    'nama' => 'KURSUS JURU UKUR'
                ),
                array(
                    'bkn_id' => 'A5EB03E2035BF6A0E040640A040252AD',
                    'cepat_kode' => 2272,
                    'nama' => 'KURSUS KA WAORKSJOP'
                ),
                array(
                    'bkn_id' => 'A5EB03E20292F6A0E040640A040252AD',
                    'cepat_kode' => 2155,
                    'nama' => 'KURSUS KADER PENDAPATAN DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20293F6A0E040640A040252AD',
                    'cepat_kode' => 2156,
                    'nama' => 'KURSUS KEPALA WORKSHOP'
                ),
                array(
                    'bkn_id' => 'A5EB03E20294F6A0E040640A040252AD',
                    'cepat_kode' => 2157,
                    'nama' => 'KURSUS KEPARIWISATAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20295F6A0E040640A040252AD',
                    'cepat_kode' => 2158,
                    'nama' => 'KURSUS KERANGKA PEMB DAN STRATEGI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20296F6A0E040640A040252AD',
                    'cepat_kode' => 2159,
                    'nama' => 'KURSUS KESEJAHTERAAN SOSIAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E20297F6A0E040640A040252AD',
                    'cepat_kode' => 2160,
                    'nama' => 'KURSUS KETATA USAHAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20298F6A0E040640A040252AD',
                    'cepat_kode' => 2161,
                    'nama' => 'KURSUS KEUANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20299F6A0E040640A040252AD',
                    'cepat_kode' => 2162,
                    'nama' => 'KURSUS KOMPUTER'
                ),
                array(
                    'bkn_id' => 'A5EB03E2029AF6A0E040640A040252AD',
                    'cepat_kode' => 2163,
                    'nama' => 'KURSUS KONSERVASI LAHAN PASANG SURUT'
                ),
                array(
                    'bkn_id' => 'A5EB03E2029BF6A0E040640A040252AD',
                    'cepat_kode' => 2164,
                    'nama' => 'KURSUS KONTRASEPSI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2029CF6A0E040640A040252AD',
                    'cepat_kode' => 2165,
                    'nama' => 'KURSUS KOPERASI TK DASAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E2029DF6A0E040640A040252AD',
                    'cepat_kode' => 2166,
                    'nama' => 'KURSUS KUD MANDIRI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2029EF6A0E040640A040252AD',
                    'cepat_kode' => 2167,
                    'nama' => 'KURSUS KURK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2029FF6A0E040640A040252AD',
                    'cepat_kode' => 2168,
                    'nama' => 'KURSUS LABOTARIUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E202A1F6A0E040640A040252AD',
                    'cepat_kode' => 2170,
                    'nama' => 'KURSUS LOAN ADB'
                ),
                array(
                    'bkn_id' => 'A5EB03E2035CF6A0E040640A040252AD',
                    'cepat_kode' => 2273,
                    'nama' => 'KURSUS LPPU'
                ),
                array(
                    'bkn_id' => 'A5EB03E202A4F6A0E040640A040252AD',
                    'cepat_kode' => 2173,
                    'nama' => 'KURSUS MANAJEMEN DAN PENDAPATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202A2F6A0E040640A040252AD',
                    'cepat_kode' => 2171,
                    'nama' => 'KURSUS MANAJEMEN PROYEK'
                ),
                array(
                    'bkn_id' => 'A5EB03E202A5F6A0E040640A040252AD',
                    'cepat_kode' => 2174,
                    'nama' => 'KURSUS MANAJEMEN PROYEK'
                ),
                array(
                    'bkn_id' => 'A5EB03E202A7F6A0E040640A040252AD',
                    'cepat_kode' => 2176,
                    'nama' => 'KURSUS MANDOR'
                ),
                array(
                    'bkn_id' => 'A5EB03E202A8F6A0E040640A040252AD',
                    'cepat_kode' => 2177,
                    'nama' => 'KURSUS MEKANIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E202A9F6A0E040640A040252AD',
                    'cepat_kode' => 2178,
                    'nama' => 'KURSUS MEKANIK ENGINE ELECTRIAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E202AAF6A0E040640A040252AD',
                    'cepat_kode' => 2179,
                    'nama' => 'KURSUS NAMA PENYAKIT TANAMAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202ABF6A0E040640A040252AD',
                    'cepat_kode' => 2180,
                    'nama' => 'KURSUS OBJEK WISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E202ACF6A0E040640A040252AD',
                    'cepat_kode' => 2181,
                    'nama' => 'KURSUS OJT'
                ),
                array(
                    'bkn_id' => 'A5EB03E202ADF6A0E040640A040252AD',
                    'cepat_kode' => 2182,
                    'nama' => 'KURSUS OPERATOR'
                ),
                array(
                    'bkn_id' => 'A5EB03E202AEF6A0E040640A040252AD',
                    'cepat_kode' => 2183,
                    'nama' => 'KURSUS OPERATOR DEP.PU'
                ),
                array(
                    'bkn_id' => 'A5EB03E202B7F6A0E040640A040252AD',
                    'cepat_kode' => 2192,
                    'nama' => 'KURSUS P3A'
                ),
                array(
                    'bkn_id' => 'A5EB03E202B8F6A0E040640A040252AD',
                    'cepat_kode' => 2193,
                    'nama' => 'KURSUS P3KN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202B9F6A0E040640A040252AD',
                    'cepat_kode' => 2194,
                    'nama' => 'KURSUS P5D'
                ),
                array(
                    'bkn_id' => 'A5EB03E202BAF6A0E040640A040252AD',
                    'cepat_kode' => 2195,
                    'nama' => 'KURSUS PAPTES'
                ),
                array(
                    'bkn_id' => 'A5EB03E202BCF6A0E040640A040252AD',
                    'cepat_kode' => 2197,
                    'nama' => 'KURSUS PELAKSANA KONTRUKSI JALAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202BDF6A0E040640A040252AD',
                    'cepat_kode' => 2198,
                    'nama' => 'KURSUS PELATIH KADER PEMB DESA TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E202C1F6A0E040640A040252AD',
                    'cepat_kode' => 2202,
                    'nama' => 'KURSUS PEMBANTU BATU CETAK'
                ),
                array(
                    'bkn_id' => 'A5EB03E202C3F6A0E040640A040252AD',
                    'cepat_kode' => 2204,
                    'nama' => 'KURSUS PEMBINAAN LLAJR'
                ),
                array(
                    'bkn_id' => 'A5EB03E202C4F6A0E040640A040252AD',
                    'cepat_kode' => 2205,
                    'nama' => 'KURSUS PEMBINAAN PEMERINTAHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202C5F6A0E040640A040252AD',
                    'cepat_kode' => 2206,
                    'nama' => 'KURSUS PEMBINAAN TENAGA KERJA'
                ),
                array(
                    'bkn_id' => 'A5EB03E202C6F6A0E040640A040252AD',
                    'cepat_kode' => 2207,
                    'nama' => 'KURSUS PEMERIKSAAN KEBUNTINGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2031BF6A0E040640A040252AD',
                    'cepat_kode' => 2208,
                    'nama' => 'KURSUS PENDAPATAN DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E2031CF6A0E040640A040252AD',
                    'cepat_kode' => 2209,
                    'nama' => 'KURSUS PENDIDIKAN RONTGEN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2031DF6A0E040640A040252AD',
                    'cepat_kode' => 2210,
                    'nama' => 'KURSUS PENEGAK HUKUM LINGKUNGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2031EF6A0E040640A040252AD',
                    'cepat_kode' => 2211,
                    'nama' => 'KURSUS PENGAIRAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2031FF6A0E040640A040252AD',
                    'cepat_kode' => 2212,
                    'nama' => 'KURSUS PENGATUR PERJALAN WISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20320F6A0E040640A040252AD',
                    'cepat_kode' => 2213,
                    'nama' => 'KURSUS PENGATUR WISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20321F6A0E040640A040252AD',
                    'cepat_kode' => 2214,
                    'nama' => 'KURSUS PENGAWAS BANGUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20322F6A0E040640A040252AD',
                    'cepat_kode' => 2215,
                    'nama' => 'KURSUS PENGAWAS LAPANGAN IPJK'
                ),
                array(
                    'bkn_id' => 'A5EB03E20323F6A0E040640A040252AD',
                    'cepat_kode' => 2216,
                    'nama' => 'KURSUS PENGAWAS PELAKSANA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20324F6A0E040640A040252AD',
                    'cepat_kode' => 2217,
                    'nama' => 'KURSUS PENGAWASAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20325F6A0E040640A040252AD',
                    'cepat_kode' => 2218,
                    'nama' => 'KURSUS PENGAWASAN MUTU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20326F6A0E040640A040252AD',
                    'cepat_kode' => 2219,
                    'nama' => 'KURSUS PENGAWASAN PELAKSANAAN PUK'
                ),
                array(
                    'bkn_id' => 'A5EB03E20329F6A0E040640A040252AD',
                    'cepat_kode' => 2222,
                    'nama' => 'KURSUS PENGENDALIAN HAMA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2032AF6A0E040640A040252AD',
                    'cepat_kode' => 2223,
                    'nama' => 'KURSUS PENGENDALIAN MUTU'
                ),
                array(
                    'bkn_id' => 'A5EB03E2032BF6A0E040640A040252AD',
                    'cepat_kode' => 2224,
                    'nama' => 'KURSUS PENGURUS KPN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2032DF6A0E040640A040252AD',
                    'cepat_kode' => 2226,
                    'nama' => 'KURSUS PENYEGARAN SAPI BALI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20336F6A0E040640A040252AD',
                    'cepat_kode' => 2235,
                    'nama' => 'KURSUS PERENC FISIK PARIWISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20333F6A0E040640A040252AD',
                    'cepat_kode' => 2232,
                    'nama' => 'KURSUS PERENC PEMBANGUNAN PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20334F6A0E040640A040252AD',
                    'cepat_kode' => 2233,
                    'nama' => 'KURSUS PERENC PEMBANGUNAN/KIP'
                ),
                array(
                    'bkn_id' => 'A5EB03E20331F6A0E040640A040252AD',
                    'cepat_kode' => 2230,
                    'nama' => 'KURSUS PERENCAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20332F6A0E040640A040252AD',
                    'cepat_kode' => 2231,
                    'nama' => 'KURSUS PERENCAAN KOTA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20338F6A0E040640A040252AD',
                    'cepat_kode' => 2237,
                    'nama' => 'KURSUS PERHITUNGAN ANGGARAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2033AF6A0E040640A040252AD',
                    'cepat_kode' => 2239,
                    'nama' => 'KURSUS PERPAJAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2033BF6A0E040640A040252AD',
                    'cepat_kode' => 2240,
                    'nama' => 'KURSUS PERPAJAKAN DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E2033CF6A0E040640A040252AD',
                    'cepat_kode' => 2241,
                    'nama' => 'KURSUS PERTELAAHAN STAF PARIPURNA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2033DF6A0E040640A040252AD',
                    'cepat_kode' => 2242,
                    'nama' => 'KURSUS PETUGAS BIDANG BINA MARGA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20341F6A0E040640A040252AD',
                    'cepat_kode' => 2246,
                    'nama' => 'KURSUS PETUGAS PUPT TK NASIONAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E20340F6A0E040640A040252AD',
                    'cepat_kode' => 2245,
                    'nama' => 'KURSUS PETUGAS TERNAK KAMBING'
                ),
                array(
                    'bkn_id' => 'A5EB03E20342F6A0E040640A040252AD',
                    'cepat_kode' => 2247,
                    'nama' => 'KURSUS PIMP PERUSAHAAN PERIKANAN LAUT'
                ),
                array(
                    'bkn_id' => 'A5EB03E20344F6A0E040640A040252AD',
                    'cepat_kode' => 2249,
                    'nama' => 'KURSUS PJM P3KT + KOCP'
                ),
                array(
                    'bkn_id' => 'A5EB03E20349F6A0E040640A040252AD',
                    'cepat_kode' => 2254,
                    'nama' => 'KURSUS QUALITY CONTROL'
                ),
                array(
                    'bkn_id' => 'A5EB03E2034AF6A0E040640A040252AD',
                    'cepat_kode' => 2255,
                    'nama' => 'KURSUS REGIONAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E2034BF6A0E040640A040252AD',
                    'cepat_kode' => 2256,
                    'nama' => 'KURSUS SANITASI TEPAT GUNA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2035DF6A0E040640A040252AD',
                    'cepat_kode' => 2274,
                    'nama' => 'KURSUS SAPI PERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E2034CF6A0E040640A040252AD',
                    'cepat_kode' => 2257,
                    'nama' => 'KURSUS SISTEM PEMBUANGAN LIMBAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E2034EF6A0E040640A040252AD',
                    'cepat_kode' => 2259,
                    'nama' => 'KURSUS STATISTIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2034FF6A0E040640A040252AD',
                    'cepat_kode' => 2260,
                    'nama' => 'KURSUS SUPERVISI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20350F6A0E040640A040252AD',
                    'cepat_kode' => 2261,
                    'nama' => 'KURSUS TEKNIK PERKEBUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20351F6A0E040640A040252AD',
                    'cepat_kode' => 2262,
                    'nama' => 'KURSUS TEKNIK TATA KOTA DAN DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20353F6A0E040640A040252AD',
                    'cepat_kode' => 2264,
                    'nama' => 'KURSUS TEKNIS PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20354F6A0E040640A040252AD',
                    'cepat_kode' => 2265,
                    'nama' => 'KURSUS TEKNISI LABOTARIUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E20352F6A0E040640A040252AD',
                    'cepat_kode' => 2263,
                    'nama' => 'KURSUS TEKNISI RADIO KOMUNIKASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20355F6A0E040640A040252AD',
                    'cepat_kode' => 2266,
                    'nama' => 'KURSUS TEMU KARYA GIZI TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20356F6A0E040640A040252AD',
                    'cepat_kode' => 2267,
                    'nama' => 'KURSUS TENAGA KERJA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20357F6A0E040640A040252AD',
                    'cepat_kode' => 2268,
                    'nama' => 'KURSUS TERTULIS PARIWISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2035AF6A0E040640A040252AD',
                    'cepat_kode' => 2271,
                    'nama' => 'KURSUS URBAN TRANSPORTASI PROJECT IBRD'
                ),
                array(
                    'bkn_id' => 'A5EB03E20359F6A0E040640A040252AD',
                    'cepat_kode' => 2270,
                    'nama' => 'KURSUS USAHA GIZI KELUARGA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20358F6A0E040640A040252AD',
                    'cepat_kode' => 2269,
                    'nama' => 'KURSUS USUS TANAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20362F6A0E040640A040252AD',
                    'cepat_kode' => 2279,
                    'nama' => 'LAT ANALIS KEMAMPUAN MANAJEMEN(AKM)'
                ),
                array(
                    'bkn_id' => 'A5EB03E20365F6A0E040640A040252AD',
                    'cepat_kode' => 2282,
                    'nama' => 'LAT BAGI APARAT PENGEMBANGAN PERKOTAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2035EF6A0E040640A040252AD',
                    'cepat_kode' => 2275,
                    'nama' => 'LAT CATAR MANAG.PEMERINT.WILCAM DI DT II'
                ),
                array(
                    'bkn_id' => 'A5EB03E20303F6A0E040640A040252AD',
                    'cepat_kode' => 2361,
                    'nama' => 'LAT DIK.TNG.SUPERV.BID.PERUB.&PENGEM.SOS'
                ),
                array(
                    'bkn_id' => 'A5EB03E2044FF6A0E040640A040252AD',
                    'cepat_kode' => 2518,
                    'nama' => 'LAT DITEKSI DINI TUMBUH KEMBANG BALITA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203BCF6A0E040640A040252AD',
                    'cepat_kode' => 2453,
                    'nama' => 'LAT GAS CARA PENGGUNAAN RACUN HAMA PENY'
                ),
                array(
                    'bkn_id' => 'A5EB03E20381F6A0E040640A040252AD',
                    'cepat_kode' => 2394,
                    'nama' => 'LAT GAS EK. PERTANIAN DRH TRANSMIGRASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E202CDF6A0E040640A040252AD',
                    'cepat_kode' => 2307,
                    'nama' => 'LAT. INST PENANGGULAN BENCANA ALAM'
                ),
                array(
                    'bkn_id' => 'A5EB03E202CFF6A0E040640A040252AD',
                    'cepat_kode' => 2309,
                    'nama' => 'LAT INTEG.ASP KEPEND.DLM PERENC PEMBANG.'
                ),
                array(
                    'bkn_id' => 'A5EB03E202D0F6A0E040640A040252AD',
                    'cepat_kode' => 2310,
                    'nama' => 'LAT. INTENSIFIKASI PEMBENIHAN IKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202D1F6A0E040640A040252AD',
                    'cepat_kode' => 2311,
                    'nama' => 'LAT INVENTARISASI SENSUS BARANG DIDAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E202D2F6A0E040640A040252AD',
                    'cepat_kode' => 2312,
                    'nama' => 'LAT. KADER PEMBANGUNAN DESA'
                ),
                array(
                    'bkn_id' => 'A5EB03E202DBF6A0E040640A040252AD',
                    'cepat_kode' => 2321,
                    'nama' => 'LAT KERJA PENGAMAT PENGAIRAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202DAF6A0E040640A040252AD',
                    'cepat_kode' => 2320,
                    'nama' => 'LAT KERJA PENYUSUNAN PROG.JANG.MENENGAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E202DCF6A0E040640A040252AD',
                    'cepat_kode' => 2322,
                    'nama' => 'LAT KETRAMPILAN ALAT MESIN PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202DFF6A0E040640A040252AD',
                    'cepat_kode' => 2325,
                    'nama' => 'LAT KETRAMPILAN BETERNAK AYAM BURAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E202DDF6A0E040640A040252AD',
                    'cepat_kode' => 2323,
                    'nama' => 'LAT KETRAMPILAN PENYAKIT HEWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202E0F6A0E040640A040252AD',
                    'cepat_kode' => 2326,
                    'nama' => 'LAT KETRAMPILAN TENAGA TEKNIK PETERNAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202E2F6A0E040640A040252AD',
                    'cepat_kode' => 2328,
                    'nama' => 'LAT KHUSUS KONTRASEPSI BARU'
                ),
                array(
                    'bkn_id' => 'A5EB03E202E3F6A0E040640A040252AD',
                    'cepat_kode' => 2329,
                    'nama' => 'LAT MAIZOSEET TECHNOLOGY COURS'
                ),
                array(
                    'bkn_id' => 'A5EB03E202E5F6A0E040640A040252AD',
                    'cepat_kode' => 2331,
                    'nama' => 'LAT MANAG.PEMB.DESA TERPADU BG SEKWILCAM'
                ),
                array(
                    'bkn_id' => 'A5EB03E202EAF6A0E040640A040252AD',
                    'cepat_kode' => 2336,
                    'nama' => 'LAT MENDISSEMINASI KONSEP TT RUANG KOTA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2030DF6A0E040640A040252AD',
                    'cepat_kode' => 2371,
                    'nama' => 'LAT OPERATOR ALAT METEOROLOGI PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20449F6A0E040640A040252AD',
                    'cepat_kode' => 2512,
                    'nama' => 'LAT PARAMEDIS PUSKESMAS DNG TEMPAT TIDUR'
                ),
                array(
                    'bkn_id' => 'A5EB03E202F1F6A0E040640A040252AD',
                    'cepat_kode' => 2343,
                    'nama' => 'LAT PEG BARU (TTG PAJAK & RETRIBUSI DRH)'
                ),
                array(
                    'bkn_id' => 'A5EB03E202F2F6A0E040640A040252AD',
                    'cepat_kode' => 2344,
                    'nama' => 'LAT PEGAWAI DALAM LINGKUNGAN DIPENDA'
                ),
                array(
                    'bkn_id' => 'A5EB03E202FAF6A0E040640A040252AD',
                    'cepat_kode' => 2352,
                    'nama' => 'LAT PEMILIHAN LOK.PRO PADAT KARYA(WIPAK)'
                ),
                array(
                    'bkn_id' => 'A5EB03E202FEF6A0E040640A040252AD',
                    'cepat_kode' => 2356,
                    'nama' => 'LAT PENANGANAN KES. HEWAN AYAM BURAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E202FFF6A0E040640A040252AD',
                    'cepat_kode' => 2357,
                    'nama' => 'LAT PENANGGUL PETERNAKAN PENDPTAN RENDAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20305F6A0E040640A040252AD',
                    'cepat_kode' => 2363,
                    'nama' => 'LAT PENGAMAT HAMA, ISKARA TEH PRODUKSI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20318F6A0E040640A040252AD',
                    'cepat_kode' => 2382,
                    'nama' => 'LAT PERENC. & TATA LAKSANA PEMBANG. DRH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20378F6A0E040640A040252AD',
                    'cepat_kode' => 2385,
                    'nama' => 'LAT PERENC. & TATA LAKSANA PEMBANG. DRH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20316F6A0E040640A040252AD',
                    'cepat_kode' => 2380,
                    'nama' => 'LAT PERENC.ADM. BAGI KETUA BAPPEDA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2039AF6A0E040640A040252AD',
                    'cepat_kode' => 2419,
                    'nama' => 'LAT PREPARATION MONITOR&EVAL DEVL PROJ.'
                ),
                array(
                    'bkn_id' => 'A5EB03E2039CF6A0E040640A040252AD',
                    'cepat_kode' => 2421,
                    'nama' => 'LAT PROG. INTEGRASI KB KELAPA HIBRIDA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203ABF6A0E040640A040252AD',
                    'cepat_kode' => 2436,
                    'nama' => 'LAT STAF PENYULUHAN SUB SEKT NON PANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203ADF6A0E040640A040252AD',
                    'cepat_kode' => 2438,
                    'nama' => 'LAT STATISTIK PENGOLAH DATA PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202DEF6A0E040640A040252AD',
                    'cepat_kode' => 2324,
                    'nama' => 'LAT TRAMP.REPRO.&KONTROL STERILISASI PHM'
                ),
                array(
                    'bkn_id' => 'A5EB03E20466F6A0E040640A040252AD',
                    'cepat_kode' => 2541,
                    'nama' => 'LAT.GAS LAP. PELAYANAN ANAK TERLANTAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20361F6A0E040640A040252AD',
                    'cepat_kode' => 2278,
                    'nama' => 'LATIHAN ADM PERENC PEMBANGUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20363F6A0E040640A040252AD',
                    'cepat_kode' => 2280,
                    'nama' => 'LATIHAN ANALIS MGT KB KESEHATAN TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20364F6A0E040640A040252AD',
                    'cepat_kode' => 2281,
                    'nama' => 'LATIHAN AUDIO VISUAL AID'
                ),
                array(
                    'bkn_id' => 'A5EB03E20366F6A0E040640A040252AD',
                    'cepat_kode' => 2283,
                    'nama' => 'LATIHAN BERCOCOK TANAM'
                ),
                array(
                    'bkn_id' => 'A5EB03E20367F6A0E040640A040252AD',
                    'cepat_kode' => 2284,
                    'nama' => 'LATIHAN BERCOCOK TANAMAN UBI KAYU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20368F6A0E040640A040252AD',
                    'cepat_kode' => 2285,
                    'nama' => 'LATIHAN BINA MUTU IKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20369F6A0E040640A040252AD',
                    'cepat_kode' => 2286,
                    'nama' => 'LATIHAN BUDIDAYA AIR PAYAU'
                ),
                array(
                    'bkn_id' => 'A5EB03E2036AF6A0E040640A040252AD',
                    'cepat_kode' => 2287,
                    'nama' => 'LATIHAN BUDIDAYA AYAM BURAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E2036BF6A0E040640A040252AD',
                    'cepat_kode' => 2288,
                    'nama' => 'LATIHAN BUDIDAYA JERUK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2036CF6A0E040640A040252AD',
                    'cepat_kode' => 2289,
                    'nama' => 'LATIHAN BUDIDAYA PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2036DF6A0E040640A040252AD',
                    'cepat_kode' => 2290,
                    'nama' => 'LATIHAN CAMAT'
                ),
                array(
                    'bkn_id' => 'A5EB03E2036EF6A0E040640A040252AD',
                    'cepat_kode' => 2291,
                    'nama' => 'LATIHAN DASAR KARET'
                ),
                array(
                    'bkn_id' => 'A5EB03E2036FF6A0E040640A040252AD',
                    'cepat_kode' => 2292,
                    'nama' => 'LATIHAN DASAR PENYULUH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20370F6A0E040640A040252AD',
                    'cepat_kode' => 2293,
                    'nama' => 'LATIHAN DASAR PENYULUHAN P LAPANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20371F6A0E040640A040252AD',
                    'cepat_kode' => 2294,
                    'nama' => 'LATIHAN DASAR PERENCANAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20372F6A0E040640A040252AD',
                    'cepat_kode' => 2295,
                    'nama' => 'LATIHAN DASAR PERLINDUNGAN TANAMAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20373F6A0E040640A040252AD',
                    'cepat_kode' => 2296,
                    'nama' => 'LATIHAN DASAR PPL'
                ),
                array(
                    'bkn_id' => 'A5EB03E20374F6A0E040640A040252AD',
                    'cepat_kode' => 2297,
                    'nama' => 'LATIHAN DASAR PPL/TEKNIS PERKEBUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20375F6A0E040640A040252AD',
                    'cepat_kode' => 2298,
                    'nama' => 'LATIHAN DOKTER HEWAN KARANTINA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20376F6A0E040640A040252AD',
                    'cepat_kode' => 2299,
                    'nama' => 'LATIHAN HAMA PENYAKIT IKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20377F6A0E040640A040252AD',
                    'cepat_kode' => 2300,
                    'nama' => 'LATIHAN HAMA TANAMAN PERKEBUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202C7F6A0E040640A040252AD',
                    'cepat_kode' => 2301,
                    'nama' => 'LATIHAN IDENTIFIKASI PENYAKIT'
                ),
                array(
                    'bkn_id' => 'A5EB03E202C8F6A0E040640A040252AD',
                    'cepat_kode' => 2302,
                    'nama' => 'LATIHAN IMPAC POIN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202C9F6A0E040640A040252AD',
                    'cepat_kode' => 2303,
                    'nama' => 'LATIHAN INPACT POIN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202CAF6A0E040640A040252AD',
                    'cepat_kode' => 2304,
                    'nama' => 'LATIHAN INSEMINASI BUATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202CBF6A0E040640A040252AD',
                    'cepat_kode' => 2305,
                    'nama' => 'LATIHAN INSTESIPIKASI TERNAK KEJA'
                ),
                array(
                    'bkn_id' => 'A5EB03E202D6F6A0E040640A040252AD',
                    'cepat_kode' => 2316,
                    'nama' => 'LATIHAN KA SEKSI PRODUKSI'
                ),
                array(
                    'bkn_id' => 'A5EB03E202D3F6A0E040640A040252AD',
                    'cepat_kode' => 2313,
                    'nama' => 'LATIHAN KAMBING DAN BIRI-BIR'
                ),
                array(
                    'bkn_id' => 'A5EB03E202D4F6A0E040640A040252AD',
                    'cepat_kode' => 2314,
                    'nama' => 'LATIHAN KARES PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202D5F6A0E040640A040252AD',
                    'cepat_kode' => 2315,
                    'nama' => 'LATIHAN KASI PENYULUHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202D7F6A0E040640A040252AD',
                    'cepat_kode' => 2317,
                    'nama' => 'LATIHAN KEBUN BENIH'
                ),
                array(
                    'bkn_id' => 'A5EB03E2035FF6A0E040640A040252AD',
                    'cepat_kode' => 2276,
                    'nama' => 'LATIHAN KELAPA UPP KOPI'
                ),
                array(
                    'bkn_id' => 'A5EB03E202D8F6A0E040640A040252AD',
                    'cepat_kode' => 2318,
                    'nama' => 'LATIHAN KEPEMP HFA.KBS BAGI PUSKESMAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E202E1F6A0E040640A040252AD',
                    'cepat_kode' => 2327,
                    'nama' => 'LATIHAN KEUANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202E9F6A0E040640A040252AD',
                    'cepat_kode' => 2335,
                    'nama' => 'LATIHAN MAKANISME PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202E4F6A0E040640A040252AD',
                    'cepat_kode' => 2330,
                    'nama' => 'LATIHAN MANAJEMEN PEMBIBITAN KELAPA'
                ),
                array(
                    'bkn_id' => 'A5EB03E202EBF6A0E040640A040252AD',
                    'cepat_kode' => 2337,
                    'nama' => 'LATIHAN MANAJEMEN PIMPINAN PUSKESMAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E202E6F6A0E040640A040252AD',
                    'cepat_kode' => 2332,
                    'nama' => 'LATIHAN MANAJEMEN PROGRAM KB'
                ),
                array(
                    'bkn_id' => 'A5EB03E202E7F6A0E040640A040252AD',
                    'cepat_kode' => 2333,
                    'nama' => 'LATIHAN MANAJEMEN USAHA TANAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E202E8F6A0E040640A040252AD',
                    'cepat_kode' => 2334,
                    'nama' => 'LATIHAN MANTRI TANI'
                ),
                array(
                    'bkn_id' => 'A5EB03E202ECF6A0E040640A040252AD',
                    'cepat_kode' => 2338,
                    'nama' => 'LATIHAN MINA PADI'
                ),
                array(
                    'bkn_id' => 'A5EB03E202EDF6A0E040640A040252AD',
                    'cepat_kode' => 2339,
                    'nama' => 'LATIHAN MODUL 3'
                ),
                array(
                    'bkn_id' => 'A5EB03E203A0F6A0E040640A040252AD',
                    'cepat_kode' => 2425,
                    'nama' => 'LATIHAN MONITORING DAN EVALUASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E202EEF6A0E040640A040252AD',
                    'cepat_kode' => 2340,
                    'nama' => 'LATIHAN OPERATOR PESAWAT FAX'
                ),
                array(
                    'bkn_id' => 'A5EB03E202F0F6A0E040640A040252AD',
                    'cepat_kode' => 2342,
                    'nama' => 'LATIHAN ORIENTASI PPM'
                ),
                array(
                    'bkn_id' => 'A5EB03E202EFF6A0E040640A040252AD',
                    'cepat_kode' => 2341,
                    'nama' => 'LATIHAN ORINTASI KB GENERASI MUDA'
                ),
                array(
                    'bkn_id' => 'A5EB03E202F3F6A0E040640A040252AD',
                    'cepat_kode' => 2345,
                    'nama' => 'LATIHAN PELATIHAN KADER PEMBANGUNAN DESA'
                ),
                array(
                    'bkn_id' => 'A5EB03E202F4F6A0E040640A040252AD',
                    'cepat_kode' => 2346,
                    'nama' => 'LATIHAN PEMANGKASAN KOPI'
                ),
                array(
                    'bkn_id' => 'A5EB03E202F5F6A0E040640A040252AD',
                    'cepat_kode' => 2347,
                    'nama' => 'LATIHAN PEMASARAN HASIL PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202F6F6A0E040640A040252AD',
                    'cepat_kode' => 2348,
                    'nama' => 'LATIHAN PEMBAURAN BAGI KPPL'
                ),
                array(
                    'bkn_id' => 'A5EB03E202F7F6A0E040640A040252AD',
                    'cepat_kode' => 2349,
                    'nama' => 'LATIHAN PEMBEKALAN KETERAMPILAN TEKHNIS'
                ),
                array(
                    'bkn_id' => 'A5EB03E202F8F6A0E040640A040252AD',
                    'cepat_kode' => 2350,
                    'nama' => 'LATIHAN PEMBEKALAN PARA CAMAT'
                ),
                array(
                    'bkn_id' => 'A5EB03E202FBF6A0E040640A040252AD',
                    'cepat_kode' => 2353,
                    'nama' => 'LATIHAN PEMBINAAN KARANG TARUNA'
                ),
                array(
                    'bkn_id' => 'A5EB03E202F9F6A0E040640A040252AD',
                    'cepat_kode' => 2351,
                    'nama' => 'LATIHAN PEMBINAAN WANITA TANI'
                ),
                array(
                    'bkn_id' => 'A5EB03E202FCF6A0E040640A040252AD',
                    'cepat_kode' => 2354,
                    'nama' => 'LATIHAN PEMUPUKAN BERIMBANG'
                ),
                array(
                    'bkn_id' => 'A5EB03E202FDF6A0E040640A040252AD',
                    'cepat_kode' => 2355,
                    'nama' => 'LATIHAN PENANGANAN KESEHATAN HEWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20300F6A0E040640A040252AD',
                    'cepat_kode' => 2358,
                    'nama' => 'LATIHAN PENANGKAPAN IKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20301F6A0E040640A040252AD',
                    'cepat_kode' => 2359,
                    'nama' => 'LATIHAN PENCACAH DATA STATISTIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E20302F6A0E040640A040252AD',
                    'cepat_kode' => 2360,
                    'nama' => 'LATIHAN PENDIDIKAN K/KB'
                ),
                array(
                    'bkn_id' => 'A5EB03E20304F6A0E040640A040252AD',
                    'cepat_kode' => 2362,
                    'nama' => 'LATIHAN PENGADAAN BARANG INVENT.LN.NEG'
                ),
                array(
                    'bkn_id' => 'A5EB03E20306F6A0E040640A040252AD',
                    'cepat_kode' => 2364,
                    'nama' => 'LATIHAN PENGASUH BBI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20307F6A0E040640A040252AD',
                    'cepat_kode' => 2365,
                    'nama' => 'LATIHAN PENGAWAS OBAT HEWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20308F6A0E040640A040252AD',
                    'cepat_kode' => 2366,
                    'nama' => 'LATIHAN PENGAWASAN DAN PENGENDALIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20309F6A0E040640A040252AD',
                    'cepat_kode' => 2367,
                    'nama' => 'LATIHAN PENGELOLA OBAT DI PUSKESMAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E2030AF6A0E040640A040252AD',
                    'cepat_kode' => 2368,
                    'nama' => 'LATIHAN PENGELOLAAN BBI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2030BF6A0E040640A040252AD',
                    'cepat_kode' => 2369,
                    'nama' => 'LATIHAN PENGENDALIAN HAMA TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E2030CF6A0E040640A040252AD',
                    'cepat_kode' => 2370,
                    'nama' => 'LATIHAN PENGKAJIAN DAMPAK LINGKUNGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2030EF6A0E040640A040252AD',
                    'cepat_kode' => 2372,
                    'nama' => 'LATIHAN PENGUJI SUSU'
                ),
                array(
                    'bkn_id' => 'A5EB03E2030FF6A0E040640A040252AD',
                    'cepat_kode' => 2373,
                    'nama' => 'LATIHAN PENGULITAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20310F6A0E040640A040252AD',
                    'cepat_kode' => 2374,
                    'nama' => 'LATIHAN PENINGKATAN PENGETAHUAN TEH PEG'
                ),
                array(
                    'bkn_id' => 'A5EB03E20311F6A0E040640A040252AD',
                    'cepat_kode' => 2375,
                    'nama' => 'LATIHAN PENYAJIAN PROTOKER'
                ),
                array(
                    'bkn_id' => 'A5EB03E20312F6A0E040640A040252AD',
                    'cepat_kode' => 2376,
                    'nama' => 'LATIHAN PENYULUH SUB SEKTOR NON PANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20313F6A0E040640A040252AD',
                    'cepat_kode' => 2377,
                    'nama' => 'LATIHAN PENYULUHAN BAGI PPS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20314F6A0E040640A040252AD',
                    'cepat_kode' => 2378,
                    'nama' => 'LATIHAN PENYULUHAN PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20315F6A0E040640A040252AD',
                    'cepat_kode' => 2379,
                    'nama' => 'LATIHAN PENYULUHAN PERTANIAN SPESIALIS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20360F6A0E040640A040252AD',
                    'cepat_kode' => 2277,
                    'nama' => 'LATIHAN PERENC SD INPRES'
                ),
                array(
                    'bkn_id' => 'A5EB03E20317F6A0E040640A040252AD',
                    'cepat_kode' => 2381,
                    'nama' => 'LATIHAN PERENCANAAN DAN PRAKTEK LAPANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20379F6A0E040640A040252AD',
                    'cepat_kode' => 2386,
                    'nama' => 'LATIHAN PERENCANAAN PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2037AF6A0E040640A040252AD',
                    'cepat_kode' => 2387,
                    'nama' => 'LATIHAN PERENCANAAN PRODUKSI PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20319F6A0E040640A040252AD',
                    'cepat_kode' => 2383,
                    'nama' => 'LATIHAN PERENCANAAN STATISTIK KESEHATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2031AF6A0E040640A040252AD',
                    'cepat_kode' => 2384,
                    'nama' => 'LATIHAN PERENCANAAN TU PEMBANGUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2037BF6A0E040640A040252AD',
                    'cepat_kode' => 2388,
                    'nama' => 'LATIHAN PERIKANAN AIR TAWAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E2037CF6A0E040640A040252AD',
                    'cepat_kode' => 2389,
                    'nama' => 'LATIHAN PERKREDITAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2037DF6A0E040640A040252AD',
                    'cepat_kode' => 2390,
                    'nama' => 'LATIHAN PERKREDITAN DAN PEMASARAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2037EF6A0E040640A040252AD',
                    'cepat_kode' => 2391,
                    'nama' => 'LATIHAN PERLINDUNGAN TANAMAN KOPI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2037FF6A0E040640A040252AD',
                    'cepat_kode' => 2392,
                    'nama' => 'LATIHAN PERLINDUNGAN TANAMAN PERKEBUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20380F6A0E040640A040252AD',
                    'cepat_kode' => 2393,
                    'nama' => 'LATIHAN PETUGAS BENIH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20382F6A0E040640A040252AD',
                    'cepat_kode' => 2395,
                    'nama' => 'LATIHAN PETUGAS LBK'
                ),
                array(
                    'bkn_id' => 'A5EB03E20383F6A0E040640A040252AD',
                    'cepat_kode' => 2396,
                    'nama' => 'LATIHAN PETUGAS MEDIS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20384F6A0E040640A040252AD',
                    'cepat_kode' => 2397,
                    'nama' => 'LATIHAN PETUGAS OPRS TRANSMIGRASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20385F6A0E040640A040252AD',
                    'cepat_kode' => 2398,
                    'nama' => 'LATIHAN PETUGAS PALAWIJA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20386F6A0E040640A040252AD',
                    'cepat_kode' => 2399,
                    'nama' => 'LATIHAN PETUGAS PARAMEDIS/JURU SITA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20387F6A0E040640A040252AD',
                    'cepat_kode' => 2400,
                    'nama' => 'LATIHAN PETUGAS PENGUMPULAN DATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20388F6A0E040640A040252AD',
                    'cepat_kode' => 2401,
                    'nama' => 'LATIHAN PETUGAS PERBAIKAN STATISTIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E20389F6A0E040640A040252AD',
                    'cepat_kode' => 2402,
                    'nama' => 'LATIHAN PETUGAS PERKEBUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2038AF6A0E040640A040252AD',
                    'cepat_kode' => 2403,
                    'nama' => 'LATIHAN PETUGAS PERKEBUNAN / OLAH KEBUN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2038BF6A0E040640A040252AD',
                    'cepat_kode' => 2404,
                    'nama' => 'LATIHAN PETUGAS PERLINDUNGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2038CF6A0E040640A040252AD',
                    'cepat_kode' => 2405,
                    'nama' => 'LATIHAN PETUGAS PROYEK PKGB'
                ),
                array(
                    'bkn_id' => 'A5EB03E2038DF6A0E040640A040252AD',
                    'cepat_kode' => 2406,
                    'nama' => 'LATIHAN PETUGAS TEKNIK LAPANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2038EF6A0E040640A040252AD',
                    'cepat_kode' => 2407,
                    'nama' => 'LATIHAN PETUGAS UPP'
                ),
                array(
                    'bkn_id' => 'A5EB03E2038FF6A0E040640A040252AD',
                    'cepat_kode' => 2408,
                    'nama' => 'LATIHAN PLPT'
                ),
                array(
                    'bkn_id' => 'A5EB03E20390F6A0E040640A040252AD',
                    'cepat_kode' => 2409,
                    'nama' => 'LATIHAN PLPT KELAPA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20391F6A0E040640A040252AD',
                    'cepat_kode' => 2410,
                    'nama' => 'LATIHAN PLPT TEBU DAN KOPI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20392F6A0E040640A040252AD',
                    'cepat_kode' => 2411,
                    'nama' => 'LATIHAN PLPT TEMBAKAU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20393F6A0E040640A040252AD',
                    'cepat_kode' => 2412,
                    'nama' => 'LATIHAN PPL ANEKA USAHA TANI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20394F6A0E040640A040252AD',
                    'cepat_kode' => 2413,
                    'nama' => 'LATIHAN PPL/NAEP'
                ),
                array(
                    'bkn_id' => 'A5EB03E20395F6A0E040640A040252AD',
                    'cepat_kode' => 2414,
                    'nama' => 'LATIHAN PPM SUPERVISOR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20396F6A0E040640A040252AD',
                    'cepat_kode' => 2415,
                    'nama' => 'LATIHAN PPS BD. AGRONOMI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20397F6A0E040640A040252AD',
                    'cepat_kode' => 2416,
                    'nama' => 'LATIHAN PPS DASAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20398F6A0E040640A040252AD',
                    'cepat_kode' => 2417,
                    'nama' => 'LATIHAN PPS UNTUK PPT'
                ),
                array(
                    'bkn_id' => 'A5EB03E20399F6A0E040640A040252AD',
                    'cepat_kode' => 2418,
                    'nama' => 'LATIHAN PPS UPPI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2039BF6A0E040640A040252AD',
                    'cepat_kode' => 2420,
                    'nama' => 'LATIHAN PRODUKSI PADI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2039DF6A0E040640A040252AD',
                    'cepat_kode' => 2422,
                    'nama' => 'LATIHAN PROP. PETUGAS PEMBINA PSM'
                ),
                array(
                    'bkn_id' => 'A5EB03E2039EF6A0E040640A040252AD',
                    'cepat_kode' => 2423,
                    'nama' => 'LATIHAN PROTEKSI TANAMAN PERKEBUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2039FF6A0E040640A040252AD',
                    'cepat_kode' => 2424,
                    'nama' => 'LATIHAN PROYEK MANAGEMEN SISTEM'
                ),
                array(
                    'bkn_id' => 'A5EB03E203A1F6A0E040640A040252AD',
                    'cepat_kode' => 2426,
                    'nama' => 'LATIHAN PWS KB KESEHATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203A2F6A0E040640A040252AD',
                    'cepat_kode' => 2427,
                    'nama' => 'LATIHAN QUALITY KONTROL'
                ),
                array(
                    'bkn_id' => 'A5EB03E203A3F6A0E040640A040252AD',
                    'cepat_kode' => 2428,
                    'nama' => 'LATIHAN REGISTRASI KEPENDUDUKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203A4F6A0E040640A040252AD',
                    'cepat_kode' => 2429,
                    'nama' => 'LATIHAN REGISTRASI PENDUDUK'
                ),
                array(
                    'bkn_id' => 'A5EB03E203A5F6A0E040640A040252AD',
                    'cepat_kode' => 2430,
                    'nama' => 'LATIHAN RENDEMAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203A6F6A0E040640A040252AD',
                    'cepat_kode' => 2431,
                    'nama' => 'LATIHAN SAPI PERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E203A7F6A0E040640A040252AD',
                    'cepat_kode' => 2432,
                    'nama' => 'LATIHAN SATGASSOS PBA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203A8F6A0E040640A040252AD',
                    'cepat_kode' => 2433,
                    'nama' => 'LATIHAN SIKLUS PROGRAM PPC-A'
                ),
                array(
                    'bkn_id' => 'A5EB03E203A9F6A0E040640A040252AD',
                    'cepat_kode' => 2434,
                    'nama' => 'LATIHAN SISTEM PENDIDIKAN KOMPUTER'
                ),
                array(
                    'bkn_id' => 'A5EB03E203AAF6A0E040640A040252AD',
                    'cepat_kode' => 2435,
                    'nama' => 'LATIHAN STAF PENYULUHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203ACF6A0E040640A040252AD',
                    'cepat_kode' => 2437,
                    'nama' => 'LATIHAN STATISTIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E203AEF6A0E040640A040252AD',
                    'cepat_kode' => 2439,
                    'nama' => 'LATIHAN STRATIFIKASI BAGI TU PUSKESMAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E203AFF6A0E040640A040252AD',
                    'cepat_kode' => 2440,
                    'nama' => 'LATIHAN SUPERVISI'
                ),
                array(
                    'bkn_id' => 'A5EB03E203B0F6A0E040640A040252AD',
                    'cepat_kode' => 2441,
                    'nama' => 'LATIHAN TANAMAN JAMUR'
                ),
                array(
                    'bkn_id' => 'A5EB03E203B1F6A0E040640A040252AD',
                    'cepat_kode' => 2442,
                    'nama' => 'LATIHAN TEHNOLOGI PASCA PANEN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203B2F6A0E040640A040252AD',
                    'cepat_kode' => 2443,
                    'nama' => 'LATIHAN TEKNIK PEN. PROYEK'
                ),
                array(
                    'bkn_id' => 'A5EB03E203B3F6A0E040640A040252AD',
                    'cepat_kode' => 2444,
                    'nama' => 'LATIHAN TEKNIS PENGENDALIAN LINGKUNGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203B4F6A0E040640A040252AD',
                    'cepat_kode' => 2445,
                    'nama' => 'LATIHAN TEKNIS PENYULUHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203B5F6A0E040640A040252AD',
                    'cepat_kode' => 2446,
                    'nama' => 'LATIHAN TEKNIS PERAWAT, BIDAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203B6F6A0E040640A040252AD',
                    'cepat_kode' => 2447,
                    'nama' => 'LATIHAN TEKNIS PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203B7F6A0E040640A040252AD',
                    'cepat_kode' => 2448,
                    'nama' => 'LATIHAN TEKNIS PERKEBUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203B8F6A0E040640A040252AD',
                    'cepat_kode' => 2449,
                    'nama' => 'LATIHAN TEKNOLOGI KULIT'
                ),
                array(
                    'bkn_id' => 'A5EB03E203B9F6A0E040640A040252AD',
                    'cepat_kode' => 2450,
                    'nama' => 'LATIHAN TEKNOLOGI SUSU, DAGING, TELUR'
                ),
                array(
                    'bkn_id' => 'A5EB03E203BAF6A0E040640A040252AD',
                    'cepat_kode' => 2451,
                    'nama' => 'LATIHAN TENAGA KEARSIPAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203BBF6A0E040640A040252AD',
                    'cepat_kode' => 2452,
                    'nama' => 'LATIHAN UPGK'
                ),
                array(
                    'bkn_id' => 'A5EB03E202CCF6A0E040640A040252AD',
                    'cepat_kode' => 2306,
                    'nama' => 'LAT.INST MANTAP.PENYL PEM. DESA'
                ),
                array(
                    'bkn_id' => 'A5EB03E202CEF6A0E040640A040252AD',
                    'cepat_kode' => 2308,
                    'nama' => 'LAT.INST PENYELENGGARAAN PEM.DESA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20451F6A0E040640A040252AD',
                    'cepat_kode' => 2520,
                    'nama' => 'LAT.INTEG.ASPEK KEPEN.DL PROS.PERENC.DRH'
                ),
                array(
                    'bkn_id' => 'A5EB03E202D9F6A0E040640A040252AD',
                    'cepat_kode' => 2319,
                    'nama' => 'LATJA PENYUS.INVEST.PRASARANA KATA P3KT'
                ),
                array(
                    'bkn_id' => 'A5EB03E20456F6A0E040640A040252AD',
                    'cepat_kode' => 2525,
                    'nama' => 'LAT.MANAG.KEPEMIMPINAN WANITA BIKAS UKS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20461F6A0E040640A040252AD',
                    'cepat_kode' => 2536,
                    'nama' => 'LAT.PENGGUNAAN BHN TAMBAHAN PROYEK BIPIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E20463F6A0E040640A040252AD',
                    'cepat_kode' => 2538,
                    'nama' => 'LAT.PENINGK.KEMAMP.SEKWILMAT DARI MPP'
                ),
                array(
                    'bkn_id' => 'A5EB03E20464F6A0E040640A040252AD',
                    'cepat_kode' => 2539,
                    'nama' => 'LAT.PERENC & PENILAIAN UPAYA KESEHATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2046BF6A0E040640A040252AD',
                    'cepat_kode' => 2546,
                    'nama' => 'LAT.REG.GAS.KES.DT II DLM UPAYA KES TRAD'
                ),
                array(
                    'bkn_id' => 'A5EB03E20470F6A0E040640A040252AD',
                    'cepat_kode' => 2551,
                    'nama' => 'LAT.UPAYA KES.PEKERJA SEKTOR INFORMAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E203BEF6A0E040640A040252AD',
                    'cepat_kode' => 2455,
                    'nama' => 'LIMBAH RUMAH TANGGA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20490F6A0E040640A040252AD',
                    'cepat_kode' => 2583,
                    'nama' => 'LIT PELAK OT.NYATA&BERTANG.JWB PD DT II'
                ),
                array(
                    'bkn_id' => 'A5EB03E203BFF6A0E040640A040252AD',
                    'cepat_kode' => 2456,
                    'nama' => 'LITSUS'
                ),
                array(
                    'bkn_id' => 'A5EB03E203C0F6A0E040640A040252AD',
                    'cepat_kode' => 2457,
                    'nama' => 'LK3'
                ),
                array(
                    'bkn_id' => 'A5EB03E203C1F6A0E040640A040252AD',
                    'cepat_kode' => 2458,
                    'nama' => 'LMLP PEMBANGUNAN DESA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203C2F6A0E040640A040252AD',
                    'cepat_kode' => 2459,
                    'nama' => 'LOKAKARYA MANAG.PEMBANG. SWADAYA MASY.'
                ),
                array(
                    'bkn_id' => 'A5EB03E203C3F6A0E040640A040252AD',
                    'cepat_kode' => 2460,
                    'nama' => 'LPPTD'
                ),
                array(
                    'bkn_id' => 'A5EB03E203CEF6A0E040640A040252AD',
                    'cepat_kode' => 2471,
                    'nama' => 'MANAG. AUDIT & SISTIM INFORMASI MANAG.'
                ),
                array(
                    'bkn_id' => 'A5EB03E203C7F6A0E040640A040252AD',
                    'cepat_kode' => 2464,
                    'nama' => 'MANAGEMENT KELAPA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203C8F6A0E040640A040252AD',
                    'cepat_kode' => 2465,
                    'nama' => 'MANAGEMENT KELAPA UPP'
                ),
                array(
                    'bkn_id' => 'A5EB03E203C9F6A0E040640A040252AD',
                    'cepat_kode' => 2466,
                    'nama' => 'MANAGEMENT KOPI'
                ),
                array(
                    'bkn_id' => 'E67F0157EEC4EB31E050640AF10844ED',
                    'cepat_kode' => 3164,
                    'nama' => 'MANAGEMENT OF TRAINING'
                ),
                array(
                    'bkn_id' => 'A5EB03E203D0F6A0E040640A040252AD',
                    'cepat_kode' => 2473,
                    'nama' => 'MANAGEMENT PEMBANGUNAN KOTA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203CAF6A0E040640A040252AD',
                    'cepat_kode' => 2467,
                    'nama' => 'MANAGEMENT PEMERINTAHAN DESA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203CBF6A0E040640A040252AD',
                    'cepat_kode' => 2468,
                    'nama' => 'MANAGEMENT PENDAPATAN DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E203D7F6A0E040640A040252AD',
                    'cepat_kode' => 2480,
                    'nama' => 'MANAGEMENT PENYULUHAN PETERNAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203CCF6A0E040640A040252AD',
                    'cepat_kode' => 2469,
                    'nama' => 'MANAGEMENT PERAIRAN UMUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E203C5F6A0E040640A040252AD',
                    'cepat_kode' => 2462,
                    'nama' => 'MANAGEMENT PERKOTAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203C6F6A0E040640A040252AD',
                    'cepat_kode' => 2463,
                    'nama' => 'MANAGEMENT PROYEK'
                ),
                array(
                    'bkn_id' => 'A5EB03E203CDF6A0E040640A040252AD',
                    'cepat_kode' => 2470,
                    'nama' => 'MANAGEMENT USAHA TANI'
                ),
                array(
                    'bkn_id' => 'A5EB03E203C4F6A0E040640A040252AD',
                    'cepat_kode' => 2461,
                    'nama' => 'MANAG.EXTEN.TRAINING COURSE DI AUSTRALIA'
                ),
                array(
                    'bkn_id' => 'E67F0157EEC5EB31E050640AF10844ED',
                    'cepat_kode' => 3165,
                    'nama' => 'MANAJEMEN KESEKRETARIATAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EEC6EB31E050640AF10844ED',
                    'cepat_kode' => 3166,
                    'nama' => 'MANAJEMEN PELAKSANAAN KEGIATAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EEC7EB31E050640AF10844ED',
                    'cepat_kode' => 3167,
                    'nama' => 'MANAJEMEN PENGAWASAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EEC8EB31E050640AF10844ED',
                    'cepat_kode' => 3168,
                    'nama' => 'MANAJEMEN PENGELOLAAN ANGGARAN UNTUK KAJARI'
                ),
                array(
                    'bkn_id' => 'E67F0157EEC9EB31E050640AF10844ED',
                    'cepat_kode' => 3169,
                    'nama' => 'MANAJEMEN PENYELIDIKAN PENYIDIKAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EECAEB31E050640AF10844ED',
                    'cepat_kode' => 3170,
                    'nama' => 'MANAJEMEN PERENCANAAN PROGRAM'
                ),
                array(
                    'bkn_id' => 'E67F0157EECBEB31E050640AF10844ED',
                    'cepat_kode' => 3171,
                    'nama' => 'MANAJEMEN RESIKO'
                ),
                array(
                    'bkn_id' => 'A5EB03E203CFF6A0E040640A040252AD',
                    'cepat_kode' => 2472,
                    'nama' => 'MANAMEMENT PADANG PENGEMBALAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203D1F6A0E040640A040252AD',
                    'cepat_kode' => 2474,
                    'nama' => 'MANDOR BINA MARGA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203D2F6A0E040640A040252AD',
                    'cepat_kode' => 2475,
                    'nama' => 'MAPATOA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203D3F6A0E040640A040252AD',
                    'cepat_kode' => 2476,
                    'nama' => 'MATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E201F7F6A0E040640A040252AD',
                    'cepat_kode' => 2876,
                    'nama' => 'MENGETIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E203D4F6A0E040640A040252AD',
                    'cepat_kode' => 2477,
                    'nama' => 'MESIN-MESIN PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203D5F6A0E040640A040252AD',
                    'cepat_kode' => 2478,
                    'nama' => 'METODOLOGI PENELITIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203D6F6A0E040640A040252AD',
                    'cepat_kode' => 2479,
                    'nama' => 'METRO PENELITIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203D8F6A0E040640A040252AD',
                    'cepat_kode' => 2481,
                    'nama' => 'MOTORIS PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203D9F6A0E040640A040252AD',
                    'cepat_kode' => 2482,
                    'nama' => 'MST (METODE SURVEY TERAPAN)'
                ),
                array(
                    'bkn_id' => 'A5EB03E203DAF6A0E040640A040252AD',
                    'cepat_kode' => 2483,
                    'nama' => 'MUSYAWARAH KESERASIAN SOSIAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E204F0F6A0E040640A040252AD',
                    'cepat_kode' => 2679,
                    'nama' => 'NAT. GAS PENGELOLA PROG.KUALITAS AIR'
                ),
                array(
                    'bkn_id' => 'A5EB03E204E1F6A0E040640A040252AD',
                    'cepat_kode' => 2664,
                    'nama' => 'NAT. PENINGKATAN KA. URUSAN PEMERINTAHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204EAF6A0E040640A040252AD',
                    'cepat_kode' => 2673,
                    'nama' => 'NAT. PERENC. DAL.WAS &EVALUASI PEMBANG.'
                ),
                array(
                    'bkn_id' => 'A5EB03E204D8F6A0E040640A040252AD',
                    'cepat_kode' => 2655,
                    'nama' => 'NAT.BIN PJB PEMBUAT PERATURAN PER U U AN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204B8F6A0E040640A040252AD',
                    'cepat_kode' => 2623,
                    'nama' => 'NAT.DIKLAT WAS KEU NEG.TINGKAT PELAKSANA'
                ),
                array(
                    'bkn_id' => 'A5EB03E204EEF6A0E040640A040252AD',
                    'cepat_kode' => 2677,
                    'nama' => 'NAT.GAS PARAMEDIS MIKROSKOPIS & TB PARU'
                ),
                array(
                    'bkn_id' => 'A5EB03E204EFF6A0E040640A040252AD',
                    'cepat_kode' => 2678,
                    'nama' => 'NAT.GAS PENATAR KESEHATAN MASY.PUSKESMAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E204BCF6A0E040640A040252AD',
                    'cepat_kode' => 2627,
                    'nama' => 'NAT.IMUN.&STUDI BANDING KASUBSI IMUNIS.'
                ),
                array(
                    'bkn_id' => 'A5EB03E204BDF6A0E040640A040252AD',
                    'cepat_kode' => 2628,
                    'nama' => 'NAT.INSTRUK PEMANTAPAN PENYELENG. PEMDES'
                ),
                array(
                    'bkn_id' => 'A5EB03E204D4F6A0E040640A040252AD',
                    'cepat_kode' => 2651,
                    'nama' => 'NAT.LAKS APLIKASI ADM. PENDAPATAN DRH'
                ),
                array(
                    'bkn_id' => 'A5EB03E204D6F6A0E040640A040252AD',
                    'cepat_kode' => 2653,
                    'nama' => 'NAT.LAT.TEKNIS FUNG. DOKTER PUSKESMAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E204AAF6A0E040640A040252AD',
                    'cepat_kode' => 2609,
                    'nama' => 'NAT.MANAG.MOTIV.TRAIN.FOR PERFORME IMPR.'
                ),
                array(
                    'bkn_id' => 'A5EB03E204D5F6A0E040640A040252AD',
                    'cepat_kode' => 2652,
                    'nama' => 'NAT.PELATIH INSTRUK.PENYELENGGARA DESA'
                ),
                array(
                    'bkn_id' => 'A5EB03E204D7F6A0E040640A040252AD',
                    'cepat_kode' => 2654,
                    'nama' => 'NAT.PEMANTAPAN PELAKSANAAN WAJIB BELAJAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E204DAF6A0E040640A040252AD',
                    'cepat_kode' => 2657,
                    'nama' => 'NAT.PENENTUAN PERED.PEMBAGIAN DR TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E204E2F6A0E040640A040252AD',
                    'cepat_kode' => 2665,
                    'nama' => 'NAT.PENING.KETRAMP KERJA APR BIN SOSPOL'
                ),
                array(
                    'bkn_id' => 'A5EB03E204E5F6A0E040640A040252AD',
                    'cepat_kode' => 2668,
                    'nama' => 'NAT.PENYUSUNAN DESAIN&EVAL PROY LAT PKKT'
                ),
                array(
                    'bkn_id' => 'A5EB03E204E6F6A0E040640A040252AD',
                    'cepat_kode' => 2669,
                    'nama' => 'NAT.PERAD HUK DIBERLAKUKAN U U NO.5/1986'
                ),
                array(
                    'bkn_id' => 'A5EB03E204EBF6A0E040640A040252AD',
                    'cepat_kode' => 2674,
                    'nama' => 'NAT.PERENC.PADU PEMBANG.KOMP.HANKAM NEG.'
                ),
                array(
                    'bkn_id' => 'A5EB03E204FEF6A0E040640A040252AD',
                    'cepat_kode' => 2693,
                    'nama' => 'NAT.SISTEM JARINGAN DOK.&INFORMASI HUKUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E204DBF6A0E040640A040252AD',
                    'cepat_kode' => 2658,
                    'nama' => 'NAT.WAS PARA PJB PENGURUS FUNG.DATI I/II'
                ),
                array(
                    'bkn_id' => 'A5EB03E203DBF6A0E040640A040252AD',
                    'cepat_kode' => 2484,
                    'nama' => 'NET WORK PLAINING IV'
                ),
                array(
                    'bkn_id' => 'A5EB03E203DCF6A0E040640A040252AD',
                    'cepat_kode' => 2485,
                    'nama' => 'O DAN M'
                ),
                array(
                    'bkn_id' => 'A5EB03E203DDF6A0E040640A040252AD',
                    'cepat_kode' => 2486,
                    'nama' => 'O DAN M JARINGAN AIR BERSIH'
                ),
                array(
                    'bkn_id' => 'A5EB03E203DEF6A0E040640A040252AD',
                    'cepat_kode' => 2487,
                    'nama' => 'OB FARM WATRO USE WATU MANAG TRAIN.& DEV'
                ),
                array(
                    'bkn_id' => 'A5EB03E203DFF6A0E040640A040252AD',
                    'cepat_kode' => 2488,
                    'nama' => 'ON FARM WATER USE'
                ),
                array(
                    'bkn_id' => 'A5EB03E203E0F6A0E040640A040252AD',
                    'cepat_kode' => 2489,
                    'nama' => 'ORGANISASI DAN MANAGEMENT PERPAJAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203E8F6A0E040640A040252AD',
                    'cepat_kode' => 2497,
                    'nama' => 'ORIENT. PEMBG.DT.II TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E203E1F6A0E040640A040252AD',
                    'cepat_kode' => 2490,
                    'nama' => 'ORIENTASI ADM. KEPENDUDUKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203E2F6A0E040640A040252AD',
                    'cepat_kode' => 2491,
                    'nama' => 'ORIENTASI LMD'
                ),
                array(
                    'bkn_id' => 'A5EB03E203E3F6A0E040640A040252AD',
                    'cepat_kode' => 2492,
                    'nama' => 'ORIENTASI MANAGEMENT LPDT'
                ),
                array(
                    'bkn_id' => 'A5EB03E203E4F6A0E040640A040252AD',
                    'cepat_kode' => 2493,
                    'nama' => 'ORIENTASI PEMBANGUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203E5F6A0E040640A040252AD',
                    'cepat_kode' => 2494,
                    'nama' => 'ORIENTASI PERPUSTAKAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203E6F6A0E040640A040252AD',
                    'cepat_kode' => 2495,
                    'nama' => 'ORIENTASI PPL'
                ),
                array(
                    'bkn_id' => 'A5EB03E203E7F6A0E040640A040252AD',
                    'cepat_kode' => 2496,
                    'nama' => 'ORIENTASI PROG. PENGHIJAUAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203E9F6A0E040640A040252AD',
                    'cepat_kode' => 2498,
                    'nama' => 'P2 KUSTA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203EAF6A0E040640A040252AD',
                    'cepat_kode' => 2499,
                    'nama' => 'P2LPK'
                ),
                array(
                    'bkn_id' => 'A5EB03E203EBF6A0E040640A040252AD',
                    'cepat_kode' => 2500,
                    'nama' => 'P2M'
                ),
                array(
                    'bkn_id' => 'A5EB03E203ECF6A0E040640A040252AD',
                    'cepat_kode' => 2501,
                    'nama' => 'P5D'
                ),
                array(
                    'bkn_id' => 'A5EB03E203EDF6A0E040640A040252AD',
                    'cepat_kode' => 2502,
                    'nama' => 'PAFPACK'
                ),
                array(
                    'bkn_id' => 'A5EB03E203EEF6A0E040640A040252AD',
                    'cepat_kode' => 2503,
                    'nama' => 'PANGAN DAN GIZI'
                ),
                array(
                    'bkn_id' => 'A5EB03E203EFF6A0E040640A040252AD',
                    'cepat_kode' => 2504,
                    'nama' => 'PANT. APARAT PENGEL. PEMB. KOTA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203F0F6A0E040640A040252AD',
                    'cepat_kode' => 2505,
                    'nama' => 'PATOLOGI ANATOMI'
                ),
                array(
                    'bkn_id' => 'A5EB03E203F1F6A0E040640A040252AD',
                    'cepat_kode' => 2506,
                    'nama' => 'PCC - BP3KT'
                ),
                array(
                    'bkn_id' => 'A5EB03E203F2F6A0E040640A040252AD',
                    'cepat_kode' => 2507,
                    'nama' => 'PDD'
                ),
                array(
                    'bkn_id' => 'A5EB03E203F3F6A0E040640A040252AD',
                    'cepat_kode' => 2508,
                    'nama' => 'PDE'
                ),
                array(
                    'bkn_id' => 'A5EB03E20447F6A0E040640A040252AD',
                    'cepat_kode' => 2510,
                    'nama' => 'PEJABAT INTI PROYEK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2026BF6A0E040640A040252AD',
                    'cepat_kode' => 2116,
                    'nama' => 'PELAKSANA SIPIL UMUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E20448F6A0E040640A040252AD',
                    'cepat_kode' => 2511,
                    'nama' => 'PELAKSANAAN SISTEM UDKP'
                ),
                array(
                    'bkn_id' => 'A5EB03E2044CF6A0E040640A040252AD',
                    'cepat_kode' => 2515,
                    'nama' => 'PELAT. ACTION GROUP'
                ),
                array(
                    'bkn_id' => 'A5EB03E2044DF6A0E040640A040252AD',
                    'cepat_kode' => 2516,
                    'nama' => 'PELAT. ANTENATAL CARE PERAWAT PUSKESMAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E2044EF6A0E040640A040252AD',
                    'cepat_kode' => 2517,
                    'nama' => 'PELAT. AYAM BOILER/LAYUR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20450F6A0E040640A040252AD',
                    'cepat_kode' => 2519,
                    'nama' => 'PELAT. DOKTER PUSKESMAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20452F6A0E040640A040252AD',
                    'cepat_kode' => 2521,
                    'nama' => 'PELAT. ISK-UDKP PEMBINA TEKNIS KPD-LKMD'
                ),
                array(
                    'bkn_id' => 'A5EB03E20453F6A0E040640A040252AD',
                    'cepat_kode' => 2522,
                    'nama' => 'PELAT. KEPALA PERIKANAN SE INDONESIA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20454F6A0E040640A040252AD',
                    'cepat_kode' => 2523,
                    'nama' => 'PELAT. KEPEMIMPINAN AMPI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20455F6A0E040640A040252AD',
                    'cepat_kode' => 2524,
                    'nama' => 'PELAT. KHUSUS PENCABUTAN IMPLAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20457F6A0E040640A040252AD',
                    'cepat_kode' => 2526,
                    'nama' => 'PELAT. METODOLOGI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20458F6A0E040640A040252AD',
                    'cepat_kode' => 2527,
                    'nama' => 'PELAT. PELATIH PDT'
                ),
                array(
                    'bkn_id' => 'A5EB03E20459F6A0E040640A040252AD',
                    'cepat_kode' => 2528,
                    'nama' => 'PELAT. PEMBENIHAN KAKAP PUTIH'
                ),
                array(
                    'bkn_id' => 'A5EB03E2045AF6A0E040640A040252AD',
                    'cepat_kode' => 2529,
                    'nama' => 'PELAT. PEMBERANTASAN DBD'
                ),
                array(
                    'bkn_id' => 'A5EB03E2045BF6A0E040640A040252AD',
                    'cepat_kode' => 2530,
                    'nama' => 'PELAT. PEMBINAAN KESOS REMAJA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2045CF6A0E040640A040252AD',
                    'cepat_kode' => 2531,
                    'nama' => 'PELAT. PENANGANAN SEMEN BEKU'
                ),
                array(
                    'bkn_id' => 'A5EB03E2045DF6A0E040640A040252AD',
                    'cepat_kode' => 2532,
                    'nama' => 'PELAT. PENANGGULANANGAN GAKI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2045EF6A0E040640A040252AD',
                    'cepat_kode' => 2533,
                    'nama' => 'PELAT. PENGAMALAN PUSKESMAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E2045FF6A0E040640A040252AD',
                    'cepat_kode' => 2534,
                    'nama' => 'PELAT. PENGAMBILAN SAMPEL AIR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20460F6A0E040640A040252AD',
                    'cepat_kode' => 2535,
                    'nama' => 'PELAT. PENGEMBANGAN MANAJEMEN ORSOS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20462F6A0E040640A040252AD',
                    'cepat_kode' => 2537,
                    'nama' => 'PELAT. PENGHIJAUAN DAN PERTANAHAN KOTA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20465F6A0E040640A040252AD',
                    'cepat_kode' => 2540,
                    'nama' => 'PELAT. PERHITUNGAN INDEK HARGA KONSUMEN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20467F6A0E040640A040252AD',
                    'cepat_kode' => 2542,
                    'nama' => 'PELAT. PETUGAS PENGELOLA COLD CHAIN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20468F6A0E040640A040252AD',
                    'cepat_kode' => 2543,
                    'nama' => 'PELAT. PIMPINAN RSU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20469F6A0E040640A040252AD',
                    'cepat_kode' => 2544,
                    'nama' => 'PELAT. PROSES KEPERAWATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2046AF6A0E040640A040252AD',
                    'cepat_kode' => 2545,
                    'nama' => 'PELAT. PWS. KIA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2046CF6A0E040640A040252AD',
                    'cepat_kode' => 2547,
                    'nama' => 'PELAT. RIPK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2046DF6A0E040640A040252AD',
                    'cepat_kode' => 2548,
                    'nama' => 'PELAT SATGASOSO'
                ),
                array(
                    'bkn_id' => 'A5EB03E2046EF6A0E040640A040252AD',
                    'cepat_kode' => 2549,
                    'nama' => 'PELAT. SYOK ANAFILAKTIF'
                ),
                array(
                    'bkn_id' => 'A5EB03E2046FF6A0E040640A040252AD',
                    'cepat_kode' => 2550,
                    'nama' => 'PELAT. TENAGA TEKNISI ULU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20471F6A0E040640A040252AD',
                    'cepat_kode' => 2552,
                    'nama' => 'PELAT. USK UDKP PEMBINAAN TEK.KKP-LKMD'
                ),
                array(
                    'bkn_id' => 'A5EB03E20472F6A0E040640A040252AD',
                    'cepat_kode' => 2553,
                    'nama' => 'PELAT. WIL.PADAT KARYA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2044AF6A0E040640A040252AD',
                    'cepat_kode' => 2513,
                    'nama' => 'PELATIH KPD'
                ),
                array(
                    'bkn_id' => 'A5EB03E2044BF6A0E040640A040252AD',
                    'cepat_kode' => 2514,
                    'nama' => 'PELATIH PLP PENGAWAS BID. SAMPAH'
                ),
                array(
                    'bkn_id' => 'E67F0157EECCEB31E050640AF10844ED',
                    'cepat_kode' => 3172,
                    'nama' => 'PELATIHAN COACH DAN MENTOR'
                ),
                array(
                    'bkn_id' => 'D834501E63BC3A8CE050640AF10824F4',
                    'cepat_kode' => 3150,
                    'nama' => 'PELATIHAN SISTEM MANAJEMEN BMN'
                ),
                array(
                    'bkn_id' => 'D834501E63BD3A8CE050640AF10824F4',
                    'cepat_kode' => 3151,
                    'nama' => 'PELATIHAN SISTEM MANAJEMEN SDM'
                ),
                array(
                    'bkn_id' => 'D834501E63BE3A8CE050640AF10824F4',
                    'cepat_kode' => 3152,
                    'nama' => 'PELATIHAN SISTEM PENGELOLAAN KEUANGAN'
                ),
                array(
                    'bkn_id' => 'D834501E63BF3A8CE050640AF10824F4',
                    'cepat_kode' => 3153,
                    'nama' => 'PELATIHAN TATA NASKAH DAN KEARSIPAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20479F6A0E040640A040252AD',
                    'cepat_kode' => 2560,
                    'nama' => 'PELUNC.PENGELOLA PENANG.SUS RACUN PESTIS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20474F6A0E040640A040252AD',
                    'cepat_kode' => 2555,
                    'nama' => 'PELUNCURAN INSTRUKT PENANGG.BENCANA ALAM'
                ),
                array(
                    'bkn_id' => 'A5EB03E20473F6A0E040640A040252AD',
                    'cepat_kode' => 2554,
                    'nama' => 'PELUNCURAN JEMBATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20475F6A0E040640A040252AD',
                    'cepat_kode' => 2556,
                    'nama' => 'PELUNCURAN KEPEMP.KA.DIN KANTOR DEPKES'
                ),
                array(
                    'bkn_id' => 'A5EB03E20477F6A0E040640A040252AD',
                    'cepat_kode' => 2558,
                    'nama' => 'PELUNCURAN MANAG. PUSKESMAS TK LANJUTAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20476F6A0E040640A040252AD',
                    'cepat_kode' => 2557,
                    'nama' => 'PELUNCURAN MANAGEMENT PUSKESMAS TK DASAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20478F6A0E040640A040252AD',
                    'cepat_kode' => 2559,
                    'nama' => 'PELUNCURAN PEMB. PROGRAM KARANG TARUNA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2047AF6A0E040640A040252AD',
                    'cepat_kode' => 2561,
                    'nama' => 'PELUNCURAN PENTALOKA SUPERVILAN EPIDEM.'
                ),
                array(
                    'bkn_id' => 'A5EB03E2047BF6A0E040640A040252AD',
                    'cepat_kode' => 2562,
                    'nama' => 'PELUNCURAN UPY KES.PEKERJA NON FORMAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E2047CF6A0E040640A040252AD',
                    'cepat_kode' => 2563,
                    'nama' => 'PEMAHAMAN SOSEK PERLINTAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2047EF6A0E040640A040252AD',
                    'cepat_kode' => 2565,
                    'nama' => 'PEMANTAPAN PENYELENGGARA PEMDES'
                ),
                array(
                    'bkn_id' => 'A5EB03E20482F6A0E040640A040252AD',
                    'cepat_kode' => 2569,
                    'nama' => 'PEMB. PELAKS.PROYEK PPKS+SMPL'
                ),
                array(
                    'bkn_id' => 'A5EB03E2047FF6A0E040640A040252AD',
                    'cepat_kode' => 2566,
                    'nama' => 'PEMBANGUNAN MANAGEMENT AREA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20480F6A0E040640A040252AD',
                    'cepat_kode' => 2567,
                    'nama' => 'PEMBENIHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20481F6A0E040640A040252AD',
                    'cepat_kode' => 2568,
                    'nama' => 'PEMBESARAN IKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20483F6A0E040640A040252AD',
                    'cepat_kode' => 2570,
                    'nama' => 'PEMELIHARAAN KASKO KAPAL KAYU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20484F6A0E040640A040252AD',
                    'cepat_kode' => 2571,
                    'nama' => 'PEMERAHAN DAN PANANGANAN AIR SUSU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20485F6A0E040640A040252AD',
                    'cepat_kode' => 2572,
                    'nama' => 'PEMERIKSAAN PENYAKIT PARASIT'
                ),
                array(
                    'bkn_id' => 'A5EB03E20486F6A0E040640A040252AD',
                    'cepat_kode' => 2573,
                    'nama' => 'PEMERINTAHAN DAN PEMBANGUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20487F6A0E040640A040252AD',
                    'cepat_kode' => 2574,
                    'nama' => 'PENAGIHAN DIPENDA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20489F6A0E040640A040252AD',
                    'cepat_kode' => 2576,
                    'nama' => 'PENANGANAN LAHAN KERING'
                ),
                array(
                    'bkn_id' => 'A5EB03E20488F6A0E040640A040252AD',
                    'cepat_kode' => 2575,
                    'nama' => 'PENANGANAN TUNA SEGAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E2048AF6A0E040640A040252AD',
                    'cepat_kode' => 2577,
                    'nama' => 'PENANGKAPAN IKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2048BF6A0E040640A040252AD',
                    'cepat_kode' => 2578,
                    'nama' => 'PENANGKAR BENIH'
                ),
                array(
                    'bkn_id' => 'A5EB03E2048CF6A0E040640A040252AD',
                    'cepat_kode' => 2579,
                    'nama' => 'PENATARAN WASKAT'
                ),
                array(
                    'bkn_id' => 'D834501E63C13A8CE050640AF10824F4',
                    'cepat_kode' => 3155,
                    'nama' => 'PENDAHULUAN TOS'
                ),
                array(
                    'bkn_id' => 'A5EB03E2048DF6A0E040640A040252AD',
                    'cepat_kode' => 2580,
                    'nama' => 'PENDIDIKAN JURU SANDI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2048EF6A0E040640A040252AD',
                    'cepat_kode' => 2581,
                    'nama' => 'PENDIDIKAN KEAGRARIAAN DAN PRAKTEK UKUR'
                ),
                array(
                    'bkn_id' => 'A5EB03E2048FF6A0E040640A040252AD',
                    'cepat_kode' => 2582,
                    'nama' => 'PENDIDIKAN PENYIDIK PNS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20491F6A0E040640A040252AD',
                    'cepat_kode' => 2584,
                    'nama' => 'PENGAIRAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20492F6A0E040640A040252AD',
                    'cepat_kode' => 2585,
                    'nama' => 'PENGAMANAN PENYAKIT MENULAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20493F6A0E040640A040252AD',
                    'cepat_kode' => 2586,
                    'nama' => 'PENGAMAT HEWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20494F6A0E040640A040252AD',
                    'cepat_kode' => 2587,
                    'nama' => 'PENGAMAT PENGAIRAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20495F6A0E040640A040252AD',
                    'cepat_kode' => 2588,
                    'nama' => 'PENGAMAT PETERNAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20496F6A0E040640A040252AD',
                    'cepat_kode' => 2589,
                    'nama' => 'PENGAMAT WATAK PENYAKIT HEWAN MENULAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E203F4F6A0E040640A040252AD',
                    'cepat_kode' => 2509,
                    'nama' => 'PENGASUH PETERNAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20497F6A0E040640A040252AD',
                    'cepat_kode' => 2590,
                    'nama' => 'PENGATUR HEWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20499F6A0E040640A040252AD',
                    'cepat_kode' => 2592,
                    'nama' => 'PENGAWASAN CK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2049AF6A0E040640A040252AD',
                    'cepat_kode' => 2593,
                    'nama' => 'PENGAWASAN KEUANGAN NEGARA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2049BF6A0E040640A040252AD',
                    'cepat_kode' => 2594,
                    'nama' => 'PENGAWASAN LALU LINTAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E2049CF6A0E040640A040252AD',
                    'cepat_kode' => 2595,
                    'nama' => 'PENGELOLA AIR IRIGASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2049DF6A0E040640A040252AD',
                    'cepat_kode' => 2596,
                    'nama' => 'PENGELOLA OBAT'
                ),
                array(
                    'bkn_id' => 'A5EB03E2049EF6A0E040640A040252AD',
                    'cepat_kode' => 2597,
                    'nama' => 'PENGELOLAAN BARANG DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E204A3F6A0E040640A040252AD',
                    'cepat_kode' => 2602,
                    'nama' => 'PENGELOLAAN HASIL'
                ),
                array(
                    'bkn_id' => 'A5EB03E204A2F6A0E040640A040252AD',
                    'cepat_kode' => 2601,
                    'nama' => 'PENGET. BID. STATISTIK PETERNAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204A0F6A0E040640A040252AD',
                    'cepat_kode' => 2599,
                    'nama' => 'PENGETAHUAN PAKSA USAHA TERNAK POTONG'
                ),
                array(
                    'bkn_id' => 'A5EB03E204A1F6A0E040640A040252AD',
                    'cepat_kode' => 2600,
                    'nama' => 'PENGETAHUAN ZONING DAN PEMUTUSAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204A4F6A0E040640A040252AD',
                    'cepat_kode' => 2603,
                    'nama' => 'PENGUJIAN KENDERAAN BERMOTOR'
                ),
                array(
                    'bkn_id' => 'A5EB03E203FCF6A0E040640A040252AD',
                    'cepat_kode' => 2705,
                    'nama' => 'PENINGKATAN  UDKP'
                ),
                array(
                    'bkn_id' => 'A5EB03E204A8F6A0E040640A040252AD',
                    'cepat_kode' => 2607,
                    'nama' => 'PENINGKATAN GT. PENGOLAH PROGRAM PAB.PLP'
                ),
                array(
                    'bkn_id' => 'A5EB03E204A5F6A0E040640A040252AD',
                    'cepat_kode' => 2604,
                    'nama' => 'PENINGKATAN KETERAMPILAN BIDANG PERPAJAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204A6F6A0E040640A040252AD',
                    'cepat_kode' => 2605,
                    'nama' => 'PENINGKATAN KETERAMPILAN MANAG. DOKTER'
                ),
                array(
                    'bkn_id' => 'A5EB03E204A7F6A0E040640A040252AD',
                    'cepat_kode' => 2606,
                    'nama' => 'PENINGKATAN PEGAWAI'
                ),
                array(
                    'bkn_id' => 'A5EB03E203FFF6A0E040640A040252AD',
                    'cepat_kode' => 2708,
                    'nama' => 'PENINGKATAN SUS BERHUB DG PEM UMUM/DESA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203F7F6A0E040640A040252AD',
                    'cepat_kode' => 2700,
                    'nama' => 'PENINGKATAN TEKNIK KEPEGAWAIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203F8F6A0E040640A040252AD',
                    'cepat_kode' => 2701,
                    'nama' => 'PENINGKATAN TEKNIS KEUANGAN DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E203FBF6A0E040640A040252AD',
                    'cepat_kode' => 2704,
                    'nama' => 'PENINGKATAN TEN TEKNIS INF.& DOKUMEN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203F9F6A0E040640A040252AD',
                    'cepat_kode' => 2702,
                    'nama' => 'PENINGKATAN TNG.PERANCANG PER-UN&G-2 AN'
                ),
                array(
                    'bkn_id' => 'A5EB03E203FAF6A0E040640A040252AD',
                    'cepat_kode' => 2703,
                    'nama' => 'PENINGKATAN TNG.STAT.PETERNAKAN TK.DASAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E203FDF6A0E040640A040252AD',
                    'cepat_kode' => 2706,
                    'nama' => 'PENINGKATAN WASOR KUSTA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203FEF6A0E040640A040252AD',
                    'cepat_kode' => 2707,
                    'nama' => 'PENINGKATAN WASOR TCPS'
                ),
                array(
                    'bkn_id' => 'A5EB03E204ACF6A0E040640A040252AD',
                    'cepat_kode' => 2611,
                    'nama' => 'PENT. APARAT JURU PENERANG'
                ),
                array(
                    'bkn_id' => 'A5EB03E204A9F6A0E040640A040252AD',
                    'cepat_kode' => 2608,
                    'nama' => 'PENT. APARAT KOTATIP'
                ),
                array(
                    'bkn_id' => 'A5EB03E204AEF6A0E040640A040252AD',
                    'cepat_kode' => 2613,
                    'nama' => 'PENT. BAGI PEJABAT SOSPOL'
                ),
                array(
                    'bkn_id' => 'A5EB03E204AFF6A0E040640A040252AD',
                    'cepat_kode' => 2614,
                    'nama' => 'PENT. BAGI SEKWILMAT'
                ),
                array(
                    'bkn_id' => 'A5EB03E204B0F6A0E040640A040252AD',
                    'cepat_kode' => 2615,
                    'nama' => 'PENT. BENDAHARAAN TYPE A'
                ),
                array(
                    'bkn_id' => 'A5EB03E204B1F6A0E040640A040252AD',
                    'cepat_kode' => 2616,
                    'nama' => 'PENT. BIDAN INSERSI'
                ),
                array(
                    'bkn_id' => 'A5EB03E204B2F6A0E040640A040252AD',
                    'cepat_kode' => 2617,
                    'nama' => 'PENT. BKKBN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204B3F6A0E040640A040252AD',
                    'cepat_kode' => 2618,
                    'nama' => 'PENT. CALON PENATARAN MANAG.PEMWILCAM'
                ),
                array(
                    'bkn_id' => 'A5EB03E204B4F6A0E040640A040252AD',
                    'cepat_kode' => 2619,
                    'nama' => 'PENT. DASAR-DASAR PENGAWASAN UMUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E204B5F6A0E040640A040252AD',
                    'cepat_kode' => 2620,
                    'nama' => 'PENT. DESAIN JALAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204B6F6A0E040640A040252AD',
                    'cepat_kode' => 2621,
                    'nama' => 'PENT. DESIGN PERPIPAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204B7F6A0E040640A040252AD',
                    'cepat_kode' => 2622,
                    'nama' => 'PENT. DHF'
                ),
                array(
                    'bkn_id' => 'A5EB03E204B9F6A0E040640A040252AD',
                    'cepat_kode' => 2624,
                    'nama' => 'PENT. GODOK ENDEMIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E204BAF6A0E040640A040252AD',
                    'cepat_kode' => 2625,
                    'nama' => 'PENT. HUKUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E204BBF6A0E040640A040252AD',
                    'cepat_kode' => 2626,
                    'nama' => 'PENT. IMUNISASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E204BEF6A0E040640A040252AD',
                    'cepat_kode' => 2629,
                    'nama' => 'PENT. INVENTARISASI BARANG'
                ),
                array(
                    'bkn_id' => 'A5EB03E204BFF6A0E040640A040252AD',
                    'cepat_kode' => 2630,
                    'nama' => 'PENT. JURKAM SADAR WISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E204C0F6A0E040640A040252AD',
                    'cepat_kode' => 2631,
                    'nama' => 'PENT. JURU DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E204C2F6A0E040640A040252AD',
                    'cepat_kode' => 2633,
                    'nama' => 'PENT. KA. URUSAN ADMINISTRASI KECAMATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204C1F6A0E040640A040252AD',
                    'cepat_kode' => 2632,
                    'nama' => 'PENT. KAMAWIL HANSIP'
                ),
                array(
                    'bkn_id' => 'A5EB03E204C3F6A0E040640A040252AD',
                    'cepat_kode' => 2634,
                    'nama' => 'PENT. KEHUMASAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204C4F6A0E040640A040252AD',
                    'cepat_kode' => 2635,
                    'nama' => 'PENT. KEPALA WILAYAH LLAJR'
                ),
                array(
                    'bkn_id' => 'A5EB03E204C5F6A0E040640A040252AD',
                    'cepat_kode' => 2636,
                    'nama' => 'PENT. KKS ABRI BAGI TRIPIDA'
                ),
                array(
                    'bkn_id' => 'A5EB03E204C6F6A0E040640A040252AD',
                    'cepat_kode' => 2637,
                    'nama' => 'PENT. KONS. MANAGEMEN KOPERASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E204C7F6A0E040640A040252AD',
                    'cepat_kode' => 2638,
                    'nama' => 'PENT. KUSTA UNTUK DOKTER KA. PUSKESMAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E204C8F6A0E040640A040252AD',
                    'cepat_kode' => 2639,
                    'nama' => 'PENT. LAT. PERENCANAAN WILAYAH TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E204C9F6A0E040640A040252AD',
                    'cepat_kode' => 2640,
                    'nama' => 'PENT. LITSUS'
                ),
                array(
                    'bkn_id' => 'A5EB03E204CCF6A0E040640A040252AD',
                    'cepat_kode' => 2643,
                    'nama' => 'PENT. MANAGEMEN  PEMWILCAM'
                ),
                array(
                    'bkn_id' => 'A5EB03E204CAF6A0E040640A040252AD',
                    'cepat_kode' => 2641,
                    'nama' => 'PENT. MANAGEMEN AUDIT'
                ),
                array(
                    'bkn_id' => 'A5EB03E204CBF6A0E040640A040252AD',
                    'cepat_kode' => 2642,
                    'nama' => 'PENT. MANAGEMEN MT'
                ),
                array(
                    'bkn_id' => 'A5EB03E204CDF6A0E040640A040252AD',
                    'cepat_kode' => 2644,
                    'nama' => 'PENT. MOGRIS KODIS MALARIA'
                ),
                array(
                    'bkn_id' => 'A5EB03E204CEF6A0E040640A040252AD',
                    'cepat_kode' => 2645,
                    'nama' => 'PENT. NORMA PEMERIKSA APARATUR DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E204CFF6A0E040640A040252AD',
                    'cepat_kode' => 2646,
                    'nama' => 'PENT. OPERATOR OPSET'
                ),
                array(
                    'bkn_id' => 'A5EB03E204D0F6A0E040640A040252AD',
                    'cepat_kode' => 2647,
                    'nama' => 'PENT. ORIENTASI PPWKT'
                ),
                array(
                    'bkn_id' => 'A5EB03E204FAF6A0E040640A040252AD',
                    'cepat_kode' => 2689,
                    'nama' => 'PENT. P-4'
                ),
                array(
                    'bkn_id' => 'A5EB03E204D1F6A0E040640A040252AD',
                    'cepat_kode' => 2648,
                    'nama' => 'PENT. PARASITOLOGI'
                ),
                array(
                    'bkn_id' => 'A5EB03E204FBF6A0E040640A040252AD',
                    'cepat_kode' => 2690,
                    'nama' => 'PENT. P-D'
                ),
                array(
                    'bkn_id' => 'A5EB03E204D2F6A0E040640A040252AD',
                    'cepat_kode' => 2649,
                    'nama' => 'PENT. PEGAWAI TEKNIS'
                ),
                array(
                    'bkn_id' => 'A5EB03E204D3F6A0E040640A040252AD',
                    'cepat_kode' => 2650,
                    'nama' => 'PENT. PEJABAT PARIWISATA DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E204D9F6A0E040640A040252AD',
                    'cepat_kode' => 2656,
                    'nama' => 'PENT. PENDIDIKAN BELA NEGARA'
                ),
                array(
                    'bkn_id' => 'A5EB03E204DCF6A0E040640A040252AD',
                    'cepat_kode' => 2659,
                    'nama' => 'PENT. PENGAWASAN MELEKAT'
                ),
                array(
                    'bkn_id' => 'A5EB03E204DDF6A0E040640A040252AD',
                    'cepat_kode' => 2660,
                    'nama' => 'PENT. PENGELOLA TEKNIS OBJEK WISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E204DEF6A0E040640A040252AD',
                    'cepat_kode' => 2661,
                    'nama' => 'PENT. PENGENDALIAN WILAYAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E204DFF6A0E040640A040252AD',
                    'cepat_kode' => 2662,
                    'nama' => 'PENT. PENGETAHUAN DIBIDANG GOR/STADION'
                ),
                array(
                    'bkn_id' => 'A5EB03E204E0F6A0E040640A040252AD',
                    'cepat_kode' => 2663,
                    'nama' => 'PENT. PENGOLAHAN KEUANGAN DIDAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E204E3F6A0E040640A040252AD',
                    'cepat_kode' => 2666,
                    'nama' => 'PENT. PENINGKATAN SKILL BIDANG KEUANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204E4F6A0E040640A040252AD',
                    'cepat_kode' => 2667,
                    'nama' => 'PENT. PENYULUH PARIWISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E204E7F6A0E040640A040252AD',
                    'cepat_kode' => 2670,
                    'nama' => 'PENT. PERADILAN TU'
                ),
                array(
                    'bkn_id' => 'A5EB03E204E8F6A0E040640A040252AD',
                    'cepat_kode' => 2671,
                    'nama' => 'PENT. PERANGKAT PEMERINTAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E204E9F6A0E040640A040252AD',
                    'cepat_kode' => 2672,
                    'nama' => 'PENT. PERENCANAAN KOTA'
                ),
                array(
                    'bkn_id' => 'A5EB03E204ECF6A0E040640A040252AD',
                    'cepat_kode' => 2675,
                    'nama' => 'PENT. PERPUSTAKAN UMUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E204EDF6A0E040640A040252AD',
                    'cepat_kode' => 2676,
                    'nama' => 'PENT. PETUGAS OBJEK WISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E204F1F6A0E040640A040252AD',
                    'cepat_kode' => 2680,
                    'nama' => 'PENT. PETUGAS POM'
                ),
                array(
                    'bkn_id' => 'A5EB03E204F2F6A0E040640A040252AD',
                    'cepat_kode' => 2681,
                    'nama' => 'PENT. PETUGAS RUMAH POTONG HEWAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204F3F6A0E040640A040252AD',
                    'cepat_kode' => 2682,
                    'nama' => 'PENT. PGP-D'
                ),
                array(
                    'bkn_id' => 'A5EB03E204F4F6A0E040640A040252AD',
                    'cepat_kode' => 2683,
                    'nama' => 'PENT. PKBRS'
                ),
                array(
                    'bkn_id' => 'A5EB03E204F5F6A0E040640A040252AD',
                    'cepat_kode' => 2684,
                    'nama' => 'PENT. PKGMK'
                ),
                array(
                    'bkn_id' => 'A5EB03E204F6F6A0E040640A040252AD',
                    'cepat_kode' => 2685,
                    'nama' => 'PENT. PKM TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E204F7F6A0E040640A040252AD',
                    'cepat_kode' => 2686,
                    'nama' => 'PENT. PKN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204F8F6A0E040640A040252AD',
                    'cepat_kode' => 2687,
                    'nama' => 'PENT. PRAMUWISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E204F9F6A0E040640A040252AD',
                    'cepat_kode' => 2688,
                    'nama' => 'PENT. PROYEK PERINTIS PERBAIKAN KAMPUNG'
                ),
                array(
                    'bkn_id' => 'A5EB03E204FCF6A0E040640A040252AD',
                    'cepat_kode' => 2691,
                    'nama' => 'PENT. SATSAMPAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E204FDF6A0E040640A040252AD',
                    'cepat_kode' => 2692,
                    'nama' => 'PENT. SHN'
                ),
                array(
                    'bkn_id' => 'A5EB03E204FFF6A0E040640A040252AD',
                    'cepat_kode' => 2694,
                    'nama' => 'PENT. SISTEM ADMINISTRASI PERALATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20500F6A0E040640A040252AD',
                    'cepat_kode' => 2695,
                    'nama' => 'PENT. SJDI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20501F6A0E040640A040252AD',
                    'cepat_kode' => 2696,
                    'nama' => 'PENT. SPPTP'
                ),
                array(
                    'bkn_id' => 'A5EB03E20502F6A0E040640A040252AD',
                    'cepat_kode' => 2697,
                    'nama' => 'PENT. STAF TEK. PROYEK PLP BI&G DRAINASE'
                ),
                array(
                    'bkn_id' => 'A5EB03E203F5F6A0E040640A040252AD',
                    'cepat_kode' => 2698,
                    'nama' => 'PENT. STAF TEKNIK PLP BIDANG SAMPAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E203F6F6A0E040640A040252AD',
                    'cepat_kode' => 2699,
                    'nama' => 'PENT. TBC'
                ),
                array(
                    'bkn_id' => 'A5EB03E204ABF6A0E040640A040252AD',
                    'cepat_kode' => 2610,
                    'nama' => 'PENTALOKA PETUGAS GIZI'
                ),
                array(
                    'bkn_id' => 'A5EB03E204ADF6A0E040640A040252AD',
                    'cepat_kode' => 2612,
                    'nama' => 'PENT.APARAT PENGELOLA PEMBANGUNAN KOTA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20401F6A0E040640A040252AD',
                    'cepat_kode' => 2710,
                    'nama' => 'PENYEDIAAN AIR BERSIH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20402F6A0E040640A040252AD',
                    'cepat_kode' => 2711,
                    'nama' => 'PENYEHATAN KEMAMPUAN TEH PERKEBUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20403F6A0E040640A040252AD',
                    'cepat_kode' => 2712,
                    'nama' => 'PENYELESAIAN SENGKETA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20404F6A0E040640A040252AD',
                    'cepat_kode' => 2713,
                    'nama' => 'PENYIAPAN TENAGA PENYULUH OKK-P2LDT'
                ),
                array(
                    'bkn_id' => 'A5EB03E2040AF6A0E040640A040252AD',
                    'cepat_kode' => 2719,
                    'nama' => 'PENY.INDUSTRI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2040BF6A0E040640A040252AD',
                    'cepat_kode' => 2720,
                    'nama' => 'PENY.ORGANISASI DAN MGT'
                ),
                array(
                    'bkn_id' => 'A5EB03E2040CF6A0E040640A040252AD',
                    'cepat_kode' => 2721,
                    'nama' => 'PENY.PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2040DF6A0E040640A040252AD',
                    'cepat_kode' => 2722,
                    'nama' => 'PENY.POSYANDU'
                ),
                array(
                    'bkn_id' => 'A5EB03E2040EF6A0E040640A040252AD',
                    'cepat_kode' => 2723,
                    'nama' => 'PENY.TINGKAT NASIONAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E20405F6A0E040640A040252AD',
                    'cepat_kode' => 2714,
                    'nama' => 'PENYULUHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20409F6A0E040640A040252AD',
                    'cepat_kode' => 2718,
                    'nama' => 'PENYULUHAN DAN PERENCANAAN TENAGA KERJA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20406F6A0E040640A040252AD',
                    'cepat_kode' => 2715,
                    'nama' => 'PENYULUHAN KESEHATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20400F6A0E040640A040252AD',
                    'cepat_kode' => 2709,
                    'nama' => 'PENYULUHAN PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20407F6A0E040640A040252AD',
                    'cepat_kode' => 2716,
                    'nama' => 'PENYULUHAN SUB SEKTOR TK.NASIONAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E20408F6A0E040640A040252AD',
                    'cepat_kode' => 2717,
                    'nama' => 'PENYUSUNAN REPELITA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2040FF6A0E040640A040252AD',
                    'cepat_kode' => 2724,
                    'nama' => 'PERAMBUAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20410F6A0E040640A040252AD',
                    'cepat_kode' => 2725,
                    'nama' => 'PERANGKAT PENGAWASAN/PEMERIKSA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20411F6A0E040640A040252AD',
                    'cepat_kode' => 2726,
                    'nama' => 'PERC.PEMBANGUNAN PERKEBUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20412F6A0E040640A040252AD',
                    'cepat_kode' => 2727,
                    'nama' => 'PERC.PEMBANGUNAN PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20413F6A0E040640A040252AD',
                    'cepat_kode' => 2728,
                    'nama' => 'PERC.PENGEMBANGAN WILAYAH TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20414F6A0E040640A040252AD',
                    'cepat_kode' => 2729,
                    'nama' => 'PERC.PRODUKSI PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20415F6A0E040640A040252AD',
                    'cepat_kode' => 2730,
                    'nama' => 'PERDAGANGAN NEGARA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20416F6A0E040640A040252AD',
                    'cepat_kode' => 2731,
                    'nama' => 'PERENC DAERAH TK.I TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20417F6A0E040640A040252AD',
                    'cepat_kode' => 2732,
                    'nama' => 'PERENC KOTA JANGKA MENENGAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20418F6A0E040640A040252AD',
                    'cepat_kode' => 2733,
                    'nama' => 'PERENC PEMBANGUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2041EF6A0E040640A040252AD',
                    'cepat_kode' => 2739,
                    'nama' => 'PERENC PEMBANGUNAN DAERAH TK.II'
                ),
                array(
                    'bkn_id' => 'A5EB03E20419F6A0E040640A040252AD',
                    'cepat_kode' => 2734,
                    'nama' => 'PERENC PEMBANGUNAN DIBIDANG EKONOMI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2041AF6A0E040640A040252AD',
                    'cepat_kode' => 2735,
                    'nama' => 'PERENC PEMBANGUNAN DIDAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E2041BF6A0E040640A040252AD',
                    'cepat_kode' => 2736,
                    'nama' => 'PERENC PEMBANGUNAN PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2041CF6A0E040640A040252AD',
                    'cepat_kode' => 2737,
                    'nama' => 'PERENC PEMBANGUNAN PETERNAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2041DF6A0E040640A040252AD',
                    'cepat_kode' => 2738,
                    'nama' => 'PERENC PEMBANGUNAN TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E2041FF6A0E040640A040252AD',
                    'cepat_kode' => 2740,
                    'nama' => 'PERENC PERKANTORAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20420F6A0E040640A040252AD',
                    'cepat_kode' => 2741,
                    'nama' => 'PERENC PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20421F6A0E040640A040252AD',
                    'cepat_kode' => 2742,
                    'nama' => 'PERENC SOSIAL  PENGEMBANGAN KOTA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20422F6A0E040640A040252AD',
                    'cepat_kode' => 2743,
                    'nama' => 'PERFORMANCE IMPROPMENT (MMT)'
                ),
                array(
                    'bkn_id' => 'A5EB03E20423F6A0E040640A040252AD',
                    'cepat_kode' => 2744,
                    'nama' => 'PERHITUNGAN ANGGARAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20424F6A0E040640A040252AD',
                    'cepat_kode' => 2745,
                    'nama' => 'PERKAYUAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20425F6A0E040640A040252AD',
                    'cepat_kode' => 2746,
                    'nama' => 'PERKOPERASIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20426F6A0E040640A040252AD',
                    'cepat_kode' => 2747,
                    'nama' => 'PERLINDUNGAN TANAMAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20427F6A0E040640A040252AD',
                    'cepat_kode' => 2748,
                    'nama' => 'PERN DAN EVALUASI PROYEK'
                ),
                array(
                    'bkn_id' => 'A5EB03E20428F6A0E040640A040252AD',
                    'cepat_kode' => 2749,
                    'nama' => 'PERPAJAKAN DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20429F6A0E040640A040252AD',
                    'cepat_kode' => 2750,
                    'nama' => 'PERPUSTAKAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2042AF6A0E040640A040252AD',
                    'cepat_kode' => 2751,
                    'nama' => 'PERTAMANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2042BF6A0E040640A040252AD',
                    'cepat_kode' => 2752,
                    'nama' => 'PETERNAKAN ITIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2042CF6A0E040640A040252AD',
                    'cepat_kode' => 2753,
                    'nama' => 'PETUGAS DOMBA/KAMBING'
                ),
                array(
                    'bkn_id' => 'A5EB03E2042DF6A0E040640A040252AD',
                    'cepat_kode' => 2754,
                    'nama' => 'PETUGAS KESEHATAN MASY.VETERINER'
                ),
                array(
                    'bkn_id' => 'A5EB03E2042EF6A0E040640A040252AD',
                    'cepat_kode' => 2755,
                    'nama' => 'PETUGAS OBJEK WISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20430F6A0E040640A040252AD',
                    'cepat_kode' => 2757,
                    'nama' => 'PETUGAS PENYULUH PETERNAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2042FF6A0E040640A040252AD',
                    'cepat_kode' => 2756,
                    'nama' => 'PETUGAS PENYULUHAN LAPANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20431F6A0E040640A040252AD',
                    'cepat_kode' => 2758,
                    'nama' => 'PETUGAS PENYULUHAN LAP.PERUMAHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20433F6A0E040640A040252AD',
                    'cepat_kode' => 2760,
                    'nama' => 'PETUGAS TEKNIK BASAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E20434F6A0E040640A040252AD',
                    'cepat_kode' => 2761,
                    'nama' => 'PETUGAS TRANSMIGRASI SE INDONESIA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20435F6A0E040640A040252AD',
                    'cepat_kode' => 2762,
                    'nama' => 'PILLARIASYS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20436F6A0E040640A040252AD',
                    'cepat_kode' => 2763,
                    'nama' => 'PILOT TRAIN PERENC KOTA PROG.JGK PANJANG'
                ),
                array(
                    'bkn_id' => 'A5EB03E20437F6A0E040640A040252AD',
                    'cepat_kode' => 2764,
                    'nama' => 'PKB'
                ),
                array(
                    'bkn_id' => 'A5EB03E20438F6A0E040640A040252AD',
                    'cepat_kode' => 2765,
                    'nama' => 'PKMD'
                ),
                array(
                    'bkn_id' => 'A5EB03E20439F6A0E040640A040252AD',
                    'cepat_kode' => 2766,
                    'nama' => 'PLP'
                ),
                array(
                    'bkn_id' => 'A5EB03E2043AF6A0E040640A040252AD',
                    'cepat_kode' => 2767,
                    'nama' => 'PMS'
                ),
                array(
                    'bkn_id' => 'A5EB03E2043BF6A0E040640A040252AD',
                    'cepat_kode' => 2768,
                    'nama' => 'PMS DDN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2043CF6A0E040640A040252AD',
                    'cepat_kode' => 2769,
                    'nama' => 'PPKBD'
                ),
                array(
                    'bkn_id' => 'A5EB03E2043DF6A0E040640A040252AD',
                    'cepat_kode' => 2770,
                    'nama' => 'PPKS-SMPL'
                ),
                array(
                    'bkn_id' => 'A5EB03E2043EF6A0E040640A040252AD',
                    'cepat_kode' => 2771,
                    'nama' => 'PPL BUDIDAYA TERNAK POTONG'
                ),
                array(
                    'bkn_id' => 'A5EB03E2043FF6A0E040640A040252AD',
                    'cepat_kode' => 2772,
                    'nama' => 'PPL KARET'
                ),
                array(
                    'bkn_id' => 'A5EB03E20440F6A0E040640A040252AD',
                    'cepat_kode' => 2773,
                    'nama' => 'PPL KELAPA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20441F6A0E040640A040252AD',
                    'cepat_kode' => 2774,
                    'nama' => 'PPL TERNAK UNGGAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E20442F6A0E040640A040252AD',
                    'cepat_kode' => 2775,
                    'nama' => 'PPL/TC PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20443F6A0E040640A040252AD',
                    'cepat_kode' => 2776,
                    'nama' => 'PPS BUDIDAYA PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20444F6A0E040640A040252AD',
                    'cepat_kode' => 2777,
                    'nama' => 'PPS DASAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20445F6A0E040640A040252AD',
                    'cepat_kode' => 2778,
                    'nama' => 'PPS ORIENTASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20446F6A0E040640A040252AD',
                    'cepat_kode' => 2779,
                    'nama' => 'PPS TERNAK PERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20198F6A0E040640A040252AD',
                    'cepat_kode' => 2781,
                    'nama' => 'PROG.PELAT.INTEGRASI ASPEK KEPENDUDUKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20199F6A0E040640A040252AD',
                    'cepat_kode' => 2782,
                    'nama' => 'PROG.PEMBIAYAAN PRASARANA KOTA TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20197F6A0E040640A040252AD',
                    'cepat_kode' => 2780,
                    'nama' => 'PROGRAM JANGKA MENENGAH DAN P3KT'
                ),
                array(
                    'bkn_id' => 'A5EB03E2019AF6A0E040640A040252AD',
                    'cepat_kode' => 2783,
                    'nama' => 'PROGRAM PERENCANAAN NASIONAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E2019BF6A0E040640A040252AD',
                    'cepat_kode' => 2784,
                    'nama' => 'PROJECT DESIGN AND EVALUASION'
                ),
                array(
                    'bkn_id' => 'A5EB03E2019CF6A0E040640A040252AD',
                    'cepat_kode' => 2785,
                    'nama' => 'PROTEKSI'
                ),
                array(
                    'bkn_id' => 'A5EB03E2019DF6A0E040640A040252AD',
                    'cepat_kode' => 2786,
                    'nama' => 'PROYEK MGT SYSTEM (PMS)'
                ),
                array(
                    'bkn_id' => 'A5EB03E2019FF6A0E040640A040252AD',
                    'cepat_kode' => 2788,
                    'nama' => 'PROYEK PENINGKATAN PRODUKSI TERNAK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2019EF6A0E040640A040252AD',
                    'cepat_kode' => 2787,
                    'nama' => 'PROYEK UNTI PENYIDIKAN SAPI'
                ),
                array(
                    'bkn_id' => 'A5EB03E201A0F6A0E040640A040252AD',
                    'cepat_kode' => 2789,
                    'nama' => 'PTGA'
                ),
                array(
                    'bkn_id' => 'A5EB03E201A1F6A0E040640A040252AD',
                    'cepat_kode' => 2790,
                    'nama' => 'PTPD'
                ),
                array(
                    'bkn_id' => 'A5EB03E201A2F6A0E040640A040252AD',
                    'cepat_kode' => 2791,
                    'nama' => 'PTUN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201A3F6A0E040640A040252AD',
                    'cepat_kode' => 2792,
                    'nama' => 'PUPT'
                ),
                array(
                    'bkn_id' => 'A5EB03E201A4F6A0E040640A040252AD',
                    'cepat_kode' => 2793,
                    'nama' => 'PUSPIL'
                ),
                array(
                    'bkn_id' => 'A5EB03E201A5F6A0E040640A040252AD',
                    'cepat_kode' => 2794,
                    'nama' => 'PWS - PG'
                ),
                array(
                    'bkn_id' => 'A5EB03E201A6F6A0E040640A040252AD',
                    'cepat_kode' => 2795,
                    'nama' => 'RABIES'
                ),
                array(
                    'bkn_id' => 'A5EB03E201A7F6A0E040640A040252AD',
                    'cepat_kode' => 2796,
                    'nama' => 'RABIES PETUGAS LAPANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201A8F6A0E040640A040252AD',
                    'cepat_kode' => 2797,
                    'nama' => 'RECORDER'
                ),
                array(
                    'bkn_id' => 'E67F0157EECDEB31E050640AF10844ED',
                    'cepat_kode' => 3173,
                    'nama' => 'REFORMASI BIROKRASI'
                ),
                array(
                    'bkn_id' => 'E67F0157EECEEB31E050640AF10844ED',
                    'cepat_kode' => 3174,
                    'nama' => 'REFRESHING COURSE ESELON II/III/IV'
                ),
                array(
                    'bkn_id' => 'A5EB03E201A9F6A0E040640A040252AD',
                    'cepat_kode' => 2798,
                    'nama' => 'REG.PLANNING'
                ),
                array(
                    'bkn_id' => 'A5EB03E201AAF6A0E040640A040252AD',
                    'cepat_kode' => 2799,
                    'nama' => 'REPRODUKSI HEWAN NASIONAL'
                ),
                array(
                    'bkn_id' => 'E67F0157EECFEB31E050640AF10844ED',
                    'cepat_kode' => 3175,
                    'nama' => 'REVOLUSI MENTAL'
                ),
                array(
                    'bkn_id' => 'B3BFF38092F32B03E050640A2903458A',
                    'cepat_kode' => 3056,
                    'nama' => 'RUMPUN ARSITEKTUR, DESAIN, DAN PERENCANAAN'
                ),
                array(
                    'bkn_id' => 'B3BFF38093052B03E050640A2903458A',
                    'cepat_kode' => 3074,
                    'nama' => 'RUMPUN BAHASA INTERNASIONAL'
                ),
                array(
                    'bkn_id' => 'B3BFF38093022B03E050640A2903458A',
                    'cepat_kode' => 3071,
                    'nama' => 'RUMPUN BISNIS'
                ),
                array(
                    'bkn_id' => 'B3BFF38092FE2B03E050640A2903458A',
                    'cepat_kode' => 3067,
                    'nama' => 'RUMPUN HUKUM'
                ),
                array(
                    'bkn_id' => 'B3BFF38092FB2B03E050640A2903458A',
                    'cepat_kode' => 3064,
                    'nama' => 'RUMPUN ILMU ALAM'
                ),
                array(
                    'bkn_id' => 'B3BFF38093012B03E050640A2903458A',
                    'cepat_kode' => 3070,
                    'nama' => 'RUMPUN ILMU FORMAL'
                ),
                array(
                    'bkn_id' => 'B3BFF38092F92B03E050640A2903458A',
                    'cepat_kode' => 3062,
                    'nama' => 'RUMPUN ILMU HUMANIORA'
                ),
                array(
                    'bkn_id' => 'B3BFF38093042B03E050640A2903458A',
                    'cepat_kode' => 3073,
                    'nama' => 'RUMPUN ILMU SOSIAL'
                ),
                array(
                    'bkn_id' => 'B3BFF38092F42B03E050640A2903458A',
                    'cepat_kode' => 3057,
                    'nama' => 'RUMPUN ILMU TERAPAN PERTANIAN'
                ),
                array(
                    'bkn_id' => 'B3BFF38092F22B03E050640A2903458A',
                    'cepat_kode' => 3055,
                    'nama' => 'RUMPUN JEJARING KEILMUAN MULTI, INTER, ATAU TRANSDISIPLIN'
                ),
                array(
                    'bkn_id' => 'B3BFF38092F82B03E050640A2903458A',
                    'cepat_kode' => 3061,
                    'nama' => 'RUMPUN KEOLAHRAGAAN'
                ),
                array(
                    'bkn_id' => 'B3BFF38093032B03E050640A2903458A',
                    'cepat_kode' => 3072,
                    'nama' => 'RUMPUN KESEHATAN'
                ),
                array(
                    'bkn_id' => 'B3BFF38093002B03E050640A2903458A',
                    'cepat_kode' => 3069,
                    'nama' => 'RUMPUN KOMUNIKASI'
                ),
                array(
                    'bkn_id' => 'B3BFF38092F72B03E050640A2903458A',
                    'cepat_kode' => 3060,
                    'nama' => 'RUMPUN LINGKUNGAN'
                ),
                array(
                    'bkn_id' => 'B3BFF38092FA2B03E050640A2903458A',
                    'cepat_kode' => 3063,
                    'nama' => 'RUMPUN MILITER'
                ),
                array(
                    'bkn_id' => 'B3BFF38092F52B03E050640A2903458A',
                    'cepat_kode' => 3058,
                    'nama' => 'RUMPUN PARIWISATA'
                ),
                array(
                    'bkn_id' => 'B3BFF38092F12B03E050640A2903458A',
                    'cepat_kode' => 3054,
                    'nama' => 'RUMPUN PENDIDIKAN'
                ),
                array(
                    'bkn_id' => 'B3BFF38092F62B03E050640A2903458A',
                    'cepat_kode' => 3059,
                    'nama' => 'RUMPUN PROGRAM MAGISTER TERAPAN DAN PROGRAM DOKTOR TERAPAN'
                ),
                array(
                    'bkn_id' => 'B3BFF38092FC2B03E050640A2903458A',
                    'cepat_kode' => 3065,
                    'nama' => 'RUMPUN SAINS INFORMASI'
                ),
                array(
                    'bkn_id' => 'B3BFF38092FD2B03E050640A2903458A',
                    'cepat_kode' => 3066,
                    'nama' => 'RUMPUN SOSIAL'
                ),
                array(
                    'bkn_id' => 'B3BFF38092F02B03E050640A2903458A',
                    'cepat_kode' => 3053,
                    'nama' => 'RUMPUN TEKNIK ATAU REKAYASA'
                ),
                array(
                    'bkn_id' => 'B3BFF38092FF2B03E050640A2903458A',
                    'cepat_kode' => 3068,
                    'nama' => 'RUMPUN TRANSPORTASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E201ABF6A0E040640A040252AD',
                    'cepat_kode' => 2800,
                    'nama' => 'RURAL REGIONAL'
                ),
                array(
                    'bkn_id' => 'A5EB03E201ACF6A0E040640A040252AD',
                    'cepat_kode' => 2801,
                    'nama' => 'SADAR WISATA BAGI TNG.INDUS.PARIWISATA'
                ),
                array(
                    'bkn_id' => 'A5EB03E201ADF6A0E040640A040252AD',
                    'cepat_kode' => 2802,
                    'nama' => 'SANDI DAN TELEKOMUNIKASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E201AEF6A0E040640A040252AD',
                    'cepat_kode' => 2803,
                    'nama' => 'SANTIAJI PENGENDALIAN KETERTIBAN UMUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E201AFF6A0E040640A040252AD',
                    'cepat_kode' => 2804,
                    'nama' => 'SEKOLAH PEKARYA KESEHATAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201B0F6A0E040640A040252AD',
                    'cepat_kode' => 2805,
                    'nama' => 'SEKOLAH PEMBANTU PARAMEDIS'
                ),
                array(
                    'bkn_id' => 'A5EB03E201B1F6A0E040640A040252AD',
                    'cepat_kode' => 2806,
                    'nama' => 'SEMINAR ON JAPANESE TOURRISTS'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4625BA2E050640AF1085889',
                    'cepat_kode' => 3100,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG ANALIS ANGGARAN'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4725BA2E050640AF1085889',
                    'cepat_kode' => 3116,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG ANALIS HUKUM'
                ),
                array(
                    'bkn_id' => 'CEB02F55C46A5BA2E050640AF1085889',
                    'cepat_kode' => 3108,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG ANALIS KEBIJAKAN'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4635BA2E050640AF1085889',
                    'cepat_kode' => 3101,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG ARSIPARIS'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4675BA2E050640AF1085889',
                    'cepat_kode' => 3105,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG ASESOR SDM'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4655BA2E050640AF1085889',
                    'cepat_kode' => 3103,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG AUDITOR'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4735BA2E050640AF1085889',
                    'cepat_kode' => 3117,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG PELAKSANA'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4695BA2E050640AF1085889',
                    'cepat_kode' => 3107,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG PENATA LAKSANA BARANG'
                ),
                array(
                    'bkn_id' => 'CEB02F55C45F5BA2E050640AF1085889',
                    'cepat_kode' => 3097,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG PENGAWAS FARMASI DAN MAKANAN'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4605BA2E050640AF1085889',
                    'cepat_kode' => 3098,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG PENGELOLA KEUANGAN APBN'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4615BA2E050640AF1085889',
                    'cepat_kode' => 3099,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG PENGELOLA PENGADAAN BARANG DAN JASA'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4685BA2E050640AF1085889',
                    'cepat_kode' => 3106,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG PENGELOLA SDM APARATUR'
                ),
                array(
                    'bkn_id' => 'CEB02F55C46B5BA2E050640AF1085889',
                    'cepat_kode' => 3109,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG PENGEMBANGAN TEKNOLOGI PEMBELAJARAN'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4645BA2E050640AF1085889',
                    'cepat_kode' => 3102,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG PERANCANG UNDANG-UNDANG'
                ),
                array(
                    'bkn_id' => 'CEB02F55C46D5BA2E050640AF1085889',
                    'cepat_kode' => 3111,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG PERENCANA'
                ),
                array(
                    'bkn_id' => 'CEB02F55C46C5BA2E050640AF1085889',
                    'cepat_kode' => 3110,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG PRANATA HUMAS'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4665BA2E050640AF1085889',
                    'cepat_kode' => 3104,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG PRANATA KOMPUTER'
                ),
                array(
                    'bkn_id' => 'CEB02F55C46F5BA2E050640AF1085889',
                    'cepat_kode' => 3113,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG PUSTAKAWAN'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4705BA2E050640AF1085889',
                    'cepat_kode' => 3114,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG STATISTISI'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4745BA2E050640AF1085889',
                    'cepat_kode' => 3118,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG STRUKTURAL'
                ),
                array(
                    'bkn_id' => 'CEB02F55C46E5BA2E050640AF1085889',
                    'cepat_kode' => 3112,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG TEKNIS PSIKOLOGI KLINIS'
                ),
                array(
                    'bkn_id' => 'CEB02F55C4715BA2E050640AF1085889',
                    'cepat_kode' => 3115,
                    'nama' => 'SEMINAR/WORKSHOP/KURSUS/MAGANG WIDYAISWARA'
                ),
                array(
                    'bkn_id' => 'A5EB03E201B2F6A0E040640A040252AD',
                    'cepat_kode' => 2807,
                    'nama' => 'SENI MUSIK ANAK-ANAK'
                ),
                array(
                    'bkn_id' => 'A5EB03E201B3F6A0E040640A040252AD',
                    'cepat_kode' => 2808,
                    'nama' => 'SENSUS PETERNAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201B4F6A0E040640A040252AD',
                    'cepat_kode' => 2809,
                    'nama' => 'SHORT COURSE TENTANG KEHUMASAN PROTOKOL'
                ),
                array(
                    'bkn_id' => 'A5EB03E201B5F6A0E040640A040252AD',
                    'cepat_kode' => 2810,
                    'nama' => 'SIMPOSIUM DAN KURSUS PDM'
                ),
                array(
                    'bkn_id' => 'A5EB03E201B6F6A0E040640A040252AD',
                    'cepat_kode' => 2811,
                    'nama' => 'SISTEM KEUANGAN DAN BIMBINGAN KEUANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201B7F6A0E040640A040252AD',
                    'cepat_kode' => 2812,
                    'nama' => 'SMALHOLDER LIVESTOCK PRODUCTION'
                ),
                array(
                    'bkn_id' => 'A5EB03E201B8F6A0E040640A040252AD',
                    'cepat_kode' => 2813,
                    'nama' => 'SOIL AMELIORATION'
                ),
                array(
                    'bkn_id' => 'A5EB03E201B9F6A0E040640A040252AD',
                    'cepat_kode' => 2814,
                    'nama' => 'SPESIALIS DASAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E201BAF6A0E040640A040252AD',
                    'cepat_kode' => 2815,
                    'nama' => 'SPLEOLOGI'
                ),
                array(
                    'bkn_id' => 'A5EB03E201BBF6A0E040640A040252AD',
                    'cepat_kode' => 2816,
                    'nama' => 'STATISTIK PERIKANAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201BCF6A0E040640A040252AD',
                    'cepat_kode' => 2817,
                    'nama' => 'STATISTIK PERTANIAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201BDF6A0E040640A040252AD',
                    'cepat_kode' => 2818,
                    'nama' => 'STERILTI CONTROL'
                ),
                array(
                    'bkn_id' => 'A5EB03E201BEF6A0E040640A040252AD',
                    'cepat_kode' => 2819,
                    'nama' => 'STUDY PENGEMBANGAN REGIONAL LTA 12'
                ),
                array(
                    'bkn_id' => 'A5EB03E201BFF6A0E040640A040252AD',
                    'cepat_kode' => 2820,
                    'nama' => 'SUPERVISI PENINGKATAN DAN PEMELIHARAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201C0F6A0E040640A040252AD',
                    'cepat_kode' => 2821,
                    'nama' => 'SURVEY TB'
                ),
                array(
                    'bkn_id' => 'A5EB03E20280F6A0E040640A040252AD',
                    'cepat_kode' => 2137,
                    'nama' => 'SUS BID PIPA BOR & PASANG POMPA TANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20282F6A0E040640A040252AD',
                    'cepat_kode' => 2139,
                    'nama' => 'SUS BIMTEK PENYL SENGKETA & KUASA HUKUM'
                ),
                array(
                    'bkn_id' => 'A5EB03E20285F6A0E040640A040252AD',
                    'cepat_kode' => 2142,
                    'nama' => 'SUS DASAR APLIKASI & PRODUKSI ALAT BERAT'
                ),
                array(
                    'bkn_id' => 'A5EB03E20288F6A0E040640A040252AD',
                    'cepat_kode' => 2145,
                    'nama' => 'SUS FOTO UD PETA PEMATIK KOTA SKAL BESAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E20289F6A0E040640A040252AD',
                    'cepat_kode' => 2146,
                    'nama' => 'SUS GAMBAR & ANGG BANGUNAN CIPTA KARYA'
                ),
                array(
                    'bkn_id' => 'A5EB03E2033EF6A0E040640A040252AD',
                    'cepat_kode' => 2243,
                    'nama' => 'SUS GAS.BID CIPKAR JUR PEMELIHRN.GEDUNG'
                ),
                array(
                    'bkn_id' => 'A5EB03E20339F6A0E040640A040252AD',
                    'cepat_kode' => 2238,
                    'nama' => 'SUS HIT STAT.REG.INCOME PERCAPITA'
                ),
                array(
                    'bkn_id' => 'A5EB03E201C1F6A0E040640A040252AD',
                    'cepat_kode' => 2822,
                    'nama' => 'SUS KALAK'
                ),
                array(
                    'bkn_id' => 'A5EB03E201C2F6A0E040640A040252AD',
                    'cepat_kode' => 2823,
                    'nama' => 'SUS KAPIN HANSIP'
                ),
                array(
                    'bkn_id' => 'A5EB03E202A0F6A0E040640A040252AD',
                    'cepat_kode' => 2169,
                    'nama' => 'SUS LAT LANJUTAN METER DIESEL & LISTRIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E202A3F6A0E040640A040252AD',
                    'cepat_kode' => 2172,
                    'nama' => 'SUS MANAG.PROY PERSONIL TK SM/MM RCNTP-1'
                ),
                array(
                    'bkn_id' => 'A5EB03E202A6F6A0E040640A040252AD',
                    'cepat_kode' => 2175,
                    'nama' => 'SUS MANAG.PROYEK & METODE SURVEY HARAPAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202B5F6A0E040640A040252AD',
                    'cepat_kode' => 2190,
                    'nama' => 'SUS ORIENT PROG.PENGHIJAUAN & REBOISASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E202B3F6A0E040640A040252AD',
                    'cepat_kode' => 2188,
                    'nama' => 'SUS ORIENTASI DAL.CEMAR.LING&PENGEL SDA'
                ),
                array(
                    'bkn_id' => 'A5EB03E202AFF6A0E040640A040252AD',
                    'cepat_kode' => 2184,
                    'nama' => 'SUS ORIENTASI PEMBANGUNAN DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E202B0F6A0E040640A040252AD',
                    'cepat_kode' => 2185,
                    'nama' => 'SUS ORIENTASI PEMBANGUNAN PERKOTAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202B1F6A0E040640A040252AD',
                    'cepat_kode' => 2186,
                    'nama' => 'SUS ORIENTASI PEMBANGUNAN TERPADU'
                ),
                array(
                    'bkn_id' => 'A5EB03E202B2F6A0E040640A040252AD',
                    'cepat_kode' => 2187,
                    'nama' => 'SUS ORIENTASI PEMDA TK.II'
                ),
                array(
                    'bkn_id' => 'A5EB03E202B4F6A0E040640A040252AD',
                    'cepat_kode' => 2189,
                    'nama' => 'SUS ORIENTASI RENCANA KERJA DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E202B6F6A0E040640A040252AD',
                    'cepat_kode' => 2191,
                    'nama' => 'SUS ORIENTASI TEKNIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E202BBF6A0E040640A040252AD',
                    'cepat_kode' => 2196,
                    'nama' => 'SUS PEDOMAN PENY PERENC & DAL.PEMB DRH'
                ),
                array(
                    'bkn_id' => 'A5EB03E202BEF6A0E040640A040252AD',
                    'cepat_kode' => 2199,
                    'nama' => 'SUS PEMANFAATAN LHN KOTA&PELAK TIB BANG.'
                ),
                array(
                    'bkn_id' => 'A5EB03E202BFF6A0E040640A040252AD',
                    'cepat_kode' => 2200,
                    'nama' => 'SUS PEMANFAATAN LIMBAH PERTANIAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E202C0F6A0E040640A040252AD',
                    'cepat_kode' => 2201,
                    'nama' => 'SUS PEMB APARAT PEMBANGUNAN KOTA'
                ),
                array(
                    'bkn_id' => 'A5EB03E202C2F6A0E040640A040252AD',
                    'cepat_kode' => 2203,
                    'nama' => 'SUS PEMBENIHAN UDANG GALAH DAN WINDU'
                ),
                array(
                    'bkn_id' => 'A5EB03E20327F6A0E040640A040252AD',
                    'cepat_kode' => 2220,
                    'nama' => 'SUS PENGELOLAAN ADM BARANG DAERAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20328F6A0E040640A040252AD',
                    'cepat_kode' => 2221,
                    'nama' => 'SUS PENGEMB.& PENYEMPURNAAN DATA POKOK'
                ),
                array(
                    'bkn_id' => 'A5EB03E2032CF6A0E040640A040252AD',
                    'cepat_kode' => 2225,
                    'nama' => 'SUS PENYEGARAN PERNC PERUNDANG-UNDANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2032EF6A0E040640A040252AD',
                    'cepat_kode' => 2227,
                    'nama' => 'SUS PENYUSN.PERENC&DAL PAMBAGIAN DRH'
                ),
                array(
                    'bkn_id' => 'A5EB03E2032FF6A0E040640A040252AD',
                    'cepat_kode' => 2228,
                    'nama' => 'SUS PENYUSUNAN TATA RUANG PEDESAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20330F6A0E040640A040252AD',
                    'cepat_kode' => 2229,
                    'nama' => 'SUS PERBAIKAN KAMPUNG'
                ),
                array(
                    'bkn_id' => 'A5EB03E20335F6A0E040640A040252AD',
                    'cepat_kode' => 2234,
                    'nama' => 'SUS PERENC & TATA LAKSANA PEMBAGIAN DRH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20337F6A0E040640A040252AD',
                    'cepat_kode' => 2236,
                    'nama' => 'SUS PERENC PRODUKSI PETERNAKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2033FF6A0E040640A040252AD',
                    'cepat_kode' => 2244,
                    'nama' => 'SUS PETUGAS LAPANGAN PROYEK PUPADB'
                ),
                array(
                    'bkn_id' => 'A5EB03E20343F6A0E040640A040252AD',
                    'cepat_kode' => 2248,
                    'nama' => 'SUS PIMPRO PROG.PENUNJANG JLN KABUPATEN'
                ),
                array(
                    'bkn_id' => 'A5EB03E20346F6A0E040640A040252AD',
                    'cepat_kode' => 2251,
                    'nama' => 'SUS POLISI PAMONG PRAJA'
                ),
                array(
                    'bkn_id' => 'A5EB03E20347F6A0E040640A040252AD',
                    'cepat_kode' => 2252,
                    'nama' => 'SUS PRODUK DOMESTIK REG. BRUTO (PDRB)'
                ),
                array(
                    'bkn_id' => 'A5EB03E20348F6A0E040640A040252AD',
                    'cepat_kode' => 2253,
                    'nama' => 'SUS PROGRAM KERJA LISTRIK MASUK DESA'
                ),
                array(
                    'bkn_id' => 'A5EB03E203BDF6A0E040640A040252AD',
                    'cepat_kode' => 2454,
                    'nama' => 'SUS SIST.LAKU PENYULUH PERTANIAN LAP.'
                ),
                array(
                    'bkn_id' => 'A5EB03E2034DF6A0E040640A040252AD',
                    'cepat_kode' => 2258,
                    'nama' => 'SUS STAF PEMBANTU BUPATI ANGKATAN V'
                ),
                array(
                    'bkn_id' => 'A5EB03E201ECF6A0E040640A040252AD',
                    'cepat_kode' => 2865,
                    'nama' => 'SUS TANAH DAN PEMETAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E2047DF6A0E040640A040252AD',
                    'cepat_kode' => 2564,
                    'nama' => 'TAP PELAKSANAAN UU NO.5 TAHUN 1979'
                ),
                array(
                    'bkn_id' => 'A5EB03E201C3F6A0E040640A040252AD',
                    'cepat_kode' => 2824,
                    'nama' => 'TARPADNAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E201C4F6A0E040640A040252AD',
                    'cepat_kode' => 2825,
                    'nama' => 'TARWASKAT TN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201C5F6A0E040640A040252AD',
                    'cepat_kode' => 2826,
                    'nama' => 'TATA RUANG'
                ),
                array(
                    'bkn_id' => 'A5EB03E201C6F6A0E040640A040252AD',
                    'cepat_kode' => 2827,
                    'nama' => 'TATA USAHA TENTANG PAJAK'
                ),
                array(
                    'bkn_id' => 'A5EB03E201C7F6A0E040640A040252AD',
                    'cepat_kode' => 2828,
                    'nama' => 'TECHNOLOGI BUAH-BUAHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201CBF6A0E040640A040252AD',
                    'cepat_kode' => 2832,
                    'nama' => 'TEHNISI KETRAMP.GAS PEREN TG.KERJA DT II'
                ),
                array(
                    'bkn_id' => 'A5EB03E201CCF6A0E040640A040252AD',
                    'cepat_kode' => 2833,
                    'nama' => 'TEHNISI RADIO KOMUNIKASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E201CDF6A0E040640A040252AD',
                    'cepat_kode' => 2834,
                    'nama' => 'TEHNISI SURVEY DAN PEMETAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201CEF6A0E040640A040252AD',
                    'cepat_kode' => 2835,
                    'nama' => 'TEHNOLOGI IKAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201CFF6A0E040640A040252AD',
                    'cepat_kode' => 2836,
                    'nama' => 'TEJNIK BUDIDAYA AIR TAWAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E201CAF6A0E040640A040252AD',
                    'cepat_kode' => 2831,
                    'nama' => 'TEKNIK DAN METODE PENGELOLAAN PROJECT UP'
                ),
                array(
                    'bkn_id' => 'A5EB03E201C8F6A0E040640A040252AD',
                    'cepat_kode' => 2829,
                    'nama' => 'TEKNIK MANAJEMEN PERENC PEMBANGUNAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201D0F6A0E040640A040252AD',
                    'cepat_kode' => 2837,
                    'nama' => 'TEKNIK PENGGUNAAN PUPUK'
                ),
                array(
                    'bkn_id' => 'A5EB03E201C9F6A0E040640A040252AD',
                    'cepat_kode' => 2830,
                    'nama' => 'TEKNIK PENILAIAN PROYEK'
                ),
                array(
                    'bkn_id' => 'E67F0157EED0EB31E050640AF10844ED',
                    'cepat_kode' => 3176,
                    'nama' => 'TEKNIS ADMINISTRASI KEJAKSAAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EED1EB31E050640AF10844ED',
                    'cepat_kode' => 3177,
                    'nama' => 'TEKNIS AGEN INTELIJEN'
                ),
                array(
                    'bkn_id' => 'E67F0157EED2EB31E050640AF10844ED',
                    'cepat_kode' => 3178,
                    'nama' => 'TEKNIS AJUDAN PIMPINAN / ADC'
                ),
                array(
                    'bkn_id' => 'E67F0157EED3EB31E050640AF10844ED',
                    'cepat_kode' => 3179,
                    'nama' => 'TEKNIS ASSET RECOVERY'
                ),
                array(
                    'bkn_id' => 'E6F4F39B82D995FBE050640AF10835F9',
                    'cepat_kode' => 3238,
                    'nama' => 'TEKNIS ASSET RECOVERY DAN EKSTRADISI'
                ),
                array(
                    'bkn_id' => 'E67F0157EED4EB31E050640AF10844ED',
                    'cepat_kode' => 3180,
                    'nama' => 'TEKNIS ASSET TRACING'
                ),
                array(
                    'bkn_id' => 'E67F0157EED5EB31E050640AF10844ED',
                    'cepat_kode' => 3181,
                    'nama' => 'TEKNIS AUDIT KECURANGAN/FRAUD EXAMINATION'
                ),
                array(
                    'bkn_id' => 'E67F0157EED6EB31E050640AF10844ED',
                    'cepat_kode' => 3182,
                    'nama' => 'TEKNIS BAHASA ASING'
                ),
                array(
                    'bkn_id' => 'E6F507920BD3F138E050640AF2084E98',
                    'cepat_kode' => 3245,
                    'nama' => 'TEKNIS BENDAHARA PENGELUARAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EED7EB31E050640AF10844ED',
                    'cepat_kode' => 3183,
                    'nama' => 'TEKNIS CERTIFIED DATA CENTER PROFESSIONAL (CDCP)'
                ),
                array(
                    'bkn_id' => 'E67F0157EED8EB31E050640AF10844ED',
                    'cepat_kode' => 3184,
                    'nama' => 'TEKNIS CERTIFIED ETHICAL HACKER (CEH)'
                ),
                array(
                    'bkn_id' => 'E67F0157EED9EB31E050640AF10844ED',
                    'cepat_kode' => 3185,
                    'nama' => 'TEKNIS CERTIFIED NETWORK DEFENDER (CND)'
                ),
                array(
                    'bkn_id' => 'E67F0157EEDAEB31E050640AF10844ED',
                    'cepat_kode' => 3186,
                    'nama' => 'TEKNIS COMP TIA CYBER SECURITY ANALYST'
                ),
                array(
                    'bkn_id' => 'E67F0157EEDBEB31E050640AF10844ED',
                    'cepat_kode' => 3187,
                    'nama' => 'TEKNIS COMPUTER FORENSIC FUNDAMENTAL (CFF)'
                ),
                array(
                    'bkn_id' => 'E67F0157EEDCEB31E050640AF10844ED',
                    'cepat_kode' => 3188,
                    'nama' => 'TEKNIS COMPUTER HACKING FORENSIC INVESTIGATOR (CHFI)'
                ),
                array(
                    'bkn_id' => 'E6F508186D70C56DE050640AF2084F07',
                    'cepat_kode' => 3276,
                    'nama' => 'TEKNIS DIGITAL FORENSIK'
                ),
                array(
                    'bkn_id' => 'E67F0157EEDDEB31E050640AF10844ED',
                    'cepat_kode' => 3189,
                    'nama' => '"TEKNIS FOR 578 CYBER THREAD INTELEGENCE "'
                ),
                array(
                    'bkn_id' => 'E6F504BD82E95179E050640AF2084E07',
                    'cepat_kode' => 3230,
                    'nama' => 'TEKNIS HAK ASASI MANUSIA'
                ),
                array(
                    'bkn_id' => 'E67F0157EEDEEB31E050640AF10844ED',
                    'cepat_kode' => 3190,
                    'nama' => '"TEKNIS HARDENING OPERATING SYSTEM "'
                ),
                array(
                    'bkn_id' => 'E67F0157EEDFEB31E050640AF10844ED',
                    'cepat_kode' => 3191,
                    'nama' => 'TEKNIS HUMAN TRAFICKING'
                ),
                array(
                    'bkn_id' => 'E67F0157EEE0EB31E050640AF10844ED',
                    'cepat_kode' => 3192,
                    'nama' => 'TEKNIS ILLEGAL FISHING'
                ),
                array(
                    'bkn_id' => 'E6F5075029D32E42E050640AF2084E7B',
                    'cepat_kode' => 3233,
                    'nama' => 'TEKNIS ILLEGAL MINING'
                ),
                array(
                    'bkn_id' => 'E67F0157EEE1EB31E050640AF10844ED',
                    'cepat_kode' => 3193,
                    'nama' => 'TEKNIS INTELIJEN DASAR'
                ),
                array(
                    'bkn_id' => 'E6F4F389200CB20BE050640AF10835F5',
                    'cepat_kode' => 3234,
                    'nama' => 'TEKNIS IT DATA BASE'
                ),
                array(
                    'bkn_id' => 'A5EB03E201D1F6A0E040640A040252AD',
                    'cepat_kode' => 2838,
                    'nama' => 'TEKNIS JEMBATAN TIMBANG & TRAFFIC LIGHT'
                ),
                array(
                    'bkn_id' => 'E6F4F3AFA2C5F51DE050640AF108360B',
                    'cepat_kode' => 3243,
                    'nama' => 'TEKNIS KEAMANAN DALAM'
                ),
                array(
                    'bkn_id' => 'E67F0157EEE2EB31E050640AF10844ED',
                    'cepat_kode' => 3194,
                    'nama' => 'TEKNIS KEBAKARAN HUTAN DAN LAHAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EEE3EB31E050640AF10844ED',
                    'cepat_kode' => 3195,
                    'nama' => 'TEKNIS KEHUTANAN'
                ),
                array(
                    'bkn_id' => 'E6F508462054F92CE050640AF2084F27',
                    'cepat_kode' => 3286,
                    'nama' => '"TEKNIS KEMUDAHAN INVESTASI "'
                ),
                array(
                    'bkn_id' => 'E6F4F402E058C7FDE050640AF1083667',
                    'cepat_kode' => 3263,
                    'nama' => 'TEKNIS KEPAILITAN'
                ),
                array(
                    'bkn_id' => 'E6F507CC69211DE3E050640AF2084EB7',
                    'cepat_kode' => 3259,
                    'nama' => 'TEKNIS KEPENGACARAAN (TEKNIK LANJUTAN 1)'
                ),
                array(
                    'bkn_id' => 'E67F0157EEE4EB31E050640AF10844ED',
                    'cepat_kode' => 3196,
                    'nama' => 'TEKNIS KOMPUTER FORENSIK'
                ),
                array(
                    'bkn_id' => 'E6F5079EAE15117AE050640AF2084E9C',
                    'cepat_kode' => 3248,
                    'nama' => 'TEKNIS KOMPUTER FORENSIK INTELIJEN'
                ),
                array(
                    'bkn_id' => 'E6F4FC861C09E447E050640AF2084BF0',
                    'cepat_kode' => 3288,
                    'nama' => 'TEKNIS LEGAL ASSISTANCE'
                ),
                array(
                    'bkn_id' => 'E6F4F44B718B8D1BE050640AF10836AE',
                    'cepat_kode' => 3279,
                    'nama' => 'TEKNIS LEGAL DRAFTING'
                ),
                array(
                    'bkn_id' => 'E67F0157EEE5EB31E050640AF10844ED',
                    'cepat_kode' => 3197,
                    'nama' => 'TEKNIS LINGKUNGAN HIDUP'
                ),
                array(
                    'bkn_id' => 'E67F0157EEE6EB31E050640AF10844ED',
                    'cepat_kode' => 3198,
                    'nama' => 'TEKNIS LITIGASI'
                ),
                array(
                    'bkn_id' => 'E6F4F3F6C6022D4DE050640AF1083641',
                    'cepat_kode' => 3260,
                    'nama' => 'TEKNIS LITIGASI (TEKNIK LANJUTAN 2)'
                ),
                array(
                    'bkn_id' => 'E6F4F41A598DD298E050640AF1083674',
                    'cepat_kode' => 3268,
                    'nama' => 'TEKNIS MAFIA TANAH'
                ),
                array(
                    'bkn_id' => 'E6F4F45444F03C1AE050640AF10836B4',
                    'cepat_kode' => 3281,
                    'nama' => 'TEKNIS MANAJEMEN DAN ANALISIS INTELIJEN (LANJUTAN WIRA INTELIJEN)'
                ),
                array(
                    'bkn_id' => 'E6F507C01B43085CE050640AF2084EAF',
                    'cepat_kode' => 3256,
                    'nama' => 'TEKNIS MANAJEMEN PENGELOLAAN PERKARA'
                ),
                array(
                    'bkn_id' => 'E67F0157EEE7EB31E050640AF10844ED',
                    'cepat_kode' => 3199,
                    'nama' => 'TEKNIS MINERAL BATUBARA'
                ),
                array(
                    'bkn_id' => 'E6F4F3FAF1B3F10AE050640AF1083664',
                    'cepat_kode' => 3261,
                    'nama' => 'TEKNIS NON LITIGASI (ALTERNATIVE DISPUTE RESOLUTION)'
                ),
                array(
                    'bkn_id' => 'E67F0157EEE8EB31E050640AF10844ED',
                    'cepat_kode' => 3200,
                    'nama' => 'TEKNIS OMNIBUS LAW'
                ),
                array(
                    'bkn_id' => 'E67F0157EEE9EB31E050640AF10844ED',
                    'cepat_kode' => 3201,
                    'nama' => '"TEKNIS OWASP SECURITY "'
                ),
                array(
                    'bkn_id' => 'E67F0157EEEAEB31E050640AF10844ED',
                    'cepat_kode' => 3202,
                    'nama' => 'TEKNIS PASAR MODAL'
                ),
                array(
                    'bkn_id' => 'E6F5077951044EB5E050640AF2084E92',
                    'cepat_kode' => 3239,
                    'nama' => 'TEKNIS PEMERIKSA KEUANGAN, PERLENGKAPAN, DAN PROYEK PEMBANGUNAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EEEBEB31E050640AF10844ED',
                    'cepat_kode' => 3203,
                    'nama' => 'TEKNIS PEMILIHAN UMUM'
                ),
                array(
                    'bkn_id' => 'E67F0157EEECEB31E050640AF10844ED',
                    'cepat_kode' => 3204,
                    'nama' => 'TEKNIS PEMULIHAN ASET'
                ),
                array(
                    'bkn_id' => 'E6F508339486A0F3E050640AF2084F1F',
                    'cepat_kode' => 3282,
                    'nama' => 'TEKNIS PENANGANAN BARANG BUKTI DAN BARANG RAMPASAN'
                ),
                array(
                    'bkn_id' => 'E6F4F470580E6F77E050640AF10836BF',
                    'cepat_kode' => 3287,
                    'nama' => 'TEKNIS PENANGANAN KEPAILITAN'
                ),
                array(
                    'bkn_id' => 'E6F4F3A384DF924AE050640AF10835FD',
                    'cepat_kode' => 3240,
                    'nama' => 'TEKNIS PENANGANAN PERKARA BERBASIS GENDER'
                ),
                array(
                    'bkn_id' => 'E67F0157EEEDEB31E050640AF10844ED',
                    'cepat_kode' => 3205,
                    'nama' => 'TEKNIS PENANGANAN PERKARA CYBER'
                ),
                array(
                    'bkn_id' => 'E6F4F3E1FDCB6186E050640AF1083628',
                    'cepat_kode' => 3255,
                    'nama' => 'TEKNIS PENANGANAN PERKARA PIDANA UMUM'
                ),
                array(
                    'bkn_id' => 'E6F507712F3AA964E050640AF2084E8C',
                    'cepat_kode' => 3237,
                    'nama' => 'TEKNIS PENANGANAN PERKARA TINDAK PIDANA KHUSUS'
                ),
                array(
                    'bkn_id' => 'E6F50768AFC72996E050640AF2084E85',
                    'cepat_kode' => 3235,
                    'nama' => 'TEKNIS PENANGANAN PERKARA TINDAK PIDANA PEMILIHAN UMUM'
                ),
                array(
                    'bkn_id' => 'E6F4F3EA25864F42E050640AF108362A',
                    'cepat_kode' => 3257,
                    'nama' => 'TEKNIS PENANGANAN PERKARA TRANS NATIONAL CRIME'
                ),
                array(
                    'bkn_id' => 'E6F4F3D98D76913CE050640AF1083626',
                    'cepat_kode' => 3253,
                    'nama' => 'TEKNIS PENANGANAN PERKARA WILD LIFE CRIME'
                ),
                array(
                    'bkn_id' => 'E6F4F43626B685C2E050640AF10836A4',
                    'cepat_kode' => 3274,
                    'nama' => 'TEKNIS PENANGANAN TINDAK PIDANA HAM BERAT'
                ),
                array(
                    'bkn_id' => 'E6F4F3CD456BEBEFE050640AF1083620',
                    'cepat_kode' => 3250,
                    'nama' => 'TEKNIS PENANGANAN TINDAK PIDANA KORUPSI DAN MONEY LAUNDRY'
                ),
                array(
                    'bkn_id' => 'E6F507EF04E828ADE050640AF2084ECB',
                    'cepat_kode' => 3267,
                    'nama' => 'TEKNIS PENANGANAN TINDAK PIDANA KORUPSI DAN TPPU'
                ),
                array(
                    'bkn_id' => 'E6F5083783CB5784E050640AF2084F21',
                    'cepat_kode' => 3283,
                    'nama' => 'TEKNIS PENANGANAN TINDAK PIDANA NARKOTIKA DAN ZAT ADIKTIF LAINNYA'
                ),
                array(
                    'bkn_id' => 'E6F5081C72EE800FE050640AF2084F12',
                    'cepat_kode' => 3277,
                    'nama' => 'TEKNIS PENANGANAN TINDAK PIDANA PERBANKAN'
                ),
                array(
                    'bkn_id' => 'E6F4F3C8E2C50970E050640AF1083619',
                    'cepat_kode' => 3249,
                    'nama' => 'TEKNIS PENANGANAN TINDAK PIDANA PERIKANAN'
                ),
                array(
                    'bkn_id' => 'E6F4F43A72264E25E050640AF10836A8',
                    'cepat_kode' => 3275,
                    'nama' => 'TEKNIS PENANGANAN TINDAK PIDANA TERORISME DAN PENCEGAHAN RADIKALISME'
                ),
                array(
                    'bkn_id' => 'E6F4F3D5BB4D61C1E050640AF1083624',
                    'cepat_kode' => 3252,
                    'nama' => 'TEKNIS PENELUSURAN ASET (ASSET TRACING)'
                ),
                array(
                    'bkn_id' => 'E67F0157EEEEEB31E050640AF10844ED',
                    'cepat_kode' => 3206,
                    'nama' => 'TEKNIS PENGAMANAN INTELIJEN'
                ),
                array(
                    'bkn_id' => 'E67F0157EEEFEB31E050640AF10844ED',
                    'cepat_kode' => 3207,
                    'nama' => '"TEKNIS PENGAWAL, PENGAMANAN PEMERINTAHAN DAN PEMBANGUNAN (TP4) "'
                ),
                array(
                    'bkn_id' => 'E6F4F3ABB9B8E216E050640AF1083607',
                    'cepat_kode' => 3242,
                    'nama' => 'TEKNIS PENGELOLAAN ASET BARANG MILIK NEGARA (BMN)'
                ),
                array(
                    'bkn_id' => 'E67F0157EEF0EB31E050640AF10844ED',
                    'cepat_kode' => 3208,
                    'nama' => 'TEKNIS PENGELOLAAN BARANG BUKTI ELEKTRONIK'
                ),
                array(
                    'bkn_id' => 'E67F0157EEF1EB31E050640AF10844ED',
                    'cepat_kode' => 3209,
                    'nama' => 'TEKNIS PENGELOLAAN BENDA SITAAN DAN RAMPASAN'
                ),
                array(
                    'bkn_id' => 'E6F4F3A7D4EA41CCE050640AF1083601',
                    'cepat_kode' => 3241,
                    'nama' => 'TEKNIS PENGELOLAAN KEPEGAWAIAN'
                ),
                array(
                    'bkn_id' => 'E6F508206F6885BDE050640AF2084F16',
                    'cepat_kode' => 3278,
                    'nama' => 'TEKNIS PENGELOLAAN KEUANGAN BAGI KUASA PENGGUNA ANGGARAN'
                ),
                array(
                    'bkn_id' => 'E6F4F40B9C2B5990E050640AF108366B',
                    'cepat_kode' => 3265,
                    'nama' => 'TEKNIS PENGEMUDI MOBIL PELACAKAN DPO'
                ),
                array(
                    'bkn_id' => 'E6F5079A2B00941EE050640AF2084E9A',
                    'cepat_kode' => 3247,
                    'nama' => 'TEKNIS PENYELIDIKAN DASAR INTELIJEN'
                ),
                array(
                    'bkn_id' => 'E6F4F3BC095991BFE050640AF1083611',
                    'cepat_kode' => 3246,
                    'nama' => 'TEKNIS PENYELIDIKAN WIRA INTELIJEN'
                ),
                array(
                    'bkn_id' => 'E6F507D8E4E4449EE050640AF2084EBF',
                    'cepat_kode' => 3262,
                    'nama' => 'TEKNIS PENYUSUNAN CONTRACT DRAFTING'
                ),
                array(
                    'bkn_id' => 'E6F4E4B2FDF06279E050640AF108329D',
                    'cepat_kode' => 3229,
                    'nama' => 'TEKNIS PERBANKAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EEF2EB31E050640AF10844ED',
                    'cepat_kode' => 3210,
                    'nama' => 'TEKNIS PERDATA DAN TATA USAHA NEGARA'
                ),
                array(
                    'bkn_id' => 'E67F0157EEF3EB31E050640AF10844ED',
                    'cepat_kode' => 3211,
                    'nama' => 'TEKNIS PERSELISIHAN HASIL PEMILIHAN UMUM'
                ),
                array(
                    'bkn_id' => 'E67F0157EEF4EB31E050640AF10844ED',
                    'cepat_kode' => 3212,
                    'nama' => 'TEKNIS PERTAMBANGAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201D2F6A0E040640A040252AD',
                    'cepat_kode' => 2839,
                    'nama' => 'TEKNIS PETERNAKAN SAPI'
                ),
                array(
                    'bkn_id' => 'E67F0157EEF5EB31E050640AF10844ED',
                    'cepat_kode' => 3213,
                    'nama' => 'TEKNIS PNBP'
                ),
                array(
                    'bkn_id' => 'E6F4F4632C1F5B18E050640AF10836B8',
                    'cepat_kode' => 3284,
                    'nama' => 'TEKNIS PROTOKOL/AJUDAN'
                ),
                array(
                    'bkn_id' => 'E6F4F44FB541494FE050640AF10836B0',
                    'cepat_kode' => 3280,
                    'nama' => 'TEKNIS PUBLIC RELATIONS'
                ),
                array(
                    'bkn_id' => 'E67F0157EEF6EB31E050640AF10844ED',
                    'cepat_kode' => 3214,
                    'nama' => 'TEKNIS PUBLIC SPEAKING'
                ),
                array(
                    'bkn_id' => 'E6F4F410CAFD6E17E050640AF108366F',
                    'cepat_kode' => 3266,
                    'nama' => 'TEKNIS RESTORATIVE JUSTICE'
                ),
                array(
                    'bkn_id' => 'E6F507E0E65B04B0E050640AF2084EC7',
                    'cepat_kode' => 3264,
                    'nama' => 'TEKNIS SANDIMAN LANJUTAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EEF7EB31E050640AF10844ED',
                    'cepat_kode' => 3215,
                    'nama' => 'TEKNIS SERTIFIKASI KEAHLIAN LEAD IMPLEMENTER ISO'
                ),
                array(
                    'bkn_id' => 'E67F0157EEF8EB31E050640AF10844ED',
                    'cepat_kode' => 3216,
                    'nama' => 'TEKNIS SIBER DASAR'
                ),
                array(
                    'bkn_id' => 'E67F0157EEF9EB31E050640AF10844ED',
                    'cepat_kode' => 3217,
                    'nama' => 'TEKNIS SIBER LANJUTAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EEFAEB31E050640AF10844ED',
                    'cepat_kode' => 3218,
                    'nama' => 'TEKNIS SIBER TERPADU'
                ),
                array(
                    'bkn_id' => 'E6F5078D8A3577FBE050640AF2084E96',
                    'cepat_kode' => 3244,
                    'nama' => 'TEKNIS SISTEM AKUNTANSI INSTANSI (SAI)'
                ),
                array(
                    'bkn_id' => 'E6F4F4280259BBEBE050640AF1083691',
                    'cepat_kode' => 3271,
                    'nama' => 'TEKNIS TERPADU AKSES TERHADAP DISABILITAS'
                ),
                array(
                    'bkn_id' => 'E67F0157EEFBEB31E050640AF10844ED',
                    'cepat_kode' => 3219,
                    'nama' => 'TEKNIS TERPADU ANTAR NEGARA DALAM PENANGANAN TINDAK PIDANA NARKOTIKA LINTAS NEGARA'
                ),
                array(
                    'bkn_id' => 'E67F0157EEFCEB31E050640AF10844ED',
                    'cepat_kode' => 3220,
                    'nama' => '"TEKNIS TERPADU ANTAR NEGARA TENTANG CRYPTO CURRENCY "'
                ),
                array(
                    'bkn_id' => 'E6F51E91931A5C00E050640AF2084FBA',
                    'cepat_kode' => 3232,
                    'nama' => 'TEKNIS TERPADU APARAT PENEGAK HUK. UTK PENANGANAN PERKARA YG MNDUKUNG SIST. PERADILAN PIDANA TERPADU'
                ),
                array(
                    'bkn_id' => 'E67F0157EEFDEB31E050640AF10844ED',
                    'cepat_kode' => 3221,
                    'nama' => 'TEKNIS TERPADU ILLEGAL FISHING'
                ),
                array(
                    'bkn_id' => 'E67F0157EEFEEB31E050640AF10844ED',
                    'cepat_kode' => 3222,
                    'nama' => 'TEKNIS TERPADU KEBAKARAN HUTAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EEFFEB31E050640AF10844ED',
                    'cepat_kode' => 3223,
                    'nama' => 'TEKNIS TERPADU MINERAL DAN BATUBARA'
                ),
                array(
                    'bkn_id' => 'E6F4F423279F0058E050640AF1083686',
                    'cepat_kode' => 3270,
                    'nama' => 'TEKNIS TERPADU PEMULIHAN ASET'
                ),
                array(
                    'bkn_id' => 'E6F4F43147D16646E050640AF10836A0',
                    'cepat_kode' => 3273,
                    'nama' => 'TEKNIS TERPADU PENANGANAN PERKARA KONEKSITAS'
                ),
                array(
                    'bkn_id' => 'E6F4F42C8D762CD9E050640AF1083698',
                    'cepat_kode' => 3272,
                    'nama' => 'TEKNIS TERPADU SENSITIFITAS GENDER'
                ),
                array(
                    'bkn_id' => 'E67F0157EF00EB31E050640AF10844ED',
                    'cepat_kode' => 3224,
                    'nama' => 'TEKNIS TERPADU SISTEM PERADILAN PIDANA ANAK'
                ),
                array(
                    'bkn_id' => 'E6F4F3933DEC96C4E050640AF10835F7',
                    'cepat_kode' => 3236,
                    'nama' => 'TEKNIS TERPADU TINDAK PIDANA ANAK BERHADAPAN DENGAN HUKUM (ABH)'
                ),
                array(
                    'bkn_id' => 'E6F4F467528460D5E050640AF10836BD',
                    'cepat_kode' => 3285,
                    'nama' => 'TEKNIS TERPADU TINDAK PIDANA DALAM UU CIPTA KERJA'
                ),
                array(
                    'bkn_id' => 'E6F4F0E8805BF12BE050640AF1083592',
                    'cepat_kode' => 3231,
                    'nama' => 'TEKNIS TERPADU TINDAK PIDANA KORUPSI'
                ),
                array(
                    'bkn_id' => 'E6F4F41EE983427AE050640AF108367D',
                    'cepat_kode' => 3269,
                    'nama' => 'TEKNIS TERPADU TINDAK PIDANA PEMILIHAN UMUM'
                ),
                array(
                    'bkn_id' => 'E6F507B7BAA5E956E050640AF2084EA9',
                    'cepat_kode' => 3254,
                    'nama' => 'TEKNIS TINDAK PIDANA PENCUCIAN UANG'
                ),
                array(
                    'bkn_id' => 'E6F507C844BC2106E050640AF2084EB5',
                    'cepat_kode' => 3258,
                    'nama' => 'TEKNIS TINDAK PIDANA PERBANKAN'
                ),
                array(
                    'bkn_id' => 'E67F0157EF01EB31E050640AF10844ED',
                    'cepat_kode' => 3225,
                    'nama' => 'TEKNIS TINDAK PIDANA TERORISME'
                ),
                array(
                    'bkn_id' => 'E6F507AB7424ED46E050640AF2084EA3',
                    'cepat_kode' => 3251,
                    'nama' => 'TEKNIS TRIAL ADVOKASI BAGI JAKSA'
                ),
                array(
                    'bkn_id' => 'E67F0157EF02EB31E050640AF10844ED',
                    'cepat_kode' => 3226,
                    'nama' => '"TEKNIS WIRA INTELIJEN "'
                ),
                array(
                    'bkn_id' => 'A5EB03E201D3F6A0E040640A040252AD',
                    'cepat_kode' => 2840,
                    'nama' => 'TEMBAKAU VIRGINIA'
                ),
                array(
                    'bkn_id' => 'A5EB03E201D4F6A0E040640A040252AD',
                    'cepat_kode' => 2841,
                    'nama' => 'TEMU PEMUDA'
                ),
                array(
                    'bkn_id' => 'A5EB03E201D5F6A0E040640A040252AD',
                    'cepat_kode' => 2842,
                    'nama' => 'TENAGA MEKANIK'
                ),
                array(
                    'bkn_id' => 'A5EB03E201D6F6A0E040640A040252AD',
                    'cepat_kode' => 2843,
                    'nama' => 'TENAGA PERENCANAAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201D7F6A0E040640A040252AD',
                    'cepat_kode' => 2844,
                    'nama' => 'TENAGA STATISTIK PET.TK DASAR'
                ),
                array(
                    'bkn_id' => 'A5EB03E201D8F6A0E040640A040252AD',
                    'cepat_kode' => 2845,
                    'nama' => 'TERNAK UNGGAS'
                ),
                array(
                    'bkn_id' => 'A5EB03E201D9F6A0E040640A040252AD',
                    'cepat_kode' => 2846,
                    'nama' => 'THE PLANNING&APRAISAL OF ARG INDUST.PROJ'
                ),
                array(
                    'bkn_id' => 'A5EB03E201DAF6A0E040640A040252AD',
                    'cepat_kode' => 2847,
                    'nama' => 'TMPP (TEKN MGT PERENC PEMBD)'
                ),
                array(
                    'bkn_id' => 'A5EB03E201DBF6A0E040640A040252AD',
                    'cepat_kode' => 2848,
                    'nama' => 'TOUR LEADER'
                ),
                array(
                    'bkn_id' => 'A5EB03E201DDF6A0E040640A040252AD',
                    'cepat_kode' => 2850,
                    'nama' => 'TRAIN COUR.PRINCIPL.OF COASTAL RECOURCES'
                ),
                array(
                    'bkn_id' => 'A5EB03E201E1F6A0E040640A040252AD',
                    'cepat_kode' => 2854,
                    'nama' => 'TRAINING ALIH TEHNOLOGI MAPATDA'
                ),
                array(
                    'bkn_id' => 'A5EB03E201DCF6A0E040640A040252AD',
                    'cepat_kode' => 2849,
                    'nama' => 'TRAINING COURSE IN THE FIELD SEWAGE WORK'
                ),
                array(
                    'bkn_id' => 'A5EB03E201E5F6A0E040640A040252AD',
                    'cepat_kode' => 2858,
                    'nama' => 'TRAINING GAS KHUSUS PEMBINAAN KEINDAHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201DEF6A0E040640A040252AD',
                    'cepat_kode' => 2851,
                    'nama' => 'TRAINING INSTRUKTUR BIDANG PERSAMPAHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201E2F6A0E040640A040252AD',
                    'cepat_kode' => 2855,
                    'nama' => 'TRAINING KELAPA'
                ),
                array(
                    'bkn_id' => 'A5EB03E201E3F6A0E040640A040252AD',
                    'cepat_kode' => 2856,
                    'nama' => 'TRAINING KOMPUTERISASI DAN IMPLEMENTASI'
                ),
                array(
                    'bkn_id' => 'A5EB03E201E4F6A0E040640A040252AD',
                    'cepat_kode' => 2857,
                    'nama' => 'TRAINING MAPATDA'
                ),
                array(
                    'bkn_id' => 'E67F0157EF03EB31E050640AF10844ED',
                    'cepat_kode' => 3227,
                    'nama' => 'TRAINING OF FACILITATOR'
                ),
                array(
                    'bkn_id' => 'E67F0157EF04EB31E050640AF10844ED',
                    'cepat_kode' => 3228,
                    'nama' => 'TRAINING OFFICIAL COURSE'
                ),
                array(
                    'bkn_id' => 'A5EB03E201E0F6A0E040640A040252AD',
                    'cepat_kode' => 2853,
                    'nama' => 'TRAINING WORKSHOP MANAGEMEN OPR'
                ),
                array(
                    'bkn_id' => 'A5EB03E201DFF6A0E040640A040252AD',
                    'cepat_kode' => 2852,
                    'nama' => 'TRAIN.PROG.IN PLAN POLICY ANALYSIS& DEV.'
                ),
                array(
                    'bkn_id' => 'A5EB03E201E6F6A0E040640A040252AD',
                    'cepat_kode' => 2859,
                    'nama' => 'TRANSMIGRAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201E7F6A0E040640A040252AD',
                    'cepat_kode' => 2860,
                    'nama' => 'TRANSPORTION PROJECT COURSE'
                ),
                array(
                    'bkn_id' => 'A5EB03E201E8F6A0E040640A040252AD',
                    'cepat_kode' => 2861,
                    'nama' => 'TRAPICAL ANIMAL PRODUCTION'
                ),
                array(
                    'bkn_id' => 'A5EB03E201E9F6A0E040640A040252AD',
                    'cepat_kode' => 2862,
                    'nama' => 'TROWE AND LONG LINE'
                ),
                array(
                    'bkn_id' => 'A5EB03E201EAF6A0E040640A040252AD',
                    'cepat_kode' => 2863,
                    'nama' => 'UDKP/P3KT'
                ),
                array(
                    'bkn_id' => 'A5EB03E201EBF6A0E040640A040252AD',
                    'cepat_kode' => 2864,
                    'nama' => 'UKS'
                ),
                array(
                    'bkn_id' => 'A5EB03E201EDF6A0E040640A040252AD',
                    'cepat_kode' => 2866,
                    'nama' => 'UPGRADING BEND'
                ),
                array(
                    'bkn_id' => 'A5EB03E201F0F6A0E040640A040252AD',
                    'cepat_kode' => 2869,
                    'nama' => 'UPGRADING KEPERTOKOLAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201EEF6A0E040640A040252AD',
                    'cepat_kode' => 2867,
                    'nama' => 'UPGRADING PERHITUNGAN ANGGARAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201EFF6A0E040640A040252AD',
                    'cepat_kode' => 2868,
                    'nama' => 'UPGRADING TENAGA PERENCANA'
                ),
                array(
                    'bkn_id' => 'A5EB03E201F1F6A0E040640A040252AD',
                    'cepat_kode' => 2870,
                    'nama' => 'VAKSINATOR'
                ),
                array(
                    'bkn_id' => 'A5EB03E201F2F6A0E040640A040252AD',
                    'cepat_kode' => 2871,
                    'nama' => 'VISIT.ASS.ON ANIMAL HEALTH&EPIDEMINOLOGI'
                ),
                array(
                    'bkn_id' => 'A5EB03E20498F6A0E040640A040252AD',
                    'cepat_kode' => 2591,
                    'nama' => 'WAS BID. AIR LIMBAH & PENGAWAS SAMPAH'
                ),
                array(
                    'bkn_id' => 'A5EB03E20267F6A0E040640A040252AD',
                    'cepat_kode' => 2112,
                    'nama' => 'WERENG COKLAT'
                ),
                array(
                    'bkn_id' => 'A5EB03E201F3F6A0E040640A040252AD',
                    'cepat_kode' => 2872,
                    'nama' => 'WIPAK'
                ),
                array(
                    'bkn_id' => 'A5EB03E201F5F6A0E040640A040252AD',
                    'cepat_kode' => 2874,
                    'nama' => 'WORKSHOP DAN PENYULUHAN'
                ),
                array(
                    'bkn_id' => 'A5EB03E201F4F6A0E040640A040252AD',
                    'cepat_kode' => 2873,
                    'nama' => 'WORKSHOP TATA RUANG KOTA'
                )
            );
        foreach ($jenis_kursus as $data) {
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            DB::table('jenis_kursus')->insert($data);
        }
    }
}
