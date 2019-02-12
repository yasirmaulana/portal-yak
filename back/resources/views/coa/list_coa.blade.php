@extends('layouts.app')
@section('content')
<div class="container">
    <p><h4>DATA COA</h4>
    <p><p><a href="" class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Data Coa</a>

    <div class="table-responsive">
        <p><table class="table table-hover">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Kode COA</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($daftarCoa as $coa)
                <tr>
                    <td>{{$coa->id}}</td>
                    <td>{{$coa->kode_budget}}</td>
                    <td>{{$coa->deskripsi}}</td>
                    <td>
                        <a href="{{route('coa.edit', $coa->id)}}" class="btn btn-info">Edit</a>
                        <!--Edit Modal -->
                        <!-- <div class="modal fade" id="editModal" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="{{route('coa.update', $coa->id)}}" method="post">
                                            @csrf
                                            {{$coa->id}}
                                            <p><input type="text" class="form-control" name="kode_coa" placeholder="Kode_COA">
                                            <p><input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi">
                                            <p><button type="submit" class="btn btn-info">Edit Data COA</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!--Add Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="{{route('coa.store')}}" method="post">
                        @csrf
                        <p><input type="text" class="form-control" name="kode_coa" placeholder="Kode_COA">
                        <p><input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi">
                        <p><button type="submit" class="btn btn-success">Tambah Data COA</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
