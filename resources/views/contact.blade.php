@extends('layouts.main')

@section('content')
@include('includes.alerts')
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Contato</h6>
    </div>
    <div class="card-body">
        <p class="text-justify">
        	Para dúvidas, sugestões ou relatar problemas, entre em contato com algum de nossos canais de comunicação ou através do formulário abaixo.
        </p>
        <a href="https://api.whatsapp.com/send?phone=+5535998681301&text=Cliente:%20{{ Auth::user()->name }}%0d%0aMensagem:" target="_blank" class="btn btn-success btn-circle">
            <i class="fab fa-whatsapp"></i>
        </a>
        <a href="skype:marcus498.habbo?chat" class="btn btn-primary btn-circle">
            <i class="fab fa-skype"></i>
        </a>
        <a href="mailto:marcus.rcm@outlook.com" class="btn btn-warning btn-circle">
            <i class="fa fa-envelope"></i>
        </a>
        <hr class="my-4">
        <form role="form" method="POST" action="{{ route('contact.form') }}">
            {!! csrf_field() !!}
  			<fieldset disabled>
    			<div class="form-group">
      				<input type="text" id="disabledTextInput" class="form-control" placeholder="Nome" value="{{ Auth::user()->name }}">
    			</div>
    		</fieldset>
    		<div class="form-group">
    			<textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="2" placeholder="Digite sua mensagem aqui." autofocus></textarea>
                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
    		<button type="submit" class="btn btn-primary btn-block">Enviar</button>
		</form>
    </div>
</div>
@endsection