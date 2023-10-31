<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    protected $table = 'golongan';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function uang_makan()
    {
        return $this->hasMany(UangMakan::class);
    }
    public function gaji()
    {
        return $this->hasMany(Gaji::class);
    }
}
