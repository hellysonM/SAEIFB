<?php

class Aluno extends Usuario {

    private $curso;
    private $matricula;
    private $id_usuario;

    public function __construct() {
        
      if (!isset($_SESSION)) {
          
            session_start();
        }        
        
        if(isset($_SESSION['tipo']) && isset($_SESSION['login']) && $_SESSION['tipo'] == 1 && $_SESSION['login'] == 'true' ){
            
         header("Location: /Dashboard/Usuario/CompletarRegistro ");
         exit();
            
        }
        else if(!(isset($_SESSION['tipo'])) || !(isset($_SESSION['login'])) || $_SESSION['tipo'] != 2 || $_SESSION['login'] != 'true'){
            
            header("Location: / ");
            
            exit();
            
        }else{
         
 
        $this->con = new Connection();
        $this->functions = new Functions();
            
        
        }
        
        

        
    }

    public function checkEvento() {
        $query = $this->con->con()->prepare("SELECT  evento.Finalizado,evento.DataInicio,evento.DataTermino FROM evento order by id desc limit 1");

        $query->execute();
        $retorno = $query->fetch();

        return $retorno;
    }

    public function listCurso() {

        $query = $this->con->con()->prepare("SELECT curso.Nome,aluno_curso.Ingresso,aluno_curso.ID FROM `curso` INNER JOIN aluno_curso ON curso.ID = aluno_curso.IDCurso WHERE aluno_curso.IDAluno = (SELECT aluno.ID FROM aluno WHERE aluno.IDUsuario = :id)
           && aluno_curso.Status = '0' && aluno_curso.StatusAntigo = '0' ");
        $query->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetchAll();

        return $retorno;
    }

    public function checkSolicitacao($n) {

        $retorno = $this->checkEvento();

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d');

        if ($retorno['Finalizado'] == 1) {

            header("Location: / ");
            exit();
        } else if (strtotime($date) < strtotime($retorno['DataInicio'])) {

            header("Location: / ");
            exit();
        } else if (strtotime($date) >= strtotime($retorno['DataTermino'])) {

            header("Location: / ");
            exit();
        } else {

            $id = URL[$n];

            $queryValidarURL = $this->con->con()->prepare("select aluno_curso.ID from aluno_curso WHERE (sha1(aluno_curso.ID) = :id1) && (aluno_curso.IDAluno = (SELECT aluno.ID FROM aluno WHERE aluno.IDUsuario = :id2))");
            $queryValidarURL->bindParam(":id1", $id, PDO::PARAM_STR);
            $queryValidarURL->bindParam(":id2", $_SESSION['id'], PDO::PARAM_INT);
            $queryValidarURL->execute();
            $retorno = $queryValidarURL->fetchAll();

            if (count($retorno) != 1) {
                header("Location: / ");
                exit();
            };
        }
    }

    public function listCursoSolicitacao() {   
        
        $url = URL[3];

        $query = $this->con->con()->prepare("SELECT curso.Nome,aluno_curso.Ingresso FROM `curso` INNER JOIN aluno_curso ON curso.ID = aluno_curso.IDCurso WHERE sha1(aluno_curso.ID) = :id");


     
        $query->bindParam(":id", $url, PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetch();

        return $retorno;
    }

    public function listMateriaSolicitao() {
        
    }

    public function listSemestreCurso() {

        $query = $this->con->con()->prepare("SELECT curso.Semestres FROM `curso` JOIN aluno_curso on curso.ID = aluno_curso.IDCurso WHERE sha1(aluno_curso.ID) = :id
");


        $url = URL[3];
        $query->bindParam(":id", $url, PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetch();

        return $retorno;
    }

    public function listMateriaSemestre($semestre) {

        $query = $this->con->con()->prepare("SELECT materia.Nome,materia.ID from materia INNER JOIN curso on materia.IDCurso = curso.ID INNER JOIN aluno_curso ON curso.ID = aluno_curso.IDCurso WHERE sha1(aluno_curso.ID) = :id && materia.Semestre = :semestre");


        $url = URL[3];
        $query->bindParam(":id", $url, PDO::PARAM_STR);
        $query->bindParam(":semestre", $semestre, PDO::PARAM_INT);
        $query->execute();
        $retorno = $query->fetchAll();

        return $retorno;
    }

    public function insertSolicitacao() {



        $id_aluno_curso = URL[2];



        $query = $this->con->con()->prepare("SELECT ID FROM aluno_curso where sha1(ID) = :id ");
        $query->bindParam(":id", $id_aluno_curso, PDO::PARAM_STR);

        $query->execute();
        $retorno = $query->fetch();

        $id_aluno_curso = $retorno[0];




        $query = $this->con->con()->prepare("UPDATE aluno_curso set aluno_curso.Status = '1' where ID = :id");
        $query->bindParam(":id", $id_aluno_curso, PDO::PARAM_INT);

        $query->execute();




        $data = $this->functions->dataAtual();

        $query = $this->con->con()->prepare("INSERT INTO `solicitacao` (`IDAluno_curso`,`Observacao`,`Data`) values (:id,:observacao,:data)");
        $query->bindParam(":id", $id_aluno_curso, PDO::PARAM_INT);
        $query->bindParam(":observacao", $_POST['Obs'], PDO::PARAM_STR);
        $query->bindParam(":data", $data, PDO::PARAM_STR);
        $query->execute();





        $query = $this->con->con()->prepare("SELECT ID FROM `solicitacao` where IDAluno_curso = :id ORDER BY `ID` DESC LIMIT 1");
        $query->bindParam(":id", $id_aluno_curso, PDO::PARAM_INT);

        $query->execute();
        $retorno = $query->fetch();



        $id_solicitacao = $retorno[0];






        if (isset($_POST['materia'])) {

            foreach ($_POST['materia'] as $materia) {


                if (!empty($materia['origem'])) {



                    $query = $this->con->con()->prepare("INSERT INTO `solicitacao_materia` (`IDMateria`,`MateriaOrigem`,`IDSolicitacao`) values (:id,:origem,:idsol)");
                    $query->bindParam(":id", $materia['ifb'], PDO::PARAM_INT);
                    $query->bindParam(":origem", $materia['origem'], PDO::PARAM_STR);
                    $query->bindParam(":idsol", $id_solicitacao, PDO::PARAM_INT);
                    $query->execute();
                }
            }
        }


        //ENVIO DE ARQUIVOSSSSSSSSSSSSSSSSS    


        /*


          if (isset($_POST['UploadForm'])) {
          echo 'post =<br>' ;
          print_r($_POST);
          echo '<br>files =<br>' ;
          print_r($_FILES);
          echo '<hr>' ;
          echo 'nbr files to upload = ' . (count($_FILES['fileToUpload']['name']['file']));
          echo '<br>' ;
          print_r($_FILES['fileToUpload']);
          echo '<br>' ;
          print_r($_FILES['fileToUpload']['error']['file']);
          echo '<hr>' ;
          // die();
          }
          // ********************************************************
         */

        if (isset($_POST['UploadForm']) && count($_FILES['fileToUpload']['tmp_name']['file']) == 0) {



            $retorno = array('codigo' => 1, 'mensagem' => 'Você não enviou nenhum arquivo');
            echo json_encode($retorno);


            return 0;
        }

        if (isset($_POST['UploadForm']) && count($_FILES['fileToUpload']['tmp_name']['file']) > 0) {


            $valid_formats = array("pdf");
// $valid_formats = array("rar","zip","7z","pdf","xlsx","xls","docx","doc", "ppt", "txt", "jpeg", "jpg", "png", "gif",);
            $valid_formats_server = array(
                "application/pdf",
//	"application/octet-stream",
//	"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
//	"application/vnd.openxmlformats-officedocument.wordprocessingml.document",
//	"application/msword",
//	"application/vnd.ms-excel",
//	"application/nd.ms-powerpoint",
//	"text/plain"
            );

//prevent uploading of wrong file types 
            foreach ($_FILES['fileToUpload']['type']['file'] as $t => $Type) {
                if (!in_array($_FILES['fileToUpload']['type']['file'][$t], $valid_formats_server)) {


                    $retorno = array('codigo' => 1, 'mensagem' => 'Arquivo em formato inválido. Somente são aceitos arquivos em PDF');
                    echo json_encode($retorno);



                    return 0;
                }
            }




            $target_dir = "views/uploads/" . sha1($_SESSION['id']) . "/";

// create upload directory if it doesn't already exist
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $max_file_size = 10 * 1024 * 1024; //5MB
            $count = 0; // nbr of successfully uploaded files
            $filenames = ''; //names of successfully uploaded files
            $files = count($_FILES['fileToUpload']['name']['file']); // number of files to upload
//paaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
// UPLOAD EACH FILE
// loop thru all files
            foreach ($_FILES['fileToUpload']['name']['file'] as $f => $name) {
                if ($_FILES['fileToUpload']['error']['file'][$f] == 4) {

                    //$message[] = $_FILES['fileToUpload']['error'][$f];

                    $retorno = array('codigo' => 1, 'mensagem' => 'erro 4');
                    echo json_encode($retorno);


                    // Skip file if any error found, go to next file in loop
                    continue;
                }
                if ($_FILES['fileToUpload']['size']['file'][$f] > $max_file_size) {
                    $message[] = "$name is too large!";
                    $retorno = array('codigo' => 1, 'mensagem' => 'Seu arquivo excedeu o limite de 10mb');
                    echo json_encode($retorno);
                    return;
                } elseif (!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats)) {

                    $retorno = array('codigo' => 1, 'mensagem' => 'Formato inválido');
                    echo json_encode($retorno);

                    return;
                } else { // No error found! Move uploaded files
                    // rename file to remove unsafe characters
                    $rename = preg_replace('`[^a-z0-9-_.]`i', '_', basename($name));

                    $rename = md5(time() . $rename) . '.pdf';


                    //Get the temp file path
                    $tmpFilePath = $_FILES['fileToUpload']['tmp_name']['file'][$f];

                    // from the form input, file to be uploaded
                    $target_file = $target_dir . $rename;

                    $fileURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . "/uploads/" . $_SESSION['id'] . "/" . $rename;

                    //$fileURL = str_replace("index.php?page=","",$fileURL);
                    // UPLOAD THE FILE
                    // if the destination file already exists, it will be overwritten
                    if (move_uploaded_file($tmpFilePath, $target_file)) {
                        $count++; // counting successful uploads
                        $filenames .= ', ' . $rename;

                        $descricao = $_POST['fileToUpload']['description'][$f];






                        $query = $this->con->con()->prepare("INSERT INTO `arquivo_solicitacao` (`IDSolicitacao`,`Caminho`,`Descricao`) values (:id,:caminho,:descri)");
                        $query->bindParam(":id", $id_solicitacao, PDO::PARAM_INT);
                        $query->bindParam(":caminho", $rename, PDO::PARAM_STR);
                        $query->bindParam(":descri", $descricao, PDO::PARAM_STR);
                        $query->execute();
                    }
                }
            }

            $retorno = array('codigo' => 0, 'mensagem' => 'Solicitação realizada com sucesso!');
            echo json_encode($retorno);
        }
    }

    public function insertFile() {
        
    }

    public function listAcompanharSolicitacao() {


        $id_usuario = $_SESSION['id'];


        $query = $this->con->con()->prepare("SELECT aluno_curso.ID as AlunoCurso_id,aluno_curso.Ingresso,solicitacao.status as Status,solicitacao_status.Nome as StatusNome,solicitacao_status.Porcentagem as Percent,solicitacao.ID as ID,curso.ID as CursoID,curso.Nome as Curso,(select usuario.nome from usuario where id = solicitacao.IDProfessor) Professor,DATE_FORMAT(solicitacao.DataProfessor, '%d/%m/%Y %H:%i:%S') as DataProfessor,DATE_FORMAT(solicitacao.Data, '%d/%m/%Y %H:%i:%S') as Data FROM solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID INNER JOIN usuario ON aluno.IDUsuario = usuario.ID inner JOIN curso ON aluno_curso.IDCurso = curso.ID inner JOIN solicitacao_status ON solicitacao.Status = solicitacao_status.ID where usuario.ID = :id");
        $query->bindParam(":id", $id_usuario, PDO::PARAM_INT);
        $query->execute();
        $retorno = $query->fetchAll();


        return $retorno;
    }
    
    
    
    public function checkSolicitacaoRefazer($n1,$n2){
        
        $retorno = $this->checkEvento();

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d');

        if ($retorno['Finalizado'] == 1) {

            header("Location: / ");
            exit();
        } else if (strtotime($date) < strtotime($retorno['DataInicio'])) {

            header("Location: / ");
            exit();
        } else if (strtotime($date) >= strtotime($retorno['DataTermino'])) {

            header("Location: / ");
            exit();
        } else {
            
            
            $id = URL[$n1];
            $id2 = URL[$n2];

            $queryValidarURL = $this->con->con()->prepare("select aluno_curso.IDAluno from aluno_curso inner join solicitacao on aluno_curso.ID = solicitacao.IDAluno_curso inner JOIN aluno ON aluno_curso.IDAluno = aluno.ID inner join usuario on aluno.IDUsuario = usuario.ID where usuario.ID = :id2 && sha1(solicitacao.ID) = :id1 && sha1(aluno_curso.ID) = :id3");
            $queryValidarURL->bindParam(":id1", $id, PDO::PARAM_STR);
             $queryValidarURL->bindParam(":id3", $id2, PDO::PARAM_STR);
            $queryValidarURL->bindParam(":id2", $_SESSION['id'], PDO::PARAM_INT);
            $queryValidarURL->execute();
            $retorno = $queryValidarURL->fetchAll();

            if (count($retorno) != 1) {
                header("Location: / ");
                exit();
            };
            
          
            
            
        }
        
        
    }
    
    
    public function refazerSolicitacao(){
        
        $id = URL[3];
        
        $query = $this->con->con()->prepare("DELETE FROM solicitacao where sha1(id) = :id");
        $query->bindParam(":id", $id, PDO::PARAM_STR);
      
        $query->execute();
        
        
        $this->insertSolicitacao();
        
        
    }
    
    public function updateCurso(){
        $retorno = $this->checkEvento();
        
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d');
        

        if(strtotime($date) > strtotime($retorno['DataInicio']) && strtotime($date) <= strtotime($retorno['DataTermino']) && $retorno['Finalizado'] == 0) {
             
            $retorno = array('codigo' => 1, 'mensagem' => 'Você não pode alterar seu curso enquanto no período de inscrições');
            echo json_encode($retorno);

            exit();
        } 
        


        else{


        if ((empty($_POST['Curso1'])) && (empty($_POST['Curso2']))) {

            $retorno = array('codigo' => 1, 'mensagem' => 'Selecione pelo menos um curso');
            echo json_encode($retorno);
            return 0;
        } else if ((!empty($_POST['Curso1'])) && (empty($_POST['Curso2']))) {


            if (empty($_POST['Ingresso1'])) {
                $retorno = array('codigo' => 1, 'mensagem' => 'Selecione o ano de ingresso do curso superior');
                echo json_encode($retorno);
                return 0;
            } else {
                $val = true;
                $curso = $_POST['Curso1'];
                $ingresso = $_POST['Ingresso1'];
            }
        } else if ((empty($_POST['Curso1'])) && (!empty($_POST['Curso2']))) {


            if (empty($_POST['Ingresso2'])) {
                $retorno = array('codigo' => 1, 'mensagem' => 'Selecione o ano de ingresso do curso técnico');
                echo json_encode($retorno);
                return 0;
            } else {

                $val = true;
                $curso = $_POST['Curso2'];
                $ingresso = $_POST['Ingresso2'];
            }
        } else {

            if (empty($_POST['Ingresso1'])) {
                $retorno = array('codigo' => 1, 'mensagem' => 'Selecione o ano de ingresso do curso superior ');
                echo json_encode($retorno);
                return 0;
            } else if (empty($_POST['Ingresso2'])) {
                $retorno = array('codigo' => 1, 'mensagem' => 'Selecione o ano de ingresso do curso técnico');
                echo json_encode($retorno);
                return 0;
            } else {
                $val = false;
            }
        }

        $queryIDAluno = $this->con->con()->prepare("SELECT `ID` from `aluno` where `IDUsuario` = :idusuario ");

        $queryIDAluno->bindParam(":idusuario", $_SESSION['id'], PDO::PARAM_INT);
        $queryIDAluno->execute();
        $resultado = $queryIDAluno->fetch();
        
        
        $id_del = $resultado[0];
        
        
        
        $query = $this->con->con()->prepare("UPDATE aluno_curso SET StatusAntigo = '1' where IDAluno = :idusuario");
        $query->bindParam(":idusuario", $id_del, PDO::PARAM_INT);
        $query->execute();
        

        if ($val) {
            $query = $this->con->con()->prepare("INSERT INTO `aluno_curso` (`IDAluno`, `IDCurso`, `Ingresso`) VALUES (:idaluno, :curso, :ingresso)");
            $query->bindParam(":idaluno", $resultado[0], PDO::PARAM_STR);
            $query->bindParam(":curso", $curso, PDO::PARAM_STR);
            $query->bindParam(":ingresso", $ingresso, PDO::PARAM_STR);
            $query->execute();
        } else {
            $query = $this->con->con()->prepare("INSERT INTO `aluno_curso` (`IDAluno`, `IDCurso`, `Ingresso`) VALUES (:idaluno, :curso1, :ingresso1),(:idaluno, :curso2, :ingresso2)");

            $query->bindParam(":idaluno", $resultado[0], PDO::PARAM_STR);
            $query->bindParam(":curso1", $_POST['Curso1'], PDO::PARAM_STR);

            $query->bindParam(":ingresso1", $_POST['Ingresso1'], PDO::PARAM_STR);
            $query->bindParam(":curso2", $_POST['Curso2'], PDO::PARAM_STR);
            $query->bindParam(":ingresso2", $_POST['Ingresso2'], PDO::PARAM_STR);


            $query->execute();
        }


        $retorno = array('codigo' => 0, 'mensagem' => 'Sucesso');

        echo json_encode($retorno);
        return 0;
        
        }
        }
        
        
        public function perfilAjax(){
            
            if(URL[2]=="Email"){
            
        $index_view = new View(ABSPATH . '/views/includes/aluno/perfil/email.php');
        $index_view->showContents();
        
        }else if(URL[2]=="Senha"){
            
        $index_view = new View(ABSPATH . '/views/includes/aluno/perfil/senha.php');
        $index_view->showContents();
        
        }else if(URL[2]=="Curso"){
            
          
        $index_view = new View(ABSPATH . '/views/includes/aluno/perfil/curso.php');
        $index_view->showContents();
        
        }
        }
        
        public function aproveitamentoPDF() {




        $id_solicitacao = URL[2];


        $query = $this->con->con()->prepare("SELECT solicitacao.ID as ID,usuario.Nome as Nome,aluno_curso.Ingresso as Ingresso,usuario.CPF as CPF,aluno.Matricula as Matricula,curso.Nome as Curso,(select usuario.nome from usuario where id = solicitacao.IDServidor) Servidor,(select usuario.nome from usuario where id = solicitacao.IDProfessor) Professor,DATE_FORMAT(solicitacao.DataProfessor, '%d/%m/%Y %H:%i:%S') as DataProfessor,DATE_FORMAT(solicitacao.DataServidor, '%d/%m/%Y %H:%i:%S') as DataServidor,DATE_FORMAT(solicitacao.Data, '%d/%m/%Y %H:%i:%S') as Data,solicitacao.Status as Status FROM solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID INNER JOIN usuario ON aluno.IDUsuario = usuario.ID inner JOIN curso ON aluno_curso.IDCurso = curso.ID where sha1(solicitacao.ID) = :id");
        $query->bindParam(":id", $id_solicitacao, PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetchAll();






        $query = $this->con->con()->prepare("SELECT materia.Nome as Nome,solicitacao_materia.MateriaOrigem as Origem,solicitacao_materia.Status as Status FROM solicitacao INNER JOIN solicitacao_materia on solicitacao_materia.IDSolicitacao = solicitacao.ID inner join materia on solicitacao_materia.IDMateria = materia.ID WHERE sha1(solicitacao.ID) = :id
");
        $query->bindParam(":id", $id_solicitacao, PDO::PARAM_STR);
        $query->execute();
        $retorno_materias = $query->fetchAll();

        foreach ($retorno_materias as $row) {

            if ($row['Status'] == 1) {
                $row['StatusNome'] = "Deferido";
            } elseif ($row['Status'] == 2) {
                $row['StatusNome'] = "Indeferido por Carga";
            } elseif ($row['Status'] == 3) {
                $row['StatusNome'] = "Indeferido por conteúdo";
            } else {
                $row['StatusNome'] = "Erro";
            }
        }





        return array($retorno, $retorno_materias);
    }
        
    }