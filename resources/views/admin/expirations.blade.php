@extends('layouts.main')

@section('content')
@include('includes.alerts')
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Vencimentos</h6>
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
					@forelse ($users as $user)
					<tr>
						<th scope="row" class="text-center align-middle">
							<form role="form" method="POST" action="{{ route('admin.user.view') }}">
								{!! csrf_field() !!}
								<input type="hidden" name="identify" value="{{$user->id}}">
								<button type="submit" class="btn btn-primary btn-sm text-white my-1 mx-1"><i class="fas fa-eye"></i></button>
							</form>
							<a class="btn btn-danger btn-sm text-white my-1 mx-1" data-toggle="modal" data-target="#delModal" onClick="deleteUser({{$user->id}})"><i class="fas fa-trash-alt"></i></a>
						</th>
						<td class="align-middle">{{ $user->name }}</td>
						<td class="align-middle">{{ $user->email }}</td>
						<td class="align-middle phone">{{ $user->phone }}</td>
						<td class="align-middle @if($user->expiration > date('Y-m-d H:i:s'))text-warning @else text-danger @endif">
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
					@empty
					<tr>
						<th colspan="5">Nenhum usuário próximo do vencimento.</th>
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
                <h5 class="modal-title" id="delModalLabel"><i class="fas fa-fw fa-trash-alt mr-2"></i>Deletar Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja deletar este usuário?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" role="form" method="POST" action="{{ route('admin.user.del') }}">
                    {!! method_field('delete') !!}
                    {!! csrf_field() !!}
                    <input type="hidden" name="identify1" id="identify1" value="">
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
</script>
@endsection
