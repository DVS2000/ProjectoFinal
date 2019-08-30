<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');

# CRIANDO O CRUD DA NACIONALIDADE

class CrudNacionalidade extends Conexao {

    # CRIANDO A FUNÇÃO PARA FAZER O INSERT DA NACIONALIDADE
    public function insert(Nacionalidade $model) {
        # Abriando a conexao;
        $this->connect();
        $query = "INSERT INTO tbnacionalidade(descricao) VALUES('".$model->getDescricao()."');";
       
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo " Não correu tudo bem";
        }

        # Fechando a conexão
        mysqli_close($this->conexao);
    }


    # CRIANDO A FUNÇÃO PARA FAZER O UPDATE DA NACIONALIDADE
    public function update(Nacionalidade $model) {
        # Abrindo a conexão
        $this->connect();
        $query = "UPDATE tbnacionalidade SET descricao = '".$model->getDescricao()."' WHERE idnacionalidade = ".$model->getId().";";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }
    } 

    # CRIANDO A FUNÇÃO PARA LISTAR TODAS NACIONALIDADE
    public function select() {
        # Abrindom a conexao
        $this->connect();

        $query  = "SELECT * FROM tbnacionalidade";
        $result = mysqli_query($this->conexao, $query);
        
        $nacional = array();

        while($dados = mysqli_fetch_assoc($result)) {
            $objecto = new Nacionalidade();
            $objecto->setId($dados["idnacionalidade"]);
            $objecto->setDescricao($dados["descricao"]);
            $nacional[] = $objecto;
        }

        return $nacional;
    }
}
