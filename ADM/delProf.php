<?php
include('../conexao.php');
$cod = $_POST["cod"];
$isActive = false;

$sql = mysqli_query($conexao,"UPDATE professor SET prof_isActive='$isActive' WHERE prof_cod='$cod'");

if($sql){
    header('Location:pageControl.php');
}else{
    echo "Erro no Insert";
}
?>