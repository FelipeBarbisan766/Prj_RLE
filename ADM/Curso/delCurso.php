<?php
include_once('../../conexao.php');
include_once ('../../protectCode.php');
$cod = $_POST['cod'];
$isActive = false;

$sql = mysqli_query($conexao,"UPDATE curso SET cur_isActive='$isActive' WHERE cur_cod='$cod'");

if($sql){
    header('Location:list_cur.php');
}else{
    echo "Erro no Insert";
}
