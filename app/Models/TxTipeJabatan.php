<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TxTipeJabatan extends Model
{
    use HasFactory;
    protected $table = 'tx_tipe_jabatan';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    public function pegawai_riwayat_jabatan()
    {
        return $this->hasMany(PegawaiRiwayatJabatan::class);
    }
}
