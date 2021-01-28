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
    private $planoAula;
    private $foto;
    private $certificado;
    private $bilhete;

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

    # Crinaod o set o get da faculdade do curso da inscrição
    public function getFaculdade() { return $this->faculdade; }
    public function setFaculdade($faculdade) { $this->faculdade = $faculdade; }

    # Crinaod o set o get do plano curso em que o aluno se inscreveu
    public function getPlanoAula() { return $this->planoAula; }
    public function setPlanoAula($planoAula) { $this->planoAula = $planoAula; }

    # Criando o Get e o set para pegar a foto do candidato
    public function getFoto() { return $this->foto; }
    public function setFoto($foto) { $this->foto = $foto; }

    # Criando o get e o set para pegar o certificado do candidato
    public function getCertificado() { return $this->certificado; }
    public function setCertificado($certificado) { $this->certificado = $certificado; }

    # Criando o get e set para pegar o fiheiro do BI do candidato
    public function getBilheteFile() { return $this->bilhete; }
    public function setBilheteFile($bilhete) { $this->bilhete = $bilhete; }
}
