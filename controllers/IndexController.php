<?php

class IndexController {

    public function indexAction() {
        
        Usuario::authenticateUsuario();
        
        $index_view = new View(ABSPATH . '/views/inicio.php');
        $index_view->showContents();
    }

}

?>
