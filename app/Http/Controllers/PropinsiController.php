<?php

namespace App\Http\Controllers;

use App\Models\Propinsi;
use Illuminate\Http\Request;

class PropinsiController extends Controller
{
    public function getPropinsi(Request $request)
    {
        $propinsi = Propinsi::select('id', 'nama')->get();
        echo "<option value=''>-- Pilih Propinsi --</option>";
        foreach ($propinsi as $item) {
            if ($request->propinsi_id != null && $request->propinsi_id == $item->id) {
                echo "<option value=" . $item->id . " selected>" . $item->nama . "</option>";
            } else {
                echo "<option value=" . $item->id . ">" . $item->nama . "</option>";
            }
        }
    }
}
