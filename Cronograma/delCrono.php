<?php 
include('../conexao.php');
// include_once ('../protectCode.php');

$cod = $_POST['cod'];
$isActive = false;
$sql = mysqli_query($conexao,"UPDATE `cronograma` SET `cro_isActive` = '$isActive' WHERE `cro_cod` = '$cod';");

if($sql){
    //  header('Location:lista.php');
}else{
    echo "Erro no Insert";
}