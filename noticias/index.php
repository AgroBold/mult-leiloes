<?php include('../includes/header.php') ?>

<div id="banner-area" class="banner-area">
	<div class="banner-text">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="banner-heading">
						<h1 class="banner-title" style="color: #212121;font-weight: 700;">NOTÍCIAS</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<section id="main-container" class="main-container">
	<div class="container">
		<div class="row">


			<?php 
				// EXECUTA A QUERY QUE TRAZ TODAS AS NOTICIAS DA LEILOEIRA ATIVAS
				$query_noticias =
				" SELECT * FROM tab_noticias
					WHERE (
						id_haras = '$leiloeira' AND
						situacao_noticia = '1'
					)
					ORDER BY tab_noticias.data_noticia DESC
				";

				$resultado_query_noticias = executa_query($query_noticias);
				$dados = $resultado_query_noticias->dados;         
				$num_noticias = sizeof($dados);
				
				if($num_noticias > 0) { 
					foreach($dados as $dado) {
						$contador++;
						?>  

						<div class="col-md-4">
							<div class="ts-service-box mb-30px">
								<div class="mb-lg">
									<a href="../detalhes-noticia/?id=<?= criptografa($dado->id_noticia);?>" class="grayscale-hover-80">
										<img class="img-responsive border-ccc" src="<?= !empty(trim($dado->foto_noticia)) ? $link_padrao_fotos.$dado->foto_noticia : $sem_img ?>" alt="">
									</a>
								</div>

								<div class="pl-md">
									<h3 class="service-box-title">
										<a href="../detalhes-noticia/?id=<?= criptografa($dado->id_noticia);?>">
											<span class="red-template">
												<?= $dado->titulo_noticia; ?>
											</span>
										</a>
									</h3>
									
									<p><?= strip_tags(substr($dado->texto_noticia, 0, 200)) . ' [...]';?></p>

									<p>
										<a class="learn-more red-template" href="../detalhes-noticia/?id=<?= criptografa($dado->id_noticia);?>">
											<i class="fa fa-caret-right"></i> Veja mais
										</a>
									</p>  
								</div>

							</div>
						</div>

						<?         
					} // WHILE
				} // IF
				else { ?>

					<div class="col-md-12 text-center fix g-mb-50 border-ccc">
						<br>
						<h1 class="error g-mt-20">AGUARDE!</h1>
						<h4 class="err-mess">No momento não temos notícias cadastradas!</h4>
						<br>
					</div>

					<?php     
				} // ELSE
			?>

		</div>
	</div>
</section>



<?php

include('../includes/parceiros.php');
include('../includes/footer.php');
