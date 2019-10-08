<?php	


include_once('index.php');

	
	$html = '  

	<div class="mrl-auto">
	<img src="../../src/imgs/teste.jpg" style="width: 100px; height: 50px;" style="position:absolute; left: 50%; top: 50%; transform:translate(-50%, -50%);"/>
	</div>
	<div class="mr-auto">
	<h1 style="text-transform: uppercase; font-size: 30pt;">Relatório de todos cursos</h1>
	Data: '.date('d-m-Y').'
	</div>

	

<hr>
	
<link href="../../src/css/sb-admin-2.min.css" rel="stylesheet">

	<div class="table-responsive-md"><table class="table">
	<thead class="thead-light">
		<tr>
        <th scope="col">Nome</th>
        <th scope="col">Preço</th>
        <th scope="col">Data de criação</th>
        <th scope="col">Data de edição</th>
		</tr>
	</thead>
	<tbody>';


	include_once('../../model/curso.php');
	include_once('../../controller/crud-curso.php');

     $select = new CrudCurso();
     $dados  = $select->select();
              foreach ($dados as $key => $value) {
              $html .= '<tr>
              <td>'.$value->getDescricao().'</td>
             <td>'.$value->getPreco().' Kzs</td>
             <td>'.$value->getDtCriacao().'</td>
             <td>'.$value->getDtEdicao().'</td>
							
					  </tr>';
			}

		$html .= '  </tbody>
		</table>
		</div>';



	$relatorio = new Relatorio();
	$relatorio->exeRelatorio($html, "Relatório Todos Cursos");
?>