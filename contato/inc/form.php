<form id="form_contato" role="form">

  <div class="row">

    <div class="col-md-4">
      <div class="form-group">
        <label class="nmb">Nome: *</label>
        <div>
          <input class="form-control form-control-name" name="nome_usuario" id="name" placeholder="Seu nome completo..." type="text">
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label class="nmb">Email: *</label>
        <div>
          <input class="form-control form-control-email" name="email_usuario" id="email" placeholder="Seu E-mail..." type="email">
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="form-group">
        <label class="nmb">Celular: *</label>
        <div>
          <input class="form-control form-control-subject mask-cel" name="celular_usuario" id="subject" placeholder="Seu Nº de Celular...">
        </div>
      </div>
    </div>

  </div>

  <div class="form-group">
    <label class="nmb">Mensagem: *</label>
    <div>
      <textarea class="form-control form-control-message nmb npb" name="mensagem_usuario" id="message" placeholder="Descreva sua mensagem aqui..." rows="10"></textarea>
    </div>
  </div>

  <div class="text-right">
    <button class="btn btn-primary solid blank" type="submit">ENVIAR MENSAGEM</button> 
  </div>
</form>
