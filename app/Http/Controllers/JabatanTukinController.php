<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\JabatanTukin;

class JabatanTukinController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        $title = 'Jabatan Tukin';

        return view('jabatan-tukin.index', compact('title'));
    }
     
    public function datatable(JabatanTukin $jabatanTukin)
    {        
        $data = JabatanTukin::all();

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('aksi', 'jabatan-tukin.aksi')
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
        $title = 'Jabatan Tukin';

        return view('jabatan-tukin.create', compact('title'));
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
				'jabatan_id' => 'required',
				'jenis_jabatan_id' => 'required',
				'tukin_id' => 'required',
        ]);   
            
        $input = [];
			$input['jabatan_id'] = $request->jabatan_id;
			$input['jenis_jabatan_id'] = $request->jenis_jabatan_id;
			$input['tukin_id'] = $request->tukin_id;
        JabatanTukin::create($input);

        return redirect()->route('jabatan-tukin.index')
        ->with('success', 'Data Jabatan Tukin berhasil disimpan');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function show(JabatanTukin $jabatanTukin)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function edit(JabatanTukin $jabatanTukin)
    {               
        $title = 'Edit Jabatan Tukin';

        return view('jabatan-tukin.edit', compact('title'),'jabatanTukin');
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,JabatanTukin $jabatanTukin)
    {  
        $this->validate($request, [
				'jabatan_id' => 'required',
				'jenis_jabatan_id' => 'required',
				'tukin_id' => 'required',
        ]);


			$jabatanTukin->jabatan_id = $request->jabatan_id;
			$jabatanTukin->jenis_jabatan_id = $request->jenis_jabatan_id;
			$jabatanTukin->tukin_id = $request->tukin_id;
        $jabatanTukin->save();

        return redirect()->route('jabatan-tukin.index')
        ->with('success', 'Data Jabatan Tukin berhasil diupdate');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */        
    public function destroy(JabatanTukin $jabatanTukin)
    {           
        $jabatanTukin->delete();
        return redirect()->route('jabatan-tukin.index')
        ->with('success', 'Delete data Jabatan Tukin berhasil');
    }
}
