<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use AzisHapidin\IndoRegion\Traits\ProvinceTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Propinsi Model.
 */
class Propinsi extends Model
{
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'propinsi';

    /**
     * Propinsi has many regencies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kota()
    {
        return $this->hasMany(Kota::class);
    }
    public function pegawai_alamat()
    {
        return $this->hasMany(PegawaiAlamat::class);
    }
}
