<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\JenisKawin;
use App\Models\Pegawai;
use App\Models\PegawaiAnak;
use App\Models\PegawaiRiwayatJabatan;
use App\Models\TingkatPendidikan;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($pegawai_id)
    {
        $title = "Anak";
        $pegawai = Pegawai::select('id', 'nama_depan', 'nama_belakang')->where('id', $pegawai_id)->first();
        $pendidikan = TingkatPendidikan::select('id', 'nama')->get();
        $jenis_kawin = JenisKawin::select('id', 'nama')->get();
        return view('pegawai.keluarga.create-anak', compact('title', 'pegawai', 'pendidikan', 'jenis_kawin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'pegawai_id' => ['required', 'exists:pegawai,id'],
                'nama' => ['required', 'max:50'],
                'nik' => ['required', 'digits:16'],
                'anak_ke' => ['required', 'max:2'],
                'tempat_lahir' => ['required', 'max:50'],
                'tanggal_lahir' => ['required', 'date_format:d-m-Y'],
                'status_anak' => ['required', Rule::in(["Kandung", "Angkat"])],
                'status_tunjangan' => ['required', 'boolean', 'max:1'],
                'pendidikan_id' => ['required', 'exists:pendidikan,id'],
                'bidang_studi' => ['required', 'max:50'],
            ],
            [
                'pegawai_id.required' => 'pegawai harus diisi',
                'pegawai_id.exists' => 'pegawai tidak valid',
                'pendidikan_id.required' => 'pendidikan harus diisi',
                'pendidikan_id.exists' => 'pendidikan tidak valid',
                'nama.required' => 'nama harus diisi',
                'nama.max' => 'nama maksimal 50 karakter',
                'nik.required' => 'nik harus diisi',
                'nik.digits' => 'nik harus 16 digit',
                'anak_ke.required' => 'anak ke harus diiisi',
                'anak_ke.max' => 'anak ke maksimal 2 digit',
                'tempat_lahir.required' => 'tempat lahir harus diiisi',
                'tempat_lahir.max' => 'tempat lahir maksimal 50 karakter',
                'tanggal_lahir.required' => 'tempat lahir harus diiisi',
                'tanggal_lahir.date_format' => 'tanggal harus dalam bentuk format yang valid',
                'status_anak.required' => 'status anak harus diiisi',
                'status_anak.in' => 'status anak tidak valid',
                'status_tunjangan.required' => 'status tunjangan harus diiisi',
                'status_tunjangan.boolean' => 'status tunjangan tidak valid',
                'bidang_studi.required' => 'bidang studi harus diiisi',
                'bidang_studi.max' => 'bidang studi maksimal 50 karakter',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            $anak = new PegawaiAnak();
            $anak->pegawai_id = $request->pegawai_id;
            $anak->nama = $request->nama;
            $anak->nik = $request->nik;
            $anak->anak_ke = $request->anak_ke;
            $anak->tempat_lahir = $request->tempat_lahir;
            $anak->tanggal_lahir = Carbon::parse($request->tanggal_lahir)->translatedFormat('Y-m-d');;
            $anak->status_anak = $request->status_anak;
            $anak->status_tunjangan = $request->status_tunjangan;
            $anak->pendidikan_id = $request->pendidikan_id;
            $anak->bidang_studi = $request->bidang_studi;
            try {
                $anak->save();
                return response()->json(['success' => 'Pasangan Berhasil Disimpan']);
            } catch (QueryException $e) {
                return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $anak = PegawaiAnak::select(
                'id',
                'pegawai_id',
                'anak_ke',
                'nama',
                'nik',
                'tempat_lahir',
                'tanggal_lahir',
                'status_anak',
                'pendidikan_id',
                'bidang_studi',
                'status_tunjangan',
            )->where('id', $id)->first();

            if ($anak == null) {
                return response()->json(['errors' => ['data' => 'Data tidak ditemukan']]);
            }
            $anak->tanggal_lahir = Carbon::parse($anak->tanggal_lahir)->translatedFormat('d-m-Y');
            $anak->pendidikan;
            return response()->json(['result' => $anak]);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Pasangan";
        $anak = PegawaiAnak::select(
            'id',
            'pegawai_id',
            'anak_ke',
            'nama',
            'nik',
            'tempat_lahir',
            'tanggal_lahir',
            'status_anak',
            'pendidikan_id',
            'bidang_studi',
            'status_tunjangan',
        )->where('id', $id)->first();
        $anak->tanggal_lahir = Carbon::parse($anak->tanggal_lahir)->translatedFormat('d-m-Y');
        $pendidikan = TingkatPendidikan::select('id', 'nama')->get();
        $jenis_kawin = JenisKawin::select('id', 'nama')->get();
        return view('pegawai.keluarga.edit-anak', compact('title', 'anak', 'pendidikan', 'jenis_kawin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'pegawai_id' => ['required', 'exists:pegawai,id'],
                'nama' => ['required', 'max:50'],
                'nik' => ['required', 'digits:16'],
                'anak_ke' => ['required', 'max:2'],
                'tempat_lahir' => ['required', 'max:50'],
                'tanggal_lahir' => ['required', 'date_format:d-m-Y'],
                'status_anak' => ['required', Rule::in(["Kandung", "Angkat"])],
                'status_tunjangan' => ['required', 'boolean', 'max:1'],
                'pendidikan_id' => ['required', 'exists:pendidikan,id'],
                'bidang_studi' => ['required', 'max:50'],
            ],
            [
                'pegawai_id.required' => 'pegawai harus diisi',
                'pegawai_id.exists' => 'pegawai tidak valid',
                'pendidikan_id.required' => 'pendidikan harus diisi',
                'pendidikan_id.exists' => 'pendidikan tidak valid',
                'nama.required' => 'nama harus diisi',
                'nama.max' => 'nama maksimal 50 karakter',
                'nik.required' => 'nik harus diisi',
                'nik.digits' => 'nik harus 16 digit',
                'anak_ke.required' => 'anak ke harus diiisi',
                'anak_ke.max' => 'anak ke maksimal 2 digit',
                'tempat_lahir.required' => 'tempat lahir harus diiisi',
                'tempat_lahir.max' => 'tempat lahir maksimal 50 karakter',
                'tanggal_lahir.required' => 'tempat lahir harus diiisi',
                'tanggal_lahir.date_format' => 'tanggal harus dalam bentuk format yang valid',
                'status_anak.required' => 'status anak harus diiisi',
                'status_anak.in' => 'status anak tidak valid',
                'status_tunjangan.required' => 'status tunjangan harus diiisi',
                'status_tunjangan.boolean' => 'status tunjangan tidak valid',
                'bidang_studi.required' => 'bidang studi harus diiisi',
                'bidang_studi.max' => 'bidang studi maksimal 50 karakter',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {

            try {
                $anak = PegawaiAnak::where('id', $id)->first();
                $anak->pegawai_id = $request->pegawai_id;
                $anak->nama = $request->nama;
                $anak->nik = $request->nik;
                $anak->anak_ke = $request->anak_ke;
                $anak->tempat_lahir = $request->tempat_lahir;
                $anak->tanggal_lahir = Carbon::parse($request->tanggal_lahir)->translatedFormat('Y-m-d');;
                $anak->status_anak = $request->status_anak;
                $anak->status_tunjangan = $request->status_tunjangan;
                $anak->pendidikan_id = $request->pendidikan_id;
                $anak->bidang_studi = $request->bidang_studi;
                $anak->is_verified = FALSE;
                $anak->save();
                return response()->json(['success' => 'Anak Berhasil Disimpan']);
            } catch (QueryException $e) {
                return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anak = PegawaiAnak::where('id', $id)->first();

        if ($anak == null) {
            return response()->json(['errors' => ['connection' => 'Tidak menemukan data yang dihapus']]);
        }
        try {
            $anak->delete();
            return response()->json(['success' => 'Sukses Menghapus Data']);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['connection' => 'Data gagal dihapus']]);
        }
    }
    /**
     * Datatable Anak
     */
    public function datatable(Request $request)
    {
        $anak = PegawaiAnak::select('id', 'nama', 'nik', 'status_tunjangan', 'is_verified')
            ->where('pegawai_id', $request->pegawai_id)->orderBy('created_at', 'ASC');
        return DataTables::of($anak)
            ->addColumn('no', '')
            ->addColumn('aksi', 'pegawai.keluarga.aksi-anak')
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function verifikasi_sdmoh($id)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        $diklat = PegawaiAnak::where('id', $id)->first();
        $diklat->is_verified = TRUE;
        $diklat->save();
        return back();
    }
}
