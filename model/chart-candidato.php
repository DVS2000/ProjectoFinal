<?php

class ChartCandidato {

    private $id;
    private $numCand;
    private $mes;

    # CRIANDO O GET E SET DO ID DO GRÁFICO DO CANDIDATO 
    public function getId() { return $this->id; } 
    public function setId($id) { $this->id = $id; }
 
    # CRIANDO O GET E O SET DO NUMERO DE CANDIDATOS
    public function getNumCand() { return $this->numCand; } 
    public function setNumCand($numCand) { $this->numCand = $numCand; }

    # CRIANDO O GET E O SET DO MES 
    public function getMes() { return $this->mes; }
    public function setMes($mes) { $this->mes = $mes; }
}