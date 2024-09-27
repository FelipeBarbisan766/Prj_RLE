<?php
include_once ("../navbar2.php");
include_once ('../protect.php');
include('../conexao.php');
$link_back = 'pageProfessor.php';
include_once('../button_back.php');
?>
<div class="">
    <form class="max-w-sm mx-auto" method="POST">
    <div class="mb-5 mt-2">
            <?php
            $cod = $_SESSION['cod'];
            $slq = mysqli_query($conexao, 'SELECT * FROM professor WHERE prof_cod=' . $cod . '');
            $prof = mysqli_fetch_array($slq);
            echo '<input type="hidden" name="cod" value="'.$cod.'">';
            ?>
            <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
            <input value="<?php echo $prof['prof_nome']; ?>" type="text" id="nome" name="nome" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nome" required />
        </div>
        <div class="mb-5">
            <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome de Usuario</label>
            <input value="<?php echo $prof['prof_user']; ?>" type="text" id="user" name="user" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input value="<?php echo $prof['prof_email']; ?>" type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <div class="flex-row mb-5 sm:space-x-2">    
                <button href="pageProfessor.php" class="mb-2 text-white bg-danger-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</button>
                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirmar</button>
        </div>
    </div>
    </form>
</div>
</body>
</html>
<?php 
if(isset($_POST['cod'])){
$cod = $_POST["cod"];
$nome = strtoupper($_POST['nome']);
$email = strtolower($_POST['email']);
$user = strtolower($_POST['user']);
$sql = mysqli_query($conexao,"UPDATE professor SET prof_nome='$nome', prof_user='$user', prof_email='$email' WHERE prof_cod='$cod'");

if($sql){
    echo "<script> window.location.href='$link_back'</script>";
}else{
    echo "Erro no alter";
}

}
?>