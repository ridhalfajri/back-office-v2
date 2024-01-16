<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\AturanThrGajiplus;
use App\Models\PesanRuangRapat;
use App\Models\RuangRapat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PesanRuangRapatController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        $title = 'Pesan Ruang Rapat';

        $dataRuangRapat = DB::table('ruang_rapat')
        ->select('*')
        ->where('is_active', 'Y')
        ->get();

        return view('pesan-ruang-rapat.index', compact('title', 'dataRuangRapat'));
    }
     
    public function datatable(Request $request)
    {        
        $tanggal = $request->tanggal;
        $ruangRapat = $request->ruangRapat;

        //dd($ruangRapat, $tanggal);

        $data = DB::table('pesan_ruang_rapat as prr')
        ->select('prr.id', 'prr.pegawai_id', 'p.nama_depan', 'p.nama_belakang', 'uk.nama as unit_kerja', 
        'rr.nama as ruang_rapat', 'prr.nama_rapat', 'prr.tanggal', 'prr.waktu_mulai', 'prr.waktu_selesai')
        ->join('ruang_rapat as rr','rr.id','=','prr.ruang_rapat_id')
        ->join('pegawai as p','p.id','=','prr.pegawai_id')
        ->join('pegawai_riwayat_jabatan as prj', function ($join) {
            $join->on('prj.pegawai_id','=','prr.pegawai_id')
                ->where('prj.is_now','=',1)
                ;
        })
        ->join('jabatan_unit_kerja as juk', 'juk.id', '=', 'prj.jabatan_unit_kerja_id')
        ->join('hirarki_unit_kerja as huk', 'huk.id', '=', 'juk.hirarki_unit_kerja_id')
        ->leftJoin('unit_kerja as uk', 'uk.id', '=', 'huk.child_unit_kerja_id')
        //
        //->where('prr.tanggal', '=', $tanggal)
        //->where('prr.ruang_rapat_id', '=', $ruangRapat)
        ->orderBy('uk.id','asc')
        ->orderBy('prr.tanggal','desc')
        ->orderBy('prr.waktu_mulai','asc')
        ;

        if(null != $tanggal || '' != $tanggal){
            $data->where('prr.tanggal', '=', $tanggal);
        }

        if(null != $ruangRapat || '' != $ruangRapat){
            $data->where('prr.ruang_rapat_id', '=', $ruangRapat);
        }

        return Datatables::of($data)
        ->addColumn('no', '')
        ->addColumn('nama_pegawai', function ($data) {
            return $data->nama_depan.' '.$data->nama_belakang;
        })

        ->addColumn('aksi', 'pesan-ruang-rapat.aksi')
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
        $title = 'Buat Pesanan Ruang Rapat';

        $dataRuangRapat = DB::table('ruang_rapat')
        ->select('*')
        ->where('is_active', 'Y')
        ->get();

        return view('pesan-ruang-rapat.create', compact('title', 'dataRuangRapat'));
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

        $this->validate($request, [
            'nama_rapat' => ['required'],
            'ruang_rapat_id' => ['required'],
            'tanggal' => ['required'],
            'waktu_mulai' => ['required'],
            'waktu_selesai' => ['required'],
        ],
        [
            'nama_rapat.required'=>'data nama rapat harus diisi!',
            'ruang_rapat_id.required'=>'data ruang rapat harus diisi!',
            'tanggal.required'=>'data tanggal rapat harus diisi!',
            'waktu_mulai.required'=>'data waktu mulai rapat harus diisi!',
            'waktu_selesai.required'=>'data aktu selesai rapat harus diisi!',
        ]);

        try {
            $waktuMulai = $request->waktu_mulai;
            $waktuSelesai = $request->waktu_selesai;
            //validasi pegawai_id, golongan_id
            $cekDataExist = PesanRuangRapat::where('ruang_rapat_id',$request->nama)
            ->where('tanggal',$request->tanggal)
            ->where(function ($query) use ($waktuMulai, $waktuSelesai) {
                $query->where('waktu_mulai', '<=', $waktuSelesai)
                    ->where('waktu_selesai', '>=', $waktuMulai);
            })
            ->get();

            if($cekDataExist->isNotEmpty()){
                session()->flash('message', 'Pesanan ruang rapat sudah ada!');

                return redirect()->back();
            } else {
                //insert
                $atg = new PesanRuangRapat();
                $atg->pegawai_id = Auth::user()->pegawai_id;
                $atg->nama_rapat = $request->nama_rapat;
                $atg->ruang_rapat_id = $request->ruang_rapat_id;
                $atg->tanggal = $request->tanggal;
                $atg->waktu_mulai = $request->waktu_mulai;
                $atg->waktu_selesai = $request->waktu_selesai;

                $atg->save();

                DB::commit();
                Log::info('Data berhasil di-insert di method store pada PesanRuangRapatController!');

                return redirect()->route('pesan-ruang-rapat.index')
                    ->with('success', 'Data Pesanan Ruang Rapat berhasil disimpan');
            }    
        } catch (\Exception $e) {
            //throw $th;
            DB::rollback();
            Log::error($e->getMessage(), ['Data gagal di-insert di method store pada PesanRuangRapatController!']);

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
    public function destroy(PesanRuangRapat $pesan_ruang_rapat)
    {           
        DB::beginTransaction();
        try {
            $pesan_ruang_rapat->delete();

            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pesanan Ruang Rapat berhasil di hapus!',
                'error' => false,
                'error_message' => ''
            ];

            DB::commit();
            Log::info('Data berhasil di-delete di method destroy pada PesanRuangRapatController!');

            return response()->json($response, 200);
        } catch (\Exception $e) {
            $response['status'] = [
                'code' => 200,
                'message' => 'Data Pesanan Ruang Rapat gagal dibatalkan!',
                'error' => true,
                'error_message' => 'Data Pesanan Ruang Rapat gagal dibatalkan!'
            ];

            Log::error($e->getMessage(), ['Data gagal di-hapus di method destroy pada PesanRuangRapatController!']);
            DB::rollback();

            return response()->json($response, 200);
        }
    }
}
