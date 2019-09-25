<?php 

include_once('../../php/model/curso.php');
include_once('../../php/controller/crud-curso.php');

# INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
include_once('../../php/Util/clear-var.php');

    $clean = new Clear();
    $clean->connect();


if(isset($_POST["deletar"])) {

    $id = $clean->int('id');
    $deletar = new CrudCurso();
    $deletar->delete($id);
    header('Location: reciclagem.php');
 
} else if(isset($_POST['recuperar'])) {
    $id = $clean->int('id');
    $recuperar = new CrudCurso();
    $recuperar->enable($id);
    header('Location: reciclagem.php');
    
} else {
  header('Location: reciclagem.php');


}