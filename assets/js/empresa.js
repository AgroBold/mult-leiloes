$(document).ready(() => {

  $('#preload').fadeOut();

  
  $(`#register-form input, #register-form select`).on('focus change', () =>{
    calcula_altura_form_cad();
  })
});


// ---------------------------------------------




function calcula_altura_form_cad() {
  setTimeout(() => {
    $('#div-forms').css("height", $('#register-form').height());
  }, 200);

  console.log('calcula_altura_form_cad()');
}


// ---------------------------------------------




function modal_login() {


  $('#preload').show();

  $('#lost-form').hide();
  $('#register-form').hide();
  
  $('#login-modal').modal('show');

  
  setTimeout(() => {
    // $('#preload').fadeOut();
    $('#preload').hide();
    $('#login-form').show();
    $('#div-forms').css("height", $('#login-form').height());
    $('#login-modal').removeClass('opacity-0');
  }, 550);
  
  console.log('modal_login()');
}

function modal_cadastro() {


  $('#preload').show();

  $('#lost-form').hide();
  $('#login-modal').modal('show');
  $('#register-form').show();

  setTimeout(() => {
    // $('#preload').fadeOut();
    $('#preload').hide();
    $('#login-form').hide();
    $('#div-forms').css("height", $('#login-form').height());
    $('#login-modal').removeClass('opacity-0');
  }, 550);

  console.log('modal_login()');
}



// ---------------------------------------------



function modal_video_lote(url_video, descricao = '', modo) {


  
  let iframe = '#modal_video_lote iframe';

  $('#preload').show();
  $(iframe).attr('src', url_video); // CARREGA IFRAME
  // $('#modal_video_lote #descricao_video').text(descricao); // CARREGA DESCRIÇÃO
  $('#modal_video_lote').modal('show'); // ABRE MODAL
  
  
  setTimeout(() => {
    // play video
    $(iframe).attr('src', $(iframe).attr('src') + '?rel=o&arp;autoplay=1');
  }, 500);
  
  console.log(`modal_video_lote('${url_video}')`);
  if (modo == "full"){
    var elem = document.getElementById("video");
    if (elem.requestFullscreen) {
      elem.requestFullscreen();
    } else if (elem.msRequestFullscreen) {
      elem.msRequestFullscreen();
    } else if (elem.mozRequestFullScreen) {
      elem.mozRequestFullScreen();
    } else if (elem.webkitRequestFullscreen) {
      elem.webkitRequestFullscreen();
    } 
  }
}


$(document).ready(() => {



  // EVENTOS AO ABRIR MODAL VIDEO
  $('#modal_video_lote').on('show.bs.modal', () => {
    setTimeout(() => {
      $('#preload').fadeOut();
    }, 600);

    console.log(`OPEN MODAL VIDEO LOTE`);
  });


  // EVENTOS AO FECHAR MODAL VIDEO
  $('#modal_video_lote').on('hide.bs.modal', () => {
    setTimeout(() => {
      $('#modal_video_lote iframe').attr('src', ''); // LIMPA IFRAME
    }, 560);
    console.log(`CLOSE MODAL VIDEO LOTE`);
  });



});



// ---------------------------------------------





function put_login() {

  $('#preload').show();
  $.ajax({
    url: "../includes/acesso/login.php",
    type: "POST",
    cache: false,
    data: $('#login-form').serialize(),
    success: function (response) {
      
      $('#preload').fadeOut();
      console.log(response);
      mensagens_resposta(response, 'topCenter');
      
      var json = $.parseJSON(response);
      if (json['result'] == 'success') {
        setTimeout(() => {
          location.reload();	
        }, 800);
      }
      
    },
    error:function () {
      $('#preload').fadeOut();
      mensagens_erro('Erro! Não foi possível logar no momento!');
    }
  });

  console.log('put_login()');
}

// ---------------------------------------------


