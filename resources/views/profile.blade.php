@extends('layouts.main')

@section('content')
@include('includes.alerts')
<div class="row">
	<div class="col-lg-6">
		<div class="card shadow mb-4 border-left-primary">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Meu Perfil</h6>
			</div>
		 	<div class="card-body">
		     	<p class="text-center"><i class="fas fa-user-circle fa-5x"></i></p>
		     	<p class="text-center">{{ Auth::user()->name }}</p>
		     	<hr class="my-4">
		     	<p class="text-left"><i class="fas mr-2 fa-envelope"></i><strong>Email:</strong>
					<span class="text-right">{{ Auth::user()->email }}</span></p>
				<p class="text-left"><i class="fas mr-2 fa-phone"></i><strong>Telefone:</strong>
					<span class="phone">{{ Auth::user()->phone }}</span>
				</p>
				<p class="text-left"><i class="fas mr-2 fa-file"></i><strong>
					@if (strlen(Auth::user()->document) === 11)
					CPF: 
					@else
					CNPJ: 
					@endif 
					</strong><span class="document">{{ Auth::user()->document }}</span>
				</p>
		     	<p class="text-left"><i class="fas mr-2 fa-calendar-week"></i><strong>Validade:</strong>
					{{ date('d/m/Y', strtotime(Auth::user()->expiration)) }}</p>
		    	<p class="text-left"><i class="fas mr-2 fa-user-tag"></i><strong>Conta:</strong>
					@if (Auth::user()->user_type == 'Master')
					<span class="text-primary">	
						{{ Auth::user()->user_type }}	
					@else
					<span class="text-warning">
						{{ Auth::user()->user_type }}	
					@endif
					</span>
				</p> 
				<p class="text-left"><i class="fas mr-2 fa-info-circle"></i><strong>Status:</strong>
					@if (strtotime(Auth::user()->expiration) > strtotime('now'))
					<span class="text-success">	
						ATIVA
					@else
					<span class="text-danger">
						INATIVA
					@endif	
					</span>
		     	</p>
		    </div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card shadow mb-4 border-left-primary">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Alterar</h6>
			</div>
	  		<div class="card-body">
     			<p class="text-center">
     				<p class="text-xs font-weight-bold">TELEFONE:</p>
     				<form id="tellForm" role="form" method="POST" action="{{ route('profile.tell') }}">
						{!! csrf_field() !!}
						<div class="input-group mb-3">
							<input id="phone" type="text" class="phone form-control" name="phone" value="{{ Auth::user()->phone }}" required autocomplete="phone" placeholder="Telefone/Celular" >
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit"><i class="fas fa-redo-alt"></i></button>
							</div>
						</div>
					</form>
					<hr class="my-4">
					<p class="text-xs font-weight-bold">LINK PERSONALIZADO:</p>
					<form id="logoForm" role="form" method="POST" action="{{ route('profile.link') }}">
						{!! csrf_field() !!}
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-primary text-white" id="inputGroupPrepend2">vwiot.io/</span>
								</div>
								<input type="text" class="form-control" id="link" name="link" placeholder="link-personalizado" required>
								<div class="input-group-append">
									<button class="btn btn-primary" type="submit"><i class="fas fa-redo-alt"></i></button>
								</div>
							</div>
						</div>
					</form>
					<hr class="my-4">
					<p class="text-xs font-weight-bold">LOGO:</p>
					<form id="logoForm" role="form" method="POST" action="{{ route('profile.logo') }}" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<div class="form-group">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="logo" name="logo" accept="image/*" required>
								<label class="custom-file-label" for="customFile" data-browse="Selecione">600 x 400 pixels</label>
							</div>
						</div>
						<div class="form-row">
							<div class="col">
								<button type="submit" class="btn btn-primary btn-block">Salvar</button>
							</form>
							</div>
							<div class="col">
								<form id="logoDelForm" role="form" method="POST" action="{{ route('profile.logoDel') }}">
									{!! method_field('delete') !!}
									{!! csrf_field() !!}
									<button type="submit" class="btn btn-dark btn-block">Apagar</button>
								</form>
							</div>
						</div>
     				<hr class="my-4">
					<p class="text-xs font-weight-bold">SENHA:</p>
					<form id="passForm" role="form" method="POST" action="{{ route('profile.pass') }}">
						{!! csrf_field() !!}
						<div class="form-group">
							<input type="password" id="passNew" name="passNew" class="form-control" placeholder="Nova Senha">
						</div>
						<div class="form-group">
							<input type="password" id="passNewConf" name="passNewConf" class="form-control" placeholder="Confirmar Senha">
						</div>
						<button type="submit" class="btn btn-primary btn-block">Alterar</button>
					</form>
		     	</p>
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
        var DocMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length < 12 ? '000.000.000-009' : '00.000.000/0000-00';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(DocMaskBehavior.apply({}, arguments), options);
            },clearIfNotMatch: true
        };
		$(".document").mask(DocMaskBehavior, spOptions);
		
		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	});
</script>
@endsection
