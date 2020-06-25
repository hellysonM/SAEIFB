<?php ?>
<!DOCTYPE html>
<html>
    <head>     
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="<?php echo HOME_URL ?>views/css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="<?php echo HOME_URL ?>views/css/inicio.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body> 



        <nav class="teal darken-1">
            <div class="nav-wrapper teal darken-3 " id="menu">
                <a href="#!" class="brand-logo">&nbsp;&nbsp;SAE-IFB</a>                


            </div> 

        </nav>






        <main>

            <br>

            <div class="row">
                <div class="col s4 offset-xl4 ">
                    <div class="card-panel z-depth-2 ">

                        <h5>Autenticar</h5>
                        <div class="divider"></div>
                        <br>


                        <div class="row">
                            <form class="col s12">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">vpn_key</i>
                                        <input id="icon_prefix" type="text" class="validate">
                                        <label for="icon_prefix">Chave de autenticação</label>
                                    </div>
                                 
                                </div>
                                
                                <div class="container center-align">
                                <button class="btn waves-effect waves-light " type="submit" name="action">Submit
                                    <i class="material-icons right">send</i>
                                </button>
                                </div>

                                
                                
                                
                            </form>
                        </div>



                    </div>




                </div>
                <div>
                </div>

            </div>




        </main>  






        <footer class="page-footer teal darken-1">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Sistema de Aproveitamento de Estudos - IFB </h5>
                        <p class="grey-text text-lighten-4">Com o SAE, o aluno pode realizar digitalmente e acompanhar o processo de aproveitamento de seus estudos do Instituto Federal de Brasília.</p>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="white-text">Mapa do Site</h5>
                        <ul>
                            <li><a href="#" data-target="modal1" class="modal-trigger white-text" >- Entrar</a></li>
                            <li><a href="#" data-target="modal2" class="modal-trigger white-text" >- Registre-se</a></li>

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
        
        
        <script>
            
            
            
        
        
        </script>
        
        
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo HOME_URL ?>views/js/materialize.min.js"></script>
        <script type="text/javascript" src="<?php echo HOME_URL ?>views/js/inicio.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    </body>
</html>
