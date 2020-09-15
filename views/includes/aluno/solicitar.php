

<div class="row">
    <div class="col xl6 offset-xl3 s12 ">
        <div class="card-panel z-depth-2 ">

            <h5>Solicitar Aproveitamento de Estudos</h5>
            <div class="divider"></div>
            <br>

            <?php
            //$aluno = new Aluno();
            $retorno = $aluno->checkEvento();
            
            date_default_timezone_set('America/Sao_Paulo');
                $date = date('Y-m-d');
           /*     
           echo $date."<br>";
           
           echo $retorno['DataInicio']."<br>";
           echo $retorno['DataTermino']."<br>";
           */ 
                
                
            
            if($retorno['Finalizado'] == 1){
                
                echo "<h6>Não existe período de solicitações em vigência.</h5>";
                
            }else if(strtotime($date) < strtotime($retorno['DataInicio'])){
                
                echo "<h6>O período de solicitações não foi iniciado.</h5>";
                
            }else if(strtotime($date) >= strtotime($retorno['DataTermino'])){
                
                echo "<h6>O período de solicitações terminou.</h5>";
                
            }else{
            
            ?>
            
            <?php 
            $resultado = $aluno->listCurso();
            
            if(count($resultado)==0){
            
                echo "<h6>Você não possui curso disponível para solicitar aproveitamento.</h6>";
                
            }else{
            ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome do curso</th>
                        <th>Ingresso</th>
                        <th>Solicitar</th>
                    </tr>
                </thead>

                <tbody>
                            
                           

                    <?php
            } 

                    
                    foreach ($resultado as $curso) {
                        ?>
                        <tr>
                            <td><?= $curso['Nome']; ?> </td>
                            <td><?= $curso['Ingresso'] ?></td>
                            <td>  <a class="btn-floating btn-small waves-effect waves-light darken-3 blue" href="/Dashboard/Aluno/Solicitar/<?= sha1($curso['ID']) ?>"><i class="material-icons">add</i></a>
                            </td>
                        </tr>

                    <?php }
                    
                    
            ?>


                </tbody>
            </table>

            <?php } ?>


        </div>         


    </div>



</div>




























