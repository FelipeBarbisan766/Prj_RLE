<?php
include_once ("../../navbar2.php");
include_once ('../protectAdm.php');
$link_back = 'pageProf.php';
include_once('../../button_back.php');
?>
<div class="">
    
   
    <?php if(!isset($_GET['prof'])) { ?>

    <h1 class="mb-4 text-3xl text-center mt-2 font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Editar Professor</h1>

    <form class="max-w-sm mx-auto" action="formEditProf.php" method="GET">
        <div class="mb-5">
            <label for="prof" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Professor</label>
            <select id="prof" name="prof" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php
                $slq = mysqli_query($conexao, "SELECT * FROM professor");
                while ($prof = mysqli_fetch_array($slq)) {
                    if ($prof['prof_isActive'] == true) { ?>
                        <option value="<?php echo $prof['prof_cod']; ?>"><?php echo $prof['prof_nome']; ?></option>
                        <?php }
                }
                ; ?>
            </select>
        </div>
        <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Selecionar</button>
    </form>

    
    <?php }else{?>
        
        <form class="max-w-sm mx-auto" method="POST">
        <div class="mb-5 mt-2">
                <?php
                $cod = $_GET['prof'];
                $slq = mysqli_query($conexao, 'SELECT * FROM professor WHERE prof_cod=' . $cod . '');
                $prof = mysqli_fetch_array($slq);
                echo '<input type="hidden" name="cod" value="'.$cod.'">';
                ?>
                <label for="nome" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome do professor</label>
                <input value="<?php echo $prof['prof_nome']; ?>" type="text" id="nome" name="nome" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nome" required />
            </div>
            <div class="mb-5">
                <label for="user" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome de Usuário
                    professor</label>
                <input type="text" id="user" name="user"  value="<?php echo $prof['prof_user']; ?>" 
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Nome usado para entrar no site" required />
            </div>  
            <div class="mb-5">
                <label for="senha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha para professor</label>
                <input value="<?php echo $prof['prof_senha']; ?>" type="password" id="senha" name="senha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email professor</label>
                <input value="<?php echo $prof['prof_email']; ?>" type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>
            <div class="mb-5">
            <label for="senha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo</label>
            <select id="cargo" name="cargo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="prof">Professor</option>
                <option value="adm">Coordenador / Administrador</option>
            </select>
            
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
$email = strtolower($_POST['email']);
$user = strtolower($_POST['user']);
$cargo = strtolower($_POST['cargo']);
$senha = $_POST['senha'];

$old_user = mysqli_fetch_array(mysqli_query($conexao,"SELECT prof_user,prof_email FROM professor WHERE prof_cod='$cod' "));
$sql_verify = mysqli_query($conexao,"SELECT prof_user,prof_email FROM professor");//? confirmar se proibe apenas para contas ativas
$verify = false;
while ($prof = mysqli_fetch_array($sql_verify)){
    if($user == $prof['prof_user'] && $user != $old_user['prof_user'] || $email == $prof['prof_email'] && $email != $old_user['prof_email']){
        $verify = true;
    }
}
if($verify == false){
$sql = mysqli_query($conexao,"UPDATE professor SET prof_nome='$nome', prof_user='$user', prof_senha='$senha', prof_email='$email' ,prof_cargo='$cargo' WHERE prof_cod='$cod'");

if($sql){
    echo "<script> window.location.href='pageProf.php'</script>";
}else{
    echo "Erro no alter";
}
}else{
    echo'
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <div><span class="font-medium">O Nome de Usuario Ou Email </span> Já Estão em Uso, Porfavor Tente Outro Usuario ou Email.</div>
        </div>
        </div>
        ';
}
}
?>
</div>
</form>
</div>

</body>
</html>