<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\HariLibur;

class HariLiburController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $title = 'List Data Hari Libur';

        return view('hari-libur.index', compact('title'));
    }

    public function datatable(HariLibur $hariLibur)
    {
        $data = HariLibur::all();


        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('aksi', function ($row) {

                $editButton = '<a href="'.route('hari-libur.edit',  $row->id).'" class="btn btn-sm btn-icon btn-warning on-default edit" title="Ubah"><i class="fa fa-pencil text-white"></i></a>';
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
        $title = 'Tambah Data Hari Libur';

        return view('hari-libur.create', compact('title'));
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
				'is_libur' => 'required',
				'keterangan' => 'required',
				'tahun' => 'required',
				'tanggal' => 'required',
            ]);

            $input = [];
			$input['is_libur'] = $request->is_libur;
			$input['keterangan'] = $request->keterangan;
			$input['tahun'] = $request->tahun;
			$input['tanggal'] = $request->tanggal;
            HariLibur::create($input);

            return redirect()->route('hari-libur.index')
            ->with('success', 'Data Hari Libur berhasil disimpan');
        }catch (QueryException $e) {
            $msg = $e->getMessage();
            return redirect()->route('hari-libur.index')
            ->with('error', 'Simpan data Hari Libur gagal, Err: ' . $msg);
        }

    }

    /**
    * Display the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function show(HariLibur $hariLibur)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function edit(HariLibur $hariLibur)
    {
        $title = 'Ubah Data Hari Libur';

        return view('hari-libur.edit', compact('title','hariLibur'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,HariLibur $hariLibur)
    {
        try {
            $this->validate($request, [
				'is_libur' => 'required',
				'keterangan' => 'required',
				'tahun' => 'required',
				'tanggal' => 'required',
            ]);

			$hariLibur->is_libur = $request->is_libur;
			$hariLibur->keterangan = $request->keterangan;
			$hariLibur->tahun = $request->tahun;
			$hariLibur->tanggal = $request->tanggal;
            $hariLibur->save();

            return redirect()->route('hari-libur.index')
            ->with('success', 'Data Hari Libur berhasil diupdate');
        } catch (QueryException $e) {
            $msg = $e->getMessage();
            return redirect()->route('hari-libur.index')
            ->with('error', 'Ubah data Hari Libur gagal, Err: ' . $msg);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param
    * @return \Illuminate\Http\Response
    */
    public function destroy(HariLibur $hariLibur)
    {
        $blnValue = false;
        $msg = "";
        try {
            $hariLibur->delete();
            $msg = "Data berhasil dihapus";
        } catch (QueryException $e) {
            $blnValue = true;
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
