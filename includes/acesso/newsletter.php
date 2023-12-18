<?php
	
@session_start();
include("../../config/config.php");

// ID DE SESSÃO DO USUÁRIO
$id_usuario = (int)$_SESSION['id_usuario'];

// OBTEM OS PARAMETROS VIA $_POST	
$email = mb_strtolower(trim($_POST['email_newsletter']));


/*----------------------------------
  VALIDANDO OS DADOS
------------------------------------ */
if ( empty($email) ) {
  retorno_usuario("warning", "Informe seu e-mail");
}


if ( !valida_email($email) ) {
  retorno_usuario("warning", "Endereço de e-mail Inválido!");
}



/* -----------------------------------------------------------
  VEFIFICA SE E-MAIL JÁ NÃO ESTÁ CADASTRADO
-------------------------------------------------------------- */
$select_email = 
" SELECT * FROM tab_newsletter
  WHERE (
    email_cadastrado = '$email'
    AND id_empresa = '$leiloeira'
  )
";

$resultado = executa_query($select_email) or die();

if ( (int)$resultado->num_rows > 0 ) {
  retorno_usuario("info", "<b>E-MAIL NÃO CADASTRADO!</b><br>Este e-mail já encontra-se cadastrado. Obrigado!");
}



/*------------------------
  INICIANDO O CADASTRO... 
-------------------------- */
$insert =
" INSERT INTO tab_newsletter (
   id_empresa,
   email_cadastrado,
   IP_ORIGEM_CADASTRO,
   DATE_TIME_CADASTRO
  )
  VALUES (
    '$leiloeira',
    '$email',
    '$IP_ACESSO',
    NOW()
  )
";

// OBTEM O RESULTADO DO INSERT
$RESULTADO = executa_query($insert) or die();

if ( !$RESULTADO ) {
  retorno_usuario("error", "Não foi Possível cadastrar seu e-mail no momento! Erro: ". mysql_error($connect));
}

retorno_usuario("success", "E-MAIL CADASTRADO COM SUCESSO!<br>Aguarde que em breve tem enviaremos novidades!");
