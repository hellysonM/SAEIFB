<?php session_abort();$aluno = new Aluno();?>
<div class="row">
    <div class="col s12 ">
        <div class="row">

            <div class="row">
                <form id="alterar_curso" class="col s12" method="POST" action="/Aluno/AlterarCurso">

                    <div class="col s12">
                        <b>Curso matriculado(é possível selecionar mais de uma opção).</b><br>
                        <b>A mudança de curso só está disponível fora do período de inscrições.</b><br>   
                    </div>

                    <ul class="collapsible popout col s12">
                        <li>
                            <div class="collapsible-header"><i class="material-icons">school</i>Superior</div>
                            <div class="collapsible-body"><span>
                                    <div class="row">

                                        <div class="input-field col s12">
                                            <select  name="Curso1">

                                                <option value="" disabled selected>Curso</option>
                                                <?php
                                              
                                                $resultado = $aluno->listCursoSelectAluno(1);
                                                foreach ($resultado as $curso) {
                                                    ?>
                                                    <option value="<?= $curso['ID'] ?>"><?= $curso['Nome'] ?></option>

                                                <?php } ?>

                                            </select>
                                            <label>Selecionar curso</label>
                                        </div>

                                        <div class="input-field col s12">
                                            <select name="Ingresso1">
                                                <option value="" disabled selected>Ano de ingresso</option>
                                                <option value="2015/1">2015/1</option>
                                                <option value="2015/2">2015/2</option>
                                                <option value="2016/1">2016/1</option>
                                                <option value="2016/2">2016/2</option>
                                                <option value="1">2017/1</option>
                                                <option value="2017/1">2017/2</option>
                                                <option value="2018/1">2018/1</option>
                                                <option value="2018/2">2018/2</option>
                                                <option value="2019/1">2019/1</option>
                                                <option value="2019/2">2019/2</option>
                                                <option value="2020/1">2020/1</option>
                                                <option value="2021/2">2021/2</option>
                                            </select>
                                            <label>Selecionar Ano de ingresso</label>
                                        </div>


                                    </div> 

                                </span></div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">build</i>Técnico</div>
                            <div class="collapsible-body"><span>



                                    <div class="row">

                                        <div class="input-field col s12">
                                            <select  name="Curso2">

                                                <option value="" disabled selected>Curso</option>
                                                <?php
                                                
                                                $resultado = $aluno->listCursoSelectAluno(2);
                                                foreach ($resultado as $curso) {
                                                    ?>
                                                    <option value="<?= $curso['ID'] ?>"><?= $curso['Nome'] ?></option>

                                                <?php } ?>


                                            </select>
                                            <label>Selecionar curso</label>
                                        </div>

                                        <div class="input-field col s12">
                                            <select name="Ingresso2">
                                                <option value="" disabled selected>Ano de ingresso</option>
                                                <option value="1">2015/1</option>
                                                <option value="2">2015/2</option>
                                                <option value="1">2016/1</option>
                                                <option value="2">2016/2</option>
                                                <option value="1">2017/1</option>
                                                <option value="2">2017/2</option>
                                                <option value="1">2018/1</option>
                                                <option value="2">2018/2</option>
                                                <option value="1">2019/1</option>
                                                <option value="2">2019/2</option>
                                                <option value="1">2020/1</option>
                                                <option value="2">2021/2</option>
                                            </select>
                                            <label>Selecionar Ano de ingresso</label>
                                        </div>


                                    </div>         


                                </span></div>
                        </li>

                    </ul>

                    <div class="container center-align">
                        <button type="submit" class="waves-effect waves-light btn blue" ><i class="material-icons left">exit_to_app</i>Alterar</button >
                    </div>


                </form>
            </div>







        </div>




    </div>
    <div>
    </div>

</div>



<script>
  $(document).ready(function(){
    $('select').formSelect();
     $('.collapsible').collapsible();
    
    $('#alterar_curso').submit(function (event) {
        event.preventDefault(); 
        var form = $(this);
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (response) {
                console.log('Submission was successful.');
                console.log(response.mensagem);
                if (response.codigo == 1) {

                    $.confirm({
                        title: 'Houve um erro ao solicitar',
                        content: response.mensagem,
                        type: 'red',
                        typeAnimated: true,
                        buttons: {
                            tryAgain: {
                                text: 'Tentar novamente',
                                btnClass: 'btn-red',
                                action: function () {
                                }
                            },

                        }
                    });
                } else {

                    window.location.href = "/Dashboard/Aluno/Alterado";


                }

            },
            error: function (data) {
                console.log('An error occurred.');

            },
            complete: function () {
                $("#loading").addClass("hide");
            }
        })
    });
 
     
     
     
     
     
     
     
     
     
  });
</script>
