<?php


session_start();
session_unset();
session_destroy();

setcookie('idUtilizador', null, -1, '/inscricaoonline/admin');

header('Location: ../admin/login.php');

?>