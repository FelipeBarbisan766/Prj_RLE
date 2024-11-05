<?php
include_once ("../../navbar2.php");
include_once ('../protectAdm.php');
$link_back = 'pageCurso.php';
include_once('../../button_back.php');
?>
<div class="">
    
   
    <?php if(!isset($_GET['cur'])) { ?>

    <h1 class="mb-4 text-3xl text-center mt-2 font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Editar Curso</h1>

    <form class="max-w-sm mx-auto" action="" method="GET">
        <div class="mb-5">
            <label for="cur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Curso</label>
            <select id="cur" name="cur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php
                $slq = mysqli_query($conexao, "SELECT * FROM curso Order by cur_nome ASC");
                while ($cur = mysqli_fetch_array($slq)) {
                    if ($cur['cur_isActive'] == true) { ?>
                        <option value="<?php echo $cur['cur_cod']; ?>"><?php echo $cur['cur_nome']; ?></option>
                        <?php }
                }
                ; ?>
            </select>
        </div>
        <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Selecionar</button>
    </form>

    
    <?php }else{?>
        
        <form class="max-w-sm mx-auto" method="POST">
        <div class="mb-5 mt-2">
                <?php
                $cod = $_GET['cur'];
                $slq = mysqli_query($conexao, 'SELECT * FROM curso WHERE cur_cod=' . $cod . '');
                $cur = mysqli_fetch_array($slq);
                echo '<input type="hidden" name="cod" value="'.$cod.'">';
                ?>
                <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do Curso</label>
                <input value="<?php echo $cur['cur_nome']; ?>" type="text" id="nome" name="nome" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nome" required />
            </div>

            <div class="flex-row mb-5 sm:space-x-2">    
                    <button href="pageControl.php" class="mb-2 text-white bg-danger-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</button>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirmar</button>
            </div>
        

    <?php }

if(isset($_POST['nome']))  {  
include('../../conexao.php');
$cod = $_POST["cod"];
$nome = strtoupper($_POST['nome']);


$sql = mysqli_query($conexao,"UPDATE curso SET cur_nome='$nome' WHERE cur_cod='$cod'");

if($sql){
    echo "<script> window.location.href='PageCurso.php'</script>";
}else{
    echo "Erro no alter";
}
}
?>
</div>
</form>
</div>

</body>
</html>