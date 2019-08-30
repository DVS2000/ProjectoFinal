<?php


class Nacionalidade {

    # VARIAVEIS DA NACIONALIDADE 
    private $id;
    private $descricao;
    
    # CRIANDO OS GET E SET DO ID DA NACIONALIDADE
    public function getId() { return $this->id; }

    public function setId($id) { $this->id = $id; }

    # CRIANDO O GET E SET DA DESCRIÇÃO DA NACIONALIDADE
    public function getDescricao() { return $this->descricao; }

    public function setDescricao($descricao) { $this->descricao = $descricao; }
}
