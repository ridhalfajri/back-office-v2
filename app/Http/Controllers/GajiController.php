<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use App\Models\Gaji;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;

class GajiController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $title = 'Gaji';
        // $data = Gaji::select('gaji.id as id','gaji.masa_kerja as masa_kerja', 'gaji.nominal as nominal', 'golongan.nama as golongan')->join('golongan', 'golongan.id', '=', 'gaji.golongan_id')
        // ->get();
        // dd(($data));

        return view('gaji.index', compact('title'));
    }

    public function datatable()
    {

        //  $data = Gaji::select('gaji.id as id','masa_kerja',  DB::raw("CONCAT('Rp. ', FORMAT(nominal, 0)) AS nominal"), 'golongan.nama as nama')->join('golongan', 'golongan.id', '=', 'gaji.golongan_id');
        $data = Gaji::select('gaji.id as id','masa_kerja', "nominal", 'golongan.nama as nama')->join('golongan', 'golongan.id', '=', 'gaji.golongan_id');

        return Datatables::of($data)
            ->addColumn('no', '')
            // ->addColumn('aksi', '')
            ->addColumn('aksi', function($row) {
                $editButton = '<button class="btn btn-sm btn-icon btn-warning on-default edit-btn" data-id="' . $row->id . '"><i class="fa fa-pencil"></i></button>';
                $deleteButton = '<button class="btn btn-sm btn-icon btn-danger on-default delete-btn" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button>';

                return '<div style="display: inline-block; white-space: nowrap; margin: 0 10px;">' . $editButton . ' ' . $deleteButton . '</div>';
            })
            ->editColumn('masa_kerja', function($row){
                // Format the data as needed here
                return $row->masa_kerja . ' Tahun';
            })
            ->filterColumn('masa_kerja', function ($query, $keyword) {
                $query->whereRaw("CONCAT(masa_kerja,' Tahun') like ?", ["%$keyword%"]);
            })
            ->editColumn('nominal', function($row){
                // Format the data as needed here
                $nom =  (float)$row->nominal;
                return "Rp. ".number_format($nom, 2, ',', ',');
            })
            ->filterColumn('nominal', function ($query, $keyword) {
                $query->whereRaw("CONCAT('Rp. ', FORMAT(nominal, 0)) like ?", ["%$keyword%"]);
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
        $title = 'Gaji';

        return view('gaji.create', compact('title'));
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->validate($request, [
				'golongan_id' => 'required',
				'masa_kerja' => 'required',
				'nominal' => 'required',
        ]);

        $input = [];
			$input['golongan_id'] = $request->golongan_id;
			$input['masa_kerja'] = $request->masa_kerja;
			$input['nominal'] = $request->nominal;
        Gaji::create($input);

        return redirect()->route('gaji.index')
        ->with('success', 'Data Gaji berhasil disimpan');
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
        $title = 'Edit Gaji';

        return view('gaji.edit', compact('title'),'gaji');
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,Gaji $gaji)
    {
        $this->validate($request, [
				'golongan_id' => 'required',
				'masa_kerja' => 'required',
				'nominal' => 'required',
        ]);


			$gaji->golongan_id = $request->golongan_id;
			$gaji->masa_kerja = $request->masa_kerja;
			$gaji->nominal = $request->nominal;
        $gaji->save();

        return redirect()->route('gaji.index')
        ->with('success', 'Data Gaji berhasil diupdate');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function destroy(Gaji $gaji)
    {
        $gaji->delete();
        return redirect()->route('gaji.index')
        ->with('success', 'Delete data Gaji berhasil');
    }
}
