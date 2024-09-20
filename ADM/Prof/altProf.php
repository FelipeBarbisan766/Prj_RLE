<?php
include('../../conexao.php');
$cod = $_POST["cod"];
$nome = $_POST['nome'];
$email = $_POST['email'];
$cargo = $_POST['cargo'];
$senha = $_POST['senha'];

$sql = mysqli_query($conexao,"UPDATE professor SET prof_nome='$nome', prof_senha='$senha',prof_cargo='$cargo' WHERE prof_cod='$cod'");

if($sql){
    header('Location:pageProf.php');
}else{
    echo "Erro no alter";
}
?>
