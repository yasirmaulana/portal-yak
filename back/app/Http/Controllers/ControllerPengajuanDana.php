<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sequence;
use App\PengajuanDana;
use App\PengajuanDanaDetail;
use App\Pengguna;
use App\DivisiDetail;
use Auth;

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
        $pengajuandana = PengajuanDana::where('user_id', $user)
                                      ->where('statusdisetujui', '<', 5)
                                      ->get();
        
        return view('pengajuandana.front', compact('pengajuandana'));
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createNumber(){
        $seq = Sequence::find(1)->no;
        $updateDate = date_format(Sequence::find(1)->updated_at, 'ym');
        $datenow = date_format(now(), 'ym');
        $initialDivisi = DivisiDetail::select('initial')->where('user_id', Auth::user()->id)->get();
        if ($datenow == $updateDate) {
            $seq = $seq + 1;
            if(strlen(strval($seq))==1){
                $seq = '00' . $seq;
            }
            elseif(strlen(strval($seq))==2){
                $seq = '0' . $seq;
            }
            else{
                $seq = $seq;
            }
            $no = $initialDivisi[0]->initial . date_format(now(), 'ym') . $seq;
        } else {
            $seq = '00' . 1;
            $no =  $initialDivisi[0]->initial . date_format(now(), 'ym') . $seq;
        }

        return $no;
    }

    public function create()
    {
        $no = $this->createNumber();
        $pengaju = Auth::user();
        $details = PengajuanDanaDetail::where('user_id', Auth::user()->id)->where('nomor', $no)->get();
        $total = '';

        return view('pengajuandana.create', compact('no', 'pengaju', 'details', 'total'))->with('status', '');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $no = $request->nomor;
        $pengaju = Auth::user();
        $pembayaran = $request->pembayaran;
        $details = PengajuanDanaDetail::where('nomor', $no)->get();
        $total = PengajuanDanaDetail::where('nomor', $no)
                                        ->sum('total');
        $divisi = DivisiDetail::where('user_id', Auth::user()->id)->get();

        // CEK INPUTAN PEMBAYARAN
        if  (empty($pembayaran) or empty($request->tujuan)) {
            return view('pengajuandana.create', compact('no', 'pengaju', 'details', 'total'))->with('status', 'Input Tujuan atau Pembayaran harus diisi!!!');
            // return redirect()->route('pengajuan.create')->with('status', 'Input Pembayaran harus diisi!!!');
        }

        if ($pembayaran == 't') {
            if (empty($request->nomor_rekening) or empty($request->bank) or empty($request->atas_nama) or empty($request->email)) {
                return view('pengajuandana.create', compact('no', 'pengaju', 'details', 'total'))->with('status', 'Nomor rekening, nama bank, a/n dan email tidak boleh kosong!!!');
                // return redirect()->route('pengajuan.create')->with('status', 'Nomor rekening, nama bank, a/n dan email tidak boleh kosong!!!');
            }
        }

        // CEK PENGAJUAN DETAIL
        if (count($details)>0) {
            $post = new PengajuanDana;
            $post->user_id = $request->user_id;
            $post->tujuan = $request->tujuan;
            $post->pembayaran = $request->pembayaran;

            if ($request->pembayaran == 't') {
                $post->nomor_rekening = $request->nomor_rekening;
                $post->bank = $request->bank;
                $post->atas_nama = $request->atas_nama;
                $post->email = $request->email;
            }
            
            $post->nomor = $request->nomor;
            $post->progres = $request->progres;
            $post->statusdisetujui = $request->statusdisetujui;
            $post->statusopen = $request->statusopen;
            $post->divisi = $divisi[0]->divisi;
            $post->save();
    
            
            // SEND WA TO MANAGER
            $nomorWA = Pengguna::select('nomor_wa')
                                ->where('divisi',Auth::user()->divisi)
                                ->where('jabatan','manager')
                                ->get();
            // $nomorWA = implode($nomorWA);

            $pesan = '*PENGAJUAN DANA*\r\n\r\n'.
            'Staf anda melakukan pengajuan dana dan menunggu proses selanjutnya dari anda.';

            $this->sendWA($nomorWA[0]->nomor_wa,$pesan);
            
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
            // $user = Auth::user()->id;
            // $pengajuandana = PengajuanDana::where('user_id', $user)
            //                             ->where('statusopen', 'y')
            //                             ->get();
    
            // return view('pengajuandana.front', compact('pengajuandana'));
            return redirect()->route('pengajuan.index');
        } else {

            $no = $this->createNumber();
            $details = PengajuanDanaDetail::where('nomor', $no);

            return view('pengajuandana.create', compact('no', 'pengaju', 'details'))->with('status', 'Input detail pengajuan terlebih dahulu!!!');
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
    public function destroy($nomor)
    {
        $cek = PengajuanDana::where('nomor', $nomor)->get();
        if(sizeof($cek) == 0 ) {
        } else {
            $deletePengajuan = PengajuanDana::where('nomor', $nomor);
            $deletePengajuan->delete();
        }

        $deletePengajuanDetail = PengajuanDanaDetail::where('nomor', $nomor);
        $deletePengajuanDetail->delete();

        return redirect()->route('pengajuan.index');

    }
}
