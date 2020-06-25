<div class="row">
    <div class="col s12  xl6 offset-xl3">
        <div class="card-panel z-depth-2 ">

            <h5>Seu perfil</h5>
            <div class="divider"></div>
            <br>


            <!-- Dropdown Structure -->
            <ul id="dropdown1" class="dropdown-content">
                <li><a href="#" class="perfil_ajax" id="Senha">Senha</a></li>
                <li class="divider"></li>
                <li><a href="#" class="perfil_ajax" id="Email">E-mail</a></li>
                <li><a href="#" class="perfil_ajax" id="Curso">Curso</a></li>
                
                
            </ul>
            <nav>
                <div class="nav-wrapper blue lighten-1">

                    <ul class="left">
                        <li><a href="">Perfil</a></li>

                        <!-- Dropdown Trigger -->
                        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Preferências<i class="material-icons right">arrow_drop_down</i></a></li>
                    </ul>
                </div>
            </nav>

            <div class="grey lighten-4" id="conteudo">



                <div id="loader" class="hide">
                    <div class="progress">
                        <div class="indeterminate"></div>
                    </div>
                </div>
                    
                


                <div class="row">
                    <div class="col xl4 offset-xl1">
                        <div class="card">
                            <div class="card-image">
                                <img src="/views/img/ifb-1.jpg">
                                <span class="card-title"><?= $_SESSION['nome'] ?></span>
                            </div>
                            <div class="card-content">
                                <p>

                                <div class="row">
                                    
                                    <div class="input-field col s12">
                                        <input disabled value="<?=$_SESSION['email']?>" id="disabled1" type="text" class="validate">
                                        <label for="disabled">E-mail</label>
                                    </div> 
                                    
                                    <div class="input-field col s12">
                                        <input disabled value="<?=$_SESSION['cpf']?>" id="disabled2" type="text" class="validate">
                                        <label for="disabled">CPF</label>
                                    </div>
                                    
                                    <div class="input-field col s12">
                                        <input disabled value="<?=$_SESSION['tipoNome']?>" id="disabled3" type="text" class="validate">
                                        <label for="disabled">Tipo de registro</label>
                                    </div>


                                    
                                </div>
                              
                            </div>
                        </div>
                    </div>















                </div>


            </div>




        </div>
        <div>
        </div>

    </div>
    
</div>