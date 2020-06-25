<?php
$admin = new Administrador();

$admin->checkSolicitacao(3);

$retorno = $admin->listSolicitacaoDetalhes();

foreach ($retorno[0] as $solicitacao) {

    $nome_aluno = $solicitacao['Nome'];
    $professor = $solicitacao['Professor'];
    $professor_data = $solicitacao['DataProfessor'];
    $curso = $solicitacao['Curso'];
    $data = $solicitacao['Data'];
    $status = $solicitacao['Status'];
}
?>



<div class="row">
    <div class="col xl6 offset-xl3 s12 ">
        <div class="card-panel z-depth-2 ">

            <h5>Solicitação de <b><?= $nome_aluno ?></b> - <span class=""><?= $data ?></span></h5>
            <div class="divider"></div>
            <br>




            <div class="row">
                <div class="col s6">
                    <div class="card-panel grey lighten-5">
                        <span class="card-title"><h5>Curso<i class="material-icons">school</i></h5>
                            <div class="divider"></div>
                        </span>
                        <span class="black-text"><blockquote class="">
                                <b><?= $curso ?></b>
                            </blockquote>
                        </span>
                    </div>
                </div>
                <div class="col s6">
                    <div class="card-panel grey lighten-5">
                        <span class="card-title"><h5>Avaliação do professor<i class="material-icons"></i></h5>
                            <div class="divider"></div>
                        </span>
                        <span class="black-text">
                            <blockquote class="">
                            <b>Professor: <?= $professor ?></b><br>

                        </span>


                        <span class="black-text">
                            <b>Data da avaliação: <spam class="black-text"><?= $data ?></spam></b><Br>

                        </span>

                        <span class="black-text">
                            <b>Status da avaliação : <spam class="black-text"><?php
                                    if ($status == "3") {
                                        echo "Documentação incompleta";
                                    } else {
                                        echo "Avaliado";
                                    }
                                    ?></spam></b>

                        </span>


                    </blockquote>

                    </div>
                </div>

            </div>

            <div class="row">

                <div class="col s12">
                    <div class="card-panel grey lighten-5">
                        <span class="card-title"><h5>Arquivos <i class="material-icons">attach_file</i></h5>

                            <table class="striped blue-grey lighten-4">

                                <thead>
                                    <tr>

                                        <th>Descricao do aluno</th>
                                        <th>Arquivo</th>

                                    </tr>
                                </thead>

                                <?php
                                $retorno = $admin->listSolicitacaoAvaliarArquivos();

                                $id_usuario = $retorno[1];

                                foreach ($retorno[0] as $caminho) {

                                    $caminho_final = "/views/uploads/" . sha1($id_usuario) . "/" . $caminho['Caminho'];
                                    ?>

                                    <tr>
                                        <td>
                                            <?= $caminho['Descricao'] ?>
                                        </td>
                                        <td> <a onclick="return abrirPopup('<?= $caminho_final ?>', 1280, 720)" class="btn-floating btn-small waves-effect waves-light blue"><i class="material-icons">attach_file</i></a>

                                        </td>
                                    </tr>

                                    <?php
                                }
                                ?>

                                </tbody>
                            </table>


                    </div>
                </div>

            </div>




            <div class="row">
                <?php if ($status != "3") { ?>

                    <div class="col s12">
                        <div class="card-panel grey lighten-5">
                            <span class="card-title"><h5>Matérias <i class="material-icons">book</i></h5>

                                <table class="striped  blue-grey lighten-4">

                                    <thead>
                                        <tr>

                                            <th>Matéria IFB</th>
                                            <th>Matéria Origem</th>
                                            <th>Avaliação</th>

                                        </tr>
                                    </thead>

                                    <?php
                                    $retorno = $admin->listSolicitacaoDetalhes();



                                    foreach ($retorno[1] as $materia) {
                                        ?>

                                        <tr>
                                            <td>
                                                <?= $materia['Nome'] ?>
                                            </td>
                                            <td> 
                                                <?= $materia['Origem'] ?>
                                            </td>
                                            <td> 
                                                <?php
                                                if ($materia['Status'] == "1") {

                                                    echo "Deferido";
                                                } else if ($materia['Status'] == "2") {
                                                    echo "Indeferido por carga";
                                                } else {
                                                    echo "Indeferido por conteúdo";
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>




                        </div>


                        <br>
                    <?php } ?>          
                    <div class="container center-align">

                        <button id="finalizar" type="" class="waves-effect waves-light btn green" name="uploadform" value=""><i class="material-icons left"></i>Finalizar</button>
                        <button id="retornar" type="" class="waves-effect waves-light btn blue" name="uploadform" value="">Retornar ao professor</button>
                    </div>


                    <input type="hidden" value="<?= URL[3] ?>" id="url">
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



























