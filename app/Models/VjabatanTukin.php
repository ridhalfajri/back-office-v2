<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VJabatanTukin extends Model
{
    use HasFactory;

    // Define the table or view name
    protected $table = 'vjabatan_tukin';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    // Disable timestamps if the table or view doesn't have 'created_at' and 'updated_at' columns
    public $timestamps = false;

    // Define the fillable columns if needed
    protected $fillable = [
        'id',
        'jabatan_id',
        'jenis_jabatan_id',
        'jenis_jabatan',
        'grade',
        'nominal',
        'nama_jabatan',
    ];
}
