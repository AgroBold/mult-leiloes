<section id="main-container" class="main-container">
	<div class="container">
		<div class="row">

			<div class="container">
				<div class="row">
					<h1 class="column-title text-center mb-10px">
						<?= !empty(trim($lote->num_lote_leilao)) ? $lote->num_lote_leilao : '00' ?>
						<!-- - <?= $lote->nome_grupo; ?> -->
						- <?= $lote->nome_animal; ?>
					</h1>

					<div class="col-md-6">
						<!-- <?= (int)$lote->situacao_comercial_animal_evento == 1 ? '<span class="tarja-vendido">VENDIDO</span>' : '' ?> -->
						<?= (int)$lote->situacao_comercial_animal_evento == 1 ? '<span class="tarja_lote_vendido"><img src="../assets/images/tarja-vendido.png" alt="Lote Vendido" /></span>' : '' ?>
						<div id="page-slider" class="owl-carousel owl-theme page-slider small-bg">
							<?php

							$fotos_existentes['foto00'] = trim($lote->foto_lote_leilao); // FOTO DO LOTE
							$fotos_existentes['foto01'] = trim($lote->foto01_animal);
							$fotos_existentes['foto02'] = trim($lote->foto02_animal);
							$fotos_existentes['foto03'] = trim($lote->foto03_animal);
							$fotos_existentes['foto04'] = trim($lote->foto04_animal);
							$fotos_existentes['foto05'] = trim($lote->foto05_animal);
							$fotos_existentes['foto06'] = trim($lote->foto06_animal);

							$FOTO_01 = ''; // PARA USAR NA GENEALOGIA
							for ($i = 0; $i <= 6; $i++) {

								$foto_atual = $fotos_existentes["foto0$i"];
								if (!empty($foto_atual)) {

									$FOTO_01 = empty($FOTO_01) ? $foto_atual : $FOTO_01;
							?>

									<div class="item">
										<img src="<?= $url_docs_sistema . $foto_atual ?>" alt="Foto Animal" class="img-responsive border-ccc" />
									</div>

								<? $cont_fotos++;
								}
							}
							if ($cont_fotos <= 0) { ?>
								<div class="item border-ccc" style="background-image:url('<?= $img_sem_img ?>')">
									<!-- (NONE) -->
								</div>
							<?
							}
							?>
						</div>
					</div>

					<div class="col-md-6">
						<div id="page-slider" class="owl-carousel owl-theme page-slider small-bg mt-15px-xs">
							<?php

							$videos_existentes['video_00'] = trim($lote->url_video_lote_leilao); // VÍDEO DO LOTE
							$videos_existentes['video_01'] = trim($lote->video_animal_01);
							$videos_existentes['video_02'] = trim($lote->video_animal_02);
							$videos_existentes['video_03'] = trim($lote->video_animal_03);

							for ($i = 0; $i <= 4; $i++) {

								$video_atual = $videos_existentes["video_0$i"];
								if (!empty($video_atual)) { ?>

									<div class="item">
										<iframe width="100%" height="370" src="<?= $video_atual ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									</div>

								<? $cont_videos++;
								}
							}
							if ($cont_videos <= 0) { ?>
								<div class="item border-ccc" style="background-image:url('https://sistema.agrobold.com.br/assets/img/sem_video.png')">
								</div>
							<?
							}
							?>
						</div>
					</div>

				</div>
				<br>


				<div class="col-md-<?= !$LOTE_VENDIDO ? '6' : '12' ?>">
					<table class="table table-hover">
						<tbody>

							<tr>
								<td>
									<h4 class="panel-title">CATEGORIA:</h4>
								</td>
								<td>
									<p class='nmb'><?= $lote->nome_grupo; ?></p>
								</td>
							</tr>

							<tr>
								<td>
									<h4 class="panel-title">VENDEDOR(ES):</h4>
								</td>
								<td>
									<p><?= !empty(trim($lote->NOMES_VENDEDORES)) ? $lote->NOMES_VENDEDORES : "<span class='text-muted2'>NÃO INFORMADO</span>"; ?></p>
								</td>
							</tr>

							<tr>
								<td>
									<h4 class="panel-title">PAI:</h4>
								</td>
								<td>
									<p><?= !empty(trim($lote->p00)) ? $lote->p00 : "<span class='text-muted2'>NÃO INFORMADO</span>"; ?></p>
								</td>
							</tr>


							<tr>
								<td>
									<h4 class="panel-title">MÃE:</h4>
								</td>
								<td>
									<p><?= !empty(trim($lote->m00)) ? $lote->m00 : "<span class='text-muted2'>NÃO INFORMADA</span>"; ?></p>
								</td>
							</tr>


							<tr>
								<td>
									<h4 class="panel-title">NASCIMENTO:</h4>
								</td>
								<td>
									<p><?= !empty(trim($lote->nascimento_animal)) && trim($lote->nascimento_animal) != '0000-00-00' ? date('d/m/Y', strtotime($lote->nascimento_animal)) : "<span class='text-muted2'>NÃO INFORMADO</span>" ?></p>
								</td>
							</tr>

							<tr>
								<td>
									<h4 class="panel-title">SEXO:</h4>
								</td>
								<td>
									<p> <?= !empty(trim($lote->sexo_animal)) ? $lote->sexo_animal : "<span class='text-muted2'>NÃO INFORMADO</span>" ?></p>
								</td>
							</tr>

							<tr>
								<td>
									<h4 class="panel-title">PELAGEM:</h4>
								</td>
								<td>
									<p> <?= !empty(trim($lote->pelagem_animal)) ? $lote->pelagem_animal : "<span class='text-muted2'>NÃO INFORMADA</span>" ?></p>
								</td>
							</tr>

							<tr>
								<td>
									<h4 class="panel-title">COTAS A VENDA:</h4>
								</td>
								<td class="red-template text-weight-600">
									<p><?= (float)$lote->COTAS_VENDA_LOTE > 0 ? number_format((float)$lote->COTAS_VENDA_LOTE, 2, ',', '.') . '%' : "<span class='text-muted2'>NÃO INFORMADAS</span>" ?><?= !empty(trim($lote->nome_amigavel)) ? " / $lote->nome_amigavel" : '' ?></p>
								</td>
							</tr>

							<tr>
								<td>
									<h4 class="panel-title">NÚMERO DE VISITAS:</h4>
								</td>
								<td>
									<p><?= (int)$lote->NUM_VISITAS_LOTE ?></p>
								</td>
							</tr>

							<tr>
								<td>
									<h4 class="panel-title">COMPARTILHAR:</h4>
								</td>
								<td>
									<div class="fb-share-button" data-href="http://www.multleiloes.com.br/detalhes/?lote=<?= $_GET['lote'] ?>" data-layout="button_count" data-size="large" data-mobile-iframe="true">
										<a target="_blank" class="fb-xfbml-parse-ignore" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.multleiloes.com.br%2Fdetalhes%2F%3Flote%3D<?= substr($_GET['lote'], 0, -1); ?>%253D&amp;src=sdkpreparse">
											Compartilhar
										</a>
									</div>
								</td>
							</tr>

						</tbody>
					</table>
					<div class="row mt-lg pt-lg text-center">

						<?php
						$nome_animal = $dados['nome_animal'];
						$link = "https://api.whatsapp.com/send?phone=557191727633&text=Ol%C3%A1%20Seleção%20da%20Marcha%2C%20gostaria%20de%20fazer%20uma%20proposta%20ao%20{$nome_animal}%2C" ?>

						<div class="col-sm-12 mt-sm pt-sm mb-md">
							<p><b>Faça uma proposta neste lote!</b></p>
						</div>

						<a href="<?= $link ?>" class="wpp" target="_blank"><i class="fa fa-whatsapp mr-sm"></i>Enviar proposta</a>

					</div> <br><br>

					<?php
					$comentario_animal = !empty(trim($lote->info_lote_leilao)) ? strip_tags(trim($lote->info_lote_leilao)) : strip_tags(trim($lote->comentario_animal));

					if (!empty($comentario_animal)) { ?>

						<h4 class="panel-title">
							Comentários:
						</h4>
						<blockquote>
							<p><?= $comentario_animal ?></p>
						</blockquote>

					<?
					}
					?>

					<!-- <h4 class="panel-title"> 
						Premiação:
					</h4>
					<blockquote>
						<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Corporis deleniti culpa laudantium non eaque, </p>
					</blockquote> -->
				</div>



				<div class="col-md-6">
					<?php
					if (!$LOTE_VENDIDO) {
						if ($IS_LEILAO_COM_LANCE) {
							include('inc/form_lances.php');
						} elseif ($IS_VENDA) {
							include('inc/form_vendas.php');
						}
					}
					?>
				</div>


			</div>
		</div>
	</div>
</section>