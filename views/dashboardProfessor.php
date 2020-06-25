<?php
$professor = new Professor();
?>
<!DOCTYPE html>
<html>
    <head>     
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo HOME_URL ?>views/css/dashboardProfessor.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>  

        <header>

            <nav>

                <div class="nav-wrapper  blue-grey darken-1">


                    <a data-target="slide-out" class=" sidenav-trigger show-on-large btn-floating btn-large waves-effect waves-light  blue-grey darken-1"><i class="material-icons">menu</i></a>
                      <!-- <a href="#" data-target="slide-out" class="waves-light  sidenav-trigger show-on-large"><i class="material-icons">menu</i></a> -->
                    <a href="/" class="brand-logo center">Sae-IFB</a>



                    <ul id="nav-mobile" class="">






                    </ul>
                </div>
            </nav>
        </header>



        <div class="col s1">
            <ul id="slide-out" class="sidenav ">
                <li><div class="user-view">
                        <div class="background">
                            <img class="responsive-img" src="<?php echo HOME_URL ?>views/img/ifb-1.jpg">
                        </div>
                        <a href="#user"><img class="circle" ></a>
                        <a href="#name"><span class="white-text name"><?= $_SESSION['nome'] ?></span></a>
                        <a href="#email"><span class="white-text email"><?= $_SESSION['tipoNome'] ?></span></a>
                    </div></li>
                <li><a href="/Usuario/Sair"><i class="material-icons">exit_to_app</i>Sair</a></li>
                <li><a href="#!">Configurações<i class="material-icons">settings</i></a></li>
                <li><div class="divider"></div></li>
                <li><a class="subheader">Menu</a></li>
                <li class="no-padding  blue-grey darken-1 " >
                    <ul class=" collapsible collapsible-accordion  ">
                        <li>
                            <a class="collapsible-header white-text waves-effect waves-blue active"><i class="material-icons white-text ">book</i>Aproveitamento de Estudos <i class="material-icons right white-text" style="margin-right:0;">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="/Dashboard/Professor/Solicitacoes">Solicitações<i class="material-icons">event_note</i></a></li>


                                    <li><a href="/Dashboard/Professor/Ajuda">Ajuda<i class="material-icons">help</i></a></li>
                                    <li><div class="divider "></div></li>

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
                        case "Solicitacoes":

                            if (isset(URL[3])) {

                                include 'views/includes/professor/avaliar_solicitacao.php';
                            } else {
                                include 'views/includes/professor/solicitacoes.php';
                            }





                            break;
                    }
                }else {
                    include 'views/includes/dashboard/main.php';
                }
                ?>







            </section>
        </main>


        <footer class="page-footer blue-grey">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Sistema de Aproveitamento de Estudos - IFB </h5>
                        <p class="grey-text text-lighten-4">Com o SAE, o aluno pode realizar digitalmente e acompanhar o processo de aproveitamento de seus estudos do Instituto Federal de Brasília.</p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h4 class="white-text"><b>Dashboard Professor </b>
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
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?php echo HOME_URL ?>views/js/dashboardProfessor.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>



        <script>


<?php
if (isset(URL[2])) {

    switch (URL[2]) {
        case "CompletarRegistro":
            $titulo = "Registre-se como aluno";
            $msg = "Para acessar todos os recursos da plataforma é necessário completar o seu cadastro como aluno.";

            break;


        case "Welcome":
            $titulo = "Bem-vindo";
            $msg = "Seja Bem-vindo ao SAE-IFB, agradecemos o seu registro e esperamos que aproveite o portal :)";

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
