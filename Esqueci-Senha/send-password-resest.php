<?php

include_once('../navbar2.php'); 
require_once '../conexao.php';

$prof_email = $_GET["email"];

$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$server_smtp = "smtp.hostinger.com";
$server_imap = "imap.hostinger.com";
$email_account = "contato@varejaopagleve.com.br";
$email_password = "Projeto_rle10";

$recipient = $prof_email;

use PHPMailer\PHPMailer\PHPMailer;
require "./phpmailer/autoload.php";

$sql = "SHOW TABLES LIKE 'professor'";
$result = $conexao->query($sql);
// $sqlinto = mysqli_query($conexao,"UPDATE professor SET reset_token_hash = '$token_hash', reset_token_expires_at = $expiry WHERE prof_email = '$prof_email'");//!Provisorio

if ($result->num_rows > 0) {

    $sql = "UPDATE professor SET reset_token_hash = ?, reset_token_expires_at = ? WHERE prof_email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sss", $token_hash, $expiry, $prof_email);

    if ($stmt->execute()) {

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
        $reset_link = "https://varejaopagleve.com.br/rle/Esqueci-Senha/redefinir_senha.php?token=$token_hash";
        $mail->msgHTML("<h1>Para redefinir sua senha, clique no link abaixo</h1>
                        <a href='$reset_link'>Clique aqui</a><br>");

        if ($mail->send()) {
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
                    
                    <a href="../index.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">         
                    Voltar
                    </a>
                  </div>';
        } 
		else{
            echo "Erro ao enviar e-mail.";
        }
    } 
	else{
        echo "Erro ao atualizar o token no banco de dados.";
    }
}
else{
    echo "A tabela professor não existe.";
}

?>
