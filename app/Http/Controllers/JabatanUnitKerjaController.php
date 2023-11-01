<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\JabatanUnitKerja;

class JabatanUnitKerjaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        $title = 'Jabatan Unit Kerja';

        return view('jabatan-unit-kerja.index', compact('title'));
    }
     
    public function datatable(JabatanUnitKerja $jabatanUnitKerja)
    {        
        $data = JabatanUnitKerja::all();

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('aksi', 'jabatan-unit-kerja.aksi')
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
        $title = 'Jabatan Unit Kerja';

        return view('jabatan-unit-kerja.create', compact('title'));
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
				'jabatan_tukin_id' => 'required',
				'hirarki_unit_kerja_id' => 'required',
        ]);   
            
        $input = [];
			$input['jabatan_tukin_id'] = $request->jabatan_tukin_id;
			$input['hirarki_unit_kerja_id'] = $request->hirarki_unit_kerja_id;
        JabatanUnitKerja::create($input);

        return redirect()->route('jabatan-unit-kerja.index')
        ->with('success', 'Data Jabatan Unit Kerja berhasil disimpan');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function show(JabatanUnitKerja $jabatanUnitKerja)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function edit(JabatanUnitKerja $jabatanUnitKerja)
    {               
        $title = 'Edit Jabatan Unit Kerja';

        return view('jabatan-unit-kerja.edit', compact('title'),'jabatanUnitKerja');
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,JabatanUnitKerja $jabatanUnitKerja)
    {  
        $this->validate($request, [
				'jabatan_tukin_id' => 'required',
				'hirarki_unit_kerja_id' => 'required',
        ]);


			$jabatanUnitKerja->jabatan_tukin_id = $request->jabatan_tukin_id;
			$jabatanUnitKerja->hirarki_unit_kerja_id = $request->hirarki_unit_kerja_id;
        $jabatanUnitKerja->save();

        return redirect()->route('jabatan-unit-kerja.index')
        ->with('success', 'Data Jabatan Unit Kerja berhasil diupdate');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */        
    public function destroy(JabatanUnitKerja $jabatanUnitKerja)
    {           
        $jabatanUnitKerja->delete();
        return redirect()->route('jabatan-unit-kerja.index')
        ->with('success', 'Delete data Jabatan Unit Kerja berhasil');
    }
}
