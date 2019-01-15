@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if(empty($user->role))
                        <h5>Assalamu'alaikum {{$user->name}},</h5>
                        <h5>Saat ini anda belum memiliki akses apapun.</h5>
                        <h5>mohon menghubungi Admin!!!</h5>
                    @else
                        @foreach($menu as $pilih)
                        
                        <a href="{{route($pilih->route)}}">{{$pilih->name}}</a>

                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
