<?php

namespace App\Http\Controllers\Presensi;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
// use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PreTakTercatat;
use App\Models\Pegawai;
use App\Helpers\PegawaiHelper;
use Carbon\Carbon;
use SplFileInfo;
use Yajra\DataTables\Facades\DataTables;

class PreTakTercatatController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $title = 'List Data Presensi Tidak Tercatat';
        $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);
        $totalKuota = PegawaiHelper::getKuotaIjin();
        return view('presensi.pre-tak-tercatat.index', compact('title','pegawai','totalKuota'));
    }

    public function datatable()
    {
        $data = PreTakTercatat::select('pre_tak_tercatat.id', 'pre_tak_tercatat.no_enroll', 'pre_tak_tercatat.tanggal_pengajuan', 'pre_tak_tercatat.tanggal_approved', 'pre_tak_tercatat.jenis', 'pre_tak_tercatat.jam_perubahan', 'pre_tak_tercatat.status')
                ->join('pegawai', 'pre_tak_tercatat.no_enroll', '=', 'pegawai.no_enroll')
                ->where('pegawai.id','=',auth()->user()->pegawai->id)
                ->orderByDesc('pre_tak_tercatat.id')
                ;

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('jenis', function ($row) {
                // Modify the value of the 'jenis_ijin' column based on your logic
                if ($row->jenis == 1) {
                    return 'Jam Masuk';
                } else {
                    return 'Jam Pulang';
                }
            })
            ->addColumn('status', function ($row) {
                // Modify the value of the 'jenis_ijin' column based on your logic
                if ($row->status == 1) {
                    return 'Pengajuan';
                } elseif ($row->status == 2) {
                    return 'Disetujui';
                } else {
                    return 'Ditolak';
                }
            })
            ->editColumn('tanggal_pengajuan', function ($row) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $formattedDate = Carbon::parse($row->tanggal_pengajuan)->isoFormat('dddd, D MMMM Y');
                return $formattedDate;
            })
            ->filterColumn('tanggal_pengajuan', function ($query, $keyword) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $query->whereRaw("DATE_FORMAT(tanggal_pengajuan, '%W, %d %M %Y') like ?", ["%$keyword%"]);
            })
            ->addColumn('aksi', function ($row) {

                if ($row->status == 1){
                    $editButton = '<a href="'.route('pre-tak-tercatat.edit',  $row->id).'" class="btn btn-sm btn-icon btn-warning on-default edit" title="Ubah"><i class="fa fa-pencil text-white"></i></a>';
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
                    ->select('s.id','s.jenis','s.tanggal_pengajuan','s.jam_perubahan','s.status','p.id as pegawai_id','p.nip','p.nama_depan','p.nama_belakang','p.tempat_lahir','p.tanggal_lahir','p.email_kantor','p.no_enroll','x.id as jabatan_id','x.jabatan_tukin_id','q.jabatan_unit_kerja_id','z.jenis_jabatan','z.nama_jabatan','z.grade','z.nominal','y.nama_unit_kerja','x.hirarki_unit_kerja_id','y.nama_jenis_unit_kerja','y.nama_parent_unit_kerja','q.is_plt')
                    ->join('pegawai_riwayat_jabatan as q', function ($join) {
                        $join->on('p.id', '=', 'q.pegawai_id')->where('q.is_now', '=', 1);
                    })
                    ->join('pre_tak_tercatat as s', 's.no_enroll', '=', 'p.no_enroll')
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
                    ->whereBetween('s.tanggal_pengajuan', [$request->date_awal, $request->date_akhir]);

                    if(!empty($request->pegawai_id)){
                        $data->where('p.id','=',$request->pegawai_id);
                    }

                    if(!empty($request->status_pengajuan)){
                        $data->where('s.status','=',$request->status_pengajuan);
                    }

                    $data->orderBy('s.tanggal_pengajuan', 'asc');



            return Datatables::of($data)
                ->addColumn('no', '')
                ->addColumn('jenis', function ($row) {
                    if ($row->jenis == 1) {
                        return 'Jam Datang';
                    } else {
                        return 'Jam Pulang';
                    }
                })
                ->filterColumn('jenis', function ($query, $keyword) {
                    $query->where(function ($query) use ($keyword) {
                        $query->where('jenis', '=', $keyword === 'Jam Datang' ? 1 : 0)
                              ->orWhere('jenis', '=', $keyword === 'Jam Pulang' ? 0 : 1);
                    });
                })
                ->rawColumns(['jenis']) // Add 'jenis' to rawColumns to prevent HTML escaping

                ->editColumn('tanggal_pengajuan', function ($row) {
                    // Set the locale to Indonesian
                    DB::statement('SET lc_time_names = "id_ID"');
                    // Format the date as needed, assuming tanggal_presensi is a Carbon instance
                    $formattedDate = Carbon::parse($row->tanggal_pengajuan)->isoFormat('dddd, D MMMM Y');

                    return $formattedDate;
                })
                ->filterColumn('tanggal_pengajuan', function ($query, $keyword) {
                    // Set the locale to Indonesian
                    DB::statement('SET lc_time_names = "id_ID"');
                    $query->whereRaw("DATE_FORMAT(tanggal_pengajuan, '%W, %d %M %Y') like ?", ["%$keyword%"]);

                })

                ->addColumn('status', function ($row) {
                    // Modify the value of the 'jenis_ijin' column based on your logic
                    if ($row->status == 1) {
                        return 'Pengajuan';
                    } elseif ($row->status == 2) {
                        return 'Disetujui';
                    } else {
                        return 'Ditolak';
                    }
                })
                ->addColumn('nama', function ($row) {
                    return $row->nama_depan . ' ' . $row->nama_belakang;
                })

                ->addColumn('aksi', function ($row) {

                    if ($row->status == 1){
                        $editButton =  '<button class="btn btn-sm btn-icon btn-success on-default setujui" data-id="' . $row->id . '" title="Setujui"><i class="fa fa-check"></i></button>';
                        $deleteButton = '<button class="btn btn-sm btn-icon btn-warning on-default tolak" data-id="' . $row->id . '" title="Tolak"><i class="fa fa-times"></i></button>';

                        return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' . $editButton . ' ' . $deleteButton . '</div>';
                    }
                    // elseif ($row->status == 3){
                    //         $cancelButton = '<button class="btn btn-sm btn-icon btn-danger on-default batal" data-id="' . $row->id . '" title="Batal"><i class="fa fa-undo"></i></button>';
                    //         return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' .  $cancelButton . '</div>';
                    // }
                    else{

                        // $dt = $row->tanggal_pengajuan;

                        // $currentDate = date('Y-m-d');

                        // // Compare the two dates
                        // if (strtotime($currentDate) < strtotime($dt)) {
                        //     $cancelButton = '<button class="btn btn-sm btn-icon btn-danger on-default batal" data-id="' . $row->id . '" title="Batal"><i class="fa fa-undo"></i></button>';
                        //     return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' .  $cancelButton . '</div>';
                        // } else {
                            return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' .  ' - ' . '</div>';
                        // }
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
        $totalKuota = PegawaiHelper::getKuotaIjin();
        if ($totalKuota<3){
            $title = 'Pengajuan Presensi Tidak Tercatat';
            $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);
            return view('presensi.pre-tak-tercatat.create', compact('title','pegawai'));
        }else{
            return redirect()->back()->with('warning', 'Mohon maaf kuota ijin anda sudah habis!');
        }



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
				'tanggal_pengajuan' => 'required',
				'jenis' => 'required',
				'jam_perubahan' => 'required',
            ]);

            $input = [];
			$input['no_enroll'] = $pegawai->no_enroll;
			$input['tanggal_pengajuan'] = $request->tanggal_pengajuan;
			$input['jenis'] = $request->jenis;
			$input['jam_perubahan'] = $request->jam_perubahan;
			$input['status'] = 1;
            $preDL = PreTakTercatat::create($input);


            if ($request->media_presensi_logbook) {
                $preDL->addMediaFromRequest('media_st_dinas_luar')->toMediaCollection('media_st_dinas_luar');
            }

            if ($request->media_presensi_logbook) {
                $preDL->addMediaFromRequest('media_data_presensi')->toMediaCollection('media_data_presensi');
            }

            return redirect()->route('pre-tak-tercatat.index')
            ->with('success', 'Data presensi tidak tercatat berhasil disimpan');
        }catch (QueryException $e) {
            $msg = $e->getMessage();
            return redirect()->route('pre-tak-tercatat.index')
            ->with('error', 'Simpan data presensi tidak tercatat gagal, Err: ' . $msg);
        }

    }

    public function persetujuan()
    {

        if (auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 1 ||
        auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2 || auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5){

            $title = 'Persetujuan Presensi Tidak Tercatat';
            $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);

            return view('presensi.pre-tak-tercatat.persetujuan', compact('title','pegawai'));
        }
        else{
            return redirect()->back()->with('warning', 'Mohon maaf anda tidak mempunyai akses!');
        }

    }



    public function konfirmasi(Request $request)
    {

        $preTakTercatat = PreTakTercatat::find($request->id);

        $blnValue = false;
        $msg = "";
        try {
            $preTakTercatat->atasan_approval_id = $request->atasan_id;
            $preTakTercatat->tanggal_approved =date('Y-m-d');;
            $preTakTercatat->status = $request->status;
            try {
                // Start a database transaction
                DB::beginTransaction();

                $update = PegawaiHelper::UpdatePresensiTidakTercatat($preTakTercatat);
                if ($update){
                    $preTakTercatat->save();
                    DB::commit();
                    $msg = "Status ijin kehadiran berhasil diubah";
                }else
                {
                    $msg = "Proses Persetujuan dibatalkan karena Pegawai tidak melakukan salah satu presensi kehadiran yang dipersyaratkan";
                }

            } catch (\Exception $e) {
                // Handle any exceptions that may occur during the update
                DB::rollback();
                $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
                Log::error($msg);
                $msg = $e->getMessage();
            }


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
    public function show(PreTakTercatat $preTakTercatat)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function edit(PreTakTercatat $preTakTercatat)
    {
        $title = 'Ubah Pengajuan Presensi Tidak Tercatat';

        return view('presensi.pre-tak-tercatat.edit', compact('title','preTakTercatat'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,PreTakTercatat $preTakTercatat)
    {
        try {
            $this->validate($request, [
				'no_enroll' => 'required',
				'tanggal_pengajuan' => 'required',
				'tanggal_approved' => 'required',
				'jenis' => 'required',
				'jam_perubahan' => 'required',
				'atasan_approval_id' => 'required',
				'status' => 'required',
            ]);

			$preTakTercatat->no_enroll = $request->no_enroll;
			$preTakTercatat->tanggal_pengajuan = $request->tanggal_pengajuan;
			$preTakTercatat->tanggal_approved = $request->tanggal_approved;
			$preTakTercatat->jenis = $request->jenis;
			$preTakTercatat->jam_perubahan = $request->jam_perubahan;
			$preTakTercatat->atasan_approval_id = $request->atasan_approval_id;
			$preTakTercatat->status = $request->status;
            $preTakTercatat->save();

            return redirect()->route('pre-tak-tercatat.index')
            ->with('success', 'Data Presensi Tidak Tercatat berhasil diupdate');
        } catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            $msg = $e->getMessage();
            return redirect()->route('pre-tak-tercatat.index')
            ->with('error', 'Ubah data Presensi Tidak Tercatat gagal, Err: ' . $msg);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function destroy(PreTakTercatat $preTakTercatat)
    {
        $blnValue = false;
        $msg = "";
        try {
            $preTakTercatat->delete();
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
