<?php
  include_once ("../../navbar2.php");
  include_once ('../protectAdm.php');
  ?>
    
<div class="px-4 mx-auto max-w-screen-xl ">
    <a href="../pageControl.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">         
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
    </svg>
    </a>
</div>
<div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Painel de Laboratorio</h1>
    <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">O quê deseja fazer?</p>
    <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <a href="addLab.php" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Adicionar Laboratorio
            </a>
            <a href="altLab.php" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Editar Laboratorio
            </a> 
            <a href="delLab.php" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">                    
                Desativar Laboratorio
            </a>  
            
    </div>

    </div>   
<div class="relative overflow-x-auto  container mx-auto px-3 xs:rounded-lg rounded-md ">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Código
                </th>
                <th scope="col" class="px-6 py-3">
                    Nome
                </th>
                <th scope="col" class="px-6 py-3">
                    Descrição
                </th>
               
            </tr>
        </thead>
        <tbody>
                <?php
                $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
                while ($lab = mysqli_fetch_array($slq)) {
                    if ($lab['lab_isActive'] == true) { ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4"><?php echo $lab['lab_cod']; ?></td>
                            <td class="px-6 py-4"><?php echo $lab['lab_nome']; ?></td>
                            <td class="px-6 py-4"><?php echo $lab['lab_desc']; ?></td>
                        </tr>
                    <?php }
                }
                ; ?>
        </tbody>
    </table>
</div>

</body>

</html>