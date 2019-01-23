@extends('layouts.app')

@section('content')
<div class="container shadow p-4 mb-4 bg-white" style="background:white; padding:10px">
    <!-- FORMULIR PENGAJUAN DANA -->
    <div id="home" class="container tab-pane active"><br>
        <h1>DATA PENGAJUAN DANA</h1>
        
            <div class="form-group row"> 
                <label class="col-md-3 col-form-label text-md-right">Nomor :</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="no" value="" disabled style="border: 0;background: none;">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">NIK :</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" value=""  disabled style="border: 0;background: none;">
                </div>
                <label class="col-md-1 col-form-label text-md-right">Nama :</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" value=""  disabled style="border: 0;background: none;">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">Divisi :</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" value=""  disabled style="border: 0;background: none;">
                </div>
                <label class="col-md-1 col-form-label text-md-right">Jabatan :</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" value=""  disabled style="border: 0;background: none;">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">Pembayaran :</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" value=""  disabled style="border: 0;background: none;">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">Nomor Rekening Transfer :</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" value=""  disabled style="border: 0;background: none;">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">Nama Bank :</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" value=""  disabled style="border: 0;background: none;">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">a/n Rekening :</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" value=""  disabled style="border: 0;background: none;">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">Email :</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" value=""  disabled style="border: 0;background: none;">
                </div>
            </div>
    </div>
    
    <!-- FORMULIR PENGAJUAN DANA DETAIL -->
    <div class="form-group row">
        <div class="col-md-8">
            <a href="" data-toggle="modal" data-target="#myModal">
                + tambah detail
            </a>
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="{{route('pengajuandetail.store')}}" method="post">
                                @csrf
                                <input type="text" class="form-control" name="nomor" placeholder="nomor" value="" style="border: 0;background: none;">
                                <input type="hidden" class="form-control" name="user_id" placeholder="user_id" value="{{Auth::user()->id}}">
                                <input type="text" class="form-control" name="item" placeholder="item">
                                <input type="number" class="form-control" name="satuan" placeholder="satuan (tulis tanpa titik)">
                                <input type="number" class="form-control" name="harga" placeholder="harga (tulis tanpa titik)">
                                <button type="submit" class="btn btn-primary">Tambah Detail</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Item</th>
                <th>qty</th>
                <th>@Harga</th>
                <th>Jumlah</th>
                <th></th>
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
                <form action="{{route('pengajuandetail.destroy', $detail->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection