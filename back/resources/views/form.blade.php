@extends('layouts.app')

@section('content')
<div class="form-group row">
    <div class="col-md-6">
        <a href="" data-toggle="modal" data-target="#myModal">
            + tambah detail
        </a>

        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{url('add')}}" method="post">
                            @csrf
                            <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                            <input type="text" class="form-control" name="id" placeholder="id">
                            <input type="text" class="form-control" name="name" placeholder="name">
                            <input type="number" class="form-control" name="price" placeholder="price">
                            <input type="number" class="form-control" name="quantity" placeholder="quantity">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="container">
    <form action="{{url('add')}}" method="post">
        <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
        <input type="text" class="form-control" name="id" placeholder="id">
        <input type="text" class="form-control" name="name" placeholder="name">
        <input type="number" class="form-control" name="price" placeholder="price">
        <input type="number" class="form-control" name="quantity" placeholder="quantity">
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div> -->

@if (count($data)>0)
<div class="container">
    <table class="table table-striped">
        <tr>
            <td>ID</td>
            <td>item</td>
            <td>satuan</td>
            <td>harga</td>
            <td>jumlah</td>
            <td>hapus</td>
        </tr>
        @foreach($data as $detail)
        <tr>
            <td>{{ $detail->id }}</td>
            <td>{{ $detail->name }}</td>
            <td>{{ $detail->quantity }}</td>
            <td>{{ number_format($detail->price) }}</td>
            <td>{{ number_format($detail->price * $detail->quantity) }}</td>
            <td>
                <a href="">hapus</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endif

@endsection