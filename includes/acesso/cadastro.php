<?php

@session_start();
include("../../config/config.php");

// OBTEM OS PARAMETROS VIA $_POST

// SEUS DADOS PESSOAIS
$nome_usuario = trim(mb_strtoupper($_POST['nome_usuario']),"UTF-8");
$cpf_usuario = trim($_POST['cpf_usuario']);
$celular_usuario = trim($_POST['celular_usuario']);

// DADOS DE ENDEREÇO
$estado_usuario = trim(mb_strtoupper($_POST['estado_usuario']),"UTF-8");
$cidade_usuario = trim(mb_strtoupper($_POST['cidade_usuario']),"UTF-8");

// DADOS DE ACESSO
$email_usuario = mb_strtolower(trim($_POST['email_usuario']), 'UTF-8');
$senha_usuario = trim(mysql_real_escape_string($_POST['senha_usuario']));


// DADOS BANCÁRIOS
$banco_usuario = trim(mysql_real_escape_string($_POST['banco_usuario']));
$conta_usuario = trim(mysql_real_escape_string($_POST['conta_usuario']));
$agencia_usuario = trim(mysql_real_escape_string($_POST['agencia_usuario']));

// REFERÊNCIAS COMERCIAIS
$empresa_comercial_01_usuario = trim(mb_strtoupper(mysql_real_escape_string($_POST['empresa_comercial_01_usuario']), 'UTF-8'));
$empresa_comercial_02_usuario = trim(mb_strtoupper(mysql_real_escape_string($_POST['empresa_comercial_02_usuario']), 'UTF-8'));
$telefone_empresa_comercial_01_usuario = trim(mysql_real_escape_string($_POST['telefone_empresa_comercial_01_usuario']));
$telefone_empresa_comercial_02_usuario = trim(mysql_real_escape_string($_POST['telefone_empresa_comercial_02_usuario']));


$banco_usuario = !empty($banco_usuario) ? $banco_usuario : NULL;
$conta_usuario = !empty($conta_usuario) ? $conta_usuario : NULL;
$agencia_usuario = !empty($agencia_usuario) ? $agencia_usuario : NULL;

$empresa_comercial_01_usuario = !empty($empresa_comercial_01_usuario) ? $empresa_comercial_01_usuario : NULL;
$empresa_comercial_02_usuario = !empty($empresa_comercial_02_usuario) ? $empresa_comercial_02_usuario : NULL;
$telefone_empresa_comercial_01_usuario = !empty($telefone_empresa_comercial_01_usuario) ? $telefone_empresa_comercial_01_usuario : NULL;
$telefone_empresa_comercial_02_usuario = !empty($telefone_empresa_comercial_02_usuario) ? $telefone_empresa_comercial_02_usuario : NULL;


$associado_abccmm = (int)trim(mysql_real_escape_string($_POST['associado_abccmm'])) == 1 ?  'SIM' : 'NÃO';

// retorno_usuario("info", "$associado_abccmm");

// Formata CPF
$pattern_cnpj_cpf = "/[^0-9]/";
$cpf_usuario = preg_replace($pattern_cnpj_cpf, "", $cpf_usuario); //Remove caracteres especiais do CPF/CNPJ

// Formata Celular
$pattern_celular = "/(\d{2})(\d{5})(\d*)/";		
$celular_usuario = preg_replace($pattern_celular, "($1) $2-$3", formata_celular($celular_usuario));


// print_r($_POST);
// exit;


/*--------------------------------------
	VALIDA OS DADOS
---------------------------------------- */
if (
	empty($nome_usuario) || 
	empty($cpf_usuario)	 ||
	
	empty($celular_usuario) ||
	empty($cidade_usuario) ||
	empty($estado_usuario) ||

	empty($email_usuario) ||
	empty($senha_usuario)
 )
{
	retorno_usuario("error", "Por favor, preencha todos os campos com '*'!");
}


// $_FILES['DOC_1'] - DOCUMENTO DE IDENTIFICAÇÃO
// $_FILES['DOC_2'] - COMPROVANTE DE ENDEREÇO
// $_FILES['DOC_3'] - COMPROVANTE DE RENDA

if (!isset($_FILES['DOC_1']) || empty($_FILES['DOC_1']['name']) ) {
  retorno_usuario("warning", "Por favor, anexe um <strong>Documento de Identificação</strong> (CPF, CNH ou RG)!");
}
if (!isset($_FILES['DOC_2']) || empty($_FILES['DOC_2']['name']) ) {
  retorno_usuario("warning", "Por favor, anexe um <strong>Comprovante de Endereço</strong>!");
}



