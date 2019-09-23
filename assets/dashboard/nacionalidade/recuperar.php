<?php 


if(isset($_POST["deletar"])) {
    include_once('../../php/model/curso.php');
    include_once('../../php/controller/crud-curso.php');

    $id = $_POST['id'];
    $deletar = new CrudCurso();
    $deletar->recuperar($id);
    header('Location: eliminados.php');
} else {
    header('Location: eliminados.php');
}