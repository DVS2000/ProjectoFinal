<?php

setcookie('idCandidato', null, -1, '/projectofinal');

session_start();
session_unset();
session_destroy();

header('Location: ../');

?>