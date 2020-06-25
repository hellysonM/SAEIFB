<?php


class Professor extends Usuario{
    
    public function __construct() {
        
        
  if (!isset($_SESSION)) {
            
            session_start();
        }

        
        if(!(isset($_SESSION['tipo'])) || !(isset($_SESSION['login'])) || $_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 2 || $_SESSION['login'] != 'true'){
            
            require_once ABSPATH.'lib/includes/404.php';
            
            exit();
            
        }else{
         
  
       

        $this->con = new Connection();
        $this->functions = new Functions();
            
        
        }
        
        

        
    }
    
    public function listSolicitacao(){
          
         
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
        if($searchValue != ''){
           $searchQuery = " AND (Usuario.Nome LIKE :Nome or 
                Curso.Nome LIKE :Curso) ";
           $searchArray = array( 
                'Nome'=>"%$searchValue%", 
                'Curso'=>"%$searchValue%",
                
           );
        }
        
        ## Total number of records without filtering
        $stmt = $this->con->con()->prepare("SELECT COUNT(*) AS allcount FROM solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID INNER JOIN usuario ON aluno.IDUsuario = usuario.ID inner JOIN curso ON aluno_curso.IDCurso = curso.ID
 where solicitacao.status = 1 ||solicitacao.status = 5 ");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];
        
        ## Total number of records with filtering
        $stmt = $this->con->con()->prepare("SELECT COUNT(*) AS allcount  FROM solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID INNER JOIN usuario ON aluno.IDUsuario = usuario.ID inner JOIN curso ON aluno_curso.IDCurso = curso.ID
 WHERE solicitacao.status = 1 ||solicitacao.status = 5 && 1 ".$searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];
        
        ## Fetch records
        $stmt = $this->con->con()->prepare("SELECT solicitacao.ID as ID,usuario.Nome as Nome,curso.Nome as Curso,solicitacao.Status as Status,solicitacao.Data as Data FROM solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID INNER JOIN usuario ON aluno.IDUsuario = usuario.ID inner JOIN curso ON aluno_curso.IDCurso = curso.ID

 WHERE solicitacao.status = 1 ||solicitacao.status = 5 && 1 ".$searchQuery." ORDER BY ".$columnName." ".$columnSortOrder." LIMIT :limit,:offset");
        
        // Bind values
        foreach($searchArray as $key=>$search){
           $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
        }
        
        $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();
        
        $data = array();
        
       

        foreach($empRecords as $row){

            

            $data[] = array(
                "Curso"=>$row['Curso'],
               "Nome"=>$row['Nome'],
                
                "Data"=>$row['Data'],
                "Status"=>$row['Status'],
               
               
               "Avaliar"=>'<a href="/Dashboard/Professor/Solicitacoes/'.sha1($row['ID']).'" id="'.$row['ID'].'" class="modal-trigger alterar_usuario" data-target="modal"><i class="material-icons">&nbspcreate</i></a>'
  

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
    
    
    
    
    public function checkSolicitacao($n){
        
        $id = URL[$n];
        
         $query = $this->con->con()->prepare("SELECT id from `solicitacao` where sha1(ID) = :id ");           
            $query->bindParam(":id", $id, PDO::PARAM_STR);
            $query->execute();            
            $retorno = $query->fetchAll();
            
            if(count($retorno) != 1){
            
                
                header("Location: /Dashboard/professor/Solicitacoes");
                
                
            }
        
        
        
    }
    
    public function listSolicitacaoID(){
        
         $id = URL[3];
         
        $query = $this->con->con()->prepare("SELECT solicitacao.Observacao as Obs,solicitacao.ID as ID,usuario.Nome as Nome,curso.Nome as Curso,solicitacao.Status as Status,DATE_FORMAT(solicitacao.Data, '%d/%m/%Y %H:%i:%S') as Data,aluno_curso.Ingresso FROM solicitacao INNER JOIN aluno_curso on solicitacao.IDAluno_curso = aluno_curso.ID INNER JOIN aluno on aluno_curso.IDAluno = aluno.ID INNER JOIN usuario ON aluno.IDUsuario = usuario.ID inner JOIN curso ON aluno_curso.IDCurso = curso.ID where sha1(solicitacao.ID) = :id");           
            $query->bindParam(":id", $id, PDO::PARAM_STR);
            $query->execute();            
            $retorno = $query->fetchAll();
            
            return $retorno;
    }
    
   
    
    public function listSolicitacaoAvaliar(){
        
        $id = URL[3];
        
        
        $query = $this->con->con()->prepare("select materia.Nome,solicitacao_materia.ID,solicitacao_materia.MateriaOrigem from solicitacao_materia inner JOIN solicitacao on solicitacao_materia.IDSolicitacao = solicitacao.ID INNER JOIN materia ON solicitacao_materia.IDMateria = materia.ID where sha1(solicitacao.ID) = :id");           
            $query->bindParam(":id", $id, PDO::PARAM_STR);
            $query->execute();            
            $retorno = $query->fetchAll();
            
            
            return $retorno;
        
    }
    
    public function listSolicitacaoAvaliarArquivos(){
        
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
            
            return array($retorno,$id_usuario);

            
            
            
        
    }
    
    
    
    public function updateSolicitacao($n){
        
        session_start();
        
        $id = URL[2];
        
        echo $n;
        
        
        
        
        foreach ($_POST['solicitacao_materia'] as $materia) {
            
            
            
           
            
           $query = $this->con->con()->prepare("update solicitacao_materia set Status = :status  where ID = :id");  
           
           
          
            $query->bindParam(":id",  $materia['id'], PDO::PARAM_STR);
            $query->bindParam(":status", $materia['status'], PDO::PARAM_STR);
            $query->execute();   
            
    
    
    
}
        
        
        
        
        
        
        
        
        
        
        
        
        
        $query = $this->con->con()->prepare("update solicitacao set Status = :status,IDProfessor = :id_prof,DataProfessor = :data  where sha1(ID) = :id");  
           
            $data = $this->functions->dataAtual();
           
            
            
            $query->bindParam(":id", $id, PDO::PARAM_STR);
            $query->bindParam(":id_prof", $_SESSION['id'], PDO::PARAM_INT);
            $query->bindParam(":data", $data, PDO::PARAM_STR);
            $query->bindParam(":status", $n, PDO::PARAM_STR);
            $query->execute();            
            
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
}