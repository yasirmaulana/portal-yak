@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Form Input Realisasi</h3><p>
    <!-- <b>Nomor Pengajuan : </b><p> -->
    
    <!-- {{$detail}} -->
    <form action="{{route('lpjr.update', $detail[0]->id)}}" method="post">
        @csrf
        @method('PUT')
        <p><input type="hidden" name="nomor" value="{{$detail[0]->nomor}}">
        <p><input disabled type="text" class="form-control" name="item" value="{{$detail[0]->item}}">
        <p><input disabled type="text" class="form-control" name="rab" value="{{$detail[0]->total}}">
        <p><input type="number" class="form-control" name="realisasi" placeholder="realisasi (tulis tanpa titik)">
        <p><button type="submit" class="btn btn-success">Isi Realisasi</button>
    </form>

</div>

@endsection