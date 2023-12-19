<div id="banner-area" class="banner-area">
	<div class="banner-text">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="banner-heading">
            <!-- <h3 class="banner-title font-22px" style="color: #212121;font-weight: 700;"><?= $TITLE_EVENTS ?></h3> -->
						<h3 class="banner-title"><?= $TITLE_EVENTS ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<section id="div_encerrados">
  <div class="container">

    <?php
      foreach($dados as $dado) {
        include('titulo_eventos.php');
      } //
    ?>
  </div>
</section>
