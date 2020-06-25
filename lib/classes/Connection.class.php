<?php



class Connection {
	
//ATRIBUTO PRIVADOS
private $usuario;
private $senha;
private $banco;
private $servidor;
private static $pdo;
//CONSTRUTOR
public function __construct(){		
	$this->servidor = HOSTNAME;
	$this->banco = DB_NAME;
	$this->usuario = DB_USER; 
	$this->senha = DB_PASSWD;
}

public function con(){
	try{
		if(is_null(self::$pdo)){
			self::$pdo = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);
                        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		return self::$pdo;
	}catch(PDOException $e){
		echo 'Error: '.$e->getMessage();
	}
}

}