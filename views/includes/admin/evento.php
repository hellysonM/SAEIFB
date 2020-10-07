<div class="row">
    <div class="col s12  offset-xl2 xl8">
        <div class="card-panel z-depth-2  ">

            <h5>Criar novo evento</h5>
            <div class="divider"></div>
            <br>

            <form  method="POST" action="<?=HOME_URL?>/Admin/inserirEvento">
            <div class="card blue">
                <div class="card-content white-text">
                    <p>Para permitir que novas solicitações sejam enviadas é necessários definir um novo evento com período de tempo pré determinado.
                        <b>A criação de um novo evento exclui o evento vigente.</b>           
                    </p>
                </div>
                <div class="card-tabs">
                    <ul class="tabs tabs-fixed-width tabs-transparent">
                        <li class="tab"><a href="#test1" class="active">Básico</a></li>
                        <li class="tab"><a class="" href="#test2">Data</a></li>
                     
                        <li class="indicator" style="left: 0px; right: 180px;"></li></ul>
                </div>
                <div class="card-content blue lighten-5">
                    <div id="test1" style="display: block;" class="active">
                     <div class="row">
                            <div class="input-field col s6">
                                <input value="" id="first_name2" type="text" class="validate" name="nome" required>
                                <label class="active" for="first_name2">Nome</label>
                            </div>
           
                            <div class="input-field col s6">
                                <textarea id="textarea2" class="" data-length="120" name="descricao" placeholder="Descrição" cols="100" rows="50"></textarea>  
                            </div>

                        </div> 

                    </div>

                    <div id="test2" class="" style="display: none;">


                        <div class="row">
                            <div class="col s6">
                                Data início    
                                <input type="text" class="datepicker" name="data_inicio" required>      
                            </div> 


                            <div class="col s6">
                                Data fim  
                                <input type="text" class="datepicker" name="data_fim" required>     
                            </div>       
                        </div>  
                        
                        
                            <div class="container center-align"> 
                       <button type="submit" class="waves-effect waves-light btn-large blue" name="uploadform" value="enviar"><i class="material-icons left" >exit_to_app</i>Enviar</button >
                        </div>
                        
                    </div>

      
                    
                </div>
            </div>
            </form>
        </div>

    </div>
    
   
     <div class="col s12 xl8 offset-xl2 ">
    <div class="card-panel z-depth-2  s12">

    <h5>Evento vigente</h5>
      <div class="divider"></div>
      <br>
      
        <table>
        <thead>
          <tr>
              <th>Nome</th>
              <th>Data Início</th>
              <th>Data Fim</th>
              <th class="hide-on-small-only">Observação</th>
              <th>Encerrar</th>
          </tr>
        </thead>
        <?php $admin = new Administrador();
        $retorno = $admin->listEvento();
        
        
        foreach($retorno as $valor){
        ?>
        <tbody>
          <tr>
            <td><?=$valor['Nome']?></td>
            <td><?=$valor['DataInicio']?></td>
            <td><?=$valor['DataTermino']?></td>
            <td class="hide-on-small-only	"><?=$valor['Descricao']?></td>
            <td>  <a href="/Admin/deletarEvento/<?=$valor['ID']?>"><i class="red-text medium material-icons">event_busy</i></a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
  
    </div>
   
  </div>


</div>