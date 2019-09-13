<?php


//include_once('../../global/erro.php');
//session_start();

class Conexao {

    /* VARIAVES DO SERVIDOR */
    const SERVERNAME = "localhost";
    const USERNAME   = "root";
    const PASSWORD   = "";
    const DBNAME     = "bdjelu";
   
    # Variavel de Conexão
    var $conexao;
    
     public function connect() {

        $this->conexao = mysqli_connect(self::SERVERNAME, self::USERNAME, self::PASSWORD, self::DBNAME);
        mysqli_set_charset($this->conexao, "UTF8");

        if(mysqli_connect_error()) {
            $_SESSION['tipoErro']   = "500";
            $_SESSION['descricao']  = "Ocorreu um erro na conexão com o Banco de Dados, tente mais tarde.Obrigado";
            header('Location: ../../dashboard/404.php');
       } 
     }    




     
     public static $instance;

     public static function getConne() {
       if(!isset(self::$instance)) {
         self::$instance = new PDO("mysql:host".self::SERVERNAME.";dbname=".self::DBNAME.";charset=utf8",self::USERNAME, self::PASSWORD);
       } else {
         return self::$instance;
       }
     }
}

//Conexao::getConne();