<?php

namespace App\Http\Controllers;

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
        $title = 'Pegawai Riwayat Uang Makan';

        return view('perhitungan-umak.pegawai-riwayat-umak', compact('title'));
    }
    
    public function datatable(Request $request)
    {        
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        //dd($request);

        $data = [];
        if('' != $bulan && '' != $tahun){ 
            $data = PegawaiRiwayatUmak::select('p.nama_depan', 'p.nama_belakang', 'p.nip', 'um.nominal',
            'pegawai_riwayat_umak.jumlah_hari_masuk', 'pegawai_riwayat_umak.total',
            'pegawai_riwayat_umak.bulan', 'pegawai_riwayat_umak.tahun')
            ->join('pegawai as p','p.id','=','pegawai_riwayat_umak.pegawai_id')
            // ->leftJoin('status_pegawai as sp', function ($join) {
            //     $join->on('sp.id','=','p.status_pegawai_id')
            //         ->whereIn('sp.nama', array('PNS', 'CPNS', 'PPPK'))
            //         ;
            // })
            ->join('pegawai_riwayat_golongan as prg', function ($join) {
                $join->on('prg.pegawai_id','=','p.id')
                    ->where('prg.is_active','=',1)
                    ;
            })
            ->leftJoin('uang_makan as um','um.golongan_id','=','prg.golongan_id')
            ->where('pegawai_riwayat_umak.bulan', '=', $bulan)
            ->where('pegawai_riwayat_umak.tahun', '=', $tahun)
            ->orderBy('um.nominal','desc');
        } else {
            $data = PegawaiRiwayatUmak::select('p.nama_depan', 'p.nama_belakang', 'p.nip', 'um.nominal',
            'pegawai_riwayat_umak.jumlah_hari_masuk', 'pegawai_riwayat_umak.total',
            'pegawai_riwayat_umak.bulan', 'pegawai_riwayat_umak.tahun')
            ->join('pegawai as p','p.id','=','pegawai_riwayat_umak.pegawai_id')
            // ->leftJoin('status_pegawai as sp', function ($join) {
            //     $join->on('sp.id','=','p.status_pegawai_id')
            //         ->whereIn('sp.nama', array('PNS', 'CPNS', 'PPPK'))
            //         ;
            // })
            ->join('pegawai_riwayat_golongan as prg', function ($join) {
                $join->on('prg.pegawai_id','=','p.id')
                    ->where('prg.is_active','=',1)
                    ;
            })
            ->leftJoin('uang_makan as um','um.golongan_id','=','prg.golongan_id')
            ->where('pegawai_riwayat_umak.bulan', '=', Carbon::now()->format('m'))
            ->where('pegawai_riwayat_umak.tahun', '=', Carbon::now()->format('Y'))
            ->orderBy('um.nominal','desc');
        }

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('nama_pegawai', function ($data) {
                return $data->nama_depan.' '.$data->nama_belakang;
            })
            ->addColumn('periode', function ($data) {
                switch ($data->bulan) {
                    case '01':
                        return 'Jan - ' . $data->tahun;
                        break;
                    case '02':
                        return 'Feb - ' . $data->tahun;
                        break;
                    case '03':
                        return 'Mar - ' . $data->tahun;
                        break;
                    case '04':
                        return 'Apr - ' . $data->tahun;
                        break;
                    case '05':
                        return 'Mei - ' . $data->tahun;
                        break;
                    case '06':
                        return 'Jun - ' . $data->tahun;
                        break;
                    case '07':
                        return 'Jul - ' . $data->tahun;
                        break;
                    case '08':
                        return 'Agt - ' . $data->tahun;
                        break;
                    case '09':
                        return 'Sep - ' . $data->tahun;
                        break;
                    case '10':
                        return 'Okt - ' . $data->tahun;
                        break;
                    case '11':
                        return 'Nov - ' . $data->tahun;
                        break;
                    case '12':
                        return 'Des - ' . $data->tahun;
                        break;
                }
            })

            ->make(true);
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    // public function create()
    // {            
    //     $title = 'Buat Uang Makan';

    //     $golongan = DB::table('golongan')
    //     ->select('golongan.*')
    //     ->get();

    //     return view('uang-makan.create', compact('title', 'golongan'));
    // }
        
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function kalkulasiUmak(Request $request)
    {
        //saat desember akhir dan januari bagaimana kondisinya
        //januari tidak akan muncul buttonnya dan muncul saat tgl 7 v
        //desember akhir bagaimana??
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        //validasi bulan dan tahun harus ke isi
        $this->validate($request, [
            'bulan' => ['required'],
            'tahun' => ['required']
        ],
        [
            'bulan.required'=>'bulan harus diisi saat kalkulasi!',
            //'golongan_id.integer'=>'data golongan harus bilangan bulat positif!',
            'tahun.required'=>'tahun harus diisi saat kalkulasi!',
            //'nominal.integer'=>'data nominal harus bilangan bulat positif!',
        ]);

        //kondisi bulan
        $bulanCalc = null;
        if($bulan == '12'){
            $bulanCalc = '11';
        }
        if($bulan == '11'){
            $bulanCalc = '10';
        }
        if($bulan == '10'){
            $bulanCalc = '09';
        }
        if($bulan == '09'){
            $bulanCalc = '08';
        }
        if($bulan == '08'){
            $bulanCalc = '07';
        }
        if($bulan == '07'){
            $bulanCalc = '06';
        }
        if($bulan == '06'){
            $bulanCalc = '05';
        }
        if($bulan == '05'){
            $bulanCalc = '04';
        }
        if($bulan == '04'){
            $bulanCalc = '03';
        }
        if($bulan == '03'){
            $bulanCalc = '02';
        }
        if($bulan == '02'){
            $bulanCalc = '01';
        }

        //
        $periodePerhitungan = $tahun.'-'.$bulanCalc;

        //dd($bulan);

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
                    ->whereRaw("DATE_FORMAT(tanggal_presensi, '%Y-%m') = ?", [$periodePerhitungan])
                    ->where('no_enroll','=',$dataPegawai->no_enroll)
                    ->where('is_tubel','=','N')
                    ->where('is_cuti','=','N')
                    ->where('is_dinas_luar','=','N')
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
                    $cekDataPru = DB::table('pegawai_riwayat_umak')
                    ->select('*')
                    ->where('pegawai_id','=',$pegawaiId)
                    ->where('bulan','=',$bulanCalc)
                    ->where('tahun','=',$tahun)
                    ->get();

                    if($cekDataPru->isNotEmpty()){
                        //update
                        DB::table('pegawai_riwayat_umak')
                        ->where('pegawai_id', $pegawaiId)
                        ->where('bulan', $bulanCalc)
                        ->where('tahun', $tahun)
                        ->update([
                            'uang_makan_id' => $uangMakanId,
                            'jumlah_hari_masuk' => $jumlahHariMasuk,
                            'total' => $totalUangMakan,
                            'updated_at' => now(),
                        ]);
                    } else {
                        //insert
                        DB::table('pegawai_riwayat_umak')->insert([
                            'pegawai_id' => $pegawaiId,
                            'uang_makan_id' => $uangMakanId,
                            'jumlah_hari_masuk' => $jumlahHariMasuk,
                            'total' => $totalUangMakan,
                            'bulan' => $bulanCalc,
                            'tahun' => $tahun,
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

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    // public function show(UangMakan $uangMakan)
    // {
    //     //
    // }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    // public function edit(UangMakan $uangMakan)
    // {               
    //     $title = 'Ubah Uang Makan';

    //     $umak = $uangMakan;

    //     $golongan = DB::table('golongan')
    //     ->select('golongan.*')
    //     ->get();

    //     return view('uang-makan.edit', compact('title','umak', 'golongan'));
    // }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    // public function update(Request $request, UangMakan $uangMakan)
    // {  
    //     DB::beginTransaction();

    //     $this->validate($request, [
    //         'golongan_id' => ['required', 'integer', 'min:1', 'max:999'],
    //         'nominal' => ['required', 'integer', 'min:1', 'max:999999999999999']
    //     ],
    //     [
    //         'golongan_id.required'=>'data golongan harus diisi!',
    //         'golongan_id.integer'=>'data golongan harus bilangan bulat positif!',
    //         'nominal.required'=>'data nominal harus diisi!',
    //         'nominal.integer'=>'data nominal harus bilangan bulat positif!',
    //     ]);

    //     try {
    //         //validasi golongan
    //         $cekDataExist = UangMakan::where('golongan_id',$request->golongan_id)
    //             ->where('id','!=',$uangMakan->id)
    //             ->get();

    //         if($cekDataExist->isNotEmpty()){
    //             session()->flash('message', 'Data golongan sudah ada!');

    //             return redirect()->back();
    //         } else {
    //             $uangMakan->golongan_id = $request->golongan_id;
    //             $uangMakan->nominal = $request->nominal;
                
    //             $uangMakan->update();
    //             DB::commit();
    //             Log::info('Data berhasil di-update di method update pada UangMakanController!');

    //             return redirect()->route('uang-makan.index')
    //                 ->with('success', 'Data Uang Makan berhasil diupdate');
    //         }    
    //     } catch (\Exception $e) {
    //         //throw $th;
    //         DB::rollback();
    //         Log::error($e->getMessage(), ['Data gagal di-update di method update pada UangMakanController!']);

    //         session()->flash('message', 'Error saat proses data!');

    //         // return redirect()->route('uang-makan.create');
    //         return redirect()->back();
    //     }  
    // }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */        
    // public function destroy(UangMakan $uangMakan)
    // {           
    //     DB::beginTransaction();
    //     try {
    //         //$profisiensiMSampelUp->deleted_by = Auth::user()->username;;
    //         $uangMakan->delete();

    //         $response['status'] = [
    //             'code' => 200,
    //             'message' => 'Data Uang Makan berhasil di hapus!',
    //             'error' => false,
    //             'error_message' => ''
    //         ];

    //         DB::commit();
    //         Log::info('Data berhasil di-delete di method destroy pada UangMakanController!');

    //         return response()->json($response, 200);
    //     } catch (\Exception $e) {
    //         $response['status'] = [
    //             'code' => 200,
    //             'message' => 'Data Uang Makan gagal dibatalkan!',
    //             'error' => true,
    //             'error_message' => 'Data Uang Makan gagal dibatalkan!'
    //         ];

    //         Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada UangMakanController!']);
    //         DB::rollback();

    //         return response()->json($response, 200);
    //     }
    // }
}
