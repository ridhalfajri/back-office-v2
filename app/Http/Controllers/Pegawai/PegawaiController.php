<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\HirarkiUnitKerja;
use App\Models\Pegawai;
use App\Models\PegawaiAlamat;
use App\Models\PegawaiRiwayatJabatan;
use App\Models\Propinsi;
use App\Models\UnitKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->first();
        $this->authorize('kabiro', $kabiro);
        $unit_kerja = UnitKerja::select('id', 'nama')->limit(22)->get();
        $title = "Pegawai";
        return view('pegawai.index', compact('title', 'unit_kerja'));
    }
    public function index_esselon()
    {
        // $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->first();
        // $this->authorize('kabiro', $kabiro);
        $atasan_langsung = PegawaiRiwayatJabatan::select('pegawai_id')->whereIn('tx_tipe_jabatan_id', [2, 5])->where('pegawai_id', auth()->user()->pegawai_id)->first();
        $this->authorize('atasan_langsung', $atasan_langsung);
        $riwayat_jabatan = PegawaiRiwayatJabatan::where('pegawai_id', auth()->user()->pegawai_id)->where('is_now', 1)->get();
        if ($riwayat_jabatan[0]->tx_tipe_jabatan_id == 1) {
            $unit_kerja = HirarkiUnitKerja::select('*')->join('unit_kerja', 'unit_kerja.id', '=', 'hirarki_unit_kerja.child_unit_kerja_id')->where('parent_unit_kerja_id', 2)->get();
        } else {
            foreach ($riwayat_jabatan as $key) {
                $unit_kerja[] = [
                    'id' => $key->jabatan_unit_kerja->hirarki_unit_kerja->child->id,
                    'nama' => $key->jabatan_unit_kerja->hirarki_unit_kerja->child->nama,

                ];
            }
        }
        $title = "Pegawai";
        return view('pegawai.index', compact('title', 'unit_kerja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('try');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cek_pegawai = Pegawai::where('id', $id)->first();
        $this->authorize('personal', $cek_pegawai);
        $title = 'Pegawai';
        try {
            $propinsi = Propinsi::select('id', 'nama')->get();
            $pegawai = Pegawai::select(
                'id',
                'nik',
                'nip',
                'nama_depan',
                'nama_belakang',
                'jenis_kelamin',
                'agama_id',
                'golongan_darah',
                'jenis_kawin_id',
                'tempat_lahir',
                'tanggal_lahir',
                'email_kantor',
                'email_pribadi',
                'no_telp',
                'jenis_pegawai_id',
                'status_pegawai_id',
                'status_dinas',
                'tanggal_berhenti',
                'tanggal_wafat',
                'no_bpjs',
                'no_taspen',
                'no_enroll',
                'npwp'
            )->where('id', $id)->first();
            $alamat_domisili = PegawaiAlamat::where('pegawai_id', $pegawai->id)->where('tipe_alamat', 'Domisili')->first();
            $alamat_asal = PegawaiAlamat::where('pegawai_id', $pegawai->id)->where('tipe_alamat', 'Asal')->first();
        } catch (\Throwable $th) {
            return abort(500);
        }
        if ($pegawai == null) {
            return redirect()->route('pegawai.index')->with('error', 'Data pegawai tidak ditemukan');
        }
        $pegawai->tanggal_lahir = Carbon::parse($pegawai->tanggal_lahir)->translatedFormat('d F Y');
        switch ($pegawai->jenis_kelamin) {
            case "L":
                $pegawai->jenis_kelamin = 'Laki-Laki';
                break;
            case "P":
                $pegawai->jenis_kelamin = 'Perempuan';
                break;
            default:
                $pegawai->jenis_kelamin = '';
        }
        switch ($pegawai->status_dinas) {
            case 0:
                $pegawai->status_dinas = 'Tidak Aktif';
                break;
            case 1:
                $pegawai->status_dinas = 'Aktif';
                break;
            default:
                $pegawai->status_dinas = '';
        }
        if ($pegawai->tanggal_berhenti != null) {
            $pegawai->tanggal_berhenti = Carbon::parse($pegawai->tanggal_berhenti)->translatedFormat('d F Y');
        }
        if ($pegawai->tanggal_wafat != null) {
            $pegawai->tanggal_wafat = Carbon::parse($pegawai->tanggal_wafat)->translatedFormat('d F Y');
        }
        return view('pegawai.show', compact('pegawai', 'title', 'propinsi', 'alamat_domisili', 'alamat_asal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        dd($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Datatable for pegawai.
     */
    public function datatable(Request $request)
    {
        $pegawai = Pegawai::select('pegawai.id', 'nip', 'nama_depan', 'nama_belakang', DB::raw('CONCAT(nama_depan," " ,nama_belakang) AS nama_lengkap'), 'no_telp', 'email_kantor', 'uk.nama AS nama_unit_kerja')->orderBy('nama_unit_kerja', 'DESC')
            ->join('pegawai_riwayat_jabatan AS prj', 'prj.pegawai_id', '=', 'pegawai.id')
            ->join('jabatan_unit_kerja AS juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja AS huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->join('unit_kerja AS uk', 'uk.id', '=', 'huk.child_unit_kerja_id')
            ->where('prj.is_now', 1);

        if ($request->unit_kerja != null) {
            $pegawai->where('huk.child_unit_kerja_id', $request->unit_kerja);
        }
        return DataTables::of($pegawai)
            ->addColumn('no', '')
            ->addColumn('aksi', 'pegawai.aksi')
            ->filterColumn('nama_lengkap', function ($query, $keyword) {
                $query->whereRaw("CONCAT(nama_depan,' ',nama_belakang) like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
