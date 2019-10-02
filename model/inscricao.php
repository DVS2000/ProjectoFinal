<?php


class Inscricao{
    private $id;
    private $idCurso;
    private $idCandidato;
    private $dtCriacao;
    private $dtEdicao;

    # CRIANDO O GET E O SET DO ID  DA INSCRIÇÃO
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    # CRIANDO O GET O SET DO CURSO DA INSCRIÇÃO
    public function getIdCurso() { return $this->idCurso; }
    public function setIdCurso($idCurso) { $this->idCurso = $idCurso; }

    # CRIANDO O GET O SET DO ID DO CANDIDATO INSCRITO
    public function getIdCandidato() { return $this->idCandidato; }
    public function setIdCandidato($idCandidato) { $this->idCandidato = $idCandidato; }

    # CRIANDO O GET E O SET DA DATA DE CRIAÇÃO DA INSCRIÇÃO
    public function getDtCriacao() { return $this->dtCriacao; }
    public function setDtCriacao($dtCriacao) { $this->dtCriacao = $dtCriacao; }

    # CRIANDO O GET E O SET DA DATA DE EDIÇÃO DA INSCRIÇÃO
    public function getDtEdicao() { return $this->dtEdicao; }
    public function setDtEdicao($dtEdicao) { $this->dtEdicao = $dtEdicao; }


}
