@extends('layouts.main')

@section('content')
@include('includes.alerts')
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Operadores</h6>
    </div>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" style="width:10%"></th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contato</th>
                </tr>
            </thead>
            <tbody>
            @forelse($operators as $operator)
                <tr>
                    <th scope="row" class="text-center align-middle">
                        <a class="btn btn-warning btn-sm text-white my-1 mx-1" data-toggle="modal" data-target="#delModal" onClick="deleteOperator({{ $operator->id }})"><i class="fas fa-trash-alt"></i></a>
                    </th>
                    <td class="align-middle">{{ $operator->name }}</td>
                    <td class="align-middle">{{ $operator->email }}</td>
                    <td class="align-middle phone">{{ $operator->phone }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Você não possui operadores registrados.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="card shadow mb-4 border-left-primary">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Código de Registro</h6>
    </div>
    <div class="card-body">
        <p class="text-justify">
          Para vincular Operadores a sua conta, forneça o código abaixo no momento de cadastra-los.
        </p>
        <div class="alert bg-secondary text-white shadow mb-3 fade show" role="alert">
            <strong><i class="icon fa fa-key mr-2"></i></strong> {{ Auth::user()->user_token }}
        </div>
    </div>
</div>
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delModalLabel"><i class="fas fa-trash-alt mr-2"></i>Deletar Operador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja deletar este operador?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" role="form" method="POST" action="{{ route('operators.del') }}">
                    {!! method_field('delete') !!}
                    {!! csrf_field() !!}
                    <input type="hidden" name="identify" id="identify" value="">
                    <button type="submit" id="deleteButton" class="btn btn-secondary">Confirmar</button>
                </form>
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
    });

    function deleteOperator($identify){
        document.getElementById("identify").value = $identify;
    }

</script>
@endsection
