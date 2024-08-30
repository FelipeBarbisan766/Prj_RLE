<?php
include_once ("../conexao.php");
include_once ("../navbar2.php");
include_once ("../protect.php");
date_default_timezone_set('America/Sao_Paulo');
?>
<div class="px-4 mx-auto max-w-screen-xl ">    
<a href="../index.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">         
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
    </svg>
    </a>
</div>
<div class=" py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
<div class="relative overflow-x-auto">
 
    <?php
        $cod = $_SESSION['cod'];
        $slq_reserva = mysqli_query($conexao, "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, l.lab_nome as lab, r.res_data as dat FROM reserva as r INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.prof_cod='$cod' ORDER BY r.res_data DESC");
        $quantidade = $slq_reserva->num_rows;
        if ($quantidade >= 1){
         echo '<table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th colspan=2 scope="col" class="px-6 py-3">
                            Minhas reservas
                        </th>
                    </tr>
            </thead>
            <tbody>';
            while ($reserva = mysqli_fetch_array($slq_reserva)) {
                if($reserva['dat']< (new DateTime)->format('Y-m-d')){

                }
               echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td scope="row" class="px-6 py-4 ">';
                    echo (new DateTime($reserva['dat']))->format('d/m/Y  ');
                '</td>
                <td class="px-6 py-4">';
                    echo $reserva['aula'].'ºAula - '.$reserva['descr'].' - '.$reserva['lab'];
                '</td>
                </tr>';
                }
        }else{
            echo '<h2 class="mb-4 text-3xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Você ainda não possui reservas</h2>';
        }
         ?>
       </tbody>
       </table>
</div>
</div>
</div>

</body>
</html>