<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiRekening extends Model
{
    protected $table = 'pegawai_rekening';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
