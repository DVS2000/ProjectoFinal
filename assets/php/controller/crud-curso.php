<?php


# Incluindo o ficheiro de conexao
include_once('conexao.php');

# CRIANDO A CLASS QUE VAI CONTER TODAS FUNÇÕES DO CRUD PARA O CURSO
class CrudCurso extends Conexao {

    public function insert(Curso $model) {
        # Abrindo a conexão
        $this->connect();

        $query = "INSERT  INTO tbCurso (descricao, preco, requisitos, idEstado, dtCriacao, dtEdicao)
                  VALUES('".$model->getDescricao()."',
                  ".$model->getPreco().",
                  '".$model->getRequisitos()."',
                  ".$model->getIdEstado().",
                  '".$model->getDtCriacao()."',
                  '".$model->getDtEdicao()."');";

        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
    }


    # Função para fazer o update do curso
    public function update(Curso $model) {
        # Abrindo a conexão
        $this->connect();

        $query = "UPDATE tbCurso SET
                  descricao       = '".$model->getDescricao()."',
                  preco           =  ".$model->getPreco().",
                  requisitos      = '".$model->getRequisitos()."',
                  idEstado        =  ".$model->getIdEstado().",
                  dtCriacao       = '".$model->getDtCriacao()."',
                  dtEdicao        = '".$model->getDtEdicao()."'
                  WHERE idCurso   =  ".$model->getId().";";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # Fechando a conexão
        mysqli_close($this->conexao);
    }

    # Função para fazer o delete do curso
    public function delete($id) {
        # ABRINDO A CONEXÃO
        $this->connect();

        $query = "UPDATE tbcurso SET idEstado = 3 WHERE idCurso = $id;";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
    }

    # Função para listar todos os curso
    public function select() {
        # Abrindo a conexão
        $this->connect();
        
        $query = "SELECT * FROM tbcurso";

        $cursos = array();
        if($result = mysqli_query($this->conexao, $query)) {

            while($dados = mysqli_fetch_assoc($result)) {
                $curso = new Curso();
                $curso->       setId($dados["idCurso"]);
                $curso->       setDescricao($dados["descricao"]);
                $curso->       setPreco($dados["preco"]);
                $curso->       setRequisitos($dados["requisitos"]);
                $curso->       setIdEstado($dados["idEstado"]);
                $curso->       setDtCriacao($dados["dtCriacao"]);
                $curso->       setDtEdicao($dados["dtEdicao"]);
                $cursos[] = $curso;
            }
        }
        
        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
        return $cursos;

    }

    # Função para pesquisar o curso
    public function search($descricao) {
        # Abrindo a conexão
        $this->connect();
        
        $query = "SELECT * FROM tbcurso WHERE descricao  LIKE '%$descricao%';";

        $cursos = array();
        if($result = mysqli_query($this->conexao, $query)) {

            while($dados = mysqli_fetch_assoc($result)) {
                $curso = new Curso();
                $curso->       setId($dados["idCurso"]);
                $curso->       setDescricao($dados["descricao"]);
                $curso->       setPreco($dados["preco"]);
                $curso->       setRequisitos($dados["requisitos"]);
                $curso->       setIdEstado($dados["idEstado"]);
                $curso->       setDtCriacao($dados["dtCriacao"]);
                $curso->       setDtEdicao($dados["dtEdicao"]);
                $cursos[] = $curso;

            }
        }
        
        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
        return $cursos;

    }

} 


