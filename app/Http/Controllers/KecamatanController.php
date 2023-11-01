<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function getKecamatan(Request $request)
    {
        $kecamatan = Kecamatan::select('id', 'nama')->where('kota_id', $request->id)->get();
        echo "<option>-- Pilih Kecamatan --</option>";
        foreach ($kecamatan as $item) {
            if ($request->kota_id != null && $request->kota_id == $item->id) {
                echo "<option value=" . $item->id . " selected>" . $item->nama . "</option>";
            } else {
                echo "<option value=" . $item->id . ">" . $item->nama . "</option>";
            }
        }
    }
}
