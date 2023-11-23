<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profesi = array(
            array(
                "bkn_id" => "A5EB03E206F3F6A0E040640A040252AD",
                "nama" => "A-I ( AKTA SATU )"),
            array(
                "bkn_id" => "A5EB03E20714F6A0E040640A040252AD",
                "nama" => "A-I ADM. KETERAMPILAN"),
            array(
                "bkn_id" => "A5EB03E20715F6A0E040640A040252AD",
                "nama" => "A-I ADM. KEU."),
            array(
                "bkn_id" => "A5EB03E20716F6A0E040640A040252AD",
                "nama" => "A-I ADM. PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20718F6A0E040640A040252AD",
                "nama" => "A-I ADM. PERKANTORAN"),
            array(
                "bkn_id" => "A5EB03E2071AF6A0E040640A040252AD",
                "nama" => "A-I ADM. PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E20717F6A0E040640A040252AD",
                "nama" => "A-I ADM. SUPERVISI PEND."),
            array(
                "bkn_id" => "A5EB03E20719F6A0E040640A040252AD",
                "nama" => "A-I ADM. TATA PERKANTORAN"),
            array(
                "bkn_id" => "A5EB03E2071DF6A0E040640A040252AD",
                "nama" => "A-I ADM.ILMU ADM. NEGARA"),
            array(
                "bkn_id" => "A5EB03E20712F6A0E040640A040252AD",
                "nama" => "A-I ADMINISTRASI"),
            array(
                "bkn_id" => "A5EB03E20713F6A0E040640A040252AD",
                "nama" => "A-I ADMINISTRASI EKONOMI"),
            array(
                "bkn_id" => "A5EB03E2071BF6A0E040640A040252AD",
                "nama" => "A-I ADMINISTRASI SEKOLAH"),
            array(
                "bkn_id" => "A5EB03E2071CF6A0E040640A040252AD",
                "nama" => "A-I ADMINISTRASI SOSIAL"),
            array(
                "bkn_id" => "A5EB03E207D4F6A0E040640A040252AD",
                "nama" => "A-I ARSITEKTUR"),
            array(
                "bkn_id" => "A5EB03E207C1F6A0E040640A040252AD",
                "nama" => "A-I BAHASA"),
            array(
                "bkn_id" => "A5EB03E206F7F6A0E040640A040252AD",
                "nama" => "A-I BAHASA DAERAH"),
            array(
                "bkn_id" => "A5EB03E206FBF6A0E040640A040252AD",
                "nama" => "A-I BAHASA & SASTRA ARAB"),
            array(
                "bkn_id" => "A5EB03E206F4F6A0E040640A040252AD",
                "nama" => "A-I BAHASA & SASTRA BALI"),
            array(
                "bkn_id" => "A5EB03E206FDF6A0E040640A040252AD",
                "nama" => "A-I BAHASA & SASTRA CINA"),
            array(
                "bkn_id" => "A5EB03E207C3F6A0E040640A040252AD",
                "nama" => "A-I BAHASA & SASTRA JAWA"),
            array(
                "bkn_id" => "A5EB03E20706F6A0E040640A040252AD",
                "nama" => "A-I BAHASA ARAB"),
            array(
                "bkn_id" => "A5EB03E20709F6A0E040640A040252AD",
                "nama" => "A-I BAHASA ASING"),
            array(
                "bkn_id" => "A5EB03E20707F6A0E040640A040252AD",
                "nama" => "A-I BAHASA BALI"),
            array(
                "bkn_id" => "A5EB03E20708F6A0E040640A040252AD",
                "nama" => "A-I BAHASA BATAK"),
            array(
                "bkn_id" => "A5EB03E2070AF6A0E040640A040252AD",
                "nama" => "A-I BAHASA BELANDA"),
            array(
                "bkn_id" => "A5EB03E2070BF6A0E040640A040252AD",
                "nama" => "A-I BAHASA CINA/CINOLOGI"),
            array(
                "bkn_id" => "A5EB03E206FAF6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. ASING"),
            array(
                "bkn_id" => "A5EB03E207C5F6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. BATAK"),
            array(
                "bkn_id" => "A5EB03E206FCF6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. BELANDA"),
            array(
                "bkn_id" => "A5EB03E206F6F6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. DAERAH"),
            array(
                "bkn_id" => "A5EB03E206FEF6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. INDIA"),
            array(
                "bkn_id" => "A5EB03E207C2F6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. INDONESIA"),
            array(
                "bkn_id" => "A5EB03E206FFF6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. INGGRIS"),
            array(
                "bkn_id" => "A5EB03E20700F6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. JEPANG"),
            array(
                "bkn_id" => "A5EB03E20701F6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. JERMAN"),
            array(
                "bkn_id" => "A5EB03E20702F6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. KOREA"),
            array(
                "bkn_id" => "A5EB03E206F5F6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. MINANGKABAU"),
            array(
                "bkn_id" => "A5EB03E20703F6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. PERANCIS"),
            array(
                "bkn_id" => "A5EB03E20704F6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. RUSIA"),
            array(
                "bkn_id" => "A5EB03E20705F6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. SLAVIA"),
            array(
                "bkn_id" => "A5EB03E207C4F6A0E040640A040252AD",
                "nama" => "A-I BHS & SAS. SUNDA"),
            array(
                "bkn_id" => "A5EB03E206F8F6A0E040640A040252AD",
                "nama" => "A-I BHS SEJARAH & BUDAYA"),
            array(
                "bkn_id" => "A5EB03E206F9F6A0E040640A040252AD",
                "nama" => "A-I BHS SEJARAH BHS BALI"),
            array(
                "bkn_id" => "A5EB03E20730F6A0E040640A040252AD",
                "nama" => "A-I BIMBINGAN & PENYULUHAN"),
            array(
                "bkn_id" => "A5EB03E20731F6A0E040640A040252AD",
                "nama" => "A-I BP ADM. PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20732F6A0E040640A040252AD",
                "nama" => "A-I BP ADM.SUPERVISI PEND."),
            array(
                "bkn_id" => "A5EB03E20733F6A0E040640A040252AD",
                "nama" => "A-I BP BIMB. & KONSELING"),
            array(
                "bkn_id" => "A5EB03E20734F6A0E040640A040252AD",
                "nama" => "A-I BP BIMB. & PENYULUH"),
            array(
                "bkn_id" => "A5EB03E20735F6A0E040640A040252AD",
                "nama" => "A-I BP DIDAKTIK"),
            array(
                "bkn_id" => "A5EB03E20736F6A0E040640A040252AD",
                "nama" => "A-I BP DIDAKTIK& KURIKULUM"),
            array(
                "bkn_id" => "A5EB03E20740F6A0E040640A040252AD",
                "nama" => "A-I BP KEOLAHRAGAAN"),
            array(
                "bkn_id" => "A5EB03E2073AF6A0E040640A040252AD",
                "nama" => "A-I BP KURIKL PERSEK/PENG."),
            array(
                "bkn_id" => "A5EB03E2073DF6A0E040640A040252AD",
                "nama" => "A-I BP KURIKL. PENYULUHAN"),
            array(
                "bkn_id" => "A5EB03E2073BF6A0E040640A040252AD",
                "nama" => "A-I BP KURIKL.& TEK.PEND."),
            array(
                "bkn_id" => "A5EB03E2073CF6A0E040640A040252AD",
                "nama" => "A-I BP KURIKULUM PEND."),
            array(
                "bkn_id" => "A5EB03E2073EF6A0E040640A040252AD",
                "nama" => "A-I BP KURTEK PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2073FF6A0E040640A040252AD",
                "nama" => "A-I BP PENGAJ.&PENGEMB.KUR"),
            array(
                "bkn_id" => "A5EB03E20737F6A0E040640A040252AD",
                "nama" => "A-I BP PONDASI PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20739F6A0E040640A040252AD",
                "nama" => "A-I BP PSIK. PEND.& BIMB."),
            array(
                "bkn_id" => "A5EB03E20738F6A0E040640A040252AD",
                "nama" => "A-I BP PSIKOLOGI PEND."),
            array(
                "bkn_id" => "A5EB03E2072BF6A0E040640A040252AD",
                "nama" => "A-I EK. PENDD.DUNIA USA"),
            array(
                "bkn_id" => "A5EB03E2072DF6A0E040640A040252AD",
                "nama" => "A-I EK. STUDI PEMBANGUN"),
            array(
                "bkn_id" => "A5EB03E2072FF6A0E040640A040252AD",
                "nama" => "A-I EK. TATA PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E2071EF6A0E040640A040252AD",
                "nama" => "A-I EKONOMI"),
            array(
                "bkn_id" => "A5EB03E20723F6A0E040640A040252AD",
                "nama" => "A-I EKONOMI"),
            array(
                "bkn_id" => "A5EB03E2071FF6A0E040640A040252AD",
                "nama" => "A-I EKONOMI AKUNTANSI"),
            array(
                "bkn_id" => "A5EB03E20720F6A0E040640A040252AD",
                "nama" => "A-I EKONOMI BISNIS"),
            array(
                "bkn_id" => "A5EB03E20721F6A0E040640A040252AD",
                "nama" => "A-I EKONOMI BISNIS TATA"),
            array(
                "bkn_id" => "A5EB03E20722F6A0E040640A040252AD",
                "nama" => "A-I EKONOMI BISNIS VOKAS"),
            array(
                "bkn_id" => "A5EB03E20728F6A0E040640A040252AD",
                "nama" => "A-I EKONOMI ILMU EKONOMI"),
            array(
                "bkn_id" => "A5EB03E20729F6A0E040640A040252AD",
                "nama" => "A-I EKONOMI KEUANGAN"),
            array(
                "bkn_id" => "A5EB03E20724F6A0E040640A040252AD",
                "nama" => "A-I EKONOMI KOPERASI"),
            array(
                "bkn_id" => "A5EB03E20725F6A0E040640A040252AD",
                "nama" => "A-I EKONOMI MANAJEMEN"),
            array(
                "bkn_id" => "A5EB03E2072AF6A0E040640A040252AD",
                "nama" => "A-I EKONOMI MANAJEMEN"),
            array(
                "bkn_id" => "A5EB03E20726F6A0E040640A040252AD",
                "nama" => "A-I EKONOMI PEMBANGUNAN"),
            array(
                "bkn_id" => "A5EB03E2072CF6A0E040640A040252AD",
                "nama" => "A-I EKONOMI PENDD.MANAJ."),
            array(
                "bkn_id" => "A5EB03E20727F6A0E040640A040252AD",
                "nama" => "A-I EKONOMI PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E2072EF6A0E040640A040252AD",
                "nama" => "A-I EKONOMI TATA NIAGA"),
            array(
                "bkn_id" => "A5EB03E207B9F6A0E040640A040252AD",
                "nama" => "A-I EKSAK IL PASTI & ALAM"),
            array(
                "bkn_id" => "A5EB03E207BAF6A0E040640A040252AD",
                "nama" => "A-I EKSAK.ILMU PENGET.ALAM"),
            array(
                "bkn_id" => "A5EB03E207B5F6A0E040640A040252AD",
                "nama" => "A-I EKSAKTA"),
            array(
                "bkn_id" => "A5EB03E207B6F6A0E040640A040252AD",
                "nama" => "A-I EKSAKTA BIOLOGI"),
            array(
                "bkn_id" => "A5EB03E207B7F6A0E040640A040252AD",
                "nama" => "A-I EKSAKTA FISIKA"),
            array(
                "bkn_id" => "A5EB03E207BBF6A0E040640A040252AD",
                "nama" => "A-I EKSAKTA GEOLOGI"),
            array(
                "bkn_id" => "A5EB03E207B8F6A0E040640A040252AD",
                "nama" => "A-I EKSAKTA ILMU ALAM"),
            array(
                "bkn_id" => "A5EB03E207BCF6A0E040640A040252AD",
                "nama" => "A-I EKSAKTA ILMU KIMIA"),
            array(
                "bkn_id" => "A5EB03E207BEF6A0E040640A040252AD",
                "nama" => "A-I EKSAKTA ILMU PASTI"),
            array(
                "bkn_id" => "A5EB03E207BDF6A0E040640A040252AD",
                "nama" => "A-I EKSAKTA KIMIA"),
            array(
                "bkn_id" => "A5EB03E207BFF6A0E040640A040252AD",
                "nama" => "A-I EKSAKTA MATEMATIKA"),
            array(
                "bkn_id" => "A5EB03E207C0F6A0E040640A040252AD",
                "nama" => "A-I EKSAKTA STATISTIK"),
            array(
                "bkn_id" => "A5EB03E207D6F6A0E040640A040252AD",
                "nama" => "A-I ELEKTRONIKA"),
            array(
                "bkn_id" => "A5EB03E20741F6A0E040640A040252AD",
                "nama" => "A-I FILSAFAT"),
            array(
                "bkn_id" => "A5EB03E20744F6A0E040640A040252AD",
                "nama" => "A-I FILSAFAT & SOSIOLOGI"),
            array(
                "bkn_id" => "A5EB03E20743F6A0E040640A040252AD",
                "nama" => "A-I FILSAFAT BARAT"),
            array(
                "bkn_id" => "A5EB03E20742F6A0E040640A040252AD",
                "nama" => "A-I FILSAFAT BHS & SAS.IND"),
            array(
                "bkn_id" => "A5EB03E20745F6A0E040640A040252AD",
                "nama" => "A-I FILSAFAT KEBUDAYAAN"),
            array(
                "bkn_id" => "A5EB03E20746F6A0E040640A040252AD",
                "nama" => "A-I FILSAFAT PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20782F6A0E040640A040252AD",
                "nama" => "A-I IPS"),
            array(
                "bkn_id" => "A5EB03E20784F6A0E040640A040252AD",
                "nama" => "A-I IPS ANTROP. BUDAYA"),
            array(
                "bkn_id" => "A5EB03E20785F6A0E040640A040252AD",
                "nama" => "A-I IPS ANTROP. SOSIAL"),
            array(
                "bkn_id" => "A5EB03E20783F6A0E040640A040252AD",
                "nama" => "A-I IPS ANTROPOLOGI"),
            array(
                "bkn_id" => "A5EB03E2078EF6A0E040640A040252AD",
                "nama" => "A-I IPS CIVICS HUKUM"),
            array(
                "bkn_id" => "A5EB03E2079EF6A0E040640A040252AD",
                "nama" => "A-I IPS DIK. KESEHATAN"),
            array(
                "bkn_id" => "A5EB03E207A2F6A0E040640A040252AD",
                "nama" => "A-I IPS DIK.LUAR SEKOLAH"),
            array(
                "bkn_id" => "A5EB03E2078FF6A0E040640A040252AD",
                "nama" => "A-I IPS HUKUM PMP"),
            array(
                "bkn_id" => "A5EB03E20795F6A0E040640A040252AD",
                "nama" => "A-I IPS ILMU BUMI"),
            array(
                "bkn_id" => "A5EB03E207A9F6A0E040640A040252AD",
                "nama" => "A-I IPS ILMU KESEJAHTERA"),
            array(
                "bkn_id" => "A5EB03E20796F6A0E040640A040252AD",
                "nama" => "A-I IPS ILMU MENDIDIK"),
            array(
                "bkn_id" => "A5EB03E207AAF6A0E040640A040252AD",
                "nama" => "A-I IPS ILMU PEMBANGUNAN"),
            array(
                "bkn_id" => "A5EB03E207ABF6A0E040640A040252AD",
                "nama" => "A-I IPS ILMU PENGETAHUAN"),
            array(
                "bkn_id" => "A5EB03E20798F6A0E040640A040252AD",
                "nama" => "A-I IPS KATAKETIK DIK."),
            array(
                "bkn_id" => "A5EB03E207ACF6A0E040640A040252AD",
                "nama" => "A-I IPS KESEJAH. SOSIAL"),
            array(
                "bkn_id" => "A5EB03E20790F6A0E040640A040252AD",
                "nama" => "A-I IPS KEWARGANEGARAAN"),
            array(
                "bkn_id" => "A5EB03E207B2F6A0E040640A040252AD",
                "nama" => "A-I IPS O R & KESEHATAN"),
            array(
                "bkn_id" => "A5EB03E207B1F6A0E040640A040252AD",
                "nama" => "A-I IPS OLAH RAGA"),
            array(
                "bkn_id" => "A5EB03E207A4F6A0E040640A040252AD",
                "nama" => "A-I IPS P.MORAL PANCASILA"),
            array(
                "bkn_id" => "A5EB03E20797F6A0E040640A040252AD",
                "nama" => "A-I IPS PAEDAGOGIK"),
            array(
                "bkn_id" => "A5EB03E207ADF6A0E040640A040252AD",
                "nama" => "A-I IPS PEMB.MASY.DESA"),
            array(
                "bkn_id" => "A5EB03E207A1F6A0E040640A040252AD",
                "nama" => "A-I IPS PEND. LUAR BIASA"),
            array(
                "bkn_id" => "A5EB03E2079AF6A0E040640A040252AD",
                "nama" => "A-I IPS PEND.&PENGEMBANGAN"),
            array(
                "bkn_id" => "A5EB03E2079BF6A0E040640A040252AD",
                "nama" => "A-I IPS PEND.&PENGEMBANGAN"),
            array(
                "bkn_id" => "A5EB03E2079DF6A0E040640A040252AD",
                "nama" => "A-I IPS PEND.KEMASY."),
            array(
                "bkn_id" => "A5EB03E2079FF6A0E040640A040252AD",
                "nama" => "A-I IPS PEND.KESEJAHTERAAN"),
            array(
                "bkn_id" => "A5EB03E207A3F6A0E040640A040252AD",
                "nama" => "A-I IPS PEND.MASYARAKAT"),
            array(
                "bkn_id" => "A5EB03E20799F6A0E040640A040252AD",
                "nama" => "A-I IPS PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2079CF6A0E040640A040252AD",
                "nama" => "A-I IPS PENDIDIKAN DASAR"),
            array(
                "bkn_id" => "A5EB03E207A0F6A0E040640A040252AD",
                "nama" => "A-I IPS PENDIDIKAN KHUSUS"),
            array(
                "bkn_id" => "A5EB03E207A5F6A0E040640A040252AD",
                "nama" => "A-I IPS PENDIDIKAN SEK."),
            array(
                "bkn_id" => "A5EB03E207A6F6A0E040640A040252AD",
                "nama" => "A-I IPS PENDIDIKAN SOSIAL"),
            array(
                "bkn_id" => "A5EB03E207A7F6A0E040640A040252AD",
                "nama" => "A-I IPS PENDIDIKAN UMUM"),
            array(
                "bkn_id" => "A5EB03E207AFF6A0E040640A040252AD",
                "nama" => "A-I IPS PERPUSTAKAAN"),
            array(
                "bkn_id" => "A5EB03E207B0F6A0E040640A040252AD",
                "nama" => "A-I IPS PHSIKOLOGI"),
            array(
                "bkn_id" => "A5EB03E20791F6A0E040640A040252AD",
                "nama" => "A-I IPS PKK"),
            array(
                "bkn_id" => "A5EB03E20792F6A0E040640A040252AD",
                "nama" => "A-I IPS PKN DAN HUKUM"),
            array(
                "bkn_id" => "A5EB03E20793F6A0E040640A040252AD",
                "nama" => "A-I IPS PMP DAN KWNEGARAAN"),
            array(
                "bkn_id" => "A5EB03E20794F6A0E040640A040252AD",
                "nama" => "A-I IPS PSPB"),
            array(
                "bkn_id" => "A5EB03E207AEF6A0E040640A040252AD",
                "nama" => "A-I IPS PUBLISISTIK"),
            array(
                "bkn_id" => "A5EB03E20788F6A0E040640A040252AD",
                "nama" => "A-I IPS RAH .& ARKELOGI"),
            array(
                "bkn_id" => "A5EB03E20786F6A0E040640A040252AD",
                "nama" => "A-I IPS SEJARAH"),
            array(
                "bkn_id" => "A5EB03E20787F6A0E040640A040252AD",
                "nama" => "A-I IPS SEJARAH & ANTROP."),
            array(
                "bkn_id" => "A5EB03E20789F6A0E040640A040252AD",
                "nama" => "A-I IPS SEJARAH & BUDAYA"),
            array(
                "bkn_id" => "A5EB03E2078AF6A0E040640A040252AD",
                "nama" => "A-I IPS SEJARAH GEOGRAFI"),
            array(
                "bkn_id" => "A5EB03E2078BF6A0E040640A040252AD",
                "nama" => "A-I IPS SEJARAH INDONESIA"),
            array(
                "bkn_id" => "A5EB03E2078CF6A0E040640A040252AD",
                "nama" => "A-I IPS SEJARAH PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2078DF6A0E040640A040252AD",
                "nama" => "A-I IPS SEJARAH PURBAKAL"),
            array(
                "bkn_id" => "A5EB03E207B3F6A0E040640A040252AD",
                "nama" => "A-I IPS SOSIAL"),
            array(
                "bkn_id" => "A5EB03E207B4F6A0E040640A040252AD",
                "nama" => "A-I IPS SOSIAL EKONOMI"),
            array(
                "bkn_id" => "A5EB03E207A8F6A0E040640A040252AD",
                "nama" => "A-I IPS TEORI & RAH PEND."),
            array(
                "bkn_id" => "A5EB03E207E0F6A0E040640A040252AD",
                "nama" => "A-I KIMIA"),
            array(
                "bkn_id" => "A5EB03E207E2F6A0E040640A040252AD",
                "nama" => "A-I LISTRIK"),
            array(
                "bkn_id" => "A5EB03E207E4F6A0E040640A040252AD",
                "nama" => "A-I MESIN"),
            array(
                "bkn_id" => "A5EB03E2070CF6A0E040640A040252AD",
                "nama" => "A-I SENI"),
            array(
                "bkn_id" => "A5EB03E2070DF6A0E040640A040252AD",
                "nama" => "A-I SENI BAHASA DAN SENI"),
            array(
                "bkn_id" => "A5EB03E2070EF6A0E040640A040252AD",
                "nama" => "A-I SENI MENGGAMBAR"),
            array(
                "bkn_id" => "A5EB03E2070FF6A0E040640A040252AD",
                "nama" => "A-I SENI MUSIK"),
            array(
                "bkn_id" => "A5EB03E20710F6A0E040640A040252AD",
                "nama" => "A-I SENI RUPA"),
            array(
                "bkn_id" => "A5EB03E20711F6A0E040640A040252AD",
                "nama" => "A-I SENI TARI"),
            array(
                "bkn_id" => "A5EB03E207D9F6A0E040640A040252AD",
                "nama" => "A-I TEK.ELEKTRO KOMUNIKASI"),
            array(
                "bkn_id" => "A5EB03E20747F6A0E040640A040252AD",
                "nama" => "A-I TEKNIK"),
            array(
                "bkn_id" => "A5EB03E207E7F6A0E040640A040252AD",
                "nama" => "A-I TEKNIK &MANAJ. INDUS."),
            array(
                "bkn_id" => "A5EB03E207DFF6A0E040640A040252AD",
                "nama" => "A-I TEKNIK ALIRAN SUNGAI"),
            array(
                "bkn_id" => "A5EB03E207D5F6A0E040640A040252AD",
                "nama" => "A-I TEKNIK ARSITEKTUR"),
            array(
                "bkn_id" => "A5EB03E207DDF6A0E040640A040252AD",
                "nama" => "A-I TEKNIK BANGUNAN"),
            array(
                "bkn_id" => "A5EB03E207D7F6A0E040640A040252AD",
                "nama" => "A-I TEKNIK ELEKTRO"),
            array(
                "bkn_id" => "A5EB03E207D8F6A0E040640A040252AD",
                "nama" => "A-I TEKNIK ELEKTRO KOMP."),
            array(
                "bkn_id" => "A5EB03E207DAF6A0E040640A040252AD",
                "nama" => "A-I TEKNIK ELEKTRONIKA"),
            array(
                "bkn_id" => "A5EB03E207DCF6A0E040640A040252AD",
                "nama" => "A-I TEKNIK GEDUNG"),
            array(
                "bkn_id" => "A5EB03E207E8F6A0E040640A040252AD",
                "nama" => "A-I TEKNIK INDUSTRI"),
            array(
                "bkn_id" => "A5EB03E207E1F6A0E040640A040252AD",
                "nama" => "A-I TEKNIK KIMIA"),
            array(
                "bkn_id" => "A5EB03E207DBF6A0E040640A040252AD",
                "nama" => "A-I TEKNIK KOMPUTER"),
            array(
                "bkn_id" => "A5EB03E207E3F6A0E040640A040252AD",
                "nama" => "A-I TEKNIK LISTRIK"),
            array(
                "bkn_id" => "A5EB03E207E5F6A0E040640A040252AD",
                "nama" => "A-I TEKNIK MESIN"),
            array(
                "bkn_id" => "A5EB03E207E6F6A0E040640A040252AD",
                "nama" => "A-I TEKNIK OTOMOTIF"),
            array(
                "bkn_id" => "A5EB03E207DEF6A0E040640A040252AD",
                "nama" => "A-I TEKNIK SIPIL"),
            array(
                "bkn_id" => "A5EB03E207E9F6A0E040640A040252AD",
                "nama" => "A-II"),
            array(
                "bkn_id" => "A5EB03E20561F6A0E040640A040252AD",
                "nama" => "A-II ADM. KETERAMPILAN"),
            array(
                "bkn_id" => "A5EB03E20562F6A0E040640A040252AD",
                "nama" => "A-II ADM. KEU."),
            array(
                "bkn_id" => "A5EB03E20563F6A0E040640A040252AD",
                "nama" => "A-II ADM. PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20565F6A0E040640A040252AD",
                "nama" => "A-II ADM. PERKANTORAN"),
            array(
                "bkn_id" => "A5EB03E20567F6A0E040640A040252AD",
                "nama" => "A-II ADM. PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E20564F6A0E040640A040252AD",
                "nama" => "A-II ADM. SUPERVISI PEND."),
            array(
                "bkn_id" => "A5EB03E20566F6A0E040640A040252AD",
                "nama" => "A-II ADM. TATA PERKANTORAN"),
            array(
                "bkn_id" => "A5EB03E2056AF6A0E040640A040252AD",
                "nama" => "A-II ADM.ILMU ADM. NEGARA"),
            array(
                "bkn_id" => "A5EB03E20890F6A0E040640A040252AD",
                "nama" => "A-II ADMINISTRASI"),
            array(
                "bkn_id" => "A5EB03E20560F6A0E040640A040252AD",
                "nama" => "A-II ADMINISTRASI EKONOMI"),
            array(
                "bkn_id" => "A5EB03E20568F6A0E040640A040252AD",
                "nama" => "A-II ADMINISTRASI SEKOLAH"),
            array(
                "bkn_id" => "A5EB03E20569F6A0E040640A040252AD",
                "nama" => "A-II ADMINISTRASI SOSIAL"),
            array(
                "bkn_id" => "A5EB03E20595F6A0E040640A040252AD",
                "nama" => "A-II ARSITEKTUR"),
            array(
                "bkn_id" => "A5EB03E2086DF6A0E040640A040252AD",
                "nama" => "A-II BAHASA"),
            array(
                "bkn_id" => "A5EB03E20875F6A0E040640A040252AD",
                "nama" => "A-II BAHASA DAERAH"),
            array(
                "bkn_id" => "A5EB03E20879F6A0E040640A040252AD",
                "nama" => "A-II BAHASA & SASTRA ARAB"),
            array(
                "bkn_id" => "A5EB03E20872F6A0E040640A040252AD",
                "nama" => "A-II BAHASA & SASTRA BALI"),
            array(
                "bkn_id" => "A5EB03E2087BF6A0E040640A040252AD",
                "nama" => "A-II BAHASA & SASTRA CINA"),
            array(
                "bkn_id" => "A5EB03E2086FF6A0E040640A040252AD",
                "nama" => "A-II BAHASA & SASTRA JAWA"),
            array(
                "bkn_id" => "A5EB03E20884F6A0E040640A040252AD",
                "nama" => "A-II BAHASA ARAB"),
            array(
                "bkn_id" => "A5EB03E20887F6A0E040640A040252AD",
                "nama" => "A-II BAHASA ASING"),
            array(
                "bkn_id" => "A5EB03E20885F6A0E040640A040252AD",
                "nama" => "A-II BAHASA BALI"),
            array(
                "bkn_id" => "A5EB03E20886F6A0E040640A040252AD",
                "nama" => "A-II BAHASA BATAK"),
            array(
                "bkn_id" => "A5EB03E20888F6A0E040640A040252AD",
                "nama" => "A-II BAHASA BELANDA"),
            array(
                "bkn_id" => "A5EB03E20889F6A0E040640A040252AD",
                "nama" => "A-II BAHASA CINA/CINOLOGI"),
            array(
                "bkn_id" => "A5EB03E20878F6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. ASING"),
            array(
                "bkn_id" => "A5EB03E20871F6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. BATAK"),
            array(
                "bkn_id" => "A5EB03E2087AF6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. BELANDA"),
            array(
                "bkn_id" => "A5EB03E20874F6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. DAERAH"),
            array(
                "bkn_id" => "A5EB03E2087CF6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. INDIA"),
            array(
                "bkn_id" => "A5EB03E2086EF6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. INDONESIA"),
            array(
                "bkn_id" => "A5EB03E2087DF6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. INGGRIS"),
            array(
                "bkn_id" => "A5EB03E2087EF6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. JEPANG"),
            array(
                "bkn_id" => "A5EB03E2087FF6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. JERMAN"),
            array(
                "bkn_id" => "A5EB03E20880F6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. KOREA"),
            array(
                "bkn_id" => "A5EB03E20873F6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. MINANGKABAU"),
            array(
                "bkn_id" => "A5EB03E20881F6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. PERANCIS"),
            array(
                "bkn_id" => "A5EB03E20882F6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. RUSIA"),
            array(
                "bkn_id" => "A5EB03E20883F6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. SLAVIA"),
            array(
                "bkn_id" => "A5EB03E20870F6A0E040640A040252AD",
                "nama" => "A-II BHS & SAS. SUNDA"),
            array(
                "bkn_id" => "A5EB03E20876F6A0E040640A040252AD",
                "nama" => "A-II BHS SEJARAH & BUDAYA"),
            array(
                "bkn_id" => "A5EB03E20877F6A0E040640A040252AD",
                "nama" => "A-II BHS SEJARAH BHS BALI"),
            array(
                "bkn_id" => "A5EB03E2057DF6A0E040640A040252AD",
                "nama" => "A-II BIMBINGAN & PENYULUHAN"),
            array(
                "bkn_id" => "A5EB03E2057EF6A0E040640A040252AD",
                "nama" => "A-II BP ADM. PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2057FF6A0E040640A040252AD",
                "nama" => "A-II BP ADM.SUPERVISI PEND."),
            array(
                "bkn_id" => "A5EB03E20580F6A0E040640A040252AD",
                "nama" => "A-II BP BIMB. & KONSELING"),
            array(
                "bkn_id" => "A5EB03E20581F6A0E040640A040252AD",
                "nama" => "A-II BP BIMB. & PENYULUH"),
            array(
                "bkn_id" => "A5EB03E20582F6A0E040640A040252AD",
                "nama" => "A-II BP DIDAKTIK"),
            array(
                "bkn_id" => "A5EB03E20583F6A0E040640A040252AD",
                "nama" => "A-II BP DIDAKTIK& KURIKULUM"),
            array(
                "bkn_id" => "A5EB03E2058DF6A0E040640A040252AD",
                "nama" => "A-II BP KEOLAHRAGAAN"),
            array(
                "bkn_id" => "A5EB03E20587F6A0E040640A040252AD",
                "nama" => "A-II BP KURIKL PERSEK/PENG."),
            array(
                "bkn_id" => "A5EB03E2058AF6A0E040640A040252AD",
                "nama" => "A-II BP KURIKL. PENYULUHAN"),
            array(
                "bkn_id" => "A5EB03E20588F6A0E040640A040252AD",
                "nama" => "A-II BP KURIKL.& TEK.PEND."),
            array(
                "bkn_id" => "A5EB03E20589F6A0E040640A040252AD",
                "nama" => "A-II BP KURIKULUM PEND."),
            array(
                "bkn_id" => "A5EB03E2058BF6A0E040640A040252AD",
                "nama" => "A-II BP KURTEK PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2058CF6A0E040640A040252AD",
                "nama" => "A-II BP PENGAJ.&PENGEMB.KUR"),
            array(
                "bkn_id" => "A5EB03E20584F6A0E040640A040252AD",
                "nama" => "A-II BP PONDASI PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20586F6A0E040640A040252AD",
                "nama" => "A-II BP PSIK. PEND.& BIMB."),
            array(
                "bkn_id" => "A5EB03E20585F6A0E040640A040252AD",
                "nama" => "A-II BP PSIKOLOGI PEND."),
            array(
                "bkn_id" => "A5EB03E20578F6A0E040640A040252AD",
                "nama" => "A-II EK. PENDD.DUNIA USA"),
            array(
                "bkn_id" => "A5EB03E2057AF6A0E040640A040252AD",
                "nama" => "A-II EK. STUDI PEMBANGUN"),
            array(
                "bkn_id" => "A5EB03E2057CF6A0E040640A040252AD",
                "nama" => "A-II EK. TATA PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E2056BF6A0E040640A040252AD",
                "nama" => "A-II EKONOMI"),
            array(
                "bkn_id" => "A5EB03E20570F6A0E040640A040252AD",
                "nama" => "A-II EKONOMI"),
            array(
                "bkn_id" => "A5EB03E2056CF6A0E040640A040252AD",
                "nama" => "A-II EKONOMI AKUNTANSI"),
            array(
                "bkn_id" => "A5EB03E2056DF6A0E040640A040252AD",
                "nama" => "A-II EKONOMI BISNIS"),
            array(
                "bkn_id" => "A5EB03E2056EF6A0E040640A040252AD",
                "nama" => "A-II EKONOMI BISNIS TATA"),
            array(
                "bkn_id" => "A5EB03E2056FF6A0E040640A040252AD",
                "nama" => "A-II EKONOMI BISNIS VOKAS"),
            array(
                "bkn_id" => "A5EB03E20575F6A0E040640A040252AD",
                "nama" => "A-II EKONOMI ILMU EKONOMI"),
            array(
                "bkn_id" => "A5EB03E20576F6A0E040640A040252AD",
                "nama" => "A-II EKONOMI KEUANGAN"),
            array(
                "bkn_id" => "A5EB03E20571F6A0E040640A040252AD",
                "nama" => "A-II EKONOMI KOPERASI"),
            array(
                "bkn_id" => "A5EB03E20572F6A0E040640A040252AD",
                "nama" => "A-II EKONOMI MANAJEMEN"),
            array(
                "bkn_id" => "A5EB03E20577F6A0E040640A040252AD",
                "nama" => "A-II EKONOMI MANAJEMEN"),
            array(
                "bkn_id" => "A5EB03E20573F6A0E040640A040252AD",
                "nama" => "A-II EKONOMI PEMBANGUNAN"),
            array(
                "bkn_id" => "A5EB03E20579F6A0E040640A040252AD",
                "nama" => "A-II EKONOMI PENDD.MANAJ."),
            array(
                "bkn_id" => "A5EB03E20574F6A0E040640A040252AD",
                "nama" => "A-II EKONOMI PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E2057BF6A0E040640A040252AD",
                "nama" => "A-II EKONOMI TATA NIAGA"),
            array(
                "bkn_id" => "A5EB03E20865F6A0E040640A040252AD",
                "nama" => "A-II EKSAK IL PASTI & ALAM"),
            array(
                "bkn_id" => "A5EB03E20866F6A0E040640A040252AD",
                "nama" => "A-II EKSAK.ILMU PENGET.ALAM"),
            array(
                "bkn_id" => "A5EB03E20861F6A0E040640A040252AD",
                "nama" => "A-II EKSAKTA"),
            array(
                "bkn_id" => "A5EB03E20862F6A0E040640A040252AD",
                "nama" => "A-II EKSAKTA BIOLOGI"),
            array(
                "bkn_id" => "A5EB03E20863F6A0E040640A040252AD",
                "nama" => "A-II EKSAKTA FISIKA"),
            array(
                "bkn_id" => "A5EB03E20867F6A0E040640A040252AD",
                "nama" => "A-II EKSAKTA GEOLOGI"),
            array(
                "bkn_id" => "A5EB03E20864F6A0E040640A040252AD",
                "nama" => "A-II EKSAKTA ILMU ALAM"),
            array(
                "bkn_id" => "A5EB03E20868F6A0E040640A040252AD",
                "nama" => "A-II EKSAKTA ILMU KIMIA"),
            array(
                "bkn_id" => "A5EB03E2086AF6A0E040640A040252AD",
                "nama" => "A-II EKSAKTA ILMU PASTI"),
            array(
                "bkn_id" => "A5EB03E20869F6A0E040640A040252AD",
                "nama" => "A-II EKSAKTA KIMIA"),
            array(
                "bkn_id" => "A5EB03E2086BF6A0E040640A040252AD",
                "nama" => "A-II EKSAKTA MATEMATIKA"),
            array(
                "bkn_id" => "A5EB03E2086CF6A0E040640A040252AD",
                "nama" => "A-II EKSAKTA STATISTIK"),
            array(
                "bkn_id" => "A5EB03E20597F6A0E040640A040252AD",
                "nama" => "A-II ELEKTRONIKA"),
            array(
                "bkn_id" => "A5EB03E2058EF6A0E040640A040252AD",
                "nama" => "A-II FILSAFAT"),
            array(
                "bkn_id" => "A5EB03E20591F6A0E040640A040252AD",
                "nama" => "A-II FILSAFAT & SOSIOLOGI"),
            array(
                "bkn_id" => "A5EB03E20590F6A0E040640A040252AD",
                "nama" => "A-II FILSAFAT BARAT"),
            array(
                "bkn_id" => "A5EB03E2058FF6A0E040640A040252AD",
                "nama" => "A-II FILSAFAT BHS & SAS.IND"),
            array(
                "bkn_id" => "A5EB03E20592F6A0E040640A040252AD",
                "nama" => "A-II FILSAFAT KEBUDAYAAN"),
            array(
                "bkn_id" => "A5EB03E20593F6A0E040640A040252AD",
                "nama" => "A-II FILSAFAT PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E207EAF6A0E040640A040252AD",
                "nama" => "A-II IPS"),
            array(
                "bkn_id" => "A5EB03E207ECF6A0E040640A040252AD",
                "nama" => "A-II IPS ANTROP. BUDAYA"),
            array(
                "bkn_id" => "A5EB03E207EDF6A0E040640A040252AD",
                "nama" => "A-II IPS ANTROP. SOSIAL"),
            array(
                "bkn_id" => "A5EB03E207EBF6A0E040640A040252AD",
                "nama" => "A-II IPS ANTROPOLOGI"),
            array(
                "bkn_id" => "A5EB03E207F6F6A0E040640A040252AD",
                "nama" => "A-II IPS CIVICS HUKUM"),
            array(
                "bkn_id" => "A5EB03E20806F6A0E040640A040252AD",
                "nama" => "A-II IPS DIK. KESEHATAN"),
            array(
                "bkn_id" => "A5EB03E2084EF6A0E040640A040252AD",
                "nama" => "A-II IPS DIK.LUAR SEKOLAH"),
            array(
                "bkn_id" => "A5EB03E207F7F6A0E040640A040252AD",
                "nama" => "A-II IPS HUKUM PMP"),
            array(
                "bkn_id" => "A5EB03E207FDF6A0E040640A040252AD",
                "nama" => "A-II IPS ILMU BUMI"),
            array(
                "bkn_id" => "A5EB03E20855F6A0E040640A040252AD",
                "nama" => "A-II IPS ILMU KESEJAHTERA"),
            array(
                "bkn_id" => "A5EB03E207FEF6A0E040640A040252AD",
                "nama" => "A-II IPS ILMU MENDIDIK"),
            array(
                "bkn_id" => "A5EB03E20856F6A0E040640A040252AD",
                "nama" => "A-II IPS ILMU PEMBANGUNAN"),
            array(
                "bkn_id" => "A5EB03E20857F6A0E040640A040252AD",
                "nama" => "A-II IPS ILMU PENGETAHUAN"),
            array(
                "bkn_id" => "A5EB03E20800F6A0E040640A040252AD",
                "nama" => "A-II IPS KATAKETIK DIK."),
            array(
                "bkn_id" => "A5EB03E20858F6A0E040640A040252AD",
                "nama" => "A-II IPS KESEJAH. SOSIAL"),
            array(
                "bkn_id" => "A5EB03E207F8F6A0E040640A040252AD",
                "nama" => "A-II IPS KEWARGANEGARAAN"),
            array(
                "bkn_id" => "A5EB03E2085EF6A0E040640A040252AD",
                "nama" => "A-II IPS O R & KESEHATAN"),
            array(
                "bkn_id" => "A5EB03E2085DF6A0E040640A040252AD",
                "nama" => "A-II IPS OLAH RAGA"),
            array(
                "bkn_id" => "A5EB03E20850F6A0E040640A040252AD",
                "nama" => "A-II IPS P.MORAL PANCASILA"),
            array(
                "bkn_id" => "A5EB03E207FFF6A0E040640A040252AD",
                "nama" => "A-II IPS PAEDAGOGIK"),
            array(
                "bkn_id" => "A5EB03E20859F6A0E040640A040252AD",
                "nama" => "A-II IPS PEMB.MASY.DESA"),
            array(
                "bkn_id" => "A5EB03E2084DF6A0E040640A040252AD",
                "nama" => "A-II IPS PEND. LUAR BIASA"),
            array(
                "bkn_id" => "A5EB03E20802F6A0E040640A040252AD",
                "nama" => "A-II IPS PEND.&PENGEMBANGAN"),
            array(
                "bkn_id" => "A5EB03E20803F6A0E040640A040252AD",
                "nama" => "A-II IPS PEND.&PENGEMBANGAN"),
            array(
                "bkn_id" => "A5EB03E20805F6A0E040640A040252AD",
                "nama" => "A-II IPS PEND.KEMASY."),
            array(
                "bkn_id" => "A5EB03E2084AF6A0E040640A040252AD",
                "nama" => "A-II IPS PEND.KESEJAHTERAAN"),
            array(
                "bkn_id" => "A5EB03E2084FF6A0E040640A040252AD",
                "nama" => "A-II IPS PEND.MASYARAKAT"),
            array(
                "bkn_id" => "A5EB03E20801F6A0E040640A040252AD",
                "nama" => "A-II IPS PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20804F6A0E040640A040252AD",
                "nama" => "A-II IPS PENDIDIKAN DASAR"),
            array(
                "bkn_id" => "A5EB03E2084CF6A0E040640A040252AD",
                "nama" => "A-II IPS PENDIDIKAN KHUSUS"),
            array(
                "bkn_id" => "A5EB03E20851F6A0E040640A040252AD",
                "nama" => "A-II IPS PENDIDIKAN SEK."),
            array(
                "bkn_id" => "A5EB03E20852F6A0E040640A040252AD",
                "nama" => "A-II IPS PENDIDIKAN SOSIAL"),
            array(
                "bkn_id" => "A5EB03E20853F6A0E040640A040252AD",
                "nama" => "A-II IPS PENDIDIKAN UMUM"),
            array(
                "bkn_id" => "A5EB03E2085BF6A0E040640A040252AD",
                "nama" => "A-II IPS PERPUSTAKAAN"),
            array(
                "bkn_id" => "A5EB03E2085CF6A0E040640A040252AD",
                "nama" => "A-II IPS PHSIKOLOGI"),
            array(
                "bkn_id" => "A5EB03E207F9F6A0E040640A040252AD",
                "nama" => "A-II IPS PKK"),
            array(
                "bkn_id" => "A5EB03E207FAF6A0E040640A040252AD",
                "nama" => "A-II IPS PKN DAN HUKUM"),
            array(
                "bkn_id" => "A5EB03E207FBF6A0E040640A040252AD",
                "nama" => "A-II IPS PMP DAN KWNEGARAAN"),
            array(
                "bkn_id" => "A5EB03E207FCF6A0E040640A040252AD",
                "nama" => "A-II IPS PSPB"),
            array(
                "bkn_id" => "A5EB03E2085AF6A0E040640A040252AD",
                "nama" => "A-II IPS PUBLISISTIK"),
            array(
                "bkn_id" => "A5EB03E207F0F6A0E040640A040252AD",
                "nama" => "A-II IPS RAH .& ARKELOGI"),
            array(
                "bkn_id" => "A5EB03E207EEF6A0E040640A040252AD",
                "nama" => "A-II IPS SEJARAH"),
            array(
                "bkn_id" => "A5EB03E207EFF6A0E040640A040252AD",
                "nama" => "A-II IPS SEJARAH & ANTROP."),
            array(
                "bkn_id" => "A5EB03E207F1F6A0E040640A040252AD",
                "nama" => "A-II IPS SEJARAH & BUDAYA"),
            array(
                "bkn_id" => "A5EB03E207F2F6A0E040640A040252AD",
                "nama" => "A-II IPS SEJARAH GEOGRAFI"),
            array(
                "bkn_id" => "A5EB03E207F3F6A0E040640A040252AD",
                "nama" => "A-II IPS SEJARAH INDONESIA"),
            array(
                "bkn_id" => "A5EB03E207F4F6A0E040640A040252AD",
                "nama" => "A-II IPS SEJARAH PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E207F5F6A0E040640A040252AD",
                "nama" => "A-II IPS SEJARAH PURBAKAL"),
            array(
                "bkn_id" => "A5EB03E2085FF6A0E040640A040252AD",
                "nama" => "A-II IPS SOSIAL"),
            array(
                "bkn_id" => "A5EB03E20860F6A0E040640A040252AD",
                "nama" => "A-II IPS SOSIAL EKONOMI"),
            array(
                "bkn_id" => "A5EB03E20854F6A0E040640A040252AD",
                "nama" => "A-II IPS TEORI & RAH PEND."),
            array(
                "bkn_id" => "A5EB03E205A1F6A0E040640A040252AD",
                "nama" => "A-II KIMIA"),
            array(
                "bkn_id" => "A5EB03E205A3F6A0E040640A040252AD",
                "nama" => "A-II LISTRIK"),
            array(
                "bkn_id" => "A5EB03E2051DF6A0E040640A040252AD",
                "nama" => "A-II MESIN"),
            array(
                "bkn_id" => "A5EB03E2088AF6A0E040640A040252AD",
                "nama" => "A-II SENI"),
            array(
                "bkn_id" => "A5EB03E2088BF6A0E040640A040252AD",
                "nama" => "A-II SENI BAHASA DAN SENI"),
            array(
                "bkn_id" => "A5EB03E2088CF6A0E040640A040252AD",
                "nama" => "A-II SENI MENGGAMBAR"),
            array(
                "bkn_id" => "A5EB03E2088DF6A0E040640A040252AD",
                "nama" => "A-II SENI MUSIK"),
            array(
                "bkn_id" => "A5EB03E2088EF6A0E040640A040252AD",
                "nama" => "A-II SENI RUPA"),
            array(
                "bkn_id" => "A5EB03E2088FF6A0E040640A040252AD",
                "nama" => "A-II SENI TARI"),
            array(
                "bkn_id" => "A5EB03E2059AF6A0E040640A040252AD",
                "nama" => "A-II TEK.ELEKTRO KOMUNIKASI"),
            array(
                "bkn_id" => "A5EB03E20594F6A0E040640A040252AD",
                "nama" => "A-II TEKNIK"),
            array(
                "bkn_id" => "A5EB03E20520F6A0E040640A040252AD",
                "nama" => "A-II TEKNIK &MANAJ. INDUS."),
            array(
                "bkn_id" => "A5EB03E205A0F6A0E040640A040252AD",
                "nama" => "A-II TEKNIK ALIRAN SUNGAI"),
            array(
                "bkn_id" => "A5EB03E20596F6A0E040640A040252AD",
                "nama" => "A-II TEKNIK ARSITEKTUR"),
            array(
                "bkn_id" => "A5EB03E2059EF6A0E040640A040252AD",
                "nama" => "A-II TEKNIK BANGUNAN"),
            array(
                "bkn_id" => "A5EB03E20598F6A0E040640A040252AD",
                "nama" => "A-II TEKNIK ELEKTRO"),
            array(
                "bkn_id" => "A5EB03E20599F6A0E040640A040252AD",
                "nama" => "A-II TEKNIK ELEKTRO KOMP."),
            array(
                "bkn_id" => "A5EB03E2059BF6A0E040640A040252AD",
                "nama" => "A-II TEKNIK ELEKTRONIKA"),
            array(
                "bkn_id" => "A5EB03E2059DF6A0E040640A040252AD",
                "nama" => "A-II TEKNIK GEDUNG"),
            array(
                "bkn_id" => "A5EB03E20521F6A0E040640A040252AD",
                "nama" => "A-II TEKNIK INDUSTRI"),
            array(
                "bkn_id" => "A5EB03E205A2F6A0E040640A040252AD",
                "nama" => "A-II TEKNIK KIMIA"),
            array(
                "bkn_id" => "A5EB03E2059CF6A0E040640A040252AD",
                "nama" => "A-II TEKNIK KOMPUTER"),
            array(
                "bkn_id" => "A5EB03E2051CF6A0E040640A040252AD",
                "nama" => "A-II TEKNIK LISTRIK"),
            array(
                "bkn_id" => "A5EB03E2051EF6A0E040640A040252AD",
                "nama" => "A-II TEKNIK MESIN"),
            array(
                "bkn_id" => "A5EB03E2051FF6A0E040640A040252AD",
                "nama" => "A-II TEKNIK OTOMOTIF"),
            array(
                "bkn_id" => "A5EB03E2059FF6A0E040640A040252AD",
                "nama" => "A-II TEKNIK SIPIL"),
            array(
                "bkn_id" => "A5EB03E20522F6A0E040640A040252AD",
                "nama" => "A-III"),
            array(
                "bkn_id" => "A5EB03E205CBF6A0E040640A040252AD",
                "nama" => "A-III ADM. KETERAMPILAN"),
            array(
                "bkn_id" => "A5EB03E205CCF6A0E040640A040252AD",
                "nama" => "A-III ADM. KEU."),
            array(
                "bkn_id" => "A5EB03E205CDF6A0E040640A040252AD",
                "nama" => "A-III ADM. PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E205CFF6A0E040640A040252AD",
                "nama" => "A-III ADM. PERKANTORAN"),
            array(
                "bkn_id" => "A5EB03E205D1F6A0E040640A040252AD",
                "nama" => "A-III ADM. PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E205CEF6A0E040640A040252AD",
                "nama" => "A-III ADM. SUPERVISI PEND."),
            array(
                "bkn_id" => "A5EB03E205D0F6A0E040640A040252AD",
                "nama" => "A-III ADM. TATA PERKANTORAN"),
            array(
                "bkn_id" => "A5EB03E205D4F6A0E040640A040252AD",
                "nama" => "A-III ADM.ILMU ADM. NEGARA"),
            array(
                "bkn_id" => "A5EB03E205C9F6A0E040640A040252AD",
                "nama" => "A-III ADMINISTRASI"),
            array(
                "bkn_id" => "A5EB03E205CAF6A0E040640A040252AD",
                "nama" => "A-III ADMINISTRASI EKONOMI"),
            array(
                "bkn_id" => "A5EB03E205D2F6A0E040640A040252AD",
                "nama" => "A-III ADMINISTRASI SEKOLAH"),
            array(
                "bkn_id" => "A5EB03E205D3F6A0E040640A040252AD",
                "nama" => "A-III ADMINISTRASI SOSIAL"),
            array(
                "bkn_id" => "A5EB03E20643F6A0E040640A040252AD",
                "nama" => "A-III ARSITEKTUR"),
            array(
                "bkn_id" => "A5EB03E205A6F6A0E040640A040252AD",
                "nama" => "A-III BAHASA"),
            array(
                "bkn_id" => "A5EB03E205AEF6A0E040640A040252AD",
                "nama" => "A-III BAHASA DAERAH"),
            array(
                "bkn_id" => "A5EB03E205B2F6A0E040640A040252AD",
                "nama" => "A-III BAHASA & SASTRA ARAB"),
            array(
                "bkn_id" => "A5EB03E205ABF6A0E040640A040252AD",
                "nama" => "A-III BAHASA & SASTRA BALI"),
            array(
                "bkn_id" => "A5EB03E205B4F6A0E040640A040252AD",
                "nama" => "A-III BAHASA & SASTRA CINA"),
            array(
                "bkn_id" => "A5EB03E205A8F6A0E040640A040252AD",
                "nama" => "A-III BAHASA & SASTRA JAWA"),
            array(
                "bkn_id" => "A5EB03E205BDF6A0E040640A040252AD",
                "nama" => "A-III BAHASA ARAB"),
            array(
                "bkn_id" => "A5EB03E205C0F6A0E040640A040252AD",
                "nama" => "A-III BAHASA ASING"),
            array(
                "bkn_id" => "A5EB03E205BEF6A0E040640A040252AD",
                "nama" => "A-III BAHASA BALI"),
            array(
                "bkn_id" => "A5EB03E205BFF6A0E040640A040252AD",
                "nama" => "A-III BAHASA BATAK"),
            array(
                "bkn_id" => "A5EB03E205C1F6A0E040640A040252AD",
                "nama" => "A-III BAHASA BELANDA"),
            array(
                "bkn_id" => "A5EB03E205C2F6A0E040640A040252AD",
                "nama" => "A-III BAHASA CINA/CINOLOGI"),
            array(
                "bkn_id" => "A5EB03E205B1F6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. ASING"),
            array(
                "bkn_id" => "A5EB03E205AAF6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. BATAK"),
            array(
                "bkn_id" => "A5EB03E205B3F6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. BELANDA"),
            array(
                "bkn_id" => "A5EB03E205ADF6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. DAERAH"),
            array(
                "bkn_id" => "A5EB03E205B5F6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. INDIA"),
            array(
                "bkn_id" => "A5EB03E205A7F6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. INDONESIA"),
            array(
                "bkn_id" => "A5EB03E205B6F6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. INGGRIS"),
            array(
                "bkn_id" => "A5EB03E205B7F6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. JEPANG"),
            array(
                "bkn_id" => "A5EB03E205B8F6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. JERMAN"),
            array(
                "bkn_id" => "A5EB03E205B9F6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. KOREA"),
            array(
                "bkn_id" => "A5EB03E205ACF6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. MINANGKABAU"),
            array(
                "bkn_id" => "A5EB03E205BAF6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. PERANCIS"),
            array(
                "bkn_id" => "A5EB03E205BBF6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. RUSIA"),
            array(
                "bkn_id" => "A5EB03E205BCF6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. SLAVIA"),
            array(
                "bkn_id" => "A5EB03E205A9F6A0E040640A040252AD",
                "nama" => "A-III BHS & SAS. SUNDA"),
            array(
                "bkn_id" => "A5EB03E205AFF6A0E040640A040252AD",
                "nama" => "A-III BHS SEJARAH & BUDAYA"),
            array(
                "bkn_id" => "A5EB03E205B0F6A0E040640A040252AD",
                "nama" => "A-III BHS SEJARAH BHS BALI"),
            array(
                "bkn_id" => "A5EB03E205E7F6A0E040640A040252AD",
                "nama" => "A-III BIMBINGAN & PENYULUHAN"),
            array(
                "bkn_id" => "A5EB03E2062CF6A0E040640A040252AD",
                "nama" => "A-III BP ADM. PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2062DF6A0E040640A040252AD",
                "nama" => "A-III BP ADM.SUPERVISI PEND."),
            array(
                "bkn_id" => "A5EB03E2062EF6A0E040640A040252AD",
                "nama" => "A-III BP BIMB. & KONSELING"),
            array(
                "bkn_id" => "A5EB03E2062FF6A0E040640A040252AD",
                "nama" => "A-III BP BIMB. & PENYULUH"),
            array(
                "bkn_id" => "A5EB03E20630F6A0E040640A040252AD",
                "nama" => "A-III BP DIDAKTIK"),
            array(
                "bkn_id" => "A5EB03E20631F6A0E040640A040252AD",
                "nama" => "A-III BP DIDAKTIK& KURIKULUM"),
            array(
                "bkn_id" => "A5EB03E2063BF6A0E040640A040252AD",
                "nama" => "A-III BP KEOLAHRAGAAN"),
            array(
                "bkn_id" => "A5EB03E20635F6A0E040640A040252AD",
                "nama" => "A-III BP KURIKL PERSEK/PENG."),
            array(
                "bkn_id" => "A5EB03E20638F6A0E040640A040252AD",
                "nama" => "A-III BP KURIKL. PENYULUHAN"),
            array(
                "bkn_id" => "A5EB03E20636F6A0E040640A040252AD",
                "nama" => "A-III BP KURIKL.& TEK.PEND."),
            array(
                "bkn_id" => "A5EB03E20637F6A0E040640A040252AD",
                "nama" => "A-III BP KURIKULUM PEND."),
            array(
                "bkn_id" => "A5EB03E20639F6A0E040640A040252AD",
                "nama" => "A-III BP KURTEK PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2063AF6A0E040640A040252AD",
                "nama" => "A-III BP PENGAJ.&PENGEMB.KUR"),
            array(
                "bkn_id" => "A5EB03E20632F6A0E040640A040252AD",
                "nama" => "A-III BP PONDASI PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20634F6A0E040640A040252AD",
                "nama" => "A-III BP PSIK. PEND.& BIMB."),
            array(
                "bkn_id" => "A5EB03E20633F6A0E040640A040252AD",
                "nama" => "A-III BP PSIKOLOGI PEND."),
            array(
                "bkn_id" => "A5EB03E205E2F6A0E040640A040252AD",
                "nama" => "A-III EK. PENDD.DUNIA USA"),
            array(
                "bkn_id" => "A5EB03E205E4F6A0E040640A040252AD",
                "nama" => "A-III EK. STUDI PEMBANGUN"),
            array(
                "bkn_id" => "A5EB03E205E6F6A0E040640A040252AD",
                "nama" => "A-III EK. TATA PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E205D5F6A0E040640A040252AD",
                "nama" => "A-III EKONOMI"),
            array(
                "bkn_id" => "A5EB03E205DAF6A0E040640A040252AD",
                "nama" => "A-III EKONOMI"),
            array(
                "bkn_id" => "A5EB03E205D6F6A0E040640A040252AD",
                "nama" => "A-III EKONOMI AKUNTANSI"),
            array(
                "bkn_id" => "A5EB03E205D7F6A0E040640A040252AD",
                "nama" => "A-III EKONOMI BISNIS"),
            array(
                "bkn_id" => "A5EB03E205D8F6A0E040640A040252AD",
                "nama" => "A-III EKONOMI BISNIS TATA"),
            array(
                "bkn_id" => "A5EB03E205D9F6A0E040640A040252AD",
                "nama" => "A-III EKONOMI BISNIS VOKAS"),
            array(
                "bkn_id" => "A5EB03E205DFF6A0E040640A040252AD",
                "nama" => "A-III EKONOMI ILMU EKONOMI"),
            array(
                "bkn_id" => "A5EB03E205E0F6A0E040640A040252AD",
                "nama" => "A-III EKONOMI KEUANGAN"),
            array(
                "bkn_id" => "A5EB03E205DBF6A0E040640A040252AD",
                "nama" => "A-III EKONOMI KOPERASI"),
            array(
                "bkn_id" => "A5EB03E205E1F6A0E040640A040252AD",
                "nama" => "A-III EKONOMI MANAJEMEN"),
            array(
                "bkn_id" => "A5EB03E205DCF6A0E040640A040252AD",
                "nama" => "A-III EKONOMI MANAJEMEN"),
            array(
                "bkn_id" => "A5EB03E205DDF6A0E040640A040252AD",
                "nama" => "A-III EKONOMI PEMBANGUNAN"),
            array(
                "bkn_id" => "A5EB03E205E3F6A0E040640A040252AD",
                "nama" => "A-III EKONOMI PENDD.MANAJ."),
            array(
                "bkn_id" => "A5EB03E205DEF6A0E040640A040252AD",
                "nama" => "A-III EKONOMI PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E205E5F6A0E040640A040252AD",
                "nama" => "A-III EKONOMI TATA NIAGA"),
            array(
                "bkn_id" => "A5EB03E2055AF6A0E040640A040252AD",
                "nama" => "A-III EKSAK IL PASTI & ALAM"),
            array(
                "bkn_id" => "A5EB03E2055BF6A0E040640A040252AD",
                "nama" => "A-III EKSAK.ILMU PENGET.ALAM"),
            array(
                "bkn_id" => "A5EB03E20556F6A0E040640A040252AD",
                "nama" => "A-III EKSAKTA"),
            array(
                "bkn_id" => "A5EB03E20557F6A0E040640A040252AD",
                "nama" => "A-III EKSAKTA BIOLOGI"),
            array(
                "bkn_id" => "A5EB03E20558F6A0E040640A040252AD",
                "nama" => "A-III EKSAKTA FISIKA"),
            array(
                "bkn_id" => "A5EB03E2055CF6A0E040640A040252AD",
                "nama" => "A-III EKSAKTA GEOLOGI"),
            array(
                "bkn_id" => "A5EB03E20559F6A0E040640A040252AD",
                "nama" => "A-III EKSAKTA ILMU ALAM"),
            array(
                "bkn_id" => "A5EB03E2055DF6A0E040640A040252AD",
                "nama" => "A-III EKSAKTA ILMU KIMIA"),
            array(
                "bkn_id" => "A5EB03E2055FF6A0E040640A040252AD",
                "nama" => "A-III EKSAKTA ILMU PASTI"),
            array(
                "bkn_id" => "A5EB03E2055EF6A0E040640A040252AD",
                "nama" => "A-III EKSAKTA KIMIA"),
            array(
                "bkn_id" => "A5EB03E205A4F6A0E040640A040252AD",
                "nama" => "A-III EKSAKTA MATEMATIKA"),
            array(
                "bkn_id" => "A5EB03E205A5F6A0E040640A040252AD",
                "nama" => "A-III EKSAKTA STATISTIK"),
            array(
                "bkn_id" => "A5EB03E20645F6A0E040640A040252AD",
                "nama" => "A-III ELEKTRONIKA"),
            array(
                "bkn_id" => "A5EB03E2063CF6A0E040640A040252AD",
                "nama" => "A-III FILSAFAT"),
            array(
                "bkn_id" => "A5EB03E2063FF6A0E040640A040252AD",
                "nama" => "A-III FILSAFAT & SOSIOLOGI"),
            array(
                "bkn_id" => "A5EB03E2063EF6A0E040640A040252AD",
                "nama" => "A-III FILSAFAT BARAT"),
            array(
                "bkn_id" => "A5EB03E2063DF6A0E040640A040252AD",
                "nama" => "A-III FILSAFAT BHS & SAS.IND"),
            array(
                "bkn_id" => "A5EB03E20640F6A0E040640A040252AD",
                "nama" => "A-III FILSAFAT KEBUDAYAAN"),
            array(
                "bkn_id" => "A5EB03E20641F6A0E040640A040252AD",
                "nama" => "A-III FILSAFAT PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20523F6A0E040640A040252AD",
                "nama" => "A-III IPS"),
            array(
                "bkn_id" => "A5EB03E20525F6A0E040640A040252AD",
                "nama" => "A-III IPS ANTROP. BUDAYA"),
            array(
                "bkn_id" => "A5EB03E20526F6A0E040640A040252AD",
                "nama" => "A-III IPS ANTROP. SOSIAL"),
            array(
                "bkn_id" => "A5EB03E20524F6A0E040640A040252AD",
                "nama" => "A-III IPS ANTROPOLOGI"),
            array(
                "bkn_id" => "A5EB03E2052FF6A0E040640A040252AD",
                "nama" => "A-III IPS CIVICS HUKUM"),
            array(
                "bkn_id" => "A5EB03E2053FF6A0E040640A040252AD",
                "nama" => "A-III IPS DIK. KESEHATAN"),
            array(
                "bkn_id" => "A5EB03E20543F6A0E040640A040252AD",
                "nama" => "A-III IPS DIK.LUAR SEKOLAH"),
            array(
                "bkn_id" => "A5EB03E20530F6A0E040640A040252AD",
                "nama" => "A-III IPS HUKUM PMP"),
            array(
                "bkn_id" => "A5EB03E20536F6A0E040640A040252AD",
                "nama" => "A-III IPS ILMU BUMI"),
            array(
                "bkn_id" => "A5EB03E2054AF6A0E040640A040252AD",
                "nama" => "A-III IPS ILMU KESEJAHTERA"),
            array(
                "bkn_id" => "A5EB03E20537F6A0E040640A040252AD",
                "nama" => "A-III IPS ILMU MENDIDIK"),
            array(
                "bkn_id" => "A5EB03E2054BF6A0E040640A040252AD",
                "nama" => "A-III IPS ILMU PEMBANGUNAN"),
            array(
                "bkn_id" => "A5EB03E2054CF6A0E040640A040252AD",
                "nama" => "A-III IPS ILMU PENGETAHUAN"),
            array(
                "bkn_id" => "A5EB03E20539F6A0E040640A040252AD",
                "nama" => "A-III IPS KATAKETIK DIK."),
            array(
                "bkn_id" => "A5EB03E2054DF6A0E040640A040252AD",
                "nama" => "A-III IPS KESEJAH. SOSIAL"),
            array(
                "bkn_id" => "A5EB03E20531F6A0E040640A040252AD",
                "nama" => "A-III IPS KEWARGANEGARAAN"),
            array(
                "bkn_id" => "A5EB03E20553F6A0E040640A040252AD",
                "nama" => "A-III IPS O R & KESEHATAN"),
            array(
                "bkn_id" => "A5EB03E20552F6A0E040640A040252AD",
                "nama" => "A-III IPS OLAH RAGA"),
            array(
                "bkn_id" => "A5EB03E20545F6A0E040640A040252AD",
                "nama" => "A-III IPS P.MORAL PANCASILA"),
            array(
                "bkn_id" => "A5EB03E20538F6A0E040640A040252AD",
                "nama" => "A-III IPS PAEDAGOGIK"),
            array(
                "bkn_id" => "A5EB03E2054EF6A0E040640A040252AD",
                "nama" => "A-III IPS PEMB.MASY.DESA"),
            array(
                "bkn_id" => "A5EB03E20542F6A0E040640A040252AD",
                "nama" => "A-III IPS PEND. LUAR BIASA"),
            array(
                "bkn_id" => "A5EB03E2053CF6A0E040640A040252AD",
                "nama" => "A-III IPS PEND.&PENGEMBANGAN"),
            array(
                "bkn_id" => "A5EB03E2053BF6A0E040640A040252AD",
                "nama" => "A-III IPS PEND.&PENGEMBANGAN"),
            array(
                "bkn_id" => "A5EB03E2053EF6A0E040640A040252AD",
                "nama" => "A-III IPS PEND.KEMASY."),
            array(
                "bkn_id" => "A5EB03E20540F6A0E040640A040252AD",
                "nama" => "A-III IPS PEND.KESEJAHTERAAN"),
            array(
                "bkn_id" => "A5EB03E20544F6A0E040640A040252AD",
                "nama" => "A-III IPS PEND.MASYARAKAT"),
            array(
                "bkn_id" => "A5EB03E2053AF6A0E040640A040252AD",
                "nama" => "A-III IPS PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2053DF6A0E040640A040252AD",
                "nama" => "A-III IPS PENDIDIKAN DASAR"),
            array(
                "bkn_id" => "A5EB03E20541F6A0E040640A040252AD",
                "nama" => "A-III IPS PENDIDIKAN KHUSUS"),
            array(
                "bkn_id" => "A5EB03E20546F6A0E040640A040252AD",
                "nama" => "A-III IPS PENDIDIKAN SEK."),
            array(
                "bkn_id" => "A5EB03E20547F6A0E040640A040252AD",
                "nama" => "A-III IPS PENDIDIKAN SOSIAL"),
            array(
                "bkn_id" => "A5EB03E20548F6A0E040640A040252AD",
                "nama" => "A-III IPS PENDIDIKAN UMUM"),
            array(
                "bkn_id" => "A5EB03E20550F6A0E040640A040252AD",
                "nama" => "A-III IPS PERPUSTAKAAN"),
            array(
                "bkn_id" => "A5EB03E20551F6A0E040640A040252AD",
                "nama" => "A-III IPS PHSIKOLOGI"),
            array(
                "bkn_id" => "A5EB03E20532F6A0E040640A040252AD",
                "nama" => "A-III IPS PKK"),
            array(
                "bkn_id" => "A5EB03E20533F6A0E040640A040252AD",
                "nama" => "A-III IPS PKN DAN HUKUM"),
            array(
                "bkn_id" => "A5EB03E20534F6A0E040640A040252AD",
                "nama" => "A-III IPS PMP DAN KWNEGARAAN"),
            array(
                "bkn_id" => "A5EB03E20535F6A0E040640A040252AD",
                "nama" => "A-III IPS PSPB"),
            array(
                "bkn_id" => "A5EB03E2054FF6A0E040640A040252AD",
                "nama" => "A-III IPS PUBLISISTIK"),
            array(
                "bkn_id" => "A5EB03E20529F6A0E040640A040252AD",
                "nama" => "A-III IPS RAH .& ARKELOGI"),
            array(
                "bkn_id" => "A5EB03E20527F6A0E040640A040252AD",
                "nama" => "A-III IPS SEJARAH"),
            array(
                "bkn_id" => "A5EB03E20528F6A0E040640A040252AD",
                "nama" => "A-III IPS SEJARAH & ANTROP."),
            array(
                "bkn_id" => "A5EB03E2052AF6A0E040640A040252AD",
                "nama" => "A-III IPS SEJARAH & BUDAYA"),
            array(
                "bkn_id" => "A5EB03E2052BF6A0E040640A040252AD",
                "nama" => "A-III IPS SEJARAH GEOGRAFI"),
            array(
                "bkn_id" => "A5EB03E2052CF6A0E040640A040252AD",
                "nama" => "A-III IPS SEJARAH INDONESIA"),
            array(
                "bkn_id" => "A5EB03E2052DF6A0E040640A040252AD",
                "nama" => "A-III IPS SEJARAH PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2052EF6A0E040640A040252AD",
                "nama" => "A-III IPS SEJARAH PURBAKAL"),
            array(
                "bkn_id" => "A5EB03E20554F6A0E040640A040252AD",
                "nama" => "A-III IPS SOSIAL"),
            array(
                "bkn_id" => "A5EB03E20555F6A0E040640A040252AD",
                "nama" => "A-III IPS SOSIAL EKONOMI"),
            array(
                "bkn_id" => "A5EB03E20549F6A0E040640A040252AD",
                "nama" => "A-III IPS TEORI & RAH PEND."),
            array(
                "bkn_id" => "A5EB03E2064FF6A0E040640A040252AD",
                "nama" => "A-III KIMIA"),
            array(
                "bkn_id" => "A5EB03E20651F6A0E040640A040252AD",
                "nama" => "A-III LISTRIK"),
            array(
                "bkn_id" => "A5EB03E20653F6A0E040640A040252AD",
                "nama" => "A-III MESIN"),
            array(
                "bkn_id" => "A5EB03E205C3F6A0E040640A040252AD",
                "nama" => "A-III SENI"),
            array(
                "bkn_id" => "A5EB03E205C4F6A0E040640A040252AD",
                "nama" => "A-III SENI BAHASA DAN SENI"),
            array(
                "bkn_id" => "A5EB03E205C5F6A0E040640A040252AD",
                "nama" => "A-III SENI MENGGAMBAR"),
            array(
                "bkn_id" => "A5EB03E205C6F6A0E040640A040252AD",
                "nama" => "A-III SENI MUSIK"),
            array(
                "bkn_id" => "A5EB03E205C7F6A0E040640A040252AD",
                "nama" => "A-III SENI RUPA"),
            array(
                "bkn_id" => "A5EB03E205C8F6A0E040640A040252AD",
                "nama" => "A-III SENI TARI"),
            array(
                "bkn_id" => "A5EB03E20648F6A0E040640A040252AD",
                "nama" => "A-III TEK.ELEKTRO KOMUNIKASI"),
            array(
                "bkn_id" => "A5EB03E20642F6A0E040640A040252AD",
                "nama" => "A-III TEKNIK"),
            array(
                "bkn_id" => "A5EB03E20656F6A0E040640A040252AD",
                "nama" => "A-III TEKNIK &MANAJ. INDUS."),
            array(
                "bkn_id" => "A5EB03E2064EF6A0E040640A040252AD",
                "nama" => "A-III TEKNIK ALIRAN SUNGAI"),
            array(
                "bkn_id" => "A5EB03E20644F6A0E040640A040252AD",
                "nama" => "A-III TEKNIK ARSITEKTUR"),
            array(
                "bkn_id" => "A5EB03E2064CF6A0E040640A040252AD",
                "nama" => "A-III TEKNIK BANGUNAN"),
            array(
                "bkn_id" => "A5EB03E20646F6A0E040640A040252AD",
                "nama" => "A-III TEKNIK ELEKTRO"),
            array(
                "bkn_id" => "A5EB03E20647F6A0E040640A040252AD",
                "nama" => "A-III TEKNIK ELEKTRO KOMP."),
            array(
                "bkn_id" => "A5EB03E20649F6A0E040640A040252AD",
                "nama" => "A-III TEKNIK ELEKTRONIKA"),
            array(
                "bkn_id" => "A5EB03E2064BF6A0E040640A040252AD",
                "nama" => "A-III TEKNIK GEDUNG"),
            array(
                "bkn_id" => "A5EB03E20657F6A0E040640A040252AD",
                "nama" => "A-III TEKNIK INDUSTRI"),
            array(
                "bkn_id" => "A5EB03E20650F6A0E040640A040252AD",
                "nama" => "A-III TEKNIK KIMIA"),
            array(
                "bkn_id" => "A5EB03E2064AF6A0E040640A040252AD",
                "nama" => "A-III TEKNIK KOMPUTER"),
            array(
                "bkn_id" => "A5EB03E20652F6A0E040640A040252AD",
                "nama" => "A-III TEKNIK LISTRIK"),
            array(
                "bkn_id" => "A5EB03E20654F6A0E040640A040252AD",
                "nama" => "A-III TEKNIK MESIN"),
            array(
                "bkn_id" => "A5EB03E20655F6A0E040640A040252AD",
                "nama" => "A-III TEKNIK OTOMOTIF"),
            array(
                "bkn_id" => "A5EB03E2064DF6A0E040640A040252AD",
                "nama" => "A-III TEKNIK SIPIL"),
            array(
                "bkn_id" => "A5EB03E20658F6A0E040640A040252AD",
                "nama" => "A-IV"),
            array(
                "bkn_id" => "A5EB03E205FFF6A0E040640A040252AD",
                "nama" => "A-IV BAHASA"),
            array(
                "bkn_id" => "A5EB03E20757F6A0E040640A040252AD",
                "nama" => "A-IV IPS"),
            array(
                "bkn_id" => "A5EB03E2075BF6A0E040640A040252AD",
                "nama" => "A-IV ADM. KETERAMPILAN"),
            array(
                "bkn_id" => "A5EB03E2075CF6A0E040640A040252AD",
                "nama" => "A-IV ADM. KETERAMPILAN JASA"),
            array(
                "bkn_id" => "A5EB03E20758F6A0E040640A040252AD",
                "nama" => "A-IV ADM. PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2075DF6A0E040640A040252AD",
                "nama" => "A-IV ADM. PERKANTORAN"),
            array(
                "bkn_id" => "A5EB03E2075EF6A0E040640A040252AD",
                "nama" => "A-IV ADM. PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E20759F6A0E040640A040252AD",
                "nama" => "A-IV ADM.SUPERVISI PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2075AF6A0E040640A040252AD",
                "nama" => "A-IV ADMINISTRASI SEKOLAH"),
            array(
                "bkn_id" => "A5EB03E205F3F6A0E040640A040252AD",
                "nama" => "A-IV AKUNTANSI"),
            array(
                "bkn_id" => "A5EB03E2076DF6A0E040640A040252AD",
                "nama" => "A-IV ARSITEKTUR"),
            array(
                "bkn_id" => "A5EB03E20609F6A0E040640A040252AD",
                "nama" => "A-IV BAHASA ARAB"),
            array(
                "bkn_id" => "A5EB03E20602F6A0E040640A040252AD",
                "nama" => "A-IV BAHASA DAN SASTRA"),
            array(
                "bkn_id" => "A5EB03E2060AF6A0E040640A040252AD",
                "nama" => "A-IV BAHASA DAN SASTRA ARAB"),
            array(
                "bkn_id" => "A5EB03E20605F6A0E040640A040252AD",
                "nama" => "A-IV BAHASA DAN SASTRA JAWA"),
            array(
                "bkn_id" => "A5EB03E20601F6A0E040640A040252AD",
                "nama" => "A-IV BAHASA INDONESIA"),
            array(
                "bkn_id" => "A5EB03E20606F6A0E040640A040252AD",
                "nama" => "A-IV BAHASA JAWA"),
            array(
                "bkn_id" => "A5EB03E20610F6A0E040640A040252AD",
                "nama" => "A-IV BAHASA JEPANG"),
            array(
                "bkn_id" => "A5EB03E20612F6A0E040640A040252AD",
                "nama" => "A-IV BAHASA JERMAN"),
            array(
                "bkn_id" => "A5EB03E20613F6A0E040640A040252AD",
                "nama" => "A-IV BAHASA PERANCIS"),
            array(
                "bkn_id" => "A5EB03E2060CF6A0E040640A040252AD",
                "nama" => "A-IV BAHASA RUSIA"),
            array(
                "bkn_id" => "A5EB03E2060DF6A0E040640A040252AD",
                "nama" => "A-IV BHS DAN SAS. ASING"),
            array(
                "bkn_id" => "A5EB03E20604F6A0E040640A040252AD",
                "nama" => "A-IV BHS DAN SAS. DAERAH"),
            array(
                "bkn_id" => "A5EB03E20603F6A0E040640A040252AD",
                "nama" => "A-IV BHS DAN SAS. INDONESIA"),
            array(
                "bkn_id" => "A5EB03E2060EF6A0E040640A040252AD",
                "nama" => "A-IV BHS DAN SAS. INGGRIS"),
            array(
                "bkn_id" => "A5EB03E2060FF6A0E040640A040252AD",
                "nama" => "A-IV BHS DAN SAS. JEPANG"),
            array(
                "bkn_id" => "A5EB03E20611F6A0E040640A040252AD",
                "nama" => "A-IV BHS DAN SAS. JERMAN"),
            array(
                "bkn_id" => "A5EB03E20607F6A0E040640A040252AD",
                "nama" => "A-IV BHS DAN SAS. SUNDA"),
            array(
                "bkn_id" => "A5EB03E20666F6A0E040640A040252AD",
                "nama" => "A-IV BIDANG KEPENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2066AF6A0E040640A040252AD",
                "nama" => "A-IV BIMBINGAN & KONSELING"),
            array(
                "bkn_id" => "A5EB03E2066BF6A0E040640A040252AD",
                "nama" => "A-IV BIMBINGAN & PENYULUHAN"),
            array(
                "bkn_id" => "A5EB03E20662F6A0E040640A040252AD",
                "nama" => "A-IV BIOLOGI"),
            array(
                "bkn_id" => "A5EB03E205F9F6A0E040640A040252AD",
                "nama" => "A-IV BISNIS TATA BUKU"),
            array(
                "bkn_id" => "A5EB03E205FAF6A0E040640A040252AD",
                "nama" => "A-IV BISNIS VOKASIONAL"),
            array(
                "bkn_id" => "A5EB03E2075FF6A0E040640A040252AD",
                "nama" => "A-IV CIVICS HUKUM"),
            array(
                "bkn_id" => "A5EB03E20668F6A0E040640A040252AD",
                "nama" => "A-IV DIDAKTIK"),
            array(
                "bkn_id" => "A5EB03E2066CF6A0E040640A040252AD",
                "nama" => "A-IV DIK. & PENGEMB SOSIAL"),
            array(
                "bkn_id" => "A5EB03E205F7F6A0E040640A040252AD",
                "nama" => "A-IV EKONOMI KOPERASI"),
            array(
                "bkn_id" => "A5EB03E205F6F6A0E040640A040252AD",
                "nama" => "A-IV EKONOMI PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E20773F6A0E040640A040252AD",
                "nama" => "A-IV ELEKTRO"),
            array(
                "bkn_id" => "A5EB03E20776F6A0E040640A040252AD",
                "nama" => "A-IV ELEKTRO ARUS LEMAH"),
            array(
                "bkn_id" => "A5EB03E205FBF6A0E040640A040252AD",
                "nama" => "A-IV FILSAFAT"),
            array(
                "bkn_id" => "A5EB03E205FCF6A0E040640A040252AD",
                "nama" => "A-IV FILSAFAT KEBUDAYAAN"),
            array(
                "bkn_id" => "A5EB03E205FDF6A0E040640A040252AD",
                "nama" => "A-IV FILSAFAT PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E205FEF6A0E040640A040252AD",
                "nama" => "A-IV FILSAFAT SOSIOLOGI PEND."),
            array(
                "bkn_id" => "A5EB03E2065FF6A0E040640A040252AD",
                "nama" => "A-IV FISIKA"),
            array(
                "bkn_id" => "A5EB03E205F4F6A0E040640A040252AD",
                "nama" => "A-IV HITUNG DAGANG"),
            array(
                "bkn_id" => "A5EB03E20760F6A0E040640A040252AD",
                "nama" => "A-IV HUKUM PMP"),
            array(
                "bkn_id" => "A5EB03E2065EF6A0E040640A040252AD",
                "nama" => "A-IV IL.PENGETAHUAN ALAM"),
            array(
                "bkn_id" => "A5EB03E20661F6A0E040640A040252AD",
                "nama" => "A-IV ILMU BUMI"),
            array(
                "bkn_id" => "A5EB03E205F5F6A0E040640A040252AD",
                "nama" => "A-IV ILMU EKONOMI"),
            array(
                "bkn_id" => "A5EB03E20663F6A0E040640A040252AD",
                "nama" => "A-IV ILMU HAYAT/BIOLOGI"),
            array(
                "bkn_id" => "A5EB03E2065BF6A0E040640A040252AD",
                "nama" => "A-IV ILMU PASTI"),
            array(
                "bkn_id" => "A5EB03E2065AF6A0E040640A040252AD",
                "nama" => "A-IV ILMU PASTI DAN ALAM"),
            array(
                "bkn_id" => "A5EB03E2066DF6A0E040640A040252AD",
                "nama" => "A-IV KEGURUAN & ILMU SOSIAL"),
            array(
                "bkn_id" => "A5EB03E20665F6A0E040640A040252AD",
                "nama" => "A-IV KEPENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E205EBF6A0E040640A040252AD",
                "nama" => "A-IV KESEHATAN DAN REKREASI"),
            array(
                "bkn_id" => "A5EB03E205ECF6A0E040640A040252AD",
                "nama" => "A-IV KESEJAHTERAAN KELUARGA"),
            array(
                "bkn_id" => "A5EB03E205EDF6A0E040640A040252AD",
                "nama" => "A-IV KESEJAHTERAAN SOSIAL"),
            array(
                "bkn_id" => "A5EB03E2077BF6A0E040640A040252AD",
                "nama" => "A-IV KETERAMPILAN"),
            array(
                "bkn_id" => "A5EB03E2077CF6A0E040640A040252AD",
                "nama" => "A-IV KETERAMPILAN JASA"),
            array(
                "bkn_id" => "A5EB03E2077DF6A0E040640A040252AD",
                "nama" => "A-IV KETERAMPILAN TEKNIK"),
            array(
                "bkn_id" => "A5EB03E20660F6A0E040640A040252AD",
                "nama" => "A-IV KIMIA"),
            array(
                "bkn_id" => "A5EB03E205F8F6A0E040640A040252AD",
                "nama" => "A-IV KOPERASI"),
            array(
                "bkn_id" => "A5EB03E2066EF6A0E040640A040252AD",
                "nama" => "A-IV KUR.& TEK./PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2066FF6A0E040640A040252AD",
                "nama" => "A-IV KURIK&PERSEK.AN/PENGAJ"),
            array(
                "bkn_id" => "A5EB03E206B4F6A0E040640A040252AD",
                "nama" => "A-IV KURIKULUM PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E206B5F6A0E040640A040252AD",
                "nama" => "A-IV KURIKULUM PENYULUHAN"),
            array(
                "bkn_id" => "A5EB03E206B6F6A0E040640A040252AD",
                "nama" => "A-IV KURTEK PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20777F6A0E040640A040252AD",
                "nama" => "A-IV LISTRIK"),
            array(
                "bkn_id" => "A5EB03E20778F6A0E040640A040252AD",
                "nama" => "A-IV LISTRIK ARUS KUAT"),
            array(
                "bkn_id" => "A5EB03E20779F6A0E040640A040252AD",
                "nama" => "A-IV LISTRIK ARUS LEMAH"),
            array(
                "bkn_id" => "A5EB03E20768F6A0E040640A040252AD",
                "nama" => "A-IV MANAJEMEN"),
            array(
                "bkn_id" => "A5EB03E2065CF6A0E040640A040252AD",
                "nama" => "A-IV MATEMATIKA"),
            array(
                "bkn_id" => "A5EB03E2065DF6A0E040640A040252AD",
                "nama" => "A-IV MATEMATIKA DAN IPA"),
            array(
                "bkn_id" => "A5EB03E206B7F6A0E040640A040252AD",
                "nama" => "A-IV METODOLOGI & KURIKULUM"),
            array(
                "bkn_id" => "A5EB03E206B8F6A0E040640A040252AD",
                "nama" => "A-IV METODOLOGI PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20659F6A0E040640A040252AD",
                "nama" => "A-IV MIPA"),
            array(
                "bkn_id" => "A5EB03E206B9F6A0E040640A040252AD",
                "nama" => "A-IV OLAH RAGA"),
            array(
                "bkn_id" => "A5EB03E206BAF6A0E040640A040252AD",
                "nama" => "A-IV OLAH RAGA & KES."),
            array(
                "bkn_id" => "A5EB03E20667F6A0E040640A040252AD",
                "nama" => "A-IV PAEDAGOGIK"),
            array(
                "bkn_id" => "A5EB03E20764F6A0E040640A040252AD",
                "nama" => "A-IV PEND. MORAL PANCASIL"),
            array(
                "bkn_id" => "A5EB03E2084BF6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN AGAMA ISLAM"),
            array(
                "bkn_id" => "A5EB03E206BBF6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN AGAMA KRISTEN"),
            array(
                "bkn_id" => "A5EB03E206BCF6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN ANAK"),
            array(
                "bkn_id" => "A5EB03E20748F6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN BISNIS"),
            array(
                "bkn_id" => "A5EB03E2074AF6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN DASAR"),
            array(
                "bkn_id" => "A5EB03E2074BF6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN DASAR UMUM"),
            array(
                "bkn_id" => "A5EB03E2074CF6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN DUNIA USAHA"),
            array(
                "bkn_id" => "A5EB03E2074DF6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN GEOGRAFI"),
            array(
                "bkn_id" => "A5EB03E2074EF6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN GURU"),
            array(
                "bkn_id" => "A5EB03E20749F6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN GURU SD"),
            array(
                "bkn_id" => "A5EB03E2074FF6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN LUAR BIASA"),
            array(
                "bkn_id" => "A5EB03E20750F6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN LUAR SEK."),
            array(
                "bkn_id" => "A5EB03E20751F6A0E040640A040252AD",
                "nama" => "A-IV PENDIDIKAN MASYARAKAT"),
            array(
                "bkn_id" => "A5EB03E20752F6A0E040640A040252AD",
                "nama" => "A-IV PERENCANAAN PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2077AF6A0E040640A040252AD",
                "nama" => "A-IV PKK"),
            array(
                "bkn_id" => "A5EB03E20761F6A0E040640A040252AD",
                "nama" => "A-IV PKN DAN HUKUM"),
            array(
                "bkn_id" => "A5EB03E20762F6A0E040640A040252AD",
                "nama" => "A-IV PMP & KEWARGANEGARAAN"),
            array(
                "bkn_id" => "A5EB03E20753F6A0E040640A040252AD",
                "nama" => "A-IV PROGRAM GURU SPG"),
            array(
                "bkn_id" => "A5EB03E20754F6A0E040640A040252AD",
                "nama" => "A-IV PSIKOLOGI"),
            array(
                "bkn_id" => "A5EB03E20755F6A0E040640A040252AD",
                "nama" => "A-IV PSIKOLOGI PEND. & BI"),
            array(
                "bkn_id" => "A5EB03E20756F6A0E040640A040252AD",
                "nama" => "A-IV PSIKOLOGI PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20765F6A0E040640A040252AD",
                "nama" => "A-IV PSPB"),
            array(
                "bkn_id" => "A5EB03E205EFF6A0E040640A040252AD",
                "nama" => "A-IV SANDRATARI DAN MUSIK"),
            array(
                "bkn_id" => "A5EB03E20608F6A0E040640A040252AD",
                "nama" => "A-IV SASTRA ARAB"),
            array(
                "bkn_id" => "A5EB03E20600F6A0E040640A040252AD",
                "nama" => "A-IV SASTRA INDONESIA"),
            array(
                "bkn_id" => "A5EB03E2060BF6A0E040640A040252AD",
                "nama" => "A-IV SASTRA RUSIA"),
            array(
                "bkn_id" => "A5EB03E20766F6A0E040640A040252AD",
                "nama" => "A-IV SEJARAH"),
            array(
                "bkn_id" => "A5EB03E20767F6A0E040640A040252AD",
                "nama" => "A-IV SEJARAH & ANTROPOLOGI"),
            array(
                "bkn_id" => "A5EB03E20669F6A0E040640A040252AD",
                "nama" => "A-IV SEJARAH PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E205EEF6A0E040640A040252AD",
                "nama" => "A-IV SENI"),
            array(
                "bkn_id" => "A5EB03E205F0F6A0E040640A040252AD",
                "nama" => "A-IV SENI MUSIK"),
            array(
                "bkn_id" => "A5EB03E205F1F6A0E040640A040252AD",
                "nama" => "A-IV SENI RUPA & KERAJINAN"),
            array(
                "bkn_id" => "A5EB03E205F2F6A0E040640A040252AD",
                "nama" => "A-IV SENI TARI"),
            array(
                "bkn_id" => "A5EB03E20664F6A0E040640A040252AD",
                "nama" => "A-IV STATISTIK"),
            array(
                "bkn_id" => "A5EB03E2077EF6A0E040640A040252AD",
                "nama" => "A-IV TATA BOGA"),
            array(
                "bkn_id" => "A5EB03E205EAF6A0E040640A040252AD",
                "nama" => "A-IV TATA BUKU"),
            array(
                "bkn_id" => "A5EB03E2077FF6A0E040640A040252AD",
                "nama" => "A-IV TATA BUSANA"),
            array(
                "bkn_id" => "A5EB03E20780F6A0E040640A040252AD",
                "nama" => "A-IV TATA GRAHA"),
            array(
                "bkn_id" => "A5EB03E20763F6A0E040640A040252AD",
                "nama" => "A-IV TATA NEGARA"),
            array(
                "bkn_id" => "A5EB03E20781F6A0E040640A040252AD",
                "nama" => "A-IV TATA NIAGA"),
            array(
                "bkn_id" => "A5EB03E205E8F6A0E040640A040252AD",
                "nama" => "A-IV TATA PERKANTORAN"),
            array(
                "bkn_id" => "A5EB03E205E9F6A0E040640A040252AD",
                "nama" => "A-IV TATA PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E2076CF6A0E040640A040252AD",
                "nama" => "A-IV TEK.SIPIL BANGUNAN AIR"),
            array(
                "bkn_id" => "A5EB03E20769F6A0E040640A040252AD",
                "nama" => "A-IV TEKNIK"),
            array(
                "bkn_id" => "A5EB03E2076BF6A0E040640A040252AD",
                "nama" => "A-IV TEKNIK BANGUNAN"),
            array(
                "bkn_id" => "A5EB03E20774F6A0E040640A040252AD",
                "nama" => "A-IV TEKNIK ELEKTRO"),
            array(
                "bkn_id" => "A5EB03E20775F6A0E040640A040252AD",
                "nama" => "A-IV TEKNIK ELEKTRONIKA"),
            array(
                "bkn_id" => "A5EB03E20772F6A0E040640A040252AD",
                "nama" => "A-IV TEKNIK MEKANIK"),
            array(
                "bkn_id" => "A5EB03E2076EF6A0E040640A040252AD",
                "nama" => "A-IV TEKNIK MESIN"),
            array(
                "bkn_id" => "A5EB03E2076FF6A0E040640A040252AD",
                "nama" => "A-IV TEKNIK MESIN INDUKSI"),
            array(
                "bkn_id" => "A5EB03E20770F6A0E040640A040252AD",
                "nama" => "A-IV TEKNIK MESIN PRODUKSI"),
            array(
                "bkn_id" => "A5EB03E20771F6A0E040640A040252AD",
                "nama" => "A-IV TEKNIK OTOMOTIF"),
            array(
                "bkn_id" => "A5EB03E2076AF6A0E040640A040252AD",
                "nama" => "A-IV TEKNIK SIPIL"),
            array(
                "bkn_id" => "A5EB03E20614F6A0E040640A040252AD",
                "nama" => "A-V"),
            array(
                "bkn_id" => "A5EB03E206C6F6A0E040640A040252AD",
                "nama" => "A-V BAHASA"),
            array(
                "bkn_id" => "A5EB03E20688F6A0E040640A040252AD",
                "nama" => "A-V IPS"),
            array(
                "bkn_id" => "A5EB03E2068CF6A0E040640A040252AD",
                "nama" => "A-V ADM. KETERAMPILAN"),
            array(
                "bkn_id" => "A5EB03E2068DF6A0E040640A040252AD",
                "nama" => "A-V ADM. KETERAMPILAN JASA"),
            array(
                "bkn_id" => "A5EB03E20689F6A0E040640A040252AD",
                "nama" => "A-V ADM. PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2068EF6A0E040640A040252AD",
                "nama" => "A-V ADM. PERKANTORAN"),
            array(
                "bkn_id" => "A5EB03E2068FF6A0E040640A040252AD",
                "nama" => "A-V ADM. PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E2068AF6A0E040640A040252AD",
                "nama" => "A-V ADM.SUPERVISI PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2068BF6A0E040640A040252AD",
                "nama" => "A-V ADMINISTRASI SEKOLAH"),
            array(
                "bkn_id" => "A5EB03E207D1F6A0E040640A040252AD",
                "nama" => "A-V AKUNTANSI"),
            array(
                "bkn_id" => "A5EB03E2069EF6A0E040640A040252AD",
                "nama" => "A-V ARSITEKTUR"),
            array(
                "bkn_id" => "A5EB03E206D0F6A0E040640A040252AD",
                "nama" => "A-V BAHASA ARAB"),
            array(
                "bkn_id" => "A5EB03E206C9F6A0E040640A040252AD",
                "nama" => "A-V BAHASA DAN SASTRA"),
            array(
                "bkn_id" => "A5EB03E206D1F6A0E040640A040252AD",
                "nama" => "A-V BAHASA DAN SASTRA ARAB"),
            array(
                "bkn_id" => "A5EB03E206CCF6A0E040640A040252AD",
                "nama" => "A-V BAHASA DAN SASTRA JAWA"),
            array(
                "bkn_id" => "A5EB03E206C8F6A0E040640A040252AD",
                "nama" => "A-V BAHASA INDONESIA"),
            array(
                "bkn_id" => "A5EB03E206CDF6A0E040640A040252AD",
                "nama" => "A-V BAHASA JAWA"),
            array(
                "bkn_id" => "A5EB03E206D7F6A0E040640A040252AD",
                "nama" => "A-V BAHASA JEPANG"),
            array(
                "bkn_id" => "A5EB03E206D9F6A0E040640A040252AD",
                "nama" => "A-V BAHASA JERMAN"),
            array(
                "bkn_id" => "A5EB03E206DAF6A0E040640A040252AD",
                "nama" => "A-V BAHASA PERANCIS"),
            array(
                "bkn_id" => "A5EB03E206D3F6A0E040640A040252AD",
                "nama" => "A-V BAHASA RUSIA"),
            array(
                "bkn_id" => "A5EB03E206D4F6A0E040640A040252AD",
                "nama" => "A-V BHS DAN SAS. ASING"),
            array(
                "bkn_id" => "A5EB03E206CBF6A0E040640A040252AD",
                "nama" => "A-V BHS DAN SAS. DAERAH"),
            array(
                "bkn_id" => "A5EB03E206CAF6A0E040640A040252AD",
                "nama" => "A-V BHS DAN SAS. INDONESIA"),
            array(
                "bkn_id" => "A5EB03E206D5F6A0E040640A040252AD",
                "nama" => "A-V BHS DAN SAS. INGGRIS"),
            array(
                "bkn_id" => "A5EB03E206D6F6A0E040640A040252AD",
                "nama" => "A-V BHS DAN SAS. JEPANG"),
            array(
                "bkn_id" => "A5EB03E206D8F6A0E040640A040252AD",
                "nama" => "A-V BHS DAN SAS. JERMAN"),
            array(
                "bkn_id" => "A5EB03E206CEF6A0E040640A040252AD",
                "nama" => "A-V BHS DAN SAS. SUNDA"),
            array(
                "bkn_id" => "A5EB03E20616F6A0E040640A040252AD",
                "nama" => "A-V BIDANG KEPENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2061AF6A0E040640A040252AD",
                "nama" => "A-V BIMBINGAN & KONSELING"),
            array(
                "bkn_id" => "A5EB03E2061BF6A0E040640A040252AD",
                "nama" => "A-V BIMBINGAN & PENYULUHAN"),
            array(
                "bkn_id" => "A5EB03E20685F6A0E040640A040252AD",
                "nama" => "A-V BIOLOGI"),
            array(
                "bkn_id" => "A5EB03E206C0F6A0E040640A040252AD",
                "nama" => "A-V BISNIS TATA BUKU"),
            array(
                "bkn_id" => "A5EB03E206C1F6A0E040640A040252AD",
                "nama" => "A-V BISNIS VOKASIONAL"),
            array(
                "bkn_id" => "A5EB03E20690F6A0E040640A040252AD",
                "nama" => "A-V CIVICS HUKUM"),
            array(
                "bkn_id" => "A5EB03E20618F6A0E040640A040252AD",
                "nama" => "A-V DIDAKTIK"),
            array(
                "bkn_id" => "A5EB03E2061CF6A0E040640A040252AD",
                "nama" => "A-V DIK. & PENGEMB SOSIAL"),
            array(
                "bkn_id" => "A5EB03E206BEF6A0E040640A040252AD",
                "nama" => "A-V EKONOMI KOPERASI"),
            array(
                "bkn_id" => "A5EB03E206BDF6A0E040640A040252AD",
                "nama" => "A-V EKONOMI PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E206A4F6A0E040640A040252AD",
                "nama" => "A-V ELEKTRO"),
            array(
                "bkn_id" => "A5EB03E206A7F6A0E040640A040252AD",
                "nama" => "A-V ELEKTRO ARUS LEMAH"),
            array(
                "bkn_id" => "A5EB03E206C2F6A0E040640A040252AD",
                "nama" => "A-V FILSAFAT"),
            array(
                "bkn_id" => "A5EB03E206C3F6A0E040640A040252AD",
                "nama" => "A-V FILSAFAT KEBUDAYAAN"),
            array(
                "bkn_id" => "A5EB03E206C4F6A0E040640A040252AD",
                "nama" => "A-V FILSAFAT PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E206C5F6A0E040640A040252AD",
                "nama" => "A-V FILSAFAT SOSIOLOGI PEND."),
            array(
                "bkn_id" => "A5EB03E20682F6A0E040640A040252AD",
                "nama" => "A-V FISIKA"),
            array(
                "bkn_id" => "A5EB03E207D2F6A0E040640A040252AD",
                "nama" => "A-V HITUNG DAGANG"),
            array(
                "bkn_id" => "A5EB03E20691F6A0E040640A040252AD",
                "nama" => "A-V HUKUM PMP"),
            array(
                "bkn_id" => "A5EB03E20681F6A0E040640A040252AD",
                "nama" => "A-V IL.PENGETAHUAN ALAM"),
            array(
                "bkn_id" => "A5EB03E20684F6A0E040640A040252AD",
                "nama" => "A-V ILMU BUMI"),
            array(
                "bkn_id" => "A5EB03E207D3F6A0E040640A040252AD",
                "nama" => "A-V ILMU EKONOMI"),
            array(
                "bkn_id" => "A5EB03E20686F6A0E040640A040252AD",
                "nama" => "A-V ILMU HAYAT/BIOLOGI"),
            array(
                "bkn_id" => "A5EB03E2067EF6A0E040640A040252AD",
                "nama" => "A-V ILMU PASTI"),
            array(
                "bkn_id" => "A5EB03E2067DF6A0E040640A040252AD",
                "nama" => "A-V ILMU PASTI DAN ALAM"),
            array(
                "bkn_id" => "A5EB03E2061DF6A0E040640A040252AD",
                "nama" => "A-V KEGURUAN & ILMU SOSIAL"),
            array(
                "bkn_id" => "A5EB03E20615F6A0E040640A040252AD",
                "nama" => "A-V KEPENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E207C9F6A0E040640A040252AD",
                "nama" => "A-V KESEHATAN DAN REKREASI"),
            array(
                "bkn_id" => "A5EB03E207CAF6A0E040640A040252AD",
                "nama" => "A-V KESEJAHTERAAN KELUARGA"),
            array(
                "bkn_id" => "A5EB03E207CBF6A0E040640A040252AD",
                "nama" => "A-V KESEJAHTERAAN SOSIAL"),
            array(
                "bkn_id" => "A5EB03E206ACF6A0E040640A040252AD",
                "nama" => "A-V KETERAMPILAN"),
            array(
                "bkn_id" => "A5EB03E206ADF6A0E040640A040252AD",
                "nama" => "A-V KETERAMPILAN JASA"),
            array(
                "bkn_id" => "A5EB03E206AEF6A0E040640A040252AD",
                "nama" => "A-V KETERAMPILAN TEKNIK"),
            array(
                "bkn_id" => "A5EB03E20683F6A0E040640A040252AD",
                "nama" => "A-V KIMIA"),
            array(
                "bkn_id" => "A5EB03E206BFF6A0E040640A040252AD",
                "nama" => "A-V KOPERASI"),
            array(
                "bkn_id" => "A5EB03E2061EF6A0E040640A040252AD",
                "nama" => "A-V KUR.& TEK./PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2061FF6A0E040640A040252AD",
                "nama" => "A-V KURIK&PERSEK.AN/PENGAJ"),
            array(
                "bkn_id" => "A5EB03E20620F6A0E040640A040252AD",
                "nama" => "A-V KURIKULUM PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20621F6A0E040640A040252AD",
                "nama" => "A-V KURIKULUM PENYULUHAN"),
            array(
                "bkn_id" => "A5EB03E20622F6A0E040640A040252AD",
                "nama" => "A-V KURTEK PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E206A8F6A0E040640A040252AD",
                "nama" => "A-V LISTRIK"),
            array(
                "bkn_id" => "A5EB03E206A9F6A0E040640A040252AD",
                "nama" => "A-V LISTRIK ARUS KUAT"),
            array(
                "bkn_id" => "A5EB03E206AAF6A0E040640A040252AD",
                "nama" => "A-V LISTRIK ARUS LEMAH"),
            array(
                "bkn_id" => "A5EB03E20699F6A0E040640A040252AD",
                "nama" => "A-V MANAJEMEN"),
            array(
                "bkn_id" => "A5EB03E2067FF6A0E040640A040252AD",
                "nama" => "A-V MATEMATIKA"),
            array(
                "bkn_id" => "A5EB03E20680F6A0E040640A040252AD",
                "nama" => "A-V MATEMATIKA DAN IPA"),
            array(
                "bkn_id" => "A5EB03E20623F6A0E040640A040252AD",
                "nama" => "A-V METODOLOGI & KURIKULUM"),
            array(
                "bkn_id" => "A5EB03E20624F6A0E040640A040252AD",
                "nama" => "A-V METODOLOGI PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E2067CF6A0E040640A040252AD",
                "nama" => "A-V MIPA"),
            array(
                "bkn_id" => "A5EB03E20625F6A0E040640A040252AD",
                "nama" => "A-V OLAH RAGA"),
            array(
                "bkn_id" => "A5EB03E20626F6A0E040640A040252AD",
                "nama" => "A-V OLAH RAGA & KES."),
            array(
                "bkn_id" => "A5EB03E20617F6A0E040640A040252AD",
                "nama" => "A-V PAEDAGOGIK"),
            array(
                "bkn_id" => "A5EB03E20695F6A0E040640A040252AD",
                "nama" => "A-V PEND. MORAL PANCASIL"),
            array(
                "bkn_id" => "A5EB03E20627F6A0E040640A040252AD",
                "nama" => "A-V PENDIDIKAN AGM.KRISTEN"),
            array(
                "bkn_id" => "A5EB03E20628F6A0E040640A040252AD",
                "nama" => "A-V PENDIDIKAN ANAK"),
            array(
                "bkn_id" => "A5EB03E20629F6A0E040640A040252AD",
                "nama" => "A-V PENDIDIKAN BISNIS"),
            array(
                "bkn_id" => "A5EB03E2062BF6A0E040640A040252AD",
                "nama" => "A-V PENDIDIKAN DASAR"),
            array(
                "bkn_id" => "A5EB03E20670F6A0E040640A040252AD",
                "nama" => "A-V PENDIDIKAN DASAR UMUM"),
            array(
                "bkn_id" => "A5EB03E20671F6A0E040640A040252AD",
                "nama" => "A-V PENDIDIKAN DUNIA USAHA"),
            array(
                "bkn_id" => "A5EB03E20672F6A0E040640A040252AD",
                "nama" => "A-V PENDIDIKAN GEOGRAFI"),
            array(
                "bkn_id" => "A5EB03E20673F6A0E040640A040252AD",
                "nama" => "A-V PENDIDIKAN GURU"),
            array(
                "bkn_id" => "A5EB03E2062AF6A0E040640A040252AD",
                "nama" => "A-V PENDIDIKAN GURU SD"),
            array(
                "bkn_id" => "A5EB03E20674F6A0E040640A040252AD",
                "nama" => "A-V PENDIDIKAN LUAR BIASA"),
            array(
                "bkn_id" => "A5EB03E20675F6A0E040640A040252AD",
                "nama" => "A-V PENDIDIKAN LUAR SEK."),
            array(
                "bkn_id" => "A5EB03E20676F6A0E040640A040252AD",
                "nama" => "A-V PENDIDIKAN MASYARAKAT"),
            array(
                "bkn_id" => "A5EB03E20677F6A0E040640A040252AD",
                "nama" => "A-V PERENCANAAN PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E206ABF6A0E040640A040252AD",
                "nama" => "A-V PKK"),
            array(
                "bkn_id" => "A5EB03E20692F6A0E040640A040252AD",
                "nama" => "A-V PKN DAN HUKUM"),
            array(
                "bkn_id" => "A5EB03E20693F6A0E040640A040252AD",
                "nama" => "A-V PMP & KEWARGANEGARAAN"),
            array(
                "bkn_id" => "A5EB03E20678F6A0E040640A040252AD",
                "nama" => "A-V PROGRAM GURU SPG"),
            array(
                "bkn_id" => "A5EB03E20679F6A0E040640A040252AD",
                "nama" => "A-V PSIKOLOGI"),
            array(
                "bkn_id" => "A5EB03E2067AF6A0E040640A040252AD",
                "nama" => "A-V PSIKOLOGI PEND. & BI"),
            array(
                "bkn_id" => "A5EB03E2067BF6A0E040640A040252AD",
                "nama" => "A-V PSIKOLOGI PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E20696F6A0E040640A040252AD",
                "nama" => "A-V PSPB"),
            array(
                "bkn_id" => "A5EB03E207CDF6A0E040640A040252AD",
                "nama" => "A-V SANDRATARI DAN MUSIK"),
            array(
                "bkn_id" => "A5EB03E206CFF6A0E040640A040252AD",
                "nama" => "A-V SASTRA ARAB"),
            array(
                "bkn_id" => "A5EB03E206C7F6A0E040640A040252AD",
                "nama" => "A-V SASTRA INDONESIA"),
            array(
                "bkn_id" => "A5EB03E206D2F6A0E040640A040252AD",
                "nama" => "A-V SASTRA RUSIA"),
            array(
                "bkn_id" => "A5EB03E20697F6A0E040640A040252AD",
                "nama" => "A-V SEJARAH"),
            array(
                "bkn_id" => "A5EB03E20698F6A0E040640A040252AD",
                "nama" => "A-V SEJARAH & ANTROPOLOGI"),
            array(
                "bkn_id" => "A5EB03E20619F6A0E040640A040252AD",
                "nama" => "A-V SEJARAH PENDIDIKAN"),
            array(
                "bkn_id" => "A5EB03E207CCF6A0E040640A040252AD",
                "nama" => "A-V SENI"),
            array(
                "bkn_id" => "A5EB03E207CEF6A0E040640A040252AD",
                "nama" => "A-V SENI MUSIK"),
            array(
                "bkn_id" => "A5EB03E207CFF6A0E040640A040252AD",
                "nama" => "A-V SENI RUPA & KERAJINAN"),
            array(
                "bkn_id" => "A5EB03E207D0F6A0E040640A040252AD",
                "nama" => "A-V SENI TARI"),
            array(
                "bkn_id" => "A5EB03E20687F6A0E040640A040252AD",
                "nama" => "A-V STATISTIK"),
            array(
                "bkn_id" => "A5EB03E206AFF6A0E040640A040252AD",
                "nama" => "A-V TATA BOGA"),
            array(
                "bkn_id" => "A5EB03E207C8F6A0E040640A040252AD",
                "nama" => "A-V TATA BUKU"),
            array(
                "bkn_id" => "A5EB03E206B0F6A0E040640A040252AD",
                "nama" => "A-V TATA BUSANA"),
            array(
                "bkn_id" => "A5EB03E206B1F6A0E040640A040252AD",
                "nama" => "A-V TATA GRAHA"),
            array(
                "bkn_id" => "A5EB03E20694F6A0E040640A040252AD",
                "nama" => "A-V TATA NEGARA"),
            array(
                "bkn_id" => "A5EB03E206B2F6A0E040640A040252AD",
                "nama" => "A-V TATA NIAGA"),
            array(
                "bkn_id" => "A5EB03E206B3F6A0E040640A040252AD",
                "nama" => "A-V TATA PERKANTORAN"),
            array(
                "bkn_id" => "A5EB03E207C7F6A0E040640A040252AD",
                "nama" => "A-V TATA PERUSAHAAN"),
            array(
                "bkn_id" => "A5EB03E2069DF6A0E040640A040252AD",
                "nama" => "A-V TEK.SIPIL BANGUNAN AIR"),
            array(
                "bkn_id" => "A5EB03E2069AF6A0E040640A040252AD",
                "nama" => "A-V TEKNIK"),
            array(
                "bkn_id" => "A5EB03E2069CF6A0E040640A040252AD",
                "nama" => "A-V TEKNIK BANGUNAN"),
            array(
                "bkn_id" => "A5EB03E206A5F6A0E040640A040252AD",
                "nama" => "A-V TEKNIK ELEKTRO"),
            array(
                "bkn_id" => "A5EB03E206A6F6A0E040640A040252AD",
                "nama" => "A-V TEKNIK ELEKTRONIKA"),
            array(
                "bkn_id" => "A5EB03E206A3F6A0E040640A040252AD",
                "nama" => "A-V TEKNIK MEKANIK"),
            array(
                "bkn_id" => "A5EB03E2069FF6A0E040640A040252AD",
                "nama" => "A-V TEKNIK MESIN"),
            array(
                "bkn_id" => "A5EB03E206A0F6A0E040640A040252AD",
                "nama" => "A-V TEKNIK MESIN INDUKSI"),
            array(
                "bkn_id" => "A5EB03E206A1F6A0E040640A040252AD",
                "nama" => "A-V TEKNIK MESIN PRODUKSI"),
            array(
                "bkn_id" => "A5EB03E206A2F6A0E040640A040252AD",
                "nama" => "A-V TEKNIK OTOMOTIF"),
            array(
                "bkn_id" => "A5EB03E2069BF6A0E040640A040252AD",
                "nama" => "A-V TEKNIK SIPIL"),
            array(
                "bkn_id" => "A5EB03E20845F6A0E040640A040252AD",
                "nama" => "APOTEKER"),
            array(
                "bkn_id" => "A5EB03E20848F6A0E040640A040252AD",
                "nama" => "NOTARIS"),
            array(
                "bkn_id" => "A5EB03E20849F6A0E040640A040252AD",
                "nama" => "PENGACARA"),
            array(
                "bkn_id" => "A5EB03E20847F6A0E040640A040252AD",
                "nama" => "PSIKIATER"),
            array(
                "bkn_id" => "A5EB03E20846F6A0E040640A040252AD",
                "nama" => "PSIKOLOG"),
            array(
                "bkn_id" => "A5EB03E207C6F6A0E040640A040252AD",
                "nama" => "SERTIFIKASI GURU"),
            array(
                "bkn_id" => "A5EB03E206DBF6A0E040640A040252AD",
                "nama" => "SPESIALIS I"),
            array(
                "bkn_id" => "A5EB03E206DCF6A0E040640A040252AD",
                "nama" => "SPESIALIS I ANAK"),
            array(
                "bkn_id" => "A5EB03E206DDF6A0E040640A040252AD",
                "nama" => "SPESIALIS I ANESTESI"),
            array(
                "bkn_id" => "A5EB03E206DEF6A0E040640A040252AD",
                "nama" => "SPESIALIS I BEDAH"),
            array(
                "bkn_id" => "A5EB03E206DFF6A0E040640A040252AD",
                "nama" => "SPESIALIS I BEDAH MULUT"),
            array(
                "bkn_id" => "A5EB03E206E0F6A0E040640A040252AD",
                "nama" => "SPESIALIS I BEDAH PLASTIK"),
            array(
                "bkn_id" => "A5EB03E206E1F6A0E040640A040252AD",
                "nama" => "SPESIALIS I FARMAKOLOGI"),
            array(
                "bkn_id" => "A5EB03E206E2F6A0E040640A040252AD",
                "nama" => "SPESIALIS I FARMASI APOTEKER"),
            array(
                "bkn_id" => "A5EB03E206E3F6A0E040640A040252AD",
                "nama" => "SPESIALIS I FISIO TERAPI"),
            array(
                "bkn_id" => "A5EB03E206E4F6A0E040640A040252AD",
                "nama" => "SPESIALIS I ILMU KEDOKTERAN FORENS"),
            array(
                "bkn_id" => "A5EB03E206E5F6A0E040640A040252AD",
                "nama" => "SPESIALIS I ILMU KEDOKTERAN JIWA"),
            array(
                "bkn_id" => "A5EB03E206E6F6A0E040640A040252AD",
                "nama" => "SPESIALIS I ILMU KEDOKTERAN KEHAKI"),
            array(
                "bkn_id" => "A5EB03E206E7F6A0E040640A040252AD",
                "nama" => "SPESIALIS I JANTUNG"),
            array(
                "bkn_id" => "A5EB03E206E8F6A0E040640A040252AD",
                "nama" => "SPESIALIS I KANDUNGAN"),
            array(
                "bkn_id" => "A5EB03E206E9F6A0E040640A040252AD",
                "nama" => "SPESIALIS I KEDOKTERAN GIGI"),
            array(
                "bkn_id" => "A5EB03E206EAF6A0E040640A040252AD",
                "nama" => "SPESIALIS I KEDOKTERAN OLAHRAGA"),
            array(
                "bkn_id" => "A5EB03E206EBF6A0E040640A040252AD",
                "nama" => "SPESIALIS I KESEHATAN ANAK"),
            array(
                "bkn_id" => "A5EB03E206ECF6A0E040640A040252AD",
                "nama" => "SPESIALIS I KESEHATAN GIGI ANAK"),
            array(
                "bkn_id" => "A5EB03E206EDF6A0E040640A040252AD",
                "nama" => "SPESIALIS I KONSERVASI GIGI"),
            array(
                "bkn_id" => "A5EB03E206EEF6A0E040640A040252AD",
                "nama" => "SPESIALIS I KULIT DAN KELAMIN"),
            array(
                "bkn_id" => "A5EB03E206EFF6A0E040640A040252AD",
                "nama" => "SPESIALIS I LABORAN"),
            array(
                "bkn_id" => "A5EB03E206F0F6A0E040640A040252AD",
                "nama" => "SPESIALIS I MATA"),
            array(
                "bkn_id" => "A5EB03E206F1F6A0E040640A040252AD",
                "nama" => "SPESIALIS I MICROBIOLGI"),
            array(
                "bkn_id" => "A5EB03E206F2F6A0E040640A040252AD",
                "nama" => "SPESIALIS I MIKROKLINIK"),
            array(
                "bkn_id" => "A5EB03E20807F6A0E040640A040252AD",
                "nama" => "SPESIALIS I OBSTETRI/GINEKOLOG"),
            array(
                "bkn_id" => "A5EB03E20808F6A0E040640A040252AD",
                "nama" => "SPESIALIS I ORTODONSIA"),
            array(
                "bkn_id" => "A5EB03E20809F6A0E040640A040252AD",
                "nama" => "SPESIALIS I ORTOPEDI"),
            array(
                "bkn_id" => "A5EB03E2080AF6A0E040640A040252AD",
                "nama" => "SPESIALIS I PARASITOLOG"),
            array(
                "bkn_id" => "A5EB03E2080BF6A0E040640A040252AD",
                "nama" => "SPESIALIS I PATHOLOGI"),
            array(
                "bkn_id" => "A5EB03E2080CF6A0E040640A040252AD",
                "nama" => "SPESIALIS I PATHOLOGI ANATOMI"),
            array(
                "bkn_id" => "A5EB03E2080DF6A0E040640A040252AD",
                "nama" => "SPESIALIS I PENGEMB. SUMBER DAYA AIR"),
            array(
                "bkn_id" => "A5EB03E2080EF6A0E040640A040252AD",
                "nama" => "SPESIALIS I PENYAKIT DALAM"),
            array(
                "bkn_id" => "A5EB03E2080FF6A0E040640A040252AD",
                "nama" => "SPESIALIS I PENYAKIT MULUT"),
            array(
                "bkn_id" => "A5EB03E20810F6A0E040640A040252AD",
                "nama" => "SPESIALIS I PENYAKIT PARU"),
            array(
                "bkn_id" => "A5EB03E20811F6A0E040640A040252AD",
                "nama" => "SPESIALIS I PERIODONSI"),
            array(
                "bkn_id" => "A5EB03E20812F6A0E040640A040252AD",
                "nama" => "SPESIALIS I PERJAMAHAN"),
            array(
                "bkn_id" => "A5EB03E20813F6A0E040640A040252AD",
                "nama" => "SPESIALIS I PROSTODONSIA"),
            array(
                "bkn_id" => "A5EB03E20814F6A0E040640A040252AD",
                "nama" => "SPESIALIS I PSIKIATRI"),
            array(
                "bkn_id" => "A5EB03E20815F6A0E040640A040252AD",
                "nama" => "SPESIALIS I RADIOLOGI"),
            array(
                "bkn_id" => "A5EB03E20816F6A0E040640A040252AD",
                "nama" => "SPESIALIS I REHABILITASI MEDIK"),
            array(
                "bkn_id" => "A5EB03E20817F6A0E040640A040252AD",
                "nama" => "SPESIALIS I SARAF"),
            array(
                "bkn_id" => "A5EB03E20818F6A0E040640A040252AD",
                "nama" => "SPESIALIS I THT"),
            array(
                "bkn_id" => "A5EB03E20819F6A0E040640A040252AD",
                "nama" => "SPESIALIS I UROLOG"),
            array(
                "bkn_id" => "A5EB03E2081AF6A0E040640A040252AD",
                "nama" => "SPESIALIS II"),
            array(
                "bkn_id" => "A5EB03E2081BF6A0E040640A040252AD",
                "nama" => "SPESIALIS II ANAK"),
            array(
                "bkn_id" => "A5EB03E2081CF6A0E040640A040252AD",
                "nama" => "SPESIALIS II ANESTESI"),
            array(
                "bkn_id" => "A5EB03E2081DF6A0E040640A040252AD",
                "nama" => "SPESIALIS II BEDAH"),
            array(
                "bkn_id" => "A5EB03E2081EF6A0E040640A040252AD",
                "nama" => "SPESIALIS II BEDAH MULUT"),
            array(
                "bkn_id" => "A5EB03E2081FF6A0E040640A040252AD",
                "nama" => "SPESIALIS II BEDAH PLASTIK"),
            array(
                "bkn_id" => "A5EB03E20820F6A0E040640A040252AD",
                "nama" => "SPESIALIS II FARMAKOLOGI"),
            array(
                "bkn_id" => "A5EB03E20821F6A0E040640A040252AD",
                "nama" => "SPESIALIS II FARMASI APOTEKER"),
            array(
                "bkn_id" => "A5EB03E20822F6A0E040640A040252AD",
                "nama" => "SPESIALIS II FISIO TERAPI"),
            array(
                "bkn_id" => "A5EB03E20823F6A0E040640A040252AD",
                "nama" => "SPESIALIS II ILMU KEDOKTERAN FOREN"),
            array(
                "bkn_id" => "A5EB03E20824F6A0E040640A040252AD",
                "nama" => "SPESIALIS II ILMU KEDOKTERAN JIWA"),
            array(
                "bkn_id" => "A5EB03E20825F6A0E040640A040252AD",
                "nama" => "SPESIALIS II ILMU KEDOKTERAN KEHAK"),
            array(
                "bkn_id" => "A5EB03E20826F6A0E040640A040252AD",
                "nama" => "SPESIALIS II JANTUNG"),
            array(
                "bkn_id" => "A5EB03E20827F6A0E040640A040252AD",
                "nama" => "SPESIALIS II KANDUNGAN"),
            array(
                "bkn_id" => "A5EB03E20828F6A0E040640A040252AD",
                "nama" => "SPESIALIS II KEDOKTERAN GIGI"),
            array(
                "bkn_id" => "A5EB03E20829F6A0E040640A040252AD",
                "nama" => "SPESIALIS II KEDOKTERAN OLAHRAGA"),
            array(
                "bkn_id" => "A5EB03E2082AF6A0E040640A040252AD",
                "nama" => "SPESIALIS II KESEHATAN ANAK"),
            array(
                "bkn_id" => "A5EB03E2082BF6A0E040640A040252AD",
                "nama" => "SPESIALIS II KESEHATAN GIGI ANAK"),
            array(
                "bkn_id" => "A5EB03E2082CF6A0E040640A040252AD",
                "nama" => "SPESIALIS II KONSERVASI GIGI"),
            array(
                "bkn_id" => "A5EB03E2082DF6A0E040640A040252AD",
                "nama" => "SPESIALIS II KULIT DAN KELAMIN"),
            array(
                "bkn_id" => "A5EB03E2082EF6A0E040640A040252AD",
                "nama" => "SPESIALIS II LABORAN"),
            array(
                "bkn_id" => "A5EB03E2082FF6A0E040640A040252AD",
                "nama" => "SPESIALIS II MATA"),
            array(
                "bkn_id" => "A5EB03E20830F6A0E040640A040252AD",
                "nama" => "SPESIALIS II MICROBIOLGI"),
            array(
                "bkn_id" => "A5EB03E20831F6A0E040640A040252AD",
                "nama" => "SPESIALIS II MIKROKLINIK"),
            array(
                "bkn_id" => "A5EB03E20832F6A0E040640A040252AD",
                "nama" => "SPESIALIS II OBSTETRI/GINEKOLOG"),
            array(
                "bkn_id" => "A5EB03E20833F6A0E040640A040252AD",
                "nama" => "SPESIALIS II ORTODONSIA"),
            array(
                "bkn_id" => "A5EB03E20834F6A0E040640A040252AD",
                "nama" => "SPESIALIS II ORTOPEDI"),
            array(
                "bkn_id" => "A5EB03E20835F6A0E040640A040252AD",
                "nama" => "SPESIALIS II PARASITOLOG"),
            array(
                "bkn_id" => "A5EB03E20836F6A0E040640A040252AD",
                "nama" => "SPESIALIS II PATHOLOGI"),
            array(
                "bkn_id" => "A5EB03E20837F6A0E040640A040252AD",
                "nama" => "SPESIALIS II PATHOLOGI ANATOMI"),
            array(
                "bkn_id" => "A5EB03E20838F6A0E040640A040252AD",
                "nama" => "SPESIALIS II PENGEMB. SUMBER DAYA AIR"),
            array(
                "bkn_id" => "A5EB03E20839F6A0E040640A040252AD",
                "nama" => "SPESIALIS II PENYAKIT DALAM"),
            array(
                "bkn_id" => "A5EB03E2083AF6A0E040640A040252AD",
                "nama" => "SPESIALIS II PENYAKIT MULUT"),
            array(
                "bkn_id" => "A5EB03E2083BF6A0E040640A040252AD",
                "nama" => "SPESIALIS II PENYAKIT PARU"),
            array(
                "bkn_id" => "A5EB03E2083CF6A0E040640A040252AD",
                "nama" => "SPESIALIS II PERIODONSI"),
            array(
                "bkn_id" => "A5EB03E2083DF6A0E040640A040252AD",
                "nama" => "SPESIALIS II PERJAMAHAN"),
            array(
                "bkn_id" => "A5EB03E2083EF6A0E040640A040252AD",
                "nama" => "SPESIALIS II PROSTODONSIA"),
            array(
                "bkn_id" => "A5EB03E2083FF6A0E040640A040252AD",
                "nama" => "SPESIALIS II PSIKIATRI"),
            array(
                "bkn_id" => "A5EB03E20840F6A0E040640A040252AD",
                "nama" => "SPESIALIS II RADIOLOGI"),
            array(
                "bkn_id" => "A5EB03E20841F6A0E040640A040252AD",
                "nama" => "SPESIALIS II REHABILITASI MEDIK"),
            array(
                "bkn_id" => "A5EB03E20842F6A0E040640A040252AD",
                "nama" => "SPESIALIS II SARAF"),
            array(
                "bkn_id" => "A5EB03E20843F6A0E040640A040252AD",
                "nama" => "SPESIALIS II THT"),
            array(
                "bkn_id" => "A5EB03E20844F6A0E040640A040252AD",
                "nama" => "SPESIALIS II UROLOG")
        );
        foreach ($profesi as $data)
        {
            {
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                DB::table('profesi')->insert($data);
            }
        }

    }
}
