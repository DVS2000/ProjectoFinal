<?php 


 include_once('../../model/curso.php');
 include_once('../../controller/crud-curso.php');

 # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
 include_once('../../Util/clear-var.php');

    $clean = new Clear();
    $clean->connect();

if(isset($_POST["disable"])) {

    $id = $clean->int('id');
    $deletar = new CrudCurso();
    $deletar->disable($id);
    header('Location: vertodos.php');
} else if(isset($_POST['delete'])) {

    $id = $clean->int('id');
    $deletar = new CrudCurso();
    $deletar->delete($id);
    header('Location: vertodos.php');
} else {
    header('Location: vertodos.php');
}