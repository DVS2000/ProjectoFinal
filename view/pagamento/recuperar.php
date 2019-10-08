<?php 

include_once('../../model/curso.php');
include_once('../../controller/crud-curso.php');

# INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
include_once('../../Util/clear-var.php');

    $clean = new Clear();

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