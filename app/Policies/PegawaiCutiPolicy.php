<?php

namespace App\Policies;

use App\Models\PegawaiCuti;
use App\Models\User;

class PegawaiCutiPolicy
{
    public function view(User $user, PegawaiCuti $pegawaiCuti)
    {
        return $user->pegawai_id == $pegawaiCuti->pegawai_id;
    }
    public function delete(User $user, PegawaiCuti $pegawaiCuti)
    {
        return $user->pegawai_id == $pegawaiCuti->pegawai_id;
    }
}
