<?php

setcookie('idCandidato', null, -1, '/ProjectoFinal');

session_start();
session_unset();
session_destroy();

header('Location: ../');

?>