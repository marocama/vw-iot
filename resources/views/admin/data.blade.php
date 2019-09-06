@extends('layouts.main')

@section('content')
@include('includes.alerts')
<div class="row">
	<div class="col-lg-7">
		<div class="card shadow mb-4 border-left-primary">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Apagar Dados Até</h6>
			</div>
			<div class="card-body">
				<form role="form" method="POST" action="{{ route('admin.data.delete') }}">
					{!! method_field('delete') !!}
					{!! csrf_field() !!}
					<div class="form-row">
						<div class="form-group col-md-8">
							<input type="date" id="period" name="period" class="form-control" required>
						</div>
						<div class="form-group col-md-4">
							<button type="submit" class="btn btn-primary btn-block"><i class="fas fa-trash-alt fa-fw"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-5">
		<div class="card shadow mb-4 border-left-primary">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Detalhes</h6>
			</div>
			<div class="card-body text-center">
				<a class="btn btn-primary text-white shadow mr-3 mb-2">Protocolos: <strong>{{ $totalReadouts }}</strong></a>
				<a class="btn btn-primary text-white shadow mb-2">Transmissores: <strong>{{ $totalTransmitter }}</strong></a>
			</div>
		</div> 
	</div>
</div>
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Dados Antigos</h6>
    </div>
    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">Data</th>
						<th scope="col">Transmissor</th>
						<th scope="col">Usuário</th>
						<th scope="col" class="text-center">Status</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($readouts as $readout)
					<tr>
						<td class="align-middle">
							@if (date('d/m/Y') == date('d/m/Y', strtotime($readout->created_at)))
							Hoje
							@elseif (date('d/m/Y', strtotime('yesterday')) == date('d/m/Y', strtotime($readout->created_at)))
							Ontem
							@elseif (date('d/m/Y', strtotime('tomorrow')) == date('d/m/Y', strtotime($readout->created_at)))
							Amanhã
							@else
							{{ date('d/m/Y', strtotime($readout->created_at)) }}
							@endif 
						</td>
						<td class="align-middle">{{ $readout->transmitter->name }}</td>
						<td class="align-middle">{{ $readout->transmitter->user->name }}</td>
						<td class="align-middle text-center">
							@if ($readout->transmitter->user->expiration > date('Y-m-d H:i:s'))
                        	<i class="fas fa-check-circle text-success"></i>
                    		@else
                        	<i class="fas fa-times-circle text-danger"></i>
                     		@endif
						</td>
					</tr>
					@empty
					<tr>
						<th colspan="3">Nenhum dado para exibir.</th>
					</tr>
					@endforelse
				</tbody>
			</table>
    	</div>
    </div>
</div>
@endsection