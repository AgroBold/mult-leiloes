<?php

$autoriza_ips = ['181.233.184.21', '131.161.4.160', '181.233.184.12', '201.51.226.137'];
$ipMatch = false;



@session_start();
session_cache_expire(120);

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL & ~(E_NOTICE|E_DEPRECATED));



$url_site_leiloeira = "www.multleiloes.com.br/";
$leiloeira = "103";
$email_leiloeira = "contato@multleiloes.com.br";
$nome_leiloeira = "Mult Leilões";
$tel_leiloeira = "???";
$RANDOM = rand(1, 9999);



foreach ($autoriza_ips as $ip) {
  if($_SERVER['REMOTE_ADDR'] === $ip){
    $ipMatch = true;

    $leiloeira = 11;
    $email_leiloeira = "ribeirosacarlos@gmail.com";
    $tel_leiloeira = "31991449237";
    break;
  }
}

if(!$ipMatch){
  exit();
}




$ID_USUARIO_LOGADO = (int)trim($_SESSION['id_usuario']);
$IP_ACESSO = $_SERVER["REMOTE_ADDR"];

include("path.php");
include('/home/agrobold/public_html/cdn/php/includes/connect_pdo.php');
include '/home/agrobold/public_html/cdn/php/turbo-mail/TurboApiClient.php';
include '/home/agrobold/public_html/cdn/php/functions/sistema.php';


date_default_timezone_set('America/Sao_Paulo'); // DEFINE O FUSO HORÁRIO
setlocale(LC_ALL, "pt_BR", "ptb");


include("funcoes.php"); // CONEXÃO BANCO DE DADOS MYSQL
include("api.php");
conta_visitas_site(103);