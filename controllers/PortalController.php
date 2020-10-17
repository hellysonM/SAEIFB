<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PortalController{
    
   public function indexAction() {
        
        Usuario::authenticateUsuario();
        
        $index_view = new View(ABSPATH . '/views/portal.php');
        $index_view->showContents();
    }  
    
    public function NoticiaAction() {
        
        Usuario::authenticateUsuario();
        
        $index_view = new View(ABSPATH . '/views/portal.php');
        $index_view->showContents();
    } 
    
    public function PesquisaAction(){
        
        $index_view = new View(ABSPATH . '/views/portal_pesquisa.php');
        $index_view->showContents();  
        
    }
 
    
    
    
    
    
    
    
}