<?php

# INCLUINDO O MODEL DO CANDIDATO
include_once('model/candidato.php');

# INCLUINDO O CONTROLLER DO CANDIDATO
include_once('controller/crud-candidato.php');

# INCLUINDO O FICHEIRO DE LIMPEZA DAS VARIAVEIS
include_once('Util/clear-var.php');

include_once('controller/relatorio-candidato.php');

$status = 0;

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

}


?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">
    <link href="sr/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="src/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="src/style/style.css">
    <link rel="stylesheet" href="src/assets/style/animate.css">
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
                    <li class="nav-item">
                        <a data-toggle="modal" data-target="#loginModal" class="nav-link mybtn py-0 mt-2 mr-2"
                            style="cursor: pointer">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mybtn2 py-0 mt-2" style="cursor: pointer" data-toggle="modal"
                            data-target="#criarConta">Criar Conta</a>
                    </li>
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <title>ic_chevron_left_24px</title>
                    <g fill="#ffffff">
                        <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"></path>
                    </g>
                </svg>
            </span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <title>ic_chevron_right_24px</title>
                    <g fill="#ffffff">
                        <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"></path>
                    </g>
                </svg>
            </span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container ">
        <div class="row pt-5">
            <div class="col-md-6 col-sm-12">
                <h3 id="sobre">
                    A ESCOLA DE CONDUÇÃO "JELU"
                    <hr>
                </h3>
                <p class="text-justify">
                    A escola nasceu em 1986 em Santa Comba Dão e foi chamada ‘do Emigrante’ em honra ao seufundador Antonino de
                    Sousa Gonçalves que, tendo sido emigrante durante muitos anos em países tão diversos como aÁrabia Saudita
                    ou a Suíça, cedo se apercebeu da importância para os emigrantes de terem a carta de condução.Assim, decidiu
                    regressar a Portugal para ajudar outras pessoas na mesma situação. Estava assim criada aEscola de Condução
                    do Emigrante – uma escola de condução pensada à medida das necessidades dos emigrantes,organizada por quem
                    entende na 1ª pessoa as necessidades de quem está emigrado ou que pensa emigrar.
                </p>
            </div>
            <div class="col-md-6 col-sm-12">
                <figure class="text-right ">
                    <img class="imgAbout" src="imgs/img2.gif">
                </figure>
            </div>
        </div>
    </div>

    <!---====================== AQUI AONDE FICAM OS CURSOS ==========================--->
    <div class="teste" id="curso"></div>
    <div class="teste" id="curso"></div>
    <div class="mb-5 animated wow fadeInUp" data-wow-delay=".2s"
        style="visibility: visible;-webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
        <div class="container mt-40 mb-5">
            <h3 class="text-center">CURSOS DE ALTA QUALIDADE</h3>
            <hr>
            <div class="row mt-30">
                <div class="col-md-4 col-sm-12 mb-4">     
                    <!-- Card -->
                    <div class="card ovf-hidden">
        
                    <!-- Card image -->
                    <div class="view overlay">
                    <img class="card-img-top" src="imgs/img2.gif" alt="Card image cap">
                    <a>
                        <div class="mask waves-effect waves-light rgba-white-slight"></div>
                    </a>
                    </div>
            
                    <!-- Card content -->
                    <div class="card-body">
                        <!-- Title -->
                        <h4 class="card-title text-center">Nome  curso</h4>
                        <hr>
                        <!-- Text -->
                        <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet, qui accusamus! Dignissimos unde nihil quos, atque magni aperiam numquam labore.</p>
                        <a class="link-text">
                            <h5>Ler mais  <i class="fas fa-angle-double-right ml-2"></i></h5>
                        </a>
                    </div>    
                </div>
                <!-- Card -->        
            </div>


            <div class="col-md-4 col-sm-12 mb-4">            
                <!-- Card -->
                <div class="card ovf-hidden">
                    <!-- Card image -->
                    <div class="view overlay">
                    <img class="card-img-top" src="imgs/img2.gif" alt="Card image cap">
                    <a>
                        <div class="mask waves-effect waves-light rgba-white-slight"></div>
                    </a>
                    </div>
                
                    <!-- Card content -->
                    <div class="card-body">
                    <!-- Title -->
                    <h4 class="card-title text-center">Nome curso</h4>
                    <hr>
                    <!-- Text -->
                    <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet, qui accusamus! Dignissimos unde nihil quos, atque magni aperiam numquam labore.</p>
                    <a class="link-text">
                        <h5>Ler mais  <i class="fas fa-angle-double-right ml-2"></i></h5>
                    </a>
                </div>    
            </div>
            <!-- Card -->
            </div>

            <div class="col-md-4 col-sm-12 mb-4">           
                <!-- Card -->
                <div class="card ovf-hidden">
                    <!-- Card image -->
                    <div class="view overlay">
                      <img class="card-img-top" src="imgs/img2.gif" alt="Card image cap">
                      <a>
                        <div class="mask waves-effect waves-light rgba-white-slight"></div>
                      </a>
                    </div>
                      
                    <!-- Card content -->
                    <div class="card-body">
                        <!-- Title -->
                        <h4 class="card-title text-center">Nome  curso</h4>
                        <hr>
                        <!-- Text -->
                        <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet, qui accusamus! Dignissimos unde nihil quos, atque magni aperiam numquam labore.</p>
                          <a class="link-text">
                            <h5>Ler mais  <i class="fas fa-angle-double-right ml-2"></i></h5>
                          </a>
                        </div>    
                      </div>
                      <!-- Card -->       
                    </div>
                </div>
            </div>
        </div>



    <a href="#carouselExampleIndicators" class="back-to-top" style="display: block;">
        <div class="ripple-container"></div>
        <svg class="mysvg" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
            <title>ic_arrow_upward_48px</title>
            <g fill="#ffffff">
                <path d="M8 24l2.83 2.83L22 15.66V40h4V15.66l11.17 11.17L40 24 24 8 8 24z"></path>
            </g>
        </svg>
    </a>

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
                            <form class="user">
                                <div class="form-group">

                                    <input type="text" class="form-control form-control-user"
                                        style="border-radius: 30px" placeholder="Telefone ou E-mail">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user"
                                        style="border-radius: 30px" placeholder="Senha">
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <a href="index.html" class="btn btn-primary btn-block"
                                            style="border-radius: 30px">
                                            ENTRAR
                                        </a>
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
                                <a href="#" class="small" data-toggle="modal" data-target="#criarConta">Criar uma
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

    <h2 class="text-center pt-5" id="contactos">CONTACTOS</h2>
    <hr>
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-6 col-sm-12">
        <!-- Default form contact -->
        <form class="text-center border border-light p-5" action="#!">
        
            <!-- Name -->
            <input type="text" id="defaultContactFormName" class="form-control mb-4" placeholder="Nome">
        
            <!-- Email -->
            <input type="email" id="defaultContactFormEmail" class="form-control mb-4" placeholder="E-mail">
        
            <!-- Subject -->
            <input type="text" id="defaultContactFormsubject" class="form-control mb-4" placeholder="Asssunto">

            <!-- Message -->
            <div class="form-group">
                <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" placeholder="Mensagem"></textarea>
            </div>
        
            <!-- Send button -->
            <button class="btn btn-info btn-block" type="submit">Enviar</button>
        </form>
        <!-- Default form contact -->
        </div>
        <div class="col-md-6 col-sm-12">
            <h3>Lorem ipsum dolor sit amet consectetu.</h3>

        </div>
    </div>
