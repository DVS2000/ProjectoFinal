<?php

# INCLUINDO O MODEL DO CANDIDATO
include_once('model/candidato.php');

# INCLUINDO O CONTROLLER DO CANDIDATO
include_once('controller/crud-candidato.php');

# INCLUINDO O FICHEIRO DE LIMPEZA DAS VARIAVEIS
include_once('Util/clear-var.php');

include_once('controller/relatorio-candidato.php');


session_start();

$status = 0;
$dados = new Candidato();

    if(isset($_SESSION['idCandidato'])) {

        $idCandidato = $_SESSION['idCandidato'];
        $getCand   = new CrudCandidato();
        $dados = $getCand->getById($idCandidato);
        $_SESSION['idCandidato'] = $dados->getId();

    } else if(isset($_COOKIE['idCandidato'])) {

        $idCandidato = $_COOKIE['idCandidato'];
        $getCand   = new CrudCandidato();
        $dados = $getCand->getById($idCandidato);
    }

if(isset($_POST['criarConta'])) {

    $clear = new Clear();

    $nome               = $clear->specialChars('nome');
    $email              = $clear->email('email');
    $telefone           = $clear->int('telefone');
    $bi                 = $clear->specialChars('bi');
    $dtNasc             = $clear->specialChars('dtNasc');
    $sexo               = $clear->int('sexo');
    $nacionalidade      = $clear->int('nacionalidade');
    $nomePai            = $clear->specialChars('nomePai');
    $nomeMae            = $clear->specialChars('nomeMae');
    $morada             = $clear->specialChars('morada');
    $senha              = $clear->specialChars('senha');
    $confirSenha        = $clear->specialChars('confirSenha');

    $anoNasc            = substr($dtNasc, 0, 4);
    $anoActual          = date('Y');

    $idade              = (int)$anoActual - (int)$anoNasc;


    if($senha != $confirSenha) {
        $status = 4;
    } else if($idade < 18) {
        $status = 5;
    } else {
        $candidato = new Candidato();

        $candidato->        setNome($nome);
        $candidato->        setEmail($email);
        $candidato->        setTelefone($telefone);
        $candidato->        setBi($bi);
        $candidato->        setDtNasc($dtNasc);
        $candidato->        setIdSexo($sexo);
        $candidato->        setIdNacionalidade($nacionalidade);
        $candidato->        setIdEstado(1);
        $candidato->        setNomePai($nomePai);
        $candidato->        setNomeMae($nomeMae);
        $candidato->        setMorada($morada);
        $candidato->        setSenha($senha);
        $candidato->        setDtCriacao(date('Y-m-d'));
        $candidato->        setDtEdicao(date('Y-m-d'));

        $insert = new CrudCandidato();
        $status = $insert->insert($candidato);

        $relatorioCandidato = new RelatorioCandidato();
        $relatorioCandidato->UpdateRelatorio();

    }


    } else if(isset($_POST['entrar'])) {
        
        $clear = new Clear();

        $telefone           = $clear->int('telEmail');
        $email              = $clear->email('telEmail');
        $senha              = md5($clear->specialChars('senha'));

        $candidato = new Candidato();
        $candidato->setTelefone($telefone);
        $candidato->setEmail($email);
        $candidato->setSenha($senha);

        $login = new CrudCandidato();
        $cand = $login->login($candidato);

        if($cand->getid() == null) {
            echo "Não tens acesso";
        } else {
            $dados = $login->getById($cand->getId());
            setcookie('idCandidato', $dados->getId(), time() + 3600);
            $_SESSION['idCandidato'] = $dados->getId();

        }


} 


