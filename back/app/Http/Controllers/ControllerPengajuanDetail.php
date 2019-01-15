<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengajuanDanaDetail;

class ControllerPengajuanDetail extends Controller
{
    public function destroy($id, $nomor){
        PengajuanDanaDetail::destroy($id);

        $details = PengajuanDanaDetail::where('nomor', $nomor)->get();

        return redirect()->route('pengajuan.create', ['details' => $details]);

    }
}
