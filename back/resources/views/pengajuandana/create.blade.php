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
            <div class="jumbotron">
                DISCLIMER:
                <ul>
                    <li>dengan mengajukan formulir ini, berarti...</li>
                    <li>apabila dana belum masuk, tunggu 3x24 jam.</li>
                    <li>setiap pengaju adalah otomatis bertanggun jawab untuk mengembalikan.</li>
                    <li>batas pengajuan</li>
                </ul>
            </div>
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
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="progres" value="manager">
                <input type="hidden" name="statusdisetujui" value="w">
                <input type="hidden" name="statusopen" value="y">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label text-md-right"></label>
                    <div class="col-md-7">
                        <button class="btn btn-primary">Ajukan</button>
                        <a href="{{route('pengajuan.index')}}" class="btn btn-warning">Batal</a>
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
                                        <input type="text" class="form-control" name="nomor" placeholder="nomor" value="{{$no}}" style="border: 0;background: none;">
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
                            <a href="">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

</div>

@endsection