<?php
date_default_timezone_set('America/Sao_Paulo');
 
require_once('classes/PHPMailer-master/src/PHPMailer.php');
require_once('classes/PHPMailer-master/src/SMTP.php');
require_once('classes/PHPMailer-master/src/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
	$nome = $_POST['name'];
	$lastnome = $_POST['lastname'];
	$email = $_POST['email'];
	$sujeito = $_POST['subject'];
	$mensagem = $_POST['message'];
	$data = date('d/m/Y H:i:s');
 
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'gruponetree@gmail.com';
	$mail->Password = '.netree01.';
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
	$mail->Port = 587;
 
	$mail->setFrom('gruponetree@gmail.com');
	$mail->addAddress('gruponetree@gmail.com', 'NETREE');
	$mail->addReplyTo($email, $nome);
 
	$mail->isHTML(true);
	$mail->Subject = "Contato - ".$nome;
	$mail->Body = "Nome: {$nome}<br>
				   Último Nome: {$lastnome}<br>
				   Email: {$email}<br>
				   Sujeito: {$sujeito}<br>
				   Mensagem: {$mensagem}<br>
				   Data/hora: {$data}";
 
	if($mail->send()) {
		echo "Email enviado com sucesso!";
	} else {
        echo $mail->ErrorInfo;
        
	}

