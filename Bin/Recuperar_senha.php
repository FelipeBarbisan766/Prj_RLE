<!-- 
Esse formulario pode ser usado para receber mensagem de Suporte (não dá para usar para recuperar senha!) 
<form action="https://formsubmit.co/your@email.com" method="POST">
     <input type="text" name="name" required>
     <input type="email" name="email" required>
     <button type="submit">Send</button>
</form> -->


<?php include_once('navbar2.php');

?>
<form action="rec_senha.php" method="post">
    <label for="">Email</label>
    <input type="email" name="email" id="">
</form>
<!-- <form action="" method="post">
    <label for="">Digite a Nova senha</label>
    <input type="password" name="" id="">
    <label for="">Digite novamente a senha</label>
    <input type="password" name="" id="">
    <input type="submit" value="">
</form> -->

<?php
// include_once('conexao.php');

// $email = $_POST['email'];

// $token = bin2hex(random_bytes(16));
// $token_hash = hash('sha256',$token);

// $expiry = date('Y-m-d H:i:s',time() + 60 * 30);

// $sql = mysqli_query($conexao,"UPDATE professor SET prof_token_hash='$token_hash' AND prof_token_expiry='$expiry' WHERE prof_email='$email'");

?>

<!-- Link para Continuar https://www.youtube.com/watch?v=R9bfts9ZFjs  -->
<!-- Essa ideia foi descontinuada desde 13/08/24  -->