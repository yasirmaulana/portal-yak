<?php

namespace App\Http\Controllers;

use App\PengajuanDana;
use App\PengajuanDanaDetail;
use Illuminate\Http\Request;

class ControllerPengajuanDana extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $data = PengajuanDana::all();

        return view('pengajuandana/front', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $no = 'AK301218';
        $details = PengajuanDanaDetail::where('nomor', $no);

        return view('pengajuandana/create', compact('no'), compact('details'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new PengajuanDana;

        $post->pembayaran = $request->pembayaran;
        $post->nomor_rekening = $request->nomor_rekening;
        $post->bank = $request->bank;
        $post->atas_nama = $request->atas_nama;
        $post->email = $request->email;
        $post->nomor = $request->nomor;

        $post->save();

        return 'input berhasil';
        // $no = 'AK301218';
        // return view('pengajuandana/create', compact('no'));
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
