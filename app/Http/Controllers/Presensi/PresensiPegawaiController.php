<?php

namespace App\Http\Controllers\Presensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Presensi;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;
use App\Helpers\PresensiHelper;
use Illuminate\Support\Carbon;
use App\Helpers\PegawaiHelper;
use Yajra\DataTables\Facades\DataTables;

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


        return view('presensi.presensiku.index', compact('title','pegawai'));
    }

    public function getdatapresensi(Request $request)
    {
        PresensiHelper::get_DataPresensi();
        return redirect()->route('presensiku.index')
            ->with('success', 'Syncronize Data Presensi berhasil');
    }

    public function datatable(Request $request)
    {

        $user = Auth::user();

        $pegawai = Pegawai::where('id', '=', $user->pegawai_id)->first();


        if (!empty($request->date_awal) && !empty($request->date_akhir) &&  $pegawai ) {


            $data = Presensi::where('no_enroll',$pegawai->no_enroll)
                                ->Where('tanggal_presensi','>=',$request->date_awal)
                                ->Where('tanggal_presensi','<=',$request->date_akhir)
                                ->orderBy('tanggal_presensi', 'asc')
                                ;



            return Datatables::of($data)
            ->addColumn('no', '')
            ->editColumn('nominal_potongan', function ($row) {
                // Format the data as needed here
                $nom =  (float)$row->nominal_potongan;
                return "Rp " . number_format($nom, 0, ',', '.');
            })
            ->editColumn('tanggal_presensi', function ($row) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                // Format the date as needed, assuming tanggal_presensi is a Carbon instance
                $formattedDate = Carbon::parse($row->tanggal_presensi)->isoFormat('dddd, D MMMM Y');

                return $formattedDate;
            })
            ->filterColumn('tanggal_presensi', function ($query, $keyword) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $query->whereRaw("DATE_FORMAT(tanggal_presensi, '%W, %d %M %Y') like ?", ["%$keyword%"]);

            })

            ->make(true);
        }

    }


    public function dataPresensiPegawai()
    {
        $title = 'List Data Presensi Pegawai';
        $pegawai = Pegawai::where(function ($query) {
            $query->where('tanggal_berhenti', null)
                  ->orWhere('tanggal_berhenti', '');
        })->get();

        $hirarkiUnitKerja = DB::table('db_backoffice.hirarki_unit_kerja as a')
                ->select('a.id', 'a.child_unit_kerja_id', 'a.parent_unit_kerja_id', 'b.nama as nama_unit_kerja', 'c.nama_jenis_unit_kerja', 'c.nama_parent_unit_kerja')
                ->join('unit_kerja as b', 'a.child_unit_kerja_id', '=', 'b.id')
                ->join(DB::raw('(SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, c.nama as nama_jenis_unit_kerja, b.nama as nama_parent_unit_kerja
                        FROM db_backoffice.hirarki_unit_kerja a
                        INNER JOIN unit_kerja b ON a.parent_unit_kerja_id = b.id
                        INNER JOIN jenis_unit_kerja c ON c.id = b.jenis_unit_kerja_id) c'), 'a.id', '=', 'c.id')
                ->orderBy('b.nama', 'asc')
                ->get();


        return view('presensi.presensi-pegawai.index', compact('title','pegawai','hirarkiUnitKerja'));
    }

    public function datatablepresensi(Request $request)
    {


        if (!empty($request->date_awal) && !empty($request->date_akhir) ) {

            $data = DB::table('pegawai as p')
            ->select('o.id', 'o.tanggal_presensi', 'o.jam_masuk', 'o.jam_pulang', 'o.kekurangan_jam', 'o.kelebihan_jam',
                    'o.nominal_potongan', 'o.status_kehadiran', 'o.keterangan',
                    'p.id as pegawai_id', 'p.nip', 'p.nama_depan', 'p.nama_belakang', 'p.tempat_lahir', 'p.tanggal_lahir', 'p.email_kantor','p.no_enroll',
                    'x.id as jabatan_id', 'x.jabatan_tukin_id', 'q.jabatan_unit_kerja_id', 's.nama as nama_golongan',
                    's.nama_pangkat', 'z.jenis_jabatan', 'z.nama_jabatan', 'y.nama_unit_kerja',
                    'x.hirarki_unit_kerja_id', 'y.nama_jenis_unit_kerja', 'y.nama_parent_unit_kerja')
            ->join('pegawai_riwayat_jabatan as q', function ($join) {
                $join->on('p.id', '=', 'q.pegawai_id')
                    ->where('q.is_now', '=', 1);
            })
            ->join('pegawai_riwayat_golongan as r', function ($join) {
                $join->on('p.id', '=', 'r.pegawai_id')
                    ->where('r.is_active', '=', 1);
            })
            ->join('presensi as o', 'p.no_enroll', '=', 'o.no_enroll')
            ->join('golongan as s', 'r.golongan_id', '=', 's.id')
            ->join('jabatan_unit_kerja as x', 'q.jabatan_unit_kerja_id', '=', 'x.id')
            ->join(DB::raw('(SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, b.nama as nama_unit_kerja, c.nama_jenis_unit_kerja, c.nama_parent_unit_kerja
                            FROM hirarki_unit_kerja as a
                            INNER JOIN unit_kerja as b ON a.child_unit_kerja_id = b.id
                            INNER JOIN (SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, c.nama as nama_jenis_unit_kerja, b.nama as nama_parent_unit_kerja
                                        FROM hirarki_unit_kerja as a
                                        INNER JOIN unit_kerja as b ON a.parent_unit_kerja_id = b.id
                                        INNER JOIN jenis_unit_kerja as c ON c.id = b.jenis_unit_kerja_id) as c ON a.id = c.id) as y'), function ($join) {
                $join->on('x.hirarki_unit_kerja_id', '=', 'y.id');
            })
            ->join(DB::raw('(SELECT a.id, a.jabatan_id, a.jenis_jabatan_id, b.nama as jenis_jabatan, c.grade, c.nominal,
                            CASE
                                WHEN a.jenis_jabatan_id = 1 THEN d.nama
                                WHEN a.jenis_jabatan_id = 2 THEN e.nama
                                WHEN a.jenis_jabatan_id = 4 THEN f.nama
                                ELSE NULL
                            END AS nama_jabatan
                            FROM jabatan_tukin as a
                            INNER JOIN jenis_jabatan as b ON a.jenis_jabatan_id = b.id
                            INNER JOIN tukin as c ON a.tukin_id = c.id
                            LEFT JOIN jabatan_struktural as d ON d.id = a.jabatan_id
                            LEFT JOIN jabatan_fungsional as e ON e.id = a.jabatan_id
                            LEFT JOIN jabatan_fungsional_umum as f ON f.id = a.jabatan_id) as z'), 'x.jabatan_tukin_id', '=', 'z.id')
            ->whereBetween('o.tanggal_presensi', [$request->date_awal, $request->date_akhir])
            ->where('q.is_plt', '=', 0);

            if($request->hirarki_unit_kerja_id!=''){
                $data->where('x.hirarki_unit_kerja_id','=',$request->hirarki_unit_kerja_id);
            }

            if($request->pegawai_id!=''){
                $data->where('p.id','=',$request->pegawai_id);
            }

            $data->orderBy('o.tanggal_presensi', 'asc')
            ;


            return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('nama', function ($row) {
                return $row->nama_depan . ' ' . $row->nama_belakang;
           })
            ->editColumn('nominal_potongan', function ($row) {
                // Format the data as needed here
                $nom =  (float)$row->nominal_potongan;
                return "Rp " . number_format($nom, 0, ',', '.');
            })
            ->editColumn('tanggal_presensi', function ($row) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                // Format the date as needed, assuming tanggal_presensi is a Carbon instance
                $formattedDate = Carbon::parse($row->tanggal_presensi)->isoFormat('dddd, D MMMM Y');

                return $formattedDate;
            })
            ->filterColumn('tanggal_presensi', function ($query, $keyword) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $query->whereRaw("DATE_FORMAT(tanggal_presensi, '%W, %d %M %Y') like ?", ["%$keyword%"]);

            })

            ->make(true);
        }

    }

    public function getAnggotaTim(Request $request){

        $result = DB::table('pegawai as p')
                    ->select('p.id as pegawai_id', 'p.nip', 'p.nama_depan', 'p.nama_belakang', 'y.nama_unit_kerja', 'x.hirarki_unit_kerja_id', 'y.nama_jenis_unit_kerja', 'y.nama_parent_unit_kerja')
                    ->join('pegawai_riwayat_jabatan as q', function ($join) {
                        $join->on('p.id', '=', 'q.pegawai_id')
                            ->where('q.is_now', '=', 1);
                    })
                    ->join('jabatan_unit_kerja as x', 'q.jabatan_unit_kerja_id', '=', 'x.id')
                    ->join(DB::raw('(SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, b.nama as nama_unit_kerja, c.nama_jenis_unit_kerja, c.nama_parent_unit_kerja FROM hirarki_unit_kerja as a
                                    INNER JOIN unit_kerja as b ON a.child_unit_kerja_id = b.id
                                    INNER JOIN (SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, c.nama as nama_jenis_unit_kerja, b.nama as nama_parent_unit_kerja FROM hirarki_unit_kerja as a
                                        INNER JOIN unit_kerja as b ON a.parent_unit_kerja_id = b.id
                                        INNER JOIN jenis_unit_kerja as c ON c.id = b.jenis_unit_kerja_id) as c ON a.id = c.id) as y'), 'x.hirarki_unit_kerja_id', '=', 'y.id')
                    ->where('x.hirarki_unit_kerja_id', '=', $request->hirarki_unit_kerja_id)
                    ->where('p.id', '<>',  $request->pimpinan_id)
                    ->get();

                    return response()->json($result);
    }

    public function getdataPresensiPegawai(Request $request)
    {
        PresensiHelper::get_DataPresensi();
        return redirect()->route('presensi-pegawai.index')
            ->with('success', 'Syncronize Data Presensi berhasil');
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
