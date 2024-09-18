<?php
//! PRECISA ADICIONAR O SELECT PARA TROCAR AS AULAS E PUXAR A cro_desc DO BANCO
include_once ("../navbar2.php");
include_once ('../ADM/protectAdm.php');
?>
<div class="">
    
    <div class="px-4 mx-auto max-w-screen-xl ">
        <a href="cronograma2.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">         
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
        </a>
    </div>
    <?php if(!isset($_GET['crono'])) { ?>

    <h1 class="mb-4 text-3xl text-center mt-2 font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Editar Aula</h1>

    <form class="max-w-sm mx-auto" action="" method="GET">
        <div class="mb-5">
            <label for="crono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Aula</label>
            <select id="crono" name="crono" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php
                $slq = mysqli_query($conexao, "SELECT * FROM cronograma");
                while ($crono = mysqli_fetch_array($slq)) {
                    if ($crono['cro_isActive'] == true) { ?>
                        <option value="<?php echo $crono['cro_cod']; ?>"><?php echo $crono['cro_desc']; ?></option>
                        <?php }
                }
                ; ?>
            </select>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selecionar</button>
    </form>
    
    <?php }else{?>
        
        <form class="max-w-sm mx-auto" action="" method="POST">
        <div class="mb-5 mt-2">
                <?php
                $cod = $_GET['crono'];
                $slq = mysqli_query($conexao, 'SELECT * FROM cronograma WHERE cro_cod=' . $cod . '');
                $crono = mysqli_fetch_array($slq);
                echo '<input type="hidden" name="cod" value="'.$cod.'">';
                ?>
                <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome da aula</label>
                <input value="<?php echo $crono['cro_desc']; ?>" type="text" id="cro_desc" name="cro_desc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nome" required />
            </div>
            <select name="aula" id="aula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1">1º Aula</option>
                    <option value="2">2º Aula</option>
                    <option value="3">3º Aula</option>
                    <option value="4">4º Aula</option>
                    <option value="5">5º Aula</option>
                    <option value="6">6º Aula</option>
                </select>
            <div class="flex-row mb-5 sm:space-x-2">    
                    <button href="cronograma2.php" class="mb-2 text-white bg-danger-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</button>
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
$desc = $_POST['cro_desc'];
$aula = $_POST['aula'];

$sql = mysqli_query($conexao,"UPDATE cronograma SET cro_desc='$desc', cro_aula='$aula' WHERE cro_cod='$cod'");

if($sql){
    echo "<script> window.location.href='cronograma2.php'</script>";
}else{
    echo "Erro no alter";
}
}
?>

</body>
</html>