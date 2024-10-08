<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PegawaiAnak extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'pegawai_anak';
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
        return $this->belongsTo(TingkatPendidikan::class);
    }
}
