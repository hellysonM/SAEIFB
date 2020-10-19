<?php

class Usuario {

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $cpf;
    private $dataCadastro;
    private $dataUltimoLogin;
    private $logado;
    private $ip;
    private $tipo;
    private $con;
    private $functions;

    public function __construct() {

        if(!isset($_SESSION)) 
           session_start();
        
        $this->con = new Connection();
        $this->functions = new Functions();
        
        
    }
    
    public static function authenticateUsuario(){
        session_start();
        if (isset($_SESSION['login']) && $_SESSION['login'] == 'true' && URL[0]!="Portal") {
            header("Location:".HOME_URL."/Dashboard ");
        }
    }
    
    public static function isRegularUsuario(){
        
        if(!(isset($_SESSION['tipo'])) || !(isset($_SESSION['login'])) || $_SESSION['tipo'] != 1 || $_SESSION['login'] != 'true'){
            
            header("Location:".HOME_URL." / ");
            
            exit();     
        }   
    }

    public function __set($att, $value) {

        $this->$att = $value;
    }

    public function __get($att) {
        return $this->$att;
    }

    public function insertUsuario() {

        try {
            if (!isset($_POST['nome']) || !isset($_POST['email']) || !isset($_POST['cpf']) || !isset($_POST['senha'])) {
                header("Location:".HOME_URL." /");
                return 0;
            }
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
            "secret=".RECAPT_PRIVATE_KEY."&response=".$_POST['g-recaptcha-response']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec($ch);
            curl_close ($ch);

            $resposta = json_decode($server_output);

            if(($resposta->{'success'})!=true){
                $retorno = array('codigo' => 1, 'mensagem' => 'A verificação recaptcha está incorreta ou foi expirada.');
                echo json_encode($retorno);
                return 0;
            }
            
            $this->nome = filter_var($_POST['nome'],FILTER_SANITIZE_STRING);
            $this->email = $_POST['email'];
            $this->cpf = $_POST['cpf'];
            $this->senha = filter_var($_POST['senha'],FILTER_SANITIZE_STRING);

            $this->senha = sha1($this->senha);
            $this->cpf = $this->functions->validaCPF($this->cpf);

            if($this->senha!=sha1($_POST['senhaConfirm'])){
                $retorno = array('codigo' => 1, 'mensagem' => 'As senhas não coincidem.');
                echo json_encode($retorno);
                return 0;
            }

            if (!(filter_var($this->email, FILTER_VALIDATE_EMAIL)) || !(preg_match('/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/', $this->nome)) || !(preg_match('/^[0-9]{11}$/', $this->cpf))
            ) {

                $retorno = array('codigo' => 1, 'mensagem' => 'Alteração na integridade do formulário');
                echo json_encode($retorno);
                return 0;
            }

            $queryValidarNome = $this->con->con()->prepare("SELECT `nome` from `usuario` where `Nome` = :nome");
            $queryValidarNome->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $queryValidarNome->execute();

            $retorno = $queryValidarNome->fetchAll();
            if (count($retorno) > 0) {
                $retorno = array('codigo' => 1, 'mensagem' => 'Já existe um usuário registrado com esse nome');
                echo json_encode($retorno);
                return 0;
            }

            $queryValidarEmail = $this->con->con()->prepare("SELECT `nome` from `usuario` where `Email` = :email");
            $queryValidarEmail->bindParam(":email", $this->email, PDO::PARAM_STR);
            $queryValidarEmail->execute();

            $retorno = $queryValidarEmail->fetchAll();
            if (count($retorno) > 0) {
                $retorno = array('codigo' => 1, 'mensagem' => 'Já existe um usuário registrado com esse E-mail');
                echo json_encode($retorno);
                return 0;
            }

            $queryValidarCPF = $this->con->con()->prepare("SELECT `nome` from `usuario` where `CPF` = :cpf");
            $queryValidarCPF->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
            $queryValidarCPF->execute();
            $retorno = $queryValidarCPF->fetchAll();
            if (count($retorno) > 0) {
                $retorno = array('codigo' => 1, 'mensagem' => 'Já existe um usuário registrado com esse CPF');
                echo json_encode($retorno);
                return 0;
            }

            $this->dataCadastro = $this->functions->dataAtual();

            $query = $this->con->con()->prepare("INSERT INTO `usuario` (`Nome`, `Email`, `Senha`, `CPF` , `DataRegistro`) VALUES (:nome, :email, :senha,:cpf ,:dataCadastro);");
            $query->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $query->bindParam(":email", $this->email, PDO::PARAM_STR);
            $query->bindParam(":senha", $this->senha, PDO::PARAM_STR);
            $query->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
            $query->bindParam(":dataCadastro", $this->dataCadastro, PDO::PARAM_STR);
            $query->execute();
            
            $this->loginUsuario();
            
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function insertAluno() {

        $queryValidarMatricula = $this->con->con()->prepare("SELECT `Matricula` from `aluno` where `Matricula` = :matricula");
        $queryValidarMatricula->bindParam(":matricula", $_POST['Matricula'], PDO::PARAM_STR);
        $queryValidarMatricula->execute();

        $retorno = $queryValidarMatricula->fetchAll();
        if (count($retorno) > 0) {
            $retorno = array('codigo' => 1, 'mensagem' => 'Já existe um usuário registrado com essa matricula');
            echo json_encode($retorno);
            return 0;
        }

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
        
        $query = $this->con->con()->prepare("INSERT INTO `aluno` (`IDUsuario`,`Telefone`,`Matricula`) VALUES (:idusuario, :telefone, :matricula)");
        $query->bindParam(":idusuario", $_SESSION['id'], PDO::PARAM_STR);
        $query->bindParam(":telefone", $_POST['Telefone'], PDO::PARAM_STR);
        $query->bindParam(":matricula", $_POST['Matricula'], PDO::PARAM_STR);
        $query->execute();
        
        $tipo = 2;
        $query = $this->con->con()->prepare("UPDATE usuario set `Tipo`= :tipo where ID = :id  ");
        $query->bindParam(":tipo", $tipo, PDO::PARAM_INT);
        $query->bindParam(":id", $_SESSION['id'], PDO::PARAM_INT);

        $_SESSION['tipo'] = 2;

        $query->execute();
        
        $queryIDAluno = $this->con->con()->prepare("SELECT `ID` from `aluno` where `IDUsuario` = :idusuario ");

        $queryIDAluno->bindParam(":idusuario", $_SESSION['id'], PDO::PARAM_INT);
        $queryIDAluno->execute();
        $resultado = $queryIDAluno->fetch();

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

    public function loginUsuario() {

        try {
            
            if (!isset($_POST['cpf']) || !isset($_POST['senha'])) {
                header("Location:".HOME_URL." /");
                return 0;
            }
            
            $this->cpf = $_POST['cpf'];
            $this->senha = sha1($_POST['senha']);

            $this->cpf = $this->functions->validaCPF($this->cpf);

            $query = $this->con->con()->prepare("SELECT `ID`, `Email`,`Nome`,`CPF`,`Tipo` FROM `usuario` WHERE `CPF` = :cpf AND `Senha` = :senha;");

            $query->bindParam(":senha", $this->senha, PDO::PARAM_STR);
            $query->bindParam(":cpf", $this->cpf, PDO::PARAM_STR);
            $query->execute();

            if ($query->rowCount() == 0) {

                $retorno = array('codigo' => 1, 'mensagem' => 'Nome de usuário ou senha incorretos');
                echo json_encode($retorno);
            } else {
                
                $resultado = $query->fetch();

                $_SESSION['login'] = 'true';
                $_SESSION['nome'] = $resultado['Nome'];
                $_SESSION['email'] = $resultado['Email'];
                $_SESSION['cpf'] = $resultado['CPF'];
                $_SESSION['id'] = $resultado['ID'];
                $_SESSION['tipo'] = $resultado['Tipo'];

                if ($resultado['Tipo'] == '1') {
                    $_SESSION['tipoNome'] = "Usuário";
                } else if ($resultado['Tipo'] == '2') {
                    $_SESSION['tipoNome'] = "Aluno";
                    
                } else if ($resultado['Tipo'] == '3') {
                    $_SESSION['tipoNome'] = "Professor";
                    
                }
                else if ($resultado['Tipo'] == '4') {
                    $_SESSION['tipoNome'] = "Administrador";
                    
                }else {
                    $_SESSION['tipoNome'] = "Servidor";        
                }

                $retorno = array('codigo' => 0, 'mensagem' => 'Logado com sucesso');
                echo json_encode($retorno);
            }
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function logoutUsuario() {
        session_unset();
        session_destroy();
        header("Location:".HOME_URL." / ");
    }

    public function statusUsuario($logado) {

        try {
            $this->dataUltimoLogin = $this->functions->dataAtual();
            $this->ip = $this->functions->IP();
            $this->logado = $logado;
            $this->id = $_SESSION['id'];

            $query = $this->con->con()->prepare("UPDATE `usuario` SET `IP` = :IP, `DataUltimoLogin` = :DataUltimoLogin
            ,`Logado` = :Logado where `ID` = :id");
            $query->bindParam(":IP", $this->ip, PDO::PARAM_STR);
            $query->bindParam(":DataUltimoLogin", $this->dataUltimoLogin, PDO::PARAM_STR);
            $query->bindParam(":Logado", $this->logado, PDO::PARAM_STR);
            $query->bindParam(":id", $this->id, PDO::PARAM_INT);

            $query->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    
    public function listCursoSelectAluno($tipo) {

        $query = $this->con->con()->prepare("SELECT ID,Nome from `curso` where Tipo = $tipo");

        $query->execute();
        $retorno = $query->fetchAll();

        return $retorno;
    }
    
    public function updateEmail(){
   
        if (!(filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL))) {

                $retorno = array('codigo' => 1, 'mensagem' => 'Alteração na integridade do formulário');
                echo json_encode($retorno);
                return 0;
         }

         else if($_POST['Email']!=$_POST['Email2']){
            $retorno = array('codigo' => 1, 'mensagem' => 'Seus e-mails não coincidem');
            echo json_encode($retorno);
            return 0;
        }
         
         $queryValidarEmail = $this->con->con()->prepare("SELECT `nome` from `usuario` where `Email` = :email");
            $queryValidarEmail->bindParam(":email", $_POST['Email'], PDO::PARAM_STR);
            $queryValidarEmail->execute();

            $retorno = $queryValidarEmail->fetchAll();
            if (count($retorno) > 0) {
                $retorno = array('codigo' => 1, 'mensagem' => 'Já existe um usuário registrado com esse E-mail');
                echo json_encode($retorno);
                return 0;
            }
         
        else{
            
        $queryValidarMatricula = $this->con->con()->prepare("UPDATE usuario set  Email = :email where ID = :id");
        $queryValidarMatricula->bindParam(":email", $_POST['Email'], PDO::PARAM_STR);
        $queryValidarMatricula->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
        $queryValidarMatricula->execute(); 
         
        $_SESSION['email'] = $_POST['Email'];
        
        $retorno = array('codigo' => 0, 'mensagem' => 'Sucesso');
                echo json_encode($retorno);
                return 0;
        
        }
           
    }

    public function updateSenha(){
        
        $queryValidarSenha = $this->con->con()->prepare("Select Senha from usuario where id  = :id");
       
        $queryValidarSenha->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
        $queryValidarSenha->execute(); 
        $retorno = $queryValidarSenha->fetch();
        
        if(sha1($_POST['senha_atual'])!=$retorno[0]){
            
            $retorno = array('codigo' => 1, 'mensagem' => 'Sua Senha atual está incorreta');
            echo json_encode($retorno);
            return 0;
 
        }
        else if($_POST['nova_senha']!=$_POST['nova_senha2']){
            $retorno = array('codigo' => 1, 'mensagem' => 'Suas novas senhas não coincidem');
            echo json_encode($retorno);
            return 0;
        }
        else{
            
          $senha =   sha1($_POST['nova_senha']);
          $queryValidarSenha = $this->con->con()->prepare("UPDATE usuario set Senha = :senha where ID = :id");
       
        $queryValidarSenha->bindParam(":id", $_SESSION['id'], PDO::PARAM_STR);
        $queryValidarSenha->bindParam(":senha", $senha, PDO::PARAM_STR);
        $queryValidarSenha->execute();  
            
        $retorno = array('codigo' => 0, 'mensagem' => 'Senha alterada');
            echo json_encode($retorno);
            return 0;
            
        } 
    }
    
    public function sendPasswd(){
        
       $senha = $this->functions->geraSenha(8, true, false);
       $senha_sha1 = sha1($senha);
       
       $email =   $_POST['email'];
       
        $query = $this->con->con()->prepare("UPDATE usuario set Senha = :senha where Email = :email");
       
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->bindParam(":senha", $senha_sha1, PDO::PARAM_STR);
        $query->execute();

     $query = $this->con->con()->prepare("Select Nome from usuario where Email = :email");
       
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        
        $query->execute();   
        $nome = $query->fetch();
        
        $nome = $nome[0];
    
        $assunto = "Nova senha";
        $corpo = "<h1>Nova Senha gerada</h1>Olá $nome, uma nova senha foi gerada para você: <strong>$senha</strong>.";
    
        $this->functions->sendMail($email,$corpo,$assunto);
    
    
        $retorno = array('codigo' => 0, 'mensagem' => 'Sua nova senha foi enviada ao seu E-mail com sucesso');
            echo json_encode($retorno);
            return 0;
 
   }  
   
   public function destroySession() {
        session_destroy();
        header("Location:".HOME_URL."/");
    }

    
    public function perfilAjax(){
        
            if (URL[2] == "Email") {
            $index_view = new View(ABSPATH . '/views/includes/usuario/perfil/email.php');
            $index_view->showContents();
        } else if (URL[2] == "Senha") {
            $index_view = new View(ABSPATH . '/views/includes/usuario/perfil/senha.php');
            $index_view->showContents();
        }
    }
    
    public function listNoticia(){
        
         $query = $this->con->con()->prepare("select usuario.Nome,noticia.ID,noticia.Titulo,noticia.Subtitulo,noticia.Conteudo,DATE_FORMAT(noticia.Data, '%d/%m/%Y %H:%i:%S') as Data from noticia INNER JOIN usuario on noticia.Autor= usuario.ID
        order by id desc limit 5");
        
         //$query->bindValue(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetchAll();
        
        return $retorno;
  
    }
    
    public function listNoticiaById(){
        
        $titulo = URL[2];
        
        $query = $this->con->con()->prepare("select usuario.Nome as Autor,noticia.ID,noticia.Titulo,noticia.Subtitulo,noticia.Conteudo,DATE_FORMAT(noticia.Data, '%d/%m/%Y %H:%i') as Data from noticia INNER JOIN usuario on noticia.Autor= usuario.ID
        where Titulo = :titulo");
        
         $query->bindValue(':titulo', $titulo ,PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetchAll();
   
        if(count($retorno)!= 1){
            header("Location: ".HOME_URL." /");
        }
 
        return $retorno;
    }
    
    public function listNoticiaPesquisa(){
        
        $pesquisa = filter_var($_POST['pesquisa'],FILTER_SANITIZE_STRING);
        
         $query = $this->con->con()->prepare("select usuario.Nome,noticia.ID,noticia.Titulo,noticia.Subtitulo,noticia.Conteudo,DATE_FORMAT(noticia.Data, '%d/%m/%Y %H:%i:%S') as Data from noticia INNER JOIN usuario on noticia.Autor= usuario.ID
         where Titulo like :pesquisa order by id desc limit 5");
        
        $query->bindValue(':pesquisa', $pesquisa, PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetchAll();
   
        return $retorno;
    }

}
