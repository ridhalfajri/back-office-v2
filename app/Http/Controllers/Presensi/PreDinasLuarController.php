<?php

namespace App\Http\Controllers\Presensi;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PreDinasLuar;
use App\Models\Pegawai;
use App\Helpers\PegawaiHelper;
use Barryvdh\Debugbar\Facades\Debugbar as FacadesDebugbar;
use Carbon\Carbon;
use SplFileInfo;
use Yajra\DataTables\Facades\DataTables;
use Spatie\MediaLibrary;
class PreDinasLuarController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $title = 'List Data Dinas Luar';
        $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);

        return view('presensi.pre-dinas-luar.index', compact('title','pegawai'));
    }

    public function datatable()
    {

        $data = PreDinasLuar::select('pre_dinas_luar.id', 'pre_dinas_luar.no_enroll', 'pre_dinas_luar.tanggal_dinas_awal','pre_dinas_luar.tanggal_dinas_akhir', 'pre_dinas_luar.nama_kegiatan', 'pre_dinas_luar.lokasi','pre_dinas_luar.status_approve', 'pre_dinas_luar.is_active')
                ->join('pegawai', 'pre_dinas_luar.no_enroll', '=', 'pegawai.no_enroll')
                ->where('pegawai.id','=',auth()->user()->pegawai->id)
                ->orderBy('pre_dinas_luar.tanggal_dinas_awal', 'asc')
                ;

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('status', function ($row) {
                // Modify the value of the 'jenis_ijin' column based on your logic
                if ($row->status_approve == 1) {
                    return 'Pengajuan';
                } elseif ($row->status_approve == 2) {
                    return 'Disetujui';
                } else {
                    return 'Ditolak';
                }
            })
            ->editColumn('tanggal_dinas_awal', function ($row) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $formattedDate = Carbon::parse($row->tanggal_dinas_awal)->isoFormat('D MMMM Y');
                return $formattedDate;
            })
            ->filterColumn('tanggal_dinas_awal', function ($query, $keyword) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $query->whereRaw("DATE_FORMAT(tanggal_dinas_awal, '%d %M %Y') like ?", ["%$keyword%"]);

            })

            ->editColumn('tanggal_dinas_akhir', function ($row) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $formattedDate = Carbon::parse($row->tanggal_dinas_akhir)->isoFormat('D MMMM Y');
                return $formattedDate;
            })
            ->filterColumn('tanggal_dinas_akhir', function ($query, $keyword) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $query->whereRaw("DATE_FORMAT(tanggal_dinas_akhir, '%d %M %Y') like ?", ["%$keyword%"]);

            })
            ->addColumn('file_st', function ($row) {
                $mediaItem = $row->getMedia('media_st_dinas_luar')->first();
                // Check if the media item exists
                if ($mediaItem) {
                    // Get the URL of the media item
                    $mediaUrl = $mediaItem->getUrl();
                    return $mediaUrl;
                }
            })
            ->addColumn('file_ref', function ($row) {

                $mediaItem = $row->getMedia('media_ref_dinas_luar')->first();
                // Check if the media item exists
                if ($mediaItem) {
                    // Get the URL of the media item
                    $mediaUrl = $mediaItem->getUrl();
                    return $mediaUrl;
                }
            })
            ->addColumn('aksi', function ($row) {

                if ($row->status_approve == 1){
                    $editButton = '<a href="'.route('pre-dinas-luar.edit',  $row->id).'" class="btn btn-sm btn-icon btn-warning on-default edit" title="Ubah"><i class="fa fa-pencil text-white"></i></a>';
                    $deleteButton = '<button class="btn btn-sm btn-icon btn-danger on-default delete" data-id="' . $row->id . '" title="Hapus"><i class="fa fa-trash"></i></button>';
                    return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' . $editButton . ' ' . $deleteButton . '</div>';
                }else{

                    return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' .  ' - ' . '</div>';
                }

            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function datatablepersetujuan(Request $request)
    {

        $data = DB::table('pegawai as p')
                    ->select('s.id','s.tanggal_dinas_awal','s.tanggal_dinas_akhir','s.nama_kegiatan','s.lokasi','s.status_approve','p.id as pegawai_id','p.nip','p.nama_depan','p.nama_belakang','p.tempat_lahir','p.tanggal_lahir','p.email_kantor','p.no_enroll','x.id as jabatan_id','x.jabatan_tukin_id','q.jabatan_unit_kerja_id','z.jenis_jabatan','z.nama_jabatan','z.grade','z.nominal','y.nama_unit_kerja','x.hirarki_unit_kerja_id','y.nama_jenis_unit_kerja','y.nama_parent_unit_kerja','q.is_plt')
                    ->join('pegawai_riwayat_jabatan as q', function ($join) {
                        $join->on('p.id', '=', 'q.pegawai_id')->where('q.is_now', '=', 1);
                    })
                    ->join('pre_dinas_luar as s', 's.no_enroll', '=', 'p.no_enroll')
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
                    ->where('x.hirarki_unit_kerja_id', '=', $request->hirarki_unit_kerja_id)
                    ->where('p.id','<>', $request->pimpinan_Id)
                    ->whereBetween('s.tanggal_dinas_awal', [$request->date_awal, $request->date_akhir]);

                if(!empty($request->pegawai_id)){
                    $data->where('p.id','=',$request->pegawai_id);
                }

                if(!empty($request->status_pengajuan)){
                    $data->where('s.status_approve','=',$request->status_pengajuan);
                }

                $data->orderBy('s.tanggal_dinas_awal', 'asc');



        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('status_approve', function ($row) {
                if ($row->status_approve == 1) {
                    return 'Pengajuan';
                } elseif ($row->status_approve == 2) {
                    return 'Disetujui';
                } else {
                    return 'Ditolak';
                }
            })
            ->addColumn('nama', function ($row) {
                 return $row->nama_depan . ' ' . $row->nama_belakang;
            })
            ->editColumn('tanggal_dinas_awal', function ($row) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                // Format the date as needed, assuming tanggal_presensi is a Carbon instance
                $formattedDate = Carbon::parse($row->tanggal_dinas_awal)->isoFormat('dddd, D MMMM Y');

                return $formattedDate;
            })
            ->filterColumn('tanggal_dinas_awal', function ($query, $keyword) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $query->whereRaw("DATE_FORMAT(tanggal_dinas_awal, '%W, %d %M %Y') like ?", ["%$keyword%"]);

            })
            ->editColumn('tanggal_dinas_akhir', function ($row) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                // Format the date as needed, assuming tanggal_presensi is a Carbon instance
                $formattedDate = Carbon::parse($row->tanggal_dinas_akhir)->isoFormat('dddd, D MMMM Y');

                return $formattedDate;
            })
            ->filterColumn('tanggal_dinas_akhir', function ($query, $keyword) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $query->whereRaw("DATE_FORMAT(tanggal_dinas_akhir, '%W, %d %M %Y') like ?", ["%$keyword%"]);

            })
            ->addColumn('aksi', function ($row) {

                if ($row->status_approve == 1){
                    $editButton =  '<button class="btn btn-sm btn-icon btn-success on-default setujui" data-id="' . $row->id . '" title="Setujui"><i class="fa fa-check"></i></button>';
                    $deleteButton = '<button class="btn btn-sm btn-icon btn-warning on-default tolak" data-id="' . $row->id . '" title="Tolak"><i class="fa fa-times"></i></button>';

                    return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' . $editButton . ' ' . $deleteButton . '</div>';
                }else{

                    $dt = $row->tanggal_dinas_awal;

                    $currentDate = date('Y-m-d');

                    // Compare the two dates
                    if (strtotime($currentDate) < strtotime($dt)) {
                        $cancelButton = '<button class="btn btn-sm btn-icon btn-danger on-default batal" data-id="' . $row->id . '" title="Batal"><i class="fa fa-undo"></i></button>';
                        return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' .  $cancelButton . '</div>';
                    } else {
                        return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' .  ' - ' . '</div>';
                    }

                }


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
        $title = 'Pengajuan Dinas Luar';
        $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);

        return view('presensi.pre-dinas-luar.create', compact('title','pegawai'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $pegawai = Pegawai::find(auth()->user()->pegawai->id);

        try {
            $this->validate($request, [
				'nama_kegiatan' => 'required',
				'lokasi' => 'required',
                'tanggal_dinas' => 'required',
				'media_st_dinas_luar' => 'required',
            ]);

            $dateRange = explode(' - ',  $request->tanggal_dinas);
            $tanggalAwal = explode('-', $dateRange[0]);
            $tanggalAkhir = explode('-', $dateRange[1]);

            $preDL =  new PreDinasLuar();
			$preDL->no_enroll = $pegawai->no_enroll;
			$preDL->tanggal_dinas_awal = $tanggalAwal[2] . '-' . $tanggalAwal[1] . '-' . $tanggalAwal[0];
            $preDL->tanggal_dinas_akhir = $tanggalAkhir[2] . '-' . $tanggalAkhir[1] . '-' . $tanggalAkhir[0];

			$preDL->nama_kegiatan = $request->nama_kegiatan;
			$preDL->lokasi = $request->lokasi;
            $preDL->status_approve = 1;
			$preDL->is_active = 'Y';
            $preDL->save();

            if ($request->media_st_dinas_luar) {
                $preDL->addMediaFromRequest('media_st_dinas_luar')->toMediaCollection('media_st_dinas_luar');
            }

            if ($request->media_ref_dinas_luar) {
                $preDL->addMediaFromRequest('media_ref_dinas_luar')->toMediaCollection('media_ref_dinas_luar');
            }

            return redirect()->route('pre-dinas-luar.index')
            ->with('success', 'Data dinas luar berhasil disimpan');
        }catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            return redirect()->route('pre-dinas-luar.index')
            ->with('error', 'Simpan data dinas luar gagal, Err: ' . $msg);
        }

    }

    public function persetujuan()
    {

        $title = 'Persetujuan Pengajuan Dinas Luar';
        $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);

        return view('presensi.pre-dinas-luar.persetujuan', compact('title','pegawai'));
    }

    public function konfirmasi(Request $request)
    {

        $preDinasLuar = PreDinasLuar::find($request->id);

        $blnValue = false;
        $msg = "";
        try {
            $preDinasLuar->status_approve = $request->status;
            $preDinasLuar->save();

            $msg = "Status pengajuan dinas luar berhasil diubah";
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

    /**
    * Display the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function show(PreDinasLuar $preDinasLuar)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function edit(PreDinasLuar $preDinasLuar)
    {
        $title = 'Ubah Data Pengajuan Dinas Luar';
        $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);
        return view('presensi.pre-dinas-luar.edit', compact('title','preDinasLuar','pegawai'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,PreDinasLuar $preDinasLuar)
    {
        try {

            $this->validate($request, [
				'nama_kegiatan' => 'required',
				'lokasi' => 'required',
                'tanggal_dinas' => 'required',
                'media_st_dinas_luar' => 'required',
            ]);

            $dateRange = explode(' - ',  $request->tanggal_dinas);
            $tanggalAwal = explode('-', $dateRange[0]);
            $tanggalAkhir = explode('-', $dateRange[1]);

			$preDinasLuar->nama_kegiatan = $request->nama_kegiatan;
			$preDinasLuar->lokasi = $request->lokasi;
            $preDinasLuar->tanggal_dinas_awal = $tanggalAwal[2] . '-' . $tanggalAwal[1] . '-' . $tanggalAwal[0];
            $preDinasLuar->tanggal_dinas_akhir = $tanggalAkhir[2] . '-' . $tanggalAkhir[1] . '-' . $tanggalAkhir[0];
			$preDinasLuar->status_approve = 1;
			$preDinasLuar->is_active = 'Y';
            $preDinasLuar->save();

            // Retrieve the media item associated with the model and the collection name
            $stFile = $preDinasLuar->getMedia('media_st_dinas_luar')->first();
            if ($stFile) {
                $stFile->delete();
            }

            $refFile = $preDinasLuar->getMedia('media_ref_dinas_luar')->first();
            if ($refFile) {
                $refFile->delete();
            }

            if ($request->media_st_dinas_luar) {
                $preDinasLuar->addMediaFromRequest('media_st_dinas_luar')->toMediaCollection('media_st_dinas_luar');
            }

            if ($request->media_ref_dinas_luar) {
                $preDinasLuar->addMediaFromRequest('media_ref_dinas_luar')->toMediaCollection('media_ref_dinas_luar');
            }

            return redirect()->route('pre-dinas-luar.index')
            ->with('success', 'Data dinas luar berhasil diupdate');
        } catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            return redirect()->route('pre-dinas-luar.index')
            ->with('error', 'Ubah data dinas luar gagal, Err: ' . $msg);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function destroy(PreDinasLuar $preDinasLuar)
    {
        $blnValue = false;
        $msg = "";
        try {
            $preDinasLuar->delete();
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
