<?php 


 include_once('../../php/model/utilizador.php');
 include_once('../../php/controller/crud-utilizador.php');

 # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
 include_once('../../php/Util/clear-var.php');

    $clean = new Clear();
    $clean->connect();

if(isset($_POST["disable"])) {

    $id = $clean->int('id');
    $deletar = new CrudUtilizador();
    $deletar->disable($id);
    header('Location: vertodos.php');
} else if(isset($_POST['delete'])) {

    $id = $clean->int('id');
    $deletar = new CrudUtilizador();
    $deletar->delete($id);
    header('Location: vertodos.php');
} else {
    header('Location: vertodos.php');
}