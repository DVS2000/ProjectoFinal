

<?php


include_once('../model/candidato.php');
include_once('../controller/crud-candidato.php');


include_once('../model/curso.php');
include_once('../controller/crud-curso.php');

include_once('../model/pagamento.php');
include_once('../controller/crud-pagamento.php');


$select       = new CrudCandidato();
$candidatos   = $select->select();


$select       = new CrudCurso();
$curso        = $select->select();

$select       = new CrudPagamento();
$pagamentos   = $select->selectFeitos();

# INCLUIDON O CABEÇALHO
include_once('includes/header.php');

?>

        <div class="container-fluid">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800" style="text-transform: uppercase;"><?php echo $user->getTipoUtilizador() ?></h1>
          </div>


          <div class="row animated wow fadeIn" style="visibility: visible; -webkit-animation-delay: .3s; -moz-animation-delay: .3s; animation-delay: .3s;">
            <div class="<?php  echo $user->getIdTipoUtilizador() != 11 ? 'col-xl-6 col-md-6 mb-4' : 'col-xl-4 col-md-6 mb-4'; ?>" data-wow-delay=".4s">
                <div class="card border-left-info shadow-sm h-100 py-2">
                  <a href="candidato/vertodos.php" style="text-decoration: none">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Candidatos </div>
                            <div class="row no-gutters align-items-center">
                              <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo count($candidatos); ?></div>
                              </div>
                            </div>
                          </div>
                          <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                          </div>
                        </div>
                      </div>
                  </a>
                </div>
              </div>
  
              <!-- Pending Requests Card Example -->
              <div class="<?php  echo $user->getIdTipoUtilizador() != 11 ? 'col-xl-6 col-md-6 mb-4' : 'col-xl-4 col-md-6 mb-4'; ?>">
                <a href="pagamento/vertodos.php" style="text-decoration: none">
                  <div class="card border-left-warning shadow-sm h-100 py-2">
                    <div class="card-body">
                      <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">PAGAMENTOS</div>
                          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count($pagamentos); ?></div>
                        </div>
                        <div class="col-auto">
                          <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
          

            <?php

                if($user->getIdTipoUtilizador() == 11){
                  echo '<div class="col-xl-4 col-md-6 mb-4">
                        <a href="curso/vertodos.php" style="text-decoration: none">
                          <div class="card border-left-success shadow-sm h-100 py-2">
                              <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                  <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Cursos</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">'.count($curso).'</div>
                                  </div>
                                  <div class="col-auto">
                                    <i class="fas fa-address-card fa-2x text-gray-300"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </a>
                      </div>';
                }

            ?>
          </div>


          <div class="row animated wow fadeIn" style="visibility: visible; -webkit-animation-delay: .6s; -moz-animation-delay: .6s; animation-delay: .6s;">

            <div class="col-xl-12 col-lg-7">
              <div class="card shadow-sm mb-4">
               
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary" style="text-transform: uppercase">Rendimento Anual dos Candidatos</h6>
                  
                </div>
               
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

        </div>
      </div>

   <?php
   # INCLUINDO O RODAPÉ
   include_once('includes/footer.php');
   ?>