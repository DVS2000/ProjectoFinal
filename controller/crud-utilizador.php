<?php

# Incluindo o ficheiro de conexao
include_once('conexao.php');

# CRIANDO O CRUD DO UTILIZADOR


class CrudUtilizador extends Conexao {

    # MÉTODO CONSTRUCTOR DO CLASS CRUDCRUSO
    function __construct() {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }

    # CRIANDO A FUNÇÃO PARA FAZER O INSERT NO BANCO DE DADOS
    public function insert(Utilizador $model) {

        $nome           = $model->getNome();
        $email          = $model->getEmail();
        $telefone       = $model->getTelefone();
        $senha          = $model->getSenha();
        $dtCriacao      = $model->getDtCriacao();
        $dtEdicao       = $model->getDtEdicao();
        $idTipoUser     = $model->getIdTipoUtilizador();
        $idEstado       = $model->getIdEstado();
        $idSexo         = $model->getIdSexo();           
        
        $query = $this->conexao->prepare("SELECT * FROM tbutilizador WHERE email = ? OR  telefone = ?");
        $query->bind_param("ss", $email, $telefone);
        if($query->execute()) {

           $query->store_result();

            if($query->num_rows > 0 ) {

                echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                       <h4 class="alert-heading">O E-mail ou Telefone já está registado.</h4>
                       <p>Tente um outro E-mail ou Telefone, Obrigado!</p>
                    </div>';

            } else {
             $query  = $this->conexao->prepare("INSERT INTO tbutilizador(nome, email, telefone, senha, dtCriacao, dtEdicao, idtbTipoUtilizador, idEstado, idSexo) 
                VALUES (?,?,?,?,?,?,?,?,?)");
                $query->bind_param('ssssssiii', $nome, $email, $telefone, $senha, $dtCriacao, $dtEdicao, $idTipoUser, $idEstado, $idSexo);

                if($query->execute()) {
                    echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                            </button>
                            <h4 class="alert-heading">'.$nome.'</h4>
                            <p>Foi adicionado!</p>
                            <p class="mb-0">'.date('d-m-Y H:s').'</p>
                            </div>';
                } else {
                    echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                            </button>
                            <h4 class="alert-heading">'.$nome.'</h4>
                            <p>Não foi adicionado com sucesso!</p>
                            <p class="mb-0">'.date('d-m-Y H:s').'</p>
                        </div>';
                }
            }
        } else {
            echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                       <h4 class="alert-heading">Ocorreu um erro.</h4>
                       <p>Tente mais tarde.</p>
                    </div>';
        }

        #FECHANDO A COMANDO
        $query->close();
        #FECHANDO A CONEXÃO
        $this->conexao->close();
    }

    # CRIANDO A FUNÇÃO PARA FAZER O UPDATE DO UTILIZADOR NO BANCO DE DADOS
    public function update(Utilizador $model) {

        $id             = $model->getId();
        $nome           = $model->getNome();
        $email          = $model->getEmail();
        $telefone       = $model->getTelefone();
        $senha          = $model->getSenha();
        $dtEdicao       = $model->getDtEdicao();
        $idTipoUser     = $model->getIdTipoUtilizador();
        $idEstado       = $model->getIdEstado();
        $idSexo         = $model->getIdSexo(); 

        $query = $this->conexao->prepare("SELECT * FROM tbutilizador WHERE email = ? AND idUtilizador <> ? OR  telefone = ? AND idUtilizador <> ?");
        $query->bind_param('sisi', $email, $id, $telefone, $id);

        if($query->execute()) {

            $query->store_result();

            if($query->num_rows > 0 ) {

                echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                       <h4 class="alert-heading">O E-mail ou Telefone já está registado.</h4>
                       <p>Tente um outro E-mail ou Telefone, Obrigado!</p>
                    </div>';

            } else {
                $query = $this->conexao->prepare("UPDATE tbutilizador SET 
                  nome               = ?,
                  email              = ?,
                  telefone           = ?,
                  senha              = ?,
                  dtEdicao           = ?,
                  idtbTipoUtilizador = ?,
                  idEstado           = ?,
                  idSexo             = ?
                  WHERE idUtilizador = ?");

                  $query->bind_param('sssssiiii', $nome, $email, $telefone, $senha, $dtEdicao, $idTipoUser, $idEstado, $idSexo, $id);


                if($query->execute()) {
                    echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <h4 class="alert-heading">'.$nome.'</h4>
                                <p>Foi editado!</p>
                                <p class="mb-0">'.date('d-m-Y H:s').'</p>
                            </div>';

                } else {
                    echo '<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                                </button>
                                <h4 class="alert-heading">'.$nome.'</h4>
                                <p>Não foi editado!</p>
                                <p class="mb-0">'.date('d-m-Y H:s').'</p>
                            </div>';
                }

            }
        } else {
            echo '<div class="alert alert-success mt-5 alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      <span class="sr-only">Close</span>
                    </button>
                       <h4 class="alert-heading">Ocorreu um erro.</h4>
                       <p>Tente mais tarde.</p>
                    </div>';
        }

        #FECHANDO A COMANDO
        $query->close();
        #FECHANDO A CONEXÃO
        $this->conexao->close();
    }


    # CRIANDO A FUNÇÃO PARA FAZER O DELETE DO UTILIZADOR NO BANCO DE DADOS
    public function delete($id) {

        $query = $this->conexao->prepare("DELETE FROM tbUtilizador WHERE idutilizador = ?");
        $query->bind_param('i', $id);
        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        #FECHANDO A COMANDO
        $query->close();
        #FECHANDO A CONEXÃO
        $this->conexao->close();
    }

    # CRINAOD A FUNÇÃO PARA FAZER O SELECT DE TODOS OS UTILIZADORES
    public function select() {

        $query  = $this->conexao->prepare("SELECT * FROM verUtilizador WHERE idestado <> 2 ORDER BY nome");
        $query->execute();
        $result = $query->get_result();

        $users = array();
        while($dados = $result->fetch_assoc()) {
            $objecto =  new Utilizador();
            $objecto->  setId($dados["idutilizador"]);
            $objecto->  setNome($dados["nome"]);
            $objecto->  setEmail($dados["email"]);
            $objecto->  setTelefone($dados["telefone"]);
            $objecto->  setTipoUtilizador($dados['TipoUtil']);
            $objecto->  setSexo($dados['sexo']);
            $objecto->  setIdSexo($dados["idsexo"]);
            $objecto->  setDtCriacao(date('d-m-Y', strtotime($dados["dtcriacao"])));
            $objecto->  setDtEdicao(date('d-m-Y', strtotime($dados["dtedicao"])));
            $objecto->  setIdTipoUtilizador($dados["idtbTipoUtilizador"]);
           
            $users[] =  $objecto;
        }

       return $users;  
       #FECHANDO A COMANDO
       $query->close();
       #FECHANDO A CONEXÃO
       $this->conexao->close();
    }

    /* ===========FUNÇÕES ADICIONAL =========== */

    # CRINAOD A FUNÇÃO PARA FAZER O SELECT DE TODOS OS UTILIZADORES
    public function selectDesactivado() {

        $query  = $this->conexao->prepare("SELECT * FROM verUtilizador WHERE idestado = 2 ORDER BY nome");
        $query->execute();
        $result = $query->get_result();

        $users = array();
        while($dados = $result->fetch_assoc()) {
            $objecto =  new Utilizador();
            $objecto->  setId($dados["idutilizador"]);
            $objecto->  setNome($dados["nome"]);
            $objecto->  setEmail($dados["email"]);
            $objecto->  setTelefone($dados["telefone"]);
            $objecto->  setTipoUtilizador($dados['TipoUtil']);
            $objecto->  setSexo($dados['sexo']);
            $objecto->  setIdSexo($dados["idsexo"]);
            $objecto->  setDtCriacao(date('d-m-Y', strtotime($dados["dtcriacao"])));
            $objecto->  setDtEdicao(date('d-m-Y', strtotime($dados["dtedicao"])));
            $objecto->  setIdTipoUtilizador($dados["idtbTipoUtilizador"]);
           
            $users[] =  $objecto;
        }

       return $users;  
       #FECHANDO A COMANDO
       $query->close();
       #FECHANDO A CONEXÃO
       $this->conexao->close();  
    }

    # CRIANDO A FUNÇÃO PARA DESACTIVAR O UTILIZADOR NO BANCO DE DADOS
    public function disable($id) {

        $query = $this->conexao->prepare("UPDATE tbutilizador SET idEstado = 2 WHERE idUtilizador = ?");
        $query->bind_param('i', $id);
        if($query->execute()){
           echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

       #FECHANDO A COMANDO
       $query->close();
       #FECHANDO A CONEXÃO
       $this->conexao->close();
    }

    # CRIANDO A FUNÇÃO PARA ACTIVAR DO UTILIZADOR NO BANCO DE DADOS
    public function enable($id) {

        $query = $this->conexao->prepare("UPDATE tbutilizador SET idEstado = 1 WHERE idUtilizador = ?");
        $query->bind_param('i', $id);
        if($query->execute()){
           echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

       #FECHANDO A COMANDO
       $query->close();
       #FECHANDO A CONEXÃO
       $this->conexao->close();
    }

    # CRIANDO A FUNÇÃO PARA PESQUISAR UM OU MAIS UTILIZADORES
    public function search($nome) {

        $search = "%{$nome}%";

        $query = $this->conexao->prepare("SELECT * FROM verUtilizador WHERE nome LIKE ? OR telefone LIKE ? OR email LIKE ? ORDER BY nome");
        $query->bind_param('sss', $search, $search, $search);
        $query->execute();
        $result = $query->get_result();

        $users = array();
        while($dados = $result->fetch_assoc()) {
            $objecto =  new Utilizador();
            $objecto->  setId($dados["idutilizador"]);
            $objecto->  setNome($dados["nome"]);
            $objecto->  setEmail($dados["email"]);
            $objecto->  setTelefone($dados["telefone"]);
            $objecto->  setTipoUtilizador($dados['TipoUtil']);
            $objecto->  setSexo($dados['sexo']);
            $objecto->  setIdSexo($dados["idsexo"]);
            $objecto->  setDtCriacao(date('d-m-Y', strtotime($dados["dtcriacao"])));
            $objecto->  setDtEdicao(date('d-m-Y', strtotime($dados["dtedicao"])));
            $objecto->  setIdTipoUtilizador($dados["idtbTipoUtilizador"]);
           
            $users[] =  $objecto;
        }

       return $users;  
       #FECHANDO A COMANDO
       $query->close();
       #FECHANDO A CONEXÃO
       $this->conexao->close();
    }

     # CRINAOD A FUNÇÃO PARA FAZER O SELECT DO UTILIZADOR APARTIR DO ID
     public function getById($id) {

        $query  = $this->conexao->prepare("SELECT * FROM verUtilizador WHERE idutilizador = ?");
        $query->bind_param('i', $id);
        $query->execute();
        $result = $query->get_result();

        while($dados =  $result->fetch_assoc()) {
            $objecto =  new Utilizador();
            $objecto->  setId($dados["idutilizador"]);
            $objecto->  setNome($dados["nome"]);
            $objecto->  setEmail($dados["email"]);
            $objecto->  setTelefone($dados["telefone"]);
            $objecto->  setTipoUtilizador($dados['TipoUtil']);
            $objecto->  setSexo($dados['sexo']);
            $objecto->  setIdSexo($dados["idsexo"]);
            $objecto->  setDtCriacao($dados["dtcriacao"]);
            $objecto->  setDtEdicao($dados["dtedicao"]);
            $objecto->  setIdTipoUtilizador($dados["idtbTipoUtilizador"]);
        }

        return $objecto; 
        #FECHANDO A COMANDO
       $query->close();
       #FECHANDO A CONEXÃO
       $this->conexao->close();
       
    }

    # CRIANDO A FUNÇÃO PARA FAZER LOGIN
    public function login(Utilizador $model) {

        $email     = $model->getEmail();
        $telefone  = $model->getTelefone();
        $senha     = $model->getSenha();
        
        $query = $this->conexao->prepare("SELECT * FROM verUtilizador WHERE email = ? AND senha = ? OR telefone = ? AND senha = ? ");
        $query     ->bind_param('ssss', $email, $senha, $telefone, $senha);
        if($query->execute()) {

            $result      = $query->get_result();
            $dados = $result->fetch_assoc();
                 $objecto   =  new Utilizador();
                
                    $objecto->  setId($dados["idutilizador"]);
                    $objecto->  setNome($dados["nome"]);
                    $objecto->  setEmail($dados["email"]);
                    $objecto->  setTelefone($dados["telefone"]);
                    $objecto->  setTipoUtilizador($dados['TipoUtil']);
                    $objecto->  setSexo($dados['sexo']);
                    $objecto->  setIdSexo($dados["idsexo"]);
                    $objecto->  setDtCriacao(date('d-m-Y', strtotime($dados["dtcriacao"])));
                    $objecto->  setDtEdicao(date('d-m-Y', strtotime($dados["dtedicao"])));
                    $objecto->  setIdTipoUtilizador($dados["idtbTipoUtilizador"]);

        }

       return $objecto; 

       #FECHANDO A COMANDO
       $query->close();
       #FECHANDO A CONEXÃO
       $this->conexao->close();
    }

}


