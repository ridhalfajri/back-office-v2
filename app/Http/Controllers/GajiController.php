<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\Gaji;

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

        return view('gaji.index', compact('title'));
    }
     
    public function datatable(Gaji $gaji)
    {        
        $data = Gaji::all();

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('aksi', 'gaji.aksi')
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
