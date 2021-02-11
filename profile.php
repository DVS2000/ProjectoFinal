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

# INCLUINDO O MODEL DO PAGAMENTO
include_once('model/pagamento.php');

# INCLUINDO O CONTROLLER DO PAGAMENTO
include_once('controller/crud-pagamento.php');


$status = 0;

$dados               = new Candidato();
$inscricao           = new CrudInscricao();
$pagamento           = new Pagamento();
$pagamentoController = new CrudPagamento();
$clear               = new Clear();

if (isset($_SESSION['idCandidato'])) {


    $idCandidato             = $_SESSION['idCandidato'];
    $getCand                 = new CrudCandidato();
    $dados                   = $getCand->getById($idCandidato);

    $nome                    = $dados->getNome();
    $inscriCurso             = $inscricao->getByCandidato($dados->getId());
    $pagamento               = $pagamentoController->getByIdInscricao($inscriCurso->getId());
    $letraInical             = $dados->getFoto() == null ? substr($dados->getNome(), 0, 1) : '';
} else if (isset($_COOKIE['idCandidato'])) {

    $idCandidato              = $_COOKIE['idCandidato'];
    $getCand                  = new CrudCandidato();
    $dados                    = $getCand->getById($idCandidato);
    $inscriCurso              = $inscricao->getByCandidato($dados->getId());
    $pagamento                = $pagamentoController->getByIdInscricao($inscriCurso->getId());
    $_SESSION['idCandidato']  = $_COOKIE['idCandidato'];
    $letraInical              = $dados->getFoto() == null ? substr($dados->getNome(), 0, 1) : '';
}



?>


