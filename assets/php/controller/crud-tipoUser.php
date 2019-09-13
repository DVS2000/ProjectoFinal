<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');


class CrudTipoUser extends Conexao {
    
    public function insert(TipoUtilizador $objecto) {
        $this->connect();
        # Query
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
        $this->connect();

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
        $this->connect();

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
        $this->connect();
        $selected = "selected";
        $query = "SELECT * FROM tbtipoutilizador";
        if($resultado = mysqli_query($this->conexao, $query)) {
            while ($dados = mysqli_fetch_array($resultado)) {
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


