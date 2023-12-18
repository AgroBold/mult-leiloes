<?php

// RECEBE O ID DO LOTE VIA GET 
$id_lote = $id_lote_leilao = (int)descriptografa(addslashes(trim($_GET['lote'])));

// ATUALIZA AS VISITAS DO LOTE 
$query_visitas_lote =
"	UPDATE tab_lotes_leiloes SET
    num_visitas_lote = num_visitas_lote + 1
  WHERE (
    id_lote_leilao = '$id_lote_leilao'
    AND id_haras = '$leiloeira'
  )
";
    
$insert_visitas_lote = mysql_query($query_visitas_lote, $connect) or die (mysql_error($connect));

// OBTENDO OS DADOS DO LOTE / LEILÃO / ANIMAL
$sql_dados =
" SELECT
    *,
    tab_leiloes.tipo AS TIPO_EVENTO,
    -- tab_lotes_leiloes.cotas_venda_animal AS COTAS_VENDA_LOTE,
    tab_lotes_leiloes.tipo_produto_animal AS TIPO_PRODUTO_ANIMAL,
    (SELECT nome_animal FROM tab_animais WHERE id_animais = tab_lotes_leiloes.id_animal_macho_embriao) AS NOME_PAI_EMBRIAO,
    (SELECT SUM(num_visitas_lote) FROM tab_lotes_leiloes WHERE tab_lotes_leiloes.id_lote_leilao = '$id_lote_leilao') AS NUM_VISITAS_LOTE,
    (SELECT sum(cotas_a_venda) FROM tab_vendedores_lotes WHERE id_tab_lote_leilao = tab_lotes_leiloes.id_lote_leilao) AS COTAS_VENDA_LOTE,

    quantidade_coberturas AS UNIDADES_DISPONIVEIS,

    IF (
      NOW() < TIMESTAMP(data_termino, hora_termino),
      IF( 
        NOW() > TIMESTAMP(data_inicio, hora_inicio),
        'ACONTECENDO',
        'LEILÃO FUTURO'
      ),
      'ENCERRADO'
    ) AS STATUS_LEILAO,

    IF(
      tipo_parcelamento_animal > 0,
      tipo_parcelamento_animal,
      parcelas_leilao
    ) AS NUM_PARCELAS_ANIMAL,
    

    IF (
		  categoria_site = 1 OR categoria_site = 3, 
      valor_leilao_animal,
      valor_venda_direta_animal
    ) AS VALOR_ANIMAL,


    (
		  SELECT
        group_concat(nome_usuario SEPARATOR '; ')
      FROM tab_vendedores_lotes
      JOIN tab_usuarios ON id_usuario = id_pessoa_vendedor
      WHERE id_tab_lote_leilao = tab_lotes_leiloes.id_lote_leilao
    ) AS NOMES_VENDEDORES,


    (
      SELECT
        MAX(valor_lance)
      FROM tab_lances
      WHERE (
        id_tab_lote_leilao = '$id_lote' AND
        id_leilao_lance = tab_lotes_leiloes.id_leilao
      )
    ) AS VALOR_ULTIMO_LANCE

  FROM tab_lotes_leiloes 
  JOIN tab_animais ON id_animais = tab_lotes_leiloes.id_lote
  JOIN tab_leiloes ON tab_leiloes.ID = tab_lotes_leiloes.id_leilao
  JOIN tab_tipos_eventos ON id_tp = tipo
  JOIN tab_grupos ON tab_grupos.id_grupo = tab_lotes_leiloes.tipo_produto_animal
  LEFT JOIN tab_racas ON id_raca = id_raca_animal
  JOIN tab_haras ON tab_haras.id_haras = tab_lotes_leiloes.id_haras
  LEFT JOIN tab_tipo_marcha ON tab_tipo_marcha.id_tipo_marcha = tab_animais.tipo_marcha_animal
  LEFT JOIN tab_genealogias ON tab_genealogias.id_animal = tab_animais.id_animais
  LEFT JOIN tab_documentos ON tab_documentos.id_documento = tab_leiloes.id_catalogo_leilao
  WHERE (
    tab_animais.id_haras = '$leiloeira'
    AND id_lote_leilao = '$id_lote_leilao'
  )
";

$query_dados1 = mysql_query($sql_dados, $connect) or die (mysql_error());
$query_dados2 = mysql_query($sql_dados, $connect) or die (mysql_error());

$dados = mysql_fetch_array($query_dados1);
$lote = mysql_fetch_object($query_dados2);

$num_lote_atual = (int)$dados['ordem_animal'];
$num_lote_leilao = trim($dados['num_lote_leilao']);
$id_leilao = (int)$dados['id_leilao'];


/*
  1 - LEILÃO VIRTUAL {{SEM LANCE}}
  2 - LEILÃO VIRTUAL WEB / ONLINE COM LANCE
  3 - LEILÃO PRESENCIAL {{SEM LANCE}}
  4 - SHOPPING / FEIRA
  5 - LEILÃO PRESENCIAL [[COM LANCE]]
  6 - VENDA DIRETA / CONSULTORIA COMERCIAL

  7 - LEILÃO VIRTUAL COM PRÉ-LANCE
  8 - CLASSIFICADOS
  9 - PLANTEL
*/
$IS_LEILAO_COM_LANCE = false; // LEILÕES COM LANCES
if ( (int)$dados['categoria_site'] == 1 ) {
  $IS_LEILAO_COM_LANCE = true;
}


// LEILÕES SEM LANCES
$IS_LEILAO_SEM_LANCE = false;
if ( 
    (int)$dados['TIPO_EVENTO'] == 1 ||
    (int)$dados['TIPO_EVENTO'] == 3 ||
    (int)$dados['TIPO_EVENTO'] == 5 
  ) {
  $IS_LEILAO_SEM_LANCE = true;
}


// VARIÁVEL - VENDA DIRETA / SHOPPING
$IS_VENDA = false;
if ( (int)$dados['TIPO_EVENTO'] == 4 || (int)$dados['TIPO_EVENTO'] == 6 || (int)$dados['TIPO_EVENTO'] == 8 ) {
  $IS_VENDA = true;
}

$parcelas_lote = (int)$dados['parcelas_leilao'];

if( (int)$dados['tipo_parcelamento_animal'] > 0) {
	$parcelas_lote = (int)$dados['tipo_parcelamento_animal'];
}



$LOTE_VENDIDO = (int)$lote->situacao_comercial_animal_evento == 1 ? true : false;