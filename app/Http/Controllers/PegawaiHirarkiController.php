<?php

namespace App\Http\Controllers;

use App\Models\PegawaiRekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\PegawaiRiwayatGolongan;
use App\Models\PegawaiRiwayatJabatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PegawaiHirarkiController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Hirarki Pegawai';

        $dataUnitKerja = DB::table('unit_kerja')
        ->select('*')
        ->whereIn('jenis_unit_kerja_id', array(1, 2, 3))
        ->where('is_active','Y')
        ->get();

        return view('pegawai-hirarki.index', compact('title', 'dataUnitKerja'));
    }
    
    public function datatable(Request $request)
    {        
        $unitKerja = $request->unitKerja;

        //dd($unitKerja);

        $data = DB::table('tx_hirarki_pegawai AS thp')
            ->selectRaw("CONCAT(p1.nama_depan, ' ', p1.nama_belakang) AS nama_staff,
                CONCAT(p2.nama_depan, ' ', p2.nama_belakang) AS nama_pimpinan,
                uk.nama AS unit_kerja")
            ->join('pegawai AS p1', function ($join) {
                $join->on('p1.id', '=', 'thp.pegawai_id')
                    ->where('p1.status_dinas', '=', 1);
            })
            ->join('pegawai AS p2', function ($join) {
                $join->on('p2.id', '=', 'thp.pegawai_pimpinan_id')
                    ->where('p2.status_dinas', '=', 1);
            })
            ->join('unit_kerja AS uk', function ($join) {
                $join->on('uk.id', '=', 'thp.unit_kerja_id')
                    ->where('uk.is_active', '=', 'Y')
                    ->where('uk.jenis_unit_kerja_id', '!=', 1);
            })
            
            ->orderBy('uk.id', 'ASC')
            ->orderBy('nama_staff', 'ASC')
            ;

            if(null != $unitKerja || '' != $unitKerja){
                $data->where('uk.id', '=', $unitKerja);
            }

        return Datatables::of($data)
        ->addColumn('no', '')

        ->make(true);
    }

    
}
