<?php

include('../includes/header.php');
include('inc/query.sql.php');
include('inc/breadcumb.php');

if ( $IS_LEILAO_SEM_LANCE || $IS_LEILAO_COM_LANCE ) {
	$leilao = $lote;
  $dado = (object)$dados;
	include('../eventos/titulo_eventos.php');
	$leilao = '';
}


// INFORMAÇÕES PRINCIPAIS DO LOTE
include('inc/query_setas.php');
include('inc/perfil_animal.php');




if ( (int)$lote->id_genealogia > 0 ) {
  echo
  '<section id="main-container" class="main-container">
    <div class="container">

    <h1 class="column-title text-center nmb">
      GENEALOGIA DO ANIMAL
    </h1>
    ';

      include('inc/genealogia.php');
      echo
    '</div>
  </div>';
}



if ( $IS_LEILAO_COM_LANCE || $IS_LEILAO_SEM_LANCE ) {
  include('inc/table_lances.php');
}

include('inc/form_animal.php');

// include('../includes/parceiros.php');
echo "<script src='put/js.js?v=1.0.1.6'></script>";


if ( isset($_GET['div_lote']) ) { ?>

  <script>
    $(document).ready(() => {
      let scroll_width = window.innerWidth > 768 ? 650 : 1250;
      setTimeout(() => {
        $('html, body').animate({ scrollTop: scroll_width }, 'slow');
      }, 650);
    });
  </script>

  <?
}

include('../includes/footer.php');
