<?php	

	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");

	class Relatorio {

		public function exeRelatorio($html, $nameFile) {
			//Criando a Instancia
			$dompdf = new DOMPDF();


			$dompdf->setPaper('A4', 'landscape');

			// Carrega seu HTML
			$dompdf->load_html($html);


			//Renderizar o html
			$dompdf->render();

			//Exibibir a página
			$dompdf->stream(
				"$nameFile -".date("d-m-Y"), 
				array(
					"Attachment" => false //Para realizar o download somente alterar para true
				)
			);
		}
	}
?>