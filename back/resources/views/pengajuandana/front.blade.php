@extends('layouts.app')
@section('content')
<div class="container shadow p-4 mb-4 bg-white">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard Pengajuan Dana</div>

                <div class="card-body">
                </div>
                
            </div>
        </div>
    </div> -->
 
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Pengajuan Dana</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">Pengembalian Dana</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu2">LPJ</a>
        </li>
    </ul>
{{$pengajuandana}}
    <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            <a href="{{ route('pengajuan.create') }}">+ Ajukan Dana</a>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <th>Nomor</th>
                        <th>Pembayaran</th>
                        <th>No Rekening</th>
                        <th>Atas Nama</th>
                        <th>Email</th>
                        <th>Proses</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuandana as $detail) 
                    <tr>
                        <td>{{$detail->created_at}}</td>
                        <td>
                            <a href="{{route('pengajuandetail.edit', $detail->nomor)}}">
                                {{$detail->nomor}}
                            </a>
                        </td>
                        <td>
                            @if($detail->pembayaran == 't')
                                Transfer
                            @else
                                Cash
                            @endif
                        </td>
                        <td>{{$detail->nomor_rekening}}</td>
                        <td>{{$detail->atas_nama}}</td>
                        <td>{{$detail->email}}</td>
                        <td>{{$detail->progres}}</td>
                        <td>
                            <form action="route('pengajuan.destroy', $detail->id)">
                                @csrf
                                @method('DELETE')
                                @if($detail->statusdisetujui==1)
                                    <button type="submit" class="btn btn-warning">Batal</button>
                                @else
                                    <button disabled type="submit" class="btn btn-success">Menunggu</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    
        <div id="menu1" class="container tab-pane fade"><br>
            ini tab pengembalian dana
        </div>
    
        <div id="menu2" class="container tab-pane fade"><br>
            ini tab lpj
        </div>
    </div>
    
</div>
@endsection
