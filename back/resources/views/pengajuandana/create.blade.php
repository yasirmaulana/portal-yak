@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" action="{{ route('pengajuandana.store') }}">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="form-group row">
                        <label class="col-md-6 col-form-label text-md-left"><b>Formulir Pengajuan Dana</b></label>
                        <label for="nomor" class="col-md-3 col-form-label text-md-right">Nomor :</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="no" value="{{ $no }}" disabled style="border: 0;background: none;">
                            <input type="hidden" name="nomor" value="{{ $no }}" >
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nik"  class="col-md-2 col-form-label text-md-right">NIK :</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" value="13034543" disabled>
                        </div>
                        <label for="nama"  class="col-md-2 col-form-label text-md-right">Nama :</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" value="Yasir" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="divisi"  class="col-md-2 col-form-label text-md-right">Divisi :</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" value="IT" disabled>
                        </div>
                        <label for="jabatan"  class="col-md-2 col-form-label text-md-right">Jabatan :</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" value="Staf" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                    
                    </div>
                    <div class="form-group row">
                        <label for="pembayaran"  class="col-md-4 col-form-label text-md-right">Pembayaran :</label>
                        <div class="col-md-6">
                            <div class="radio">
                                <label class="radio-inline"><input type="radio" name="pembayaran" value="c">Cash  &nbsp &nbsp</label>
                                <label class="radio-inline"><input type="radio" name="pembayaran" value="t">Transfer</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nomor_rekening"  class="col-md-4 col-form-label text-md-right">Nomor Rekening Transfer :</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="nomor_rekening">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bank"  class="col-md-4 col-form-label text-md-right">Nama Bank :</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="bank">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="an"  class="col-md-4 col-form-label text-md-right">a/n Rekening :</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="atas_nama">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email :</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <!-- <label for="" class="col-md-4 col-form-label text-md-right"></label> -->
                        <div class="col-md-6">
                            <a href="" data-toggle="modal" data-target="#myModal">
                                + tambah detail
                            </a>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <input type="text" class="form-control" name="no" value="nomor {{ $no }}" disabled style="border: 0;background: none;">
                                        <input type="text" class="form-control" name="item" placeholder="item">
                                        <input type="text" class="form-control" name="qty" placeholder="qty">
                                        <input type="text" class="form-control" name="harga" placeholder="harga">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                 </div>
                                
                                </div>
                            </div>

                        </div>
                    </div>
                    {{ $tes }}
                    
                    @if( $tes > 1)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Item</th>
                            <th>ty</th>
                            <th>@Harga</th>
                            <th>Jumlah</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>mouse dan mouse dan mouse dan mouse dan mouse dan mouse dan mouse dan mouse</td>
                            <td>1</td>
                            <td>100000</td>
                            <td>100000</td>
                            <td>
                                <a href="">Edit</a>
                                <a href="">Hapus</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    @endif
                    
                    <div class="form-group row">
                        <div class="col-md-6">
                            <button class="btn btn-primary">Ajukan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        </div>
    </div>
</div>
@endsection