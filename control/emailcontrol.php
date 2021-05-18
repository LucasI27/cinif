<?php

require_once '../vendor/autoload.php';
require_once 'constantes.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername(EMAIL)
  ->setPassword(EMAIL_SENHA)
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);



function verificar_email($userEmail, $token){
  
  global $mailer;
  $body = '
  <!DOCTYPE html>
  <html lang="en">
  <head>
      <title>verifique-se</title>
  </head>
  <body>
      <div>
          <p>Verifique sua conta clicando <a href="http://localhost/cinif/back/emailverif.php?token='. $token .'">aqui</a></p>
      </div>
  </body>
  </html>'
  ;


  // Create a message
  $message = (new Swift_Message('Opa, iae, Confirma seu email com o link abaixo S2'))
    ->setFrom(EMAIL)
    ->setTo($userEmail)
    ->setBody($body, 'text/html')
    ;

  // Send the message
  $result = $mailer->send($message);
}