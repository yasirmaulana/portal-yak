<?php

namespace App\Http\Controllers;

use Auth;
use App\PengajuanDanaDetail;
use Illuminate\Http\Request;

class ControllerPengajuanDanaDetail extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $post = new PengajuanDanaDetail;

        $post->nomor = $request->nomor;
        $post->user_id = $request->user_id;
        $post->item = $request->item;
        $post->satuan = $request->satuan;
        $post->harga = $request->harga;

        // $post->save();

        $no = $request->nomor;
        $details = PengajuanDanaDetail::where('user_id', Auth::user()->id)->where('nomor', $no)->get();
        // return $details;
        return view('pengajuandana/create', compact('no', 'details'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
