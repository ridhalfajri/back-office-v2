<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use App\Models\Tukin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GradeTukinController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {            
        $title = 'Info Grade Tukin';

        return view('tukin.index-personal', compact('title'));
    }
     
    public function datatable(Tukin $tukin)
    {        
        $data = Tukin::select('*')
        ->where('is_active','=','Y')
        ->orderBy('grade','asc');

        //dd($data);

        return Datatables::of($data)
            ->addColumn('no', '')
            ->make(true);
    }
    
}
