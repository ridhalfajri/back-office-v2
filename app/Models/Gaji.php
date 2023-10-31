<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'gaji';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }
    public function pegawai_tmt_gaji()
    {
        return $this->hasMany(PegawaiTmtGaji::class);
    }
}
