<?php

# CRIANDO MODELO DO PAGAMENTO

class Pagamento {
    private $id;
    private $idFormPag;
    private $formPag;
    private $tempo;
    private $idInscricao;
    private $estado;
    private $dtPagamento;
    private $dtEdicao;


    # CRIANDO O GET E SET DO ID DO PAGAMENTO
    public function getId() { return $this->id; }
    public function setId($id)  { $this->id = $id; }

    # CRIANDO O GET E SER DO ID DA FORMA DE PAGAMENTO
    public function getIdFormPag() { return $this->idFormPag; }
    public function setIdFormPag($idFormPag) { $this->idFormPag = $idFormPag; }

    # CRIANDO O GET E O SET DA FORMA DE PAGAMENTO
    public function getFormPag() { return $this->formPag; }
    public function setFormPag($formPag) { $this->formPag = $formPag; }

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
}


?>