<?php

namespace App\Http\Controllers;

use App\Models\PegawaiBpjsRegular;
use App\Models\PegawaiRiwayatJabatan;
use App\Models\PegawaiTambahanMk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExportBpjsReg;
use Carbon\Carbon;

class PegawaiRegularBpjsController extends Controller
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

        $title = 'Approval BPJS Regular';

        $dataUnitKerja = DB::table('unit_kerja')
            ->select('*')
            ->whereIn('jenis_unit_kerja_id', array(1, 2, 3))
            ->where('is_active', 'Y')
            ->get();

        return view('pegawai-regular-bpjs.index', compact('title', 'dataUnitKerja'));
    }

    public function datatable(Request $request)
    {
        $unitKerja = $request->unitKerja;
        $status = $request->status;
        $daftarBpjs = $request->daftarBpjs;

        $data = DB::table('pegawai_bpjs_regular as ptm')
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

        if (null != $daftarBpjs || '' != $daftarBpjs) {
            $data->where('ptm.daftar_ke_bpjs', '=', $daftarBpjs);
        }

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

            ->addColumn('status_hub_keluarga', function ($data) {
                if ($data->kode_hub_keluarga == 1) {
                    return 'Peserta';
                }
                if ($data->kode_hub_keluarga == 2) {
                    return 'Istri';
                }
                if ($data->kode_hub_keluarga == 3) {
                    return 'Suami';
                }
                if ($data->kode_hub_keluarga == 4) {
                    return 'Anak';
                }
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

            ->addColumn('aksi', 'pegawai-regular-bpjs.aksi')
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show(PegawaiBpjsRegular $pegawai_regular_bpj)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Lihat File';

        $bpjs = $pegawai_regular_bpj;

        $cek_media = $bpjs->getMedia("file_pengajuan_bpjs_regular")->count();
        if ($cek_media) {
            $bpjs->file_pengajuan_bpjs_regular = $bpjs->getFirstMediaUrl("file_pengajuan_bpjs_regular");
        }

        // $cek_media = $bpjs->getMedia("file_kartu_bpjs")->count();
        // if ($cek_media) {
        //     $bpjs->file_kartu_bpjs = $bpjs->getMedia("file_kartu_bpjs")[0]->getUrl();
        // }

        return view('pegawai-regular-bpjs.show', compact('title', 'bpjs'));
    }

    public function edit(PegawaiBpjsRegular $pegawai_regular_bpj)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Persetujuan BPJS Regular';

        $pegawai = DB::table('pegawai_bpjs_regular as ptm')
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
            ->where('ptm.pegawai_id', '=', $pegawai_regular_bpj->pegawai_id)
            ->first();

        $bpjs = $pegawai_regular_bpj;

        $cek_media = $bpjs->getMedia("file_pengajuan_bpjs_regular")->count();
        if ($cek_media) {
            $bpjs->file_pengajuan_bpjs_regular = $bpjs->getFirstMediaUrl("file_pengajuan_bpjs_regular");
        }

        return view('pegawai-regular-bpjs.edit', compact('title', 'bpjs', 'pegawai'));
    }

    public function update(Request $request, PegawaiBpjsRegular $pegawai_regular_bpj)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        //dd($request->all());

        DB::beginTransaction();

        try {
            //update
            //jika button submit atau jika button tolak
            if ($request->button_clicked == "setuju") {
                $pegawai_regular_bpj->status = 3;
                $pegawai_regular_bpj->is_active = 1;
                $pegawai_regular_bpj->keterangan_tolak = '';
            }

            if ($request->button_clicked == "tolak") {
                $pegawai_regular_bpj->status = 2;
                $pegawai_regular_bpj->is_active = 0;
                $pegawai_regular_bpj->keterangan_tolak = $request->keterangan_tolak;
            }

            $pegawai_regular_bpj->daftar_ke_bpjs = 'N';
            $pegawai_regular_bpj->update();

            // if ($request->file('file_kartu_bpjs')) {
            //     $pegawai_tambahan_bpj->clearMediaCollection('file_kartu_bpjs');
            //     $pegawai_tambahan_bpj->addMediaFromRequest('file_kartu_bpjs')->toMediaCollection('file_kartu_bpjs');
            // }

            DB::commit();
            Log::info('Data berhasil di-update di method update pada PegawaiRegularBpjsController!');

            return redirect()->route('pegawai-regular-bpjs.index')
                ->with('success', 'Data Persetujuan BPJS Regular berhasil diupdate');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada PegawaiRegularBpjsController!']);

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
    public function destroy(PegawaiBpjsRegular $pegawai_regular_bpj)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();
        try {
            // $pegawai_tambahan_bpj->status = 2;
            // $pegawai_tambahan_bpj->is_active = 0;
            $pegawai_regular_bpj->clearMediaCollection('file_pengajuan_bpjs_regular');
            $pegawai_regular_bpj->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan BPJS Regular berhasil dihapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PegawaiRegularBpjsController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan BPJS Regular gagal dihapus!',
                'error' => true,
                'error_message' => 'Data Pengajuan BPJS Regular gagal dihapus!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PegawaiRegularBpjsController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }

    public function kirimBpjs(Request $request, PegawaiBpjsRegular $pegawai_regular_bpj)
    {
        DB::beginTransaction();
        try {
            $pegawai_regular_bpj->update([
                'daftar_ke_bpjs' => 'Y'
            ]);

            $response['status'] = [
                'code' => 200,
                'message' => 'Fixasi kirim data bpjs berhasil!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Fixasi data bpjs berhasil di-update di method kirimBpjs pada PegawaiRegularBpjsController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 500,
                'message' => 'Gagal fixasi data daftar ke bpjs!',
                'error' => true,
                'error_message' => 'Gagal fixasi data daftar ke bpjs!'
            ];

            Log::error($e->getMessage(), ['Fixasi data bpjs gagal di-update di method kirimBpjs pada PegawaiRegularBpjsController!']);
            DB::rollback();

            return response()->json($response, 500);
        }
    }

    public function exportToExcel($status, $daftarBpjs)
    {
        try {
            $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
            $this->authorize('admin_sdmoh', $kabiro);

            $statusName = '';
            if ($status == 1) {
                $statusName = 'Pengajuan';
            } else if ($status == 2) {
                $statusName = 'Ditolak';
            } else if ($status == 3) {
                $statusName = 'Disetujui';
            }

            $fileName = 'BPJS-Regular' . '_' . $statusName . '_Daftar-' . $daftarBpjs . '_' . Carbon::now() . '.xlsx';

            return Excel::download(new DataExportBpjsReg($status, $daftarBpjs), $fileName);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['Export data excel gagal di method exportToExcel pada PegawaiRegularBpjsController!']);
        }
    }
}
