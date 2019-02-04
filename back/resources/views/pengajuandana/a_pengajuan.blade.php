@extends('layouts.app')
@section('content')
<div class="container">
    <p><h4>PENGAJUAN DANA</h4>
    <div class="table-responsive">
        <p><table class="table table-hover">
            <thead>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <th>Nomor</th>
                    <th>Pembayaran</th>
                    <th>No Rekening</th>
                    <th>Atas Nama</th>
                    <th>Email</th>
                    <th>Kode Budget</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $detail)
                <tr>
                    <td>{{$detail->created_at}}</td>
                    <td>
                        <a href="{{route('persetujuanpengajuandana.show', $detail->nomor)}}">
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
                    <td>
                        <form action="/action_page.php">
                            <div class="form-group">
                                <select class="form-control" id="sel1" name="sellist1">
                                    <option>--Pilih--</option>
                                    @foreach($kodebudgets as $kodebudget)
                                    <option value="{{$kodebudget->}}">{{$kodebudget->deskripsi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </td>
                    <td>
                        <a href="{{route('persetujuanpengajuandana.edit', 's'.$detail->nomor)}}" class="btn btn-success">Setuju</a>
                        <a href="{{route('persetujuanpengajuandana.edit', 't'.$detail->nomor)}}" class="btn btn-danger">Tolak</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
