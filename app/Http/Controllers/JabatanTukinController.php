<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;
use App\Models\JabatanTukin;
use App\Models\JabatanStruktural;
use App\Models\JabatanFungsional;
use App\Models\JabatanFungsionalUmum;
use App\Models\Tukin;
use App\Models\JenisJabatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use stdClass;

class JabatanTukinController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $title = 'List Data Tunjangan Kinerja Berdasarkan Jabatan';

        try {
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
                    ->get();

            return view('jabatan-tukin.index', compact('title','jabatanTukin'));

        }catch (QueryException $e){
            Log::error('terjadi kesalahan pada koneksi database  ketika load index data jabatan tukin :' . $e->getMessage());
                return redirect()->back()->withErrors([
                    'query' => 'Load data gagal'
                ]);
        }
    }

    public function getJabatan(Request $request)
    {

        $nama = $request->input('nama');
        $jenisJabatanId = $request->jenis_jabatan_id;


        if ($jenisJabatanId === "1") {
            $query = JabatanStruktural::select(['id','nama']);
        } else if ($jenisJabatanId == "2") {
            $query = JabatanFungsional::select(['id','nama']);
        } else
        // if ($jenisJabatanId == "4")
         {
            $query = JabatanFungsionalUmum::select(['id','nama']);
        }

        if ($nama) {
            $query->where('nama', 'like', "%$nama%");
        }


        $jabatans = $query->orderBy('nama', 'asc')->paginate(20); // Adjust pagination as needed

        // dd( response()->json([
        //     'items' => $jabatans->items(),
        //     'more' => $jabatans->hasMorePages(),
        // ]));

        return response()->json([
            'items' => $jabatans->items(),
            'more' => $jabatans->hasMorePages(),
        ]);


        // var_dump($jenisJabatanId);
        // dd($jabatan);

        // echo "<option value='' selected disabled>-- Pilih Jabatan --</option>";
        // foreach ($jabatan as $item) {
        //     if ($request->jabatan_id != null && $request->jabatan_id == $item->id) {
        //         echo "<option value='" . $item->id . "' selected>" . $item->nama . "</option>";
        //     } else {
        //         echo "<option value='" . $item->id . "'>" . $item->nama . "</option>";
        //     }
        // }

        // Format hasil untuk Select2.js
        // $formattedResults = [];
        // foreach ($jabatan->items() as $item) {
        //     $formattedResults[] = [
        //         'id' => $item->id,
        //         'text' => $item->nama
        //     ];
        // }

        // return response()->json([
        //     'items' => $formattedResults,
        //     'more' => $jabatan->hasMorePages(),
        // ]);

    }

    public function getjabatans(Request $request)
    {
        try {
            $jenisJabatanId = $request->jenis_jabatan_id;

            if ($jenisJabatanId === "1") {
                $jabatan = JabatanStruktural::orderBy('nama', 'asc')->get();
            } else if ($jenisJabatanId == "2") {
                $jabatan = JabatanFungsional::orderBy('nama', 'asc')->get();
            } else if ($jenisJabatanId == "4") {
                $jabatan = JabatanFungsionalUmum::orderBy('nama', 'asc')->get();
            }

            echo "<option value='' selected disabled>-- Pilih Jabatan --</option>";
            foreach ($jabatan as $item) {
                if ($request->jabatan_id != null && $request->jabatan_id == $item->id) {
                    echo "<option value='" . $item->id . "' selected>" . $item->nama . "</option>";
                } else {
                    echo "<option value='" . $item->id . "'>" . $item->nama . "</option>";
                }
            }
        } catch (QueryException $e) {
            abort(500);
        }
    }

    public function getNominal(Request $request)
    {
        $nominal = Tukin::select(DB::raw('FORMAT(nominal, 0) as formatted_nominal'))
            ->where('id', $request->id)
            ->first();

        return response()->json($nominal);
    }

    public function datatable(JabatanTukin $jabatanTukin)
    {
        $data = DB::table('jabatan_tukin as a')
                    ->select('a.id', 'a.jabatan_id', 'a.jenis_jabatan_id', 'b.nama as jenis_jabatan', 'c.grade', 'c.nominal as nominal')
                    ->addSelect(DB::raw('
                        CASE
                            WHEN a.jenis_jabatan_id = 1 THEN d.nama
                            WHEN a.jenis_jabatan_id = 2 THEN e.nama
                            WHEN a.jenis_jabatan_id = 4 THEN f.nama
                            ELSE NULL
                        END AS nama_jabatan

                    '))
                    ->addSelect(DB::raw('
                        CASE
                            WHEN a.jenis_jabatan_id = 1 THEN d.nominal_tunjangan
                            WHEN a.jenis_jabatan_id = 2 THEN e.nominal_tunjangan
                            WHEN a.jenis_jabatan_id = 4 THEN 0
                            ELSE NULL
                        END AS nominal_tunjangan

                    '))
                    ->join('jenis_jabatan as b', 'a.jenis_jabatan_id', '=', 'b.id')
                    ->join('tukin as c', 'a.tukin_id', '=', 'c.id')
                    ->leftJoin('jabatan_struktural as d', 'd.id', '=', 'a.jabatan_id')
                    ->leftJoin('jabatan_fungsional as e', 'e.id', '=', 'a.jabatan_id')
                    ->leftJoin('jabatan_fungsional_umum as f', 'f.id', '=', 'a.jabatan_id')
                    ->get();


        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('aksi', function ($row) {

                $editButton = '<a href="'.route('jabatan-tukin.edit',  $row->id).'" class="btn btn-sm btn-icon btn-warning on-default edit" title="Ubah"><i class="fa fa-pencil text-white"></i></a>';
                $deleteButton = '<button class="btn btn-sm btn-icon btn-danger on-default delete" data-id="' . $row->id . '" title="Hapus"><i class="fa fa-trash"></i></button>';

                return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' . $editButton . ' ' . $deleteButton . '</div>';
            })
            ->editColumn('nominal', function ($row) {
                // Format the data as needed here
                $nom =  (float)$row->nominal;
                return "Rp " . number_format($nom, 0, ',', '.');
            })
            // ->filterColumn('nominal', function ($query, $keyword) {
            //     $query->whereRaw("CONCAT('Rp. ', REPLACE(FORMAT(nominal, 0), ',', '.')) like ?", ["%$keyword%"])
            //           ->orWhereRaw("nominal LIKE ?", ["%$keyword%"]);
            // })
            ->editColumn('nominal_tunjangan', function ($row) {
                // Format the data as needed here
                $nom =  (float)$row->nominal_tunjangan;
                return "Rp " . number_format($nom, 0, ',', '.');
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
        $title = 'Input Data Tunjangan Kinerja Jabatan';
        $jenisJabatan = JenisJabatan::where('nama', 'not like', '%Jabatan Rangkap%')->get();
        $tukin = Tukin::select('id', 'grade', DB::raw("REPLACE(FORMAT(nominal, 0), ',', '.') as nominal"))->where('is_active','=','Y')->get();

        return view('jabatan-tukin.create', compact('title','jenisJabatan','tukin'));
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
                'jabatan_id' => 'required|unique:jabatan_tukin,jabatan_id,NULL,id,jenis_jabatan_id,'.$request->jenis_jabatan_id.',tukin_id,'.$request->tukin_id,
                'jenis_jabatan_id' => 'required',
                'tukin_id' => 'required',
                'nominal_tunjangan_jabatan' => 'required_unless:jenis_jabatan_id,4',
            ], [
                'jabatan_id.required' => 'Jabatan harus diisi.',
                'jabatan_id.unique' => 'Jenis Jabatan, Nama Jabatan dan Tunjangan Kinerja Jabatan sudah ada.',
                'jenis_jabatan_id.required' => 'Jenis Jabatan harus diisi.',
                'tukin_id.required' => 'Tunjangan Kinerja harus diisi.',
                'nominal_tunjangan_jabatan.required_unless' => 'Nominal Tunjangan Jabatan  harus diisi.',
            ]);

            $input = [];
			$input['jabatan_id'] = $request->jabatan_id;
			$input['jenis_jabatan_id'] = $request->jenis_jabatan_id;
			$input['tukin_id'] = $request->tukin_id;
            JabatanTukin::create($input);

            if ( $request->jenis_jabatan_id === "1") {
                $jabatan = JabatanStruktural::where('id', $request->jabatan_id)->first();
                $jabatan->nominal_tunjangan =  preg_replace('/[^\d]/', '', $request->nominal_tunjangan_jabatan);
                $jabatan->save();

            } else if ( $request->jenis_jabatan_id === "2") {
                $jabatan = JabatanFungsional::where('id', $request->jabatan_id)->first();
                $jabatan->nominal_tunjangan =  preg_replace('/[^\d]/', '', $request->nominal_tunjangan_jabatan);
                $jabatan->save();
            }

            return redirect()->route('jabatan-tukin.index')
            ->with('success', 'Data Jabatan Tukin berhasil disimpan');
        }catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            return redirect()->route('jabatan-tukin.index')
            ->with('error', 'Simpan data Jabatan Tukin gagal, Err: ' . $msg);
        }

    }

    /**
    * Display the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function show(JabatanTukin $jabatanTukin)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function edit(JabatanTukin $jabatanTukin)
    {

        $title = 'Ubah Data Tunjangan Kinerja Jabatan';
        $jenisJabatan = JenisJabatan::where('nama', 'not like', '%Jabatan Rangkap%')->get();
        $tukin = Tukin::select('id', 'grade', DB::raw("REPLACE(FORMAT(nominal, 0), ',', '.') as nominal"))->where('is_active','=','Y')->get();


        if ( $jabatanTukin->jenis_jabatan_id == 1) {
            $jabatan = JabatanStruktural::select(['id','nama'])->where('id', $jabatanTukin->jabatan_id)->first();
            $jabatanData = JabatanStruktural::select(['id','nama'])->where('id','<', 10)->orWhere('id', $jabatanTukin->jabatan_id)->get();

        } else if ( $jabatanTukin->jenis_jabatan_id == 2) {
            $jabatan = JabatanFungsional::select(['id','nama'])->where('id', $jabatanTukin->jabatan_id)->first();
            $jabatanData = JabatanFungsional::select(['id','nama'])->where('id','<', 10)->orWhere('id', $jabatanTukin->jabatan_id)->get();
        }else{
            $jabatanData = JabatanFungsionalUmum::select(['id','nama'])->where('id', $jabatanTukin->jabatan_id)->first();
             // Using stdClass
            $jabatan = new stdClass();
            $jabatan->nama = $jabatanData->nama;
            $jabatan->nominal_tunjangan = 0;
            $jabatanData = JabatanFungsionalUmum::select(['id', 'nama', DB::raw('0 as nominal_tunjangan')])->where('id', '<', 10)->orWhere('id', $jabatanTukin->jabatan_id)->get();
        }

        return view('jabatan-tukin.edit', compact('title','jabatanTukin','jenisJabatan','tukin','jabatan','jabatanData'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,JabatanTukin $jabatanTukin)
    {
        try {

            $this->validate($request, [
                'jabatan_id' => 'required|unique:jabatan_tukin,jabatan_id,' .$jabatanTukin->id. ',id,jenis_jabatan_id,' .$request->jenis_jabatan_id. ',tukin_id,' .$request->tukin_id,
                'jenis_jabatan_id' => 'required',
                'tukin_id' => 'required',
                'nominal_tunjangan_jabatan' => 'required_unless:jenis_jabatan_id,4',
            ], [
                'jabatan_id.required' => 'Jabatan harus diisi.',
                'jabatan_id.unique' => 'Jenis Jabatan, Nama Jabatan dan Tunjangan Kinerja Jabatan sudah ada.',
                'jenis_jabatan_id.required' => 'Jenis jabatan harus diisi.',
                'tukin_id.required' => 'Tunjangan Kinerja harus diisi.',
                'nominal_tunjangan_jabatan.required_unless' => 'Nominal Tunjangan Jabatan  harus diisi.',
            ]);

			$jabatanTukin->jabatan_id = $request->jabatan_id;
			$jabatanTukin->jenis_jabatan_id = $request->jenis_jabatan_id;
			$jabatanTukin->tukin_id = $request->tukin_id;
            $jabatanTukin->save();

            if ( $request->jenis_jabatan_id === "1") {
                $jabatan = JabatanStruktural::where('id', $request->jabatan_id)->first();
                $jabatan->nominal_tunjangan =  preg_replace('/[^\d]/', '', $request->nominal_tunjangan_jabatan);
                $jabatan->save();

            } else if ( $request->jenis_jabatan_id === "2") {
                $jabatan = JabatanFungsional::where('id', $request->jabatan_id)->first();
                $jabatan->nominal_tunjangan =  preg_replace('/[^\d]/', '', $request->nominal_tunjangan_jabatan);
                $jabatan->save();
            }

            return redirect()->route('jabatan-tukin.index')
            ->with('success', 'Data Tunjangan Kinerja Jabatan berhasil diupdate');
        } catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            return redirect()->route('jabatan-tukin.index')
            ->with('error', 'Ubah data Tunjangan Kinerja Jabatan gagal, Err: ' . $msg);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function destroy(JabatanTukin $jabatanTukin)
    {
        $blnValue = false;
        $msg = "";
        try {
            $jabatanTukin->delete();
            $msg = "Data berhasil dihapus";
        } catch (QueryException $e) {
            $blnValue = true;
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
