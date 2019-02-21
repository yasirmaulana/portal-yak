<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Menu;
use App\PengajuanDana;
use App\DivisiDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $menu = Menu::where('role', Auth::user()->role)->get();
        $div = DivisiDetail::select('divisi')
                           ->where('user_id', Auth::user()->id)
                           ->get();
        
        if(Auth::user()->role == 'standar') {
            $jmlPengajuan = PengajuanDana::where('user_id', Auth::user()->id)
                                         ->whereIn('statusdisetujui', [1,2,3,4])
                                         ->count();
            $jmlLpj = PengajuanDana::where('user_id', Auth::user()->id)
                                    ->where('statusdisetujui', 5)
                                    ->count();
        }
        elseif(Auth::user()->role == 'manager') {
            $jmlPengajuan = PengajuanDana::where('progres', Auth::user()->role)
                                         ->whereIn('divisi', $div)
                                         ->count(); 
            $jmlLpj = PengajuanDana::where('statusdisetujui', 5)
                                    ->whereIn('divisi', $div)
                                    ->count(); 
        }
        elseif (Auth::user()->role == 'accounting') {
            $jmlPengajuan = PengajuanDana::where('progres', Auth::user()->role)
                                        ->where('statusdisetujui', 2)
                                        ->count();
            $jmlLpj = PengajuanDana::where('statusdisetujui', 5)
                                    ->count(); 
        }
        elseif (Auth::user()->role == 'direktur') {
            $jmlPengajuan = PengajuanDana::where('progres', Auth::user()->role)
                                        ->where('statusdisetujui', 3)
                                        ->count();
            $jmlLpj = PengajuanDana::where('statusdisetujui', 5)
                                    ->count();
        }
        elseif (Auth::user()->role == 'kasir') {
            $jmlPengajuan = PengajuanDana::where('progres', Auth::user()->role)
                                         ->where('statusdisetujui', 4)
                                         ->count();
            $jmlLpj = PengajuanDana::where('statusdisetujui', 5)
                                    ->count();
        }
        else {
            $jmlPengajuan = 0;
        }

        // return Auth::user();
        return view('home', compact('user', 'menu', 'jmlPengajuan', 'jmlLpj'));
    }
}

// CREATE OR REPLACE VIEW `vpengajuandana` AS
// SELECT `pengajuandana`.`created_at`, `pengajuandana`.`nomor`, `pengajuandana`.`user_id`, `pengajuandana`.`pembayaran`, `pengajuandana`.`bank`, `pengajuandana`.`nomor_rekening`, `pengajuandana`.`atas_nama`, `pengajuandana`.`email`, `pengajuandana`.`progres`, `pengajuandana`.`statusdisetujui`, `pengajuandana`.`statusopen`, `pengajuandana`.`divisi`, `pengajuandana`.`kode_budget`, `pengajuandana`.`jatuh_tempo_lpj`, `pengajuandana`.`tujuan`, `pengajuandana`.`kasir`, `pengajuandana`.`tgl_transfer`, `pengajuandana`.`catatan_accounting`, sum(`pengajuandanadetail`.`total`) as total, sum(`pengajuandanadetail`.`realisasi`) AS total_realisasi

// FROM `pengajuandana`

// LEFT JOIN `pengajuandanadetail`
// ON `pengajuandanadetail`.`nomor` = `pengajuandana`.`nomor`

// WHERE `pengajuandana`.`statusopen` = 'y'

// GROUP BY `pengajuandana`.`created_at`, `pengajuandana`.`nomor`, `pengajuandana`.`user_id`, `pengajuandana`.`pembayaran`, `pengajuandana`.`bank`, `pengajuandana`.`nomor_rekening`, `pengajuandana`.`atas_nama`, `pengajuandana`.`email`, `pengajuandana`.`progres`, `pengajuandana`.`statusdisetujui`, `pengajuandana`.`statusopen`, `pengajuandana`.`divisi`, `pengajuandana`.`kode_budget`, `pengajuandana`.`jatuh_tempo_lpj`, `pengajuandana`.`tujuan`, `pengajuandana`.`kasir`, `pengajuandana`.`tgl_transfer`, `pengajuandana`.`catatan_accounting`

// ORDER BY `pengajuandana`.`divisi`