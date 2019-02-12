@extends('layouts.app')
@section('content')
<div class="container">
    <h4>PENGAJUAN DANA</h4>
    <div class="table-responsive">
        <p><a href="{{ route('pengajuan.create') }}" class="btn btn-success">Isi Formulir Pengajuan</a><p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <th>Nomor</th>
                    <th>Pembayaran</th>
                    <th>Nama Bank</th>
                    <th>No Rekening</th>
                    <th>Atas Nama</th>
                    <th>Email</th>
                    <th>Proses</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengajuandana as $detail) 
                <tr>
                    <td>{{$detail->created_at}}</td>
                    <td>
                        <a href="{{route('pengajuanedit.edit', $detail->nomor)}}">
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
                    <td>{{$detail->bank}}</td>
                    <td>{{$detail->nomor_rekening}}</td>
                    <td>{{$detail->atas_nama}}</td>
                    <td>{{$detail->email}}</td>
                    <td>{{$detail->progres}}</td>
                    <td>
                        <form action="{{route('pengajuan.destroy', $detail->nomor)}}" method="post">
                            @csrf
                            @method('DELETE')
                            @if($detail->statusdisetujui==1)
                                <button type="submit" class="btn btn-warning">Batal</button>
                            @elseif($detail->statusdisetujui==0)
                                <button disabled class="btn btn-danger">Ditolak</button>
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
</div>
@endsection
