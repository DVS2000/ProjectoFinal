<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');


class CrudCandidato extends Conexao {

    # 
    public function insert(Candidato $model) {
        # Abrindo a conexão
        $this->connect();

        $query = "INSERT INTO tbcandidato(nome, bi, email, telefone, dtNasc, idnacionalidade, idEstado, dtCriacao, dtEdicao, nomemae, nomepai, morada)
                  VALUES('".$model->getNome()."',
                  '".$model->getBi()."',
                  '".$model->getEmail()."',
                  '".$model->getTelefone()."',
                  '".$model->getDtNasc()."',
                  ".$model->getIdNacionalidade().",
                  ".$model->getIdEstado().",
                  '".$model->getDtCriacao()."',
                  '".$model->getDtEdicao()."',
                  '".$model->getNomeMae()."',
                  '".$model->getNomePai()."',
                  '".$model->getMorada()."');";

        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        mysqli_close($this->conexao);

    }

    # CRIANDO A FUNÇÃO PARA FAZER O UPDATE DO CANDIDATO
    public function update(Candidato $model) {
       # Abrinado a conexão
       $this->connect();
       
       $query = "UPDATE tbcandidato SET
                nome              = '".$model->getNome()."',
                bi                = '".$model->getBi()."',
                email             = '".$model->getEmail()."',
                telefone          = '".$model->getTelefone()."',
                dtNasc            = '".$model->getDtNasc()."',
                idNacionalidade   =  ".$model->getIdNacionalidade().",
                idEstado          =  ".$model->getIdEstado().",
                dtCriacao         = '".$model->getDtCriacao()."',
                dtEdicao          = '".$model->getDtEdicao()."',
                nomemae           = '".$model->getNomeMae()."',
                nomepai           = '".$model->getNomePai()."',
                morada            = '".$model->getMorada()."'
                WHERE idcandidato = ".$model->getId().";";

                if(mysqli_query($this->conexao, $query)) {
                    echo "Correu tudo bem";
                } else {
                    echo "Não correu tudo bem!";
                }
        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
    }

    # CRIANDO A FUNÇÃO PARA ELEMINAR O CANDIDATO
    public function delete($id) {
        #ABRINDO A CONEXÃO
        $this->connect();

        $query = "UPDATE tbcandidato SET idEstado = 3 WHERE idcandidato = $id;";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }
    }

    # CRIANDO A FUNÇÃO FAZER A LISTAGEM DE TODOS OS CANDIDADOS
    public function select() {
        # Abrindo a conexão
        $this->connect();

        $candidatos = array();
        $query = "SELECT * FROM tbcandidato";
        if($result = mysqli_query($this->conexao, $query)) {
            while($dados = mysqli_fetch_assoc($result)) {
                $candidato = new Candidato();
                $candidato-> setId($dados["idcandidato"]);
                $candidato-> setNome($dados["nome"]);
                $candidato-> setBi($dados["bi"]);
                $candidato-> setEmail($dados["email"]);
                $candidato-> setTelefone($dados["telefone"]);
                $candidato-> setDtNasc($dados["dtNasc"]);
                $candidato-> setIdNacionalidade($dados["idnacionalidade"]);
                $candidato-> setIdEstado($dados["idEstado"]);
                $candidato-> setDtCriacao($dados["dtCriacao"]);
                $candidato-> setDtEdicao($dados["dtEdicao"]);
                $candidato-> setNomeMae($dados["nomemae"]);
                $candidato-> setNomePai($dados["nomepai"]);
                $candidato-> setMorada($dados["morada"]);


                $candidatos[] = $candidato;
            }
        }

        # FECHANDO A CONEXÃO
        mysqli_close($this->conexao);
        return $candidatos;
    }

    # CRIANDO A FUNÇÃ PARA FAZER A PESQUISA DO CANDIDATO
    public function search($nome) {
         # Abrindo a conexão
         $this->connect();

         $candidatos = array();
         $query = "SELECT * FROM tbcandidato WHERE nome LIKE '%$nome%';";
         if($result = mysqli_query($this->conexao, $query)) {
             while($dados = mysqli_fetch_assoc($result)) {
                 $candidato = new Candidato();
                 $candidato-> setId($dados["idcandidato"]);
                 $candidato-> setNome($dados["nome"]);
                 $candidato-> setBi($dados["bi"]);
                 $candidato-> setEmail($dados["email"]);
                 $candidato-> setTelefone($dados["telefone"]);
                 $candidato-> setDtNasc($dados["dtNasc"]);
                 $candidato-> setIdNacionalidade($dados["idnacionalidade"]);
                 $candidato-> setIdEstado($dados["idEstado"]);
                 $candidato-> setDtCriacao($dados["dtCriacao"]);
                 $candidato-> setDtEdicao($dados["dtEdicao"]);
                 $candidato-> setNomeMae($dados["nomemae"]);
                 $candidato-> setNomePai($dados["nomepai"]);
                 $candidato-> setMorada($dados["morada"]);
 
 
                 $candidatos[] = $candidato;
             }
         }
 
         # FECHANDO A CONEXÃO
         mysqli_close($this->conexao);
         return $candidatos;
    } 
}