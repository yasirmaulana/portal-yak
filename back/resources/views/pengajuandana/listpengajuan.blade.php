@extends('layouts.app')

@section('content')
<div class="container shadow p-4 mb-4 bg-white" style="background:white; padding:10px">
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

    <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <th>Nomor</th>
                        <th>Pembayaran</th>
                        <th>No Rekening</th>
                        <th>Atas Nama</th>
                        <th>Email</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $detail)
                    <tr>
                        <td>{{$detail->created_at}}</td>
                        <td>
                            <a href="">
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
                        <td>Rp. 1.000.000</td>
                        <td>
                            <button class="btn btn-primary">Approve</button>
                            <button class="btn btn-danger">Reject</button>
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
