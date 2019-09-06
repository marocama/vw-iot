@extends('layouts.main')

@section('content')
@include('includes.alerts')
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Registrar</h6>
    </div>
    <div class="card-body">
        <p class="text-justify">
            Para associar um novo transmissor em sua conta, utilize o 
            <span class="font-weight-bold" data-toggle="tooltip" data-placement="bottom" title="Ele se parece com '1111111AAA'">número serial</span> gravado na parte inferior da placa. 
        </p>
        <p class="text-justify">
            Em seguida, insira o  
            <span class="font-weight-bold" data-toggle="tooltip" data-placement="bottom" title="Ele se parece com '1111'">código de interface</span> fornecido para vincular com seu transmissor.
        </p>
        <p class="text-justify">
            O campo Identificador é de livre uso para organizar da melhor forma seus transmissores associados.
        </p>
        <hr class="my-4">
        <form role="form" method="POST" action="{{ route('transmitters.add') }}">
            {!! csrf_field() !!}
            <div class="form-group">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus placeholder="Identificador">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="number_serial" type="text" class="form-control @error('number_serial') is-invalid @enderror" name="number_serial" required placeholder="Número Serial">
                @error('number_serial')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="interface" type="text" class="form-control @error('interface') is-invalid @enderror" name="interface" required placeholder="Código de Interface">
                @error('interface')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" placeholder="Localização (Logradouro, Número - Cidade / Estado)">
                <small id="locationHelp" class="form-text text-muted">* Opcional</small>
                @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block">Salvar</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection