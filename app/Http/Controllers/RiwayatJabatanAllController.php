<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\TxTipeJabatan;
use App\Models\Tukin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\JabatanTukin;
use App\Models\JabatanUnitKerja;
use App\Models\PegawaiRiwayatJabatan;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class RiwayatJabatanAllController extends Controller
{
    public function index()
    {
        $check = DB::table('users AS a')
            ->join('pegawai AS b', 'a.pegawai_id', '=', 'b.id')
            ->join('pegawai_riwayat_jabatan AS c', 'c.pegawai_id', 'b.id')
            ->select('c.tx_tipe_jabatan_id')
            ->where('a.id', Auth::user()->id)
            ->first();

        $title = 'Riwayat Jabatan';

        if ($check->tx_tipe_jabatan_id == 7) {
            return view('riwayat_jabatan.index', compact('title'));
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function datatable(Request $request)
    {
        $riwayat_jabatan_all = DB::table('pegawai AS p')
            ->select(
                'p.id',
                'p.nama_depan',
                'p.nama_belakang',
                'z.nama_jabatan',
                'y.nama_unit_kerja',
                DB::raw('CONCAT(p.nama_depan, " ", p.nama_belakang) AS nama_lengkap'),
            )
            ->join('pegawai_riwayat_jabatan AS q', 'p.id', '=', 'q.pegawai_id')
            ->join('jabatan_unit_kerja AS r', 'q.jabatan_unit_kerja_id', '=', 'r.id')
            ->join(DB::raw('(SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, b.nama as nama_unit_kerja, c.nama_jenis_unit_kerja, c.nama_parent_unit_kerja
                                FROM hirarki_unit_kerja as a
                                INNER JOIN unit_kerja as b ON a.child_unit_kerja_id = b.id
                                INNER JOIN (SELECT a.id, a.child_unit_kerja_id, a.parent_unit_kerja_id, c.nama as nama_jenis_unit_kerja, b.nama as nama_parent_unit_kerja
                                            FROM hirarki_unit_kerja as a
                                            INNER JOIN unit_kerja as b ON a.parent_unit_kerja_id = b.id
                                            INNER JOIN jenis_unit_kerja as c ON c.id = b.jenis_unit_kerja_id) as c ON a.id = c.id) as y'), function ($join) {
                $join->on('r.hirarki_unit_kerja_id', '=', 'y.id');
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
                                LEFT JOIN jabatan_fungsional_umum as f ON f.id = a.jabatan_id) as z'), 'r.jabatan_tukin_id', '=', 'z.id')
            ->where('q.is_now', 1);

        return DataTables::of($riwayat_jabatan_all)
            ->addColumn('no', '')
            ->addColumn('aksi', 'riwayat_jabatan.aksi')
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $title = 'Tambah Riwayat Jabatan';

        $tx_tipe_jabatan = TxTipeJabatan::all();

        $grade_tukin = Tukin::all();

        $unit_kerja = DB::table('unit_kerja as a')
            ->join('hirarki_unit_kerja as b', 'a.id', '=', 'b.child_unit_kerja_id')
            ->select('a.nama', 'b.id')
            ->get();

        return view('riwayat_jabatan.create', compact('title', 'tx_tipe_jabatan', 'grade_tukin', 'unit_kerja'));
    }

    public function store(Request $request, $id)
    {
        // dd($request->all());

        $validate = Validator::make(
            $request->all(),
            [
                'pegawai_id' => 'required',
                'no_sk' => 'required',
                'tanggal_sk' => 'required',
                'no_pelantikan' => 'required',
                'tanggal_pelantikan' => 'required',
                'tmt_jabatan' => 'required',
                'pejabat_penetap' => 'required',
                'hirarki_unit_kerja_id' => 'required',
                'tx_tipe_jabatan_id' => 'required',
                'tukin_id' => 'required',
                'jenis_jabatan_id' => 'required',
                'jabatan_id' => 'required',
                'media_sk_jabatan' => 'nullable|mimes:pdf|max:1024',
            ],
            [
                'pegawai_id.required' => 'Nama pegawai harus diisi',
                'no_sk.required' => 'Nomor SK harus diisi',
                'tanggal_sk.required' => 'Tanggal SK harus diisi',
                'no_pelantikan.required' => 'Nomor pelantikan harus diisi',
                'tanggal_pelantikan.required' => 'Tanggal pelantikan harus diisi',
                'tmt_jabatan.required' => 'TMT jabatan harus diisi',
                'pejabat_penetap.required' => 'Pejabat penetap harus diisi',
                'hirarki_unit_kerja_id.required' => 'Unit kerja harus diisi',
                'tx_tipe_jabatan_id.required' => 'Tipe pegawai harus diisi',
                'tukin_id.required' => 'Grade tukin harus diisi',
                'jenis_jabatan_id.required' => 'Tipe jabatan harus diisi',
                'jabatan_id.required' => 'Nama jabatan harus diisi',
                'media_sk_jabatan.mimes' => 'SK jabatan bertipe pdf',
                'media_sk_jabatan.max' => 'SK jabatan maksimal 1024 kb',
            ]
        );

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            //simpan JabatanTukin
            $jabatan_tukin = new JabatanTukin();
            $jabatan_tukin->jabatan_id = $request->jabatan_id;
            $jabatan_tukin->jenis_jabatan_id = $request->jenis_jabatan_id;
            $jabatan_tukin->tukin_id = $request->tukin_id;
            $jabatan_tukin->save();

            //simpan JabatanUnitKerja
            $jabatan_unit_kerja = new JabatanUnitKerja();
            $jabatan_unit_kerja->jabatan_tukin_id = $jabatan_tukin->id;
            $jabatan_unit_kerja->hirarki_unit_kerja_id = $request->hirarki_unit_kerja_id;
            $jabatan_unit_kerja->save();

            //simpan PegawaiRiwayatJabatan
            $pegawai_riwayat_jabatan = new PegawaiRiwayatJabatan();
            $pegawai_riwayat_jabatan->pegawai_id = $request->pegawai_id;
            $pegawai_riwayat_jabatan->jabatan_unit_kerja_id = $jabatan_unit_kerja->id;
            $pegawai_riwayat_jabatan->no_sk = $request->no_sk;
            $pegawai_riwayat_jabatan->no_pelantikan = $request->no_pelantikan;
            $pegawai_riwayat_jabatan->tanggal_sk = Carbon::parse($request->tanggal_sk)->translatedFormat('Y-m-d');
            $pegawai_riwayat_jabatan->tanggal_pelantikan = Carbon::parse($request->tanggal_pelantikan)->translatedFormat('Y-m-d');
            $pegawai_riwayat_jabatan->tmt_jabatan = Carbon::parse($request->tmt_jabatan)->translatedFormat('Y-m-d');
            $pegawai_riwayat_jabatan->pejabat_penetap = $request->pejabat_penetap;
            $pegawai_riwayat_jabatan->is_plt = $request->is_plt;
            $pegawai_riwayat_jabatan->is_now = 1;
            $pegawai_riwayat_jabatan->tx_tipe_jabatan_id = $request->tx_tipe_jabatan_id;
            try {
                DB::transaction(function () use ($pegawai_riwayat_jabatan, $request) {
                    $pegawai_riwayat_jabatan->save();
                    if ($request->file('media_sk_jabatan')) {
                        $pegawai_riwayat_jabatan->addMediaFromRequest('media_sk_jabatan')->toMediaCollection('media_sk_jabatan');
                    }
                });
                return response()->json(['success' => 'Riwayat Jabatan Berhasil Disimpan']);
            } catch (QueryException $e) {
                // dd($e);
                return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
            }
        }
    }

    public function get_nama_pegawai(Request $request)
    {
        $q = $request->input('q');
        $result = [];
        if (isset($q) && $q != '') {
            $data = DB::table('pegawai')
                ->select('id', DB::raw('CONCAT(nama_depan, " ", nama_belakang) AS nama_lengkap'))
                ->where('nama_depan', 'like', '%' . $q . '%')
                ->orWhere('nama_belakang', 'like', '%' . $q . '%')
                ->limit(10)
                ->get();

            foreach ($data as $key => $value) {
                $new1 = array('id' => $value->id, 'name' => $value->nama_lengkap);
                array_push($result, $new1);
            }

            print(json_encode($result));
        }
    }

    public function get_fungsional_umum(Request $request)
    {
        $q = $request->input('q');
        $result = [];
        if (isset($q) && $q != '') {
            $data = DB::table('jabatan_fungsional_umum')
                ->select('id', 'nama')
                ->where('nama', 'like', '%' . $q . '%')
                ->limit(10)
                ->get();

            foreach ($data as $key => $value) {
                $new1 = array('id' => $value->id, 'name' => $value->nama);
                array_push($result, $new1);
            }

            print(json_encode($result));
        }
    }

    public function get_fungsional_tertentu(Request $request)
    {
        $q = $request->input('q');
        $result = [];
        if (isset($q) && $q != '') {
            $data = DB::table('jabatan_fungsional')
                ->select('id', 'nama')
                ->where('nama', 'like', '%' . $q . '%')
                ->limit(10)
                ->get();

            foreach ($data as $key => $value) {
                $new1 = array('id' => $value->id, 'name' => $value->nama);
                array_push($result, $new1);
            }

            print(json_encode($result));
        }
    }

    public function get_eselon_dua(Request $request)
    {
        $q = $request->input('q');
        $result = [];
        if (isset($q) && $q != '') {
            $data = DB::table('jabatan_struktural')
                ->select('id', 'nama')
                ->where('nama', 'like', '%' . $q . '%')
                ->where('kode_struktural', 2)
                ->limit(10)
                ->get();

            foreach ($data as $key => $value) {
                $new1 = array('id' => $value->id, 'name' => $value->nama);
                array_push($result, $new1);
            }

            print(json_encode($result));
        }
    }

    public function get_eselon_satu(Request $request)
    {
        $q = $request->input('q');
        $result = [];
        if (isset($q) && $q != '') {
            $data = DB::table('jabatan_struktural')
                ->select('id', 'nama')
                ->where('nama', 'like', '%' . $q . '%')
                ->where('kode_struktural', 1)
                ->limit(10)
                ->get();

            foreach ($data as $key => $value) {
                $new1 = array('id' => $value->id, 'name' => $value->nama);
                array_push($result, $new1);
            }

            print(json_encode($result));
        }
    }
}
