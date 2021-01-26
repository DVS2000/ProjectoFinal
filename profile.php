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
    $letraInical = $dados->getFoto() == null ? substr($dados->getNome(), 0, 1) : '';
} else if (isset($_COOKIE['idCandidato'])) {

    $idCandidato              = $_COOKIE['idCandidato'];
    $getCand                  = new CrudCandidato();
    $dados                    = $getCand->getById($idCandidato);
    $inscriCurso = $inscricao->getByCandidato($dados->getId());
    $_SESSION['idCandidato']  = $_COOKIE['idCandidato'];
    $letraInical = $dados->getFoto() == null ? substr($dados->getNome(), 0, 1) : '';
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

    <title>Escola de Condução</title>
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
                            <span class="ml-2  text-gray-600 small">' . $dados->getNome() . '</span>'  
                            ?></h1>
                        <hr>
                    </div>
                    <form class="user" method="POST" name="inscricao" id="inscricao">
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
                                    <input type="email" value="<?php echo $dados->getEmail(); ?>" class="form-control form-control-user" placeholder="E-mail" name="telEmail" required="required">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user " value="<?php echo $dados->getBi(); ?>" placeholder="Bilhete de Identidade" name="bi" required="required" maxlength="14">
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
                                </div>
                            </div>
                        </div>


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

            $('#planoAula').hide();
            $('#faculdade').change(function() {
                $('#planoAula').hide();
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
                $.post('action_inscrever.php', {
                    idCurso: $(this).val()
                }, function(data) {
                    const dataJson = JSON.parse(data)
                    $('#preco').val(`${dataJson.preco},00 AOA`)
                    $('#planoAula').fadeIn('1500').attr('href', dataJson.planoAula).text(`Plano de Estudos ${dataJson.descricao}`)
                })
            })


            /*
             :::::::: ADICIONANDO FUNÇÃO AO jQuery Validade ::::::::
              -> AQUI ADICIONAMOS UMA FUNÇÃO PARA 
              -> VALIDAR A IDADE DO CANDIDO,
              -> CASO ELE FOR MENOS DE IDADE 
              -> IDADE O SISTEMA NÃO ACEITA A SUA INSCRICAO
             */
            jQuery.validator.addMethod("verifyDt", function(value, element) {
                data = new Date();
                date = data.getFullYear();
                minhaData = value[0] + value[1] + value[2] + value[3];
                idade = parseInt(date) - parseInt(value);
                if (idade >= 18) {
                    return true;
                } else {
                    return false;
                }
            }, "Precisa ser maior de idade");


            $("#inscricao").validate({
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
                    dtNasc: {
                        required: true,
                        verifyDt: true
                    },
                    morada: {
                        required: true,
                        minlength: 6
                    },
                    curso: {
                        required: true
                    },
                    foto: {
                        required: true,
                        extension: "png|jpg|jpeg"
                    },
                    certificado: {
                        required: true,
                        extension: "pdf|png|jpg|jpeg"
                    },
                    bilhete: {
                        required: true,
                        extension: "pdf|png|jpg|jpeg"
                    },

                },
                submitHandler: function(forms) {

                    var form = new FormData($("#inscricao")[0]);

                    $.ajax({
                        url: 'action_inscrever.php',
                        method: "POST",
                        contentType: false,
                        dataType: 'json',
                        cache: false,
                        processData: false,
                        data: form,
                    }).done(function(res) {
                        alert('AQUI')

                        console.log(res)

                        if (res == 1) {
                            avisoCriar.fadeIn('slow').fadeOut(8000);
                            $("#text-aviso-criar").html("Este nº de bilhete já foi registado, Tente com outro nº bilhete.");
                        } else if (res == 2) {
                            window.location.replace("http://localhost/inscricaoonline/");
                        } else if (res == 3) {
                            avisoCriar.fadeIn('slow').fadeOut(8000);
                            $("#text-aviso-criar").val("Ocorre um erro!, tente mais tarde.");
                        }
                    }).fail(function(res) {
                        alert('ERRO')
                        console.log(res)
                    });
                }
            });
        })
    </script>




</body>

</html>