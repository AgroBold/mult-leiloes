<div class="container">
<?php


$num_lote_atual = (int)$lote->ordem_animal;




// QUERY QUE BUSCA O PROXIMO ANIMAL DO LEILAO
$sql_next =
" SELECT
    id_leilao, ordem_animal, ID, id_lote_leilao
  FROM tab_lotes_leiloes 
  JOIN tab_animais ON tab_animais.id_animais = tab_lotes_leiloes.id_lote
  JOIN tab_leiloes ON tab_leiloes.ID = tab_lotes_leiloes.id_leilao
  WHERE (
    id_leilao = '$id_leilao'
    AND situacao_animal_evento = '1'
    AND ordem_animal > '$num_lote_atual'
  )
  ORDER BY ordem_animal
  LIMIT 1
";

$query_next = executa_query($sql_next);

if (isset($query_next->error_msg)) {
  retorno_usuario("error", "Erro: $resultado->error_msg");
}

$next = $query_next->dados[0];
$next = (array)$next;

$next_row = count($query_next->dados);




$sql_prev =
" SELECT
    id_leilao, ordem_animal, ID, id_lote_leilao
  FROM tab_lotes_leiloes 
  JOIN tab_animais ON tab_animais.id_animais = tab_lotes_leiloes.id_lote
  JOIN tab_leiloes ON tab_leiloes.ID = tab_lotes_leiloes.id_leilao
  WHERE (
    id_leilao = '$id_leilao'
    AND situacao_animal_evento = '1'
    AND ordem_animal < '$num_lote_atual'
  )
  ORDER BY ordem_animal DESC
  LIMIT 1
";
$query_prev = executa_query($sql_prev);

if (isset($query_prev->error_msg)) {
  retorno_usuario("error", "Erro: $resultado->error_msg");
}

$prev = $query_prev->dados[0];
$prev = (array)$prev;

$prev_row = count($query_prev->dados);




// LOTE ANTERIOR
if($prev_row > 0){ ?>

  <a href="<?= $app['APP'];?>detalhes/?lote=<?= criptografa($prev['id_lote_leilao']); ?>&div_lote" class="btn btn-md u-btn-primary g-mr-10 g-mb-15 lote-next-prev">
    <i class="fa fa-chevron-left anterior"></i>
  </a>

  <?
}

// PROXIMO LOTE
if($next_row > 0) { ?>

  <a href="<?= $app['APP'];?>detalhes/?lote=<?= criptografa($next['id_lote_leilao']); ?>&div_lote" class="btn btn-md u-btn-primary g-mr-10 g-mb-15 lote-next-prev">
    <i class="fa fa-chevron-right proximo"></i>
  </a>

  <?
}
?>
</div>
