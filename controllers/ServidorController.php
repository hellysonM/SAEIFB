<?php

class ServidorController {

    private $servidor;

    public function __construct() {

        $this->servidor = new Servidor();
    }

     public function PerfilAction(){ 
        
        $this->servidor->perfilAjax();
        
    }
    
    public function ListarMateriaAction() {

        $this->servidor->listMateria();
    }

    public function inserirMateriaAction() {

        $this->servidor->insertMateria();
    }

    public function deletarMateriaAction() {

        $this->servidor->delMateria();
    }

    public function listarMateriaModalAction() {

        $this->servidor->listMateriaModal();
    }

    public function alterarMateriaAction() {

        $this->servidor->updateMateria();
    }

    public function ListarCursoAction() {

        $this->servidor->listCurso();
    }

    public function DeletarCursoAction() {

        $this->servidor->delCurso();
    }

    public function ListarCursoModalAction() {

        $this->servidor->listCursoModal();
    }

    public function AlterarCursoAction() {

        $this->servidor->updateCurso();
    }

    public function inserirCursoAction() {

        $this->servidor->insertCurso();
    }
    
    
     public function listarSolicitacaoAvaliadaAction() {

        $this->servidor->listSolicitacaoAvaliada();
    }

    public function avaliarSolicitacaoFinalizarAction() {

        $this->servidor->avaliarSolicitacao(4);
    }

    public function avaliarSolicitacaoRetornarProfessorAction() {

        $this->servidor->avaliarSolicitacao(5);
    }

    public function listarSolicitacoesAprovadasAction() {


        $this->servidor->listSolicitacaoAprovada();
    }

    public function gerarRelatorioAction() {

        $this->servidor->functions->gerarPDF("views/includes/servidor/relatorio.php");
    }

    
    
    //CRUD NOTICIA
    
        public function inserirNoticiaAction(){
        
        $this->servidor->insertNoticia("/Dashboard/Servidor/Noticias");
        
    }
    
    public function listarNoticiaAction(){
        
        $this->servidor->listNoticiaTable();
        
    }
    
    public function atualizarNoticiaAction(){
        
        $this->servidor->updateNoticia("/Dashboard/Servidor/Noticias");
    }
    
    public function deletarNoticiaAction(){
        $this->servidor->delNoticia();
        
    }
    
    
}
