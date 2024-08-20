<?php
include_once ("../conexao.php");
include_once ("../navbar2.php");
include_once ("../protect.php");
date_default_timezone_set('America/Sao_Paulo');
?>
<div class="px-4 mx-auto max-w-screen-xl ">    
    <a href="pageProfessor.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
    </svg>
    </a>
</div>
<div class=" py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
<div class="">
    <?php
        $cod = $_SESSION['cod'];
        $slq_reserva = mysqli_query($conexao, "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, l.lab_nome as lab, r.res_data as dat FROM reserva as r INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.prof_cod='$cod' ORDER BY r.res_aula ASC");
        $quantidade = $slq_reserva->num_rows;
        if ($quantidade >= 1){
            while ($reserva = mysqli_fetch_array($slq_reserva)) {
                if($reserva['dat']< (new DateTime)->format('Y-m-d')){
                    echo '<h2>Reservas Antigas</h2>';
                    echo '<hr>';
                }
                echo '<h3>'.(new DateTime($reserva['dat']))->format('d/m/Y').'</h3>';
                echo '<a class="block w-full px-4 py-2 border-b border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white"> '.$reserva['aula'].'ºAula - '.$reserva['descr'].' - '.$reserva['lab'].'</a>';
                echo '<br><hr>';
                }
        }else{
            echo '<h2 class="mb-4 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Você ainda não possui reservas</h2>';
        }
         ?>
    
</div>
</div>
</div>

<!-- Tá cheio de Erros, tentar achar uma solução para aparecer somente uma vez a frase 'reservas antigas', alem de consertar a ordem cronologica(colocar as datas mais recentes primeiro) -->