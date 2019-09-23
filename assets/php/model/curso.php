<?php

# CRIANDO O MODELO DO CURSO

class Curso {
    private $id;
    private $descricao;
    private $preco;
    private $requisitos;
    private $idEstado;
    private $dtCriacao;
    private $dtEdicao;
    private $estado;

    # CRIANDO OS GETS E OS SETS DO Curso

    # CRIANDO O GET E O SET DO ID DO CURSO
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    # CRIANDO O GET E O SET DA DESCRIÇÃO DO CURSO
    public function getDescricao() { return $this->descricao; }
    public function setDescricao($descricao) { $this->descricao = $descricao; }

    # CRIANDO O GET E O SET DO PRECO DO CURSO
    public function getPreco() { return $this->preco; }
    public function setPreco($preco) { $this->preco = $preco; }

    # CRIANDO O GET E O SET DO REQUISITOS DO CURSO
    public function getRequisitos() { return $this->requisitos;  }
    public function setRequisitos($requisitos) { $this->requisitos = $requisitos; }

    # CRIANDO O GET E O SET DO ESTADO DO CURSO
    public function getIdEstado() { return $this->idEstado; }
    public function setIdEstado($idEstado) { $this->idEstado = $idEstado; }

    # CRIANDO O GET E O SET DA DATA DE CRIAÇÃO DO CURSO
    public function getDtCriacao() { return $this->dtCriacao; }
    public function setDtCriacao($dtCriacao) { $this->dtCriacao = $dtCriacao; }

    # CRIANDO O GET E O SET DA DATA DE EDIÇÃO DO CURSO
    public function getDtEdicao() { return $this->dtEdicao; }
    public function setDtEdicao($dtEdicao) { $this->dtEdicao = $dtEdicao; }

    # CRIANDO O GET E O SET DO ESTADO DO CURSO
    public function getEstado() { return $this->estado; }
    public function setEstado($estado) { $this->estado = $estado; }
}