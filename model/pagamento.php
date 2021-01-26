<?php

# CRIANDO MODELO DO PAGAMENTO

class Pagamento {
    private $id;
    private $comprovativo;
    private $tempo;
    private $idInscricao;
    private $estado;
    private $dtPagamento;
    private $dtEdicao;
    private $nomeCand;
    private $curso;
    private $preco;



    # CRIANDO O GET E SET DO ID DO PAGAMENTO
    public function getId() { return $this->id; }
    public function setId($id)  { $this->id = $id; }

    # CRIANDO O GET E O SET DA FORMA DE PAGAMENTO
    public function getComprovativo() { return $this->comprovativo; }
    public function setComprovativo($comprovativo) { $this->comprovativo = $comprovativo; }

    # CRIANDO O GET E O SET DO TEMPO DE LIMITE DO PAGAMENTO
    public function getTempo() { return $this->tempo; }
    public function setTempo($tempo) { $this->tempo = $tempo; }

    # CRIANDO O GET E O SET DO ID DA INSCRICAO DO PAGAMENTO
    public function getIdInscricao() { return $this->idInscricao; }
    public function setIdInscricao($idInscricao) { $this->idInscricao = $idInscricao; }

    # CRINADO O GET E O SET DO ESTADO DO PAGAMENTO
    public function getEstado() { return $this->estado; }
    public function setEstado($estado) { $this->estado = $estado; }


    # CRIAND O GET O SET DA DATA DE PAGAMENTO
    public function getDtPagamento() { return $this->dtPagamento; }
    public function setDtPagamento($dtPagamento) { $this->dtPagamento = $dtPagamento; }

    # CRIANDO O GET O SET DA DATA DE EDIÇÃO DO PAGAMENTO
    public function getDtEdicao() { return $this->dtEdicao; }
    public function setDtEdicao($dtEdicao) { $this->dtEdicao = $dtEdicao; }


    # CRIANDO O GET E O SET DO NOME DO CANDIDATO QUE VAI EFECTUAR OU JÁ FEZ O PAGAMENTO
    public function getNomeCand() { return $this->nomeCand; }
    public function setNomeCand($nomeCand) { $this->nomeCand = $nomeCand; }

   
    # CRIANDO O GET O SET DO CURSO A QUE FOI PAGO OU QUE VAO SER PAGO
    public function getCurso() { return $this->curso; }
    public function setCurso($curso) { $this->curso = $curso; }

    # CRIANDO O GET E O SET DO PREÇO DO PAGAMENTO
    public function getPreco() { return $this->preco; }
    public function setPreco($preco) { $this->preco = $preco; }
}


?>