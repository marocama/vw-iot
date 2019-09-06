@extends('layouts.main')

@section('content')
@include('includes.alerts')
<div class="alert bg-primary text-white shadow d-flex flex-wrap align-items-center justify-content-sx-between">
	<div class="col-md-3 custom-control-inline align-items-center">
		<strong><i class="icon fa fa-calendar-day mr-1"></i></strong>
		<form role="form" method="POST" action="{{ route('monitoring') }}">
			{!! csrf_field() !!}
			<input type="hidden" name="transmitter" id="transmitter" value="{{ $transmitter->number_serial }}">
			<select name="selection" class="custom-select custom-select-sm ml-2" onchange="this.form.submit()">
				@forelse ($readouts as $readout)
				<option value="{{$readout->created_at}}" @if($selection->created_at == $readout->created_at) selected class="bg-secondary text-white" @endif>
					@if (date('d/m/Y') == date('d/m/Y', strtotime($readout->created_at)))
					Hoje, às {{ date('H:i', strtotime($readout->created_at)) }}
					@elseif (date('d/m/Y', strtotime('yesterday')) == date('d/m/Y', strtotime($readout->created_at)))
					Ontem, às {{ date('H:i', strtotime($readout->created_at)) }}
					@else
					{{ date('d/m/Y à\s H:i', strtotime($readout->created_at)) }}
					@endif
				</option>
				@empty
					<option>Nenhum dado disponível</option>
				@endforelse
			</select>
		</form>
	</div>
	<div class="col-md-2" data-toggle="tooltip" data-placement="bottom" title="Identificador do Transmissor">	
		<strong><i class="icon fa fa-microchip mr-1"></i></strong> {{ $transmitter->name }}
	</div>
	<div class="col-md-2" data-toggle="tooltip" data-placement="bottom" title="Interface">
		<strong><i class="icon fa fa-folder mr-1"></i></strong> {{ $transmitter->interaction->name }}
	</div>
	<div class="col-md-1 ml-auto">
		<a class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#markModal"><strong><i class="icon fa fa-tag mr-1"></i></strong></a>
	</div>
</div>
<div class="modal fade" id="markModal" tabindex="-1" role="dialog" aria-labelledby="markModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel"><i class="fas fa-tag mr-2"></i> Personalizar Tags</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
				<ul class="list-group list-group-flush">
					@forelse ($marks as $mark)
					<li class="list-group-item @if($transmitter->mark_id == $mark->id) active @endif">
						<form role="form" method="POST" action="{{ route('monitoring.mask') }}">
							{!! csrf_field() !!}
							<input type="hidden" name="identify" value="{{$mark->id}}">
							<input type="hidden" name="transmitter" value="{{$transmitter->number_serial}}">
							<button type="submit" class="btn btn-block @if($transmitter->mark_id == $mark->id) text-white @endif">{{$mark->name}}</button>
						</form>
					</li>
					@empty
					<li class="list-group-item">Nenhuma máscara disponível</li>
					@endforelse
				</ul>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#newMarkModal"><i class="fas fa-plus-circle mr-1"></i> Nova Máscara</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="newMarkModal" tabindex="-1" role="dialog" aria-labelledby="newMarkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel"><i class="fas fa-plus-circle mr-2"></i> Nova Máscara</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			<form role="form" method="POST" action="{{ route('mark.new') }}">
				{!! csrf_field() !!}
				<div class="modal-body text-center">
					<div class="form-group row">
						<label class="col-4 col-form-label"><strong>Identificador:</strong></label>
						<div class="col-8">
							<input type="text" class="form-control" name="identify" required maxlength="20" placeholder="Máscara 1">
						</div>
					</div>
					<hr>
					@forelse ($selection->protocol as $key => $value)
						<div class="form-group row">
							<label class="col-2 col-form-label">{{strtoupper($key)}}:</label>
							<div class="col-10">
								<input type="text" class="form-control" name="{{$key}}" required maxlength="20" placeholder="Digite aqui...">
							</div>
						</div>
					@empty
						Nenhum dado disponível.
					@endforelse
				</div>
				<input type="hidden" name="interface" value="{{$transmitter->interaction->id}}">
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
        </div>
    </div>
</div>
@include($transmitter->interaction->path)
@endsection