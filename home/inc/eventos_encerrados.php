<?php

$sql = 
"	SELECT * FROM tab_leiloes
  WHERE (
    NOW() > TIMESTAMP(data_termino, hora_termino)
    AND id_haras = '$leiloeira'
    AND situacao = '1'
    AND tipo NOT IN(6, 8, 9) -- DIFERENTE DE VENDA DIRETA
  )
  ORDER BY data_inicio DESC, hora_inicio DESC
";

$resultado = executa_query($sql);

if (isset($resultado->error_msg)) {
	retorno_usuario("error", "Erro: $resultado->error_msg");
}

$dados = $resultado->dados;

$num_eventos_encerrados = count($dados);

if ( $num_eventos_encerrados > 0 ) { ?>


	<div id="banner-area" class="banner-area">
		<div class="banner-text">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="banner-heading">
							<h3 class="banner-title">EVENTOS ENCERRADOS</h3> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<section>
		<div class="container">

			<div class="row">

				<?
					foreach($dados as $dado) { ?>

						<div class="col-md-4 col-xs-12 mb-20px">
							<div class="latest-post">
								<div class="latest-post-media">
									<a href="../evento/?id=<?= criptografa($dado->ID) ?>" class="latest-post-img grayscale-hover-80">
										<img class="img-responsive" src="<?= !empty(trim($dado->arquivo)) ? $link_padrao_fotos.$dado->arquivo : $sem_img ?>" alt="img">
									</a>
								</div>
							</div>
						</div>

						<?

						echo (++$cont % 3) == 0  ? '</div><div class="row">' : '';
					}
				?>
			</div>
		</div>
	</section>


	<?
}



