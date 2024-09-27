<?php
include('../../conexao.php');
include_once ('../../protectCode.php');

$nome = strtoupper($_POST['nome']);
$senha = $_POST['senha'];
$cargo = strtolower($_POST['cargo']);
$email = strtolower($_POST['email']);
$isActive = true;

$sql = mysqli_query($conexao,"INSERT INTO professor(prof_nome,prof_senha,prof_email,prof_cargo,prof_isActive) VALUES('$nome','$senha','$email','$cargo','$isActive')");

if($sql){
    header('Location:pageProf.php');
}else{
    echo "Erro no Insert";
}
?>