<?php


#Incluido o ficheiro de conexão
include_once('conexao.php');

#Criando a classe para o crud do Email
class CrudEstado extends Conexao {

    function __construct() {
        # INICIALIZANDO A CONEXÃO NO MÉTODO CONSTRUTOR
        parent::connect();
    }

    
    

    # FUNÇÃO PARA FAZER PEGAR TODOS OS ESTADO
    public function select($idEstado = 1) { 
        $query = $this->conexao->prepare("SELECT * FROM tbestado");
        if($query->execute()) {

            $resultado = $query->get_result();
            while ($dados = $resultado->fetch_array()) {
                if($dados[0] == $idEstado) {
                    echo "<option value='$dados[0]' selected>$dados[1]</option>";
                } else {
                    echo "<option value='$dados[0]'>$dados[1]</option>";
                }   
            }

        } else {
            echo '<option value="erro">Erro</option>';
        }
    }
}
