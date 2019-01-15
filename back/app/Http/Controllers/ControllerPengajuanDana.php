<?php

namespace App\Http\Controllers;

use App\Sequence;
use App\Tab;
use App\PengajuanDana;
use App\PengajuanDanaDetail;
use Auth;
use Alert;
use Softon\SweetAlert\Facades\SWAL;
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
        $user = Auth::user()->id;
        $data = PengajuanDana::where('user_id', $user)->get();
        return view('pengajuandana/front', compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $seq = Sequence::find(1)->no;
        $updateDate = date_format(Sequence::find(1)->updated_at, 'm/Y');
        $datenow = date_format(now(), 'm/Y');
        
        if ($datenow == $updateDate) {
            $seq = $seq + 1;
            $no = $seq . '/' . $updateDate;
        } else {
            $seq = 1;
            $no = $seq . '/' . $datenow;
        }
        
        $details = PengajuanDanaDetail::where('nomor', $no);
        $tabName = Tab::where('id',2)->get();

        return view('pengajuandana/create', compact('no', 'details', 'tabName'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no = $request->nomor;
        $details = PengajuanDanaDetail::where('nomor', $no)->get();
        
        // CEK PENGAJUAN DETAIL
        if (count($details)>0) {
            $post = new PengajuanDana;
            $post->user_id = $request->user_id;
            $post->pembayaran = $request->pembayaran;
            $post->nomor_rekening = $request->nomor_rekening;
            $post->bank = $request->bank;
            $post->atas_nama = $request->atas_nama;
            $post->email = $request->email;
            $post->nomor = $request->nomor;
            $post->progres = $request->progres;
            $post->statusdisetujui = $request->statusdisetujui;
            $post->statusopen = $request->statusopen;
            $post->save();
    
            // UPDATE SEUEN
            $updateDate = date_format(Sequence::find(1)->updated_at, 'm/Y');
            $datenow = date_format(now(), 'm/Y');
            $seq = Sequence::find(1);
            $no = Sequence::find(1)->no;
            
            if ($datenow == $updateDate) {
                $seq->no = $no + 1;
            } else {
                $seq->no = 1;
            }
            $seq->save();
            
            // GOT TO FRONT
            $user = Auth::user()->id;
            $data = PengajuanDana::where('user_id', $user)->get();
    
            return view('pengajuandana/front', compact('data'));
        } else {
            return 'masih kosong, masa disave';
        };

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
