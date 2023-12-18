<form id="lost-form" style="display:none">

  <div class="modal-body">
    <div id="div-lost-msg">
      <div id="icon-lost-msg" class="glyphicon glyphicon-chevron-right"></div>
      <span id="text-lost-msg">Informe seu e-mail.</span>
    </div>

    <input name="email_usuario" id="lost_email" class="form-control" type="text" placeholder="Seu e-Mail">
  </div>

  <div class="modal-footer">
    <div>
      <button type="button" onclick="get_senha()" class="btn btn-primary btn-lg btn-block">ENVIAR</button>
    </div>

    <div>
      <button id="lost_login_btn" type="button" class="btn btn-link">Logar</button>
      <button id="lost_register_btn" type="button" class="btn btn-link">Cadastrar</button>
    </div>
  </div>

</form>
