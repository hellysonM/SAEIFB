
<div class="row">
    <div class="col s12 xl offset-xl2 xl8">
        <div class="card-panel z-depth-2 ">

            <h5>Bem-vindo <b><?= $_SESSION['nome'] ?></b> 
                
                <span class="right"><?php
                date_default_timezone_set('America/Sao_Paulo');
                $date = date('d-m-Y');
                echo $date;
                   $retorno = $professor->listInformation();
                ?></span>
            
            
            </h5>
            <div class="divider"></div>
            <br>

          


            <div class="card-panel">
                <h5>Aproveitamento de estudos</h5>
                <div class="divider"></div>
                <br>

                <div class="row">
                    
                    
                    <?php
                    
                    foreach ($retorno[1] as $tipo){
                    
                    ?>

                    <div class="col s8 offset-s2  xl4">
                        <div class="card ">
                            <div class="row">
                                <div class="col s4 container center-align">
                                    <br>
                                    <i class="material-icons" style="font-size: 50px">event_note</i>
                                </div>  
                                <div class="col s8  white-text ">
                                    <span class="black-text"><h6>Novas Solicitações</h6></span>
                                    <div class="divider"></div>
                                    <h5 class="black-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$tipo['nova_solicitacao']?></h5>          
                                </div>
                            </div>
                        </div>
                    </div>
                    
                     <?php } ?>
                    
                    <?php
                    
                    foreach ($retorno[3] as $k){
                    
                    ?>
                    
                    <div class="card col xl8 ">
                    <table class="centered">
                        <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Novas Solicitações</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td><?=$k['Nome'] ?></td>
                                <td><?=$k['Quantidade'] ?></td>
                               
                            </tr>

                        </tbody>
                    </table>
                    </div>

                    <?php } ?>
                    
                
                   
                </div>
    
                                   
                    
                <?php
                               
                                $retorno = $professor->listEvento();


                                foreach ($retorno as $valor) {
                                    ?>
                <div class="row">

                    <div class="col s12 ">
                        <div class="card-panel z-depth-2 ">

                            <h6 class="center-align">Evento em andamento</h6>
                            <div class="divider"></div>
                            <br>



                            <table class="centered">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Data Início</th>
                                        <th>Data Fim</th>
                                     
                                       
                                    </tr>
                                </thead>
                                
                                    <tbody>
                                        <tr>
                                            <td><?= $valor['Nome'] ?></td>
                                            <td><?= $valor['DataInicio'] ?></td>
                                            <td><?= $valor['DataTermino'] ?></td>
                                          
                                          
                                        </tr>
                                   
                                </tbody>
                            </table>


                        </div>
                        <?php } ?>



                    </div>
                </div>

                    
                    
                    
                    
                    
                    
                    
                    
                </div>
                
                
                
                



            </div>

        </div>




    </div>
    <div>
    </div>

</div>






