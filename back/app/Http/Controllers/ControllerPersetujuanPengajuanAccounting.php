<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KodeBudget;
use App\PengajuanDana;
use App\PengajuanDanaDetail;
use App\User;

class ControllerPersetujuanPengajuanAccounting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = PengajuanDana::where('statusdisetujui', 2)->get();
        $kodebudgets = KodeBudget::all(); 
        return view('pengajuandana.a_pengajuan', compact('details', 'kodebudgets'));
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
        $kodebudgets = KodeBudget::all(); 

        return view('pengajuandana.a_pengajuandetail', compact('no', 'namaPengaju', 'details', 'kodebudgets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nomor)
    {
        PengajuanDana::where('nomor', $nomor)->update(['statusdisetujui' => 0]);
   
        return redirect()->route('persetujuanpengajuanaccounting.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $no)
    {
        // return 'test tombol';
        $pengajuan = PengajuanDana::where('nomor', $no);
        // $pengajuan->progres = 'direktur';
        // $pengajuan->statusdisetujui = 3;
        // $pengajuan->kode_budget = $request->kodeBudget;
        $pengajuan->update([
            'progres' => 'direktur',
            'statusdisetujui' => 3,
            'kode_budget' => $request->kodeBudget
        ]);

        return redirect()->route('persetujuanpengajuanaccounting.index');
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
