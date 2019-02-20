@extends('layouts.app')
@section('content')
<div class="container">
    <p><h4>PENGAJUAN DANA</h4>
    <div class="table-responsive">
        <p><table class="table table-hover">
            <thead>
                <tr>
                    <th>Divisi</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tujuan Pengajuan</th>
                    <th>Nomor Pengajuan</th>
                    <th>Pembayaran</th>
                    <th>Total Pengajuan</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($details as $detail)
                <tr>
                <td>{{$detail->divisi}}</td>
                    <td>{{$detail->created_at}}</td>
                    <td>{{$detail->tujuan}}</td>
                    <td>
                        <a href="{{route('persetujuanpengajuandirektur.show', $detail->nomor)}}">{{$detail->nomor}}</a>
                    </td>
                    <td>
                        @if($detail->pembayaran == 't')
                            Transfer
                        @else
                            Cash
                        @endif
                    </td>
                    <td>Rp. {{number_format($detail->total)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
