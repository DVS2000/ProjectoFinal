<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
if (isset($_POST['BTEnvia'])){
 
	//REMETENTE --> ESTE EMAIL TEM QUE SER VALIDO DO DOMINIO
 	//====================================================
	$email_remetente = "dorivaldodossantos2000@gmail.com"; // deve ser um email do dominio
	//====================================================
 
 
	//Configurações do email, ajustar conforme necessidade
	//====================================================
	$email_destinatario = "dorivaldo.santos@digitalfactory.co.ao"; // qualquer email pode receber os dados
	$email_reply = "dorivaldo.santos@digitalfactory.co.ao";
	$email_assunto = "Contato formmail";
	//====================================================
 
 
	//Variaveis de POST, Alterar somente se necessário
	//====================================================
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$telefone = $_POST['telefone'];
 	$mensagem = $_POST['mensagem'];
	//====================================================
 
	//Monta o Corpo da Mensagem
	//====================================================
	$email_conteudo = "Nome = $nome \n"; 
	$email_conteudo .= "Email = $email \n"; 
	$email_conteudo .=  "Telefone = $telefone \n";
	$email_conteudo .=  "Mensagem = $mensagem \n";
 	//====================================================
 
	//Seta os Headers (Alerar somente caso necessario)
	//====================================================
	$email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Subject: $email_assunto","Return-Path:  $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
	//====================================================
 
 
	//Enviando o email
	//====================================================
	if (mail ($email_destinatario, $email_assunto, nl2br($email_conteudo), $email_headers)){
		echo "</b>E-Mail enviado com sucesso!</b>"; 
	}
  	else{
		echo "</b>Falha no envio do E-Mail!</b>";
	}
	//====================================================
}	
?>
 
 
<form action="" method="POST">
    <p>
        Nome:<br />
        <input type="text" size="30" name="nome">
    </p>
 
    <p>
        E-mail:<br />
        <input type="text" size="30" name="email">
    </p>
 
  <p>
        Telefone:<br />
        <input type="text" size="20" name="telefone">
    </p>
 
<p>
        Mensagem:<br />
    <textarea name="mensagem" id="mensagem" cols="35" rows="5"></textarea>
</p>
 
    <p>
        <input type="submit" name="BTEnvia" value="Enviar">
        <input type="reset" name="BTApaga" value="Apagar">
  </p>
</form>
</body>
</html>