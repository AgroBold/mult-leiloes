<div class="container">
	<div class="comments-form border-box">

		<h3 class="title-normal">ENVIE UMA MENSAGEM SOBRE ESTE ANIMAL / LOTE</h3>
		<form id="form_animal">

			<?php			
				$NUM_LOTE_LEILAO_FORM = '';
				$NUM_LOTE_LEILAO_FORM = !empty(trim($lote->num_lote_leilao)) ? "LOTE $lote->num_lote_leilao - " : 'LOTE 00 - ';

				$NOME_ANIMAL_FORM = $NUM_LOTE_LEILAO_FORM . $lote->nome_animal;
			?>

			<input type="hidden" name="nome_animal_form" value="<?= $NOME_ANIMAL_FORM ?>">
			
			<div class="row">
		
				<div class="col-md-4">
					<div class="form-group">
						<div><input class="form-control" name="nome_contato" id="name" placeholder="Nome" type="text"></div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<div><input class="form-control" name="email_contato" id="email" placeholder="Email" type="email"></div>
					</div>
				</div>

				<div class="col-md-4">
					<div class="form-group">
						<div><input class="form-control mask-cel" name="celular_contato" placeholder="Telefone" type="text"></div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<div><textarea class="form-control nmb	" name="mensagem_contato" id="message" placeholder="Mensagem" rows="5"></textarea></div>
					</div>
				</div>
			</div>
				
			<div class="clearfix">
				<button class="btn btn-primary pull-right nmt" type="submit">ENVIAR MENSAGEM</button>
			</div>

		</form>

	</div>
</div>


<hr class="mt-25px nmb">