<?php

# Incluído o ficheiro crud
include_once('crud.php');

#Incluido o ficheiro de conexão
include_once('conexao.php');

#Criando a classe para o crud do Email
class CrudEmail extends Conexao implements Crud {
    

    public function insert() {
      //  $this->connect();
         $this->conexao;
    }

    public function update() {
       
    }

    public function delete() {
        
    }

    public function select() {
        
    }
}

$email = new CrudEmail();
$email->insert();