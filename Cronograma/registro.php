<?php
include('../conexao.php');
date_default_timezone_set('America/Sao_Paulo');
if (!isset($_SESSION)) {
    session_start();
}
$descr = $_POST['desc'];
$aula = $_POST['aula'];
$sem = $_POST['sem'];
$isActive = true;
$lab = $_POST['lab'];
$prof = $_POST['prof'];
$adm = $_SESSION['admCod'];

$sql = mysqli_query($conexao,"INSERT INTO `cronograma` (`cro_desc`, `cro_aula`,`cro_sem`, `cro_isActive`, `adm_cod`, `lab_cod`,`prof_cod`) VALUES ('$descr', '$aula', '$sem', '$isActive', '$lab','$adm','$prof')");

if($sql){
    header('Location:../');
}else{
    echo "Erro no Insert";
}




?>