<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    public function getKota(Request $request)
    {
        $kota = Kota::select('id', 'nama')->where('propinsi_id', $request->id)->get();
        echo "<option>-- Pilih Kota --</option>";
        echo "<option value=''>-- Pilih Kota --</option>";
        foreach ($kota as $item) {
            if ($request->kota_id != null && $request->kota_id == $item->id) {
                echo "<option value=" . $item->id . " selected>" . $item->nama . "</option>";
            } else {
                echo "<option value=" . $item->id . ">" . $item->nama . "</option>";
            }
        }
        // return response()->json([
        //     'result' => $kota
        // ]);
    }
}
