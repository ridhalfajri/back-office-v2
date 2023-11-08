<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PegawaiSuamiIstri extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'pegawai_suami_istri';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }
    public function jenis_kawin()
    {
        return $this->belongsTo(JenisKawin::class);
    }
}
