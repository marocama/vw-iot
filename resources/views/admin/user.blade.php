@extends('layouts.main')

@section('content')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
@include('includes.alerts')
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Consulta</h6>
    </div>
    <div class="card-body">
        <form role="form" method="POST" action="{{ route('admin.user.edit') }}">
			{!! csrf_field() !!}
			<input type="hidden" name="identify" id="identify" value="{{$user->id}}">
			<div class="form-row">
				<div class="form-group col-md-7">
					<label>Nome Completo</label>
					<input id="name" type="text" class="form-control" name="name" value="{{$user->name}}">
				</div>
				<div class="form-group col-md-5">
					<label>CPF/CNPJ</label>
					<input id="document" type="text" class="form-control document" name="document" value="{{$user->document}}">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-3">
					<label>CEP</label>
					<input id="cep" type="text" class="form-control" name="cep" value="{{$user->cep}}">
				</div>
				<div class="form-group col-md-4">
					<label>Telefone</label>
					<input id="phone" type="text" class="form-control phone" name="phone" value="{{$user->phone}}">
				</div>
				<div class="form-group col-md-5">
					<label>Data de Nascimento</label>
					<input id="birth" type="text" class="form-control" name="birth" value="{{$user->birth}}">
				</div>	
			</div>
			<div class="form-row">
				<div class="form-group col-md-7">
					<label>Email</label>
					<input id="email" type="email" class="form-control" name="email" value="{{$user->email}}">
				</div>
				<div class="form-group col-md-5">
					<label>Vencimento</label>
					<input id="expiration" type="text" class="form-control" name="expiration" value="{{$user->expiration}}">
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-2">
					<label>Customização</label>
					<select name="custom" class="form-control bg-primary text-white" style="font-family:'FontAwesome', Arial;">
						<option value="1" @if($user->permit_customize) selected @endif>&#xf058;</option>
						<option value="0" @if(!$user->permit_customize) selected @endif>&#xf057;</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<label>Tipo</label>
					<input id="type" type="text" class="form-control" name="type" disabled value="{{$user->user_type}}">
				</div>
				<div class="form-group col-md-3">
					<label>Token</label>
					<input id="token" type="text" class="form-control" name="token" disabled value="{{$user->user_token}}">
				</div>
				<div class="form-group col-md-5">
					<label>Vínculo</label>
					<input id="vinculo" type="text" class="form-control" name="vinculo" disabled value="@if($master->count() > 0){{$master->name}}@else---@endif">
				</div>	
			</div><br>
			<div class="form-group">
				<button class="btn btn-primary btn-block">Salvar</button>
			</div>
		</form>
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
        var DocMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length < 12 ? '000.000.000-009' : '00.000.000/0000-00';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(DocMaskBehavior.apply({}, arguments), options);
            },clearIfNotMatch: true
        };
        $(".document").mask(DocMaskBehavior, spOptions);
    });
</script>
@endsection