// VALIDANDO TIPOS ARQUIVOS
for ($i=1; $i <=3; $i++) { 

  $ARQ_ATUAL = "DOC_$i";

  // SE NÃO TIVER FEITO UPLOAD DO ARQUIVO pula para o próximo upload
  if ( !isset($_FILES[$ARQ_ATUAL]) || empty($_FILES[$ARQ_ATUAL]['name']) ) {
    continue;
  }

  $NOME_ARQUIVO = $_FILES[$ARQ_ATUAL]['name'];
  $array_file_name = explode(".", $NOME_ARQUIVO);
  $extensao =  strtolower( end($array_file_name) );

  if ( $extensao != 'pdf' && $extensao != 'jpeg' && $extensao != 'jpg' && $extensao != 'png' ) {
    retorno_usuario("warning", "<strong>ARQUIVO(S) INVALIDO(S)</strong><br> São São permitidos apenas arquivos do tipo PDF, JPEG e PNG  (Arquivo $i invalido!)");
  }

}





// VERIFICA SE O CPF OU CNPJ É VÁLIDO
if ( !ValidaCPF_CNPJ($cpf_usuario) ) {
  retorno_usuario("error","<strong>O CPF/CNPJ INFORMADO INVÁLIDO</strong>!<br>Por favor verifique o número digitado e tente novamente!");
}




// VERIFICA SE O CPF E/OU E-MAIL JÁ CADASTRADO
$query =
"	SELECT cpf_cnpj_usuario, email_usuario FROM tab_usuarios
  WHERE (
    id_haras ='$leiloeira' AND
    (
      cpf_cnpj_usuario = '$cpf_usuario' 
      OR
      email_usuario = '$email_usuario' 
    )
  )
";		

// Executa a Query
$resultado = mysql_query($query,$connect);

if ( !$resultado ) {
  retorno_usuario("error", "<b>Erro:</b> ". mysql_error($connect));
}
$usuario_banco = mysql_fetch_object($resultado);



// !!!!! DESCOMENTAR !!!!!!!!!
if ( $usuario_banco->cpf_cnpj_usuario == $cpf_usuario ) {
  retorno_usuario("warning", "O Número de <b>CPF/CNPJ</b> já se encontra cadastrado em nosso sistema!<br>Verifique seu cadatro ou tente outro número.");	
}
if ( $usuario_banco->email_usuario == $email_usuario ) {
  retorno_usuario("warning", "O endereço de <b>e-mail</b> já se encontra cadastrado em nosso sistema!<br>Verifique seu cadatro ou tente outro e-mail");
}








mysql_query("START TRANSACTION");



/*-----------------------------------------------------------
  EXECUTA A QUERY INSERT COM OS DADOS DO USUÁRIO
-----------------------------------------------------------*/
  
$query_insert =
" INSERT INTO tab_usuarios (
    nome_usuario,
    cpf_cnpj_usuario,
    situacao_usuario,
    id_haras,

    uf_usuario,
    cidade_usuario,
    celular_usuario,
    -- nome_fazenda_usuario,

    email_usuario,
    senha_usuario,

    banco_usuario,
    conta_usuario,
    agencia_usuario,
    empresa_comercial_01_usuario,
    empresa_comercial_02_usuario,
    telefone_empresa_comercial_01_usuario,
    telefone_empresa_comercial_02_usuario,

    data_cadastro,
    DATA_CRIACAO
  )
  VALUES (
    '$nome_usuario',
    '$cpf_usuario',
    '3', -- 3 => SITUAÇÃO AGUARDANDO...
    '$leiloeira',

    '$estado_usuario',
    '$cidade_usuario',
    '$celular_usuario',
    -- '$nome_fazenda',
    
    '$email_usuario',
    '$senha_usuario',

    '$banco_usuario',
    '$conta_usuario',
    '$agencia_usuario',
    '$empresa_comercial_01_usuario',
    '$empresa_comercial_02_usuario',
    '$telefone_empresa_comercial_01_usuario',
    '$telefone_empresa_comercial_02_usuario',
    
    CURDATE(),
    NOW()
  )
";




// -------------------------------------------------------------------------------------

// EXECUTA A QUERY
$insert = mysql_query($query_insert);
$id_last_insert = mysql_insert_id();

