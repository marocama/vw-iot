@extends('layouts.main')

@section('content')
@include('includes.alerts')
@foreach($alerts as $alert)
<div class="alert bg-{{$alert->color}} text-white shadow mb-3 alert-dismissible fade show" role="alert">
    <strong><i class="icon fa fa-fw fa-{{$alert->symbol}} mr-2"></i></strong>{{$alert->name}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endforeach
@if (strtotime('now') > strtotime(Auth::user()->expiration))
<div class="alert bg-danger text-white shadow mb-3 alert-dismissible fade show" role="alert">
    <strong><i class="icon fa fa-fw fa-times mr-2"></i></strong>Seu plano de serviços expirou! Para continuar utilizando nossos serviços, entre em contato com o suporte.
</div>
@elseif (strtotime('+3 day') > strtotime(Auth::user()->expiration))
<div class="alert bg-warning text-white shadow mb-3 alert-dismissible fade show" role="alert">
    <strong><i class="icon fa fa-fw fa-times mr-2"></i></strong>Seu plano de serviços está prestes a expirar! Entre em contato com o suporte para evitar a suspensão de seus serviços.
</div>
@endif
<div class="d-sm-flex align-items-center justify-content-between mb-4 d-none d-sm-block">
    <h1 class="h3 mb-0 text-gray-800">Painel</h1>
    <a href="#" class="btn btn-primary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-arrow-right"></i>
        </span>
        <span class="text">Área de Monitoramento</span>
    </a>
</div>
<div class="d-block d-sm-none">
    <a href="#" class="btn btn-primary btn-block">
        <span class="icon text-white-50">
            <i class="fas fa-arrow-circle-right"></i>
        </span>
        <span class="text">Monitorar</span>
    </a>
    <br>
</div>
<div class="row">
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Transmissores</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $transmitters }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-microchip fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->user_type == "Master")   
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Operadores</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $operators }} de 3</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-4 ml-2">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $operators * 33 + 1}}%" aria-valuenow="{{ $operators * 33 + 1 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-id-badge fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Últ. Atualização</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if ($lastPack != null)
                                @if (date('d/m/Y') == $lastPack->format('d/m/Y'))
                                    Hoje, às {{ $lastPack->format('H:i') }}
                                @elseif (date('d/m/Y', strtotime('yesterday')) == $lastPack->format('d/m/Y'))
                                    Ontem, às {{ $lastPack->format('H:i') }}
                                @else
                                    {{ $lastPack->format('d/m/Y à\s H:i') }}
                                @endif
                            @else
                                Sem registros
                            @endif
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
