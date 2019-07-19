@extends('layouts.auth')

@section('content')
<div class="card-body">
    <h5 class="card-title text-center">Login</h5>
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
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
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Senha">
            <label for="password">Senha</label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="custom-control custom-checkbox mb-3">
            <div class="d-flex justify-content-between">
                <div>
                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label text-muted" for="remember">Lembrar</label>
                </div>
                <div>
                    <a class="text-muted" href="{{ route('password.request') }}">Esqueceu a senha?</a>
                </div>
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
        <br>
        <a class="btn btn-lg btn-secondary btn-block text-uppercase" href="{{ route('register') }}">Registrar</a>
    </form>
</div>
@endsection
