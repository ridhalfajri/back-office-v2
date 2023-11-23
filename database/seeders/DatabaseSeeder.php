<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(RefDokumenSeeder::class);
        // $this->call(JenisKursusSeeder::class);
        // $this->call(AgamaSeeder::class);
        // $this->call(JenisPegawaiSeeder::class);
        // $this->call(JenisJabatanSeeder::class);
        // $this->call(TingkatPendidikanSeeder::class);
        // $this->call(JenisKawinSeeder::class);
        // $this->call(JenisKepanitiaanSeeder::class);
        // $this->call(JenisDiklatSeeder::class);
        // $this->call(JenisDokumenSeeder::class);
        // $this->call(TaspenSeeder::class);
        // $this->call(GolonganSeeder::class);
        // $this->call(JenisKpSeeder::class);
        // $this->call(InstansiSeeder::class);
        // // $this->call(PropinsiSeeder::class);
        // // $this->call(KotaSeeder::class);
        // // $this->call(KecamatanSeeder::class);
        // // $this->call(DesaSeeder::class);
        // $this->call(LatihanStrukturalSeeder::class);
        // $this->call(SatuanKerjaSeeder::class);
        // $this->call(ProfesiSeeder::class);
        // $this->call(EselonSeeder::class);
        // $this->call(AlasanHukumanDisiplinSeeder::class);
        // $this->call(JenisRiwayatSeeder::class);
        // $this->call(JenisPemberhentianSeeder::class);
        // $this->call(KpknSeeder::class);
        // $this->call(KedudukanHukumSeeder::class);
        // $this->call(JenisHukumanSeeder::class);
        // $this->call(CltnSeeder::class);
        // $this->call(JenisKompetensiSeeder::class);
        // $this->call(JenisPengadaanSeeder::class);
        // $this->call(JenisPensiunSeeder::class);
        // $this->call(KelJabatanSeeder::class);
        // $this->call(PendidikanSeeder::class);
        // $this->call(StatusPegawaiSeeder::class);
        // $this->call(JenisUnitKerjaSeeder::class);
        // $this->call(UnitKerjaSeeder::class);
        // $this->call(HirarkiUnitKerjaSeeder::class);
        // $this->call(BankSeeder::class);
        $this->call(StatusCutiSeeder::class);

        // Pegawai::factory(100)->create([
        //     'status_pegawai_id' => 1,
        //     'jenis_pegawai_id' => 1,
        //     'jenis_kawin_id' => 1,
        //     'agama_id' => 1
        // ]);
    }
}
