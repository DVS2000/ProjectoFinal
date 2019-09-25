<?php 


 include_once('../../php/model/nacionalidade.php');
 include_once('../../php/controller/crud-nacionalidade.php');

 # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
 include_once('../../php/Util/clear-var.php');

    $clean = new Clear();
    $clean->connect();

if(isset($_POST["recuperar"])) {

    $id = $clean->int('id');
    $deletar = new CrudNacionalidade();
    $deletar->enable($id);
    header('Location: reciclagem.php');
} else if(isset($_POST['delete'])) {

    $id = $clean->int('id');
    $deletar = new CrudNacionalidade();
    $deletar->delete($id);
    header('Location: reciclagem.php');
} else {
    header('Location: reciclagem.php');
}