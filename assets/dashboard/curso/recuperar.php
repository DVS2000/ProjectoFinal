<?php 

include_once('../../php/model/curso.php');
include_once('../../php/controller/crud-curso.php');


if(isset($_POST["deletar"])) {

    $id = $_POST['id'];
    $deletar = new CrudCurso();
    $deletar->deleteDef($id);
    header('Location: reciclagem.php');
  // echo "Angola";
} else if(isset($_POST['recuperar'])) {
    $id = $_POST['id'];
    $recuperar = new CrudCurso();
    $recuperar->recuperar($id);
    header('Location: reciclagem.php');
    
} else {
  header('Location: reciclagem.php');


}