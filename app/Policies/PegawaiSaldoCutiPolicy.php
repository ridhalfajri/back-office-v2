<?php

namespace App\Policies;

use App\Models\PegawaiSaldoCuti;
use App\Models\User;

class PegawaiSaldoCutiPolicy
{
    public function view(User $user, PegawaiSaldoCuti $pegawaiSaldoCuti)
    {
        // dd($user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2);
        return $user->pegawai_id == $pegawaiSaldoCuti->pegawai_id;
    }
}
