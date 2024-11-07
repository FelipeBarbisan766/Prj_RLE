<?php
include_once('../conexao.php');

// Verifica se a variável 'cod' foi definida no POST ou se já existe uma definição anterior.
if (isset($_POST['cod']) && !empty($_POST['cod'])) {
    $cod = mysqli_real_escape_string($conexao, $_POST['cod']);
} else {
    // Redireciona para uma página de erro ou exibe uma mensagem informativa.
    echo "Erro: Código não fornecido. Por favor, acesse a página corretamente.";
    exit;
}

// Executa a consulta SQL se o código foi definido corretamente
$slq = mysqli_query($conexao, "SELECT * FROM reserva WHERE res_cod='$cod'");
$res = mysqli_fetch_array($slq);

?>
<form class="max-w-sm mx-auto" method="POST">
        <div class="mb-5 mt-2">
                <?php
                $slq = mysqli_query($conexao, 'SELECT * FROM reserva WHERE res_cod=' . $cod . '');
                $res = mysqli_fetch_array($slq);
                echo '<input type="hidden" name="cod" value="'.$cod.'">';
                ?>
                <label for="desc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                <input value="<?php echo $res['res_desc']; ?>" type="text" id="desc" name="desc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Descrição" required />
            </div>
            <div class="mb-5">
                <label for="aula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Aula</label>
                <select name="aula" id="aula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                </select> 
            </div>  
            <div class="mb-5">
                <label for="turma" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Turma</label>
                <select name="turma" id="turma" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                </select> 
            </div>
            <div class="mb-5">
                <label for="periodo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Periodo</label>
                <select name="periodo" id="periodo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                </select> 
            </div>
            <div class="mb-5">
            <label for="curso" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Curso</label>
            <select id="curso" name="curso" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            
            </select>
        </div>
            <div class="mb-5">
                <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                <select name="data" id="data" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                </select> 
            </div>
            
            </div>
            <div class="flex-row mb-5 sm:space-x-2">    
                    <button href="pageControl.php" class="mb-2 text-white bg-danger-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</button>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirmar</button>
            </div>
        

    <?php  

// if(isset($_POST['desc']))  {  
// include('../../conexao.php');
// $cod = $_POST["cod"];
// $desc = strtoupper($_POST['desc']);
// $turma = strtolower($_POST['turma']);
// $aula = strtolower($_POST['aula']);
// $curso = strtolower($_POST['curso']);
// $data = $_POST['data'];

// $old_res = mysqli_fetch_array(mysqli_query($conexao,"SELECT prof_user,prof_email FROM reserva WHERE res_cod='$cod' "));
// $sql_verify = mysqli_query($conexao,"SELECT prof_user,prof_email FROM reserva");//? confirmar se proibe apenas para contas ativas
// $verify = false;
// while ($res = mysqli_fetch_array($sql_verify)){
//     if($user == $prof['prof_user'] && $user != $old_user['prof_user'] || $email == $prof['prof_email'] && $email != $old_user['prof_email']){
//         $verify = true;
//     }
// }
// if($verify == false){
// $sql = mysqli_query($conexao,"UPDATE reserva SET res_desc='$desc', res_aula='$aula', res_turma='$turma', res_aula='$aula' ,res_curso='$curso', res_data='$data' WHERE res_cod='$cod'");

// if($sql){
//     echo "<script> window.location.href='reservas.php'</script>";
// }else{
//     echo "Erro no alter";
// }
// }else{
//     echo'
//         <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
//         <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
//             <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
//         </svg>
//         <span class="sr-only">Info</span>
//         <div>
//             <div><span class="font-medium">Estes Horários</span> Já Estão em Uso, Porfavor Tente Outro Horário.</div></div>
//         </div>
//         </div>
//         ';
// }
// }
// ?>
</div>
</form>