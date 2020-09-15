<?php

class Administrador extends UsuarioAdministrador {

    private $con;
    private $functions;

    public function __construct() {
        
    if (!isset($_SESSION)) {
            
            session_start();
        }

        if(!(isset($_SESSION['tipo'])) || !(isset($_SESSION['login'])) || $_SESSION['tipo'] != 4 || $_SESSION['login'] != 'true'){
            
            header("Location: / ");
            
            exit();
            
        }else{
         
        $this->con = new Connection();
        $this->functions = new Functions();
 
        }
        
        

        
    }

    public function __set($att, $value) {

        $this->$att = $value;
    }

    public function __get($att) {
        return $this->$att;
    }

    
    
  

}