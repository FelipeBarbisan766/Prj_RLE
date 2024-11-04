<?php
include_once('../conexao.php');
$cod = $_POST['cod'];
$isActive = false;

$sql = mysqli_query($conexao,"UPDATE reserva SET res_isActive='$isActive' WHERE res_cod='$cod'");

if($sql){
    //  header('Location:lista.php');
}else{
    echo "Erro no Insert";
}