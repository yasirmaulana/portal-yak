<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengajuanDana;
use App\PengajuanDanaDetail;
use App\User;
use App\VPengajuanDana;

class ControllerViewLPJ extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = VPengajuanDana::where('statusdisetujui', 5)->get();

        return view('lpj.view_lpj', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nomor)
    {
        $no = $nomor;
        $userId = PengajuanDana::select('user_id')->where('nomor', $nomor)->get();
        $namaPengaju = User::select('name')->where('id', $userId[0]->user_id)->get();
        $details = PengajuanDanaDetail::where('nomor',$no)->where('statusditolak', 0)->get();

        return view('lpj.view_lpjdetail', compact('no', 'namaPengaju', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
