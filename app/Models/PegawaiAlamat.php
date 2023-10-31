<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiAlamat extends Model
{
    protected $table = 'pegawai_alamat';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function propinsi()
    {
        return $this->belongsTo(Propinsi::class);
    }public function kota()
    {
        return $this->belongsTo(Kota::class);
    }
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }
}
