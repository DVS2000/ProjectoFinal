<?php

# ADICIONANDO O FECHEIRO DE CONEXÃO
include_once('conexao.php');

class CrudPagamento extends Conexao {

    function __construct() {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }



    public function insert(Pagamento $model) {

        $idFormPag              = $model->getIdFormPag();
        $tempo                  = $model->getTempo();
        $idInscricao            = $model->getIdInscricao();
        $estado                 = $model->getEstado();

        $query = $this->conexao->prepare("INSERT INTO tbpagamento(idFormPag, tempo, idInscricao, estado) VALUES(?, ?, ?, ?)");
        $query->bind_param('isii', $idFormPag, $tempo, $idInscricao, $estado);

        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }


        # FECHANDO A QUERY
        $query->close();

        # FECHANDO CONEXÃO
        $this->conexao->close();
    }
}


