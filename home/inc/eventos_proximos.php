<?php

/* -------------------------------------------------
 --------------- EVENTOS ATUAIS  -----------------
---------------------------------------------------- */
$sql = 
"	SELECT * FROM tab_leiloes
  LEFT JOIN tab_documentos ON (
    tab_documentos.id_documento = tab_leiloes.id_catalogo_leilao
    AND tab_documentos.situacao = '1'
  )
  WHERE (
    TIMESTAMP(data_inicio, hora_inicio) > NOW()
    AND tab_leiloes.id_haras = '$leiloeira'
    AND tab_leiloes.situacao = '1'
    AND tipo NOT IN(6, 8, 9) -- DIFERENTE DE VENDA DIRETA
  )
  ORDER BY data_inicio, hora_inicio ASC
";

$resultado = executa_query($sql);

$dados = $resultado->dados;

if (!empty($dados)) {
	$TITLE_PROXIMOS = sizeof($dados) > 1 ? 'PRÓXIMOS EVENTOS' : 'PRÓXIMO EVENTO';
	?>

	<div class="row text-center mt-30px">
		<h2 class="section-title">Eventos</h2>
		<h3 class="section-sub-title margem_titulo nmb"><?= $TITLE_PROXIMOS ?></h3>
	</div>

	<?

	$num_eventos_atuais = sizeof($dados);

	if ( $num_eventos_atuais > 1 ) { ?>

		<section>
			<div class="container">
				<div class="row">

					<?
						foreach($dados as $dado) { ?>

							<div class="col-md-6 col-xs-12">
								<div class="latest-post">
									<div class="latest-post-media">
										<a href="../evento/?id=<?= criptografa($dado->ID) ?>" class="latest-post-img grayscale-hover-80">
											<img class="img-responsive border-ccc" src="<?= !empty(trim($dado->arquivo)) ? $link_padrao_fotos.$dado->arquivo : $sem_img ?>" alt="img">
										</a>
									</div>
									<div class="post-body pt-sm">
										<h4 class="post-title">
											<a href="../evento/?id=<?= criptografa($dado->ID) ?>"><?= $dado->titulo ?></a>
										</h4>
										<div class="latest-post-meta">
											<span class="post-item-date">
												<i class="fa fa-clock-o"></i>
												<?php
													$DIA = date('d', strtotime($dado->data_inicio));
													$MES = nome_mes(date('m', strtotime($dado->data_inicio)));
													$ANO = date('Y', strtotime($dado->data_inicio));

													echo "$DIA de $MES de $ANO";
												?>
											</span>
										</div>
									</div>
								</div>
							</div>

							<?
						}
					?>

				</div>
			</div>
		</section>

		<?
	}
	else {
		include('../eventos/titulo_eventos.php');
	}
}
