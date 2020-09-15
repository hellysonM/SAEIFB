<?php
$admin = new Administrador();
?>
<!DOCTYPE html>
<html>
    <head>     
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">   
        <link type="text/css" rel="stylesheet" href="<?php echo HOME_URL ?>views/css/dashboardAdmin.css"/>
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
                <div class="nav-wrapper blue darken-1">

                    <a data-target="slide-out" class=" sidenav-trigger show-on-large btn-floating btn-large waves-effect waves-light blue darken-1"><i class="material-icons">menu</i></a>
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
            <li><a href="/Dashboard/Admin/Perfil">Perfil<i class="material-icons">assignment_ind</i></a></li>
            <li><div class="divider"></div></li>
            <li><a href="/">Início<i class="material-icons">home</i></a></li>
            <li class="no-padding blue darken-1 " >
                <ul class=" collapsible collapsible-accordion  ">
                    <li>
                        <a class="collapsible-header white-text waves-effect waves-blue "><i class="material-icons white-text ">book</i>Aproveitamento de Estudos <i class="material-icons right white-text" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="/Dashboard/Admin/Evento">Eventos<i class="material-icons">event</i></a></li>
                                <li><a href="/Dashboard/Admin/NovasSolicitacoes" class="">Novas solicitações<i class="material-icons">assignment_late</i></a></li>
                                <li><a href="/Dashboard/Admin/SolicitacoesAvaliadas">Solicitações avaliadas<i class="material-icons">new_releases</i></a></li>
                                <li><a href="/Dashboard/Admin/Resultados">Resultados<i class="material-icons">event_note</i></a></li>
                                <li><div class="divider"></div></li>

                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="no-padding blue darken " >
                <ul class=" collapsible collapsible-accordion ">
                    <li>
                        <a class="collapsible-header  white-text waves-effect waves-blue "><i class="material-icons white-text ">stars
                            </i>Gerenciar <i class="material-icons right white-text" style="margin-right:0;">arrow_drop_down</i></a>
                        <div class="collapsible-body ">
                            <ul>
                                <li><a href="/Dashboard/Admin/Cursos">Cursos<i class="material-icons">collections_bookmark</i></a></li>
                                <li><a href="/Dashboard/Admin/Materias">Materias<i class="material-icons">layers</i></a></li>
                                <li><a href="/Dashboard/Admin/Usuarios">Usuários<i class="material-icons">person</i></a></li>
                                <li><a href="/Dashboard/Admin/Noticias">Notícias<i class="material-icons">note</i></a></li>               
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
                        case "Usuarios":
                            include 'views/includes/admin/usuarios.php';
                            break;

                        case "Evento" :
                            include 'views/includes/admin/evento.php';
                            break;

                        case "Cursos":

                            include 'views/includes/admin/curso.php';


                            break;
                        
                        case "Perfil":
                            
                      include 'views/includes/admin/perfil.php';
   
                            
                      break;


                        case "SolicitacoesAvaliadas":


                            if (isset(URL[3])) {
                                include 'views/includes/admin/avaliar_solicitacao.php';
                            } else {

                                include 'views/includes/admin/solicitacoes_avaliadas.php';
                            }

                            break;

                        case "Resultados":

                            include 'views/includes/admin/resultados.php';

                            break;

                        case "NovasSolicitacoes":
                            if (isset(URL[3])) {
                                include 'views/includes/admin/avaliar_nova_solicitacao.php';
                            } else {

                                include 'views/includes/admin/novas_solicitacoes.php';
                            }

                            break;

                        case "Materias":
                            include 'views/includes/admin/materia.php';


                            break;


                        case "NovasSolicitacoes":

                            if (isset(URL[3])) {

                                include 'views/includes/professor/avaliar_nova_solicitacao.php';
                            } else {
                                include 'views/includes/professor/novas_solicitacoes.php';
                            }

                            break;

                        case "Noticias":
                            
                            if(isset(URL[3])){
                                
                            include 'views/includes/admin/noticias_editar.php'; 
                                
                            }else{
                             include 'views/includes/admin/noticias.php';
                            }

                            

                            break;
                    }
                } else {

                    include "views/includes/admin/inicio.php";
                }
                ?>







            </section>

        </main>


        <footer class="page-footer blue">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Sistema de Aproveitamento de Estudos - IFB </h5>
                        <p class="grey-text text-lighten-4">Com o SAE, o aluno pode solicitar e acompanhar digitalmente o processo de aproveitamento de estudos no Instituto Federal de Brasília</p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h4 class="white-text"><b>Dashboard Admin</b>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

        <script type="text/javascript" src="<?php echo HOME_URL ?>views/js/dashboardAdmin.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>
       


<?php
if ((isset(URL[2])) && (URL[2] == "Welcome")) {

    echo "
      <script>
      $( document ).ready(function() {      
        $.confirm({

          title: 'Obrigado por se registrar',
          content: 'Você acabou de criar uma conta no SAE IFB, agora você estará apto a entrar no seu DashBoard. Aproveite :)',
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
