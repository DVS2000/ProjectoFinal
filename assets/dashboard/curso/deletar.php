<?php 


 include_once('../../php/model/curso.php');
 include_once('../../php/controller/crud-curso.php');

if(isset($_POST["deletarTmp"])) {

    $id = $_POST['id'];
    $deletar = new CrudCurso();
    $deletar->disable($id);
    header('Location: vertodos.php');
} else if(isset($_POST['deletarDef'])) {

    $id = $_POST['id'];
    $deletar = new CrudCurso();
    $deletar->delete($id);
    header('Location: vertodos.php');
} else {
    header('Location: vertodos.php');
}