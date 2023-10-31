<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pegawai.index');
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
        } catch (\Throwable $th) {
            return redirect()->route('pegawai.index')->with('error', 'Gagal memuat halaman');
        }
        $pegawai->tanggal_lahir = date('d-F-Y', strtotime($pegawai->tanggal_lahir));
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
            $pegawai->tanggal_berhenti = date('d-F-Y', strtotime($pegawai->tanggal_lahir));
        }
        if ($pegawai->tanggal_wafat != null) {
            $pegawai->tanggal_wafat = date('d-F-Y', strtotime($pegawai->tanggal_wafat));
        }
        return view('pegawai.show', compact('pegawai', 'title'));
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
