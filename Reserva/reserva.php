<?php
include('../conexao.php');
include('../protectCode.php');
date_default_timezone_set('America/Sao_Paulo');
if (!isset($_SESSION)) {
    session_start();
}
$desc = strtoupper($_POST["desc"]);
$aula = $_POST["aula"];
$curso = $_POST["curso"];
$turma = $_POST["turma"];
$data = $_POST["data"];
$lab = $_POST["lab"];
$dataRes = date("Y-m-d H:i");
$isActive = True;
$prof = $_SESSION['cod'];
$sql = mysqli_query($conexao,"INSERT INTO reserva(res_desc,res_aula,res_turma,res_data,res_dataRes,res_isActive,lab_cod,prof_cod,cur_cod) VALUES('$desc','$aula','$turma','$data','$dataRes','$isActive','$lab','$prof','$curso')");

if($sql){
    header('Location:../');
}else{
    echo "Erro no Insert";
}
?>