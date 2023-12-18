<?php
	
@session_start();
include("../../config/config.php");

// OBTEM OS PARAMETROS VIA $_POST
$email_usuario = strtolower($_POST['email_usuario']);
$senha_usuario = $_POST['senha_usuario'];


// VERIFICA SE OS CAMPOS ABAIXO ESTÃO PREENCHIDOS
if ( empty(trim($email_usuario)) || empty(trim($senha_usuario)) ) {
	retorno_usuario("error", "Preencha seu <b>Login</b> e <b>Senha</b>!");
}



/*--------------------
	CONSULTA O USUÁRIO
---------------------- */

$query_select = 
"	SELECT * FROM tab_usuarios
	WHERE (
		id_haras = '$leiloeira' AND
		email_usuario = '$email_usuario' AND
		senha_usuario = '$senha_usuario'
	)
";


$select = executa_query($query_select);

if ( isset($select->error_msg) ) {
  retorno_usuario('error', "<b>Erro:</b> $select->error_msg");
}

// SE NAO ACHOU NINGUEM...
if( empty($select->dados) ) {
	retorno_usuario('warning', "<strong>E-MAIL OU SENHA INCORRETO(S)!</strong><br>Verifique e tente novamente.");
}


$usuario = $select->dados[0];


// SE O USUÁRIO ESTIVER COM A APROVAÇÃO AINDA PENDENTE...
if ( (int)$usuario->situacao_usuario == 3 ) {
	retorno_usuario('warning', "Seu cadastro ainda está <b>pendente</b>. Aguarde, ou entre em contato com o administrador.");
}

// SE O USUÁRIO TIVER COM O CADASTRO REPROVADO PELO ADMINISTRADOR...
elseif ( (int)$usuario->situacao_usuario != 1 )  {
	retorno_usuario('error', "Infelizmente seu cadastro foi <b>Reprovado</b> devido a alguma pendência. Entre em contato com o administrador para mais detalhes.");
}




// ATUALIZA AS VISITAS NO BANCO
$acessos = (int)$usuario->acessos_usuario + 1; // Incrementa o contador a cada Acesso à Area do Cliente

$id_usuario = (int)$usuario->id_usuario;
$query = "UPDATE tab_usuarios SET acessos_usuario = '$acessos' WHERE id_usuario = '$id_usuario'";
$update = executa_query($query);

if ( isset($update->error_msg) ) {
  retorno_usuario('error', "<b>Erro:</b> $update->error_msg");
}


$IP_USER = $_SERVER["REMOTE_ADDR"];

// Registra o Acesso do Usuário no Log de Acessos:
$query =
"	INSERT INTO tab_log (
		id_usuario_log,
		data_log,
		hora_log,
		ip_user_log
	) 
	VALUES (
		'$id_usuario',
		CURDATE(),
		CURTIME(),
		'$IP_USER'
	)
";
$insert = executa_query($query);

if ( isset($insert->error_msg) ) {
  retorno_usuario('error', "<b>Erro:</b> $insert->error_msg");
}

// Grava em Sessão os dados do Usuário
$_SESSION['id_usuario'] = $usuario->id_usuario;
$_SESSION['nome_usuario'] = mb_strtoupper($usuario->nome_usuario, "UTF-8");

$array_nome = explode(' ', $_SESSION['nome_usuario']);
$_SESSION['pnome_usuario'] = trim($array_nome[0]);

$_SESSION['email_usuario'] = $usuario->email_usuario;
$_SESSION['banco_usuario'] = $usuario->banco_usuario;
$_SESSION['acessos_usuario'] = $usuario->acessos_usuario;

$_SESSION['cidade_usuario'] = mb_strtoupper($usuario->cidade_usuario, 'UTF-8');
$_SESSION['uf_usuario'] = mb_strtoupper($usuario->uf_usuario, 'UTF-8');

retorno_usuario('success', "Login realizado com Sucesso!");