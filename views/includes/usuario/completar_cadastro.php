
<div class="row">
    <div class="col xl4 offset-xl4 s12 ">
        <div class="card-panel z-depth-2 ">

            <h5>Registrar-se como aluno</h5>
            <div class="divider"></div>
            <br>
            <div class="row">
                <form id="inserir_aluno" class="col s12" method="POST" action="<?=HOME_URL?>/Usuario/RegistrarAluno">

                    <div class="col s12">
                        Curso matriculado(é possível selecionar mais de uma opção)   
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
                                              
                                                $resultado = $usuario->listCursoSelectAluno(1);
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
                                                <option value="2017/1">2017/1</option>
                                                <option value="2017/1">2017/2</option>
                                                <option value="2018/1">2018/1</option>
                                                <option value="2018/2">2018/2</option>
                                                <option value="2019/1">2019/1</option>
                                                <option value="2019/2">2019/2</option>
                                                <option value="2020/1">2020/1</option>
                                                <option value="2020/2">2020/2</option>
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
                                                
                                                $resultado = $usuario->listCursoSelectAluno(2);
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
                                                <option value="2015/1">2015/1</option>
                                                <option value="2015/2">2015/2</option>
                                                <option value="2016/1">2016/1</option>
                                                <option value="2016/2">2016/2</option>
                                                <option value="2017/1">2017/1</option>
                                                <option value="2017/2">2017/2</option>
                                                <option value="2018/1">2018/1</option>
                                                <option value="2018/2">2018/2</option>
                                                <option value="2019/1">2019/1</option>
                                                <option value="2019/2">2019/2</option>
                                                <option value="2020/1">2020/1</option>
                                                <option value="2020/2">2020/2</option>
                                            </select>
                                            <label>Selecionar Ano de ingresso</label>
                                        </div>
                                    </div>         
                                </span></div>
                        </li>
                    </ul>

                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_box</i>
                        <input type="text" id="numero" name="Matricula" class="validate"  pattern="[0-9]+$" minlength="12" maxlength="12" required>
                        <span class="helper-text" data-error="Matrícula incorreta. A matrícula possui 12 números" data-success="">Insira sua matricula</span>
                        <label for="numero">Matricula</label>
                    </div>    

                    <div class="input-field col s12">
                        <i class="material-icons prefix">call</i>
                        <input type="text" id="telefone" name="Telefone"  required>
                        <span class="helper-text" data-error="Insira um numero válido" data-success="">Insira seu telefone de contato</span>
                        <label for="telefone">Telefone</label>
                    </div> 

                    <div class="container center-align">
                        <button type="submit" class="waves-effect waves-light btn" ><i class="material-icons left">exit_to_app</i>Cadastrar-se</button >
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div>
    </div>
</div>