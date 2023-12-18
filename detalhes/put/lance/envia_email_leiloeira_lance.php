<?php

if ( valida_email($email_leiloeira) ) {

  // MONTA O CORPO DO E-MAIL
  $mensagem = 
  "
    <br>Olá <strong>$nome_leiloeira</strong>!<br><br>
    O Lote <strong>$nome_animal</strong> acaba de receber um novo lance! Confira os detalhes:<br><br>
    
    <br>Data do lance: <strong>$data_atual</strong>
    <br>Hora do lance: <strong>$hora_atual</strong>
    <br>Valor do lance: <strong>R$ $valor_lance_formatado</strong>
    <br>
    <br>Usuário: <strong>$nome_usuario</strong>
    <br>Local Usuário: <strong>$cidade_usuario / $uf_usuario</strong>

    <br><br>
    Link do Lote - Acesse:
    <a href='$url_site_leiloeira/detalhes/?lote=$id_animal_cripto&div_lote'>$nome_animal</a>
  ";

  // ENVIA E-MAIL
  envia_email(trim($mensagem), "NOVO LANCE - LOTE $nome_animal", strtoupper($nome_leiloeira), $email_leiloeira);

} // IF E-MAIL

