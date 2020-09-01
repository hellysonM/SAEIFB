<?php


class Servidor extends UsuarioAdministrador{
   
        public function __construct() {
        
        
  if (!isset($_SESSION)) {
            
            session_start();
        }

        
        if(!(isset($_SESSION['tipo'])) || !(isset($_SESSION['login'])) || $_SESSION['tipo'] != 5 || $_SESSION['login'] != 'true'){
            
            header("Location: / ");
            
            exit();
            
        }else{
         
        $this->con = new Connection();
        $this->functions = new Functions();
            
        
        }
   
    }
    
    
    
    
    
    
    
    
    
    
    
}




?>
