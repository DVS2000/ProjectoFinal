<?php

include_once('../model/utilizador.php');
include_once('../controller/crud-utilizador.php'); 

session_start();

if(isset($_SESSION['idUtlizador'])) {

    $id     = $_SESSION['idUtilizador'];
    $select = new CrudUtilizador();
    $user   = $select->getById($id);


} else if(isset($_COOKIE['idUtilizador'])) {

    $_SESSION['idUtilizador']   = $_COOKIE['idUtilizador'];
    $id                         = $_SESSION['idUtilizador'];
    $select                     = new CrudUtilizador();
    $user                       = $select->getById($id);

} else {
  header('Location: login.php');
}



?>





<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <title>Escola de Condução - ADMIN</title>
  <link href="../src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="../src/style/style.css">
  <link rel="stylesheet" href="../src/style/animate.css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="../src/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion " style="background: #0B508C" id="meuSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <img src="../src/imgs/logo-small.png" height="50" alt="Logo pequeno da escola de condução JELU">
        </div>
        <div class="sidebar-brand-text mx-3"><img src="../src/imgs/log.png" height="50px" alt="Logo da escola de condução JELU"></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInscricao">
          <i class="fas fa-address-card"></i>
          <span>Inscrição</span>
        </a>
        <div id="collapseInscricao" class="collapse" data-parent="#meuSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="inscricao/vertodos.php">Ver todas</a>
            <a class="collapse-item" href="inscricao/reciclagem.php">Desactivados</a>
          </div>
        </div>
      </li>



      <li class="nav-item">
        <a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseCandidato">
          <i class="fas fa-clipboard-list    "></i>
          <span>Candidato</span>
        </a>

        <div class="collapse" id="collapseCandidato" data-parent="#meuSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a href="candidato/vertodos.php" class="collapse-item">Ver todos</a>
            <a href="candidato/reciclagem.php" class="collapse-item">Desactivados</a>
          </div>
        </div>
      </li>

      <?php

        if($user->getIdTipoUtilizador() == 11) {
          echo '<li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilizador">
            <i class="fas fa-users fa-cog"></i>
            <span>Utilizador</span>
          </a>
          <div id="collapseUtilizador" class="collapse"  data-parent="#meuSidebar">
            <div class="bg-white py-2 collapse-inner rounded">         
              <a class="collapse-item" href="utilizador/">Novo</a>
              <a class="collapse-item" href="utilizador/vertodos.php">Ver Todos</a>
              <a class="collapse-item" href="utilizador/reciclagem.php">Desactivados</a>
            </div>
          </div>
        </li>

          <li class="nav-item">
          <a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseCurso">
            <i class="fa fa-book" aria-hidden="true"></i>
            <span>Curso</span>
          </a>
          <div id="collapseCurso" class="collapse"  data-parent="#meuSidebar">
            <div class="bg-white py-2 collapse-inner rounded">         
              <a class="collapse-item" href="curso/">Novo</a>
              <a class="collapse-item" href="curso/vertodos.php">Ver Todos</a>
              <a class="collapse-item" href="curso/reciclagem.php">Desactivados</a>
            </div>
          </div>
        </li>'
        ;

        }


      ?>


        <li class="nav-item">
          <a href="#" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseNacional">
            <i class="fa fa-book" aria-hidden="true"></i>
            <span>Pagamento</span>
          </a>
          <div id="collapseNacional" class="collapse"  data-parent="#meuSidebar">
            <div class="bg-white py-2 collapse-inner rounded">         
              <a class="collapse-item" href="pagamento/vertodos.php">Ver Confirmados</a>
              <a class="collapse-item" href="pagamento/reciclagem.php">Não confirmados</a>
            </div>
          </div>
        </li>


      <?php


        if($user->getIdTipoUtilizador() == 11) { 
      echo '
      <hr class="sidebar-divider">
        <div class="sidebar-heading">
        TABELAS
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#candidato" aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-clipboard-list    "></i>
              <span>Nacionalidade</span>
            </a>
            <div id="candidato" class="collapse" aria-labelledby="headingPages" data-parent="#meuSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="nacionalidade/">Nova</a>
                <a class="collapse-item" href="nacionalidade/vertodos.php">Ver Todas</a>
                <div class="collapse-divider"></div>
                <a class="collapse-item" href="nacionalidade/reciclagem.php">Desactivados</a>
              </div>
            </div>
          </li>';
        }

        ?>

      <hr class="sidebar-divider d-none d-md-block">

      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

  

          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <button class="btn btn-primary rounded-circle"><?php echo substr($user->getNome(), 0,1) ?></button>
                <span class="ml-2 d-none d-lg-inline text-gray-600 small"><?php echo $user->getNome() ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <button class="dropdown-item" onClick='<?php echo 'window.location.replace("http://localhost/projectofinal/view/utilizador/editar.php?id='.$user->getId().'")'; ?>'>
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Editar Perfil
                </button>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Terminar sessão
                </a>
              </div>
            </li>
          </ul>
        </nav>