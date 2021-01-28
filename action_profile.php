<?php

# INCLUINDO O MODEL DO CANDIDATO
include_once('model/candidato.php');

# INCLUINDO O CONTROLLER DO CANDIDATO
include_once('controller/crud-candidato.php');

# INCLUINDO O MODEL DO PAGAMENTO
include_once('model/pagamento.php');

# INCLUINDO O CONTROLLER DO PAGAMENTO
include_once('controller/crud-pagamento.php');

# INCLUINDO O FICHEIRO DE LIMPEZA DAS VARIAVEIS
include_once('Util/clear-var.php');

$clear = new Clear();

session_start();

if (!isset($_SESSION['idCandidato'])) {
    header('Location: index.php');
} else if (!isset($_COOKIE['idCandidato'])) {
    header('Location: index.php');
}

if (isset($_POST['editar'])) {
    $nome               = $clear->specialChars('nome');
    $email              = $clear->email('email');
    $telefone           = $clear->int('telefone');
    $bi                 = $clear->specialChars('bi');
    $morada             = $clear->specialChars('morada');



    $candidato = new Candidato();


    $candidato->setId($_SESSION['idCandidato']);
    $candidato->setNome($nome);
    $candidato->setEmail($email);
    $candidato->setTelefone($telefone);
    $candidato->setBi($bi);
    $candidato->setMorada($morada);
    $candidato->setDtEdicao(date('Y-m-d'));


    $update = new CrudCandidato();
    $status = $update->update($candidato);
    echo json_encode($status);
} else if (isset($_POST['pagar'])) {

    $status;

    $extensao = pathinfo($_FILES['comprovativo']['name'], PATHINFO_EXTENSION);
    $folder   = "admin/upload/";
    $tempFile = $_FILES['comprovativo']['tmp_name'];
    $newNAME = uniqid() . ".$extensao";

    if (move_uploaded_file($tempFile, $folder . $newNAME)) {
        $pagamento = new Pagamento();

        $pagamento->setIdInscricao($clear->int('idInscricao'));
        $pagamento->setComprovativo("admin/upload/$newNAME");

        $inserPagamento = new CrudPagamento();
        $status = $inserPagamento->insert($pagamento);

    } else {
        $status = 3;
    }


    echo json_encode($status);
}
