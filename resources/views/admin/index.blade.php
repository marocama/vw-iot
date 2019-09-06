@extends('layouts.main')

@section('content')
@include('includes.alerts')
@if ($users->isEmpty() && $transmitters->isEmpty() && Route::getCurrentRoute()->getName() == 'admin.query')
<div class="alert bg-warning text-white shadow mb-3 alert-dismissible fade show" role="alert">
	<strong><i class="icon fa fa-fw fa-exclamation-circle mr-2"></i></strong>Nenhum usuário/transmissor encontrado com as informações fornecidas.
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>
@endif
<div class="card shadow mb-4 border-left-secondary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-secondary">Consulta</h6>
    </div>
    <div class="card-body">
        <form role="form" method="POST" action="{{ route('admin.query') }}">
			{!! csrf_field() !!}
			<div class="form-row">
				<div class="form-group col-md-11">
      				<input type="text" id="search" name="search" class="form-control" placeholder="Nome, Email, Telefone, Número Serial, etc" autofocus>
				</div>
				<div class="form-group col-md-1 d-none d-sm-block">
					<button type="submit" class="btn btn-secondary btn-block"><i class="fas fa-search"></i></button>
				</div>
				<div class="form-group col-md-12 d-block d-sm-none">
					<button type="submit" class="btn btn-secondary btn-block">Pesquisar</button>
				</div>
			</div>
		</form>
    </div>
</div>
@if (!$users->isEmpty())
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Usuários</h6>
    </div>
    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col" style="width:10%"></th>
						<th scope="col">Nome</th>
						<th scope="col">Email</th>
						<th scope="col">Contato</th>
						<th scope="col">Vencimento</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<th scope="row" class="text-center align-middle">
							<form role="form" method="POST" action="{{ route('admin.user.view') }}">
                    			{!! csrf_field() !!}
								<input type="hidden" name="identify" value="{{$user->id}}">
                    			<button type="submit" class="btn btn-primary btn-sm text-white my-1 mx-1"><i class="fas fa-eye"></i></button>
                			</form>
							<a class="btn btn-danger btn-sm text-white my-1 mx-1" data-toggle="modal" data-target="#delModal1" onClick="deleteUser({{$user->id}})"><i class="fas fa-trash-alt"></i></a>
						</th>
						<td class="align-middle">{{ $user->name }}</td>
						<td class="align-middle">{{ $user->email }}</td>
						<td class="align-middle phone">{{ $user->phone }}</td>
						<td class="align-middle @if(strtotime($user->expiration) > strtotime('+20 days')) text-success @elseif(strtotime($user->expiration) > strtotime('now')) text-warning @else text-danger @endif">
							@if (date('d/m/Y') == date('d/m/Y', strtotime($user->expiration)))
							Hoje
							@elseif (date('d/m/Y', strtotime('yesterday')) == date('d/m/Y', strtotime($user->expiration)))
							Ontem
							@elseif (date('d/m/Y', strtotime('tomorrow')) == date('d/m/Y', strtotime($user->expiration)))
							Amanhã
							@else
							{{ date('d/m/Y', strtotime($user->expiration)) }}
							@endif 
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
    	</div>
    </div>
</div>
@endif
@if (!$transmitters->isEmpty())
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transmissores</h6>
    </div>
    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col" style="width:10%"></th>
						<th scope="col">Identificador</th>
						<th scope="col">Registro</th>
						<th scope="col" class="text-center">Status</th>
					</tr>
				</thead>
				<tbody>
					@foreach($transmitters as $transmitter)
					<tr>
						<th scope="row" class="text-center align-middle">
							<form role="form" method="POST" action="{{ route('admin.tran.view') }}">
                    			{!! csrf_field() !!}
								<input type="hidden" name="identify" value="{{$transmitter->id}}">
                    			<button type="submit" class="btn btn-primary btn-sm text-white my-1 mx-1"><i class="fas fa-eye"></i></button>
                			</form>
							<a class="btn btn-danger btn-sm text-white my-1 mx-1" data-toggle="modal" data-target="#delModal2" onClick="deleteTran({{ $transmitter->id }})"><i class="fas fa-trash-alt"></i></a>
						</th>
						<td class="align-middle">{{ $transmitter->name }}</td>
						<td class="align-middle">{{ $transmitter->number_serial }}</td>
						<td class="text-center align-middle">
							@if ($transmitter->status)
								<i class="fas fa-check-circle text-success"></i>
							@else
								<i class="fas fa-times-circle text-danger"></i>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
    	</div>
    </div>
</div>
@endif
<div class="modal fade" id="delModal1" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delModalLabel"><i class="fas fa-fw fa-trash-alt mr-2"></i>Deletar Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja deletar este usuário?
            </div>
            <div class="modal-footer">
                <form role="form" method="POST" action="{{ route('admin.user.del') }}">
                    {!! method_field('delete') !!}
                    {!! csrf_field() !!}
                    <input type="hidden" name="identify1" id="identify1" value="">
                    <button type="submit" id="deleteButton" class="btn btn-secondary">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delModal2" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delModalLabel"><i class="fas fa-fw fa-trash-alt mr-2"></i>Deletar Transmissor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja deletar este transmissor?
            </div>
            <div class="modal-footer">
                <form role="form" method="POST" action="{{ route('admin.transmitter.del') }}">
                    {!! method_field('delete') !!}
                    {!! csrf_field() !!}
                    <input type="hidden" name="identify2" id="identify2" value="">
                    <button type="submit" id="deleteButton" class="btn btn-secondary">Confirmar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script type="text/javascript">

    $(function(){  
        var masks = ['(00) 00000-0000', '(00) 0000-00009'];
        $('.phone').mask(masks[1], {onKeyPress: 
            function(val, e, field, options) {
                field.mask(val.length > 14 ? masks[0] : masks[1], options) ;
            }
        });
    });

	function deleteUser($identify){
        document.getElementById("identify1").value = $identify;
    }
	function deleteTran($identify){
        document.getElementById("identify2").value = $identify;
    }
</script>
@endsection