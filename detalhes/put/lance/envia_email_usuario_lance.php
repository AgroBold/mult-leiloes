<?php

// if ( valida_email($email_usuario) && $tipo_cliente != 1 ) {
if ( valida_email($email_usuario) ) {

  // MONTA O CORPO DO E-MAIL
  $mensagem = 
  " <br>
    Olá <strong>$nome_usuario</strong>!
    
    <br><br>
    Seu lance no Lote <strong>$nome_animal</strong> foi registrado com Sucesso! Confira os detalhes:
    <br><br>

    <br>Data do lance: <strong>$data_atual</strong>
    <br>Hora do lance: <strong>$hora_atual</strong>
    <br>Valor do lance: <strong>R$ $valor_lance_formatado</strong>

    <br><br>
    Link do Lote - Acesse:
    <a href='$url_site_leiloeira/detalhes/?lote=$id_animal_cripto&div_lote'>$nome_animal</a>
  ";

  // ENVIA E-MAIL
  envia_email($mensagem, "SEU LANCE - LOTE $nome_animal", $nome_usuario, $email_usuario);

} // IF E-MAIL

