<?php


#Incluido o ficheiro de conexão
include_once('conexao.php');

class CrudSexo extends Conexao {

    function __construct() {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }

    public function select($idEstado = 2) {

        $query = $this->conexao->prepare("SELECT * FROM tbSexo");
        if($query->execute()) {

            $resultado   = $query->get_result();
            while($dados = $resultado->fetch_array()) {
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
