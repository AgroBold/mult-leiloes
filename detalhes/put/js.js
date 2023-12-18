
// FORM CADASTRO
function cadastrar_mensagem() {

  $('#preload').show();
  $.ajax({
    url: "./put/contato_animal.php",
    type: "POST",
    data: $('#form_animal').serialize(),
    success: function (response){ 

      $('#preload').fadeOut();
      console.log(response);
      mensagens_resposta(response, 'topCenter');
      var JSONArray = $.parseJSON(response);

      if (JSONArray['result'] == 'success') {

        document.getElementById("form_animal").reset();

        setTimeout(() => {
          // window.location='../home';
          // location.reload();
        }, 1500);

      
      }

    },
    error:function () {
      $('#preload').fadeOut();
      mensagens_erro('<b>ERRO AO ENVIAR SUA MENSAGEM!</b><br>Atualize a página e tente novamente.');
    }
  });

}















function dar_lance() {

  $('#preload').show();
  $.ajax({
    url: "./put/lance/",
    type: "POST",
    data: $('#form_lance').serialize(),
    success: function (response) {

      $('#preload').fadeOut();
      console.log(response);
      mensagens_resposta(response);

      var json = $.parseJSON(response);
      if (json['result'] == 'success') {
        setTimeout(() => {
          location.reload();
        }, 2000);
      }
      
      

      if ( parseInt(json['data']) === -1 ) {
        setTimeout(() => {
          modal_login();
        }, 1000);
      }

      
    },
    error: function () {
      mensagens_erro('Não foi possível dar seu lance no momento!<br>Atualize a página e tente novamente!');
    }
  });

}









function confirma_compra() {

  iziToast.show({
    id: 'haduken', theme: 'dark',icon: 'icon-contacts', position: 'center',
    title: 'CONFIRMAÇÃO DE COMPRA!',
    message: 'DESEJA REALMENTE REALIZAR ESTA <strong>COMPRA</strong>?',
    transitionIn: 'flipInX', transitionOut: 'flipOutX',
    iconColor: 'rgb(1, 168, 89)', progressBarColor: 'rgb(1, 168, 89)',
    imageWidth: 70, layout: 2, maxWidth: 500,
    // onClosed: function(instance, toast, closedBy) {
    // },
    buttons: [

      // BOTÃO CONFIRMAR
      ['<button class="btn-notificacao-sim"><b>CONFIRMAR</b></button>', function (instance, toast) {

        $('#preload').show();
        $.ajax({
          url: "./put/compra/",
          type: "POST",
          data: $('#form_compra').serialize(),
          success: function (response) {
      
            $('#preload').fadeOut();
            console.log(response);
            mensagens_resposta(response);
      
            var json = $.parseJSON(response);
            if (json['result'] == 'success') {
              setTimeout(() => {
                location.reload();
              }, 2000);
            }
      
            if ( parseInt(json['data']) === -1 ) {
              setTimeout(() => {
                modal_login();
              }, 1000);
            }
            
          },
          error: function () {
            mensagens_erro('<strong>NÃO FOI POSSÍVEL REALIZAR SUA COMPRA NO MOMENTO!</strong><br>Atualize a página e tente novamente!');
          }
        });


        // Fecha o Alert
        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

      }, true],

      // BOTÃO CANCELAR
      ['<button class="btn-notificacao-nao"><b>CANCELAR</b></button>', function (instance, toast) {
  
        // Fecha o Alert
        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');    
        
      }, false]


    ]
  });

}
