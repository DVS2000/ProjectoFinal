<?php

class Conexao {

    /* VARIAVES DO SERVIDOR */
    const SERVERNAME = "localhost";
    const USERNAME   = "root";
    const PASSWORD   = "";
    const BDNAME     = "bdinscricao";


   
    # Variavel de Conexão
     protected $conexao;

     function connect() {
       $this->conexao = new mysqli(self::SERVERNAME, self::USERNAME, self::PASSWORD, self::BDNAME);
       $this->conexao->set_charset('UTF8');

       # SE TIVER ALGUM ERRO ELE ENVIA O USER NA PÁGINA DE ERRO
        if(mysqli_connect_errno()) {
          header('Location: view/404.php');
        }

        return true;
     }
}

