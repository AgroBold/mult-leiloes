<?php

function esta_logado() {
  if ( (int)$_SESSION['id_usuario'] > 0  ) {
    return true;
  }
  return false;
}

/*-----------------------------------------------------------
  CRIPTOGRAFA E DESCRIPTOGRAFA STRINGS
-----------------------------------------------------------*/

// Criptografa Strings
function criptografa($criptografar) {
  // Aplica o base64_encode 7 vezes
  for($i = 1; $i < 8; $i++) {
    // Criptografa com base64
    $criptografar = base64_encode($criptografar);
  }
  
  return $criptografar;
}

function descriptografa($descriptografar) {
  // Aplica o base64_decode 7 vezes
  for($i = 1; $i < 8; $i++) {
    // Criptografa com base64
    $descriptografar = base64_decode($descriptografar);
  }
  return $descriptografar;
}



/*-----------------------------------------------------------
  VALIDA CPF E CNPJ
-----------------------------------------------------------*/
function ValidaCPF_CNPJ($cpf_cnpj) {

  // VERIFICA SE UM NÚMERO FOI INFORMADO
  if(empty( trim($cpf_cnpj) )) {
    return false;
  }

  // FORMATA O NUMERO
	$cpf_cnpj = ereg_replace('[^0-9]', '', $cpf_cnpj);
	$cpf_cnpj = str_pad($cpf_cnpj, 11, '0', STR_PAD_LEFT);

  // SE FOR CPF
  if (strlen($cpf_cnpj) == 11) {

    // Verifica se o numero de digitos informados é igual a 11 
    if (strlen($cpf_cnpj) != 11) {
      return false;
    }
    
    // Verifica se nenhuma das sequências invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf_cnpj == '00000000000' || 
      $cpf_cnpj == '11111111111' || 
      $cpf_cnpj == '22222222222' || 
      $cpf_cnpj == '33333333333' || 
      $cpf_cnpj == '44444444444' || 
      $cpf_cnpj == '55555555555' || 
      $cpf_cnpj == '66666666666' || 
      $cpf_cnpj == '77777777777' || 
      $cpf_cnpj == '88888888888' || 
      $cpf_cnpj == '99999999999') {
      return false;
      // Calcula os digitos verificadores para verificar se o
      // CPF é válido
      } else {   
        
      for ($t = 9; $t < 11; $t++) {
          
        for ($d = 0, $c = 0; $c < $t; $c++) {
          $d += $cpf_cnpj{$c} * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf_cnpj{$c} != $d) {
          return false;
        }
      }
    
      return true;
    }
    
  } // IF CPF
  


  // SE FOR CNPJ
  if (strlen($cpf_cnpj) == 14)  {
    
    //Zera a Soma
    $soma = 0;
    
    $soma += ($cpf_cnpj[0] * 5);
    $soma += ($cpf_cnpj[1] * 4);
    $soma += ($cpf_cnpj[2] * 3);
    $soma += ($cpf_cnpj[3] * 2);
    $soma += ($cpf_cnpj[4] * 9); 
    $soma += ($cpf_cnpj[5] * 8);
    $soma += ($cpf_cnpj[6] * 7);
    $soma += ($cpf_cnpj[7] * 6);
    $soma += ($cpf_cnpj[8] * 5);
    $soma += ($cpf_cnpj[9] * 4);
    $soma += ($cpf_cnpj[10] * 3);
    $soma += ($cpf_cnpj[11] * 2); 
    
    $d1 = $soma % 11; 
    $d1 = $d1 < 2 ? 0 : 11 - $d1; 
    
    $soma = 0;
    $soma += ($cpf_cnpj[0] * 6); 
    $soma += ($cpf_cnpj[1] * 5);
    $soma += ($cpf_cnpj[2] * 4);
    $soma += ($cpf_cnpj[3] * 3);
    $soma += ($cpf_cnpj[4] * 2);
    $soma += ($cpf_cnpj[5] * 9);
    $soma += ($cpf_cnpj[6] * 8);
    $soma += ($cpf_cnpj[7] * 7);
    $soma += ($cpf_cnpj[8] * 6);
    $soma += ($cpf_cnpj[9] * 5);
    $soma += ($cpf_cnpj[10] * 4);
    $soma += ($cpf_cnpj[11] * 3);
    $soma += ($cpf_cnpj[12] * 2); 
    
    
    $d2 = $soma % 11; 
    $d2 = $d2 < 2 ? 0 : 11 - $d2; 
    
    if ($cpf_cnpj[12] == $d1 && $cpf_cnpj[13] == $d2){
      return true;
    }
    return false;
    
  } // IF CNPJ


  return false;
}  
  


