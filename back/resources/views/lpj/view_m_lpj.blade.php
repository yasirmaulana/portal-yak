@extends('layouts.app')
@section('content')
<div class="container">
    <p><h4>LAPORAN PERTANGGUNG JAWABAN</h4>
    <div class="table-responsive">
        <p><table class="table table-hover">
            <thead>
                <tr>
                    <th>Divisi</th>
                    <th>Tgl Pengajuan</th>
                    <th>Tgl Jatuh Tempo LPJ</th>
                    <th>Tujuan Pengajuan</th>
                    <th>Nomor Pengajuan</th>
                    <th>Pembayaran</th>
                    <th>Total Pengajuan</th> 
                    <th>Total Realisasi</th>
                    <th>Pengembalian</th>

                </tr>
            </thead>
            <tbody> 
                @foreach($details as $detail)
                <tr>
                    <td>{{$detail->divisi}}</td>
                    <td>{{$detail->created_at}}</td>
                    <td>{{$detail->jatuh_tempo_lpj}}</td>
                    <td>{{$detail->tujuan}}</td>
                    <td>
                        <a href="{{route('mlpj.show', $detail->nomor)}}">{{$detail->nomor}}</a>
                    </td>
                    <td>
                        @if($detail->pembayaran == 't')
                            Transfer
                        @else
                            Cash
                        @endif
                    </td>
                    <td>Rp. {{number_format($detail->total)}}</td>
                    <td>Rp. {{number_format($detail->total_realisasi)}}</td>
                    @if($detail->total_realisasi == 0)
                    <td>Rp. {{number_format($detail->total_realisasi)}}</td>
                    @else
                    <td>Rp. {{number_format($detail->total-$detail->total_realisasi)}}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
