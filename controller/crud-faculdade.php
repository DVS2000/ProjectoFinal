<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');



# CRIANDO O CRUD DA Faculdade
class CrudFaculdade extends Conexao {

    function __construct() {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }


    # CRIANDO A FUNÇÃO PARA FAZER O INSERT DA Faculdade
    public function insert(Faculdade $model) {


        $descricao          = $model->getDescricao();
        $idEstado           = $model->getIdEstado();
        $dtCriacao          = $model->getDtCriacao();
        $dtEdicao           = $model->getDtEdicao();

        $query = $this->conexao->prepare("SELECT * FROM tbFaculdade WHERE descricao = ?");
        $query->bind_param('s', $descricao);
    
        if($query->execute()) {
            $query->store_result();
            if($query->num_rows > 0) {

                return '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
                   <h4 class="alert-heading">Esta Faculdade já está registada.</h4>
                   <p>Tente uma outra Faculdade, Obrigado!</p>
                </div>';

            } else {

                $query = $this->conexao->prepare("INSERT INTO tbFaculdade(descricao, idEstado, dtCriacao, dtEdicao) VALUES(?, ?, ?, ?)");
                 $query->bind_param('ssss',$descricao, $idEstado, $dtCriacao, $dtEdicao);

                if($query->execute()) {
                    return '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                        </button>
                                        <h4 class="alert-heading">'.$descricao.'</h4>
                                        <p>Foi adicionado com sucesso!</p>
                                        <p class="mb-0">'.date('d-m-Y H:s').'</p>
                                    </div>';
                        } else {
                            return '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <h4 class="alert-heading">'.$descricao.'</h4>
                                <p>Não foi adicionado com sucesso!</p>
                                <p class="mb-0">'.date('d-m-Y H:s').'</p>
                            </div>';
                        }
       
            }

        } else {
            return '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
               <h4 class="alert-heading">Ocorreu um erro.</h4>
               <p>Tente mais tarde, Obrigado!</p>
            </div>';

        }

        # Fechando o comando
        $query->close();
        #Fechando a conexão
        $this->conexao->close();
    }

    # CRIANDO A FUNÇÃO PARA FAZER O UPDATE DA Faculdade
    public function update(Faculdade $model) {

        $id                 = $model->getId();
        $descricao          = $model->getDescricao();
        $idEstado           = $model->getIdEstado();
        $dtCriacao          = $model->getDtCriacao();
        $dtEdicao           = $model->getDtEdicao();


        $query = $this->conexao->prepare("SELECT * FROM tbFaculdade WHERE descricao = ? AND idFaculdade <> ?");
        $query->bind_param('ss', $descricao, $id);
        if($query->execute()) {

            $query->store_result();

            if($query->num_rows > 0) {
                return '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
                   <h4 class="alert-heading">Esta Faculdade já está registada.</h4>
                   <p>Tente uma outra Faculdade, Obrigado!</p>
                </div>';

            } else {
                $query = $this->conexao->prepare("UPDATE tbFaculdade SET descricao = ?, idestado = ?, dtEdicao = ? WHERE idFaculdade = ?");
                $query->bind_param('ssss', $descricao, $idEstado, $dtEdicao, $id);
                if($query->execute()) {
                    return '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <h4 class="alert-heading">'.$descricao.'</h4>
                                <p>Foi editado com sucesso!</p>
                                <p class="mb-0">'.date('d-m-Y H:s').'</p>
                            </div>';
                } else {
                    return '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <h4 class="alert-heading">'.$descricao.'</h4>
                                <p>Não foi editado com sucesso!</p>
                                <p class="mb-0">'.date('d-m-Y H:s').'</p>
                            </div>';
                }
            }

        } else {
            return '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
               <h4 class="alert-heading">Ocorreu um erro.</h4>
               <p>Tente mais tarde, Obrigado!</p>
            </div>';

        }
        
        # Fechando o comando
        $query->close();
        #Fechando a conexão
        $this->conexao->close();
    } 

    # CRIANDO A FUNÇÃO PARA ELIMINAR A Faculdade
    public function delete($id) {

        $query = $this->conexao->prepare("DELETE FROM tbFaculdade WHERE idFaculdade = ?");
        $query->bind_param('s', $id);
        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # Fechando o comando
        $query->close();
        #Fechando a conexão
        $this->conexao->close();
    }

