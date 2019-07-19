@extends('layouts.main')

@section('content')
@include('includes.alerts')
<div class="alert bg-primary text-white shadow text-right">
    <strong><i class="icon fa fa-microchip mr-1"></i></strong> {{ $transmitter[0]->name }}
    <strong><i class="icon fa fa-folder mr-1 ml-4"></i></strong> {{ $interaction[0]->name }}
</div>
@include($interaction[0]->path)
@endsection
