<?php
$servidor = new Servidor();
?>
<!DOCTYPE html>
<html>
    <head>     
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">   
        <link type="text/css" rel="stylesheet" href="<?php echo HOME_URL ?>/views/css/dashboardServidor.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src='https://cdn.tiny.cloud/1/8ppklswk6m1vj83qk7tmvqicbjpqjserh1qr49smf38q5k5o/tinymce/5/tinymce.min.js' referrerpolicy="origin">
            <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css"/>
        </script>
            <script>
                tinymce.init({
                    selector: '#mytextarea'
                });
            </script>
        </head>
        <body>        
            <header>    
                <nav>
                    <div class="nav-wrapper green darken-1">

                        <a data-target="slide-out" class=" sidenav-trigger show-on-large btn-floating btn-large waves-effect waves-light green darken-1"><i class="material-icons">menu</i></a>
                          <!-- <a href="#" data-target="slide-out" class="waves-light  sidenav-trigger show-on-large"><i class="material-icons">menu</i></a> -->
                        <a href="/" class="brand-logo center">Sae-IFB</a>

                        <ul id="nav-mobile" class="">

                        </ul>
                    </div>
                </nav>
            </header>





            <ul id="slide-out" class="sidenav ">
                <li><div class="user-view">
                        <div class="background">
                            <img class="responsive-img" src="<?php echo HOME_URL ?>views/img/ifb-1.jpg">
                        </div>
                        <a href="#user"><img></a>
                        <a href="#name"><span class="white-text name"><?= $_SESSION['nome'] ?></span></a>
                        <a href="#email"><span class="white-text email"><?= $_SESSION['tipoNome'] ?></span></a>
                    </div></li>
                <li><a href="/Usuario/Sair"><i class="material-icons">exit_to_app</i>Sair</a></li>
                <li><a href="/Dashboard/Servidor/Perfil">Perfil<i class="material-icons">assignment_ind</i></a></li>
                <li><div class="divider"></div></li>
                <li><a href="/">Início<i class="material-icons">home</i></a></li>
                <li class="no-padding green darken-1 " >
                    <ul class=" collapsible collapsible-accordion  ">
                        <li>
                            <a class="collapsible-header white-text waves-effect waves-green active"><i class="material-icons white-text ">book</i>Aproveitamento de Estudos <i class="material-icons right white-text arrow-change" style="margin-right:0;">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <ul>


                                    <li><a href="/Dashboard/Servidor/SolicitacoesAvaliadas">Solicitações avaliadas<i class="material-icons">new_releases</i></a></li>
                                    <li><a href="/Dashboard/Servidor/Resultados">Resultados<i class="material-icons">event_note</i></a></li>
                                    <li><div class="divider"></div></li>

                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="no-padding green darken " >
                    <ul class=" collapsible collapsible-accordion ">
                        <li>
                            <a class="collapsible-header  white-text waves-effect waves-green "><i class="material-icons white-text ">stars
                                </i>Gerenciar <i class="material-icons right white-text arrow-change" style="margin-right:0;">arrow_drop_down</i></a>
                            <div class="collapsible-body ">
                                <ul>
                                    <li><a href="/Dashboard/Servidor/Cursos">Cursos<i class="material-icons">collections_bookmark</i></a></li>
                                    <li><a href="/Dashboard/Servidor/Materias">Materias<i class="material-icons">layers</i></a></li>

                                    <li><a href="/Dashboard/Servidor/Noticias">Notícias<i class="material-icons">note</i></a></li>               
                                    <li><div class="divider"></div></li>

                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>  
            </ul>


            <main>  
                <section class="section">

                    <?php
                    if (isset(URL[2])) {
                        switch (URL[2]) {
                            case "Cursos":
                                include 'views/includes/servidor/curso.php';
                                break;

                            case "Perfil":
                                include 'views/includes/servidor/perfil.php';
                                break;

                            case "SolicitacoesAvaliadas":
                                if (isset(URL[3])) {
                                    include 'views/includes/servidor/avaliar_solicitacao.php';
                                } else {

                                    include 'views/includes/servidor/solicitacoes_avaliadas.php';
                                }
                                break;

                            case "Resultados":
                                include 'views/includes/servidor/resultados.php';
                                break;
                            
                            case "Materias":
                                include 'views/includes/servidor/materia.php';
                                break;

                            case "Noticias":

                                if (isset(URL[3])) {
                                    include 'views/includes/servidor/noticias_editar.php';
                                } else {
                                    include 'views/includes/servidor/noticias.php';
                                }
                                break;
                        }
                    } else {

                        include "views/includes/servidor/inicio.php";
                    }
                    ?>







                </section>

            </main>


            <footer class="page-footer green">
                <div class="container">
                    <div class="row">
                        <div class="col l6 s12">
                            <h5 class="white-text">Sistema de Aproveitamento de Estudos - IFB </h5>
                            <p class="grey-text text-lighten-4">Com o SAE, o aluno pode solicitar e acompanhar digitalmente o processo de aproveitamento de estudos no Instituto Federal de Brasília</p>
                        </div>
                        <div class="col l4 offset-l2 s12">
                            <h4 class="white-text"><b>Dashboard Servidor</b>
                            </h4>

                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="container">
                        © 2020 SAE-IFB - Todos os direitos reservados - Melhor visualizado em 1920x1080.








                    </div>
                </div>
            </footer>












            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>  
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="<?php echo HOME_URL ?>/views/js/dashboardServidor.js"></script>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>



            <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>


            <?php
            if ((isset(URL[3])) && (URL[3] == "Alterado")) {

                echo "
      <script>
      $( document ).ready(function() {      
        $.confirm({

          title: 'Concluido',
          content: 'Seus dados foram atualizados',
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
      </script>
      ";
            }
            ?>        





        </body>
    </html>
