<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HirarkiUnitKerja extends Model
{
    protected $table = 'hirarki_unit_kerja';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function jabatan_unit_kerja()
    {
        return $this->hasMany(JabatanUnitKerja::class);
    }
    public function child()
    {
        return $this->belongsTo(UnitKerja::class,'child_unit_kerja_id');
    }public function parent()
    {
        return $this->belongsTo(UnitKerja::class,'parent_unit_kerja_id');
    }
}
