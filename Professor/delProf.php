<?php
include('../conexao.php');
include_once ('../protectCode.php');
$cod = $_GET['cod'];
$isActive = false;

$sql = mysqli_query($conexao,"UPDATE professor SET prof_isActive='$isActive' WHERE prof_cod='$cod'");

if($sql){
    
    header('Location:../logoff.php');
}else{
    echo "Erro no Insert";
}
?>