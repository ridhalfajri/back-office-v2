<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use AzisHapidin\IndoRegion\Traits\DistrictTrait;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kota;
use App\Models\Desa;

/**
 * Kecamatan Model.
 */
class Kecamatan extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'kecamatan';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'kota_id'
    ];

    /**
     * Kecamatan belongs to Kota.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    /**
     * Kecamatan has many villages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function desa()
    {
        return $this->hasMany(Desa::class);
    }
    public function pegawai_alamat()
    {
        return $this->hasMany(PegawaiAlamat::class);
    }
}
