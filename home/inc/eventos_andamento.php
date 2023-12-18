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

if (!empty($resultado->dados)) { ?>


	<div class="row text-center mt-30px">
		<h2 class="section-title">Eventos</h2>
		<h3 class="section-sub-title margem_titulo nmb">EVENTOS EM ANDAMENTO</h3>
	</div>


	<?
	foreach($resultado->dados as $dado)
		include('../eventos/titulo_eventos.php');
	} 



