<?php


class Inscricao{
    private $id;
    private $idCurso;
    private $curso;
    private $idCandidato;
    private $nomeCand;
    private $dtCriacao;
    private $dtEdicao;
    private $idEstado;
    private $estadoInscricao;
    private $faculdade;

    # CRIANDO O GET E O SET DO ID  DA INSCRIÇÃO
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    # CRIANDO O GET O SET DO CURSO DA INSCRIÇÃO
    public function getIdCurso() { return $this->idCurso; }
    public function setIdCurso($idCurso) { $this->idCurso = $idCurso; }

    # CRIANDO O GET E O SET DO NOME DO CURSO DA INSCRIÇÃO
    public function getCurso() { return $this->curso; }
    public function setCurso($curso) { $this->curso = $curso; }

    # CRIANDO O GET O SET DO ID DO CANDIDATO INSCRITO
    public function getIdCandidato() { return $this->idCandidato; }
    public function setIdCandidato($idCandidato) { $this->idCandidato = $idCandidato; }

    # CRINAOD O GET E O SET DO NOME DO CANDIDATO INSCRITO
    public function getNomeCand() { return $this->nomeCand; }
    public function setNomeCand($nomeCand) { $this->nomeCand = $nomeCand; }

    # CRIANDO O GET E O SET DA DATA DE CRIAÇÃO DA INSCRIÇÃO
    public function getDtCriacao() { return $this->dtCriacao; }
    public function setDtCriacao($dtCriacao) { $this->dtCriacao = $dtCriacao; }

    # CRIANDO O GET E O SET DA DATA DE EDIÇÃO DA INSCRIÇÃO
    public function getDtEdicao() { return $this->dtEdicao; }
    public function setDtEdicao($dtEdicao) { $this->dtEdicao = $dtEdicao; }

    # CRIANDO O GET O SET DO ID DO ESTADO DA INSCRIÇÃO
    public function getIdEstado() { return $this->idEstado; }
    public function setIdEstado($idEstado) { $this->idEstado = $idEstado; }

    # Crinaod o set o get do estado da inscricao
    public function getEstadoInscricao() { return $this->estadoInscricao; }
    public function setEstadoInscricao($estadoInscricao) { $this->estadoInscricao = $estadoInscricao; }

    # Crinaod o set o get do estado da faculdade
    public function getFaculdade() { return $this->faculdade; }
    public function setFaculdade($faculdade) { $this->faculdade = $faculdade; }
}
