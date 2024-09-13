<?php

include_once('../navbar2.php'); 
require_once '../conexao.php';

$prof_nome = $_POST["email"];

$server_smtp = "smtp.hostinger.com";
$server_imap = "imap.hostinger.com";
$email_account = "contato@varejaopagleve.com.br";
$email_password = "Projeto_rle10";


$recipient = $prof_nome;

use PHPMailer\PHPMailer\PHPMailer;
require "./phpmailer/autoload.php";
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;

$mail->Host = $server_smtp;
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls";
$mail->Username = $email_account;
$mail->Password = $email_password;

$mail->setFrom($email_account, "");
$mail->addReplyTo($email_account, "");
$mail->addAddress($recipient, "");
$mail->Subject = "Recuperar senha";
$mail->msgHTML("<h1>Para redefinir sua senha clique no link abaixo</h1>
                        <a href=''>Clique aqui</a><br>
                        <p>Caso você não tenha pedido para redefinir a senha, ignore esta mensagem</p>
");

$mail->send();
echo '<div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">

	<div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
	<svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
		<path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
	</svg>
	<span class="sr-only">Info</span>
	<div>
		<span class="font-medium">Sucesso!</span> Um email para redefinição de senha foi enviado!
	</div>
	</div>
      
    <a href="../login.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">         
    Voltar
    </a>
	</div>
      ';  

 }   
	if(!empty($server_imap)) {
		// Add the message to the IMAP.Sent mailbox
		$mail_string = $mail->getSentMIMEMessage();
		$imap_stream = imap_open("{".$server_imap."}", $email_account, $email_password);
		imap_append($imap_stream, "{".$server_imap."}INBOX.Sent", $mail_string);

        
	}

?>