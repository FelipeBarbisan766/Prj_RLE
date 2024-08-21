<?php
include('../conexao.php');
include_once ('../protectCode.php');
$cod = $_POST["cod"];
$isActive = false;

$sql = mysqli_query($conexao,"UPDATE professor SET prof_isActive='$isActive' WHERE prof_cod='$cod'");

if($sql){
    
}else{
    echo "Erro no Insert";
}
?>
