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
$per = $_POST["per"];
$dataRes = date("Y-m-d H:i:s");
$isActive = True;
$prof = $_POST['prof'];
$sql = mysqli_query($conexao,"INSERT INTO reserva(res_desc,res_aula,res_turma,res_periodo,res_data,res_dataRes,res_isActive,lab_cod,prof_cod,cur_cod) VALUES('$desc','$aula','$turma','$per','$data','$dataRes','$isActive','$lab','$prof','$curso')");

if($sql){
    header('Location:../Calendario/diaV3.php?data='.$data.'&lab='.$lab.'&per='.$per);
}else{
    echo "Erro no Insert";
}
?>