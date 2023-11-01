<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use AzisHapidin\IndoRegion\Traits\RegencyTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Kota Model.
 */
class Kota extends Model
{

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'kota';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'propinsi_id'
    ];

    /**
     * Kota belongs to Propinsi.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function propinsi()
    {
        return $this->belongsTo(Propinsi::class);
    }

    /**
     * Kota has many districts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
    }
    public function pegawai_alamat()
    {
        return $this->hasMany(PegawaiAlamat::class);
    }
}
