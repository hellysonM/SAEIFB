<div class="row">
    <div class="col s12 ">
        <div class="card-panel z-depth-2 ">
            <h5>Notícias</h5>
            <div class="divider"></div>
            <br>
            <div class="row ">

                <div id="tabela_noticia" class="col s12">
                    <div class="card material-table ">
                        <div class="table-header">
                            <span class="table-title">Lista de Notícias</span>
                            <div class="actions">
                                <a id="inserir_noticia" href="#" class="modal-trigger waves-effect btn-flat nopadding"><i class="material-icons">add_box</i></a>
                                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
                            </div>
                        </div>
                        <table id="noticia" class="centered">
                            <thead>
                                <tr>

                                    <th class="all">Título</th>
                                    <th>Subtítulo</th>
                                    <th>Autor</th>
                                    <th>Data</th>
                                    <th class="all">Editar</th>
                                    <th class="all">Remover</th>
                                 

                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
                
                <form id="inserir_noticia_form" class="col s12 xl6 hide" method="POST" action="/Servidor/inserirNoticia">
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">title</i>
                            <input id="titulo" type="text" class="validate tamanho" data-length="200" name="titulo" required="">
                            <label for="titulo">Título</label>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix">subtitles</i>
                            <input id="subtitulo" type="tel" class="validate tamanho" data-length="500" name="subtitulo" required="">
                            <label for="subtitulo">Subtítulo</label>
                        </div>
                        
                        
                        <div class="input-field col s12">
                            <textarea id="mytextarea"  name="conteudo">
                        Conteúdo
                        </textarea>
                        </div>
                    </div>
                    
                    
                <div class="container center-align">

                        <button id="" type="" class="waves-effect waves-light btn green" name="uploadform" value=""><i class="material-icons left"></i>Inserir</button>
                        <button id="voltar" type="" class="waves-effect waves-light btn blue" name="uploadform" >Voltar</button>
                    </div>
                    
                </form>
                

                
                
            </div>
        </div>
    </div>
</div>

