<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengajuanDana;
use App\PengajuanDanaDetail;
use Auth;

class ControllerLPJ extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $details = PengajuanDana::where('user_id', $user)
                                      ->where('statusdisetujui', 5)
                                      ->get();
        
        return view('lpj.s_lpj', compact('details'));
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
        $tambahDetail = new PengajuanDanaDetail;

        $tambahDetail->nomor = $request->nomor;
        $tambahDetail->user_id = $request->user_id;
        $tambahDetail->item = $request->item;
        $tambahDetail->satuan = $request->satuan;
        $tambahDetail->harga = $request->harga;
        $tambahDetail->statusditolak = 0;
        $tambahDetail->realisasi = $request->satuan * $request->harga;
        $tambahDetail->total = $request->satuan * $request->harga;
        $tambahDetail->status_tambah_realisasi = 'y';

        $tambahDetail->save();

        return redirect()->route('lpj.show', $request->nomor);
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
        $details = PengajuanDanaDetail::where('nomor', $nomor)
                                        ->where('statusditolak', 0)->get();
        
        return view('lpj.s_lpjdetail', compact('no', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nomor)
    {
        $editPengajuan = PengajuanDana::where('nomor', $nomor)
                ->update([
                    'statusdisetujui' => 6,
                    'progres' => 'kasir'
                ]);

        return redirect()->route('lpj.index');
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
        $editPengajuanDetail = PengajuanDanaDetail::where('id', $id)
                ->update([
                    'realisasi' => $request->realisasi
                ]);
        
        $nomor = $request->nomor;

        return redirect()->route('lpj.show', $nomor);
        // return 'hahahhahh';
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
