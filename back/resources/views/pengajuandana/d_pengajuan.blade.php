@extends('layouts.app')
@section('content')
<div class="container">
direktur
    <p><h4>PENGAJUAN DANA</h4>
    <div class="table-responsive">
        <p><table class="table table-hover">
            <thead>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <th>Nomor</th>
                    <th>Pembayaran</th>
                    <th>Nama Bank</th>
                    <th>No Rekening</th>
                    <th>Atas Nama</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($details as $detail)
                <tr>
                    <td>{{$detail->created_at}}</td>
                    <td>{{$detail->nomor}}</td>
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
                    <td>
                        <a href="{{route('persetujuanpengajuandirektur.show', $detail->nomor)}}" class="btn btn-success">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
