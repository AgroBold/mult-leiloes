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

$dados = $resultado->dados;

$num_eventos_encerrados = sizeof($dados);

if ( $num_eventos_encerrados > 0 ) { ?>

	<section>
		<div class="container">
			
			<div class="row text-center">
				<h2 class="section-title">Eventos</h2>
				<h3 class="section-sub-title margem_titulo">EVENTOS ENCERRADOS</h3>
			</div>

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



