<?php	

	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");


	$html = '  

	<div class="mrl-auto">
		<img src="logo.png" />
	</div>
	<div class="mr-auto">
	<h1 style="text-transform: uppercase; font-size: 30pt;">Relatório de todos Utilizadores</h1>
	Luanda aos '.date('d').' de '.date('M').' de '.date('Y').'
	</div>

	

<hr>
	
<link href="../dashboard/css/sb-admin-2.css" rel="stylesheet">
	<div class="table-responsive-md"><table class="table">
	<thead class="thead-light">
		<tr>
			<th>NOME</th>
			<th >TELEFONE</th>
			<th >E-MAIL</th>
			<th >SEXO</th>
			<th >TIPO DE UTILIZADOR</th>
			<th >DATA DE CRIAÇÃO</th>
			<th >DATA DE EDIÇÃO</th>
			
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
							<td>'.$value->getDtEdicao().'</td>
                      </tr>';
			}

		$html .= '  </tbody>
		</table>
		</div>';


	//Criando a Instancia
	$dompdf = new DOMPDF();


	$dompdf->setPaper('A4', 'landscape');


	$page = file_get_contents('recibo.html');

	// Carrega seu HTML
	$dompdf->load_html($page);


	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"Relatório Todos Utilizadors -".date("d-m-Y"), 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
?>