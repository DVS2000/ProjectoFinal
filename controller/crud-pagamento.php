<?php

# ADICIONANDO O FECHEIRO DE CONEXÃO
include_once('conexao.php');

class CrudPagamento extends Conexao {

    function __construct() {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }



    public function insert(Pagamento $model) {

        $idFormPag              = $model->getIdFormPag();
        $tempo                  = $model->getTempo();
        $idInscricao            = $model->getIdInscricao();
        $estado                 = $model->getEstado();

        $query = $this->conexao->prepare("INSERT INTO tbpagamento(idFormPag, tempo, idInscricao, estado) VALUES(?, ?, ?, ?)");
        $query->bind_param('isii', $idFormPag, $tempo, $idInscricao, $estado);

        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }


        # FECHANDO A QUERY
        $query->close();

        # FECHANDO CONEXÃO
        $this->conexao->close();
    }


        public function update(Pagamento $model) {

        $idPag              = $model->getId();
        $idFormPag          = $model->getIdFormPag();
        $dtEdicao           = date('Y-m-d');
        

        $query = $this->conexao->prepare("UPDATE tbPagamento SET idFormPag = ?, dtEdicao = ? WHERE id = ?");
        $query->bind_param('isi', $idFormPag, $dtEdicao, $idPag);

        if($query->execute()) {
            echo "Corre tudo bem";
        } else {
            echo "Não corre tudo bem";
        }

        # FECHANDO O COMANDO
        $query->close();

        # FECHANDO A CONEXÃO
        $this->conexao->close();
    }

    public function delete($id) {

        $query = $this->conexao->prepare("DELETE FROM tbPagamento WHERE idInscricao = ?");
        $query->bind_param('i', $id);

        if($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # FECHANDO O COMANDO
        $query->close();

        # FECHANDO A CONEXÃO
        $this->conexao->close();
    }


    public function select() {

        $query = $this->conexao->prepare("SELECT * FROM verPagamento ORDER BY nome");

        $pagamentos = array();

        if($query->execute()) {
            
            $result = $query->get_result();
            while ($dados = $result->fetch_assoc()) {

                $pagamento = new Pagamento();
                $pagamento->setId($dados['id']);
                $pagamento->setNomeCand($dados['nome']);
                $pagamento->setCurso($dados['curso']);
                $pagamento->setPreco($dados['preco']);
                $pagamento->setFormPag($dados['formPag']);
                $pagamento->setEstado($dados['estado']);
                $pagamento->setIdInscricao($dados['idinscricao']);
                $pagamento->setTempo(date('d-m-Y', strtotime($dados['tempo'])));
                $pagamento->setDtPagamento($dados['dtPagamento'] == null ? "**-**-****" : $dados['dtPagamento']);
                $pagamento->setDtEdicao($dados['dtEdicao'] == null ? "**-**-****" : $dados['dtEdicao']);

                $pagamentos[] = $pagamento;

            }

            return $pagamentos;
        }
    }


    # ::::::::::::::::::::: FUNCÇÕES ADICIONAIS :::::::::::::::::::::::::::::::::::::


    public function search($nomeCand) {

        $search = "%{$nomeCand}%";

        $query = $this->conexao->prepare("SELECT * FROM verPagamento WHERE nome LIKE ? ORDER BY nome");
        $query->bind_param('s', $search);

        $pagamentos = array();

        if($query->execute()) {
            
            $result = $query->get_result();
            while ($dados = $result->fetch_assoc()) {

                $pagamento = new Pagamento();
                $pagamento->setId($dados['id']);
                $pagamento->setNomeCand($dados['nome']);
                $pagamento->setCurso($dados['curso']);
                $pagamento->setPreco($dados['preco']);
                $pagamento->setFormPag($dados['formPag']);
                $pagamento->setEstado($dados['estado']);
                $pagamento->setIdInscricao($dados['idinscricao']);
                $pagamento->setTempo(date('d-m-Y', strtotime($dados['tempo'])));
                $pagamento->setDtPagamento($dados['dtPagamento'] == null ? "**-**-****" : $dados['dtPagamento']);
                $pagamento->setDtEdicao($dados['dtEdicao'] == null ? "**-**-****" : $dados['dtEdicao']);

                $pagamentos[] = $pagamento;

            }

            return $pagamentos;
        }
    }

        public function selectFeitos() {

            $query = $this->conexao->prepare("SELECT * FROM verPagamento WHERE estado = 1 ORDER BY nome");

            $pagamentos = array();

            if($query->execute()) {
                
                $result = $query->get_result();
                while ($dados = $result->fetch_assoc()) {

                    $pagamento = new Pagamento();
                    $pagamento->setId($dados['id']);
                    $pagamento->setNomeCand($dados['nome']);
                    $pagamento->setCurso($dados['curso']);
                    $pagamento->setPreco($dados['preco']);
                    $pagamento->setFormPag($dados['formPag']);
                    $pagamento->setEstado($dados['estado']);
                    $pagamento->setIdInscricao($dados['idinscricao']);
                    $pagamento->setTempo(date('d-m-Y', strtotime($dados['tempo'])));
                    $pagamento->setDtPagamento($dados['dtPagamento'] == null ? "**-**-****" : $dados['dtPagamento']);
                    $pagamento->setDtEdicao($dados['dtEdicao'] == null ? "**-**-****" : $dados['dtEdicao']);

                    $pagamentos[] = $pagamento;

                }

                return $pagamentos;
            }
        }


        public function cofirm($id) {

            $dtPagamento = date('Y-m-d');
            $dtEdicao = date('Y-m-d');
            
            $query = $this->conexao->prepare("UPDATE tbPagamento SET estado = 1, dtPagamento = ?, dtEdicao = ? WHERE id = ?");
            $query->bind_param('ssi', $dtPagamento, $dtEdicao, $id);

            if($query->execute()) {
                return true;
            } else {
                return false;
            }

            # FECHANDO O COMANDO
            $query->close();

            # FECHANDO A CONEXÃO
            $this->conexao->close();
        }


        public function getById($id) {

            $query = $this->conexao->prepare("SELECT * FROM verPagamento WHERE estado <> 1 AND id = ?");
            $query->bind_param('i', $id);
            if($query->execute()) {
                
                $pagamento = new Pagamento();
                $result = $query->get_result();
                while ($dados = $result->fetch_assoc()) {

                    
                    $pagamento->setId($dados['id']);
                    $pagamento->setNomeCand($dados['nome']);
                    $pagamento->setCurso($dados['curso']);
                    $pagamento->setPreco($dados['preco']);
                    $pagamento->setFormPag($dados['formPag']);
                    $pagamento->setEstado($dados['estado']);
                    $pagamento->setIdInscricao($dados['idinscricao']);
                    $pagamento->setTempo(date('d-m-Y', strtotime($dados['tempo'])));
                    $pagamento->setDtPagamento($dados['dtPagamento'] == null ? "**-**-****" : $dados['dtPagamento']);
                    $pagamento->setDtEdicao($dados['dtEdicao'] == null ? "**-**-****" : $dados['dtEdicao']);

                    

                }

                return $pagamento;
            }
        }

}



