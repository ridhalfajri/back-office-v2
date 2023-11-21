<?php

namespace App\Policies;

use App\Models\PegawaiRiwayatJabatan;
use App\Models\User;

class PegawaiRiwayatJabatanPolicy
{
    /**
     * Create a new policy instance.
     */
    public function kabiro(User $user, PegawaiRiwayatJabatan $pegawaiRiwayatJabatan)
    {
        return $user->pegawai_id == $pegawaiRiwayatJabatan->pegawai_id;
    }
    public function atasan_langsung(User $user, PegawaiRiwayatJabatan $pegawaiRiwayatJabatan)
    {
        return $user->pegawai_id == $pegawaiRiwayatJabatan->pegawai_id;
    }
}
