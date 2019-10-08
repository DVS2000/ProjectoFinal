<?php


session_start();
session_unset();
session_destroy();

setcookie('idUtilizador', null, -1, '/projectofinal/view');

header('Location: ../view/login.php');

?>