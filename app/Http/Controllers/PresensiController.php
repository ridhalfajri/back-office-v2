<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Presensi;
use Illuminate\Support\Facades\Auth;
use App\Helpers\PresensiHelper;

class PresensiController extends Controller
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
        $pegawai = $user->pegawai()->first();
        return view('presensi.index', compact('title','pegawai'));
    }

    public function getdatapresensi(Request $request)
    {
        PresensiHelper::get_DataPresensi();
        return redirect()->route('presensi.index')
            ->with('info', 'Syncronize Data Presensi berhasil');
    }
    public function datatable(Request $request)
    {

        $user = Auth::user();
        $pegawai = $user->pegawai()->first();


        if (!empty($request->date_awal) && !empty($request->date_akhir)) {

            $data = Presensi::where('no_enroll',$pegawai->no_enroll)
                                ->Where('tanggal_presensi','>=',$request->date_awal)
                                ->Where('tanggal_presensi','<=',$request->date_akhir)
                                ->get();


            return Datatables::of($data)
            ->addColumn('no', '')
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
