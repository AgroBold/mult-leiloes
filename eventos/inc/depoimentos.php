<div class="col-md-6">
	<h3 class="column-title">Depoimentos</h3>
	<div id="testimonial-slide" class="owl-carousel owl-theme testimonial-slide">



		<!-- PAULO NÓVOA -->
		<div class="item">
			<div class="quote-item">
				<span class="quote-text">
					O site Seleção da Marcha surge em momento propício,
					em que todos os setores estão sedentos por alguns princípios:
					conhecimento, comprometimento e ética, portanto é prenúncio de um futuro brilhante.”
				</span>
				<div class="quote-item-footer">
					<img class="testimonial-thumb" src="../assets/images/depoimentos/paulo-novoa.jpeg" alt="Foto Paulo Nóvoa">
					<div class="quote-item-info">
						<h3 class="quote-author">Paulo Nóvoa</h3>
						<span class="quote-subtext">
							Ex Diretor da ABCCMM<br> 
							Ex Presidente do Núcleo Baiano<br> 
							Titular do Haras do AP
						</span>
					</div>
				</div>
			</div>
		</div>




		<!-- EDSON BASTOS -->
		<div class="item">
			<div class="quote-item">
				<span class="quote-text">
					O site Seleção da Marcha é assinado por dois dos maiores conhecedores do M.Marchador,
					Matheus Rolim e Marcelo Braga. Criadores na essência, honestidade, competência e dos melhores relacionamentos.
					Sinônimo de satisfação dos clientes e sucesso geral. Quem ganha é o nosso cavalo.
					Muito boa sorte amigos!”
				</span>
				<div class="quote-item-footer">
					<img class="testimonial-thumb" src="../assets/images/depoimentos/edson-bastos.jpeg" alt="Foto Edson Bastos">
					<div class="quote-item-info">
						<h3 class="quote-author">Edson Bastos</h3>
						<span class="quote-subtext">Haras Itapoan - BA</span>
					</div>
				</div>
			</div>
		</div>


		<!-- GERALDO PINTO CORREIA -->
		<div class="item">
			<div class="quote-item">
				<span class="quote-text">
					Não tenho dúvidas! O site, dos grandes amigos e criadores,
					Matheus Rolim e Marcelo Braga, experientes, dedicados e competentes,
					será uma ferramenta, indispensável para a comercialização do nosso M. Marchador.
					Parabenizá-os e desejo-lhes boa sorte e sucesso.”
				</span>
				<div class="quote-item-footer">
					<img class="testimonial-thumb" src="../assets/images/depoimentos/geraldo-pinto-correia.jpeg" alt="Foto Geraldo Pinto Correia">
					<div class="quote-item-info">
						<h3 class="quote-author">Geraldo Pinto Correia</h3>
						<span class="quote-subtext">Haras do YôYô - BA</span>
					</div>
				</div>
			</div>
		</div>



		<div class="item">
			<div class="quote-item">
				<span class="quote-text">
					Excelente opção para o novo criador que procura uma assessoria visando adquirir bons animais.
					O longo tempo de dedicação a raça Mangalarga Marchador conferem a credibilidade necessária para
					que a Seleção da Marcha se torne um excelente canal na comercialização dos nossos exemplares.”
				</span>
				<div class="quote-item-footer">
					<img class="testimonial-thumb" src="../assets/images/depoimentos/leo-barros.jpeg" alt="Foto Léo Barros">
					<div class="quote-item-info">
						<h3 class="quote-author">Léo Barros</h3>
						<span class="quote-subtext">Haras Caraíbas</span>
					</div>
				</div>
			</div>
		</div>



	</div>

	<?php
		// VÍDEO INSTITUCIONAL - MOSTRA APENAS NA HOME PAGE

		# JS DO AUTO PLAY REMOVIDO -> TICKET #559
		if ( verifica_url_page('home/') ) { ?>


			<iframe id="video_institucional" width="100%" height="320" src="https://www.youtube.com/embed/ITU2fAZZyes" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


			<!-- 
			<script>
				// FORÇANDO O "AUTOPLAY" DO VÍDEO
				document.addEventListener("DOMContentLoaded", function(event) { 

					var play_video_institucional = false;
					$(document).on('scroll', ()=> {
						console.log( `scroll: ${$(document).scrollTop()}` );

						if ( $(document).scrollTop() >= 1550 && !play_video_institucional ) {
							let iframe = 'iframe#video_institucional';
							$(iframe).attr('src', $(iframe).attr('src') + '?rel=o&arp;autoplay=1');
							play_video_institucional = true;
							console.log( `PLAY PLAY PLAY PLAY PLAY PLAY !!!!!!!!!!!`);
						}
					});

				});
			</script>
			-->


			<?
		}
	?>


</div>




<br>
<br>
