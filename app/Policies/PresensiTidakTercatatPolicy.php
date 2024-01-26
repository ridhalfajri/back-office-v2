<?php

namespace App\Policies;
use App\Models\PreTakTercatat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PresensiTidakTercatatPolicy
{
    public function preTCAuth(User $user, PreTakTercatat $preTakTercatat)
    {
        if ($preTakTercatat->no_enroll==$user->pegawai->no_enroll && $preTakTercatat->status == 1) {
            return true;
        }{
            return false;
        }
    }

    public function preTCPimpinanAuth(User $user)
    {
        if (($user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 1 ||
        $user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2 || $user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)){
            return true;
        } else {
            return false;
        }
    }

    public function preTCKonfirmasiPimpinanAuth(User $user, PreTakTercatat $preTakTercatat)
    {
        if (($user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 1 ||
        $user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2 || $user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5) && $preTakTercatat->status == 1){
            return true;
        } else {
            return false;
        }
    }

}
