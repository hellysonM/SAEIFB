<?php
/**
* Camada - Controller
* Diretório Pai - lib
* Arquivo - Application.php
**/
 
/**
* Essa função garante que todas as classes 
* da pasta lib serão carregadas automaticamente
*/





/**
* Verifica qual classe controlador (Controller) o usuário deseja chamar
* e qual método dessa classe (Action) deseja executar
* Caso o controlador (controller) não seja especificado, o IndexControllers será o padrão
* Caso o método (Action) não seja especificado, o indexAction será o padrão
* 
* @package Exemplo simples com MVC
* @author Hellyson
* @version 0.1.1
**/
class Application
{
    /**
    * Usada pra guardar o nome da classe
    * de controle (Controller) a ser executada
    * @var string
    */
    protected $st_controller;
  
    /**
    * Usada para guardar o nome do metodo da
    * classe de controle (Controller) que deverá ser executado
    * @var string
    */
    protected $st_action;
  
    /**
    * Verifica se os parâmetros de controlador (Controller) e ação (Action) foram
    * passados via parâmetros "Post" ou "Get" e os carrega tais dados
    * nos respectivos atributos da classe
    */



    private function loadRoute()
    {
        
        $this->st_controller = isset(URL[0]) ?  URL[0] : 'Index';
  
        
        $this->st_action = isset(URL[1]) ?  URL[1] : 'index';
    }
  
    /**
    *
    * Instancia classe referente ao Controlador (Controller) e executa
    * método referente e  acao (Action)
    * @throws Exception
    */
    public function __construct()
    {
        $this->loadRoute();
  
        //verificando se o arquivo de controle existe
        $st_controller_file = ABSPATH.'/controllers/'.$this->st_controller.'Controller.php';
        if(file_exists($st_controller_file)){
            require_once $st_controller_file;
        }
        else{
            require_once ABSPATH.'/lib/includes/404.php';
            throw new Exception('Arquivo '.$st_controller_file.' nao encontrado');
                
            }

        //verificando se a classe existe
        $st_class = $this->st_controller.'Controller';
        if(class_exists($st_class))
            $o_class = new $st_class;
        else
            throw new Exception("Classe '$st_class' nao existe no arquivo '$st_controller_file'");
  
        //verificando se o metodo existe
        $st_method = $this->st_action.'Action';
        if(method_exists($o_class,$st_method))
            $o_class->$st_method();
        else{
            require_once ABSPATH.'/lib/includes/404.php';
            throw new Exception("Metodo '$st_method' nao existe na classe $st_class'");
        }
    }
  
    /**
    * Redireciona a chamada http para outra página
    * @param string $st_uri
    */
    static function redirect( $st_uri )
    {
        header("Location: $st_uri");
    }
}
?>