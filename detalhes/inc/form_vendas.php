<div class="ts-pricing-box nmt">

	<div class="ts-pricing-header">
		<h2 class="ts-pricing-name">VALOR DE VENDA</h2>
		<h2 class="ts-pricing-price">
			<span class="currency">R$</span> <strong><?= number_format((float)$lote->valor_venda_direta_animal, 2, ',', '.') ?></strong><small>/ Parcela</small>
		</h2>
	</div>

	<table class="table table-hover">
		<tbody>
			<?php
			if ((int)$lote->NUM_PARCELAS_ANIMAL > 0) { ?>

				<tr>
					<td class="text-left">
						<h4 class="panel-title">Total de Parcelas do Lote:</h4>
					</td>
					<td class="text-right">
						<p><strong><?= (int)$lote->NUM_PARCELAS_ANIMAL ?> <?= (int)$lote->NUM_PARCELAS_ANIMAL > 1 ? 'PARCELAS' : 'PARCELA' ?></strong></p>
					</td>
				</tr>

			<?
			}
			?>

			<tr>
				<td class="text-left">
					<h4 class="panel-title">Valor da Compra:</h4>
				</td>
				<td class="text-right">
					<p><?= (int)$lote->NUM_PARCELAS_ANIMAL > 0 ? $lote->NUM_PARCELAS_ANIMAL . "x de" : '' ?> <strong>R$ <?= number_format((float)$lote->valor_venda_direta_animal, 2, ',', '.') ?></strong> <small class="text-muted2">(unidade)</small></p>
				</td>
			</tr>

			<tr>
				<td class="text-left">
					<h4 class="panel-title">Valor Final:</h4>
				</td>
				<td class="text-right">
					<p><strong>R$ <?= number_format((float)$lote->valor_venda_direta_animal * ($lote->NUM_PARCELAS_ANIMAL > 0 ? $lote->NUM_PARCELAS_ANIMAL : 1), 2, ',', '.') ?></strong> <small class="text-muted2">(unidade)</small></p>
				</td>
			</tr>

			<tr>
				<?php
				$UNIDADES_DISPONIVEIS = (int)$lote->tipo_multiplo == 1 ? (int)$lote->UNIDADES_DISPONIVEIS : 1;

				?>
				<td class="text-left">
					<h4 class="panel-title">Quantidade disponível:</h4>
				</td>
				<td class="text-right">
					<p><strong><?= $UNIDADES_DISPONIVEIS ?></strong> UNIDADE<?= $UNIDADES_DISPONIVEIS != 1 ? 'S' : '' ?></p>
				</td>
			</tr>

		</tbody>
	</table>


	<form id="form_compra">
		<input type="hidden" name="id_lote" value="<?= criptografa((int)$lote->id_lote_leilao); ?>">

		<div class="form-group text-left">
			<label class="nmb">SELECIONE A QUANTIDADE:</label>
			<select name="quantidade" class="form-control font-25px black">
				<?php

				if ((int)$lote->tipo_multiplo == 1) {
					echo $UNIDADES_DISPONIVEIS <= 0 ? '<option value="0">NENHUMA UNIDADE DISPONÍVEL</option>' : '<option value="1">1 Unidade</option>';

					if ($UNIDADES_DISPONIVEIS > 1) {
						for ($i = 2; $i <= $UNIDADES_DISPONIVEIS; $i++) {
							echo "<option value='$i'>$i Unidades</option>";
						}
					}
				} else {
					echo (int)$lote->situacao_comercial_animal_evento != 1 ? '<option value="1">1 UNIDADE DISPONÍVEL</option>' : '<option value="0">ANIMAL VENDIDO!</option>';
				}
				?>
			</select>
		</div>

		<?php
		if (!esta_logado()) {
			echo "<button type='button' class='botao_lance' onclick='mensagens_atencao(`<strong>FAÇA LOGIN PARA REALIZAR SUA COMPRA!</strong>`, `topCenter`);setTimeout(() => {modal_login()}, 1500)'>COMPRAR</button>";
		} else {
			echo "<button type='button' onclick='confirma_compra()' class='botao_lance'>COMPRAR</button>";
		}
		?>

	</form>

</div>