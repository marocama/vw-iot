@extends('layouts.auth')

@section('content')
<div class="card-body">
    <h5 class="card-title text-center">Cadastre-se</h5>
    <form class="form-signin" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-label-group">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome completo">
            <label for="name">Nome completo</label>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-label-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
            <label for="email">Email</label>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-label-group">
            <input id="phone" type="text" class="phone form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="Telefone/Celular" >
            <label for="phone">Telefone/Celular</label>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-label-group">
            <input id="document" type="text" class="document form-control @error('document') is-invalid @enderror" name="document" value="{{ old('document') }}" required autocomplete="document" placeholder="CPF/CNPJ" >
            <label for="document">CPF/CNPJ</label>
            @error('document')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-label-group">
            <input id="cep" type="text" class="cep form-control @error('cep') is-invalid @enderror" name="cep" value="{{ old('cep') }}" required autocomplete="cep" placeholder="CEP" >
            <label for="cep">CEP</label>
            @error('cep')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>  
        <div class="form-label-group">
            <input id="birth" type="text" class="birth form-control @error('birth') is-invalid @enderror" name="birth" value="{{ old('birth') }}" required autocomplete="birth" placeholder="Data de Nascimento" >
            <label for="birth">Data de Nascimento</label>
            @error('birth')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-label-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Senha">
            <label for="password">Senha</label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-label-group">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Senha novamente">
                <label for="password-confirm">Confirme sua senha</label>
        </div>
        <div class="custom-control custom-checkbox mb-3">
            <input class="custom-control-input form-control @error('operator') is-invalid @enderror" type="checkbox" name="operator" id="operator" {{ old('operator') ? 'checked' : '' }} onClick="operatorHide()">
            <label class="custom-control-label text-muted" for="operator">Conta Operador</label> 
            @error('operator')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="custom-control custom-checkbox mb-3">
            <input class="custom-control-input form-control @error('terms') is-invalid @enderror" type="checkbox" name="terms" id="terms" {{ old('terms') ? 'checked' : '' }}>
            <label class="custom-control-label text-muted" for="terms">Li e Concordo com os</label>
            <a class="text-muted" href="#">Termos de Serviço</a>
            @error('terms')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-label-group" id="operator_token_div">
            <input id="operator_token" type="text" class="form-control @error('operator_token') is-invalid @enderror" name="operator_token" value="{{ old('operator_token') }}" autocomplete="operator_token" placeholder="Código de Registro">
            <label for="operator_token">Código de Registro</label>
            @error('operator_token')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Registrar</button>
        <br>
        <a class="btn btn-lg btn-secondary btn-block text-uppercase" href="{{ route('login') }}">Login</a>
    </form>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/jquery.mask.min.js') }}"></script>
<script type="text/javascript">

    $(function() {  
        var masks = ['(00) 00000-0000', '(00) 0000-00009'];
        $('.phone').mask(masks[1], {onKeyPress: 
            function(val, e, field, options) {
                field.mask(val.length > 14 ? masks[0] : masks[1], options) ;
            },clearIfNotMatch: true
        });

        var DocMaskBehavior = function (val) {
            return val.replace(/\D/g, '').length < 12 ? '000.000.000-009' : '00.000.000/0000-00';
        },
        docOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(DocMaskBehavior.apply({}, arguments), options);
            },clearIfNotMatch: true
        };
        $(".document").mask(DocMaskBehavior, docOptions);

        var optionsCep =  {
            onKeyPress: function(cep, e, field, options) {
                var mask = ['00000-000'];
                $('.cep').mask(mask, options);
            },clearIfNotMatch: true
        };

        $('.cep').mask('00000-000', optionsCep);

        var optionsBirth =  {
            onKeyPress: function(birth, e, field, options) {
                var mask = ['00/00/0000'];
            },clearIfNotMatch: true
        };

        $('.birth').mask('00/00/0000', optionsBirth);
    });
    $(document).ready(function() {  
        document.getElementById("operator").checked ? document.getElementById("operator_token_div").style.display = 'block' : document.getElementById("operator_token_div").style.display = 'none';
    });
    

    function operatorHide() {
        if(document.getElementById("operator").checked){
            document.getElementById("operator_token_div").style.display = 'block';
        } else {
            document.getElementById("operator_token_div").style.display = 'none';
            document.getElementById("operator_token").value = '';
        } 
    }

</script>
@endsection

