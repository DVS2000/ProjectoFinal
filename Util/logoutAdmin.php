<?php

setcookie('idUtilizador', null, -1, '/ProjectoFinal/view');

session_start();
session_unset();
session_destroy();

header('Location: ../view/login.php');

?>