<?php
include('../conexao.php');
$nome = strtoupper($_POST['nome']);
$senha = strtolower($_POST['senha']);
$isActive = true;

$sql = mysqli_query($conexao,"INSERT INTO professor(prof_nome,prof_senha,prof_isActive) VALUES('$nome','$senha','$isActive')");

if($sql){
    header('Location:pageControl.php');
}else{
    echo "Erro no Insert";
}
?>