<?php

class ProfessorController {

    private $professor;

    public function __construct() {

        $this->professor = new Professor();
    }

    public function listarSolicitacaoAction() {

        $this->professor->listSolicitacao();
    }

    public function avaliarSolicitacaoAction() {

        $this->professor->updateSolicitacao(2);
    }

    public function avaliarSolicitacaoDocIncAction() {

        $this->professor->updateSolicitacao(3);
    }

    
     public function PerfilAction(){ 
        
        $this->professor->perfilAjax();
        
    }
}
