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

    if(isset($_SESSION['idCandidato'])) {


        $idCandidato             = $_SESSION['idCandidato'];
        $getCand                 = new CrudCandidato();
        $dados                   = $getCand->getById($idCandidato);
        $inscriCurso             = $inscricao->getByCandidato($dados->getId());

    } else if(isset($_COOKIE['idCandidato'])) {
       
        $idCandidato              = $_COOKIE['idCandidato'];
        $getCand                  = new CrudCandidato();
        $dados                    = $getCand->getById($idCandidato);
        $inscriCurso = $inscricao->getByCandidato($dados->getId());
        $_SESSION['idCandidato']  = $_COOKIE['idCandidato'];
    }

 /*
   if(isset($_POST['criarConta'])) {


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
        $candidato->        setSenha(md5($senha));
        $candidato->        setDtCriacao(date('Y-m-d'));
        $candidato->        setDtEdicao(date('Y-m-d'));

        $insert = new CrudCandidato();
       $status = $insert->insert($candidato);

        $maxIdAluno = $insert->getMaxId($telefone);

        $dados = $insert->getById($maxIdAluno);
        $_SESSION['idCandidato'] = $dados->getId();
        $_COOKIE['idCandidato'] = $dados->getId();

        $relatorioCandidato = new RelatorioCandidato();
        $relatorioCandidato->UpdateRelatorio();

        

    }
    
    } else if(isset($_POST['editarConta'])) {

        
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
    
            $candidato->        setId($idCandidato);
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
            $candidato->        setSenha(md5($senha));
            $candidato->        setDtCriacao(date('Y-m-d'));
            $candidato->        setDtEdicao(date('Y-m-d'));
    
            $update = new CrudCandidato();
            $status = $update->update($candidato);
    
            
    
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
            $inscricao = new CrudInscricao();
            $inscriCurso = $inscricao->getByCandidato($dados->getId());

      
            setcookie('idCandidato', $dados->getId(), time() + 36000 * 6);
            $_SESSION['idCandidato'] = $dados->getId();

        }


}*/ 


