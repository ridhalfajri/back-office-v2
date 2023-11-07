<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\PegawaiRiwayatPendidikan;
use App\Models\Pendidikan;
use App\Models\Propinsi;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class RiwayatPendidikanController extends Controller
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
    public function create($id)
    {
        $title = "Riwayat Pendidikan";
        $pendidikan = Pendidikan::select('id', 'nama')->get();
        $pegawai = Pegawai::select('id', 'nama_depan', 'nama_belakang')->where('id', $id)->first();
        return view('pegawai.pendidikan.create', compact('pendidikan', 'title', 'pegawai'));
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
                'pendidikan_id' => ['required', 'exists:pendidikan,id'],
                'nama_instansi' => ['required', 'max:100'],
                'propinsi_id' => ['required', 'exists:propinsi,id'],
                'kota_id' => ['required', 'exists:kota,id'],
                'alamat' => ['required'],
                'no_ijazah' => ['required', 'max:100'],
                'tanggal_ijazah' => ['required', 'date_format:d-m-Y'],
                'kode_gelar_depan' => ['nullable', 'max:10'],
                'kode_gelar_belakang' => ['nullable', 'max:10'],
                'media_ijazah' => ['required_without:id', 'nullable', 'mimes:pdf', 'file', 'max:1024',],
            ],
            [
                'pegawai_id.required' => 'pegawai harus diisi',
                'pegawai_id.exists' => 'pegawai tidak valid',
                'pendidikan_id.required' => 'pendidikan harus diisi',
                'pendidikan_id.exists' => 'pendidikan tidak valid',
                'nama_instansi.required' => 'nama instansi harus diisi',
                'nama_instansi.max' => 'nama instansi maksimal 100 karakter',
                'propinsi_id.required' => 'propinsi harus diisi',
                'propinsi_id.exists' => 'propinsi tidak valid',
                'kota_id.required' => 'kota/kabupaten harus diisi',
                'kota_id.exists' => 'kota tidak valid',
                'alamat.required' => 'alamat harus diisi',
                'tanggal_ijazah.required' => 'tanggal ijazah harus diisi',
                'tanggal_ijazah.date_format' => 'tanggal harus dalam bentuk format yang valid',
                'no_ijazah.required' => ' ijazah harus diisi',
                'no_ijazah.max' => ' nomor ijazah maksimal 100 karakter',
                'kode_gelar_depan.max' => ' gelar depan maksimal 100 karakter',
                'kode_gelar_belakang.max' => 'gelar belakang maksimal 100 karakter',
                'media_ijazah.required_without' => 'file ijazah harus diisi',
                'media_ijazah.mimes' => 'format file ijazah harus pdf',
                'media_ijazah.max' => 'ukuran file terlalu besar (maksimal file 1MB)',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            $pendidikan = new PegawaiRiwayatPendidikan();
            $pendidikan->pegawai_id = $request->pegawai_id;
            $pendidikan->pendidikan_id = $request->pendidikan_id;
            $pendidikan->nama_instansi = $request->nama_instansi;
            $pendidikan->propinsi_id = $request->propinsi_id;
            $pendidikan->kota_id = $request->kota_id;
            $pendidikan->alamat = $request->alamat;
            $pendidikan->no_ijazah = $request->no_ijazah;
            $pendidikan->tanggal_ijazah = Carbon::parse($request->tanggal_ijazah)->translatedFormat('Y-m-d');
            $pendidikan->kode_gelar_depan = $request->kode_gelar_depan;
            $pendidikan->kode_gelar_belakang = $request->kode_gelar_belakang;
            try {
                DB::transaction(function () use ($pendidikan) {
                    $pendidikan->save();
                    $pendidikan->addMediaFromRequest('media_ijazah')->toMediaCollection('media_ijazah');
                });
                return response()->json(['success' => 'Sukses Mengubah Data']);
            } catch (QueryException $e) {
                return response()->json(['errors' => ['connection' => 'Data gagal disimpan']]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
     * Datatable Riwayat Pendidikan By Pegawai
     */
    public function datatable(Request $request)
    {
        $pendidikan = PegawaiRiwayatPendidikan::select('pegawai_riwayat_pendidikan.id', 'pendidikan_id', 'pendidikan.nama', 'nama_instansi', 'tanggal_ijazah')
            ->join('pendidikan', 'pendidikan.id', '=', 'pegawai_riwayat_pendidikan.pendidikan_id')
            ->where('pegawai_id', $request->pegawai_id)->orderBy('pegawai_riwayat_pendidikan.tanggal_ijazah', 'DESC');
        return DataTables::of($pendidikan)
            ->addColumn('no', '')
            ->addColumn('aksi', 'pegawai.pendidikan.aksi-pendidikan')
            ->editColumn('tanggal_ijazah', function ($pendidikan) {
                return $pendidikan->tanggal_ijazah ? with(new Carbon($pendidikan->tanggal_ijazah))->format('d/m/Y') : '';
            })
            ->filterColumn('tanggal_ijazah', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_ijazah, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function getpendidikanById(Request $request)
    {
        //
    }
}
