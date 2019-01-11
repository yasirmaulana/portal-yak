@extends('layouts.app')

@section('content')
<div class="container shadow p-4 mb-4 bg-white" style="background:white; padding:10px">

    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">Pengajuan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">Detail Pengajuan</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            <form method="post" action="{{route('pengajuan.store')}}">
                @csrf
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">Nomor :</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="no" value="{{ $no }}" disabled style="border: 0;background: none;">
                        <input type="hidden" name="nomor" value="{{ $no }}" >
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">NIK :</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" value="{{Auth::user()->nik}}"  disabled style="border: 0;background: none;">
                    </div>
                    <label class="col-md-1 col-form-label text-md-right">Nama :</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" value="{{Auth::user()->name}}"  disabled style="border: 0;background: none;">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">Divisi :</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" value="{{Auth::user()->divisi}}"  disabled style="border: 0;background: none;">
                    </div>
                    <label class="col-md-1 col-form-label text-md-right">Jabatan :</label>
                    <div class="col-md-3">
                        <input type="text" class="form-control" value="{{Auth::user()->jabatan}}"  disabled style="border: 0;background: none;">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">Pembayaran :</label>
                    <div class="col-md-7">
                        <div class="radio">
                            <label class="radio-inline"><input type="radio" name="pembayaran" value="c">Cash  &nbsp &nbsp</label>
                            <label class="radio-inline"><input type="radio" name="pembayaran" value="t">Transfer</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">Nomor Rekening Transfer :</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="nomor_rekening">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">Nama Bank :</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="bank">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">a/n Rekening :</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="atas_nama">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right">Email :</label>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="email">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right"></label>
                    <div class="col-md-7">
                        <button class="btn btn-primary">Ajukan</button>
                    </div>
                </div>
            </form>
        </div>
    
        <div id="menu1" class="container tab-pane fade"><br>
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
                                        <input type="text" class="form-control" name="nomor" placeholder="nomor">
                                        <input type="text" class="form-control" name="user_id" placeholder="user_id">
                                        <input type="text" class="form-control" name="item" placeholder="item">
                                        <input type="number" class="form-control" name="satuan" placeholder="satuan">
                                        <input type="number" class="form-control" name="harga" placeholder="harga">
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
                        <td>{{ $detail->name }}</td>
                        <td>{{ number_format($detail->quantity) }}</td>
                        <td>{{ number_format($detail->price) }}</td>
                        <td>{{ number_format($detail->quantity * $detail->price) }}</td>
                        <td>
                            <a href="">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

</div>

@endsection