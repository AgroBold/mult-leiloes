<?php

$sql = "SELECT * FROM tab_parceiros WHERE '$leiloeira' = id_haras AND '1' = situacao";
$resultado = executa_query($sql);

if (!empty($resultado->dados)) { ?>

	<section class="news">
		<div class="container">
			
			<div class="row text-center">
				<h2 class="section-sub-title margem_titulo mb-sm pl-10px-xs pr-10px-xs">Parceiros</h2>
				<h3 class="section-sub-title mb-lg pl-10px-xs pr-10px-xs">PARCERIA MULTLEILÕES</h3>
			</div>

			<div class="row">
				<div class="row all-clients pl-10px-xs pr-10px-xs">

					<?
						foreach($resultado->dados as $dado) { ?>

							<div class="col-sm-3">
								<figure class="clients-logo">
									<?php
										$url_parceiro = !empty(trim($dado->url)) ? trim($dado->url) : 'javascript:void(0)';
										$target_parceiro = !empty(trim($dado->url)) ? "target='_blank'" : '';
									?>
									<a href="<?= $url_parceiro ?>" <?= $target_parceiro ?> class="grayscale-hover-80">
										<img class="img-responsive pa-sm" src="<?= !empty(trim($dado->arquivo)) ? $link_padrao_fotos. $dado->arquivo : $sem_img ?>" alt="<?= $dado->titulo ?>" />
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
