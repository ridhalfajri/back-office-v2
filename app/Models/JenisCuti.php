<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    protected $guarded = [];
    protected $table = 'jenis_cuti';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
}
