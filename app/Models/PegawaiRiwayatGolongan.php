<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiRiwayatGolongan extends Model
{
    protected $table = 'pegawai_riwayat_golongan';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
