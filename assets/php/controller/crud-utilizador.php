<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');

# CRIANDO O CRUD DO UTILIZADOR


class CrudUtilizador extends Conexao {

    # CRIANDO A FUNÇÃO PARA FAZER O INSERT NO BANCO DE DADOS
    public function insert(Utilizador $model) {
        #Incializando a conexão
        $this->connect();

        $query;
        $query  = "INSERT INTO tbutilizador(nome, email, telefone, senha, dtCriacao, dtEdicao, idtbTipoUtilizador, idEstado) 
                VALUES ('".$model->getNome()."','".$model->getEmail()."','".$model->getTelefone()."','".$model->getSenha()."','".$model->getDtCriacao()."','".$model->getDtEdicao()."',".$model->getIdTipoUtilizador().",".$model->getIdEstado().");";

        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tuo bem";
        } else {
            echo "Não correu tudo bem";
        }
    }

    # CRIANDO A FUNÇÃO PARA FAZER O UPDATE DO UTILIZADOR NO BANCO DE DADOS
    public function update(Utilizador $model) {

        $this->connect();

        $query = "UPDATE tbutilizador SET 
                  nome               = '".$model->getNome()."',
                  email              = '".$model->getEmail()."',
                  telefone           = '".$model->getTelefone()."',
                  senha              = '".$model->getSenha()."',
                  dtEdicao           = '".$model->getDtEdicao()."',
                  idtbTipoUtilizador = ".$model->getIdTipoUtilizador().",
                  idEstado           = ".$model->getIdEstado()."
                  WHERE idUtilizador = ".$model->getId().";";

        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tuo bem";
         } else {
            echo "Não correu tudo bem";
         }

         # FECHANDO A CONEXÃO
         mysqli_close($this->conexao);
    }


    # CRIANDO A FUNÇÃO PARA FAZER O DELETE DO UTILIZADOR NO BANCO DE DADOS
    public function delete($id) {
        $this->connect();

        $query = "DELETE FROM tbutilizador WHERE idUtilizador = $id";
        if(mysqli_query($this->conexao, $query)){
            echo "Correu tudo bem";
        } else {
            $_SESSION['tipoErro']  = "500";
            $_SESSION['descricao'] = "Ocorreu um erro ao tentar inserir o dado no banco de dados, tente mais tarde. Obrigado!";
            header('Location: ../../dashboard/404.php');
        }

        mysqli_close($this->conexao);
    }

    # CRINAOD A FUNÇÃO PARA FAZER O SELECT DE TODOS OS UTILIZADORES
    public function select() {
        $this->connect();

        $query  = "SELECT * FROM tbutilizador";
        $result = mysqli_query($this->conexao, $query);

        $users = array();
        while($dados = mysqli_fetch_assoc($result)) {
            $objecto =  new Utilizador();
            $objecto->  setId($dados["idUtilizador"]);
            $objecto->  setNome($dados["nome"]);
            $objecto->  setEmail($dados["email"]);
            $objecto->  setTelefone($dados["telefone"]);
            $objecto->  setSenha($dados["senha"]);
            $objecto->  setDtCriacao($dados["dtcriacao"]);
            $objecto->  setDtEdicao($dados["dtEdicao"]);
            $objecto->  setIdTipoUtilizador($dados["idtbTipoUtilizador"]);
            $objecto->  setIdEstado($dados["idEstado"]);
            $users[] =  $objecto;
           
        }

       mysqli_close($this->conexao);
       return $users;  
    }

    # CRIANDO A FUNÇÃO PARA PESQUISAR UM OU MAIS UTILIZADORES
    public function search($nome) {
        $this->connect();

        $query = "SELECT * FROM tbutilizador WHERE $nome LIKE '%$nome%'";
        $result = mysqli_query($this->conexao, $query);

        $users = array();
        while($dados = mysqli_fetch_assoc($result)) {
            $objecto =  new Utilizador();
            $objecto->  setId($dados["idUtilizador"]);
            $objecto->  setNome($dados["nome"]);
            $objecto->  setEmail($dados["email"]);
            $objecto->  setTelefone($dados["telefone"]);
            $objecto->  setSenha($dados["senha"]);
            $objecto->  setDtCriacao($dados["dtcriacao"]);
            $objecto->  setDtEdicao($dados["dtEdicao"]);
            $objecto->  setIdTipoUtilizador($dados["idtbTipoUtilizador"]);
            $objecto->  setIdEstado($dados["idEstado"]);
            $users[] =  $objecto;
           
        }

        mysqli_close($this->conexao);
       return $users;
    }
}