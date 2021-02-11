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

# INCLUINDO O MODEL DO PAGAMENTO
include_once('model/pagamento.php');

# INCLUINDO O CONTROLLER DO PAGAMENTO
include_once('controller/crud-pagamento.php');


$status = 0;

$dados               = new Candidato();
$inscricao           = new CrudInscricao();
$pagamento           = new Pagamento();
$pagamentoController = new CrudPagamento();
$clear               = new Clear();

if (isset($_SESSION['idCandidato'])) {


  $idCandidato             = $_SESSION['idCandidato'];
  $getCand                 = new CrudCandidato();
  $dados                   = $getCand->getById($idCandidato);

  $nome                    = $dados->getNome();
  $inscriCurso             = $inscricao->getByCandidato($dados->getId());
  $pagamento               = $pagamentoController->getByIdInscricao($inscriCurso->getId());
  $letraInical             = $dados->getFoto() == null ? substr($dados->getNome(), 0, 1) : '';
} else if (isset($_COOKIE['idCandidato'])) {

  $idCandidato              = $_COOKIE['idCandidato'];
  $getCand                  = new CrudCandidato();
  $dados                    = $getCand->getById($idCandidato);
  $inscriCurso              = $inscricao->getByCandidato($dados->getId());
  $pagamento                = $pagamentoController->getByIdInscricao($inscriCurso->getId());
  $_SESSION['idCandidato']  = $_COOKIE['idCandidato'];
  $letraInical              = $dados->getFoto() == null ? substr($dados->getNome(), 0, 1) : '';
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Recibo</title>
  <link href="src/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <style>
    body {
      width: 1000px;
      margin: auto;
      font-family: 'Courier New', Courier, monospace;
      padding: 50px;
    }

    header,
    .contractP {
      text-align: center;
    }

    .info {
      font-size: 11px;
    }

    p {
      text-indent: 50px;
      line-height: 20px;
    }

    .assign {
      display: flex;
      margin-top: 20px;
      justify-content: space-between;
    }


    html {
      position: relative;
      min-height: 100%;
    }

    .btn-1 {
      font-family: Hack, monospace;
      background: #E57717;
      color: #fff;
      cursor: pointer;
      font-size: 2em;
      padding: 10px 20px;
      border: 0;
      transition: all 0.5s;
      border-radius: 10px;
      width: 100%;
      margin-top: 20px;
      position: relative;
    }

    .btn-1::after {
      content: '';
      font-family: "Font Awesome 5 Pro";
      font-weight: 400;
      position: absolute;
      left: 85%;
      top: 31%;
      right: 5%;
      bottom: 0;
      opacity: 0;
    }

    .btn-1:hover {
      background: #E88834;
      transition: all 0.5s;
      border-radius: 10px;
      box-shadow: 0px 6px 15px #00f 61;
      padding: 15px 25px;
    }

    .btn-1:hover::after {
      opacity: 1;
      transition: all 0.5s;
    }

    
  </style>
</head>

<body>
  <div id="container">
    <header>
      <img src="src/src/images/uor_logo.png" alt="" />
      <h3 style="color: #E88834;">UNIVERSIDADE OSCAR RIBAS</h3>
      <h3 class="contractP" style="text-transform: uppercase; color: #E88834;"><b>Recibo de Inscrição</b></h3>
      <hr>
      <span>Avenida Samora Machel <br>Município de Talatona</span>
      <br />
      <span>+244 922 17 15 21</span>
      <hr>
    </header>

    <p><b>NOME COMPLETO:</b> <?php echo $dados->getNome(); ?></p>
    <p><b>TELEFONE:</b> <?php echo $dados->getTelefone(); ?></p>
    <p><b>Nº DO BILHETE:</b> <?php echo $dados->getBi(); ?></p>
    <hr>

    <p><b>FACULDADE:</b> <?php echo $inscriCurso->getFaculdade(); ?></p>
    <p><b>CURSO:</b> <?php echo $inscriCurso->getCurso(); ?></p>
    <p><b>DATA:</b> <?php echo str_replace("-", "/", $inscriCurso->getDtCriacao()); ?></p>
    <hr>

    <p><b>ESTADO DO PAGAMENTO:</b> Confirmado</p>
    <p><b>DATA:</b> <?php echo str_replace("-", "/", $pagamento->getDtPagamento()); ?></p>
    <hr>


    <span style="margin: 20px 0 20px 0">Luanda aos <?php echo date('d/m/Y'); ?></script> </span>
  </div>

  <div>
    <button class="btn-1" onclick="gerarPdf()">IMPRIMIR O RECIBO EM PDF <i class="fas fa-sm fa-file-pdf mr-2 text-gray-400"></i></button>
  </div>
</body>

<script>
  function gerarPdf() {
    var minhaTabela = document.getElementById("container").innerHTML;
    var style = `<style>
            body {
                width: 1000px;
                margin: auto;
                font-family: 'Courier New', Courier, monospace;
                padding: 50px;
            }

            header,
            .contractP {
                text-align: center;
            }

            .info {
                font-size: 11px;
            }

            p {
                text-indent: 50px;
                line-height: 20px;
            }


            .assign {
                display: flex;
                margin-top: 20px;
                justify-content: space-between;
            }
        </style>`;
    // CRIA UM OBJETO WINDOW
    var win = window.open("", "", "height=700,width=700");
    win.document.write("<html><head>");
    win.document.write(style); // INCLUI UM ESTILO NA TAB HEAD
    win.document.write("</head>");
    win.document.write("<body>");
    win.document.write(minhaTabela); // O CONTEUDO DA TABELA DENTRO DA TAG BODY
    win.document.write("</body></html>");
    win.document.close(); // FECHA A JANELA
    win.print(); // IMPRIME O CONTEUDO
  }
</script>

</html>