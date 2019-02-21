@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Detail LPJ</h3><p>
    <b>Nomor Pengajuan : {{$no}}</b><p>
    <a href="{{route('lpj.index')}}">> Kembali ke list</a><p>
    
    <div class="table-responsive">
        <!-- TAMBAH DETAIL REALISASI -->
        <div>
            <a href="" data-toggle="modal" data-target="#myModalTambah">+ Tambah detail</a>
            <div class="modal fade" id="myModalTambah" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="{{route('lpj.store')}}" method="post">
                                @csrf
                                <input type="text" class="form-control" name="nomor" placeholder="nomor" value="{{$no}}" style="border: 0;background: none;">
                                <p><input type="hidden" class="form-control" name="user_id" placeholder="user_id" value="{{Auth::user()->id}}">
                                <p><input type="text" class="form-control" name="item" placeholder="item">
                                <p><input type="number" class="form-control" name="satuan" placeholder="satuan (tulis tanpa titik)">
                                <p><input type="number" class="form-control" name="harga" placeholder="harga (tulis tanpa titik)">
                                <p><button type="submit" class="btn btn-success">Tambah Detail</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Item</th> 
                    <th>qty</th>
                    <th>@Harga</th> 
                    <th>Total Harga</th>
                    <th>Realisasi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody> 
                @foreach( $details as $detail )
                <tr>
                    <td>{{ $detail->id }}</td>
                    <td>{{ $detail->item }}</td>
                    <td>{{ number_format($detail->satuan) }}</td>
                    <td>{{ number_format($detail->harga) }}</td>
                    <td>{{ number_format($detail->satuan * $detail->harga) }}</td>
                    <td>{{ number_format($detail->realisasi) }}</td>
                    <td><a href="{{route('lpjr.show', $detail->id)}}" class="btn btn-info">Input Realisasi</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection