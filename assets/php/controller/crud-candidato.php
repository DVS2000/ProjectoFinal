<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');


class CrudCandidato extends Conexao {

    function __construct() {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }

    # CRIANDO A FUNÇÃO PARA FAZER O INSERT DO CANDIDATO
    public function insert(Candidato $model) {

        $nome           = $model->getNome();
        $bi             = $model->getBi();
        $email          = $model->getEmail();
        $telefone       = $model->getTelefone();
        $dtNasc         = $model->getDtNasc();
        $idNacional     = $model->getIdNacionalidade();
        $idEstado       = $model->getIdEstado();
        $dtCriacao      = $model->getDtCriacao();
        $dtEdicao       = $model->getDtEdicao();
        $nomePai        = $model->getNomePai();
        $nomeMae        = $model->getNomeMae();
        $morada         = $model->getMorada();
        $idSexo         = $model->getIdSexo();
        $senha          = $model->getSenha();

        $query = $this->conexao->prepare("SELECT * FROM tbCandidato WHERE email = ? OR telefone = ? AND bi = ?");
        $query->bind_param('sss', $email, $telefone, $bi);

        if($query->execute()) {
            $result = $query->store_result();
            if($result->num_rows > 0) {
                echo "Candidato existente";

            } else {
                $query = $this->conexao->prepare("INSERT INTO tbcandidato(nome, bi, email, telefone, dtNasc, idnacionalidade, idEstado, dtCriacao, dtEdicao, nomemae, nomepai, morada, senha)
                        VALUES('?,?,?,?,?,?,?,?,?,?,?,?,?, ?)");
                $query->bind_param('ssssssssssssss', $nome, $bi, $email, $telefone, $dtNasc, $idNacional, $idEstado, $dtCriacao, $dtEdicao,$nomeMae, $nomePai, $morada, $senha);

                if($query->execute()) {
                    echo "Correu tudo bem";
                } else {
                    echo "Não correu tudo bem";
                }

            }

        } else {
            echo "Ocorreu um erro";
        }

        # FECHANDO A CONEXÃO
        $query->close();
        $this->conexao->close();

    }

    # CRIANDO A FUNÇÃO PARA FAZER O UPDATE DO CANDIDATO
    public function update(Candidato $model) {


        $id             = $model->getId();
        $nome           = $model->getNome();
        $bi             = $model->getBi();
        $email          = $model->getEmail();
        $telefone       = $model->getTelefone();
        $dtNasc         = $model->getDtNasc();
        $idNacional     = $model->getIdNacionalidade();
        $idEstado       = $model->getIdEstado();
        $dtCriacao      = $model->getDtCriacao();
        $dtEdicao       = $model->getDtEdicao();
        $nomePai        = $model->getNomePai();
        $nomeMae        = $model->getNomeMae();
        $morada         = $model->getMorada();
        $idSexo         = $model->getIdSexo();
        $senha          = $model->getSenha();


        $query = $this->conexao->prepare("SELECT * FROM tbCandidato WHERE email = ? OR telefone = ? OR bi = ? AND idcandidato");
        $query->bind_param('sss', $email, $telefone, $bi, $id);

        if($query->execute()) {
            $result = $query->store_result();
            if($result->num_rows > 0) {
                echo "Candidato existente";

            } else {
                $query = "UPDATE tbcandidato SET
                nome              = ?,
                bi                = ?,
                email             = ?,
                telefone          = ?,
                dtNasc            = ?,
                idNacionalidade   = ?,
                idEstado          = ?,
                dtEdicao          = ?,
                nomemae           = ?,
                nomepai           = ?,
                morada            = ?,
                senha             = ?
                WHERE idcandidato = ?";
                $query->bind_param('ssssssssssssss', $nome, $bi, $email, $telefone, $dtNasc, $idNacional, $idEstado, $dtEdicao,$nomeMae, $nomePai, $morada, $senha, $id);

                if($query->execute()) {
                    echo "Correu tudo bem";
                } else {
                    echo "Não correu tudo bem";
                }

            }

        } else {
            echo "Ocorreu um erro";
        }

         # FECHANDO A CONEXÃO
        $query->close();
        $this->conexao->close();      
    }

    # CRINAOD A FUNÇÃO PARA ELIMINAR O CANDIDATO
    public function delete($id) {


        $query = $this->conexao->prepare("DELETE FROM tbCandidato WHERE idCandidato = ?");
        $query->bind_param('s', $id);

        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # FECHANDO O COMANDO;
        $query->close();
        #FECHANDO A CONEXÃO
        $this->conexao->close();
    }

    # CRIANDO A FUNÇÃO FAZER A LISTAGEM DE TODOS OS CANDIDADOS
    public function select() {


        $candidatos = array();
        $query = $this->conexao->prepare("SELECT * FROM tbcandidato WHERE idEstado = 1");
        if($query->execute()) {

            $result      = $query->get_result();
            while($dados = $result->fetch_assoc()) {
                $candidato = new Candidato();
                $candidato-> setId($dados["idcandidato"]);
                $candidato-> setNome($dados["nome"]);
                $candidato-> setBi($dados["bi"]);
                $candidato-> setEmail($dados["email"]);
                $candidato-> setTelefone($dados["telefone"]);
                $candidato-> setDtNasc($dados["dtNasc"]);
                $candidato-> setIdNacionalidade($dados["idnacionalidade"]);
                $candidato-> setIdEstado($dados["idEstado"]);
                $candidato-> setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
                $candidato-> setDtEdicao(date('d-m-Y',strtotime($dados["dtEdicao"])));
                $candidato-> setNomeMae($dados["nomemae"]);
                $candidato-> setNomePai($dados["nomepai"]);
                $candidato-> setMorada($dados["morada"]);


                $candidatos[] = $candidato;
            }
        }

        return $candidatos;

         # FECHANDO O COMANDO;
         $query->close();
         #FECHANDO A CONEXÃO
         $this->conexao->close();
    }

    # CRIANDO A FUNÇÃO PARA ACTIVAR O CANDIDATO
    public function enable($id) {
        # ABRINDO A CONEXÃO
        $this->connect();

        $query = $this->conexao->prepare("UPDATE tbCandicado SET idEstado = 1 WHERE idCandidato  = ?");
        $query->bind_param('s', $id);
        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

         # FECHANDO O COMANDO;
         $query->close();
         #FECHANDO A CONEXÃO
         $this->conexao->close();
    }

    # CRIANDO A FUNÇÃO PARA DESACTIVAR temporaraio O CANDIDATO
    public function disable($id) {

        $query = $this->conexao->prepare("UPDATE tbcandidato SET idEstado = 2 WHERE idcandidato = ?");
        $query->bind_param('s', $id);

        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

         # FECHANDO O COMANDO;
         $query->close();
         #FECHANDO A CONEXÃO
         $this->conexao->close();
    }

    # CRIANDO A FUNÇÃ PARA FAZER A PESQUISA DO CANDIDATO
    public function search($nome) {


         $candidatos = array();
         $query = $this->conexao->prepare("SELECT * FROM tbcandidato WHERE nome LIKE '% ? %'");
         $query->bind_param('s', $nome);
         if($query->execute()) {

            $result       = $query->get_result();
             while($dados = $result->fetch_assoc()) {
                $candidato = new Candidato();
                $candidato-> setId($dados["idcandidato"]);
                $candidato-> setNome($dados["nome"]);
                $candidato-> setBi($dados["bi"]);
                $candidato-> setEmail($dados["email"]);
                $candidato-> setTelefone($dados["telefone"]);
                $candidato-> setDtNasc($dados["dtNasc"]);
                $candidato-> setIdNacionalidade($dados["idnacionalidade"]);
                $candidato-> setIdEstado($dados["idEstado"]);
                $candidato-> setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
                $candidato-> setDtEdicao(date('d-m-Y',strtotime($dados["dtEdicao"])));
                $candidato-> setNomeMae($dados["nomemae"]);
                $candidato-> setNomePai($dados["nomepai"]);
                $candidato-> setMorada($dados["morada"]);
 
 
                 $candidatos[] = $candidato;
             }
         }
 
         return $candidatos;

         # FECHANDO O COMANDO;
         $query->close();
         #FECHANDO A CONEXÃO
         $this->conexao->close();
    } 

    # CRIANDO A FUNÇÃO FAZER A LISTAGEM DE TODOS OS CANDIDADOS
    public function selectDisable() {


        $candidatos = array();
        $query = $this->conexao->prepare("SELECT * FROM tbcandidato WHERE idEstado = 2");
        if($query->execute()) {

            $result      = $query->get_result();
            while($dados = $result->fetch_assoc()) {
                $candidato = new Candidato();
                $candidato-> setId($dados["idcandidato"]);
                $candidato-> setNome($dados["nome"]);
                $candidato-> setBi($dados["bi"]);
                $candidato-> setEmail($dados["email"]);
                $candidato-> setTelefone($dados["telefone"]);
                $candidato-> setDtNasc($dados["dtNasc"]);
                $candidato-> setIdNacionalidade($dados["idnacionalidade"]);
                $candidato-> setIdEstado($dados["idEstado"]);
                $candidato-> setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
                $candidato-> setDtEdicao(date('d-m-Y',strtotime($dados["dtEdicao"])));
                $candidato-> setNomeMae($dados["nomemae"]);
                $candidato-> setNomePai($dados["nomepai"]);
                $candidato-> setMorada($dados["morada"]);


                $candidatos[] = $candidato;
            }
        }

        return $candidatos;

         # FECHANDO O COMANDO;
         $query->close();
         #FECHANDO A CONEXÃO
         $this->conexao->close();
    }

    # CRINAOD A FUNÇÃO QUE RETURNA O CANDIDATO VIA ID
    public function getById($id) {

        $candidato = new Candidato();
        $query = $this->conexao->prepare("SELECT * FROM tbcandidato WHERE idcandidato = ?");
        $query->bind_param('s', $id);
        if($query->execute()) {

            $result      = $query->get_result();
            while($dados = $result->fetch_assoc()) {
               
                $candidato-> setId($dados["idcandidato"]);
                $candidato-> setNome($dados["nome"]);
                $candidato-> setBi($dados["bi"]);
                $candidato-> setEmail($dados["email"]);
                $candidato-> setTelefone($dados["telefone"]);
                $candidato-> setDtNasc($dados["dtNasc"]);
                $candidato-> setIdNacionalidade($dados["idnacionalidade"]);
                $candidato-> setIdEstado($dados["idEstado"]);
                $candidato-> setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
                $candidato-> setDtEdicao(date('d-m-Y',strtotime($dados["dtEdicao"])));
                $candidato-> setNomeMae($dados["nomemae"]);
                $candidato-> setNomePai($dados["nomepai"]);
                $candidato-> setMorada($dados["morada"]);

            }
        }

        return $candidato;

         # FECHANDO O COMANDO;
         $query->close();
         #FECHANDO A CONEXÃO
         $this->conexao->close();
    }
}