<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\Golongan;
use Illuminate\Database\QueryException;
use Yajra\Datatables\Datatables;

class GajiController extends Controller
{

    public function getGolongan(Request $request)
    {

        try {
            $data = Golongan::select('id', 'nama','nama_pangkat')->orderBy('nama', 'asc')->get();
            echo "<option value=''>-- Pilih Gaji --</option>";
            foreach ($data as $item) {
                if ($request->golongan_id != null && $request->golongan_id == $item->id) {
                    echo "<option value='" . $item->id . "' selected> Gol: " . $item->nama . " | " . $item->nama_pangkat ."</option>";
                } else {
                    echo "<option value='" . $item->id . "'>" . $item->nama . " | " . $item->nama_pangkat ."</option>";
                }
            }
        } catch (QueryException $e) {
            abort(500);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Master Data Gaji';
        // $data = Gaji::select('gaji.id as id','gaji.masa_kerja as masa_kerja', 'gaji.nominal as nominal', 'golongan.nama as golongan')->join('golongan', 'golongan.id', '=', 'gaji.golongan_id')
        // ->get();
        // dd(($data));

        return view('gaji.index', compact('title'));
    }


    public function datatable()
    {

        //  $data = Gaji::select('gaji.id as id','masa_kerja',  DB::raw("CONCAT('Rp. ', FORMAT(nominal, 0)) AS nominal"), 'golongan.nama as nama')->join('golongan', 'golongan.id', '=', 'gaji.golongan_id');
        $data = Gaji::select('gaji.id as id', 'masa_kerja', "nominal", 'golongan.nama as nama','golongan.nama_pangkat as nama_pangkat')->join('golongan', 'golongan.id', '=', 'gaji.golongan_id');

        return Datatables::of($data)
            ->addColumn('no', '')
            // ->addColumn('aksi', '')
            ->addColumn('aksi', function ($row) {

                $editButton = '<a href="'.route('gaji.edit',  $row->id).'" class="btn btn-sm btn-icon btn-warning on-default edit" title="Ubah"><i class="fa fa-edit text-white"></i></a>';
                // $editButton = '<button class="btn btn-sm btn-icon btn-warning on-default edit" data-id="' . $row->id . '"><i class="fa fa-pencil"></i></button>';
                $deleteButton = '<button class="btn btn-sm btn-icon btn-danger on-default delete" data-id="' . $row->id . '" title="Hapus"><i class="fa fa-trash"></i></button>';

                return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' . $editButton . ' ' . $deleteButton . '</div>';
            })
            ->editColumn('masa_kerja', function ($row) {
                // Format the data as needed here
                return $row->masa_kerja . ' Tahun';
            })
            ->filterColumn('masa_kerja', function ($query, $keyword) {
                $query->whereRaw("CONCAT(masa_kerja,' Tahun') like ?", ["%$keyword%"])
                      ->orWhereRaw("masa_kerja LIKE ?", ["%$keyword%"]);
            })
            ->editColumn('nominal', function ($row) {
                // Format the data as needed here
                $nom =  (float)$row->nominal;
                return "Rp. " . number_format($nom, 0, ',', '.');
            })
            ->filterColumn('nominal', function ($query, $keyword) {
                $query->whereRaw("CONCAT('Rp. ', REPLACE(FORMAT(nominal, 0), ',', '.')) like ?", ["%$keyword%"])
                      ->orWhereRaw("nominal LIKE ?", ["%$keyword%"]);
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
        $title = 'Tambah Data Gaji Baru';
        $golongan = Golongan::select('id', 'nama','nama_pangkat')->orderBy('nama', 'asc')->get();
        return view('gaji.create', compact('title','golongan'));
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
                'golongan_id' => 'required|unique:gaji,golongan_id,NULL,id,golongan_id,'.$request->golongan_id.',masa_kerja,'.$request->masa_kerja.',nominal,'.preg_replace('/[^\d]/', '', $request->nominal),
                'masa_kerja' => 'required|min:0',
                'nominal' => 'required|min:1',
            ],[
                'golongan_id.required' => 'Kolom golongan harus diisi.',
                'golongan_id.unique' => 'Golongan, Masa Kerja dan Nominal sudah ada di database.',
                'masa_kerja.required' => 'Kolom masa kerja harus diisi.',
                'nominal.required' => 'Kolom nominal harus diisi.',
                'nominal.min' => 'Jumlah Nominal harus lebih besar dari Nol .',
            ]);


            $input = [];
            $input['golongan_id'] = $request->golongan_id;
            $input['masa_kerja'] = $request->masa_kerja;
            $input["nominal"] = preg_replace('/[^\d]/', '', $request->nominal);
            Gaji::create($input);

            return redirect()->route('gaji.index')
                ->with('success', 'Data Gaji berhasil disimpan');
        }catch (QueryException $e) {
            $msg = $e->getMessage();
            return redirect()->route('gaji.index')
                ->with('error', 'Simpan data Gaji gagal, Error: ' . $msg);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
     * @return \Illuminate\Http\Response
     */
    public function show(Gaji $gaji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Gaji $gaji)
    {
        $title = 'Ubah Data Gaji';
        $golongan = Golongan::select('id', 'nama','nama_pangkat')->orderBy('nama', 'asc')->get();
        return view('gaji.edit', compact('title', 'gaji','golongan'));
    }

    /* Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    *
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Gaji $gaji)
    {
        try {

            $this->validate($request, [
                'golongan_id' => 'required|unique:gaji,golongan_id,'.$request->id.',id,masa_kerja,'.$request->masa_kerja.',nominal,'.preg_replace('/[^\d]/', '', $request->nominal),
                'masa_kerja' => 'required|min:1',
                'nominal' => 'required|min:1',
            ],[
                'golongan_id.required' => 'Kolom golongan harus diisi.',
                'golongan_id.unique' => 'Golongan, Masa Kerja dan Nominal sudah ada di database.',
                'masa_kerja.required' => 'Kolom masa kerja harus diisi.',
                'nominal.required' => 'Kolom nominal harus diisi.',
                'nominal.min' => 'Jumlah Nominal harus lebih besar dari Nol .',
            ]);

            $gaji->golongan_id = $request->golongan_id;
            $gaji->masa_kerja = $request->masa_kerja;
            $gaji->nominal = preg_replace('/[^\d]/', '', $request->nominal);
            $gaji->save();

            return redirect()->route('gaji.index')
                ->with('success', 'Data Gaji berhasil diubah');
        } catch (QueryException $e) {
            $msg = $e->getMessage();
            return redirect()->route('gaji.index')
                ->with('error', 'Ubah data Gaji gagal, Error: ' . $msg);
        }


    }

    /**

     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gaji $gaji)
    {
        $blnValue = false;
        $msg = "";
        try {
            $gaji->delete();
            $msg = "Data berhasil dihapus";
        } catch (QueryException $e) {
            $blnValue = true;
            $msg = $e->getMessage();;
        }


        $data = [
            'status' => [
                'error' => $blnValue ,
                'message' => $msg, // You can also include an error message
            ],
        ];

        return response()->json($data, 200);

    }

    public function get_gaji(Request $request)
    {
        try {
            $gaji = Gaji::select('id', 'masa_kerja', 'golongan_id', 'nominal')->get();
            echo "<option value=''>-- Pilih Gaji --</option>";
            foreach ($gaji as $item) {
                if ($request->gaji_id != null && $request->gaji_id == $item->id) {
                    echo "<option value='" . $item->id . "' selected> Gol: " . $item->golongan->nama . " | " . $item->masa_kerja . " Tahun | RP. " . number_format($item->nominal, 2, ',', '.') . "</option>";
                } else {
                    echo "<option value='" . $item->id . "'>" . $item->golongan->nama . " | " . $item->masa_kerja . " Tahun | Rp. " . number_format($item->nominal, 2, ',', '.') . "</option>";
                }
            }
        } catch (QueryException $e) {
            abort(500);
        }
    }
}
