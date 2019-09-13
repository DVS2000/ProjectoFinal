<?php


#Incluido o ficheiro de conexão
include_once('conexao.php');

class CrudSexo extends Conexao {

    public function select($idEstado = 2) {
        $this->connect();

        $query = "SELECT * FROM tbSexo";
        if($resultado = mysqli_query($this->conexao, $query)) {
            while($dados = mysqli_fetch_array($resultado)) {
                if($dados[0] == $idEstado) {
                    echo "<option value='$dados[0]' selected>$dados[1]</option>";
                } else {
                    echo "<option value='$dados[0]'>$dados[1]</option>";
                }
            }

        } else {
            echo "<option value='erro'>Erro</option>";
        }
    }
}
