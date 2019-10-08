<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">

  <title>Recuperar Senha</title>

  <!-- Custom fonts for this template-->
  <link href="../src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../src/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block" style="background: url('../src/imgs/forget.jpg') no-repeat; background-size: cover;"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">ESQUECEU A SUA SENHA ?</h1>
                    <p class="mb-4">Nós entendemos, coisas acontecem. Basta digitar o seu endereço de email abaixo e lhe enviaremos uma nova senha!</p>
                  </div>
                  <form class="user mb-3" method="POST">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" aria-describedby="emailHelp" placeholder="Introduza seu e-mail...">
                    </div>
                    <button name="reset" class="btn btn-primary btn-user btn-block">
                      Recuperar Senha
                    </button>
                  </form>

                  <?php

                      if(isset($_POST['reset'])) {

                        include_once('../controller/crud-candidato.php');
                        include_once('../model/candidato.php');

                        include_once('../controller/crud-utilizador.php');
                        include_once('../model/utilizador.php');
                        # INCLUINDO O FICHEIRO DE LIMPEZA DAS VARIAVEIS
                        include_once('../Util/clear-var.php');

                        include_once('../Util/email/enviar.php');

                       

                        $clear = new Clear();
                        $email = new SendEmail();

                        $primeiro = rand(0,9);
                        $segundo  = rand(0,9);
                        $terceiro = rand(0,9);
                        $quarta   = rand(0,9);
                        $newPassword = $primeiro .''.$segundo.''.$terceiro.''.$quarta;

                        $myEmail = $clear->email('email');

                        if($_GET['tipo'] == 'candidato') {

                          $crudCandidato = new CrudCandidato();
                          $candidato = $crudCandidato->getByEmail($myEmail);

                          try {
                            if($email->resentPassowrd($myEmail, $candidato->getNome(), $newPassword)) {

                              if($crudCandidato->resetPassword($myEmail, $newPassword) == 1) {
                                
                                # ELIMINADO O COOKIE E SESSÃO DE QUALQUER UTILIZADOR LOGADO
                                setcookie('idCandidato', null, -1, '/projectofinal');
                                session_start();
                                session_unset();
                                session_destroy();
                                header('Location: ../');
                              } else {
                                echo $crudCandidato->resetPassword($myEmail, $newPassword);
                               }
                            } else {
                              echo "Falha na internet.";
                            }
                          } catch (\Throwable $th) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      <span class="sr-only">Close</span>
                                    </button>
                                    <h6 class="text-center">Falha na internet.</h6>
                                  </div>';
                          }


                        } else if($_GET['tipo'] == 'utilizador') {

                            $crudUtilizador = new CrudUtilizador();
                            $utilizador = $crudUtilizador->getByEmail($myEmail);

                            try {
                              if($email->resentPassowrd($myEmail, $utilizador->getNome(), $newPassword)) {

                                if($crudUtilizador->resetPassword($myEmail, $newPassword) == 1) {
                                  
                                  # ELIMINADO O COOKIE E SESSÃO DE QUALQUER UTILIZADOR LOGADO
                                  setcookie('idUtilizador', null, -1, '/projectofinal/view');
                                  session_start();
                                  session_unset();
                                  session_destroy();
                                  header('Location: login.php');
                                } else {
                                  echo $crudUtilizador->resetPassword($myEmail, $newPassword);
                                  }
                              } else {
                                echo "Falha na internet.";
                              }
                            } catch (\Throwable $th) {

                              
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                      <span class="sr-only">Close</span>
                                    </button>
                                    <h6 class="text-center">Falha na internet.</h6>
                                  </div>';
                            }
                        } else {
                          exit();
                        }
                      }

                  ?>
                  <hr>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../src/vendor/jquery/jquery.min.js"></script>
  <script src="../src/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../src/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../src/js/sb-admin-2.min.js"></script>
  <script src="../src/jquery/jquery.validate.min.js"></script>
  <script src="../src/jquery/additional-methods.min.js"></script>
  <script src="../src/jquery/localization/messages_pt_PT.js"></script>

</body>

</html>
