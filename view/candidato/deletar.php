<?php 


 include_once('../../php/model/candidato.php');
 include_once('../../controller/crud-candidato.php');

 # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
 include_once('../../Util/clear-var.php');

    $clean = new Clear();

if(isset($_POST["disable"])) {

    $id = $clean->int('id');
    $deletar = new CrudCandidato();
    $deletar->disable($id);
    header('Location: vertodos.php');
} else if(isset($_POST['delete'])) {

    $id = $clean->int('id');
    $deletar = new CrudCandidato();
    $deletar->delete($id);
    header('Location: vertodos.php');
} else {
    header('Location: vertodos.php');
}