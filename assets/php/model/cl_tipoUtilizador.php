<?php


# Modelo do tipo de utilizadot

class TipoUtilizador {
    private $idTipoUer;
    private $descrica;

    # Get e set do id do tipo user
    public function getIdTipoUser() { return $this->idTipoUser; }
    public function setIdTipoUser($id) { $this->idTipoUser = $id; }
    
    # Get e set da descrição do tipo de user
    public function getDescricao() { return $this->descricao; }
    public function setDescricao($desc) { $this->descricao = $desc; }
}
