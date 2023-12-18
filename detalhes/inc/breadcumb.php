<div id="banner-area" class="banner-area" style="min-height: 150px">
	<div class="banner-text">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="banner-heading">
						<h1 class="banner-title">
							<?= !empty(trim($lote->num_lote_leilao)) ? $lote->num_lote_leilao : '00' ?>
							- <?= $lote->nome_grupo; ?>
							- <?= $lote->nome_animal; ?>
						</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>