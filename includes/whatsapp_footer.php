<div class="caixa_chat_windows">
	<!-- <div class="chat_window"> -->

		<!-- <div class="whats_top_menu">
			<div class="buttons">
				<div id="buttonavatar" class="button avatar"></div>
			</div>
			<a id="btclose">
				<div class="title">Mult Leilões</div>
				<div class="button whats_close" title="Fechar">x</div>
			</a>
		</div>

		<ul class="whats_messages">

			<div id="message_1">
				<li class="message left appeared">
					<div class="text_wrapper">
						<div class="text">Olá, Como vai?</div>
						<p class="time" id="time"><?php echo date('H:i'); ?></p>
					</div>
				</li>
			</div>

			<div id="message_2">
				<li class="message left appeared">
					<div class="text_wrapper">
						<div class="text">Estamos disponíveis para mais informações</div>
						<p class="time" id="time"><?php echo date('H:i'); ?></p>
					</div>
				</li>
			</div>

			<div id="message_3">
				<li class="message left appeared">
					<div class="text_wrapper">
						<div class="text">Entre em contato via whatsapp</div>
						<p class="time" id="time"><?php echo date('H:i'); ?></p>
					</div>
				</li>
			</div>
		</ul> -->


		<!-- <div class="whats_bottom_wrapper clearfix">
			<form id="form_whats" action="https://api.whatsapp.com/send?phone=557191727633&text=Estou entrando em contato através do site!" method="post" target="_blank">

				<div class="message_input_wrapper">
					<input name="nome" class="message_input" placeholder="Nome" maxlength="60" required />
				</div>

				<div class="message_input_wrapper">
					<input name="telefone" class="message_input" placeholder="(DD)0000-0000" id="whats_telefone" maxlength="15" required />
				</div>

				<div class="send_message">
					<input type="image" src="../assets/images/whatsapp_modulo_enviar.png" onclick="submit_whatsApp()">
				</div>

			</form>
		</div>
	</div> -->

	<a class="float-whatsapp" onclick="submit_whatsApp()">
		<img src="../assets/images/whatsapp_modulo_icone.png" class="my-icon-whatsapp" style="width: 30px">
		<span class="pulse">1</span>
	</a>

</div>

<!-- <style>
	#message_1 {
		display: none;
	}

	#message_2 {
		display: none;
	}

	#message_3 {
		display: none;
	}
</style> -->


<script>
	function submit_whatsApp() {
		window.open('https://api.whatsapp.com/send?phone=557191727633&text=Estou entrando em contato através do site!', '_blank');
	}

	function check_WhatsLead() {
		if (window.jQuery) {
			$("#btwhatsapp").click(function() {
				$(".chat_window").fadeIn(200);

				setTimeout(function() {
					return document.getElementById('message_1').style.display = 'block';
				}, 600);
				setTimeout(function() {
					return document.getElementById('message_2').style.display = 'block';
				}, 1800);
				setTimeout(function() {
					return document.getElementById('message_3').style.display = 'block';
				}, 2900);
			});
			$("#btclose").click(function() {
				$(".chat_window").fadeOut(200);
				document.getElementById('message_1').style.display = 'none';
				document.getElementById('message_2').style.display = 'none';
				document.getElementById('message_3').style.display = 'none';
			});
		} else {
			window.setTimeout("check_WhatsLead();", 100);
		}
	}

	check_WhatsLead();

	if (document.getElementById('whats_telefone')) {
		document.getElementById('whats_telefone').addEventListener('input', function(e) {
			var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
			e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
		});
	}
</script>