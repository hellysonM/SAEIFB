<?php
$aluno->checkSolicitacao(3);
?>

<div class="row">
    <div class="col xl6 offset-xl3 s12 ">
        <div class="card-panel z-depth-2 ">

            <h5>Aproveitamento de Estudos</h5>
            <div class="divider"></div>



            <h5 class="teal-text"><?php
                $resultado = $aluno->listCursoSolicitacao();
                echo $resultado[0];
                ?> </h5>




            <form action="/Aluno/InserirSolicitacao/<?= URL[3] ?>" id="inserir_solicitacao" method="POST" enctype="multipart/form-data" class="">  
                <div class="row">
                    <div class="divider"></div>



                   



                        <div class="section grey lighten-5">
                            <div class="container">
                                <div class="row">
                                    <div class="col s12">

                                        <div class="card">
                                            <div class="card-content">

                                                <ul data-method="GET" class="stepper linear">
                                                    <li class="step active">
                                                        <div class="step-title waves-effect waves-dark">Disciplinas</div>
                                                        <div class="step-content">
                                                            <div class="row">

                                                                Selecione as disciplinas que se deseja aproveitar indicando o nome da componente que consta em seus documentos.<br><br>

                                                                <ul class="collapsible">


                                                                    <?php
                                                                    $count = 0;
                                                                    $semestres = $aluno->listSemestreCurso();


                                                                    for ($i = 1; $i <= $semestres[0]; $i++) {
                                                                        $materia_semestre = $aluno->listMateriaSemestre($i);
                                                                        ?>
                                                                        <li>
                                                                            <div class="collapsible-header"><i class="tiny material-icons arrow-change"><span class="">arrow_drop_down</span></i><?= $i ?>° Semestre</div>
                                                                            <div class="collapsible-body"><span><?php
                                                                                    foreach ($materia_semestre as $materia) {
                                                                                        ?> 


                                                                                        <div class="row">
                                                                                            <div class="col s12">

                                                                                                <label>
                                                                                                    <input type="checkbox" class="filled-in" value="<?= $materia['Nome'] ?>" id="curso_do_ifb<?= $count ?>" />
                                                                                                    <span><?= $materia['Nome'] ?></span>
                                                                                                </label>

                                                                                                <input type="hidden" id="materia[<?= $count ?>][ifb]" name="materia[<?= $count ?>][ifb]" value="<?= $materia['ID'] ?>">

                                                                                                <div class="input-field  hide" id="abaixo_do_curso_do_ifb<?= $count ?>">

                                                                                                    <input type="text" value="" id="curso_de_origem<?= $count ?>"  type="text" class="validate" name="materia[<?= $count ?>][origem]">       
                                                                                                    <span class="helper-text" data-error="não deve ser deixado em branco" data-success=""></span>
                                                                                                    <label for="curso_de_origem<?= $count ?>">Nome da componente de origem</label>
                                                                                                </div>


                                                                                            </div>



                                                                                        </div> 


                                                                                        <?php
                                                                                        $count++;
                                                                                    }
                                                                                    ?></span></div>
                                                                        </li>

                                                                    <?php } ?>


                                                                </ul>



                                                            </div>
                                                            <div class="step-actions">
                                                                <button class="waves-effect waves-dark btn blue next-step" data-feedback="anyThing">Continuar</button>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="step">
                                                        <div class="step-title waves-effect waves-dark">Enviar documentos</div>
                                                        <div class="step-content">


                                                            <div class="row">


                                                                <div class="col s12">

                                                                    <a id="btn_adicionar" class="btn-floating btn-small waves-effect waves-light blue tooltipped container right" data-position="left" data-tooltip="adicionar outro arquivo"><i class="material-icons">note_add</i></a>


                                                                </div>

                                                                <div id="div_adicionar" class="">



                                                                    <div class="">  




                                                                        <div class="file-field input-field col s6">
                                                                            <div class="btn teal">
                                                                                <span><i class="material-icons">file_upload</i></span>

                                                                                <input type="file"  name="fileToUpload[file][]" id="fileToUpload" required>
                                                                            </div>

                                                                            <div class="file-path-wrapper ">
                                                                                <input class="file-path validate" type="text" placeholder="adicionar arquivo">
                                                                            </div>
                                                                        </div> 





                                                                        <div class="input-field col s4 ">

                                                                            <input id="icon_prefix" type="text" class="validate" name="fileToUpload[description][]">
                                                                            <label for="icon_prefix">descrição</label>
                                                                        </div>

                                                                        <div class=" input-field col s2">
                                                                            <a class="btn-floating  cyan pulse tooltipped" data-position="right" data-tooltip="Apenas arquivos .pdf são permitidos,<br> sendo no máximo 5 arquivos com até 10mb cada um"><i class="material-icons">help</i></a> 
                                                                        </div>




                                                                    </div>


                                                                </div>



                                                            </div>

                                                            <div class="step-actions">
                                                                <button class="waves-effect waves-dark btn blue next-step">Continuar</button>
                                                                <button class="waves-effect waves-dark btn-flat previous-step">Voltar</button>
                                                            </div>


                                                        </div>
                                                    </li>
                                                    <li class="step">
                                                        <div class="step-title waves-effect waves-dark">Finalizar</div>
                                                        <div class="step-content">

                                                            Alguma observação referente a sua solicitação?<br><br>



                                                            <div class="row">
                                                                <div class="input-field col s12">
                                                                    <textarea id="textarea2" class="materialize-textarea" data-length="120" name="Obs"></textarea>
                                                                    <label for="textarea2">Observações</label>
                                                                </div>




                                                                <input type="hidden" name="UploadForm">
                                                                <div class="container center-align">
                                                                    <button type="submit" class="waves-effect waves-light btn" name="uploadform" value="enviar"><i class="material-icons left" >exit_to_app</i>Enviar</button >
                                                                </div>
                                                                <br>





                                                                <div class="step-actions">
                                                                    <!--<button class="waves-effect waves-dark btn blue next-step" data-feedback="noThing">ENDLESS CALLBACK!</button>-->
                                                                </div>
                                                            </div>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                     





                </div>
                </form>  
        </div> 





    </div>



</div>





























