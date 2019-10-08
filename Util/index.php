<?php	

	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();

	// Carrega seu HTML
	$dompdf->load_html('
    <img src="img.jpeg" style="width: 400px; height: 200px;" style="position:absolute; left: 50%; top: 50%; transform:translate(-50%, -50%);"/>
  
        <div>
            
            <h3 >ESCOLA DE CONDUÇÃO JELÚ</h3>
            <h3>Recibo de pagamento Nº 115</h3>
            <hr style="width: 500px; height: 2px; font-weight: bolder; background: black;">
        </div>
        <div class="header2">
            <p><b>ENDEREÇO:</b> Rua da Samba 364 R/C Luanda - Angola</p>
            <p><b>E-MAIL:</b> jelu.lops@gmail.com</p>
            <p><b>TEL:</b> 222 001 597 / 915 937 036</p>
            <p><b>NIF:</b> 540308530</p>
        </div>
   
   

    <p><b>Nº DE INSCRIÇÃO:</b> 6319/2017</p>
    <p><b>NOME DO ALUNO:</b> DOLENTE HOLÉ PODI</p>
    <p><b>CATEGORIA:</b> LIGEIRO PROFISSIONAL</p>
    <p><b>SERVIÇO</b> MATRÍCULA LIGEIRO PROFISSIONAL</p>
    <p><b>CAIXA DE PAGAMENTO:</b> BAI MULTICAIXA</p>
    <p><b>VALOR PAGO:</b> 65.000.00 KZ</p>
    <div style="display:flex; justify-content: space-between; width:450px;">
        <p><b>DATA DE PAGAMENTOF:</b> 15/07/2017</p>
        <p><b>HORA:</b> 16:08:07</p>
    </div>
    <p><b>SALDO DO ALUNO:</b>0.00 KZ</p>
    <div style="text-align: center; padding: 20px;">
        <div class="assign">
            <div class="assigner1">
                    <span class="names">O (A) Operador </span>
                <hr >
                <span class="names">DOLENTES HILÉ PODI</span>
            </div>
            <div class="assigner2">
                <p></p>
                <span>SECRETÁRIA</span>
                <hr>
                <span >PAULÃO DE ALMEIDA</span>
            </div>
        </div>
    </div>
    <small>Documento processado por computador: 16:24:32, 18 de Janeiro de 2017</small>
			');

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"RelatorioSemana.pdf", 
		array(
			"Attachment" => true //Para realizar o download somente alterar para true
		)
	);
?>