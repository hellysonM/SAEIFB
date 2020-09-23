<?php

require_once 'lib/api/dompdf/autoload.inc.php';

require_once 'lib/api/phpmailer/PHPMailer.php';
require_once 'lib/api/phpmailer/SMTP.php';
require_once 'lib/api/phpmailer/Exception.php';

use Dompdf\Dompdf;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Functions {

    public function encode($att) {
        return sha1($att);
    }

    public function tratarCaracter($vlr, $tipo) {
        switch ($tipo) {
            case 1: $rst = utf8_decode($vlr);
                break;
            case 2: $rst = htmlentities($vlr, ENT_QUOTES, "ISO-8859-1");
                break;
        }
        return $rst;
    }
    
    public function dataEmSql($dateSql){
    $ano= substr($dateSql, 6);
    $mes= substr($dateSql, 3,-5);
    $dia= substr($dateSql, 0,-8);
    return $ano."-".$mes."-".$dia;
}

    function validaCPF($cpf = null) {

        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        if (strlen($cpf) != 11) {

            $retorno = array('codigo' => 0, 'mensagem' => 'CPF não atende ao padrão');
            echo json_encode($retorno);
        } else {
            return $cpf;
        }
    }

    public function base64($vlt, $n) {
        switch ($n) {
            case 1: return base64_encode($vlt);
                break;
            case 2;
                return base64_decode($vlt);
                break;
        }
    }

    public function dataAtual() {
        date_default_timezone_set('America/Sao_Paulo');
        return date("Y-m-d H:i:s");
    }

    public function IP() {

        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function gerarPDF($file) {

        $dompdf = new Dompdf();
	    
	ob_start();
        require $file;
        $pdf = ob_get_clean();
        $dompdf->load_html($pdf);
	    
        $dompdf->set_paper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("nome-do-arquivo.pdf", ["Attachment" => false]);
    }
    

    public function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false) {
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';

        $caracteres .= $lmin;
        if ($maiusculas)
            $caracteres .= $lmai;
        if ($numeros)
            $caracteres .= $num;
        if ($simbolos)
            $caracteres .= $simb;

        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand - 1];
        }
        return $retorno;
    }
    
    
    public function sendMail($to,$msg,$subject){
         
        $mail = new PHPMailer(false);
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        
        $mail->Host = '';
        $mail->SMTPAuth = true;
        $mail->Username = '';
        $mail->Password = '';
        $mail->Port = 587;
        
        $mail->setFrom('hellysonjk2024@gmail.com');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        
        $mail->Body = $msg;
        
        if($mail->send()) {
		//echo 'Email enviado com sucesso';
	} else {
		//echo 'Email nao enviado';
	}    
        
    }

}
