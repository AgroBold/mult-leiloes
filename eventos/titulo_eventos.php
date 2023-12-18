<section>
	<div class="container">

    <div class="row text-center">
			<?= !verifica_url_page('detalhes/') ? '<hr class="nmt">' : '' ?>
			<h5 class="section-sub-title margem_titulo red-template mb-sm pl-10px-xs pr-10px-xs"><?= $dado->titulo ?></h5>
		</div>

		<div class="row">
			
			<div class="col-md-6 col-xs-12">
				<div class="latest-post">
					<div class="latest-post-media">
						<a href="<?php
						if(!$dado->link_banner_leilao){
							echo "../evento/?id= ".criptografa($dado->ID);
						} else {
							echo $dado->link_banner_leilao;
						}
							?>" class="latest-post-img grayscale-hover-80">
							<img class="img-responsive border-ccc" src="<?= !empty(trim($dado->arquivo)) ? $link_padrao_fotos.$dado->arquivo : $sem_img ?>?v=1.0.2" alt="Imagem Evento" style="border-radius: 5px;"/>
						</a>
					</div>
				</div>
			</div>

			<div class="col-md-6 col-xs-12 pl-25px-xs pr-25px-xs">
				<div class="latest-post">

					<div class="post-body npt">
						<div class="row">
							<div class="panel-group panel-classic" id="accordion">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"> 
											INÍCIO: 
											<span>
												<strong class="red-template"><?= date('d/m/Y', strtotime($dado->data_inicio)) ?></strong>
												- <?= date('H:i', strtotime($dado->hora_inicio)) ?>
											</span>
										</h4>
									</div>
								</div>

								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"> 
											TÉRMINO:
											<span>
												<strong><?= date('d/m/Y', strtotime($dado->data_termino)) ?></strong>
												- <?= date('H:i', strtotime($dado->hora_termino)) ?>
											</span>
										</h4>
									</div>
								</div>
								
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"> 
											CONDIÇÃO DE PAGAMENTO:
											<span>
												<?= !empty(trim($dado->condicoes_leilao)) ? $dado->condicoes_leilao : 'Não Informadas' ?>
											</span>
										</h4>
									</div>
								</div>




								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title"> 
											ENCERRA EM:
											<span class="light-grey" id="clockdiv_<?= $dado->ID ?>">
												<strong class='yellow-template days'>00</strong> DIAS |
												<strong class='yellow-template hours'>00</strong>h |
												<strong class='yellow-template minutes'>00</strong>min |
												<strong class='yellow-template seconds'>00</strong>s
											</span>
										</h4>
									</div>
								</div>



								<?php
									if ( !empty(trim($dado->nome_arquivo_documento)) ) { ?>
				
										<div class="panel panel-default">
											<div class="panel-heading">
												<h4 class="panel-title"> 
													CATÁLOGO DE LOTES:
													<span>
														
														<a href="<?= $link_padrao_fotos . $dado->nome_arquivo_documento ?>" target='_blank' class="btn btn-primary white" style="padding: 5px 20px; margin-top: -4px;">	
															PDF
														</a>

													</span>
												</h4>
											</div>
										</div>

										<?
									}

									if ( !empty(trim($dado->descricao_leilao)) ) { ?>

										<div class="panel panel-default">
											<div id="collapseOne" class="panel-collapse collapse in">
												<div class="pt-10px pl-10px pr-10px npb">
													<p> <?= $dado->descricao_leilao ?> </p>
												</div>
											</div>
										</div>

										<?
									}
								?>
									

							</div>
		
							<div class="flex">
								<?php	
									if ( strlen(strip_tags(trim($dado->comentario))) > 20 ) { ?>

										<div class="call-to-action-btn text-center mr-xs width-100">
											<button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal_comentario_leilao_<?= (int)$dado->ID ?>">
												EQUIPE DE VENDAS
											</button>
										</div>

										<?
									}
									if ( !verifica_url_page('evento/') ) { ?>

										<div class="call-to-action-btn text-center mr-xs width-100">
											<a class="btn btn-block btn-primary" href="<?php
											if(!$dado->link_banner_leilao){
												echo "../evento/?id= ".criptografa($dado->ID);
											} else {
												echo $dado->link_banner_leilao;
											}
											?>">Confira os lotes</a>
										</div>

										<?
									}
									if ( strlen(trim($dado->regulamento)) > 10 ) { ?>

										<div class="call-to-action-btn text-center width-100">
											<button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal_regulamento_leilao_<?= (int)$dado->ID ?>">
												REGULAMENTO
											</button>
										</div>

										<?
									}
								?>
							</div> <!-- .flex -->

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>


