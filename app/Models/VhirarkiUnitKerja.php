<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VhirarkiUnitKerja extends Model
{
    use HasFactory;

    // Define the table or view name
    protected $table = 'vhirarki_unit_kerja';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Disable timestamps if the table or view doesn't have 'created_at' and 'updated_at' columns
    public $timestamps = false;

    // Define the fillable columns if needed
    protected $fillable = [
        'id',
        'child_unit_kerja_id',
        'parent_unit_kerja_id',
        'nama_unit_kerja',
        'nama_jenis_unit_kerja',
        'nama_parent_unit_kerja',
    ];
}
