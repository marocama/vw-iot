<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/price.css') }}" rel="stylesheet" type="text/css">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body>
    <section class="pricing py-5">
        <h3><a class="sidebar-brand d-flex align-items-center justify-content-center text-dark" href="{{ route('home')}}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fa fa-wifi text-white"></i>
            </div>
            <div class="sidebar-brand-text text-white mx-3">VW  <sup>IOT</sup></div></h3>
        </a></h3><br>
        <div class="container">
            <div class="row">
              <!-- Free Tier -->
                {{-- <div class="col-lg-12">
                    <div class="card mb-5 mb-lg-0">
                        <div class="card-body">
                            <h5 class="card-title text-muted text-uppercase text-center">Free</h5>
                            <h6 class="card-price text-center">R$0<span class="period">/mês</span></h6>
                            <hr>
                            <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Usuário Único</li>
                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Interface Personalizada</li>
                            </ul>
                            <a href="#" class="btn btn-block btn-primary text-uppercase">CONSULTAR</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-5 mb-lg-0">
                        <div class="card-body">
                            <h5 class="card-title text-muted text-uppercase text-center">Plus</h5>
                            <h6 class="card-price text-center">R$30<span class="period">/mês</span></h6>
                            <p class="text-center text-muted py-2">À vista: R$350/Ano</p>
                            <hr>
                            <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>5 Usuários</strong></li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>1GB de Armazenamento</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>5 Transmissores</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Suporte Agilizado</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Interface Personalizada</li>
                                <li class="text-muted"><span class="fa-li"><i class="fas fa-times"></i></span>Integração Agilizada</li>
                            </ul>
                            <a href="#" class="btn btn-block btn-primary text-uppercase">CONSULTAR</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-muted text-uppercase text-center">Pro</h5>
                            <h6 class="card-price text-center">R$50<span class="period">/mês</span></h6>
                            <hr>
                            <ul class="fa-ul">
                                <li><span class="fa-li"><i class="fas fa-check"></i></span><strong>Usuários Ilimitados</strong></li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>10GB de Armazenamento</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Transmissores <strong>Ilimitados</strong></li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Suporte Agilizado</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Interface Personalizada</li>
                                <li><span class="fa-li"><i class="fas fa-check"></i></span>Integração Agilizada</li>
                            </ul>
                            <a href="#" class="btn btn-block btn-primary text-uppercase">CONSULTAR</a>
                        </div>
                    </div>
                </div> --}}
            </div>
            <br>
            <a href="{{ route('home') }}" class="btn btn-block btn-warning text-uppercase">PAINEL ADMINISTRATIVO</a>
        </div>
    </section>
    </body>
</html>
