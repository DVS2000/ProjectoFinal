<?php

# ADICIONANDO O FECHEIRO DE CONEXÃO
include_once('conexao.php');

class CrudPagamento extends Conexao
{

    function __construct()
    {
        # INICIALIZANDO A CONEXÃO
        parent::connect();
    }



    public function insert(Pagamento $model)
    {

        $comprovativo           = $model->getComprovativo();
        $idInscricao            = $model->getIdInscricao();
        $dtPagamento            = date('Y-m-d');
        $dtEdicao               = date('Y-m-d');

        $query = $this->conexao->prepare("INSERT INTO tbpagamento(comprovativo, idInscricao, dtPagamento, dtEdicao) VALUES(?, ?, ?, ?)");
        $query->bind_param('siss', $comprovativo, $idInscricao, $dtPagamento, $dtEdicao);

        if ($query->execute()) {
            return 1;
        } else {
            return 2;
        }

        # FECHANDO A QUERY
        $query->close();

        # FECHANDO CONEXÃO
        $this->conexao->close();
    }


    public function update(Pagamento $model)
    {

        $idPag              = $model->getId();
        $estado             = $model->getEstado();
        $dtEdicao           = date('Y-m-d');


        $query = $this->conexao->prepare("UPDATE tbPagamento SET estado = ?, dtEdicao = ? WHERE id = ?");
        $query->bind_param('ssi', $estado, $dtEdicao, $idPag);

        if ($query->execute()) {
            echo 1;
        } else {
            echo 2;
        }

        # FECHANDO O COMANDO
        $query->close();

        # FECHANDO A CONEXÃO
        $this->conexao->close();
    }

    public function delete($id)
    {

        $query = $this->conexao->prepare("DELETE FROM tbPagamento WHERE idInscricao = ?");
        $query->bind_param('i', $id);

        if ($query->execute()) {
            echo "Correu tudo bem";
        } else {
            echo "Não correu tudo bem";
        }

        # FECHANDO O COMANDO
        $query->close();

        # FECHANDO A CONEXÃO
        $this->conexao->close();
    }


    public function select($estado)
    {

        $query = $this->conexao->prepare("SELECT * FROM verPagamento WHERE estado = ? ORDER BY nome");
        $query->bind_param('s', $estado);

        $pagamentos = array();

        if ($query->execute()) {

            $result = $query->get_result();
            while ($dados = $result->fetch_assoc()) {

                $pagamento = new Pagamento();
                $pagamento->setId($dados['id']);
                $pagamento->setNomeCand($dados['nome']);
                $pagamento->setCurso($dados['curso']);
                $pagamento->setPreco($dados['preco']);
                $pagamento->setComprovativo($dados['comprovativo']);
                $pagamento->setEstado($dados['estado']);
                $pagamento->setIdInscricao($dados['idinscricao']);
                $pagamento->setDtPagamento($dados['dtPagamento'] == null ? "**-**-****" : $dados['dtPagamento']);
                $pagamento->setDtEdicao($dados['dtEdicao'] == null ? "**-**-****" : $dados['dtEdicao']);

                $pagamentos[] = $pagamento;
            }

            return $pagamentos;
        }
    }


    # ::::::::::::::::::::: FUNCÇÕES ADICIONAIS :::::::::::::::::::::::::::::::::::::


