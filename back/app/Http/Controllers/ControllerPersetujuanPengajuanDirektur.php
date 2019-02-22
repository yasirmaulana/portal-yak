<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PengajuanDana;
use App\PengajuanDanaDetail;
use App\User;
use App\VPengajuanDana;
use App\Pengguna;

class ControllerPersetujuanPengajuanDirektur extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $details = PengajuanDana::where('statusdisetujui', 3)->get();
        // return view('pengajuandana.d_pengajuan', compact('details'));

        $jmlPengajuan = VPengajuanDana::where('progres', 'direktur')
                                      ->where('statusdisetujui', 3)
                                      ->sum('total');

        $details = VPengajuanDana::where('progres', 'direktur')
                            ->where('statusdisetujui', 3)
                            ->get();

        return view('pengajuandana.d_pengajuan', compact('jmlPengajuan', 'details'));
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
        // $no = $nomor;
        // $userId = PengajuanDana::select('user_id')->where('nomor', $nomor)->get();
        // $namaPengaju = User::select('name')->where('id', $userId[0]->user_id)->get();
        // $details = PengajuanDanaDetail::where('nomor',$no)->where('statusditolak', 0)->get();

        // return view('pengajuandana.d_pengajuandetail', compact('no', 'namaPengaju', 'details'));

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

        return view('pengajuandana.d_pengajuandetail', compact('no', 'namaPengaju', 'pengajuandana', 'details'));
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
        $no = substr($nomor,1,9);
        $userid0 = PengajuanDana::select('user_id')->where('nomor', $no)->get();
        $userid = $userid0[0]->user_id;
        $noWAPengaju0 = Pengguna::select('nomor_wa')->where('id', $userid)->get();
        $noWAPengaju = $noWAPengaju0[0]->nomor_wa;
        $noWAKasir0 = Pengguna::select('nomor_wa')->where('role', 'kasir')->get();
        $noWAKasir = $noWAKasir0[0]->nomor_wa;
        $tglPengajuan = VPengajuanDana::select('created_at')->where('nomor', $no)->get();
        $totalPengajuan = VPengajuanDana::select('total')->where('nomor', $no)->get();

        if($cek == 's') {
            PengajuanDana::where('nomor', $no)->update(['progres' => 'kasir', 'statusdisetujui' => 4]);
            
            $pesanKePengaju = '*PENGAJUAN DANA (' . $no . ')*\r\n\r\n' .
            'Pengajuan anda tertanggal ' . $tglPengajuan[0]->created_at . '  sebesar Rp. ' . number_format($totalPengajuan[0]->total) . ' telah mendapat persetujuan oleh Direktur dan sedang proses dibagian Accounting';
            
            $pesanKeKasir = '*PENGAJUAN DANA (' . $no . ') - Patty Cash*\r\n\r\n'.
            'Ada sebuah pengajuan dana sebesar Rp. ' . number_format($totalPengajuan[0]->total) . ' yang harus di proses...';
            // return $pesanKeKasir;

            $this->sendWA($noWAKasir,$pesanKeKasir);
            $this->sendWA($noWAPengaju,$pesanKePengaju);

        } else {
            PengajuanDana::where('nomor', $no)->update(['statusdisetujui' => 0]);

            $pesanKePengaju = '*PENGAJUAN DANA (' . $no . ')*\r\n\r\n'.
            'Pengajuan anda telah ditolak oleh Direktur.';

            $this->sendWA($noWAPengaju,$pesanKePengaju);
        }
       
        return redirect()->route('persetujuanpengajuandirektur.index');
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
