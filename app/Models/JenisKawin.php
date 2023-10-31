<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKawin extends Model
{
    use HasFactory;

    protected $table = 'jenis_kawin';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    public function pegawai_riwayat_thp()
    {
        return $this->hasMany(PegawaiRiwayatThp::class);
    }
}
