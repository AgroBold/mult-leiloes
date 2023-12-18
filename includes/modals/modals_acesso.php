<div class="modal fade opacity-0" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
				<img  id="img_logo" src="../assets/images/header-logo.png">
			</div>
                
			<div id="div-forms">
				<?php
					include('inc/form_login.php');
					include('inc/form_senha.php');
					include('inc/form_cadastro.php');
				?>
			</div>
                
		</div>
	</div>
</div>
