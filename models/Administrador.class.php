<?php

class Administrador extends Usuario {

    private $con;
    private $functions;

    public function __construct() {
        
    if (!isset($_SESSION)) {
            
            session_start();
        }


        if(!(isset($_SESSION['tipo'])) || !(isset($_SESSION['login'])) || $_SESSION['tipo'] != 4 || $_SESSION['login'] != 'true'){
            
            require_once ABSPATH.'lib/includes/404.php';
            
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

    public function listUsuario() {

        ## Read value
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();

        ## Search 
        $searchQuery = " ";
        if ($searchValue != '') {
            $searchQuery = " AND (Nome LIKE :Nome or 
                Email LIKE :Email OR 
                CPF LIKE :CPF ) ";
            $searchArray = array(
                'Nome' => "%$searchValue%",
                'Email' => "%$searchValue%",
                'CPF' => "%$searchValue%"
            );
        }

        ## Total number of records without filtering
        $stmt = $this->con->con()->prepare("SELECT COUNT(*) AS allcount FROM usuario ");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        ## Total number of records with filtering
        $stmt = $this->con->con()->prepare("SELECT COUNT(*) AS allcount FROM usuario WHERE 1 " . $searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $stmt = $this->con->con()->prepare("SELECT * FROM usuario WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

        // Bind values
        foreach ($searchArray as $key => $search) {
            $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        $data = array();



        foreach ($empRecords as $row) {

            if ($row['Tipo'] == 1) {
                $row['Tipo'] = "Usuario";
            } elseif ($row['Tipo'] == 2) {
                $row['Tipo'] = "Aluno";
            } elseif ($row['Tipo'] == 3) {
                $row['Tipo'] = "Professor";
            } else {
                $row['Tipo'] = "Administrador";
            }

            $data[] = array(
                //"ID"=>$row['ID'],
                "Nome" => $row['Nome'],
                //"Senha"=>$row['Senha'],
                "Email" => $row['Email'],
                "CPF" => $row['CPF'],
                "DataRegistro" => $row['DataRegistro'],
                "DataUltimoLogin" => $row['DataUltimoLogin'],
                "Logado" => $row['Logado'],
                "IP" => $row['IP'],
                "Tipo" => $row['Tipo'],
                "Alterar" => '<a href="#" id="' . $row["ID"] . '" class="modal-trigger alterar_usuario" data-target="modal"><i class="material-icons">&nbspcreate</i></a>',
            );
        }




        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }

    public function insertEvento() {


        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $datainicio = $_POST['data_inicio'];
        $datatermino = $_POST['data_fim'];

        $query = $this->con->con()->prepare("UPDATE evento set Finalizado =  1");
        $query->execute();
        
        $query = $this->con->con()->prepare("UPDATE aluno_curso set Status =  '0' ");
        $query->execute();

        $query = $this->con->con()->prepare("INSERT INTO `evento` (`Nome`, `Descricao`, `DataInicio`, `DataTermino`) VALUES (:nome, :descricao, :datainicio,:datatermino);");
        $query->bindParam(":nome", $nome, PDO::PARAM_STR);
        $query->bindParam(":descricao", $descricao, PDO::PARAM_STR);
        $query->bindParam(":datainicio", $datainicio, PDO::PARAM_STR);
        $query->bindParam(":datatermino", $datatermino, PDO::PARAM_STR);

        $query->execute();
        
        
        header("Location: /Dashboard/Admin/Evento");
    }
    
    
    public function listEvento() {

        $var = '0';

        $query = $this->con->con()->prepare("SELECT * from `evento` where `Finalizado` = :finalizado");
        $query->bindParam(":finalizado", $var, PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetchAll();

        return $retorno;
    }
    
    
    public function delEvento(){
        
        $id = URL[2];
        
        $query = $this->con->con()->prepare("UPDATE evento set Finalizado =  1");
        $query->bindParam(":id", $id, PDO::PARAM_STR);
        $query->execute();
        
        header("Location: /Dashboard/Admin/Evento");
        
        
    }
    
    
    
    

    public function statusEvento() {


        $var = '0';

        $query = $this->con->con()->prepare("SELECT `Nome` from `evento` where `Finalizado` = :finalizado");
        $query->bindParam(":finalizado", $var, PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetchAll();
        if (count($retorno) > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    

    public function listCurso() {


        ## Read value
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();

        ## Search 
        $searchQuery = " ";
        if ($searchValue != '') {
            $searchQuery = " AND (Curso.Nome LIKE :Nome) ";
            $searchArray = array(
                'Nome' => "%$searchValue%",
            );
        }

        ## Total number of records without filtering
        $stmt = $this->con->con()->prepare("SELECT COUNT(*) AS allcount FROM curso ");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        ## Total number of records with filtering
        $stmt = $this->con->con()->prepare("SELECT COUNT(*) AS allcount FROM curso WHERE 1 " . $searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $stmt = $this->con->con()->prepare("SELECT COUNT(materia.ID) as Numero_materias,curso.Nome,curso.ID,curso.Semestres,curso.Tipo,curso.Descricao from curso LEFT JOIN materia on curso.ID = materia.IDCurso  WHERE 1 " . $searchQuery . " GROUP BY curso.Nome ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

        // Bind values
        foreach ($searchArray as $key => $search) {
            $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        $data = array();



        foreach ($empRecords as $row) {

            if ($row['Tipo'] == 1) {
                $row['Tipo'] = "Superior";
            } elseif ($row['Tipo'] == 2) {
                $row['Tipo'] = "Tecnico";
            }
            /* elseif($row['Tipo'] == 3){
              $row['Tipo'] = "Professor";
              }else{
              $row['Tipo'] = "Administrador";
              }
             */
            $data[] = array(
                "Nome" => $row['Nome'],
                "Descricao" => $row['Descricao'],
                "Numero_materias" => $row['Numero_materias'],
                "Semestres" => $row['Semestres'],
                "Tipo" => $row['Tipo'],
                "Excluir" => '<a href="#" id="' . $row["ID"] . '" class="excluir" ><i class="material-icons">delete</i></a>',
                "Alterar" => '<a href="#" id="' . $row["ID"] . '" class="modal-trigger alterar" data-target="modal3"><i class="material-icons">create</i></a>'
            );
        }




        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }

    public function listCursoModal() {

        $query = $this->con->con()->prepare("SELECT Nome,Descricao from `curso` where ID = :id");


        $query->bindValue(':id', $_POST['ID'], PDO::PARAM_INT);
        $query->execute();
        $retorno = $query->fetch();



        echo json_encode($retorno);
    }

    public function listCursoSelect() {

        $query = $this->con->con()->prepare("SELECT ID,Nome from `curso`");

        $query->execute();
        $retorno = $query->fetchAll();

        return $retorno;
    }

    

    public function insertCurso() {

        $query = $this->con->con()->prepare("INSERT INTO `curso` (`Nome`,`Descricao`,`Tipo`,`Semestres`) values (:nome,:descricao,:tipo,:semestres) ");

        $query->bindParam(":nome", $_POST['Nome'], PDO::PARAM_STR);
        $query->bindParam(":descricao", $_POST['Descricao'], PDO::PARAM_STR);
        $query->bindParam(":tipo", $_POST['Tipo'], PDO::PARAM_INT);
        $query->bindParam(":semestres", $_POST['Semestres'], PDO::PARAM_INT);
        $query->execute();
    }

    public function delCurso() {

        $id = $_POST['ID'];

        $query = $this->con->con()->prepare("DELETE FROM curso where ID = :id ");

        $query->bindParam(":id", $id, PDO::PARAM_STR);

        $query->execute();
    }

    public function updateCurso() {




        $query = $this->con->con()->prepare("UPDATE `curso` SET `Nome` = :nome, `Descricao` = :descricao
            where `ID` = :id");

        $query->bindParam(":nome", $_POST['Nome'], PDO::PARAM_STR);
        $query->bindParam(":descricao", $_POST['Descricao'], PDO::PARAM_STR);
        $query->bindParam(":id", $_POST['ID'], PDO::PARAM_INT);
        $query->execute();
    }

    public function insertMateria() {

        $query = $this->con->con()->prepare("INSERT INTO `materia` (`Nome`,`Semestre`,`IDCurso`) values (:nome,:semestre,:curso) ");

        $query->bindParam(":nome", $_POST['Nome'], PDO::PARAM_STR);
        $query->bindParam(":semestre", $_POST['Semestre'], PDO::PARAM_STR);
        $query->bindParam(":curso", $_POST['Curso'], PDO::PARAM_STR);
        $query->execute();
    }

    public function delMateria() {

        $id = $_POST['ID'];

        $query = $this->con->con()->prepare("DELETE FROM materia where ID = :id ");

        $query->bindParam(":id", $id, PDO::PARAM_STR);

        $query->execute();
    }

    public function listMateria() {


        ## Read value
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();

        ## Search 
        $searchQuery = " ";
        if ($searchValue != '') {
            $searchQuery = " AND (Nome LIKE :Nome) ";
            $searchArray = array(
                'Nome' => "%$searchValue%"
            );
        }

        ## Total number of records without filtering
        $stmt = $this->con->con()->prepare("SELECT COUNT(*) AS allcount FROM materia ");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        ## Total number of records with filtering
        $stmt = $this->con->con()->prepare("SELECT COUNT(*) AS allcount FROM materia WHERE 1 " . $searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $stmt = $this->con->con()->prepare("SELECT * FROM materia WHERE 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

        // Bind values
        foreach ($searchArray as $key => $search) {
            $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        $data = array();



        foreach ($empRecords as $row) {
            /*
              if($row['Tipo'] == 1){
              $row['Tipo'] = "Usuario";
              }
              elseif($row['Tipo'] == 2){
              $row['Tipo'] = "Aluno";
              }elseif($row['Tipo'] == 3){
              $row['Tipo'] = "Professor";
              }else{
              $row['Tipo'] = "Administrador";
              }
             * 
             * 
             *          
             * 
             *
             */
            $query = $this->con->con()->prepare("SELECT Nome from `curso` where ID = :id");


            $query->bindValue(':id', $row['IDCurso'], PDO::PARAM_INT);
            $query->execute();
            $retorno = $query->fetch();

            $row['IDCurso'] = $retorno[0];

            $data[] = array(
                "Nome" => $row['Nome'],
                "IDCurso" => $row['IDCurso'],
                "Semestre" => $row['Semestre'],
                "Excluir" => '<a href="#" id="' . $row["ID"] . '" class="excluir_materia" ><i class="material-icons">delete</i></a>',
                "Alterar" => '<a href="#" id="' . $row["ID"] . '" class="modal-trigger alterar_materia" data-target="modal4"><i class="material-icons">create</i></a>'
            );
        }




        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }

    public function listMateriaModal() {

        $query = $this->con->con()->prepare("SELECT Nome,Semestre,IDCurso from `materia` where ID = :id");


        $query->bindValue(':id', $_POST['ID'], PDO::PARAM_INT);
        $query->execute();
        $retorno = $query->fetch();



        echo json_encode($retorno);
    }

    public function updateMateria() {




        $query = $this->con->con()->prepare("UPDATE `materia` SET `Nome` = :nome, `Semestre` = :semestre,`IDCurso` = :curso
            where `ID` = :id");

        $query->bindParam(":nome", $_POST['Nome'], PDO::PARAM_STR);
        $query->bindParam(":semestre", $_POST['Semestre'], PDO::PARAM_STR);
        $query->bindParam(":curso", $_POST['Curso'], PDO::PARAM_INT);
        $query->bindParam(":id", $_POST['ID'], PDO::PARAM_INT);
        $query->execute();
    }

    public function listUsuarioModal() {


        $query = $this->con->con()->prepare("SELECT Nome,Email,CPF,Tipo from `usuario` where ID = :id");


        $query->bindValue(':id', $_POST['ID'], PDO::PARAM_INT);
        $query->execute();
        $retorno = $query->fetch();



        echo json_encode($retorno);
    }

    public function updateUsuarioModal() {

        $query = $this->con->con()->prepare("UPDATE `usuario` SET `Nome` = :nome,`CPF` = :cpf, `Email` = :email,`Tipo` = :tipo
            where `ID` = :id");

        $query->bindParam(":nome", $_POST['Nome'], PDO::PARAM_STR);
        $query->bindParam(":cpf", $_POST['CPF'], PDO::PARAM_STR);
        $query->bindParam(":tipo", $_POST['Tipo'], PDO::PARAM_INT);
        $query->bindParam(":email", $_POST['Email'], PDO::PARAM_STR);
        $query->bindParam(":id", $_POST['ID'], PDO::PARAM_INT);
        $query->execute();
    }

    public function listSolicitacaoAvaliada() {




        ## Read value
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();



        ## Search 
        $searchQuery = " ";
        if ($searchValue != '') {
            $searchQuery = " AND (Usuario.Nome LIKE :Nome or 
                Curso.Nome LIKE :Curso) ";
            $searchArray = array(
                'Nome' => "%$searchValue%",
                'Curso' => "%$searchValue%",
            );
        }

        ## Total number of records without filtering
        $stmt = $this->con->con()->prepare("SELECT COUNT(*) AS allcount FROM solicitacao where solicitacao.Status = 2 || solicitacao.Status = 3");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        ## Total number of records with filtering
        $stmt = $this->con->con()->prepare("SELECT COUNT(*) AS allcount  FROM solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID INNER JOIN usuario ON aluno.IDUsuario = usuario.ID inner JOIN curso ON aluno_curso.IDCurso = curso.ID
 WHERE solicitacao.Status = 2 || solicitacao.Status = 3 && 1 " . $searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $stmt = $this->con->con()->prepare("SELECT solicitacao.ID as ID,usuario.Nome as Nome,curso.Nome as Curso,(select usuario.nome from usuario where id = solicitacao.IDProfessor) Professor,DATE_FORMAT(solicitacao.DataProfessor, '%d/%m/%Y %H:%i:%S') as DataProfessor,DATE_FORMAT(solicitacao.Data, '%d/%m/%Y %H:%i:%S') as Data FROM solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID INNER JOIN usuario ON aluno.IDUsuario = usuario.ID inner JOIN curso ON aluno_curso.IDCurso = curso.ID WHERE solicitacao.Status = 2 || solicitacao.Status = 3 && 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

        // Bind values
        foreach ($searchArray as $key => $search) {
            $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        $data = array();



        foreach ($empRecords as $row) {



            $data[] = array(
                "Curso" => $row['Curso'],
                "Nome" => $row['Nome'],
                "Data" => $row['Data'],
                "DataProfessor" => $row['DataProfessor'],
                "Professor" => $row['Professor'],
                "Finalizar" => '<a href="/Dashboard/Admin/SolicitacoesAvaliadas/' . sha1($row['ID']) . '" id="' . $row['ID'] . '" class="modal-trigger alterar_usuario" data-target="modal"><i class="material-icons">&nbspcheck_circle
</i></a>'
            );
        }




        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }

    public function checkSolicitacao($n) {

        $id = URL[$n];

        $query = $this->con->con()->prepare("SELECT id from `solicitacao` where sha1(ID) = :id ");
        $query->bindParam(":id", $id, PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetchAll();

        if (count($retorno) != 1) {


            header("Location: /Dashboard/Admin/Solicitacoes");

            exit;
        }
    }

    public function listSolicitacaoDetalhes() {

        $id_solicitacao = URL[3];


        $query = $this->con->con()->prepare("SELECT solicitacao.ID as ID,usuario.Nome as Nome,curso.Nome as Curso,(select usuario.nome from usuario where id = solicitacao.IDProfessor) Professor,DATE_FORMAT(solicitacao.DataProfessor, '%d/%m/%Y %H:%i:%S') as DataProfessor,DATE_FORMAT(solicitacao.Data, '%d/%m/%Y %H:%i:%S') as Data,solicitacao.Status as Status FROM solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID INNER JOIN usuario ON aluno.IDUsuario = usuario.ID inner JOIN curso ON aluno_curso.IDCurso = curso.ID where sha1(solicitacao.ID) = :id");
        $query->bindParam(":id", $id_solicitacao, PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetchAll();




        $query = $this->con->con()->prepare("SELECT materia.Nome as Nome,solicitacao_materia.MateriaOrigem as Origem,solicitacao_materia.Status as Status FROM solicitacao INNER JOIN solicitacao_materia on solicitacao_materia.IDSolicitacao = solicitacao.ID inner join materia on solicitacao_materia.IDMateria = materia.ID WHERE sha1(solicitacao.ID) = :id
");
        $query->bindParam(":id", $id_solicitacao, PDO::PARAM_STR);
        $query->execute();
        $retorno_materias = $query->fetchAll();





        return array($retorno, $retorno_materias);
    }

    public function listSolicitacaoAvaliarArquivos() {

        $id_solicitacao = URL[3];


        $query = $this->con->con()->prepare("SELECT usuario.ID as id_do_usuario from solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = 
            aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID inner join usuario on aluno.IDUsuario = usuario.ID where sha1(solicitacao.id) = :id



");
        $query->bindParam(":id", $id_solicitacao, PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetch();

        $id_usuario = $retorno[0];


        $query = $this->con->con()->prepare("select Caminho,Descricao from arquivo_solicitacao where sha1(IDSolicitacao) = :id");



        $query->bindParam(":id", $id_solicitacao, PDO::PARAM_STR);
        $query->execute();
        $retorno = $query->fetchAll();

        return array($retorno, $id_usuario);
    }

    public function avaliarSolicitacao($status) {
        session_start();

        $this->checkSolicitacao(2);

        $id = URL[2];

        if ($status == 4) {

            $query = $this->con->con()->prepare("SELECT Status from solicitacao where sha1(solicitacao.ID) = :id");
            $query->bindParam(":id", $id, PDO::PARAM_STR);
            $query->execute();
            $retorno = $query->fetch();




            if ($retorno[0] == "3") {
                $status = 6;
            }
        }




        $query = $this->con->con()->prepare("update solicitacao set solicitacao.Status = :status,solicitacao.DataServidor = :data,solicitacao.IDServidor = :id_servidor  where sha1(ID) = :id");

        echo $status;
        $data = $this->functions->dataAtual();


        $query->bindParam(":id", $id, PDO::PARAM_STR);
        $query->bindParam(":status", $status, PDO::PARAM_INT);
        $query->bindParam(":data", $data, PDO::PARAM_STR);
        $query->bindParam(":id_servidor", $_SESSION['id'], PDO::PARAM_INT);
        $query->execute();
    }

    public function listSolicitacaoAprovada() {


        ## Read value
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();

        ## Search 
        $searchQuery = " ";
        if ($searchValue != '') {
            $searchQuery = " AND (usuario.Nome LIKE :Nome)  ";
            $searchArray = array(
                'Nome' => "%$searchValue%"
            );
        }

        ## Total number of records without filtering
        $stmt = $this->con->con()->prepare("SELECT COUNT(*) AS allcount FROM solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID INNER JOIN usuario ON aluno.IDUsuario = usuario.ID inner JOIN curso ON aluno_curso.IDCurso = curso.ID
 where solicitacao.Status = 4 || solicitacao.Status = 6 ");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        ## Total number of records with filtering
        $stmt = $this->con->con()->prepare("SELECT COUNT(*) AS allcount FROM solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID INNER JOIN usuario ON aluno.IDUsuario = usuario.ID inner JOIN curso ON aluno_curso.IDCurso = curso.ID
 where solicitacao.Status = 4 || solicitacao.Status = 6 && 1 " . $searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $stmt = $this->con->con()->prepare("SELECT solicitacao.ID as ID,usuario.Nome as Nome,curso.Nome as Curso,(select usuario.nome from usuario where id = solicitacao.IDProfessor) Professor,(select usuario.nome from usuario where id = solicitacao.IDServidor) Servidor,DATE_FORMAT(solicitacao.DataServidor, '%d/%m/%Y %H:%i:%S') as DataServidor FROM solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID INNER JOIN usuario ON aluno.IDUsuario = usuario.ID inner JOIN curso ON aluno_curso.IDCurso = curso.ID
 where solicitacao.Status = 4 || solicitacao.Status = 6 && 1 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

        // Bind values
        foreach ($searchArray as $key => $search) {
            $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        $data = array();



        foreach ($empRecords as $row) {
            /*
              if($row['Tipo'] == 1){
              $row['Tipo'] = "Usuario";
              }
              elseif($row['Tipo'] == 2){
              $row['Tipo'] = "Aluno";
              }elseif($row['Tipo'] == 3){
              $row['Tipo'] = "Professor";
              }else{
              $row['Tipo'] = "Administrador";
              }
             * 
             * 
             *          
             * 
             *
             */


            $data[] = array(
                "Nome" => $row['Nome'],
                "Curso" => $row['Curso'],
                "Servidor" => $row['Servidor'],
                "Professor" => $row['Professor'],
                "DataServidor" => $row['DataServidor'],
                "Relatório" => '<a href="#"  id="' . $row["ID"] . '" onclick="return abrirPopup(\' /Admin/gerarRelatorio/' . sha1($row["ID"]) . '  \', 1280, 720) "><i class="material-icons"> &nbsp;&nbsp;assignment</i></a>',
            );
        }




        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
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

    public function listInformation() {


        $query = $this->con->con()->prepare("select COUNT(usuario.ID) as usuario,(select COUNT(usuario.ID) from usuario where Tipo = 2) as aluno,(select COUNT(usuario.ID) from usuario where Tipo = 3) as professor, (select COUNT(usuario.ID) from usuario where Tipo = 4) as servidor from usuario");

        $query->execute();
        $retorno1 = $query->fetchAll();




        $query = $this->con->con()->prepare("select COUNT(solicitacao.ID) as solicitacao_total,(SELECT COUNT(solicitacao.ID) FROM solicitacao WHERE solicitacao.Status = 1) as nova_solicitacao,(SELECT COUNT(solicitacao.ID) FROM solicitacao WHERE solicitacao.Status = 4 || solicitacao.Status = 6) as solicitacao_finalizada,(SELECT COUNT(solicitacao.ID) FROM solicitacao WHERE solicitacao.Status = 5 || solicitacao.Status = 2 || solicitacao.Status = 3) as solicitacao_aguardando FROM solicitacao");

        $query->execute();
        $retorno2 = $query->fetchAll();





        return array($retorno1, $retorno2);
    }
    
    
  

}