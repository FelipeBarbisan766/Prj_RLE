<?php
if(!isset($_SESSION)){
    session_start();
}
session_destroy();
header('Location:\Prj_RLE/login.php')
?>