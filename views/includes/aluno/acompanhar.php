<div class="row">
    <div class="col xl6 offset-xl3 s12 ">
        <div class="card-panel z-depth-2 ">
            <h5>Aproveitamento de Estudos</h5>
            <div class="divider"></div>
            <br>
            <?php
            $retorno = $aluno->listAcompanharSolicitacao();
            
            if(count($retorno)==0){
             echo "<h6>Nenhuma solicitação foi realizada.<h6>" ;  
            }
        
            foreach ($retorno as $solicitacao) {
                ?>     
                <ul class="collection">
                    <li class="collection-item avatar">
                        <i class="material-icons circle cyan darken-2">school</i>
                        <span class="title">Curso: <?= $solicitacao['Curso'] ?></span>
                        <p>Ingresso: <?= $solicitacao['Ingresso'] ?><br>
                            Data da solicitação: <?= $solicitacao['Data'] ?>
                        </p>
                        <a href="<?=HOME_URL?>/Dashboard/Aluno/Refazer/<?php echo sha1($solicitacao['AlunoCurso_id']).'/'.sha1($solicitacao['ID']) ?>" class=" cyan secondary-content waves-effect waves-light btn-small">Refazer</a>
                    </li>
                    <div class="col s12" >
                        <ul id="aluno_collapsible" class="collapsible"  >
                            <li>
                                <div class="collapsible-header">
                                    <div class="progress2">
                                        <div class="bar" style="width:<?= $solicitacao['Percent'] ?>%">
                                            <p class="percent"><?= $solicitacao['Percent'] ?>%</p>
                                        </div>
                                    </div>				
                                </div>
                                <div class="collapsible-body">

                                    <div class="row">
                                        <div class="col s8">
                                            <h6><span class="cyan-text text-darken-2">Situação -</span> <b><?= $solicitacao['StatusNome'] ?></b></h6>
                                        </div>
                                        <div class="col s4">
                                            <?php
                                            if ($solicitacao['Status'] == 4 || $solicitacao['Status'] == 6) {

                                                echo '<spam class="cyan-text text-darken-2">Comprovante</spam> <a class="btn-floating btn-small waves-effect waves-light green" onclick="return abrirPopup(\''.HOME_URL.'/Aluno/gerarRelatorio/' . sha1($solicitacao["ID"]) . '  \', 1280, 720) "><i class="material-icons">assignment</i></a>';
                                            }
                                            ?>
                                        </div>    
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </ul>
            <?php } ?>
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
        newwindow.moveTo(left, top);
        newwindow.focus();
        return false;
    }
</script>
























