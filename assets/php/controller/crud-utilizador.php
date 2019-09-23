<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');

# CRIANDO O CRUD DO UTILIZADOR


class CrudUtilizador extends Conexao {

    # CRIANDO A FUNÇÃO PARA FAZER O INSERT NO BANCO DE DADOS
    public function insert(Utilizador $model) {
        #Incializando a conexão
        $this->connect();
        
        $query = "SELECT * FROM tbutilizador WHERE email = '".$model->getEmail()."' OR  telefone = '".$model->getTelefone()."'";
        if($result = mysqli_query($this->conexao, $query)) {
            if(mysqli_num_rows($result) > 0 ) {

                echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                       <h4 class="alert-heading">O E-mail ou Telefone já está registado.</h4>
                       <p>Tente um outro E-mail ou Telefone, Obrigado!</p>
                    </div>';

            } else {
             $query  = "INSERT INTO tbutilizador(nome, email, telefone, senha, dtCriacao, dtEdicao, idtbTipoUtilizador, idEstado, idSexo) 
                VALUES ('".$model->getNome()."',
                '".$model->getEmail()."',
                '".$model->getTelefone()."',
                '".$model->getSenha()."',
                '".$model->getDtCriacao()."',
                '".$model->getDtEdicao()."',
                ".$model->getIdTipoUtilizador().",
                ".$model->getIdEstado().",
                ".$model->getIdSexo().");";

                if(mysqli_query($this->conexao, $query)) {
                    echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                            </button>
                            <h4 class="alert-heading">'.$model->getNome().'</h4>
                            <p>Foi adicionado com sucesso!.</p>
                            <p class="mb-0">'.date('d-m-Y H:s').'</p>
                            </div>';
                } else {
                    echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                            </button>
                            <h4 class="alert-heading">'.$model->getNome().'</h4>
                            <p>Não foi adicionado com sucesso!.</p>
                            <p class="mb-0">'.date('d-m-Y H:s').'</p>
                        </div>';
                }
            }
        } else {
            echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                       <h4 class="alert-heading">Ocorreu um erro.</h4>
                       <p>Tente mais tarde.</p>
                    </div>';
        }
        mysqli_close($this->conexao);
    }

    # CRIANDO A FUNÇÃO PARA FAZER O UPDATE DO UTILIZADOR NO BANCO DE DADOS
    public function update(Utilizador $model) {

        $this->connect();

        $query = "SELECT * FROM tbutilizador WHERE email = '".$model->getEmail()."' AND idUtilizador <> ".$model->getId()." OR  telefone = '".$model->getTelefone()."' AND idUtilizador <> ".$model->getId().";";
        if($result = mysqli_query($this->conexao, $query)) {
            if(mysqli_num_rows($result) > 0 ) {

                echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                       <h4 class="alert-heading">O E-mail ou Telefone já está registado.</h4>
                       <p>Tente um outro E-mail ou Telefone, Obrigado!</p>
                    </div>';

            } else {
                $query = "UPDATE tbutilizador SET 
                  nome               = '".$model->getNome()."',
                  email              = '".$model->getEmail()."',
                  telefone           = '".$model->getTelefone()."',
                  senha              = '".$model->getSenha()."',
                  dtEdicao           = '".$model->getDtEdicao()."',
                  idtbTipoUtilizador = ".$model->getIdTipoUtilizador().",
                  idEstado           = ".$model->getIdEstado().",
                  idSexo             = ".$model->getIdSexo()."
                  WHERE idUtilizador = ".$model->getId().";";


                if(mysqli_query($this->conexao, $query)) {
                    echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <h4 class="alert-heading">'.$model->getNome().'</h4>
                                <p>Foi editado com sucesso!</p>
                                <p class="mb-0">'.date('d-m-Y H:s').'</p>
                            </div>';

                } else {
                    echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <h4 class="alert-heading">'.$model->getNome().'</h4>
                                <p>Não foi editado com sucesso!</p>
                                <p class="mb-0">'.date('d-m-Y H:s').'</p>
                            </div>';
                }

            }
        } else {
            echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                       <h4 class="alert-heading">Ocorreu um erro.</h4>
                       <p>Tente mais tarde.</p>
                    </div>';
        }

         # FECHANDO A CONEXÃO
         mysqli_close($this->conexao);
    }