function logout() {

  $('#preload').show();
  $.ajax({
    url: "../includes/acesso/logout.php",
    type: "POST",
    cache: false,
    success: function (response) {
      
      $('#preload').fadeOut();
      console.log(response);
      mensagens_resposta(response, 'topCenter');
      
      var json = $.parseJSON(response);
      if (json['result'] == 'success') {
        setTimeout(() => {
          location.reload();	
        }, 800);
      }
      
    },
    error:function () {
      $('#preload').fadeOut();
      mensagens_erro('Erro! Não foi possível deslogar no momento!');
    }
  });

  console.log('logout()');
}



// ---------------------------------------------




function get_senha() {

  $('#preload').show();
  $.ajax({
    url: "../includes/acesso/senha.php",
    type: "POST",
    cache: false,
    data: $('#lost-form').serialize(),
    success: function (response) {
      
      $('#preload').fadeOut();
      console.log(response);
      mensagens_resposta(response, 'topCenter');
      
      var json = $.parseJSON(response);
      if (json['result'] == 'success') {
        $('#login-modal').modal('hide');
        setTimeout(() => {
          document.getElementById("lost-form").reset();
        }, 500);
      }
      
    },
    error:function () {
      $('#preload').fadeOut();
      mensagens_erro('Erro! Não foi possível enviar sua solicitação no momento!');
    }
  });

  console.log('get_senha()');
}



// ----------------------------------------------------




// FORM CADASTRO

$(document).ready(() => {
  $("#register-form").validate({
    rules: {

      // DADOS PRINCIPAIS
      nome_usuario: {required:true},
      cpf_usuario:  {required:true},
      cidade_usuario: {required:true},
      estado_usuario: {required:true},
      celular_usuario: {required:true},

      // DADOS BANCÁRIOS
      // banco_usuario: {required:true},
      // conta_usuario: {required:true},
      // agencia_usuario: {required:true},
      
      
      // REFERÊNCIAS COMERCIAIS
      // empresa_comercial_01_usuario: {required:true},
      // telefone_empresa_comercial_01_usuario: {required:true},
      // empresa_comercial_02_usuario: {required:true},
      // telefone_empresa_comercial_02_usuario: {required:true},


      // DADOS DE ACESSO
      email_usuario: {required:true},
      senha_usuario: {required:true, minlength:6}
    },
    messages: {

      // DADOS PRINCIPAIS
      nome_usuario:  {required: 'Campo obrigatório!'},
      cpf_usuario:  {required: 'Campo obrigatório!'},
      cidade_usuario:  {required: 'Campo obrigatório!'},
      estado_usuario:  {required: 'Campo obrigatório!'},
      celular_usuario:  {required: 'Campo obrigatório!'},

      // DADOS BANCÁRIOS
      // banco_usuario: {required: 'Campo obrigatório!'},
      // conta_usuario: {required: 'Campo obrigatório!'},
      // agencia_usuario:  {required: 'Campo obrigatório!'},

      // REFERÊNCIAS COMERCIAIS
      // empresa_comercial_01_usuario: {required: 'Campo obrigatório!'},
      // empresa_comercial_02_usuario: {required: 'Campo obrigatório!'},
      // telefone_empresa_comercial_01_usuario: {required: 'Campo obrigatório!'},
      // telefone_empresa_comercial_02_usuario: {required: 'Campo obrigatório!'},
     

      // DADOS DE ACESSO
      email_usuario: {required: 'Por favor, informe seu e-mail!', email: 'Endereço de e-mail inválido!'},
      senha_usuario: {required: 'Por favor, informe uma senha', minlength:"Mínimo de 6 caracteres"}
    },
    submitHandler : function(e) {




      /*
      $('#preload').show();
      $.ajax({
        url: "../includes/acesso/cadastro.php",
        type: "POST",
        data: $('#register-form').serialize(),
        success: (response) => {

          $('#preload').fadeOut();
          // console.log('testeeee');
          console.log(response);
          mensagens_resposta(response, 'topCenter');
          
          var json = $.parseJSON(response);
          if (json['result'] == 'success') {
            
            $('#login-modal').modal('hide');
            setTimeout(() => {
              document.getElementById("register-form").reset();
            }, 1000);
          
          }

        },
        error: () => {
          $('#preload').fadeOut();
          mensagens_erro('<b>ERRO AO SALVAR OS DADOS!</b><br>Atualize a página e tente novamente.');
        }
      });
      */ 





      var form_data = new FormData($('#register-form')[0]);

      $('#preload').show();
      $.ajax({
        type: "POST",
        cache: false,
        data: form_data,
        contentType: false,
        processData: false,
        url: "../includes/acesso/cadastro.php",
        xhr: function() {
          var myXhr = $.ajaxSettings.xhr();
          if (myXhr.upload) { // AVALIA SE TEM SUPORTE A PROPRIEDADE UPLOAD
            let progresso_percent = '0%';
            myXhr.upload.onprogress = progress => {
              progresso_percent = Math.round((progress.loaded * 100) / progress.total);
              // console.log('progresso_percent: ' + progresso_percent + '%');
              $('#preload span').text(`${progresso_percent}%`);
            }
          }
          return myXhr;
        },
        success: function(response) {
    
          $('#preload').fadeOut();
          $('#preload span').text('');
          console.log(response);
          mensagens_resposta(response, 'topCenter');
    
          var json = $.parseJSON(response);
          if (json['result'] == 'success') {
            
            $('#login-modal').modal('hide');
            setTimeout(() => {
              document.getElementById("register-form").reset();
            }, 1000);
          
          }

        },
        error: () => {
          $('#preload').fadeOut();
          mensagens_erro('<b>ERRO AO SALVAR OS DADOS!</b><br>Atualize a página e tente novamente.');
        }
      });
    









      
    },
    errorPlacement : function(error, element) {
      error.insertAfter(element.parent());
    }
  });
});






