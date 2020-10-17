<?php


$config = parse_ini_file('ini-config.ini');



define( 'ABSPATH', $config['ABSPATH'] );
define( 'UPABSPATH', $config['UPABSPATH'] );
define( 'UPLOAD_URL', $config['UPLOAD_URL'] );
define( 'HOME_URL', $config['HOME_URL']);
define( 'HOSTNAME', $config['HOSTNAME']);
define( 'DB_NAME', $config['DB_NAME'] );
define( 'DB_USER', $config['DB_USER'] );
define( 'DB_PASSWD', $config['DB_PASSWD'] );
define( 'DB_CHARSET', 'utf8' );
define( 'DEBUG', $config['DEBUG']);
define( 'MAINTENANCE', $config['MAINTENANCE']);

define( 'RECAPT_PUBLIC_KEY', $config['RECAPT_PUBLIC_KEY']);
define( 'RECAPT_PRIVATE_KEY', $config['RECAPT_PRIVATE_KEY']);


ini_set('display_errors', DEBUG);
error_reporting(E_ALL);

/*
$path = $_SERVER['REQUEST_URI']; 
$path = rtrim($path, '/'); 
$path = filter_var($path, FILTER_SANITIZE_URL); 
$path = explode('/', $path); 
*/

$url = '';
if($_GET){
$url = explode('/', $_GET['url']);
}

define('URL',$url);




function loadClass($class_name) {
    
	$file1 = ABSPATH . '/lib/classes/'.$class_name.'.class.php';
	$file2 = ABSPATH . '/models/'.$class_name.'.class.php';
        $file3 = ABSPATH . '/models/'.$class_name.'.interface.php';;
       
	if(file_exists($file1)){
             require_once($file1);  
        }
            else if(file_exists($file2)){
            require_once($file2);    
            }
                else if(file_exists($file3)){
                require_once ($file3);
                }
        
	else{
		//require_once ABSPATH . '/lib/includes/404.php';	
	}
        
} 
spl_autoload_register("loadClass");

//Início do Programa
if(!MAINTENANCE)
$app = new Application();
else{
    require_once ABSPATH . '/lib/includes/Maintenance/index.php';
}




