<?php

namespace App\Http\Controllers\Presensi;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;
// use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PreTubel;
use Carbon\Carbon;
use SplFileInfo;
use Yajra\DataTables\Facades\DataTables;

class PreTubelController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $title = 'List Data Pegawai Yang Menjalankan Tugas Belajar';

        return view('presensi.pre-tubel.index', compact('title'));
    }

    public function datatable(PreTubel $preTubel)
    {
        // ->select('s.id','s.tanggal_awal','s.tanggal_akhir','s.is_active','p.id as pegawai_id','p.nip','p.nama_depan','p.nama_belakang','p.tempat_lahir','p.tanggal_lahir','p.email_kantor','p.no_enroll','x.id as jabatan_id','x.jabatan_tukin_id','q.jabatan_unit_kerja_id','z.jenis_jabatan','z.nama_jabatan','z.grade','z.nominal','y.nama_unit_kerja','x.hirarki_unit_kerja_id','y.nama_jenis_unit_kerja','y.nama_parent_unit_kerja','q.is_plt')
        $data = DB::table('pegawai as p')
                ->select('s.id','s.tanggal_awal','s.tanggal_akhir','s.is_active','p.id as pegawai_id','p.nip','p.nama_depan','p.nama_belakang','p.tempat_lahir','p.tanggal_lahir','p.email_kantor','z.jenis_jabatan','z.nama_jabatan','y.nama_unit_kerja','y.nama_jenis_unit_kerja','y.nama_parent_unit_kerja')
                ->join('pegawai_riwayat_jabatan as q', function ($join) {
                    $join->on('p.id', '=', 'q.pegawai_id')->where('q.is_now', '=', 1);
                })
                ->join('pre_tubel as s', 's.no_enroll', '=', 'p.no_enroll')
                ->join('jabatan_unit_kerja as x', 'q.jabatan_unit_kerja_id', '=', 'x.id')
                ->join(DB::raw('(SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, b.nama as nama_unit_kerja, c.nama_jenis_unit_kerja, c.nama_parent_unit_kerja FROM hirarki_unit_kerja as a
                    INNER JOIN unit_kerja as b ON a.child_unit_kerja_id = b.id
                    INNER JOIN (SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, c.nama as nama_jenis_unit_kerja, b.nama as nama_parent_unit_kerja FROM hirarki_unit_kerja as a
                        INNER JOIN unit_kerja as b ON a.parent_unit_kerja_id = b.id
                        INNER JOIN jenis_unit_kerja as c ON c.id = b.jenis_unit_kerja_id) as c ON a.id = c.id) as y'), 'x.hirarki_unit_kerja_id', '=', 'y.id')
                ->join(DB::raw('(SELECT a.id, a.jabatan_id, a.jenis_jabatan_id, b.nama as jenis_jabatan, c.grade, c.nominal,
                        CASE WHEN a.jenis_jabatan_id = 1 THEN d.nama WHEN a.jenis_jabatan_id = 2 THEN e.nama WHEN a.jenis_jabatan_id = 4 THEN f.nama ELSE NULL END AS nama_jabatan
                        FROM jabatan_tukin as a
                        INNER JOIN jenis_jabatan as b ON a.jenis_jabatan_id = b.id
                        INNER JOIN tukin as c ON a.tukin_id = c.id
                        LEFT JOIN jabatan_struktural as d ON d.id = a.jabatan_id
                        LEFT JOIN jabatan_fungsional as e ON e.id = a.jabatan_id
                        LEFT JOIN jabatan_fungsional_umum as f ON f.id = a.jabatan_id) as z'), 'x.jabatan_tukin_id', '=', 'z.id')
                ->orderBy('s.id', 'desc')
                ;

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('nama', function ($row) {
                return $row->nama_depan . ' ' . $row->nama_belakang;
           })
           ->filterColumn('nama', function ($query, $keyword) {
                // Custom filter logic for 'nama' column
                $query->where(function ($query) use ($keyword) {
                    $query->where('nama_depan', 'LIKE', "%$keyword%")
                        ->orWhere('nama_belakang', 'LIKE', "%$keyword%");
                });
            })

           ->editColumn('tanggal_awal', function ($row) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $formattedDate = Carbon::parse($row->tanggal_awal)->isoFormat('dddd, D MMMM Y');

                return $formattedDate;
            })
            ->filterColumn('s.tanggal_awal', function ($query, $keyword) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $query->whereRaw("DATE_FORMAT(tanggal_awal, '%W, %d %M %Y') like ?", ["%$keyword%"]);
            })

            ->editColumn('tanggal_akhir', function ($row) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $formattedDate = Carbon::parse($row->tanggal_akhir)->isoFormat('dddd, D MMMM Y');

                return $formattedDate;
            })
            ->filterColumn('s.tanggal_akhir', function ($query, $keyword) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $query->whereRaw("DATE_FORMAT(tanggal_akhir, '%W, %d %M %Y') like ?", ["%$keyword%"]);
            })

            ->addColumn('aksi', function ($row) {

                $editButton = '<a href="'.route('pre-tubel.edit',  $row->id).'" class="btn btn-sm btn-icon btn-warning on-default edit" title="Ubah"><i class="fa fa-pencil text-white"></i></a>';
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
        $title = 'Input Data Tugas Belajar';
        $pegawai = Pegawai::all();
        return view('presensi.pre-tubel.create', compact('title','pegawai'));
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
				'no_enroll' => 'required',
				'tanggal_tubel' => 'required',
				'is_active' => 'required',
            ]);

            $input = [];

            $dateRange = explode(' - ',  $request->tanggal_tubel);

			$input['no_enroll'] = $request->no_enroll;
            $tanggalAwal = explode('-', $dateRange[0]);
			$input['tanggal_awal'] = $tanggalAwal[2] . '-' . $tanggalAwal[1] . '-' . $tanggalAwal[0];

            $tanggalAkhir = explode('-', $dateRange[1]);
			$input['tanggal_akhir'] = $tanggalAkhir[2] . '-' . $tanggalAkhir[1] . '-' . $tanggalAkhir[0];
            $input['is_active'] = $request->is_active;

            PreTubel::create($input);

            return redirect()->route('pre-tubel.index')
            ->with('success', 'Data Pre Tubel berhasil disimpan');

        }catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            $msg = $e->getMessage();
            return redirect()->route('pre-tubel.index')
            ->with('error', 'Simpan data Pre Tubel gagal, Err: ' . $msg);
        }

    }

    /**
    * Display the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function show(PreTubel $preTubel)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function edit(PreTubel $preTubel)
    {
        $title = 'Ubah Data Tugas Belajar';

        return view('presensi.pre-tubel.edit', compact('title','preTubel'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,PreTubel $preTubel)
    {
        try {
            $this->validate($request, [
				'no_enroll' => 'required',
				'tanggal_awal' => 'required',
				'tanggal_akhir' => 'required',
            ]);

			$preTubel->no_enroll = $request->no_enroll;
			$preTubel->tanggal_awal = $request->tanggal_awal;
			$preTubel->tanggal_akhir = $request->tanggal_akhir;
            $preTubel->save();

            return redirect()->route('pre-tubel.index')
            ->with('success', 'Data Pre Tubel berhasil diupdate');
        } catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            $msg = $e->getMessage();
            return redirect()->route('pre-tubel.index')
            ->with('error', 'Ubah data Pre Tubel gagal, Err: ' . $msg);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function destroy(PreTubel $preTubel)
    {
        $blnValue = false;
        $msg = "";
        try {
            $preTubel->delete();
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
