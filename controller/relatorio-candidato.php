<?php

include_once('conexao.php');

class RelatorioCandidato extends Conexao {

    function __construct() {
        # INCIALIZANDO ... A CONEXÃO
        parent::connect();
    }
    

    public function UpdateRelatorio() {

        $mes = date("m");
        $query = "SELECT MAX(id) FROM tbrelatoriocandidato WHERE mes = $mes";
        if($result = mysqli_query($this->conexao, $query)) {
            
            $dados = mysqli_fetch_array($result);
            $maxiD          = $dados[0];

            $query          = "SELECT * FROM tbrelatoriocandidato WHERE id = $maxiD";
            $result         = mysqli_query($this->conexao, $query);
            $dados          = mysqli_fetch_assoc($result);
            $numCandidato   = $dados['numCandidatos'];
            $mes            = $dados['mes'];
            $mes            = substr($mes, 0,1) == "0" ? substr($mes, 1,1) : $mes;
            $mesActual      = date('m');
            $mesActual      = strpos($mesActual, '0') == 0 ? substr($mesActual, 1,1) : $mesActual;


            if($mes != $mesActual) {
                $query = $this->conexao->prepare("INSERT INTO tbrelatoriocandidato(numCandidatos, mes) VALUES(1, ?)");
                $query ->bind_param("i", $mesActual);
                $query ->execute();
            } else {
                $query          = $this->conexao->prepare("UPDATE tbrelatoriocandidato SET numCandidatos = ? WHERE id = ?");
                $numCandidato   = (int)$numCandidato;
                $numCandidato   = $numCandidato + 1;
                $query          ->bind_param("ii", $numCandidato, $maxiD);
                $query->execute();
            }

        } else {
                echo "Ocorre um erro";
        }
    }


    public function select() {

        $query = $this->conexao->prepare("SELECT * FROM tbrelatoriocandidato ORDER BY mes");
        
        $relatorios = array();
        if($query->execute()) {
         $results =  $query->get_result();

         while ($dados = $results->fetch_assoc()) {
                $objecto = new ChartCandidato();
                $objecto->setId($dados['id']);
                $objecto->setNumCand($dados['numCandidatos']);
                $objecto->setMes($dados['mes']);
                $relatorios[] = $objecto;
         }
            
          return $relatorios;
        } else {
            return new ChartCandidato();
        }
    }
}


