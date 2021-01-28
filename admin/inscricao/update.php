<?php


include_once('../../model/inscricao.php');
include_once('../../controller/crud-inscricao.php');
include_once('../../Util/clear-var.php');

$clean = new Clear();

$estadoInscricao  = $clean->int('estado_inscricao');
$idInscri         =  $clean->int('idInscricao');
$inscricao = new Inscricao();

$inscricao->setId($idInscri);
$inscricao->setEstadoInscricao($estadoInscricao);


$edit = new CrudInscricao();
echo $edit->update($inscricao);

if (isset($_SERVER["HTTP_REFERER"])) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
