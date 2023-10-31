<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatihanStruktural extends Model
{
    protected $table = 'latihan_struktural';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
}