/*----------------------------------------------------------
  MENSAGEM DE RETORNO NOS FORMULARIOS PARA OS USUARIOS
-----------------------------------------------------------*/
function retorno_usuario($result, $message, $data = "") {
  $retorno = array(
    "result" => $result, // success ou error
    "message" => $message, // Mensagem para o usuario
    "data" => $data
  );

  $resposta = json_encode($retorno);	
  echo $resposta;
  exit;	
}
  

/*-----------------------------------------------------
  VALIDA UMA STRING DE E-MAIL
------------------------------------------------------- */
function valida_email($email)
{

  if (contem_substring('@email.com', $email) || contem_substring('fake', $email)) {
    return false;
  }

  //Verifica se é email duplo
  if ((int) strpos($email, ",") > 0) {
    return true;
  }

  $conta = "^[a-zA-Z0-9\._-]+@";
  $domino = "[a-zA-Z0-9\._-]+.";
  $extensao = "([a-zA-Z]{2,4})$";
  $pattern = $conta . $domino . $extensao;

  if (preg_match("/{$pattern}/", trim($email))) {
    return true;
  }

  return false;
}

function contem_substring($substring, $string) {
  return strpos($string, $substring) === false ? false : true;
}


/*-----------------------------------------------------------
  FORMATA NUMERO DE CELULAR
-----------------------------------------------------------*/

function formata_celular($tel) {
  
  //verificando se é celular
  $array_pre_numero = array ("9","8","7");
  
  //Retira os espaços
  $tel = trim($tel);
  
  //tratando manualmente
  $tel = str_replace("-", "", $tel);
  $tel = str_replace("(", "", $tel);
  $tel = str_replace(")", "", $tel);
  $tel = str_replace("_", "", $tel);
  $tel = str_replace(" ", "", $tel);
  $tamanho = strlen($tel);
  
  //Maior
  if($tamanho  > '10') {
    
    //Não faz nada
    $telefone = $tel;
  }
  
  //Igual
  if($tamanho == '10')
  {
    
    $verificando_celular = substr($tel, 2, 1);
    
    if(in_array($verificando_celular, $array_pre_numero))
    {
      
      $telefone.= substr($tel, 0, 2);
      $telefone.= "9"; // nono digito
      $telefone.= substr($tel, 2);
      
    }
    
    else{
      
      $telefone = $tel;
      
    }
    
  }
  
  //Menor
  if($tamanho < '10'){
    
    //Não faz nada
    $telefone = $tel;
    
  }
  
  return $telefone;
  
}




/*-----------------------------------------------------------
  LIMITA O TAMANHO DA STR
-----------------------------------------------------------*/
function limita_str($str, $tam_max, $uppercase = false) {

  if ($tam_max <= 0) {
    return $str;
  }

  $str = trim($str);

  if ( strlen($str) <= 0 ) {
    return "- - -";
  }

  $str = strlen($str) > $tam_max ? substr($str, 0, $tam_max) . ' <small>[. . .]</small>' : $str;
  if ( $uppercase ) {
    $str = strlen($str) > $tam_max ? substr(mb_strtoupper($str, 'UTF-8'), 0, $tam_max) . ' <small>[. . .]</small>' : $str;
  }
  return $str;
}










