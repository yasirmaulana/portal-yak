@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard Pengajuan Dana</div>

                <div class="card-body">
                   <a href="{{ route('pengajuandana.create') }}">Ajukan Dana</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
