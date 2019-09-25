<?php


# Incluindo o ficheiro de conexao
include_once('conexao.php');


# CRIANDO A CLASS QUE VAI CONTER TODAS FUNÇÕES DO CRUD PARA O CURSO
class CrudCurso extends Conexao {

    
    # FUNÇÃO PARA FAZER O INSERT DO CURSO NO BANCO DE CADO
    public function insert(Curso $model) {

        # ABRINDO A CONEXÃO
        $this->connect();
        
        $query = "SELECT * FROM tbCurso  WHERE descricao = '".$model->getDescricao()."';";
        
        if($result = mysqli_query($this->conexao, $query)) {
            if(mysqli_num_rows($result) > 0) {

                echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                       <h4 class="alert-heading">Este Curso já está registado.</h4>
                       <p>Tente um outro curso, Obrigado!</p>
                    </div>';


            } else {
                $query = "INSERT  INTO tbCurso (descricao, preco, requisitos, idEstado, dtCriacao, dtEdicao, planoAula)
                  VALUES('".$model->getDescricao()."',
                  ".$model->getPreco().",
                  '".$model->getRequisitos()."',
                  ".$model->getIdEstado().",
                  '".$model->getDtCriacao()."',
                  '".$model->getDtEdicao()."',
                  '".$model->getPlanoAula()."');";
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
                       <p>Tente mais tarde.</p>
                    </div>';

        }
        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
    }

    # Função para fazer o update do curso
    public function update(Curso $model) {
        # Abrindo a conexão
        $this->connect();


        $query = "SELECT * FROM tbCurso  WHERE descricao = '".$model->getDescricao()."' AND idCurso <>".$model->getId().";";
        
        if($result = mysqli_query($this->conexao, $query)) {
            if(mysqli_num_rows($result) > 0) {

                echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                       <h4 class="alert-heading">Este Curso já está registado.</h4>
                       <p>Tente um outro curso, Obrigado!</p>
                    </div>';


            } else {
                $query = "UPDATE tbCurso SET
                  descricao       = '".$model->getDescricao()."',
                  preco           =  ".$model->getPreco().",
                  requisitos      = '".$model->getRequisitos()."',
                  planoAula       = '".$model->getPlanoAula()."', 
                  idEstado        =  ".$model->getIdEstado().",
                  dtEdicao        = '".$model->getDtEdicao()."'
                  WHERE idCurso   =  ".$model->getId().";";
                    if(mysqli_query($this->conexao, $query)) {
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

        # Fechando a conexão
        mysqli_close($this->conexao);
    }

    # FUNÇÃO PARA FAZER O DELETE DO CURSO DE FORMA DEFINITIVA
    public function delete($id) {
        #Abrindo a conexão
        $this->connect();

        $query = "DELETE FROM tbcurso WHERE idCurso = $id";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            "Não correu tudo bem";
        }


        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
    }

    # Função para listar todos os curso
    public function select() {
        # Abrindo a conexão
        $this->connect();
        
        $query = "SELECT * FROM verCursos WHERE idestado <> 2 ORDER BY descricao";

        $cursos = array();
        if($result = mysqli_query($this->conexao, $query)) {

            while($dados = mysqli_fetch_assoc($result)) {
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
        
        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
        return $cursos;

    }

    /* ===========FUNÇÕES ADICIONAL =========== */

    # Função para listar todos os curso
    public function selectDesactivado() {
        # Abrindo a conexão
        $this->connect();
        
        $query = "SELECT * FROM verCursos WHERE idestado = 2 ORDER BY descricao";

        $cursos = array();
        if($result = mysqli_query($this->conexao, $query)) {

            while($dados = mysqli_fetch_assoc($result)) {
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
        
        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
        return $cursos;

    }

    # Função para Activar o curso
    public function enable($id) {
        # ABRINDO A CONEXÃO
        $this->connect();

        $query = "UPDATE tbcurso SET idEstado = 1 WHERE idCurso = $id;";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
    }
    # Função para Desactivar o curso
    public function disable($id) {
        # ABRINDO A CONEXÃO
        $this->connect();

        $query = "UPDATE tbcurso SET idEstado = 2 WHERE idCurso = $id;";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
    }

    # Função para pesquisar o curso
    public function search($descricao) {
        # Abrindo a conexão
        $this->connect();

        $query = "SELECT * FROM verCursos WHERE descricao  LIKE '%$descricao%' ORDER BY descricao;";

        $cursos = array();
        if($result = mysqli_query($this->conexao, $query)) {

            while($dados = mysqli_fetch_assoc($result)) {
                $curso = new Curso();
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
        
        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
        return $cursos;

    }

    # Função para Pegar o curso vai id
    public function getById($id) {
        # Abrindo a conexão
        $this->connect();
        
        $query = "SELECT * FROM verCursos WHERE idcurso = $id";
       
        if($result = mysqli_query($this->conexao, $query)) {
            $curso = new Curso();
            while($dados = mysqli_fetch_assoc($result)) {
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
        
        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
        return $curso;

    }

} 