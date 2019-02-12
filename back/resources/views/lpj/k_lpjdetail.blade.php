@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Detail Pengajuan Dana</h3><p>
    <b>Nomor Pengajuan : {{$no}}</b><p>
    <b>Nama Pengaju : {{$namaPengaju[0]->name}}</b><p>
    <b>Status LPJ Close? : </b>
    <a href="{{route('klpj.edit', $no)}}">Ya</a> | 
    <a href="{{route('klpj.index')}}">Kembali ke list</a><p>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Item</th> 
                    <th>qty</th>
                    <th>@Harga</th> 
                    <th>Total Harga</th>
                    <!-- <th>Status</th> -->
                </tr>
            </thead>
            <tbody> 
                @foreach( $details as $detail )
                <tr>
                    <td>{{ $detail->item }}</td>
                    <td>{{ number_format($detail->satuan) }}</td>
                    <td>{{ number_format($detail->harga) }}</td>
                    <td>{{ number_format($detail->satuan * $detail->harga) }}</td>
                    <!-- <td>
                        @if($detail->statusditolak == 1)
                            <button disabled class="btn btn-danger">Ditolak</button>
                        @else
                            <button disabled class="btn btn-info">Disetujui</button>
                        @endif
                    </td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection