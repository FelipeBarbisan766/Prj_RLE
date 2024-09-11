<?php
require_once '../conexao.php';

$prof_nome = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$sql = "SHOW TABLES LIKE 'professor'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        
        $sql = "UPDATE professor SET reset_token_hash = ?, reset_token_expires_at = ? WHERE prof_nome = ?";

        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sss", $token_hash, $expiry, $prof_nome);

        if ($stmt->execute()) {
            echo "E-mail enviado com sucesso!";
        } else {
            echo "Erro ao enviar e-mail.";
        }
    } else {
        echo "A tabela professor não existe.";
    }

if($conexao->affected_rows){
    require __DIR__ . "/mailer.php";

    $mail->setFrom("fgatechtest@gmail.com");
    $mail->addAddress($prof_nome);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END
        Click <a href="http:/example.com/reset-password.php?token=">here</a>
        to reset your password.
    END;
    try{
        $mail->send();
    }
    catch (Exception $e){
        echo "A mensagem não foi enviada. Mailer error {$mail->ErrorInfo}";
    }
}

echo "A Mensagem foi enviada, verifique seu email";