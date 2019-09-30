<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');


class CrudTipoUser extends Conexao {

    function __construct() {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }
    
    # FUNÇÃO PARA FAZER O INSERT DO TIPO DE UTILIZADOR
    public function insert(TipoUtilizador $objecto) {

        $query = "INSERT INTO tbtipoutilizador(descricao) VALUES('".$objecto->getDescricao()."')";    
        if(mysqli_query($this->conexao, $query)) {
           echo "Correu tudo bem";
        } else {
            $_SESSION['tipoErro']  = "500";
            $_SESSION['descricao'] = "Ocorreu um erro ao tentar inserir o dado no banco de dados, tente mais tarde. Obrigado!";
            header('Location: ../../dashboard/404.php');
        }
    }

    # Função para fazer o update
    public function update(TipoUtilizador $objecto) {
  
        #Query  para fazer o update
        $query = "UPDATE tbtipoutilizador SET descricao='".$objecto->getDescricao()."' WHERE idtbTipoUtilizador = ".$objecto->getIdTipoUser().";";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            $_SESSION['tipoErro']  = "500";
            $_SESSION['descricao'] = "Ocorreu um erro ao tentar actualizar os dados no banco de dados, tente mais tarde. Obrigado!";
            header('Location: ../../dashboard/404.php'); 
        }

    }

    # Função para fazer o dele
    public function delete($id) {

        #Query para eliminar o tipo de user
        $query = "DELETE FROM tbtipoutilizador WHERE idtbTipoUtilizador = $id";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            $_SESSION['tipoErro']  = "500";
            $_SESSION['descricao'] = "Ocorreu um erro ao tentar eliminar o tipo de usuário no banco de dados, tente mais tarde. Obrigado!";
            header('Location: ../../dashboard/404.php'); 
        }
    }

    # Função para fazer o select
    public function select($idTipoUtilizador = 11) {

        $query = $this->conexao->prepare("SELECT * FROM tbtipoutilizador");
        if($query->execute()) {

            $resultado    = $query->get_result();
            while ($dados = $resultado->fetch_array()) {
                if($dados[0] == $idTipoUtilizador)
                    echo "<option selected value='$dados[0]'>$dados[1]</option>";
                else
                    echo "<option value='$dados[0]'>$dados[1]</option>";
            }

        } else {
            echo '<option value="erro">Erro</option>';
        }

    }
}


