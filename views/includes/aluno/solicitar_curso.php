<?php
$aluno->checkSolicitacao(3);
?>

<div class="row">
    <div class="col xl6 offset-xl3 s12 ">
        <div class="card-panel z-depth-2 ">

            <h5>Aproveitamento de Estudos</h5>
            <div class="divider"></div>



            <h4 class="teal-text"><?php
                $resultado = $aluno->listCursoSolicitacao();
                echo $resultado[0];
                ?> </h4>




            <form action="/Aluno/InserirSolicitacao/<?= URL[3] ?>" id="inserir_solicitacao" method="POST" enctype="multipart/form-data" class="">  
                <div class="row">
                    <div class="divider"></div>

                    <ul id="tabs-swipe-demo" class="tabs">
                        <li class="tab col s3"><a class="active" href="#test-swipe-1">Materias</a></li>
                        <li class="tab col s3"><a  href="#test-swipe-2">Documentos</a></li>
                        <li class="tab col s3"><a href="#test-swipe-3">Finalizar</a></li>
                    </ul>
                    <div id="test-swipe-1" class="col s12  grey lighten-5">


                        <h5>Defina as materias do curso de origem</h5>(Preencha apenas os campos das materias que se deseja aproveitar)

                        <div class="divider"></div>

                        <br>

                        <form action="/Aluno/InserirSolicitacao/<?= URL[3] ?>" id="inserir_solicitacao" method="POST" enctype="multipart/form-data" class="">  
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
                                                        <div class="input-field col s6">
                                                            <input disabled value="<?= $materia['Nome'] ?>" id="curso_do_ifb<?= $count ?>" type="text" class="validate" name="">
                                                            <label for="curso_do_ifb<?= $count ?>">Matéria no IFB</label>
                                                        </div>

                                                        <input type="hidden" id="materia[<?= $count ?>][ifb]" name="materia[<?= $count ?>][ifb]" value="<?= $materia['ID'] ?>">



                                                        <div class="input-field col s6">
                                                            <input type="text" value="" id="curso_de_origem<?= $count ?>" type="text" class="validate" name="materia[<?= $count ?>][origem]">
                                                            <label for="curso_de_origem<?= $count ?>">Matéria de origem</label>
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
                    <div id="test-swipe-2" class="col s12 grey lighten-5">

                        <h5>Envie seus documentos </h5>
                        <div class="divider"></div>
                        <br>
                        <br>
                        <div class="row">


                            <div class="col s12">

                                <a id="btn_adicionar" class="btn-floating btn-small waves-effect waves-light blue tooltipped container right" data-position="left" data-tooltip="adicionar outro arquivo"><i class="material-icons">note_add</i></a>


                            </div>

                            <div id="div_adicionar" class="container">



                                <div class="">  




                                    <div class="file-field input-field col s6">
                                        <div class="btn teal">
                                            <span><i class="material-icons">file_upload</i></span>

                                            <input type="file"  name="fileToUpload[file][]" id="fileToUpload">
                                        </div>

                                        <div class="file-path-wrapper ">
                                            <input class="file-path validate" type="text" placeholder="adicionar arquivo">
                                        </div>
                                    </div> 





                                    <div class="input-field col s4 ">

                                        <input id="icon_prefix" type="text" class="validate" name="fileToUpload[description][]">
                                        <label for="icon_prefix">descrição documento</label>
                                    </div>

                                    <div class=" input-field col s2">
                                        <a class="btn-floating  cyan pulse tooltipped" data-position="right" data-tooltip="Apenas arquivos .pdf são permitidos,<br> sendo no máximo 4 arquivos com até 5mb cada um"><i class="material-icons">help</i></a> 
                                    </div>




                                </div>


                            </div>



                        </div>

                    </div>
                    <div id="test-swipe-3" class="col s12 grey lighten-5">

                        <h5>Minhas observações</h5> 



                        <div class="divider"></div>

                        <br>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="textarea2" class="" data-length="120" name="Obs" placeholder="" cols="100" rows="50"></textarea>
                                <!--<label for="textarea2">Possui alguma observação?</label> -->
                            </div>
                        </div>




                        <input type="hidden" name="UploadForm">
                        <div class="container center-align">
                            <button type="submit" class="waves-effect waves-light btn" name="uploadform" value="enviar"><i class="material-icons left" >exit_to_app</i>Enviar</button >
                        </div>
                        <br>
                    </div> 

                </div> 
            </form>   





        </div>
    </div> 





</div>



</div>

</div>




