    # CRIANDO A FUNÇÃO PARA LISTAR TODAS Faculdade
    public function select() {

        $query     = $this->conexao->prepare("SELECT * FROM tbFaculdade WHERE idEstado <> 2 ORDER BY descricao");
        $query     ->execute();
        $result    = $query->get_result();
        $nacional  = array();

        while($dados = $result->fetch_assoc()) {
            $objecto = new Faculdade();
            $objecto->      setId($dados["idFaculdade"]);
            $objecto->      setDescricao($dados["descricao"]);
            $objecto->      setIdEstado($dados["idEstado"]);
            $objecto->      setDtCriacao(date('d-m-Y',strtotime($dados["dtCriacao"])));
            $objecto->      setDtEdicao(date('d-m-Y',strtotime($dados["dtEdicao"])));
            $nacional[] = $objecto;
        }

        return $nacional;

        # Fechando o comando
        $query->close();
        #Fechando a conexão
        $this->conexao->close();
    }

     /* ===========FUNÇÕES ADICIONAL =========== */

    # CRIANDO A FUNÇÃO PARA LISTAR TODAS Faculdade
    public function selectDesactivado() {

        $query     = $this->conexao->prepare("SELECT * FROM tbFaculdade WHERE idEstado = 2");
        $query     ->execute();
        $result    = $query->get_result();
        $nacional  = array();

        while($dados = $result->fetch_assoc()) {
            $objecto = new Faculdade();
            $objecto->      setId($dados["idFaculdade"]);
            $objecto->      setDescricao($dados["descricao"]);
            $objecto->      setIdEstado($dados["idEstado"]);
            $objecto->      setDtCriacao(date('d-m-Y',strtotime($dados["dtCriacao"])));
            $objecto->      setDtEdicao(date('d-m-Y',strtotime($dados["dtEdicao"])));
            $nacional[] = $objecto;
        }

        return $nacional;
    }

    # CRIANDO A FUNÇÃO PARA Activar A Faculdade
    public function enable($id) {


        $query = $this->conexao->prepare("UPDATE tbFaculdade SET idestado = 1 WHERE idFaculdade = ?");
        $query->bind_param('s', $id);
        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # Fechando o comando
        $query->close();
        #Fechando a conexão
        $this->conexao->close();
    }
    
    # CRIANDO A FUNÇÃO PARA DESABLITAR A Faculdade
    public function disable($id) {


        $query = $this->conexao->prepare("UPDATE tbFaculdade SET idestado = 2 WHERE idFaculdade = ?");
        $query->bind_param('s', $id);
        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # Fechando o comando
        $query->close();
        #Fechando a conexão
        $this->conexao->close();
    } 

     # CRIANDO A FUNÇÃO PARA LISTAR TODAS Faculdade
     public function search($descricao) {

        $search    = "%{$descricao}%"; 

        $query     = $this->conexao->prepare("SELECT * FROM tbFaculdade WHERE descricao LIKE ? ORDER BY descricao");
        $query     ->bind_param('s', $search);
        $query     ->execute();
        $result    = $query->get_result();
        $nacional  = array();

        while($dados = $result->fetch_assoc()) {
            $objecto = new Faculdade();
            $objecto->      setId($dados["idFaculdade"]);
            $objecto->      setDescricao($dados["descricao"]);
            $objecto->      setIdEstado($dados["idEstado"]);
            $objecto->      setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
            $objecto->      setDtCriacao(date('d-m-Y', strtotime($dados["dtEdicao"])));
            $nacional[] = $objecto;
        }

        return $nacional;
    }

    # CRIANDO A FUNÇÃO PARA LISTAR Faculdade PELO ID
    public function getById($id) {


        $query     = $this->conexao->prepare("SELECT * FROM tbFaculdade WHERE idFaculdade = $id");
        $query     ->execute();
        $result    = $query->get_result();

        $objecto   = new Faculdade();
        while($dados = $result->fetch_assoc()) {
            $objecto->      setId($dados["idFaculdade"]);
            $objecto->      setDescricao($dados["descricao"]);
            $objecto->      setIdEstado($dados["idEstado"]);
            $objecto->      setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
            $objecto->      setDtCriacao(date('d-m-Y', strtotime($dados["dtEdicao"])));
            
        }

        return $objecto;
    }


    # CRIANDO A FUNÇÃO PARA LISTAR TODAS Faculdade NUM OPCTION
    public function options($id = 1) {

        $query     = $this->conexao->prepare("SELECT * FROM tbFaculdade WHERE idEstado <> 2");
        $query     ->execute();
        $result    = $query->get_result();
        $nacional  = array();

        while($dados = $result->fetch_assoc()) {
            $objecto = new Faculdade();
            $objecto->      setId($dados["idFaculdade"]);
            $objecto->      setDescricao($dados["descricao"]);
            
            if($objecto->getId() == $id) {
                echo '<option value="'.$objecto->getId().'" selected>'.$objecto->getDescricao().'</option>';
            } else {
                echo '<option value="'.$objecto->getId().'">'.$objecto->getDescricao().'</option>';
            }
        }

    

        # Fechando o comando
        $query->close();
        #Fechando a conexão
        $this->conexao->close();
    }
}
