<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');


class CrudCandidato extends Conexao {

    # CRIANDO A FUNÇÃO PARA FAZER O INSERT DO CANDIDATO
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
                  '".$model->getMorada().",
                  ".$model->getIdSexo()."');";

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

    # CRINAOD A FUNÇÃO PARA ELIMINAR O CANDIDATO
    public function delete($id) {
        #ABRINDO A CONEXÃO
        $this->connect();

        $query = "DELETE FROM tbCandidato WHERE idCandidato = $id";
        if(mysqli_query($this->conexao,$query)) {
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

    # CRIANDO A FUNÇÃO PARA ACTIVAR O CANDIDATO
    public function enable($id) {
        # ABRINDO A CONEXÃO
        $this->connect();

        $query = "UPDATE tbCandicado SET idEstado = 1 WHERE idCandidato  = $id";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }
    }

    # CRIANDO A FUNÇÃO PARA DESACTIVAR temporaraio O CANDIDATO
    public function disable($id) {
        #ABRINDO A CONEXÃO
        $this->connect();

        $query = "UPDATE tbcandidato SET idEstado = 2 WHERE idcandidato = $id;";
        if(mysqli_query($this->conexao, $query)) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }
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

    # CRIANDO A FUNÇÃO FAZER A LISTAGEM DE TODOS OS CANDIDADOS
    public function selectDisable() {
        # Abrindo a conexão
        $this->connect();

        $candidatos = array();
        $query = "SELECT * FROM tbcandidato WHERE idEstado = 2";
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

    # CRINAOD A FUNÇÃO QUE RETURNA O CANDIDATO VIA ID
    public function getById($id) {

    }
}