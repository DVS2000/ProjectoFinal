<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');


class CrudInscricao extends Conexao {

    function __construct() {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }



    /**:::::::::::::::::::::::: CRUD :::::::::::::::::::::::::: */

    public function insert(Inscricao $model) {
        $idCurso        = $model->getIdCurso();
        $idCandidato    = $model->getIdCandidato();
        $dtCriacao      = $model->getDtCriacao();
        $dtEdicao       = $model->getDtEdicao();

        
        $query = $this->conexao->prepare("INSERT INTO tbInscricao(idCurso, idCandidato, dtCriacao, dtEdicao, idEstado) VALUES(?, ?, ?, ?, 1)");
        $query->bind_param('iiss', $idCurso, $idCandidato, $dtCriacao, $dtEdicao);

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

    public function update(Inscricao $model) {
        $id             = $model->getId();
        $idCurso        = $model->getIdCurso();
        $dtEdicao           = date('Y-m-d');

    
        $query = $this->conexao->prepare("UPDATE tbInscricao SET idCurso = ?, dtEdicao = ? WHERE id = ?");
        $query->bind_param('isi', $idCurso, $dtEdicao, $id);

        if($query->execute()) {
            
            return 0;
        } else {
            return 1;
        }


        # FECHANDO O COMANDO 
        $query->close();

        # FECHANDO A CONEXÃO
        $this->conexao->close();
    }

    public function delete($id) {

        $query = $this->conexao->prepare("DELETE FROM tbInscricao WHERE id = ?");
        $query->bind_param('i', $id);

        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tod bem";
        }

        # FECHANDO O COMANDO
        $query->close();

        # FEHCANDO A CONEXÃO
        $this->conexao->close();
    }

    public function select() {

        $query = $this->conexao->prepare("SELECT * FROM verInscricao WHERE idEstado <> 2 ORDER BY nome");

        if($query->execute()) {
            

            $result = $query->get_result();

            $inscricoes = array();
            while ($dados = $result->fetch_assoc()) {
               $inscricao = new Inscricao();
               $inscricao->setId($dados['id']);
               $inscricao->setIdCurso($dados['idCurso']);
               $inscricao->setCurso($dados['curso']);
               $inscricao->setIdCandidato($dados['idCandidato']);
               $inscricao->setNomeCand($dados['nome']);
               $inscricao->setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
               $inscricao->setdtEdicao(date('d-m-Y', strtotime($dados["dtEdicao"])));
               $inscricao->setIdEstado($dados['idEstado']);
               $inscricoes[] = $inscricao;
            }

            return $inscricoes;
        } 
    }


    # ::::::::::::::::::::: FUNÇÕES ADICIONAIS ::::::::::::::::::::::::::::: #


    public function selectDisable() {

        $query = $this->conexao->prepare("SELECT * FROM verInscricao WHERE idEstado = 2 ORDER BY nome");

        if($query->execute()) {
            

            $result = $query->get_result();

            $inscricoes = array();
            while ($dados = $result->fetch_assoc()) {
               $inscricao = new Inscricao();
               $inscricao->setId($dados['id']);
               $inscricao->setIdCurso($dados['idCurso']);
               $inscricao->setCurso($dados['curso']);
               $inscricao->setIdCandidato($dados['idCandidato']);
               $inscricao->setNomeCand($dados['nome']);
               $inscricao->setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
               $inscricao->setdtEdicao(date('d-m-Y', strtotime($dados["dtEdicao"])));
               $inscricao->setIdEstado($dados['idEstado']);
               $inscricoes[] = $inscricao;
            }

            return $inscricoes;
        } 
    }

    public function enable($id) {

        $query = $this->conexao->prepare("UPDATE tbInscricao SET idEstado = 1 WHERE id = ?");
        $query->bind_param('i', $id);

        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }


        # FECHANDO O COMANDO
        $query->close();

        #FECHANDO A CONEXÃO
        $this->conexao->close();
    }

    public function disable($id) {
        $query = $this->conexao->prepare("UPDATE tbInscricao SET idEstado = 2 WHERE id = ?");
        $query->bind_param('i', $id);

        if($query->execute()) {

            echo "Correu tudo bem";

        } else {
            echo "Não correu tudo";
        }

        # FECHANDO COMANDO
        $query->close();

        # FECHANDO A CONEXÃO
        $this->conexao->close(); 
    }


    public function search($nomeCand) {

        $search = "%{$nomeCand}%";

        $query = $this->conexao->prepare("SELECT * FROM verInscricao WHERE idEstado <> 2 AND nome LIKE ? ORDER BY nome");
        $query->bind_param('s', $search);

        if($query->execute()) {
            

            $result = $query->get_result();

            $inscricoes = array();
            while ($dados = $result->fetch_assoc()) {
               $inscricao = new Inscricao();
               $inscricao->setId($dados['id']);
               $inscricao->setIdCurso($dados['idCurso']);
               $inscricao->setCurso($dados['curso']);
               $inscricao->setIdCandidato($dados['idCandidato']);
               $inscricao->setNomeCand($dados['nome']);
               $inscricao->setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
               $inscricao->setdtEdicao(date('d-m-Y', strtotime($dados["dtEdicao"])));
               $inscricao->setIdEstado($dados['idEstado']);
               $inscricoes[] = $inscricao;
            }

            return $inscricoes;
        } 
    }

    public function getByCandidato($idCandidato) {

        $query = $this->conexao->prepare("SELECT * FROM verInscricao WHERE idEstado <> 2 AND idCandidato = ?");
        $query->bind_param('i', $idCandidato);

        if($query->execute()) {
            

            $result = $query->get_result();

            $inscricoes = array();
            while ($dados = $result->fetch_assoc()) {
               $inscricao = new Inscricao();
               $inscricao->setId($dados['id']);
               $inscricao->setIdCurso($dados['idCurso']);
               $inscricao->setCurso($dados['curso']);
               $inscricao->setIdCandidato($dados['idCandidato']);
               $inscricao->setNomeCand($dados['nome']);
               $inscricao->setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
               $inscricao->setDtCriacao(date('d-m-Y', strtotime($dados["dtEdicao"])));
               $inscricao->setIdEstado($dados['idEstado']);
               $inscricoes[] = $inscricao;
            }

            return $inscricoes;
        } 
    }



    public function getById($id) {

        $query = $this->conexao->prepare("SELECT * FROM verInscricao WHERE idEstado <> 2 AND id = ?");
        $query->bind_param('i', $id);

        if($query->execute()) {
            

            $result = $query->get_result();
            $inscricao = new Inscricao();
            $inscricoes = array();
            while ($dados = $result->fetch_assoc()) {
               
               $inscricao->setId($dados['id']);
               $inscricao->setIdCurso($dados['idCurso']);
               $inscricao->setCurso($dados['curso']);
               $inscricao->setIdCandidato($dados['idCandidato']);
               $inscricao->setNomeCand($dados['nome']);
               $inscricao->setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
               $inscricao->setDtCriacao(date('d-m-Y', strtotime($dados["dtEdicao"])));
               $inscricao->setIdEstado($dados['idEstado']);
              
            }

            return $inscricao;
        } 
    }

    public function getMaxId($idCandidato) {

        $query = $this->conexao->prepare("SELECT MAX(id) FROM tbInscricao WHERE idCandidato = ?");
        $query->bind_param('i', $idCandidato);

        $query->execute();
        $result      = $query->get_result();
        $dados = $result->fetch_array();

        return $dados[0];
    }
}


