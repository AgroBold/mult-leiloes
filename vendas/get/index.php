<?php

include("../../config/config.php");

// $_POST
$id_categoria = (int)$_POST['id_categoria'] > 0 ? (int)$_POST['id_categoria'] : '%';
$id_leilao = (int)trim($_POST['id_leilao']);

$sql_lotes =
" SELECT
    *,
    IF (
		  categoria_site = 1 OR categoria_site = 3, 
      valor_leilao_animal,
      valor_venda_direta_animal
    ) AS VALOR_ANIMAL,


    IF(
      tipo_parcelamento_animal > 0,
      tipo_parcelamento_animal,
      parcelas_leilao
    ) AS NUM_PARCELAS_ANIMAL,
    

    DATEDIFF( NOW(), nascimento_animal) AS IDADE_EM_DIAS
  FROM tab_lotes_leiloes
  JOIN tab_animais ON id_animais = id_lote
  JOIN tab_leiloes ON (
    NOW() < TIMESTAMP(data_termino, hora_termino) -- EVENTOS DENTRO DO PRAZO
    AND ID = id_leilao -- EVENTOS DOS LOTES
    AND situacao = '1' -- ATIVOS
    AND tipo = '6' -- VENDA DIRETA !!!
  )
  JOIN tab_tipos_eventos ON id_tp = tipo
  LEFT JOIN tab_genealogias ON id_animal = id_animais
  LEFT JOIN tab_grupos ON tab_grupos.id_grupo = tab_lotes_leiloes.tipo_produto_animal
  LEFT JOIN tab_racas ON id_raca = id_raca_animal
  WHERE (
    situacao_animal_evento = '1' --  LOTES ATIVOS
    AND tab_lotes_leiloes.id_haras = '$leiloeira'
    AND tab_lotes_leiloes.tipo_produto_animal LIKE '$id_categoria'
  )
  ORDER BY ordem_animal
";

$resultado = executa_query($sql_lotes);

print_obj($resultado);
// $dados = $resultado->dados;
// $num_lotes = sizeof($dados);


if ($num_lotes > 0) {
  foreach($dados as $dado) {
    include('../../includes/card_animal.php');
  }
  exit;
}
?>

<div class="text-center text-muted pb-30px mb-lg border-ccc">
  <br><br><br>
  
  <i class="fa fa-search fa-2x"></i><br>
  <h2 class="nmb"><strong>Nenhum Lote Encontrado!</strong></h2>
  <p class="font-19px">
    Aguarde que em breve teremos diversos Lotes!
  </p>

  <br><br>
</div>
