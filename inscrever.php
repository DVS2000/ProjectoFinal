<?php

session_start();

if (!isset($_SESSION['idCandidato'])) {
    header('Location: index.php');
} else if (!isset($_COOKIE['idCandidato'])) {
    header('Location: index.php');
}


# INCLUINDO O MODEL DO CANDIDATO
include_once('model/candidato.php');

# INCLUINDO O CONTROLLER DO CANDIDATO
include_once('controller/crud-candidato.php');

# INCLUINDO O FICHEIRO DE LIMPEZA DAS VARIAVEIS
include_once('Util/clear-var.php');

include_once('controller/relatorio-candidato.php');

# INCLUINDO O MODEL DA INSCRIÇÃO
include_once('model/inscricao.php');

# INCLUINDO O CONTROLLER DA INSCRICAO
include_once('controller/crud-inscricao.php');

$status = 0;

$dados = new Candidato();
$inscricao = new CrudInscricao();
$clear = new Clear();

if (isset($_SESSION['idCandidato'])) {


    $idCandidato             = $_SESSION['idCandidato'];
    $getCand                 = new CrudCandidato();
    $dados                   = $getCand->getById($idCandidato);

    $nome = $dados->getNome();
    $inscriCurso             = $inscricao->getByCandidato($dados->getId());
} else if (isset($_COOKIE['idCandidato'])) {

    $idCandidato              = $_COOKIE['idCandidato'];
    $getCand                  = new CrudCandidato();
    $dados                    = $getCand->getById($idCandidato);
    $inscriCurso = $inscricao->getByCandidato($dados->getId());
    $_SESSION['idCandidato']  = $_COOKIE['idCandidato'];
}



?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link href=".src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="src/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="src/style/style.css">
    <link rel="stylesheet" href="src/style/animate.css">

    <title>Escola de Condução</title>
</head>

<body>


    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-3"></div>
            <div class="col-lg-12 sm-6 card shadow mt-5">
                <div class="p-3">
                    <div class="text-left">
                        <h1 class="h4 text-gray-900 mb-4">FORMULÁRIO DE INSCRIÇÃO</h1>
                        <hr>
                    </div>
                    <form class="user" method="POST">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" value="<?php echo $dados->getNome(); ?>" class="form-control form-control-user" placeholder="Nome" name="nome" required="required">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="tel" value="<?php echo $dados->getTelefone(); ?>" class="form-control form-control-user" placeholder="Telefone" name="telefone" required="required" maxlength="9">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="email" value="<?php echo $dados->getEmail(); ?>" class="form-control form-control-user" placeholder="E-mail" name="telEmail" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user " placeholder="Bilhete de Identidade" name="bi" required="required" maxlength="14">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-user" placeholder="Data de Nascimento" name="dtNasc" required="required">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" placeholder="Morada" name="telefone" required="required" maxlength="9">
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="custom-select" style="border-radius: 30px" name="faculdade" id="faculdade">
                                        <?php

                                        include_once('model/faculdade.php');
                                        include_once('controller/crud-faculdade.php');
                                        $select = new CrudFaculdade();
                                        $select->options();

                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="custom-select" style="border-radius: 30px" name="faculdade" id="curso">
                                    </select>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="custom-select" style="border-radius: 30px" name="faculdade" id="faculdade">
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">


                            <div class="col-sm-12 input-group mb-3">
                                <label class="input-group-text" for="foto">Fotográfia</label>
                                <input type="file" class="form-control custom-input-file" id="foto">
                            </div>

                            <div class="col-sm-12 input-group mb-3">
                                <label class="input-group-text" for="bilhete">Bilhete de Identidade</label>
                                <input type="file" class="form-control custom-input-file" id="bilhete">
                            </div>

                            <div class="col-sm-12 input-group mb-3">
                                <label class="input-group-text" for="certificado">Certificado</label>
                                <input type="file" class="form-control custom-input-file" id="certificado">
                            </div>

                        </div>


                        <div class="row mb-3 mt-3">
                            <div class="col-sm-3">
                                <button class="btn btn-primary btn-block" style="border-color: white;" name="entrar">
                                    Inscrever-ser
                                </button>
                            </div>

                            <div class="col-sm-3 mb-3">
                                <a class="btn btn-primary btn-block" href="index.php" style="border-color: white;">
                                    Cancelar
                                </a>
                            </div>

                        </div>
                </div>


                <?php
                # INCLUINDO O MODEL DO CANDIDATO
                #include_once('../model/utilizador.php');

                # INCLUINDO O CONTROLLER DO CANDIDATO
                #include_once('../controller/crud-utilizador.php');

                # INCLUINDO O FICHEIRO DE LIMPEZA DAS VARIAVEIS
                #include_once('../Util/clear-var.php');

                /*if(isset($_POST['entrar'])) {
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
                }*/

                ?>
                </form>

            </div>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
    </div>


    <script src="src/jquery/jquery.js"></script>
    <script src="src/popper/popper.min.js"></script>
    <script src="src/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="src/js/sb-admin-2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#faculdade').change(function() {
                const idFaculdade = $(this).val();

                $.post('action_inscrever.php', {
                    idFaculdade: idFaculdade
                }, function(data) {

                    $('#curso option').each(function() {
                        $(this).remove()
                    });

                    const datas = JSON.parse(decodeURIComponent(data));
                    datas.forEach(element => $("#curso").append(`<option value="${element.id}">${element.descricao}</option>`))
                });
            })

            $('#curso').change(function() {
                alert($(this).val())
            })
        })
    </script>




</body>

</html>