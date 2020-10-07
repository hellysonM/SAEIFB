<div class="">
        <br>  
        <div class="container center-align white-text ">
            <div class="section ">
                <div class="slider ">
                    <ul class="slides">

                        <?php 
                        
                        $usuario = new Usuario();               
                        $resultado = $usuario->listNoticia();
             
                        foreach ($resultado as $k){
                        ?>
                        <li>
                        <img src="" class='teal lighten-2 responsive-img'> 
                            <div class="caption center-align">
                                <h3 ><a class="white-text" href="/Portal/Noticia/<?=$k['Titulo']?>"><?=$k['Titulo']?></a></h3>
                              <h5 class="light teal-text text-darken-2"><?=$k['Subtitulo']?></h5>
                            </div>
                        </li>
                        <?php } ?>
                        
                    </ul>
                </div>
            </div>
        </div>
        <br>
    </div>