?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">
    <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="src/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="src/style/style.css">
    <link rel="stylesheet" href="src/style/animate.css">
    <title>Escola de Condução</title>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="6">


    <?php


    if($status == 1) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <h3>Este candidato já está registado.</h3>
        </div>';

    } else if($status == 2) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h3>Olá '.$nome.', seja Bem-vindo a JELU!</h3>
            </div>';
    } else if($status == 3) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h3>Ocorreu um erro, tente novamente.</h3>
            </div>';
    } else if($status == 4) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h3>O campo senha e confirmar senha são diferentes.</h3>
            </div>';
    } else if($status == 5) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h3>Tens que ter no mínimo 18 de idade.</h3>
            </div>';

    } else if(isset($_GET['sucesso']) && $_GET['sucesso'] == "true") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h3>Inscrição efectuado com sucesso.</h3>
            </div>';
    } else if(isset($_GET['sucesso']) && $_GET['sucesso'] == "false") {

        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h3>Inscrição não foi efectuado com sucesso.</h3>
            </div>';
    }




    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-1">
        <div class="container">
            <a class="navbar-brand animated wow pulse" href="#"><img src="src/imgs/log.png" height="45px;" class="py-0"
                    alt="" srcset=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <div class="navbar-nav mr-auto"></div>

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="#carouselExampleIndicators">Página inicial
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="#escola" class="nav-link">A Escola</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#curso">Curso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#galeria">Galeria</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contactos">Contactos</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <?php 
                        if($dados->getid() == null) {
                            echo '<li class="nav-item">
                                    <a data-toggle="modal" data-target="#loginModal" class="nav-link mybtn py-0 mt-2 mr-2"
                                        style="cursor: pointer">Entrar</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mybtn2 py-0 mt-2" style="cursor: pointer" data-toggle="modal"
                                        data-target="#criarConta">Criar Conta</a>
                                </li>';
                        } else {
                            echo ' <div class="topbar-divider d-none d-sm-block"></div>
                            <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button class="btn btn-primary btn-circle">
                                    <h4>'.substr($dados->getNome(), 0,1).'</h4>
                                </button>   
                            <span class="ml-2  text-gray-600 small">'.$dados->getNome().'</span>
                                
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Editar Perfil
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
    </nav>

    <div id="carouselExampleIndicators" class=" carousel slide" data-ride="carousel">
        <!-- INDICADORES DO CAROUSEL -->
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner">

            <!--PRIMEIRO ITEM DO CAROUSEL-->
            <div class="carousel-item active">
                <img src="src/imgs/img2.jpg" class="d-bloc w-100 img-fluid" alt="">
                <div class="carousel-caption d-none d-md-block text-left">
                    <h3 class="animated wow fadeInDown" data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
                        ESCOLA DE CONDUÇÃO "JELÚ"
                    </h3>
                    <h4 class="animated wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
                        A segurança é a nossa prioridade!
                    </h4>
                    <a class="btn btn-outline-primary animated fadeInUp" data-toggle="modal" data-target="#loginModal"
                        data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s; cursor: pointer;">
                        FAZ A TUA PRÉ-INSCRIÇÃO
                    </a>


                </div>
            </div>

            <!--SEGUNDO ITEM DO CAROUSEL-->
            <div class="carousel-item">
                <img src="src/imgs/img.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-left">
                    <h3 class="animated wow fadeInDown" data-wow-delay=".4s"
                        style="visibility: visible;-webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
                        AQUI, A SEGURANÇA APRENDE-SE</h3>
                    <h4 class="animated wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible;-webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
                        Prioridade ao ensino de uma condução segura e consciente.</h4>
                    <a class="btn btn-outline-primary animated fadeInUp" data-toggle="modal" data-target="#loginModal"
                        data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s; cursor: pointer;">
                        FAZ A TUA PRÉ-INSCRIÇÃO
                    </a>
                </div>
            </div>

            <!-- TERCEIRO ITEM DO CAROUSEL-->
            <div class="carousel-item">
                <img src="src/imgs/img1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-left">
                    <h3 class="animated wow fadeInDown" data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
                        O CAMINHO PARA A CONDUÇÃO DO SUCCESO.</h3>
                    <h4 class="animated wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
                        Nós ensinamos técnicas de condução defensiva para todas as situações. Aqui os campeões conduzem
                        com segurança.</h4>
                    <a class="btn btn-outline-primary animated fadeInUp" data-toggle="modal" data-target="#loginModal"
                        data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s; cursor: pointer;">
                        FAZ A TUA PRÉ-INSCRIÇÃO
                    </a>
                </div>
            </div>

        </div>

        <!--AQUI TEMOS OS INDICADORES DO CAROUSEL-->
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span aria-hidden="true">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
            </span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span aria-hidden="true">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="teste" id="escola"></div>
    <div class="container mt-5">
        <h3 class="text-left mytitle">
            ESCOLA DE CONDUÇÃO "JELU"
        </h3>

        <p class="text-justify">
            A escola nasceu em 1986 em Santa Comba Dão e foi chamada ‘do Emigrante’ em honra ao seu fundador Antonino de
            Sousa Gonçalves que, tendo sido emigrante durante muitos anos em países tão diversos como a Árabia Saudita
            ou a Suíça, cedo se apercebeu da importância para os emigrantes de terem a carta de condução. Assim, decidiu
            regressar a Portugal para ajudar outras pessoas na mesma situação. Estava assim criada a Escola de Condução
            do Emigrante – uma escola de condução pensada à medida das necessidades dos emigrantes, organizada por quem
            entende na 1ª pessoa as necessidades de quem está emigrado ou que pensa emigrar.
        </p>
        <hr>
        <p class="text-justify">
            Hoje em dia, a escola continua a crescer e a adaptar-se às evolução das necessidades dos clientes que serve,
            alargando o seu leque de serviços disponibilizado. Qualquer que seja a sua necessidade ao nível da
            aprendizagem da condução, formação especializada ou qualquer situação relacionada com o seu título de
            condução, a Escola de Condução ‘do Emigrante’ tem a solução.
        </p>
    </div>

    <!---====================== AQUI AONDE FICAM OS CURSOS ==========================--->
    <div id="curso"></div>


    <div class="mb-5 animated wow fadeInUp" data-wow-delay=".2s"
        style="visibility: visible;-webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
        <div class="container mt-40 mb-5">
            <h3 class="text-left mytitle">CURSOS DE ALTA QUALIDADE</h3>
            <div class="row mt-30">

                <?php

                    include_once('model/curso.php');
                    include_once('controller/crud-curso.php');
                    $select = new CrudCurso();

                    $curso = $select->select();

                    foreach ($curso as $key => $value) {
                        echo "<div class='col-md-4 col-sm-6'>
                                <div class='box3'>
                                    <img src='src/imgs/".$value->getId().".jpg'>
                                    <div class='box-content'>
                                        <h3 class='title'>".$value->getDescricao()."</h3>
                                        <h4 class='text-white'>
                                            ".$value->getPreco()."Kzs
                                        </h4>
                                        <div class='row d-flex justify-content-center mb-2'>
                                        <button class='btn btn-outline-primary mr-2' data-toggle='modal' data-target='#requisitos".$value->getId()."'>
                                            <i class='fa fa-eye' aria-hidden='true'></i>
                                            Requisitos
                                        </button> 

                                        <button class='btn btn-outline-primary' data-toggle='modal' data-target='#plano".$value->getId()."'>
                                            <i class='fa fa-book' aria-hidden='true'></i>
                                            Plano de aula
                                        </button> 
                                        </div>";
                                        if($dados->getId() != null)  {
                                            echo "<button class='btn btn-outline-primary' data-toggle='modal' data-target='#inscrever".$value->getId()."'>
                                                INSCREVER-SE
                                            </button> ";
                                            }
                                        
                                    echo "</div>
                                    </div>
                                </div>";
                    }
                    ?>

            </div>
        </div>
    </div>



    <section class="sec1">
        <div class="test">
            <div class="container">
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <div class="card p-2">

                            <p class="text-justify">
                                Ao longo da sua vida a escola manteve o seu foco nas necessidades dos emigrantes tendo
                                sido igualmente adaptada e melhorada para o público nacional. A Escola de Condução ‘do
                                Emigrante’ orgulha-se de servir há mais de 30 anos feitos de imenso sucesso – comprovado
                                pelas suas taxas de aprovação que são das mais altas do país.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card p-2">

                            <p class="text-justify">
                                Ao longo da sua vida a escola manteve o seu foco nas necessidades dos emigrantes tendo
                                sido igualmente adaptada e melhorada para o público nacional. A Escola de Condução ‘do
                                Emigrante’ orgulha-se de servir há mais de 30 anos feitos de imenso sucesso – comprovado
                                pelas suas taxas de aprovação que são das mais altas do país.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card p-2">


                            <p class="text-justify">
                                Ao longo da sua vida a escola manteve o seu foco nas necessidades dos emigrantes tendo
                                sido igualmente adaptada e melhorada para o público nacional. A Escola de Condução ‘do
                                Emigrante’ orgulha-se de servir há mais de 30 anos feitos de imenso sucesso – comprovado
                                pelas suas taxas de aprovação que são das mais altas do país.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="mb-5 animated wow fadeInUp" data-wow-delay=".2s"
        style="visibility: visible;-webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
        <div class="container mt-40 mb-5">
            <h3 class="text-left mytitle" id="galeria">CURSOS DE ALTA QUALIDADE</h3>
            <div class="row mt-30">
                <div class="col-md-4 col-sm-6">
                    <div class="box3">
                        <img src="http://bestjquery.com/tutorial/hover-effect/demo169/images/img-1.jpg">
                        <div class="box-content">
                            <h3 class="title">DORIVALDO</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci pariatur qui.
                            </p>
                            <button class="btn btn-outline-primary">
                                SABER MAIS
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="box3">
                        <img src="http://bestjquery.com/tutorial/hover-effect/demo169/images/img-2.jpg">
                        <div class="box-content">
                            <h3 class="title">Kristiana</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci pariatur qui.
                            </p>
                            <button class="btn btn-outline-primary">
                                SABER MAIS
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="box3">
                        <img src="http://bestjquery.com/tutorial/hover-effect/demo169/images/img-3.jpg">
                        <div class="box-content">
                            <h3 class="title">Kristiana</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci pariatur qui.
                            </p>
                            <button class="btn btn-outline-primary">
                                SABER MAIS
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-40">
            <h3 class="text-center">NOSSOS SERVIÇOS</h3>
            <hr>
            <div class="row mt-30">
                <div class="col-md-4 col-sm-6">
                    <div class="box3">
                        <img src="http://bestjquery.com/tutorial/hover-effect/demo169/images/img-1.jpg">
                        <div class="box-content">
                            <h3 class="title">DORIVALDO</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci pariatur qui.
                            </p>
                            <button class="btn btn-outline-primary">
                                SABER MAIS
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="box3">
                        <img src="http://bestjquery.com/tutorial/hover-effect/demo169/images/img-2.jpg">
                        <div class="box-content">
                            <h3 class="title">Kristiana</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci pariatur qui.
                            </p>
                            <button class="btn btn-outline-primary">
                                SABER MAIS
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="box3">
                        <img src="http://bestjquery.com/tutorial/hover-effect/demo169/images/img-3.jpg">
                        <div class="box-content">
                            <h3 class="title">Kristiana</h3>
                            <p class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ad adipisci pariatur qui.
                            </p>
                            <button class="btn btn-outline-primary">
                                SABER MAIS
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <footer class="page-footer font-small  py-3" style="background: #1C2331" id="contactos">
        <!-- Footer Links -->
        <div class="container text-center text-md-left mt-5 text-light">

            <!-- Grid row -->
            <div class="row mt-3">

                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

                    <!-- Content -->
                    <h6 class="text-uppercase font-weight-bold">Sobre a empresa</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p> A escola nasceu em 1986 em Santa Comba Dão e foi chamada ‘do Emigrante’ em honra ao seufundador
                        Antonino de
                        Sousa Gonçalves que, tendo sido emigrante durante muitos anos em países tão diversos como
                        aÁrabia Saudita
                    </p>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-2 col-xl-2 mx-auto mb-4">

                    <!-- Links -->
                    <h6 class="text-uppercase font-weight-bold ">Mapa do site</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <ul class="text-light list-unstyled">
                        <li><a href="#carouselExampleIndicators" class="text-white">Página inicial</a></li>
                        <li><a href="#escola" class="text-white">A escola</a></li>
                        <li><a href="#curso" class="text-white">Cursos</a></li>
                        <li><a href="#galeria" class="text-white">Galeria</a></li>
                        <li><a href="#contactos" class="text-white">Contactos</a></li>
                    </ul>


                </div>
                <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-md-0 mb-4">

                    <!-- Links -->
                    <h6 class="text-uppercase font-weight-bold">Contactos</h6>
                    <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>
                        <i class="fas fa-home mr-3"></i> Rua da Samba-Luanda</p>
                    <p>
                        <i class="fas fa-envelope mr-3"></i> jelu@gmail.com</p>
                    <p>
                        <i class="fas fa-phone mr-3"></i> 925-726-859</p>
                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->
    </footer>


    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content"
                style="border-bottom: .25rem solid #0B508C!important; border-top: .25rem solid #0B508C!important;">
                <div class="modal-body">
                    <div class="col-lg-12 sm-6">
                        <div class="p-3">
                            <div class="text-left">
                                <h1 class="h4 text-gray-900 mb-4">ENTRAR</h1>
                            </div>
                            <form class="user" method="POST">
                                <div class="form-group">

                                    <input type="text" class="form-control form-control-user"
                                        style="border-radius: 30px" placeholder="Telefone ou E-mail" name="telEmail"
                                        required="required">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        style="border-radius: 30px" placeholder="Senha" name="senha"
                                        required="required">
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <button class="btn btn-primary btn-block" style="border-radius: 30px"
                                            name="entrar">
                                            ENTRAR
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="" class="btn btn-outline-danger btn-block" style="border-radius: 30px"
                                            data-dismiss="modal">CANCELAR</a>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Esqueceu a senha?</a>
                            </div>
                            <div class="text-center">
                                <a href="#" class="small" data-dismiss="modal" data-toggle="modal"
                                    data-target="#criarConta">Criar uma
                                    conta!</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <div class="modal fade" id="criarConta" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content"
                style="border-bottom: .25rem solid #0B508C!important; border-top: .25rem solid #0B508C!important;">
                <div class="modal-body">
                    <div class="col-lg-12 sm-6">
                        <div class="p-3">
                            <div class="text-left">
                                <h1 class="h4 text-gray-900 mb-4">CRIAR CONTA</h1>
                                <p>Crie a sua conta para poder se inscrever nos nosso cursos</p>
                            </div>
                            <form class="user" method="POST">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                style="border-radius: 30px" placeholder="Nome completo" name="nome"
                                                required="required">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                style="border-radius: 30px" placeholder="E-mail" name="email"
                                                required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                style="border-radius: 30px" placeholder="Nº do Bilhete de identidade"
                                                name="bi" required="required">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="date" class="form-control form-control-user"
                                                style="border-radius: 30px" placeholder="Nº do Bilhete de identidade"
                                                name="dtNasc" required="required">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="nomePai" id=""
                                                class="form-control form-control-user" required="required"
                                                placeholder="Nome do pai">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select style="border-radius: 30px; height: 50px;" class="custom-select"
                                                required name="sexo" required="required">
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
                                            <select style="border-radius: 30px; height: 50px;" class="custom-select"
                                                required name="nacionalidade" required="required">

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
                                            <input type="text" name="nomeMae" id=""
                                                class="form-control form-control-user" required="required"
                                                placeholder="Nome da mãe">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="tel" name="telefone" id=""
                                                class="form-control form-control-user" required="required"
                                                placeholder="Telefone">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="password" name="senha" id=""
                                                class="form-control form-control-user" required="required"
                                                placeholder="Senha">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="password" name="confirSenha" id=""
                                                class="form-control form-control-user" required="required"
                                                placeholder="Confirmar senha">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="morada" id="" placeholder="Morada"
                                                class="form-control form-control-user">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <button class="btn btn-primary btn-block" name="criarConta"
                                            style="border-radius: 30px">
                                            CRIAR CONTA
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="" class="btn btn-outline-danger btn-block" style="border-radius: 30px"
                                            data-dismiss="modal">CANCELAR</a>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="view/forgot-password.html">Esqueceu a senha?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="#" data-toggle="modal" data-target="#criarConta">Criar uma
                                    conta!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php

    if($dados->getId() != null) {
        echo '
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
        </div>';
    }





  

        include_once('controller/crud-formPag.php');

        $options="";
        $formPag = new CrudFormPag();

        $formsPags = $formPag->select();
        foreach ($formsPags as $key => $value) {
            $options.= $value;
        }
        $select = new CrudCurso();
        $dados  = $select->select();
        foreach ($dados as $key => $value) {

            echo '
            <div class="modal fade" id="requisitos'.$value->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">'.$value->getDescricao().' - Requisitos Necessário</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">'.$value->getRequisitos().'</div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>    
            ';

            echo '
            <div class="modal fade" id="plano'.$value->getId().'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">'.$value->getDescricao().' - Plano de Aula</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">'.$value->getPlanoAula().'</div>
                        <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>    
            ';



            echo '<div class="modal fade" id="inscrever'.$value->getId().'" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content"
                style="border-bottom: .25rem solid #0B508C!important; border-top: .25rem solid #0B508C!important;">
                <div class="modal-body">
                    <div class="col-lg-12 sm-6">
                        <div class="p-3">
                            <div class="text-left">
                                <h1 class="h4 text-gray-900 mb-4">INSCREVER-SE</h1>
                            </div>
                            <form class="user" method="POST" action="view/inscricao/">

                                <div class="form-group">
                                    <select style="border-radius: 30px; height: 50px;" class="custom-select" required
                                        name="formPag" required="required">
                                            '.$options.'
                                    </select>
                                </div>
                                <div class="form-group">
                                <input type="hidden" name="idCurso" value="'.$value->getId().'">
                                    <input type="text" class="form-control form-control-user" disabled
                                        style="border-radius: 30px; font-size: 14pt" placeholder="Valor a pagar"
                                        name="valor" value="'.$value->getPreco().' kzs" required="required">
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <button class="btn btn-primary btn-block" style="border-radius: 30px"
                                            name="cofirm">
                                            CONFIRMAR
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="" class="btn btn-outline-danger btn-block" style="border-radius: 30px"
                                            data-dismiss="modal">CANCELAR</a>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <div class="alert alert-warning">
                                <p><strong>Atenção:</strong> O pagamento vía cash tem um limite de até 6 dias para fazer
                                    o pagamento.</p>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>';
        
        }

    ?>

    <script src="src/jquery/jquery.js"></script>
    <script src="src/popper/popper.min.js"></script>
    <script src="src/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="src/js/sb-admin-2.min.js"></script>



</body>

</html>