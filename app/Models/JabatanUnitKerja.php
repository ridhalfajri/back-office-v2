<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JabatanUnitKerja extends Model
{
    protected $table = 'jabatan_unit_kerja';
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public function jabatan_tukin()
    {
        return $this->belongsTo(JabatanTukin::class);
    }
    public function hirarki_unit_kerja()
    {
        return $this->belongsTo(HirarkiUnitKerja::class);
    }
    public function pegawai_riwayat_jabatan()
    {
        return $this->hasMany(PegawaiRiwayatJabatan::class);
    }
    public function get_data_jabatan_unit_kerja()
    {
        $result = DB::table('jabatan_unit_kerja AS x')
            ->select('x.id', 'x.jabatan_tukin_id', 'z.jenis_jabatan', 'z.jenis_jabatan_id as jenis_jabatan_id', 'z.nama_jabatan', 'y.nama_unit_kerja', 'x.hirarki_unit_kerja_id', 'y.child_unit_kerja_id', 'y.parent_unit_kerja_id', 'y.nama_parent_unit_kerja')
            ->joinSub(function ($query) {
                $query->select('a.id', 'a.child_unit_kerja_id', 'a.parent_unit_kerja_id', 'b.nama AS nama_unit_kerja', 'c.nama_jenis_unit_kerja', 'c.nama_parent_unit_kerja')
                    ->from('hirarki_unit_kerja AS a')
                    ->join('unit_kerja AS b', 'a.child_unit_kerja_id', '=', 'b.id')
                    ->joinSub(function ($query) {
                        $query->select('a.id', 'a.child_unit_kerja_id', 'a.parent_unit_kerja_id', 'c.nama AS nama_jenis_unit_kerja', 'b.nama AS nama_parent_unit_kerja')
                            ->from('hirarki_unit_kerja AS a')
                            ->join('unit_kerja AS b', 'a.parent_unit_kerja_id', '=', 'b.id')
                            ->join('jenis_unit_kerja AS c', 'c.id', '=', 'b.jenis_unit_kerja_id');
                    }, 'c', 'a.id', '=', 'c.id');
            }, 'y', 'x.hirarki_unit_kerja_id', '=', 'y.id')
            ->joinSub(function ($query) {
                $query->select('a.id', 'a.jabatan_id', 'a.jenis_jabatan_id', 'b.nama AS jenis_jabatan', 'c.grade', 'c.nominal')
                    ->addSelect(DB::raw('
                            CASE
                                WHEN a.jenis_jabatan_id = 1 THEN d.nama
                                WHEN a.jenis_jabatan_id = 2 THEN e.nama
                                WHEN a.jenis_jabatan_id = 4 THEN f.nama
                                ELSE NULL
                            END AS nama_jabatan
                        '))
                    ->from('jabatan_tukin AS a')
                    ->join('jenis_jabatan AS b', 'a.jenis_jabatan_id', '=', 'b.id')
                    ->join('tukin AS c', 'a.tukin_id', '=', 'c.id')
                    ->leftJoin('jabatan_struktural AS d', 'd.id', '=', 'a.jabatan_id')
                    ->leftJoin('jabatan_fungsional AS e', 'e.id', '=', 'a.jabatan_id')
                    ->leftJoin('jabatan_fungsional_umum AS f', 'f.id', '=', 'a.jabatan_id');
            }, 'z', 'x.jabatan_tukin_id', '=', 'z.id')
            ->where('z.jenis_jabatan_id', 1);
        // ->where('y.child_unit_kerja_id', 16);

        dd($result->get());
        return $result;
    }
}
