<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\PegawaiAlamat;
use App\Models\Propinsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Pegawai";
        return view('pegawai.index', compact('title'));
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
                'no_kartu_pegawai',
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
    public function datatable()
    {
        $pegawai = Pegawai::select('id', 'nip', 'nama_depan', 'nama_belakang', 'no_telp', 'email_kantor')->orderBy('created_at', 'DESC')->get();
        return DataTables::of($pegawai)
            ->addColumn('no', '')
            ->addColumn('aksi', 'pegawai.aksi')
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
