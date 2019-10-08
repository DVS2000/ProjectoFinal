<?php	


include_once('index.php');

	
	$html = '  

	<div class="mrl-auto">
	<img src="../../src/imgs/teste.jpg" style="width: 100px; height: 50px;" style="position:absolute; left: 50%; top: 50%; transform:translate(-50%, -50%);"/>
	</div>
	<div class="mr-auto">
	<h1 style="text-transform: uppercase; font-size: 30pt;">Relatório de todos Utilizadores</h1>
	Data: '.date('d-m-Y').'
	</div>

	

<hr>
	
<link href="../../src/css/sb-admin-2.min.css" rel="stylesheet">

	<div class="table-responsive-md"><table class="table">
	<thead class="thead-light">
		<tr>
			<th>NOME</th>
			<th >TELEFONE</th>
			<th >E-MAIL</th>
			<th >SEXO</th>
			<th >TIPO DE UTILIZADOR</th>
			<th >DATA DE CRIAÇÃO</th>
		</tr>
	</thead>
	<tbody>';


	include_once('../../model/utilizador.php');
	include_once('../../controller/crud-utilizador.php');

     $select = new CrudUtilizador();
     $dados  = $select->select();
              foreach ($dados as $key => $value) {
              $html .= '<tr>
							<td>'.$value->getNome().'</td>
							<td>'.$value->getTelefone().'</td>
							<td>'.$value->getEmail().'</td>
							<td>'.$value->getSexo().'</td>
							<td>'.$value->getTipoUtilizador().'</td>
							<td>'.$value->getDtCriacao().'</td>
							
					  </tr>';
			}

		$html .= '  </tbody>
		</table>
		</div>';



	$relatorio = new Relatorio();
	$relatorio->exeRelatorio($html, "Relatório Todos Utilizadors");
?>