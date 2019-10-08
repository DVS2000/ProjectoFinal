<?php

session_start();

if(isset($_SESSION['idUtilizador'])) {
    header('Location: index.php');
} else if(isset($_COOKIE['idUtilizador'])) {
    header('Location: index.php');
} 



?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link href="../src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../src/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="src/style/style.css">
    <link rel="stylesheet" href="src/style/animate.css">
   
    <title>Escola de Condução</title>
</head>

<body>


<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-sm-3"></div>
        <div class="col-lg-6 sm-6 card shadow mt-5">
    <div class="p-3">
        <div class="text-left">
            <h1 class="h4 text-gray-900 mb-4">ENTRAR</h1>
            <hr>
        </div>
        <form class="user" method="POST">
            <div class="form-group">

                <input type="text" class="form-control form-control-user" style="border-radius: 30px"
                    placeholder="Telefone ou E-mail" name="telEmail" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control form-control-user" style="border-radius: 30px"
                    placeholder="Senha" name="senha" required="required">
            </div>

            <div class="row">
                <div class="col-sm-6 mb-3">
                    <button class="btn btn-primary btn-block" style="border-radius: 30px" name="entrar">
                        ENTRAR
                    </button>
                </div>
                <div class="col-sm-6">
                    
                </div>
            </div>


            <?php
                # INCLUINDO O MODEL DO CANDIDATO
                include_once('../model/utilizador.php');

                # INCLUINDO O CONTROLLER DO CANDIDATO
                include_once('../controller/crud-utilizador.php');

                # INCLUINDO O FICHEIRO DE LIMPEZA DAS VARIAVEIS
                include_once('../Util/clear-var.php');

                if(isset($_POST['entrar'])) {
                    $clear = new Clear();

                    $telefone           = $clear->int('telEmail');
                    $email              = $clear->email('telEmail');
                    $senha              = md5($clear->specialChars('senha'));

                    $utilizador = new Utilizador();
                    $utilizador->setTelefone($telefone);
                    $utilizador->setEmail($email);
                    $utilizador->setSenha($senha);

                    $login = new CrudUtilizador();
                    $user = $login->login($utilizador);

                    if($user->getid() == null) {
                        echo "Não tens acesso";
                    } else {
                        $dados = $login->getById($user->getId());
                        setcookie('idUtilizador', $dados->getId(), time() + 36000 * 6);
                        $_SESSION['idUtilizador'] = $dados->getId();
                        header('Location: index.php');

                    }
                }

            ?>
        </form>
        <hr>
        <div class="text-center">
            <a class="small" href="esqueceu-senha.php?tipo=utilizador">Esqueceu a senha?</a>
        </div>
        
    </div>
</div>
<div class="col-sm-3">
</div>
    </div>
</div>


    <script src="../src/jquery/jquery.js"></script>
    <script src="../src/popper/popper.min.js"></script>
    <script src="../src/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../src/js/sb-admin-2.min.js"></script>

    

</body>

</html>
