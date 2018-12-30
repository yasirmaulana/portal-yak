@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Formulir Pengajuan Dana
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('pengajuandana.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="nomor" class="col-md-4 col-form-label text-md-right">Nomor :</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="no" value="{{ $no }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nik"  class="col-md-4 col-form-label text-md-right">NIK :</label>
                        
                        </div>
                        <div class="form-group row">
                            <label for="nama"  class="col-md-4 col-form-label text-md-right">Nama :</label>
                            <div class="col-md-6">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="divisi"  class="col-md-4 col-form-label text-md-right">Divisi :</label>
                        
                        </div>
                        <div class="form-group row">
                            <label for="jabatan"  class="col-md-4 col-form-label text-md-right">Jabatan :</label>
                        
                        </div>
                        <div class="form-group row">
                            <label for="pembayaran"  class="col-md-4 col-form-label text-md-right">Pembayaran :</label>
                            <div class="col-md-6">
                                <div class="radio">
                                    <label class="radio-inline"><input type="radio" name="optpembayaran" value="c">Cash  &nbsp &nbsp</label>
                                    <label class="radio-inline"><input type="radio" name="optpembayaran" value="t">Transfer</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="norek"  class="col-md-4 col-form-label text-md-right">Nomor Rekening Transfer :</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="norek">
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
                                <input type="text" class="form-control" name="an">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email :</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary">Ajukan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection