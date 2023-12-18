<section>
  <div class="container">

    <div class="row text-center">
      <h2 class="section-title">Eventos</h2>
      <h3 class="section-sub-title  nmb"><?= $TITLE_EVENTS ?></h3>
    </div>

    <?php
      foreach($dados as $dado) {
        include('titulo_eventos.php');
      } //
    ?>
  </div>
</section>
