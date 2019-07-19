@extends('layouts.auth')

@section('content')
<div class="card-body">
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('Um novo link de verificação foi enviado para o seu endereço de e-mail.') }}
        </div>
    @endif
    <p class="text-muted">{{ __('Antes de prosseguir, verifique em seu e-mail o link de verificação.') }}</p>
    <p class="text-muted">{{ __('Se você não recebeu o email') }}, <a href="{{ route('verification.resend') }}">{{ __('clique aqui para enviar novamente') }}</a>.</p>
</div>
@endsection

