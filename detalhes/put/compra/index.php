<?php
	
@session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/config/config.php');

$id_usuario = (int)trim($_SESSION['id_usuario']);

// Obtem os Parametros Via POST
$id_lote_leilao = $id_lote = (int)descriptografa($_POST['id_lote']);
$quantidade = (int)trim($_POST['quantidade']);

/*-------------------------
  VALIDANDO OS DADOS
--------------------------- */
if ( $id_usuario <= 0 ) {
  retorno_usuario("warning", "Sessão Expirada!<br>Faça Login Novamente para realizar sua compra!", -1);
}

if ( $quantidade <= 0) {
  retorno_usuario("warning", "Número de unidades inválido! Tente novamente");
}
if ( $id_lote <= 0 ) {
  retorno_usuario("error", "Lote e/ou Leilão inexistentes. Atualize a Página e tente novamente!");
}






// OBTENDO OS DADOS DO LOTE / LEILÃO / ANIMAL
$sql_dados =
" SELECT * FROM tab_lotes_leiloes 
  JOIN tab_animais ON id_animais = tab_lotes_leiloes.id_lote
  JOIN tab_leiloes ON tab_leiloes.ID = tab_lotes_leiloes.id_leilao
  JOIN tab_grupos ON tab_grupos.id_grupo = tab_lotes_leiloes.tipo_produto_animal
  JOIN tab_haras ON tab_haras.id_haras = tab_lotes_leiloes.id_haras
  LEFT JOIN tab_tipo_marcha ON tab_tipo_marcha.id_tipo_marcha = tab_animais.tipo_marcha_animal
  LEFT JOIN tab_genealogias ON tab_genealogias.id_animal = tab_animais.id_animais
  LEFT JOIN tab_documentos ON tab_documentos.id_documento = tab_leiloes.id_catalogo_leilao
  WHERE (
    tab_animais.id_haras = '$leiloeira'
    AND id_lote_leilao = '$id_lote'
  )
";

$query_dados = mysql_query($sql_dados, $connect) or die (mysql_error());


if ((int)mysql_num_rows($query_dados) <= 0 ) {
  retorno_usuario("error", "<b>COMPRA NÃO REALIZADA!</b><br>Lote não encontrado!");
}

$lote = mysql_fetch_object($query_dados);





/*---------------------------------
  VEFIFICA SE O LEILÃO JÁ INICIOU
----------------------------------- */
$select_prazo_leilao = 
" SELECT data_inicio, hora_inicio FROM tab_leiloes
  WHERE (
    NOW() < TIMESTAMP(data_inicio, hora_inicio)
    AND ID = '$lote->id_leilao'
  )
";

$resultado_prazo_leilao = mysql_query($select_prazo_leilao, $connect) or die(mysql_error());

if ( (int)mysql_num_rows($resultado_prazo_leilao) > 0 ) {

  $leilao = mysql_fetch_object($resultado_prazo_leilao);
  $data_inicio = date('d/m/Y', strtotime($leilao->data_inicio));
  $hora_inicio = date('H:i', strtotime($leilao->hora_inicio));
  retorno_usuario("warning", "<b>Evento fechado para Compras!</b><br>Você poderá realizar compras neste evento somente a partir das $hora_inicio em $data_inicio");
}

/*----------------------------------------
  VEFIFICA SE O PRAZO DO LEILÃO JÁ ACABOU
------------------------------------------ */
$select_prazo_leilao = 
" SELECT data_termino, hora_termino FROM tab_leiloes
  WHERE (
    NOW() > TIMESTAMP(data_termino, hora_termino)
    AND ID = '$lote->id_leilao'
  )
";

$resultado_prazo_leilao = mysql_query($select_prazo_leilao, $connect) or die(mysql_error($connect));

if ( (int)mysql_num_rows($resultado_prazo_leilao) > 0 ) {
  retorno_usuario("warning", "<b>Evento Finalizado!</b><br>Você não pode mais realizar compras neste evento!");
}





$valor_prestacao = (float)$lote->valor_venda_direta_animal;


if ( (int)$lote->situacao_comercial_animal_evento == 1 ) {
  retorno_usuario("warning", "<b>COMPRA NÃO REALIZADA!</b><br>Este Animal já encontra-se vendido!");
}
if ( $valor_prestacao <= 0  ) {
  retorno_usuario("warning", "<b>COMPRA NÃO REALIZADA!</b><br>Não existe valor de venda cadastrado para este Animal!");
}

$num_parcelas = (int)$lote->parcelas_leilao;
if( (int)$lote->tipo_parcelamento_animal > 0) {
	$num_parcelas = (int)$lote->tipo_parcelamento_animal;
}


if ( $num_parcelas <= 0  ) {
  retorno_usuario("warning", "<b>COMPRA NÃO REALIZADA!</b><br>Não existe número de parcelas cadastrado para este Evento!");
}

// retorno_usuario("info", "<b>OKOKOk");


// INICIO A TRANSACTION
mysql_query("START TRANSACTION");


$update_lote_leilao = '';
if ( (int)$lote->tipo_multiplo == 1 ) {

  $quantidade_disponivel = (int)$lote->quantidade_coberturas;
  if ( $quantidade > $quantidade_disponivel ) {
    retorno_usuario("warning", "<b>Quantidade indisponível!</b><br>Você não pode realizar a compra de $quantidade unidades, pois só temos $quantidade_disponivel unidades deste produto! Selecione um número menor de unidades!");
  }
    
  // ATUALIZA A QUANTIDADE DE COBERTURAS DISPONÍVEIS
  $nova_quantidade = $quantidade_disponivel - $quantidade;

  $SUBQUERY_VENDIDO = '';
  if ( $nova_quantidade == 0 ) {
    $SUBQUERY_VENDIDO = ",situacao_comercial_animal_evento = '1'";
  }

  $update_lote_leilao =
  " UPDATE tab_lotes_leiloes SET
      quantidade_coberturas = ($nova_quantidade)
      $SUBQUERY_VENDIDO
    WHERE id_lote_leilao = '$id_lote_leilao'
  ";

}
else {

  $update_lote_leilao =
  " UPDATE tab_lotes_leiloes SET
      situacao_comercial_animal_evento = '1'
    WHERE id_lote_leilao = '$id_lote_leilao'
  ";

}

