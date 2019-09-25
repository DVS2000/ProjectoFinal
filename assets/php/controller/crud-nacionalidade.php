<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');

# CRIANDO O CRUD DA NACIONALIDADE

class CrudNacionalidade extends Conexao {

    # CRIANDO A FUNÇÃO PARA FAZER O INSERT DA NACIONALIDADE
    public function insert(Nacionalidade $model) {
        # Abriando a conexao;
        $this->connect();

        $query = "SELECT * FROM tbnacionalidade WHERE descricao = '".$model->getDescricao()."';";
        if($result = mysqli_query($this->conexao, $query)) {
            if(mysqli_num_rows($result) > 0) {
                echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
                   <h4 class="alert-heading">Esta nacionalidade já está registada.</h4>
                   <p>Tente uma outra nacionalidade, Obrigado!</p>
                </div>';

            } else {
                $query = "INSERT INTO tbnacionalidade(descricao, idEstado, dtCriacao, dtEdicao) VALUES('".$model->getDescricao()."',".$model->getIdEstado().", '".$model->getDtCriacao()."', '".$model->getDtEdicao()."');";
            
                if(mysqli_query($this->conexao, $query)) {
                    echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <h4 class="alert-heading">'.$model->getDescricao().'</h4>
                                <p>Foi adicionado com sucesso!</p>
                                <p class="mb-0">'.date('d-m-Y H:s').'</p>
                            </div>';
                } else {
                    echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                        </button>
                        <h4 class="alert-heading">'.$model->getDescricao().'</h4>
                        <p>Não foi adicionado com sucesso!</p>
                        <p class="mb-0">'.date('d-m-Y H:s').'</p>
                    </div>';
                }
            }

        } else {
            echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
               <h4 class="alert-heading">Ocorreu um erro.</h4>
               <p>Tente mais tarde, Obrigado!</p>
            </div>';

        }

        # Fechando a conexão
        mysqli_close($this->conexao);
    }

    # CRIANDO A FUNÇÃO PARA FAZER O UPDATE DA NACIONALIDADE
    public function update(Nacionalidade $model) {
        # Abrindo a conexão
        $this->connect();


        $query = "SELECT * FROM tbnacionalidade WHERE descricao = '".$model->getDescricao()."' AND idnacionalidade <> ".$model->getId().";";
        if($result = mysqli_query($this->conexao, $query)) {
            if(mysqli_num_rows($result) > 0) {
                echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
                   <h4 class="alert-heading">Esta nacionalidade já está registada.</h4>
                   <p>Tente uma outra nacionalidade, Obrigado!</p>
                </div>';

            } else {
                $query = "UPDATE tbnacionalidade SET descricao = '".$model->getDescricao()."', idestado = ".$model->getIdEstado().", dtEdicao = '".$model->getDtEdicao()."' WHERE idnacionalidade = ".$model->getId().";";
                if(mysqli_query($this->conexao, $query)) {
                    echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <h4 class="alert-heading">'.$model->getDescricao().'</h4>
                                <p>Foi editado com sucesso!</p>
                                <p class="mb-0">'.date('d-m-Y H:s').'</p>
                            </div>';
                } else {
                    echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <h4 class="alert-heading">'.$model->getDescricao().'</h4>
                                <p>Não foi editado com sucesso!</p>
                                <p class="mb-0">'.date('d-m-Y H:s').'</p>
                            </div>';
                }
            }

        } else {
            echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
               <h4 class="alert-heading">Ocorreu um erro.</h4>
               <p>Tente mais tarde, Obrigado!</p>
            </div>';

        }
        
    } 

    # CRIANDO A FUNÇÃO PARA ELIMINAR A NACIONALIDADE
    public function delete($id) {
        # ABRINDO A CONEXÃO
        $this->connect();

        $query = "DELETE FROM tbNacionalidade WHERE idNacionalidade = $id";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
    }

