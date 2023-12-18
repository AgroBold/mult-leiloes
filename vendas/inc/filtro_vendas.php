<?php

$query = 
" SELECT
    tipo_produto_animal, LOWER(nome_grupo) AS nome_grupo,
    COUNT(tipo_produto_animal) AS total_grupo  -- QUANTIDADE DO TIPO
  FROM tab_lotes_leiloes
  JOIN tab_grupos ON tipo_produto_animal = id_grupo
  JOIN tab_leiloes ON (
    NOW() < TIMESTAMP(data_termino, hora_termino) -- EVENTOS DENTRO DO PRAZO
    AND ID = id_leilao -- EVENTOS DOS LOTES
    AND situacao = '1' -- ATIVO
    AND tipo = '6' -- VENDA DIRETA
  )
  WHERE (
    tab_lotes_leiloes.id_haras = '$leiloeira'
    AND situacao_animal_evento = '1'
  )
  GROUP BY tipo_produto_animal
";

$res = executa_query($query); 

if (isset($res->error_msg)) {
  retorno_usuario("error", "Erro:$res->error_msg");
}


$dados = $res->dados;

// $total_grupo_totos = 0;
if ( !empty($dados)) {

  echo
  " <div class=\"col-lg-12 col-sm-12 mb-20px mt-20px flex npl npr\">
    <div class='item-filtro' onclick=\"get_lote_categoria('0', '$id_leilao')\"> TODOS <span id='total_grupo_todos'></span></div>
  ";

  foreach($dados as $dado) {
    echo "<div class='item-filtro' onclick=\"get_lote_categoria('$dado->tipo_produto_animal', '$id_leilao')\">  <span class='text-capitalize'>$dado->nome_grupo</span> ($dado->total_grupo)</div>";

    $total_grupo_totos += $dado->total_grupo;
  } // WHILE
  echo "</div>";
} // IF