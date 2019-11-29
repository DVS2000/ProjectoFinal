<?php	


include_once('index.php');

	$sms = "";
	if(isset($_GET['search'])) {
		$sms = '<h1>PESQUISADO POR: '.$_GET['search'].'</h1> </br>';
	}

	$html = '  

	<div class="mrl-auto">
	<img src="../../src/imgs/teste.jpg" style="width: 100px; height: 50px;" style="position:absolute; left: 50%; top: 50%; transform:translate(-50%, -50%);"/>
	</div>
	<div class="mr-auto">
	<h1 style="text-transform: uppercase; font-size: 30pt;">Relatório de todos Pagamentos</h1>
	'.$sms.'
	Data: '.date('d-m-Y').'
	</div>

	

<hr>
	
<link href="../../src/css/sb-admin-2.min.css" rel="stylesheet">

	<div class="table-responsive-md"><table class="table">
	<thead class="thead-light">
		<tr>
        <th scope="col">Candidato</th>
        <th scope="col">Curso</th>
        <th scope="col">Preço</th>
        <th scope="col">Forma de Pagamento</th>
        <th scope="col">Tempo</th>
        <th scope="col">Data de pagamento</th>
        <th scope="col">Data de edição</th>
		</tr>
	</thead>
	<tbody>';


	include_once('../../model/pagamento.php');
	include_once('../../controller/crud-pagamento.php');

     $select = new CrudPagamento();
     if(isset($_GET['search'])) {
		$search = $_GET['search'];
		if($search != null) {
			$dados = $select->search($search);
		} else {
			$dados = $select->selectFeitos();
		}
	} else {
		$dados = $select->selectFeitos();
	}
              foreach ($dados as $key => $value) {
              $html .= '<tr>
              <td>'.$value->getNomeCand().'</td>
              <td>'.$value->getCurso().'</td>
              <td>'.$value->getPreco().' Kzs</td>
              <td>'.$value->getFormPag().'</td>
              <td>'.$value->getTempo().'</td>
              <td>'.$value->getDtPagamento().'</td>
              <td>'.$value->getDtEdicao().'</td>
							
					  </tr>';
			}

		$html .= '  </tbody>
		</table>
		</div>';



	$relatorio = new Relatorio();
	$relatorio->exeRelatorio($html, "Relatório Todos Pagamentos");
?>