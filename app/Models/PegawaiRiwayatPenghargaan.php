<?php

namespace App\Models;

use App\Models\Siasn\SiasnPnsRwPenghargaan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PegawaiRiwayatPenghargaan extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];
    protected $table = 'pegawai_riwayat_penghargaan';
    protected $casts = [
        'tanggal_sk' => 'date'
    ];

    public function penghargaan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Penghargaan::class);
    }

    public function pegawai(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function siasnRwPenghargaan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SiasnPnsRwPenghargaan::class, 'bkn_id', 'id');
    }
}
