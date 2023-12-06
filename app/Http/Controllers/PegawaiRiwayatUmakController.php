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

class PegawaiRiwayatUmakController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('kabiro', $kabiro);

        $title = 'Pegawai Riwayat Uang Makan';
        
        $dataUnitKerja = DB::table('unit_kerja')
        ->select('*')
        ->whereIn('jenis_unit_kerja_id', array(1, 2, 3))
        ->get();

        return view('perhitungan-umak.pegawai-riwayat-umak', compact('title', 'dataUnitKerja'));
    }
    
    public function datatable(Request $request)
    {        
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $unitKerja = $request->unitKerja;

        //dd($request);

        $data = [];
        if('' != $bulan && '' != $tahun){ 
            $data = PegawaiRiwayatUmak::select('p.nama_depan', 'p.nama_belakang', 'p.nip', 'um.nominal',
            'pegawai_riwayat_umak.jumlah_hari_masuk', 'pegawai_riwayat_umak.total', 'pegawai_riwayat_umak.is_double',
            'pegawai_riwayat_umak.bulan', 'pegawai_riwayat_umak.tahun', 'uk.nama as unit_kerja')
            ->join('pegawai as p','p.id','=','pegawai_riwayat_umak.pegawai_id')
            ->join('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai_riwayat_umak.pegawai_id')
            ->join('jabatan_unit_kerja as juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja as huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->leftJoin('unit_kerja as uk', 'uk.id', '=', 'huk.child_unit_kerja_id')
            ->join('pegawai_riwayat_golongan as prg', function ($join) {
                $join->on('prg.pegawai_id','=','p.id')
                    ->where('prg.is_active','=',1)
                    ;
            })
            ->leftJoin('uang_makan as um','um.golongan_id','=','prg.golongan_id')
            //
            ->where('pegawai_riwayat_umak.bulan', '=', $bulan)
            ->where('pegawai_riwayat_umak.tahun', '=', $tahun)
            ->orderBy('uk.id','asc');

            if(null != $unitKerja || '' != $unitKerja){
                $data->where('uk.id', '=', $unitKerja);
            }
        }

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('jumlah_hari', function ($data) {
                return $data->jumlah_hari_masuk.' hari';
            })
            ->addColumn('nama_pegawai', function ($data) {
                return $data->nama_depan.' '.$data->nama_belakang;
            })
            ->addColumn('periode', function ($data) {
                if($data->bulan == '01'){
                    return 'Jan - ' . $data->tahun;
                }
                if($data->bulan == '02'){
                    return 'Feb - ' . $data->tahun;
                }
                if($data->bulan == '03'){
                    return 'Mar - ' . $data->tahun;
                }
                if($data->bulan == '04'){
                    return 'Apr - ' . $data->tahun;
                }
                if($data->bulan == '05'){
                    return 'Mei - ' . $data->tahun;
                }
                if($data->bulan == '06'){
                    return 'Jun - ' . $data->tahun;
                }
                if($data->bulan == '07'){
                    return 'Jul - ' . $data->tahun;
                }
                if($data->bulan == '08'){
                    return 'Agt - ' . $data->tahun;
                }
                if($data->bulan == '09'){
                    return 'Sept - ' . $data->tahun;
                }
                if($data->bulan == '10'){
                    return 'Okt - ' . $data->tahun;
                }
                if($data->bulan == '11'){
                    return 'Nov - ' . $data->tahun;
                }
                if($data->bulan == '12' && $data->is_double == 'N'){
                    return 'Des - ' . $data->tahun;
                }
                if($data->bulan == '12' && $data->is_double == 'Y'){
                    return 'Des (2) - ' . $data->tahun;
                }
            })

            ->make(true);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function kalkulasiUmak(Request $request)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('kabiro', $kabiro);

        $splitTanggal = explode(" - ", $request->tanggal);
        $tanggalMulaiSplit = $splitTanggal[0];
        $tanggalAkhirSplit = $splitTanggal[1];
        //$waktuPlusSatuBulan = date('m', strtotime($tanggalAkhirSplit . ' +1 month'));

        //dd($waktuPlusSatuBulan);
        $bulan = Carbon::parse($tanggalAkhirSplit)->translatedFormat('m');
        $bulanKeDb = null;
        if($bulan == '01'){
            $bulanKeDb = '02';
        }
        if($bulan == '02'){
            $bulanKeDb = '03';
        }
        if($bulan == '03'){
            $bulanKeDb = '04';
        }
        if($bulan == '04'){
            $bulanKeDb = '05';
        }
        if($bulan == '05'){
            $bulanKeDb = '06';
        }
        if($bulan == '06'){
            $bulanKeDb = '07';
        }
        if($bulan == '07'){
            $bulanKeDb = '08';
        }
        if($bulan == '08'){
            $bulanKeDb = '09';
        }
        if($bulan == '09'){
            $bulanKeDb = '10';
        }
        if($bulan == '10'){
            $bulanKeDb = '11';
        }
        if($bulan == '11'){
            $bulanKeDb = '12';
        }

        //kondisi bulan
        //$bulan = Carbon::parse($waktuPlusSatuBulan)->translatedFormat('m');
        $tahun = Carbon::parse($tanggalAkhirSplit)->translatedFormat('Y');

        //kalo tgl awal dan akhir desember
        $isDouble = 'N';
        if('12' == Carbon::parse($tanggalMulaiSplit)->translatedFormat('m')
            && '12' == Carbon::parse($tanggalAkhirSplit)->translatedFormat('m')){
                $bulanKeDb = Carbon::parse($tanggalAkhirSplit)->translatedFormat('m');
                $isDouble = 'Y';
        }

        $tanggalMulaiFormat = Carbon::parse($tanggalMulaiSplit)->translatedFormat('Y-m-d');
        $tanggalAkhirFormat = Carbon::parse($tanggalAkhirSplit)->translatedFormat('Y-m-d');

        DB::beginTransaction();

        try {
            //looping data pegawai
            $listPegawai = DB::table('pegawai as p')
            ->select('p.id', 'p.no_enroll')
            ->leftJoin('status_pegawai as sp', function ($join) {
                $join->on('sp.id','=','p.status_pegawai_id')
                    ->whereIn('sp.nama', array('PNS', 'CPNS', 'PPPK'))
                    ;
            })
            //untuk test, data pegawai_riwayat_golongan harus ada!
            //->where('p.id','=',498)
            ->get();

            //cek list ada atau tidak
            if($listPegawai->isNotEmpty()){
                $pegawaiId = null;
                $jumlahHariMasuk = null;
                $uangMakanId = null;
                $nominalUangMakan = null;
                $totalUangMakan = null;

                foreach($listPegawai as $dataPegawai){
                    //
                    $pegawaiId = $dataPegawai->id;

                    //
                    $jumlahHariMasuk = DB::table('presensi')
                    ->select('tanggal_presensi')
                    ->whereBetween('tanggal_presensi', [$tanggalMulaiFormat, $tanggalAkhirFormat])
                    ->where('no_enroll','=',$dataPegawai->no_enroll)
                    ->where('status_kehadiran','=','HADIR')
                    ->where(function($query) {
                        $query->whereRaw('jam_masuk != null')
                            ->orWhereRaw('jam_pulang != null')
                            ->orWhere('jam_pulang','!=','00:00:00')
                            ->orWhere('jam_masuk','!=','00:00:00')
                            ;
                    })
                    ->count();

                    $umakPegawai = DB::table('uang_makan as um')
                    ->select('um.id', 'um.nominal')
                    ->join('pegawai_riwayat_golongan as prg', function ($join) use ($pegawaiId) {
                        $join->on('prg.golongan_id','=','um.golongan_id')
                            ->where('prg.is_active','=',1)
                            ->where('prg.pegawai_id','=',$pegawaiId)
                            ;
                    })
                    ->first();

                    if(null != $umakPegawai){
                        //
                        $uangMakanId = $umakPegawai->id;
                        $nominalUangMakan = $umakPegawai->nominal;

                        //
                        $totalUangMakan = $nominalUangMakan*$jumlahHariMasuk;
                    } else {
                        session()->flash('message', 'Ada pegawai yang datanya belum ada di tabel pegawai_riwayat_golongan!');

                        return redirect()->back();
                    }

                    //cek ke tabel pegawai_riwayat_umak ada data tidak
                    $cekDataPru = null;
                    if($isDouble == 'Y'){
                        $cekDataPru = DB::table('pegawai_riwayat_umak')
                        ->select('*')
                        ->where('pegawai_id','=',$pegawaiId)
                        ->where('bulan','=',$bulanKeDb)
                        ->where('tahun','=',$tahun)
                        ->where('is_double', '=', 'Y')
                        ->get();
                    }else{
                        $cekDataPru = DB::table('pegawai_riwayat_umak')
                        ->select('*')
                        ->where('pegawai_id','=',$pegawaiId)
                        ->where('bulan','=',$bulanKeDb)
                        ->where('tahun','=',$tahun)
                        ->where('is_double', '=', 'N')
                        ->get();
                    }

                    if($cekDataPru->isNotEmpty()){
                        if($isDouble == 'Y'){
                            //update
                            DB::table('pegawai_riwayat_umak')
                            ->where('pegawai_id', $pegawaiId)
                            ->where('bulan', $bulanKeDb)
                            ->where('tahun', $tahun)
                            ->where('is_double', '=', 'Y')
                            ->update([
                                'uang_makan_id' => $uangMakanId,
                                'jumlah_hari_masuk' => $jumlahHariMasuk,
                                'total' => $totalUangMakan,
                                'updated_at' => now(),
                            ]);
                        }else{
                            //update
                            DB::table('pegawai_riwayat_umak')
                            ->where('pegawai_id', $pegawaiId)
                            ->where('bulan', $bulanKeDb)
                            ->where('tahun', $tahun)
                            ->where('is_double', '=', 'N')
                            ->update([
                                'uang_makan_id' => $uangMakanId,
                                'jumlah_hari_masuk' => $jumlahHariMasuk,
                                'total' => $totalUangMakan,
                                'updated_at' => now(),
                            ]);
                        }
                    } else {
                        //insert
                        DB::table('pegawai_riwayat_umak')->insert([
                            'pegawai_id' => $pegawaiId,
                            'uang_makan_id' => $uangMakanId,
                            'jumlah_hari_masuk' => $jumlahHariMasuk,
                            'total' => $totalUangMakan,
                            'bulan' => $bulanKeDb,
                            'tahun' => $tahun,
                            'is_double' => $isDouble,
                            'created_at' => now(),
                        ]);
                    }
                }
            } else {
                session()->flash('message', 'Data pegawai tidak ada untuk memproses kalkulasi uang makan!');

                return redirect()->back();
            }

            DB::commit();
            Log::info('Data uang makan berhasil di-kalkulasi di method kalkulasi pada PegawaiRiwayatUmakController!');

            session()->flash('success', 'Berhasil kalkulasi uang makan pegawai!');

            return redirect()->back();
            // return redirect()->route('pegawai-riwayat-umak.index')
            //     ->with('success', 'Data Pegawai Riwayat Uang Makan berhasil di-insert!');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert atau di-update di method kalkulasi pada PegawaiRiwayatUmakController!']);

            session()->flash('message', 'Error saat proses data!');

            return redirect()->back();
            // return redirect()->route('pegawai-riwayat-umak.index')
            //         ->with('error', 'Error saat Proses Data Pegawai Riwayat Uang Makan!');
        }  
        
    }

}
