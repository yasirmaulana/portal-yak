<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KodeBudget;
use App\PengajuanDana;
use App\PengajuanDanaDetail;
use App\Pengguna;
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
        
        $userid = PengajuanDana::select('user_id')->where('nomor', $nomor)->get();
        $userid = $userid[0]->user_id;
        $noWAPengaju = Pengguna::select('nomor_wa')->where('id', $userid)->get();
        $noWAPengaju = $noWAPengaju[0]->nomor_wa;
            
        // SEND WA TO PENGAJU
        $pesanKePengaju = '*PENGAJUAN DANA*\r\n\r\n'.
        'Pengajuan anda telah ditolak oleh bagian Accounting.';

        $this->sendWA($noWAPengaju,$pesanKePengaju);

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
        $pengajuan = PengajuanDana::where('nomor', $no);
        $pengajuan->update([
            'progres' => 'direktur',
            'statusdisetujui' => 3,
            'kode_budget' => $request->kodeBudget
        ]);
        
        $userid = PengajuanDana::select('user_id')->where('nomor', $no)->get();
        $userid = $userid[0]->user_id;
        $noWAPengaju = Pengguna::select('nomor_wa')->where('id', $userid)->get();
        $noWAPengaju = $noWAPengaju[0]->nomor_wa;
        $noWADirektur = Pengguna::select('nomor_wa')->where('role', 'direktur')->get();
        $noWADirektur = $noWADirektur[0]->nomor_wa;
            
        // SEND WA TO ACCOUNTING
        $pesanKePengaju = '*PENGAJUAN DANA*\r\n\r\n'.
        'Pengajuan anda telah disetujuin oleh bagian _Accounting_ dan menunggu proses selanjutnya di Direktur.';

        $pesanKeDirektur = '*PENGAJUAN DANA*\r\n\r\n'.
        'Ada sebuah pengajuan dana yang harus di proses...';

        $this->sendWA($noWAPengaju,$pesanKePengaju);
        $this->sendWA($noWADirektur,$pesanKeDirektur);

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

}
