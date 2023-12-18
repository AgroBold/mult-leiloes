<?php

@session_start();
include("../../config/config.php");

// DADOS DO FORM VIA POST
$nome = trim(mb_strtoupper($_POST['nome_contato']),"UTF-8");
$email = trim($_POST['email_contato']);
$celular = trim(mb_strtoupper($_POST['celular_contato']),"UTF-8");
$mensagem = trim($_POST['mensagem_contato']);
$nome_animal = trim($_POST['nome_animal_form']);

if( empty($nome_animal) ) {
  retorno_usuario("error", "Lote e/ou Leilão inexistentes. Atualize a Página e tente novamente.");
}

if( empty($email) || empty($nome) || empty($celular) ) {
  retorno_usuario("error", "Por favor, preencha todos os campos com '*'!");    
}

// Teste se o número do telefone está incompleto - Formato com mascara: '(99) 99999-9999'
if (strlen($celular) <= 13) {
  retorno_usuario("error", "Número de celular inválido");    
}


$mensagem =
" <h2 style='text-align:center'>
    E-MAIL RECEBIDO ATRAVÉS DA PÁGINA DO ANIMAL <u><i>$nome_animal</i></u> DO SITE.
  </h2>

  <h5>Informações da mensagem:</h5>
  <h5>Nome: <b>$nome</b></h5>
  <h5>E-mail: <b>$email</b></h5>
  <h5>Celular: <b>$celular</b></h5>
  <h5>Lote: <b>$nome_animal</b></h5>

  <p>Mensagem: <br>$mensagem</p>
";

// ENVIA E-MAIL
if ( !envia_email($mensagem, "$nome_leiloeira | $nome | $nome_animal", $nome, $email_leiloeira) ) {
  retorno_usuario("error", "Não foi possível enviar sua mensagem neste momento!");
}




// Else...
retorno_usuario("success","Sua mensagem de contato foi enviada com sucesso. Aguarde, lhe retornaremos o mais breve possível!");

