<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
include('../../conexao.php');
include_once ('../../protectCode.php');
$cod = $_POST['cod'];
$isActive = false;

$sql = mysqli_query($conexao,"UPDATE professor SET prof_isActive='$isActive' WHERE prof_cod='$cod'");

if($sql){
    header('Location:list_prof.php');
    // echo "<script> window.location.href='cronograma2.php'</script>";
}else{
    echo "Erro no Insert";
}
?>
