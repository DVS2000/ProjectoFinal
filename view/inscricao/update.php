<?php


    include_once('../../model/inscricao.php');
    include_once('../../controller/crud-inscricao.php');
    include_once('../../Util/clear-var.php');

    $clean = new Clear();

    $idCurso  = $clean->int('curso');
    $idInscri =  $clean->int('idInscricao');
    $inscricao = new Inscricao();

    $inscricao->setId($idInscri);
    $inscricao->setIdCurso($idCurso);

   
    $edit = new CrudInscricao();
    $edit->update($inscricao);
    header('Location: vertodos.php');

    