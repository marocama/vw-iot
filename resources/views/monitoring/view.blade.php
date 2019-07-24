@extends('layouts.main')

@section('content')
@include('includes.alerts')
<div class="alert bg-primary text-white shadow text-right">
@if($interaction[0]->id != 4985)
    <strong><i class="icon fa fa-clock mr-1"></i></strong>
    @if (date('d/m/Y') == date('d/m/Y', strtotime($readouts[0]->created_at)))
        Hoje, às {{ date('H:i', strtotime($readouts[0]->created_at)) }}
    @elseif (date('d/m/Y', strtotime('yesterday')) == date('d/m/Y', strtotime($readouts[0]->created_at)))
        Ontem, às {{ date('H:i', strtotime($readouts[0]->created_at)) }}
    @else
        {{ date('d/m/Y à\s H:i', strtotime($readouts[0]->created_at)) }}
    @endif
@endif
    <strong><i class="icon fa fa-microchip ml-4"></i></strong> {{ $transmitter[0]->name }}
    <strong><i class="icon fa fa-folder mr-1 ml-4"></i></strong> {{ $interaction[0]->name }}
</div>
@include($interaction[0]->path)
@endsection
