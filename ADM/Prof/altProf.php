<?php
include('../../conexao.php');
$cod = $_POST["cod"];
$nome = strtoupper($_POST['nome']);
$email = strtolower($_POST['email']);
$user = strtolower($_POST['user']);
$cargo = strtolower($_POST['cargo']);
$senha = $_POST['senha'];

$sql = mysqli_query($conexao,"UPDATE professor SET prof_nome='$nome', prof_user='$user', prof_senha='$senha', prof_email='$email' ,prof_cargo='$cargo' WHERE prof_cod='$cod'");

if($sql){
    header('Location:pageProf.php');
}else{
    echo "Erro no alter";
}
?>
