<?php

namespace App\Http\Controllers;

use App\Models\PegawaiRiwayatJabatan;
use App\Models\PegawaiRiwayatUmak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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
use App\Exports\DataExportPru;

class PegawaiRiwayatUmakController extends Controller
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

        $title = 'Riwayat Uang Makan Pegawai';

        $dataUnitKerja = DB::table('unit_kerja')
            ->select('*')
            ->whereIn('jenis_unit_kerja_id', array(1, 2, 3))
            ->where('is_active','Y')
            ->get();

        return view('perhitungan-umak.pegawai-riwayat-umak', compact('title', 'dataUnitKerja'));
    }

    public function datatable(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $unitKerja = $request->unitKerja;

        //dd($request);

        $data = [];
        if ('' != $bulan && '' != $tahun) {
            $data = PegawaiRiwayatUmak::select(
                'p.nama_depan',
                'p.nama_belakang',
                DB::raw('CONCAT(p.nama_depan," " ,p.nama_belakang) AS nama_pegawai'),
                'p.nip',
                'um.nominal',
                'pegawai_riwayat_umak.jumlah_hari_masuk',
                DB::raw('CONCAT(pegawai_riwayat_umak.jumlah_hari_masuk," ","hari") AS jumlah_hari'),
                'pegawai_riwayat_umak.total',
                'pegawai_riwayat_umak.is_double',
                'pegawai_riwayat_umak.bulan',
                'pegawai_riwayat_umak.tahun',
                'uk.nama as unit_kerja'
            )
                ->join('pegawai as p', 'p.id', '=', 'pegawai_riwayat_umak.pegawai_id')
                //->join('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai_riwayat_umak.pegawai_id')
                ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                    $join->on('prj.pegawai_id', '=', 'pegawai_riwayat_umak.pegawai_id')
                        ->where('prj.is_now', '=', 1)
                        ->where('prj.is_plt', '=', 0);
                })
                ->join('jabatan_unit_kerja as juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
                ->join('hirarki_unit_kerja as huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
                ->leftJoin('unit_kerja as uk', function ($join) {
                    $join->on('uk.id', '=', 'huk.child_unit_kerja_id')
                        ->where('uk.is_active','=','Y')
                        ;
                })
                // ->join('pegawai_riwayat_golongan as prg', function ($join) {
                //     $join->on('prg.pegawai_id', '=', 'p.id')
                //         ->where('prg.is_active', '=', 1);
                // })
                ->leftJoin('uang_makan as um', function ($join) {
                    $join->on('um.id','=','pegawai_riwayat_umak.uang_makan_id')
                        ;
                })
                //
                ->where('pegawai_riwayat_umak.bulan', '=', $bulan)
                ->where('pegawai_riwayat_umak.tahun', '=', $tahun)
                ->orderBy('uk.id', 'asc')
                ->orderBy('p.nama_depan', 'asc');

            if (null != $unitKerja || '' != $unitKerja) {
                $data->where('uk.id', '=', $unitKerja);
            }
        }

        return Datatables::of($data)
            ->addColumn('no', '')
            // ->addColumn('jumlah_hari', function ($data) {
            //     return $data->jumlah_hari_masuk . ' hari';
            // })
            ->filterColumn('jumlah_hari', function ($query, $keyword) {
                $query->whereRaw("CONCAT(pegawai_riwayat_umak.jumlah_hari_masuk,' ','hari') like ?", ["%$keyword%"]);
            })
            // ->addColumn('nama_pegawai', function ($data) {
            //     return $data->nama_depan . ' ' . $data->nama_belakang;
            // })
            ->filterColumn('nama_pegawai', function ($query, $keyword) {
                $query->whereRaw("CONCAT(p.nama_depan,' ',p.nama_belakang) like ?", ["%$keyword%"]);
            })
            ->addColumn('periode', function ($data) {
                if ($data->bulan == '01') {
                    return 'Jan - ' . $data->tahun;
                }
                if ($data->bulan == '02') {
                    return 'Feb - ' . $data->tahun;
                }
                if ($data->bulan == '03') {
                    return 'Mar - ' . $data->tahun;
                }
                if ($data->bulan == '04') {
                    return 'Apr - ' . $data->tahun;
                }
                if ($data->bulan == '05') {
                    return 'Mei - ' . $data->tahun;
                }
                if ($data->bulan == '06') {
                    return 'Jun - ' . $data->tahun;
                }
                if ($data->bulan == '07') {
                    return 'Jul - ' . $data->tahun;
                }
                if ($data->bulan == '08') {
                    return 'Agt - ' . $data->tahun;
                }
                if ($data->bulan == '09') {
                    return 'Sept - ' . $data->tahun;
                }
                if ($data->bulan == '10') {
                    return 'Okt - ' . $data->tahun;
                }
                if ($data->bulan == '11') {
                    return 'Nov - ' . $data->tahun;
                }
                if ($data->bulan == '12' && $data->is_double == 'N') {
                    return 'Des - ' . $data->tahun;
                }
                if ($data->bulan == '12' && $data->is_double == 'Y') {
                    return 'Des (2) - ' . $data->tahun;
                }
            })

            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function kalkulasiUmak(Request $request)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $splitTanggal = explode(" - ", $request->tanggal);
        $tanggalMulaiSplit = $splitTanggal[0];
        $tanggalAkhirSplit = $splitTanggal[1];
        //$waktuPlusSatuBulan = date('m', strtotime($tanggalAkhirSplit . ' +1 month'));

        $tanggalMulaiFormat = Carbon::parse($tanggalMulaiSplit)->translatedFormat('Y-m-d');
        $tanggalAkhirFormat = Carbon::parse($tanggalAkhirSplit)->translatedFormat('Y-m-d');

        //dd($waktuPlusSatuBulan);
        $bulan = Carbon::parse($tanggalAkhirSplit)->translatedFormat('m');

        $bulanKeDb = null;
        if ($bulan == '01') {
            $bulanKeDb = '02';
        }
        if ($bulan == '02') {
            $bulanKeDb = '03';
        }
        if ($bulan == '03') {
            $bulanKeDb = '04';
        }
        if ($bulan == '04') {
            $bulanKeDb = '05';
        }
        if ($bulan == '05') {
            $bulanKeDb = '06';
        }
        if ($bulan == '06') {
            $bulanKeDb = '07';
        }
        if ($bulan == '07') {
            $bulanKeDb = '08';
        }
        if ($bulan == '08') {
            $bulanKeDb = '09';
        }
        if ($bulan == '09') {
            $bulanKeDb = '10';
        }
        if ($bulan == '10') {
            $bulanKeDb = '11';
        }
        if ($bulan == '11') {
            $bulanKeDb = '12';
        }

        //kondisi bulan
        //$bulan = Carbon::parse($waktuPlusSatuBulan)->translatedFormat('m');
        $tahun = Carbon::parse($tanggalAkhirSplit)->translatedFormat('Y');

        //kalo tgl awal dan akhir desember
        $isDouble = 'N';
        if (
            '12' == Carbon::parse($tanggalMulaiSplit)->translatedFormat('m')
            && '12' == Carbon::parse($tanggalAkhirSplit)->translatedFormat('m')
        ) {
            $bulanKeDb = Carbon::parse($tanggalAkhirSplit)->translatedFormat('m'); //'12'
            $isDouble = 'Y';
        }

        DB::beginTransaction();

        try {
            //validasi jika bukan bulan 12 dan 01, tanggal mulai dan tanggal akhir harus sesuai 1 bulan
            //02, 03, 04, 05, 06, 07, 08, 09, 10, 11
            $firstDayOfMonth = date('Y-m-01', strtotime($tanggalMulaiFormat));
            $lastDayOfMonth = date('Y-m-t', strtotime($tanggalMulaiFormat));
            if (
                $bulan == '02' || $bulan == '03' || $bulan == '04' || $bulan == '05' || $bulan == '06'
                || $bulan == '07' || $bulan == '08' || $bulan == '09' || $bulan == '10' || $bulan == '11'
            ) {
                if (($tanggalMulaiFormat != $firstDayOfMonth) || ($tanggalAkhirFormat != $lastDayOfMonth)) {
                    // session()->flash('message', 'Tanggal awal dan tanggal akhir yang dipilih tidak dalam 1 bulan!');
                    // return redirect()->back();

                    return response()->json(['error' => 'Tanggal awal dan tanggal akhir yang dipilih tidak dalam 1 bulan!']);
                }
            }

            //looping data pegawai
            $listPegawai = DB::table('pegawai as p')
                ->select('p.id', 'p.no_enroll')
                ->leftJoin('status_pegawai as sp', function ($join) {
                    $join->on('sp.id', '=', 'p.status_pegawai_id')
                        ->whereIn('sp.nama', array('PNS', 'CPNS'))
                        ->where('sp.is_active','Y')
                        ;
                })
                ->where('status_dinas', 1)
                ->whereIn('jenis_pegawai_id', array(1, 21))
                ->whereNull('tanggal_berhenti')
                ->whereNull('tanggal_wafat')
                //untuk test, data pegawai_riwayat_golongan harus ada!
                //->where('p.id','=',498)
                ->get();

            //cek list ada atau tidak
            if ($listPegawai->isNotEmpty()) {
                $pegawaiId = null;
                $jumlahHariMasuk = null;
                $uangMakanId = null;
                $nominalUangMakan = null;
                $totalUangMakan = null;

                foreach ($listPegawai as $dataPegawai) {
                    //
                    $pegawaiId = $dataPegawai->id;

                    //
                    $jumlahHariMasuk = DB::table('presensi')
                        ->select('tanggal_presensi')
                        ->whereBetween('tanggal_presensi', [$tanggalMulaiFormat, $tanggalAkhirFormat])
                        ->where('no_enroll', '=', $dataPegawai->no_enroll)
                        ->where('status_kehadiran', '=', 'HADIR')
                        // ->where(function($query) {
                        //     $query->whereRaw('jam_masuk != null')
                        //         ->orWhereRaw('jam_pulang != null')
                        //         ->orWhere('jam_pulang','!=','00:00:00')
                        //         ->orWhere('jam_masuk','!=','00:00:00')
                        //         ;
                        // })
                        ->count();

                    //eselon 1
                    $cekEselon1 = DB::table('pegawai_riwayat_jabatan as prj')
                    ->select('prj.*')
                    ->where('prj.pegawai_id', $dataPegawai->id)
                    ->where('prj.is_now', true)
                    ->where('prj.is_plt', false)
                    ->where('prj.tx_tipe_jabatan_id', 1)
                    ->first();

                    if($cekEselon1 != null){
                        $jumlahHariMasuk = DB::table('presensi')
                        ->select('tanggal_presensi')
                        ->whereBetween('tanggal_presensi', [$tanggalMulaiFormat, $tanggalAkhirFormat])
                        ->where('no_enroll', '=', $dataPegawai->no_enroll)
                        ->whereIn('status_kehadiran', ['HADIR', 'ALPHA'])
                        // ->where(function($query) {
                        //     $query->whereRaw('jam_masuk != null')
                        //         ->orWhereRaw('jam_pulang != null')
                        //         ->orWhere('jam_pulang','!=','00:00:00')
                        //         ->orWhere('jam_masuk','!=','00:00:00')
                        //         ;
                        // })
                        ->count();
                    }

                    $umakPegawai = DB::table('uang_makan as um')
                        ->select('um.id', 'um.nominal')
                        ->join('pegawai_riwayat_golongan as prg', function ($join) use ($pegawaiId) {
                            $join->on('prg.golongan_id', '=', 'um.golongan_id')
                                ->where('prg.is_active', '=', 1)
                                ->where('prg.pegawai_id', '=', $pegawaiId);
                        })
                        ->where('um.is_active','Y')
                        ->first();

                    if (null != $umakPegawai) {
                        //
                        $uangMakanId = $umakPegawai->id;
                        $nominalUangMakan = $umakPegawai->nominal;

                        //ada pajak 5%
                        $pajakUmak = ($nominalUangMakan * $jumlahHariMasuk) * 0.05;

                        $totalUangMakan = ($nominalUangMakan * $jumlahHariMasuk) - $pajakUmak;
                    } else {
                        // session()->flash('message', 'Ada pegawai yang datanya belum ada di tabel pegawai_riwayat_golongan!');
                        // return redirect()->back();
                        DB::rollBack();
                        Log::warning('Ada pegawai yang datanya belum ada di tabel pegawai_riwayat_golongan di method kalkulasi pada PegawaiRiwayatUmakController!');

                        return response()->json(['error' => 'Ada pegawai yang datanya belum ada di tabel pegawai_riwayat_golongan!']);
                    }

                    //cek ke tabel pegawai_riwayat_umak ada data tidak
                    $cekDataPru = null;

                    if ($isDouble == 'Y') {
                        $cekDataPru = DB::table('pegawai_riwayat_umak')
                            ->select('*')
                            ->where('pegawai_id', '=', $pegawaiId)
                            ->where('bulan', '=', $bulanKeDb)
                            ->where('tahun', '=', $tahun)
                            ->where('is_double', '=', 'Y')
                            ->get();
                    } else {
                        $cekDataPru = DB::table('pegawai_riwayat_umak')
                            ->select('*')
                            ->where('pegawai_id', '=', $pegawaiId)
                            ->where('bulan', '=', $bulanKeDb)
                            ->where('tahun', '=', $tahun)
                            ->where('is_double', '=', 'N')
                            ->get();
                    }

                    if ($cekDataPru->isNotEmpty()) {
                        if ($isDouble == 'Y') {
                            //update
                            DB::table('pegawai_riwayat_umak')
                                ->where('pegawai_id', $pegawaiId)
                                ->where('bulan', $bulanKeDb)
                                ->where('tahun', $tahun)
                                ->where('is_double', '=', 'Y')
                                ->update([
                                    'uang_makan_id' => $uangMakanId,
                                    'jumlah_hari_masuk' => $jumlahHariMasuk,
                                    'total' => $totalUangMakan,
                                    'updated_at' => now(),
                                ]);
                        } else {
                            //update
                            DB::table('pegawai_riwayat_umak')
                                ->where('pegawai_id', $pegawaiId)
                                ->where('bulan', $bulanKeDb)
                                ->where('tahun', $tahun)
                                ->where('is_double', '=', 'N')
                                ->update([
                                    'uang_makan_id' => $uangMakanId,
                                    'jumlah_hari_masuk' => $jumlahHariMasuk,
                                    'total' => $totalUangMakan,
                                    'updated_at' => now(),
                                ]);
                        }
                    } else {
                        //insert
                        DB::table('pegawai_riwayat_umak')->insert([
                            'pegawai_id' => $pegawaiId,
                            'uang_makan_id' => $uangMakanId,
                            'jumlah_hari_masuk' => $jumlahHariMasuk,
                            'total' => $totalUangMakan,
                            'bulan' => $bulanKeDb,
                            'tahun' => $tahun,
                            'is_double' => $isDouble,
                            'created_at' => now(),
                        ]);
                    }
                }
            } else {
                // session()->flash('message', 'Data pegawai tidak ada untuk memproses kalkulasi uang makan!');
                // return redirect()->back();

                return response()->json(['error' => 'Data pegawai tidak ada untuk memproses kalkulasi uang makan!']);
            }

            DB::commit();
            Log::info('Data uang makan berhasil di-kalkulasi di method kalkulasi pada PegawaiRiwayatUmakController!');

            //session()->flash('success', 'Berhasil kalkulasi uang makan pegawai!');
            //return redirect()->back();
            return response()->json(['success' => 'Berhasil kalkulasi uang makan pegawai']);


            // return redirect()->route('pegawai-riwayat-umak.index')
            //     ->with('success', 'Data Pegawai Riwayat Uang Makan berhasil di-insert!');
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert atau di-update di method kalkulasi pada PegawaiRiwayatUmakController!']);

            // session()->flash('message', 'Error saat proses data!');
            // return redirect()->back();

            return response()->json(['error' => 'Error saat proses data!']);

            // return redirect()->route('pegawai-riwayat-umak.index')
            //         ->with('error', 'Error saat Proses Data Pegawai Riwayat Uang Makan!');
        }
    }

    public function exportToTxt($tgl_awal, $tgl_akhir)
    {
        try {
            //---------------

            // $data = DB::table('pegawai')
            // ->select('pegawai.nip', 'presensi.tanggal_presensi')
            // ->join('presensi', 'pegawai.no_enroll', '=', 'presensi.no_enroll')
            // ->whereBetween('presensi.tanggal_presensi', [$tgl_awal, $tgl_akhir])
            // ->where('presensi.status_kehadiran', 'HADIR')
            // ->orderBy('pegawai.nip', 'asc')
            // ->get();

            $query1 = DB::table('pegawai')
            ->select('pegawai.nip', 'presensi.tanggal_presensi')
            ->leftJoin('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai.id')
            ->join('presensi', 'pegawai.no_enroll', '=', 'presensi.no_enroll')
            ->where('prj.is_now', 1)
            ->where('prj.is_plt', 0)
            ->where('prj.tx_tipe_jabatan_id', '!=', 1)
            ->whereBetween('presensi.tanggal_presensi', ['2024-05-01', '2024-05-31'])
            ->where('presensi.status_kehadiran', 'HADIR');

            //eselon 1
            $query2 = DB::table('pegawai')
            ->select('pegawai.nip', 'presensi.tanggal_presensi')
            ->leftJoin('pegawai_riwayat_jabatan as prj', 'prj.pegawai_id', '=', 'pegawai.id')
            ->join('presensi', 'pegawai.no_enroll', '=', 'presensi.no_enroll')
            ->where('prj.is_now', 1)
            ->where('prj.is_plt', 0)
            ->where('prj.tx_tipe_jabatan_id', 1)
            ->whereBetween('presensi.tanggal_presensi', ['2024-05-01', '2024-05-31'])
            ->whereIn('presensi.status_kehadiran', ['HADIR', 'ALPHA']);

            $data = $query1->union($query2)->get();

            // Tentukan nama file
            $fileName = 'Uang-Makan_'.$tgl_awal.'_sampai_'.$tgl_akhir.'.txt';

            // Buat file temporary
            $filePath = storage_path('app/' . $fileName);

            // Buka file untuk menulis
            $file = fopen($filePath, 'w');

            // Tulis baris header jika diperlukan
            // contoh: fwrite($file, "Header1\tHeader2\tHeader3\n");

            // Tulis data ke file dengan delimiter tab
            foreach ($data as $row) {
                $rowData = implode("\t", get_object_vars($row));
                fwrite($file, $rowData . "\n");
            }

            // Tutup file
            fclose($file);

            // Buat respons untuk mengunduh file
            return Response::download($filePath, $fileName)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['Export data txt gagal di method exportToTxt pada PegawaiRiwayatUmakController!']);
        }
    }

    public function exportToExcel($bulan, $tahun)
    {
        try {
            $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
            $this->authorize('admin_sdmoh', $kabiro);

            $fileName = 'Riwayat_Uang_Makan_Pegawai' . '_' . $tahun . '_' . $bulan . '.xlsx';

            $unitKerja = null;
            return Excel::download(new DataExportPru($bulan, $tahun, $unitKerja), $fileName);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['Export data excel gagal di method exportToExcel pada PegawaiRiwayatUmakController!']);
        }
    }

    public function exportToExcelDua($bulan, $tahun, $unitKerjaId)
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
                $fileName = 'Riwayat_Uang_Makan_Pegawai_' . $namaUker->singkatan . '_' . $tahun . '_' . $bulan . '.xlsx';
            }

            return Excel::download(new DataExportPru($bulan, $tahun, $unitKerjaId), $fileName);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ['Export data excel gagal di method exportToExcelDua pada PegawaiRiwayatUmakController!']);
        }
    }
}
