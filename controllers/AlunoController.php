<?php

class AlunoController {
    
    private $aluno;
    
    public function __construct() {

        $this->aluno = new Aluno();
    }
    
    public function InserirSolicitacaoAction() {
        
        $this->aluno->checkSolicitacao(2);
        $this->aluno->insertSolicitacao(false);
    }
    
     public function PerfilAction(){

        $this->aluno->perfilAjax();
   
    }
    
    public function RefazerAction(){
       
        $this->aluno->checkSolicitacaoRefazer(3,2); 
        $this->aluno->refazerSolicitacao();
          
    }
    
    public function AlterarSenhaAction(){
        
        $this->aluno->updateSenha();    
    }
    
    public function AlterarEmailAction(){

        $this->aluno->updateEmail();     
    } 
    
    public function NovaSenhaAction(){
        
        $this->aluno->sendPasswd();
        
    }
 
    public function AlterarCursoAction(){
        
        $this->aluno->updateCurso();
        
    }
    
    public function gerarRelatorioAction() {

        $this->aluno->functions->gerarPDF("views/includes/aluno/relatorio.php");
    }

}

?>
