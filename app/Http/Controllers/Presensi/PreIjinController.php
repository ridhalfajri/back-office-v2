<?php

namespace App\Http\Controllers\Presensi;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PreIjin;
use App\Helpers\PegawaiHelper;
use App\Helpers\PresensiHelper;
use App\Models\Pegawai;
use App\Models\Presensi;
use Carbon\Carbon;
use SplFileInfo;
use Yajra\DataTables\Facades\DataTables;

class PreIjinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Data Ijin Kehadiran';
        $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);

        $totalKuota = PegawaiHelper::getKuotaIjin();

        return view('presensi.pre-ijin.index', compact('title', 'pegawai', 'totalKuota'));
    }

    public function datatable(PreIjin $preIjin)
    {

        $data = PreIjin::select('pre_ijin.id', 'pre_ijin.tanggal', 'pre_ijin.jenis_ijin', 'pre_ijin.status', 'pre_ijin.keterangan')
            ->join('pegawai', 'pre_ijin.no_enroll', '=', 'pegawai.no_enroll')
            ->where('pegawai.id', '=', auth()->user()->pegawai->id)
            ->orderBy('pre_ijin.id');

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('jenis_ijin', function ($row) {
                // Modify the value of the 'jenis_ijin' column based on your logic
                if ($row->jenis_ijin == 1) {
                    return 'Datang Terlambat';
                } elseif ($row->jenis_ijin == 2) {
                    return 'Pulang Awal';
                } else {
                    return 'Datang Terlambat dan Pulang Awal';
                }
            })
            // ->filterColumn('jenis_ijin', function ($query, $keyword) {
            //     // Add a custom filter for the 'jenis_ijin' column
            //     $query->where('jenis_ijin', $keyword);
            // })
            ->editColumn('tanggal', function ($row) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $formattedDate = Carbon::parse($row->tanggal)->isoFormat('dddd, D MMMM Y');
                return $formattedDate;
            })
            ->filterColumn('tanggal', function ($query, $keyword) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $query->whereRaw("DATE_FORMAT(tanggal, '%W, %d %M %Y') like ?", ["%$keyword%"]);
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
            // ->filterColumn('status', function ($query, $keyword) {
            //     // Add a custom filter for the 'jenis_ijin' column
            //     $query->where('status', $keyword);
            // })
            ->addColumn('aksi', function ($row) {

                if ($row->status == 1) {
                    $editButton = '<a href="' . route('pre-ijin.edit',  $row->id) . '" class="btn btn-sm btn-icon btn-warning on-default edit" title="Ubah"><i class="fa fa-pencil text-white"></i></a>';
                    $deleteButton = '<button class="btn btn-sm btn-icon btn-danger on-default delete" data-id="' . $row->id . '" title="Hapus"><i class="fa fa-trash"></i></button>';
                    return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' . $editButton . ' ' . $deleteButton . '</div>';
                } else {

                    return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' .  ' - ' . '</div>';
                }
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function datatablepersetujuan(Request $request)
    {
        // $this->authorize('preIjinPimpinanAuth');

        $data = DB::table('pegawai as p')
            ->select('s.id', 's.jenis_ijin', 's.tanggal', 's.status', 's.keterangan', 'p.id as pegawai_id', 'p.nip', 'p.nama_depan', 'p.nama_belakang', 'p.tempat_lahir', 'p.tanggal_lahir', 'p.email_kantor', 'p.no_enroll', 'x.id as jabatan_id', 'x.jabatan_tukin_id', 'q.jabatan_unit_kerja_id', 'z.jenis_jabatan', 'z.nama_jabatan', 'z.grade', 'z.nominal', 'y.nama_unit_kerja', 'x.hirarki_unit_kerja_id', 'y.nama_jenis_unit_kerja', 'y.nama_parent_unit_kerja', 'q.is_plt')
            ->join('pegawai_riwayat_jabatan as q', function ($join) {
                $join->on('p.id', '=', 'q.pegawai_id')->where('q.is_now', '=', 1);
            })
            ->join('pre_ijin as s', 's.no_enroll', '=', 'p.no_enroll')
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
            ->where('p.id', '<>', $request->pimpinan_Id)
            ->whereBetween('s.tanggal', [$request->date_awal, $request->date_akhir]);

        if (!empty($request->pegawai_id)) {
            $data->where('p.id', '=', $request->pegawai_id);
        }

        if (!empty($request->status_pengajuan)) {
            $data->where('s.status', '=', $request->status_pengajuan);
        }

        $data->orderBy('s.tanggal', 'asc');


        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('jenis_ijin', function ($row) {
                // Modify the value of the 'jenis_ijin' column based on your logic
                if ($row->jenis_ijin == 1) {
                    return 'Datang Terlambat';
                } elseif ($row->jenis_ijin == 2) {
                    return 'Pulang Awal';
                } else {
                    return 'Datang Terlambat dan Pulang Awal';
                }
            })
            ->filterColumn('jenis_ijin', function ($query, $keyword) {
                $query->where(function ($query) use ($keyword) {
                    $query->where('jenis_ijin', '=', $keyword === 'Datang Terlambat' ? 1 : 0)
                        ->orWhere('jenis_ijin', '=', $keyword === 'Pulang Awal' ? 2 : 0)
                        ->orWhere('jenis_ijin', '=', $keyword === 'Datang Terlambat dan Pulang Awal' ? 3 : 0);
                });
            })
            ->rawColumns(['jenis_ijin']) // Add 'jenis' to rawColumns to prevent HTML escaping
            ->editColumn('tanggal', function ($row) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                // Format the date as needed, assuming tanggal_presensi is a Carbon instance
                $formattedDate = Carbon::parse($row->tanggal)->isoFormat('dddd, D MMMM Y');

                return $formattedDate;
            })
            ->filterColumn('tanggal', function ($query, $keyword) {
                // Set the locale to Indonesian
                DB::statement('SET lc_time_names = "id_ID"');
                $query->whereRaw("DATE_FORMAT(tanggal, '%W, %d %M %Y') like ?", ["%$keyword%"]);
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
            // ->filterColumn('status', function ($query, $keyword) {
            //     // Add a custom filter for the 'jenis_ijin' column
            //     $query->where('status', $keyword);
            // })
            ->addColumn('aksi', function ($row) {

                if ($row->status == 1) {
                    $editButton =  '<button class="btn btn-sm btn-icon btn-success on-default setujui" data-id="' . $row->id . '" title="Setujui"><i class="fa fa-check"></i></button>';
                    $deleteButton = '<button class="btn btn-sm btn-icon btn-warning on-default tolak" data-id="' . $row->id . '" title="Tolak"><i class="fa fa-times"></i></button>';

                    return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' . $editButton . ' ' . $deleteButton . '</div>';
                }
                // elseif ($row->status == 3){
                //         $cancelButton = '<button class="btn btn-sm btn-icon btn-danger on-default batal" data-id="' . $row->id . '" title="Batal"><i class="fa fa-undo"></i></button>';
                //         return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' .  $cancelButton . '</div>';
                // }
                else {

                    // $dt = $row->tanggal;

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
        $title = 'Pengisian Form Pengajuan Ijin';

        $totalKuota = PegawaiHelper::getKuotaIjin();
        if ($totalKuota < 3) {
            $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);
            return view('presensi.pre-ijin.create', compact('title', 'pegawai'));
        } else {
            return redirect()->back()->with('warning', 'Mohon maaf kuota ijin anda sudah habis!');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function persetujuan()
    {
        // $this->authorize('preIjinPimpinanAuth');

        if (
            auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 1 ||
            auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 2 || auth()->user()->pegawai->jabatan_sekarang->tx_tipe_jabatan_id == 5
        ) {
            $title = 'Persetujuan Ijin';
            $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);

            return view('presensi.pre-ijin.persetujuan', compact('title', 'pegawai'));
        } else {
            return redirect()->back()->with('warning', 'Mohon maaf anda tidak mempunyai akses!');
        }
    }

    public function konfirmasi(Request $request)
    {

        $preIjin = PreIjin::find($request->id);

        $this->authorize('preIjinKonfirmasiPimpinanAuth', $preIjin);

        $blnValue = false;
        $msg = "";
        try {
            $preIjin->status = $request->status;
            try {
                // Start a database transaction
                DB::beginTransaction();

                $preIjin->save();
                $update = PegawaiHelper::UpdatePresensiForIjin($preIjin);
                DB::commit();
                $msg = "Status ijin kehadiran berhasil diubah";
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
                'error' => $blnValue,
                'message' => $msg, // You can also include an error message
            ],
        ];

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);

        try {
            $this->validate($request, [
                'jenis_ijin' => 'required',
                'tanggal' => 'required',
                'keterangan' => 'required',
            ]);

            $input = [];
            $input['no_enroll'] = $pegawai[0]->no_enroll;
            $input['jenis_ijin'] = $request->jenis_ijin;
            $input['tanggal'] = $request->tanggal;
            $input['keterangan'] = $request->keterangan;
            $input['status'] = 1;
            PreIjin::create($input);

            return redirect()->route('pre-ijin.index')
                ->with('success', 'Data ijin kehadiran berhasil disimpan');
        } catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            return redirect()->route('pre-ijin.index')
                ->with('error', 'Simpan data ijin kehadiran gagal, Err: ' . $msg);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function show(PreIjin $preIjin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function edit(PreIjin $preIjin)
    {

        $this->authorize('preijinauth', $preIjin);


        if ($preIjin->status == 1 && $preIjin->no_enroll == auth()->user()->pegawai->no_enroll) {
            $title = 'Ubah Pengajuan Ijin';
            $pegawai = PegawaiHelper::getPegawaiData(auth()->user()->pegawai->id);

            return view('presensi.pre-ijin.edit', compact('title', 'pegawai', 'preIjin'));
        } else {
            return redirect()->back()->with('warning', 'Terjadi kesalahan!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PreIjin $preIjin)
    {
        try {

            $this->authorize('preIjinAuth', $preIjin);

            $this->validate($request, [
                'jenis_ijin' => 'required',
                'tanggal' => 'required',
                'keterangan' => 'required',
            ]);

            $preIjin->no_enroll = $preIjin->no_enroll;
            $preIjin->jenis_ijin = $request->jenis_ijin;
            $preIjin->tanggal = $request->tanggal;
            $preIjin->keterangan = $request->keterangan;
            $preIjin->save();

            return redirect()->route('pre-ijin.index')
                ->with('success', 'Data ijin kehadiran berhasil diupdate');
        } catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            return redirect()->route('pre-ijin.index')
                ->with('error', 'Ubah data ijin kehadiran gagal, Err: ' . $msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $preIjin = PreIjin::find($id);
        $blnValue = false;
        $msg = "";
        $this->authorize('preIjinAuth', $preIjin);


        try {
            $preIjin->delete();
            $msg = "Data berhasil dihapus";
        } catch (QueryException $e) {
            $blnValue = true;
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            $msg = $e->getMessage();
        }


        $data = [
            'status' => [
                'error' => $blnValue,
                'message' => $msg, // You can also include an error message
            ],
        ];

        return response()->json($data, 200);
    }
}
