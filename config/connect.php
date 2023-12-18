<?php

// Declaração de Variáveis com dados de acesso ao Servidor 
$server      = "localhost";
$user_server = "leilaoma_siagrob";
$pass_server = 'dV?zBbPBgOCk';	
$bd_name 		 = "leilaoma_sistema_agrobold";

// Realiza a Conexão com o Servidor
$connect = mysql_connect($server, $user_server, $pass_server) or die("Erro ao conectar ao Servidor de Banco de Dados");
$db_server = mysql_select_db($bd_name);
mysql_set_charset('UTF8', $connect);
