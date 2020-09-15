<?php

class UsuarioController {
    
    private $usuario;

    public function __construct() {
       $this->usuario = new Usuario();       
    }

    public function LogarAction() {
        
        $this->usuario->loginUsuario();
        
    }

    public function RegistrarAction() {

        $this->usuario->insertUsuario();

    }

    public function SairAction() {
        
        $this->usuario->destroySession();
        
    }

    public function registrarAlunoAction() {
        
        $this->usuario->insertAluno();
        
    }
    
    
    public function PerfilAction(){ 
        
        $this->usuario->perfilAjax();
        
    }
    
    public function AlterarSenhaAction(){
        
        $this->usuario->updateSenha();    
    }
    
    public function AlterarEmailAction(){

        $this->usuario->updateEmail();
        
    } 
    
    public function NovaSenhaAction(){
        
        $this->usuario->sendPasswd();
        
    }
            

}
