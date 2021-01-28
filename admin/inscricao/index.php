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

    $inscricao              = new Inscricao();
    $idCandidato            = $_SESSION['idCandidato'] == null ? $_COOKIE['idCandidato'] : $_SESSION['idCandidato'];
    $idInscricao            = $_POST['idInscricao'];
    $estadoInscricao        = $_POST['estado_inscricao'];

    $inscricao->setIdCandidato($idCandidato);
    $inscricao->setid($idInscricao);
    $inscricao->setEstadoInscricao($estadoInscricao);
    $inscricao->setDtCriacao(date('Y-m-d'));
    $inscricao->setDtEdicao(date('Y-m-d'));

    $insert = new CrudInscricao();
    $status = $insert->update($inscricao);

    header('Location: ../index.php');

    /*$getCandidato   = new CrudCandidato();
    $candidato      = $getCandidato->getById($idCandidato);
    $nome           = $candidato->getNome();
    $emailCand      = $candidato->getEmail();

  #  echo $email; exit();
    $getCurso       = new CrudCurso();
    $curso          = $getCurso->getById($idCurso);
    $nomCurso       = $curso->getDescricao();


    $insert = new CrudInscricao();
    
    $email = new SendEmail();
    
    try {
        if($email->enviar($nome, $nomCurso, $emailCand)) {
            $insert->insert($inscricao);
    
            $insert = new CrudInscricao();
            $maxId = $insert->getMaxId($idCandidato);
        
            $pag = new Pagamento();
            $pag->setTempo(date('Y-m-d', strtotime('+6 days')));
            $pag->setIdInscricao($maxId);
            $pag->setEstado(0);
        
            $insertPag = new CrudPagamento();
            $insertPag->insert($pag);
        
            $_SESSION['inscricao'] = 1;
            header('Location: ../../index.php');
        } else {
            $_SESSION['inscricao'] = 2;
            header('Location: ../../index.php');
        }
    } catch (\Throwable $th) {
        $_SESSION['inscricao'] = 3;
        header('Location: ../../index.php');
    }*/


} else {
    echo '<script>window.location.replace("http://localhost/inscricaoonline/");</script>';
}