<?php


# Incluindo o ficheiro de conexao
include_once('conexao.php');


# CRIANDO A CLASS QUE VAI CONTER TODAS FUNÇÕES DO CRUD PARA O CURSO
class CrudCurso extends Conexao {

    function __construct() {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }
 
    # ::::::::::::::::::::::::::: CRUD COMPLETO :::::::::::::::::::::::::::::::::::

    # FUNÇÃO PARA FAZER O INSERT DO CURSO NO BANCO DE CADO
    public function insert(Curso $model) {

        $descricao              = $model->getDescricao();
        $preco                  = $model->getPreco();
        $requisitos             = $model->getRequisitos();
        $idEstado               = $model->getIdEstado();
        $dtCriao                = $model->getDtCriacao();
        $dtEdicao               = $model->getDtEdicao();
        $planoAula              = $model->getPlanoAula();

        
        $query = $this->conexao->prepare("SELECT * FROM tbCurso  WHERE descricao = ?");
        $query->bind_param('s', $descricao);
        
        
        if($query->execute()) {

            $query->store_result();
            if($query->num_rows > 0) {

                echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                       <h4 class="alert-heading">Este Curso já está registado.</h4>
                       <p>Tente um outro curso, Obrigado!</p>
                    </div>';


            } else {
                $query = $this->conexao->prepare("INSERT INTO tbCurso (descricao, preco, requisitos, idEstado, dtCriacao, dtEdicao, planoAula)  VALUES(?,?,?,?,?,?,?)");
                $query->bind_param('sssssss', $descricao, $preco, $requisitos, $idEstado, $dtCriao, $dtEdicao, $planoAula);    
                if($query->execute()) {
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
                       <p>Tente mais tarde.</p>
                    </div>';

        }

        # FECHANDO O COMANDO
        $query->close();
        # FECHANDO A CONEXÃO
        $this->conexao->close();
    }

    # Função para fazer o update do curso
    public function update(Curso $model) {

        $id                     = $model->getId();
        $descricao              = $model->getDescricao();
        $preco                  = $model->getPreco();
        $requisitos             = $model->getRequisitos();
        $idEstado               = $model->getIdEstado();
        $dtEdicao               = $model->getDtEdicao();
        $planoAula              = $model->getPlanoAula();


        $query = $this->conexao->prepare("SELECT * FROM tbCurso  WHERE descricao = ? AND idCurso <> ?");
        $query->bind_param('ss', $descricao, $id);

        
        if($query->execute()) {

            $query->store_result();
            if($query->num_rows > 0) {

                echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                       <h4 class="alert-heading">Este Curso já está registado.</h4>
                       <p>Tente um outro curso, Obrigado!</p>
                    </div>';


            } else {
                $query = $this->conexao->prepare("UPDATE tbCurso SET
                  descricao       =  ?,
                  preco           =  ?,
                  requisitos      =  ?,
                  planoAula       =  ?, 
                  idEstado        =  ?,
                  dtEdicao        =  ?
                  WHERE idCurso   =  ?");

                $query->bind_param('sssssss', $descricao, $preco, $requisitos, $planoAula, $idEstado, $dtEdicao, $id);
                    if($query->execute()) {
                        echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            <span class="sr-only">Close</span>
                                            </button>
                                            <h4 class="alert-heading">'.$model->getDescricao().'</h4>
                                            <p>Foi editado com sucesso!.</p>
                                            <p class="mb-0">'.date('d-m-Y H:s').'</p>
                                        </div>';
                    
                    } else {
                        echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                        </button>
                        <h4 class="alert-heading">'.$model->getDescricao().'</h4>
                        <p>Não foi editado com sucesso!.</p>
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
                       <p>Tente mais tarde.</p>
                    </div>';

        }

        # FECHANDO O COMANDO
        $query->close();
        # FECHANDO A CONEXÃO
        $this->conexao->close();
    } 

    # FUNÇÃO PARA FAZER O DELETE DO CURSO DE FORMA DEFINITIVA
    public function delete($id) {

        $query = $this->conexao->prepare("DELETE FROM tbcurso WHERE idCurso = $id");
        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            "Não correu tudo bem";
        }


         # FECHANDO O COMANDO
         $query->close();
         # FECHANDO A CONEXÃO
         $this->conexao->close();
    }

    # Função para listar todos os curso
    public function select() {
        
        $query = $this->conexao->prepare("SELECT * FROM verCursos WHERE idestado <> 2 ORDER BY descricao");
        
        $cursos = array();
        if($query->execute()) {

            $result      = $query->get_result();
            while($dados = $result->fetch_assoc()) {
                $curso = new Curso();
                $curso->       setId($dados["idcurso"]);
                $curso->       setDescricao($dados["descricao"]);
                $curso->       setPreco($dados["preco"]);
                $curso->       setRequisitos($dados["requisitos"]);
                $curso->       setPlanoAula($dados['planoAula']);
                $curso->       setIdEstado($dados["idestado"]);
                $curso->       setEstado($dados["estado"]);
                $curso->       setDtCriacao($dados["dtCriacao"]);
                $curso->       setDtEdicao($dados["dtEdicao"]);
                $cursos[] = $curso;
            }
        }

        return $cursos;
        
       # FECHANDO O COMANDO
       $query->close();
       # FECHANDO A CONEXÃO
       $this->conexao->close();
    }

    # ::::::::::::::::::::::::::: FUNÇÕES ADICIONAL :::::::::::::::::::::::::::::::::::

    # Função para listar todos os curso
    public function selectDesactivado() {
        
        $query = $this->conexao->prepare("SELECT * FROM verCursos WHERE idestado = 2 ORDER BY descricao");

        $cursos = array();
        if($query->execute()) {

            $result      = $query->get_result();
            while($dados = $result->fetch_assoc()) {
                $curso = new Curso();
                $curso->       setId($dados["idcurso"]);
                $curso->       setDescricao($dados["descricao"]);
                $curso->       setPreco($dados["preco"]);
                $curso->       setRequisitos($dados["requisitos"]);
                $curso->       setPlanoAula($dados['planoAula']);
                $curso->       setIdEstado($dados["idestado"]);
                $curso->       setEstado($dados["estado"]);
                $curso->       setDtCriacao($dados["dtCriacao"]);
                $curso->       setDtEdicao($dados["dtEdicao"]);
                $cursos[] = $curso;
            }
        } else {
            return $cursos;
        }
        
        
        return $cursos;

        # FECHANDO O COMANDO
       $query->close();
       # FECHANDO A CONEXÃO
       $this->conexao->close();

    }

    # Função para Activar o curso
    public function enable($id) {

        $query = $this->conexao->prepare("UPDATE tbcurso SET idEstado = 1 WHERE idCurso = $id");
        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # FECHANDO O COMANDO
       $query->close();
       # FECHANDO A CONEXÃO
       $this->conexao->close();
    }
    # Função para Desactivar o curso
    public function disable($id) {

        $query = $this->conexao->prepare("UPDATE tbcurso SET idEstado = 2 WHERE idCurso = $id");
        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # FECHANDO O COMANDO
       $query->close();
       # FECHANDO A CONEXÃO
       $this->conexao->close();
    }

    # Função para pesquisar o curso
    public function search($descricao) {

        $query = $this->conexao->prepare("SELECT * FROM verCursos WHERE descricao  LIKE '% ? %' ORDER BY descricao");
        $query->bind_param('s', $descricao);

        $cursos = array();
        if($query->execute()) {

            $result      = $query->get_result(); 

            while($dados = $result->fetch_assoc()) {
                $curso   = new Curso();
                $curso->       setId($dados["idCurso"]);
                $curso->       setDescricao($dados["descricao"]);
                $curso->       setPreco($dados["preco"]);
                $curso->       setRequisitos($dados["requisitos"]);
                $curso->       setIdEstado($dados["idEstado"]);
                $curso->       setEstado($dados["estado"]);
                $curso->       setDtCriacao($dados["dtCriacao"]);
                $curso->       setDtEdicao($dados["dtEdicao"]);
                $cursos[] = $curso;

            }
        }

        return $cursos;

        # FECHANDO O COMANDO
       $query->close();
       # FECHANDO A CONEXÃO
       $this->conexao->close();

    }

    # Função para Pegar o curso vai id
    public function getById($id) {


        $query = $this->conexao->prepare("SELECT * FROM verCursos WHERE idcurso = ?");
        $query->bind_param('s', $id);

        if($query->execute()) {

            $result      = $query->get_result(); 
            $curso       = new Curso();
            while($dados = $result->fetch_assoc()) {
                $curso->       setId($dados["idcurso"]);
                $curso->       setDescricao($dados["descricao"]);
                $curso->       setPreco($dados["preco"]);
                $curso->       setRequisitos($dados["requisitos"]);
                $curso->       setPlanoAula($dados["planoAula"]);
                $curso->       setIdEstado($dados["idestado"]);
                $curso->       setEstado($dados["estado"]);
                $curso->       setDtCriacao($dados["dtCriacao"]);
                $curso->       setDtEdicao($dados["dtEdicao"]);
            }
        }
        
        
        return $curso;

       # FECHANDO O COMANDO
       $query->close();
       # FECHANDO A CONEXÃO
       $this->conexao->close();

    }

}