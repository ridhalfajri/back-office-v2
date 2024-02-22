<?php

namespace App\Http\Controllers;

use App\Models\HirarkiUnitKerja;
use App\Models\JenisJabatan;
use App\Models\Pegawai;
use App\Models\PegawaiRiwayatJabatan;
use App\Models\TxHirarkiPegawai;
use App\Models\TxTipeJabatan;
use App\Models\UnitKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PegawaiRiwayatJabatanController extends Controller
{
    public function create($pegawai_id)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', TRUE)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $pegawai = Pegawai::where('id', $pegawai_id)->first();
        $unit_kerja = UnitKerja::select('id', 'nama')->where('is_active', 'Y')->get();
        $jenis_jabatan = JenisJabatan::all();
        $tipe_jabatan = TxTipeJabatan::select('id', 'tipe_jabatan')->get();
        $title = 'Tambah Riwayat Jabatan';
        return view('a-riwayat-jabatan.create', compact('title', 'pegawai', 'unit_kerja', 'jenis_jabatan', 'tipe_jabatan'));
    }

    public function store(Request $request)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', TRUE)->first();
        $this->authorize('admin_sdmoh', $kabiro);
        $validate = Validator::make(
            $request->all(),
            [
                'pegawai_id' => ['required', 'exists:pegawai,id'],
                'jabatan_unit_kerja_id' => ['required'],
                'unit_kerja' => ['required'],
                'no_sk' => ['required'],
                'no_pelantikan' => ['required'],
                'tanggal_sk' => ['required'],
                'tanggal_pelantikan' => ['required'],
                'tmt_jabatan' => ['required'],
                'pejabat_penetap' => ['required'],
                'is_plt' => ['required'],
                'is_now' => ['required'],
                'tx_tipe_jabatan_id' => ['required'],
                'media_sk_jabatan' => ['required'],

            ],
            [
                'id.required' => 'kesalahan memuat halaman',
                'id.exists' => 'kesalahan memuat halaman',
                'jabatan_unit_kerja_id.required' => 'jabatan tidak boleh kosong',
                'unit_kerja.required' => 'Unit kerja tidak boleh kosong',
                'no_sk.required' => 'nomor sk tidak boleh kosong',
                'no_pelantikan.required' => 'nomor pelantikan tidak boleh kosong',
                'tanggal_sk.required' => 'tanggal sk tidak boleh kosong',
                'tanggal_pelantikan.required' => 'tanggal pelantikan tidak boleh kosong',
                'tmt_jabatan.required' => 'tmt jabatan tidak boleh kosong',
                'pejabat_penetap.required' => 'pejabat penetap tidak boleh kosong',
                'is_plt.required' => 'status plt tidak boleh kosong',
                'is_now.required' => 'status jabatan tidak boleh kosong',
                'tx_tipe_jabatan_id.required' => 'tipe jabatan tidak boleh kosong',
                'media_sk_jabatan.required' => 'file sk tidak boleh kosong',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        }
        if (!$request->is_now) {
            $prj_baru = $this->save_pegawai_riwayat_jabatan($request);
            DB::transaction(function () use ($prj_baru, $request) {
                $prj_baru->save();
                if ($request->media_sk_jabatan) {
                    $prj_baru->addMediaFromRequest('media_sk_jabatan')->toMediaCollection('media_sk_jabatan');
                }
            });
        } else {
            $pegawai_bersangkutan = TxHirarkiPegawai::where('pegawai_id', $request->pegawai_id)->first();
            if ($pegawai_bersangkutan == null) {
                $pegawai_bersangkutan = new TxHirarkiPegawai();
                $pegawai_bersangkutan->pegawai_id = $request->pegawai_id;
            }

            if ($request->tx_tipe_jabatan_id == 1) {
                //AMBIL PARENT DARI UNIT KERJA YANG DIINPUT
                $parent_unit_kerja = HirarkiUnitKerja::where('child_unit_kerja_id', $request->unit_kerja)->first();

                // CARI PIMPINAN ID DARI PARENT UNIT KERJA TERSEBUT
                $pimpinan_parent = $this->get_pimpinan(8, $parent_unit_kerja);

                //UPDATE DATA PEGAWAI BERSANGKUTAN
                $pegawai_bersangkutan->pegawai_pimpinan_id = $pimpinan_parent->pegawai_id;
                $pegawai_bersangkutan->unit_kerja_id = $request->unit_kerja;

                //CARI PEGAWAI PIMPINAN LAMA
                $pimpinan_lama = $this->get_pimpinan_lama($request->tx_tipe_jabatan_id, $request->unit_kerja);
                //NON AKTIFKAN JABATAN PIMPINAN LAMA
                $prj_pimpinan_lama = PegawaiRiwayatJabatan::where('id', $pimpinan_lama->id_pegawai_riwayat_jabatan)->first();
                $prj_pimpinan_lama->is_now = FALSE;

                //update PIMPINAN ID SEMUA TIM
                $tim = TxHirarkiPegawai::where('pegawai_pimpinan_id', $pimpinan_lama->pegawai_id);

                //CREATE JABATAN BARU PADA TABEL PEGAWAI RIWAYAT JABATAN
                $prj_baru = $this->save_pegawai_riwayat_jabatan($request);

                //AMBIL PEGAWAI RIWAYAT JABATAN YANG LAMA YANG AKTIF
                if ($request->is_plt) {
                    $jabatan_lama = PegawaiRiwayatJabatan::where('pegawai_id', $pegawai_bersangkutan->pegawai_id)->where('is_now', TRUE)->where('is_plt', TRUE)->first();
                } else {
                    $jabatan_lama = PegawaiRiwayatJabatan::where('pegawai_id', $pegawai_bersangkutan->pegawai_id)->where('is_now', TRUE)->where('is_plt', FALSE)->first();
                }
                //NON AKTIFKAN JABATAN LAMA
                if ($jabatan_lama != null) {
                    $jabatan_lama->is_now = FALSE;
                }

                try {
                    DB::transaction(function () use ($pegawai_bersangkutan, $tim, $prj_pimpinan_lama, $prj_baru, $request, $jabatan_lama) {
                        if ($jabatan_lama != null) {
                            $jabatan_lama->save();
                        }
                        $prj_baru->save();
                        $prj_pimpinan_lama->save();
                        $pegawai_bersangkutan->save();
                        $tim->update(['pegawai_pimpinan_id' => $pegawai_bersangkutan->pegawai_id]);
                        if ($request->media_sk_jabatan) {
                            $prj_baru->addMediaFromRequest('media_sk_jabatan')->toMediaCollection('media_sk_jabatan');
                        }
                    });
                } catch (\Throwable $th) {
                    return response()->json(['errors' => ['connection' => 'data gagal disimpan']]);
                }
            } else if ($request->tx_tipe_jabatan_id == 2 || $request->tx_tipe_jabatan_id == 5) {
                //AMBIL PARENT DARI UNIT KERJA YANG DIINPUT
                $parent_unit_kerja = HirarkiUnitKerja::where('child_unit_kerja_id', $request->unit_kerja)->first();

                //CARI PIMPINAN ID DARI PARENT UNIT KERJA TERSEBUT
                $pimpinan_parent = $this->get_pimpinan(1, $parent_unit_kerja);

                //CARI PEGAWAI PIMPINAN LAMA
                $pimpinan_lama = $this->get_pimpinan_lama($request->tx_tipe_jabatan_id, $request->unit_kerja);

                //NON AKTIFKAN JABATAN PIMPINAN LAMA
                $prj_pimpinan_lama = PegawaiRiwayatJabatan::where('id', $pimpinan_lama->id_pegawai_riwayat_jabatan)->first();
                $prj_pimpinan_lama->is_now = FALSE;

                //UPDATE DATA PEGAWAI BERSANGKUTAN
                $pegawai_bersangkutan->pegawai_pimpinan_id = $pimpinan_parent->pegawai_id;
                $pegawai_bersangkutan->unit_kerja_id = $request->unit_kerja;

                //update PIMPINAN ID SEMUA TIM
                $tim = TxHirarkiPegawai::where('unit_kerja_id', $pegawai_bersangkutan->unit_kerja_id)
                    ->where('pegawai_pimpinan_id', '<>', $pegawai_bersangkutan->pegawai_pimpinan_id);

                //CREATE JABATAN BARU PADA TABEL PEGAWAI RIWAYAT JABATAN
                $prj_baru = $this->save_pegawai_riwayat_jabatan($request);


                //AMBIL PEGAWAI RIWAYAT JABATAN YANG LAMA YANG AKTIF
                if ($request->is_plt) {
                    $jabatan_lama = PegawaiRiwayatJabatan::where('pegawai_id', $pegawai_bersangkutan->pegawai_id)->where('is_now', TRUE)->where('is_plt', TRUE)->first();
                } else {
                    $jabatan_lama = PegawaiRiwayatJabatan::where('pegawai_id', $pegawai_bersangkutan->pegawai_id)->where('is_now', TRUE)->where('is_plt', FALSE)->first();
                }
                //NON AKTIFKAN JABATAN LAMA
                if ($jabatan_lama != NULL) {
                    $jabatan_lama->is_now = FALSE;
                }
                try {
                    DB::transaction(function () use ($pegawai_bersangkutan, $tim, $prj_pimpinan_lama, $prj_baru, $request, $jabatan_lama) {
                        if ($jabatan_lama != NULL) {
                            $jabatan_lama->save();
                        }
                        $prj_baru->save();
                        $prj_pimpinan_lama->save();
                        $pegawai_bersangkutan->save();
                        $tim->update(['pegawai_pimpinan_id' => $pegawai_bersangkutan->pegawai_id]);
                        if ($request->media_sk_jabatan) {
                            $prj_baru->addMediaFromRequest('media_sk_jabatan')->toMediaCollection('media_sk_jabatan');
                        }
                    });
                } catch (\Throwable $th) {
                    return response()->json(['errors' => ['connection' => 'data gagal disimpan']]);
                }
            } else if ($request->tx_tipe_jabatan_id == 6 || $request->tx_tipe_jabatan_id == 7) {
                if ($request->unit_kerja == 9 || $request->tx_tipe_jabatan_id == 7) {
                    $pimpinan = $this->get_pimpinan_lama(5, $request->unit_kerja);
                } else {
                    $pimpinan = $this->get_pimpinan_lama(2, $request->unit_kerja);
                }

                if ($pimpinan == null) {
                    return response()->json(['errors' => ['data_pimpinan' => 'unit kerja belum mempunyai pimpinan, silahkan mengisi pimpinan terlebih dahulu']]);
                }

                //CREATE JABATAN BARU PADA TABEL PEGAWAI RIWAYAT JABATAN
                $prj_baru = $this->save_pegawai_riwayat_jabatan($request);


                $pegawai_bersangkutan->pegawai_pimpinan_id = $pimpinan->pegawai_id;
                $pegawai_bersangkutan->unit_kerja_id = $request->unit_kerja;

                $jabatan_lama = PegawaiRiwayatJabatan::where('pegawai_id', $pegawai_bersangkutan->pegawai_id)->where('is_now', TRUE)->first();
                if ($jabatan_lama != null) {
                    $jabatan_lama->is_now = FALSE;
                }
                try {
                    DB::transaction(function () use ($pegawai_bersangkutan, $prj_baru, $request, $jabatan_lama) {
                        if ($jabatan_lama != null) {
                            $jabatan_lama->save();
                        }
                        $prj_baru->save();
                        $pegawai_bersangkutan->save();
                        if ($request->media_sk_jabatan) {
                            $prj_baru->addMediaFromRequest('media_sk_jabatan')->toMediaCollection('media_sk_jabatan');
                        }
                    });
                } catch (\Throwable $th) {
                    return response()->json(['errors' => ['connection' => 'data gagal disimpan']]);
                }
            }
        }
    }
    protected function save_pegawai_riwayat_jabatan($request)
    {
        $prj_baru = new PegawaiRiwayatJabatan();
        $prj_baru->pegawai_id = $request->pegawai_id;
        $prj_baru->jabatan_unit_kerja_id = $request->jabatan_unit_kerja_id;
        $prj_baru->no_sk = $request->no_sk;
        $prj_baru->no_pelantikan = $request->no_pelantikan;
        $prj_baru->tanggal_sk = $request->tanggal_sk;
        $prj_baru->tanggal_pelantikan = $request->tanggal_pelantikan;
        $prj_baru->tmt_jabatan = $request->tmt_jabatan;
        $prj_baru->pejabat_penetap = $request->pejabat_penetap;
        $prj_baru->is_plt = $request->is_plt;
        $prj_baru->is_now = $request->is_now;
        $prj_baru->tx_tipe_jabatan_id = $request->tx_tipe_jabatan_id;
        return $prj_baru;
    }
    protected function get_pimpinan($tx_tipe_jabatan_id, $parent_unit_kerja)
    {
        $pimpinan_parent = PegawaiRiwayatJabatan::select('pegawai_riwayat_jabatan.pegawai_id')
            ->join('jabatan_unit_kerja', 'pegawai_riwayat_jabatan.jabatan_unit_kerja_id', '=', 'jabatan_unit_kerja.id')
            ->join('hirarki_unit_kerja', 'hirarki_unit_kerja.id', '=', 'jabatan_unit_kerja.hirarki_unit_kerja_id')
            ->where('is_now', TRUE)
            ->where('tx_tipe_jabatan_id', $tx_tipe_jabatan_id)
            ->where('child_unit_kerja_id', $parent_unit_kerja->parent_unit_kerja_id)->first();
        return $pimpinan_parent;
    }
    protected function get_pimpinan_lama($tx_tipe_jabatan_id, $unit_kerja_id)
    {
        $pimpinan_lama = PegawaiRiwayatJabatan::select('pegawai_riwayat_jabatan.pegawai_id', 'pegawai_riwayat_jabatan.id AS id_pegawai_riwayat_jabatan')
            ->join('jabatan_unit_kerja', 'pegawai_riwayat_jabatan.jabatan_unit_kerja_id', '=', 'jabatan_unit_kerja.id')
            ->join('hirarki_unit_kerja', 'hirarki_unit_kerja.id', '=', 'jabatan_unit_kerja.hirarki_unit_kerja_id')
            ->where('is_now', TRUE)
            ->where('tx_tipe_jabatan_id', $tx_tipe_jabatan_id)
            ->where('child_unit_kerja_id', $unit_kerja_id)->first();
        return $pimpinan_lama;
    }

    protected function get_jabatan_unit_kerja(Request $request)
    {
        $data = DB::table('jabatan_unit_kerja AS x')
            ->select('x.id', 'x.jabatan_tukin_id', 'z.jenis_jabatan', 'z.jenis_jabatan_id as jenis_jabatan_id', 'z.nama_jabatan', 'y.nama_unit_kerja', 'x.hirarki_unit_kerja_id', 'y.child_unit_kerja_id', 'y.parent_unit_kerja_id', 'y.nama_parent_unit_kerja')
            ->joinSub(function ($query) {
                $query->select('a.id', 'a.child_unit_kerja_id', 'a.parent_unit_kerja_id', 'b.nama AS nama_unit_kerja', 'c.nama_jenis_unit_kerja', 'c.nama_parent_unit_kerja')
                    ->from('hirarki_unit_kerja AS a')
                    ->join('unit_kerja AS b', 'a.child_unit_kerja_id', '=', 'b.id')
                    ->joinSub(function ($query) {
                        $query->select('a.id', 'a.child_unit_kerja_id', 'a.parent_unit_kerja_id', 'c.nama AS nama_jenis_unit_kerja', 'b.nama AS nama_parent_unit_kerja')
                            ->from('hirarki_unit_kerja AS a')
                            ->join('unit_kerja AS b', 'a.parent_unit_kerja_id', '=', 'b.id')
                            ->join('jenis_unit_kerja AS c', 'c.id', '=', 'b.jenis_unit_kerja_id');
                    }, 'c', 'a.id', '=', 'c.id');
            }, 'y', 'x.hirarki_unit_kerja_id', '=', 'y.id')
            ->joinSub(function ($query) {
                $query->select('a.id', 'a.jabatan_id', 'a.jenis_jabatan_id', 'b.nama AS jenis_jabatan', 'c.grade', 'c.nominal')
                    ->addSelect(DB::raw('
                            CASE
                                WHEN a.jenis_jabatan_id = 1 THEN d.nama
                                WHEN a.jenis_jabatan_id = 2 THEN e.nama
                                WHEN a.jenis_jabatan_id = 4 THEN f.nama
                                ELSE NULL
                            END AS nama_jabatan
                        '))
                    ->from('jabatan_tukin AS a')
                    ->join('jenis_jabatan AS b', 'a.jenis_jabatan_id', '=', 'b.id')
                    ->join('tukin AS c', 'a.tukin_id', '=', 'c.id')
                    ->leftJoin('jabatan_struktural AS d', 'd.id', '=', 'a.jabatan_id')
                    ->leftJoin('jabatan_fungsional AS e', 'e.id', '=', 'a.jabatan_id')
                    ->leftJoin('jabatan_fungsional_umum AS f', 'f.id', '=', 'a.jabatan_id');
            }, 'z', 'x.jabatan_tukin_id', '=', 'z.id');
        if ($request->unit_kerja != null) {
            $data->where('y.child_unit_kerja_id', $request->unit_kerja);
        }
        if ($request->jenis_jabatan != null) {
            $data->where('z.jenis_jabatan_id', $request->jenis_jabatan);
        }
        if ($request->unit_kerja == null || $request->jenis_jabatan == null) {
            echo "<option value=''>-- Pilih Jabatan Unit Kerja --</option>";
        } else {
            $jabatan_unit_kerja = $data->get();
            echo "<option value=''>-- Pilih Jabatan Unit Kerja --</option>";
            foreach ($jabatan_unit_kerja as $item) {
                if ($request->jabatan_unit_kerja_id != null && $request->jabatan_unit_kerja_id == $item->id) {
                    echo "<option value='" . $item->id . "' selected>" . $item->nama_jabatan . "</option>";
                } else {
                    echo "<option value='" . $item->id . "'>" . $item->nama_jabatan . "</option>";
                }
            }
        }
    }
    public function edit($pegawai_riwayat_jabatan_id)
    {

        $prj = DB::table('jabatan_unit_kerja AS x')
            ->select(
                'x.id',
                'x.jabatan_tukin_id',
                'z.jenis_jabatan',
                'z.jenis_jabatan_id as jenis_jabatan_id',
                'z.nama_jabatan',
                'y.nama_unit_kerja',
                'x.hirarki_unit_kerja_id',
                'y.child_unit_kerja_id',
                'y.parent_unit_kerja_id',
                'y.nama_parent_unit_kerja',
                'pegawai.nama_depan',
                'pegawai.nama_belakang',
                'pegawai.nip',
                'tj.tipe_jabatan',
                'prj.id AS prj_id',
                'prj.no_sk',
                'prj.no_pelantikan',
                'prj.tanggal_sk',
                'prj.tanggal_pelantikan',
                'prj.tmt_jabatan',
                'prj.pejabat_penetap',
                'prj.is_plt',
                'prj.is_now',
                'prj.tx_tipe_jabatan_id',

            )
            ->joinSub(function ($query) {
                $query->select('a.id', 'a.child_unit_kerja_id', 'a.parent_unit_kerja_id', 'b.nama AS nama_unit_kerja', 'c.nama_jenis_unit_kerja', 'c.nama_parent_unit_kerja')
                    ->from('hirarki_unit_kerja AS a')
                    ->join('unit_kerja AS b', 'a.child_unit_kerja_id', '=', 'b.id')
                    ->joinSub(function ($query) {
                        $query->select('a.id', 'a.child_unit_kerja_id', 'a.parent_unit_kerja_id', 'c.nama AS nama_jenis_unit_kerja', 'b.nama AS nama_parent_unit_kerja')
                            ->from('hirarki_unit_kerja AS a')
                            ->join('unit_kerja AS b', 'a.parent_unit_kerja_id', '=', 'b.id')
                            ->join('jenis_unit_kerja AS c', 'c.id', '=', 'b.jenis_unit_kerja_id');
                    }, 'c', 'a.id', '=', 'c.id');
            }, 'y', 'x.hirarki_unit_kerja_id', '=', 'y.id')
            ->joinSub(function ($query) {
                $query->select('a.id', 'a.jabatan_id', 'a.jenis_jabatan_id', 'b.nama AS jenis_jabatan', 'c.grade', 'c.nominal')
                    ->addSelect(DB::raw('
                            CASE
                                WHEN a.jenis_jabatan_id = 1 THEN d.nama
                                WHEN a.jenis_jabatan_id = 2 THEN e.nama
                                WHEN a.jenis_jabatan_id = 4 THEN f.nama
                                ELSE NULL
                            END AS nama_jabatan
                        '))
                    ->from('jabatan_tukin AS a')
                    ->join('jenis_jabatan AS b', 'a.jenis_jabatan_id', '=', 'b.id')
                    ->join('tukin AS c', 'a.tukin_id', '=', 'c.id')
                    ->leftJoin('jabatan_struktural AS d', 'd.id', '=', 'a.jabatan_id')
                    ->leftJoin('jabatan_fungsional AS e', 'e.id', '=', 'a.jabatan_id')
                    ->leftJoin('jabatan_fungsional_umum AS f', 'f.id', '=', 'a.jabatan_id');
            }, 'z', 'x.jabatan_tukin_id', '=', 'z.id')
            ->join('pegawai_riwayat_jabatan AS prj', 'prj.jabatan_unit_kerja_id', '=', 'x.id')
            ->join('pegawai', 'prj.pegawai_id', '=', 'pegawai.id')
            ->join('tx_tipe_jabatan AS tj', 'prj.tx_tipe_jabatan_id', '=', 'tj.id')
            ->where('prj.id', $pegawai_riwayat_jabatan_id)->first();
        $unit_kerja = UnitKerja::select('id', 'nama')->limit(22)->get();
        $jenis_jabatan = JenisJabatan::all();
        $tipe_jabatan = TxTipeJabatan::select('id', 'tipe_jabatan')->get();
        $title = 'Tambah Riwayat Jabatan';
        return view('a-riwayat-jabatan.edit', compact('title', 'prj'));
    }
    public function update(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'no_sk' => ['required'],
                'no_pelantikan' => ['required'],
                'tanggal_sk' => ['required'],
                'tanggal_pelantikan' => ['required'],
                'tmt_jabatan' => ['required'],
                'pejabat_penetap' => ['required'],
                'is_now' => ['required'],

            ],
            [
                'no_sk.required' => 'nomor sk tidak boleh kosong',
                'no_pelantikan.required' => 'nomor pelantikan tidak boleh kosong',
                'tanggal_sk.required' => 'tanggal sk tidak boleh kosong',
                'tanggal_pelantikan.required' => 'tanggal pelantikan tidak boleh kosong',
                'tmt_jabatan.required' => 'tmt jabatan tidak boleh kosong',
                'pejabat_penetap.required' => 'pejabat penetap tidak boleh kosong',
                'is_now.required' => 'status jabatan tidak boleh kosong',
            ]
        );
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()]);
        }
        $prj_baru = PegawaiRiwayatJabatan::where('id', $request->pegawai_riwayat_jabatan_id)->first();
        $prj_baru->no_sk = $request->no_sk;
        $prj_baru->no_pelantikan = $request->no_pelantikan;
        $prj_baru->tanggal_sk = $request->tanggal_sk;
        $prj_baru->tanggal_pelantikan = $request->tanggal_pelantikan;
        $prj_baru->tmt_jabatan = $request->tmt_jabatan;
        $prj_baru->pejabat_penetap = $request->pejabat_penetap;

        DB::transaction(function () use ($prj_baru, $request) {
            $prj_baru->save();
            if ($request->file('media_sk_jabatan')) {
                $prj_baru->clearMediaCollection('media_sk_jabatan');
                $prj_baru->addMediaFromRequest('media_sk_jabatan')->toMediaCollection('media_sk_jabatan');
            }
        });
    }
}
