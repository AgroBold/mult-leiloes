function get_lotes_categoria(id_categoria) {

  // $("#get_lotes_categoria").hide();
  // $('#loading_lotes').show();
  $('#preload').show();

  $.ajax({
    url: "./get/",
    type: "POST",
    dataType: 'html', 
    cache: false,
    data: {'id_categoria':id_categoria},
    success: function (response) {

      
      $("#get_lotes_categoria").html(response);
      $('#loading_lotes').hide();
      $('#preload').hide();
      // $("#get_lotes_categoria").show();
      
    },
    error:function () {
      mensagens_erro('Erro! Não foi possível obter os animais no momento! Atualize a page e tente novamente.');
      $('#loading_lotes').hide();
      $("#get_lotes_categoria").show();
    }
  });

  console.log('get_lotes_categoria()');
}


$(document).on('ready', () => { 
  get_lotes_categoria('0');
});
