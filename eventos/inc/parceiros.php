<?php

$sql = "SELECT * FROM tab_parceiros WHERE '$leiloeira' = id_haras AND '1' = situacao";
$resultado = executa_query($sql);

if (isset($resultado->error_msg)) {
	retorno_usuario("error", "Erro: $resultado->error_msg");
}

if (!empty($resultado->dados)) { ?>


	<div id="banner-area" class="banner-area">
		<div class="banner-text">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="banner-heading">
							<h3 class="banner-title">PARCERIAS MULTLEILÕES</h3> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<section class="news">
		<div class="container">

			<div class="row">
				<div class="row all-clients pl-10px-xs pr-10px-xs">

					<?
					foreach ($resultado->dados as $dado) { ?>

						<div class="col-sm-3">
							<figure class="clients-logo">
								<?php
								$url_parceiro = !empty(trim($dado->url)) ? trim($dado->url) : 'javascript:void(0)';
								$target_parceiro = !empty(trim($dado->url)) ? "target='_blank'" : '';
								?>
								<a href="<?= $url_parceiro ?>" <?= $target_parceiro ?> class="grayscale-hover-80">
									<img class="img-responsive pa-sm"
										src="<?= !empty(trim($dado->arquivo)) ? $link_padrao_fotos . $dado->arquivo : $sem_img ?>"
										alt="<?= $dado->titulo ?>" />
								</a>
							</figure>
						</div>

					<?
					}
					?>

				</div>
			</div>

		</div>
	</section>

<?
}
