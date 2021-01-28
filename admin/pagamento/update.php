<?php


include_once('../../model/pagamento.php');
include_once('../../controller/crud-pagamento.php');

# INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
include_once('../../Util/clear-var.php');


$clear = new Clear();

$clean = new Clear();

$estado               = $clean->int('estado');
$idPagameento         =  $clean->int('idPagamento');

$pagamento = new Pagamento();
$pagamento->setId($idPagameento);
$pagamento->setEstado($estado);


$edit = new CrudPagamento();
echo $edit->update($pagamento);

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
