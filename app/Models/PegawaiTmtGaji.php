<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PegawaiTmtGaji extends Model implements HasMedia

{
    use InteractsWithMedia;

    protected $table = 'pegawai_tmt_gaji';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function gaji()
    {
        return $this->belongsTo(Gaji::class);
    }
}
