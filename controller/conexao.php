<?php



class Conexao {

    /* VARIAVES DO SERVIDOR */
    const SERVERNAME = "localhost";
    const USERNAME   = "root";
    const PASSWORD   = "";
    const DBNAME     = "bdjelu";


   
    # Variavel de Conexão
     protected $conexao;

     function connect() {
       $this->conexao = new mysqli(self::SERVERNAME, self::USERNAME, self::PASSWORD, self::DBNAME);
       $this->conexao->set_charset('UTF8');

        if(mysqli_connect_errno()) {
          header('Location: ../../dashboard/404.php');
        }

        return true;
     }
}

