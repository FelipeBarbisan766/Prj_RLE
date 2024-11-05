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
    <?php if(isset($_GET['crono'])) { ?>
        
        <form class="max-w-sm mx-auto" action="" method="POST">
        <div class="mb-5 mt-2">
                <?php
                $cod = $_GET['crono'];
                $slq = mysqli_query($conexao, 'SELECT * FROM cronograma WHERE cro_cod=' . $cod . '');
                $crono = mysqli_fetch_array($slq);
                echo '<input type="hidden" name="cod" value="'.$cod.'">';
                ?>
             <label for="desc" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Descrição</label>
                <input type="text" name="desc" id="desc" value="<?php echo $crono['cro_desc'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required><br>
                <label for="curso" class="flex px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Curso</label>
            <select name="curso" id="curso" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php
                
                $slq = mysqli_query($conexao, "SELECT * FROM curso");
                while ($cur = mysqli_fetch_array($slq)) {
                    ?>
                        <option value="<?php echo $cur['cur_cod'];if ($cur['cur_cod'] == $crono['cur_cod']) { echo 'selected'; } ?>"><?php echo $cur['cur_nome']; ?></option>
                    <?php
                }
                ; ?>            
            </select>
            <label for="Turma" class="flex px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Turma</label>
            <select name="turma" id="Turma" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="TURMA A E B" <?php if ($crono['cro_turma'] == 'TURMA A E B' ) { echo 'selected'; } ?>>Turma A e B</option>
                <option value="TURMA A">Turma A</option>
                <option value="TURMA B">Turma B</option>
            </select>
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