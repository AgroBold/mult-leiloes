<?php

@session_start();
include("../../config/config.php");


// OBTEM OS PARAMETROS VIA $_POST
$sigla_estado = trim($_POST['estado_usuario']);


if ( empty($sigla_estado) ) {
	// retorno_usuario("info", "Selecione um estado.");
}


// QUERY DE CONSULTA
$query_select =
"	SELECT nome_cidade FROM tab_cidades
	JOIN tab_uf ON tab_uf.id_uf = tab_cidades.id_uf_cidade
	WHERE (
		sigla_uf = '$sigla_estado'
	)
	ORDER BY nome_cidade ASC
";

// Executa a Query
$select = executa_query($query_select);


// Verifica se deu certo a Conexão com o Banco
if($select) {
	
	$i = 0;
	$cidades = array();

	while( $dados_cidade = $select->fetchAll(PDO::FETCH_ASSOC) ) {		
		$cidades[$i] = $dados_cidade;
		$i++;
	}

	$retorno_cliente = array (
		"result" => "success",
		"message" => "",
		"data" => json_encode($cidades)
	);

	// Converte o Array para formato JSON
	$resposta = json_encode($retorno_cliente);
	echo $resposta;
	exit;	
}

// Else...
retorno_usuario("error", "Não foi possível obter os dados das cidades deste Estado no momento!<br>Erro:");
