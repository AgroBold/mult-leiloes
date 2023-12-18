<?php
include('../includes/header.php');

/*
  --- TIPOS DE EVENTOS (BANCO DE DADOS) ---
  1 - Leilão Virtual sem Lance
  2 - Leilão Virtual Web / Online com Lance
  3 - Leilão Presencial sem Lance
  4 - Shopping / Feira
  5 - Leilão Presencial com Lance
  6 - Venda Direta / Consultoria Comercial
  7 - Leilão Virtual com Pré-Lance
  8 - Classificados
  9 - Plantel
*/


/* -------------------------------------------------
 --------------- EVENTOS ATUAIS  -----------------
---------------------------------------------------- */
$sql =
"	SELECT
    *,
    IF (
      NOW() < TIMESTAMP(data_termino, hora_termino),
      IF( 
        NOW() > TIMESTAMP(data_inicio, hora_inicio),
        'ACONTECENDO',
        'FUTURO'
      ),
      'ENCERRADO'
    ) AS STATUS_LEILAO
  FROM tab_leiloes
  LEFT JOIN tab_documentos ON (
    tab_documentos.id_documento = tab_leiloes.id_catalogo_leilao
    AND tab_documentos.situacao = '1'
  )
  WHERE (
    NOW() >= TIMESTAMP(data_inicio, hora_inicio) AND
    NOW() <= TIMESTAMP(data_termino, hora_termino)
    AND tab_leiloes.id_haras = '$leiloeira'
    AND tab_leiloes.situacao = '1'
    AND tipo NOT IN(6, 8, 9) -- DIFERENTE DE VENDA DIRETA
  )
  ORDER BY data_inicio, hora_inicio ASC
";

$resultado = executa_query($sql);

if (isset($resultado->error_msg)) {
  retorno_usuario("error", "Erro: $resultado->error_msg");
}

$dados = $resultado->dados;
$num_eventos_atuais = count($dados);

if ( $num_eventos_atuais > 0 ) {
	$TITLE_EVENTS = $num_eventos_atuais > 1 ? 'EVENTOS EM ANDAMENTO' : 'EVENTO EM ANDAMENTO';
  include('events/atuais.php');
}





/* -------------------------------------------------
 --------------- PROXIMOS EVENTOS -----------------
---------------------------------------------------- */
$sql = 
"	SELECT
    *,
    IF (
      NOW() < TIMESTAMP(data_termino, hora_termino),
      IF( 
        NOW() > TIMESTAMP(data_inicio, hora_inicio),
        'ACONTECENDO',
        'FUTURO'
      ),
      'ENCERRADO'
    ) AS STATUS_LEILAO
  FROM tab_leiloes
  WHERE (
    NOW() <= TIMESTAMP(data_inicio, hora_inicio)
    AND id_haras = '$leiloeira'
    AND situacao = '1'
    AND tipo NOT IN(6, 8, 9) -- DIFERENTE DE VENDA DIRETA
  )
  ORDER BY data_inicio, hora_inicio ASC
";

$resultado = executa_query($sql);

if (isset($resultado->error_msg)) {
  retorno_usuario("error", "Erro: $resultado->error_msg");
}

$dados = $resultado->dados;
$num_proximos_eventos = count($dados);

if ( $num_proximos_eventos ) {
	$TITLE_EVENTS = $num_proximos_eventos > 1 ? 'PRÓXIMOS EVENTOS' : 'PRÓXIMO EVENTO';
  include('events/proximos.php');
}





/* -------------------------------------------------
 --------------- EVENTOS ENCERRADOS -----------------
---------------------------------------------------- */
$sql = 
"	SELECT
    *,
    IF (
      NOW() < TIMESTAMP(data_termino, hora_termino),
      IF( 
        NOW() > TIMESTAMP(data_inicio, hora_inicio),
        'ACONTECENDO',
        'FUTURO'
      ),
      'ENCERRADO'
    ) AS STATUS_LEILAO
  FROM tab_leiloes
  WHERE (
    NOW() > TIMESTAMP(data_termino, hora_termino)
    AND id_haras = '$leiloeira'
    AND situacao = '1'
    AND tipo NOT IN(6, 8, 9) -- DIFERENTE DE VENDA DIRETA
  )
  ORDER BY data_inicio, hora_inicio ASC
";

$resultado = executa_query($sql);

if (isset($resultado->error_msg)) {
  retorno_usuario("error", "Erro: $resultado->error_msg");
}

$dados = $resultado->dados;
$num_eventos_encerrados = count($dados);

if ( $num_eventos_encerrados > 0 ) {
	$TITLE_EVENTS = $num_eventos_encerrados > 1 ? 'EVENTOS ENCERRADOS' : 'EVENTO ENCERRADO';
  include('events/encerrados.php');
}


if ( ($num_eventos_atuais + $num_proximos_eventos + $num_eventos_encerrados) <= 0  ) { ?>

  <section class="bg-gray pt-lg pb-lg">
    <div class="row">
      <div class="container">

        <div class="col-sm-8">
          <h2 class='mt-lg'>Nossos Leilões</h2>
        </div>

        <div class="col-sm-4 text-right pt-sm">
          <p class="mt-lg text-primary">
            <a href="../home" class="mr-md">Home</a>
            / <span class="ml-md">Leilões</span>
          </p>
        </div>

      </div>
    </div>
  </section>


  <section class="contact2">
    <div class="container">

      <div class="text-center text-muted pb-30px mb-lg border-ccc">
        <br><br><br>
        
        <i class="fa fa-search fa-2x"></i><br>
        <h2 class="nmb"><strong>Nenhum Evento Disponível!</strong></h2>
        <p class="font-19px">
          Aguarde que em breve teremos diversos Eventos e Leilões!
        </p>

        <br><br>
      </div>

    </div>
  </div>

  <br><br>

  <?
}
?>

<section class="content">
	<div class="container">
		<div class="row">
			<?php
				include('inc/parceiros.php');
			?>
		</div>
	</div>
</section>


<?php
include('../includes/footer.php');
