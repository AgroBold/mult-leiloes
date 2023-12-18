// FORM CADASTRO

$(document).ready(() => {
  $("#form_contato").validate({
    rules:{
      nome_usuario: {required:true},
      email_usuario: {required:true},
      celular_usuario: {required:true},
      mensagem_usuario: {required:true, minlength:10}
    },
    messages: {
      nome_usuario: {required: 'Informe seu nome!'},
      email_usuario: {required: 'Informe seu e-mail!', email:"E-mail inválido!"},
      celular_usuario: {required: 'Informe seu número de celular!'},
      mensagem_usuario: {required: 'Por favor, informe sua mensagem!', minlength: "Mensagem muito curta!"}
    },
    submitHandler : function(e) {

      $('#preload').show();
      $.ajax({
        url: "./inc/",
        type: "POST",
        data: $('#form_contato').serialize(),
        success: function (response){ 

          $('#preload').fadeOut();
          console.log(response);
          mensagens_resposta(response, 'topCenter');
          var JSONArray = $.parseJSON(response);

          if (JSONArray['result'] == 'success') {

            document.getElementById("form_contato").reset();  
          }

        },
        error:function () {
          $('#preload').fadeOut();
          mensagens_erro('<b>ERRO AO ENVIAR SUA MENSAGEM!</b><br>Atualize a página e tente novamente.');
        }
      });
      
    },
    errorPlacement : function(error, element) {
      error.insertAfter(element.parent());
    }
  });
});
