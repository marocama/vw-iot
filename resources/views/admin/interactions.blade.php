@extends('layouts.main')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
@include('includes.alerts')
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registrar</h6>
    </div>
    <div class="card-body">
        <form role="form" method="POST" action="{{ route('admin.interaction.register') }}">
			{!! csrf_field() !!}
			<div class="form-row">
				<div class="form-group col-md-2">
					<input type="text" class="form-control" name="code" placeholder="Código (XXXX)" required>
				</div>
				<div class="form-group col-md-4">
					<input type="text" class="form-control" name="name" placeholder="Nome" required>
				</div>
				<div class="form-group col-md-6">
					<input type="text" class="form-control" name="description" placeholder="Descrição" required>
				</div>
			</div>
    		<button type="submit" class="btn btn-primary btn-block">Salvar</button>
		</form>
    </div>
</div>
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Interfaces Disponíveis</h6>
    </div>
    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">Código</th>
						<th scope="col">Nome</th>
						<th scope="col">Descrição</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($interactions as $interaction)
					<tr>
						<td class="align-middle">{{ $interaction->id }}</td>
						<td class="align-middle">{{ $interaction->name }}</td>
						<td class="align-middle">{{ $interaction->description }}</td>
					</tr>
					@empty
					<tr>
						<th colspan="3">Nenhuma interface para exibir.</th>
					</tr>
					@endforelse
				</tbody>
			</table>
    	</div>
    </div>
</div>
@endsection