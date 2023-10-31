<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUnitKerja extends Model
{
    protected $table = 'jenis_unit_kerja';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function unit_kerja()
    {
        return $this->hasMany(UnitKerja::class);
    }
}
