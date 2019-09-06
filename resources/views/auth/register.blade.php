@extends('layouts.auth')

@section('content')
<div class="card-body">
    <noscript>
	    <div class="alert bg-danger text-white shadow mb-3 alert-dismissible fade show" role="alert">
		    <strong><i class="icon fa fa-fw fa-exclamation-circle mr-2"></i></strong>Parace que seu navegador não oferece suporte ao JavaScript. Para melhor aproveitamento da plataforma, troque de navegador.
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        <span aria-hidden="true">&times;</span>
		    </button>
	    </div>
    </noscript>
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
            <a class="text-muted" href="#" data-toggle="modal" data-target="#termsModal">Termos de Serviço</a>
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
<div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-muted" id="termsModalLabel"><i class="fas fa-file-contract mr-2"></i> Termos e Condições de Uso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			<div class="modal-body text-muted">
                <p class="font-weight-light text-center">Termos e condições aplicáveis aos serviços fornecidos pela vwIoT.io através da área privada.</p>
                <hr>
                <p class="font-weight-bold"><i class="fas fa-thumbtack mr-2"></i> Definições:</p>
                <ul>
                    <li><strong>Plataforma ou VW IoT:</strong> O conjunto de páginas da Web que compõem o site publicado sob o nome de domínio vwiot.io e seus subdomínios.</li>
                    <li><strong>Transmissor:</strong> Dispositivo eletrônico responsável por transmitir informações para a Plataforma.</li>
                    <li><strong>Usuário:</strong> Pessoa física ou jurídica que forneceu informações pessoais por meio de qualquer formulário da web.</li>
                    <li><strong>Área Privada:</strong> Páginas da Web cujo acesso é limitado aos Usuários.</li>
                    <li><strong>Plano:</strong> Especificações e limitadores da Área Privada.</li>
                </ul>
                <p class="font-weight-normal">Os seguintes termos e condições aplicam-se ao uso da Plataforma, incluindo todas as ferramentas e serviços disponibilizados na Área Privada.</p>
                <p class="font-weight-normal">Leia atentamente todo este documento antes de iniciar sua utilização, visto que o cadastro na Plataforma e o acesso a Área Privada implica a imediata aceitação destes termos e condições por parte do Usuário.</p>
                <p class="font-weight-normal">Quaisquer alterações posteriores a este documento serão notificadas na Área Privada. Após essa notificação, caso o Usuário continue a utilizar os serviços, o mesmo aceita tais modificações.</p>
                <hr>
                <p class="font-weight-bold"><i class="fas fa-info-circle mr-2"></i> Obrigações do usuário relacionadas ao uso da Plataforma:</p>
                <p class="font-weight-normal">Ao aceitar os Termos e Condições de uso e ao utilizar a Plataforma, o Usuário se compromete a:</p>  
                <ul>
                    <li>Garantir que ele é o legítimo possuidor dos Transmissores que irá cadastrar e gerenciar através da Área Privada.</li>
                    <li>Garantir que as informações fornecidas no momento de cadastro e posteriores atualizações são verídicas, próprias e obtidas legalmente sem incorrer ao roubo de identidade.</li>
                    <li>Garantir que não usará as informações obtidas pela Plataforma como única base para tomada de decisões.</li>
                    <li>Permitir o acesso de suas informações, necessárias para o fornecimento dos serviços da Plataforma.</li>
                    <li>Permitir que a VW IoT entre em contato com os meios fornecidos para comunicação de alertas e outras eventuais notificações.</li>
                    <li>Monitorar o prazo de vencimento de seu Plano, sujeitando-se a suspensão do plano, caso não seja feita a renovação.</li>
                    <li>Não utilizar a Plataforma para fins ilegais.</li>
                    <li>Não transmitir nenhum vírus ou qualquer código de natureza destrutiva ou que comprometa a operabilidade dos serviços.</li>
                </ul>
                <p class="font-weight-normal">É proibida a reprodução, duplicação, cópia, venda, revenda ou exploração de qualquer parte do uso, acesso, ou qualquer contato da Plataforma sem permissão expressa e escrita.</p>
                <hr>
                <p class="font-weight-bold"><i class="fas fa-toggle-on mr-2"></i> Ativação:</p>
                <p class="font-weight-normal">Fica estabelecido o prazo de 5 dias úteis para ativação do Transmissor após a contratação ou alteração de um Plano.</p>
                <hr>
                <p class="font-weight-bold"><i class="fas fa-ticket-alt mr-2"></i> Suporte Técnico:</p>
                <p class="font-weight-normal">O suporte técnico fornece serviços de atendimento ao Usuário em relação a Plataforma, por meio de ticket na aba “Suporte”, presente na Área Privada, ou através do e-mail suporte@vwiot.io.</p>
                <hr>
                <p class="font-weight-bold"><i class="fas fa-user-times mr-2"></i> Suspensão de Usuários:</p>
                <p class="font-weight-normal">A VW IoT suspenderá a prestação de serviços a um usuário quando:</p>  
                <ul>
                    <li>Após o vencimento do Plano contratado pelo Usuário. Neste caso, a VW IoT antecipadamente entrará em contato pelos meios cabíveis para informar e negociar a renovação do Plano.</li>
                    <li>Qualquer violação aos Termos e Condições de Uso.</li>
                </ul>
                <p class="font-weight-normal">Enquanto a suspensão estiver vigente, todos ou parte dos Transmissores serão bloqueados, não sendo possível a recepção, armazenamento e exibição de novos dados.</p>
                <hr>
                <p class="font-weight-bold"><i class="fas fa-cart-arrow-down mr-2"></i> Renovação do Plano:</p>
                <p class="font-weight-normal">A VW IoT reserva-se o direito de reajustar a qualquer momento e sem aviso prévio os valores dos Planos.</p>
                <hr>
                <p class="font-weight-bold"><i class="fas fa-ban mr-2"></i> Cancelamento:</p>
                <p class="font-weight-normal">Caso o Usuário deseje cancelar sua utilização da Plataforma, o mesmo deverá entrar em contato com o suporte através do e-mail suporte@vwiot.io, para que não seja efetuada uma nova cobrança. O acesso a Plataforma continuará até o vencimento previsto.</p>
                <p class="font-weight-normal">No cancelamento, após o vencimento do Plano vigente, todos os dados do Usuário e dos Transmissores cadastrados poderão ser deletados sem aviso prévio.</p>
                <hr>
                <p class="font-weight-bold"><i class="fas fa-hourglass-end mr-2"></i> Término dos serviços:</p>
                <p class="font-weight-normal">Caso a VW IoT venha a encerrar seus serviços, todos os dados de Usuários e Transmissores serão deletados. No entanto, a Plataforma notificará pelos meios cabíveis, disponibilizando um link através do qual o usuário poderá acessar e copiar suas informações até aquele momento armazenadas.</p>
                <hr>
                <p class="font-weight-bold"><i class="fas fa-exclamation-circle mr-2"></i> Força maior:</p>
                <p class="font-weight-normal">Nenhuma parte será responsável por falha ou desempenho defeituoso, se tal falha ou desempenho defeituoso resultar de eventos que não poderiam ser previstos, ou que, previsto, eram inevitáveis, tais como casos de força maior, como desastres naturais, guerra, distúrbios da ordem pública, falta de energia ou falha no serviço de comunicações eletrônicas, ou qualquer outra medida excepcional tomada pelas autoridades administrativas ou governamentais.</p>
                <p class="font-weight-normal">A ocorrência de um evento de força maior ou inesperado implica a suspensão da Plataforma até o restabelecimento da normalidade.</p>
                <hr>
                <p class="font-weight-bold"><i class="fas fa-file-alt mr-2"></i> Aviso Legal:</p>
                <p class="font-weight-normal">A VW IoT não se responsabiliza por quaisquer tipos de danos decorrentes de decisões feitas com base nas informações obtidas pela Plataforma.</p>
                <p class="font-weight-normal">A VW IoT não garante que a qualidade de seus serviços, ferramentas ou outros materiais adquiridos irão atender as expectativas do Usuário.</p>
                <hr>
                <p class="font-weight-bold"><i class="fas fa-balance-scale mr-2"></i> Lei Aplicável e Jurisdição:</p>
                <p class="font-weight-normal">Estes Termos e Condições de Uso serão regidos pela lei brasileira.</p>
                <hr>
                <p class="font-weight-normal"><strong>Última alteração:</strong> 20 de agosto de 2019.</p>
            </div>
        </div>
    </div>
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

