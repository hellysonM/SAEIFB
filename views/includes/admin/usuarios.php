<div class="row">
  <div class="col s12 ">
    <div class="card-panel z-depth-2 ">
      <h5>Usuarios</h5>
      <div class="divider"></div>
      <br>
      <div class="row ">

        <div id="man" class="col s12 ">
          <div class="card material-table ">
            <div class="table-header">
              <span class="table-title">Lista de Usuários</span>
              <div class="actions">
               
                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
              </div>
            </div>
              <table id="usuario" class="centered">
              <thead>
                <tr>
                    
                    <th class="all">Nome</th>
                  
                  <th>Email</th>
                  <th class="all">CPF</th>
                  <th>Data registro</th>
                  
                  <th>Tipo</th>
                  <th  class="all">Alterar</th>
                

                </tr>
              </thead>
              
            </table>
          </div>
        </div>


        
      </div>



    </div>
  </div>
</div>
         










<div id="modal" class="modal">
        <div class="close-modal right ">
            <a href="#!" class="modal-close waves-effect  waves-green btn-flat"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-content">
            <h4>Alterar Usuário</h4>
            <div class="divider"></div>

            <form action="/Admin/alterarUsuarioModal" method="post" id="alterar_usuario">

            <div class="row">
                <div class="input-field">
                    <i class="material-icons prefix">perm_identity</i>
                    <input type="text" name="Nome" id="nome" required >
                    <label for="name"></label>
                    <span class="helper-text" data-error="" data-success="">Nome do usuário</span>
                </div>
                
                
                <div class="input-field">
                    <i class="material-icons prefix">contact_mail</i>
                    <input type="text" name="Email" id="email" required >
                    <label for="name"></label>
                    <span class="helper-text" data-error="" data-success="">E-mail</span>
                </div>
                
                <div class="input-field">
                    <i class="material-icons prefix">person</i>
                    <input type="text" name="CPF" id="cpf" required >
                    <label for="name"></label>
                    <span class="helper-text" data-error="" data-success="">CPF</span>
                </div>
                
                
                  <div class="input-field ">
                      <select class="browser-default" id="tipo" name="Tipo">
                      <option value="" disabled selected>Tipo de usuário</option>
                      <option value="5">Servidor</option>
                      <option value="1">Usuario</option>
                      <option value="3">Professor</option>
                      <option value="2">Aluno</option>
                    </select>
                    
                  </div>
                
                
                

                

          </div>


<div class="container center-align">
<button type="submit" class="waves-effect waves-light btn-small"><i class="material-icons left">done</i>Inserir</submit>
</div>
</form>

        <div class="progress hide" id="loading">
    <div class="indeterminate"></div>
</div>
        </div>
</div>