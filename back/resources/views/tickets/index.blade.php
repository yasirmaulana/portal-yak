@extends('layouts.app')
@section('content')


<div class="container">
    <h4>Daftar Antrian Problem IT </h4>    
    <a href="" data-toggle="modal" data-target="#myModal" class="btn btn-success">Buat Tiket Problem</a>
    <p></p>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Formulir Buat Tiket</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{route('ticket.store')}}" method="post">
                        @csrf
                        <p><input type="hidden" class="form-control" name="user_id" placeholder="user_id" value="{{Auth::user()->id}}">
                        <p><select class="form-control" id="sel1" name="jenis">
                                <option>Jenis</option>
                                <option>Hardware</option>
                                <option>Software</option>
                                <option>Network</option>
                            </select>
                        <p><input type="text" class="form-control" name="subjek" placeholder="subjek">
                        <p><textarea class="form-control" rows="5" name="deskripsi" placeholder="deskripsi"></textarea>
                        <p><button type="submit" class="btn btn-success">Buat Tiket</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                        <th>PIC</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                    <tr >
                        <td>{{$ticket->id}}</td>
                        <td>{{$ticket->created_at}}</td>
                        <td>{{$ticket->name}}</td>
                        <td>{{$ticket->divisi}}</td>
                        <td>{{$ticket->jenis}}</td>
                        <td>{{$ticket->subjek}}</td>
                        <td>{{$ticket->deskripsi}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>


@endsection
