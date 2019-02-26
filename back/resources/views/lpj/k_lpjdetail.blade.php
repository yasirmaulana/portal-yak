@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Detail Pengajuan Dana</h3><p>
    <b>Nomor Pengajuan : {{$no}}</b><p>
    <b>Nama Pengaju : {{$namaPengaju[0]->name}}</b><p>
    <b>Status LPJ Close? : </b><a href="" data-toggle="modal" data-target="#myModal"> Cek Dokumen</a>
    
    <p></p><a href="{{route('klpj.index')}}">Kembali ke list</a><p>
    
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Item</th> 
                    <th>qty</th>
                    <th>@Harga</th> 
                    <th>Total Harga</th>
                    <th>Realisasi</th>
                    <th>Pengembalian</th>
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

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{route('klpj.update', $no)}}" method="post">
                        @csrf
                        @method('PUT')
                        <input type="text" class="form-control" name="nomor" placeholder="nomor" value="{{$no}}" style="border: 0;background: none;">
                        <div class="form-group">
                            <select class="form-control" name="stBukti" id="sel1">
                                <option>Status Bukti</option>
                                <option>Sudah</option>
                                <option>Belum</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="jnBukti" placeholder="Jenis Bukti">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" id="comment" name="catAccounting" placeholder="Catatan"></textarea>
                        </div>
                        <p><button type="submit" class="btn btn-success">LPJ Close</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection