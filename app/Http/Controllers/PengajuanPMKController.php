<?php

namespace App\Http\Controllers;

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

class PengajuanPMKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pengajuan Peninjauan Masa Kerja';

        return view('pengajuan-pmk.index', compact('title'));
    }

    public function datatable(Request $request)
    {
        $data = PegawaiTambahanMk::select('*')
            ->where('pegawai_id', '=', Auth::user()->pegawai_id);

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    return 'Pengajuan';
                }
                if ($data->status == 2) {
                    return 'Dibatalkan';
                }
                if ($data->status == 3) {
                    return 'Disetujui';
                }
            })

            // ->addColumn('file_pengajuan_pmk', function ($data) {
            //     $cek_media = $data->getMedia("file_pengajuan_pmk")->count();
            //     dd($cek_media);
            //     if ($cek_media) {
            //         $data->file_pengajuan_pmk = $data->getMedia("file_pengajuan_pmk")[0]->getUrl();
            //         return $data->file_pengajuan_pmk;
            //     } else {
            //         return null;
            //     }
            // })

            ->addColumn('aksi', 'pengajuan-pmk.aksi')
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
        $title = 'Buat Pengajuan Peninjauan Masa Kerja';

        return view('pengajuan-pmk.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $this->validate(
            $request,
            [
                'tahun_plus_pengajuan' => ['required'],
                'bulan_plus_pengajuan' => ['required'],
                'tipe_pengalaman' => ['required'],
                'file_pengajuan_pmk' => ['required', 'file', 'mimes:rar,zip', 'max:51200'],
            ],
            [
                'tahun_plus_pengajuan.required' => 'data tahun plus pengajuan harus diisi!',
                'bulan_plus_pengajuan.required' => 'data bulan plus pengajuan harus diisi!',
                'tipe_pengalaman.required' => 'data tipe pmk harus diisi!',
                'file_pengajuan_pmk.mimes' => 'format file sk harus rar/zip!',
                'file_pengajuan_pmk.max' => 'ukuran file terlalu besar (maksimal file 50Mb)!',
                'file_pengajuan_pmk.file' => 'upload data harus berupa file!',
            ]
        );

        try {
            //validasi pegawai_id, golongan_id
            $cekDataExist = PegawaiTambahanMk::where('pegawai_id', Auth::user()->pegawai_id)
                ->whereIn('status', array(1, 3))
                ->get();

            if ($cekDataExist->isNotEmpty()) {
                session()->flash('message', 'Data pengajuan pmk sudah ada!');

                return redirect()->back();
            } else {
                //insert
                $ptm = new PegawaiTambahanMk();
                $ptm->pegawai_id = Auth::user()->pegawai_id;

                $ptm->tahun_plus_pengajuan = $request->tahun_plus_pengajuan;
                $ptm->bulan_plus_pengajuan = $request->bulan_plus_pengajuan;
                $ptm->tipe_pengalaman = $request->tipe_pengalaman;
                $ptm->status = 1;
                $ptm->keterangan = $request->keterangan;

                $ptm->save();

                if ($request->file_pengajuan_pmk) {
                    $ptm->addMediaFromRequest('file_pengajuan_pmk')->toMediaCollection('file_pengajuan_pmk');
                }

                DB::commit();
                Log::info('Data berhasil di-insert di method store pada PengajuanPMKController!');

                return redirect()->route('pengajuan-pmk.index')
                    ->with('success', 'Data Pengajuan PMK berhasil disimpan');
            }
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada PengajuanPMKController!']);

            session()->flash('message', 'Error saat proses data!');

            // return redirect()->route('uang-makan.create');
            return redirect()->back();
        }
    }

    public function show(PegawaiTambahanMk $pengajuan_pmk)
    {
        $title = 'Lihat File';

        $pmk = $pengajuan_pmk;

        $cek_media = $pmk->getMedia("file_sk_pmk")->count();
        if ($cek_media) {
            $pmk->file_sk_pmk = $pmk->getFirstMediaUrl("file_sk_pmk");
        }

        $cek_media = $pmk->getMedia("file_pengajuan_pmk")->count();
        if ($cek_media) {
            $pmk->file_pengajuan_pmk = $pmk->getFirstMediaUrl("file_pengajuan_pmk");
        }

        return view('pengajuan-pmk.show', compact('title', 'pmk'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\PegawaiTambahanMk  $bidangProfisiensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PegawaiTambahanMk $pengajuan_pmk)
    {
        DB::beginTransaction();
        try {
            $pengajuan_pmk->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan PMK berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PengajuanPMKController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pengajuan PMK gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Pengajuan PMK gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PengajuanPMKController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
