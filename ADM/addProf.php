<?php
include('../conexao.php');
include_once ('../protectCode.php');

$nome = strtoupper($_POST['nome']);
$senha = strtolower($_POST['senha']);
$cargo = strtolower($_POST['cargo']);
$isActive = true;

$sql = mysqli_query($conexao,"INSERT INTO professor(prof_nome,prof_senha,prof_cargo,prof_isActive) VALUES('$nome','$senha','$cargo','$isActive')");

if($sql){
    header('Location:pageControl.php');//decidir um lugar melhor para redirecionar!
}else{
    echo "Erro no Insert";
}
?>