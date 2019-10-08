<?php 


 include_once('../../model/inscricao.php');
 include_once('../../controller/crud-inscricao.php');
 include_once('../../controller/crud-pagamento.php');
 # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
 include_once('../../Util/clear-var.php');

    $clean = new Clear();
    $deletePag = new CrudPagamento();

if(isset($_POST["enable"])) {

    $id = $clean->int('id');
    $deletar = new CrudInscricao();
    $deletar->enable($id);
    header('Location: reciclagem.php');
} else if(isset($_POST['delete'])) {

    $id = $clean->int('id');
    $deletar = new CrudInscricao();
    $deletar->delete($id);
    $deletePag->delete($id);
    header('Location: reciclagem.php');
} else {
    header('Location: reciclagem.php');
}