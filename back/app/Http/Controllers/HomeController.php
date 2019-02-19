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
        $jmlPengajuan = PengajuanDana::where('progres', Auth::user()->role)
                                     ->whereIn('divisi', $div)
                                     ->count(); 

        return view('home', compact('user', 'menu', 'jmlPengajuan'));
    }
}
