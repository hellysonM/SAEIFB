<?php 
$usuario=new Usuario();
$usuario::isRegularUsuario();
?>
<!DOCTYPE html>
<html>
   <head>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <link type="text/css" rel="stylesheet" href="<?php echo HOME_URL ?>views/css/dashboard.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   </head>
   <body>
      <header>
         <nav>
            <div class="nav-wrapper teal darken-1">
               <a data-target="slide-out" class=" sidenav-trigger show-on-large btn-floating btn-large waves-effect waves-light teal darken-1"><i class="material-icons">menu</i></a>
               <!-- <a href="#" data-target="slide-out" class="waves-light  sidenav-trigger show-on-large"><i class="material-icons">menu</i></a> -->
               <a href="/" class="brand-logo center">Sae-IFB</a>
               <ul id="nav-mobile" class="">
               </ul>
            </div>
         </nav>
      </header>
      <div class="col s1">
         <ul id="slide-out" class="sidenav ">
            <li>
               <div class="user-view">
                  <div class="background">
                     <img class="responsive-img" src="<?php echo HOME_URL ?>views/img/ifb-1.jpg">
                  </div>
                  <a href="#user"><img class="circle"></a>
                  <a href="#name"><span class="white-text name"><?=$_SESSION['nome'] ?></span></a>
                  <a href="#email"><span class="white-text email"><?=$_SESSION['tipoNome'] ?></span></a>
               </div>
            </li>
            <li><a href="/Usuario/Sair"><i class="material-icons">exit_to_app</i>Sair</a></li>
            <li><a href="/Dashboard/Usuario/Perfil">Perfil<i class="material-icons">assignment_ind</i></a></li>
            <li>
               <div class="divider"></div>
            </li>
            <li><a class="subheader">Menu</a></li>
            <li class="no-padding teal darken-1 " >
               <ul class=" collapsible collapsible-accordion">
                  <li>
                     <a class="collapsible-header white-text waves-effect waves-blue active"><i class="material-icons white-text ">book</i>Aproveitamento de Estudos <i class="material-icons right white-text arrow-change" style="margin-right:0;">arrow_drop_down</i></a>
                     <div class="collapsible-body">
                        <ul>
                           <li><a href="/Dashboard/Aluno/Solicitar">Solicitar<i class="material-icons">event_note</i></a></li>
                           <li><a href="/Dashboard/Aluno/Acompanhar">Acompanhar<i class="material-icons">date_range</i></a></li>
                           <li><a href="/Dashboard/Aluno/Plano_de_ensino">Planos de Ensino<i class="material-icons">library_books</i></a></li>
                           <li><a href="/Dashboard/Aluno/Ajuda">Ajuda<i class="material-icons">help</i></a></li>
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
                  case "CompletarRegistro":
                      include 'views/includes/usuario/completar_cadastro.php';
                      break;
                  case "Perfil":
                      include 'views/includes/usuario/perfil.php';
                      break;
                  
                  case "Welcome":
                      
                      include 'views/includes/usuario/inicio.php';
                      break;
                  
                   case "Alterado":
                      
                      include 'views/includes/dashboard/main.php';
                      break;
                  
                  
              }
          }else{
          include 'views/includes/usuario/inicio.php';    
              
          }
          ?>
      </section>
      </main>
      
      
      
       <footer class="page-footer teal darken-1">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                  <h5 class="white-text">Sistema de Aproveitamento de Estudos - IFB </h5>
                  <p class="grey-text text-lighten-4">Com o SAE, o aluno pode solicitar e acompanhar digitalmente o processo de aproveitamento de estudos no Instituto Federal de Brasília</p>
                </div>
                <div class="col l4 offset-l2 s12">
                  <h5 class="white-text">Mapa do Site</h5>
                  <ul>
                    <li><a href="CompletarRegistro" class="modal-trigger white-text" >- Solicitar</a> <a href="CompletarRegistro" class="modal-trigger white-text" >- Planos de ensino</a></li>
                    <li><a href="CompletarRegistro" class="modal-trigger white-text" >- Acompanhar</a> <a href="CompletarRegistro" class="modal-trigger white-text" >- Ajuda</a></li>
                    
                  </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
            © 2020 SAE-IFB - Todos os direitos reservados - Melhor visualizado em 1920x1080.
            
            
           
            
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
      <script type="text/javascript" src="<?php echo HOME_URL ?>views/js/dashboard.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
      <script>
         <?php 
            if(isset(URL[2])){
                
               
              
                switch(URL[2]){
                    case "CompletarRegistro":
                        $titulo = "Registre-se como aluno";
                        $msg = "Para acessar todos os recursos da plataforma é necessário completar o seu cadastro como aluno.";
                        
                        break;
                    
                    
                    case "Welcome":
                        $titulo = "Bem-vindo";
                        $msg = "Seja Bem-vindo ao SAE-IFB, agradecemos o seu registro e esperamos que aproveite o portal :)";
                        
                        break;
                    
                    case "Alterado":
                        
                        $titulo = "Solicitação de mudança";
                        $msg = "Sua solicitação foi realizada com sucesso,relogue para aplicá-las";
                        
                        break;
                        
                            
                }
                
                echo "
                
              $( document ).ready(function() {      
                $.confirm({
            
                  title: '${titulo}',
                  content: '${msg}',
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