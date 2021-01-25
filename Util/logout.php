<?php

setcookie('idCandidato', null, -1, '/inscricaoonline');

session_start();
session_unset();
session_destroy();

header('Location: ../');

?>