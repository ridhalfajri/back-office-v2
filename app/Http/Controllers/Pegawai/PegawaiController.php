<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Agama;
use App\Models\JenisKawin;
use App\Models\JenisPegawai;
use App\Models\Pegawai;
use App\Models\PegawaiAlamat;
use App\Models\Propinsi;
use App\Models\StatusPegawai;
use App\Models\PegawaiRiwayatJabatan;
use App\Models\UnitKerja;
use App\Models\Gaji;
use App\Models\HirarkiUnitKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', TRUE)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        $unit_kerja = UnitKerja::select('id', 'nama')->where('is_active', 'Y')->get();
        $title = "Pegawai";
        $esselon = false;
        return view('pegawai.index', compact('title', 'unit_kerja', 'esselon'));
    }

    public function index_esselon()
    {
        // $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->first();
        // $this->authorize('admin_sdmoh', $kabiro);
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
        $esselon = true;

        return view('pegawai.index', compact('title', 'unit_kerja', 'esselon'));
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
        //$gaji = Gaji::select('id', 'masa_kerja', 'golongan_id', 'nominal')->get();
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
                'npwp',
                'is_verified'
            )->where('id', $id)->first();
            $alamat_domisili = PegawaiAlamat::where('pegawai_id', $pegawai->id)->where('tipe_alamat', 'Domisili')->first();
            $alamat_asal = PegawaiAlamat::where('pegawai_id', $pegawai->id)->where('tipe_alamat', 'Asal')->first();
            // if (!empty($pegawai->getFirstMediaUrl('media_foto_pegawai'))) {
            //     $pegawai->media_foto_pegawai = $pegawai->getFirstMediaUrl('media_foto_pegawai');
            // }
            // if (!empty($pegawai->getFirstMediaUrl('media_kartu_pegawai'))) {
            //     $pegawai->media_kartu_pegawai = $pegawai->getFirstMediaUrl('media_kartu_pegawai');
            // }
            if (!empty($pegawai->getMedia('media_foto_pegawai')[0])) {
                $pegawai->media_foto_pegawai = $pegawai->getFirstMediaUrl('media_foto_pegawai');
            }
            if (!empty($pegawai->getMedia('media_kartu_pegawai')[0])) {
                $pegawai->media_kartu_pegawai = $pegawai->getFirstMediaUrl('media_kartu_pegawai');
            }
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
        $title = 'Ubah Data Pegawai';

        $agama = Agama::all();

        $jenis_kawin = JenisKawin::all();

        $jenis_pegawai = JenisPegawai::all();

        $status_pegawai = StatusPegawai::all();

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
            // 'no_kartu_pegawai',
            'no_bpjs',
            'no_taspen',
            'no_enroll',
            'npwp'
        )->where('id', $id)->first();

        if (!empty($pegawai->getMedia('media_foto_pegawai')[0])) {
            $pegawai->media_foto_pegawai = $pegawai->getFirstMediaUrl('media_foto_pegawai');
        }
        if (!empty($pegawai->getMedia('media_kartu_pegawai')[0])) {
            $pegawai->media_kartu_pegawai = $pegawai->getFirstMediaUrl('media_kartu_pegawai');
        }

        return view('pegawai.edit', compact('title', 'pegawai', 'agama', 'jenis_kawin', 'jenis_pegawai', 'status_pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());

        $validate = Validator::make(
            $request->all(),
            [
                'nik' => 'required|digits:16',
                'nip' => 'required|digits:18',
                'nama_depan' => 'required|string',
                'nama_belakang' => 'required|string',
                'jenis_kelamin' => 'required',
                'agama_id' => 'required',
                'golongan_darah' => 'required',
                'jenis_kawin_id' => 'required',
                'tempat_lahir' => 'required|max:50|regex:/^[\pL\s\-]+$/u',
                'tanggal_lahir' => 'required|date',
                'email_kantor' => 'required|email:rfc,dns',
                'email_pribadi' => 'nullable|email:rfc,dns',
                'no_telp' => 'required|digits_between:8,13',
                'jenis_pegawai_id' => 'required',
                'status_pegawai_id' => 'required',
                'status_dinas' => 'required',
                // 'no_kartu_pegawai' => 'nullable|between:7,10|string',
                'tanggal_wafat' => 'nullable|date',
                'tanggal_berhenti' => 'nullable|date',
                'no_bpjs' => 'nullable|digits:13',
                'no_taspen' => 'nullable|max:50',
                'npwp' => 'nullable|size:16|string',
                'no_enroll' => 'max:50',
                'media_kartu_pegawai' => 'nullable|mimes:jpg,png|max:1024',
                'media_foto_pegawai' => 'nullable|mimes:jpg,png|max:1024'
            ],
            [
                'nik.required' => 'NIK harus diisi',
                'nik.digits' => 'NIK harus 16 digit',
                'nip.required' => 'NIP harus diisi',
                'nip.digits' => 'NIP harus 18 digit',
                'nama_depan.required' => 'Nama depan harus diisi',
                'nama_depan.string' => 'Nama depan berupa string',
                'nama_belakang.required' => 'Nama belakang harus diisi',
                'nama_belakang.string' => 'Nama belakang berupa string',
                'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
                'agama_id.required' => 'Agama harus diisi',
                'golongan_darah.required' => 'Golongan darah harus diisi',
                'jenis_kawin_id.required' => 'Status nikah harus diisi',
                'tempat_lahir.required' => 'Tempat lahir harus diisi',
                'tempat_lahir.max' => 'Tempat lahir tidak lebih dari 50 karakter',
                'tempat_lahir.regex' => 'Tempat lahir tidak boleh menggunakan karakter spesial',
                'tanggal_lahir.required' => 'Tanggal lahir harus diisi',
                'tanggal_lahir.date' => 'Tanggal lahir harus format tanggal',
                'email_kantor.required' => 'Email kantor harus diisi',
                'email_kantor.email' => 'Email kantor harus format alamat email',
                'email_pribadi.required' => 'Email pribadi harus diisi',
                'email_pribadi.email' => 'Email pribadi harus format alamat email',
                'no_telp.required' => 'No Telepon harus diisi',
                'no_telp.digits_between' => 'Nomor Telepon diantara 8-13 digit',
                'jenis_pegawai_id.required' => 'Jenis pegawai harus diisi',
                'status_pegawai_id.required' => 'Status pegawai harus diisi',
                'status_dinas.required' => 'Status dinas harus diisi',
                // 'no_kartu_pegawai.between' => 'Nomor kartu pegawai diantara 7-10 karakter',
                // 'no_kartu_pegawai.string' => 'Nomor kartu pegawai harus string',
                'tanggal_wafat.date' => 'Tanggal wafat harus format tanggal',
                'tanggal_berhenti.date' => 'Tanggal berhenti harus format tanggal',
                //'no_bpjs.required' => 'Nomor BPJS harus diisi',
                'no_bpjs.digits' => 'Nomor BPJS harus 13 digits',
                'no_taspen.max' => 'Nomor Taspen maksimal 50 karakter',
                'npwp.size' => 'NPWP harus 16 karakter',
                'npwp.string' => 'NPWP harus string',
                'no_enroll.max' => 'Nomor Fingerprint maksimal 50 karakter',
                'media_kartu_pegawai.mimes' => 'Kartu pegawai bertipe jpg atau png',
                'media_kartu_pegawai.max' => 'Kartu pegawai maksimal 1024 kb',
                'media_foto_pegawai.mimes' => 'Foto pegawai bertipe jpg atau png',
                'media_foto_pegawai.max' => 'Foto pegawai maksimal 1024 kb',
            ]
        );

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            $pegawai = Pegawai::where('id', $id)->first();
            $pegawai->nik = $request->nik;
            $pegawai->nip = $request->nip;
            $pegawai->npwp = $request->npwp;
            $pegawai->nama_depan = $request->nama_depan;
            $pegawai->nama_belakang = $request->nama_belakang;
            $pegawai->jenis_kelamin = $request->jenis_kelamin;
            $pegawai->agama_id = $request->agama_id;
            $pegawai->golongan_darah = $request->golongan_darah;
            $pegawai->jenis_kawin_id = $request->jenis_kawin_id;
            $pegawai->tempat_lahir = $request->tempat_lahir;
            $pegawai->tanggal_lahir = Carbon::parse($request->tanggal_lahir)->translatedFormat('Y-m-d');
            $pegawai->email_kantor = $request->email_kantor;
            $pegawai->email_pribadi = $request->email_pribadi;
            $pegawai->no_telp = $request->no_telp;
            $pegawai->jenis_pegawai_id = $request->jenis_pegawai_id;
            $pegawai->status_pegawai_id = $request->status_pegawai_id;
            $pegawai->status_dinas = $request->status_dinas;
            $pegawai->tanggal_berhenti = $request->tanggal_berhenti;
            $pegawai->tanggal_wafat = $request->tanggal_wafat;
            $pegawai->no_bpjs = $request->no_bpjs;
            $pegawai->no_taspen = $request->no_taspen;
            $pegawai->no_enroll = $request->no_enroll;
            $pegawai->is_verified = 'N';
            // $pegawai->no_kartu_pegawai = $request->no_kartu_pegawai;
            try {
                DB::transaction(function () use ($pegawai, $request) {
                    $pegawai->save();
                    if ($request->file('media_foto_pegawai')) {
                        $pegawai->clearMediaCollection('media_foto_pegawai');
                        $pegawai->addMediaFromRequest('media_foto_pegawai')->toMediaCollection('media_foto_pegawai');
                    }
                    if ($request->file('media_kartu_pegawai')) {
                        $pegawai->clearMediaCollection('media_kartu_pegawai');
                        $pegawai->addMediaFromRequest('media_kartu_pegawai')->toMediaCollection('media_kartu_pegawai');
                    }
                });
                return response()->json(['success' => 'Data Pegawai Berhasil Disimpan']);
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
        //
    }

    public function verifikasi_profile($id)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', TRUE)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        $pegawai = Pegawai::where('id', $id)->first();
        //dd($pegawai);
        $pegawai->is_verified = 'Y';
        $pegawai->save();
        return back();
    }

    /**
     * Datatable for pegawai.
     */
    public function datatable(Request $request)
    {
        $pegawai = Pegawai::select('pegawai.id', 'nip', 'nama_depan', 'nama_belakang', DB::raw('CONCAT(nama_depan," " ,nama_belakang) AS nama_lengkap'), 'no_telp', 'email_kantor', 'uk.nama AS nama_unit_kerja')->orderBy('nama_unit_kerja', 'DESC')
            ->leftJoin('pegawai_riwayat_jabatan AS prj', 'prj.pegawai_id', '=', 'pegawai.id')
            ->leftJoin('jabatan_unit_kerja AS juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->leftJoin('hirarki_unit_kerja AS huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->leftJoin('unit_kerja AS uk', 'uk.id', '=', 'huk.child_unit_kerja_id')
            ->where('prj.is_now', 1)
            ->where('prj.is_plt', 0);

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
