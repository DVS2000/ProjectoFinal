<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');


class CrudInscricao extends Conexao {

    function __construct() {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }

    public function insert(Inscricao $model) {
        $idCurso        = $model->getIdCurso();
        $idCandidato    = $model->getIdCandidato();
        $dtCriacao      = $model->getDtCriacao();
        $dtEdicao       = $model->getDtEdicao();

        echo $idCurso;

        
        $query = $this->conexao->prepare("INSERT INTO tbInscricao(idCurso, idCandidato, dtCriacao, dtEdicao) VALUES(?, ?, ?, ?)");
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


    public function getMaxId($idCandidato) {

        $query = $this->conexao->prepare("SELECT MAX(id) FROM tbInscricao WHERE idCandidato = ?");
        $query->bind_param('i', $idCandidato);

        $query->execute();
        $result      = $query->get_result();
        $dados = $result->fetch_array();

        return $dados[0];
    }
}