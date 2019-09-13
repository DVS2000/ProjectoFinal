<?php


class Sexo {

    private $idSexo;
    private $descricao;



    # CRIANDO O GET E O SET DO ID DO SEXO:
    public function getIdSexo() { return $this->idSexo;  }
    public function setIdSexo($idSexo) { $this->idSexo = $idSexo; }


    # CRIANDO O GET E O SET DA DESCRIÇÃO DO SEXO 
    public function getDescricao() { return $this->descricao; }
    public function setDescricao($descricao) { $this->descricao = $descricao; }
}




?>