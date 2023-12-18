<?php include('../config/config.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

	<meta charset="utf-8">
	<title>MultLeiloes</title>
	<?php include('SEO.php'); ?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="../assets/images/faviconV2.png?v=2">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<link rel="stylesheet" href="../assets/css/bootstrap.min.css?01">
	<link rel="stylesheet" href="../assets/css/style.css?v=1.2.6"> <!-- !!!!!!!!!!!! -->
	<link rel="stylesheet" href="../assets/css/responsive.css">
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/css/animate.css">
	<link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
	<link rel="stylesheet" href="../assets/css/colorbox.css">
	<link rel="stylesheet" href="../assets/css/modals.css?v=1.0.3">


	<!-- IZITOAST-MASTER CSS -->
	<link href="https://cdn.agrobold.com.br/plugins/iziToast-master/iziToast.min.css" rel="stylesheet">

	<!-- CDN AGROBOLD -->
	<link href="https://www.cdn.agrobold.com.br/css/agrobold.css?v=1.0.0.3" rel="stylesheet">

	<!-- <link rel="stylesheet" href="../assets/css/custom.css?v=1.0.14.<?= $RANDOM ?>"> -->
	<link rel="stylesheet" href="../assets/css/custom.css?v=2.1.0">


	<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v4.0&appId=760617337452205&autoLogAppEvents=1"></script>
</head>

<body>
	<div id="preload" style="display:none">
		<img src="../assets/images/preload.gif?v=1.1">
		<span></span>
	</div>


	<div class="body-inner">

		<?php
		if (esta_logado()) { ?>

			<div id="top-bar" class="top-bar">
				<div class="container">
					<div class="row">

						<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
							<ul class="top-info">
								<li>
									<!-- <i class="fa fa-map-marker">&nbsp;</i> -->
									<i class="fa fa-calendar">&nbsp;</i>
									<p class="info-text">
										<strong>
											<?php
											$DIA = date('d');
											$MES = nome_mes(date('m'));
											$ANO = date('Y');

											echo "$DIA de $MES de $ANO";
											?>
										</strong>
									</p>
								</li>
							</ul>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 top-social text-right">
							<ul class="unstyled">
								<li>
									OLÁ <strong><?= $_SESSION['pnome_usuario'] ?></strong>!
								</li>

								<li><strong class="ml-sm mr-sm">/</strong></li>

								<li>
									<a href="javascript:void(0)" onclick="logout()"><strong class="text-danger yellow-hover">SAIR</strong></a>
								</li>
							</ul>
						</div>

					</div>
				</div>
			</div>

		<?
		} // ESTA LOGADO
		?>


		<!-- Header start -->
		<header id="header" class="header-one">

			<div class="container">
				<div class="row">
					<div class="logo-area clearfix">

						<div class="logo_custom col-xs-12 col-md-3">
							<a href="../home">
								<img src="../assets/images/header-logo.png?v=2.0" alt="Logo Principal">
							</a>
						</div>

						<div class="col-xs-12 col-md-9 header-left" style="margin-top:-5px">
							<ul class="top-info-box">
								<li class="last">
									<div class="info-box last" id="contato_header">

										<!-- CONTADO #1 -->
										<div class="info-box-content">
											<p class="info-box-subtitle"><i class="fa fa-phone-square" aria-hidden="true"></i>  (61) 3465-2074</p>
										</div>
										<br>

										<!-- CONTADO #2 -->
										<div class="info-box-content">
											<p class="info-box-subtitle"><i class="fa fa-whatsapp" aria-hidden="true"></i> (61) 99983-4121</p>
										</div>
										<br>

										<!-- INSTAGRAM -->
										<div class="info-box-content">
											<p class="info-box-subtitle">
												<a href="https://www.instagram.com/multleiloes" target="_blank" rel="noopener noreferrer" class='font-14px'>
													<i class="fa fa-instagram mr-sm" aria-hidden="true"></i> multleiloes
												</a>
											</p>
										</div>


									</div>
								</li>

							</ul>
						</div>

					</div>
				</div>
			</div>

			<nav class="site-navigation navigation navdown" style="z-index:999999">
				<div class="container" style="z-index: 300">

					<div class="row">
						<div class="col-sm-12">
							<div class="site-nav-inner pull-left">

								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>

								<div class="collapse navbar-collapse navbar-responsive-collapse">
									<ul class="nav navbar-nav">

										<li class="<?= verifica_url_page('home/') ? 'active' : '' ?>"><a href="../home">Home</a></li>
										<li class="<?= verifica_url_page('sobre/') ? 'active' : '' ?>"><a href="../sobre">Sobre</a></li>

										<li class="dropdown <?= verifica_url_page('evento') ? 'active' : '' ?>">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown">Eventos <i class="fa fa-angle-down"></i></a>
											<ul class="dropdown-menu" role="menu">
												<!-- <li><a href="../eventos/agenda">Agenda de Eventos</a></li> -->
												<li><a href="../eventos/">Eventos em Andamento</a></li>
												<li><a href="../eventos/?scroll=div_proximos">Eventos Futuros</a></li>
												<li><a href="../eventos/?scroll=div_encerrados">Eventos Encerrados</a></li>
												
											</ul>
										</li>

										<li class="<?= verifica_url_page('vendas/') ? 'active' : '' ?>"><a href="../vendas/">Venda Direta</a></li>
										<li class="<?= verifica_url_page('noticias/') ? 'active' : '' ?>"><a href="../noticias">Notícias</a></li>
										<li class="<?= verifica_url_page('contato/') ? 'active' : '' ?>"><a href="../contato">Contato</a></li>
									</ul>
								</div>



							</div>
						</div>
					</div>

					<div class="nav-search" id="btns-acesso">							
						<?php
							if(esta_logado()) { ?>
								<a href="//areadocliente.agrobold.com.br/login/?empresa=<?= criptografa($leiloeira) ?>" target="_blank" class="btn btn-primary" style="margin-top: -7px">
									<i class="fa fa-user mr-sm"></i>
									Área do Cliente
								</a>
								<? 
							}
							else { ?>
								<button class="btn btn-primary mr-md" onclick="modal_login()" style="margin-top: -7px;">
									<i class="fa fa-lock mr-sm"></i>
									Login
								</button>

								<button class="btn btn-primary" onclick="modal_cadastro()" style="margin-top: -7px;">
									<i class="fa fa-user-plus mr-sm"></i>
									Cadastro
								</button>
								<?php
							}
						?>
					</div>
							
				</div>
			</nav>

		</header>