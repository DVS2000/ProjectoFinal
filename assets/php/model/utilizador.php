<?php

# CRIANDO O MODEL DO UTILIZADOR

class Utilizador {
    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $senha;
    private $dtCriao;
    private $dtEdicao;
    private $idTipoUtilizador;
    private $idEstado;
    # CRAINDO OS GET E SET #

    # CRAINDO O GET E SETS DO ID UTILIZADOR
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    # CRAINDO O GET E SET DO NOME DO UTILIZADOR
    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }

    # CRIANDO O GET E SET DO EMAIL DO UTILIZADOR
    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    # CRIANDO O GET E SET DO TELEFONE DO UTILIZADOR
    public function getTelefone() { return $this->telefone; }
    public function setTelefone($telefone) { $this->telefone = $telefone; }

    # CREIANDO O GET E SET DO SENHA DO UTILIZADOR
    public function getSenha() { return $this->senha; }
    public function setSenha($senha) { $this->senha = md5($senha); }

    # CRIANDO O GET E SET DA DATA DA CRIAÇÃO DA CONTA DO UTLIZADOR
    public function getDtCriacao() { return $this->dtCriacao; }
    public function setDtCriacao($dtCriao) { $this->dtCriacao = $dtCriao; /* DESTE MODO A DATA DE CRIAÇÃO SERÁ SEMPRE A DATA ACTUAL */}

    # CRIANDO O GET E SET DA DATA DE EDIÇÃO DA CONTA DO UTILIZADOR
    public function getDtEdicao() { return $this->dtEdicao; }
    public function setDtEdicao($dtEdicao) { return $this->dtEdicao = $dtEdicao; /* DESTE MODO A DATA DE EDIÇÃO SERÁ SEMPRE A DATA ACTUAL */}

    # CRIANDO O GET E SET DO TIPO DE UTILIZADOR
    public function getIdTipoUtilizador() { return $this->idTipoUtilizador; }
    public function setIdTipoUtilizador($idTipoUtilizador) { $this->idTipoUtilizador = $idTipoUtilizador; }

    # CRIANDO O GET E SET DO ID DO ESTADO DO UTILIZADOR
    public function getIdEstado() { return $this->idEstado; }
    public function setIdEstado($idEstado) { $this->idEstado = $idEstado; }
}
