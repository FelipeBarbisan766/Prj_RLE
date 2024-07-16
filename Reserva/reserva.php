<?php
include('../conexao.php');
date_default_timezone_set('America/Sao_Paulo');
if (!isset($_SESSION)) {
    session_start();
}
$desc = strtoupper($_POST["desc"]);
$aula = $_POST["aula"];
$data = $_POST["data"];
$lab = $_POST["lab"];
$dataRes = date("Y-m-d H:i");
$isActive = True;
$prof = $_SESSION['cod'];
$sql = mysqli_query($conexao,"INSERT INTO reserva(res_desc,res_aula,res_data,res_dataRes,res_isActive,lab_cod,prof_cod) VALUES('$desc','$aula','$data','$dataRes','$isActive','$lab','$prof')");

if($sql){
    header('Location:../');
}else{
    echo "Erro no Insert";
}
?>