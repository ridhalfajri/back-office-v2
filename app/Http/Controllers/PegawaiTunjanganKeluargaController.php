<?php

namespace App\Http\Controllers;

use App\Models\PegawaiTunjanganKeluarga;
use App\Models\PegawaiRiwayatJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

class PegawaiTunjanganKeluargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Approval Tunjangan Kinerja (KP4)';

        $dataUnitKerja = DB::table('unit_kerja')
            ->select('*')
            ->whereIn('jenis_unit_kerja_id', array(1, 2, 3))
            ->where('is_active', 'Y')
            ->get();

        return view('pegawai-tunjangan-keluarga.index', compact('title', 'dataUnitKerja'));
    }

    public function datatable(Request $request)
    {
        $unitKerja = $request->unitKerja;
        $status = $request->status;

        $data = DB::table('pegawai_tunjangan_keluarga as ptm')
            ->select(
                'ptm.*',
                'p.nama_depan',
                'p.nama_belakang',
                DB::raw('CONCAT(p.nama_depan," " ,p.nama_belakang) AS nama_pegawai'),
                'p.nip',
                'uk.nama as unit_kerja',
                'uk.singkatan as singkatan_unit_kerja'
            )
            ->join('pegawai as p', 'p.id', '=', 'ptm.pegawai_id')
            //->join('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai_riwayat_umak.pegawai_id')
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id', '=', 'ptm.pegawai_id')
                    ->where('prj.is_now', '=', 1)
                    ->where('prj.is_plt', '=', 0)
                ;
            })
            ->join('jabatan_unit_kerja as juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja as huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->leftJoin('unit_kerja as uk', function ($join) {
                $join->on('uk.id', '=', 'huk.child_unit_kerja_id')
                    ->where('uk.is_active', '=', 'Y')
                ;
            })
            ->orderBy('ptm.created_at', 'DESC')
            ->orderBy('uk.id', 'asc')
            ->orderBy('p.nama_depan', 'asc');

        if (null != $status || '' != $status) {
            $data->where('ptm.status', '=', $status);
        }

        // if (null != $daftarBpjs || '' != $daftarBpjs) {
        //     $data->where('ptm.daftar_ke_bpjs', '=', $daftarBpjs);
        // }

        if (null != $unitKerja || '' != $unitKerja) {
            $data->where('uk.id', '=', $unitKerja);
        }

        return Datatables::of($data)
            ->addColumn('no', '')

            // ->addColumn('nama_pegawai', function ($data) {
            //     return $data->nama_depan.' '.$data->nama_belakang;
            // })
            ->filterColumn('nama_pegawai', function ($query, $keyword) {
                $query->whereRaw("CONCAT(p.nama_depan,' ',p.nama_belakang) like ?", ["%$keyword%"]);
            })

            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    return 'Pengajuan';
                }
                if ($data->status == 2) {
                    return 'Ditolak';
                }
                if ($data->status == 3) {
                    return 'Disetujui';
                }
            })

            ->addColumn('aksi', 'pegawai-tunjangan-keluarga.aksi')
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show(PegawaiTunjanganKeluarga $pegawai_tunjangan_keluarga)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Lihat File';

        $ptk = $pegawai_tunjangan_keluarga;

        $cek_media = $ptk->getMedia("file_kp_ttd")->count();
        if ($cek_media) {
            $ptk->file_kp_ttd = $ptk->getFirstMediaUrl("file_kp_ttd");
        }

        $cek_media = $ptk->getMedia("file_pengajuan_kp")->count();
        if ($cek_media) {
            $ptk->file_pengajuan_kp = $ptk->getMedia("file_pengajuan_kp")[0]->getUrl();
        }

        return view('pegawai-tunjangan-keluarga.show', compact('title', 'ptk'));
    }

    public function edit(PegawaiTunjanganKeluarga $pegawai_tunjangan_keluarga)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Ubah Persetujuan Tunjangan Kinerja (KP4)';

        $pegawai = DB::table('pegawai_tunjangan_keluarga as ptm')
            ->select(
                'ptm.*',
                'p.nama_depan',
                'p.nama_belakang',
                'p.nip',
                'uk.nama as unit_kerja',
                'uk.singkatan as singkatan_unit_kerja'
            )
            ->join('pegawai as p', 'p.id', '=', 'ptm.pegawai_id')
            //->join('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai_riwayat_umak.pegawai_id')
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id', '=', 'ptm.pegawai_id')
                    ->where('prj.is_now', '=', 1)
                    ->where('prj.is_plt', '=', 0)
                ;
            })
            ->join('jabatan_unit_kerja as juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja as huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->leftJoin('unit_kerja as uk', function ($join) {
                $join->on('uk.id', '=', 'huk.child_unit_kerja_id')
                    ->where('uk.is_active', '=', 'Y')
                ;
            })
            ->where('ptm.pegawai_id', '=', $pegawai_tunjangan_keluarga->pegawai_id)
            ->first();

        $ptk = $pegawai_tunjangan_keluarga;

        $cek_media = $ptk->getMedia("file_kp_ttd")->count();
        if ($cek_media) {
            $ptk->file_kp_ttd = $ptk->getFirstMediaUrl("file_kp_ttd");
        }

        $cek_media = $ptk->getMedia("file_pengajuan_kp")->count();
        if ($cek_media) {
            $ptk->file_pengajuan_kp = $ptk->getMedia("file_pengajuan_kp")[0]->getUrl();
        }

        return view('pegawai-tunjangan-keluarga.edit', compact('title', 'ptk', 'pegawai'));
    }

    public function update(Request $request, PegawaiTunjanganKeluarga $pegawai_tunjangan_keluarga)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        //dd($request->all());

        DB::beginTransaction();

        if ($request->button_clicked == "setuju") {
            $this->validate(
                $request,
                [
                    'file_kp_ttd' => ['required', 'file', 'mimes:pdf', 'max:20480'],
                ],
                [
                    'file_kp_ttd.required' => 'data file harus di-upload saat menyetujui kp4!',
                    'file_kp_ttd.mimes' => 'format file harus pdf!',
                    'file_kp_ttd.max' => 'ukuran file terlalu besar (maksimal file 20Mb)!',
                    'file_kp_ttd.file' => 'upload data harus berupa file!',
                ]
            );
        }

        try {
            //update
            //jika button submit atau jika button tolak
            if ($request->button_clicked == "setuju") {
                $pegawai_tunjangan_keluarga->status = 3;
                $pegawai_tunjangan_keluarga->keterangan_tolak = '';

                if ($request->file('file_kp_ttd')) {
                    $pegawai_tunjangan_keluarga->clearMediaCollection('file_kp_ttd');
                    $pegawai_tunjangan_keluarga->addMediaFromRequest('file_kp_ttd')->toMediaCollection('file_kp_ttd');
                }
            }

            if ($request->button_clicked == "tolak") {
                $pegawai_tunjangan_keluarga->status = 2;
                $pegawai_tunjangan_keluarga->keterangan_tolak = $request->keterangan_tolak;
                $pegawai_tunjangan_keluarga->clearMediaCollection('file_kp_ttd');
            }

            $pegawai_tunjangan_keluarga->update();

            DB::commit();
            Log::info('Data berhasil di-update di method update pada PegawaiTunjanganKeluargaController!');

            return redirect()->route('pegawai-tunjangan-keluarga.index')
                ->with('success', 'Data Persetujuan Tunjangan Keluarga berhasil diupdate');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada PegawaiTunjanganKeluargaController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\PegawaiTambahanMk  $bidangProfisiensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PegawaiTunjanganKeluarga $pegawai_tunjangan_keluarga)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();
        try {
            // $pegawai_tambahan_bpj->status = 2;
            // $pegawai_tambahan_bpj->is_active = 0;
            $pegawai_tunjangan_keluarga->clearMediaCollection('file_kp_ttd');
            $pegawai_tunjangan_keluarga->clearMediaCollection('file_pengajuan_kp');
            $pegawai_tunjangan_keluarga->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan Tunjangan Keluarga berhasil dihapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PegawaiTunjanganKeluargaController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan Tunjangan Keluarga gagal dihapus!',
                'error' => true,
                'error_message' => 'Data Pengajuan Tunjangan Keluarga gagal dihapus!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PegawaiTunjanganKeluargaController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
