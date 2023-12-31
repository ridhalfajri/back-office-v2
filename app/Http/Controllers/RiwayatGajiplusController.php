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
use App\Exports\DataExportPrg;
use App\Models\AturanThrGajiplus;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\PegawaiAnak;
use App\Models\PegawaiRiwayatGajiplus;
use App\Models\PegawaiRiwayatThr;
use App\Models\PegawaiSuamiIstri;
use App\Models\PegawaiTmtGaji;
use App\Models\PreTubel;
use App\Models\TunjanganBeras;
use Illuminate\Support\Facades\Auth;

class RiwayatGajiplusController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        $title = 'Riwayat Gaji-13';
        
        return view('perhitungan-gajiplus.riwayat-gajiplus', compact('title'));
    }
    
    public function datatable(Request $request)
    {        
        $tahun = $request->tahun;

        $data = [];
        if('' != $tahun){ 
            $data = PegawaiRiwayatGajiplus::select(
            'pegawai_riwayat_gajiplus.nominal_gaji_pokok', 'pegawai_riwayat_gajiplus.tunjangan_beras', 'pegawai_riwayat_gajiplus.tunjangan_pasangan',
            'pegawai_riwayat_gajiplus.tunjangan_anak', 'pegawai_riwayat_gajiplus.tunjangan_jabatan', 'pegawai_riwayat_gajiplus.tunjangan_kinerja',
            'pegawai_riwayat_gajiplus.tahun', 'pegawai_riwayat_gajiplus.total_gajiplus')
            ->where('pegawai_riwayat_gajiplus.tahun', '=', $tahun)
            //->where('pegawai_riwayat_gajiplus.pegawai_id', '=', Auth::user()->pegawai_id)
            ->where('pegawai_riwayat_gajiplus.pegawai_id', '=', 498)
            ->orderBy('pegawai_riwayat_gajiplus.tahun','desc')
            ;
        }else {
            $data = PegawaiRiwayatGajiplus::select(
                'pegawai_riwayat_gajiplus.nominal_gaji_pokok', 'pegawai_riwayat_gajiplus.tunjangan_beras', 'pegawai_riwayat_gajiplus.tunjangan_pasangan',
                'pegawai_riwayat_gajiplus.tunjangan_anak', 'pegawai_riwayat_gajiplus.tunjangan_jabatan', 'pegawai_riwayat_gajiplus.tunjangan_kinerja',
                'pegawai_riwayat_gajiplus.tahun', 'pegawai_riwayat_gajiplus.total_gajiplus')
                //->where('pegawai_riwayat_gajiplus.pegawai_id', '=', Auth::user()->pegawai_id)
                ->where('pegawai_riwayat_gajiplus.pegawai_id', '=', 498)
                ->orderBy('pegawai_riwayat_gajiplus.tahun','desc')
                ;
        }

        return Datatables::of($data)
            ->addColumn('no', '')
            ->make(true);
    }

}