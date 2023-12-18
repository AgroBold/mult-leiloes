<?php include('../includes/header.php'); ?>

<section>
  <div class="container">

    <div class="row text-center mt-30px">
      <h2 class="section-title">Vendas</h2>
      <h3 class="section-sub-title margem_titulo">ANIMAIS DE VENDA DIRETA</h3>  
    </div>


    <?php include('inc/filtro_vendas.php'); ?>

    

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
</section>

<?php include('../includes/footer.php'); ?>

<script>

  function get_lote_categoria(id_categoria, id_leilao) {

    $('#preload').show();

    $.ajax({
      url: "./get/",
      type: "POST",
      dataType: 'html', 
      cache: false,
      data: {
        'id_leilao': id_leilao,
        'id_categoria': id_categoria
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