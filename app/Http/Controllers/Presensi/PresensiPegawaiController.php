<?php

namespace App\Http\Controllers\Presensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;
use App\Helpers\PresensiHelper;
use Illuminate\Support\Carbon;
use App\Helpers\PegawaiHelper;

class PresensiPegawaiController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $title = 'List Data Presensi';
        $user = Auth::user();

        $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);

        return view('presensi.presensi-pegawai.index', compact('title','pegawai'));
    }

    public function getdatapresensi(Request $request)
    {
        PresensiHelper::get_DataPresensi();
        return redirect()->route('presensi-pegawai.index')
            ->with('success', 'Syncronize Data Presensi berhasil');
    }
    public function datatable(Request $request)
    {

        $user = Auth::user();
        $pegawai = $user->pegawai()->first();

        if (!empty($request->date_awal) && !empty($request->date_akhir)) {

            // $data = Presensi::select('id',DB::raw('CONCAT(
            //     CASE DAYOFWEEK(tanggal_presensi)
            //         WHEN 1 THEN "Minggu"
            //         WHEN 2 THEN "Senin"
            //         WHEN 3 THEN "Selasa"
            //         WHEN 4 THEN "Rabu"
            //         WHEN 5 THEN "Kamis"
            //         WHEN 6 THEN "Jumat"
            //         WHEN 7 THEN "Sabtu"
            //     END,
            //     ", ",
            //     DATE_FORMAT(tanggal_presensi, "%d %M %Y")
            // ) AS tanggal_presensi'), 'jam_masuk','jam_pulang','kekurangan_jam','keterangan')
            // ->where('no_enroll',$pegawai->no_enroll)
            //                     ->Where('tanggal_presensi','>=',$request->date_awal)
            //                     ->Where('tanggal_presensi','<=',$request->date_akhir)
            //                     ->get();

            $data = Presensi::where('no_enroll',$pegawai->no_enroll)
                                ->Where('tanggal_presensi','>=',$request->date_awal)
                                ->Where('tanggal_presensi','<=',$request->date_akhir)
                                ->get();



            return Datatables::of($data)
            ->addColumn('no', '')
            // ->editColumn('tanggal_presensi', function ($row) {
            //     // Format the date as needed, assuming tanggal_presensi is a Carbon instance
            //     return Carbon::parse($row->tanggal_presensi)->isoFormat('dddd, D MMMM Y');
            //     // Change the format to match your requirements
            // })
            // ->filterColumn('tanggal_presensi', function ($query, $keyword) {
            //     // Custom filter logic for the date range
            //     $query->whereRaw("tanggal_presensi like ?", ["%{$keyword}%"]);
            // })
            ->make(true);
        }
        // else{
        //     return redirect()->route('presensi.index')
        //     ->with('info', 'Silakan pilih tanggal presensi');
        // }

    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {

    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

    }

    /**
    * Display the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function show(Presensi $presensi)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function edit(Presensi $presensi)
    {

    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,Presensi $presensi)
    {

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function destroy(Presensi $presensi)
    {

    }
}
