<div class="ts-pricing-box nmt">

	<div class="ts-pricing-header">
		<h2 class="ts-pricing-name"><?= (float)$lote->VALOR_ULTIMO_LANCE > 0 ? 'PRÓXIMO LANCE' : 'LANCE INICIAL' ?></h2>
		<h2 class="ts-pricing-price">
			<span class="currency">R$</span> <strong>
			<?php
				if ( (int)$lote->VALOR_ULTIMO_LANCE ) {
					echo number_format((float)$lote->VALOR_ULTIMO_LANCE + $lote->incremento_leilao, 2, ',', '.');
				}
				else {
					echo (int)$lote->valor_leilao_animal > 0  ? number_format((float)$lote->valor_leilao_animal, 2, ',', '.') : number_format((float)$lote->incremento_leilao, 2, ',', '.');
				}
			?>
			</strong><small>/ Parcela</small>
		</h2>
	</div>

	<table class="table table-hover">
		<tbody>

			<?php
				if ( (float)$lote->VALOR_ULTIMO_LANCE > 0 ) { ?>

					<tr>
						<td class="text-left"><h4 class="panel-title">Valor do Último Lance:</h4></td>
						<td class="text-right"><p><strong>R$ <?= number_format((float)$lote->VALOR_ULTIMO_LANCE, 2, ',', '.') ?></strong></p></td>
					</tr>

					<?
				}
				else { ?>
					
					<tr>
						<td class="text-left"><h4 class="panel-title">Valor do Primeiro Lance:</h4></td>
						<td class="text-right"><p><strong>R$ <?= (int)$lote->valor_leilao_animal > 0  ? number_format((float)$lote->valor_leilao_animal, 2, ',', '.') : number_format((float)$lote->incremento_leilao, 2, ',', '.') ?></strong></p></td>
					</tr>

					<?
				}


				
				if ( (int)$lote->NUM_PARCELAS_ANIMAL > 0 ) { ?>

					<tr>
						<td class="text-left"><h4 class="panel-title">Total de Parcelas do Lote:</h4></td>
						<td class="text-right"><p><strong><?= (int)$lote->NUM_PARCELAS_ANIMAL ?> <?= (int)$lote->NUM_PARCELAS_ANIMAL > 1 ? 'PARCELAS' : 'PARCELA' ?></strong></p></td>
					</tr>

					<?
				}
			?>

			<tr>
				<?php
					$NUM_PARCELAS_LOTE = (int)$lote->NUM_PARCELAS_ANIMAL > 0 ? (int)$lote->NUM_PARCELAS_ANIMAL : 1;
					$VALOR_PARCELA_LOTE = (float)$lote->VALOR_ULTIMO_LANCE > 0 ? (float)$lote->VALOR_ULTIMO_LANCE : (float)$lote->valor_leilao_animal;
				?>
				<td class="text-left"><h4 class="panel-title">Valor atualizado do Lote:</h4></td>
				<!-- <td class="text-right"><p><?= (int)$lote->NUM_PARCELAS_ANIMAL > 0 ? $lote->NUM_PARCELAS_ANIMAL . "x de" : '' ?> <strong>R$ <?= number_format((float)$lote->VALOR_ULTIMO_LANCE > 0 ? (float)$lote->VALOR_ULTIMO_LANCE : (float)$lote->valor_leilao_animal, 2, ',', '.') ?></strong></p></td> -->
				<td class="text-right">
					<p>
						
						
						<?php

							echo $NUM_PARCELAS_LOTE ."x de " . number_format($VALOR_PARCELA_LOTE, 2, ',', '.');
							echo " = <strong>R$ " . number_format((float)($NUM_PARCELAS_LOTE * $VALOR_PARCELA_LOTE), 2, ',', '.') . '</strong>';
						?>

						
					</p>
				</td>
			</tr>
		
			<tr>
				<td class="text-left"><h4 class="panel-title">Incremento mínimo por Lance:</h4></td>
				<td class="text-right"><p><strong>R$ <?= number_format((float)$lote->incremento_leilao, 2, ',', '.') ?></strong></p></td>
			</tr>

		</tbody>
	</table>



	<form id="form_lance">

		<input type="hidden" name="id_leilao" value="<?= criptografa((int)$lote->id_leilao);?>">
		<input type="hidden" name="id_lote" value="<?= criptografa((int)$lote->id_lote_leilao);?>">
		<input type="hidden" name="nome_animal" value="<?= !empty(trim($lote->num_lote_leilao)) ? $lote->num_lote_leilao : '00 ';?> - <?= $lote->nome_animal ?>">

		<div class="form-group text-left">
			<label class="nmb">SELECIONE O VALOR:</label>
			<select name="valor_lance" class="form-control font-25px black">
				<?php
					// SE NÃO HOUVER LANCE EXECUTA ESSE TRECHO PARA MOSTRAR OS VALORES
					if((int)$dados['VALOR_ULTIMO_LANCE'] <= 0) { ?>

						<option value="
							<?php
								if((int)$dados['VALOR_ULTIMO_LANCE'] <= 0) {
									echo number_format((int)$dados['valor_leilao_animal'], 2, '.', ',');
								}
								else {
									echo number_format(((int)$dados['incremento_leilao'] + (int)$dados['valor_leilao_animal']), 2, '.', ',');
								}
							?>
						">
							R$
							<?php
								if((int)$dados['VALOR_ULTIMO_LANCE'] <= 0) {
									echo number_format((int)$dados['valor_leilao_animal'], 2, ',', '.');
								}
								else {
									echo number_format(((int)$dados['incremento_leilao'] + (int)$dados['valor_leilao_animal']), 2, ',', '.');
								} 
							?>
						</option>
						
						<?php

						// APLICA PREÇOS 10 VEZES COM INCREMENTO MINIMO
						for($i = 1; $i < 11; $i++) { ?>
							
							<option value="<?php echo(((int)$dados['incremento_leilao'] * $i) + (int)$dados['valor_leilao_animal']); ?>">
								R$ <?php echo number_format((((int)$dados['incremento_leilao'] * $i) + (int)$dados['valor_leilao_animal']),  2, ',', '.'); ?>
							</option>

							<?php
						}
						// VERIFICA SE TEM VALOR PARA VENDA IMEDIATA
						if ((int)$dados['valor_venda_imediata_animal'] > 0) { ?>

							<option value="<?php echo (int)$dados['valor_venda_imediata_animal']; ?>">
								R$ <?= number_format(((int)$dados['valor_venda_imediata_animal']),  2, ',', '.'); ?> - Venda Imediata
							</option>
					
							<?php
						} // IF
					} // IF - if( $dados['ultimo_lance'] <= 0 ) 
					else { // SE JÁ HOUVER LANCE EXECUTA ESSE TRECHO PARA MOSTRAR OS VALORES
						?>

						<option value="<?php echo((int)$dados['incremento_leilao'] + (int)$dados['VALOR_ULTIMO_LANCE']); ?>">
							R$ <?php echo number_format(((int)$dados['incremento_leilao'] + (int)$dados['VALOR_ULTIMO_LANCE']),  2, ',', '.'); ?>
						</option>
						
						<?php

						//Aplica preços 10 vezes com incremento minimo
						for($i = 2; $i < 11; $i++) { ?>
					
							<option value="<?php echo(((int)$dados['incremento_leilao'] * $i) + (int)$dados['VALOR_ULTIMO_LANCE']); ?>">
								R$ <?php echo number_format((((int)$dados['incremento_leilao'] * $i) + (int)$dados['VALOR_ULTIMO_LANCE']),  2, ',', '.'); ?>
							</option>
					
							<?php
						} // FOR
							
						// VERIFICA SE TEM VALOR PARA VENDA IMEDIATA
						if ((int)$dados['valor_venda_imediata_animal'] > 0) { ?>
					
							<option value="<?php echo (int)$dados['valor_venda_imediata_animal']; ?>">
								R$ <?php echo number_format(((int)$dados['valor_venda_imediata_animal']),  2, ',', '.'); ?> - Venda Imediata
							</option>

							<?php
						} // IF
					} // ELSE
				?>
			</select>
		</div>

		<?php
			if ( !esta_logado() ) {
				echo "<button type='button' class='botao_lance' onclick='mensagens_atencao(`<strong>FAÇA LOGIN PARA REALIZAR SEU LANCE!</strong>`, `topCenter`);setTimeout(() => {modal_login()}, 1500)'>DAR LANCE</button>";
			}
			else {
				echo "<button type='button' onclick='dar_lance()' class='botao_lance'>DAR LANCE</button>";
			}
		?>

		<div class="col-sm-12 bb-xs pt-sm pb-md">
			<h4 class="red-template nmb nmt"><b><i class="fa fa-warning mr-md"></i>ATENÇÃO!</b></h4>
			<span>Antes de dar seu Lance leia atentamente o
				<a href="javascript:void(0)" data-toggle="modal" data-target="#modal_regulamento_leilao_<?= (int)$lote->ID ?>" class="red-template"><strong>Regulamento do Evento</strong></a>!
			</span>
		</div>

	</form>

</div>

	