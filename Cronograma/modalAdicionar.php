<?php
include_once('../conexao.php');
$lab = $_POST['lab'];
$sem = $_POST['sem'];
$per = $_POST['per']; 
?>
<a id="btnAdicionar" href="form2.php?lab=<?php echo $lab;?>&sem=<?php echo $sem;?>&per=<?php echo $per;?>" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Adicionar Cronograma
</a>

    