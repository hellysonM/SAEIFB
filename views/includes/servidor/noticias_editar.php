<div class="row">
    <div class="col s12 ">
        <div class="card-panel z-depth-2 ">
            <h5>Notícias</h5>
            <div class="divider"></div>
            <br>
            <div class="row ">

                <?php
                
                
                
                $resultado = $servidor->listNoticiaById();
                
                foreach ($resultado as $k)
                
                ?>
                
                <form id="inserir_noticia_form" class="col s12 xl6" method="POST" action="/Servidor/atualizarNoticia">
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">title</i>
                            <input id="titulo" value="<?=$k['Titulo']?>" type="text" class="validate tamanho" data-length="200" name="titulo" required="">
                            <label for="titulo">Título</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">subtitles</i>
                            <input id="subtitulo" type="tel" class="validate tamanho" data-length="500" name="subtitulo" required="" value="<?=$k['Subtitulo']?>">
                            <label for="subtitulo">Subtítulo</label>
                        </div>
                        
                        
                        <div class="input-field col s12">
                            <textarea id="mytextarea"  name="conteudo">
                        <?=$k['Conteudo']?>
                        </textarea>
                        </div>
                    </div>
                    
                    
                <div class="container center-align">

                        <button id="" type="" class="waves-effect waves-light btn green" name="uploadform" value=""><i class="material-icons left"></i>Inserir</button>
                        <button id="voltar" type="" class="waves-effect waves-light btn blue" name="uploadform" >Voltar</button>
                    </div>
                    <input type="hidden" name="id" value="<?=sha1($k['ID'])?>">
                    <input type="hidden" name="autor" value="<?=sha1($k['Autor'])?>">
                </form>
                        
                        <?php ?>
                

                
                
            </div>
        </div>
    </div>
</div>

