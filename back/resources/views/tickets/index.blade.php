@extends('layouts.app')
@section('content')


<div class="container">
    
    {{$tickets}}
    <h4>Daftar Antrian Problem IT </h4>    
    <!-- FORMULIR PENGAJUAN DANA DETAIL -->
    <!-- <div class="col-md-8"> -->
        <a href="" data-toggle="modal" data-target="#myModal" class="btn btn-success">Buat Tiket Problem</a>
        <p></p>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{route('pengajuandetail.store')}}" method="post">
                            @csrf
                            <input type="text" class="form-control" name="nomor" placeholder="nomor" value="" style="border: 0;background: none;">
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
    <!-- </div> -->

    <!-- TABLE DETAIL -->
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tgl Input</th>
                        <th>User</th>
                        <th>Divisi</th>
                        <th>Jenis</th>
                        <th>Subjek</th>
                        <th>Deskripsi</th>
                        <th>Penanganan Oleh</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection
