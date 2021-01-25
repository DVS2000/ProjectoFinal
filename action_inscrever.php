<?php

# INCLUINDO O MODEL DO CURSO
include_once('model/curso.php');

# INCLUINDO O CONTROLLER DO CURSO
include_once('controller/crud-curso.php');

if(isset($_POST['idFaculdade'])) {

    $idFaculdade = $_POST['idFaculdade'];

    $curso = new CrudCurso();

    $dados = $curso->getByIdFaculdade($idFaculdade);


    echo json_encode($dados);
} else if(isset($_POST['idCurso'])) {

    $idCurso = $_POST['idCurso'];

    $curso = new CrudCurso();

    $dados = $curso->getPrecoByID($idCurso);

    echo $dados->getPreco();
}

?>