if ( !$insert ) {
  mysql_query("ROLLBACK");
  retorno_usuario("error", "<b>Erro:</b> ". mysql_error($connect));
}

$id_last_insert_cripto = criptografa($id_last_insert);



// ---------------------------
// ARMAZENANDO OS DOCUMENTOS
// ---------------------------


// PROVISORIO
$PATH_DOCS_SISTEMA = "$PATH_ROOT_SISTEMA/upload/docs/";


$DOCUMENTOS_EMAIL = '';

$array_descricoes = array(
  '1' => "DOCUMENTO DE IDENTIFICAÇÃO", 
  '2' => "COMPROVANTE DE ENDEREÇO", 
  '3' => "COMPROVANTE DE RENDA"
);

for ($i=1; $i <= 3; $i++) {
  
  $descricao_documento = $array_descricoes[$i];

  


  $ARQ_ATUAL = "DOC_$i";
  $NOME_ARQUIVO = $_FILES[$ARQ_ATUAL]['name'];
  
  // SE NÃO TIVER FEITO UPLOAD DO ARQUIVO pula para o próximo upload
  if (!isset($_FILES[$ARQ_ATUAL]) || empty($NOME_ARQUIVO) ) {
    continue;
  }

  

  $query_insert_doc =
  " INSERT INTO tab_documentos (
      id_haras,
      id_tipo_documento,
      descricao_documento,
      id_usuario_documento,
      nome_arquivo_documento,

      ID_USUARIO_CRIACAO,
      DATA_CRIACAO
    )
    VALUES (
      '$leiloeira',
      '5', -- 5 = Documentos de Usuário
      '$descricao_documento',
      '$id_last_insert',
      'PROVISORIO', -- nome_arquivo_documento
      
      '$id_last_insert',
      NOW()
    )
  ";

  $insert_doc = mysql_query($query_insert_doc);
  
  if ( !$insert_doc ) {
    mysql_query("ROLLBACK");
    retorno_usuario("error", "<b>Erro:</b> ". mysql_error($connect));
  }

  $ID_LAST_INSERT_DOC = mysql_insert_id();



  
  // Dados para compor o novo nome do arquivo
  $NUMERO_DOCUMENTO = 'DOC_' . str_pad($ID_LAST_INSERT_DOC, 4, "0", STR_PAD_LEFT) . "_USUARIO_$id_last_insert";
  
  // OBTENDO A EXTENSÃO DO ARQUIVO
  $array_file_name = explode(".", $NOME_ARQUIVO);
  $extensao =  strtolower( end($array_file_name) );

  // EX.: DE FORMATO DO NOME DE ARQUIVO: FOTO_2_00718122017143109.png
  $novo_nome_arquivo = $NUMERO_DOCUMENTO .'.'. $extensao;

  // NOME TEMPORARIO	
  $temp_name = $_FILES[$ARQ_ATUAL]['tmp_name'];

  // APLICANDO IMAGICK NA IMAGEM
  $qualidade_percent_img = 70; // DEFININDO A QUALIDADE (%) DA IMAGEM (por padrão 70%)
  $setFormato_img = $extensao;
  include("$PATH_ROOT_SISTEMA/include/class/otimiza_img.php");

  // CASO NÃO CONSIGA MOVER O ARQUIVO
  if( !move_uploaded_file($temp_name, $PATH_DOCS_SISTEMA.$novo_nome_arquivo) ) {
    mysql_query("ROLLBACK");
    retorno_usuario("error", "Erro ao tentar enviar o aquivo do documento. Tente novamente!");
  } // IF (move_uploaded)
  


  // Else...
  $query_update_doc =
  " UPDATE tab_documentos SET
      nome_arquivo_documento = '$novo_nome_arquivo'
    WHERE(
      id_documento = '$ID_LAST_INSERT_DOC'
    )   
  ";

  $update_doc = mysql_query($query_update_doc);
  
  if ( !$update_doc ) {
    mysql_query("ROLLBACK");
    unlink($PATH_DOCS_SISTEMA.$novo_nome_arquivo);
    retorno_usuario("error", "<b>Erro:</b> ". mysql_error($connect));
  }


  $DOCUMENTOS_EMAIL .=
  " <a href='$link_padrao_fotos$novo_nome_arquivo' target='_blank' download>
      $descricao_documento
    </a>
    <br>
  ";
 
} // FOR

