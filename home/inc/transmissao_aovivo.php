<?php

// VERIFICA SE TEM TRANSMISSÃO AO VIVO
$query_transmissao = "SELECT * FROM tab_haras WHERE id_haras = '$leiloeira' AND '1' = situacao_transmissao";
$resultado = executa_query($query_transmissao);


if (isset($resultado->error_msg)) {
  retorno_usuario("error", "Erro: $resultado->error_msg");
}

// OBTEM AS INFORMAÇÕES DE TRANSMISSÃO
if (!empty($resultado->dados)) {  ?>

  <div id="banner-area" class="banner-area">
    <div class="banner-text">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="banner-heading">
              <h3 class="banner-title">
                <i class="fa fa-youtube-play mr-sm" aria-hidden="true"></i>
                TRANSMISSÃO AO VIVO!
              </h3> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section>
    <div class="container">

      <div class="row">
        <div class="col-md-12 col-xs-12" id="div_iframe">
          <?php
            $transmissao = $resultado->dados[0];
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
