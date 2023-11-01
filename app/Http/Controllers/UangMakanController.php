<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\UangMakan;

class UangMakanController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        $title = 'Uang Makan';

        return view('uang-makan.index', compact('title'));
    }
     
    public function datatable(UangMakan $uangMakan)
    {        
        $data = UangMakan::all();

        return Datatables::of($data)
            ->addColumn('no', '')
            ->addColumn('aksi', 'uang-makan.aksi')
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
        $title = 'Uang Makan';

        return view('uang-makan.create', compact('title'));
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
				'nominal' => 'required',
        ]);   
            
        $input = [];
			$input['golongan_id'] = $request->golongan_id;
			$input['nominal'] = $request->nominal;
        UangMakan::create($input);

        return redirect()->route('uang-makan.index')
        ->with('success', 'Data Uang Makan berhasil disimpan');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function show(UangMakan $uangMakan)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function edit(UangMakan $uangMakan)
    {               
        $title = 'Edit Uang Makan';

        return view('uang-makan.edit', compact('title'),'uangMakan');
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,UangMakan $uangMakan)
    {  
        $this->validate($request, [
				'golongan_id' => 'required',
				'nominal' => 'required',
        ]);


			$uangMakan->golongan_id = $request->golongan_id;
			$uangMakan->nominal = $request->nominal;
        $uangMakan->save();

        return redirect()->route('uang-makan.index')
        ->with('success', 'Data Uang Makan berhasil diupdate');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Models\BidangProfisiensi  $bidangProfisiensi
    * @return \Illuminate\Http\Response
    */        
    public function destroy(UangMakan $uangMakan)
    {           
        $uangMakan->delete();
        return redirect()->route('uang-makan.index')
        ->with('success', 'Delete data Uang Makan berhasil');
    }
}
