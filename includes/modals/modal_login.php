<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				</button>
				<img  id="img_logo" src="../assets/images/header-logo.png">
			</div>
							
                
			<div id="div-forms">
			
				<form id="login-form">
					
					<div class="modal-body">
						<input id="login_username" class="form-control" type="text" placeholder="E-mail" required>
						<input id="login_password" class="form-control" type="password" placeholder="Senha" required>
					</div>

					<div class="modal-footer">
						<div>
							<button type="submit" class="btn btn-primary btn-lg btn-block">Entrar</button>
							<button type="submit" class="btn btn-primary btn-lg btn-block">Registrar</button>
						</div>
					<div>

					<button id="login_lost_btn" type="button" class="btn btn-link">Esqueceu sua senha?</button>

									
					</div> <!-- DIV SOLTA SEM SENTIDO  -->
					</div> <!-- DIV SOLTA SEM SENTIDO  -->
				</form>
					
					
				<!-- Begin | Lost Password Form -->
				<form id="lost-form" style="display:none;">
					<div class="modal-body">
						<div id="div-lost-msg">
							<div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
							<span id="text-lost-msg">Type your e-mail.</span>
						</div>

						<input id="lost_email" class="form-control" type="text" placeholder="E-Mail (type ERROR for error effect)" required>
					</div>

					<div class="modal-footer">
						<div>
							<button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
						</div>

						<div>
							<button id="lost_login_btn" type="button" class="btn btn-link">Log In</button>
							<button id="lost_register_btn" type="button" class="btn btn-link">Register</button>
						</div>
					</div>

				</form>
				<!-- End | Lost Password Form -->
					


				<!-- Begin | Register Form -->
				<form id="register-form" style="display:none;">
					<div class="modal-body">

						<div id="div-register-msg">
							<div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
							<span id="text-register-msg">Register an account.</span>
						</div>

						<input id="register_username" class="form-control" type="text" placeholder="Username (type ERROR for error effect)" required>
						<input id="register_email" class="form-control" type="text" placeholder="E-Mail" required>
						<input id="register_password" class="form-control" type="password" placeholder="Password" required>
					</div>

					<div class="modal-footer">
						<div>
							<button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
						</div>

						<div>
							<button id="register_login_btn" type="button" class="btn btn-link">Log In</button>
							<button id="register_lost_btn" type="button" class="btn btn-link">Lost Password?</button>
						</div>
					</div>

				</form>
					
					
			</div>
			
                
		</div>
	</div>
</div>
