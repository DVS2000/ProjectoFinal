<?php

# CRIANDO O MODELO DO CANDIDATO

class Candidato {
    private $id;
    private $nome;
    private $bi;
    private $email;
    private $telefone;
    private $dtNasc;
    private $idNacionalidade;
    private $idEstado;
    private $dtCriacao;
    private $dtEdicao;
    private $nomeMae;
    private $nomePai;
    private $morada;


    # CRIANDO O GET E SET DO ID DO CANDIDATO
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    # CRIANDO O GET E O SET DO NOME DO CANDIDATO
    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }

    # CRIANDO O GET E O SET DO BILHETE DE IDENTIDADE DP CANDIDATO
    public function getBi() { return $this->bi; }
    public function setBi($bi) { $this->bi = $bi; }

    # CRIANDO O GET E O SET DO EMAIL DO CANDIDADO
    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    # CRIANDO O GET E O SET DO TELEFONE DO CANDIDATO
    public function getTelefone() { return $this->telefone; }
    public function setTelefone($telefone) { $this->telefone = $telefone; }

    # CRIANDO O GET E O SET DA DATA DE NASCIMENTO DO CADNDIDATO
    public function getDtNasc() { return $this->dtNasc; }
    public function setDtNasc($dtNasc) { $this->dtNasc = $dtNasc; }

    # CRIANDO O GET E O SET DO ID DA NACIONALIDADE DO CANDIDATO
    public function getIdNacionalidade() { return $this->idNacionalidade; }
    public function setIdNacionalidade($idNacionalidade) { $this->idNacionalidade = $idNacionalidade; }

    # CRIANDO O GET E O SET DO ID DO ESTADO DO CANDIDADO 
    public function getIdEstado() { return $this->idEstado; }
    public function setIdEstado($idEstado) { $this->idEstado = $idEstado; }

    # CRIANDO O GET E O SET DA DATA DE CRIAÇÃO DO CANDIDATO
    public function getDtCriacao() { return $this->dtCriacao; }
    public function setDtCriacao($dtCriacao) { $this->dtCriacao = $dtCriacao; }

    # CRIANDO O GET E O SET DA DATA DE EDIÇÃO DO CANDIDATO
    public function getDtEdicao()  { return $this->dtEdicao; } 
    public function setDtEdicao($dtEdicao) { $this->dtEdicao = $dtEdicao; }

    # CRIANDO O GET E O SET DO NOME DA MAE DO CANDIDATO
    public function getNomeMae() { return $this->nomeMae; }
    public function setNomeMae($nomeMae) { $this->nomeMae = $nomeMae; }

    # CRIANDO O GET E O SET DO NOME DA MÃE DO CANDIDATO
    public function getNomePai() { return $this->nomePai;  }
    public function setNomePai($nomePai) { $this->nomePai = $nomePai; }

    # CRIANDO O GET E O SET DO NOME DO PAI DO CANDIDATO.
    public function getMorada() { return $this->morada; }
    public function setMorada($morada) { $this->morada = $morada; }
}