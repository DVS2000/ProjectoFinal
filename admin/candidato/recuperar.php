<?php 


 include_once('../../model/candidato.php');
 include_once('../../controller/crud-candidato.php');

 # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
 include_once('../../Util/clear-var.php');

    $clean = new Clear();

if(isset($_POST["enable"])) {

    $id = $clean->int('id');
    $deletar = new CrudCandidato();
    $deletar->enable($id);
    header('Location: reciclagem.php');
} else if(isset($_POST['delete'])) {

    $id = $clean->int('id');
    $deletar = new CrudCandidato();
    $deletar->delete($id);
    header('Location: reciclagem.php');
} else {
    header('Location: reciclagem.php');
}