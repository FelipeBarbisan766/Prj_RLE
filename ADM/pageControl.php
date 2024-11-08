<?php
include_once ("../navbar2.php");
include_once ('protectAdm.php');
include_once('../button_back.php');
?>
    
<div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Painel de Administrador</h1>
    <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">O quê deseja fazer?</p>
    <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <a href="Prof/list_prof.php" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                Professor
            </a>
            <a href="Lab/list_lab.php" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                Laboratorio
            </a>
            <a href="../Cronograma/cronograma2.php" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                Cronograma
            </a>
            <a href="Curso/list_cur.php" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                Curso
            </a>
            <!-- <a href="list.php" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                teste
            </a> -->

    </div>
</div>
      
</body>

</html>