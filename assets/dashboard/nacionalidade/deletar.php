<?php 


if(isset($_POST["deletar"])) {
    include_once('../../php/model/nacionalidade.php');
    include_once('../../php/controller/crud-nacionalidade.php');

    $id = $_POST['id'];
    echo $id;
    $deletar = new CrudNacionalidade();
    $deletar->delete($id);
    header('Location: vertodos.php');
} else {
    header('Location: vertodos.php');
}