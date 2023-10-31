<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tukin extends Model
{
    use HasFactory;
    protected $table = 'tukin';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function jabatan_tukin()
    {
        return $this->hasMany(JabatanTukin::class);
    }
}
