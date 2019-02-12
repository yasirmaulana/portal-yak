@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <h4>Formulir Edit Data Coa</h4>
    <br>
    <form method="post" action="{{route('coa.update', $data[0]->id)}}">
        @csrf
        @method('PUT')
        <div class="form-group row"> 
            <label class="col-md-2 col-form-label">Code COA :</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="kode_coa" value="{{$data[0]->kode_budget}}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Deskripsi :</label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="deskripsi" value="{{$data[0]->deskripsi}}">
            </div>
        </div>
        <button class="btn btn-success">Ajukan</button>
        <a href="{{route('coa.index')}}" class="btn btn-warning">Batal</a>
    </form>
    

</div>

@endsection