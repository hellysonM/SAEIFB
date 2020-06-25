
<div class="row">
    <div class="col s12 xl offset-xl2 xl8">
        <div class="card-panel z-depth-2 ">

            <h5>Bem-vindo <b><?= $_SESSION['nome'] ?></b> 
                
                <span class="right"><?php
                date_default_timezone_set('America/Sao_Paulo');
                $date = date('d-m-Y');
                echo $date;
                ?></span>
            
            
            </h5>
            <div class="divider"></div>
            <br>

            <div class="card-panel">
                <h5>Dashboard</h5>
                <div class="divider"></div>
                <br>

                <div class="row">
                    <?php 
                    
                    $adm = new Administrador();
                    
                    $retorno = $adm->listInformation();
                    
                    foreach($retorno[0] as $tipo){
                    
                    ?>
                    
                    <div class="col s6 xl2">
                        <div class="card ">
                            <div class="row">
                                <div class="col s4 container center-align">
                                    <br>
                                    <i class="material-icons medium">account_circle</i>
                                </div>  
                                <div class="col s8  white-text ">
                                    <span class="black-text"><h5>Usuários</h5></span>
                                    <div class="divider"></div>
                                    <h5 class="black-text"><?=$tipo['usuario']?></h5>          
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    <div class="col s6 xl3">
                        <div class="card ">
                            <div class="row">
                                <div class="col s4 container center-align">
                                    <br>
                                    <i class="material-icons medium">local_library</i>
                                </div>  
                                <div class="col s8  white-text ">
                                    <span class="black-text"><h5>Alunos</h5></span>
                                    <div class="divider"></div>
                                    <h5 class="black-text"><?=$tipo['aluno']?></h5>          
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col s6 xl3">
                        <div class="card ">
                            <div class="row">
                                <div class="col s4 container center-align">
                                    <br>
                                    <i class="material-icons medium">school</i>
                                </div>  
                                <div class="col s8  white-text ">
                                    <span class="black-text"><h5>Professores</h5></span>
                                    <div class="divider"></div>
                                    <h5 class="black-text"><?=$tipo['professor']?></h5>          
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col s6 xl3">
                        <div class="card ">
                            <div class="row">
                                <div class="col s4 container center-align">
                                    <br>
                                    <i class="material-icons medium">perm_contact_calendar</i>
                                </div>  
                                <div class="col s8  white-text ">
                                    <span class="black-text"><h5>Servidores</h5></span>
                                    <div class="divider"></div>
                                    <h5 class="black-text"><?=$tipo['servidor']?></h5>          
                                </div>
                            </div>
                        </div>
                    </div>


                    
                    
                    <?php } ?>
                </div>



            </div>  


            <div class="card-panel">
                <h5>Aproveitamento de estudos</h5>
                <div class="divider"></div>
                <br>

                <div class="row">
                    
                    
                    <?php
                    
                                    foreach ($retorno[1] as $tipo){
                    
                    ?>

                    <div class="col s6 xl2">
                        <div class="card ">
                            <div class="row">
                                <div class="col s4 container center-align">
                                    <br>
                                    <i class="material-icons small">event_note</i>
                                </div>  
                                <div class="col s8  white-text ">
                                    <span class="black-text"><h6>Novas Solicitações</h6></span>
                                    <div class="divider"></div>
                                    <h5 class="black-text"><?=$tipo['nova_solicitacao']?></h5>          
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="col s6 xl2">
                        <div class="card ">
                            <div class="row">
                                <div class="col s4 container center-align">
                                    <br>
                                    <i class="material-icons small">event</i>
                                </div>  
                                <div class="col s8  white-text ">
                                    <span class="black-text"><h6>Solicitações aguardando</h6></span>
                                    <div class="divider"></div>
                                    <h5 class="black-text"><?=$tipo['solicitacao_aguardando']?></h5>          
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div class="col s6 xl2">
                        <div class="card ">
                            <div class="row">
                                <div class="col s4 container center-align">
                                    <br>
                                    <i class="material-icons small">event_available</i>
                                </div>  
                                <div class="col s8  white-text ">
                                    <span class="black-text"><h6>Solicitações finalizadas</h6></span>
                                    <div class="divider"></div>
                                    <h5 class="black-text"><?=$tipo['solicitacao_finalizada']?></h5>          
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    
                                    <?php } ?>
                    
                    
                    
                    
                    
                    

                    <div class="col s6 ">
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
                                <?php
                                $admin = new Administrador();
                                $retorno = $admin->listEvento();


                                foreach ($retorno as $valor) {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?= $valor['Nome'] ?></td>
                                            <td><?= $valor['DataInicio'] ?></td>
                                            <td><?= $valor['DataTermino'] ?></td>
                                          
                                          
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>


                        </div>




                    </div>


                    
                    
                    
                    
                    
                    
                    
                    
                </div>
                
                
                
                



            </div>

        </div>




    </div>
    <div>
    </div>

</div>






