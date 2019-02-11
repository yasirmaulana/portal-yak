<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sequence;
use App\PengajuanDana;
use App\PengajuanDanaDetail;
use App\Pengguna;
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
        
        // $pengajuandana = PengajuanDana::latest()->paginate(5);
        // return view('pengajuandana.front', compact('pengajuandana'))
        //         ->with('i', (request()->input('page',1) -1)*5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createNumber(){
        $seq = Sequence::find(1)->no;
        $updateDate = date_format(Sequence::find(1)->updated_at, 'y');
        $datenow = date_format(now(), 'y');
        
        if ($datenow == $updateDate) {
            $seq = $seq + 1;
            $no = Auth::user()->divisi . date_format(now(), 'ym') . $seq;
        } else {
            $seq = 1;
            $no =  Auth::user()->divisi . date_format(now(), 'ym') . $seq;
        }

        return $no;
    }

    public function create()
    {
        $no = $this->createNumber();
        $details = PengajuanDanaDetail::where('user_id', Auth::user()->id)->where('nomor', $no)->get();

        return view('pengajuandana.create', compact('no', 'details'))->with('status', '');
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
    
        echo $number . $msg;

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
        $pembayaran = $request->pembayaran;
        $details = PengajuanDanaDetail::where('nomor', $no)->get();
        
        // CEK INPUTAN PEMBAYARAN
        if  (empty($pembayaran)) {
            return view('pengajuandana.create', compact('no', 'details'))->with('status', 'Input Pembayaran harus diisi!!!');
            // return redirect()->back()->with('status', 'Input Pembayaran harus diisi!!!');
        }

        if ($pembayaran == 't') {
            if (empty($request->nomor_rekening) or empty($request->bank) or empty($request->atas_nama) or empty($request->email)) {
                return view('pengajuandana.create', compact('no', 'details'))->with('status', 'Nomor rekening, nama bank, a/n dan email tidak boleh kosong!!!');
            }
        }

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
            $post->divisi = Auth::user()->divisi;
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
            $user = Auth::user()->id;
            $pengajuandana = PengajuanDana::where('user_id', $user)
                                        ->where('statusopen', 'y')
                                        ->get();
    
            return view('pengajuandana.front', compact('pengajuandana'));
        } else {

            $no = $this->createNumber();
            $details = PengajuanDanaDetail::where('nomor', $no);

            return view('pengajuandana.create', compact('no', 'details'))->with('status', 'Input detail pengajuan terlebih dahulu!!!');
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
        $deletePengajuan = PengajuanDana::where('nomor', $nomor);
        $deletePengajuan->delete();

        $deletePengajuanDetail = PengajuanDanaDetail::where('nomor', $nomor);
        $deletePengajuanDetail->delete();

        return redirect()->route('pengajuan.index');
    }
}