$resultado = mysql_query($update_lote_leilao, $connect);

if ( !$resultado ) {
  retorno_usuario("error", "Não foi possível realizar a compra no momento! Atualize a página e tente novamente. " . mysql_error());
}



$nome_grupo = str_replace(['EQUINO - ', '(EQUINO)'], '', $lote->nome_grupo);


if ( $valor_prestacao <= 0) {
  retorno_usuario("warning", "Valor de Compra não identificado! Tente novamente");
}
if ( $num_parcelas <= 0 ) {
  retorno_usuario("error", "Erro ao obter o número de parcelas! Atualize a Página e tente novamente.");
}
if ( empty(trim($nome_grupo)) ) {
  retorno_usuario("error", "Erro ao obter a categoria do lote! Atualize a Página e tente novamente.");
}



$valor_compra = $quantidade * $valor_prestacao;
// retorno_usuario("info", "<b>Implementando!</b><br>Aguarde... $email_leiloeira");




/*-------------------------------------------------------------
  INICIANDO O CADASTRO DO LANCE (COMPRA) A PARTIR DAQUI....
-------------------------------------------------------------*/

$insert_lance_compra =
" INSERT INTO tab_lances (
    id_usuario_lance,
    id_leilao_lance,
    id_tab_lote_leilao,
    data_lance,
    hora_lance,
    valor_lance,

    quantidade_lances,
    tipo_lance
  )
  VALUES (    
    '$id_usuario',
    '$lote->id_leilao',
    '$id_lote',
    CURDATE(),
    CURTIME(),
    '$valor_compra',

    '$quantidade', -- QUANTIDADE DE UNIDADES COMPRADAS
    '2'            -- TIPO COMPRA
  )
";

// OBTEM O RESULTADO DO INSERT
$resultado = mysql_query($insert_lance_compra, $connect) or die(mysql_error());
if ( !$resultado ) {
  retorno_usuario("error", "Não foi Possível cadastrar sua compra no momento! Erro: ". mysql_error($connect));
}

/*----------------------------------------
  OBTENDO DADOS PARA OS E-MAILS
------------------------------------------ */

// OBTENDO DADOS DO USUARIO
$uf_usuario = trim($_SESSION['uf_usuario']) != "" ? $_SESSION['uf_usuario'] : "- - -";
$nome_usuario = $_SESSION['nome_usuario'];
$email_usuario = $_SESSION['email_usuario'];
$cidade_usuario = trim($_SESSION['cidade_usuario']) != "" ? $_SESSION['cidade_usuario'] : "- - -";


// OBTENDO DATA E HORA DO LANCE
$data_atual = date("d/m/Y");
$hora_atual = date("H:i:s");
$valor_presta_formatado = number_format($valor_prestacao,  2, ',', '.');
$valor_compra_formatado = number_format($valor_compra,  2, ',', '.');
$valor_total_formatado = number_format($num_parcelas * $valor_compra,  2, ',', '.');
$ID_LEILAO_CRIPTO = criptografa($lote->id_leilao);
// $url_site = "https://www.opportunityleiloes.com.br";



$INFO_MSGS = 
" <br><br>
  Confira os detalhes:
  <br><br

  <br>Usuário: <strong>$nome_usuario</strong>
  <br>Local Usuário: <strong>$cidade_usuario / $uf_usuario</strong>

  <br>
  <br>Data da compra: <strong>$data_atual</strong>
  <br>Hora da compra: <strong>$hora_atual</strong>
  <br>Quantidade: <strong>$quantidade unidade(s) ($nome_grupo) (R$ $valor_presta_formatado/cada)  </strong>
  <br>Valor Total Compra: <strong>$num_parcelas x R$ $valor_compra_formatado = R$ $valor_total_formatado</strong>

  <br><br>
  Link do Lote - Acesse:
<a href='$url_site/lotes/?leilao=$ID_LEILAO_CRIPTO'>$lote->nome_animal</a>
";






/*----------------------------
  ENVIA E-MAIL PARA O USUÁRIO
------------------------------ */
$mensagem = 
" <br>Olá <strong>$nome_usuario</strong>!<br><br>
  Sua compra no lote <strong>$lote->nome_animal</strong> foi registrado com Sucesso!
  $INFO_MSGS
";
// Envia o E-mail
envia_email($mensagem, $nome_leiloeira . " | SUA COMPRA - $lote->nome_animal", $nome_usuario, strtolower($email_usuario));
  





/*--------------------------------
  ENVIA E-MAIL PARA A LEILOEIRA
---------------------------------- */
$mensagem = 
" <br>Olá <strong>$nome_leiloeira</strong>!<br><br>
  O lote <strong>$lote->nome_animal</strong> acaba de receber uma proposta de compra!  
  $INFO_MSGS
";
// Envia o E-mail
envia_email($mensagem, $nome_leiloeira . " | Novo Compra Realizada - $lote->nome_animal", $nome_usuario, $email_leiloeira);







// mysql_query("ROLLBACK");
mysql_query("COMMIT");
retorno_usuario("success", "Sua Compra foi Registrada com Sucesso!<br>Um comprovante foi enviado para o seu e-mail!");
