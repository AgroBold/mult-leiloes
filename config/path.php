<?php

$protocolo_app = isset($_SERVER["HTTP"]) ? 'http' : 'http';
$defalt_path_server = $protocolo_app . "://" . $_SERVER['SERVER_NAME'] . '/';

$defalt_path_app = $defalt_path_server;

$app = array (
	"PROTOCOLO" => "$protocolo_app",
	"SERVER" 		=> "$defalt_path_server",
	"APP" 			=> "$defalt_path_app",
);


$img_sem_img = $sem_img = 'https://sistema.agrobold.com.br/assets/img/sem_imagem.jpg';
$url_docs_sistema = $link_padrao_fotos = "https://sistema.agrobold.com.br/upload/docs/";

$PATH_ROOT_SERVER = '/home/agrobold/public_html';
$PATH_ROOT_SISTEMA = "$PATH_ROOT_SERVER/sistema";

