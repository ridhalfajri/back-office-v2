<?php

namespace App\Http\Controllers;

use App\Models\HariLibur;
use App\Models\HirarkiUnitKerja;
use App\Models\JenisCuti;
use App\Models\Konfigurasi;
use App\Models\Pegawai;
use App\Models\PegawaiCuti;
use App\Models\PegawaiRiwayatJabatan;
use App\Models\PegawaiSaldoCuti;
use App\Models\PreJamKerja;
use App\Models\Presensi;
use App\Models\StatusCuti;
use App\Models\TxHirarkiPegawai;
use App\Models\UnitKerja;
use Carbon\Carbon;
use DateTime;
use Dflydev\DotAccessData\Data;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use SplFileInfo;
use Yajra\DataTables\Facades\DataTables;

use function Livewire\of;

class CutiController extends Controller
{
    public function pengajuan_cuti()
    {
        $title = 'Pengajuan Cuti';
        $jenis_cuti = JenisCuti::select('id', 'jenis')->get();
        $saldo_cuti = PegawaiSaldoCuti::where('pegawai_id', auth()->user()->pegawai_id)->first();
        $saldo_cuti->total = array_sum([$saldo_cuti->saldo_n, $saldo_cuti->saldo_n_1, $saldo_cuti->saldo_n_2]);
        return view('cuti.pengajuan-cuti', compact('title', 'jenis_cuti', 'saldo_cuti'));
    }
    public function saldo_cuti()
    {
        $saldo_cuti = PegawaiSaldoCuti::where('pegawai_id', auth()->user()->pegawai_id)->first();
        $this->authorize('view', $saldo_cuti);
        $title = 'Saldo Cuti';

        return view('cuti.saldo-cuti', compact('title', 'saldo_cuti'));
    }
    public function cek_hari_libur(Request $request)
    {
        $tanggal_mulai = $request->tanggal_mulai;
        $tanggal_akhir = $request->tanggal_akhir;
        if (date('Y', strtotime($tanggal_mulai)) != date('Y', strtotime($tanggal_akhir))) {
            return response()->json(['errors' => ['tahun' => 'mengajukan cuti tidak boleh lintas tahun']]);
        }
        $weekdays = $this->get_all_weekdays($tanggal_mulai, $tanggal_akhir);
        if ($request->jenis_cuti == 1) {
            if (count($weekdays) > $request->saldo_cuti) {
                return response()->json(['errors' => ['saldo' => 'saldo cuti anda tidak mencukupi']]);
            }
        }
        return response()->json(['success' => ['lama_cuti' => count($weekdays)]]);
    }
    protected function get_all_weekdays($tanggal_mulai, $tanggal_akhir)
    {
        $weekdays = array();

        // Konversi tanggal awal dan akhir ke objek DateTime
        $tanggal_mulai_obj = new DateTime($tanggal_mulai);
        $tanggal_akhir_obj = new DateTime($tanggal_akhir);

        // Iterasi melalui rentang tanggal
        while ($tanggal_mulai_obj <= $tanggal_akhir_obj) {
            //* Periksa apakah tanggal saat ini adalah hari kerja (1: Senin, 7: Minggu)
            $day_of_week = $tanggal_mulai_obj->format('N');
            if ($day_of_week >= 1 && $day_of_week <= 5) {
                $libur = HariLibur::where('is_libur', 1)->where('tahun', $tanggal_mulai_obj->format('Y'))->where('tanggal', $tanggal_mulai_obj->format('Y-m-d'))->count();
                if (!$libur) {
                    $weekdays[] = $tanggal_mulai_obj->format('Y-m-d');
                }
            }

            // Tambahkan 1 hari ke tanggal saat ini
            $tanggal_mulai_obj->modify('+1 day');
        }

        return $weekdays;
    }
    public function store_cuti(Request $request)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'jenis_cuti_id' => ['required', 'exists:jenis_cuti,id'],
                'tanggal_cuti' => ['required'],
                'lama_cuti' => ['required'],
                'no_telepon_cuti' => ['required'],
                'alasan' => ['required'],
                'alamat_cuti' => ['required'],
                'media_pengajuan_cuti' => ['nullable', 'mimes:pdf', 'file', 'max:1024',],
            ],
            [
                'jenis_cuti_id.required' => 'jenis cuti harus diisi',
                'jenis_cuti_id.exists' => 'jenis cuti tidak valid',
                'tanggal_cuti.required' => 'tanggal cuti harus diisi',
                'lama_cuti.required' => 'lama cuti harus diisi',
                'no_telepon_cuti.required' => 'no telepon harus diisi',
                'alasan.required' => 'alasan harus diisi',
                'alamat_cuti.required' => 'alamat harus diisi',
                'media_pengajuan_cuti.mimes' => 'format file ijazah harus pdf',
                'media_pengajuan_cuti.max' => 'ukuran file terlalu besar (maksimal file 1MB)',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            if ($request->jenis_cuti_id == 5) {
                if ($request->keterangan_cuti_p == null) {
                    return response()->json(['errors' => ['keterangan_cuti_p' => 'alasan tidak boleh kosong']]);
                } else {
                    if (($request->keterangan_cuti_p == 'Keluarga Sakit Keras' || $request->keterangan_cuti_p == 'Keluarga Meninggal Dunia') && $request->detail_keterangan_cuti_p == null) {
                        return response()->json(['errors' => ['detail_keterangan_cuti_p' => 'alasan tidak boleh kosong']]);
                    }
                }
            }
            // $saldo = null;
            $split_tanggal = explode(" - ", $request->tanggal_cuti);
            $tanggal_mulai = $split_tanggal[0];
            $tanggal_akhir = $split_tanggal[1];
            // if ($request->jenis_cuti_id == 1) {
            //     $saldo = $this->update_saldo_cuti(auth()->user()->pegawai_id, $request->lama_cuti);
            // }
            $cuti = new PegawaiCuti();
            $cuti->pegawai_id = auth()->user()->pegawai_id;
            $cuti->jenis_cuti_id = $request->jenis_cuti_id;
            $cuti->tanggal_awal_cuti = Carbon::parse($tanggal_mulai)->translatedFormat('Y-m-d');
            $cuti->tanggal_akhir_cuti = Carbon::parse($tanggal_akhir)->translatedFormat('Y-m-d');
            $cuti->lama_cuti = $request->lama_cuti;
            $cuti->no_telepon_cuti = $request->no_telepon_cuti;
            $cuti->alasan = $request->alasan;
            $cuti->alamat_cuti = $request->alamat_cuti;
            $cuti->status_pengajuan_cuti_id = 1;
            if ($request->jenis_cuti_id == 5) {
                $cuti->keterangan_cuti_p = $request->keterangan_cuti_p;
                $cuti->detail_keterangan_cuti_p = $request->detail_keterangan_cuti_p;
            }
            try {
                DB::transaction(function () use ($cuti, $request) {
                    // if ($saldo != null) {
                    //     $saldo->save();
                    // }
                    $cuti->save();
                    if ($request->media_pengajuan_cuti) {
                        $cuti->addMediaFromRequest('media_pengajuan_cuti')->toMediaCollection('media_pengajuan_cuti');
                    }
                });
                return response()->json(['success' => 'Sukses Menambahkan Data']);
            } catch (QueryException $e) {
                return response()->json(['errors' => ['connection' => 'Data gagal disimpan']]);
            }
        }
    }
    public function pengajuan_cuti_edit($id)
    {
        $cuti = PegawaiCuti::where('id', $id)->first();
        $this->authorize('view', $cuti);
        $cek_media = $cuti->getMedia("media_pengajuan_cuti")->count();
        if ($cek_media) {
            $cuti->media_pengajuan_cuti = $cuti->getFirstMediaUrl("media_pengajuan_cuti");
        }

        $tanggal_mulai = Carbon::parse($cuti->tanggal_awal_cuti)->translatedFormat('d-m-Y');
        $tanggal_akhir = Carbon::parse($cuti->tanggal_akhir_cuti)->translatedFormat('d-m-Y');

        $title = 'Edit Pengajuan Cuti';
        $jenis_cuti = JenisCuti::select('id', 'jenis')->get();
        $saldo_cuti = PegawaiSaldoCuti::where('pegawai_id', auth()->user()->pegawai_id)->first();
        $saldo_cuti->total = array_sum([$saldo_cuti->saldo_n, $saldo_cuti->saldo_n_1, $saldo_cuti->saldo_n_2]);
        return view('cuti.pengajuan-cuti-edit', compact('title', 'jenis_cuti', 'saldo_cuti', 'cuti'));
    }
    public function update_cuti(Request $request, $id)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'jenis_cuti_id' => ['required', 'exists:jenis_cuti,id'],
                'tanggal_cuti' => ['required'],
                'lama_cuti' => ['required'],
                'no_telepon_cuti' => ['required'],
                'alasan' => ['required'],
                'alamat_cuti' => ['required'],
                'media_pengajuan_cuti' => ['nullable', 'mimes:pdf', 'file', 'max:1024',],
            ],
            [
                'jenis_cuti_id.required' => 'jenis cuti harus diisi',
                'jenis_cuti_id.exists' => 'jenis cuti tidak valid',
                'tanggal_cuti.required' => 'tanggal cuti harus diisi',
                'lama_cuti.required' => 'lama cuti harus diisi',
                'no_telepon_cuti.required' => 'no telepon harus diisi',
                'alasan.required' => 'alasan harus diisi',
                'alamat_cuti.required' => 'alamat harus diisi',
                'media_pengajuan_cuti.mimes' => 'format file ijazah harus pdf',
                'media_pengajuan_cuti.max' => 'ukuran file terlalu besar (maksimal file 1MB)',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        } else {
            if ($request->jenis_cuti_id == 5) {
                if ($request->keterangan_cuti_p == null) {
                    return response()->json(['errors' => ['keterangan_cuti_p' => 'alasan tidak boleh kosong']]);
                } else {
                    if (($request->keterangan_cuti_p == 'Keluarga Sakit Keras' || $request->keterangan_cuti_p == 'Keluarga Meninggal Dunia') && $request->detail_keterangan_cuti_p == null) {
                        return response()->json(['errors' => ['detail_keterangan_cuti_p' => 'alasan tidak boleh kosong']]);
                    }
                }
            }
            // $update_saldo  = null;
            // $restore_saldo = null;
            $cuti = PegawaiCuti::where('id', $id)->first();
            // if ($cuti->jenis_cuti_id == 1) {
            //     $restore_saldo = $this->restore_saldo_cuti(auth()->user()->pegawai_id, $cuti->lama_cuti);
            // }

            $split_tanggal = explode(" - ", $request->tanggal_cuti);
            $tanggal_mulai = $split_tanggal[0];
            $tanggal_akhir = $split_tanggal[1];

            $cuti->jenis_cuti_id = $request->jenis_cuti_id;
            $cuti->tanggal_awal_cuti = Carbon::parse($tanggal_mulai)->translatedFormat('Y-m-d');
            $cuti->tanggal_akhir_cuti = Carbon::parse($tanggal_akhir)->translatedFormat('Y-m-d');
            $cuti->lama_cuti = $request->lama_cuti;
            $cuti->no_telepon_cuti = $request->no_telepon_cuti;
            $cuti->alasan = $request->alasan;
            $cuti->alamat_cuti = $request->alamat_cuti;
            $cuti->status_pengajuan_cuti_id = 1;
            if ($request->jenis_cuti_id == 5) {
                $cuti->keterangan_cuti_p = $request->keterangan_cuti_p;
                $cuti->detail_keterangan_cuti_p = $request->detail_keterangan_cuti_p;
            } else {
                $cuti->keterangan_cuti_p = null;
                $cuti->detail_keterangan_cuti_p = null;
            }
            try {
                DB::transaction(function () use ($cuti, $request) {
                    // if ($restore_saldo != null) {
                    //     $restore_saldo->save();
                    // }
                    if ($request->jenis_cuti_id == 1) {
                        $update_saldo = $this->update_saldo_cuti(auth()->user()->pegawai_id, $request->lama_cuti);
                    }
                    if ($update_saldo != null) {
                        $update_saldo->save();
                    }
                    $cuti->save();
                    if ($request->file('media_pengajuan_cuti')) {
                        $cuti->clearMediaCollection('media_pengajuan_cuti');
                        $cuti->addMediaFromRequest('media_pengajuan_cuti')->toMediaCollection('media_pengajuan_cuti');
                    }
                });
                return response()->json(['success' => 'Sukses Menambahkan Data']);
            } catch (QueryException $e) {
                return response()->json(['errors' => ['connection' => 'Data gagal disimpan']]);
            }
        }
    }
    protected function update_saldo_cuti($id, $lama_cuti)
    {
        $saldo = PegawaiSaldoCuti::where('pegawai_id', $id)->first();
        $lama_cuti = $lama_cuti;
        //*MENGUBAH NILAI SALDO N-2
        if ($saldo->saldo_n_2 > 0) {
            $lama_cuti = $lama_cuti - $saldo->saldo_n_2;
            if ($lama_cuti < 0) {
                $saldo->saldo_n_2 = $lama_cuti * -1;
            } else if ($lama_cuti >= 0) {
                $saldo->saldo_n_2 = 0;
            }
        }
        //*MENGUBAH NILAI SALDO N-1
        if ($lama_cuti > 0) {
            if ($saldo->saldo_n_1 > 0) {
                $lama_cuti = $lama_cuti - $saldo->saldo_n_1;
                if ($lama_cuti < 0) {
                    $saldo->saldo_n_1 = $lama_cuti * -1;
                } else if ($lama_cuti >= 0) {
                    $saldo->saldo_n_1 = 0;
                }
            }
        }
        //*MENGUBAH NILAI SALDO N-1
        if ($lama_cuti > 0) {
            if ($saldo->saldo_n > 0) {
                $lama_cuti = $lama_cuti - $saldo->saldo_n;
                if ($lama_cuti < 0) {
                    $saldo->saldo_n = $lama_cuti * -1;
                } else if ($lama_cuti >= 0) {
                    $saldo->saldo_n = 0;
                }
            }
        }
        return $saldo;
    }
    protected function restore_saldo_cuti($pegawai_id, $lama_cuti)
    {
        $saldo = PegawaiSaldoCuti::where('pegawai_id', $pegawai_id)->first();
        $lama_cuti = $lama_cuti;
        if ($lama_cuti > 0) {
            $saldo->saldo_n +=  $lama_cuti;
            if ($saldo->saldo_n > 12) {
                $lama_cuti = $saldo->saldo_n - 12;
                $saldo->saldo_n = 12;
            } else {
                $lama_cuti = 0;
            }
            if ($lama_cuti > 0) {
                $saldo->saldo_n_1 += $lama_cuti;
                if ($saldo->saldo_n_1 > 6) {
                    $lama_cuti = $saldo->saldo_n_1 - 6;
                    $saldo->saldo_n_1 = 6;
                } else {
                    $lama_cuti = 0;
                }
                if ($lama_cuti > 0) {
                    $saldo->saldo_n_2 += $lama_cuti;
                    if ($saldo->saldo_n_2 > 6) {
                        $lama_cuti = $saldo->saldo_n_2 - 6;
                        $saldo->saldo_n_2 = 6;
                    }
                }
            }
        }
        return $saldo;
    }
    public function riwayat_cuti()
    {
        $title = 'Riwayat Cuti';
        return view('cuti.riwayat-cuti', compact('title'));
    }
    public function show($id)
    {
        try {
            $cuti = PegawaiCuti::select('pegawai_cuti.id', 'jenis_cuti.jenis', 'keterangan_cuti_p', 'detail_keterangan_cuti_p', 'tanggal_awal_cuti', 'tanggal_akhir_cuti', 'lama_cuti', 'alasan', 'alamat_cuti', 'no_telepon_cuti', 'tanggal_approve_al', 'tanggal_approve_akb', 'tanggal_penolakan_cuti', 'pegawai_cuti.keterangan')
                ->join('jenis_cuti', 'jenis_cuti.id', '=', 'pegawai_cuti.jenis_cuti_id')
                ->where('pegawai_cuti.id', $id)
                ->first();
            $cuti->tanggal_awal_cuti = Carbon::parse($cuti->tanggal_awal_cuti)->translatedFormat('d-m-Y');
            $cuti->tanggal_akhir_cuti = Carbon::parse($cuti->tanggal_akhir_cuti)->translatedFormat('d-m-Y');
            if ($cuti->tanggal_approve_al != null) {
                $cuti->tanggal_approve_al = Carbon::parse($cuti->tanggal_approve_al)->translatedFormat('d-m-Y');
            }
            if ($cuti->tanggal_approve_akb != null) {
                $cuti->tanggal_approve_akb = Carbon::parse($cuti->tanggal_approve_akb)->translatedFormat('d-m-Y');
            }
            if ($cuti->tanggal_penolakan_cuti != null) {
                $cuti->tanggal_penolakan_cuti = Carbon::parse($cuti->tanggal_penolakan_cuti)->translatedFormat('d-m-Y');
            }
            if ($cuti == null) {
                return response()->json(['errors' => ['data' => 'Data tidak ditemukan']]);
            }
            $cek_media = $cuti->getMedia("media_pengajuan_cuti")->count();
            if ($cek_media) {
                $cuti->media_pengajuan_cuti = $cuti->getFirstMediaUrl("media_pengajuan_cuti");
            }
            return response()->json(['result' => $cuti]);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['connection' => 'Terjadi kesalahan koneksi']]);
        }
    }
    public function destroy($id)
    {
        $restore_saldo = null;
        $cuti = PegawaiCuti::where('id', $id)->first();
        $this->authorize('delete', $cuti);
        if ($cuti == null) {
            return response()->json(['errors' => ['connection' => 'Tidak menemukan data yang dihapus']]);
        }
        if ($cuti->jenis_cuti_id == 1) {
            $restore_saldo = $this->restore_saldo_cuti(auth()->user()->pegawai_id, $cuti->lama_cuti);
        }
        try {
            DB::transaction(function () use ($cuti, $restore_saldo) {
                if ($restore_saldo != null) {
                    $restore_saldo->save();
                }
                if ($cuti->hasMedia("media_pengajuan_cuti")) {
                    $cuti->getMedia("media_pengajuan_cuti")[0]->delete();
                }
                $cuti->delete();
            });
            return response()->json(['success' => 'Sukses Mengubah Data']);
        } catch (QueryException $e) {
            return response()->json(['errors' => ['connection' => 'Data gagal dihapus']]);
        }
    }
    public function datatable_riwayat_cuti(Request $request)
    {
        $cuti = PegawaiCuti::select('pegawai_cuti.id', 'jenis_cuti.jenis', 'pegawai_cuti.status_pengajuan_cuti_id', 'status_cuti.status', 'tanggal_awal_cuti', 'tanggal_akhir_cuti', 'lama_cuti', 'pegawai_cuti.created_at AS tanggal_pengajuan')
            ->join('jenis_cuti', 'jenis_cuti.id', '=', 'pegawai_cuti.jenis_cuti_id')
            ->join('status_cuti', 'status_cuti.id', '=', 'pegawai_cuti.status_pengajuan_cuti_id')
            ->where('pegawai_id', auth()->user()->pegawai_id)->orderBy('tanggal_pengajuan', 'DESC');
        return DataTables::of($cuti)
            ->addColumn('no', '')
            ->addColumn('aksi', 'cuti.aksi-pengajuan-cuti')
            ->editColumn('tanggal_awal_cuti', function ($cuti) {
                return $cuti->tanggal_awal_cuti ? with(new Carbon($cuti->tanggal_awal_cuti))->format('d/m/Y') : '';
            })
            ->filterColumn('tanggal_awal_cuti', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_awal_cuti, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->editColumn('tanggal_akhir_cuti', function ($cuti) {
                return $cuti->tanggal_akhir_cuti ? with(new Carbon($cuti->tanggal_akhir_cuti))->format('d/m/Y') : '';
            })
            ->filterColumn('tanggal_akhir_cuti', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_akhir_cuti, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->editColumn('tanggal_pengajuan', function ($cuti) {
                return $cuti->tanggal_pengajuan ? with(new Carbon($cuti->tanggal_pengajuan))->format('d/m/Y') : '';
            })
            ->filterColumn('tanggal_pengajuan', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_pengajuan, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function pengajuan_masuk()
    {
        $atasan_langsung = PegawaiRiwayatJabatan::select('pegawai_id')->whereIn('tx_tipe_jabatan_id', [1, 2, 5])->where('pegawai_id', auth()->user()->pegawai_id)->first();
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

        $status_cuti = StatusCuti::select('id', 'status')->get();
        $title = "Acc Atasan Langsung";
        return view('cuti.pengajuan-masuk', compact('title', 'unit_kerja', 'status_cuti'));
    }

    public function datatable_pengajuan_masuk(Request $request)
    {
        $id_pimpinan = auth()->user()->pegawai_id;
        $pegawai = TxHirarkiPegawai::where('pegawai_pimpinan_id', $id_pimpinan)
            ->select('pegawai_id')
            ->get();
        $cuti = PegawaiCuti::select('pegawai_cuti.id', 'pegawai_cuti.pegawai_id', DB::raw('CONCAT(nama_depan," " ,nama_belakang) AS nama_lengkap'), 'pegawai_cuti.created_at AS tanggal_pengajuan', 'tanggal_awal_cuti', 'juk.hirarki_unit_kerja_id', 'uk.nama AS nama_unit_kerja', 'pegawai.nama_depan', 'pegawai.nama_belakang', 'jenis_cuti.jenis', 'status_cuti.status')
            ->join('pegawai_riwayat_jabatan AS prj', 'prj.pegawai_id', '=', 'pegawai_cuti.pegawai_id')
            ->join('jenis_cuti', 'jenis_cuti.id', '=', 'pegawai_cuti.jenis_cuti_id')
            ->join('pegawai', 'pegawai.id', '=', 'pegawai_cuti.pegawai_id')
            ->join('jabatan_unit_kerja AS juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja AS huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->join('unit_kerja AS uk', 'uk.id', '=', 'huk.child_unit_kerja_id')
            ->join('status_cuti', 'status_cuti.id', '=', 'pegawai_cuti.status_pengajuan_cuti_id')
            ->whereIn('pegawai_cuti.pegawai_id', $pegawai)->where('prj.is_now', 1);
        if ($request->unit_kerja != null) {
            $cuti->where('huk.child_unit_kerja_id', $request->unit_kerja);
        }
        if ($request->status != null) {
            $cuti->where('status_pengajuan_cuti_id', $request->status);
        }
        return DataTables::of($cuti)
            ->addColumn('no', '')
            ->addColumn('aksi', 'cuti.aksi-pengajuan-masuk')
            ->editColumn('tanggal_pengajuan', function ($cuti) {
                return $cuti->tanggal_pengajuan ? with(new Carbon($cuti->tanggal_pengajuan))->format('d/m/Y') : '';
            })
            ->filterColumn('tanggal_pengajuan', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_pengajuan, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })

            ->filterColumn('nama_lengkap', function ($query, $keyword) {
                $query->whereRaw("CONCAT(nama_depan,' ',nama_belakang) like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function detail_pengajuan_masuk($id)
    {
        $atasan_langsung = PegawaiRiwayatJabatan::select('pegawai_id')->whereIn('tx_tipe_jabatan_id', [1, 2, 5])->where('pegawai_id', auth()->user()->pegawai_id)->first();
        $this->authorize('atasan_langsung', $atasan_langsung);
        $cuti = PegawaiCuti::where('id', $id)->first();
        $cuti->tanggal_awal_cuti = Carbon::parse($cuti->tanggal_awal_cuti)->translatedFormat('d-m-Y');
        $cuti->tanggal_akhir_cuti = Carbon::parse($cuti->tanggal_akhir_cuti)->translatedFormat('d-m-Y');
        if ($cuti->tanggal_approve_al != null) {
            $cuti->tanggal_approve_al = Carbon::parse($cuti->tanggal_approve_al)->translatedFormat('d-m-Y');
        }
        if ($cuti->tanggal_approve_akb != null) {
            $cuti->tanggal_approve_akb = Carbon::parse($cuti->tanggal_approve_akb)->translatedFormat('d-m-Y');
        }
        if ($cuti->tanggal_penolakan_cuti != null) {
            $cuti->tanggal_penolakan_cuti = Carbon::parse($cuti->tanggal_penolakan_cuti)->translatedFormat('d-m-Y');
        }
        $cek_media = $cuti->getMedia("media_pengajuan_cuti")->count();
        if ($cek_media) {
            $cuti->media_pengajuan_cuti = $cuti->getFirstMediaUrl("media_pengajuan_cuti");
        }
        $saldo_cuti = PegawaiSaldoCuti::where('pegawai_id', $cuti->pegawai_id)->first();
        $title = 'Detail Pengajuan Cuti';
        return view('cuti.detail-pengajuan-masuk', compact('title', 'cuti', 'saldo_cuti'));
    }

    public function acc_atasan_langsung(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'id' => ['required', 'exists:pegawai_cuti,id'],
                'kode' => ['required'],

            ],
            [
                'id.required' => 'cuti tidak boleh kosong',
                'id.exists' => 'cuti tidak valid',
                'kode.required' => 'kode tidak boleh kosong',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => ['data' => 'terjadi kesalahan harap lakukan refresh halaman']]);
        }
        $cuti = PegawaiCuti::where('id', $request->id)->first();
        if ($cuti == null) {
            return response()->json(['errors' => ['data' => 'terjadi kesalahan harap lakukan refresh halaman']]);
        }
        $atasan_pegawai = TxHirarkiPegawai::select('pegawai_pimpinan_id')->where('pegawai_id', $cuti->pegawai_id)->first();
        if (auth()->user()->pegawai_id != $atasan_pegawai->pegawai_pimpinan_id) {
            return response()->json(['errors' => ['data' => 'Anda tidak memiliki akses']]);
        }
        // $restore_saldo = null;

        // if ($cuti->jenis_cuti_id == 1 && $request->kode == 'Tolak') {
        //     $restore_saldo = $this->restore_saldo_cuti($cuti->pegawai_id, $cuti->lama_cuti);
        // }
        switch ($request->kode) {
            case 'Terima':
                $cuti->atasan_langsung_id = auth()->user()->pegawai_id;
                $cuti->tanggal_approve_al = Carbon::now()->format('Y-m-d');
                $cuti->keterangan = $request->keterangan;
                $cuti->status_pengajuan_cuti_id = 2;
                break;
            case 'Tolak':
                $cuti->atasan_langsung_id = auth()->user()->pegawai_id;
                $cuti->tanggal_penolakan_cuti = Carbon::now()->format('Y-m-d');
                $cuti->keterangan = $request->keterangan;
                $cuti->status_pengajuan_cuti_id = 4;
                break;
        }
        try {
            // if ($restore_saldo != null) {
            //     $restore_saldo->save();
            // }
            $cuti->save();
            return response()->json(['success' => 'cuti berhasil di terima/tolak']);
        } catch (QueryException $qe) {
            return response()->json(['errors' => ['connection' => 'terjadi kesalahan koneksi']]);
        }
    }
    public function pengajuan_masuk_sdmoh()
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', TRUE)->first();
        $this->authorize('spesial_kabiro', $kabiro);
        $unit_kerja = UnitKerja::select('id', 'nama')->limit(22)->get();
        $status_cuti = StatusCuti::select('id', 'status')->get();
        $title = "Acc Atasan Langsung";
        return view('cuti.pengajuan-masuk-sdmoh', compact('title', 'unit_kerja', 'status_cuti'));
    }
    public function datatable_pengajuan_masuk_sdmoh(Request $request)
    {
        $cuti = PegawaiCuti::select('pegawai_cuti.id', 'pegawai_cuti.pegawai_id', DB::raw('CONCAT(nama_depan," " ,nama_belakang) AS nama_lengkap'), 'pegawai_cuti.created_at AS tanggal_pengajuan', 'tanggal_awal_cuti', 'juk.hirarki_unit_kerja_id', 'uk.nama AS nama_unit_kerja', 'pegawai.nama_depan', 'pegawai.nama_belakang', 'jenis_cuti.jenis', 'status_cuti.status')
            ->join('pegawai_riwayat_jabatan AS prj', 'prj.pegawai_id', '=', 'pegawai_cuti.pegawai_id')
            ->join('jenis_cuti', 'jenis_cuti.id', '=', 'pegawai_cuti.jenis_cuti_id')
            ->join('pegawai', 'pegawai.id', '=', 'pegawai_cuti.pegawai_id')
            ->join('jabatan_unit_kerja AS juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
            ->join('hirarki_unit_kerja AS huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
            ->join('unit_kerja AS uk', 'uk.id', '=', 'huk.child_unit_kerja_id')
            ->join('status_cuti', 'status_cuti.id', '=', 'pegawai_cuti.status_pengajuan_cuti_id')
            ->where('prj.is_now', 1);
        if ($request->unit_kerja != null) {
            $cuti->where('huk.child_unit_kerja_id', $request->unit_kerja);
        }
        if ($request->status != null) {
            $cuti->where('status_pengajuan_cuti_id', $request->status);
        }
        return DataTables::of($cuti)
            ->addColumn('no', '')
            ->addColumn('aksi', 'cuti.aksi-pengajuan-masuk-sdmoh')
            ->editColumn('tanggal_pengajuan', function ($cuti) {
                return $cuti->tanggal_pengajuan ? with(new Carbon($cuti->tanggal_pengajuan))->format('d/m/Y') : '';
            })
            ->filterColumn('tanggal_pengajuan', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(tanggal_pengajuan, '%d/%m/%Y') like ?", ["%$keyword%"]);
            })

            ->filterColumn('nama_lengkap', function ($query, $keyword) {
                $query->whereRaw("CONCAT(nama_depan,' ',nama_belakang) like ?", ["%$keyword%"]);
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    public function detail_pengajuan_masuk_sdmoh($id)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', TRUE)->first();
        $this->authorize('spesial_kabiro', $kabiro);

        $cuti = PegawaiCuti::where('id', $id)->first();
        $cuti->tanggal_awal_cuti = Carbon::parse($cuti->tanggal_awal_cuti)->translatedFormat('d-m-Y');
        $cuti->tanggal_akhir_cuti = Carbon::parse($cuti->tanggal_akhir_cuti)->translatedFormat('d-m-Y');
        if ($cuti->tanggal_approve_al != null) {
            $cuti->tanggal_approve_al = Carbon::parse($cuti->tanggal_approve_al)->translatedFormat('d-m-Y');
        }
        if ($cuti->tanggal_approve_akb != null) {
            $cuti->tanggal_approve_akb = Carbon::parse($cuti->tanggal_approve_akb)->translatedFormat('d-m-Y');
        }
        if ($cuti->tanggal_penolakan_cuti != null) {
            $cuti->tanggal_penolakan_cuti = Carbon::parse($cuti->tanggal_penolakan_cuti)->translatedFormat('d-m-Y');
        }
        $cek_media = $cuti->getMedia("media_pengajuan_cuti")->count();
        if ($cek_media) {
            $cuti->media_pengajuan_cuti = $cuti->getFirstMediaUrl("media_pengajuan_cuti");
        }
        $saldo_cuti = PegawaiSaldoCuti::where('pegawai_id', $cuti->pegawai_id)->first();
        $title = 'Detail Pengajuan Cuti';
        return view('cuti.detail-pengajuan-masuk-sdmoh', compact('title', 'cuti', 'saldo_cuti'));
    }
    public function acc_kabiro_sdmoh(Request $request)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'id' => ['required', 'exists:pegawai_cuti,id'],

            ],
            [
                'id.required' => 'cuti tidak boleh kosong',
                'id.exists' => 'cuti tidak valid',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => ['data' => 'terjadi kesalahan harap lakukan refresh halaman']]);
        }
        $konfigurasi = Konfigurasi::where('key', 'tahun_cuti')->select('value')->first();
        $tahun_cuti = $konfigurasi->value;

        $cuti = PegawaiCuti::where('id', $request->id)->first();
        if (date('Y', strtotime($cuti->tanggal_awal_cuti)) != $tahun_cuti) {
            return response()->json(['errors' => ['saldo_cuti' => 'saldo cuti untuk tahun ini belum diupdate, silahkan update saldo cuti terlebih dahulu']]);
        }
        $tanggal_cuti = $this->get_all_weekdays($cuti->tanggal_awal_cuti, $cuti->tanggal_akhir_cuti);
        if ($cuti == null) {
            return response()->json(['errors' => ['data' => 'terjadi kesalahan harap lakukan refresh halaman']]);
        }
        $restore_saldo = null;
        $saldo = null;
        switch ($request->kode) {
            case 'Terima':
                $cuti->kabiro_sdmoh_id = auth()->user()->pegawai_id;
                $cuti->tanggal_approve_akb = Carbon::now()->format('Y-m-d');
                $cuti->status_pengajuan_cuti_id = 3;
                $saldo_cuti = PegawaiSaldoCuti::where('pegawai_id', $cuti->pegawai_id)->first();
                $total_saldo = $saldo_cuti->saldo_n + $saldo_cuti->saldo_n_1 + $saldo_cuti->saldo_n_2;
                if ($total_saldo < $cuti->lama_cuti) {
                    return response()->json(['errors' => ['saldo_cuti' => 'saldo cuti pegawai tidak mencukupi']]);
                }
                if ($cuti->jenis_cuti_id == 1) {
                    $saldo = $this->update_saldo_cuti($cuti->pegawai_id, $cuti->lama_cuti);
                }
                break;
            case 'Tolak':
                $cuti->kabiro_sdmoh_id = auth()->user()->pegawai_id;
                $cuti->tanggal_penolakan_cuti = Carbon::now()->format('Y-m-d');
                $cuti->status_pengajuan_cuti_id = 4;
                if ($cuti->jenis_cuti_id == 1) {
                    $restore_saldo = $this->restore_saldo_cuti($cuti->pegawai_id, $cuti->lama_cuti);
                }
                break;
        }
        // try {
        //* INSERT DATA PRESENSI
        $jam_kerja = PreJamKerja::where('is_active', true)->first();
        $JAM = '00:00:00';
        DB::beginTransaction();
        $cuti->save();
        if ($saldo != null) {
            $saldo->save();
        }
        if ($restore_saldo != null) {
            $restore_saldo->save();
        }
        if ($request->kode == 'Terima') {
            foreach ($tanggal_cuti as $hari) {
                $presensi = Presensi::where('tanggal_presensi', $hari)->where('no_enroll', $cuti->pegawai->no_enroll)->first();
                if ($presensi != null) {
                    $presensi->status_kehadiran = 'CUTI';
                    $presensi->keterangan = $cuti->jenis_cuti->jenis;
                    $presensi->tanggal_update = date('Y-m-d H:i:s');
                } else {
                    $presensi = new Presensi();
                    $presensi->no_enroll = $cuti->pegawai->no_enroll;
                    $presensi->jam_kerja_id = $jam_kerja->id;
                    $presensi->tanggal_presensi = $hari;
                    $presensi->jam_masuk = $JAM;
                    $presensi->jam_pulang = $JAM;
                    $presensi->kekurangan_jam = $JAM;
                    $presensi->is_ijin = 0;
                    $presensi->is_jk_normal = 'Y';
                    $presensi->status_kehadiran = 'CUTI';
                    $presensi->tanggal_update = date('Y-m-d H:i:s');
                    $presensi->keterangan = $cuti->jenis_cuti->jenis;
                    $presensi->nominal_potongan = 0;
                }
                $presensi->save();
            }
        } else {
            foreach ($tanggal_cuti as $hari) {
                $presensi = Presensi::where('tanggal_presensi', $hari)->where('no_enroll', $cuti->pegawai->id)->where('status_kehadiran', 'CUTI')->first();
                if ($presensi != null) {
                    $presensi->delete();
                } else {
                    continue;
                }
            }
        }
        DB::commit();
        return response()->json(['success' => 'cuti berhasil di terima']);
        // } catch (QueryException $qe) {
        // Log::error($qe);
        DB::rollBack();

        return response()->json(['errors' => ['connection' => 'terjadi kesalahan koneksi']]);
        // }
    }

    public function saldo_cuti_pegawai()
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', TRUE)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        $title = 'Saldo Cuti Pegawai';
        $unit_kerja = UnitKerja::select('id', 'nama')->limit(22)->get();
        $konfigurasi = Konfigurasi::where('key', 'tahun_cuti')->select('value')->first();
        $tahun_cuti = $konfigurasi->value != date('Y', strtotime(now()));
        return view('cuti.saldo-cuti-pegawai', compact('title', 'unit_kerja', 'tahun_cuti'));
    }
    public function datatable_saldo_cuti(Request $request)
    {
        $saldo = PegawaiSaldoCuti::select('pegawai_saldo_cuti.*', DB::raw('CONCAT(nama_depan," " ,nama_belakang) AS nama_lengkap'), 'nama_depan', 'nama_belakang')->join('pegawai', 'pegawai_saldo_cuti.pegawai_id', '=', 'pegawai.id')->orderBy('pegawai_saldo_cuti.id', 'ASC');
        return DataTables::of($saldo)
            ->addColumn('no', '')
            ->filterColumn('nama_lengkap', function ($query, $keyword) {
                $query->whereRaw("CONCAT(nama_depan,' ',nama_belakang) like ?", ["%$keyword%"]);
            })
            ->make(true);
    }
    public function  update_all_saldo_cuti(Request $request)
    {
        DB::transaction(function () {
            $pegawai_saldo = PegawaiSaldoCuti::all();
            foreach ($pegawai_saldo as $saldo) {
                $N = Carbon::now()->format('Y');
                $N_1 = $N - 1;
                $N_2 = $N - 2;
                $cuti_n_1 = PegawaiCuti::where('pegawai_id', $saldo->pegawai_id)->whereYear('tanggal_awal_cuti', $N_1)->count();
                $cuti_n_2 = PegawaiCuti::where('pegawai_id', $saldo->pegawai_id)->whereYear('tanggal_awal_cuti', $N_2)->count();
                if (($saldo->saldo_n_1 == 6) && ($cuti_n_1 == 0) && ($cuti_n_2 == 0)) {
                    $saldo_n_2 = 6;
                } else {
                    $saldo_n_2 = 0;
                }
                if ($saldo->saldo_n >= 6) {
                    $saldo_n_1 = 6;
                } else {
                    $saldo_n_1 = $saldo->saldo_n;
                }
                $saldo->saldo_n = 12;
                $saldo->saldo_n_1 = $saldo_n_1;
                $saldo->saldo_n_2 = $saldo_n_2;
                $saldo->save();
            }
            $konfigurasi = Konfigurasi::where('key', 'tahun_cuti')->first();
            $konfigurasi->value = date('Y', strtotime(now()));
            $konfigurasi->save();
        });
        return response()->json(['success' => 'saldo berhasil di update']);
    }
}
