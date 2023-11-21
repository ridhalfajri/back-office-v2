<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PegawaiCuti extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'pegawai_cuti';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    public function jenis_cuti()
    {
        return $this->belongsTo(JenisCuti::class);
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function atasan_langsung()
    {
        return $this->belongsTo(Pegawai::class, 'atasan_langsung_id');
    }
}
