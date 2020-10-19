<?php

class AdminController {

    private $admin;
    
    

    public function __construct() {

        $this->admin = new Administrador();
    }
    
     public function PerfilAction(){ 
        
        $this->admin->perfilAjax();
        
    }
    

    public function ListarUsuariosAction() {

        $this->admin->listUsuario();
    }

    public function ListarMateriaAction() {

        $this->admin->listMateria();
    }

    public function inserirMateriaAction() {

        $this->admin->insertMateria();
    }

    public function deletarMateriaAction() {

        $this->admin->delMateria();
    }

    public function listarMateriaModalAction() {

        $this->admin->listMateriaModal();
    }

    public function alterarMateriaAction() {

        $this->admin->updateMateria();
    }

    public function ListarCursoAction() {

        $this->admin->listCurso();
    }

    public function DeletarCursoAction() {

        $this->admin->delCurso();
    }

    public function ListarCursoModalAction() {

        $this->admin->listCursoModal();
    }

    public function AlterarCursoAction() {

        $this->admin->updateCurso();
    }

    public function inserirCursoAction() {

        $this->admin->insertCurso();
    }

    public function listarUsuarioModalAction() {

        $this->admin->listUsuarioModal();
    }

    public function alterarUsuarioModalAction() {


        $this->admin->updateUsuarioModal();
    }

    public function listarSolicitacaoAvaliadaAction() {

        $this->admin->listSolicitacaoAvaliada();
    }

    public function avaliarSolicitacaoFinalizarAction() {

        $this->admin->avaliarSolicitacao(4);
    }

    public function avaliarSolicitacaoRetornarProfessorAction() {

        $this->admin->avaliarSolicitacao(5);
    }

    public function listarSolicitacoesAprovadasAction() {


        $this->admin->listSolicitacaoAprovada();
    }

    public function gerarRelatorioAction() {

        $this->admin->functions->gerarPDF("views/includes/admin/relatorio.php");
    }

    public function inserirEventoAction() {

        $this->admin->insertEvento();
    }

    public function deletarEventoAction() {

        $this->admin->delEvento();
    }
    
    
    
    //CRUD DO PROFESSOR
    
    public function listarSolicitacaoAction() {

        $this->admin->listSolicitacao();
    }

    public function avaliarSolicitacaoAction() {

        $this->admin->updateSolicitacao(2);
    }

    public function avaliarSolicitacaoDocIncAction() {

        $this->admin->updateSolicitacao(3);
    }
    
    
    //CRUD NOTICIA
    
    
    public function inserirNoticiaAction(){
        
        $this->admin->insertNoticia(HOME_URL."/Dashboard/Admin/Noticias");
        
    }
    
    public function listarNoticiaAction(){
        
        $this->admin->listNoticiaTable();
        
    }
    
    public function atualizarNoticiaAction(){
        
        $this->admin->updateNoticia(HOME_URL."/Dashboard/Admin/Noticias");
    }
    
    public function deletarNoticiaAction(){
        $this->admin->delNoticia();
        
    }

}
