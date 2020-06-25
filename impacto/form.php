
<?php 

if(!isset($_POST['nome']) || !isset($_POST['subject']) || !isset($_POST['msg']) || !isset($_POST['email']) )
{
    header("Location: /");

}else{


    $from = "falecom@impactopositivo.net.br";

    $to = "falecom@impactopositivo.net.br";
    
    $subject = $_POST['subject'];
    
    $message = "E-MAIL:".$_POST['email']."<br>"."Mensagem:"."<br>".$_POST['msg'];
    
    $headers = "De:". $from;
    
    mail($to, $subject, $message, $headers);
    
    echo "<script>alert('Sua mensagem foi enviada');window.location.href = '/';</script>";

    

}


?>