
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

                    foreach ($retorno[0] as $tipo) {
                        ?>

                        <div class="col s6 xl2">
                            <div class="card ">
                                <div class="row">
                                    <div class="col s4 container center-align">
                                        <br>
                                        <i class="material-icons medium" style="font-size: 40px">account_circle</i>
                                    </div>  
                                    <div class="col s8  white-text ">
                                        <span class="black-text"><h6>Usuários</h6></span>
                                        <div class="divider"></div>
                                        <span class="black-text"><h5><?= $tipo['usuario'] ?></h5>          
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="col s6 xl2">
                            <div class="card ">
                                <div class="row">
                                    <div class="col s4 container center-align">
                                        <br>
                                        <i class="material-icons" style="font-size: 40px">local_library</i>
                                    </div>  
                                    <div class="col s8  white-text ">
                                        <span class="black-text"><h6>Alunos</h6></span>
                                        <div class="divider"></div>
                                        <h5 class="black-text"><?= $tipo['aluno'] ?></h5>          
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col s6 xl3">
                            <div class="card ">
                                <div class="row">
                                    <div class="col s4 container center-align">
                                        <br>
                                        <i class="material-icons medium" style="font-size: 40px">school</i>
                                    </div>  
                                    <div class="col s8  white-text ">
                                        <span class="black-text"><h6>Professores</h6></span>
                                        <div class="divider"></div>
                                        <h5 class="black-text"><?= $tipo['professor'] ?></h5>          
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col s6 xl3">
                            <div class="card ">
                                <div class="row">
                                    <div class="col s4 container center-align">
                                        <br>
                                        <i class="material-icons medium" style="font-size: 40px">perm_contact_calendar</i>
                                    </div>  
                                    <div class="col s8  white-text ">
                                        <span class="black-text"><h6>Servidores</h6></span>
                                        <div class="divider"></div>
                                        <h5 class="black-text"><?= $tipo['servidor'] ?></h5>          
                                    </div>
                                </div>
                            </div>
                        </div>


                    <?php } ?>


                    <?php foreach ($retorno[2] as $tipo) { ?>

                        <div class="col s6 xl2">
                            <div class="card ">
                                <div class="row">
                                    <div class="col s4 container center-align">
                                        <br>
                                        <i class="material-icons medium" style="font-size: 40px">subject</i>
                                    </div>  
                                    <div class="col s8  white-text ">
                                        <span class="black-text"><h6>Notícias</h6></span>
                                        <div class="divider"></div>
                                        <h5 class="black-text"><?= $tipo['noticia'] ?></h5>          
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>






            </div>  


            <div class="card-panel">
                <h5>Aproveitamento de estudos</h5>
                <div class="divider"></div>
                <br>

                <div class="row">


                    <?php
                    foreach ($retorno[1] as $tipo) {
                        ?>

                        <div class="col s12 xl4">
                            <div class="card ">
                                <div class="row">
                                    <div class="col s4 container center-align">
                                        <br>
                                        <i class="material-icons" style="font-size: 50px">event_note</i>
                                    </div>  
                                    <div class="col s8  white-text ">
                                        <span class="black-text"><h6>Novas Solicitações</h6></span>
                                        <div class="divider"></div>
                                        <h5 class="black-text"><?= $tipo['nova_solicitacao'] ?></h5>          
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col s12 xl4">
                            <div class="card ">
                                <div class="row">
                                    <div class="col s4 container center-align">
                                        <br>
                                        <i class="material-icons small" style="font-size: 50px">event</i>
                                    </div>  
                                    <div class="col s8  white-text ">
                                        <span class="black-text"><h6>Solicitações avaliadas</h6></span>
                                        <div class="divider"></div>
                                        <h5 class="black-text"><?= $tipo['solicitacao_aguardando'] ?></h5>          
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col s12 xl4">
                            <div class="card ">
                                <div class="row">
                                    <div class="col s4 container center-align">
                                        <br>
                                        <i class="material-icons small" style="font-size: 50px">event_available</i>
                                    </div>  
                                    <div class="col s8  white-text ">
                                        <span class="black-text"><h6>Solicitações finalizadas</h6></span>
                                        <div class="divider"></div>
                                        <h5 class="black-text"><?= $tipo['solicitacao_finalizada'] ?></h5>          
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                <?php } ?>

                <?php
                $retorno = $admin->listEvento();


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




                        </div>
                    </div>
                <?php } ?>








            </div>







        </div>

    </div>




</div>
<div>
</div>

</div>






