@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Detail Pengajuan Dana</h3><p>
    <b>Nomor Pengajuan : {{$no}}</b><p>
    <b>Nama Pengaju : {{$namaPengaju[0]->name}}</b><p>

    @if($pengajuandana[0]->pembayaran == 't')
    <b>Nama Bank : {{$pengajuandana[0]->bank}}</b><p>
    <b>Nomor Rekening : {{$pengajuandana[0]->nomor_rekening}}</b><p>
    <b>Atas Nama : {{$pengajuandana[0]->atas_nama}}</b><p>
    <b>Email : {{$pengajuandana[0]->email}}</b><p>
    @endif
    
    <a href="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Set Jatuh Tempo LPJ</a>
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{route('listkasir.update', $no)}}" method="post">
                        @csrf
                        @method('PUT')
                        <b>Tanggal Jatuh Tempo LPJ :</b><p>
                        <p><input type="date" class="col-md-4 form-control" name="jtLPJ">
                        <p><button type="submit" class="btn btn-success">Set Jatuh Tempo LPJ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <a href="{{route('listkasir.index')}}">Kembali ke list</a><p>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Item</th> 
                    <th>qty</th>
                    <th>@Harga</th> 
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody> 
                @foreach( $details as $detail )
                <tr>
                    <td>{{ $detail->item }}</td>
                    <td>{{ number_format($detail->satuan) }}</td>
                    <td>{{ number_format($detail->harga) }}</td>
                    <td>{{ number_format($detail->satuan * $detail->harga) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection