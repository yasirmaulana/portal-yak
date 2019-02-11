@extends('layouts.app')

@section('content')
<div class="container">
    
    <h3>Detail Pengajuan Dana</h3><p>
    <b>Nomor Pengajuan : {{$no}}</b><p>
    <b>Nama Pengaju : {{$namaPengaju[0]->name}}</b><p>
    <b>Kode COA :</b>
    <form action="{{route('persetujuanpengajuanaccounting.update', $no)}}" class="col-md-3" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <select class="form-control" id="kodeBudget" name="kodeBudget">
                <option>--Pilih--</option>
                @foreach($kodebudgets as $kodebudget)
                <option value="{{$kodebudget->kode_budget}}">{{$kodebudget->kode_budget}} - {{$kodebudget->deskripsi}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Setuju</button>
        <a href="{{route('persetujuanpengajuanaccounting.edit', $no)}}" class="btn btn-danger">Tolak</a><p><p>
    </form>
    <a href="{{route('persetujuanpengajuanaccounting.index')}}">Kembali ke list</a><p>
    
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
                        <a href="{{route('persetujuanpengajuandetail.edit', $detail->id)}}" class="btn btn-danger">Tolak</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection