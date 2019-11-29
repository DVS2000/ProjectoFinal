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
	<h1 style="text-transform: uppercase; font-size: 30pt;">Relatório de Todas Inscrição</h1>
	'.$sms.'
	
	Data: '.date('d-m-Y').'
	</div>

	

<hr>
	
<link href="../../src/css/sb-admin-2.min.css" rel="stylesheet">

	<div class="table-responsive-md"><table class="table">
	<thead class="thead-light">
		<tr>
			<th scope="col">Nome do candidato</th>
			<th scope="col">Curso</th>
			<th scope="col">Data de inscrição</th>
			<th scope="col">Data de edição</th>
		</tr>
	</thead>
	<tbody>';


	include_once('../../model/inscricao.php');
	include_once('../../controller/crud-inscricao.php');

     $select = new CrudInscricao();
		if(isset($_GET['search'])) {
			$search = $_GET['search'];
			if($search != null) {
				$dados = $select->search($search);
			} else {
				$dados = $select->select();
			}
		} else {
			$dados = $select->select();
		}
              foreach ($dados as $key => $value) {
              $html .= '<tr>
							<td>'.$value->getNomeCand().'</td>
							<td>'.$value->getCurso().'</td>
							<td>'.$value->getDtCriacao().'</td>
							<td>'.$value->getDtEdicao().'</td>
						</tr>';
			}

		$html .= '  </tbody>
		</table>
		</div>';



	$relatorio = new Relatorio();
	$relatorio->exeRelatorio($html, "Relatório de Todas Inscrição");
?>