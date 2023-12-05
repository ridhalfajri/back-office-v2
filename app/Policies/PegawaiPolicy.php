<?php

namespace App\Policies;

use App\Models\Pegawai;
use App\Models\PegawaiRiwayatJabatan;
use App\Models\TxHirarkiPegawai;
use App\Models\User;

class PegawaiPolicy
{
    public function personal(User $user, Pegawai $pegawai)
    {
        $hirarki = TxHirarkiPegawai::where('pegawai_id', $pegawai->id)->first();
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->first();
        if ($user->pegawai_id == $kabiro->pegawai_id || $user->pegawai_id == $hirarki->pegawai_pimpinan_id) {
            return true;
        } else {
            return $user->pegawai_id == $pegawai->id;
        }
    }
}