</div>

<!-- Map  -->
<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d63075.46452560087!2d13.167916846616741!3d-8.859423021423899!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1ssamba!5e0!3m2!1spt-PT!2sao!4v1569590054413!5m2!1spt-PT!2sao" style="width: 100%; height: 400px;" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
    <!--Map-->
<!-- Footer -->
<footer class="page-footer font-small unique-color-dark  py-3" style="background: #1C2331">
    <!-- Footer Links -->
    <div class="container text-center text-md-left mt-5 text-light">
  
      <!-- Grid row -->
      <div class="row mt-3">
  
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
  
          <!-- Content -->
          <h6 class="text-uppercase font-weight-bold">Sobre a empresa</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <p> A escola nasceu em 1986 em Santa Comba Dão e foi chamada ‘do Emigrante’ em honra ao seufundador Antonino de
            Sousa Gonçalves que, tendo sido emigrante durante muitos anos em países tão diversos como aÁrabia Saudita
          </p>
  
        </div>
        <!-- Grid column -->
  
        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
  
          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold ">Mapa do site</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
          <ul class="text-light list-unstyled">
              <li><a href="#!">Página inicial</a></li>
              <li><a href="#!">A escola</a></li>
              <li><a href="#!">Cursos</a></li>
              <li><a href="#!">Galeria</a></li>
              <li><a href="#!">Contactos</a></li>
          </ul>
  
  
        </div>
        <!-- Grid column -->
  
        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
  
          <!-- Links -->
          <h6 class="text-uppercase font-weight-bold">Useful links</h6>
          <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">

          <ul class="text-light list-unstyled">
            <li><a href="#!">Página inicial</a></li>
            <li><a href="#!">A escola</a></li>
            <li><a href="#!">Cursos</a></li>
            <li><a href="#!">Galeria</a></li>
            <li><a href="#!">Contactos</a></li>
         </ul>

        </div>
        <!-- Grid column -->
  
        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
  
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

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3 bg-dark">© 2019 Copyright:
        <a href="https://mdbootstrap.com/education/bootstrap/" class="text-light"> DevApp</a>
      </div>
      <!-- Copyright -->
  <!-- Footer -->




    <script src="src/jquery/jquery.js"></script>
    <script src="src/popper/popper.min.js"></script>
    <script src="src/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


    <script>
        $(function () {

            /*FUNÇÃO QUE PERMITE CONTROLAR O BOTÃO QUE FAZ VOLTAR NO TOP*/
            var offset = 200;
            var duration = 500;
            $(window).scroll(() => {
                $(this).scrollTop() > offset
                    ? $('.back-to-top').fadeIn(400)
                    : $('.back-to-top').fadeOut(400);
            });
        });
    </script>
</body>

</html>