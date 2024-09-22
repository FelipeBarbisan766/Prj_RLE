<?php
include_once ("../conexao.php");
include_once ("../navbar2.php");
?>
<div class="container mx-auto px-3">
    <a href="../" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
    </svg>
    </a>

    <?php
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        $sql_code = "SELECT * FROM professor WHERE reset_token_hash = '$token'";
        $sql_query = $conexao->query($sql_code) or die("falha na execução do codigo");
        $quantidade = $sql_query->num_rows;
        if ($quantidade == 1) {
            $sql = mysqli_fetch_array($sql_query);
            $cod = $sql['prof_cod'];
            ?>  
            <h1 class="mb-4 text-3xl text-center mt-2 font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Alteração de Senha</h1>
            <form class="mt-3 max-w-sm mx-auto" method="post">
                
                <label for="nova_senha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nova senha:</label>
                <input type="text" name="nova_senha" id="nova_senha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <br>
                <label for="nova_senha2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirme a Nova senha:</label>
                <input type="text" name="nova_senha2" id="nova_senha2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <br>
                <?php echo '<input type="hidden" name="cod" value="'.$cod.'">';?>
                <a type="button" href="forgot-password.php" class="mb-2 text-white bg-danger-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>
                <input type="submit" value="Registrar" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            </form>
            <?php
        } else {
            echo '
            <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <div><span class="font-medium">Link Invalido</span> O link fornecido pode ter falhado ou expirado tente novamente.</div>
            </div>
            </div>
            ';
        }
    }
    if(isset($_POST['nova_senha'])){
        $cod = $_POST['cod'];
        $senha_nova = $_POST['nova_senha'];
        $senha_nova2 = $_POST['nova_senha2'];
        if($senha_nova == $senha_nova2){
            $sql = mysqli_query($conexao,"UPDATE professor SET prof_senha='$senha_nova' WHERE prof_cod='$cod'");
            if($sql){
                echo "<script> window.location.href='forgot-password.php'</script>";
            }else{
                echo "Erro no alter";
            }
        }else{
            echo '
            <h1 class="mb-4 text-3xl text-center mt-2 font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Alteração de Senha do Professor</h1>
            <form class="mt-3 max-w-sm mx-auto"  method="post">
                
                <label for="nova_senha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nova senha:</label>
                <input type="text" name="nova_senha" id="nova_senha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <br>
                <label for="nova_senha2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirme a Nova senha:</label>
                <input type="text" name="nova_senha2" id="nova_senha2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <br>
                <input type="hidden" value="<?php echo $cod;?>" name="cod">
                <a type="button" href="forgot-password.php" class="mb-2 text-white bg-danger-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>
                <input type="submit" value="Registrar" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
            </form>
            <br>
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 max-w-sm mx-auto" role="alert">
                <span class="font-medium">As senhas não coincidem</span> Alguma das senhas estão incorretas, tente novamente!
            </div>';
        }
    }