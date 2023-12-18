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
$query_next = mysql_query($sql_next, $connect) or die(mysql_error());
$next = mysql_fetch_array($query_next);
$next_row = mysql_num_rows($query_next);




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
$query_prev = mysql_query($sql_prev, $connect) or die(mysql_error());
$prev = mysql_fetch_array($query_prev);
$prev_row = mysql_num_rows($query_prev);




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
