<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpkn extends Model
{
    protected $table = 'kpkn';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
}
