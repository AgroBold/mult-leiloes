<?php

$query = 
" SELECT
    tipo_produto_animal,
    LOWER(nome_grupo) AS nome_grupo,
    LOWER(nome_amigavel) AS nome_amigavel,
    COUNT(tipo_produto_animal) AS total_grupo  -- QUANTIDADE DO TIPO
  FROM tab_lotes_leiloes
  JOIN tab_grupos ON tipo_produto_animal = id_grupo
  JOIN tab_leiloes ON (
    NOW() < TIMESTAMP(data_termino, hora_termino) -- EVENTOS DENTRO DO PRAZO
    AND ID = id_leilao -- EVENTOS DOS LOTES
    AND situacao = '1' -- ATIVO
    AND tipo NOT IN(6, 8, 9) -- DIFERENTE DE VENDA DIRETA
    AND ID = '$id_leilao'
  )
  WHERE (
    tab_lotes_leiloes.id_haras = '$leiloeira'
    AND situacao_animal_evento = '1'
  )
  GROUP BY tipo_produto_animal
";

$res = executa_query($query);

$dados = $res->dados;
// $total_grupo_totos = 0;
if ( sizeof($dados) > 0) {

  echo
  " <div class=\"col-lg-12 col-sm-12 mb-20px mt-20px flex npl npr\">
    <div class='item-filtro' onclick=\"get_lotes_categoria('0', '$id_leilao')\"> TODOS <span id='total_grupo_todos'></span></div>
  ";

  foreach($dados as $dado) {
    echo "<div class='item-filtro' onclick=\"get_lotes_categoria('$dado->tipo_produto_animal', '$id_leilao')\">  <span class='text-capitalize'>$dado->nome_amigavel</span> ($dado->total_grupo)</div>";

    $total_grupo_totos += $dado->total_grupo;
  } // WHILE
  echo "</div>";
} // IF