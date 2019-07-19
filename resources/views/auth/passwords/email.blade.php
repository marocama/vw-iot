@extends('layouts.auth')

@section('content')
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <h5 class="card-title text-center">Recuperar conta</h5>
    <form class="form-signin" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-label-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
            <label for="email">Email</label>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Enviar</button>
        <hr class="my-2">
        <a class="btn btn-lg btn-secondary btn-block text-uppercase" href="{{ route('login') }}">Login</a>
    </form>
</div>
@endsection
