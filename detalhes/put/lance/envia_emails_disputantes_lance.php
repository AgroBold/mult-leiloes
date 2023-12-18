<?php

// OBTENDO OS DADOS DE TODOS OS DISPUTANTES DO ANIMAL PARA OS E-MAILS
$select_disputantes = 
" SELECT * FROM tab_lances
  JOIN tab_usuarios ON id_usuario = id_usuario_lance
  JOIN tab_lotes_leiloes ON tab_lotes_leiloes.id_lote_leilao = tab_lances.id_tab_lote_leilao
  JOIN tab_leiloes ON ID = id_leilao_lance
  WHERE (
    id_usuario_lance <> '$id_usuario'
    AND id_tab_lote_leilao = '$id_lote'
  )
  GROUP BY id_usuario_lance
";

$resultado_disputantes = executa_query($select_disputantes);

if (isset($resultado_disputantes->error_msg)) {
  retorno_usuario("error", "Erro: $resultado_disputantes->error_msg");
}

$dados = $resultado_disputantes->dados;

if ( !empty($resultado_disputantes->dados) ) {
  foreach($dados as $disputante) {
    if ( valida_email($disputante->email_usuario) ) { // VERIFICA SE O USUARIO CORRENTE TEM E-MAIL, E SE SIM, SE O MESMO É VÁLIDO

      // OBTEM DADOS DO DISPUTANTE CORRENTE PARA A MSG
      $email_disputante = $disputante->email_usuario;
      $nome_disputante = $disputante->nome_usuario;

      // MONTA O CORPO DO E-MAIL
      $mensagem =
      " <br>
        Olá <strong>$nome_disputante</strong>!

        <br>
        Um lote que você está disputando no site da acaba de receber um novo Lance! Confira:
        <br><br>

        <br>LOTE: <strong>$nome_animal</strong>
        <br>Data do lance: <strong>$data_atual</strong>
        <br>Hora do lance: <strong>$hora_atual</strong>
        <br>Valor do lance: <strong>R$ $valor_lance_formatado</strong>

        <br><br>
        Você gostaria de cobrir este Lance agora? Acesse:
        <a href='$url_site_leiloeira/detalhes/?lote=$id_animal_cripto'>$nome_animal</a>
      ";

      // ENVIA E-MAIL
      envia_email($mensagem, strtoupper($nome_leiloeira) . " / COBRIÇÃO DE LANCE - LOTE $nome_animal", $nome_disputante, $email_disputante);

    } // IF VALIDA_EMAIL
  } // WHILE
} // IF NUM DISPUTANTES > 0