$("#form_newsletter").submit( (event) => {

  event.preventDefault();

  if ( !$('#newsletter-form-email').val().trim() ) {
    mensagens_atencao('Informe seu E-mail...', 'topCenter');
    return;
  }

  $.ajax({
    url: "/includes/acesso/newsletter.php",
    type: "POST",
    data: $('#form_newsletter').serialize(),
    success: function (response) {

      console.log(response);
      mensagens_resposta(response, 'center');

      var json = $.parseJSON(response);
      if (json['result'] == 'success') {
        document.getElementById("form_newsletter").reset();
      }

      
    },
    error: function () {
      mensagens_erro('Não foi possível dar seu lance no momento!<br>Atualize a página e tente novamente!');
    }
  });
});
















// GET_CIDADES
function get_cidades(estado_usuario, id_select_cidade) {

  $('#'+ id_select_cidade).html('<option value="0">Aguarde...</option>');

  $.ajax({
    url: "../includes/get/cidades.php",
    
    type: "POST",
    data: "estado_usuario=" + $('#'+ estado_usuario).val(),
    success: function(response){
      
      var json = $.parseJSON(response);
      if (json['result'] == 'success') {

        var CIDADES = $.parseJSON(json['data']);
        var options = '<option value="">SELECIONE A CIDADE</option>';
        var i = 0;
        for (i = 0; i < CIDADES.length; i++) {
          options += '<option value="' + CIDADES[i].nome_cidade + '">' + CIDADES[i].nome_cidade + '</option>';
        }
        if ( i < 1) {
          options = '<option value="">SELECIONE O ESTADO</option>';
        }
        $('#'+id_select_cidade).html(options);
      } 
      else {
        mensagens_resposta(response);
      }
    },
    error:function () {
      mensagens_erro("Erro na tentativa de obtenção das cidades!");
    }
  });



}







// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------
// -----------------------------------------------------------------------------


