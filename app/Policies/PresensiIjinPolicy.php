<?php

namespace App\Policies;
use App\Models\PreIjin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PresensiIjinPolicy
{
    public function preIjinAuth(User $user, PreIjin $preIjin)
    {

        if ($preIjin->no_enroll==$user->pegawai->no_enroll && $preIjin->status == 1) {
            return true;
        }{
            return false;
        }
    }

    public function preIjinPimpinanAuth(User $user)
    {
        if (($user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 1 ||
        $user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2 || $user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5)){
            return true;
        } else {
            return false;
        }
    }

    public function preIjinKonfirmasiPimpinanAuth(User $user, PreIjin $preIjin)
    {
        if (($user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 1 ||
        $user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2 || $user->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5) && $preIjin->status == 1){
            return true;
        } else {
            return false;
        }
    }

}
