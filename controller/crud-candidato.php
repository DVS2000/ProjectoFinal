<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');


class CrudCandidato extends Conexao
{

    function __construct()
    {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }

    # :::::::::::::::::::: CRUD :::::::::::::::::::::::: #

    # CRIANDO A FUNÇÃO PARA FAZER O INSERT DO CANDIDATO
    public function insert(Candidato $model)
    {

        $nome           = $model->getNome();
        #$bi             = $model->getBi();
        $email          = $model->getEmail();
        $telefone       = $model->getTelefone();
        $dtCriacao      = $model->getDtCriacao();
        $dtEdicao       = $model->getDtEdicao();
        //$idSexo         = $model->getIdSexo();
        $senha          = $model->getSenha();

        # $this->conexao == DESTE JEITO PEGAMOS A VARIVÉAVEL CONEXÃO DA CLASSE CONEXÃO
        $query = $this->conexao->prepare("SELECT * FROM tbCandidato WHERE email = ? OR telefone = ?");
        $query->bind_param('ss', $email, $telefone);

        if ($query->execute()) {
            $query->store_result();
            if ($query->num_rows > 0) {
                return 1;
            } else {
                $query = $this->conexao->prepare("INSERT INTO tbcandidato(nome, email, telefone, dtCriacao, dtEdicao, senha)
                        VALUES(?,?,?,?,?,?)");
                $query->bind_param('ssssss', $nome, $email, $telefone, $dtCriacao, $dtEdicao, $senha);

                if ($query->execute()) {
                    return 2;
                } else {
                    return 3;
                }
            }
        } else {
            echo "Ocorreu um erro";
        }

        # FECHANDO COMANDO
        $query->close();

        #FECHANDO A CONEXÃO
        $this->conexao->close();
    }

    # CRIANDO A FUNÇÃO PARA FAZER O UPDATE DO CANDIDATO
    public function update(Candidato $model)
    {

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
        $morada         = $model->getMorada();
        $idSexo         = $model->getIdSexo();
        $senha          = $model->getSenha();


        $query = $this->conexao->prepare("SELECT * FROM tbCandidato WHERE email = ? AND idcandidato <> ? OR telefone = ? AND idcandidato <> ? OR bi = ? AND idcandidato <> ?");
        $query->bind_param('sisisi', $email, $id, $telefone, $id, $bi, $id);

        if ($query->execute()) {
            $query->store_result();
            if ($query->num_rows > 0) {
                return 1;
            } else {
                $query = $this->conexao->prepare("UPDATE tbcandidato SET
                nome              = ?,
                bi                = ?,
                email             = ?,
                telefone          = ?,
                dtNasc            = ?,
                idNacionalidade   = ?,
                idEstado          = ?,
                dtEdicao          = ?,
                morada            = ?,
                senha             = ?
                WHERE idcandidato = ?");
                $query->bind_param('sssssiisssi', $nome, $bi, $email, $telefone, $dtNasc, $idNacional, $idEstado, $dtEdicao, $morada, $senha, $id);

                if ($query->execute()) {
                    return 2;
                } else {
                    return 3;
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
    public function updateInInscricao(Candidato $model)
    {

        $id             = $model->getId();
        $telefone       = $model->getTelefone();
        $email          = $model->getEmail();
        $bi             = $model->getBi();
        $dtNasc         = $model->getDtNasc();
        $idNacional     = $model->getIdNacionalidade();
        $dtCriacao      = $model->getDtCriacao();
        $dtEdicao       = $model->getDtEdicao();
        $morada         = $model->getMorada();
        $idSexo         = $model->getIdSexo();
        $foto           = $model->getFoto();
        $certificado    = $model->getCertificado();
        $bilhete        = $model->getBilheteFile();


        $query = $this->conexao->prepare("SELECT * FROM tbCandidato WHERE email = ? AND idcandidato <> ? OR telefone = ? AND idcandidato <> ? OR bi = ? AND idcandidato <> ?");
        $query->bind_param('sisisi', $email, $id, $telefone, $id, $bi, $id);

        if ($query->execute()) {
            $query->store_result();
            if ($query->num_rows > 0) {
                return 1;
            } else {
                $query = $this->conexao->prepare("UPDATE tbcandidato SET
                bi                = ?,
                dtNasc            = ?,
                idNacionalidade   = ?,
                dtEdicao          = ?,
                morada            = ?,
                foto              = ?,
                certificado       = ?,
                bilhete           = ?
                WHERE idcandidato = ?");
                $query->bind_param('ssisssssi', $bi, $dtNasc, $idNacional, $dtEdicao, $morada, $foto, $certificado, $bilhete, $id);

                if ($query->execute()) {
                    return 2;
                } else {
                    return 3;
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
    public function delete($id)
    {


        $query = $this->conexao->prepare("DELETE FROM tbCandidato WHERE idCandidato = ?");
        $query->bind_param('i', $id);

        if ($query->execute()) {
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
    public function select()
    {


        $candidatos = array();
        $query = $this->conexao->prepare("SELECT * FROM verCandidato WHERE idestado = 1 ORDER BY nome");
        if ($query->execute()) {

            $result      = $query->get_result();
            while ($dados = $result->fetch_assoc()) {
                $candidato = new Candidato();
                $candidato->setId($dados["idCandidato"]);
                $candidato->setNome($dados["nome"]);
                $candidato->setBi($dados["bi"]);
                $candidato->setEmail($dados["email"]);
                $candidato->setTelefone($dados["telefone"]);
                $candidato->setDtNasc(date('d-m-Y', strtotime($dados["dtNasc"])));
                $candidato->setIdNacionalidade($dados["idnacionalidade"]);
                $candidato->setNacionalidade($dados["nacionalidade"]);
                $candidato->setIdEstado($dados["idestado"]);
                $candidato->setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
                $candidato->setDtEdicao(date('d-m-Y', strtotime($dados["dtEdicao"])));
                $candidato->setMorada($dados["morada"]);
                $candidato->setSexo($dados['sexo']);
                $candidato->setFoto($dados['foto']);
                $candidato->setCertificado($dados['certificado']);
                $candidato->setBilheteFile($dados['bilhete']);

                $candidatos[] = $candidato;
            }
        }

        return $candidatos;

        # FECHANDO O COMANDO;
        $query->close();
        #FECHANDO A CONEXÃO
        $this->conexao->close();
    }



    #:::::::::::::::::::::::: FUNCÕES ADICIONAL :::::::::::::::::::::::::::::::#

    # CRIANDO A FUNÇÃO PARA ACTIVAR O CANDIDATO
    public function enable($id)
    {

        $query = $this->conexao->prepare("UPDATE tbcandidato SET idEstado = 1 WHERE idcandidato  =  ?");
        $query->bind_param('s', $id);
        if ($query->execute()) {
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
    public function disable($id)
    {

        $query = $this->conexao->prepare("UPDATE tbcandidato SET idEstado = 2 WHERE idcandidato = ?");
        $query->bind_param('s', $id);

        if ($query->execute()) {
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
    public function search($var)
    {

        $search = "%{$var}%";


        $candidatos = array();
        $query = $this->conexao->prepare("SELECT * FROM verCandidato WHERE nome LIKE ? OR bi LIKE ? OR email LIKE ? OR telefone LIKE ? ORDER BY nome");
        $query->bind_param('ssss', $search, $search, $search, $search);
        if ($query->execute()) {

            $result      = $query->get_result();
            while ($dados = $result->fetch_assoc()) {
                $candidato = new Candidato();
                $candidato->setId($dados["idCandidato"]);
                $candidato->setNome($dados["nome"]);
                $candidato->setBi($dados["bi"]);
                $candidato->setEmail($dados["email"]);
                $candidato->setTelefone($dados["telefone"]);
                $candidato->setDtNasc($dados["dtNasc"]);
                $candidato->setIdNacionalidade($dados["idnacionalidade"]);
                $candidato->setNacionalidade($dados["nacionalidade"]);
                $candidato->setIdEstado($dados["idestado"]);
                $candidato->setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
                $candidato->setDtEdicao(date('d-m-Y', strtotime($dados["dtEdicao"])));
                $candidato->setMorada($dados["morada"]);
                $candidato->setFoto($dados['foto']);
                $candidato->setCertificado($dados['certificado']);
                $candidato->setBilheteFile($dados['bilhete']);


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
    public function selectDisable()
    {


        $candidatos = array();
        $query = $this->conexao->prepare("SELECT * FROM verCandidato WHERE idEstado = 2");
        if ($query->execute()) {

            $result      = $query->get_result();
            while ($dados = $result->fetch_assoc()) {
                $candidato = new Candidato();
                $candidato->setId($dados["idCandidato"]);
                $candidato->setNome($dados["nome"]);
                $candidato->setBi($dados["bi"]);
                $candidato->setEmail($dados["email"]);
                $candidato->setTelefone($dados["telefone"]);
                $candidato->setDtNasc($dados["dtNasc"]);
                $candidato->setIdNacionalidade($dados["idnacionalidade"]);
                $candidato->setNacionalidade($dados["nacionalidade"]);
                $candidato->setIdEstado($dados["idestado"]);
                $candidato->setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
                $candidato->setDtEdicao(date('d-m-Y', strtotime($dados["dtEdicao"])));
                $candidato->setMorada($dados["morada"]);
                $candidato->setSexo($dados['sexo']);
                $candidato->setFoto($dados['foto']);
                $candidato->setCertificado($dados['certificado']);
                $candidato->setBilheteFile($dados['bilhete']);


                $candidatos[] = $candidato;
            }
        }

        return $candidatos;

        # FECHANDO O COMANDO;
        $query->close();
        #FECHANDO A CONEXÃO
        $this->conexao->close();
    }


    # CRIANDO A FUNÇÃO QUE FAZER O RESET DA SENHA DO UTILIZADOR
    public function resetPassword($email, $newPassowrd)
    {

        $query = $this->conexao->prepare("UPDATE tbCandidato SET senha = ? WHERE email = ?");
        $senha = md5($newPassowrd);

        $query->bind_param('ss', $senha, $email);

        if ($query->execute()) {
            return 1;
        } else {
            return '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
               <h4 class="alert-heading">Ocorreu um erro.</h4>
               <p>Tente mais tarde.</p>
            </div>';
        }

        # FECHANDO O COMANDO;
        $query->close();
        #FECHANDO A CONEXÃO
        $this->conexao->close();
    }

    # CRINAOD A FUNÇÃO QUE RETURNA O CANDIDATO VIA ID
    public function getById($id)
    {

        $candidato = new Candidato();
        $query = $this->conexao->prepare("SELECT * FROM verCandidato WHERE idcandidato = ?");
        $query->bind_param('i', $id);
        if ($query->execute()) {

            $result      = $query->get_result();
            while ($dados = $result->fetch_assoc()) {
                $candidato = new Candidato();
                if ($dados['idestado'] == 1) {
                    $candidato->setId($dados["idCandidato"]);
                    $candidato->setNome($dados["nome"]);
                    $candidato->setBi($dados["bi"]);
                    $candidato->setEmail($dados["email"]);
                    $candidato->setTelefone($dados["telefone"]);
                    $candidato->setDtNasc(date('d-m-Y', strtotime($dados["dtNasc"])));
                    $candidato->setIdNacionalidade($dados["idnacionalidade"]);
                    $candidato->setNacionalidade($dados["nacionalidade"]);
                    $candidato->setIdEstado($dados["idestado"]);
                    $candidato->setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
                    $candidato->setDtEdicao(date('d-m-Y', strtotime($dados["dtEdicao"])));
                    $candidato->setMorada($dados["morada"]);
                    $candidato->setIdSexo($dados['idsexo']);
                    $candidato->setSexo($dados['sexo']);
                    $candidato->setFoto($dados['foto']);
                    $candidato->setCertificado($dados['certificado']);
                    $candidato->setBilheteFile($dados['bilhete']);
                }
            }

            return $candidato;
        }
    }


    # CRINAOD A FUNÇÃO QUE RETURNA O CANDIDATO VIA ID
    public function getByEmail($email)
    {

        $candidato = new Candidato();
        $query = $this->conexao->prepare("SELECT * FROM verCandidato WHERE email = ?");
        $query->bind_param('s', $email);
        if ($query->execute()) {

            $result      = $query->get_result();
            while ($dados = $result->fetch_assoc()) {
                $candidato = new Candidato();
                if ($dados['idestado'] == 1) {
                    $candidato->setId($dados["idCandidato"]);
                    $candidato->setNome($dados["nome"]);
                    $candidato->setBi($dados["bi"]);
                    $candidato->setEmail($dados["email"]);
                    $candidato->setTelefone($dados["telefone"]);
                    $candidato->setDtNasc(date('d-m-Y', strtotime($dados["dtNasc"])));
                    $candidato->setIdNacionalidade($dados["idnacionalidade"]);
                    $candidato->setNacionalidade($dados["nacionalidade"]);
                    $candidato->setIdEstado($dados["idestado"]);
                    $candidato->setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
                    $candidato->setDtEdicao(date('d-m-Y', strtotime($dados["dtEdicao"])));
                    $candidato->setMorada($dados["morada"]);
                    $candidato->setIdSexo($dados['idsexo']);
                    $candidato->setSexo($dados['sexo']);
                    $candidato->setFoto($dados['foto']);
                    $candidato->setCertificado($dados['certificado']);
                    $candidato->setBilheteFile($dados['bilhete']);
                }
            }
        }

        return $candidato;

        # FECHANDO O COMANDO;
        $query->close();
        #FECHANDO A CONEXÃO
        $this->conexao->close();
    }


    # CRIANDO A FUNÇÃO PARA FAZER O LOGIN
    public function login(Candidato $model)
    {

        $email     = $model->getEmail();
        $telefone  = $model->getTelefone();
        $senha     = $model->getSenha();

        $query = $this->conexao->prepare("SELECT * FROM verCandidato WHERE email = ? AND senha = ? OR telefone = ? AND senha = ? ");
        $query->bind_param('ssss', $email, $senha, $telefone, $senha);
        if ($query->execute()) {

            $result      = $query->get_result();

            $dados = $result->fetch_assoc();
            $candidato = new Candidato();
            if ($dados['idestado'] == 1) {
                $candidato->setId($dados["idCandidato"]);
                $candidato->setNome($dados["nome"]);
                $candidato->setBi($dados["bi"]);
                $candidato->setEmail($dados["email"]);
                $candidato->setTelefone($dados["telefone"]);
                $candidato->setDtNasc($dados["dtNasc"]);
                $candidato->setIdNacionalidade($dados["idnacionalidade"]);
                $candidato->setNacionalidade($dados["nacionalidade"]);
                $candidato->setIdEstado($dados["idestado"]);
                $candidato->setDtCriacao(date('d-m-Y', strtotime($dados["dtCriacao"])));
                $candidato->setDtEdicao(date('d-m-Y', strtotime($dados["dtEdicao"])));
                $candidato->setMorada($dados["morada"]);
                $candidato->setSenha($dados["senha"]);
                $candidato->setFoto($dados['foto']);
                $candidato->setCertificado($dados['certificado']);
                $candidato->setBilheteFile($dados['bilhete']);
            }

            return $candidato;
        }



        # FECHANDO O COMANDO;
        $query->close();
        #FECHANDO A CONEXÃO
        $this->conexao->close();
    }


    # FUNÇÃO PARA PEGAR O ÚTILMO ID COM NÚMERO DO TELEFONE DO CANDIDATO
    public function getMaxId($tel)
    {

        $query = $this->conexao->prepare("SELECT MAX(idCandidato) FROM tbCandidato WHERE telefone = ?");
        $query->bind_param('s', $tel);

        $query->execute();
        $result      = $query->get_result();
        $dados = $result->fetch_array();

        return $dados[0];
    }
}
