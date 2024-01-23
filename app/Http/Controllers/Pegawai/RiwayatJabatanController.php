<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\JabatanTukin;
use App\Models\JabatanUnitKerja;
use App\Models\Pegawai;
use App\Models\PegawaiRiwayatJabatan;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\TxTipeJabatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Tukin;

class RiwayatJabatanController extends Controller
{
    public function index()
    {
        $cek_pegawai = Pegawai::where('id', auth()->user()->pegawai_id)->first();
        $this->authorize('personal', $cek_pegawai);
        $title = 'Riwayat Jabatan';
        return view('riwayat_jabatan.index', compact('title'));
    }
    public function datatable(Request $request)
    {

        $riwayat_jabatan = PegawaiRiwayatJabatan::select('pegawai_riwayat_jabatan.id', 'ttj.tipe_jabatan', 'uk.nama AS nama_unit_kerja', 'tanggal_sk', 'tanggal_pelantikan', 'tmt_jabatan', 'is_plt', 'is_now')
            ->join('tx_tipe_jabatan AS ttj', 'ttj.id', '=', 'pegawai_riwayat_jabatan.tx_tipe_jabatan_id')
            ->join('jabatan_unit_kerja AS juk', 'juk.id', '=', 'pegawai_riwayat_jabatan.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja AS huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->join('unit_kerja AS uk', 'uk.id', '=', 'huk.child_unit_kerja_id');
        if ($request->pegawai_id != null) {
            $riwayat_jabatan = $riwayat_jabatan->where('pegawai_id', $request->pegawai_id);
        }
        return DataTables::of($riwayat_jabatan)
            ->addColumn('no', '')
            ->addColumn('aksi', 'riwayat_jabatan.aksi')
            ->editColumn('tanggal_sk', function ($riwayat_jabatan) {
                return $riwayat_jabatan->tanggal_sk ? with(new Carbon($riwayat_jabatan->tanggal_sk))->format('d/m/Y') : '';
            })
            ->filterColumn('tanggal_sk', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_sk, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->editColumn('tanggal_pelantikan', function ($riwayat_jabatan) {
                return $riwayat_jabatan->tanggal_pelantikan ? with(new Carbon($riwayat_jabatan->tanggal_pelantikan))->format('d/m/Y') : '';
            })
            ->filterColumn('tanggal_pelantikan', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_pelantikan, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->editColumn('tmt_jabatan', function ($riwayat_jabatan) {
                return $riwayat_jabatan->tmt_jabatan ? with(new Carbon($riwayat_jabatan->tmt_jabatan))->format('d/m/Y') : '';
            })
            ->filterColumn('tmt_jabatan', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tmt_jabatan, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $title = 'Tambah Riwayat Jabatan';

        $pegawai = Pegawai::where('id', auth()->user()->pegawai_id)->first();

        $tx_tipe_jabatan = TxTipeJabatan::all();

        $grade_tukin = Tukin::all();

        $unit_kerja = DB::table('unit_kerja as a')
            ->join('hirarki_unit_kerja as b', 'a.id', '=', 'b.child_unit_kerja_id')
            ->select('a.nama', 'b.id')
            ->get();

        return view('riwayat_jabatan.create', compact('title', 'pegawai', 'tx_tipe_jabatan', 'grade_tukin', 'unit_kerja'));
    }

    public function store(Request $request, $id)
    {
        // dd($request->all());

        $validate = Validator::make(
            $request->all(),
            [
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

    public function show($id)
    {
        $jabatan = PegawaiRiwayatJabatan::where('id', $id)->first();
        if ($jabatan == null) {
            abort(404);
        }
        $this->authorize('personal', $jabatan->pegawai);

        $title = 'Detail Jabatan';
        return view('riwayat_jabatan.show', compact('title', 'jabatan'));
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
