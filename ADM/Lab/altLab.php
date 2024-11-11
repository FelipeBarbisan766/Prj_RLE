<?php
include_once ("../../navbar2.php");
include_once ('../protectAdm.php');
$link_back = 'list_lab.php';
include_once('../../button_back.php');
?>
<div class="">
    <?php if(isset($_GET['cod'])) {?>
        
        <form class="max-w-sm mx-auto" action="" method="POST">
        <div class="mb-5 mt-2">
                <?php
                $cod = $_GET['cod'];
                $slq = mysqli_query($conexao, 'SELECT * FROM laboratorio WHERE lab_cod=' . $cod . '');
                $lab = mysqli_fetch_array($slq);
                echo '<input type="hidden" name="cod" value="'.$cod.'">';
                ?>
                <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do Local</label>
                <input value="<?php echo $lab['lab_nome']; ?>" type="text" id="nome" name="nome" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nome" required>
            </div>
            <div class="mb-5">
                <label for="desc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição do Local</label>
                <input value="<?php echo $lab['lab_desc']; ?>" type="text" id="desc" name="desc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            
            <div class="flex-row mb-5 sm:space-x-2">    
                    <button href="list_lab.php" class="mb-2 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</button>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirmar</button>
            </div>
        </div>
        </form>

    <?php } ?>    
</div>

<?php
if(isset($_POST['cod'])){
include('../../conexao.php');
$cod = $_POST["cod"];
$nome = strtoupper($_POST['nome']) ;
$desc = $_POST['desc'];

$sql = mysqli_query($conexao,"UPDATE laboratorio SET lab_nome='$nome', lab_desc='$desc' WHERE lab_cod='$cod'");

if($sql){
    echo "<script> window.location.href='list_lab.php'</script>";
}else{
    echo "Erro no alter";
}
}
?>


</body>
</html>