    public function search($nomeCand)
    {

        $search = "%{$nomeCand}%";

        $query = $this->conexao->prepare("SELECT * FROM verPagamento WHERE nome LIKE ? AND estado = 1 OR curso LIKE ? AND estado = 1 ORDER BY nome");
        $query->bind_param('ss', $search, $search);

        $pagamentos = array();

        if ($query->execute()) {

            $result = $query->get_result();
            while ($dados = $result->fetch_assoc()) {

                $pagamento = new Pagamento();
                $pagamento->setId($dados['id']);
                $pagamento->setNomeCand($dados['nome']);
                $pagamento->setCurso($dados['curso']);
                $pagamento->setPreco($dados['preco']);
                $pagamento->setComprovativo($dados['comprovativo']);
                $pagamento->setEstado($dados['estado']);
                $pagamento->setIdInscricao($dados['idinscricao']);
                $pagamento->setDtPagamento($dados['dtPagamento'] == null ? "**-**-****" : $dados['dtPagamento']);
                $pagamento->setDtEdicao($dados['dtEdicao'] == null ? "**-**-****" : $dados['dtEdicao']);

                $pagamentos[] = $pagamento;
            }

            return $pagamentos;
        }
    }

    public function selectFeitos()
    {

        $query = $this->conexao->prepare("SELECT * FROM verPagamento WHERE estado = 1 ORDER BY nome");

        $pagamentos = array();

        if ($query->execute()) {

            $result = $query->get_result();
            while ($dados = $result->fetch_assoc()) {

                $pagamento = new Pagamento();
                $pagamento->setId($dados['id']);
                $pagamento->setNomeCand($dados['nome']);
                $pagamento->setCurso($dados['curso']);
                $pagamento->setPreco($dados['preco']);
                $pagamento->setComprovativo($dados['comprovativo']);
                $pagamento->setEstado($dados['estado']);
                $pagamento->setIdInscricao($dados['idinscricao']);
                $pagamento->setDtPagamento($dados['dtPagamento'] == null ? "**-**-****" : $dados['dtPagamento']);
                $pagamento->setDtEdicao($dados['dtEdicao'] == null ? "**-**-****" : $dados['dtEdicao']);

                $pagamentos[] = $pagamento;
            }

            return $pagamentos;
        }
    }


    public function getByIdInscricao($idInscricao)
    {

        $query = $this->conexao->prepare("SELECT * FROM verPagamento WHERE idinscricao = ?");
        $query->bind_param('i', $idInscricao);

        $pagamento = new Pagamento();

        if ($query->execute()) {

            $result = $query->get_result();
            while ($dados = $result->fetch_assoc()) {

                $pagamento->setId($dados['id']);
                $pagamento->setNomeCand($dados['nome']);
                $pagamento->setCurso($dados['curso']);
                $pagamento->setPreco($dados['preco']);
                $pagamento->setComprovativo($dados['comprovativo']);
                $pagamento->setEstado($dados['estado']);
                $pagamento->setIdInscricao($dados['idinscricao']);
                $pagamento->setDtPagamento($dados['dtPagamento'] == null ? "**-**-****" : $dados['dtPagamento']);
                $pagamento->setDtEdicao($dados['dtEdicao'] == null ? "**-**-****" : $dados['dtEdicao']);
            }

            return $pagamento;
        }
    }


    public function cofirm($id)
    {

        $dtPagamento = date('Y-m-d');
        $dtEdicao = date('Y-m-d');

        $query = $this->conexao->prepare("UPDATE tbPagamento SET estado = 1, dtPagamento = ?, dtEdicao = ? WHERE id = ?");
        $query->bind_param('ssi', $dtPagamento, $dtEdicao, $id);

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }

        # FECHANDO O COMANDO
        $query->close();

        # FECHANDO A CONEXÃO
        $this->conexao->close();
    }


    public function getById($id)
    {

        $query = $this->conexao->prepare("SELECT * FROM verPagamento WHERE estado <> 1 AND id = ?");
        $query->bind_param('i', $id);
        if ($query->execute()) {

            $pagamento = new Pagamento();
            $result = $query->get_result();
            while ($dados = $result->fetch_assoc()) {


                $pagamento->setId($dados['id']);
                $pagamento->setNomeCand($dados['nome']);
                $pagamento->setCurso($dados['curso']);
                $pagamento->setPreco($dados['preco']);
                $pagamento->setComprovativo($dados['comprovativo']);
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