?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="src/bootstrap/css/bootstrap.min.css">
    <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="src/css/sb-admin-2.css" rel="stylesheet">
    <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="src/style/teste.css">
    <link rel="stylesheet" href="src/css/baguetteBox.min.css">
    <link rel="stylesheet" href="src/style/animate.css">
    <title>Escola de Condução</title>
    <style>
        .error {
            font-size: 10pt !important;
        }
    </style>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="6">


    <?php


  /*  if($status == 1) {
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
                <h3>Olá '.$nome.', seja Bem-vindo a JELÚ!</h3>
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
    }*/




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
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profile">
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
    </nav>

    <div class="container" style="height: 64px;">
    <button disabled="disabled"></button>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <!-- INDICADORES DO CAROUSEL -->
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>

        <div class="carousel-inner">

            <!--PRIMEIRO ITEM DO CAROUSEL-->
            <div class="carousel-item active">
                <img src="src/imgs/c1.jpg" class="d-bloc w-100 img-fluid" alt="">
                <div class="carousel-caption d-none d-md-block text-left">
                    <h3 class="animated wow fadeInDown" data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
                        ESCOLA DE CONDUÇÃO "JELÚ"
                    </h3>
                    <h4 class="animated wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
                        A segurança é a nossa prioridade!
                    </h4>
                    <a class="btn btn-outline-primary animated fadeInUp" href="#curso"
                        data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s; cursor: pointer;">
                        FAZ A TUA PRÉ-INSCRIÇÃO
                    </a>


                </div>
            </div>

            <!--SEGUNDO ITEM DO CAROUSEL-->
            <div class="carousel-item">
                <img src="src/imgs/c2.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-left">
                    <h3 class="animated wow fadeInDown" data-wow-delay=".4s"
                        style="visibility: visible;-webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
                        AQUI, A SEGURANÇA APRENDE-SE</h3>
                    <h4 class="animated wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible;-webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
                        Prioridade ao ensino de uma condução segura e consciente.</h4>
                    <a class="btn btn-outline-primary animated fadeInUp" href="#curso"
                        data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s; cursor: pointer;">
                        FAZ A TUA INSCRIÇÃO
                    </a>
                </div>
            </div>

            <!-- TERCEIRO ITEM DO CAROUSEL-->
            <div class="carousel-item">
                <img src="src/imgs/c3.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block text-left">
                    <h3 class="animated wow fadeInDown" data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
                        O CAMINHO PARA A CONDUÇÃO DO SUCCESO.</h3>
                    <h4 class="animated wow fadeInUp" data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s;">
                        Nós ensinamos técnicas de condução defensiva para todas as situações. Aqui os campeões conduzem
                        com segurança.</h4>
                    <a class="btn btn-outline-primary animated fadeInUp" href="#curso"
                        data-wow-delay=".4s"
                        style="visibility: visible; -webkit-animation-delay: .4s; -moz-animation-delay: .4s; animation-delay: .4s; cursor: pointer;">
                        FAZ A TUA INSCRIÇÃO
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


    <?php

        if(isset($_SESSION['inscricao']) &&($_SESSION['inscricao'] == 1)) {
            echo '<div id="alert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h3 class="text-center"> A inscrição foi efectuada com sucesso, verifique o seu e-mail.</h3>
                </div>';

                $_SESSION['inscricao'] = 0;
                
                
        } else if(isset($_SESSION['inscricao']) &&($_SESSION['inscricao'] == 2)) {

            echo '<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h3 class="text-center">A inscrição não foi efectuada com sucesso.</h3>
                </div>';

                $_SESSION['inscricao'] = 0;
        } else if(isset($_SESSION['inscricao']) &&($_SESSION['inscricao'] == 3)) {

            echo '<div id="alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h3 class="text-center">Falha na internet.</h3>
                </div>';

                $_SESSION['inscricao'] = 0;
        }


        ?>

   
    <div class="teste" id="escola"></div>
    <div class="container mt-5">
        <h3 class="text-left mytitle">
            ESCOLA DE CONDUÇÃO "JELÚ"
        </h3>

        <p class="text-justify">
        A escola nasceu em 2009 na rua da direita de Samba e foi chamada ‘Jelú’ em homenagem a esposa e a filha mais nova do seu fundador Antonino de Sousa Gonçalves que, tendo dificuldades em conseguir uma carta de condução, cedo se apercebeu da importância para os jovens de terem a carta de condução. Assim, decidiu ajudar outras pessoas na mesma situação. Estava assim criada a Escola de Condução Jelú– uma escola de condução pensada à medida das necessidades dos jovens, organizada por quem entende na 1ª pessoa as necessidades dos jovens sonhadores.
        </p>
        <hr>
        <p class="text-justify">
        Hoje em dia, a escola continua a crescer e a adaptar-se às evolução das necessidades dos clientes que serve, alargando o seu leque de serviços disponibilizado. Qualquer que seja a sua necessidade ao nível da aprendizagem da condução, formação especializada ou qualquer situação relacionada com o seu título de condução, a Escola de Condução ‘Jelú’ tem a solução.
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

                    $imgsNumber = 0;

                    foreach ($curso as $key => $value) {

                        $imgsNumber++;

                        
                        echo "<div class='col-md-4 col-sm-6 mb-3'>
                                <div class='box3'>
                                    <img src='src/imgs/$imgsNumber.jpg'>
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

                                            $condicao = "";
                                            $statusBtn = "";

                                            $anoNasc = substr($dados->getDtNasc(), 6,4);
                                            $anoActual = date('Y');
                                            $idade = (int)$anoActual - (int)$anoNasc;

                                            
                                                
                                                        foreach ($inscriCurso as $key => $valueInsc) {

                                                            if($value->getId() == $valueInsc->getIdCurso()) {
                                                                $condicao = "INSCRITO";
                                                                $statusBtn = "disabled";
                                                            } 
                                                    
                                                        }

                                                    if($value->getDescricao() == "Ligeiro Amador" && $idade < 21) {

                                                            echo "<button $statusBtn class='btn btn-outline-primary' data-toggle='modal' data-target='#inscrever".$value->getId()."'>";
                                                                echo $condicao == "" ? "INSCREVER-SER" : $condicao;
                                                            echo "</button>";

                                                        } else if($idade >= 21) {

                                                            echo "<button $statusBtn class='btn btn-outline-primary' data-toggle='modal' data-target='#inscrever".$value->getId()."'>";
                                                                echo $condicao == "" ? "INSCREVER-SER" : $condicao;
                                                            echo "</button>";
                                                        }

                                               

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
                        <div class=" p-2">

                            <p class="text-justify">
                                
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class=" p-2">

                            <h4 class="text-justify">
                               
                            </h4>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class=" p-2">


                            <p class="text-justify">
                                
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
            <h3 class="text-left mytitle" id="galeria">GALERIA</h3>
            <div class="row mt-30">

            </div>
        </div>

        <div class="container mt-40">
            <div class="container gallery-container">
                    <div class="tz-gallery">

                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div class="card">
                                    <a class="lightbox" href="src/imgs/g1.jpg">
                                        <img src="src/imgs/g1.jpg" alt="Park" class="card-img-top">
                                    </a>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="card">
                                    <a class="lightbox" href="src/imgs/g2.jpg">
                                        <img src="src/imgs/g2.jpg" alt="Park" class="card-img-top">
                                    </a>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="card">
                                    <a class="lightbox" href="src/imgs/g6.jpg">
                                        <img src="src/imgs/g6.jpg" alt="Park" class="card-img-top">
                                    </a>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row">
                        <div class="col-md-4">
                                <div class="card">
                                    <a class="lightbox" href="src/imgs/g5.jpg">
                                        <img src="src/imgs/g5.jpg" alt="Park" class="card-img-top">
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <a class="lightbox" href="src/imgs/g4.jpg">
                                        <img src="src/imgs/g4.jpg" alt="Park" class="card-img-top">
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card">
                                    <a class="lightbox" href="src/imgs/g9.jpg">
                                        <img src="src/imgs/g9.jpg" alt="Park" class="card-img-top">
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
        </div>
    </div>



    <footer class="page-footer font-small  py-3" style="background: #1C2331" id="contactos">
        <div class="container text-center text-md-left mt-5 text-light">
            <div class="row mt-3">
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold">Sobre a empresa</h6>
                    <hr class=" bg-white mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p> A escola nasceu em 2009 na rua da direita de Samba e foi chamada ‘Jelú’ em homenagem a esposa e a filha mais nova do seu fundador Antonino de Sousa Gonçalves que, tendo dificuldades em conseguir uma carta de condução...
                    </p>

                </div>
                <div class="col-md-4 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase font-weight-bold ">Mapa do site</h6>
                    <hr class="bg-white  mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <ul class="text-light list-unstyled">
                        <li><a href="#carouselExampleIndicators" class="text-white">Página inicial</a></li>
                        <li><a href="#escola" class="text-white">A escola</a></li>
                        <li><a href="#curso" class="text-white">Cursos</a></li>
                        <li><a href="#galeria" class="text-white">Galeria</a></li>
                        <li><a href="#contactos" class="text-white">Contactos</a></li>
                    </ul>
                </div>
                <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-md-0 mb-4">
                    <h6 class="text-uppercase font-weight-bold">Contactos</h6>
                    <hr class="bg-white  mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                    <p>
                        <i class="fas fa-home mr-3"></i> Rua da Samba-Luanda</p>
                    <p>
                        <i class="fas fa-envelope mr-3"></i> jelu@gmail.com</p>
                    <p>
                        <i class="fas fa-phone mr-3"></i> 925-726-859</p>
                </div>
            </div>
        </div>
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
                            <form class="user" method="POST" id="formLogin">
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
                                <a class="small" href="view/esqueceu-senha.php?tipo=candidato">Esqueceu a senha?</a>
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
                            <form class="user" method="POST" id="formCriar" name="formCriar">
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
                                            <input type="password" name="senha"
                                                class="form-control form-control-user" required="required" id="senha"
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
                                        <button  class="btn btn-primary btn-block" name="criarConta"
                                            style="border-radius: 30px" >
                                            CRIAR CONTA
                                        </button>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="" class="btn btn-outline-danger btn-block" style="border-radius: 30px"
                                            data-dismiss="modal">CANCELAR</a>
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





    <?php

    if($dados->getId() != null) {


        # MODAL PARA VER PERFIL


        echo '
                <div class="modal fade" id="profile" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content"
                        style="border-bottom: .25rem solid #0B508C!important; border-top: .25rem solid #0B508C!important;">
                        <div class="modal-body">
                            <div class="col-lg-12 sm-6">
                                <div class="p-3">
                                    <div class="text-center">
                                        <h5 class="text-center"><b>DADOS PESSOAL</b></h5>
                                    </div>
                                    <hr>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for=""><b>Nome:</b> '.$dados->getNome().'</label>
                                                        <hr>

                                                        <label for=""><b>BI:</b> '.$dados->getBi().'</label>
                                                        <hr>

                                                        <label for=""><b>Data de nascimento:</b> '.$dados->getDtNasc().'</label>
                                                        <hr>

                                                        <label for=""><b>Sexo:</b> '.$dados->getSexo().'</label>
                                                        <hr>

                                                        <label for=""><b>Nacionalidade:</b> '.$dados->getNacionalidade().'</label>
                                                        <hr>
                                                    </div>

                                                    <div class="col-sm-6">

                                                        <label for=""><b>Morada:</b> '.$dados->getMorada().'</label>
                                                        <hr>
                                                        <label for=""><b>Nome do pai:</b> '.$dados->getNomePai().'</label>
                                                        <hr>

                                                        <label for=""><b>Nome da mãe:</b> '.$dados->getNomeMae().'</label>
                                                        <hr>

                                                        <label for=""><b>Telefone:</b> '.$dados->getTelefone().'</label>
                                                        <hr>

                                                        <label for=""><b>E-mail:</b> '.$dados->getEmail().'</label>
                                                        <hr>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        
                                                        <button class="btn btn-primary btn-block"  data-dismiss="modal" data-toggle="modal" data-target="#editProfile">EDITAR PERFIL</button>
                                                    </div>
                                                </div>



                                            </div>


                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <h5 class="text-center"><b>CURSOS INSCRITO</b></h5>
                                    </div>
                                    <hr>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-sm-6">
                                            ';
                                                

                                               foreach ($inscriCurso as $key => $value) {
                                                   echo '<label for=""><b>Curso</b> '.$value->getCurso().'</label>
                                                   <hr>';
                                               }
                                            echo '    
                                            </div>


                                            <div class="col-sm-6">';
                                                
                                            foreach ($inscriCurso as $key => $value) {
                                                echo '<label for=""><b>Data de inscrição</b> '.$value->getDtCriacao().'</label>
                                                <hr>';
                                            }

                                               
                                            echo '</div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-right">
                                        <a class="btn btn-outline-danger" data-dismiss="modal" href="#">Fechar</a>
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ';




        # MODAL PARA EDITAR O PERFIL
            echo '
            <div class="modal fade" id="editProfile" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content"
                style="border-bottom: .25rem solid #0B508C!important; border-top: .25rem solid #0B508C!important;">
                <div class="modal-body">
                    <div class="col-lg-12 sm-6">
                        <div class="p-3">
                            <div class="text-left">
                                <h1 class="h4 text-gray-900 mb-4">EDITAR PERFIL</h1>
                                
                            </div>
                            <form class="user" method="POST" id="editCand">
                                <div class="row">
                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                style="border-radius: 30px" placeholder="Nome completo" name="nome"
                                                required="required" value="'.$dados->getNome().'">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                style="border-radius: 30px" placeholder="E-mail" name="email"
                                                required="required" value="'.$dados->getEmail().'">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                style="border-radius: 30px" placeholder="Nº do Bilhete de identidade"
                                                name="bi" required="required" value="'.$dados->getBi().'">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="date" class="form-control form-control-user"
                                                style="border-radius: 30px" placeholder="Nº do Bilhete de identidade"
                                                name="dtNasc" required="required" value="'.date('Y-m-d',strtotime($dados->getDtNasc())).'">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="nomePai" id=""
                                                class="form-control form-control-user" required="required"
                                                placeholder="Nome do pai"  value="'.$dados->getNomePai().'">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select style="border-radius: 30px; height: 50px;" class="custom-select"
                                                required name="sexo" required="required">
                                                ';

                                                $select = new CrudSexo();
                                                $select->select($dados->getIdSexo());

                                           
                                           echo ' </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <select style="border-radius: 30px; height: 50px;" class="custom-select"
                                                required name="nacionalidade" required="required">';

                                               
                                                    
                                                     $select = new CrudNacionalidade();
                                                     $select->options($dados->getIdNacionalidade());
                                            

                                           echo '</select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="nomeMae" id=""
                                                class="form-control form-control-user" required="required"
                                                placeholder="Nome da mãe" value="'.$dados->getNomeMae().'">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="tel" name="telefone" id=""
                                                class="form-control form-control-user" required="required"
                                                placeholder="Telefone" value="'.$dados->getTelefone().'">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="password" name="newsenha" id="newsenha"
                                                class="form-control form-control-user" required="required"
                                                placeholder="Senha">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="password" name="confirSenha" 
                                                class="form-control form-control-user" required="required"
                                                placeholder="Confirmar senha">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="text" name="morada" id="" placeholder="Morada"
                                                class="form-control form-control-user" value="'.$dados->getMorada().'">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <button class="btn btn-primary btn-block" name="editarConta"
                                            style="border-radius: 30px">
                                            EDITAR CONTA
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
                                <a class="small" href="view/esqueceu-senha.php?tipo=candidato">Esqueceu a senha?</a>
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
            ';


        # MODAL PARA FAZER O LGOUT
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


            # :::::::::::::: MODAL PARA VER OS REQUISISTOS DO CURSO ::::::::::::
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

            # :::::::::::: MODAL PARA VER O PLANO DE AULA DO CURSO ::::::::::::
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


             # :::::::: MODAL PARA SE INSCREVER  :::::::::::
             # AQUI CRIAMOS O MODAL PARA FAZER 
             # A INSCRIÇÃO NUM CERTO CURSO
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
                                        </div>

                                        <div class="col-sm-6">
                                        <a href="" class="btn btn-outline-danger btn-block" style="border-radius: 30px"
                                            data-dismiss="modal">CANCELAR</a>
                                    </div>
                                    </div>
                                    
                                </div>
                            </form>
                            <hr>
                            <div class="alert alert-warning">
                                <p><strong>Atenção:</strong> O pagamento tem um limite de até 6 dias para ser efectuado
                                    .</p>
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

    <script src="src/jquery/jquery.validate.min.js"></script>
    <script src="src/jquery/additional-methods.min.js"></script>
    <script src="src/jquery/localization/messages_pt_PT.js"></script>
    <script>

        

        $(document).ready(function() {

            baguetteBox.run('.tz-gallery');

          //  $("#alert").fadeOut('6000');
           aviso       = $(".aviso");
           avisoCriar  = $(".aviso-criar");
           avisoEditar = $(".aviso-editar");
           aviso.hide();
           avisoCriar.hide();
           avisoEditar.hide();

           
           /*
            :::::::: ADICIONANDO FUNÇÃO AO jQuery Validade ::::::::
             -> AQUI ADICIONAMOS UMA FUNÇÃO PARA 
             -> VALIDAR A IDADE DO CANDIDO,
             -> CASO ELE FOR MENOS DE IDADE 
             -> IDADE O SISTEMA NÃO ACEITA A SUA INSCRICAO
            */
        jQuery.validator.addMethod("verifyDt", function(value, element) {
            data = new Date();
            date =data.getFullYear();
            minhaData = value[0] + value[1] + value[2] + value[3];
            idade =  parseInt(date) - parseInt(value);
            if(idade >= 18) {
                return true;
            } else {
                return false;
            }
        }, "Precisa ser maior de idade");


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
                   nomePai: {
                         required: true,
                        maxlength: 100,
                        minlength: 2,
                        minWords: 2,
                        maxWords: 5
                   },
                   nomeMae: {
                        required: true,
                        maxlength: 100,
                        minlength: 2,
                        minWords: 2,
                        maxWords: 5
                   },
                   dtNasc: {
                       required: true,
                       verifyDt: true
                   },
                   morada: {
                       required: true,
                       minlength: 6
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
                        url:            'action.php',
                        type:           'post',
                        dataType:       'json',
                        cache:          false,
                        processData:    false,
                        contentType:    false,
                        data:           form,
                        timeout:        8000,
                        success:        function(resultado) {
                            /*
                            :::::: RESPOSTA(RESULTADO) ::::::::::
                            1 -> JÁ EXISTE NO NOSSO BANCO DE DADOS
                            2 -> CORREU TUDO BEM
                            3 -> OCORREU UM ERRO
                            */
                            if(resultado == 1) {
                                avisoCriar.fadeIn('slow').fadeOut(8000);
                                $("#text-aviso-criar").html("Este candidato já foi registado, Tente com outros dados.");
                            } else if(resultado == 2) {
                                window.location.reload();
                            } else if(resultado == 3) {
                                avisoCriar.fadeIn('slow').fadeOut(8000);
                                $("#text-aviso-criar").val("Ocorre um erro!, tente mais tarde.");
                            }
                        }
                    });
                }
            });


            /*
             :::::::: VALIDANDO O FORMÚLARIO PARA EDITAR O PERFIL DO CANDIDATO ::::::::::::::::::
            */
            $("#editCand").validate({
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
                   nomePai: {
                         required: true,
                        maxlength: 100,
                        minlength: 2,
                        minWords: 2,
                        maxWords: 5
                   },
                   nomeMae: {
                        required: true,
                        maxlength: 100,
                        minlength: 2,
                        minWords: 2,
                        maxWords: 5
                   },
                   dtNasc: {
                       required: true,
                       verifyDt: true
                   },
                   morada: {
                       required: true,
                       minlength: 6
                   },
                   newsenha: {
                       required: true,
                       minlength: 4,
                       maxlength: 10
                   },
                   confirSenha: {
                       required: true,
                       equalTo: "#newsenha"
                   }
                   
                },
                submitHandler: function(forms) {
                   
                    var form = new FormData($("#editCand")[0]);
                    
                    $.ajax({
                        url:            'action.php',
                        type:           'post',
                        dataType:       'json',
                        cache:          false,
                        processData:    false,
                        contentType:    false,
                        data:           form,
                        timeout:        8000,
                        success:        function(resultado) {
                           
                             if(resultado == 1) {
                                avisoEditar.fadeIn('slow').fadeOut(15000);
                                $("#text-aviso-editar").html("Este candidato já foi registado, Tente com outros dados.");
                            } else if(resultado == 2) {
                                window.location.reload();
                            } else if(resultado == 3) {
                                avisoEditar.fadeIn('slow').fadeOut(15000);
                                $("#text-aviso-editar").val("Ocorre um erro!, tente mais tarde.");
                            } 
                        }
                    });
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
                        url:            'action.php',
                        type:           'post',
                        dataType:       'json',
                        cache:          false,
                        processData:    false,
                        contentType:    false,
                        data:           form,
                        timeout:        8000,
                        success:        function(resultado) {
                            if(resultado == 1) {
                                
                                /* ACTUALIZAR A PÁGINA */
                                window.location.reload();
                                
                            } else if(resultado == 2) {
                                aviso.fadeIn('slow').fadeOut(15000);
                                $("#text-aviso").html("Não tens acesso, Crie uma conta.");
                            }
                        }    
                    });
                }
            });
           
        });
    </script>


    <script src="src/js/baguetteBox.min.js"></script>


</body>

</html>