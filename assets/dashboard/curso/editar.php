<?php

  if(isset($_GET['id'])) {

    include_once('../../php/model/curso.php');
    include_once('../../php/controller/crud-curso.php');

    # INCLUIDO O FICHEIRO QUE VAI FAZER A LIMPEZA DAS VARIAVEL
    include_once('../../php/Util/clear-var.php');
    $clean = new Clear();
    $clean->connect();

    $id = $clean->intGET('id');
    if($id != null) {

        $selectCurso = new CrudCurso();
        $curso  = $selectCurso->getById($id);
        if($curso->getId() == null) {
            header('Location: ../index.html');
        }

    } else {
        header('Location: ../index.html');
    }
    
    } else {
        header('Location: ../index.html');
    } 


?>

<!DOCTYPE html>
<html lang="pt">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $curso->getDescricao(); ?></title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/animate.css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.css" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion " style="background: #0B508C" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">



            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users fa-cog"></i>
                    <span>Utilizador</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="buttons.html">Novo utilizador</a>
                        <a class="collapse-item" href="cards.html">Ver todos utilizadores</a>
                        <a href="#" class="collapse-item">Online</a>
                        <a href="#" class="collapse-item">Eliminados</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-address-card"></i>
                    <span>Inscrição</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="utilities-color.html">Fazer inscrição</a>
                        <a class="collapse-item" href="utilities-border.html">Ver todas inscrições</a>
                        <a class="collapse-item" href="utilities-animation.html">Em espera</a>
                        <a class="collapse-item" href="utilities-other.html">Eliminados</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Outras OPÇÕES
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-dollar-sign"></i>
                    <span>Pagamento</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Dorivaldo dos Santos</span>
                                <img class="img-profile rounded-circle"
                                    src="https://scontent.flad1-1.fna.fbcdn.net/v/t1.0-9/37919657_2101164123470574_5433798344348532736_n.jpg?_nc_cat=107&_nc_eui2=AeEtNBFU1yGntd_Glvcy1ru9A9Sf4Jc7YGIBcMe-JXTiWiDVPzHeVhnQV6d4Y7vs1T2hejhFSQhe-CdU8IdhicnJr64_WJusQsWTqjwQ3nvSbA&_nc_oc=AQlaoE0YPUvCcEyZbmE0KGbbIDVPTq2rjDdMRkOrllBmkzkMq_-1MvfvHVGMMnZBD0Y&_nc_ht=scontent.flad1-1.fna&oh=e7465ccfe7ae6c10b68b3e5b9710b291&oe=5D9FDDAD">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Actividade de logs
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Terminar sessão
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="card o-hidden border-0 shadow-lg my-1">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-left">
                                            <h1 class="h4 text-gray-900 mb-2 font-weight-bold"
                                                style="text-transform: uppercase">Editar
                                                Curso</h1>
                                            <hr>
                                        </div>
                                        <form class="user" method="POST">
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="nome">Nome</label>
                                                    <input type="text" class="form-control " id="nome"
                                                        placeholder="Nome" required="required" name="nome" value="<?php echo $curso->getDescricao(); ?>" >
                                                </div>
                                                <div class="col-sm-3">
                                                    <label for="preco">Preço</label>
                                                    <input type="number" class="form-control" id="preco"
                                                        placeholder="Preço" required="required" name="preco" value="<?php echo $curso->getPreco(); ?>">
                                                </div>


                                                <div class="col-sm-3">
                                                <label>Estado</label>
                                                    <select class="custom-select" required="required" name="estado">
                                                        <?php

                                                        include_once('../../php/controller/crud-estado.php');
                                                        $select = new CrudEstado();
                                                        $select->select($curso->getIdEstado());

                                                        ?>
                                                    </select>
                                                </div>


                                            </div>
                                            <div class="form-group row">
                                               <div class="col-sm-12">
                                               <label>Requisitos</label>

                                                <div class="centered">
                                                <textarea name="requisitos" id="editor">
                                                      <?php echo $curso->getRequisitos(); ?> 
                                                 </textarea>
                                                </div>
                                               </div> 
                                            </div>

                                            <div class="form-group row">
                                               <div class="col-sm-12">
                                               <label>Plano de Aula</label>

                                                <div class="centered">
                                                <textarea name="planoAula" id="editor1">
                                                      <?php echo $curso->getPlanoAula(); ?> 
                                                 </textarea>
                                                </div>
                                               </div> 
                                            </div>


                                            <?php
                                          include_once('../../php/model/curso.php');
                                          include_once('../../php/controller/crud-curso.php');
                                          

                                          if(isset($_POST['guardar'])) {

                                            # ============LIMPANDO AS VARIÁVEIS============== #
                                            
                                            $nome         = $clean->specialChars('nome');
                                            $preco        = $clean->int('preco');
                                            $estado       = $clean->int('estado');
                                            $resquitos    = $clean->script($_POST['requisitos']);
                                            $planoAula    = $clean->script($_POST['planoAula']);

                                                $model = new Curso();
                                                $model->setId($id);
                                                $model->setDescricao($nome);
                                                $model->setPreco($preco);
                                                $model->setIdEstado($estado);
                                                $model->setRequisitos($resquitos);
                                                $model->setPlanoAula($planoAula);
                                                $model->setDtEdicao(date('Y-m-d H:s'));
                                                $insert = new CrudCurso();
                                                $insert->update($model);
                                                

                                          }
                                          ?>


                                            <button class="btn btn-primary ml-auto mt-2" name="guardar">
                                                EDITAR
                                            </button>


                                        </form>



                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Todos direitos reservados JELU 2019</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
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
                        <a class="btn btn-primary" href="login.html">Sim</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin-2.min.js"></script>
        <!-- Page level custom scripts -->
        <script src="../../ckeditor.js"></script>

        <script>
             ClassicEditor
            .create(document.querySelector('#editor'), {
                     toolbar: [ 
                                'heading',
                                '|',
                                'alignment',                                                 
                                'bold',
                                'italic',
                                'link',
                                'bulletedList',
                                'numberedList',
                                'blockQuote',
                                'undo',
                                'redo'
                        ]
                     })
                      .then(editor => {
                       window.editor = editor;
                     })
                      .catch(err => {
                        console.error(err.stack);
                      });


            ClassicEditor
            .create(document.querySelector('#editor1'), {
                     toolbar: [ 
                                'heading',
                                '|',
                                'alignment',                                                 
                                'bold',
                                'italic',
                                'link',
                                'bulletedList',
                                'numberedList',
                                'blockQuote',
                                'undo',
                                'redo'
                        ]
                     })
                      .then(editor => {
                       window.editor = editor;
                     })
                      .catch(err => {
                        console.error(err.stack);
                      });
             </script>
</body>

</html>