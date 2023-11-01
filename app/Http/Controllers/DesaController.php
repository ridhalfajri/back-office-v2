<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function getDesa(Request $request)
    {
        $desa = Desa::select('id', 'nama')->where('kecamatan_id', $request->id)->get();
        echo "<option>-- Pilih Desa --</option>";
        foreach ($desa as $item) {
            if ($request->kecamatan_id != null && $request->kecamatan_id == $item->id) {
                echo "<option value=" . $item->id . " selected>" . $item->nama . "</option>";
            } else {
                echo "<option value=" . $item->id . ">" . $item->nama . "</option>";
            }
        }
    }
}
