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

    <a href="{{route('persetujuanpengajuandana.edit', 's'.$no)}}" class="btn btn-success">Setuju</a>
    <a href="{{route('persetujuanpengajuandana.edit', 't'.$no)}}" class="btn btn-danger">Tolak</a><p>
    <a href="{{route('persetujuanpengajuandana.index')}}">Kembali ke list</a>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>qty</th>
                    <th>@Harga</th>
                    <th>Total Harga</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody> 
                @foreach( $details as $detail )
                <tr>
                    <td>{{ $detail->item }}</td>
                    <td>{{ number_format($detail->satuan) }}</td>
                    <td>{{ number_format($detail->harga) }}</td>
                    <td>{{ number_format($detail->satuan * $detail->harga) }}</td>
                    <td>
                        <a href="{{route('persetujuanpengajuandetail.edit', $detail->id)}}" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection