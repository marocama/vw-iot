@extends('layouts.main')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
@include('includes.alerts')
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registrar</h6>
    </div>
    <div class="card-body">
        <form role="form" method="POST" action="{{ route('admin.register') }}">
			{!! csrf_field() !!}
    		<div class="form-group">
    			<textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="2" placeholder="Digite sua mensagem aqui." autofocus required></textarea>
                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
			</div>
			<div class="form-row">
				<div class="form-group col-md-3">
					<select class="form-control" style="font-family:'FontAwesome', Arial;" name="symbol">
						<option selected value="clock">&#xf017;</option>
						<option value="times-circle">&#xf057;</option>
						<option value="check-circle">&#xf058;</option>
						<option value="info-circle">&#xf05a;</option>
						<option value="calendar">&#xf133;</option>
						<option value="wifi">&#xf1eb;</option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<select class="form-control" name="color">
						<option selected value="primary" class="text-primary">Azul</option>
						<option value="success" class="text-success">Verde</option>
						<option value="secondary" class="text-secondary">Cinza</option>
						<option value="warning" class="text-warning">Amarelo</option>
						<option value="danger" class="text-danger">Vermelho</option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<input type="date" id="period1" name="period1" class="form-control" required>
				</div>
				<div class="form-group col-md-3">
					<input type="time" id="period2" name="period2" class="form-control" required>
				</div>
			</div>
    		<button type="submit" class="btn btn-primary btn-block">Enviar</button>
		</form>
    </div>
</div>
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Alertas Públicos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col" style="width:10%"></th>
						<th scope="col">Exibição Até</th>
						<th scope="col">Alerta</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($alerts as $alert)
					<tr>
						<th scope="row" class="text-center align-middle">
							<a class="btn btn-danger btn-sm text-white my-1 mx-1" data-toggle="modal" data-target="#delModal" onClick="deleteAlert({{$alert->id}})"><i class="fas fa-trash-alt"></i></a>
						</th>
						<td class="align-middle">{{ date('d/m/Y H:i', strtotime($alert->period)) }}</td>
						<td class="align-middle">
							<div class="alert bg-{{$alert->color}} text-white shadow mb-3 alert-dismissible fade show" role="alert">
    							<strong><i class="icon fa fa-fw fa-{{$alert->symbol}} mr-2"></i></strong>{{ $alert->name }}
  							</div>
						</td>
					</tr>
					@empty
					<tr>
						<th colspan="3">Nenhum alerta para exibir.</th>
					</tr>
					@endforelse
				</tbody>
			</table>
    	</div>
    </div>
</div>
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delModalLabel"><i class="fas fa-fw fa-trash-alt mr-2"></i>Deletar Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja deletar este alerta?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" role="form" method="POST" action="{{ route('admin.alert.del') }}">
                    {!! method_field('delete') !!}
                    {!! csrf_field() !!}
                    <input type="hidden" name="identify" id="identify" value="">
                    <button type="submit" id="deleteButton" class="btn btn-secondary">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

	function deleteAlert($identify){
        document.getElementById("identify").value = $identify;
    }
</script>
@endsection