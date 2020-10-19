<?php

$usuario = new Usuario();



if(URL[1]=="Noticia")
{
    
    $noticia = $usuario->listNoticiaById();
    
}else{
    header("Location: /");
}


?>
<!DOCTYPE html>
<html>
    <head>     
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">  
        <link type="text/css" rel="stylesheet" href="<?php echo HOME_URL ?>/views/css/inicio.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>SAE-IFB</title>
    </head>

    <body> 
        <!-- NAV E SIDENAV -->  
        <nav class="teal darken-1 ">
            <div class="nav-wrapper teal darken-3 z-depth-1" id="menu">
                <a href="<?=HOME_URL?>/" class="brand-logo">&nbsp;&nbsp;SAE-IFB</a>                
                <a href="#" data-target="mobile-navbar" class="sidenav-trigger"><i class="material-icons ">menu</i></a>            
                <ul class="right hide-on-med-and-down">
                    <?php if(isset($_SESSION['login']) && $_SESSION['login']=="true") { ?>
                    <li><a href="<?=HOME_URL?>/" data-target="" class="modal-trigger waves-effect" ><i class="material-icons left">web</i>Dashboard</a></li>
                    <?php } else {?>
                    <?php } ?>
                    
                    <li><a href="#" id="buscar"><i class="material-icons">search</i></a></li>
                    
                </ul>
            </div> 
            <div class="nav-wrapper " id="barra_buscar">
                <form method="POST" action="<?=HOME_URL?>/Portal/Pesquisa">
                    <div class="input-field ">
                        <input id="search" type="search" name="pesquisa" >
                        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                        <i class="material-icons">close</i>
                    </div>
                </form>
            </div>          
        </nav>

        <ul class="sidenav" id="mobile-navbar">
            <?php if(false) { ?>
            <li><a href="#" data-target="modal1" class="modal-trigger waves-effect" ><i class="material-icons left">arrow_drop_down</i>Entrar</a></li>
            <li><a href="#" data-target="modal2" class="modal-trigger waves-effect" ><i class="material-icons left">person_add</i>Cadastre-se</a></li>
            <?php } ?>
            <li>
                <nav>  
                    <div class="nav-wrapper teal">
                        <form method="POST" action="/Portal/Pesquisa">
                            <div class="input-field">
                                <input  type="search"  name="pesquisa" required>
                                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                                <i class="material-icons">close</i>
                            </div>
                        </form>
                    </div>
                </nav>
            </li>
        </ul>

        <!-- MODAL 1 LOGIN  -->  
        <div id="modal1" class="modal">
            <div class="close-modal right ">
                <a href="#" class="modal-close waves-effect  waves-green btn-flat"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-content">
                <h4>Entrar</h4>
                <div class="divider"></div>
                <form action="<?=HOME_URL?>/Usuario/Logar" method="post" id="logar">

                    <div class="input-field">
                        <i class="material-icons prefix">person</i>
                        <input type="text" name="cpf" id="cpf_login" required name="CPF" class="cpf">
                        <label for="cpf_login">CPF</label>
                        <span class="helper-text" data-error="" data-success="">Insira seu CPF</span>
                    </div>

                    <div class="input-field">
                        <i class="material-icons prefix">lock</i>
                        <input type="password" id="senha" required name="senha">
                        <label for="senha">Senha</label>
                        <span class="helper-text" data-error="" data-success="">Insira sua senha</span>

                    </div>
                    <label>
                        <input type="checkbox" class="filled-in" checked="checked" />
                        <span>Manter-me conectado</span>
                    </label>
                    <div class="container center-align">
                        <button type="submit" class="waves-effect waves-light btn" /><i class="material-icons left">exit_to_app</i>Ir
                    </div>
                </form>
                <div class="progress hide" id="loading">
                    <div class="indeterminate"></div>
                </div>

            </div>
            <div class="divider"></div>
            <div class="modal-footer">
                <a href="#" class="waves-effect waves-green btn-flat modal-close" id="esqueceu_senha">Esqueceu sua senha?</a>
            </div>
        </div>   

        <!-- MODAL 2 CADASTRO  --> 
        <div id="modal2" class="modal ">
            <div class="close-modal right ">
                <a href="#!" class="modal-close waves-effect  waves-green btn-flat"><i class="material-icons">close</i></a>
            </div>
            <div class="modal-content">
                <h4>Cadastre-se</h4>
                <div class="divider"></div>
                <form id="cadastrar" class="col s12" method="post" action="<?=HOME_URL?>/Usuario/Registrar">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">face</i>
                        <input type="text" id="nome" name="nome" class="validate" required pattern="[A-Za-zÀ-ú\s]+$"  minlength="2" maxlength="100">
                        <label for="nome">Nome completo</label>
                        <span class="helper-text" data-error="Esse não é um nome válido" data-success="">Seu nome não deve possuir números ou caracteres especiais</span>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">email</i>
                        <input id="email" name="email" type="email" class="validate" required title="This field should not be left blank.">
                        <label for="email">Email</label>
                        <span class="helper-text" data-error="Esse não é um E-mail válido" data-success="">Insira um e-mail válido</span>
                    </div>

                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_box</i>
                        <input type="text" id="numero" name="cpf" class="validate cpf"  pattern="^([0-9]){3}\.([0-9]){3}\.([0-9]){3}-([0-9]){2}$" minlength="" maxlength="" required>
                        <span class="helper-text" data-error="Insira um CPF válido" data-success="">Insira um CPF somente números</span>
                        <label for="numero">CPF</label>
                    </div>

                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">lock</i>
                            <input id="password" name="senha" type="password" class="validate" required minlength="8" maxlength="50">
                            <label for="password">Senha</label>

                            <span class="helper-text" data-error="Insira uma Senha válida com no mínimo 8 caracteres" data-success="">Deve possuir 8 caracteres </span>
                        </div>
                        <div class="input-field col s6">
                            <input id="passwordConfirm" name="senhaConfirm" type="password">
                            <label for="passwordConfirm">Repita</label>
                            <span class="helper-text" data-error="As senhas não coincidem" data-success="">Insira senhas iguais</span>
                        </div>
                    </div>

                    <div class="g-recaptcha" data-sitekey="<?=RECAPT_PUBLIC_KEY?>"></div>


                    <div class="container center-align">
                        <button type="submit" class="waves-effect waves-light btn" ><i class="material-icons left">exit_to_app</i>Cadastrar-se</button >
                    </div>
                </form>
            </div>
            <div class="divider"></div>
            <div class="modal-footer">
                <a href="#!" class="waves-effect waves-green btn-flat">Precisa de ajuda?</a>
            </div>
        </div>

        <!-- SLIDER  --> 



        <!-- SECTION  -->  
        <main>
            <br>
            <div class="row">

                <div class="col xl2 s12">
                    <div class="card-panel z-depth-2">

                        <h4>Portal</h4>

                        <div class="collection">

                            <?php 
                            
                            $retorno = $usuario->listNoticia();
                            
                            foreach ($retorno as $k){
                            
                            ?>                      

                            <a href="<?=HOME_URL?>/Portal/Noticia/<?=$k['Titulo']?>" class="collection-item <?php if(URL[2]==$k['Titulo'])echo"active"?>"><?=$k['Titulo']?></a>

                            <?php } ?>

                        </div>
                    </div>  

                </div>

                <?php
                
                        foreach ($noticia as $k){
                
                ?>
                
                <div class="col xl9 s12 ">
                    <div class="card teal darken-1">
                        <div class="card-content white-text">
                            <span class="card-title"><?=$k['Titulo']?></span>
                            <p><?=$k['Subtitulo']?></p>
                            <br>
                            <div class="divider"></div>
                            
                            <br>
                            <?=$k['Conteudo']?>
                        </div>

                        <div class="card-action">
                            <a href="">Por: <?=strstr($k['Autor'], ' ', true)?> em <?=$k['Data']?></a>

                        </div>
                    </div>
                </div>


                        <?php } ?>

            </div>

        </main>
        <!-- SLIDER  -->
        <footer class="page-footer teal darken-1">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Sistema de Aproveitamento de Estudos - IFB </h5>
                        <p class="grey-text text-lighten-4">Com o SAE, o aluno pode solicitar e acompanhar digitalmente o processo de aproveitamento de estudos no Instituto Federal de Brasília</p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="white-text">Portal do SAE</h5>
                        <ul>
                            
                            <?php if(isset($_SESSION['login']) && $_SESSION['login']=="true") { ?>
                            
                           <li><a href="<?=HOME_URL?>/" data-target="modal1" class="white-text" >- Dashboard</a></li>

                            
                            <?php } else{?>
                      
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    © 2020 SAE-IFB 1.0~beta - Todos os direitos reservados - Melhor visualizado em 1920x1080.

                    <a class="waves-effect waves-light btn-floating social instagram right" href="https://www.instagram.com/ifbrasilia/" target="blank">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a class="waves-effect waves-light btn-floating social instagram right" href="https://twitter.com/ifbnoticias" target="blank">
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a class="waves-effect waves-light btn-floating social instagram right" href="https://www.youtube.com/channel/UC23eWxl4L_Uzx9w8tFDfoEw/featured" target="blank">
                        <i class="fa fa-youtube"></i>
                    </a>

                    <a class="waves-effect waves-light btn-floating social instagram right" href="https://www.facebook.com/IFBrasilia/" target="blank">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <span class="right"><h6>Siga o IFB nas redes &nbsp;&nbsp;</h6></span>

                </div>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>  
        <script type="text/javascript" src="<?php echo HOME_URL ?>/views/js/inicio.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    </body>
</html>