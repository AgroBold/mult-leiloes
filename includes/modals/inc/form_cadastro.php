<form id="register-form" style="display:none;">

  <div class="modal-body">
    <div id="div-register-msg">
      <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
      <span id="text-register-msg">Dados Principais</span>
    </div>

    <div><input name="nome_usuario" class="form-control mb-10px" type="text" placeholder="Seu nome completo *" style="height:45px"></div>
    <div><input name="celular_usuario" class="form-control mb-10px mask-cel" type="text" placeholder="Número de Celular  *" style="height:45px"></div>
    <div><input name="cpf_usuario" class="form-control mb-10px" type="text" placeholder="Seu CPF / CNPJ *" style="height:45px" onkeypress='mascaraMutuario(this,cpfCnpj)' onblur='clearTimeout()' maxlength="18"></div>

    <div>
      <select name="estado_usuario" id="estado_usuario" class="form-control mb-10px" style="height:45px" onchange="get_cidades('estado_usuario', 'cidade_usuario')">
        <option value="">ESTADO *</option>
        <?php get_estados('', false); ?>
      </select>
    </div>

    <div>
      <select name="cidade_usuario" id="cidade_usuario" class="form-control mb-10px" style="height:45px">
        <option value="">CIDADE *</option>
      </select>
    </div>


    <div class="div-register-msg mt-20px mb-10px">
      <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
      <span id="text-register-msg">Dados Bancários</span>
    </div>

    <div>
      <select name="banco_usuario" id="banco_usuario" class="form-control mb-10px" style="height:45px">
        <option value="">Selecione o Banco</option>
        <?php get_bancos(); ?>
      </select>
    </div>    
    <div><input name="agencia_usuario" class="form-control mb-10px" type="text" placeholder="Agência" style="height:45px"></div>
    <div><input name="conta_usuario" class="form-control mb-10px" type="text" placeholder="Nº da Conta" style="height:45px"></div>
    


    <div class="div-register-msg mt-20px mb-10px">
      <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
      <span id="text-register-msg">Documentos (Max. 2MB por arquivo)</span>
    </div>

    <!-- INPUT FILE -->
    <div class="form-group">
      <div class="input-group input-file" name="DOC_1">
        
        <span class="input-group-btn">
          <button class="btn btn-default btn-choose" type="button">Selecione</button>
        </span>
        
        <input type="text" class="form-control" placeholder='Documento de Identificação *' style="height: 34px;cursor: pointer;padding: 3px 10px;margin-top: 0px;"/>

        <span class="input-group-btn">
          <button class="btn btn-secondary btn-reset" type="button"><i class="fa fa-times"></i></button>
        </span>

      </div>
    </div>


    <!-- INPUT FILE -->
    <div class="form-group">
      <div class="input-group input-file" name="DOC_2">
        
        <span class="input-group-btn">
          <button class="btn btn-default btn-choose" type="button">Selecione</button>
        </span>

        <input type="text" class="form-control" placeholder='Comprovante de Endereço *' style="height: 34px;cursor: pointer;padding: 3px 10px;margin-top: 0px;"/>
        
        <span class="input-group-btn">
          <button class="btn btn-secondary btn-reset" type="button"><i class="fa fa-times"></i></button>
        </span>

      </div>
    </div>




    <!-- INPUT FILE -->
    <div class="form-group mb-25px">
      <div class="input-group input-file" name="DOC_3">
        
        <span class="input-group-btn">
          <button class="btn btn-default btn-choose" type="button">Selecione</button>
        </span>
        
        <input type="text" class="form-control" placeholder='Comprovante de Renda...' style="height: 34px;cursor: pointer;padding: 3px 10px;margin-top: 0px;"/>        
        
        <span class="input-group-btn">
          <button class="btn btn-secondary btn-reset" type="button"><i class="fa fa-times"></i></button>
        </span>

      </div>
    </div>






    <div class="div-register-msg mt-20px mb-10px">
      <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
      <span id="text-register-msg">Referências Comerciais</span>
    </div>

    <div><input name="empresa_comercial_01_usuario" class="form-control mb-10px" type="text" placeholder="Referência Comercial 1" style="height:45px"></div>
    <div><input name="telefone_empresa_comercial_01_usuario" class="form-control mb-10px mask-cel" type="text" placeholder="Telefone Referência 1" style="height:45px"></div>


    <div><input name="empresa_comercial_02_usuario" class="form-control mb-10px" type="text" placeholder="Referência Comercial 2" style="height:45px"></div>
    <div><input name="telefone_empresa_comercial_02_usuario" class="form-control mb-10px mask-cel" type="text" placeholder="Telefone Referência 2" style="height:45px"></div>



    <label class="check-container">
      <input type="checkbox" class="check-lancamentos" name="associado_abccmm" value="1">
      <span class="checkmark"></span>
      <span class="text-checkmark">
        ASSOCIADO <strong class="red-template">ABCCMM</strong>?
      </span>
    </label>





    <div class="div-register-msg mt-20px mb-10px">
      <div id="icon-register-msg" class="glyphicon glyphicon-chevron-right"></div>
      <span id="text-register-msg">Dados de Acesso</span>
    </div>
    <!-- <hr class="nmt nmb"> -->

    <div><input name="email_usuario" class="form-control mb-10px" type="text" placeholder="Seu e-mail *" style="height:45px"></div>
    <div><input name="senha_usuario" class="form-control mb-10px" type="password" placeholder="Informe uma senha *" style="height:45px"></div>

  </div>

  <div class="modal-footer">
    <div>
      <button type="submit" class="btn btn-primary btn-lg btn-block" onclick="calcula_altura_form_cad()">CADASTRAR</button>
    </div>

    <div>
      <button id="register_login_btn" type="button" class="btn btn-link">Logar</button>
      <button id="register_lost_btn" type="button" class="btn btn-link">Esqueceu sua senha?</button>
    </div>
  </div>

</form>





