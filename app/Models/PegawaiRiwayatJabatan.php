<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class PegawaiRiwayatJabatan extends Model
{
    use InteractsWithMedia;

    protected $table = 'pegawai_riwayat_jabatan';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function jabatan_unit_kerja()
    {
        return $this->belongsTo(JabatanUnitKerja::class);
    }
}
