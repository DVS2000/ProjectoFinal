<?php


include_once('../../model/pagamento.php');
include_once('../../controller/crud-pagamento.php');

# INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
include_once('../../Util/clear-var.php');

$clear = new Clear();
$idPagmento = $clear->int('id');
$idFormPag  = $clear->int('formPag');



$pagamento = new Pagamento();
$pagamento->setId($idPagmento);
$pagamento->setIdFormPag($idFormPag);




$update = new CrudPagamento();
$update->update($pagamento);
header('Location: reciclagem.php');