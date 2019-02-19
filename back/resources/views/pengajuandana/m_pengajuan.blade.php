@extends('layouts.app')
@section('content')
<div class="container">
    <p><h4>PENGAJUAN DANA</h4>
    <div class="table-responsive">
        <p><table class="table table-hover">
            <thead>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <th>Divisi</th>
                    <th>Nomor</th>
                    <th>Pembayaran</th>
                    <th>Nama Bank</th>
                    <th>No Rekening</th>
                    <th>Atas Nama</th>
                    <th>Email</th>
                    <th>Total Pengajuan</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($data as $detail)
                <tr>
                    <td>{{$detail->created_at}}</td>
                    <td>{{$detail->divisi}}</td>
                    <td>
                        <a href="{{route('persetujuanpengajuandana.show', $detail->nomor)}}">{{$detail->nomor}}</a>
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
                    <td>Rp. {{number_format($detail->total)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
