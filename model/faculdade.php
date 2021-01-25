<?php


class Faculdade {

    # VARIAVEIS DA NACIONALIDADE 
    private $id;
    private $descricao;
    private $idEstado;
    private $dtCriacao;
    private $dtEdicao;
    
    # CRIANDO OS GET E SET DO ID DA NACIONALIDADE
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    # CRIANDO O GET E SET DA DESCRIÇÃO DA NACIONALIDADE
    public function getDescricao() { return $this->descricao; }
    public function setDescricao($descricao) { $this->descricao = $descricao; }

    # CRIANDO O GET E O SET DO ID DA NACIONALIDADE
    public function getIdEstado() { return $this->idEstado; }
    public function setIdEstado($idEstado) { $this->idEstado = $idEstado; }

    # CRIANDO O GET E O SET DA DATA DE CRIAÇÃO DA NACIONALIDADE
    public function getDtCriacao() { return $this->dtCriacao; } 
    public function setDtCriacao($dtCriacao) { $this->dtCriacao = $dtCriacao;  }

    # CRINAOD O GET E O SET DA DATA DE EDIÇÃO DA NACIONALIDADE
    public function getDtEdicao() { return $this->dtEdicao; }
    public function setDtEdicao($dtEdicao) { $this->dtEdicao = $dtEdicao; }
}
