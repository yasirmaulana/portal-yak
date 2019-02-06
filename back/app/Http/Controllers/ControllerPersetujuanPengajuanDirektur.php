<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengajuanDana;
use App\PengajuanDanaDetail;
use App\User;

class ControllerPersetujuanPengajuanDirektur extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = PengajuanDana::where('statusdisetujui', 3)->get();
        return view('pengajuandana.d_pengajuan', compact('details'));
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

        return view('pengajuandana.d_pengajuandetail', compact('no', 'namaPengaju', 'details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nomor)
    {
        $cek = substr($nomor,0,1);
        $no = substr($nomor,1,8);
        // return $no;
        if($cek == 's') {
            PengajuanDana::where('nomor', $no)->update(['progres' => 'direktur', 'statusdisetujui' => 4]);
        } else {
            PengajuanDana::where('nomor', $no)->update(['statusdisetujui' => 0]);
        }
       
        return redirect()->route('persetujuanpengajuandirektur.index');
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
