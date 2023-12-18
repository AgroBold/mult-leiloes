function check_WhatsLead(){
  if ( window.jQuery)
  {
	$("#btwhatsapp").click(function () {
			  $(".chat_window").fadeIn(200);
			  setTimeout(function () {
				return  document.getElementById('message_1').style.display = 'block';
			}, 600);
			  setTimeout(function () {
				return  document.getElementById('message_2').style.display = 'block';
			}, 1800);
			  setTimeout(function () {
				return  document.getElementById('message_3').style.display = 'block';
			}, 2900);
        });
	$("#btclose").click(function () {
          $(".chat_window").fadeOut(200);
		  document.getElementById('message_1').style.display = 'none';
		  document.getElementById('message_2').style.display = 'none';
		  document.getElementById('message_3').style.display = 'none';
       });   
  }
  else{
  window.setTimeout("check_WhatsLead();",100);
  }
}

check_WhatsLead();

if (document.getElementById('whats_telefone'))
{
	document.getElementById('whats_telefone').addEventListener('input', function (e) {
		var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
		e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
	});
}




