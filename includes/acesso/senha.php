<?php

@session_start();
include('../../config/config.php');

// OBTEM E-MAI VIA POST
$email = strtolower($_POST['email_usuario']);

// VALIDA O E-MAIL
if ( strlen($email) < 1 ) {
  retorno_usuario('warning', "Informe seu E-mail!");
}

if ( !valida_email($email) ) {
  retorno_usuario('warning', "<b>E-MAIL INVÁLIDO!</b><br>Verifique e tente novamente.");
}

// CONSULTA EXISTÊNCIA DO E-MAIL
$query_select = "SELECT * FROM tab_usuarios WHERE email_usuario = '$email' AND id_haras = '$leiloeira'";
$select = executa_query($query_select);


// VERIFICA SE A CONSULTA DEU CERTO
if (isset($select->error_msg)) {
  retorno_usuario('error', "<b>Erro:</b>$select->error_msg");
}

// VERIFICA A EXISTÊNCIA DO E-MAIL NO BANCO
if(empty($select->dados) ) {
	retorno_usuario('warning', "Este e-mail <b>não se encontra</b> cadastrado no sistema. Verifique e tente novamente!");
}


$usuario = $select->dados[0];


// Cria Nova Senha de 6 digitos aleatoria
$randomid = mt_rand(100000, 999999); 

//Atualiza a Senha no Banco de Dados
$query_update = "UPDATE tab_usuarios SET senha_usuario = '$randomid' WHERE id_usuario = '$usuario->id_usuario'";
$update = executa_query($query_update, $connect);

if (isset($update->error_msg)) {
  retorno_usuario('error', "<b>Erro:</b>$update->error_msg");
}


// MENSAGEM DO E-MAIL
$MENSAGEM_USER = "
  Olá <b>$usuario->nome_usuario</b>!
  <br>
  <br>
  Você solicitou um lembrete de senha no site do $nome_leiloeira. Segue abaixo a sua <b>nova</b> senha:
  <br>
  <br>
  E-mail de acesso: <b>$email</b><br>
  Nova senha: <b>$randomid</b>
  <br>
  <br>
  <b>Importante:</b> Anote a sua senha em local seguro!
";


// ENVIA E-MAIL
$ENVIOU = envia_email($MENSAGEM_USER, 'RECUPERAÇÃO DE SENHA', $usuario->nome_usuario, $usuario->email_usuario);

// VERIFICA SE HOUVE ALGUM ERRO NO ENVIO
if ( !$ENVIOU ) {
	retorno_usuario("error", "Erro no envio do E-mail! Tente novamente.");
}

retorno_usuario("success", "<b>SOLICITAÇÃO ENVIADA COM SUCESSO</b>!<br>Verifique seu endereço de e-mail.");

