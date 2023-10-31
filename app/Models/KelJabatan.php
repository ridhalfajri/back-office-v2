<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelJabatan extends Model
{
    protected $table = 'kel_jabatan';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function jabatan_fungsional()
    {
        return $this->hasMany(JabatanFungsional::class);
    }
}
