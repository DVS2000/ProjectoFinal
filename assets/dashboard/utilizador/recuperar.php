<?php 


 include_once('../../php/model/utilizador.php');
 include_once('../../php/controller/crud-utilizador.php');

 # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
 include_once('../../php/Util/clear-var.php');

    $clean = new Clear();
    $clean->connect();

if(isset($_POST["enable"])) {

    $id = $clean->int('id');
    $deletar = new CrudUtilizador();
    $deletar->enable($id);
    header('Location: reciclagem.php');
} else if(isset($_POST['delete'])) {

    $id = $clean->int('id');
    $deletar = new CrudUtilizador();
    $deletar->delete($id);
    header('Location: reciclagem.php');
} else {
    header('Location: reciclagem.php');
}