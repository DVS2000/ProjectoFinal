<?php

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


session_start();

$status = 0;

$dados = new Candidato();
$inscricao = new CrudInscricao();
$clear = new Clear();
$inscriCurso;

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
    $letraInical = $dados->getFoto() == null ? substr($dados->getNome(), 0, 1) : '';
    
    $_SESSION['idCandidato']  = $_COOKIE['idCandidato'];


}

?>


<!DOCTYPE html>
<html lang="pt-PT">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <title>Online</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="Abraham Nketa">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="#" type="image/x-icon" />
    <link rel="apple-touch-icon" href="#" />

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="src/src/css/bootstrap.min.css" />
    <!-- Pogo Slider CSS -->
    <link rel="stylesheet" href="src/src/css/pogo-slider.min.css" />
    <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="src/src/css/style.css" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="src/src/css/responsive.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="src/src/css/custom.css" />

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
            <img src="src/src/images/loader.gif" alt="#" />
        </div>
    </div>
    <!-- end loader -->
    <!-- END LOADER -->

    <!-- Start header -->

    <header class="top-header">
        <nav class="navbar header-nav navbar-expand-lg">
            <div class="container-fluid" style="padding-left: 0px !important; padding-right: 0px !important;">
                <a class="navbar-brand" href="http://localhost/inscricaoonline/"><img src="src/src/images/uor_logo.png" height="50px" alt="image"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav" style="color: #f0ad4e;">
                        <?php
                        if ($dados->getid() == null) {
                            echo '<li><a class="nav-link ative" data-dismiss="modal" data-target="#loginModal" data-toggle="modal">Entrar</a></li>
                            <li><a class="nav-link" data-toggle="modal" data-target="#criarConta">Criar conta</a></li>';
                        } else {
                            echo ' <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button style="
                                height: 50px;
                                border-radius: 100%;
                                width: 50px;
                                background: #f0ad4e;
                                border-color: #ffff;
                                background-image: url(\'http://localhost/inscricaoonline/'.$dados->getFoto().'\');
                                background-size: cover;
                            " class="btn btn-primary btn-circle">
                                    <h4 style="
                                    margin-top: 5px;
                                    color: #fff;">' . $letraInical . '</h4>
                                </button>   
                            <span class="ml-2  text-gray-600 small">' . $dados->getNome() . '</span>
                                
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Perfil
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Terminar sessão
                                </a>
                                </div>';
                        }
                        ?>

                    </ul>
                </div>

            </div>
            </div>
        </nav>
    </header>
    <!-- End header -->

    <!-- Start Banner -->
    <div class="ulockd-home-slider">
        <div class="container-fluid" style="padding-left: 0px !important; padding-right: 0px !important;">
            <div class="row">
                <div class="pogoSlider" id="js-main-slider">
                    <div class="pogoSlider-slide" style="background-image:url(src/src/images/dsc_0443.jpg);">
                        <div style="background: rgba(0, 0, 0, .3); height: 100%; width: 100%;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="slide_text">
                                            <h3 style="color: #fff;">Inscrição Online</h3>
                                            <br>
                                            <h4><span class="theme_color" style="color: #fff;">Simples, rápido e cômodo</span></h4>
                                            <br>
                                            <p style="color: #fff;">Evite longas filas de espera, evite aglomerações</p>
                                            <?php

                                            if (!isset($_SESSION['idCandidato'])) {
                                                echo '<a class="contact_bt " data-dismiss="modal" data-target="#loginModal" data-toggle="modal"  href="#" style="background-color:#f0ad4e;">Inscrever-se</a>';
                                            } else if (empty($inscriCurso)) {
                                                echo '<a class="contact_bt "  href="inscrever.php" style="background-color:#f0ad4e;">Inscrever-se</a>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pogoSlider-slide" style="background-image:url(src/src/images/dsc_0331-1.jpg);">
                        <div style="background: rgba(0, 0, 0, .3); height: 100%; width: 100%;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="slide_text">
                                            <h3 style="color: #fff;">Preparamos o Futuro</h3>
                                            <br>
                                            <h4><span class="theme_color" style="color: #fff;">Simples, rápido e cômodo</span></h4>
                                            <br>
                                            <p style="color: #fff;">Formamos líderes com programas contextualizados, que proporcionam as novas gerações, o desenvolvimento do espírito empreendedor para adaptar-se a realidade social, económica, cultural e política do país.</p>
                                            <?php

                                            if (!isset($_SESSION['idCandidato'])) {
                                                echo '<a class="contact_bt " data-dismiss="modal" data-target="#loginModal" data-toggle="modal"  href="#" style="background-color:#f0ad4e;">Inscrever-se</a>';
                                            } else if (empty($inscriCurso)) {
                                                echo '<a class="contact_bt "  href="inscrever.php" style="background-color:#f0ad4e;">Inscrever-se</a>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .pogoSlider -->
            </div>
        </div>
    </div>



    <div style="background: #f0ad4e ;" class="p-2 my-5 m-5">
        <h4 class="text-white center" style="font-weight: bold;">FACULDADES</h4>
    </div>

    <div class="mx-5">
        <hr>
    </div>

    <div class="container my-5">
        <div class="row">

            <div class="col-sm-12 col-md-6 mb-4">
                <div class="card" style="box-shadow:  -20px -20px 60px #f9f6f6,20px 20px 60px #ffffff;">
                    <img class="card-img-top" src="http://uor.ed.ao/wp-content/uploads/2017/12/dsc_0391-1-1-1024x683.jpg" alt="Card image cap">
                    <div class="card-body">
                        <div style="background-color: #f0ad4e" class="p-1">
                            <p class="card-title center text-white p-0">CIÊNCIAS E TECNOLOGIA</p>
                        </div>
                        <p class="card-text text-justify">Nossa visão como uma faculdade é fornecer o melhor ensino superior orientado para a prática , em Ciências Sociais, através de programas internacionalmente reconhecidos, pesquisa e serviço para permitir os estudantes a ser líderes profissionais dentro da sociedade do conhecimento nacional, regional e global.</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6">
                <div class="card" style="box-shadow:  -20px -20px 60px #f9f6f6,20px 20px 60px #ffffff;">
                    <img class="card-img-top" src="http://uor.ed.ao/wp-content/uploads/2017/12/dsc_0319-1024x683.jpg" alt="Card image cap">
                    <div class="card-body">
                        <div class="p-1" style="background-color: #f0ad4e;">
                            <p class="card-title center text-white p-0">CIÊNCIAS SOCIAIS E HUMANAS</p>
                        </div>
                        <p class="card-text text-justify">Nossa visão como uma faculdade é fornecer o melhor ensino superior orientado para a prática , em Ciências Sociais, através de programas internacionalmente reconhecidos, pesquisa e serviço para permitir os estudantes a ser líderes profissionais dentro da sociedade do conhecimento nacional, regional e global.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="border-bottom: .25rem solid #f0ad4e!important; border-top: .25rem solid #f0ad4e!important;">
                <div class="modal-body">
                    <div class="col-lg-12 sm-6">
                        <div class="p-3">
                            <div class="text-left">
                                <h1 class="h4 text-gray-900 mb-4">ENTRAR</h1>
                            </div>
                            <form class="user" method="POST" id="formLogin">
                                <div class="form-group">

                                    <input type="text" class="form-control form-control-user" placeholder="Telefone ou E-mail" name="telEmail" required="required">
                                </div>
                                <div class="form-group">

                                    <input type="password" class="form-control form-control-user" placeholder="Senha" name="senha" required="required">
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <button class="btn btn-primary btn-block" style="background-color: #f0ad4e; border-color: #fff;" name="entrar">
                                            ENTRAR
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="" class="btn btn-primary btn-block" style="background-color: #f0ad4e; border-color: #fff;" data-dismiss="modal">CANCELAR</a>
                                    </div>
                                </div>
                            </form>

                            <div class="aviso">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <h3 class="text-center" id="text-aviso">Este candidato já foi registado.</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a class="small">Esqueceu a senha?</a>
                            </div>
                            <div class="text-center">
                                <a href="#" class="small" data-dismiss="modal" data-toggle="modal" data-target="#criarConta">Criar uma
                                    conta!</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- end section -->




    <div class="modal fade" id="criarConta" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content" style="border-bottom: .25rem solid #f0ad4e!important; border-top: .25rem solid #f0ad4e!important;">
                <div class="modal-body">
                    <div class="col-lg-12 sm-6">
                        <div class="p-3">
                            <div class="text-left">
                                <h1 class="h4 text-gray-900 mb-4">CRIAR CONTA</h1>
                                <p>Crie a sua conta para poder se inscrever nos nosso cursos</p>
                            </div>
                            <form class="user" method="POST" id="formCriar" name="formCriar">

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" placeholder="Nome completo" name="nome" required="required">
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" placeholder="E-mail" name="email" required="required">
                                </div>


                                <div class="form-group">
                                    <input type="tel" name="telefone" maxlength="9" id="telefone" class="form-control form-control-user" required="required" placeholder="Telefone">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="senha" class="form-control form-control-user" required="required" id="senha" placeholder="Senha">
                                </div>

                                <div class="form-group">
                                    <input type="password" name="confirSenha" id="confirSenha" class="form-control form-control-user" required="required" placeholder="Confirmar senha">
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <button class="btn btn-primary btn-block" style="background-color: #f0ad4e; border-color: #fff;" name="criarConta" style="border-radius: 30px">
                                            Criar Conta
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="" class="btn btn-primary btn-block" style="background-color: #f0ad4e; border-color: #fff;" data-dismiss="modal">Cancelar</a>
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
                            <hr>
                            <div class="text-center">
                                <a class="small" href="admin/esqueceu-senha.php?tipo=candidato">Esqueceu a senha?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Já tenho uma
                                    conta</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="candidatura" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-bottom: .25rem solid #f0ad4e!important; border-top: .25rem solid #f0ad4e!important;">
                <div class="modal-body">
                    <div class="col-lg-12 sm-6">
                        <div class="p-3">
                            <div class="text-left">
                                <h1 class="h4 text-gray-900 mb-4">CRIAR CONTA</h1>
                                <p>Crie a sua conta para poder se inscrever nos nosso cursos</p>
                            </div>
                            <form class="user" method="POST" id="formCriar" name="formCriar">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" style="border-radius: 30px" placeholder="Nome completo" name="nome" required="required">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" style="border-radius: 30px" placeholder="E-mail" name="email" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" style="border-radius: 30px" placeholder="Nº do Bilhete de identidade" name="bi" required="required">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="date" class="form-control form-control-user" style="border-radius: 30px" placeholder="Nº do Bilhete de identidade" name="dtNasc" required="required">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="nomePai" id="" class="form-control form-control-user" required="required" placeholder="Nome do pai">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select style="border-radius: 30px; height: 50px;" class="custom-select" required name="sexo" required="required">
                                                <?php

                                                include_once('model/sexo.php');
                                                include_once('controller/crud-sexo.php');

                                                $select = new CrudSexo();
                                                $select->select();

                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select style="border-radius: 30px; height: 50px;" class="custom-select" required name="nacionalidade" required="required">

                                                <?php
                                                include_once('model/nacionalidade.php');
                                                include_once('controller/crud-nacionalidade.php');
                                                $select = new CrudNacionalidade();
                                                $select->options();
                                                ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="nomeMae" id="" class="form-control form-control-user" required="required" placeholder="Nome da mãe">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="tel" name="telefone" id="" class="form-control form-control-user" required="required" placeholder="Telefone">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="password" name="senha" class="form-control form-control-user" required="required" id="senha" placeholder="Senha">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="password" name="confirSenha" id="" class="form-control form-control-user" required="required" placeholder="Confirmar senha">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="morada" id="" placeholder="Morada" class="form-control form-control-user">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <button class="btn btn-primary btn-block" name="criarConta" style="border-radius: 30px">
                                            CRIAR CONTA
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="" class="btn btn-outline-danger btn-block" style="border-radius: 30px" data-dismiss="modal">CANCELAR</a>
                                    </div>
                                </div>
                            </form>

                            <div class="aviso-criar">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                    <h3 class="text-center" id="text-aviso-criar">Este candidato já foi registado.</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="view/esqueceu-senha.php?tipo=candidato">Esqueceu a senha?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Já tenho uma
                                    conta</a>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Terminar Sessão?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tens certeza que deseja terminar sessão da tua conta ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Não</button>
                    <a class="btn btn-primary" href="Util/logout.php">Sim</a>
                </div>
            </div>
        </div>
    </div>


    <!-- end section -->


    </footer>
    <!-- End Footer -->

    <div class="footer_bottom" style="background-color:#f0ad4e;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="crp" style="color: #fff;">Universidade Óscar Ribas.</p>
                    <ul class="bottom_menu">
                        <li><a href="#" style="color: #fff;">Avenida Samora Machel, Município de Talatona, Luanda-Angola</a></li>
                        <li><a href="#" style="color: #fff;">+244922171521</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <a href="#" id="scroll-to-top" class="hvr-radial-out"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="src/jquery/jquery.js"></script>
    <script src="src/popper/popper.min.js"></script>
    <script src="src/bootstrap/js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="src/src/js/jquery.magnific-popup.min.js"></script>
    <script src="src/src/js/jquery.pogo-slider.min.js"></script>
    <script src="src/src/js/slider-index.js"></script>
    <script src="src/src/js/smoothscroll.js"></script>
    <script src="src/src/js/isotope.min.js"></script>
    <script src="src/src/js/images-loded.min.js"></script>
    <script src="src/src/js/custom.js"></script>

    <script src="src/jquery/jquery.validate.min.js"></script>
    <script src="src/jquery/additional-methods.min.js"></script>
    <script src="src/jquery/localization/messages_pt_PT.js"></script>
    <script>
        $(document).ready(function() {

            //  $("#alert").fadeOut('6000');
            aviso = $(".aviso");
            avisoCriar = $(".aviso-criar");
            avisoEditar = $(".aviso-editar");
            aviso.hide();
            avisoCriar.hide();
            avisoEditar.hide();

            /*
             :::::::: VALIDANDO O FORMÚLARIO PARA FAZER O CADASTRO DO CANDIDATO ::::::::::::::::::
            */
            $("#formCriar").validate({
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
                    senha: {
                        required: true,
                        minlength: 4,
                        maxlength: 10
                    },
                    confirSenha: {
                        required: true,
                        equalTo: "#senha"
                    }

                },
                submitHandler: function(forms) {
                    var form = new FormData($("#formCriar")[0]);

                    $.ajax({
                        url: "action.php",
                        method: "POST",
                        contentType: false,
                        dataType: 'json',
                        cache: false,
                        processData: false,
                        data: form,
                    }).done(function(res) {
                        /*
                        :::::: RESPOSTA(RESULTADO) ::::::::::
                            1 -> JÁ EXISTE NO NOSSO BANCO DE DADOS
                            2 -> CORREU TUDO BEM
                            3 -> OCORREU UM ERRO
                            */

                        if (res == 1) {
                            avisoCriar.fadeIn('slow').fadeOut(8000);
                            $("#text-aviso-criar").html("Este candidato já foi registado, Tente com outros dados.");
                        } else if (res == 2) {
                            window.location.reload();
                        } else if (res == 3) {
                            avisoCriar.fadeIn('slow').fadeOut(8000);
                            $("#text-aviso-criar").val("Ocorre um erro!, tente mais tarde.");
                        }
                    }).fail(function(res) {
                        avisoCriar.fadeIn('slow').fadeOut(8000);
                        $("#text-aviso-criar").val("Ocorre um erro!, tente mais tarde.");
                    });

                    /*
                     */
                }
            });


            /* VALINDO O FORMÚRLARIO DE LOGIN */
            $("#formLogin").validate({
                rules: {
                    telEmail: {
                        required: true,
                        minlength: 7,
                    },
                    senha: {
                        required: true,
                        minlength: 4,
                    }
                },
                submitHandler: function(forms) {

                    var form = new FormData($("#formLogin")[0]);

                    $.ajax({
                        url: "action.php",
                        method: "POST",
                        contentType: false,
                        dataType: 'json',
                        cache: false,
                        processData: false,
                        data: form,
                    }).done(function(res) {
                        window.location.reload();
                    }).fail(function(res) {
                        aviso.fadeIn('slow').fadeOut(10000);
                        $("#text-aviso").html("Ocorreu um erro, certifica se os teus dados estão correcto.");
                    })
                }
            });

        });
    </script>
</body>

</html>