<?php
include('../includes/header.php');

$sql_haras = "SELECT texto_historia_haras FROM tab_haras WHERE id_haras = '$leiloeira'";
$query_haras = executa_query($sql_haras);

if(isset($query_haras->error_msg)){
	retorno_usuario($query_haras->error_msg);
}

$dados = $query_haras->dados[0];

$TEXTO_HISTORIA = strip_tags(trim($dados->texto_historia_haras), '<p><br><b><strong>');
?>

<div id="banner-area" class="banner-area">
	<div class="banner-text">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="banner-heading">
						<h1 class="banner-title">Sobre Nós</h1>
						<ol class="breadcrumb">
							<li><a href="../home/">Home</a></li>
							<li>Sobre</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<section id="main-container" class="main-container">
	<div class="container">
		<div class="row">

			<div class="col-md-12">
				<h3 class="column-title nmb">QUEM SOMOS NÓS?</h3>
				<blockquote>
					<?= !empty($TEXTO_HISTORIA) ? $TEXTO_HISTORIA : 'Em breve...' ?>
				</blockquote>
			</div>

			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="post-content post-single">
					<div class="post-media post-image image-angle">
						<img src="../assets/images/header-logo.png" class="img-responsive border-ccc pa-md" alt="">
					</div>
				</div>
			</div>

		</div>
	</div>
</section>


<?php

include('../includes/parceiros.php');
include('../includes/footer.php');
