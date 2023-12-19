<?php

/* -------------------------------------------------
 --------------- EVENTOS ATUAIS  -----------------
---------------------------------------------------- */
$sql = 
"	SELECT * FROM tab_leiloes
  LEFT JOIN tab_documentos ON (
    tab_documentos.id_documento = tab_leiloes.id_catalogo_leilao
    AND tab_documentos.situacao = '1'
  )
  WHERE (
    NOW() >= TIMESTAMP(data_inicio, hora_inicio) AND
    NOW() <= TIMESTAMP(data_termino, hora_termino)
    AND tab_leiloes.id_haras = '$leiloeira'
    AND tab_leiloes.situacao = '1'
    AND tipo NOT IN(6, 8, 9) -- DIFERENTE DE VENDA DIRETA
  )
  ORDER BY data_inicio, hora_inicio ASC
";

$resultado = executa_query($sql);

if (isset($resultado->error_msg)) {
  retorno_usuario("error", "Erro: $resultado->error_msg");
}

if (!empty($resultado->dados)) { ?>

  <div id="banner-area" class="banner-area">
    <div class="banner-text">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="banner-heading">
              <h3 class="banner-title">EVENTOS EM ANDAMENTO</h3> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


	<?
	foreach($resultado->dados as $dado)
		include('../eventos/titulo_eventos.php');
	} 



