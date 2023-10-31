<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    protected $table = 'unit_kerja';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function jenis_unit_kerja()
    {
        return $this->belongsTo(JenisUnitKerja::class);
    }
    public function child_hirarki()
    {
        return $this->hasMany(HirarkiUnitKerja::class, 'child_unit_kerja_id');
    }public function parent_hirarki()
    {
        return $this->hasMany(HirarkiUnitKerja::class, 'parent_unit_kerja_id');
    }
}
