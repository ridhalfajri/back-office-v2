<?php

namespace App\Http\Controllers;

use App\Models\JabatanTukin;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;
use App\Models\JabatanUnitKerja;
use App\Models\VhirarkiUnitKerja;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Query\Expression;
use App\Helpers\PresensiHelper;
use Illuminate\Support\Carbon;

class JabatanUnitKerjaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $title = 'Jabatan Unit Kerja';

        return view('jabatan-unit-kerja.index', compact('title'));
    }

    public function datatable(JabatanUnitKerja $jabatanUnitKerja)
    {
        $data = DB::table('jabatan_unit_kerja AS x')
                ->select('x.id', 'x.jabatan_tukin_id', 'z.jenis_jabatan', 'z.nama_jabatan','z.grade', 'z.nominal', 'y.nama_unit_kerja', 'x.hirarki_unit_kerja_id','y.nama_jenis_unit_kerja','y.nama_parent_unit_kerja')
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
                }, 'z', 'x.jabatan_tukin_id', '=', 'z.id');

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('aksi', function ($row) {

                $editButton = '<a href="'.route('jabatan-unit-kerja.edit',  $row->id).'" class="btn btn-sm btn-icon btn-warning on-default edit" title="Ubah"><i class="fa fa-pencil text-white"></i></a>';
                $deleteButton = '<button class="btn btn-sm btn-icon btn-danger on-default delete" data-id="' . $row->id . '" title="Hapus"><i class="fa fa-trash"></i></button>';

                return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' . $editButton . ' ' . $deleteButton . '</div>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $title = 'Input Jabatan Unit Kerja Baru';
        $jabatanTukin = DB::table('jabatan_tukin as a')
                ->select('a.id', 'a.jabatan_id', 'a.jenis_jabatan_id', 'b.nama as jenis_jabatan', 'c.grade', 'c.nominal')
                ->addSelect(DB::raw('
                    CASE
                        WHEN a.jenis_jabatan_id = 1 THEN d.nama
                        WHEN a.jenis_jabatan_id = 2 THEN e.nama
                        WHEN a.jenis_jabatan_id = 4 THEN f.nama
                        ELSE NULL
                    END AS nama_jabatan
                '))
                ->join('jenis_jabatan as b', 'a.jenis_jabatan_id', '=', 'b.id')
                ->join('tukin as c', 'a.tukin_id', '=', 'c.id')
                ->leftJoin('jabatan_struktural as d', 'd.id', '=', 'a.jabatan_id')
                ->leftJoin('jabatan_fungsional as e', 'e.id', '=', 'a.jabatan_id')
                ->leftJoin('jabatan_fungsional_umum as f', 'f.id', '=', 'a.jabatan_id')
                ->orderBy('nama_jabatan')
                ->get();

                $hirarkiUnitKerja = DB::table('db_backoffice.hirarki_unit_kerja as a')
                ->select('a.id', 'a.child_unit_kerja_id', 'a.parent_unit_kerja_id', 'b.nama as nama_unit_kerja', 'c.nama_jenis_unit_kerja', 'c.nama_parent_unit_kerja')
                ->join('unit_kerja as b', 'a.child_unit_kerja_id', '=', 'b.id')
                ->join(DB::raw('(SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, c.nama as nama_jenis_unit_kerja, b.nama as nama_parent_unit_kerja
                        FROM db_backoffice.hirarki_unit_kerja a
                        INNER JOIN unit_kerja b ON a.parent_unit_kerja_id = b.id
                        INNER JOIN jenis_unit_kerja c ON c.id = b.jenis_unit_kerja_id) c'), 'a.id', '=', 'c.id')
                ->orderBy('b.nama', 'asc')
                ->get();

            //Get Data Hierarki Unit Kerja
            // $hirarkiUnitKerja = VhirarkiUnitKerja::all();


        return view('jabatan-unit-kerja.create', compact('title','jabatanTukin','hirarkiUnitKerja'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        try {

            $this->validate($request, [
                'jabatan_tukin_id' => 'required|unique:jabatan_unit_kerja,jabatan_tukin_id,NULL,id,hirarki_unit_kerja_id,'.$request->hirarki_unit_kerja_id,
                'hirarki_unit_kerja_id' => 'required',
            ], [
                'jabatan_tukin_id.required' => 'Jabatan harus diisi.',
                'jabatan_tukin_id.unique' => 'Jenis Jabatan dan Hirarki Unit Kerja sudah ada.',
                'hirarki_unit_kerja_id.required' => 'Hirarki Unit Kerja harus diisi.',
            ]);


            $input = [];
			$input['hirarki_unit_kerja_id'] = $request->hirarki_unit_kerja_id;
			$input['jabatan_tukin_id'] = $request->jabatan_tukin_id;
            JabatanUnitKerja::create($input);

            return redirect()->route('jabatan-unit-kerja.index')
            ->with('success', 'Data Jabatan Unit Kerja berhasil disimpan');
        }catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            return redirect()->route('jabatan-unit-kerja.index')
            ->with('error', 'Simpan data Jabatan Unit Kerja gagal, Err: ' . $msg);
        }
    }

    /**
    * Display the specified resource.
    *
    *
    * @return \Illuminate\Http\Response
    */
    public function show(JabatanUnitKerja $jabatanUnitKerja)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    *
    * @return \Illuminate\Http\Response
    */
    public function edit(JabatanUnitKerja $jabatanUnitKerja)
    {
        $title = 'Ubah Jabatan Unit Kerja';

        $jabatanTukin = DB::table('jabatan_tukin as a')
        ->select('a.id', 'a.jabatan_id', 'a.jenis_jabatan_id', 'b.nama as jenis_jabatan', 'c.grade', 'c.nominal')
        ->addSelect(DB::raw('
            CASE
                WHEN a.jenis_jabatan_id = 1 THEN d.nama
                WHEN a.jenis_jabatan_id = 2 THEN e.nama
                WHEN a.jenis_jabatan_id = 4 THEN f.nama
                ELSE NULL
            END AS nama_jabatan
        '))
        ->join('jenis_jabatan as b', 'a.jenis_jabatan_id', '=', 'b.id')
        ->join('tukin as c', 'a.tukin_id', '=', 'c.id')
        ->leftJoin('jabatan_struktural as d', 'd.id', '=', 'a.jabatan_id')
        ->leftJoin('jabatan_fungsional as e', 'e.id', '=', 'a.jabatan_id')
        ->leftJoin('jabatan_fungsional_umum as f', 'f.id', '=', 'a.jabatan_id')
        ->orderBy('nama_jabatan')
        ->get();

        $hirarkiUnitKerja = DB::table('db_backoffice.hirarki_unit_kerja as a')
                ->select('a.id', 'a.child_unit_kerja_id', 'a.parent_unit_kerja_id', 'b.nama as nama_unit_kerja', 'c.nama_jenis_unit_kerja', 'c.nama_parent_unit_kerja')
                ->join('unit_kerja as b', 'a.child_unit_kerja_id', '=', 'b.id')
                ->join(DB::raw('(SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, c.nama as nama_jenis_unit_kerja, b.nama as nama_parent_unit_kerja
                        FROM db_backoffice.hirarki_unit_kerja a
                        INNER JOIN unit_kerja b ON a.parent_unit_kerja_id = b.id
                        INNER JOIN jenis_unit_kerja c ON c.id = b.jenis_unit_kerja_id) c'), 'a.id', '=', 'c.id')
                ->orderBy('b.nama', 'asc')
                ->get();


        return view('jabatan-unit-kerja.edit', compact('title','jabatanUnitKerja','jabatanTukin','hirarkiUnitKerja'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,JabatanUnitKerja $jabatanUnitKerja)
    {
        try {
            $this->validate($request, [
                'jabatan_tukin_id' => 'required|unique:jabatan_unit_kerja,jabatan_tukin_id,'.$request->jabatan_tukin_id.',id,hirarki_unit_kerja_id,'.$request->hirarki_unit_kerja_id,
				'hirarki_unit_kerja_id' => 'required',
            ]);

			$jabatanUnitKerja->hirarki_unit_kerja_id = $request->hirarki_unit_kerja_id;
			$jabatanUnitKerja->jabatan_tukin_id = $request->jabatan_tukin_id;
            $jabatanUnitKerja->save();

            return redirect()->route('jabatan-unit-kerja.index')
            ->with('success', 'Data Jabatan Unit Kerja berhasil diupdate');
        } catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            return redirect()->route('jabatan-unit-kerja.index')
            ->with('error', 'Ubah data Jabatan Unit Kerja gagal, Err: ' . $msg);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function destroy(JabatanUnitKerja $jabatanUnitKerja)
    {
        $blnValue = false;
        $msg = "";
        try {
            $jabatanUnitKerja->delete();
            $msg = "Data berhasil dihapus";
        } catch (QueryException $e) {
            $blnValue = true;
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            $msg = $e->getMessage();
        }

        $data = [
            'status' => [
                'error' => $blnValue ,
                'message' => $msg, // You can also include an error message
            ],
        ];

        return response()->json($data, 200);
    }
}
