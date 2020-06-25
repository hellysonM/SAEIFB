<div class="row">
  <div class="col s12 ">
    <div class="card-panel z-depth-2 ">
      <h5>Solicitações</h5>
      <div class="divider"></div>
      <br>
      <div class="row ">

        <div id="man" class="col s12 ">
          <div class="card material-table ">
            <div class="table-header">
              <span class="table-title">Solicitações em espera</span>
              <div class="actions">
                <a href="#addClientes" class="modal-trigger waves-effect btn-flat nopadding"><i class="material-icons">person_add</i></a>
                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
              </div>
            </div>
            <table id="solicitacao">
              <thead>
                <tr>
                 
                  <th >Curso</th>
                  <th>Aluno</th>
                  <th>Data</th>
                  <th>DataProfessor</th>
                  <th>Professor</th>
                  
                 
                  <!--
                  <th>DataUltimoLogin</th>
                  <th>Logado</th>
                  <th>IP</th>
                  -->
                  <th style="" class="">Finalizar</th>
                  
                

                </tr>
              </thead>
              
            </table>
          </div>
        </div>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          


        
      </div>



    </div>
  </div>
</div>






<script>
        function abrirPopup(url, w, h) {
            var newW = w + 100;
            var newH = h + 100;
            var left = (screen.width - newW) / 2;
            var top = (screen.height - newH) / 2;
            var newwindow = window.open(url, 'name', 'width=' + newW + ',height=' + newH + ',left=' + left + ',top=' + top);
            newwindow.resizeTo(newW, newH);

            //posiciona o popup no centro da tela
            newwindow.moveTo(left, top);
            newwindow.focus();
            return false;
        }
    </script>








