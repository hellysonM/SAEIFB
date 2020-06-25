<?php

class DashBoardController {

    public function indexAction() {
        
        session_start();

        if (isset($_SESSION['login']) && $_SESSION['login'] == 'true') {

            switch ($_SESSION['tipo']) {
                
                case 1:
            
                    header('location: /Dashboard/Usuario');
                    break;

                case 2:
                    header('location: /Dashboard/Aluno');
                    break;

                case 3:
                    header('location: /Dashboard/Professor');
                    break;

                case 4:
                    header('location: /Dashboard/Admin');
                    break;
            }
        } 
        
        else {
            header("Location: / ");
        }
    }

    public function UsuarioAction() {
        
        $index_view = new View(ABSPATH . '/views/dashboard.php');   
        $index_view->showContents();
        
    }

    public function AdminAction() {
        $index_view = new View(ABSPATH . '/views/dashboardAdmin.php');
        $index_view->showContents();
    }

    public function ProfessorAction() {
        $index_view = new View(ABSPATH . '/views/dashboardProfessor.php');
        $index_view->showContents();
    }

    public function AlunoAction() {

        $index_view = new View(ABSPATH . '/views/dashboardAluno.php');
        $index_view->showContents();
    }

}