mysql_query("COMMIT");







// ------------------------------------------------------------------
// ENVIANDO E-MAIL DE CONFIRMAÇÃO AO USUÁRIO RECÉM CADASTRADO
// ------------------------------------------------------------------

$MENSAGEM_USER = "
  <b>Seu Cadastro foi realizado com Sucesso!</b></br>
  <br><br>

  Seus dados de acesso no site são:
  <br><br>
  E-mail: <b>$email_usuario</b>
  <br>
  Senha: <b>$senha_usuario</b>
  <br>
  <small>
    OBS.: Aguarde a aprovação de seu cadastro para logar no site.
  </small>
";

envia_email($MENSAGEM_USER, 'CONFIRMAÇÃO DE CADASTRO', $nome_usuario, $email_usuario);





$banco = !empty($banco_usuario) ? "Banco: <strong>$banco_usuario</strong><br>" : '';
$conta = !empty($conta_usuario) ? "Conta: <strong>$conta_usuario</strong><br>" : '';
$agencia = !empty($agencia_usuario) ? "Agencia: <strong>$agencia_usuario</strong><br>" : '';
$empresa_comercial1 = !empty($empresa_comercial_01_usuario) ? "Referência comercial 1: <strong>$empresa_comercial_01_usuario</strong><br>" : '';
$empresa_comercial2 = !empty($empresa_comercial_02_usuario) ? "Referência comercial 2: <strong>$empresa_comercial_02_usuario</strong><br>" : '';
$telefone_empresa1 = !empty($telefone_empresa_comercial_01_usuario) ? "Telefone referência comercial 1: <strong>$telefone_empresa_comercial_01_usuario</strong><br>" : '';
$telefone_empresa2 = !empty($telefone_empresa_comercial_02_usuario) ? "Telefone referência comercial 2: <strong>$telefone_empresa_comercial_02_usuario</strong><br>" : '';


$DADOS_ADICIONAIS = "
  $banco
  $conta
  $agencia
  $empresa_comercial1
  $telefone_empresa1
  $empresa_comercial2
  $telefone_empresa2
";

$DADOS_ADICIONAIS = !empty(trim($DADOS_ADICIONAIS)) ? "<hr><strong>OUTRAS INFORMAÇÕES:</strong><br><br> $DADOS_ADICIONAIS<br><br>" : '';

// ---------------------------------------------------------------------------------------------
// ENVIA O EMAIL PARA O ADMINISTRADOR INFORMANDO DO NOVO CADASTRO
$LINK = "https://sistema.agrobold.com.br/cadastros/usuarios/pessoas/?nome_pessoa=$cpf_usuario";
// ---------------------------------------------------------------------------------------------


$MENSAGEM_ADMIM = "
  <b>Um Novo Cadastro no site foi realizado e está aguardando sua aprovação!</b>
  <br><br>

  Dados do novo Usuário:
  <br><br>
  Nome: <b>$nome_usuario</b>
  <br>
  E-mail: <b>$email_usuario</b>
  <br>
  CPF / CNPJ: <b>$cpf_usuario</b>
  <br>
  Cidade: <b>$cidade_usuario</b>
  <br>
  Estado: <b>$estado_usuario</b>
  <br>
  Celular: <b>$celular_usuario</b>
  <br>
  Associado ABCCMM: <b>$associado_abccmm</b>
  <br><br>
  $DADOS_ADICIONAIS

  DOCUMENTOS ENVIADOS:<br>
  $DOCUMENTOS_EMAIL

  <br><br>
  <a href='$LINK'>CONFIRME ESTE CADASTRO NESTE LINK</a>
";

// DISPARA O E-MAIL
envia_email($MENSAGEM_ADMIM, 'NOVO CADASTRO NO SITE', $nome_leiloeira, $email_leiloeira);
// envia_email($MENSAGEM_ADMIM, 'NOVO CADASTRO NO SITE', $nome_leiloeira, 'antonio@agrobold.com.br');
retorno_usuario("success", "<b>Seu cadastro foi realizado com sucesso!</b><br> Por favor, aguarde a aprovação de seu cadastro. Nossa equipe lhe enviará um e-mail de confirmação!", 1);


// retorno_usuario("info", "<b>Seu cadastro foi realizado com sucesso!</b><br> Por favor, aguarde a aprovação de seu cadastro. Nossa equipe lhe enviará um e-mail de confirmação!", 1);
