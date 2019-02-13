@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Detail LPJ</h3><p>
    <b>Nomor Pengajuan : {{$no}}</b><p>
    <!-- <a href="" class="btn btn-success">Lapor LPJ</a><p></p> -->
    <a href="{{route('lpj.index')}}">Kembali ke list</a><p>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
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
                    <td>{{ $detail->item }}</td>
                    <td>{{ number_format($detail->satuan) }}</td>
                    <td>{{ number_format($detail->harga) }}</td>
                    <td>{{ number_format($detail->satuan * $detail->harga) }}</td>
                    <td>{{ number_format($detail->realisasi) }}</td>
                    <td>
                        <a href="" class="btn btn-info" data-toggle="modal" data-target="#myModal">Input Realisasi</a>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="{{route('lpj.update', $detail->id)}}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <p><input type="hidden" name="nomor" value="{{$detail->nomor}}">
                                            <p><input disabled type="text" class="form-control" name="item" value="{{$detail->item}}">
                                            <p><input type="number" class="form-control" name="realisasi" placeholder="realisasi (tulis tanpa titik)">
                                            <p><button type="submit" class="btn btn-success">Isi Realisasi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection