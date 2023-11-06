<?php

namespace App\Http\Controllers;

use App\Models\Propinsi;
use Illuminate\Http\Request;

class PropinsiController extends Controller
{
    public function getPropinsi()
    {
        $propinsi = Propinsi::select('id', 'nama')->get();
        return response()->json([
            'result' => $propinsi
        ]);
    }
}
