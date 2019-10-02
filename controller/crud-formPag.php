<?php


#Incluido o ficheiro de conexão
include_once('conexao.php');

class CrudFormPag extends Conexao {

    function __construct() {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }

    public function select($idEstado = 2) {
        $options = array();

        $query = $this->conexao->prepare("SELECT * FROM tbFormPag");
        if($query->execute()) {

            $resultado   = $query->get_result();
            while($dados = $resultado->fetch_array()) {
                if($dados[0] == $idEstado) {
                   $options[] = "<option value='$dados[0]' selected>$dados[1]</option>";
                } else {
                   $options[] = "<option value='$dados[0]'>$dados[1]</option>";
                }
            }

        } else {
            $options[] = "<option value='erro'>Erro</option>";
        }

        return $options;
    }
}
