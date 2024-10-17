<?php
include('../conexao.php');
include_once ("../protectCode.php");
date_default_timezone_set('America/Sao_Paulo');
if (!isset($_SESSION)) {
    session_start();
}
$descr = strtoupper($_POST['desc']);
$aula = $_POST['aula'];
$sem = $_POST['sem'];
$isActive = true;
$lab = $_POST['lab'];
$curso = $_POST["curso"];
$turma = $_POST["turma"];
$prof = $_SESSION['cod'];//é o codigo do administrador que criou o registro

$sql = mysqli_query($conexao,"INSERT INTO `cronograma` (`cro_desc`, `cro_aula`,`cro_turma`,`cro_sem`, `cro_isActive`, `lab_cod`,`prof_cod`,`cur_cod`) VALUES ('$descr', '$aula','$turma', '$sem', '$isActive', '$lab','$prof','$curso')");

if($sql){
    header('Location:cronograma2.php');
}else{
    echo "Erro no Insert";
}
?>