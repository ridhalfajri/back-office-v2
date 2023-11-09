<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Database\QueryException;
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
            ->addColumn('aksi', function ($row) {

                $editButton = '<a href="'.route('jabatan-unit-kerja.edit',  $row->id).'" class="btn btn-sm btn-icon btn-warning on-default edit" title="Ubah"><i class="fa fa-pencil text-white"></i></a>';
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
        try {
            $this->validate($request, [
				'hirarki_unit_kerja_id' => 'required',
				'jabatan_tukin_id' => 'required',
            ]);   
            
            $input = [];
			$input['hirarki_unit_kerja_id'] = $request->hirarki_unit_kerja_id;
			$input['jabatan_tukin_id'] = $request->jabatan_tukin_id;
            JabatanUnitKerja::create($input);

            return redirect()->route('jabatan-unit-kerja.index')
            ->with('success', 'Data Jabatan Unit Kerja berhasil disimpan');            
        }catch (QueryException $e) {
            $msg = $e->getMessage();          
            return redirect()->route('jabatan-unit-kerja.index')
            ->with('error', 'Simpan data Jabatan Unit Kerja gagal, Err: ' . $msg);
        }

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
        try {
            $this->validate($request, [
				'hirarki_unit_kerja_id' => 'required',
				'jabatan_tukin_id' => 'required',
            ]);
    
			$jabatanUnitKerja->hirarki_unit_kerja_id = $request->hirarki_unit_kerja_id;
			$jabatanUnitKerja->jabatan_tukin_id = $request->jabatan_tukin_id;
            $jabatanUnitKerja->save();

            return redirect()->route('jabatan-unit-kerja.index')
            ->with('success', 'Data Jabatan Unit Kerja berhasil diupdate');                
        } catch (QueryException $e) {
            $msg = $e->getMessage();          
            return redirect()->route('jabatan-unit-kerja.index')
            ->with('error', 'Ubah data Jabatan Unit Kerja gagal, Err: ' . $msg);
        }        
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param 
    * @return \Illuminate\Http\Response
    */        
    public function destroy(JabatanUnitKerja $jabatanUnitKerja)
    {         
        $blnValue = false;
        $msg = "";
        try {
            $jabatanUnitKerja->delete();
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
