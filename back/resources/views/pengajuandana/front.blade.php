@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
                <h4>PENGAJUAN DANA</h4>
        <!-- <div class="card"> -->
            <!-- <div class="card-header"> -->
            <!-- </div> -->

            <!-- <div class="card-body"> -->
                <div class="table-responsive">
                <p><a href="{{ route('pengajuan.create') }}" class="btn btn-success">Isi Formulir Pengajuan</a><p>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal Pengajuan</th>
                                <th>Nomor</th>
                                <th>Pembayaran</th>
                                <th>No Rekening</th>
                                <th>Atas Nama</th>
                                <th>Email</th>
                                <th>Proses</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengajuandana as $detail) 
                            <tr>
                                <td>{{$detail->created_at}}</td>
                                <td>
                                    <a href="{{route('pengajuandetail.edit', $detail->nomor)}}">
                                        {{$detail->nomor}}
                                    </a>
                                </td>
                                <td>
                                    @if($detail->pembayaran == 't')
                                        Transfer
                                    @else
                                        Cash
                                    @endif
                                </td>
                                <td>{{$detail->nomor_rekening}}</td>
                                <td>{{$detail->atas_nama}}</td>
                                <td>{{$detail->email}}</td>
                                <td>{{$detail->progres}}</td>
                                <td>
                                    <form action="route('pengajuan.update', $detail->id)">
                                        @csrf
                                        @if($detail->statusdisetujui==1)
                                            <button type="submit" class="btn btn-warning">Batal</button>
                                        @else
                                            <button disabled type="submit" class="btn btn-info">Menunggu...</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            <!-- </div> -->
        </div>
    </div>
 

    
</div>
@endsection
