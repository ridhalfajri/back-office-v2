<?php

namespace App\Policies;

use App\Models\Pegawai;
use App\Models\PegawaiRiwayatJabatan;
use App\Models\User;

class PegawaiPolicy
{
    public function personal(User $user, Pegawai $pegawai)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->first();
        if ($user->pegawai_id == $kabiro->pegawai_id) {
            return true;
        } else {
            return $user->pegawai_id == $pegawai->id;
        }
    }
}