<?php

include_once('model/curso.php');
include_once('controller/crud-curso.php');



$insert = new CrudCurso();
$dados = $insert->select();

var_dump($dados);
?>