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
        }
        elseif(Auth::user()->role == 'manager') {
            $jmlPengajuan = PengajuanDana::where('progres', Auth::user()->role)
                                         ->whereIn('divisi', $div)
                                         ->count(); 
        }
        elseif (Auth::user()->role == 'accounting') {
            $jmlPengajuan = PengajuanDana::where('progres', Auth::user()->role)
                                        ->where('statusdisetujui', 2)
                                        ->count();
        }
        elseif (Auth::user()->role == 'direktur') {
            $jmlPengajuan = PengajuanDana::where('progres', Auth::user()->role)
                                        ->where('statusdisetujui', 3)
                                        ->count();
        }
        elseif (Auth::user()->role == 'kasir') {
            $jmlPengajuan = PengajuanDana::where('progres', Auth::user()->role)
                                         ->where('statusdisetujui', 4)
                                         ->count();
        }
        else {
            $jmlPengajuan = 0;
        }

        // return Auth::user();
        return view('home', compact('user', 'menu', 'jmlPengajuan'));
    }
}
