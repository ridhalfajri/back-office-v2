<?php

namespace App\Http\Controllers;

use App\Models\PegawaiPenilaianKinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\PegawaiRiwayatJabatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

class PegawaiPenilaianKinerjaController extends Controller
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

        $title = 'Penilaian Kinerja Pegawai';

        $dataUnitKerja = DB::table('unit_kerja')
            ->select('*')
            ->whereIn('jenis_unit_kerja_id', array(1, 2, 3))
            ->where('is_active', 'Y')
            ->get();

        return view('pegawai-penilaian-kinerja.index', compact('title', 'dataUnitKerja'));
    }

    public function datatable(Request $request)
    {
        $unitKerja = $request->unitKerja;
        $tahunNilai = $request->tahunNilai;
        $tw = $request->tw;

        $data = DB::table('pegawai_penilaian_kinerja as ppk')
            ->select(
                'ppk.id',
                'p.nama_depan',
                'p.nama_belakang',
                DB::raw('CONCAT(p.nama_depan," " ,p.nama_belakang) AS nama_pegawai'),
                'p.nip',
                'uk.nama as unit_kerja',
                'ppk.tw',
                'ppk.tahun_nilai',
                'ppk.nilai'
            )
            ->join('pegawai as p', 'p.id', '=', 'ppk.pegawai_id')
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id', '=', 'ppk.pegawai_id')
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
            //
            //->where('is_active','=',1)
            ->orderBy('uk.id', 'asc')
            ->orderBy('p.nama_depan', 'asc')
            ->orderBy('ppk.tahun_nilai', 'desc');

        if (null != $unitKerja || '' != $unitKerja) {
            $data->where('uk.id', '=', $unitKerja);
        }

        if (null != $tahunNilai || '' != $tahunNilai) {
            $data->where('ppk.tahun_nilai', '=', $tahunNilai);
        }

        if (null != $tw || '' != $tw) {
            $data->where('ppk.tw', '=', $tw);
        }

        return Datatables::of($data)
            ->addColumn('no', '')
            // ->addColumn('nama_pegawai', function ($data) {
            //     return $data->nama_depan.' '.$data->nama_belakang;
            // })
            ->filterColumn('nama_pegawai', function ($query, $keyword) {
                $query->whereRaw("CONCAT(p.nama_depan,' ',p.nama_belakang) like ?", ["%$keyword%"]);
            })

            ->addColumn('aksi', 'pegawai-penilaian-kinerja.aksi')
            ->rawColumns(['aksi'])

            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Buat Penilaian Kinerja Pegawai';

        //nama pegawai
        $pegawai = DB::table('pegawai as p')
            //->select('p.id', DB::raw('CONCAT(p.nama_depan," ",p.nama_belakang," | ",p.nip," | ") AS nama_pegawai'))
            ->select('p.id', DB::raw('CONCAT(p.nama_depan," ",p.nama_belakang," | ",p.nip," | ",uk.singkatan) AS nama_pegawai'))
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id', '=', 'p.id')
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

            ->orderBy('uk.id', 'asc')
            ->orderBy('p.nama_depan', 'asc')
            ->get();

        $currentYear = Carbon::now()->year;
        $years = range($currentYear, $currentYear - 4);

        return view('pegawai-penilaian-kinerja.create', compact('title', 'pegawai', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate(
            $request,
            [
                'pegawai_id' => ['required'],
                'tgl_nilai' => ['required'],
                'tw' => ['required'],
                'tahun_nilai' => ['required'],
                'nilai' => ['required'],
                'awal_tgl_berlaku' => ['required'],
                'akhir_tgl_berlaku' => ['required'],
                'bukti' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            ],
            [
                'pegawai_id.required' => 'data pegawai harus diisi!',
                'tgl_nilai.required' => 'data tanggal nilai harus diisi!',
                'tw.required' => 'data tw harus diisi!',
                'tahun_nilai.required' => 'data tahun nilai harus diisi!',
                'nilai.required' => 'data nilai harus diisi!',
                'awal_tgl_berlaku.required' => 'data awal tanggal berlaku harus diisi!',
                'akhir_tgl_berlaku.required' => 'data akhir tanggal berlaku harus diisi!',
                'bukti.mimes' => 'format file bukti harus pdf/jpg/jpeg/png!',
                'bukti.max' => 'ukuran file terlalu besar (maksimal file 2Mb)!',
                'bukti.file' => 'upload data harus berupa file!',
            ]
        );

        try {
            //validasi pegawai_id, golongan_id
            $cekDataExist = PegawaiPenilaianKinerja::where('pegawai_id', $request->pegawai_id)
                ->where('tw', $request->tw)
                ->where('tahun_nilai', $request->tahun_nilai)
                ->get();

            if ($cekDataExist->isNotEmpty()) {
                session()->flash('message', 'Data penilaian kinerja sudah ada!');

                return redirect()->back();
            } else {
                //insert
                $ppk = new PegawaiPenilaianKinerja();
                $ppk->pegawai_id = $request->pegawai_id;
                $ppk->tw = $request->tw;
                $ppk->tahun_nilai = $request->tahun_nilai;
                $ppk->nilai = $request->nilai;
                $ppk->tgl_nilai = $request->tgl_nilai;
                $ppk->awal_tgl_berlaku = $request->awal_tgl_berlaku;
                $ppk->akhir_tgl_berlaku = $request->akhir_tgl_berlaku;
                $ppk->save();

                if ($request->bukti) {
                    $ppk->addMediaFromRequest('bukti')->toMediaCollection('bukti');
                }

                DB::commit();
                Log::info('Data berhasil di-insert di method store pada PegawaiPenilaianKinerjaController!');

                return redirect()->route('pegawai-penilaian-kinerja.index')
                    ->with('success', 'Data Penilaian Kinerja berhasil disimpan');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada PegawaiPenilaianKinerjaController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }
    }

    public function edit(PegawaiPenilaianKinerja $pegawai_penilaian_kinerja)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        $title = 'Ubah Penilaian Kinerja Pegawai';

        $ppk = $pegawai_penilaian_kinerja;

        $cek_media = $ppk->getMedia("bukti")->count();
        if ($cek_media) {
            $ppk->bukti = $ppk->getFirstMediaUrl("bukti");
        }

        //nama pegawai
        $pegawai = DB::table('pegawai as p')
            //->select('p.id', DB::raw('CONCAT(p.nama_depan," ",p.nama_belakang," | ",p.nip," | ") AS nama_pegawai'))
            ->select('p.id', DB::raw('CONCAT(p.nama_depan," ",p.nama_belakang," | ",p.nip," | ",uk.singkatan) AS nama_pegawai'))
            ->join('pegawai_riwayat_jabatan as prj', function ($join) {
                $join->on('prj.pegawai_id', '=', 'p.id')
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

            ->orderBy('uk.id', 'asc')
            ->orderBy('p.nama_depan', 'asc')
            ->get();

        $currentYear = Carbon::now()->year;
        $years = range($currentYear, $currentYear - 4);

        return view('pegawai-penilaian-kinerja.edit', compact('title', 'ppk', 'pegawai', 'years'));
    }

    public function update(Request $request, PegawaiPenilaianKinerja $pegawai_penilaian_kinerja)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();

        $this->validate(
            $request,
            [
                'pegawai_id' => ['required'],
                'tgl_nilai' => ['required'],
                'tw' => ['required'],
                'tahun_nilai' => ['required'],
                'nilai' => ['required'],
                'awal_tgl_berlaku' => ['required'],
                'akhir_tgl_berlaku' => ['required'],
                'bukti' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            ],
            [
                'pegawai_id.required' => 'data pegawai harus diisi!',
                'tgl_nilai.required' => 'data tanggal nilai harus diisi!',
                'tw.required' => 'data tw harus diisi!',
                'tahun_nilai.required' => 'data tahun nilai harus diisi!',
                'nilai.required' => 'data nilai harus diisi!',
                'awal_tgl_berlaku.required' => 'data awal tanggal berlaku harus diisi!',
                'akhir_tgl_berlaku.required' => 'data akhir tanggal berlaku harus diisi!',
                'bukti.mimes' => 'format file bukti harus pdf/jpg/jpeg/png!',
                'bukti.max' => 'ukuran file terlalu besar (maksimal file 2Mb)!',
                'bukti.file' => 'upload data harus berupa file!',
            ]
        );

        try {
            //validasi nama
            $cekDataExist = PegawaiPenilaianKinerja::where('pegawai_id', $pegawai_penilaian_kinerja->pegawai_id)
                ->where('tw', $request->tw)
                ->where('tahun_nilai', $request->tahun_nilai)
                ->where('id', '!=', $pegawai_penilaian_kinerja->id)
                ->get();

            if ($cekDataExist->isNotEmpty()) {
                session()->flash('message', 'Data Penilaian Kinerja sudah ada!');

                return redirect()->back();
            } else {
                //update
                //$pegawai_riwayat_golongan->pegawai_id = $request->pegawai_id;
                $pegawai_penilaian_kinerja->tw = $request->tw;
                $pegawai_penilaian_kinerja->tahun_nilai = $request->tahun_nilai;
                $pegawai_penilaian_kinerja->nilai = $request->nilai;
                $pegawai_penilaian_kinerja->tgl_nilai = $request->tgl_nilai;
                $pegawai_penilaian_kinerja->awal_tgl_berlaku = $request->awal_tgl_berlaku;
                $pegawai_penilaian_kinerja->akhir_tgl_berlaku = $request->akhir_tgl_berlaku;
                $pegawai_penilaian_kinerja->update();

                if ($request->file('bukti')) {
                    $pegawai_penilaian_kinerja->clearMediaCollection('bukti');
                    $pegawai_penilaian_kinerja->addMediaFromRequest('bukti')->toMediaCollection('bukti');
                }

                DB::commit();
                Log::info('Data berhasil di-update di method update pada PegawaiPenilaianKinerjaController!');

                return redirect()->route('pegawai-penilaian-kinerja.index')
                    ->with('success', 'Data Penilaian Kinerja berhasil diupdate');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-update di method update pada PegawaiPenilaianKinerjaController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\PegawaiRiwayatGolongan  $bidangProfisiensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PegawaiPenilaianKinerja $pegawai_penilaian_kinerja)
    {
        $kabiro = PegawaiRiwayatJabatan::select('pegawai_id')->where('tx_tipe_jabatan_id', 5)->where('is_now', true)->first();
        $this->authorize('admin_sdmoh', $kabiro);

        DB::beginTransaction();
        try {
            $pegawai_penilaian_kinerja->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Penilaian Kinerja berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PegawaiPenilaianKinerjaController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Penilaian Kinerja gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Penilaian Kinerja gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PegawaiPenilaianKinerjaController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
