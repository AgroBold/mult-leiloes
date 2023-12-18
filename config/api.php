<?php

/*---------------------------------------------------------
	QUERY | OBTEM OS ESTADOS
-----------------------------------------------------------*/
function get_estados($sigla_selected = '', $option_selecione = true) {

  $query_estados = executa_query('SELECT * FROM tab_uf') or die();
  echo $option_selecione ? "<option value=''>Selecione...</option>" : '';

  while ( $estado = $query_estados->fetchAll(PDO::FETCH_ASSOC)) {    
    $nome_estado = mb_strtoupper($estado->nome_uf, 'UTF-8');
    $selected = mb_strtoupper($sigla_selected, 'UTF-8') == mb_strtoupper($estado->sigla_uf, 'UTF-8') ? 'selected' : '';
    
    echo "<option value='$estado->sigla_uf' $selected>$nome_estado</option>";
  };

} // get_estados()





/*-------------------------
	QUERY | OBTEM OS BANCOS 
--------------------------- */

function get_bancos() {

  $query_bancos = executa_query('SELECT numero_banco, nome_banco FROM tab_bancos ORDER BY nome_banco') or die();

  while ( $banco = $query_bancos->fetchAll(PDO::FETCH_ASSOC)) {    
    $nome_banco = $banco->nome_banco;
    $numero_banco = !empty(trim($banco->numero_banco)) ? $banco->numero_banco : '000';
    echo "<option value='$banco->nome_banco'>$numero_banco - $nome_banco</option>";
  };

} // get_bancos()


