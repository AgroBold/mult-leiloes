<?php

include('../includes/header.php');

// $_POST
$id_leilao = (int)descriptografa(trim($_GET['id']));

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
    tab_leiloes.id_haras = '$leiloeira'
    AND tab_leiloes.situacao = '1'
    AND ID = '$id_leilao'
    AND tipo NOT IN(6, 8, 9) -- DIFERENTE DE VENDA DIRETA
  )
  ORDER BY data_inicio, hora_inicio ASC
";

$resultado = executa_query($sql);

if (isset($resultado->error_msg)) {
  retorno_usuario("error", "Erro: $resultado->error_msg");
}

$dado = $resultado->dados[0];

?>


  <div class="container">
    <?php
      include('../eventos/titulo_eventos.php'); 
      include('filtro_lotes.php');
    ?>

    <div class="row" id="div_lotes_categoria">
      <!-- (AJAX) -->
    </div>

    <div id="div_loading" class="g-mt-100" style="text-align: center">
      <br>
      <p>
        <i class="fa fa-circle-o-notch fa-spin font-50px"></i>
      </p>
      <h3>Filtrando Animais...</h3>
    </div>
  </div>



<script>

  function get_lotes_categoria(id_categoria, id_leilao) {

    $('#preload').show();

    $.ajax({
      url: "./get/",
      type: "POST",
      dataType: 'html', 
      cache: false,
      data: {
        'id_leilao':id_leilao,
        'id_categoria':id_categoria
      },
      success: function (response) {

        $('#preload').hide();
        $('#div_loading').hide();
        $("#div_lotes_categoria").html(response);
        
      },
      error:function () {
        mensagens_erro('Erro! Não foi possível obter os animais no momento! Atualize a page e tente novamente.');
        $('#preload').hide();
        $("#div_lotes_categoria").show();
      }
    });

    console.log('div_lotes_categoria()');
  }


  document.addEventListener("DOMContentLoaded", function(event) { 
    get_lotes_categoria('0', '<?= $id_leilao ?>');

    // CONTADOR DE LOTES
    $('#total_grupo_todos').text('('+<?= (int)$total_grupo_totos ?>+')');
  });

</script>


<?php include('../includes/footer.php'); ?>
