<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PegawaiAlamat;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class PegawaiAlamatController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'tipe_alamat' => ['required', Rule::in(["Domisili", "Asal"])],
                'propinsi_id' => ['required', 'max:10', 'exists:propinsi,id'],
                'kota_id' => ['required', 'max:20', 'exists:kota,id'],
                'kecamatan_id' => ['required', 'max:20', 'exists:kecamatan,id'],
                'desa_id' => ['required', 'max:20', 'exists:desa,id'],
                'kode_pos' => ['required', 'max:5'],
                'alamat' => ['required'],
            ],
            [
                'pegawai_id.required' => 'pegawai harus diisi',
                'pegawai_id.max' => 'pegawai tidak valid',
                'pegawai_id.exists' => 'pegawai tidak valid',
                'tipe_alamat.required' => 'tipe alamat harus diisi',
                'tipe_alamat.in' => 'tipe alamat tidak valid',
                'propinsi_id.required' => 'propinsi harus diisi',
                'propinsi_id.max' => 'propinsi tidak valid',
                'propinsi_id.exists' => 'propinsi tidak valid',
                'kota_id.required' => 'kota/kabupaten harus diisi',
                'kota_id.max' => 'kota/kabupaten tidak valid',
                'kota_id.exists' => 'kota tidak valid',
                'kecamatan_id.required' => 'kecamatan harus diisi',
                'kecamatan_id.max' => 'kecamatan tidak valid',
                'kecamatan_id.exists' => 'kecamatan tidak valid',
                'desa_id.required' => 'desa harus diisi',
                'desa_id.max' => 'desa tidak valid',
                'desa_id.exists' => 'desa tidak valid',
                'kode_pos.required' => 'kode pos harus diisi',
                'kode_pos.max' => 'kode pos tidak valid',
                'alamat.required' => 'alamat harus diisi',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            $pegawai_alamat = PegawaiAlamat::where('pegawai_id', $request->pegawai_id)->where('tipe_alamat', $request->tipe_alamat)->first();
            if ($pegawai_alamat == null) {
                $pegawai_alamat = new PegawaiAlamat();
            }
            $pegawai_alamat->pegawai_id = $request->pegawai_id;
            $pegawai_alamat->tipe_alamat = $request->tipe_alamat;
            $pegawai_alamat->propinsi_id = $request->propinsi_id;
            $pegawai_alamat->kota_id = $request->kota_id;
            $pegawai_alamat->kecamatan_id = $request->kecamatan_id;
            $pegawai_alamat->desa_id = $request->desa_id;
            $pegawai_alamat->kode_pos = $request->kode_pos;
            $pegawai_alamat->alamat = $request->alamat;
            try {
                $pegawai_alamat->save();
                return response()->json(['success' => 'Sukses Mengubah Data']);
            } catch (\Throwable $th) {
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
    public function getAlamatByPegawaiId(Request $request)
    {
        try {
            $alamat = PegawaiAlamat::select('tipe_alamat', 'propinsi_id', 'kota_id', 'kecamatan_id', 'desa_id', 'kode_pos', 'alamat')->where('pegawai_id', $request->pegawai_id)->where('tipe_alamat', $request->tipe_alamat)->first();
            return response()->json(['result' => $alamat]);
        } catch (\Throwable $th) {
            abort(500);
            //throw $th;
        }
    }
}
