<?php

@session_start();
include ("../../config/config.php");

//Obtem os dados do Formulário de Contato:
$nome_contato = trim(mb_strtoupper(addslashes($_POST['nome_usuario'])));
$email_contato = trim(addslashes($_POST['email_usuario']));
$celular_contato = addslashes($_POST['celular_usuario']);

$mensagem_contato = trim(addslashes($_POST['mensagem_usuario']));
// $mensagem_contato = str_replace(array("\n", "\r"), ' ', $mensagem_contato);

// VALIDA OS CAMPOS
if( empty($nome_contato) || empty($email_contato) || empty($celular_contato) )  {
	retorno_usuario("error", "Preencha todos os campos com <b>\"*\"</b>!");
}

// VALIDA A MENSAGEM
if( empty($mensagem_contato) )  {
	retorno_usuario("error", "Escreva uma breve <b>mensagem</b> sobre o assunto que deseja nos contatar.");
}


// VALIDA O E-MAIL
if ( !valida_email($email_contato) ) {
  retorno_usuario('warning', "<b>E-mail inválido!</b><br>Verifique e tente novamente.");
}






// MENSAGEM DO E-MAIL
$MENSAGEM_USER = "
	<b>Olá $nome_leiloeira! Você acaba de receber uma mensagem enviada através do site!</b>

	<br><br>INFORMAÇÕES RECEBIDAS:
	<br>Nome:<b> $nome_contato</b>
	<br>E-mail:<b> $email_contato</b>
	<br>Telefone:<b> $celular_contato</b>

	<hr>
	<b>MENSAGEM:</b><br> $mensagem_contato
	<hr>
";

// ENVIA E-MAIL
$ENVIOU = envia_email($MENSAGEM_USER, 'MENSAGEM DE CONTATO', $nome_leiloeira, $email_leiloeira);

// VERIFICA SE HOUVE ALGUM ERRO NO ENVIO
if ( !$ENVIOU ) {
	retorno_usuario("error", "Erro no envio da mensagem! Tente novamente.");
}

// Else...
retorno_usuario("success", "Sua mensagem foi <b>enviada com sucesso</b>! Em breve entratemos em contato com você!");