<?php								
if ( strlen(trim($dado->regulamento)) > 10 ) { ?>

	<div class="modal fade" id="modal_regulamento_leilao_<?= (int)$dado->ID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog width-85">
			<div class="modal-content">

				<div class="modal-header text-center npb">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>

					<?= !empty(trim($dado->arquivo)) ? "<img src='$link_padrao_fotos$dado->arquivo' style='width:130px' class='mb-15px border-ccc bra-xs pa-xs'>" : '' ?>
					

					<h5 class="section-sub-title margem_titulo red-template mb-sm">REGULAMENTO - <?= $dado->titulo ?></h5>
				</div>
									
				<div class="modal-body pl-20px pr-20px pb-20px" style="text-align: justify">
					<?= $dado->regulamento ?>
				</div>
									
			</div>
		</div>
	</div>


	<?
}
if ( strlen(strip_tags(trim($dado->comentario))) > 20 ) { ?>


	<div class="modal fade" id="modal_comentario_leilao_<?= (int)$dado->ID ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog width-50">
			<div class="modal-content">

				<div class="modal-header text-center npb">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button>

					<?= !empty(trim($dado->arquivo)) ? "<img src='$link_padrao_fotos$dado->arquivo' style='width:130px' class='mb-15px border-ccc bra-xs pa-xs'>" : '' ?>


					
					<h6 class="section-sub-title margem_titulo red-template mb-sm" style="font-size: 30px;line-height: 33px;">
						<span style="font-size:75%" class="text-muted">EQUIPE DE VENDAS DO EVENTO</span>
						<br><?= $dado->titulo ?>
					</h6>
				</div>
									
				<div class="modal-body pl-lg pr-lg pb-lg text-center">
					<?= $dado->comentario ?>
				</div>
									
			</div>
		</div>
	</div>


	<?
}

// echo "STATUS_LEILAO: $dado->STATUS_LEILAO";
if ( $dado->STATUS_LEILAO != 'ENCERRADO' ) { ?>


	<script>

		function atualizaContador_<?= $dado->ID ?>(id_div) {

			// Obtem a Data e Hora de Término
			var YY = <?php echo date("Y",strtotime($dado->data_termino)); ?>;
			var MM = <?php echo date("m",strtotime($dado->data_termino)); ?>;
			var DD = <?php echo date("d",strtotime($dado->data_termino)); ?>;
			var HH = <?php echo date("H",strtotime($dado->hora_termino)); ?>;
			var MI = <?php echo date("i",strtotime($dado->hora_termino)); ?>;
			var SS = <?php echo date("s",strtotime($dado->hora_termino)); ?>;

			// Calcula o Tempo Restante
			var hoje = new Date();
			var futuro = new Date(YY,MM-1,DD,HH,MI,SS);
			var ss = parseInt((futuro - hoje) / 1000);
			var mm = parseInt(ss / 60);
			var hh = parseInt(mm / 60);
			var dd = parseInt(hh / 24);
			ss = ss - (mm * 60);
			mm = mm - (hh * 60);
			hh = hh - (dd * 24);

			// Determina os objetos que exibirão o Countdown
			
			var clock = document.getElementById('clockdiv_<?= $dado->ID ?>');
			var daysSpan = clock.querySelector(`.days`);
			var hoursSpan = clock.querySelector(`.hours`);
			var minutesSpan = clock.querySelector(`.minutes`);
			var secondsSpan = clock.querySelector(`.seconds`);

			// Atualiza o tempo restante nos objetos
			daysSpan.innerHTML = (dd && dd > 1) ? str_pad(dd, 2, 0, 'STR_PAD_LEFT') : (dd==1 ? '01' : '0');
			hoursSpan.innerHTML = (toString(hh).length) ? str_pad(hh, 2, 0, 'STR_PAD_LEFT') : '00';
			minutesSpan.innerHTML = (toString(mm).length) ? str_pad(mm, 2, 0, 'STR_PAD_LEFT') : '00';
			secondsSpan.innerHTML = str_pad(ss, 2, 0, 'STR_PAD_LEFT');

			// Verifica se o Leilão terminou
			if (dd <= 0 && hh <= 0 && mm <= 0 && ss <= 0) {
				// alert("Este leilão terminou!");
				// location.href="/home/";
			}

		}

		function str_pad(input, pad_length, pad_string, pad_type) {
			//  discuss at: http://phpjs.org/functions/str_pad/
			// original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			// improved by: Michael White (http://getsprink.com)
			//    input by: Marco van Oort
			// bugfixed by: Brett Zamir (http://brett-zamir.me)
			//   example 1: str_pad('Kevin van Zonneveld', 30, '-=', 'STR_PAD_LEFT');
			//   returns 1: '-=-=-=-=-=-Kevin van Zonneveld'
			//   example 2: str_pad('Kevin van Zonneveld', 30, '-', 'STR_PAD_BOTH');
			//   returns 2: '------Kevin van Zonneveld-----'

			var half = '',
			pad_to_go;

			var str_pad_repeater = function(s, len) {
				var collect = '',
				i;

				while (collect.length < len) {
					collect += s;
				}
				collect = collect.substr(0, len);

				return collect;
			};

			input += '';
			pad_string = pad_string !== undefined ? pad_string : ' ';

			if (pad_type !== 'STR_PAD_LEFT' && pad_type !== 'STR_PAD_RIGHT' && pad_type !== 'STR_PAD_BOTH') {
				pad_type = 'STR_PAD_RIGHT';
			}
			if ((pad_to_go = pad_length - input.length) > 0) {
				if (pad_type === 'STR_PAD_LEFT') {
					input = str_pad_repeater(pad_string, pad_to_go) + input;
					} else if (pad_type === 'STR_PAD_RIGHT') {
					input = input + str_pad_repeater(pad_string, pad_to_go);
					} else if (pad_type === 'STR_PAD_BOTH') {
					half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
					input = half + input + half;
					input = input.substr(0, pad_length);
				}
			}

			return input;
		}




		document.addEventListener("DOMContentLoaded", function(event) {
			//Atualiza o Contador a cada segundo
			setInterval(() =>{
				atualizaContador_<?php echo $dado->ID ?>();
			}, 1000);
		});




	</script>


	<?
} // IF