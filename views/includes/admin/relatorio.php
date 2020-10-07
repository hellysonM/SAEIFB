<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Table Style</title>
	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
</head>
<style>
  
    body{
        margin: 10px;
        font-family: "Trebuchet MS", Helvetica, sans-serif;

        
    }
       
    h1{
        text-align: center;
        
    }
    
#table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#table td, #table th {
  border: 1px solid #ddd;
  padding: 8px;
}

#table tr:nth-child(even){background-color: #f2f2f2;}

#table tr:hover {background-color: #ddd;}

#table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
   
</style>

<body>
  
    <h2>Aproveitamento de Estudos</h2>
   
    <table id="table">
<?php 

$admin = new Administrador();

$retorno = $admin->aproveitamentoPDF();

foreach ($retorno[0] as $linha){

?>
        <tr>
            <td>Aluno</td>
            <td><?=$linha['Nome']?></td> 
        </tr>
        <tr>
            <td>Matricula</td>
            <td><?=$linha['Matricula']?></td> 
        </tr>
        <tr>
            <td>CPF</td>
            <td><?=$linha['CPF']?></td> 
        </tr>
        <tr>
            <td>Curso</td>
            <td><?=$linha['Curso']?></td> 
        </tr>
        <tr>
            <td>Ingresso</td>
            <td><?=$linha['Ingresso']?></td> 
        </tr>
        <tr>
            <td>Data da solicitação</td>
            <td><?=$linha['Data']?></td> 
        </tr>
    </table>
    
    
    <br>
    <br>
    
    
     <table id="table">

        <tr>
            <td>Professor</td>
            <td><?=$linha['Professor']?></td> 
        </tr>
        <tr>
            <td>Data da avaliação</td>
            <td><?=$linha['DataProfessor']?></td> 
        </tr>
        <tr>
            <td>Servidor</td>
            <td><?=$linha['Servidor']?></td> 
        </tr>
        <tr>
            <td>Data da aprovação</td>
            <td><?=$linha['DataServidor']?></td> 
        </tr> 
        <br>
        <br>
        
         <?php 
 
 }
 
 ?>

    </table>
    
    <h3>Resultado</h3>
    
    <?php if($linha["Status"]==6){
        echo "<h4>Documentação incompleta</h4>";
    }else{
        
        
    ?>
    
    <table id="table">


<tr>
    <th>Matéria do IFB</th>
    <th>Matéria de origem</th>
    <th>Resultado</th>
    
  </tr>
  <?php   foreach ($retorno[1] as $materia){

   ?>     <tr>
            <td><?=$materia['Nome']?></td>
            <td><?=$materia['Origem']?></td>
            <td><?php    
                
                if($materia['Status']==1){
                    echo "Deferido";
                }elseif($materia['Status']==2){
                    echo "Incompatibilidade de carga horária";
                }elseif($materia['Status']==3){
                    echo "Incompatibilidade de conteúdo";
                }else{
                    echo "Um erro ocorreu";
                }
          
           ?></td> 
        </tr>
        
        
  <?php } ?>  

    </table>
    
    <?php } ?>
    
    
    
    
    <br>
    <footer>
        
        <img src="<?=HOME_URL?>/views/img/assCampusBrasilia.png">
        
    </footer>
    
    
</body>



</html>