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

// Precisa criar uma nova coluna no banco de dados para registrar que foi que criou esse registro
// tipo isso:
// $adm = $_SESSION['cod'];

$sql = mysqli_query($conexao,"INSERT INTO `cronograma` (`cro_desc`, `cro_aula`,`cro_sem`, `cro_isActive`, `lab_cod`,`prof_cod`) VALUES ('$descr', '$aula', '$sem', '$isActive', '$lab','$prof')");

if($sql){
    header('Location:../');
}else{
    echo "Erro no Insert";
}




?>