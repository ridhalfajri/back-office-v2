<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PreDinasLuar extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'pre_dinas_luar';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

}