<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../src/bootstrap/css/bootstrap.min.css">
    <link href=".src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="src/css/sb-admin-2.css" rel="stylesheet">
    <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="src/style/style.css">
    <link rel="stylesheet" href="src/style/animate.css">

    <title>Perfil - <?php echo $dados->getNome() ?></title>
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-3"></div>
            <div class="col-lg-12 sm-6 card shadow mt-5">
                <div class="p-3">
                    <div class="text-left">
                        <h1 class="h4 text-gray-900 mb-4">
                            <?php echo '
                           <button style="
                                height: 50px;
                                border-radius: 100%;
                                width: 50px;
                                background: #f0ad4e;
                                border-color: #ffff;
                                background-image: url(\'http://localhost/inscricaoonline/' . $dados->getFoto() . '\');
                                background-size: cover;
                            " class="btn btn-primary btn-circle">
                                    <h4 style="
                                    margin-top: 5px;
                                    color: #fff;">' . $letraInical . '</h4>
                                </button>   
                            <span class="ml-2  text-gray-600 small">' . $dados->getNome() . '</span>
                            
                            '

                            ?></h1>
                        <hr>
                    </div>
                    <form class="user" method="POST" name="profile" id="profile">
                        <div class="row">
                            <input type="hidden" name="id" value="<?php echo $dados->getId(); ?>">
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
                                    <input type="email" value="<?php echo $dados->getEmail(); ?>" class="form-control form-control-user" placeholder="E-mail" name="email" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user " value="<?php echo $dados->getBi(); ?>" placeholder="Bilhete de Identidade" name="bi" required="required" maxlength="14">
                                    <div class="row p-0">
                                        <a href="#" id="planoAula" class="pl-4 py-0 pr-2 form-control-user">Ver</a>
                                        <?php echo '<a href="http://localhost/inscricaoonline/' . $dados->getFoto() . '" target="_blanck" id="planoAula" class="pl-2 py-0 pr-0 form-control-user">Fotográria</a>'; ?>
                                        <?php echo '<a href="http://localhost/inscricaoonline/' . $dados->getCertificado() . '" target="_blanck" id="planoAula" class="pl-2 py-0 pr-0 form-control-user">Certificado</a>'; ?>
                                        <?php echo '<a href="http://localhost/inscricaoonline/' . $dados->getBilheteFile() . '" target="_blanck" id="planoAula" class="pl-2 py-0 pr-0 form-control-user">Bilhete de Identidade</a>'; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" value="<?php echo $dados->getDtNasc(); ?>" readonly name="dtNasc" required="required">
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" value="<?php echo $dados->getNacionalidade(); ?>" readonly name="dtNasc" required="required">
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" value="<?php echo $dados->getMorada(); ?>" class="form-control form-control-user" placeholder="Morada" name="morada" required="required">
                                </div>
                            </div>

                        </div>

                        <h1 class="h4 text-gray-900 mb-4 mt-3">
                            <span class="ml-2  text-gray-600 small">Dados da Inscrição</span>
                        </h1>
                        <hr>


                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" value="<?php echo $inscriCurso->getFaculdade(); ?>" readonly required="required">
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" value="<?php echo $inscriCurso->getCurso(); ?>" readonly required="required">
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" value="Estado: <?php echo $inscriCurso->getEstadoInscricao(); ?>" readonly required="required">
                                    <a href="<?php echo 'http://localhost/inscricaoonline/' . $inscriCurso->getPlanoAula() . ''; ?>" target="_blanck" id="planoAula" class="form-control-user">Plano de Estudo de <?php echo $inscriCurso->getCurso(); ?></a>
                                </div>
                            </div>
                        </div>

                        <?php

                        if ($pagamento->getId() != null) {
                            echo '
                                <h1 class="h4 text-gray-900 mb-4 mt-1">
                                <span class="ml-2  text-gray-600 small">Dados do Pagamento</span>
                                </h1>
                                <hr>

                                <div class="row">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" value="Estado: '.$pagamento->getEstado().'" readonly required="required">
                                        <a href="http://localhost/inscricaoonline/'. $pagamento->getComprovativo().'" target="_blanck" id="comprovativo" class="form-control-user">Abrir o Compravativo de Pagamento</a><br>
                                        <a href="http://localhost/inscricaoonline/recibo.php" target="_blanck" class="form-control-user mr-2"> BAIXAR O RECIBO DE INSCRIÇÃO</a>
                                    </div>
                                </div>
                                </div>

                                <hr>
                                ';
                        }


                        ?>


                        <div class="row mb-3 mt-3">
                            <div class="col-sm-3">
                                <button class="btn btn-primary btn-block" style="border-color: white;" name="editar">
                                    Editar Perfil
                                </button>
                            </div>

                            <div class="col-sm-3 mb-3">
                                <a class="btn btn-primary btn-block" href="index.php" style="border-color: white;">
                                    Voltar
                                </a>
                            </div>

                        </div>
                </div>


                </form>


                <?php
                if ($inscriCurso->getEstadoInscricao() == "Aprovado") {
                    if ($pagamento->getId() == null) {
                        echo '
                                <h1 class="h4 text-gray-900 mb-4 mt-1">
                                <span class="ml-2  text-gray-600 small">Dados do Pagamento</span>
                                </h1>
                                <hr>


                            <form name="pagamento" id="pagamento" method="post">
                                <div class="row">
                                <input type="hidden" name="idInscricao" value=' . $inscriCurso->getId() . '>
                                
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <label class="input-group-text" for="comprovativo">Comprovativo</label>
                                        <input type="file" class="form-control custom-input-file" id="comprovativo" name="comprovativo">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <button class="btn btn-primary btn-block" style="border-color: white;" name="pagar">
                                            Pagar
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <hr>';
                    }
                }

                ?>

                <div class="aviso-criar">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h3 class="text-center" id="text-aviso-criar">Este E-mail já foi registado.</h3>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
    </div>


    <script src="src/jquery/jquery.js"></script>
    <script src="src/popper/popper.min.js"></script>
    <script src="src/bootstrap/js/bootstrap.min.js"></script>

    <script src="src/jquery/jquery.validate.min.js"></script>
    <script src="src/jquery/additional-methods.min.js"></script>
    <script src="src/jquery/localization/messages_pt_PT.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="src/js/sb-admin-2.min.js"></script>

    <script>
        $(document).ready(function() {

            avisoCriar = $(".aviso-criar");
            avisoCriar.hide();

            $("#pagamento").validate({
                rules: {
                    comprovativo: {
                        required: true,
                        extension: "pdf|png|jpg|jpeg"
                    },
                },
                submitHandler: function(forms) {

                   

                    var form = new FormData($("#pagamento")[0]);

                    $.ajax({
                        url: 'action_profile.php',
                        method: "POST",
                        contentType: false,
                        dataType: 'json',
                        cache: false,
                        processData: false,
                        data: form,
                    }).done(function(res) {

                        console.log(res)

                        if (res == 2) {
                            avisoCriar.fadeIn('slow').fadeOut(8000);
                            $("#text-aviso-criar").html("Está operação não foi efetuada com sucesso.");
                        } else if (res == 1) {
                            window.location.replace("http://localhost/inscricaoonline/profile.php");
                        } else if (res == 3) {
                            avisoCriar.fadeIn('slow').fadeOut(8000);
                            $("#text-aviso-criar").val("Ocorre um erro!, tente mais tarde.");
                        }
                    }).fail(function(res) {
                        console.log(res)
                        avisoCriar.fadeIn('slow').fadeOut(8000);
                        $("#text-aviso-criar").val("Ocorre um erro!, tente mais tarde.");
                    });
                }
            })


            $("#profile").validate({
                rules: {
                    nome: {
                        required: true,
                        maxlength: 100,
                        minlength: 2,
                        minWords: 2,
                        maxWords: 5

                    },
                    email: {
                        required: true,
                        email: true
                    },
                    bi: {
                        required: true,
                        minlength: 10,
                        maxlength: 20,
                        maxWords: 1
                    },
                    telefone: {
                        required: true,
                        minlength: 9,
                        maxlength: 12
                    },
                    morada: {
                        required: true,
                        minlength: 6
                    },
                },
                submitHandler: function(forms) {

                    var form = new FormData($("#profile")[0]);

                    $.ajax({
                        url: 'action_profile.php',
                        method: "POST",
                        contentType: false,
                        dataType: 'json',
                        cache: false,
                        processData: false,
                        data: form,
                    }).done(function(res) {

                        console.log(res)

                        if (res == 1) {
                            avisoCriar.fadeIn('slow').fadeOut(8000);
                            $("#text-aviso-criar").html("Este nº de bilhete já foi registado, Tente com outro nº bilhete.");
                        } else if (res == 2) {
                            window.location.replace("http://localhost/inscricaoonline/profile.php");
                        } else if (res == 3) {
                            avisoCriar.fadeIn('slow').fadeOut(8000);
                            $("#text-aviso-criar").val("Ocorre um erro!, tente mais tarde.");
                        }
                    }).fail(function(res) {
                        avisoCriar.fadeIn('slow').fadeOut(8000);
                        $("#text-aviso-criar").val("Ocorre um erro!, tente mais tarde.");
                        console.log(res)
                    });
                }
            });
        })
    </script>




</body>

</html>