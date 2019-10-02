<?php

include_once('conexao.php');

class RelatorioCandidato extends Conexao {

    function __construct() {
        # INCIALIZANDO ... A CONEXÃO
        parent::connect();
    }
    

    public function UpdateRelatorio() {

        $query = "SELECT MAX(id) FROM tbrelatoriocandidato";
        if($result = mysqli_query($this->conexao, $query)) {
            
            $dados = mysqli_fetch_array($result);
            $maxiD          = $dados[0];

            $query          = "SELECT * FROM tbrelatoriocandidato WHERE id = $maxiD";
            $result         = mysqli_query($this->conexao, $query);
            $dados          = mysqli_fetch_assoc($result);
            $numCandidato   = $dados['numCandidatos'];
            $mes            = $dados['mes'];
            $mesActual      = date('m');
            $mesActual      = strpos($mesActual, '0') == 0 ? substr($mesActual, 1,1) : $mesActual;

            echo $mes."<br>". $mesActual."<br>".$dados['mes']."<br>";

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
}
