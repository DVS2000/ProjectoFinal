
   <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Todos direitos reservados JELU 2019</span>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <a class="btn btn-primary" href="../Util/logoutAdmin.php">Sim</a>
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

  <!-- Page level plugins -->
  <script src="../src/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script>


  <?php
    include_once('../model/chart-candidato.php');
    include_once('../controller/relatorio-candidato.php');

    $meses = array();
    $relatorio = new RelatorioCandidato();
    $getResult = $relatorio->select();

    foreach ($getResult as $key => $value) {
       if($value->getMes() == 1) {
          $meses[] = "Janeiro";
       } else if($value->getMes() == 2) {
          $meses[] = "Fevereiro";
       } else if($value->getMes() == 3) {
          $meses[] = "Março";
       } else if($value->getMes() == 4) {
          $meses[] = "Abril";
       } else if($value->getMes() == 5) {
          $meses[] = "Maio";
       }  else if($value->getMes() == 6) {
          $meses[] = "Junho";
       } else if($value->getMes() == 7) {
          $meses[] = "Julho";
       } else if($value->getMes() == 8) {
          $meses[] = "Agosto";
       } else if($value->getMes() == 9) {
        $meses[] = "Setembro";
       }  else if($value->getMes() == 10) {
          $meses[] = "Outubro";
       } else if($value->getMes() == 11) {
          $meses[] = "Novembro";
       } else if($value->getMes() == 12) {
          $meses[] = "Dezembro";
       }

    } 

    



  ?>
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [<?php  
     foreach ($meses as $key => $value) {
        echo '"'.$value.'",';
     }
    ?> ],
    datasets: [{
      label: "Alunos",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php  
     foreach ($getResult as $key => $value) {
        echo $value->getNumCand().",";
     }
    ?>],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 50,
        right: 50,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          maxTicksLimit: 12
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [20],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 80,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 1,
      
    }
  }
});





  
  </script>
 

</body>

</html>
