<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VPengajuanDana;
use App\PengajuanDana;
use App\PengajuanDanaDetail;
use App\User;
use App\Pengguna;
use App\DivisiDetail;
use Auth;
use DB;

class ControllerPersetujuanPengajuanDana extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $div = DivisiDetail::select('divisi')
                           ->where('user_id', Auth::user()->id)
                           ->get();

        $data = VPengajuanDana::where('progres', 'manager')
                                ->where('statusdisetujui', 1)
                                ->whereIn('divisi', $div)
                                ->get();

        return view('pengajuandana.m_pengajuan', compact('data')); 
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

        return view('pengajuandana.m_pengajuandetail', compact('no', 'namaPengaju', 'pengajuandana', 'details'));
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
        $userid = PengajuanDana::select('user_id')->where('nomor', $no)->get();
        $userid = $userid[0]->user_id;
        $noWAPengaju = Pengguna::select('nomor_wa')->where('id', $userid)->get();
        $noWAPengaju = $noWAPengaju[0]->nomor_wa;
        $noWAAccounting = Pengguna::select('nomor_wa')->where('role', 'accounting')->get();
        $noWAAccounting = $noWAAccounting[0]->nomor_wa;

        // return $no;
        if($cek == 's') {
            PengajuanDana::where('nomor', $no)->update(['progres' => 'accounting', 'statusdisetujui' => 2]);

            // SEND WA TO ACCOUNTING
            $pesanKePengaju = '*PENGAJUAN DANA*\r\n\r\n'.
            'Pengajuan anda telah disetujuin oleh manager dan menunggu proses selanjutnya di accounting.';

            $pesanKeAccounting = '*PENGAJUAN DANA*\r\n\r\n'.
            'Ada sebuah pengajuan dana yang harus di proses...';

            $this->sendWA($noWAPengaju,$pesanKePengaju);
            $this->sendWA($noWAAccounting,$pesanKeAccounting);

        } else {
            PengajuanDana::where('nomor', $no)->update(['statusdisetujui' => 0]);

            $pesanKePengaju = '*PENGAJUAN DANA*\r\n\r\n'.
            'Pengajuan anda telah ditolak oleh manager.';

            $this->sendWA($noWAPengaju,$pesanKePengaju);

        }
       
        return redirect()->route('persetujuanpengajuandana.index');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nomor)
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
