<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\PengajuanDana;
use App\PengajuanDanaDetail;

class ControllerPengajuanDanaEdit extends Controller
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
        if (!($request->item == NULL or $request->satuan == NULL or $request->harga == NULL)) {
            
            $post = new PengajuanDanaDetail;
            
            $post->nomor = $request->nomor;
            $post->user_id = $request->user_id;
            $post->item = $request->item;
            $post->satuan = $request->satuan;
            $post->harga = $request->harga;
            
            $post->save();
            
            $no = $request->nomor;
            $pengajuan = PengajuanDana::where('nomor', $no)->get();
            $details = PengajuanDanaDetail::where('user_id', Auth::user()->id)->where('nomor', $no)->get();
            
            return view('pengajuandana.edit', compact('no', 'pengajuan', 'details'))->with('status', '');
        } else {
            $no = $request->nomor;
            $pengajuan = PengajuanDana::where('nomor', $no)->get();
            $details = PengajuanDanaDetail::where('user_id', Auth::user()->id)->where('nomor', $no)->get();

            return view('pengajuandana.edit', compact('no', 'pengajuan', 'details'))->with('status', 'semua field wajib diisi');
        }
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
    public function edit($nomor)
    {
        $no = $nomor;
        $pengajuan = PengajuanDana::where('nomor', $nomor)->get();
        $details = PengajuanDanaDetail::where('nomor', $nomor)->get();
        return view('pengajuandana.edit', compact('no', 'pengajuan', 'details'))->with('status', '');
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
        $deleteDetail = PengajuanDanaDetail::find($id);
        $deleteDetail->delete();

        $no = $deleteDetail->nomor;
        $pengajuan = PengajuanDana::where('nomor', $no)->get();
        $details = PengajuanDanaDetail::where('nomor', $no)->get();
        
        return view('pengajuandana.edit', compact('no', 'pengajuan', 'details'))->with('status', '');

    }
}