    # CRIANDO A FUNÇÃO PARA RECUPERAR O UTILIZADOR NO BANCO DE DADOS
    public function delete($id) {
        $this->connect();

        $query = "UPDATE tbutilizador SET idEstado = 3 WHERE idUtilizador = $id";
        if(mysqli_query($this->conexao, $query)){
            header('Location: ../../dashboard/utilizador/vertodos.php');
        } else {
            header('Location: ../../dashboard/404.php');
        }

        mysqli_close($this->conexao);
    }

    # CRIANDO A FUNÇÃO PARA FAZER O DELETE DO UTILIZADOR NO BANCO DE DADOS
    public function recuperar($id) {
        $this->connect();

        $query = "UPDATE tbutilizador SET idEstado = 1 WHERE idUtilizador = $id";
        if(mysqli_query($this->conexao, $query)){
            header('Location: ../../dashboard/utilizador/vertodos.php');
        } else {
            header('Location: ../../dashboard/404.php');
        }

        mysqli_close($this->conexao);
    }

    # CRINAOD A FUNÇÃO PARA FAZER O SELECT DE TODOS OS UTILIZADORES
    public function select() {
        $this->connect();

        $query  = "SELECT * FROM verUtilizador WHERE idestado <> 3 ORDER BY nome;";
        $result = mysqli_query($this->conexao, $query);

        $users = array();
        while($dados = mysqli_fetch_assoc($result)) {
            $objecto =  new Utilizador();
            $objecto->  setId($dados["idutilizador"]);
            $objecto->  setNome($dados["nome"]);
            $objecto->  setEmail($dados["email"]);
            $objecto->  setTelefone($dados["telefone"]);
            $objecto->  setTipoUtilizador($dados['TipoUtil']);
            $objecto->  setSexo($dados['sexo']);
            $objecto->  setIdSexo($dados["idsexo"]);
            $objecto->  setDtCriacao($dados["dtcriacao"]);
            $objecto->  setDtEdicao($dados["dtedicao"]);
            $objecto->  setIdTipoUtilizador($dados["idtbTipoUtilizador"]);
           
            $users[] =  $objecto;
        }

       mysqli_close($this->conexao);
       return $users;  
    }


    # CRINAOD A FUNÇÃO PARA FAZER O SELECT DE TODOS OS UTILIZADORES
    public function selectUserDeleted() {
        $this->connect();

        $query  = "SELECT * FROM verUtilizador WHERE idestado = 3 ORDER BY nome;";
        $result = mysqli_query($this->conexao, $query);

        $users = array();
        while($dados = mysqli_fetch_assoc($result)) {
            $objecto =  new Utilizador();
            $objecto->  setId($dados["idutilizador"]);
            $objecto->  setNome($dados["nome"]);
            $objecto->  setEmail($dados["email"]);
            $objecto->  setTelefone($dados["telefone"]);
            $objecto->  setTipoUtilizador($dados['TipoUtil']);
            $objecto->  setSexo($dados['sexo']);
            $objecto->  setIdSexo($dados["idsexo"]);
            $objecto->  setDtCriacao($dados["dtcriacao"]);
            $objecto->  setDtEdicao($dados["dtedicao"]);
            $objecto->  setIdTipoUtilizador($dados["idtbTipoUtilizador"]);
           
            $users[] =  $objecto;
        }

       mysqli_close($this->conexao);
       return $users;  
    }


     # CRINAOD A FUNÇÃO PARA FAZER O SELECT DO UTILIZADOR APARTIR DO ID
     public function selectById($id) {
        $this->connect();

        $query  = "SELECT * FROM verUtilizador WHERE idutilizador = $id;";
        $result = mysqli_query($this->conexao, $query);

        $users = array();
        while($dados = mysqli_fetch_assoc($result)) {
            $objecto =  new Utilizador();
            $objecto->  setId($dados["idutilizador"]);
            $objecto->  setNome($dados["nome"]);
            $objecto->  setEmail($dados["email"]);
            $objecto->  setTelefone($dados["telefone"]);
            $objecto->  setTipoUtilizador($dados['TipoUtil']);
            $objecto->  setSexo($dados['sexo']);
            $objecto->  setIdSexo($dados["idsexo"]);
            $objecto->  setDtCriacao($dados["dtcriacao"]);
            $objecto->  setDtEdicao($dados["dtedicao"]);
            $objecto->  setIdTipoUtilizador($dados["idtbTipoUtilizador"]);
        }

       mysqli_close($this->conexao);
       return $objecto; 
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