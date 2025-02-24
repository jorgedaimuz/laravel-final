@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Dashboard</h1>
    @if($flag)
        <img src="{{ $flag['flag'] }}" alt="Bandera de {{ $flag['name'] }}" style="max-width: 300px;">
    @endif
    <div class="mt-3">
        <a href="{{ route('flags.index') }}" class="btn btn-primary">Jugar</a>
    </div>
</div>
@endsection
