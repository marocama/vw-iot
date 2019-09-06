<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<meta name="description" content="Plataforma de IOT para automação industrial desenvolvida e mantida pela empresa VW Soluções">
  	<meta name="author" content="Marcus Roberto">

    <meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Laravel') }}</title>
		
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
	
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home')}}">
				@if(Auth::user()->fileName == NULL)
				<div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa fa-wifi"></i>
                </div>
				<div class="sidebar-brand-text mx-3">VW  <sup>IOT</sup></div>
				@else
				<div class="sidebar-brand-icon">
					<img src="{{ asset('storage/logos/'.Auth::user()->fileName) }}" class="img-fluid" style="width:50%">
				</div>
				@endif
			</a>
			@if (Auth::user()->user_type != "Admin")
            <hr class="sidebar-divider my-0">
            <li class="nav-item @if(Route::getCurrentRoute()->getName() == 'home') active @endif">
                <a class="nav-link" href="{{ route('home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Painel</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">Ferramentas</div>
            <li class="nav-item @if(Route::getCurrentRoute()->getName() == 'transmitters' || Route::getCurrentRoute()->getName() == 'transmitters.form') active @endif">
				<a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
					<i class="fas fa-fw fa-microchip"></i>
					<span>Transmissores</span>
				</a>
				<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">Transmissores:</h6>
						<a class="collapse-item" href="{{ route('transmitters') }}">Consultar</a>
						<a class="collapse-item" href="{{ route('transmitters.form') }}">Registrar</a>
					</div>
				</div>
			</li>
			@if (Auth::user()->user_type == "Master") 
			<li class="nav-item @if(Route::getCurrentRoute()->getName() == 'operators') active @endif">
				<a class="nav-link" href="{{ route('operators') }}">
					<i class="fas fa-fw fa-user-friends"></i>
					<span>Operadores</span>
				</a>
			</li>
			@endif
            <li class="nav-item @if(Route::getCurrentRoute()->getName() == 'statistics') active @endif">
                <a class="nav-link" href="{{ route('statistics') }}">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Relatórios</span>
                </a>
            </li>
            <hr class="sidebar-divider">
			<div class="sidebar-heading">Outros</div>
			<li class="nav-item @if(Route::getCurrentRoute()->getName() == 'contact') active @endif">
                <a class="nav-link" href="{{ route('contact') }}">
                	<i class="fas fa-fw fa-comment"></i>
                	<span>Contato</span>
                </a>
			</li>
			@elseif (Auth::user()->user_type == "Admin")
			<hr class="sidebar-divider">
			<div class="sidebar-heading">CONTROLE</div>
            <li class="nav-item @if(Route::getCurrentRoute()->getName() == 'home') active @endif">
                <a class="nav-link" href="{{ route('home')}}">
                    <i class="fas fa-fw fa-search"></i>
                    <span>Consulta</span>
                </a>
			</li>
			<li class="nav-item @if(Route::getCurrentRoute()->getName() == 'admin.alert') active @endif">
                <a class="nav-link" href="{{ route('admin.alert')}}">
                    <i class="fas fa-fw fa-exclamation-circle"></i>
                    <span>Alertas</span>
                </a>
			</li>
			<li class="nav-item @if(Route::getCurrentRoute()->getName() == 'admin.expirations') active @endif">
                <a class="nav-link" href="{{ route('admin.expirations')}}">
                    <i class="fas fa-fw fa-calendar-times"></i>
                    <span>Vencimentos</span>
                </a>
			</li>
			<li class="nav-item @if(Route::getCurrentRoute()->getName() == 'admin.tran.new') active @endif">
                <a class="nav-link" href="{{ route('admin.tran.new')}}">
                    <i class="fas fa-fw fa-plus-circle"></i>
                    <span>Registrar Transmissor</span>
                </a>
            </li>
			<li class="nav-item @if(Route::getCurrentRoute()->getName() == 'admin.suport') active @endif">
                <a class="nav-link" href="{{ route('admin.suport')}}">
                    <i class="fas fa-fw fa-life-ring"></i>
                    <span>Suporte</span>
                </a>
			</li>
			<li class="nav-item @if(Route::getCurrentRoute()->getName() == 'admin.interaction') active @endif">
                <a class="nav-link" href="{{ route('admin.interaction')}}">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Interfaces</span>
                </a>
			</li>
			<li class="nav-item @if(Route::getCurrentRoute()->getName() == 'admin.data') active @endif">
                <a class="nav-link" href="{{ route('admin.data')}}">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Dados</span>
                </a>
            </li>
            @endif
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
			<div id="content">
				<nav class="navbar navbar-expand navbar-light bg-light topbar mb-4 static-top shadow">
					<button id="sidebarToggle" class="btn btn-link rounded-circle mr-3"><i class="fa fa-bars"></i></button>
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown no-arrow mx-1">
							<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-bell fa-fw"></i>
								@if (Auth::user()->alerts()->where('view', false)->count() != 0)
								<span class="badge badge-danger badge-counter">
									{{ Auth::user()->alerts()->where('view', false)->count() }}
								</span>
								@endif
							</a>
							<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
								<h6 class="dropdown-header">Notificações</h6>
								@forelse(Auth::user()->alerts()->latest()->limit(5)->get() as $alert)
								<a class="dropdown-item d-flex align-items-center" href="{{ route('alerts.clear') }}">
									<div class="mr-3">
										<div class="icon-circle bg-{{ $alert->color }}">
											<i class="fas fa-{{ $alert->symbol }} text-white"></i>
										</div>
									</div>
									<div>
										<div class="small text-gray-500">
											@if (date('d/m/Y') == date('d/m/Y', strtotime($alert->period)))
											Hoje, às {{ date('H:i', strtotime($alert->period)) }}
											@elseif (date('d/m/Y', strtotime('yesterday')) == date('d/m/Y', strtotime($alert->period)))
											Ontem, às {{ date('H:i', strtotime($alert->period)) }}
											@else
											{{ date('d/m/Y à\s H:i', strtotime($alert->period)) }}
											@endif 
										</div>
										<span @if (!$alert->view) class="font-weight-bold" @endif>{{ $alert->name }}</span>
									</div>
								</a>
								@empty
								<a class="dropdown-item d-flex align-items-center" href="#">
									<div class="small text-gray-600">Não há nada para exibir.</div>
								</a>
								@endforelse
								<a class="dropdown-item text-center small text-gray-500"></a>
							</div>
						</li>
						<div class="topbar-divider d-none d-sm-block"></div>
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
								<i class="fas fa-user-circle fa-fw fa-2x"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="{{ route('profile') }}">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Perfil
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Sair
								</a>
							</div>
						</li>
					</ul>
				</nav>
            	<div class="container-fluid">
					<noscript>
						<div class="alert bg-danger text-white shadow mb-3 alert-dismissible fade show" role="alert">
							<strong><i class="icon fa fa-fw fa-exclamation-circle mr-2"></i></strong>Parace que seu navegador não oferece suporte ao JavaScript. Para melhor aproveitamento da plataforma, troque de navegador.
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</noscript>
					@yield('content')
				</div>
            </div>
            <footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>&copy; 2019 VW <sup>IOT</sup>. All rights reserved.</span>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Desconectar?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
				</div>
				<div class="modal-body">Selecione "Logout" abaixo se deseja sair de conta.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
					<a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
						{{ __('Logout') }}
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  	<script src="{{ asset('js/jquery.easing.min.js') }}"></script>
	<script src="{{ asset('js/main.min.js') }}"></script>
	@yield('js')
</body>  
</html>
            