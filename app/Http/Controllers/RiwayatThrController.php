<?php

namespace App\Http\Controllers;

use App\Models\PegawaiRiwayatJabatan;
use App\Models\PegawaiRiwayatUmak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\UangMakan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExportPrt;
use App\Models\AturanThrGajiplus;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\PegawaiAnak;
use App\Models\PegawaiRiwayatThr;
use App\Models\PegawaiSuamiIstri;
use App\Models\PegawaiTmtGaji;
use App\Models\PreTubel;
use App\Models\TunjanganBeras;
use Illuminate\Support\Facades\Auth;

class RiwayatThrController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        //dd(Auth::user()->pegawai_id);

        $title = 'Riwayat THR';
        
        return view('perhitungan-thr.riwayat-thr', compact('title'));
    }
    
    public function datatable(Request $request)
    {        
        $tahun = $request->tahun;

        $data = [];
        if('' != $tahun){ 
            $data = PegawaiRiwayatThr::select(
            'pegawai_riwayat_thr.nominal_gaji_pokok', 'pegawai_riwayat_thr.tunjangan_beras', 'pegawai_riwayat_thr.tunjangan_pasangan',
            'pegawai_riwayat_thr.tunjangan_anak', 'pegawai_riwayat_thr.tunjangan_jabatan', 'pegawai_riwayat_thr.tunjangan_kinerja',
            'pegawai_riwayat_thr.tahun', 'pegawai_riwayat_thr.total_thr')
            ->where('pegawai_riwayat_thr.tahun', '=', $tahun)
            ->where('pegawai_riwayat_thr.pegawai_id', '=', Auth::user()->pegawai_id)
            //->where('pegawai_riwayat_thr.pegawai_id', '=', 498)
            ->orderBy('pegawai_riwayat_thr.tahun','desc')
            ;
        }else {
            $data = PegawaiRiwayatThr::select(
                'pegawai_riwayat_thr.nominal_gaji_pokok', 'pegawai_riwayat_thr.tunjangan_beras', 'pegawai_riwayat_thr.tunjangan_pasangan',
                'pegawai_riwayat_thr.tunjangan_anak', 'pegawai_riwayat_thr.tunjangan_jabatan', 'pegawai_riwayat_thr.tunjangan_kinerja',
                'pegawai_riwayat_thr.tahun', 'pegawai_riwayat_thr.total_thr')
                ->where('pegawai_riwayat_thr.pegawai_id', '=', Auth::user()->pegawai_id)
                //->where('pegawai_riwayat_thr.pegawai_id', '=', 498)
                ->orderBy('pegawai_riwayat_thr.tahun','desc');
        }

        return Datatables::of($data)
            ->addColumn('no', '')
            ->make(true);
    }

}
