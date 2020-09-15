<?php
$aluno = new Aluno();
?>
<!DOCTYPE html>
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="<?php echo HOME_URL ?>views/css/teste.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link type="text/css" rel="stylesheet" href="<?php echo HOME_URL ?>views/css/dashboardAluno.css"/>
        <link rel="stylesheet" href="https://unpkg.com/materialize-stepper@3.1.0/dist/css/mstepper.min.css">

    </head>
    <body>
        <header>
            <nav>
                <div class="nav-wrapper  cyan darken-1">
                    <a data-target="slide-out" class=" sidenav-trigger show-on-large btn-floating btn-large waves-effect waves-light  cyan darken-1"><i class="material-icons">menu</i></a>
                    <!-- <a href="#" data-target="slide-out" class="waves-light  sidenav-trigger show-on-large"><i class="material-icons">menu</i></a> -->
                    <a href="/" class="brand-logo center">Sae-IFB</a>
                    <ul id="nav-mobile" class="">
                    </ul>
                </div>
            </nav>
            <!--<div class="progress" style="position: absolute">
                <div class="indeterminate"></div>-->
            </div>
        </header>
        <div class="col s1">
            <ul id="slide-out" class="sidenav ">
                <li>
                    <div class="user-view">
                        <div class="background">
                            <img class="responsive-img" src="<?php echo HOME_URL ?>views/img/ifb-1.jpg">
                        </div>
                        <a href="#user"><img class="circle"></a>
                        <a href="#name"><span class="white-text name"><?= $_SESSION['nome'] ?></span></a>
                        <a href="#email"><span class="white-text email"><?= $_SESSION['tipoNome'] ?></span></a>
                    </div>
                </li>
                <li><a href="/Usuario/Sair"><i class="material-icons">exit_to_app</i>Sair</a></li>
                <li><a href="/Dashboard/Aluno/Perfil">Perfil<i class="material-icons">assignment_ind</i></a></li>
                <li>
                    <div class="divider"></div>
                </li>
                <li><a class="subheader">Menu</a></li>
                <li class="no-padding  cyan darken-1 " >
                    <ul class=" collapsible collapsible-accordion  ">
                        <li>
                            <a class="collapsible-header white-text waves-effect waves-blue active"><i class="material-icons white-text ">book</i>Aproveitamento de Estudos <i class="material-icons right white-text arrow-change" style="margin-right:0;">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="/Dashboard/Aluno/Solicitar">Solicitar<i class="material-icons">event_note</i></a></li>
                                    <li><a href="/Dashboard/Aluno/Acompanhar">Acompanhar<i class="material-icons">date_range</i></a></li>
                                    <li><a href="/Dashboard/Aluno/Ajuda">Ajuda<i class="material-icons">help</i></a></li>
                                    <li><a href="/Dashboard/Aluno/ProjetoPedagogico">Planos de Curso<i class="material-icons">school</i></a></li>
                                   
                                    <li>
                                        <div class="divider "></div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Dropdown Structure -->
        <main>
            
           
            
            <section class="section">
                
                <?php
                if (isset(URL[2])) {

                    switch (URL[2]) {
                        case "Solicitar":

                            if (isset(URL[3])) {

                                include 'views/includes/aluno/solicitar_curso.php';
                            } else {
                                include 'views/includes/aluno/solicitar.php';
                            }

                            break;

                        case "Acompanhar":

                            include 'views/includes/aluno/acompanhar.php';

                            break;
                        case "Perfil":

                            include 'views/includes/aluno/perfil.php';

                            break;

                        case "Refazer":

                            include 'views/includes/aluno/refazer.php';

                            break;
                        
                        case "Ajuda":

                            include 'views/includes/aluno/ajuda.php';

                            break;
                        
                        case "ProjetoPedagogico":

                            include 'views/includes/aluno/planos_de_curso.php';

                            break;

                        case "Welcome":
                            include 'views/includes/aluno/inicio.php';

                            break;

                        case "Alterado":
                            include 'views/includes/aluno/inicio.php';

                            break;
                    }
                } else {
                    include 'views/includes/aluno/inicio.php';
                }
                ?>

            </section>
        </main>


        <footer class="page-footer  cyan lighten-1">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Sistema de Aproveitamento de Estudos - IFB </h5>
                        <p class="grey-text text-lighten-4">Com o SAE, o aluno pode solicitar e acompanhar digitalmente o processo de aproveitamento de estudos no Instituto Federal de Brasília</p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="white-text">Mapa do Site</h5>
                        <ul>
                            <li><a href="/Dashboard/aluno/Solicitar" class="modal-trigger white-text" >- Solicitar aproveitamento</a><br></li> 
                            
                            <li><a href="/Dashboard/aluno/ProjetoPedagogico" class="modal-trigger white-text" >- Planos de ensino</a></li>
                            <li><a href="/Dashboard/aluno/Acompanhar" class="modal-trigger white-text" >- Acompanhar</a> </li>
                           
                            <li><a href="/Dashboard/aluno/Ajuda" class="modal-trigger white-text" >- Ajuda</a></li>


                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    © 2020 SAE-IFB - Todos os direitos reservados - Melhor visualizado em 1920x1080.




                    <a class="waves-effect waves-light btn-floating social instagram right  cyan" href="https://www.instagram.com/ifbrasilia/" target="blank">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a class="waves-effect waves-light btn-floating social instagram right  cyan" href="https://twitter.com/ifbnoticias" target="blank">
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a class="waves-effect waves-light btn-floating social instagram right  cyan" href="https://www.youtube.com/channel/UC23eWxl4L_Uzx9w8tFDfoEw/featured" target="blank">
                        <i class="fa fa-youtube"></i>
                    </a>

                    <a class="waves-effect waves-light btn-floating social instagram right  cyan" href="https://www.facebook.com/IFBrasilia/" target="blank">
                        <i class="fa fa-facebook"></i>
                    </a>

                    <span class="right"><h6>Siga o IFB nas redes &nbsp;&nbsp;</h6></span>




                </div>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="https://unpkg.com/materialize-stepper@3.1.0/dist/js/mstepper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script type="text/javascript" src="<?php echo HOME_URL ?>views/js/dashboardAluno.js"></script> 
        <script>
<?php
if (isset(URL[2])) {

    switch (URL[2]) {
        case "Alterado":
            $titulo = "Alteração realizada";
            $msg = "Sua solicitação foi realizada com êxito, relogue para aplicá-las";

            break;

        case "Welcome":
            $titulo = "Bem-vindo aluno!";
            $msg = "Agora você está apto a acessar todas as funcionalidades da plataforma, esperamos que você goste.";

            break;
    }

    echo "

  $( document ).ready(function() {
  $.confirm({

  title: '{$titulo}',
  content: '{$msg}',
  type: 'green',
  typeAnimated: true,
  buttons: {
  tryAgain: {
  text: 'Entendi',
  btnClass: 'btn-green',
  action: function(){
  }
  }
  }
  });
  });

  ";
}
?>





        </script>
    </body>
</html>