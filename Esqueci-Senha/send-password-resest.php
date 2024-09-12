<?php
require_once '../conexao.php';

$prof_nome = $_POST["email"];

////////////////////////
// PHPMailer example
// heiko@hostinger.com
////////////////////////

// Login credentials
$server_smtp = "smtp.hostinger.com";
$server_imap = "imap.hostinger.com";
$email_account = "contato@varejaopagleve.com.br";
$email_password = "Projeto_rle10";

// Recipient
$recipient = $prof_nome;

// Stop making changes below this line

use PHPMailer\PHPMailer\PHPMailer;
require "./phpmailer/autoload.php";
$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;

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
$mail->msgHTML("<h1>Para redefinir sua senha clique no link abaixo</h1><br>
                        <a href=''>Clique aqui</a><br>
                        <p>Caso você não tenha pedido para redefinir a senha, ignore esta mensagem</p>
");

if (!$mail->send()) {
	echo "error: ".$mail->ErrorInfo;
} else {
	echo "email enviado";
    echo "<script> window.location.href='../index.php'</script>";
    
	if(!empty($server_imap)) {
		// Add the message to the IMAP.Sent mailbox
		$mail_string = $mail->getSentMIMEMessage();
		$imap_stream = imap_open("{".$server_imap."}", $email_account, $email_password);
		imap_append($imap_stream, "{".$server_imap."}INBOX.Sent", $mail_string);

        
	}
}
