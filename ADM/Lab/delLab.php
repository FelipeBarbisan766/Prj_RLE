
<?php
if(isset($_POST['cod'])){

$cod = $_POST['cod'];
$isActive = false;

$sql = mysqli_query($conexao,"UPDATE laboratorio SET lab_isActive='$isActive' WHERE lab_cod='$cod'");

if($sql){
    // echo "<script> window.location.href='pageLab.php'</script>";
}else{
    echo "Erro no Insert";
}}
?>