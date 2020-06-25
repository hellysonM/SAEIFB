<?php
$professor = new Professor();

$professor->checkSolicitacao(3);
?>

<div class="row">
    <div class="col xl8 offset-xl2 s12">
        <div class="card-panel z-depth-2 ">
            <h5>Solicitação</h5>
            <div class="divider"></div>
            <br>
            <div class="row ">

                <div id="man" class="col s12 ">

                    <?php $retorno = $professor->listSolicitacaoID(); ?>

                    <table class="">
                        <thead>
                            <tr>
                                <th>Nome do aluno</th>
                                <th>Curso</th>
                                <th>Ingresso</th>
                                <th>Data da solicitação</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    <?= $retorno[0]['Nome'] ?>
                                </td>
                                <td>
                                    <?= $retorno[0]['Curso'] ?>
                                </td>
                                <td>
                                    <?= $retorno[0]['Ingresso'] ?>
                                </td>
                                <td>
                                    <?= $retorno[0]['Data'] ?>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    
                    <br>
                    
                    <h5>Observação</h5>
                    
                    <div class="grey lighten-3 ">
                        <?= $retorno[0]['Obs'] ?>
                    </div>
                    
                    

                </div>

            </div>

        </div>
    </div>

    <div class="col xl8 offset-xl2 s12">
        <div class="card-panel z-depth-2 ">
            <h5>Avaliar</h5>
            <div class="divider"></div>
            <br>
            <div class="row ">

                <div id="man" class="col s12 ">

                    <form method="POST" action="#" id="avaliar_solicitacao" enctype="multipart/form-data">
                        <h6>Arquivos</h6>

                        <table class="striped">

                            <thead>
                                <tr>

                                    <th>Descricao do aluno</th>
                                    <th>Arquivo</th>

                                </tr>
                            </thead>

                            <?php
                            $retorno = $professor->listSolicitacaoAvaliarArquivos();

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
                        <br>

                        <div class="divider"></div>

                        <h6>Materias</h6>
                        <br>
                        <?php
                        $retorno = $professor->listSolicitacaoAvaliar();
                        $count = 1;
                        foreach ($retorno as $materia) {
                            ?>

                            <div class="row">

                                <div class="input-field col s3">
                                    <input disabled value="<?= $materia['Nome'] ?>" id="disabled" type="text" class="validate">
                                    <label for="disabled">Matéria do IFB</label>
                                </div>

                                <div class="input-field col s3">
                                    <input disabled value="<?= $materia['MateriaOrigem'] ?>" id="disabled" type="text" class="validate">
                                    <label for="disabled">Matéria de Origem</label>
                                </div>

                                <input type="hidden" name="solicitacao_materia[<?= $count ?>][id]" value="<?= $materia['ID'] ?>">

                                <div class="input-field col s2">
                                    <label>
                                        <input name="solicitacao_materia[<?= $count ?>][status]" type="radio" checked value="1" />
                                        <span>Deferido</span>
                                    </label>
                                </div>
                                <div class="input-field col s2">
                                    <label>
                                        <input name="solicitacao_materia[<?= $count ?>][status]" type="radio" value="2" />
                                        <span>Indeferido por Carga</span>
                                    </label>

                                </div>
                                <div class="input-field col s2">
                                    <label>
                                        <input class="with-gap" name="solicitacao_materia[<?= $count ?>][status]" type="radio" value="3" />
                                        <span>Indeferido por Conteudo</span>
                                    </label>
                                </div>

                            </div>

                            <?php
                            $count++;
                        }
                        ?>

                        <input type="hidden" value="<?= URL[3] ?>" id="url">

                        <div class="divider">
                        </div>
                        <br>

                    </form>

                    <div class="container center-align">

                        <button id="avaliar" type="" class="waves-effect waves-light btn green" name="uploadform" value=""><i class="material-icons left"></i>Finalizar</button>
                        <button id="documentacao_incompleta" type="submit" class="waves-effect waves-light btn blue-grey darken-1" name="uploadform" value="">documentação incompleta </button>
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