function envia_email($MENSAGEM, $assunto, $nome_destinarario, $email_destinatário) {

	$MENSAGEM = trim($MENSAGEM);
	$assunto = trim($assunto);
	$nome_destinarario  = trim($nome_destinarario);
	$email_destinatário = trim($email_destinatário);

	// VERIFICA SE ALGUM PARAMETRO VEIO VAZIO;
	if ( empty($MENSAGEM) || empty($assunto) || empty($nome_destinarario) || empty($email_destinatário) ) {
		return false;
	}

	// VALIDA O ENDEREÇO DE E-MAIL
	if ( !valida_email($email_destinatário) ) {
		return false;
  }
  
  // HEADER E FOOTER E-MAIL
  global $url_site_leiloeira;
  global $email_leiloeira;
  global $nome_leiloeira;

  
  // CORPO DO E-MAIL
  $corpo_email = 
  "<html>
    <body style='background:#f2f2f2; padding-top: 40px; padding-bottom: 40px;'>
      <div style='width:800px; margin:50px auto; background:#fff;'>

        <div style='min-height: 220px; padding:20px; text-align:center;'>
          $MENSAGEM
          <br><br><br>
          Atenciosamente,<br><br>
          <a href='$url_site_leiloeira' style='font-weight:700;color: #0a2144'>
            Equipe $nome_leiloeira
          </a>
          <br><br>
        </div>

      </div>
    </body>
  </html>
  ";

  // Instacia o TurboSMTP
  $email = new Email();
  
  // E-mail de Origem (Remetente)
  $email->setFrom($email_leiloeira);
 
  // Lista de E-mails de Destino (podem ser separados por vírgulas)
  $email->setToList($email_destinatário);
  
  // Assunto do E-mail
  $email->setSubject($assunto);
  
  // Conteúdo em HTML
  $email->setHtmlContent($corpo_email);
  
  //Login no TurboSMTP
  $turboApiClient = new TurboApiClient("contato@agrobold.com.br", "Nb6zzDwM");
  
  //Envia o E-mail e recebeo retorno do Servidor TurboSMTP
  $response = $turboApiClient->sendEmail($email);
  
  //Retorna menaagem ao Uusário
	if($response['message'] == 'error') {
		return false;
	}
  return true;
}





function nome_mes($numero_mes) {

  $numero_mes = str_pad($numero_mes, 2, '0', STR_PAD_LEFT);
  $nome_mes = array(
    '01' => 'Janeiro',
    '01' => 'Janeiro',
    '02' => 'Fevereiro',
    '03' => 'Março',
    '04' => 'Abril',
    '05' => 'Maio',
    '06' => 'Junho',
    '07' => 'Julho',
    '08' => 'Agosto',
    '09' => 'Setembro',
    '10' => 'Outubro',
    '11' => 'Novembro',
    '12' => 'Dezembro'
  );

  return $nome_mes[$numero_mes];
}



function verifica_url_page($substring_url) {
  if( strpos($_SERVER['REQUEST_URI'], $substring_url) ) {
    return true;
  }
  return false;
}






// function conta_visitas() {

// 	global $connect;
// 	global $leiloeira;
// 	$HTTP_HOST = $_SERVER['HTTP_HOST'];
// 	$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
// 	$REQUEST_URI = $_SERVER['REQUEST_URI'];

// 	$query = 
// 	"	INSERT INTO tab_visitas_site (id_haras_log, data_log, hora_log, ip_user_log, host_visita, uri_visita)
// 		VALUES ('$leiloeira', CURDATE(), CURTIME(), '$REMOTE_ADDR', '$HTTP_HOST', '$REQUEST_URI')
// 	";
// 	//$update = mysql_query($query, $connect);
// }