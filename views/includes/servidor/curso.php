<div class="row">
  <div class="col s12 ">
    <div class="card-panel z-depth-2 ">
      <h5>Cursos</h5>
      <div class="divider"></div>
      <br>
      <div class="row ">

        <div id="man" class="col s12 ">
          <div class="card material-table ">
            <div class="table-header">
              <span class="table-title">Lista de Cursos</span>
              <div class="actions">
                <a href="#" class="modal-trigger waves-effect btn-flat nopadding" data-target="modal1"><i class="material-icons">add_circle</i></a>
                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
                
              </div>
            </div>
            <table id="curso" class="centered">
              <thead>
                <tr>
                 
                    <th class="all">Nome</th>
                  <th>Descrição</th>
                  <th>Nº Materias</th>
                  <th>Nº Semestres</th>
                  <th>Tipo</th>
                  <th class="all">Excluir</th>
                  <th class="all">Alterar</th>
                  
                

                </tr>
              </thead>
              
            </table>
          </div>
        </div>


        
      </div>



    </div>
  </div>
</div>
         
















<div id="modal3" class="modal">
        <div class="close-modal right ">
            <a href="#!" class="modal-close waves-effect  waves-green btn-flat"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-content">
            <h4>Alterar Curso</h4>
            <div class="divider"></div>

            <form action="/Servidor/AlterarCurso" method="post" id="alterarcurso">

            <div class="row">
                <div class="input-field">
                    <i class="material-icons prefix">create</i>
                    <input type="text" name="Nome" id="Nome" required >
                    <label for="name"></label>
                    <span class="helper-text" data-error="" data-success=""></span>
                </div>

                <div class="input-field col s12">
            <textarea id="textarea2" class="materialize-textarea" data-length="120" name="Descricao"></textarea>
            <label for="textarea2"></label>
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





<div id="modal1" class="modal">
        <div class="close-modal right ">
            <a href="#!" class="modal-close waves-effect  waves-green btn-flat"><i class="material-icons">close</i></a>
        </div>
        <div class="modal-content">
            <h4>Inserir Curso</h4>
            <div class="divider"></div>

            <form action="/Servidor/InserirCurso" method="post" id="inserircurso">

            <div class="row">
                <div class="input-field">
                    <i class="material-icons prefix">create</i>
                    <input type="text" name="Nome" id="nome" required >
                    <label for="nome">Nome do curso</label>
                    <span class="helper-text" data-error="" data-success=""></span>
                </div>

                <div class="input-field col s12">
            <textarea id="textarea2" class="materialize-textarea" data-length="500" name="Descricao"></textarea>
            <label for="textarea2">Descricao</label>
          </div>
                <div class="input-field col s12">
                <select name="Tipo" id="tipo">
      <option value="" disabled selected>Tipo de curso</option>
      <option value="1">Superior</option>
      <option value="2">Técnico</option>
      
    </select>
    <label for="tipo">Selecionar tipo de curso</label>
                
                </div>
                
                
                
      <div class="input-field col s12">
  <p class="range-field">
      <input type="range" id="curso_semestre" min="1" max="10" name="Semestres"/>
    </p>

    <label>Quantidade de semestres</labe> 
  
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



































