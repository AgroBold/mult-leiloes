<?php
	
@session_start();
include("../../../config/config.php");

// ID DE SESSÃO DO USUÁRIO
$id_usuario = (int)$_SESSION['id_usuario'];

// OBTEM OS PARAMETROS VIA $_POST	
$id_lote = (int)descriptografa(trim($_POST['id_lote']));
$id_leilao = (int)descriptografa(trim($_POST['id_leilao']));
$nome_animal = trim($_POST['nome_animal']);
$valor_lance = (float)trim($_POST['valor_lance']);



/*----------------------------------
  VALIDANDO OS DADOS
------------------------------------ */
if ( $id_usuario <= 0 ) {
  retorno_usuario("warning", "Sessão Expirada!<br>Faça Login Novamente para dar seu Lance.", -1);
}

if ($id_leilao <= 0 || $id_lote <= 0 || empty($nome_animal)) {
  retorno_usuario("error", "Lote e/ou Leilão inexistentes. Atualize a Página e tente novamente.");
}

if ($valor_lance <= 0) {
  retorno_usuario("warning", "Selecione um <b>valor</b> para dar seu Lance!");
}



/*-------------------------------------
  VEFIFICA SE O LOTE JÁ ESTÁ VENDIDO
--------------------------------------- */
$select_lote_vendido = 
" SELECT * FROM tab_lotes_leiloes
  WHERE (
    situacao_comercial_animal_evento = '1'
    AND id_lote_leilao = '$id_lote'
  )
";

$resultado = executa_query($select_lote_vendido) or die();

if ( (int)sizeof($resultado) > 0 ) {
  retorno_usuario("warning", "<b>LANCE NÃO REALIZADO!</b><br>Este lote já encontra-se vendido!");
}










// VERIFICA SE JÁ NÃO FOI DADO UM LANCE DE MESMO VALOR, NO MESMO ANIMAL
$select_lance = 
" SELECT * FROM tab_lances
  WHERE (
    valor_lance >= $valor_lance AND
    id_tab_lote_leilao = '$id_lote'
  )
";
$resultado_lance = executa_query($select_lance) or die();
if ( (int)sizeof($resultado_lance) > 0 ) {
  retorno_usuario("warning", "Já existe Lance neste Lote com valor menor ou igual a R$ $valor_lance! Selecione um valor diferente.");
}


// retorno_usuario("info", ">>>".$_SESSION['cidade_usuario'] .'/'.$_SESSION['uf_usuario']);






/*-----------------------------------------------
  VEFIFICA SE O LEILÃO JÁ INICIOU
------------------------------------------------- */
$select_prazo_leilao = 
" SELECT data_inicio, hora_inicio FROM tab_leiloes
  WHERE (
    NOW() < TIMESTAMP(data_inicio, hora_inicio)
    AND ID = '$id_leilao'
  )
";

$resultado_prazo_leilao = executa_query($select_prazo_leilao) or die();

if ( (int)sizeof($resultado_prazo_leilao) > 0 ) {
  retorno_usuario("warning", "<b>Leilão não Iniciado!</b><br>Aguarde o início do Leilão!");
}




/*-----------------------------------------------
  VEFIFICA SE O PRAZO DO LEILÃO JÁ ACABOU
------------------------------------------------- */
$select_prazo_leilao = 
" SELECT data_termino, hora_termino FROM tab_leiloes
  WHERE (
    NOW() > TIMESTAMP(data_termino, hora_termino)
    AND ID = '$id_leilao'
  )
";

$resultado_prazo_leilao = executa_query($select_prazo_leilao) or die();

if ( (int)sizeof($resultado_prazo_leilao) > 0 ) {
  retorno_usuario("warning", "<b>Leilão Finalizado!</b><br>Você não pode mais dar Lances.");
}




// if ( $_SERVER['REMOTE_ADDR'] == '138.36.166.42' ) {
//   // retorno_usuario("info", "okokokoko");
// }


// $email_usuario  = $_SESSION['email_usuario'];
// retorno_usuario("info", "Desenvolvimento... $num_parcelas x $valor_parcela_formatada = $valor_total_formatado");
// retorno_usuario("info", "$nome_leiloeira<br>$valor_lance<br>$email_usuario<br>$email_leiloeira");
// $POST = print_r($_POST);

// retorno_usuario("info", "<pre>$POST</pre>");
// print_r($valor_lance);
// exit;





/*-------------------------------------------------
  INICIANDO O CADASTRO DO LANCE A PARTIR DAQUI...
--------------------------------------------------- */
$insert_lance =
" INSERT INTO tab_lances (
    id_tab_lote_leilao,
    id_usuario_lance,
    id_leilao_lance,
    valor_lance,
    
    data_lance,
    hora_lance
  )
  VALUES (
    '$id_lote',
    '$id_usuario',
    '$id_leilao',
    '$valor_lance',
    
    CURDATE(),
    CURTIME()
  )
";

// OBTEM O RESULTADO DO INSERT
$resultado_lance_usuario = executa_query($insert_lance) or die();

if (!$resultado_lance_usuario) {
  retorno_usuario("error", "Não foi Possível cadastrar seu lance no momento!");
}






/*----------------------------------------
  OBTENDO DADOS PARA OS E-MAILS
------------------------------------------ */

// OBTENDO DADOS DO USUARIO
$nome_usuario   = $_SESSION['nome_usuario'];
$email_usuario  = $_SESSION['email_usuario'];
$cidade_usuario = trim($_SESSION['cidade_usuario']) != "" ? utf8_decode($_SESSION['cidade_usuario']) : "- - -";
$uf_usuario     = trim($_SESSION['uf_usuario']) != "" ? utf8_decode($_SESSION['uf_usuario']) : "- - -";


// OBTENDO DATA E HORA DO LANCE
$data_atual = date("d/m/Y");
$hora_atual = date("H:i:s");
$valor_lance_formatado = number_format($valor_lance,  2, ',', '.');
  
$id_animal_cripto = criptografa($id_lote);


/*---------------------------------------------
  INICIANDO OS DISPAROS DOS E-MAILS
----------------------------------------------- */

// OBS.: VARIÁVEL $email_leiloeira, USADA NOS INCLUDES ABAIXO, ESTÁ DEFINIDA NO path.php

// ENVIA E-MAIL PARA A LEILOEIRA
include("./envia_email_leiloeira_lance.php");

// ENVIA E-MAIL PARA O USUÁRIO QUE DEU O LANCE
include("./envia_email_usuario_lance.php");

// ENVIA E-MAILS PARA TODOS OS DEMAIS DISPUTANTES DO LOTE
include("./envia_emails_disputantes_lance.php");

retorno_usuario("success", "Seu Lance foi Registrado com Sucesso!<br>Verifique seu E-mail.");