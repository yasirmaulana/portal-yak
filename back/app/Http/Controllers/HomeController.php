<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Menu;

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
        // $role = Auth::user()->role;
        $menu = Menu::where('role', Auth::user()->role)->get();

        return view('home', compact('user', 'menu'));
    }
}
