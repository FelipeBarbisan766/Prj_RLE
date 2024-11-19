<?php
include_once('../../conexao.php');
include_once ('../../protectCode.php');
$cod = $_POST['cod'];
$isActive = false;

$sql = mysqli_query($conexao,"UPDATE laboratorio SET lab_isActive='$isActive' WHERE lab_cod='$cod'");

if($sql){
    header('Location:list_lab.php');
}else{
    echo "Erro no Insert";
}
?>