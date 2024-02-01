<?php

namespace App\Http\Controllers;

use App\Models\PegawaiRiwayatJabatan;
use App\Models\PegawaiRiwayatUmak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\UangMakan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataExportPrt;
use App\Models\AturanThrGajiplus;
use App\Models\JabatanFungsional;
use App\Models\JabatanStruktural;
use App\Models\PegawaiAnak;
use App\Models\PegawaiRiwayatThr;
use App\Models\PegawaiSuamiIstri;
use App\Models\PegawaiTmtGaji;
use App\Models\PreTubel;
use App\Models\TunjanganBeras;

class PegawaiRiwayatThrController extends Controller
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

        $title = 'Riwayat THR Pegawai';

        $dataUnitKerja = DB::table('unit_kerja')
            ->select('*')
            ->whereIn('jenis_unit_kerja_id', array(1, 2, 3))
            ->where('is_active','Y')
            ->get();

        return view('perhitungan-thr.pegawai-riwayat-thr', compact('title', 'dataUnitKerja'));
    }

    public function datatable(Request $request)
    {
        $tahun = $request->tahun;
        $unitKerja = $request->unitKerja;

        //dd($request);

        $data = [];
        if ('' != $tahun) {
            $data = PegawaiRiwayatThr::select(
                'p.nama_depan',
                'p.nama_belakang',
                'p.nip',
                'pegawai_riwayat_thr.nominal_gaji_pokok',
                'pegawai_riwayat_thr.tunjangan_beras',
                'pegawai_riwayat_thr.tunjangan_pasangan',
                'pegawai_riwayat_thr.tunjangan_anak',
                'pegawai_riwayat_thr.tunjangan_jabatan',
                'pegawai_riwayat_thr.tunjangan_kinerja',
                'pegawai_riwayat_thr.tahun',
                'pegawai_riwayat_thr.total_thr',
                'uk.nama as unit_kerja',
                'uk.singkatan as singkatan_unit_kerja'
            )
                ->join('pegawai as p', 'p.id', '=', 'pegawai_riwayat_thr.pegawai_id')
                //->join('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai_riwayat_umak.pegawai_id')
                ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                    $join->on('prj.pegawai_id', '=', 'pegawai_riwayat_thr.pegawai_id')
                        ->where('prj.is_now', '=', 1);
                })
                ->join('jabatan_unit_kerja as juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
                ->join('hirarki_unit_kerja as huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
                ->leftJoin('unit_kerja as uk', function ($join) {
                    $join->on('uk.id', '=', 'huk.child_unit_kerja_id')
                        ->where('uk.is_active','=','Y')
                        ;
                })
                //
                ->where('pegawai_riwayat_thr.tahun', '=', $tahun)
                ->orderBy('uk.id', 'asc')
                ->orderBy('p.nama_depan', 'asc');

            if (null != $unitKerja || '' != $unitKerja) {
                $data->where('uk.id', '=', $unitKerja);
            }
        }

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('nama_pegawai', function ($data) {
                return $data->nama_depan . ' ' . $data->nama_belakang;
            })
            ->addColumn('gapok_tunjangan', function ($data) {
                return $data->nominal_gaji_pokok + $data->tunjangan_beras + $data->tunjangan_pasangan
                    + $data->tunjangan_anak + $data->tunjangan_jabatan;
            })

            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kalkulasiThr(Request $request)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $periode = $request->periode;

        DB::beginTransaction();

        try {
            //looping data pegawai
            $listPegawai = DB::table('pegawai as p')
                ->select('p.*')
                ->leftJoin('status_pegawai as sp', function ($join) {
                    $join->on('sp.id', '=', 'p.status_pegawai_id')
                        ->whereIn('sp.nama', array('PNS', 'CPNS', 'PPPK'))
                        ->where('sp.is_active','Y')
                        ;
                })
                ->where('status_dinas', 1)
                ->whereNull('tanggal_berhenti')
                ->whereNull('tanggal_wafat')
                //untuk test, data pegawai_riwayat_golongan harus ada!
                //->where('p.id','=',498)
                ->get();

            //cek list ada atau tidak
            if ($listPegawai->isNotEmpty()) {
                foreach ($listPegawai as $pegawai) {
                    $gaji = PegawaiTmtGaji::where('pegawai_id', $pegawai->id)->where('is_active', 1)->first();
                    $NOMINAL_GAJI_POKOK = $gaji->gaji->nominal;

                    //* TUNJANGAN PASANGAN
                    $pasangan = PegawaiSuamiIstri::where('pegawai_id', $pegawai->id)->where('status_tunjangan', true)->first();
                    $TUNJANGAN_PASANGAN = $this->_tunjangan_pasangan($pegawai, $NOMINAL_GAJI_POKOK, $pasangan);

                    //* TUNJANGAN ANAK
                    $count_anak = PegawaiAnak::where('pegawai_id', $pegawai->id)->where('status_tunjangan', 1)->count();
                    $TUNJANGAN_ANAK = $this->_tunjangan_anak($NOMINAL_GAJI_POKOK, $count_anak);

                    //*TUNJANGAN JABATAN
                    $jabatan = PegawaiRiwayatJabatan::where('pegawai_id', $pegawai->id)->where('is_now', true)->where('is_plt', false)->first();
                    $TUNJANGAN_JABATAN = $this->_tunjangan_jabatan($pegawai, $gaji, $jabatan);

                    //* TUNJANGAN KINERJA
                    $TUNJANGAN_KINERJA = $jabatan->jabatan_unit_kerja->jabatan_tukin->tukin->nominal;
                    $jabatan_plt = PegawaiRiwayatJabatan::where('pegawai_id', $pegawai->id)->where('is_now', true)->where('is_plt', true)->first();
                    if ($jabatan_plt != null) {
                        $TUNJANGAN_KINERJA += 0.2 * $jabatan_plt->jabatan_unit_kerja->jabatan_tukin->tukin->nominal;
                    }

                    //*TUNJANGAN BERAS
                    $TUNJANGAN_BERAS = $this->_tunjangan_beras($pasangan, $count_anak);

                    //** JIKA CPNS*/
                    if ($pegawai->status_pegawai_id == 4) {
                        $PERSEN_CPNS = 0.8;

                        $NOMINAL_GAJI_POKOK = $PERSEN_CPNS * $NOMINAL_GAJI_POKOK;
                        $TUNJANGAN_PASANGAN = $PERSEN_CPNS * $TUNJANGAN_PASANGAN;
                        $TUNJANGAN_ANAK = $PERSEN_CPNS * $TUNJANGAN_ANAK;
                        $TUNJANGAN_JABATAN = $PERSEN_CPNS * $TUNJANGAN_JABATAN;
                        $TUNJANGAN_KINERJA = $PERSEN_CPNS * $TUNJANGAN_KINERJA;
                        $TUNJANGAN_BERAS = $PERSEN_CPNS * $TUNJANGAN_BERAS;
                    }

                    //untuk yang tubel
                    $cekTubel = PreTubel::where('no_enroll', '=', $pegawai->no_enroll)
                        ->whereDate('tanggal_awal', '<=', now()->toDateString())
                        ->whereDate('tanggal_akhir', '>=', now()->toDateString())
                        ->where('is_active', '=', 'Y')
                        ->first();
                    if ($cekTubel != null) {
                        $PERSEN_TUBEL = 0.8;

                        $NOMINAL_GAJI_POKOK = $PERSEN_TUBEL * $NOMINAL_GAJI_POKOK;
                        $TUNJANGAN_PASANGAN = $PERSEN_TUBEL * $TUNJANGAN_PASANGAN;
                        $TUNJANGAN_ANAK = $PERSEN_TUBEL * $TUNJANGAN_ANAK;
                        $TUNJANGAN_JABATAN = $PERSEN_TUBEL * $TUNJANGAN_JABATAN;
                        $TUNJANGAN_KINERJA = $PERSEN_TUBEL * $TUNJANGAN_KINERJA;
                        $TUNJANGAN_BERAS = $PERSEN_TUBEL * $TUNJANGAN_BERAS;
                    }

                    //cek aturan persentase tukin, gaji pokok dan tunjangan yg lain
                    $cekAturan = AturanThrGajiplus::where('is_active', 'Y')->first();

                    if ($cekAturan != null) {
                        $TUNJANGAN_KINERJA = ($cekAturan->persentase_tukin / 100) * $TUNJANGAN_KINERJA;

                        $NOMINAL_GAJI_POKOK = ($cekAturan->persentase_lainnya / 100) * $NOMINAL_GAJI_POKOK;
                        $TUNJANGAN_PASANGAN = ($cekAturan->persentase_lainnya / 100) * $TUNJANGAN_PASANGAN;
                        $TUNJANGAN_ANAK = ($cekAturan->persentase_lainnya / 100) * $TUNJANGAN_ANAK;
                        $TUNJANGAN_JABATAN = ($cekAturan->persentase_lainnya / 100) * $TUNJANGAN_JABATAN;
                        $TUNJANGAN_BERAS = ($cekAturan->persentase_lainnya / 100) * $TUNJANGAN_BERAS;
                    }

                    $TOTAL_THR = $NOMINAL_GAJI_POKOK + $TUNJANGAN_PASANGAN + $TUNJANGAN_ANAK + $TUNJANGAN_JABATAN + $TUNJANGAN_KINERJA + $TUNJANGAN_BERAS;

                    //cek ke tabel pegawai_riwayat_umak ada data tidak
                    $cekData = null;

                    $cekData = DB::table('pegawai_riwayat_thr')
                        ->select('*')
                        ->where('pegawai_id', '=', $pegawai->id)
                        ->where('tahun', '=', $periode)
                        ->get();

                    if ($cekData->isNotEmpty()) {
                        //update
                        DB::table('pegawai_riwayat_thr')
                            ->where('pegawai_id', $pegawai->id)
                            ->where('tahun', $periode)
                            ->update([
                                'nominal_gaji_pokok' => $NOMINAL_GAJI_POKOK,
                                'tunjangan_beras' => $TUNJANGAN_BERAS,
                                'tunjangan_pasangan' => $TUNJANGAN_PASANGAN,
                                'tunjangan_anak' => $TUNJANGAN_ANAK,
                                'tunjangan_jabatan' => $TUNJANGAN_JABATAN,
                                'tunjangan_kinerja' => $TUNJANGAN_KINERJA,
                                'total_thr' => $TOTAL_THR,
                                'updated_at' => now(),
                            ]);
                    } else {
                        //insert
                        DB::table('pegawai_riwayat_thr')->insert([
                            'pegawai_id' => $pegawai->id,
                            'tahun' => $periode,
                            'nominal_gaji_pokok' => $NOMINAL_GAJI_POKOK,
                            'tunjangan_beras' => $TUNJANGAN_BERAS,
                            'tunjangan_pasangan' => $TUNJANGAN_PASANGAN,
                            'tunjangan_anak' => $TUNJANGAN_ANAK,
                            'tunjangan_jabatan' => $TUNJANGAN_JABATAN,
                            'tunjangan_kinerja' => $TUNJANGAN_KINERJA,
                            'total_thr' => $TOTAL_THR,
                            'created_at' => now(),
                        ]);
                    }
                }
            } else {
                // session()->flash('message', 'Data pegawai tidak ada untuk memproses kalkulasi uang makan!');
                // return redirect()->back();

                return response()->json(['errors' => 'Data pegawai tidak ada untuk memproses Kalkulasi THR!']);
            }

            DB::commit();
            Log::info('Data THR berhasil di-kalkulasi di method kalkulasi pada PegawaiRiwayatThrController!');

            //session()->flash('success', 'Berhasil kalkulasi uang makan pegawai!');
            //return redirect()->back();
            return response()->json(['success' => 'Berhasil Kalkulasi THR Pegawai!']);


            // return redirect()->route('pegawai-riwayat-umak.index')
            //     ->with('success', 'Data Pegawai Riwayat Uang Makan berhasil di-insert!');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert atau di-update di method kalkulasi pada PegawaiRiwayatThrController!']);

            // session()->flash('message', 'Error saat proses data!');
            // return redirect()->back();

            return response()->json(['errors' => 'Error saat proses data!']);

            // return redirect()->route('pegawai-riwayat-umak.index')
            //         ->with('error', 'Error saat Proses Data Pegawai Riwayat Uang Makan!');
        }
    }

    protected function _tunjangan_pasangan($pegawai, $nominal_gaji_pokok, $pasangan)
    {
        if ($pegawai->jenis_kawin_id == 1 || $pegawai->jenis_kawin_id == 3) {
            if ($pasangan != null) {
                return 0.1 * $nominal_gaji_pokok;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    protected function _tunjangan_anak($nominal_gaji_pokok, $count_anak)
    {
        if ($count_anak >= 2) {
            return 2 * 0.02 * $nominal_gaji_pokok;
        } else if ($count_anak == 1) {
            return 0.02 * $nominal_gaji_pokok;
        } else {
            return 0;
        }
    }

    protected function _tunjangan_jabatan($pegawai, $gaji, $jabatan)
    {
        /**
         *      [ ] jabatan JFU / CPNS -> tabel gaji
         *      [ ] jabatan JFT -> tabel jabatan_fungsional
         *      [ ] jabatan struktural -> tabel jabatan_struktural
         *      [ ] check is_plt -> jika ada
         */
        if ($pegawai->status_pegawai_id == 4) {
            //CPNS
            return $gaji->gaji->nominal_tunjangan_jabatan;
        } else if ($jabatan->jabatan_unit_kerja->jabatan_tukin->jenis_jabatan_id == 2) {
            //JFT
            $nominal = JabatanFungsional::select('nominal_tunjangan')->where('id', $jabatan->jabatan_unit_kerja->jabatan_tukin->jabatan_id)->first();
            return $nominal->nominal_tunjangan;
        } else if ($jabatan->jabatan_unit_kerja->jabatan_tukin->jenis_jabatan_id == 1) {
            //STRUKTURAL
            $nominal = JabatanStruktural::select('nominal_tunjangan')->where('id', $jabatan->jabatan_unit_kerja->jabatan_tukin->jabatan_id)->first();
            return $nominal->nominal_tunjangan;
        } else if ($jabatan->jabatan_unit_kerja->jabatan_tukin->jenis_jabatan_id == 4) {
            //JFU
            return $gaji->gaji->nominal_tunjangan_jabatan;
        }
    }

    protected function _tunjangan_beras($pasangan, $count_anak)
    {
        //$HARGA_BERAS = 72420; // HARUSNYA DIMASUKIN KE DALAM TABEL MASTER HARGA BERAS
        //
        $cekTuber = TunjanganBeras::where('is_active', '=', 'Y')
            ->first();

        $keluarga = 1;
        if ($pasangan != null) {
            $keluarga++;
        }
        if ($count_anak >= 2) {
            $keluarga += 2;
        } else if ($count_anak == 1) {
            $keluarga++;
        }
        //return $keluarga * $HARGA_BERAS;
        return $keluarga * $cekTuber->total;
    }

    //---------------------------------------------------------------------------------------//

    public function exportToExcel($tahun)
    {
        try {
            $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
            $this->authorize('admin_sdmoh', $kabiro);

            $fileName = 'Riwayat_THR_Pegawai' . '_' . $tahun . '.xlsx';

            $unitKerja = null;
            return Excel::download(new DataExportPrt($tahun, $unitKerja), $fileName);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['Export data excel gagal di method exportToExcel pada PegawaiRiwayatThrController!']);
        }
    }

    public function exportToExcelDua($tahun, $unitKerjaId)
    {
        try {
            $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
            $this->authorize('admin_sdmoh', $kabiro);

            $fileName = null;
            if (null != $unitKerjaId || '' != $unitKerjaId) {
                $namaUker = DB::table('unit_kerja')
                    ->select('nama', 'singkatan')
                    ->where('id', '=', $unitKerjaId)
                    ->first();
                $fileName = 'Riwayat_THR_Pegawai_' . $namaUker->singkatan . '_' . $tahun . '.xlsx';
            }

            return Excel::download(new DataExportPrt($tahun, $unitKerjaId), $fileName);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['Export data excel gagal di method exportToExcelDua pada PegawaiRiwayatThrController!']);
        }
    }
}
