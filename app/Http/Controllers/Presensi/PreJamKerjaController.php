<?php

namespace App\Http\Controllers\Presensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PreJamKerja;
use Yajra\DataTables\Facades\DataTables;

class PreJamKerjaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $title = 'Pengaturan Jam Kerja';

        return view('presensi.pre-jam-kerja.index', compact('title'));
    }

    public function datatable(PreJamKerja $preJamKerja)
    {
        $data = PreJamKerja::all();

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('aksi', function ($row) {

                $editButton = '<a href="'.route('pre-jam-kerja.edit',  $row->id).'" class="btn btn-sm btn-icon btn-warning on-default edit" title="Ubah"><i class="fa fa-pencil text-white"></i></a>';
                $deleteButton = '<button class="btn btn-sm btn-icon btn-danger on-default delete" data-id="' . $row->id . '" title="Hapus"><i class="fa fa-trash"></i></button>';

                return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' . $editButton . ' ' . $deleteButton . '</div>';
            })
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
        $title = 'Tambah Jam Kerja Baru';

        return view('presensi.pre-jam-kerja.create', compact('title'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        try {

            $this->validate($request, [
				'jam_masuk' => 'required',
				'jam_pulang' => 'required',
				'jam_masuk_khusus' => 'required',
				'jam_pulang_khusus' => 'required',
				'waktu_floating' => 'required',
				'is_active' => 'required',
				'keterangan' => 'required',
            ]);

            $input = [];
			$input['jam_masuk'] = $request->jam_masuk;
			$input['jam_pulang'] = $request->jam_pulang;
			$input['jam_masuk_khusus'] = $request->jam_masuk_khusus;
			$input['jam_pulang_khusus'] = $request->jam_pulang_khusus;
			$input['waktu_floating'] = $request->waktu_floating;
			$input['is_active'] = $request->is_active;
			$input['keterangan'] = $request->keterangan;
            $preJamKerja = PreJamKerja::create($input);

            if ($preJamKerja->is_active == 'Y'){
                PreJamKerja::where('id', '<>', $preJamKerja->id)->update(['is_active' => 'N']);
            }

            return redirect()->route('pre-jam-kerja.index')
            ->with('success', 'Data Pre Jam Kerja berhasil disimpan');
        }catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            return redirect()->route('presensi.pre-jam-kerja.index')
            ->with('error', 'Simpan data Pre Jam Kerja gagal, Err: ' . $msg);
        }

    }

    /**
    * Display the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function show(PreJamKerja $preJamKerja)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function edit(PreJamKerja $preJamKerja)
    {
        $title = 'Ubah Data Pre Jam Kerja';

        return view('presensi.pre-jam-kerja.edit', compact('title','preJamKerja'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,PreJamKerja $preJamKerja)
    {
        try {
            $this->validate($request, [
				'jam_masuk' => 'required',
				'jam_pulang' => 'required',
				'jam_masuk_khusus' => 'required',
				'jam_pulang_khusus' => 'required',
				'waktu_floating' => 'required',
				'is_active' => 'required',
				'keterangan' => 'required',
            ]);

			$preJamKerja->jam_masuk = $request->jam_masuk;
			$preJamKerja->jam_pulang = $request->jam_pulang;
			$preJamKerja->jam_masuk_khusus = $request->jam_masuk_khusus;
			$preJamKerja->jam_pulang_khusus = $request->jam_pulang_khusus;
			$preJamKerja->waktu_floating = $request->waktu_floating;
			$preJamKerja->is_active = $request->is_active;
			$preJamKerja->keterangan = $request->keterangan;
            $preJamKerja->save();

            if ($preJamKerja->is_active == 'Y'){
                PreJamKerja::where('id', '<>', $preJamKerja->id)->update(['is_active' => 'N']);
            }

            return redirect()->route('pre-jam-kerja.index')
            ->with('success', 'Data Jam Kerja berhasil diupdate');
        } catch (QueryException $e) {
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            $msg = $e->getMessage();
            return redirect()->route('presensi.pre-jam-kerja.index')
            ->with('error', 'Ubah data Jam Kerja gagal, Err: ' . $msg);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function destroy(PreJamKerja $preJamKerja)
    {
        $blnValue = false;
        $msg = "";
        try {
            $preJamKerja->delete();
            $msg = "Data berhasil dihapus";

            $data = PreJamKerja::where('is_active', '=', 'Y')->get();

            if ($data->count()==0){
                $preJamKerja = PreJamKerja::where('is_active', '=', 'N')->orderBy('id','asc')->first();
                PreJamKerja::where('id', '<>', $preJamKerja->id)->update(['is_active' => 'Y']);
            }

        } catch (QueryException $e) {
            $blnValue = true;
            $msg = 'Error : ' . class_basename(get_class($this)) . ' Method : ' . __FUNCTION__ . ' msg : ' . $e->getMessage();
            Log::error($msg);
            $msg = $e->getMessage();
        }

        $data = [
            'status' => [
                'error' => $blnValue ,
                'message' => $msg, // You can also include an error message
            ],
        ];

        return response()->json($data, 200);
    }
}