    # CRIANDO A FUNÇÃO PARA LISTAR TODAS NACIONALIDADE
    public function select() {
        # Abrindom a conexao
        $this->connect();

        $query     = "SELECT * FROM tbnacionalidade WHERE idestado <> 2";
        $result    = mysqli_query($this->conexao, $query);
        $nacional  = array();

        while($dados = mysqli_fetch_assoc($result)) {
            $objecto = new Nacionalidade();
            $objecto->      setId($dados["idnacionalidade"]);
            $objecto->      setDescricao($dados["descricao"]);
            $objecto->      setIdEstado($dados["idestado"]);
            $objecto->      setDtCriacao($dados["dtCriacao"]);
            $objecto->      setDtEdicao($dados["dtEdicao"]);
            $nacional[] = $objecto;
        }

        return $nacional;
    }

     /* ===========FUNÇÕES ADICIONAL =========== */

    # CRIANDO A FUNÇÃO PARA LISTAR TODAS NACIONALIDADE
    public function selectDesactivado() {
        # Abrindom a conexao
        $this->connect();

        $query     = "SELECT * FROM tbnacionalidade WHERE idestado = 2";
        $result    = mysqli_query($this->conexao, $query);
        $nacional  = array();

        while($dados = mysqli_fetch_assoc($result)) {
            $objecto = new Nacionalidade();
            $objecto->      setId($dados["idnacionalidade"]);
            $objecto->      setDescricao($dados["descricao"]);
            $objecto->      setIdEstado($dados["idestado"]);
            $objecto->      setDtCriacao($dados["dtCriacao"]);
            $objecto->      setDtEdicao($dados["dtEdicao"]);
            $nacional[] = $objecto;
        }

        return $nacional;
    }

    # CRIANDO A FUNÇÃO PARA Activar A NACIONALIDADE
    public function enable($id) {
        # Abrindo a conexão
        $this->connect();
        $query = "UPDATE tbnacionalidade SET idestado = 1 WHERE idnacionalidade = $id;";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }
    }
    
    # CRIANDO A FUNÇÃO PARA DESABLITAR A NACIONALIDADE
    public function disable($id) {
        # Abrindo a conexão
        $this->connect();
        $query = "UPDATE tbnacionalidade SET idestado = 2 WHERE idnacionalidade = $id;";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }
    } 

     # CRIANDO A FUNÇÃO PARA LISTAR TODAS NACIONALIDADE
     public function serach($descricao) {
        # Abrindom a conexao
        $this->connect();

        $query     = "SELECT * FROM tbnacionalidade WHERE descricao LIKE '%$descricao%' ORDER BY descricao;";
        $result    = mysqli_query($this->conexao, $query);
        $nacional  = array();

        while($dados = mysqli_fetch_assoc($result)) {
            $objecto = new Nacionalidade();
            $objecto->      setId($dados["idnacionalidade"]);
            $objecto->      setDescricao($dados["descricao"]);
            $objecto->      setIdEstado($dados["idestado"]);
            $objecto->      setDtCriacao($dados["dtCriacao"]);
            $objecto->      setDtEdicao($dados["dtEdicao"]);
            $nacional[] = $objecto;
        }

        return $nacional;
    }

    # CRIANDO A FUNÇÃO PARA LISTAR NACIONALIDADE PELO ID
    public function getById($id) {
        # Abrindom a conexao
        $this->connect();

        $query     = "SELECT * FROM tbnacionalidade WHERE idnacionalidade = $id;";
        $result    = mysqli_query($this->conexao, $query);

        $objecto   = new Nacionalidade();
        while($dados = mysqli_fetch_assoc($result)) {
            $objecto->      setId($dados["idnacionalidade"]);
            $objecto->      setDescricao($dados["descricao"]);
            $objecto->      setIdEstado($dados["idestado"]);
            $objecto->      setDtCriacao($dados["dtCriacao"]);
            $objecto->      setDtEdicao($dados["dtEdicao"]);
            
        }

        return $objecto;
    }
}
