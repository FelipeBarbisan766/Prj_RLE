<?php
include_once ("../navbar2.php");
include_once ('protectAdm.php');
?>
<?php if(!isset($_GET['prof'])) { ?>
<div class="container mx-auto px-4">

    <div class="px-4 mx-auto max-w-screen-xl ">
        <a href="pageControl.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">         
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">    
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
        </svg>
    </a>
    </div>

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
        
        <form class="max-w-sm mx-auto" action="altProf.php" method="POST">
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
                <label for="senha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha para professor</label>
                <input value="<?php echo $prof['prof_senha']; ?>" type="password" id="senha" name="senha" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
            </div>
            <div class="mb-5">
            <label for="senha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo</label>
            <select id="cargo" name="cargo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="prof">Professor</option>
                <option value="adm">Coordenador / Administrador</option>
            </select>
            
            </div>
            <div class="flex-row mb-5 sm:space-x-2">    
                    <a href="pageControl.php" class="mb-2 text-white bg-danger-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</a>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirmar</button>
            </div>
        </div>
        </form>

    <?php } ?>    
</div>

</body>
</html>