document.addEventListener("DOMContentLoaded", function(event) { 
  // CPF com caracteres
  $('.mask-cpf').mask('999.999.999-99');

  // CNPJ com caracteres
  $('.mask-cnpj').mask('99.999.999/9999-99');

  // CEP
  $('.mask-cep').mask('99999-999');

  // telefone
  $('.mask-tel').mask('(99) 9999-9999');

  // Celular
  $('.mask-cel').mask('(99) 99999-9999');

});


// -----------------------------------------------------------------------------------------------
// -----------------------------------------------------------------------------------------------

function mascaraMutuario(o,f){
  v_obj=o;
  v_fun=f;
  setTimeout('execmascara()',1);
}

function execmascara(){
  v_obj.value=v_fun(v_obj.value);
}

function cpfCnpj(v){

  //Remove tudo o que nÃƒÂ£o ÃƒÂ© dÃƒÂ­gito
  v=v.replace(/\D/g,"");

  if (v.length < 14) { //CPF

    //Coloca um ponto entre o terceiro e o quarto dÃƒÂ­gitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2");

    //Coloca um ponto entre o terceiro e o quarto dÃƒÂ­gitos
    //de novo (para o segundo bloco de nÃƒÂºmeros)
    v=v.replace(/(\d{3})(\d)/,"$1.$2");

    //Coloca um hÃƒÂ­fen entre o terceiro e o quarto dÃƒÂ­gitos
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2");

  } else { //CNPJ

    //Coloca ponto entre o segundo e o terceiro dÃƒÂ­gitos
    v=v.replace(/^(\d{2})(\d)/,"$1.$2");

    //Coloca ponto entre o quinto e o sexto dÃƒÂ­gitos
    v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3");

    //Coloca uma barra entre o oitavo e o nono dÃƒÂ­gitos
    v=v.replace(/\.(\d{3})(\d)/,".$1/$2");

    //Coloca um hÃƒÂ­fen depois do bloco de quatro dÃƒÂ­gitos
    v=v.replace(/(\d{4})(\d)/,"$1-$2");

  }

  return v;

}



function scroll_to(value_scroll = 0) {
  $('html, body').animate({ scrollTop: value_scroll }, 'slow');
  console.log(`scroll_to(${value_scroll})`);
}









function str_pad(input, pad_length, pad_string, pad_type) {
  //  discuss at: http://phpjs.org/functions/str_pad/
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Michael White (http://getsprink.com)
  //    input by: Marco van Oort
  // bugfixed by: Brett Zamir (http://brett-zamir.me)
  //   example 1: str_pad('Kevin van Zonneveld', 30, '-=', 'STR_PAD_LEFT');
  //   returns 1: '-=-=-=-=-=-Kevin van Zonneveld'
  //   example 2: str_pad('Kevin van Zonneveld', 30, '-', 'STR_PAD_BOTH');
  //   returns 2: '------Kevin van Zonneveld-----'

  var half = '',
  pad_to_go;

  var str_pad_repeater = function(s, len) {
    var collect = '',
    i;

    while (collect.length < len) {
      collect += s;
    }
    collect = collect.substr(0, len);

    return collect;
  };

  input += '';
  pad_string = pad_string !== undefined ? pad_string : ' ';

  if (pad_type !== 'STR_PAD_LEFT' && pad_type !== 'STR_PAD_RIGHT' && pad_type !== 'STR_PAD_BOTH') {
    pad_type = 'STR_PAD_RIGHT';
  }
  if ((pad_to_go = pad_length - input.length) > 0) {
    if (pad_type === 'STR_PAD_LEFT') {
      input = str_pad_repeater(pad_string, pad_to_go) + input;
      } else if (pad_type === 'STR_PAD_RIGHT') {
      input = input + str_pad_repeater(pad_string, pad_to_go);
      } else if (pad_type === 'STR_PAD_BOTH') {
      half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
      input = half + input + half;
      input = input.substr(0, pad_length);
    }
  }

  return input;
}





