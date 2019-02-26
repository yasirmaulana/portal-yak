<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengajuanDana;
use App\PengajuanDanaDetail;
use App\User;
use App\VPengajuanDana;
use App\KodeBudget;
use App\Pengguna;
use Auth;

class ControllerListKasir extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $jmlPengajuan = VPengajuanDana::where('progres', 'kasir')
                                    ->where('statusdisetujui', 4)
                                    ->sum('total');

        $details = VPengajuanDana::where('progres', 'kasir')
                                    ->where('statusdisetujui', 4)
                                    ->get();

        return view('pengajuandana.list_pengajuan', compact('jmlPengajuan', 'details'));
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
    public function show($no)
    {
        $userId = PengajuanDana::select('user_id')
                               ->where('nomor', $no)
                               ->get();
        $namaPengaju = User::select('name')
                           ->where('id', $userId[0]->user_id)
                           ->get();
        $pengajuandana = PengajuanDana::where('nomor', $no)
                                      ->get();
        $details = PengajuanDanaDetail::where('nomor', $no)
                                      ->where('statusditolak', 0)
                                      ->get();
        $kodebudgets = KodeBudget::all(); 

        return view('pengajuandana.list_pengajuandetail', compact('no', 'namaPengaju', 'pengajuandana', 'details', 'kodebudgets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nomor)
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
    public function update(Request $request, $no)
    {
        PengajuanDana::where('nomor', $no)
            ->update([
                'jatuh_tempo_lpj' => $request->jtLPJ,
                'statusdisetujui' => 5,
                'kasir' => Auth::user()->name
            ]);

        $userid0 = PengajuanDana::select('user_id')->where('nomor', $no)->get();
        $userid = $userid0[0]->user_id;
        $noWAPengaju0 = Pengguna::select('nomor_wa')->where('id', $userid)->get();
        $noWAPengaju = $noWAPengaju0[0]->nomor_wa;
        $tglPengajuan = VPengajuanDana::select('created_at')->where('nomor', $no)->get();
        $totalPengajuan = VPengajuanDana::select('total')->where('nomor', $no)->get();
        
        $pesanKePengaju = '*PENGAJUAN DANA (' . $no . ')*\r\n\r\n' .
        'Pengajuan anda tertanggal ' . $tglPengajuan[0]->created_at . '  sebesar Rp. ' . number_format($totalPengajuan[0]->total) . ' telah diproses dibagian Accounting\r\n\r\n' .
        'mohon diselesaikan Laporan Pertanggung Jawaban sebelum jatuh tempo tanggal ' . $request->jtLPJ;
            
        $this->sendWA($noWAPengaju,$pesanKePengaju);

        return redirect()->route('listkasir.index');
    }

    public function sendWA($nomorWA,$pesan)
    {
        // $number="6281586245143";
        // $msg="test send wa from route with image, setting .env";
        $img="http://www.wegeek.net/wp-content/uploads/2016/08/Aggiornamento-WhatsApp-Windows-Phone.jpg";

        $number=$nomorWA;
        $msg=$pesan;
        $JSON_DATA ='{
            "token": "'. env('PICKY_TOKEN') .'",
            "priority ":0,
            "application":"1",
            "sleep":0,
            "globalmessage":"'.$msg.'",
            "globalmedia":"",
            "data":[
                {"number":"'.$number.'","message":""}
            ]
        }';
        //--CURL FUNCTION TO CALL THE API--
        $url = env('PICKY_URL');
        $ch = curl_init($url);                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_POSTFIELDS, $JSON_DATA);                                                                  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json', 'Content-Length: ' . strlen($JSON_DATA))); 		                                                                                                                   
        $result = curl_exec($ch);
    
        // echo $number . $msg;

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
