<?php

session_start();

if(isset($_POST['cofirm'])) {
    include_once('../../model/inscricao.php');
    include_once('../../controller/crud-inscricao.php');
    include_once('../../util/email/enviar.php');

    include_once('../../model/pagamento.php');
    include_once('../../controller/crud-pagamento.php');

    include_once('../../model/candidato.php');
    include_once('../../controller/crud-candidato.php');

    include_once('../../model/curso.php');
    include_once('../../controller/crud-curso.php');

    $formPag = $_POST['formPag'];

    $inscricao      = new Inscricao();
    $idCandidato    = $_SESSION['idCandidato'];
    $idCurso        = $_POST['idCurso'];

    $inscricao->setIdCandidato($idCandidato);
    $inscricao->setIdCurso($idCurso);
    $inscricao->setDtCriacao(date('Y-m-d'));
    $inscricao->setDtEdicao(date('Y-m-d'));

    $getCandidato   = new CrudCandidato();
    $candidato      = $getCandidato->getById($idCandidato);
    $nome           = $candidato->getNome();
    $emailCand      = $candidato->getEmail();

  #  echo $email; exit();
    $getCurso       = new CrudCurso();
    $curso          = $getCurso->getById($idCurso);
    $nomCurso       = $curso->getDescricao();


    $insert = new CrudInscricao();
    
    $email = new SendEmail();
    if($email->enviar($nome, $nomCurso, $emailCand)) {
        $insert->insert($inscricao);

        $insert = new CrudInscricao();
        $maxId = $insert->getMaxId($idCandidato);
    
        $pag = new Pagamento();
        $pag->setIdFormPag($formPag);
        $pag->setTempo(date('Y-m-d', strtotime('+6 days')));
        $pag->setIdInscricao($maxId);
        $pag->setEstado(0);
    
        $insertPag = new CrudPagamento();
        $insertPag->insert($pag);
    
        header('Location: ../../index.php?sucesso=true');
    } else {
        header('Location: ../../index.php?sucesso=false');
    }


} else {
    header('Location: ../../index.php?sucesso=false');
}