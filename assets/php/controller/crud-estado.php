<?php

# Incluído o ficheiro crud
include_once('crud.php');

#Incluido o ficheiro de conexão
include_once('conexao.php');

#Criando a classe para o crud do Email
class CrudEstado extends Conexao implements Crud {
    

    public function insert() {
      //  $this->connect();
         $this->conexao;
    }

    public function update() {
       
    }

    public function delete() {
        
    }

    public function select($idEstado = 1) {
        $this->connect();
        
        $query = "SELECT * FROM tbestado";
        if($resultado = mysqli_query($this->conexao, $query)) {
            while ($dados = mysqli_fetch_array($resultado)) {
                if($dados[0] == $idEstado) {
                    echo "<option value='$dados[0]' selected>$dados[1]</option>";
                } {
                    echo "<option value='$dados[0]'>$dados[1]</option>";
                }
            }

        } else {
            echo '<option value="erro">Erro</option>';
        }
    }
}