<?php
if(!isset($_SESSION)){
    session_start();
}
if($_SESSION['cargo']!='adm'){
    header('Location:\index.php');
}
?>