@extends('layouts.auth')

@section('content')
<div class="card-body">
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('Um novo link de verificação foi enviado.') }}
        </div>
    @endif
    <p class="text-center mb-4"><i class="fas fa-envelope fa-3x text-gray-300"></i></p>
    <p class="text-muted pt-2">{{ __('Antes de prosseguir, verifique em seu e-mail o link de verificação.') }}</p>
    <p class="text-muted">{{ __('Se você não recebeu o email') }}, <a href="{{ route('verification.resend') }}">{{ __('clique aqui para enviar novamente') }}</a>.</p>
</div>
@endsection

