<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KedudukanHukum extends Model
{
    protected $table = 'kedudukan_hukum';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
}
