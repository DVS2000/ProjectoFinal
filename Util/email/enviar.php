<?php 



require_once 'vendor/autoload.php';






class SendEmail {


   public function resentPassowrd($emailSend, $nome, $newPassword) {

      $email = "projectofinal.jelu2019@gmail.com";
      $password = "jelu2019";
      $smtp = "smtp.gmail.com";
      $msg = "Teste de Envio de Email no Php com Swift Mailer By Dorivaldo dos Santos";

      // Create the Transport
      $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername($email)
        ->setPassword($password);


      // Create the Mailer using your created Transport
      $mailer = new Swift_Mailer($transport);

      // Create a message
      $data = date('d/m/Y');
      $message = (new Swift_Message('NOVA SENHA'))
        ->setFrom([$email => 'UNIVERSIDADE OSCAR RIBAS'])
        ->setTo([$emailSend])
        ->setBody($msg)
        ->addPart('
                  <html>
   <head>
      <style>
         .banner-color {
         background-color: #f0ad4e;
         }
         .title-color {
         color: #0066cc;
         }
         .button-color {
         background-color: #0066cc;
         }
         @media screen and (min-width: 500px) {
         .banner-color {
         background-color: #0066cc;
         }
         .title-color {
         color: #eb681f;
         }
         .button-color {
         background-color: #eb681f;
         }
         }
      </style>
   </head>
   <body>
      <div style="background-color:#ececec;padding:0;margin:0 auto;font-weight:200;width:100%!important">
         <table align="center" border="0" cellspacing="0" cellpadding="0" style="table-layout:fixed;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
            <tbody>
               <tr>
                  <td align="center">
                     <center style="width:100%">
                        <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="margin:0 auto;max-width:512px;font-weight:200;width:inherit;font-family:Helvetica,Arial,sans-serif" width="512">
                           <tbody>
                              <tr>
                                 <td bgcolor="#F3F3F3" width="100%" style="background-color:#f3f3f3;padding:12px;border-bottom:1px solid #ececec">
                                    <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;width:100%!important;font-family:Helvetica,Arial,sans-serif;min-width:100%!important" width="100%">
                                       <tbody>
                                          <tr>
                                             <td align="left" valign="middle" width="50%"><span style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px"></span></td>
                                             <td valign="middle" width="50%" align="right" style="padding:0 0 0 10px"><span style="margin:0;color:#4c4c4c;white-space:normal;display:inline-block;text-decoration:none;font-size:12px;line-height:20px"></span></td>
                                             <td width="1">&nbsp;</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td align="left">
                                    <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                       <tbody>
                                          <tr>
                                             <td width="100%">
                                                <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                   <tbody>
                                                      <tr>
                                                         <td align="center" bgcolor="#8BC34A" style="padding:20px 48px;color:#ffffff" class="banner-color">
                                                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                               <tbody>
                                                                  <tr>
                                                                     <td align="center" width="100%">
                                                                        <h1 style="padding:0;margin:0;color:#ffffff;font-weight:500;font-size:20px;line-height:24px">NOVA SENHA</h1>
                                                                     </td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                         <td align="center" style="padding:20px 0 10px 0">
                                                            <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                               <tbody>
                                                                  <tr>
                                                                     <td align="center" width="100%" style="padding: 0 15px;text-align: justify;color: rgb(76, 76, 76);font-size: 12px;line-height: 18px;">
                                                                        <h3 style="font-weight: 600; padding: 0px; margin: 0px; font-size: 16px; line-height: 24px; text-align: center;" class="title-color">Olá '.$nome.',</h3>
                                                                        <p style="margin: 20px 0 30px 0;font-size: 15px;text-align: center;">A sua nova senha é <b>'.$newPassword.'</b></p>
                                                                     </td>
                                                                  </tr>
                                                               </tbody>
                                                            </table>
                                                         </td>
                                                      </tr>
                                                      <tr>
                                                      </tr>
                                                      <tr>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                              <tr>
                                 <td align="left">
                                    <table bgcolor="#FFFFFF" border="0" cellspacing="0" cellpadding="0" style="padding:0 24px;color:#999999;font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                       <tbody>
                                          <tr>
                                             <td align="center" width="100%">
                                                <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                   <tbody>
                                                      <tr>
                                                         <td align="center" valign="middle" width="100%" style="border-top:1px solid #d9d9d9;padding:12px 0px 20px 0px;text-align:center;color:#4c4c4c;font-weight:200;font-size:12px;line-height:18px">Atenciosamente,
                                                            <br><b>UNIVERSIDADE OSCAR RIBAS</b>
                                                         </td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td align="center" width="100%">
                                                <table border="0" cellspacing="0" cellpadding="0" style="font-weight:200;font-family:Helvetica,Arial,sans-serif" width="100%">
                                                   <tbody>
                                                      <tr>
                                                         <td align="center" style="padding:0 0 8px 0" width="100%"></td>
                                                      </tr>
                                                   </tbody>
                                                </table>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </center>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   </body>
</html>
 ', 'text/html');

      // Send the message
      $result = $mailer->send($message);

      return $result;

    }
   
    public function enviar($nome, $curso, $send) {
      $email = "projectofinal.jelu2019@gmail.com";
      $password = "jelu2019";
      $smtp = "smtp.gmail.com";
      $msg = "Teste de Envio de Email no Php com Swift Mailer By Dorivaldo dos Santos";

      $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername($email)
        ->setPassword($password);

      $mailer = new Swift_Mailer($transport);

      $data = date('d/m/Y');

      $numRecibo = rand(1,9) + rand(1,9) + rand(1,9);
      $message = (new Swift_Message('BEM-VINDO A ESCOLA JELU'))
        ->setFrom([$email => 'UNIVERIDADE OSCAR RIBAS'])
        ->setTo([$send])
        ->setBody($msg)
        ->addPart('
               <!DOCTYPE html>
         <html lang="en">
         <head>
            <meta charset="UTF-8">
            <title>Document</title>

            <style>
               body{
                     width: 1000px;
                     margin: auto;
                     font-family: sans-serif;
                     padding: 50px;
                     
               }

               header, .contractP{
                     text-align: center;
                     
               }

               .info{
                     font-size: 11px;
               }

               p{
                     text-indent: 50px;
                     line-height: 20px;
               }

               hr{
                     width: 200px;
                     margin: 30px 0 5px 0;
               }

               .assign{
                     display: flex;
                     margin-top: 20px;
                     justify-content: space-between;
               }



            </style>
         </head>
         <body>

            <header>
               <img  style="width: 100px; height: 50px;" src="https://scontent.flad1-1.fna.fbcdn.net/v/t1.15752-9/72316675_798029177317471_362662112146751488_n.png?_nc_cat=100&_nc_oc=AQlaYEZYbh_Mif750z6xQQaT1cVoxlTSzlHpl9ENUy1DZDUFrg0THpJzKSUa8-EbOuA&_nc_ht=scontent.flad1-1.fna&oh=a3014a7e6a082c021e864a16b2507ed5&oe=5E2E8B9A" alt="">
               <h3>UNIVERSIDADE OSCAR RIBAS</h3>
               <span>Rua da samba 364 R/C Luanda-Angola</span> <br>
               <span>222 001 597 / 915 937 036</span>
               <h3 style="text-decoration: underline">Luanda</h3>
            </header>

            <p style="text-align: right;"><b>INSCRIÇÃO Nº '.$numRecibo.'/'.date('Y').'</b></p>

            <h3 class="contractP"><b>Contrato de Matricula</b></h3>

            <p>Para obtençãn da carta de condução  do tipo <b>'.$curso.'</b> contratou com esta escola de condução <b>'.$nome.'</b> para o ensino prático, teórico e técnico.</p>
         
            <p>Este contrato dá direito a 30 dias práticos, 4 exames e 0 testes multimédia. O compromisso de habilitação cessa ao fim de 4 meses, a contar da data deste contrato.</p>

            <p><b>OBS:</b> Em caso de rescisão o contrato por parte do aluno, perde todo e qualquer valor que tenha efetuado no acto da matrícula.</p>

            <p><b>Este contrato não inclui as taxas de Licença e exames.</b></p>
            <p><b>Este contrato é intrasmissível.</b></p>

            <span style="margin: 20px 0 20px 0;">Luanda,'.date('d-M-Y').'.</span>
         </body>
         </html>
                  ', 'text/html');

      // Send the message
      $result = $mailer->send($message);

      return $result;

    }


    public function enviarPag($nome, $curso, $send, $preco, $formPag, $funcao, $nomeFunc, $idPag, $idInsc) {
      $email = "projectofinal.jelu2019@gmail.com";
      $password = "jelu2019";
      $smtp = "smtp.gmail.com";
      $msg = "Teste de Envio de Email no Php com Swift Mailer By Dorivaldo dos Santos";

      $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername($email)
        ->setPassword($password);

      $mailer = new Swift_Mailer($transport);

      $data = date('d/m/Y');

      $hora = (int)date('H') - 1;
      
      $message = (new Swift_Message('CONFIRMAÇÃO DO PAGAMENTO'))
        ->setFrom([$email => 'UNIVERSIDADE OSCAR RIBAS'])
        ->setTo([$send])
        ->setBody($msg)
        ->addPart('
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Document</title>
            <style>
                body{
                    width: 1000px;
                    margin: auto;
                    font-family: sans-serif;
                    padding: 50px;   
                }
        
                .header2{
                    font-size: 13px;
                    line-height:7px;
                }
        
                
                hr{
                    width: 100px;
                    margin: 30px 0 5px 0;
                }
        
                .assign{
                    display: flex;
                    margin-top: 20px;
                    justify-content: space-between;
                }
        
        
                .names{
                    text-align: center;
                }
        
            </style>
        </head>
        <body>
                <img  style="width: 100px; height: 50px;" src="https://scontent.flad1-1.fna.fbcdn.net/v/t1.15752-9/72316675_798029177317471_362662112146751488_n.png?_nc_cat=100&_nc_oc=AQlaYEZYbh_Mif750z6xQQaT1cVoxlTSzlHpl9ENUy1DZDUFrg0THpJzKSUa8-EbOuA&_nc_ht=scontent.flad1-1.fna&oh=a3014a7e6a082c021e864a16b2507ed5&oe=5E2E8B9A" alt="">
            <header style="display:flex; justify-content: space-between;">
                <div>
                    
                    <h4 style="font-family:"Times New Roman", Times, serif">UNIVERSIDADE OSCAR RIBAS</h4>
                    <h4>Recibo de pagamento Nº '.$idPag.'</h4>
                    <hr style="width: 200px; height: 2px; font-weight: bolder; background: black;">
                </div>
                <div class="width: 100px"></div>
                <div class="header2">
                    <p><b>ENDEREÇO:</b> Rua da Samba 364 R/C</p>
                    <p><b>E-MAIL:</b> jelu.lops@gmail.com</p>
                    <p><b>TEL:</b> 222 001 597 / 915 937 036</p>
                    <p><b>NIF:</b> 540308530</p>
                </div>
            </header>
           
        
            <p><b>Nº DE INSCRIÇÃO:</b> '.$idInsc.'/'.date('Y').'</p>
            <p><b>NOME DO ALUNO:</b> '.$nome.'</p>
            <p style="text-transform: uppercase;"><b>CATEGORIA:</b> '.$curso.'</p>
            <p style="text-transform: uppercase;"><b>SERVIÇO</b> MATRÍCULA '.$curso.'</p>
            <p style="text-transform: uppercase;"><b>CAIXA DE PAGAMENTO:</b> '.$formPag.'</p>
            <p><b>VALOR PAGO:</b> '.$preco.'.00 KZ</p>
            <div style="display:flex; justify-content: space-between; width:450px;">
                <p><b>DATA DE PAGAMENTOF:</b> '.date('d/m/Y').'</p>
                <p> /<b> HORA:</b> '.$hora.':'.date('i:s').'</p>
            </div>
            <p><b>SALDO DO ALUNO:</b>0.00 KZ</p>
            <div style="text-align: center; padding: 20px;">
               
                    <div class="assigner2">
                        <p></p>
                        <span>'.$funcao.'</span>
                        
                        <span><b>'.$nomeFunc.'</b></span>
                    </div>
                </div>
            </div>
        </body>
        </html>
                  ', 'text/html');

      // Send the message
      $result = $mailer->send($message);

      return $result;

    }
}


?>