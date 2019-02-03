@extends('layouts.app')

@section('content')
<div class="container">
    @if ($status == '')
    @else
        <div class="alert alert-danger col-md-12"><strong>{{$status}}</strong></div>
    @endif
    
    <!-- FORMULIR PENGAJUAN DANA DETAIL -->
    <h3>Detail Pengajuan Dana</h3><p>
    <b>Nomor Pengajuan : {{$no}}</b><p>
    <a href="{{route('pengajuan.index')}}" class="btn btn-info">Kembali ke lis</a>
    
    <div class="form-group row">
        <div class="col-md-8">
            @if($pengajuan[0]->statusdisetujui==1)
            <a href="" data-toggle="modal" data-target="#myModal">
                + tambah detail
            </a>
            @endif
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="{{route('pengajuanedit.store')}}" method="post">
                                @csrf
                                <input type="text" class="form-control" name="nomor" value="{{$no}}" style="border: 0;background: none;">
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
                    @if($pengajuan[0]->statusdisetujui==1)
                    <form action="{{route('pengajuanedit.destroy', $detail->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                    @else
                        <button disabled type="submit" class="btn btn-info">Menunggu...</button>
                    @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection