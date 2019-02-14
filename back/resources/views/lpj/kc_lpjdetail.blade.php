@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Detail Pengajuan Dana</h3><p>
    <b>Nomor Pengajuan : {{$no}}</b><p>
    <b>Nama Pengaju : {{$namaPengaju[0]->name}}</b><p>
    <b>Status LPJ Close? : </b>
    <a href="{{route('kclpj.edit', $no)}}">Ya</a> | 
    <a href="{{route('kclpj.index')}}">Kembali ke list</a><p>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Item</th> 
                    <th>qty</th>
                    <th>@Harga</th> 
                    <th>Total Harga</th>
                    <th>Realisasi</th>
                    <th>Delta</th>
                </tr>
            </thead>
            <tbody> 
                @foreach( $details as $detail )
                <tr>
                    <td>{{ $detail->item }}</td>
                    <td>{{ number_format($detail->satuan) }}</td>
                    <td>{{ number_format($detail->harga) }}</td>
                    <td>{{ number_format($detail->satuan * $detail->harga) }}</td>
                    <td>{{ number_format($detail->realisasi) }}</td>
                    <td>{{ number_format(($detail->satuan * $detail->harga)-$detail->realisasi) }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection