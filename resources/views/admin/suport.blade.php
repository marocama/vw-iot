@extends('layouts.main')

@section('content')
@include('includes.alerts')
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Suporte</h6>
    </div>
    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead> 
					<tr>
						<th scope="col" style="width:10%"></th>
						<th scope="col">Nome</th>
						<th scope="col">Data</th>
						<th scope="col" style="width:45%">Mensagem</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($messages as $message)
					<tr>
						<th scope="row" class="text-center align-middle">
							<a class="btn btn-primary btn-sm text-white my-1 mx-1" href="mailto:{{$message->user->email}}?subject=Suporte VW IOT&body=Olá {{$message->user->name}}, em resposta a mensagem: '{{$message->message}}'"><i class="fas fa-reply"></i></a>
							<form id="answered" role="form" method="POST" action="{{ route('admin.answered') }}">
								{!! csrf_field() !!}
								<input type="hidden" name="identify" id="identify" value="{{$message->id}}">
								<button type="submit" class="btn btn-success btn-sm text-white my-1 mx-1"><i class="fas fa-check-double"></i></button>
							</form>
						</th>
						<td class="align-middle">{{ $message->user->name }}</td>
						<td class="align-middle">
							@if (date('d/m/Y') == date('d/m/Y', strtotime($message->updated_at)))
							Hoje, às {{ date('H:i', strtotime($message->updated_at)) }}
							@elseif (date('d/m/Y', strtotime('yesterday')) == date('d/m/Y', strtotime($message->updated_at)))
							Ontem, às {{ date('H:i', strtotime($message->updated_at)) }}
							@else
							{{ date('d/m/Y à\s H:i', strtotime($message->updated_at)) }}
							@endif
						</td>
						<td class="align-middle">{{ $message->message }}</td>
					</tr>
					@empty
					<tr>
						<th colspan="4">Nenhuma mensagem de suporte nova.</th>
					</tr>
					@endforelse
				</tbody>
			</table>
    	</div>
    </div>
</div>
@endsection