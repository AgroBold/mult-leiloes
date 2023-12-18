<?php

// VERIFICA SE TEM TRANSMISSÃO AO VIVO
$query_transmissao = "SELECT * FROM tab_haras WHERE id_haras = '$leiloeira' AND '1' = situacao_transmissao";
$resultado = executa_query($query_transmissao);


// OBTEM AS INFORMAÇÕES DE TRANSMISSÃO
if (!empty($resultado->dados)) {  ?>


  <section>
    <div class="container">

      <div class="row text-center">
        <h2 class="section-title">ACOMPANHE NOSSA TRANSMISSÃO ABAIXO</h2>
        <h3 class="section-sub-title margem_titulo nmb red-template">TRANSMISSÃO AO VIVO!</h3>
      </div>

      <div class="row">
        <div class="col-md-12 col-xs-12" id="div_iframe">
          <?php
            $transmissao = $resultado;
            echo $transmissao->codigo_embed_transmissao;
          ?>
          <!-- <iframe width="100%" height="560" src="https://www.youtube.com/embed/MX92bLSUY9U" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->

          <style>
            #div_iframe iframe {
              width: 100% !important;
              height: 560px !important;
            }
          </style>
        </div>
      </div>

    </div>
  </section>


  <script>
    // FORÇANDO O "AUTOPLAY" DO VÍDEO
    document.addEventListener("DOMContentLoaded", function(event) { 
      let iframe = '#div_iframe iframe';
      $(iframe).attr('src', $(iframe).attr('src') + '?rel=o&arp;autoplay=1');
    });
  </script>

  <?
}
