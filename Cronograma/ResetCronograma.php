<?php
include_once('../conexao.php');
$isActive = false ;
$sql = mysqli_query($conexao,"UPDATE cronograma SET cro_isActive='$isActive'");

if($sql){
    echo "<script> window.location.href='cronograma2.php'</script>";
}else{
    echo "Erro no alter";
}
