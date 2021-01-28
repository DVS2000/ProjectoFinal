<?php

include_once('../../model/pagamento.php');
include_once('../../controller/crud-pagamento.php');

include_once('../../model/inscricao.php');
include_once('../../controller/crud-inscricao.php');

include_once('../../model/utilizador.php');
include_once('../../controller/crud-utilizador.php');

include_once('../../model/candidato.php');
include_once('../../controller/crud-candidato.php');

include_once('../../util/email/enviar.php');


if(isset($_POST['cofirm'])) {

    $email = new SendEmail();
    
    $pagamento  = new Pagamento();
    $inscricao  = new Inscricao();
    $candidato  = new Candidato();
    $utilizador = new Utilizador();

    $select     = new CrudPagamento();
    $selectinsc = new CrudInscricao();
    $selectCand = new CrudCandidato();
    $selectUtil = new CrudUtilizador();


    $id = $_POST['id'];

    $pagamento  = $select->getById($id);
    $inscricao  = $selectinsc->getById($pagamento->getIdInscricao());
    $candidato  = $selectCand->getById($inscricao->getIdCandidato());
    $utilizador = $selectUtil->getById($_COOKIE['idUtilizador']);


    /*if($email->enviarPag($pagamento->getNomeCand(), $pagamento->getCurso(), $candidato->getEmail(), $pagamento->getPreco(), $pagamento->getFormPag(), $utilizador->getTipoUtilizador(), $utilizador->getNome(), $pagamento->getId(), $inscricao->getId())) {
        $select->cofirm($id);
        header('Location: reciclagem.php');
    } else {
      header('Location: reciclagem.php');
    }*/
}