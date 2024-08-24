<?php
include_once ("../conexao.php");
include_once ("../navbar2.php");
include_once ("../protect.php");
?>
<div class="container mx-auto px-3">
    <a href="pageProfessor.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
    </svg>
    </a>

    <?php
    if (isset($_GET['senha'])) {
        $cod = $_SESSION['cod'];
        $senha = $_GET['senha'];
        $sql_code = "SELECT * FROM professor WHERE prof_cod = '$cod' AND prof_senha ='$senha'";
        $sql_query = $conexao->query($sql_code) or die("falha na execução do codigo");

        $quantidade = $sql_query->num_rows;

        if ($quantidade == 1) {
            ?>
            <h1 class="mb-4 text-3xl text-center mt-2 font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Alteração de Senha do Professor</h1>
            <form class="max-w-sm mx-auto" action="altSenha.php" method="post">
                
                <label for="nova_senha" class="form-label">Nova senha:</label>
                <input type="text" name="nova_senha" id="nova_senha" class="form-control" required>
                <br>
                <label for="nova_senha2" class="form-label">Confirme a Nova senha:</label>
                <input type="text" name="nova_senha2" id="nova_senha2" class="form-control" required>
                <br>
                <input type="submit" value="Registrar" class="btn btn-primary">
                <a type="button" href="pageProfessor.php" class="btn btn-secondary">Cancelar</a>
            </form>
            <?php
        } else {
            echo '  <form action="" method="">
                        <label for="senha" class="form-label">Digite Sua Senha Atual Novamente:</label>
                        <input type="text" name="senha" id="senha" class="form-control" required><br>
                        <input type="submit" value="Registrar" class="btn btn-primary">
                        <a type="button" href="pageProfessor.php" class="btn btn-secondary">Cancelar</a>
                    </form><br>
                    <div class="alert alert-warning" role="alert">
                    <p>Senha incorreta! Verifique novamente</p>
                    </div>';
        }
    }elseif(isset($_POST['nova_senha'])){
        $cod = $_SESSION['cod'];
        $senha_nova = $_POST['nova_senha'];
        $senha_nova2 = $_POST['nova_senha2'];
        if($senha_nova == $senha_nova2){
            $sql = mysqli_query($conexao,"UPDATE professor SET prof_senha='$senha_nova' WHERE prof_cod='$cod'");
            if($sql){
                header('Location:pageProfessor.php');
            }else{
                echo "Erro no alter";
            }
        }else{
            echo '
            <h1>Alteração de Senha do Professor</h1>
            <form action="altSenha.php" method="post">
                
                <label for="nova_senha" class="form-label">Nova senha:</label>
                <input type="text" name="nova_senha" id="nova_senha" class="form-control" required>
                <br>
                <label for="nova_senha2" class="form-label">Confirme a Nova senha:</label>
                <input type="text" name="nova_senha2" id="nova_senha2" class="form-control" required>
                <br>
                <input type="submit" value="Registrar" class="btn btn-primary">
                <a type="button" href="pageProfessor.php" class="btn btn-secondary">Cancelar</a>
            </form>
            <br>
            <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">As senhas não coincidem</h4>
            <p>Alguma das senhas estão incorretas, tente novamente!</p></div>';
        }
    }
    else {
        ?>
        <h2 class="mb-4 text-3xl text-center mt-2 font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Antes de prosseguir, confirme sua identidade</h2>
        <form class="mt-3 max-w-sm mx-auto" action="" method="">
        <div class="mb-5">
            <label for="senha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Digite sua senha atual</label>
            <input type="password" id="senha" name="senha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        <div class="flex-row mb-5 sm:space-x-2">    
            <a type="button" href="pageProfessor.php" class="mb-2 text-white bg-danger-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>
            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirmar</button>
        </form>
    </div>
            <!-- <input type="submit" value="Registrar" class="btn btn-primary">
            <a type="button" href="pageProfessor.php" class="btn btn-secondary">Cancelar</a> -->
        <?php
    }
    ?>



</div>
