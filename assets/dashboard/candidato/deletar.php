<?php 


if(isset($_POST["deletar"])) {
    include_once('../../php/model/utilizador.php');
    include_once('../../php/controller/crud-utilizador.php');

    $id = $_POST['id'];
    $deletar = new CrudUtilizador();
    $deletar->delete($id);
    header('Location: vertodos.php');
} else {
    header('Location: vertodos.php');
}