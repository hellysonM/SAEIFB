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
                    
                    <h6>Observação fornecida pelo aluno</h6>
                    
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
                        <br>
                        <h6>Componentes curriculares</h6>
                        
                        
                        

                        <table class="highlight centered">
                            <thead>
                              <tr>
                                  <th>Matéria do IFB</th>
                                  <th>Matéria cursada</th>
                                  <th>Deferido</th>
                                  <th>Inc. carga</th>
                                  <th>Inc. conteúdo</th>
                              </tr>
                            </thead>

                            <tbody>
                                
                                
                                <?php
                        $retorno = $professor->listSolicitacaoAvaliar();
                        $count = 1;
                        foreach ($retorno as $materia) {
                            ?>

                                <input type="hidden" name="solicitacao_materia[<?= $count ?>][id]" value="<?= $materia['ID'] ?>" />
                              <tr>
                                <td><?= $materia['Nome'] ?></td>
                                <td><?= $materia['MateriaOrigem'] ?></td>
                                
                                
                                <td>
                                    <label>
                                    <input class="with-gap" name="solicitacao_materia[<?= $count ?>][status]" type="radio" checked value="1" />
                                        <span></span>
                                        </label>
                                </td>
                                <td>
                                    <label>
                                        <input class="with-gap" name="solicitacao_materia[<?= $count ?>][status]" type="radio" value="2" />
                                        <span></span>
                                    </label></td>
                                <td> <label>
                                        <input class="with-gap" name="solicitacao_materia[<?= $count ?>][status]" type="radio" value="3" />
                                        <span></span>
                                    </label></td>
                              </tr>
                        
                          <?php
                            $count++;
                        }
                        ?>
                              
                              
                              
                            </tbody>
                          </table>
                        
                        
                              

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