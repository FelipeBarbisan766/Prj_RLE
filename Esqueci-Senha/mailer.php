<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\DebugLogger; // Adicione essa linha

require  __DIR__ . "/../vendor/autoload.php";

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->Debugoutput = 'html'; // Adicione essa linha para habilitar a saída de depuração em HTML

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer :: ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "fgatechtest@gmail.com";
$mail->Password = "Abc_123!";

$mail->isHtml(true);

return $mail;