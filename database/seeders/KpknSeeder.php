<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KpknSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kpkn = array(
            array(
                "bkn_id" => "A5EB03E21CE6F6A0E040640A040252AD",
                "nama" => "TASIKMALAYA"),
            array(
                "bkn_id" => "A5EB03E21CE7F6A0E040640A040252AD",
                "nama" => "GARUT"),
            array(
                "bkn_id" => "A5EB03E21CE8F6A0E040640A040252AD",
                "nama" => "YOGYAKARTA"),
            array(
                "bkn_id" => "A5EB03E21CE9F6A0E040640A040252AD",
                "nama" => "WONOSARI"),
            array(
                "bkn_id" => "A5EB03E21CEAF6A0E040640A040252AD",
                "nama" => "SEMARANG I"),
            array(
                "bkn_id" => "A5EB03E21CEBF6A0E040640A040252AD",
                "nama" => "SEMARANG II"),
            array(
                "bkn_id" => "A5EB03E21CECF6A0E040640A040252AD",
                "nama" => "PEKALONGAN"),
            array(
                "bkn_id" => "A5EB03E21CEDF6A0E040640A040252AD",
                "nama" => "TEGAL"),
            array(
                "bkn_id" => "A5EB03E21CEEF6A0E040640A040252AD",
                "nama" => "MAGELANG"),
            array(
                "bkn_id" => "A5EB03E21CEFF6A0E040640A040252AD",
                "nama" => "SURAKARTA"),
            array(
                "bkn_id" => "A5EB03E21CF0F6A0E040640A040252AD",
                "nama" => "PATI"),
            array(
                "bkn_id" => "A5EB03E21CF1F6A0E040640A040252AD",
                "nama" => "KUDUS"),
            array(
                "bkn_id" => "A5EB03E21CF2F6A0E040640A040252AD",
                "nama" => "PURWOKERTO"),
            array(
                "bkn_id" => "A5EB03E21CF3F6A0E040640A040252AD",
                "nama" => "CILACAP"),
            array(
                "bkn_id" => "A5EB03E21CF4F6A0E040640A040252AD",
                "nama" => "PURWOREJO"),
            array(
                "bkn_id" => "A5EB03E21CF5F6A0E040640A040252AD",
                "nama" => "SURABAYA I"),
            array(
                "bkn_id" => "A5EB03E21CF6F6A0E040640A040252AD",
                "nama" => "MOJOKERTO"),
            array(
                "bkn_id" => "A5EB03E21CF7F6A0E040640A040252AD",
                "nama" => "MALANG"),
            array(
                "bkn_id" => "A5EB03E21CF8F6A0E040640A040252AD",
                "nama" => "KEDIRI"),
            array(
                "bkn_id" => "A5EB03E21CF9F6A0E040640A040252AD",
                "nama" => "MADIUN"),
            array(
                "bkn_id" => "A5EB03E21CFAF6A0E040640A040252AD",
                "nama" => "PAMEKASAN"),
            array(
                "bkn_id" => "A5EB03E21CFBF6A0E040640A040252AD",
                "nama" => "BONDOWOSO"),
            array(
                "bkn_id" => "A5EB03E21CFCF6A0E040640A040252AD",
                "nama" => "BANYUWANGI"),
            array(
                "bkn_id" => "A5EB03E21CFDF6A0E040640A040252AD",
                "nama" => "KASDA KAB. JEMBER"),
            array(
                "bkn_id" => "A5EB03E21CFFF6A0E040640A040252AD",
                "nama" => "BOJONEGORO"),
            array(
                "bkn_id" => "A5EB03E21D00F6A0E040640A040252AD",
                "nama" => "SURABAYA II"),
            array(
                "bkn_id" => "A5EB03E21D01F6A0E040640A040252AD",
                "nama" => "PONTIANAK"),
            array(
                "bkn_id" => "A5EB03E21D02F6A0E040640A040252AD",
                "nama" => "SINGKAWANG"),
            array(
                "bkn_id" => "A5EB03E21D03F6A0E040640A040252AD",
                "nama" => "KETAPANG"),
            array(
                "bkn_id" => "A5EB03E21D04F6A0E040640A040252AD",
                "nama" => "SINTANG"),
            array(
                "bkn_id" => "A5EB03E21D06F6A0E040640A040252AD",
                "nama" => "PALANGKARAYA"),
            array(
                "bkn_id" => "A5EB03E21D07F6A0E040640A040252AD",
                "nama" => "PANGKALAN BUN"),
            array(
                "bkn_id" => "A5EB03E21D08F6A0E040640A040252AD",
                "nama" => "SAMPIT"),
            array(
                "bkn_id" => "A5EB03E21D09F6A0E040640A040252AD",
                "nama" => "BUNTOK"),
            array(
                "bkn_id" => "A5EB03E21D0AF6A0E040640A040252AD",
                "nama" => "BANJARMASIN"),
            array(
                "bkn_id" => "A5EB03E21DFAF6A0E040640A040252AD",
                "nama" => "LANTAMAL BITUNG"),
            array(
                "bkn_id" => "A5EB03E21DFBF6A0E040640A040252AD",
                "nama" => "LANUDAL JUANDA"),
            array(
                "bkn_id" => "A5EB03E21DFCF6A0E040640A040252AD",
                "nama" => "SIONAL KUPANG"),
            array(
                "bkn_id" => "A5EB03E21DFDF6A0E040640A040252AD",
                "nama" => "SIONAL SEMARANG"),
            array(
                "bkn_id" => "A5EB03E21DFEF6A0E040640A040252AD",
                "nama" => "MAKO ARMATIM"),
            array(
                "bkn_id" => "A5EB03E21DFFF6A0E040640A040252AD",
                "nama" => "SIONAL BALIKPAPAN"),
            array(
                "bkn_id" => "A5EB03E21E00F6A0E040640A040252AD",
                "nama" => "SIONAL TARAKAN"),
            array(
                "bkn_id" => "A5EB03E21E01F6A0E040640A040252AD",
                "nama" => "AMUNTAI"),
            array(
                "bkn_id" => "A5EB03E21E02F6A0E040640A040252AD",
                "nama" => "SINJAI"),
            array(
                "bkn_id" => "A5EB03E21E03F6A0E040640A040252AD",
                "nama" => "BATUSANGKAR"),
            array(
                "bkn_id" => "A5EB03E21E04F6A0E040640A040252AD",
                "nama" => "WONOSOBO"),
            array(
                "bkn_id" => "A5EB03E21E05F6A0E040640A040252AD",
                "nama" => "KAIMANA"),
            array(
                "bkn_id" => "A5EB03E21E06F6A0E040640A040252AD",
                "nama" => "MARISA"),
            array(
                "bkn_id" => "A5EB03E21E07F6A0E040640A040252AD",
                "nama" => "01 KU POLDA JATIM"),
            array(
                "bkn_id" => "A5EB03E21E08F6A0E040640A040252AD",
                "nama" => "02 KU POLDA JATIM"),
            array(
                "bkn_id" => "A5EB03E21E09F6A0E040640A040252AD",
                "nama" => "03 KU POLDA JATIM"),
            array(
                "bkn_id" => "A5EB03E21E0AF6A0E040640A040252AD",
                "nama" => "04 KU POLDA JATIM"),
            array(
                "bkn_id" => "A5EB03E21E0BF6A0E040640A040252AD",
                "nama" => "05 KU POLDA JATIM"),
            array(
                "bkn_id" => "A5EB03E21E0CF6A0E040640A040252AD",
                "nama" => "06 KU POLDA JATIM"),
            array(
                "bkn_id" => "A5EB03E21E0DF6A0E040640A040252AD",
                "nama" => "07 KU POLDA JATIM"),
            array(
                "bkn_id" => "A5EB03E21E0FF6A0E040640A040252AD",
                "nama" => "09 KU POLDA JATIM"),
            array(
                "bkn_id" => "A5EB03E21E10F6A0E040640A040252AD",
                "nama" => "01 KU POLDA NUSRA"),
            array(
                "bkn_id" => "A5EB03E21E11F6A0E040640A040252AD",
                "nama" => "02 KU POLDA NUSRA"),
            array(
                "bkn_id" => "A5EB03E21E13F6A0E040640A040252AD",
                "nama" => "04 KU POLDA NUSRA"),
            array(
                "bkn_id" => "A5EB03E21E14F6A0E040640A040252AD",
                "nama" => "05 KU POLDA NUSRA"),
            array(
                "bkn_id" => "A5EB03E21E15F6A0E040640A040252AD",
                "nama" => "06 KU POLDA NUSRA"),
            array(
                "bkn_id" => "A5EB03E21E16F6A0E040640A040252AD",
                "nama" => "07 KU POLDA NUSRA"),
            array(
                "bkn_id" => "A5EB03E21E18F6A0E040640A040252AD",
                "nama" => "02 KU POLDA KALTIM"),
            array(
                "bkn_id" => "A5EB03E21E19F6A0E040640A040252AD",
                "nama" => "01 KU POLDA KALSELTENG"),
            array(
                "bkn_id" => "A5EB03E21E1AF6A0E040640A040252AD",
                "nama" => "02 KU POLDA KALSELTENG"),
            array(
                "bkn_id" => "A5EB03E21E1CF6A0E040640A040252AD",
                "nama" => "01 KU POLDA SULSELTRA"),
            array(
                "bkn_id" => "A5EB03E21E1DF6A0E040640A040252AD",
                "nama" => "02 KU POLDA SULSELTRA"),
            array(
                "bkn_id" => "A5EB03E21E1EF6A0E040640A040252AD",
                "nama" => "SEKAYU"),
            array(
                "bkn_id" => "A5EB03E21E1FF6A0E040640A040252AD",
                "nama" => "KOLAKA"),
            array(
                "bkn_id" => "A5EB03E21E20F6A0E040640A040252AD",
                "nama" => "KLATEN"),
            array(
                "bkn_id" => "A5EB03E21E21F6A0E040640A040252AD",
                "nama" => "KUNINGAN"),
            array(
                "bkn_id" => "A5EB03E21E22F6A0E040640A040252AD",
                "nama" => "03 KU POLDA SULSELTRA"),
            array(
                "bkn_id" => "A5EB03E21E24F6A0E040640A040252AD",
                "nama" => "05 KU POLDA SULSELTRA"),
            array(
                "bkn_id" => "A5EB03E21E25F6A0E040640A040252AD",
                "nama" => "01 KU POLDA SULUTTENG"),
            array(
                "bkn_id" => "A5EB03E21E26F6A0E040640A040252AD",
                "nama" => "02 KU POLDA SULUTTENG"),
            array(
                "bkn_id" => "A5EB03E21E28F6A0E040640A040252AD",
                "nama" => "01 KU POLDA MALUKU"),
            array(
                "bkn_id" => "A5EB03E21E29F6A0E040640A040252AD",
                "nama" => "02 KU POLDA MALUKU"),
            array(
                "bkn_id" => "A5EB03E21E2AF6A0E040640A040252AD",
                "nama" => "01 KU POLDA PAPUA"),
            array(
                "bkn_id" => "A5EB03E21E2BF6A0E040640A040252AD",
                "nama" => "02 KU POLDA PAPUA"),
            array(
                "bkn_id" => "A5EB03E21E2DF6A0E040640A040252AD",
                "nama" => "AMLAPURA"),
            array(
                "bkn_id" => "A5EB03E21E2EF6A0E040640A040252AD",
                "nama" => "SRAGEN"),
            array(
                "bkn_id" => "A5EB03E21E2FF6A0E040640A040252AD",
                "nama" => "SEMBAWA"),
            array(
                "bkn_id" => "A5EB03E21E30F6A0E040640A040252AD",
                "nama" => "BANGKA BELITUNG"),
            array(
                "bkn_id" => "A5EB03E21E31F6A0E040640A040252AD",
                "nama" => "BANGKALAN"),
            array(
                "bkn_id" => "A5EB03E21E32F6A0E040640A040252AD",
                "nama" => "GOWA"),
            array(
                "bkn_id" => "A5EB03E21E33F6A0E040640A040252AD",
                "nama" => "JAKARTA-VI"),
            array(
                "bkn_id" => "A5EB03E21E34F6A0E040640A040252AD",
                "nama" => "CURUP"),
            array(
                "bkn_id" => "A5EB03E21E35F6A0E040640A040252AD",
                "nama" => "RANGKASBITUNG"),
            array(
                "bkn_id" => "A5EB03E21E36F6A0E040640A040252AD",
                "nama" => "PAINAN"),
            array(
                "bkn_id" => "A5EB03E21E37F6A0E040640A040252AD",
                "nama" => "SALATIGA"),
            array(
                "bkn_id" => "A5EB03E21E38F6A0E040640A040252AD",
                "nama" => "PURWODADI"),
            array(
                "bkn_id" => "A5EB03E21E39F6A0E040640A040252AD",
                "nama" => "BANJARNEGARA"),
            array(
                "bkn_id" => "A5EB03E21E3AF6A0E040640A040252AD",
                "nama" => "TUBAN"),
            array(
                "bkn_id" => "A5EB03E21E3BF6A0E040640A040252AD",
                "nama" => "SIDOARJO"),
            array(
                "bkn_id" => "A5EB03E21E3CF6A0E040640A040252AD",
                "nama" => "SANGGAU"),
            array(
                "bkn_id" => "A5EB03E21E3DF6A0E040640A040252AD",
                "nama" => "PELEIHARI"),
            array(
                "bkn_id" => "A5EB03E21E3EF6A0E040640A040252AD",
                "nama" => "TANJUNG"),
            array(
                "bkn_id" => "A5EB03E21E3FF6A0E040640A040252AD",
                "nama" => "TANJUNG REDEB"),
            array(
                "bkn_id" => "A5EB03E21E40F6A0E040640A040252AD",
                "nama" => "KOTAMOBAGU"),
            array(
                "bkn_id" => "A5EB03E21E41F6A0E040640A040252AD",
                "nama" => "BENTENG"),
            array(
                "bkn_id" => "A5EB03E21E42F6A0E040640A040252AD",
                "nama" => "MAKALE"),
            array(
                "bkn_id" => "A5EB03E21E43F6A0E040640A040252AD",
                "nama" => "RAHA"),
            array(
                "bkn_id" => "A5EB03E21E44F6A0E040640A040252AD",
                "nama" => "SELONG"),
            array(
                "bkn_id" => "A5EB03E21E45F6A0E040640A040252AD",
                "nama" => "PEKAS LANTAMAL IX AMBON"),
            array(
                "bkn_id" => "A5EB03E21E46F6A0E040640A040252AD",
                "nama" => "SIONAL JAYAPURA"),
            array(
                "bkn_id" => "A5EB03E21E47F6A0E040640A040252AD",
                "nama" => "LANAL CILACAP"),
            array(
                "bkn_id" => "A5EB03E21E48F6A0E040640A040252AD",
                "nama" => "LANAL BIAK"),
            array(
                "bkn_id" => "A5EB03E21E49F6A0E040640A040252AD",
                "nama" => "PASHARKAN MANOKWARI"),
            array(
                "bkn_id" => "A5EB03E21E4AF6A0E040640A040252AD",
                "nama" => "MAKO KORMAR"),
            array(
                "bkn_id" => "A5EB03E21E4BF6A0E040640A040252AD",
                "nama" => "BRIGIF-2 MAR"),
            array(
                "bkn_id" => "A5EB03E21E4CF6A0E040640A040252AD",
                "nama" => "BRIGIF-1 MAR"),
            array(
                "bkn_id" => "A5EB03E21E4DF6A0E040640A040252AD",
                "nama" => "PEKAS LANMAR SURABAYA"),
            array(
                "bkn_id" => "A5EB03E21E4FF6A0E040640A040252AD",
                "nama" => "PUSIDKS KODIKAL"),
            array(
                "bkn_id" => "A5EB03E21E50F6A0E040640A040252AD",
                "nama" => "PEKAS AU"),
            array(
                "bkn_id" => "A5EB03E21E51F6A0E040640A040252AD",
                "nama" => "KAS PUSAT"),
            array(
                "bkn_id" => "A5EB03E21E52F6A0E040640A040252AD",
                "nama" => "DENMABES TNI-AU"),
            array(
                "bkn_id" => "A5EB03E21E53F6A0E040640A040252AD",
                "nama" => "DISLITBANG TNI-AU"),
            array(
                "bkn_id" => "A5EB03E21E55F6A0E040640A040252AD",
                "nama" => "KOHANUDNAS"),
            array(
                "bkn_id" => "A5EB03E21E56F6A0E040640A040252AD",
                "nama" => "KOSEK KOHANUDNAS II"),
            array(
                "bkn_id" => "A5EB03E21E57F6A0E040640A040252AD",
                "nama" => "SESKO TNI-AU"),
            array(
                "bkn_id" => "A5EB03E21E58F6A0E040640A040252AD",
                "nama" => "AKADEMI TNI-AU"),
            array(
                "bkn_id" => "A5EB03E21E5AF6A0E040640A040252AD",
                "nama" => "R U S P A U"),
            array(
                "bkn_id" => "A5EB03E21E5BF6A0E040640A040252AD",
                "nama" => "BEKMATPUS"),
            array(
                "bkn_id" => "A5EB03E21E5CF6A0E040640A040252AD",
                "nama" => "DENMA KOOPSAU I"),
            array(
                "bkn_id" => "A5EB03E21E5DF6A0E040640A040252AD",
                "nama" => "LANUD HALIM"),
            array(
                "bkn_id" => "A5EB03E21E5EF6A0E040640A040252AD",
                "nama" => "LANUD ATANG SENJAYA"),
            array(
                "bkn_id" => "A5EB03E21E60F6A0E040640A040252AD",
                "nama" => "LANUD HUSEIN S"),
            array(
                "bkn_id" => "A5EB03E21E61F6A0E040640A040252AD",
                "nama" => "LANUD KALIJATI"),
            array(
                "bkn_id" => "A5EB03E21E62F6A0E040640A040252AD",
                "nama" => "LANUD MEDAN"),
            array(
                "bkn_id" => "A5EB03E21E63F6A0E040640A040252AD",
                "nama" => "LANUD PALEMBANG"),
            array(
                "bkn_id" => "A5EB03E21E66F6A0E040640A040252AD",
                "nama" => "LANUD TJ.PINANG"),
            array(
                "bkn_id" => "A5EB03E21E67F6A0E040640A040252AD",
                "nama" => "LANUD TJ.PANDAN"),
            array(
                "bkn_id" => "A5EB03E21E68F6A0E040640A040252AD",
                "nama" => "LANUD PADANG"),
            array(
                "bkn_id" => "A5EB03E21E69F6A0E040640A040252AD",
                "nama" => "LANUD MAIMUN SALEH"),
            array(
                "bkn_id" => "A5EB03E21E6AF6A0E040640A040252AD",
                "nama" => "LANUD ASTRA KESTRA"),
            array(
                "bkn_id" => "A5EB03E21E6BF6A0E040640A040252AD",
                "nama" => "LANUD SINGKAWANG II"),
            array(
                "bkn_id" => "A5EB03E21E6CF6A0E040640A040252AD",
                "nama" => "LANUD TASIKMALAYA"),
            array(
                "bkn_id" => "A5EB03E21E6DF6A0E040640A040252AD",
                "nama" => "LANUD S.SUKANI"),
            array(
                "bkn_id" => "A5EB03E21E6EF6A0E040640A040252AD",
                "nama" => "LANUD WIRASABA"),
            array(
                "bkn_id" => "A5EB03E21E6FF6A0E040640A040252AD",
                "nama" => "LANUD KOOPSAU II"),
            array(
                "bkn_id" => "A5EB03E21E70F6A0E040640A040252AD",
                "nama" => "LANUD ISWAHYUDI"),
            array(
                "bkn_id" => "A5EB03E21E71F6A0E040640A040252AD",
                "nama" => "LANUD A RAHMAN SALEH"),
            array(
                "bkn_id" => "A5EB03E21E72F6A0E040640A040252AD",
                "nama" => "LANUD HASANUDDIN"),
            array(
                "bkn_id" => "A5EB03E21E73F6A0E040640A040252AD",
                "nama" => "LANUD SAMSUDIN NOOR"),
            array(
                "bkn_id" => "A5EB03E21E74F6A0E040640A040252AD",
                "nama" => "LANUD SURABAYA"),
            array(
                "bkn_id" => "A5EB03E21E75F6A0E040640A040252AD",
                "nama" => "LANUD MANUHUA"),
            array(
                "bkn_id" => "A5EB03E21E76F6A0E040640A040252AD",
                "nama" => "LANUD ELTARI"),
            array(
                "bkn_id" => "A5EB03E21E77F6A0E040640A040252AD",
                "nama" => "LANUD BALIKPAPAN"),
            array(
                "bkn_id" => "A5EB03E21E78F6A0E040640A040252AD",
                "nama" => "LANUD ISKANDAR"),
            array(
                "bkn_id" => "A5EB03E21E79F6A0E040640A040252AD",
                "nama" => "LANUD SAMRATULANGI"),
            array(
                "bkn_id" => "A5EB03E21E7AF6A0E040640A040252AD",
                "nama" => "LANUD W.MONGINSIDI"),
            array(
                "bkn_id" => "A5EB03E21E7BF6A0E040640A040252AD",
                "nama" => "LANUD PATTIMURA"),
            array(
                "bkn_id" => "A5EB03E21E7CF6A0E040640A040252AD",
                "nama" => "LANUD D.DUMATUBUN"),
            array(
                "bkn_id" => "A5EB03E21E7DF6A0E040640A040252AD",
                "nama" => "LANUD MOROTAI"),
            array(
                "bkn_id" => "A5EB03E21E7EF6A0E040640A040252AD",
                "nama" => "LANUD JAYAPURA"),
            array(
                "bkn_id" => "A5EB03E21E7FF6A0E040640A040252AD",
                "nama" => "LANUD MERAUKE"),
            array(
                "bkn_id" => "A5EB03E21E80F6A0E040640A040252AD",
                "nama" => "LANUD NGURAH RAI"),
            array(
                "bkn_id" => "A5EB03E21E81F6A0E040640A040252AD",
                "nama" => "LANUD REMBIGA"),
            array(
                "bkn_id" => "A5EB03E21E82F6A0E040640A040252AD",
                "nama" => "LANUD DILLI"),
            array(
                "bkn_id" => "A5EB03E21E83F6A0E040640A040252AD",
                "nama" => "LANUD BAUCAU"),
            array(
                "bkn_id" => "A5EB03E21E84F6A0E040640A040252AD",
                "nama" => "DENMA KODIKAU"),
            array(
                "bkn_id" => "A5EB03E21E85F6A0E040640A040252AD",
                "nama" => "LANUD ADI SUTJIPTO"),
            array(
                "bkn_id" => "A5EB03E21E86F6A0E040640A040252AD",
                "nama" => "LANUD ADI SUMARMO"),
            array(
                "bkn_id" => "A5EB03E21E87F6A0E040640A040252AD",
                "nama" => "LANUD SULAEMAN"),
            array(
                "bkn_id" => "A5EB03E21E88F6A0E040640A040252AD",
                "nama" => "SEKKAU HALIM"),
            array(
                "bkn_id" => "A5EB03E21E89F6A0E040640A040252AD",
                "nama" => "WING DIK TEK KAL"),
            array(
                "bkn_id" => "A5EB03E21E8AF6A0E040640A040252AD",
                "nama" => "WING DIK KUM"),
            array(
                "bkn_id" => "A5EB03E21E8BF6A0E040640A040252AD",
                "nama" => "DENMA KOHARMATAU"),
            array(
                "bkn_id" => "A5EB03E21E8CF6A0E040640A040252AD",
                "nama" => "DEPO PESBANG 10"),
            array(
                "bkn_id" => "A5EB03E21E8DF6A0E040640A040252AD",
                "nama" => "DEPO PESBANG 30"),
            array(
                "bkn_id" => "A5EB03E21E8EF6A0E040640A040252AD",
                "nama" => "DEPO SEN AMO 60"),
            array(
                "bkn_id" => "A5EB03E21E90F6A0E040640A040252AD",
                "nama" => "DEPOLEK 01"),
            array(
                "bkn_id" => "A5EB03E21E91F6A0E040640A040252AD",
                "nama" => "DEPOLEK 02"),
            array(
                "bkn_id" => "A5EB03E21E92F6A0E040640A040252AD",
                "nama" => "PEKAS POLRI"),
            array(
                "bkn_id" => "A5EB03E21E93F6A0E040640A040252AD",
                "nama" => "01 KUMABES I"),
            array(
                "bkn_id" => "A5EB03E21E94F6A0E040640A040252AD",
                "nama" => "02 KUMABES I"),
            array(
                "bkn_id" => "A5EB03E21E96F6A0E040640A040252AD",
                "nama" => "04 KUMABES I"),
            array(
                "bkn_id" => "A5EB03E21E97F6A0E040640A040252AD",
                "nama" => "05 KUMABES I"),
            array(
                "bkn_id" => "A5EB03E21E98F6A0E040640A040252AD",
                "nama" => "06 KUMABES I"),
            array(
                "bkn_id" => "A5EB03E21E99F6A0E040640A040252AD",
                "nama" => "07 KUMABES I"),
            array(
                "bkn_id" => "A5EB03E21E9BF6A0E040640A040252AD",
                "nama" => "02 KUMABES II"),
            array(
                "bkn_id" => "A5EB03E21E9CF6A0E040640A040252AD",
                "nama" => "03 KUMABES II"),
            array(
                "bkn_id" => "A5EB03E21E9DF6A0E040640A040252AD",
                "nama" => "04 KUMABES II"),
            array(
                "bkn_id" => "A5EB03E21E9EF6A0E040640A040252AD",
                "nama" => "05 KUMABES II"),
            array(
                "bkn_id" => "A5EB03E21E9FF6A0E040640A040252AD",
                "nama" => "01 KU POLDA ACEH"),
            array(
                "bkn_id" => "A5EB03E21EA1F6A0E040640A040252AD",
                "nama" => "03 KU POLDA ACEH"),
            array(
                "bkn_id" => "A5EB03E21D0BF6A0E040640A040252AD",
                "nama" => "BARABAI"),
            array(
                "bkn_id" => "A5EB03E21D0CF6A0E040640A040252AD",
                "nama" => "KOTABARU"),
            array(
                "bkn_id" => "A5EB03E21D0DF6A0E040640A040252AD",
                "nama" => "SAMARINDA"),
            array(
                "bkn_id" => "A5EB03E21D0EF6A0E040640A040252AD",
                "nama" => "BALIKPAPAN"),
            array(
                "bkn_id" => "A5EB03E21D0FF6A0E040640A040252AD",
                "nama" => "TARAKAN"),
            array(
                "bkn_id" => "A5EB03E21D10F6A0E040640A040252AD",
                "nama" => "MANADO"),
            array(
                "bkn_id" => "A5EB03E21D11F6A0E040640A040252AD",
                "nama" => "GORONTALO"),
            array(
                "bkn_id" => "A5EB03E21D12F6A0E040640A040252AD",
                "nama" => "TAHUNA"),
            array(
                "bkn_id" => "A5EB03E21D13F6A0E040640A040252AD",
                "nama" => "PALU"),
            array(
                "bkn_id" => "A5EB03E21D14F6A0E040640A040252AD",
                "nama" => "POSO"),
            array(
                "bkn_id" => "A5EB03E21D15F6A0E040640A040252AD",
                "nama" => "LUWUK"),
            array(
                "bkn_id" => "A5EB03E21D16F6A0E040640A040252AD",
                "nama" => "TOLI TOLI"),
            array(
                "bkn_id" => "A5EB03E21D17F6A0E040640A040252AD",
                "nama" => "MAKASSAR I"),
            array(
                "bkn_id" => "A5EB03E21D18F6A0E040640A040252AD",
                "nama" => "MAKASSAR II"),
            array(
                "bkn_id" => "A5EB03E21D19F6A0E040640A040252AD",
                "nama" => "PARE PARE"),
            array(
                "bkn_id" => "A5EB03E21D1AF6A0E040640A040252AD",
                "nama" => "WATAMPONE"),
            array(
                "bkn_id" => "A5EB03E21D1BF6A0E040640A040252AD",
                "nama" => "MAJENE"),
            array(
                "bkn_id" => "A5EB03E21D1CF6A0E040640A040252AD",
                "nama" => "PALOPO"),
            array(
                "bkn_id" => "A5EB03E21D1DF6A0E040640A040252AD",
                "nama" => "BANTAENG"),
            array(
                "bkn_id" => "A5EB03E21D1EF6A0E040640A040252AD",
                "nama" => "BAU BAU"),
            array(
                "bkn_id" => "A5EB03E21D1FF6A0E040640A040252AD",
                "nama" => "KENDARI"),
            array(
                "bkn_id" => "A5EB03E21D20F6A0E040640A040252AD",
                "nama" => "SINGARAJA"),
            array(
                "bkn_id" => "A5EB03E21D21F6A0E040640A040252AD",
                "nama" => "DENPASAR"),
            array(
                "bkn_id" => "A5EB03E21D22F6A0E040640A040252AD",
                "nama" => "MATARAM"),
            array(
                "bkn_id" => "A5EB03E21D23F6A0E040640A040252AD",
                "nama" => "SUMBAWA BESAR"),
            array(
                "bkn_id" => "A5EB03E21D24F6A0E040640A040252AD",
                "nama" => "BIMA"),
            array(
                "bkn_id" => "A5EB03E21D25F6A0E040640A040252AD",
                "nama" => "KUPANG"),
            array(
                "bkn_id" => "A5EB03E21D26F6A0E040640A040252AD",
                "nama" => "ENDE"),
            array(
                "bkn_id" => "A5EB03E21D27F6A0E040640A040252AD",
                "nama" => "RUTENG"),
            array(
                "bkn_id" => "A5EB03E21D28F6A0E040640A040252AD",
                "nama" => "WAINGAPU"),
            array(
                "bkn_id" => "A5EB03E21D29F6A0E040640A040252AD",
                "nama" => "AMBON"),
            array(
                "bkn_id" => "A5EB03E21D2AF6A0E040640A040252AD",
                "nama" => "TUAL"),
            array(
                "bkn_id" => "A5EB03E21D2BF6A0E040640A040252AD",
                "nama" => "SAUMLAKI"),
            array(
                "bkn_id" => "A5EB03E21D2CF6A0E040640A040252AD",
                "nama" => "TERNATE"),
            array(
                "bkn_id" => "A5EB03E21D2DF6A0E040640A040252AD",
                "nama" => "TOBELO"),
            array(
                "bkn_id" => "A5EB03E21D2EF6A0E040640A040252AD",
                "nama" => "JAYAPURA"),
            array(
                "bkn_id" => "A5EB03E21D2FF6A0E040640A040252AD",
                "nama" => "BIAK"),
            array(
                "bkn_id" => "A5EB03E21D30F6A0E040640A040252AD",
                "nama" => "MERAUKE"),
            array(
                "bkn_id" => "A5EB03E21D31F6A0E040640A040252AD",
                "nama" => "SORONG"),
            array(
                "bkn_id" => "A5EB03E21D32F6A0E040640A040252AD",
                "nama" => "FAK FAK"),
            array(
                "bkn_id" => "A5EB03E21D33F6A0E040640A040252AD",
                "nama" => "NABIRE"),
            array(
                "bkn_id" => "A5EB03E21D34F6A0E040640A040252AD",
                "nama" => "WAMENA"),
            array(
                "bkn_id" => "A5EB03E21D35F6A0E040640A040252AD",
                "nama" => "MANOKWARI"),
            array(
                "bkn_id" => "A5EB03E21D36F6A0E040640A040252AD",
                "nama" => "SERUI"),
            array(
                "bkn_id" => "A5EB03E21D37F6A0E040640A040252AD",
                "nama" => "DILLI"),
            array(
                "bkn_id" => "A5EB03E21D38F6A0E040640A040252AD",
                "nama" => "BAUCAU"),
            array(
                "bkn_id" => "A5EB03E21D39F6A0E040640A040252AD",
                "nama" => "DEPHANKAM"),
            array(
                "bkn_id" => "A5EB03E21D3AF6A0E040640A040252AD",
                "nama" => "KODAM I/BB"),
            array(
                "bkn_id" => "A5EB03E21D3BF6A0E040640A040252AD",
                "nama" => "KODAM II/SWJ"),
            array(
                "bkn_id" => "A5EB03E21D3DF6A0E040640A040252AD",
                "nama" => "KODAM IV/DIP"),
            array(
                "bkn_id" => "A5EB03E21D3EF6A0E040640A040252AD",
                "nama" => "KODAM V/BRW"),
            array(
                "bkn_id" => "A5EB03E21D3FF6A0E040640A040252AD",
                "nama" => "KODAM VI/TPR"),
            array(
                "bkn_id" => "A5EB03E21D40F6A0E040640A040252AD",
                "nama" => "KODAM VII/WRB"),
            array(
                "bkn_id" => "A5EB03E21D41F6A0E040640A040252AD",
                "nama" => "KODAM VIII/TKR"),
            array(
                "bkn_id" => "A5EB03E21D42F6A0E040640A040252AD",
                "nama" => "KODAM IX/UDY"),
            array(
                "bkn_id" => "A5EB03E21D43F6A0E040640A040252AD",
                "nama" => "KODAM JAYA"),
            array(
                "bkn_id" => "A5EB03E21D44F6A0E040640A040252AD",
                "nama" => "STAF MABES ABRI"),
            array(
                "bkn_id" => "A5EB03E21D45F6A0E040640A040252AD",
                "nama" => "RAYON JAKARTA-I"),
            array(
                "bkn_id" => "A5EB03E21D46F6A0E040640A040252AD",
                "nama" => "RAYON JAKARTA-II"),
            array(
                "bkn_id" => "A5EB03E21D47F6A0E040640A040252AD",
                "nama" => "RAYON BANDUNG-I"),
            array(
                "bkn_id" => "A5EB03E21D48F6A0E040640A040252AD",
                "nama" => "KOPKAMTIB/BAKORSTANAS"),
            array(
                "bkn_id" => "A5EB03E21D49F6A0E040640A040252AD",
                "nama" => "KOOPSKAM TIM-TIM"),
            array(
                "bkn_id" => "A5EB03E21D4AF6A0E040640A040252AD",
                "nama" => "LAKSUSDA SUMBAGUT"),
            array(
                "bkn_id" => "A5EB03E21D4BF6A0E040640A040252AD",
                "nama" => "LAKSUSDA SUMBAGSEL"),
            array(
                "bkn_id" => "A5EB03E21D4CF6A0E040640A040252AD",
                "nama" => "LAKSUSDA JATENG/DIV"),
            array(
                "bkn_id" => "A5EB03E21D4EF6A0E040640A040252AD",
                "nama" => "LAKSUSDA KALIMANTAN"),
            array(
                "bkn_id" => "A5EB03E21D4FF6A0E040640A040252AD",
                "nama" => "LAKSUSDA SULAWESI"),
            array(
                "bkn_id" => "A5EB03E21D50F6A0E040640A040252AD",
                "nama" => "LAKSUSDA NUSRA"),
            array(
                "bkn_id" => "A5EB03E21D51F6A0E040640A040252AD",
                "nama" => "LAKSUSDA MALIRJA"),
            array(
                "bkn_id" => "A5EB03E21D53F6A0E040640A040252AD",
                "nama" => "SUNGAI LIAT"),
            array(
                "bkn_id" => "A5EB03E21D54F6A0E040640A040252AD",
                "nama" => "ATAMBUA"),
            array(
                "bkn_id" => "A5EB03E21D55F6A0E040640A040252AD",
                "nama" => "MALINAU"),
            array(
                "bkn_id" => "A5EB03E21D56F6A0E040640A040252AD",
                "nama" => "MUARA SABAK"),
            array(
                "bkn_id" => "A5EB03E21D57F6A0E040640A040252AD",
                "nama" => "KALABAHI"),
            array(
                "bkn_id" => "A5EB03E21D58F6A0E040640A040252AD",
                "nama" => "JOMBANG"),
            array(
                "bkn_id" => "A5EB03E21D59F6A0E040640A040252AD",
                "nama" => "PROBOLINGGO"),
            array(
                "bkn_id" => "A5EB03E21D5AF6A0E040640A040252AD",
                "nama" => "BAGIAN KAS DAN PERBENDAHARAAN"),
            array(
                "bkn_id" => "A5EB03E21D5BF6A0E040640A040252AD",
                "nama" => "MASOHI"),
            array(
                "bkn_id" => "A5EB03E21D5CF6A0E040640A040252AD",
                "nama" => "LARANTUKA"),
            array(
                "bkn_id" => "A5EB03E21D5DF6A0E040640A040252AD",
                "nama" => "BITUNG"),
            array(
                "bkn_id" => "A5EB03E21D5EF6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-I"),
            array(
                "bkn_id" => "A5EB03E21D5FF6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-2"),
            array(
                "bkn_id" => "A5EB03E21D60F6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-3"),
            array(
                "bkn_id" => "A5EB03E21D62F6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-5"),
            array(
                "bkn_id" => "A5EB03E21D63F6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-6"),
            array(
                "bkn_id" => "A5EB03E21D64F6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-7"),
            array(
                "bkn_id" => "A5EB03E21D65F6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-8"),
            array(
                "bkn_id" => "A5EB03E21D66F6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-9"),
            array(
                "bkn_id" => "A5EB03E21D68F6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-11"),
            array(
                "bkn_id" => "A5EB03E21D69F6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-12"),
            array(
                "bkn_id" => "A5EB03E21D6AF6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-13"),
            array(
                "bkn_id" => "A5EB03E21D6CF6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-15"),
            array(
                "bkn_id" => "A5EB03E21D6DF6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-16"),
            array(
                "bkn_id" => "A5EB03E21D6EF6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-17"),
            array(
                "bkn_id" => "A5EB03E21D6FF6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-18"),
            array(
                "bkn_id" => "A5EB03E21D70F6A0E040640A040252AD",
                "nama" => "GABRAH-1"),
            array(
                "bkn_id" => "A5EB03E21D72F6A0E040640A040252AD",
                "nama" => "GABRAH-3"),
            array(
                "bkn_id" => "A5EB03E21D74F6A0E040640A040252AD",
                "nama" => "GABRAH-5"),
            array(
                "bkn_id" => "A5EB03E21D75F6A0E040640A040252AD",
                "nama" => "GABRAH-6"),
            array(
                "bkn_id" => "A5EB03E21D76F6A0E040640A040252AD",
                "nama" => "GABRAH-7"),
            array(
                "bkn_id" => "A5EB03E21D77F6A0E040640A040252AD",
                "nama" => "GABRAH-8"),
            array(
                "bkn_id" => "A5EB03E21D78F6A0E040640A040252AD",
                "nama" => "GABRAH-9"),
            array(
                "bkn_id" => "A5EB03E21D7BF6A0E040640A040252AD",
                "nama" => "GABRAH-12"),
            array(
                "bkn_id" => "A5EB03E21D7CF6A0E040640A040252AD",
                "nama" => "GABRAH-13"),
            array(
                "bkn_id" => "A5EB03E21D7DF6A0E040640A040252AD",
                "nama" => "GABRAH-14"),
            array(
                "bkn_id" => "A5EB03E21D7EF6A0E040640A040252AD",
                "nama" => "GABRAH-15"),
            array(
                "bkn_id" => "A5EB03E21D7FF6A0E040640A040252AD",
                "nama" => "GABRAH-16"),
            array(
                "bkn_id" => "A5EB03E21D80F6A0E040640A040252AD",
                "nama" => "GABRAH-17"),
            array(
                "bkn_id" => "A5EB03E21D83F6A0E040640A040252AD",
                "nama" => "GABRAH-20"),
            array(
                "bkn_id" => "A5EB03E21D84F6A0E040640A040252AD",
                "nama" => "GABRAH-21"),
            array(
                "bkn_id" => "A5EB03E21D85F6A0E040640A040252AD",
                "nama" => "GABRAH-22"),
            array(
                "bkn_id" => "A5EB03E21D86F6A0E040640A040252AD",
                "nama" => "GABRAH-23"),
            array(
                "bkn_id" => "A5EB03E21D87F6A0E040640A040252AD",
                "nama" => "GABRAH-24"),
            array(
                "bkn_id" => "A5EB03E21D89F6A0E040640A040252AD",
                "nama" => "GABRAH-26"),
            array(
                "bkn_id" => "A5EB03E21D8AF6A0E040640A040252AD",
                "nama" => "GABRAH-27"),
            array(
                "bkn_id" => "A5EB03E21D8BF6A0E040640A040252AD",
                "nama" => "GABRAH-28"),
            array(
                "bkn_id" => "A5EB03E21D8CF6A0E040640A040252AD",
                "nama" => "GABRAH-29"),
            array(
                "bkn_id" => "A5EB03E21D8DF6A0E040640A040252AD",
                "nama" => "GABRAH-30"),
            array(
                "bkn_id" => "A5EB03E21D8EF6A0E040640A040252AD",
                "nama" => "GABRAH-31"),
            array(
                "bkn_id" => "A5EB03E21D8FF6A0E040640A040252AD",
                "nama" => "GABRAH-32"),
            array(
                "bkn_id" => "A5EB03E21D90F6A0E040640A040252AD",
                "nama" => "GABRAH-33"),
            array(
                "bkn_id" => "A5EB03E21D91F6A0E040640A040252AD",
                "nama" => "GABRAH-34"),
            array(
                "bkn_id" => "A5EB03E21D92F6A0E040640A040252AD",
                "nama" => "GABRAH-35"),
            array(
                "bkn_id" => "A5EB03E21D93F6A0E040640A040252AD",
                "nama" => "GABRAH-36"),
            array(
                "bkn_id" => "A5EB03E21D94F6A0E040640A040252AD",
                "nama" => "GABRAH-37"),
            array(
                "bkn_id" => "A5EB03E21D95F6A0E040640A040252AD",
                "nama" => "GABRAH-38"),
            array(
                "bkn_id" => "A5EB03E21D96F6A0E040640A040252AD",
                "nama" => "GABRAH-39"),
            array(
                "bkn_id" => "A5EB03E21D97F6A0E040640A040252AD",
                "nama" => "GABRAH-40"),
            array(
                "bkn_id" => "A5EB03E21D98F6A0E040640A040252AD",
                "nama" => "GABRAH-41"),
            array(
                "bkn_id" => "A5EB03E21D99F6A0E040640A040252AD",
                "nama" => "GABRAH-42"),
            array(
                "bkn_id" => "A5EB03E21D9AF6A0E040640A040252AD",
                "nama" => "GABRAH-43"),
            array(
                "bkn_id" => "A5EB03E21D9BF6A0E040640A040252AD",
                "nama" => "GABRAH-44"),
            array(
                "bkn_id" => "A5EB03E21D9CF6A0E040640A040252AD",
                "nama" => "GABRAH-45"),
            array(
                "bkn_id" => "A5EB03E21D9DF6A0E040640A040252AD",
                "nama" => "GABRAH-46"),
            array(
                "bkn_id" => "A5EB03E21D9EF6A0E040640A040252AD",
                "nama" => "GABRAH-47"),
            array(
                "bkn_id" => "A5EB03E21D9FF6A0E040640A040252AD",
                "nama" => "GABRAH-48"),
            array(
                "bkn_id" => "A5EB03E21DA0F6A0E040640A040252AD",
                "nama" => "GABRAH-49"),
            array(
                "bkn_id" => "A5EB03E21DA1F6A0E040640A040252AD",
                "nama" => "GABRAH-50"),
            array(
                "bkn_id" => "A5EB03E21DA2F6A0E040640A040252AD",
                "nama" => "GABRAH-51"),
            array(
                "bkn_id" => "A5EB03E21DA3F6A0E040640A040252AD",
                "nama" => "GABRAH-52"),
            array(
                "bkn_id" => "A5EB03E21DA4F6A0E040640A040252AD",
                "nama" => "GABRAH-53"),
            array(
                "bkn_id" => "A5EB03E21DA5F6A0E040640A040252AD",
                "nama" => "GABRAH-54"),
            array(
                "bkn_id" => "A5EB03E21DA6F6A0E040640A040252AD",
                "nama" => "GABRAH-55"),
            array(
                "bkn_id" => "A5EB03E21DA7F6A0E040640A040252AD",
                "nama" => "GABRAH-56"),
            array(
                "bkn_id" => "A5EB03E21DA8F6A0E040640A040252AD",
                "nama" => "GABRAH-57"),
            array(
                "bkn_id" => "A5EB03E21DA9F6A0E040640A040252AD",
                "nama" => "GABRAH-58"),
            array(
                "bkn_id" => "A5EB03E21DAAF6A0E040640A040252AD",
                "nama" => "GABRAH-59"),
            array(
                "bkn_id" => "A5EB03E21DABF6A0E040640A040252AD",
                "nama" => "GABRAH-60"),
            array(
                "bkn_id" => "A5EB03E21DACF6A0E040640A040252AD",
                "nama" => "GABRAH-61"),
            array(
                "bkn_id" => "A5EB03E21DADF6A0E040640A040252AD",
                "nama" => "GABRAH-62"),
            array(
                "bkn_id" => "A5EB03E21DAEF6A0E040640A040252AD",
                "nama" => "GABRAH-63"),
            array(
                "bkn_id" => "A5EB03E21DAFF6A0E040640A040252AD",
                "nama" => "GABRAH-64"),
            array(
                "bkn_id" => "A5EB03E21DB0F6A0E040640A040252AD",
                "nama" => "GABRAH-65"),
            array(
                "bkn_id" => "A5EB03E21DB1F6A0E040640A040252AD",
                "nama" => "GABRAH-66"),
            array(
                "bkn_id" => "A5EB03E21DB2F6A0E040640A040252AD",
                "nama" => "GABRAH-67"),
            array(
                "bkn_id" => "A5EB03E21DB3F6A0E040640A040252AD",
                "nama" => "GABRAH-68"),
            array(
                "bkn_id" => "A5EB03E21DB4F6A0E040640A040252AD",
                "nama" => "GABRAH-69"),
            array(
                "bkn_id" => "A5EB03E21DB5F6A0E040640A040252AD",
                "nama" => "GABRAH-70"),
            array(
                "bkn_id" => "A5EB03E21DB6F6A0E040640A040252AD",
                "nama" => "GABRAH-71"),
            array(
                "bkn_id" => "A5EB03E21DB7F6A0E040640A040252AD",
                "nama" => "GABRAH-72"),
            array(
                "bkn_id" => "A5EB03E21DB8F6A0E040640A040252AD",
                "nama" => "GABRAH-73"),
            array(
                "bkn_id" => "A5EB03E21DB9F6A0E040640A040252AD",
                "nama" => "GABRAH-74"),
            array(
                "bkn_id" => "A5EB03E21DBAF6A0E040640A040252AD",
                "nama" => "GABRAH-75"),
            array(
                "bkn_id" => "A5EB03E21DBBF6A0E040640A040252AD",
                "nama" => "GABRAH-76"),
            array(
                "bkn_id" => "A5EB03E21DBCF6A0E040640A040252AD",
                "nama" => "GABRAH-77"),
            array(
                "bkn_id" => "A5EB03E21DBDF6A0E040640A040252AD",
                "nama" => "GABRAH-78"),
            array(
                "bkn_id" => "A5EB03E21DBEF6A0E040640A040252AD",
                "nama" => "GABRAH-79"),
            array(
                "bkn_id" => "A5EB03E21DBFF6A0E040640A040252AD",
                "nama" => "GABRAH-80"),
            array(
                "bkn_id" => "A5EB03E21DC0F6A0E040640A040252AD",
                "nama" => "GABRAH-81"),
            array(
                "bkn_id" => "A5EB03E21DC1F6A0E040640A040252AD",
                "nama" => "GABRAH-82"),
            array(
                "bkn_id" => "A5EB03E21DC2F6A0E040640A040252AD",
                "nama" => "GABRAH-83"),
            array(
                "bkn_id" => "A5EB03E21DC3F6A0E040640A040252AD",
                "nama" => "GABRAH-84"),
            array(
                "bkn_id" => "A5EB03E21DC4F6A0E040640A040252AD",
                "nama" => "GABRAH-85"),
            array(
                "bkn_id" => "A5EB03E21DC5F6A0E040640A040252AD",
                "nama" => "GABRAH-86"),
            array(
                "bkn_id" => "A5EB03E21DC6F6A0E040640A040252AD",
                "nama" => "GABRAH-87"),
            array(
                "bkn_id" => "A5EB03E21DC7F6A0E040640A040252AD",
                "nama" => "GABRAH-88"),
            array(
                "bkn_id" => "A5EB03E21DC8F6A0E040640A040252AD",
                "nama" => "GABRAH-89"),
            array(
                "bkn_id" => "A5EB03E21DC9F6A0E040640A040252AD",
                "nama" => "GABRAH-90"),
            array(
                "bkn_id" => "A5EB03E21DCAF6A0E040640A040252AD",
                "nama" => "GABRAH-91"),
            array(
                "bkn_id" => "A5EB03E21DCBF6A0E040640A040252AD",
                "nama" => "GABRAH-92"),
            array(
                "bkn_id" => "A5EB03E21DCCF6A0E040640A040252AD",
                "nama" => "GABRAH-93"),
            array(
                "bkn_id" => "A5EB03E21DCDF6A0E040640A040252AD",
                "nama" => "GABRAH-94"),
            array(
                "bkn_id" => "A5EB03E21DCEF6A0E040640A040252AD",
                "nama" => "GABRAH-95"),
            array(
                "bkn_id" => "A5EB03E21DCFF6A0E040640A040252AD",
                "nama" => "GABRAH-96"),
            array(
                "bkn_id" => "A5EB03E21DD0F6A0E040640A040252AD",
                "nama" => "GABRAH-97"),
            array(
                "bkn_id" => "A5EB03E21DD1F6A0E040640A040252AD",
                "nama" => "GABRAH-98"),
            array(
                "bkn_id" => "A5EB03E21DD2F6A0E040640A040252AD",
                "nama" => "GABRAH-99"),
            array(
                "bkn_id" => "A5EB03E21DD3F6A0E040640A040252AD",
                "nama" => "GABRAH-100"),
            array(
                "bkn_id" => "A5EB03E21DD4F6A0E040640A040252AD",
                "nama" => "GABRAH-101"),
            array(
                "bkn_id" => "A5EB03E21DD5F6A0E040640A040252AD",
                "nama" => "GABRAH-102"),
            array(
                "bkn_id" => "A5EB03E21DD6F6A0E040640A040252AD",
                "nama" => "GABRAH-103"),
            array(
                "bkn_id" => "A5EB03E21DD7F6A0E040640A040252AD",
                "nama" => "GABRAH-104"),
            array(
                "bkn_id" => "A5EB03E21DD8F6A0E040640A040252AD",
                "nama" => "GABRAH-105"),
            array(
                "bkn_id" => "A5EB03E21DD9F6A0E040640A040252AD",
                "nama" => "GABRAH-106"),
            array(
                "bkn_id" => "A5EB03E21DDAF6A0E040640A040252AD",
                "nama" => "GABRAH-107"),
            array(
                "bkn_id" => "A5EB03E21DDBF6A0E040640A040252AD",
                "nama" => "GABRAH-108"),
            array(
                "bkn_id" => "A5EB03E21DDCF6A0E040640A040252AD",
                "nama" => "A M N"),
            array(
                "bkn_id" => "A5EB03E21DDDF6A0E040640A040252AD",
                "nama" => "SESKOAD"),
            array(
                "bkn_id" => "A5EB03E21DDEF6A0E040640A040252AD",
                "nama" => "PEKAS AL"),
            array(
                "bkn_id" => "A5EB03E21DDFF6A0E040640A040252AD",
                "nama" => "KUPUS"),
            array(
                "bkn_id" => "A5EB03E21DE0F6A0E040640A040252AD",
                "nama" => "DENMABESAL"),
            array(
                "bkn_id" => "A5EB03E21DE1F6A0E040640A040252AD",
                "nama" => "SESKOAL"),
            array(
                "bkn_id" => "A5EB03E21DE2F6A0E040640A040252AD",
                "nama" => "DISHIDROS"),
            array(
                "bkn_id" => "A5EB03E21DE3F6A0E040640A040252AD",
                "nama" => "BALURJALBAR"),
            array(
                "bkn_id" => "A5EB03E21DE4F6A0E040640A040252AD",
                "nama" => "RS.DR.MINTOHARJO"),
            array(
                "bkn_id" => "A5EB03E21DE5F6A0E040640A040252AD",
                "nama" => "RS.DR.RAMELAN"),
            array(
                "bkn_id" => "A5EB03E21DE7F6A0E040640A040252AD",
                "nama" => "DOPUSBEKTIM"),
            array(
                "bkn_id" => "A5EB03E21DE9F6A0E040640A040252AD",
                "nama" => "LANAL BELAWAN"),
            array(
                "bkn_id" => "A5EB03E21DEAF6A0E040640A040252AD",
                "nama" => "LANAL SABANG"),
            array(
                "bkn_id" => "A5EB03E21DECF6A0E040640A040252AD",
                "nama" => "PASHARKAN MENTIGI"),
            array(
                "bkn_id" => "A5EB03E21DEDF6A0E040640A040252AD",
                "nama" => "SIONAL TELUK BAYUR"),
            array(
                "bkn_id" => "A5EB03E21DEFF6A0E040640A040252AD",
                "nama" => "MAKO ARMABAR"),
            array(
                "bkn_id" => "A5EB03E21DF0F6A0E040640A040252AD",
                "nama" => "LANTAMAL TEL.RATAI"),
            array(
                "bkn_id" => "A5EB03E21DF1F6A0E040640A040252AD",
                "nama" => "DENAL PALEMBANG"),
            array(
                "bkn_id" => "A5EB03E21DF2F6A0E040640A040252AD",
                "nama" => "MAKO KOLINLAMIL"),
            array(
                "bkn_id" => "A5EB03E21DF3F6A0E040640A040252AD",
                "nama" => "SATLINLAMIL SBY"),
            array(
                "bkn_id" => "A5EB03E21DF4F6A0E040640A040252AD",
                "nama" => "SATKOR ARMATIM"),
            array(
                "bkn_id" => "A5EB03E21DF5F6A0E040640A040252AD",
                "nama" => "SATFIB ARMATIM"),
            array(
                "bkn_id" => "A5EB03E21DF7F6A0E040640A040252AD",
                "nama" => "SIONAL BENOA"),
            array(
                "bkn_id" => "A5EB03E21DF8F6A0E040640A040252AD",
                "nama" => "PEKAS LANTAMAL VI MAKASSAR"),
            array(
                "bkn_id" => "A5EB03E21DF9F6A0E040640A040252AD",
                "nama" => "PASHARKAN U.PANDANG"),
            array(
                "bkn_id" => "A5EB03E21C95F6A0E040640A040252AD",
                "nama" => "DINAS KEUANGAN DAN ASET DAERAH"),
            array(
                "bkn_id" => "A5EB03E21C96F6A0E040640A040252AD",
                "nama" => "DPDPK"),
            array(
                "bkn_id" => "A5EB03E21C97F6A0E040640A040252AD",
                "nama" => "SOE"),
            array(
                "bkn_id" => "A5EB03E21C98F6A0E040640A040252AD",
                "nama" => "BINJAI"),
            array(
                "bkn_id" => "A5EB03E21C99F6A0E040640A040252AD",
                "nama" => "MAMUJU"),
            array(
                "bkn_id" => "A5EB03E21C9AF6A0E040640A040252AD",
                "nama" => "WATES"),
            array(
                "bkn_id" => "A5EB03E21C9BF6A0E040640A040252AD",
                "nama" => "PEKAS TNI"),
            array(
                "bkn_id" => "A5EB03E21C9CF6A0E040640A040252AD",
                "nama" => "BPKAD"),
            array(
                "bkn_id" => "A5EB03E21C9DF6A0E040640A040252AD",
                "nama" => "BADAN KEUANGAN DAN KAS DAERAH"),
            array(
                "bkn_id" => "A5EB03E21C9FF6A0E040640A040252AD",
                "nama" => "BAKD"),
            array(
                "bkn_id" => "A5EB03E21CA0F6A0E040640A040252AD",
                "nama" => "BPKD"),
            array(
                "bkn_id" => "A5EB03E21CA1F6A0E040640A040252AD",
                "nama" => "DINAS KEUANGAN DAERAH"),
            array(
                "bkn_id" => "A5EB03E21CA2F6A0E040640A040252AD",
                "nama" => "DPPKD"),
            array(
                "bkn_id" => "A5EB03E21CA3F6A0E040640A040252AD",
                "nama" => "MUKO-MUKO"),
            array(
                "bkn_id" => "A5EB03E21CA4F6A0E040640A040252AD",
                "nama" => "DPKAD"),
            array(
                "bkn_id" => "A5EB03E21CA5F6A0E040640A040252AD",
                "nama" => "DINAS PENGELOLAAN KEUANGAN DAERAH"),
            array(
                "bkn_id" => "A5EB03E21CA6F6A0E040640A040252AD",
                "nama" => "KANTOR KAS DAERAH"),
            array(
                "bkn_id" => "A5EB03E21CA7F6A0E040640A040252AD",
                "nama" => "NAMLEA"),
            array(
                "bkn_id" => "A5EB03E21CA8F6A0E040640A040252AD",
                "nama" => "PEKAS KEMHAN"),
            array(
                "bkn_id" => "A5EB03E21CA9F6A0E040640A040252AD",
                "nama" => "TANJUNG KARANG"),
            array(
                "bkn_id" => "A5EB03E21CAAF6A0E040640A040252AD",
                "nama" => "PAYAKUMBUH"),
            array(
                "bkn_id" => "A5EB03E21CABF6A0E040640A040252AD",
                "nama" => "RABA BIMA"),
            array(
                "bkn_id" => "A5EB03E21CACF6A0E040640A040252AD",
                "nama" => "BEKASI"),
            array(
                "bkn_id" => "A5EB03E21CADF6A0E040640A040252AD",
                "nama" => "BANDA ACEH"),
            array(
                "bkn_id" => "A5EB03E21CAEF6A0E040640A040252AD",
                "nama" => "LHOKSEUMAWE"),
            array(
                "bkn_id" => "A5EB03E21CAFF6A0E040640A040252AD",
                "nama" => "LANGSA"),
            array(
                "bkn_id" => "A5EB03E21CB0F6A0E040640A040252AD",
                "nama" => "TAPAKTUAN"),
            array(
                "bkn_id" => "A5EB03E21CB1F6A0E040640A040252AD",
                "nama" => "MEULABOH"),
            array(
                "bkn_id" => "A5EB03E21CB2F6A0E040640A040252AD",
                "nama" => "KUTACANE"),
            array(
                "bkn_id" => "A5EB03E21CB3F6A0E040640A040252AD",
                "nama" => "TAKENGON"),
            array(
                "bkn_id" => "A5EB03E21CB4F6A0E040640A040252AD",
                "nama" => "TEBING TINGGI"),
            array(
                "bkn_id" => "A5EB03E21CB5F6A0E040640A040252AD",
                "nama" => "MEDAN I"),
            array(
                "bkn_id" => "A5EB03E21CB6F6A0E040640A040252AD",
                "nama" => "MEDAN II"),
            array(
                "bkn_id" => "A5EB03E21CB7F6A0E040640A040252AD",
                "nama" => "PEMATANG SIANTAR"),
            array(
                "bkn_id" => "A5EB03E21CB8F6A0E040640A040252AD",
                "nama" => "TANJUNG BALAI"),
            array(
                "bkn_id" => "A5EB03E21CB9F6A0E040640A040252AD",
                "nama" => "SIBOLGA"),
            array(
                "bkn_id" => "A5EB03E21CBAF6A0E040640A040252AD",
                "nama" => "RANTAU PRAPAT"),
            array(
                "bkn_id" => "A5EB03E21CBBF6A0E040640A040252AD",
                "nama" => "SIDIKALANG"),
            array(
                "bkn_id" => "A5EB03E21CBCF6A0E040640A040252AD",
                "nama" => "BALIGE"),
            array(
                "bkn_id" => "A5EB03E21CBDF6A0E040640A040252AD",
                "nama" => "PADANG SIDEMPUAN"),
            array(
                "bkn_id" => "A5EB03E21CBEF6A0E040640A040252AD",
                "nama" => "GUNUNG SITOLI"),
            array(
                "bkn_id" => "A5EB03E21CBFF6A0E040640A040252AD",
                "nama" => "BUKITTINGGI"),
            array(
                "bkn_id" => "A5EB03E21CC0F6A0E040640A040252AD",
                "nama" => "PADANG"),
            array(
                "bkn_id" => "A5EB03E21CC1F6A0E040640A040252AD",
                "nama" => "SIJUNJUNG"),
            array(
                "bkn_id" => "A5EB03E21CC2F6A0E040640A040252AD",
                "nama" => "SOLOK"),
            array(
                "bkn_id" => "A5EB03E21CC3F6A0E040640A040252AD",
                "nama" => "LUBUK SIKAPING"),
            array(
                "bkn_id" => "A5EB03E21CC4F6A0E040640A040252AD",
                "nama" => "PEKANBARU"),
            array(
                "bkn_id" => "A5EB03E21CC5F6A0E040640A040252AD",
                "nama" => "DUMAI"),
            array(
                "bkn_id" => "A5EB03E21CC6F6A0E040640A040252AD",
                "nama" => "TANJUNG PINANG"),
            array(
                "bkn_id" => "A5EB03E21CC7F6A0E040640A040252AD",
                "nama" => "RENGAT"),
            array(
                "bkn_id" => "A5EB03E21CC8F6A0E040640A040252AD",
                "nama" => "BATAM"),
            array(
                "bkn_id" => "A5EB03E21CC9F6A0E040640A040252AD",
                "nama" => "JAMBI"),
            array(
                "bkn_id" => "A5EB03E21CCAF6A0E040640A040252AD",
                "nama" => "MUARA BUNGO"),
            array(
                "bkn_id" => "A5EB03E21CCBF6A0E040640A040252AD",
                "nama" => "SUNGAI PENUH"),
            array(
                "bkn_id" => "A5EB03E21CCCF6A0E040640A040252AD",
                "nama" => "PALEMBANG"),
            array(
                "bkn_id" => "A5EB03E21CCDF6A0E040640A040252AD",
                "nama" => "PANGKAL PINANG"),
            array(
                "bkn_id" => "A5EB03E21CCEF6A0E040640A040252AD",
                "nama" => "TANJUNG PANDAN"),
            array(
                "bkn_id" => "A5EB03E21CCFF6A0E040640A040252AD",
                "nama" => "BATU RAJA"),
            array(
                "bkn_id" => "A5EB03E21CD0F6A0E040640A040252AD",
                "nama" => "LUBUK LINGGAU"),
            array(
                "bkn_id" => "A5EB03E21CD1F6A0E040640A040252AD",
                "nama" => "BENGKULU"),
            array(
                "bkn_id" => "A5EB03E21CD2F6A0E040640A040252AD",
                "nama" => "MANNA"),
            array(
                "bkn_id" => "A5EB03E21CD3F6A0E040640A040252AD",
                "nama" => "BANDAR LAMPUNG"),
            array(
                "bkn_id" => "A5EB03E21CD4F6A0E040640A040252AD",
                "nama" => "METRO LAMPUNG"),
            array(
                "bkn_id" => "A5EB03E21CD5F6A0E040640A040252AD",
                "nama" => "KOTABUMI"),
            array(
                "bkn_id" => "A5EB03E21CD6F6A0E040640A040252AD",
                "nama" => "JAKARTA-I"),
            array(
                "bkn_id" => "A5EB03E21CD7F6A0E040640A040252AD",
                "nama" => "JAKARTA-II"),
            array(
                "bkn_id" => "A5EB03E21CD8F6A0E040640A040252AD",
                "nama" => "JAKARTA-III"),
            array(
                "bkn_id" => "A5EB03E21CD9F6A0E040640A040252AD",
                "nama" => "JAKARTA-IV"),
            array(
                "bkn_id" => "A5EB03E21CDAF6A0E040640A040252AD",
                "nama" => "JAKARTA-V"),
            array(
                "bkn_id" => "A5EB03E21CDBF6A0E040640A040252AD",
                "nama" => "BANDUNG I"),
            array(
                "bkn_id" => "A5EB03E21CDCF6A0E040640A040252AD",
                "nama" => "BANDUNG II"),
            array(
                "bkn_id" => "A5EB03E21CDDF6A0E040640A040252AD",
                "nama" => "CIMAHI"),
            array(
                "bkn_id" => "A5EB03E21CDEF6A0E040640A040252AD",
                "nama" => "BOGOR"),
            array(
                "bkn_id" => "A5EB03E21CDFF6A0E040640A040252AD",
                "nama" => "SUKABUMI"),
            array(
                "bkn_id" => "A5EB03E21CE0F6A0E040640A040252AD",
                "nama" => "CIREBON"),
            array(
                "bkn_id" => "A5EB03E21CE1F6A0E040640A040252AD",
                "nama" => "TANGERANG"),
            array(
                "bkn_id" => "A5EB03E21CE2F6A0E040640A040252AD",
                "nama" => "KARAWANG"),
            array(
                "bkn_id" => "A5EB03E21CE3F6A0E040640A040252AD",
                "nama" => "PURWAKARTA"),
            array(
                "bkn_id" => "A5EB03E21CE4F6A0E040640A040252AD",
                "nama" => "SERANG"),
            array(
                "bkn_id" => "ff80808131dd3d110131dda3e38108c8",
                "nama" => "DIREKSI PERUM PERHUTANI UNIT II JATIM"),
            array(
                "bkn_id" => "ff80808131dd3d110131dda608e308f6",
                "nama" => "DIREKSI PT. INHUTANI II"),
            array(
                "bkn_id" => "ff80808131dd3d110131dda637800903",
                "nama" => "DIREKSI PT. INHUTANI III"),
            array(
                "bkn_id" => "ff80808134c73f010134cb9438ef3992",
                "nama" => "DPKKD"),
            array(
                "bkn_id" => "ff80808134e6131e0134ee8d8bf44611",
                "nama" => "PEKAS TNI WILAYAH JABAR"),
            array(
                "bkn_id" => "8ae48289355d949e013560cc4eef2207",
                "nama" => "PEKAS PUSPENERBAL"),
            array(
                "bkn_id" => "8ae48289355d949e013560d2fbec2253",
                "nama" => "PEKAS SATKAPAL 2 ARMATIM"),
            array(
                "bkn_id" => "8ae48289355d949e013560d5ec0b2286",
                "nama" => "PEKAS PASMAR 1"),
            array(
                "bkn_id" => "8ae48289355d949e013560d9ac0c22b3",
                "nama" => "PEKAS PASMAR 2"),
            array(
                "bkn_id" => "ff80808135e7d09f0135ec0e998456d7",
                "nama" => "PROPINSI MALUKU"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f65556f81e55",
                "nama" => "KAS PT. ANGKASA PURA I SELAPARANG"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66c6e3324af",
                "nama" => "KAS PT. AP II SULTAN SYARIF KASIM II"),
            array(
                "bkn_id" => "ff8080813a2b79f9013a2f94113438f5",
                "nama" => "BAGIAN KEUANGAN SETDA KAB NIAS"),
            array(
                "bkn_id" => "ff8080813e5a0f16013e638000f2287a",
                "nama" => "DINAS PENDAPATAN DAN PENGELOLAAN KEUANGAN DAERAH"),
            array(
                "bkn_id" => "ff8080813f9eb58e013fc24f5cf1148f",
                "nama" => "PEKAS TNI WILAYAH JAKARTA V"),
            array(
                "bkn_id" => "8ae48289424bc9400142548951063c66",
                "nama" => "KAS PT. ANGKASA PURA II HALIM PERDANAKUSUMA"),
            array(
                "bkn_id" => "8ae48287437185cf01437a52870c3ff9",
                "nama" => "BADAN PENGELOLAAN KEUANGAN DAN BARANG DAERAH"),
            array(
                "bkn_id" => "ff80808145a695af0145a7bfe59118f4",
                "nama" => "KAS PERUM LPPNPI BANDARA HUSEIN SASTRANEGARA BANDUNG"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7c69ca742c8",
                "nama" => "KAUR KEU SPRIPIM"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7cd13a95000",
                "nama" => "KAUR KEU DIVHUBINTER"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7ce97df53c1",
                "nama" => "KAUR KEU PUSKEU"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d005185662",
                "nama" => "KAUR KEU DITPOLSATWA"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d087c45715",
                "nama" => "KAUR KEU KORLANTAS"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d193db5942",
                "nama" => "KAUR KEU SSDM"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d21ff35ae4",
                "nama" => "KAUR KEU PUSDOKKES"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d2f55d5d9a",
                "nama" => "KAUR KEU RUMKIT BHY TK I"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d6b71e689b",
                "nama" => "KAUR KEU DITBINMAS"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d71ec669e7",
                "nama" => "KAUR KEU PUSJARAH"),
            array(
                "bkn_id" => "8ae4828754fd78f2015500dc214701d5",
                "nama" => "LANTAMAL XIII"),
            array(
                "bkn_id" => "8ae4828754fd78f2015500dcadb50208",
                "nama" => "LANTAMAL IV"),
            array(
                "bkn_id" => "8ae4828754fd78f2015500dd301f0242",
                "nama" => "RUMKITAL DR MIDIYATO S"),
            array(
                "bkn_id" => "8ae4828754fd78f2015500ddc2140251",
                "nama" => "LADOKGI YOS SUDARSO"),
            array(
                "bkn_id" => "8ae4828754fd78f2015500deab080260",
                "nama" => "LAFIAL"),
            array(
                "bkn_id" => "8ae4828754fd78f2015500dee8390263",
                "nama" => "LAKESAL"),
            array(
                "bkn_id" => "8ae48287568b5c420156922d25e1735b",
                "nama" => "SUMATERA BARAT"),
            array(
                "bkn_id" => "8ae4829d5778fe810157792e0da209bb",
                "nama" => "MUSI RAWAS UTARA"),
            array(
                "bkn_id" => "8ae482875818d2ac0158190825b90191",
                "nama" => "PAKU KOREM 081/DSJ NA.207.02"),
            array(
                "bkn_id" => "8ae482875818d2ac01581908d6f501a5",
                "nama" => "PAKU KOREM 082/CPYJ NA.2.07.03"),
            array(
                "bkn_id" => "8ae482875818d2ac01581909520601ab",
                "nama" => "PAKU KOREM 083/BDJ NA.204.04"),
            array(
                "bkn_id" => "8ae482875818d2ac01581909c31c01ba",
                "nama" => "PAKU KOREM 084/BJ NA.2.07.05"),
            array(
                "bkn_id" => "8ae482875818d2ac0158190a59f201c0",
                "nama" => "PAKU RINDAM NA.2.07.06"),
            array(
                "bkn_id" => "8ae482875818d2ac0158190ab0db02a2",
                "nama" => "PAKU ZIDAM NA.2.07.07"),
            array(
                "bkn_id" => "8ae482875818d2ac0158190b9d8b02f8",
                "nama" => "PAKU PALDAM NA.2.07.09"),
            array(
                "bkn_id" => "8ae482875818d2ac0158190bf49e02fa",
                "nama" => "PAKU HUBDAM NA.2.07.10"),
            array(
                "bkn_id" => "8ae482875818d2ac0158190c3db70300",
                "nama" => "PAKU KESDAM NA.2.07.11"),
            array(
                "bkn_id" => "8ae482875818d2ac0158190cce320309",
                "nama" => "PAKU BRIGIF 16/WY NA.207.12"),
            array(
                "bkn_id" => "8ae482885893962001589474dd2e5209",
                "nama" => "KEPULAUAN RIAU"),
            array(
                "bkn_id" => "8ae48288589396200158947d699456c3",
                "nama" => "POLEWALI"),
            array(
                "bkn_id" => "8ae4828859b32c060159b4cc077d05a7",
                "nama" => "PAKU RSPAD GS NA.2.01.19"),
            array(
                "bkn_id" => "8ae482a759b076c20159ba3f886a2fb8",
                "nama" => "BADAN KEUANGAN DAN ASET DAERAH (BKAD)"),
            array(
                "bkn_id" => "8ae482a75a3b6efc015a4537ba4a4375",
                "nama" => "PENUKAL ABAB LEMATANG ILIR"),
            array(
                "bkn_id" => "8ae482875aa14cd3015aa1e9490e2057",
                "nama" => "BADAN PENGELOLAAN KEUANGAN DAN PAJAK DAERAH"),
            array(
                "bkn_id" => "8ae482885aad58b1015ab1c088773d41",
                "nama" => "BADAN PENGELOLAAN KEUANGAN, PENDAPATAN DAN ASET DAERAH"),
            array(
                "bkn_id" => "8ae482a55d3c7c5d015d3f2c8f653af2",
                "nama" => "BKPSDM"),
            array(
                "bkn_id" => "8ae483a85f94bd2a015f9558311756de",
                "nama" => "KAS PERUM LPPNPI BANDAR UDARA HANG NADIM BATAM"),
            array(
                "bkn_id" => "8ae483a560a02d580160a045f63d07b0",
                "nama" => "MEMPAWAH"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc5795af3649b",
                "nama" => "Paku TNI Wilayah Jakarta I"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc581d4fd653d",
                "nama" => "Paku TNI Wilayah Jakarta VIII"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc5833580658e",
                "nama" => "Paku TNI Wilayah Jakarta XI"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc58541376598",
                "nama" => "Paku TNI Wilayah Jakarta XVI"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc58858ae65ca",
                "nama" => "Paku TNI Wilayah Sumbagut"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc588e17d65cf",
                "nama" => "Paku TNI Wilayah Sumbagsel"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc5897f3e65d4",
                "nama" => "Paku TNI Wilayah Jabar"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc58b30e865da",
                "nama" => "Paku TNI Wilayah Papua I"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc58e63e065ec",
                "nama" => "Paku TNI Wilayah Maluku"),
            array(
                "bkn_id" => "8ae483a57009b3d40170187898ce4fc2",
                "nama" => "Pekas Gabpus NA.1.02.04"),
            array(
                "bkn_id" => "8ae483c674e9e5ad0175063bc9a76038",
                "nama" => "BPKA Yogyakarta"),
            array(
                "bkn_id" => "8ae483a57d510c20017d553798d5303e",
                "nama" => "RUMKITALMAR CILANDAK"),
            array(
                "bkn_id" => "A5EB03E21EA2F6A0E040640A040252AD",
                "nama" => "01 KU POLDA SUMUT"),
            array(
                "bkn_id" => "A5EB03E21EA3F6A0E040640A040252AD",
                "nama" => "02 KU POLDA SUMUT"),
            array(
                "bkn_id" => "A5EB03E21EA5F6A0E040640A040252AD",
                "nama" => "04 KU POLDA SUMUT"),
            array(
                "bkn_id" => "A5EB03E21EA6F6A0E040640A040252AD",
                "nama" => "01 KU POLDA SUMBAR"),
            array(
                "bkn_id" => "A5EB03E21EA7F6A0E040640A040252AD",
                "nama" => "02 KU POLDA SUMBAR"),
            array(
                "bkn_id" => "A5EB03E21EA8F6A0E040640A040252AD",
                "nama" => "01 KU POLDA RIAU"),
            array(
                "bkn_id" => "A5EB03E21EAAF6A0E040640A040252AD",
                "nama" => "01 KU POLDA KALBAR"),
            array(
                "bkn_id" => "A5EB03E21EABF6A0E040640A040252AD",
                "nama" => "02 KU POLDA KALBAR"),
            array(
                "bkn_id" => "A5EB03E21EACF6A0E040640A040252AD",
                "nama" => "03 KU POLDA KALBAR"),
            array(
                "bkn_id" => "A5EB03E21EAEF6A0E040640A040252AD",
                "nama" => "02 KU POLDA SUMSEL"),
            array(
                "bkn_id" => "A5EB03E21EAFF6A0E040640A040252AD",
                "nama" => "03 KU POLDA SUMSEL"),
            array(
                "bkn_id" => "A5EB03E21EB0F6A0E040640A040252AD",
                "nama" => "04 KU POLDA SUMSEL"),
            array(
                "bkn_id" => "A5EB03E21EB1F6A0E040640A040252AD",
                "nama" => "05 KU POLDA SUMSEL"),
            array(
                "bkn_id" => "A5EB03E21EB2F6A0E040640A040252AD",
                "nama" => "01 POLDA METRO JAYA"),
            array(
                "bkn_id" => "A5EB03E21EB3F6A0E040640A040252AD",
                "nama" => "02 POLDA METRO JAYA"),
            array(
                "bkn_id" => "A5EB03E21EB4F6A0E040640A040252AD",
                "nama" => "03 POLDA METRO JAYA"),
            array(
                "bkn_id" => "A5EB03E21EB6F6A0E040640A040252AD",
                "nama" => "02 KU POLDA JABAR"),
            array(
                "bkn_id" => "A5EB03E21EB7F6A0E040640A040252AD",
                "nama" => "03 KU POLDA JABAR"),
            array(
                "bkn_id" => "A5EB03E21EB8F6A0E040640A040252AD",
                "nama" => "04 KU POLDA JABAR"),
            array(
                "bkn_id" => "A5EB03E21EB9F6A0E040640A040252AD",
                "nama" => "05 KU POLDA JABAR"),
            array(
                "bkn_id" => "A5EB03E21EBBF6A0E040640A040252AD",
                "nama" => "01 KU POLDA JATENG"),
            array(
                "bkn_id" => "A5EB03E21EBCF6A0E040640A040252AD",
                "nama" => "02 KU POLDA JATENG"),
            array(
                "bkn_id" => "A5EB03E21EBDF6A0E040640A040252AD",
                "nama" => "03 KU POLDA JATENG"),
            array(
                "bkn_id" => "A5EB03E21EBFF6A0E040640A040252AD",
                "nama" => "BIRO KEUANGAN"),
            array(
                "bkn_id" => "A5EB03E21EC0F6A0E040640A040252AD",
                "nama" => "BAGIAN KEUANGAN"),
            array(
                "bkn_id" => "A5EB03E21EC1F6A0E040640A040252AD",
                "nama" => "KUALA TUNGKAL"),
            array(
                "bkn_id" => "A5EB03E21EC2F6A0E040640A040252AD",
                "nama" => "LIWA"),
            array(
                "bkn_id" => "A5EB03E21EC3F6A0E040640A040252AD",
                "nama" => "LAHAT"),
            array(
                "bkn_id" => "A5EB03E21EC4F6A0E040640A040252AD",
                "nama" => "TIMIKA"),
            array(
                "bkn_id" => "A5EB03E21EC5F6A0E040640A040252AD",
                "nama" => "NUNUKAN"),
            array(
                "bkn_id" => "A5EB03E21EC6F6A0E040640A040252AD",
                "nama" => "BLITAR"),
            array(
                "bkn_id" => "A5EB03E21EC7F6A0E040640A040252AD",
                "nama" => "05 KU POLDA JATENG"),
            array(
                "bkn_id" => "A5EB03E21EC8F6A0E040640A040252AD",
                "nama" => "06 KU POLDA JATENG"),
            array(
                "bkn_id" => "A5EB03E21EC9F6A0E040640A040252AD",
                "nama" => "07 KU POLDA JATENG"),
            array(
                "bkn_id" => "A5EB03E21ECAF6A0E040640A040252AD",
                "nama" => "08 KU POLDA JATENG"),
            array(
                "bkn_id" => "A5EB03E21ECBF6A0E040640A040252AD",
                "nama" => "BANGKO"),
            array(
                "bkn_id" => "A5EB03E21ECCF6A0E040640A040252AD",
                "nama" => "BANTEN"),
            array(
                "bkn_id" => "A5EB03E21ECDF6A0E040640A040252AD",
                "nama" => "BANGKINANG"),
            array(
                "bkn_id" => "A5EB03E21ECEF6A0E040640A040252AD",
                "nama" => "BANGLI"),
            array(
                "bkn_id" => "A5EB03E21ECFF6A0E040640A040252AD",
                "nama" => "TEMBILAHAN"),
            array(
                "bkn_id" => "A5EB03E21ED0F6A0E040640A040252AD",
                "nama" => "JAYAWIJAYA"),
            array(
                "bkn_id" => "A5EB03E21ED1F6A0E040640A040252AD",
                "nama" => "DINAS PENDAPATAN KEU.BARANG DAERAH"),
            array(
                "bkn_id" => "A5EB03E21ED2F6A0E040640A040252AD",
                "nama" => "SARMI"),
            array(
                "bkn_id" => "A5EB03E21ED3F6A0E040640A040252AD",
                "nama" => "BAGIAN KEUANGAN SETDA"),
            array(
                "bkn_id" => "A5EB03E21ED6F6A0E040640A040252AD",
                "nama" => "ASS.IV BIDANG KEUANGAN"),
            array(
                "bkn_id" => "A5EB03E21ED7F6A0E040640A040252AD",
                "nama" => "SIGLI"),
            array(
                "bkn_id" => "A5EB03E21ED8F6A0E040640A040252AD",
                "nama" => "SINGKIL"),
            array(
                "bkn_id" => "A5EB03E21ED9F6A0E040640A040252AD",
                "nama" => "PASURUAN"),
            array(
                "bkn_id" => "A5EB03E21EDAF6A0E040640A040252AD",
                "nama" => "SOASIO"),
            array(
                "bkn_id" => "A5EB03E21EDBF6A0E040640A040252AD",
                "nama" => "MANSA"),
            array(
                "bkn_id" => "A5EB03E21EDCF6A0E040640A040252AD",
                "nama" => "RANAI"),
            array(
                "bkn_id" => "A5EB03E21EDDF6A0E040640A040252AD",
                "nama" => "PEKAS MABES TNI"),
            array(
                "bkn_id" => "A5EB03E21EDEF6A0E040640A040252AD",
                "nama" => "PEKAS DEPHAN"),
            array(
                "bkn_id" => "A5EB03E21EDFF6A0E040640A040252AD",
                "nama" => "KASDA"),
            array(
                "bkn_id" => "A5EB03E21EE0F6A0E040640A040252AD",
                "nama" => "BADAN KEUANGAN DAERAH"),
            array(
                "bkn_id" => "A5EB03E21EE1F6A0E040640A040252AD",
                "nama" => "BANJARBARU"),
            array(
                "bkn_id" => "A5EB03E21EE2F6A0E040640A040252AD",
                "nama" => "KARANG ASEM"),
            array(
                "bkn_id" => "A5EB03E21EE3F6A0E040640A040252AD",
                "nama" => "BONTANG"),
            array(
                "bkn_id" => "A5EB03E21EE4F6A0E040640A040252AD",
                "nama" => "BADAN PENGELOLA KEUANGAN DAERAH"),
            array(
                "bkn_id" => "A5EB03E21EE5F6A0E040640A040252AD",
                "nama" => "BADAN PENGELOLAAN KEU. & KEKAYAAN DAERAH"),
            array(
                "bkn_id" => "A5EB03E21EE6F6A0E040640A040252AD",
                "nama" => "DINPENDA DAN PENGELOLAAN KEU DAERAH"),
            array(
                "bkn_id" => "A5EB03E21EE7F6A0E040640A040252AD",
                "nama" => "DPPKAD"),
            array(
                "bkn_id" => "A637937E58251DDEE040640A02023CD9",
                "nama" => "TANJUNG JABUNG TIMUR"),
            array(
                "bkn_id" => "A637937E58261DDEE040640A02023CD9",
                "nama" => "MUARA ENIM"),
            array(
                "bkn_id" => "A637937E58271DDEE040640A02023CD9",
                "nama" => "BANJAR"),
            array(
                "bkn_id" => "A637937E58281DDEE040640A02023CD9",
                "nama" => "LAMPUNG TIMUR"),
            array(
                "bkn_id" => "A637937E58291DDEE040640A02023CD9",
                "nama" => "LAMANDAU"),
            array(
                "bkn_id" => "A637937E582A1DDEE040640A02023CD9",
                "nama" => "INDRAMAYU"),
            array(
                "bkn_id" => "A637937E582B1DDEE040640A02023CD9",
                "nama" => "DELI SERDANG"),
            array(
                "bkn_id" => "A637937E582C1DDEE040640A02023CD9",
                "nama" => "MAMASA"),
            array(
                "bkn_id" => "A637937E582D1DDEE040640A02023CD9",
                "nama" => "SUMBA TIMUR"),
            array(
                "bkn_id" => "A637937E582E1DDEE040640A02023CD9",
                "nama" => "GAYO LUES"),
            array(
                "bkn_id" => "A637937E582F1DDEE040640A02023CD9",
                "nama" => "ALOR"),
            array(
                "bkn_id" => "A637937E58301DDEE040640A02023CD9",
                "nama" => "OGAN KOMERING ULU"),
            array(
                "bkn_id" => "A637937E58311DDEE040640A02023CD9",
                "nama" => "KEPULAUAN SERIBU"),
            array(
                "bkn_id" => "A637937E58321DDEE040640A02023CD9",
                "nama" => "NGADA"),
            array(
                "bkn_id" => "A637937E58331DDEE040640A02023CD9",
                "nama" => "BOYOLALI"),
            array(
                "bkn_id" => "A637937E58341DDEE040640A02023CD9",
                "nama" => "MAJALENGKA"),
            array(
                "bkn_id" => "A637937E58351DDEE040640A02023CD9",
                "nama" => "PONOROGO"),
            array(
                "bkn_id" => "A637937E58361DDEE040640A02023CD9",
                "nama" => "BULUKUMBA"),
            array(
                "bkn_id" => "A637937E58371DDEE040640A02023CD9",
                "nama" => "SABU RAIJUA"),
            array(
                "bkn_id" => "A637937E58381DDEE040640A02023CD9",
                "nama" => "SAWAHLUNTO/SIJUNJUNG"),
            array(
                "bkn_id" => "A637937E58391DDEE040640A02023CD9",
                "nama" => "SIAU TAGULANDANG BIARO"),
            array(
                "bkn_id" => "A637937E583A1DDEE040640A02023CD9",
                "nama" => "BANDUNG BARAT"),
            array(
                "bkn_id" => "A637937E583B1DDEE040640A02023CD9",
                "nama" => "RAJA AMPAT"),
            array(
                "bkn_id" => "A637937E583C1DDEE040640A02023CD9",
                "nama" => "KUTAI TIMUR"),
            array(
                "bkn_id" => "A637937E583D1DDEE040640A02023CD9",
                "nama" => "BUTON UTARA"),
            array(
                "bkn_id" => "A637937E583E1DDEE040640A02023CD9",
                "nama" => "SIAK"),
            array(
                "bkn_id" => "A637937E583F1DDEE040640A02023CD9",
                "nama" => "TEBO"),
            array(
                "bkn_id" => "A637937E58401DDEE040640A02023CD9",
                "nama" => "LOMBOK UTARA"),
            array(
                "bkn_id" => "A637937E58411DDEE040640A02023CD9",
                "nama" => "LAMPUNG UTARA"),
            array(
                "bkn_id" => "A637937E58421DDEE040640A02023CD9",
                "nama" => "WAROPEN"),
            array(
                "bkn_id" => "A637937E58431DDEE040640A02023CD9",
                "nama" => "PESISIR SELATAN"),
            array(
                "bkn_id" => "A637937E58441DDEE040640A02023CD9",
                "nama" => "TAPIN"),
            array(
                "bkn_id" => "A637937E58451DDEE040640A02023CD9",
                "nama" => "POHUWATO"),
            array(
                "bkn_id" => "A637937E58461DDEE040640A02023CD9",
                "nama" => "NGAWI"),
            array(
                "bkn_id" => "A637937E58471DDEE040640A02023CD9",
                "nama" => "AGAM"),
            array(
                "bkn_id" => "A637937E58481DDEE040640A02023CD9",
                "nama" => "BENGKALIS"),
            array(
                "bkn_id" => "A637937E58491DDEE040640A02023CD9",
                "nama" => "KAYONG UTARA"),
            array(
                "bkn_id" => "A637937E584A1DDEE040640A02023CD9",
                "nama" => "BUTON"),
            array(
                "bkn_id" => "A637937E584B1DDEE040640A02023CD9",
                "nama" => "KAMPAR"),
            array(
                "bkn_id" => "A637937E584C1DDEE040640A02023CD9",
                "nama" => "PARIGI MOUTONG"),
            array(
                "bkn_id" => "A637937E584D1DDEE040640A02023CD9",
                "nama" => "KEPULAUAN ANAMBAS"),
            array(
                "bkn_id" => "A637937E584E1DDEE040640A02023CD9",
                "nama" => "JEMBRANA"),
            array(
                "bkn_id" => "A637937E584F1DDEE040640A02023CD9",
                "nama" => "LABUHANBATU SELATAN"),
            array(
                "bkn_id" => "A637937E58501DDEE040640A02023CD9",
                "nama" => "BIAK NUMFOR"),
            array(
                "bkn_id" => "A637937E58511DDEE040640A02023CD9",
                "nama" => "DHARMASRAYA"),
            array(
                "bkn_id" => "A637937E58521DDEE040640A02023CD9",
                "nama" => "JAKARTA TIMUR"),
            array(
                "bkn_id" => "A637937E58531DDEE040640A02023CD9",
                "nama" => "BANGKA SELATAN"),
            array(
                "bkn_id" => "A637937E58541DDEE040640A02023CD9",
                "nama" => "KEPAHIANG"),
            array(
                "bkn_id" => "A637937E58551DDEE040640A02023CD9",
                "nama" => "GUNUNG KIDUL"),
            array(
                "bkn_id" => "A637937E58561DDEE040640A02023CD9",
                "nama" => "SUBULUSSALAM"),
            array(
                "bkn_id" => "A637937E58571DDEE040640A02023CD9",
                "nama" => "GUNUNG MAS"),
            array(
                "bkn_id" => "A637937E58581DDEE040640A02023CD9",
                "nama" => "PUNCAK"),
            array(
                "bkn_id" => "A637937E58591DDEE040640A02023CD9",
                "nama" => "JAKARTA PUSAT"),
            array(
                "bkn_id" => "A637937E585A1DDEE040640A02023CD9",
                "nama" => "SEKADAU"),
            array(
                "bkn_id" => "A637937E585B1DDEE040640A02023CD9",
                "nama" => "LINGGA"),
            array(
                "bkn_id" => "A637937E585C1DDEE040640A02023CD9",
                "nama" => "MAROS"),
            array(
                "bkn_id" => "A637937E585D1DDEE040640A02023CD9",
                "nama" => "TRENGGALEK"),
            array(
                "bkn_id" => "A637937E585E1DDEE040640A02023CD9",
                "nama" => "BUNGO"),
            array(
                "bkn_id" => "A637937E585F1DDEE040640A02023CD9",
                "nama" => "BOLAANG MONGONDOW TIMUR"),
            array(
                "bkn_id" => "A637937E58601DDEE040640A02023CD9",
                "nama" => "LAMPUNG TENGAH"),
            array(
                "bkn_id" => "A637937E58611DDEE040640A02023CD9",
                "nama" => "KONAWE SELATAN"),
            array(
                "bkn_id" => "A637937E58621DDEE040640A02023CD9",
                "nama" => "INDRAGIRI HULU"),
            array(
                "bkn_id" => "A637937E58631DDEE040640A02023CD9",
                "nama" => "SUMBA BARAT DAYA"),
            array(
                "bkn_id" => "A637937E58641DDEE040640A02023CD9",
                "nama" => "FAK-FAK"),
            array(
                "bkn_id" => "A637937E58651DDEE040640A02023CD9",
                "nama" => "LUWU TIMUR"),
            array(
                "bkn_id" => "A637937E58661DDEE040640A02023CD9",
                "nama" => "BIREUEN"),
            array(
                "bkn_id" => "A637937E58671DDEE040640A02023CD9",
                "nama" => "MUSI BANYU ASIN"),
            array(
                "bkn_id" => "A637937E58681DDEE040640A02023CD9",
                "nama" => "DEMAK"),
            array(
                "bkn_id" => "A637937E58691DDEE040640A02023CD9",
                "nama" => "LEBONG"),
            array(
                "bkn_id" => "A637937E586A1DDEE040640A02023CD9",
                "nama" => "OGAN KOMERING ULU SELATAN"),
            array(
                "bkn_id" => "A637937E586B1DDEE040640A02023CD9",
                "nama" => "BADUNG"),
            array(
                "bkn_id" => "A637937E586C1DDEE040640A02023CD9",
                "nama" => "ACEH BESAR"),
            array(
                "bkn_id" => "A637937E586D1DDEE040640A02023CD9",
                "nama" => "MINAHASA UTARA"),
            array(
                "bkn_id" => "A637937E586E1DDEE040640A02023CD9",
                "nama" => "MUARO JAMBI"),
            array(
                "bkn_id" => "A637937E586F1DDEE040640A02023CD9",
                "nama" => "MUNA"),
            array(
                "bkn_id" => "A637937E58701DDEE040640A02023CD9",
                "nama" => "KOTA TANGERANG SELATAN"),
            array(
                "bkn_id" => "A637937E58711DDEE040640A02023CD9",
                "nama" => "TANJUNG JABUNG BARAT"),
            array(
                "bkn_id" => "A637937E58721DDEE040640A02023CD9",
                "nama" => "GROBOGAN"),
            array(
                "bkn_id" => "A637937E58731DDEE040640A02023CD9",
                "nama" => "BOMBANA"),
            array(
                "bkn_id" => "A637937E58741DDEE040640A02023CD9",
                "nama" => "HULU SUNGAI SELATAN"),
            array(
                "bkn_id" => "A637937E58751DDEE040640A02023CD9",
                "nama" => "NATUNA"),
            array(
                "bkn_id" => "A637937E58761DDEE040640A02023CD9",
                "nama" => "DONGGALA"),
            array(
                "bkn_id" => "A637937E58771DDEE040640A02023CD9",
                "nama" => "ACEH TIMUR"),
            array(
                "bkn_id" => "A637937E58781DDEE040640A02023CD9",
                "nama" => "BOALEMO"),
            array(
                "bkn_id" => "A637937E58791DDEE040640A02023CD9",
                "nama" => "SUMBA TENGAH"),
            array(
                "bkn_id" => "A637937E587A1DDEE040640A02023CD9",
                "nama" => "LUWU"),
            array(
                "bkn_id" => "A637937E587B1DDEE040640A02023CD9",
                "nama" => "LOMBOK BARAT"),
            array(
                "bkn_id" => "A637937E587C1DDEE040640A02023CD9",
                "nama" => "FLORES TIMUR"),
            array(
                "bkn_id" => "A637937E587D1DDEE040640A02023CD9",
                "nama" => "PUNCAK JAYA"),
            array(
                "bkn_id" => "A637937E587E1DDEE040640A02023CD9",
                "nama" => "MAMUJU UTARA"),
            array(
                "bkn_id" => "A637937E587F1DDEE040640A02023CD9",
                "nama" => "SUKOHARJO"),
            array(
                "bkn_id" => "A637937E58801DDEE040640A02023CD9",
                "nama" => "NIAS SELATAN"),
            array(
                "bkn_id" => "A637937E58811DDEE040640A02023CD9",
                "nama" => "KOLAKA UTARA"),
            array(
                "bkn_id" => "A637937E58821DDEE040640A02023CD9",
                "nama" => "CIAMIS"),
            array(
                "bkn_id" => "A637937E58831DDEE040640A02023CD9",
                "nama" => "ROKAN HULU"),
            array(
                "bkn_id" => "A637937E58841DDEE040640A02023CD9",
                "nama" => "HALMAHERA TIMUR"),
            array(
                "bkn_id" => "A637937E58851DDEE040640A02023CD9",
                "nama" => "KARIMUN"),
            array(
                "bkn_id" => "A637937E58861DDEE040640A02023CD9",
                "nama" => "TAPANULI TENGAH"),
            array(
                "bkn_id" => "A637937E58871DDEE040640A02023CD9",
                "nama" => "KUTAI BARAT"),
            array(
                "bkn_id" => "A637937E58881DDEE040640A02023CD9",
                "nama" => "PEKAN BARU"),
            array(
                "bkn_id" => "A637937E58891DDEE040640A02023CD9",
                "nama" => "ASMAT"),
            array(
                "bkn_id" => "A637937E588A1DDEE040640A02023CD9",
                "nama" => "SAMPANG"),
            array(
                "bkn_id" => "A637937E588B1DDEE040640A02023CD9",
                "nama" => "BANGGAI"),
            array(
                "bkn_id" => "A637937E588C1DDEE040640A02023CD9",
                "nama" => "ACEH TENGAH"),
            array(
                "bkn_id" => "A637937E588E1DDEE040640A02023CD9",
                "nama" => "KOTA SERANG"),
            array(
                "bkn_id" => "A637937E588F1DDEE040640A02023CD9",
                "nama" => "NDUGA"),
            array(
                "bkn_id" => "A637937E58901DDEE040640A02023CD9",
                "nama" => "BULUNGAN"),
            array(
                "bkn_id" => "A637937E58911DDEE040640A02023CD9",
                "nama" => "SAWAH LUNTO"),
            array(
                "bkn_id" => "A637937E58921DDEE040640A02023CD9",
                "nama" => "LABUHANBATU UTARA"),
            array(
                "bkn_id" => "A637937E58931DDEE040640A02023CD9",
                "nama" => "MEDAN"),
            array(
                "bkn_id" => "A637937E58941DDEE040640A02023CD9",
                "nama" => "SELAYAR"),
            array(
                "bkn_id" => "A637937E58961DDEE040640A02023CD9",
                "nama" => "LAMONGAN"),
            array(
                "bkn_id" => "A637937E58971DDEE040640A02023CD9",
                "nama" => "TANAH BUMBU"),
            array(
                "bkn_id" => "A637937E58981DDEE040640A02023CD9",
                "nama" => "KEPULAUAN ARU"),
            array(
                "bkn_id" => "A637937E58991DDEE040640A02023CD9",
                "nama" => "MAMBERAMO RAYA"),
            array(
                "bkn_id" => "A637937E589A1DDEE040640A02023CD9",
                "nama" => "ACEH JAYA"),
            array(
                "bkn_id" => "A637937E589C1DDEE040640A02023CD9",
                "nama" => "SERAM BAGIAN TIMUR"),
            array(
                "bkn_id" => "A637937E589D1DDEE040640A02023CD9",
                "nama" => "PULAU MOROTAI"),
            array(
                "bkn_id" => "A637937E589E1DDEE040640A02023CD9",
                "nama" => "KEEROM"),
            array(
                "bkn_id" => "A637937E589F1DDEE040640A02023CD9",
                "nama" => "LAMPUNG SELATAN"),
            array(
                "bkn_id" => "A637937E58A01DDEE040640A02023CD9",
                "nama" => "BARRU"),
            array(
                "bkn_id" => "A637937E58A21DDEE040640A02023CD9",
                "nama" => "MAGETAN"),
            array(
                "bkn_id" => "A637937E58A31DDEE040640A02023CD9",
                "nama" => "SERUYAN"),
            array(
                "bkn_id" => "A637937E58A41DDEE040640A02023CD9",
                "nama" => "TOBA SAMOSIR"),
            array(
                "bkn_id" => "A637937E58A51DDEE040640A02023CD9",
                "nama" => "PINRANG"),
            array(
                "bkn_id" => "A637937E58A61DDEE040640A02023CD9",
                "nama" => "BATUBARA"),
            array(
                "bkn_id" => "A637937E58A71DDEE040640A02023CD9",
                "nama" => "BAU-BAU"),
            array(
                "bkn_id" => "A637937E58A91DDEE040640A02023CD9",
                "nama" => "BELU"),
            array(
                "bkn_id" => "A637937E58AA1DDEE040640A02023CD9",
                "nama" => "SUMBAWA"),
            array(
                "bkn_id" => "A637937E58AB1DDEE040640A02023CD9",
                "nama" => "KEPULAUAN SELAYAR"),
            array(
                "bkn_id" => "A637937E58AC1DDEE040640A02023CD9",
                "nama" => "PIDIE JAYA"),
            array(
                "bkn_id" => "A637937E58AD1DDEE040640A02023CD9",
                "nama" => "SAROLANGUN"),
            array(
                "bkn_id" => "A637937E58AE1DDEE040640A02023CD9",
                "nama" => "MANGGARAI"),
            array(
                "bkn_id" => "A637937E58AF1DDEE040640A02023CD9",
                "nama" => "BENER MERIAH"),
            array(
                "bkn_id" => "A637937E58B01DDEE040640A02023CD9",
                "nama" => "LEMBATA"),
            array(
                "bkn_id" => "A637937E58B11DDEE040640A02023CD9",
                "nama" => "BELITUNG TIMUR"),
            array(
                "bkn_id" => "A637937E58B21DDEE040640A02023CD9",
                "nama" => "TAKALAR"),
            array(
                "bkn_id" => "A637937E58B31DDEE040640A02023CD9",
                "nama" => "BUOL"),
            array(
                "bkn_id" => "A637937E58B41DDEE040640A02023CD9",
                "nama" => "PASAMAN"),
            array(
                "bkn_id" => "A637937E58B51DDEE040640A02023CD9",
                "nama" => "REJANG LEBONG"),
            array(
                "bkn_id" => "A637937E58B61DDEE040640A02023CD9",
                "nama" => "BENGKULU SELATAN"),
            array(
                "bkn_id" => "A637937E58B71DDEE040640A02023CD9",
                "nama" => "KARO"),
            array(
                "bkn_id" => "A637937E58B81DDEE040640A02023CD9",
                "nama" => "PIDIE"),
            array(
                "bkn_id" => "A637937E58B91DDEE040640A02023CD9",
                "nama" => "PANIAI"),
            array(
                "bkn_id" => "A637937E58BA1DDEE040640A02023CD9",
                "nama" => "LOMBOK TIMUR"),
            array(
                "bkn_id" => "A637937E58BB1DDEE040640A02023CD9",
                "nama" => "PADANG PARIAMAN"),
            array(
                "bkn_id" => "A637937E58BC1DDEE040640A02023CD9",
                "nama" => "BOLAANG MONGONDOW UTARA"),
            array(
                "bkn_id" => "A637937E58BD1DDEE040640A02023CD9",
                "nama" => "BONE"),
            array(
                "bkn_id" => "A637937E58BE1DDEE040640A02023CD9",
                "nama" => "NAGEKEO"),
            array(
                "bkn_id" => "A637937E58BF1DDEE040640A02023CD9",
                "nama" => "POLEWALI MANDAR"),
            array(
                "bkn_id" => "A637937E58C01DDEE040640A02023CD9",
                "nama" => "MINAHASA TENGGARA"),
            array(
                "bkn_id" => "A637937E58C11DDEE040640A02023CD9",
                "nama" => "MERANGIN"),
            array(
                "bkn_id" => "A637937E58C21DDEE040640A02023CD9",
                "nama" => "BOVEN DIGOEL"),
            array(
                "bkn_id" => "A637937E58C31DDEE040640A02023CD9",
                "nama" => "BATANG"),
            array(
                "bkn_id" => "A637937E58C41DDEE040640A02023CD9",
                "nama" => "TANAH LAUT"),
            array(
                "bkn_id" => "A637937E58C51DDEE040640A02023CD9",
                "nama" => "KEBUMEN"),
            array(
                "bkn_id" => "A637937E58C61DDEE040640A02023CD9",
                "nama" => "BELITUNG"),
            array(
                "bkn_id" => "A637937E58C71DDEE040640A02023CD9",
                "nama" => "SURABAYA"),
            array(
                "bkn_id" => "A637937E58C81DDEE040640A02023CD9",
                "nama" => "MAMBERAMO TENGAH"),
            array(
                "bkn_id" => "A637937E58C91DDEE040640A02023CD9",
                "nama" => "TIMOR TENGAH UTARA"),
            array(
                "bkn_id" => "A637937E58CA1DDEE040640A02023CD9",
                "nama" => "MALUKU BARAT DAYA"),
            array(
                "bkn_id" => "A637937E58CB1DDEE040640A02023CD9",
                "nama" => "BULELENG"),
            array(
                "bkn_id" => "A637937E58CC1DDEE040640A02023CD9",
                "nama" => "MENTAWAI"),
            array(
                "bkn_id" => "A637937E58CD1DDEE040640A02023CD9",
                "nama" => "BANDUNG"),
            array(
                "bkn_id" => "A637937E58CE1DDEE040640A02023CD9",
                "nama" => "TANA TIDUNG"),
            array(
                "bkn_id" => "A637937E58CF1DDEE040640A02023CD9",
                "nama" => "SORONG SELATAN"),
            array(
                "bkn_id" => "A637937E58D01DDEE040640A02023CD9",
                "nama" => "TIDORE KEPULAUAN"),
            array(
                "bkn_id" => "A637937E58D11DDEE040640A02023CD9",
                "nama" => "TELUK WONDAMA"),
            array(
                "bkn_id" => "A637937E58D21DDEE040640A02023CD9",
                "nama" => "BANTUL"),
            array(
                "bkn_id" => "A637937E58D31DDEE040640A02023CD9",
                "nama" => "TAMBRAUW"),
            array(
                "bkn_id" => "A637937E58D41DDEE040640A02023CD9",
                "nama" => "PAKPAK BHARAT"),
            array(
                "bkn_id" => "A637937E58D51DDEE040640A02023CD9",
                "nama" => "TULANG BAWANG"),
            array(
                "bkn_id" => "A637937E58D61DDEE040640A02023CD9",
                "nama" => "PARE-PARE"),
            array(
                "bkn_id" => "A637937E58D71DDEE040640A02023CD9",
                "nama" => "HUMBANG HASUNDUTAN"),
            array(
                "bkn_id" => "A637937E58D81DDEE040640A02023CD9",
                "nama" => "WAY KANAN"),
            array(
                "bkn_id" => "A637937E58D91DDEE040640A02023CD9",
                "nama" => "DEIYAI"),
            array(
                "bkn_id" => "A637937E58DA1DDEE040640A02023CD9",
                "nama" => "WAKATOBI "),
            array(
                "bkn_id" => "A637937E58DB1DDEE040640A02023CD9",
                "nama" => "PEMALANG"),
            array(
                "bkn_id" => "A637937E58DC1DDEE040640A02023CD9",
                "nama" => "BENGKULU TENGAH"),
            array(
                "bkn_id" => "A637937E58DD1DDEE040640A02023CD9",
                "nama" => "PURBALINGGA"),
            array(
                "bkn_id" => "A637937E58DE1DDEE040640A02023CD9",
                "nama" => "KUBU RAYA"),
            array(
                "bkn_id" => "A637937E58DF1DDEE040640A02023CD9",
                "nama" => "BARITO UTARA"),
            array(
                "bkn_id" => "A637937E58E01DDEE040640A02023CD9",
                "nama" => "SAMBAS"),
            array(
                "bkn_id" => "A637937E58E11DDEE040640A02023CD9",
                "nama" => "TANA TORAJA"),
            array(
                "bkn_id" => "A637937E58E21DDEE040640A02023CD9",
                "nama" => "SIDENRENG RAPPANG"),
            array(
                "bkn_id" => "A637937E58E31DDEE040640A02023CD9",
                "nama" => "CIANJUR"),
            array(
                "bkn_id" => "A637937E58E41DDEE040640A02023CD9",
                "nama" => "SUMBAWA BARAT"),
            array(
                "bkn_id" => "A637937E58E51DDEE040640A02023CD9",
                "nama" => "BOLAANG MONGONDOW SELATAN"),
            array(
                "bkn_id" => "A637937E58E61DDEE040640A02023CD9",
                "nama" => "KOTAWARINGIN TIMUR"),
            array(
                "bkn_id" => "A637937E58E71DDEE040640A02023CD9",
                "nama" => "SUBANG"),
            array(
                "bkn_id" => "A637937E58E81DDEE040640A02023CD9",
                "nama" => "OGAN KOMERING ILIR"),
            array(
                "bkn_id" => "A637937E58E91DDEE040640A02023CD9",
                "nama" => "KATINGAN"),
            array(
                "bkn_id" => "A637937E58EA1DDEE040640A02023CD9",
                "nama" => "NAGAN RAYA"),
            array(
                "bkn_id" => "A637937E58EB1DDEE040640A02023CD9",
                "nama" => "PADANG LAWAS"),
            array(
                "bkn_id" => "A637937E58EC1DDEE040640A02023CD9",
                "nama" => "BERAU"),
            array(
                "bkn_id" => "A637937E58ED1DDEE040640A02023CD9",
                "nama" => "TOLI-TOLI"),
            array(
                "bkn_id" => "A637937E58EE1DDEE040640A02023CD9",
                "nama" => "KONAWE"),
            array(
                "bkn_id" => "A637937E58EF1DDEE040640A02023CD9",
                "nama" => "MOROWALI"),
            array(
                "bkn_id" => "A637937E58F01DDEE040640A02023CD9",
                "nama" => "KAPUAS"),
            array(
                "bkn_id" => "A637937E58F11DDEE040640A02023CD9",
                "nama" => "BANYU ASIN"),
            array(
                "bkn_id" => "A637937E58F31DDEE040640A02023CD9",
                "nama" => "ACEH UTARA"),
            array(
                "bkn_id" => "A637937E58F41DDEE040640A02023CD9",
                "nama" => "KOTA GUNUNGSITOLI"),
            array(
                "bkn_id" => "A637937E58F51DDEE040640A02023CD9",
                "nama" => "BOLAANG MONGONDOW"),
            array(
                "bkn_id" => "A637937E58F61DDEE040640A02023CD9",
                "nama" => "METRO"),
            array(
                "bkn_id" => "A637937E58F71DDEE040640A02023CD9",
                "nama" => "LEBAK"),
            array(
                "bkn_id" => "A637937E58F81DDEE040640A02023CD9",
                "nama" => "TOJO UNA-UNA"),
            array(
                "bkn_id" => "A637937E58FA1DDEE040640A02023CD9",
                "nama" => "ACEH TAMIANG"),
            array(
                "bkn_id" => "A637937E58FB1DDEE040640A02023CD9",
                "nama" => "PASIR"),
            array(
                "bkn_id" => "A637937E58FC1DDEE040640A02023CD9",
                "nama" => "LANGKAT"),
            array(
                "bkn_id" => "A637937E58FD1DDEE040640A02023CD9",
                "nama" => "BINTAN"),
            array(
                "bkn_id" => "A637937E58FE1DDEE040640A02023CD9",
                "nama" => "PENAJAM PASER UTARA"),
            array(
                "bkn_id" => "A637937E58FF1DDEE040640A02023CD9",
                "nama" => "BANGKA"),
            array(
                "bkn_id" => "A637937E59011DDEE040640A02023CD9",
                "nama" => "NGANJUK"),
            array(
                "bkn_id" => "A637937E59021DDEE040640A02023CD9",
                "nama" => "HALMAHERA TENGAH"),
            array(
                "bkn_id" => "A637937E59031DDEE040640A02023CD9",
                "nama" => "KEPULAUAN SANGIHE"),
            array(
                "bkn_id" => "A637937E59041DDEE040640A02023CD9",
                "nama" => "LANNI JAYA"),
            array(
                "bkn_id" => "A637937E59061DDEE040640A02023CD9",
                "nama" => "SABANG"),
            array(
                "bkn_id" => "A637937E59071DDEE040640A02023CD9",
                "nama" => "BURU SELATAN"),
            array(
                "bkn_id" => "A637937E59081DDEE040640A02023CD9",
                "nama" => "KAUR"),
            array(
                "bkn_id" => "A637937E59091DDEE040640A02023CD9",
                "nama" => "TABALONG"),
            array(
                "bkn_id" => "A637937E590A1DDEE040640A02023CD9",
                "nama" => "SUPIORI"),
            array(
                "bkn_id" => "A637937E590B1DDEE040640A02023CD9",
                "nama" => "BENGKAYANG"),
            array(
                "bkn_id" => "A637937E590D1DDEE040640A02023CD9",
                "nama" => "PELALAWAN"),
            array(
                "bkn_id" => "A637937E590E1DDEE040640A02023CD9",
                "nama" => "DAIRI"),
            array(
                "bkn_id" => "A637937E590F1DDEE040640A02023CD9",
                "nama" => "LIMA PULUH KOTA"),
            array(
                "bkn_id" => "A637937E59101DDEE040640A02023CD9",
                "nama" => "PANDEGLANG"),
            array(
                "bkn_id" => "A637937E59111DDEE040640A02023CD9",
                "nama" => "TABANAN"),
            array(
                "bkn_id" => "A637937E59121DDEE040640A02023CD9",
                "nama" => "DOGIYAI"),
            array(
                "bkn_id" => "A637937E59131DDEE040640A02023CD9",
                "nama" => "KULON PROGO"),
            array(
                "bkn_id" => "A637937E59141DDEE040640A02023CD9",
                "nama" => "ROTE NDAO"),
            array(
                "bkn_id" => "A637937E59151DDEE040640A02023CD9",
                "nama" => "ACEH SELATAN"),
            array(
                "bkn_id" => "A637937E59161DDEE040640A02023CD9",
                "nama" => "KARANGANYAR"),
            array(
                "bkn_id" => "A637937E59171DDEE040640A02023CD9",
                "nama" => "DOMPU"),
            array(
                "bkn_id" => "A637937E59181DDEE040640A02023CD9",
                "nama" => "MURUNG RAYA"),
            array(
                "bkn_id" => "A637937E59191DDEE040640A02023CD9",
                "nama" => "BENGKULU UTARA"),
            array(
                "bkn_id" => "A637937E591A1DDEE040640A02023CD9",
                "nama" => "SIGI"),
            array(
                "bkn_id" => "A637937E591B1DDEE040640A02023CD9",
                "nama" => "OGAN ILIR"),
            array(
                "bkn_id" => "A637937E591C1DDEE040640A02023CD9",
                "nama" => "GIANYAR"),
            array(
                "bkn_id" => "A637937E591D1DDEE040640A02023CD9",
                "nama" => "JAKARTA UTARA"),
            array(
                "bkn_id" => "A637937E591E1DDEE040640A02023CD9",
                "nama" => "TIMOR TENGAH SELATAN"),
            array(
                "bkn_id" => "A637937E591F1DDEE040640A02023CD9",
                "nama" => "KOTAWARINGIN BARAT"),
            array(
                "bkn_id" => "A637937E59201DDEE040640A02023CD9",
                "nama" => "BANGKA TENGAH"),
            array(
                "bkn_id" => "A637937E59211DDEE040640A02023CD9",
                "nama" => "BARITO KUALA"),
            array(
                "bkn_id" => "A637937E59221DDEE040640A02023CD9",
                "nama" => "MANDAILING NATAL"),
            array(
                "bkn_id" => "A637937E59231DDEE040640A02023CD9",
                "nama" => "HALMAHERA SELATAN"),
            array(
                "bkn_id" => "A637937E59241DDEE040640A02023CD9",
                "nama" => "JEPARA"),
            array(
                "bkn_id" => "A637937E59251DDEE040640A02023CD9",
                "nama" => "BARITO TIMUR"),
            array(
                "bkn_id" => "A637937E59261DDEE040640A02023CD9",
                "nama" => "JENEPONTO"),
            array(
                "bkn_id" => "A637937E59271DDEE040640A02023CD9",
                "nama" => "PRABUMULIH"),
            array(
                "bkn_id" => "A637937E59281DDEE040640A02023CD9",
                "nama" => "ACEH SINGKIL"),
            array(
                "bkn_id" => "A637937E59291DDEE040640A02023CD9",
                "nama" => "KUANTAN SENGINGI"),
            array(
                "bkn_id" => "A637937E592A1DDEE040640A02023CD9",
                "nama" => "MUSI RAWAS"),
            array(
                "bkn_id" => "A637937E592B1DDEE040640A02023CD9",
                "nama" => "ROKAN HILIR"),
            array(
                "bkn_id" => "A637937E592C1DDEE040640A02023CD9",
                "nama" => "LUMAJANG"),
            array(
                "bkn_id" => "A637937E592D1DDEE040640A02023CD9",
                "nama" => "MALUKU TENGGARA BARAT"),
            array(
                "bkn_id" => "A637937E592E1DDEE040640A02023CD9",
                "nama" => "TULANG BAWANG BARAT"),
            array(
                "bkn_id" => "A637937E592F1DDEE040640A02023CD9",
                "nama" => "YAHUKIMO"),
            array(
                "bkn_id" => "A637937E59301DDEE040640A02023CD9",
                "nama" => "YAPEN WAROPEN"),
            array(
                "bkn_id" => "A637937E59311DDEE040640A02023CD9",
                "nama" => "TORAJA UTARA"),
            array(
                "bkn_id" => "A637937E59321DDEE040640A02023CD9",
                "nama" => "MELAWI"),
            array(
                "bkn_id" => "A637937E59331DDEE040640A02023CD9",
                "nama" => "BATU"),
            array(
                "bkn_id" => "A637937E59341DDEE040640A02023CD9",
                "nama" => "NIAS UTARA"),
            array(
                "bkn_id" => "A637937E59351DDEE040640A02023CD9",
                "nama" => "TELUK BINTUNI"),
            array(
                "bkn_id" => "A637937E59361DDEE040640A02023CD9",
                "nama" => "JAKARTA BARAT"),
            array(
                "bkn_id" => "A637937E59371DDEE040640A02023CD9",
                "nama" => "PESAWARAN"),
            array(
                "bkn_id" => "A637937E59381DDEE040640A02023CD9",
                "nama" => "SLEMAN"),
            array(
                "bkn_id" => "A637937E59391DDEE040640A02023CD9",
                "nama" => "LABUHAN BATU"),
            array(
                "bkn_id" => "A637937E593A1DDEE040640A02023CD9",
                "nama" => "OGAN KOMERING ULU TIMUR"),
            array(
                "bkn_id" => "A637937E593B1DDEE040640A02023CD9",
                "nama" => "KEPULAUAN SULA"),
            array(
                "bkn_id" => "A637937E593C1DDEE040640A02023CD9",
                "nama" => "ENREKANG"),
            array(
                "bkn_id" => "A637937E593D1DDEE040640A02023CD9",
                "nama" => "CILEGON"),
            array(
                "bkn_id" => "A637937E593E1DDEE040640A02023CD9",
                "nama" => "BLORA"),
            array(
                "bkn_id" => "A637937E593F1DDEE040640A02023CD9",
                "nama" => "HULU SUNGAI TENGAH"),
            array(
                "bkn_id" => "A637937E59401DDEE040640A02023CD9",
                "nama" => "BANGGAI KEPULAUAN"),
            array(
                "bkn_id" => "A637937E59411DDEE040640A02023CD9",
                "nama" => "MINAHASA"),
            array(
                "bkn_id" => "A637937E59421DDEE040640A02023CD9",
                "nama" => "TOLIKARA"),
            array(
                "bkn_id" => "A637937E59431DDEE040640A02023CD9",
                "nama" => "MAKASSAR"),
            array(
                "bkn_id" => "A637937E59441DDEE040640A02023CD9",
                "nama" => "MAPPI"),
            array(
                "bkn_id" => "A637937E59451DDEE040640A02023CD9",
                "nama" => "TULUNGAGUNG"),
            array(
                "bkn_id" => "A637937E59461DDEE040640A02023CD9",
                "nama" => "MANGGARAI BARAT"),
            array(
                "bkn_id" => "A637937E59471DDEE040640A02023CD9",
                "nama" => "HULU SUNGAI UTARA"),
            array(
                "bkn_id" => "A637937E59481DDEE040640A02023CD9",
                "nama" => "SERAM BAGIAN BARAT"),
            array(
                "bkn_id" => "A637937E59491DDEE040640A02023CD9",
                "nama" => "PADANG LAWAS UTARA"),
            array(
                "bkn_id" => "A637937E594A1DDEE040640A02023CD9",
                "nama" => "PEGUNUNGAN BINTANG"),
            array(
                "bkn_id" => "A637937E594B1DDEE040640A02023CD9",
                "nama" => "TAPANULI UTARA"),
            array(
                "bkn_id" => "A637937E594C1DDEE040640A02023CD9",
                "nama" => "SIKKA"),
            array(
                "bkn_id" => "A637937E594D1DDEE040640A02023CD9",
                "nama" => "LANDAK"),
            array(
                "bkn_id" => "A637937E594E1DDEE040640A02023CD9",
                "nama" => "GRESIK"),
            array(
                "bkn_id" => "A637937E594F1DDEE040640A02023CD9",
                "nama" => "WAJO"),
            array(
                "bkn_id" => "A637937E59501DDEE040640A02023CD9",
                "nama" => "BATANG HARI"),
            array(
                "bkn_id" => "A637937E59511DDEE040640A02023CD9",
                "nama" => "KONAWE UTARA"),
            array(
                "bkn_id" => "A637937E59521DDEE040640A02023CD9",
                "nama" => "TEMANGGUNG"),
            array(
                "bkn_id" => "A637937E59531DDEE040640A02023CD9",
                "nama" => "ACEH TENGGARA"),
            array(
                "bkn_id" => "A637937E59541DDEE040640A02023CD9",
                "nama" => "KUTAI KARTANEGARA"),
            array(
                "bkn_id" => "A637937E59551DDEE040640A02023CD9",
                "nama" => "LUWU UTARA"),
            array(
                "bkn_id" => "A637937E59561DDEE040640A02023CD9",
                "nama" => "BANYUMAS"),
            array(
                "bkn_id" => "A637937E59571DDEE040640A02023CD9",
                "nama" => "WONOGIRI"),
            array(
                "bkn_id" => "A637937E59581DDEE040640A02023CD9",
                "nama" => "SOPPENG"),
            array(
                "bkn_id" => "A637937E595A1DDEE040640A02023CD9",
                "nama" => "NIAS"),
            array(
                "bkn_id" => "A637937E595B1DDEE040640A02023CD9",
                "nama" => "NIAS BARAT"),
            array(
                "bkn_id" => "A637937E595C1DDEE040640A02023CD9",
                "nama" => "MIMIKA"),
            array(
                "bkn_id" => "A5EB03E21D7AF6A0E040640A040252AD",
                "nama" => "GABRAH-11"),
            array(
                "bkn_id" => "A5EB03E21D81F6A0E040640A040252AD",
                "nama" => "GABRAH-18"),
            array(
                "bkn_id" => "A5EB03E21DE8F6A0E040640A040252AD",
                "nama" => "A A L"),
            array(
                "bkn_id" => "A5EB03E21DEEF6A0E040640A040252AD",
                "nama" => "SIONAL PONTIANAK"),
            array(
                "bkn_id" => "A5EB03E21CFEF6A0E040640A040252AD",
                "nama" => "PACITAN"),
            array(
                "bkn_id" => "A5EB03E21D05F6A0E040640A040252AD",
                "nama" => "PUTUSSIBAU"),
            array(
                "bkn_id" => "A5EB03E21E65F6A0E040640A040252AD",
                "nama" => "LANUD RANAI"),
            array(
                "bkn_id" => "A5EB03E21ED5F6A0E040640A040252AD",
                "nama" => "DPPKA"),
            array(
                "bkn_id" => "A637937E595D1DDEE040640A02023CD9",
                "nama" => "BONE BOLANGO"),
            array(
                "bkn_id" => "A637937E595E1DDEE040640A02023CD9",
                "nama" => "KERINCI"),
            array(
                "bkn_id" => "A637937E595F1DDEE040640A02023CD9",
                "nama" => "SUKAMARA"),
            array(
                "bkn_id" => "A637937E59601DDEE040640A02023CD9",
                "nama" => "INDRAGIRI HILIR"),
            array(
                "bkn_id" => "A637937E59611DDEE040640A02023CD9",
                "nama" => "KENDAL"),
            array(
                "bkn_id" => "A637937E59621DDEE040640A02023CD9",
                "nama" => "KOTA TUAL"),
            array(
                "bkn_id" => "A637937E59631DDEE040640A02023CD9",
                "nama" => "SOLOK SELATAN"),
            array(
                "bkn_id" => "A637937E59651DDEE040640A02023CD9",
                "nama" => "YALIMO"),
            array(
                "bkn_id" => "A637937E59661DDEE040640A02023CD9",
                "nama" => "BALANGAN"),
            array(
                "bkn_id" => "A637937E59671DDEE040640A02023CD9",
                "nama" => "PADANG SIDIMPUAN "),
            array(
                "bkn_id" => "A637937E59681DDEE040640A02023CD9",
                "nama" => "MAYBRAT"),
            array(
                "bkn_id" => "A637937E59691DDEE040640A02023CD9",
                "nama" => "PASAMAN BARAT"),
            array(
                "bkn_id" => "A637937E596A1DDEE040640A02023CD9",
                "nama" => "SERDANG BEDAGAI"),
            array(
                "bkn_id" => "A637937E596C1DDEE040640A02023CD9",
                "nama" => "TANGGAMUS"),
            array(
                "bkn_id" => "A637937E596D1DDEE040640A02023CD9",
                "nama" => "PRINGSEWU"),
            array(
                "bkn_id" => "A637937E596E1DDEE040640A02023CD9",
                "nama" => "DEPOK"),
            array(
                "bkn_id" => "A637937E596F1DDEE040640A02023CD9",
                "nama" => "LAMPUNG BARAT"),
            array(
                "bkn_id" => "A637937E59701DDEE040640A02023CD9",
                "nama" => "PAGAR ALAM"),
            array(
                "bkn_id" => "A637937E59711DDEE040640A02023CD9",
                "nama" => "BURU"),
            array(
                "bkn_id" => "A637937E59721DDEE040640A02023CD9",
                "nama" => "MINAHASA SELATAN"),
            array(
                "bkn_id" => "A637937E59731DDEE040640A02023CD9",
                "nama" => "INTAN JAYA"),
            array(
                "bkn_id" => "A637937E59741DDEE040640A02023CD9",
                "nama" => "TAPANULI SELATAN"),
            array(
                "bkn_id" => "A637937E59751DDEE040640A02023CD9",
                "nama" => "KENDARI/KONAWE"),
            array(
                "bkn_id" => "A637937E59761DDEE040640A02023CD9",
                "nama" => "KLUNGKUNG"),
            array(
                "bkn_id" => "A637937E59771DDEE040640A02023CD9",
                "nama" => "HALMAHERA UTARA"),
            array(
                "bkn_id" => "A637937E59781DDEE040640A02023CD9",
                "nama" => "TOMOHON"),
            array(
                "bkn_id" => "A637937E59791DDEE040640A02023CD9",
                "nama" => "ACEH BARAT"),
            array(
                "bkn_id" => "A637937E597A1DDEE040640A02023CD9",
                "nama" => "KEPULAUAN TALAUD"),
            array(
                "bkn_id" => "A637937E597B1DDEE040640A02023CD9",
                "nama" => "SUMENEP"),
            array(
                "bkn_id" => "A637937E597C1DDEE040640A02023CD9",
                "nama" => "SITUBONDO"),
            array(
                "bkn_id" => "A637937E597D1DDEE040640A02023CD9",
                "nama" => "ASAHAN"),
            array(
                "bkn_id" => "A637937E597E1DDEE040640A02023CD9",
                "nama" => "BANGKA BARAT"),
            array(
                "bkn_id" => "A637937E597F1DDEE040640A02023CD9",
                "nama" => "MANGGARAI TIMUR"),
            array(
                "bkn_id" => "A637937E59801DDEE040640A02023CD9",
                "nama" => "SIMALUNGUN"),
            array(
                "bkn_id" => "A637937E59811DDEE040640A02023CD9",
                "nama" => "MALUKU TENGAH"),
            array(
                "bkn_id" => "A637937E59821DDEE040640A02023CD9",
                "nama" => "SELUMA"),
            array(
                "bkn_id" => "A637937E59831DDEE040640A02023CD9",
                "nama" => "HALMAHERA BARAT"),
            array(
                "bkn_id" => "A637937E59841DDEE040640A02023CD9",
                "nama" => "JAKARTA SELATAN"),
            array(
                "bkn_id" => "A637937E59851DDEE040640A02023CD9",
                "nama" => "SIMEULUE"),
            array(
                "bkn_id" => "A637937E59861DDEE040640A02023CD9",
                "nama" => "BREBES"),
            array(
                "bkn_id" => "A637937E59871DDEE040640A02023CD9",
                "nama" => "BARITO SELATAN"),
            array(
                "bkn_id" => "A637937E59881DDEE040640A02023CD9",
                "nama" => "ACEH BARAT DAYA"),
            array(
                "bkn_id" => "A637937E59891DDEE040640A02023CD9",
                "nama" => "REMBANG"),
            array(
                "bkn_id" => "A637937E598A1DDEE040640A02023CD9",
                "nama" => "SEMARANG"),
            array(
                "bkn_id" => "A637937E598B1DDEE040640A02023CD9",
                "nama" => "PADANG PANJANG"),
            array(
                "bkn_id" => "A637937E598C1DDEE040640A02023CD9",
                "nama" => "LOMBOK TENGAH"),
            array(
                "bkn_id" => "ff80808131ae839f0131b19e38be0d0c",
                "nama" => "DINAS PENDAPATAN & PENG. KEUANGAN (DPPK)"),
            array(
                "bkn_id" => "ff80808131dd3d110131dda2979008bd",
                "nama" => "DIREKSI PERUM PERHUTANI "),
            array(
                "bkn_id" => "ff80808131dd3d110131dda30e5308c2",
                "nama" => "DIREKSI PERUM PERHUTANI UNIT I JATENG"),
            array(
                "bkn_id" => "ff80808131dd3d110131dda4d97b08d7",
                "nama" => "DIREKSI PERUM PERHUTANI UNIT III JABAR"),
            array(
                "bkn_id" => "ff80808131dd3d110131dda5e68008f4",
                "nama" => "DIREKSI PT. INHUTANI I"),
            array(
                "bkn_id" => "ff80808131dd3d110131dda6669f0905",
                "nama" => "DIREKSI PT. INHUTANI IV"),
            array(
                "bkn_id" => "ff80808131dd3d110131dda6abc00908",
                "nama" => "DIREKSI PT. INHUTANI V"),
            array(
                "bkn_id" => "ff80808131ef7b790131efd5bc070c08",
                "nama" => "KASDA JAWA TIMUR"),
            array(
                "bkn_id" => "ff80808131ef7b790131efd789560c43",
                "nama" => "KASDA JAWA TENGAH"),
            array(
                "bkn_id" => "ff80808131f04d1b0131f20d3c040f6d",
                "nama" => "BALI"),
            array(
                "bkn_id" => "ff80808131fa08bc0131fab8e1822a24",
                "nama" => "PEKAS MAKO ARMATIM"),
            array(
                "bkn_id" => "ff80808131fa08bc0131fab92f812a31",
                "nama" => "PEKAS MAKO KORMAR"),
            array(
                "bkn_id" => "ff80808131fa08bc0131fab9a4372a3b",
                "nama" => "PEKAS KOBANGDIKAL"),
            array(
                "bkn_id" => "ff80808131fa08bc0131fabb2f452b1b",
                "nama" => "PEKAS SESKOAL"),
            array(
                "bkn_id" => "ff80808131fa08bc0131fabca0242b54",
                "nama" => "PEKAS LANTAMAL III JAKARTA"),
            array(
                "bkn_id" => "ff80808134416b940134416d15a80002",
                "nama" => "INFOLAHTADAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b940134416d9fbe0004",
                "nama" => "PENDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b940134416de5e60005",
                "nama" => "BINTALDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b940134416e222e0006",
                "nama" => "JASDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b940134416e8db90007",
                "nama" => "BABINMINVETCADDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b940134416f10990009",
                "nama" => "DENINTELDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b940134416f87e5000a",
                "nama" => "KODIM 0501/JP"),
            array(
                "bkn_id" => "ff80808134416b940134416fe0d4000b",
                "nama" => "KODIM 0502/JU"),
            array(
                "bkn_id" => "ff80808134416b940134417095cc000d",
                "nama" => "KODIM 0504/JS"),
            array(
                "bkn_id" => "ff80808134416b9401344171715f000e",
                "nama" => "KODIM 0505/JT"),
            array(
                "bkn_id" => "ff80808134416b9401344171e1a1000f",
                "nama" => "KODIM 0506/TGR"),
            array(
                "bkn_id" => "ff80808134416b94013441723b0c0010",
                "nama" => "KOROM 051/WKT DAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b9401344172ba770012",
                "nama" => "KUDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b940134417303970013",
                "nama" => "KESDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b940134417352b70014",
                "nama" => "BEKANGDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b94013441739c8e0015",
                "nama" => "PALDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b94013441742c260017",
                "nama" => "ZIDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b94013441745ca70018",
                "nama" => "POMDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b9401344174b4ab0019",
                "nama" => "TOPDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b9401344175f36d001a",
                "nama" => "RINDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b94013441769724001c",
                "nama" => "KODIM 0507/BKS"),
            array(
                "bkn_id" => "ff80808134416b9401344176ef65001d",
                "nama" => "KOREM/WKR DAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b940134417d56f7001f",
                "nama" => "POLDA"),
            array(
                "bkn_id" => "ff80808134416b940134417e36c90020",
                "nama" => "POLDA METRO LAMPUNG"),
            array(
                "bkn_id" => "ff80808134416b9401344180bea60022",
                "nama" => "RSPAD GATOT SOEBROTO"),
            array(
                "bkn_id" => "ff80808134416b9401344181c1bd0023",
                "nama" => "PUSDIKKES"),
            array(
                "bkn_id" => "ff80808134416b9401344182d73d0024",
                "nama" => "KSTRAD"),
            array(
                "bkn_id" => "ff80808134416b94013441842fb10025",
                "nama" => "LAMTAMAL III"),
            array(
                "bkn_id" => "ff80808134416b9401344186214a0026",
                "nama" => "KOLINLAMIL"),
            array(
                "bkn_id" => "ff80808134e6131e0134ee8a152f45a1",
                "nama" => "PEKAS TNI WILAYAH JAKARTA I"),
            array(
                "bkn_id" => "ff80808134e6131e0134ee8aab5145b3",
                "nama" => "PEKAS TNI WILAYAH JAKARTA II"),
            array(
                "bkn_id" => "ff80808134e6131e0134ee8df84c4623",
                "nama" => "PEKAS TNI WILAYAH SUMBAGUT"),
            array(
                "bkn_id" => "ff80808134f5f9b30134f93e13451ac1",
                "nama" => "DINAS PENG. KEUANGAN DAN BARANG DAERAH"),
            array(
                "bkn_id" => "8ae48289355d949e013560cbd7ac2206",
                "nama" => "PEKAS RUMKITAL DR. MINTOHARJO"),
            array(
                "bkn_id" => "8ae48289355d949e013560de557922ea",
                "nama" => "PEKAS LANTAMAL VIII MANADO"),
            array(
                "bkn_id" => "8ae48289355d949e013560df8e7f22f9",
                "nama" => "PEKAS LANTAMAL X JAYAPURA"),
            array(
                "bkn_id" => "8ae48289358079080135841bdd2b0afe",
                "nama" => "PEKAS TNI WILAYAH MALUKU"),
            array(
                "bkn_id" => "8ae48289358079080135841c30d00b02",
                "nama" => "PEKAS TNI WILAYAH PAPUA"),
            array(
                "bkn_id" => "ff80808135e7d09f0135ec0b3d09554d",
                "nama" => "PROPINSI SULAWESI TENGAH"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f6680ce822fb",
                "nama" => "KAS PT. ANGKASA PURA I AHMAD YANI"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f668470f2304",
                "nama" => "KAS PT. ANGKASA PURA I ADI SUTJIPTO"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f668e7fc2327",
                "nama" => "KAS PT. ANGKASA PURA I EL TARI"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66e514a2685",
                "nama" => "KAS PT. ANGKASA PURA II SULTAN THAHA"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66f0d7026f2",
                "nama" => "KAS PT. AP II SULTAN ISKANDAR MUDA"),
            array(
                "bkn_id" => "ff8080813185938201318d8e21c43175",
                "nama" => "DINAS PPKAD"),
            array(
                "bkn_id" => "ff808081319512cd0131978e3a240343",
                "nama" => "JAKARTA"),
            array(
                "bkn_id" => "ff80808131ef7b790131efd7fbed0c4f",
                "nama" => "KASDA JAWA BARAT"),
            array(
                "bkn_id" => "ff80808134e6131e0134eeaa924b4c28",
                "nama" => "PEKAS TNI WILAYAH KALIMANTAN II"),
            array(
                "bkn_id" => "ff80808134f5f5440134f95917041e9d",
                "nama" => "PEKAS GABPUS 15 NA.2.02.07"),
            array(
                "bkn_id" => "ff80808135e7d09f0135ec0a979854ef",
                "nama" => "PROPINSI SULAWESI SELATAN"),
            array(
                "bkn_id" => "8ae482893634e9d10136381b991c0ddb",
                "nama" => "BIRO KEUANGAN SETDA PROV. MALUT"),
            array(
                "bkn_id" => "ff808081374924530137493652660583",
                "nama" => "ASISTEN BIDANG KEUANGAN"),
            array(
                "bkn_id" => "8ae482893791d5970137923270c504f8",
                "nama" => "BIRO KEUANGAN OTORITA BATAM"),
            array(
                "bkn_id" => "ff80808137c168ad0137c62ed3125a0b",
                "nama" => "BADAN PENGELOLAAN KEUANGAN DAN ASET DAERAH"),
            array(
                "bkn_id" => "8ae4828938b8915d0138c6b82ed53c55",
                "nama" => "KAS PT. ANGKASA PURA I MATSC MAKASSAR"),
            array(
                "bkn_id" => "ff8080813951073b013965cb83382995",
                "nama" => "BENOA"),
            array(
                "bkn_id" => "ff80808139f30170013a005e9e4f6025",
                "nama" => "BIRO KEUANGAN DAN AKUNTANSI"),
            array(
                "bkn_id" => "8ae482893a2b87eb013a2f7970e34460",
                "nama" => "DINAS PPKKD KAB. TAPANULI SELATAN DI PANDAN"),
            array(
                "bkn_id" => "8ae482873af26d4e013b1cd79b3b4131",
                "nama" => "GUNUNG SUGIH"),
            array(
                "bkn_id" => "8ae482893d878af8013da9845b746c0f",
                "nama" => "PEKAS GABPUS-4 NA.2.01.04"),
            array(
                "bkn_id" => "ff8080813c48735e013c4b61d46218d5",
                "nama" => "DINAS PENDAPATAN"),
            array(
                "bkn_id" => "ff8080814095dd640140a9273ef405fa",
                "nama" => "PEKAS GABPUS 5 NA.2.01.05 DI JAKARTA"),
            array(
                "bkn_id" => "ff80808142c2674d0142da1ea5fe27f5",
                "nama" => "PEKAS TNI WILAYAH JAKARTA IV"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c15ee91967",
                "nama" => "KAS PERUM LPPNPI BANDARA SUPADIO PONTIANAK"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c20a2219ad",
                "nama" => "KAS PERUM LPPNPI BANDARA RAJA H. FISABILILAH TANJUNG PINANG"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c2ba9319c9",
                "nama" => "KAS PERUM LPPNPI BANDARA JUANDA SURABAYA"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c5f1b01a81",
                "nama" => "KAS PERUM LPPNPI BANDARA SYAMSUDIN NOOR BANJARMASIN"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c629bf1a84",
                "nama" => "KAS PERUM LPPNPI BANDARA EL TARI KUPANG"),
            array(
                "bkn_id" => "8ae482894636f055014640c2eefe7cf9",
                "nama" => "ENTIKONG"),
            array(
                "bkn_id" => "ff8080814688cf440146a79a23be1449",
                "nama" => "KAS PT. ANGKASA PURA II HUSEIN SASTRANEGARA BANDUNG"),
            array(
                "bkn_id" => "ff80808134416b940134417fa25e0021",
                "nama" => "POLDA METRO KALBAR"),
            array(
                "bkn_id" => "A5EB03E21EB5F6A0E040640A040252AD",
                "nama" => "01 KU POLDA JABAR"),
            array(
                "bkn_id" => "A5EB03E21EBAF6A0E040640A040252AD",
                "nama" => "06 KU POLDA JABAR"),
            array(
                "bkn_id" => "A5EB03E21EBEF6A0E040640A040252AD",
                "nama" => "04 KU POLDA JATENG"),
            array(
                "bkn_id" => "A5EB03E21ED4F6A0E040640A040252AD",
                "nama" => "DPPK"),
            array(
                "bkn_id" => "A5EB03E21D73F6A0E040640A040252AD",
                "nama" => "GABRAH-4"),
            array(
                "bkn_id" => "ff80808131fa08bc0131faa97c972704",
                "nama" => "PEKAS MAKO ARMABAR"),
            array(
                "bkn_id" => "ff80808131fa08bc0131faba11c62ae6",
                "nama" => "PEKAS KOLINLAMIL"),
            array(
                "bkn_id" => "ff80808134416b940134416d59430003",
                "nama" => "SANDIDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b940134416ec5930008",
                "nama" => "KUMDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b94013441701cd8000c",
                "nama" => "KODIM 0503/JB"),
            array(
                "bkn_id" => "ff80808134416b940134417288300011",
                "nama" => "AJENDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b9401344173ef680016",
                "nama" => "HUBDAM JAYA"),
            array(
                "bkn_id" => "ff80808134416b94013441763d22001b",
                "nama" => "KODIM 0508/DPK"),
            array(
                "bkn_id" => "A5EB03E21DE6F6A0E040640A040252AD",
                "nama" => "BALURJALTIM"),
            array(
                "bkn_id" => "A5EB03E21DEBF6A0E040640A040252AD",
                "nama" => "PEKAS LANTAMAL IV TANJUNG PINANG"),
            array(
                "bkn_id" => "A5EB03E21C9EF6A0E040640A040252AD",
                "nama" => "BPPKAD"),
            array(
                "bkn_id" => "A5EB03E21EA4F6A0E040640A040252AD",
                "nama" => "03 KU POLDA SUMUT"),
            array(
                "bkn_id" => "A5EB03E21EA9F6A0E040640A040252AD",
                "nama" => "02 KU POLDA RIAU"),
            array(
                "bkn_id" => "A5EB03E21EADF6A0E040640A040252AD",
                "nama" => "01 KU POLDA SUMSEL"),
            array(
                "bkn_id" => "A5EB03E21D4DF6A0E040640A040252AD",
                "nama" => "SKOGAR SURABAYA"),
            array(
                "bkn_id" => "A5EB03E21D52F6A0E040640A040252AD",
                "nama" => "PEKAS AD"),
            array(
                "bkn_id" => "A5EB03E21D61F6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-4"),
            array(
                "bkn_id" => "A5EB03E21D67F6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-10"),
            array(
                "bkn_id" => "A5EB03E21D6BF6A0E040640A040252AD",
                "nama" => "PEKAS GABPUS-14"),
            array(
                "bkn_id" => "A5EB03E21D71F6A0E040640A040252AD",
                "nama" => "GABRAH-2"),
            array(
                "bkn_id" => "A5EB03E21D79F6A0E040640A040252AD",
                "nama" => "GABRAH-10"),
            array(
                "bkn_id" => "A5EB03E21D82F6A0E040640A040252AD",
                "nama" => "GABRAH-19"),
            array(
                "bkn_id" => "A5EB03E21D88F6A0E040640A040252AD",
                "nama" => "GABRAH-25"),
            array(
                "bkn_id" => "A5EB03E21E8FF6A0E040640A040252AD",
                "nama" => "DEPO SARBAN 70"),
            array(
                "bkn_id" => "A5EB03E21E95F6A0E040640A040252AD",
                "nama" => "03 KUMABES I"),
            array(
                "bkn_id" => "A5EB03E21E9AF6A0E040640A040252AD",
                "nama" => "01 KUMABES II"),
            array(
                "bkn_id" => "A5EB03E21EA0F6A0E040640A040252AD",
                "nama" => "02 KU POLDA ACEH"),
            array(
                "bkn_id" => "A5EB03E21D3CF6A0E040640A040252AD",
                "nama" => "KODAM III/SLW"),
            array(
                "bkn_id" => "A5EB03E21E0EF6A0E040640A040252AD",
                "nama" => "08 KU POLDA JATIM"),
            array(
                "bkn_id" => "A5EB03E21E12F6A0E040640A040252AD",
                "nama" => "03 KU POLDA NUSRA"),
            array(
                "bkn_id" => "A5EB03E21E17F6A0E040640A040252AD",
                "nama" => "01 KU POLDA KALTIM"),
            array(
                "bkn_id" => "ff8080813195302001319810e6520d17",
                "nama" => "DINAS PENGELOLA KEUANGAN DAN ASET DAERAH"),
            array(
                "bkn_id" => "ff80808131b1c0360131b216a22d0a08",
                "nama" => "DKI JAKARTA"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f65189ba1d9d",
                "nama" => "KAS PT. ANGKASA PURA I NGURAH RAI - BALI"),
            array(
                "bkn_id" => "ff8080813951073b013967403f581323",
                "nama" => "LEMBAR"),
            array(
                "bkn_id" => "ff8080813c1c547b013c1e22ba1a23f4",
                "nama" => "BADAN PENGELOLA KEUANGAN DAN BARANG MILIK DAERAH"),
            array(
                "bkn_id" => "ff8080813d68ac8d013d6c08265c5356",
                "nama" => "PEKAS TNI WIL JAKARTA VI"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c1262c1961",
                "nama" => "KAS PERUM LPPNPI BANDARA DEPATI AMIR PANGKAL PINANG"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c37f7219dd",
                "nama" => "KAS PERUM LPPNPI BANDARA SAM RATULANGI MANADO"),
            array(
                "bkn_id" => "A5EB03E21CE5F6A0E040640A040252AD",
                "nama" => "SUMEDANG"),
            array(
                "bkn_id" => "A637937E588D1DDEE040640A02023CD9",
                "nama" => "PANGKAJENE KEPULAUAN"),
            array(
                "bkn_id" => "A637937E58951DDEE040640A02023CD9",
                "nama" => "PARIAMAN"),
            array(
                "bkn_id" => "A637937E589B1DDEE040640A02023CD9",
                "nama" => "GORONTALO UTARA"),
            array(
                "bkn_id" => "A637937E58A11DDEE040640A02023CD9",
                "nama" => "MESUJI"),
            array(
                "bkn_id" => "A637937E58A81DDEE040640A02023CD9",
                "nama" => "KAPUAS HULU"),
            array(
                "bkn_id" => "A637937E58F21DDEE040640A02023CD9",
                "nama" => "MALUKU TENGGARA"),
            array(
                "bkn_id" => "A637937E58F91DDEE040640A02023CD9",
                "nama" => "KOLAKA TIMUR"),
            array(
                "bkn_id" => "A637937E59001DDEE040640A02023CD9",
                "nama" => "SAMOSIR"),
            array(
                "bkn_id" => "A637937E59051DDEE040640A02023CD9",
                "nama" => "EMPAT LAWANG"),
            array(
                "bkn_id" => "A637937E590C1DDEE040640A02023CD9",
                "nama" => "TANAH DATAR"),
            array(
                "bkn_id" => "A637937E59591DDEE040640A02023CD9",
                "nama" => "PULANG PISAU"),
            array(
                "bkn_id" => "A5EB03E21DF6F6A0E040640A040252AD",
                "nama" => "PEKAS LANTAMAL V SURABAYA"),
            array(
                "bkn_id" => "A637937E59641DDEE040640A02023CD9",
                "nama" => "KEPULAUAN MERANTI"),
            array(
                "bkn_id" => "A637937E596B1DDEE040640A02023CD9",
                "nama" => "SUMBA BARAT"),
            array(
                "bkn_id" => "8ae48289355d949e013560dfe3c62308",
                "nama" => "PEKAS LANTAMAL XI MERAUKE "),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f65309541de0",
                "nama" => "KAS PT. ANGKASA PURA I SEPINGGAN"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66881c7230e",
                "nama" => "KAS PT. ANGKASA PURA I SYAMSUDDIN NOOR"),
            array(
                "bkn_id" => "A5EB03E21E1BF6A0E040640A040252AD",
                "nama" => "03 KU POLDA KALSELTENG"),
            array(
                "bkn_id" => "A5EB03E21E23F6A0E040640A040252AD",
                "nama" => "04 KU POLDA SULSELTRA"),
            array(
                "bkn_id" => "A5EB03E21E27F6A0E040640A040252AD",
                "nama" => "03 KU POLDA SULUTTENG"),
            array(
                "bkn_id" => "A5EB03E21E2CF6A0E040640A040252AD",
                "nama" => "03 KU POLDA PAPUA"),
            array(
                "bkn_id" => "A5EB03E21E4EF6A0E040640A040252AD",
                "nama" => "MAKO KODIKAL"),
            array(
                "bkn_id" => "A5EB03E21E54F6A0E040640A040252AD",
                "nama" => "PUSPARKHASAU TNI-AU"),
            array(
                "bkn_id" => "A5EB03E21E59F6A0E040640A040252AD",
                "nama" => "LAKESPRA SURYANTO"),
            array(
                "bkn_id" => "A5EB03E21E5FF6A0E040640A040252AD",
                "nama" => "LANUD PEKANBARU"),
            array(
                "bkn_id" => "A5EB03E21E64F6A0E040640A040252AD",
                "nama" => "LANUD SUPADIO"),
            array(
                "bkn_id" => "ff8080814b6def0c014b71b9c3c93e9d",
                "nama" => "PAKU DITPALAD NA.2.01.09 "),
            array(
                "bkn_id" => "ff8080814b818b91014b90684bdb6b6f",
                "nama" => "PANGANDARAN"),
            array(
                "bkn_id" => "8ae482894c9ec56f014ca21e4c277873",
                "nama" => "PESISIR BARAT"),
            array(
                "bkn_id" => "8ae482884e29b5c2014e423327726fbd",
                "nama" => "PAKU DITBEKANGAD NA.2.01.10"),
            array(
                "bkn_id" => "ff8080814ebaa098014ee2e52fe10f54",
                "nama" => "PAKU DITAJENAD NA.2.02.09"),
            array(
                "bkn_id" => "8ae482874f15a0f9014f1b7ee2386f3b",
                "nama" => "PAPUA"),
            array(
                "bkn_id" => "8ae4829d4f44a936014f4efb83f36255",
                "nama" => "KAS PERUM LPPNPI BANDARA FATMAWATI SOEKARNO"),
            array(
                "bkn_id" => "8ae4829d4f44a936014f4efd458b63db",
                "nama" => "KAS PERUM LPPNPI BANDARA H.A.S HANANDJOEDDIN TANJUNG PANDAN"),
            array(
                "bkn_id" => "8ae48287523eb43d01523ee300f80fe9",
                "nama" => "PAKU DITHUBAD NA.2.01.08"),
            array(
                "bkn_id" => "8ae48287528109bf01528135efb2024a",
                "nama" => "KU DENMA MABESAD NA 2.01.01"),
            array(
                "bkn_id" => "8ae48287528109bf0152813693140280",
                "nama" => "KU PUSPENERBAD NA 2.01.06"),
            array(
                "bkn_id" => "8ae48287528109bf01528137413502b4",
                "nama" => "KU DITZIAD NA 2.01.07"),
            array(
                "bkn_id" => "8ae48287528109bf0152813f3c2008e0",
                "nama" => "KU DITKUAD NA 2.01.13"),
            array(
                "bkn_id" => "8ae48287528109bf0152814109fb0ae1",
                "nama" => "KU PUSSENKAV NA 2.02.03"),
            array(
                "bkn_id" => "ff80808152814b64015281ffb5251cfa",
                "nama" => "KU DITHUBAD NA 2.01.08"),
            array(
                "bkn_id" => "ff80808152814b64015282038468203f",
                "nama" => "KU DISINFOLAHTAD NA 2.01.18"),
            array(
                "bkn_id" => "ff80808152814b6401528204a7e3214c",
                "nama" => "KU PUSSENIF NA 2.02.02"),
            array(
                "bkn_id" => "ff80808152814b64015282070a7323bc",
                "nama" => "KU DITAJENAD NA 2.02.09"),
            array(
                "bkn_id" => "8ae4828852c511ca0152cf993f8f0a77",
                "nama" => "KAUR KEU RUMKIT BHAYANGKARA PUSDIK BRIMOB"),
            array(
                "bkn_id" => "8ae4828852c511ca0152cf9bafeb0b4c",
                "nama" => "KAUR KEU RUMKIT BHAYANGKARA AKPOL"),
            array(
                "bkn_id" => "8ae4828852c511ca0152cf9d94c10b9d",
                "nama" => "KAUR KEU RUMKIT BHAYANGKARA SELAPA"),
            array(
                "bkn_id" => "8ae4828852c511ca0152cf9e2b560bd5",
                "nama" => "KAUR KEU RUMKIT BHAYANGKARA BRIMOB"),
            array(
                "bkn_id" => "8ae4828852c511ca0152cf9f01db0c21",
                "nama" => "KAUR KEU BARESKRIM POLRI"),
            array(
                "bkn_id" => "8ae4828752cac5310152d34e035a7c17",
                "nama" => "KAUR KEU PUSINAFIS POLRI"),
            array(
                "bkn_id" => "8ae4828752cac5310152d35050310016",
                "nama" => "KAUR KEU PUSDIK BRIMOB"),
            array(
                "bkn_id" => "8ae4828752cac5310152d351cc99023a",
                "nama" => "KAUR KEU SETUKPA POLRI"),
            array(
                "bkn_id" => "8ae4828752cac5310152d36f5d383f1c",
                "nama" => "KAUR KEU LEMDIKPOL"),
            array(
                "bkn_id" => "8ae4828752cac5310152d370866b4155",
                "nama" => "KAUR KEU SEPOLWAN"),
            array(
                "bkn_id" => "8ae4828752cac5310152d371788f436c",
                "nama" => "KAUR KEU RUMKIT BHAYANGKARA SETUKPA POLRI"),
            array(
                "bkn_id" => "8ae4828752cac5310152d372167a4538",
                "nama" => "KAUR KEU DENSUS 88 AT"),
            array(
                "bkn_id" => "8ae4828752cac5310152d372c8dc4719",
                "nama" => "KAUR KEU SAT II PELOPOR/ KORBRIMOB POLRI"),
            array(
                "bkn_id" => "8ae4828752cac5310152d372fae44764",
                "nama" => "KAUR KEU SAT III PELOPOR/ KORBRIMOB POLRI"),
            array(
                "bkn_id" => "8ae4828752cac5310152d37329de47b1",
                "nama" => "KAUR KEU PUSIKNAS POLRI"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7c7a36f4566",
                "nama" => "KAUR KEU SRENA"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7c82b5e46da",
                "nama" => "KAUR KEU ITWASUM"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7c88bb8476c",
                "nama" => "KAUR KEU SETUM"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7ca50a44b89",
                "nama" => "KAUR KEU DIVKUM"),
            array(
                "bkn_id" => "ff80808131fa08bc0131fabaf1682b13",
                "nama" => "PEKAS AAL"),
            array(
                "bkn_id" => "ff80808131fa08bc0131fabb8ae02b29",
                "nama" => "PEKAS DENMA MABESAL"),
            array(
                "bkn_id" => "ff80808133ea0fb20133f76a10e21504",
                "nama" => "DINAS PENDAPATAN PENGELOLA KEUANGAN DAN ASET DAERAH"),
            array(
                "bkn_id" => "ff80808134370d58013441683222166c",
                "nama" => "DENMADAM JAYA"),
            array(
                "bkn_id" => "ff80808134d1aba00134e5848734032d",
                "nama" => "PEKAS TNI STAF MABES TNI"),
            array(
                "bkn_id" => "ff80808134fac18e01352cb5a6db48c4",
                "nama" => "PEKAS GABPUS 08 NA.2.01.08"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66a878e23d9",
                "nama" => "KAS PT. ANGKASA PURA I HALIM PERDANAKUSUMA"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66b0a16240a",
                "nama" => "KAS PT. ANGK. PURA I HUSEIN SASTRANEGARA"),
            array(
                "bkn_id" => "ff80808138943f65013898487ca8264c",
                "nama" => "PEKAS AB RAYON JAKARTA-1"),
            array(
                "bkn_id" => "ff8080813af6fef2013b169a9f902e21",
                "nama" => "PEKAS GABRAH-72 NA.2.10.02"),
            array(
                "bkn_id" => "ff8080813af6fef2013b169bb7f82e4a",
                "nama" => "PEKAS GABRAH-75 NA.2.10.05"),
            array(
                "bkn_id" => "8ae482893c955451013cb305d3486de3",
                "nama" => "PAPEKAS TNI WILAYAH VI"),
            array(
                "bkn_id" => "8ae4828841312f47014133de9d3a57ca",
                "nama" => "PEKAS TNI WILAYAH JAKARTA VI"),
            array(
                "bkn_id" => "ff80808145a695af0145a7bdac931874",
                "nama" => "KAS PERUM LPPNPI BANDARA SOEKARNO HATTA CENGKARENG"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c24f5719be",
                "nama" => "KAS PERUM LPPNPI BANDARA MINANGKABAU PADANG"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c2fa5b19d8",
                "nama" => "KAS PERUM LPPNPI BANDARA SEPINGGAN BALIKPAPAN"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c3418619da",
                "nama" => "KAS PERUM LPPNPI BANDARA HASANUDDIN MAKASSAR"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c525681a53",
                "nama" => "KAS PERUM LPPNPI BANDARA PATTIMURA AMBON"),
            array(
                "bkn_id" => "8ae4828948c502ea0148d4e6a7d6028f",
                "nama" => "ANDOOLO"),
            array(
                "bkn_id" => "ff8080814ade9994014ae673591a4e27",
                "nama" => "PASER"),
            array(
                "bkn_id" => "ff8080814c036fef014c07279cb54511",
                "nama" => "PEKAS TNI WILAYAH JAKARTA VII"),
            array(
                "bkn_id" => "ff80808152814b6401528205154721d4",
                "nama" => "KU PUSSENARMED NA 2.02.04"),
            array(
                "bkn_id" => "ff80808152814b6401528207ce1524a0",
                "nama" => "KU DISJARAHAD NA 2.02.11"),
            array(
                "bkn_id" => "8ae4828752cac5310152d34edfb67d6e",
                "nama" => "KAUR KEU PUSLABFOR POLRI"),
            array(
                "bkn_id" => "8ae4828752cac5310152d3705afe40da",
                "nama" => "KAUR KEU SEBASA"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7cef4f7543c",
                "nama" => "KAUR KEU ASOPS"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d49b156227",
                "nama" => "KAUR KEU YANMA"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d54e42649a",
                "nama" => "KAUR KEU BAHARKAM"),
            array(
                "bkn_id" => "8ae482a55adcceb9015ae97d4dd60f14",
                "nama" => "BADAN KEUANGAN, PENDAPATAN DAN ASET DAERAH"),
            array(
                "bkn_id" => "8ae483a75e2632e2015e27c881f7062a",
                "nama" => "MAHAKAM ULU"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc57d356264ae",
                "nama" => "Paku TNI Wilayah Jakarta III"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc57e8a2c64e6",
                "nama" => "Paku TNI Wilayah Jakarta IV"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc58072c764fb",
                "nama" => "Paku TNI Wilayah Jakarta VI"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc5839f896593",
                "nama" => "Paku TNI Wilayah Jakarta XIII"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc58435886595",
                "nama" => "Paku TNI Wilayah Jakarta XIV"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc58680d565a2",
                "nama" => "Paku TNI Wilayah Kalimantan I"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc587b25965bd",
                "nama" => "Paku TNI Wilayah NAD"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc58a699365d5",
                "nama" => "Paku TNI Wilayah Jateng"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc58c04ab65e1",
                "nama" => "Paku TNI Wilayah Papua II"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc58f766c661e",
                "nama" => "Paku TNI Wilayah Nusra"),
            array(
                "bkn_id" => "ff808081325e911d013266d8d5723cea",
                "nama" => "DPKPA"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f6527a011dce",
                "nama" => "KAS PT. ANGKASA PURA I JUANDA - SURABAYA"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f653e2ea1e10",
                "nama" => "KAS PT. ANGKASA PURA I SAM RATULANGI"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f655095e1e38",
                "nama" => "KAS PT. ANGKASA PURA I ADI FRANS KAISEPO"),
            array(
                "bkn_id" => "ff8080813af6fef2013b169a14492e0b",
                "nama" => "PEKAS GABRAH-71 NA.2.10.01"),
            array(
                "bkn_id" => "ff8080813af6fef2013b169b2fe62e43",
                "nama" => "PEKAS GABRAH-74 NA.2.10.04"),
            array(
                "bkn_id" => "ff8080813af6fef2013b169c73042e60",
                "nama" => "PEKAS GABRAH-76 NA.2.10.06"),
            array(
                "bkn_id" => "ff8080813af6fef2013b169cce7c2e66",
                "nama" => "PEKAS GABRAH-77 NA.2.10.07"),
            array(
                "bkn_id" => "ff80808140c3ffe80140e1ef333068a2",
                "nama" => "BADAN PENGELOLAAN KEUANGAN DAERAH DAN ASET DAERAH"),
            array(
                "bkn_id" => "ff80808147e76ffd0147f1262f3a3e0e",
                "nama" => "PEKAS GABPUS-2 NA.2.01.02"),
            array(
                "bkn_id" => "8ae4829c4e1a4ff7014e1e04167516db",
                "nama" => "DINAS PPKAD KABUPATEN WAINGAPU"),
            array(
                "bkn_id" => "ff80808152814b64015281fe35ac1b3b",
                "nama" => "KU PUSPOMAD NA 2.01.03"),
            array(
                "bkn_id" => "ff80808152814b6401528200bf921e18",
                "nama" => "KU DITBEKANG NA 2.01.10"),
            array(
                "bkn_id" => "ff80808152814b64015282042bdc20f5",
                "nama" => "KU KODIKLAT TNI AD NA 2.02.01"),
            array(
                "bkn_id" => "ff80808152814b640152820581fd21e8",
                "nama" => "KU PUSSENARMED NA 2.02.05"),
            array(
                "bkn_id" => "8ae4828752cac5310152d34fc3207f9c",
                "nama" => "KAUR KEU PUSDIK GASUM"),
            array(
                "bkn_id" => "8ae4828752cac5310152d36d90ce3b2c",
                "nama" => "KAUR KEU KORBRIMOB POLRI"),
            array(
                "bkn_id" => "8ae4828752cac5310152d36e05aa3cce",
                "nama" => "KAUR KEU SEKOLAH STAF DAN PIMPINAN POLRI"),
            array(
                "bkn_id" => "8ae4828752cac5310152d36fa6a83fdc",
                "nama" => "KAUR KEU SESPIMMA POLRI"),
            array(
                "bkn_id" => "8ae4828752cac5310152d370b2b041b8",
                "nama" => "KAUR KEU PUSDIK LANTAS"),
            array(
                "bkn_id" => "8ae4828752cac5310152d371a3c44386",
                "nama" => "KAUR KEU PUSDIK RESKRIM"),
            array(
                "bkn_id" => "8ae4828752cac5310152d3724efe460e",
                "nama" => "KAUR KEU DIK TIPIDKOR POLRI"),
            array(
                "bkn_id" => "8ae482875aa14cd3015aa25e098716e9",
                "nama" => "BADAN PENGELOLAAN KEUANGAN DAN PENDAPATAN DAERAH"),
            array(
                "bkn_id" => "8ae483a86652cf69016675b6df0729e3",
                "nama" => "SOFIFI"),
            array(
                "bkn_id" => "8ae483a569bf6d050169c25259d33a16",
                "nama" => "MOROWALI UTARA"),
            array(
                "bkn_id" => "ff808081325e8a69013260d2353726d7",
                "nama" => "SETEMPAT"),
            array(
                "bkn_id" => "ff80808134e6131e0134ee8e6b0c4632",
                "nama" => "PEKAS TNI WILAYAH SUMBAGSEL"),
            array(
                "bkn_id" => "ff80808134e6131e0134ee8ec0f94643",
                "nama" => "PEKAS TNI WILAYAH JATENG/DIY"),
            array(
                "bkn_id" => "ff80808134e6131e0134eea9dd774bb4",
                "nama" => "PEKAS TNI WILAYAH JATIM "),
            array(
                "bkn_id" => "ff80808134e6131e0134eeaa438e4bf4",
                "nama" => "PEKAS TNI WILAYAH KALIMANTAN I"),
            array(
                "bkn_id" => "ff808081355118350135519195e21a6a",
                "nama" => "PAKU SESKOAD NA.2.02.06"),
            array(
                "bkn_id" => "8ae48289358079080135841b81b80afb",
                "nama" => "PEKAS TNI WILAYAH NUSRA"),
            array(
                "bkn_id" => "8ae48289358079080135841c78ad0b05",
                "nama" => "PEKAS TNI WILAYAH NAD"),
            array(
                "bkn_id" => "ff808081359a56ac01359e9f00a6690a",
                "nama" => "PEKAS GABPUS-3 NA.2.01.03"),
            array(
                "bkn_id" => "ff80808135e7d09f0135ec0aed1e5514",
                "nama" => "PROPINSI SULAWESI BARAT"),
            array(
                "bkn_id" => "ff8080813b3cbab6013b69302d645a81",
                "nama" => "KASDA PROP. SULAWESI TENGGARA"),
            array(
                "bkn_id" => "8ae48289391f7596013923f982cd5843",
                "nama" => "TANJUNG BALAI ASAHAN"),
            array(
                "bkn_id" => "8ae4828939f5c253013a01d1586253f7",
                "nama" => "BADAN PENGELOLA KEUANGAN DAN ASET DAERAH"),
            array(
                "bkn_id" => "ff8080813b3cbab6013b69308ffc5ace",
                "nama" => "KASDA KOTA KENDARI"),
            array(
                "bkn_id" => "ff8080813b3cbab6013b6930f1395b07",
                "nama" => "KASDA KOTA BAU-BAU"),
            array(
                "bkn_id" => "ff8080813c90599e013c93d1dafe2519",
                "nama" => "BADAN PENGELOLAAN KEUANGAN DAN ASET"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c287fa19c4",
                "nama" => "KAS PERUM LPPNPI BANDARA NGURAH RAI BALI"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c454b81a13",
                "nama" => "KAS PERUM LPPNPI BANDARA FRANS KAISIEPO BIAK"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c5581a1a62",
                "nama" => "KAS PERUM LPPNPI BANDARA AHMAD YANI SEMARANG"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c586021a67",
                "nama" => "KAS PERUM LPPNPI BANDARA ADI SUTJIPTO YOGYAKARTA"),
            array(
                "bkn_id" => "ff80808152814b64015281ff0e471c2b",
                "nama" => "KU PUSINTELAD NA 2.01.05"),
            array(
                "bkn_id" => "ff80808152814b640152820202de1fc9",
                "nama" => "KU DISPENAD NA 2.01.15"),
            array(
                "bkn_id" => "8ae4828752cac5310152d36eb9b83dc9",
                "nama" => "KAUR KEU AKADEMI KEPOLISIAN"),
            array(
                "bkn_id" => "8ae4828752cac5310152d36f15253ee6",
                "nama" => "KAUR KEU PUSDIK BINMAS"),
            array(
                "bkn_id" => "8ae4828754fd78f2015500de3c27025c",
                "nama" => "LADOKGI RE MARTADINATA"),
            array(
                "bkn_id" => "8ae4828754fd78f2015500df975a0274",
                "nama" => "LANTAMAL XII PONTIANAK"),
            array(
                "bkn_id" => "8ae482875669e88c01566db002fd2ee3",
                "nama" => "KAUR KEU DIVPROPAM"),
            array(
                "bkn_id" => "8ae482875a57f798015a5a13f0a76849",
                "nama" => "BADAN PENGELOLA KEUANGAN DAN PENDAPATAN ASLI DAERAH"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc582cfd1658d",
                "nama" => "Paku TNI Wilayah Jakarta X"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc584bfe26596",
                "nama" => "Paku TNI Wilayah Jakarta XV"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc585db2765a0",
                "nama" => "Paku TNI Wilayah Jatim"),
            array(
                "bkn_id" => "ff80808131fb43480131fff50fe7624d",
                "nama" => "KASDA PROP.SULAWESI SELATAN"),
            array(
                "bkn_id" => "ff80808131fb4850013204de9ca2287c",
                "nama" => "BAGIAN ANGGARAN DAN PERBENDAHARAAN SETDA"),
            array(
                "bkn_id" => "ff808081324384f30132472c6fbb192e",
                "nama" => "PELAIHARI"),
            array(
                "bkn_id" => "ff80808132cd394a0132d6fa306d5526",
                "nama" => "BPKP"),
            array(
                "bkn_id" => "8ae482893580790801358431b6ce0c0c",
                "nama" => "PAPUA BARAT"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66b43b32425",
                "nama" => "KAS PT. ANGKASA PURA II POLONIA"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66dc5c3260e",
                "nama" => "KAS PT. AP II RAJA H. FISABILILLAH"),
            array(
                "bkn_id" => "8ae4829b35f1f4c40135f7e5dc530bae",
                "nama" => "SUNGGUMINASA"),
            array(
                "bkn_id" => "ff80808136e3f73b0136e713ae990f14",
                "nama" => "DPPKKD"),
            array(
                "bkn_id" => "ff8080813af6fef2013b169add152e25",
                "nama" => "PEKAS GABRAH-73 NA.2.10.03"),
            array(
                "bkn_id" => "ff8080813eeaa968013ef38349a55504",
                "nama" => "PEKAS RUSPAU ANTARIKSA"),
            array(
                "bkn_id" => "ff80808145a695af0145a7be2dbb1891",
                "nama" => "KAS PERUM LPPNPI BANDARA SULTAN ISKANDAR MUDA ACEH"),
            array(
                "bkn_id" => "8ae4829c4d4cff79014d74f7c63d7579",
                "nama" => "PEKAS LANTAMAL VII KUPANG"),
            array(
                "bkn_id" => "ff80808152814b64015281fdb2611a5b",
                "nama" => "KU ITJENAD NA 2.01.02"),
            array(
                "bkn_id" => "ff80808152814b640152820031a31d74",
                "nama" => "KU DITPALAD NA 2.01.09"),
            array(
                "bkn_id" => "ff80808152814b64015282010d4d1e56",
                "nama" => "KU DITKESAD NA 2.01.11"),
            array(
                "bkn_id" => "ff80808152814b64015282030177200c",
                "nama" => "KU DISLITBANGAD NA 2.01.17"),
            array(
                "bkn_id" => "ff80808152814b64015282077af82408",
                "nama" => "KU DISJASAD NA 2.02.10"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7cabc624c1e",
                "nama" => "KAUR KEU DIVHUMAS"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d3967f5f41",
                "nama" => "KAUR KEU SSARPRAS"),
            array(
                "bkn_id" => "8ae482885807bc9101580a6ea5e83693",
                "nama" => "PAKU MAKODAM MA.2.07.01 SURABAYA"),
            array(
                "bkn_id" => "8ae482875818d2ac0158190b2a2702ad",
                "nama" => "PAKU BEKANGDAM NA.2.07.08"),
            array(
                "bkn_id" => "8ae4828859b32c060159b4cb54450211",
                "nama" => "PAKU PUSKESAD NA.2.01.11"),
            array(
                "bkn_id" => "8ae4828859b32c060159b5d9a9a35cca",
                "nama" => "BADAN KEUANGAN"),
            array(
                "bkn_id" => "8ae482885acac92a015acc57118d218d",
                "nama" => "BADAN PENGELOLA KEUANGAN, PENDAPATAN DAN ASET DAERAH"),
            array(
                "bkn_id" => "8ae482885acac92a015acfc6a33e6386",
                "nama" => "BADAN PENDAPATAN KEUANGAN DAN ASET DAERAH"),
            array(
                "bkn_id" => "ff80808131fa08bc0131fabbde242b3d",
                "nama" => "PEKAS LANTAMAL I BELAWAN"),
            array(
                "bkn_id" => "ff80808131fa08bc0131fabc5c362b4e",
                "nama" => "PEKAS LANTAMAL II PADANG"),
            array(
                "bkn_id" => "ff80808134d1aba00134e5859799035f",
                "nama" => "PEKAS TNI WILAYAH JAKARTA III"),
            array(
                "bkn_id" => "ff80808134e6131e0134eeab54a14c6a",
                "nama" => "PEKAS TNI WILAYAH SULAWESI"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f6538ab51e03",
                "nama" => "KAS PT. ANGKASA PURA I HASANUDDIN MAKASSAR"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f667d1fe22e2",
                "nama" => "KAS PT. ANGKASA PURA I PATTIMURA"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66be57b246b",
                "nama" => "KAS PT. AP II SULTAN MAHMUD BADARUDDIN"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66cb58924cc",
                "nama" => "KAS PT. ANGKASA PURA II MINANGKABAU"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66d4cdc25b8",
                "nama" => "KAS PT. ANGKASA PURA II SUPADIO"),
            array(
                "bkn_id" => "ff8080813dab3fe7013dc4a59ac90c61",
                "nama" => "BIRO KEUANGAN BADAN PENGUSAHAAN BATAM"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c1aab11986",
                "nama" => "KAS PERUM LPPNPI BANDARA HALIM PERDANAKUSUMA JAKARTA"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c493881a1b",
                "nama" => "KAS PERUM LPPNPI BANDARA INTERNASIONAL LOMBOK NTB"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c670a91a97",
                "nama" => "KAS PERUM LPPNPI BANDARA MATSC MAKASSAR"),
            array(
                "bkn_id" => "ff80808152305745015234282c79535d",
                "nama" => "PAKU PUSINTELAD 20400"),
            array(
                "bkn_id" => "ff80808152814b64015281fea0931bc7",
                "nama" => "KU PUSTERAD NA 2.01.04"),
            array(
                "bkn_id" => "ff80808152814b640152820162d91ecb",
                "nama" => "KU DITKUMAD NA 2.01.14"),
            array(
                "bkn_id" => "ff80808152814b640152820630b62282",
                "nama" => "KU SECAPA AD NA 2.02.07"),
            array(
                "bkn_id" => "8ae4828752cac5310152d36d3f193a2a",
                "nama" => "KAUR KEU PUSDIK INTELKAM"),
            array(
                "bkn_id" => "8ae4828752cac5310152d3701a8e4060",
                "nama" => "KAUR KEU PUSDIK POL AIR"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7c9441c4979",
                "nama" => "KAUR KEU DIVTIPOL"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7c9ab264a3a",
                "nama" => "KAUR KEU BAINTELKAM"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7cc85be4ecf",
                "nama" => "KAUR KEU STIK"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d0f42857b7",
                "nama" => "KAUR KEU DITPOLAIR"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d5e039663b",
                "nama" => "KAUR KEU DITPAMOBVIT"),
            array(
                "bkn_id" => "ff808081541ab83c0154287647c63c36",
                "nama" => "KARUBAGA"),
            array(
                "bkn_id" => "8ae4828754fd78f2015500dbda7601cf",
                "nama" => "LANTAMAL XII"),
            array(
                "bkn_id" => "8ae4828754fd78f2015500e02b990283",
                "nama" => "LANTAMAL XIII TARAKAN"),
            array(
                "bkn_id" => "8ae4829d5778fe810157792e34f309c0",
                "nama" => "PALI"),
            array(
                "bkn_id" => "8ae4829d57d297950157d618a83d3f9b",
                "nama" => "RIAU"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc580f447651b",
                "nama" => "Paku TNI Wilayah Jakarta VII"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc582377a653e",
                "nama" => "Paku TNI Wilayah Jakarta IX"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc587091365b8",
                "nama" => "Paku TNI Wilayah Kalimantan II"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc58c9a6865e2",
                "nama" => "Paku TNI Wilayah Sulawesi I"),
            array(
                "bkn_id" => "8ae483a86ddc67c8016e1175b4b77390",
                "nama" => "BPKPD KAB TASIKMALAYA"),
            array(
                "bkn_id" => "8ae483a5701f5b3d01702e018f1a63d4",
                "nama" => "TANJUNG SELOR"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f6541eac1e1d",
                "nama" => "KAS PT. ANGKASA PURA I ADI SUMARMO"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66e951f26bd",
                "nama" => "KAS PT. ANGKASA PURA II DEPATI AMIR"),
            array(
                "bkn_id" => "ff80808145a695af0145a7c3b97619eb",
                "nama" => "KAS PERUM LPPNPI BANDARA ADI SUMARMO SURAKARTA"),
            array(
                "bkn_id" => "ff80808152814b64015282028b301fdc",
                "nama" => "KU DISBINTALAD NA 2.01.16"),
            array(
                "bkn_id" => "ff80808152814b6401528205e9d5221c",
                "nama" => "KU SESKOAD NA 2.02.06"),
            array(
                "bkn_id" => "ff80808152814b6401528206ad552345",
                "nama" => "KU DISPSIAD NA 2.02.08"),
            array(
                "bkn_id" => "8ae4828752cac5310152d36e572e3d3c",
                "nama" => "KAUR KEU PUSDIKMIN"),
            array(
                "bkn_id" => "8ae4828752cac5310152d371d82d4417",
                "nama" => "KAUR KEU DIT TIPIDNARKOBA"),
            array(
                "bkn_id" => "8ae4828752cac5310152d37294a546e8",
                "nama" => "KAUR KEU SAT I GEGANA/ KORBRIMOB POLRI"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7cf82b2556a",
                "nama" => "KAUR KEU DITSABHARA"),
            array(
                "bkn_id" => "ff80808154c51de50154dc7ffaee3c4a",
                "nama" => "PAKU DITKESAD NA.2.01.11"),
            array(
                "bkn_id" => "8ae48286587907f701587b96e561179f",
                "nama" => "KALIMANTAN UTARA"),
            array(
                "bkn_id" => "8ae482885a247748015a273af6764462",
                "nama" => "BADAN KEUANGAN PROVINSI"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc57c4c7564a9",
                "nama" => "Paku TNI Wilayah Jakarta II"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc57f621764ee",
                "nama" => "Paku TNI Wilayah Jakarta V"),
            array(
                "bkn_id" => "8ae483a66bbce182016bc58dbe2e65e6",
                "nama" => "Paku TNI Wilayah Sulawesi II"),
            array(
                "bkn_id" => "ff8080813290fadf0132aa0c20683c0a",
                "nama" => "JEMBER"),
            array(
                "bkn_id" => "8ae48289355d949e013560cb7a4021f5",
                "nama" => "PEKAS RUMKITAL DR. RAMELAN"),
            array(
                "bkn_id" => "8ae48289355d949e013560d2b5772250",
                "nama" => "PEKAS SATKAPAL 1 ARMATIM"),
            array(
                "bkn_id" => "8ae48289355d949e013560da4a3222b8",
                "nama" => "PEKAS BRIGIF 3"),
            array(
                "bkn_id" => "8ae48289355d949e013560db038d22c5",
                "nama" => "PEKAS LANMAR JAKARTA"),
            array(
                "bkn_id" => "8ae4828835f1f6a00135f66a13cf238a",
                "nama" => "KAS PT. ANGK. PURA II SOEKAERNO-HATTA"),
            array(
                "bkn_id" => "ff80808138ea538e0138eab911ae2977",
                "nama" => "KAS PT. ANGKASA PURA II RHF TG. PINANG"),
            array(
                "bkn_id" => "ff8080813d68ac8d013d6c1f84de5ef5",
                "nama" => "PEKAS TNI WIL JAKARTA IV"),
            array(
                "bkn_id" => "ff8080813ef4d8b6013ef9a0bbbf008c",
                "nama" => "DINAS PKD"),
            array(
                "bkn_id" => "ff80808143717e2001437a2326072b9e",
                "nama" => "JAKARTA-VII"),
            array(
                "bkn_id" => "ff80808145a695af0145a7be65621898",
                "nama" => "KAS PERUM LPPNPI BANDARA KUALANAMU MEDAN"),
            array(
                "bkn_id" => "ff80808145a695af0145a7bec3c618b3",
                "nama" => "KAS PERUM LPPNPI BANDARA SULTAN THAHA JAMBI"),
            array(
                "bkn_id" => "ff80808145a695af0145a7bf94ea18ea",
                "nama" => "KAS PERUM LPPNPI BANDARA SULTAN SYARIF KASIM II PEKANBARU"),
            array(
                "bkn_id" => "ff8080814e14bfe7014e198251910010",
                "nama" => "PEKAS GABPUS-6 NA.2.01.06"),
            array(
                "bkn_id" => "8ae4829d4f44a936014f4efbfa916285",
                "nama" => "KAS PERUM LPPNPI BANDARA SENTANI JAYAPURA"),
            array(
                "bkn_id" => "8ae48287528109bf01528137ac2b02c7",
                "nama" => "KU DITTOPAD NA 2.01.12"),
            array(
                "bkn_id" => "8ae4828752cac5310152d371143b424b",
                "nama" => "KAUR KEU RUMKIT BHAYANGKARA PUSDIK GASUM"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7ce46be5305",
                "nama" => "KAUR KEU PUSLITBANG"),
            array(
                "bkn_id" => "8ae4829d52e520330152e7d148545878",
                "nama" => "KAUR KEU DITPOLUDARA"),
            array(
                "bkn_id" => "8ae4828754fd78f2015500e0895902a9",
                "nama" => "LANTAMAL XIV SORONG"),
            array(
                "bkn_id" => "8ae482885aad58b1015ab14191081467",
                "nama" => "BADAN PENGELOLAAN KEUANGAN DAERAH")
        );
        foreach ($kpkn as $data)
        {
            {
                $data['created_at'] = date('Y-m-d H:i:s');
                $data['updated_at'] = date('Y-m-d H:i:s');
                DB::table('kpkn')->insert($data);
            }
        }
    }
}
