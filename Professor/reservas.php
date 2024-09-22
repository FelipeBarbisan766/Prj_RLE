<?php
include_once ("../conexao.php");
include_once ("../navbar2.php");
include_once ("../protect.php");
$link_back = 'pageProfessor.php';
include_once('../button_back.php');
date_default_timezone_set('America/Sao_Paulo');

?>
<div class="px-4 mx-auto max-w-screen-xl ">    

</div>
<div class=" py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
<div class="relative overflow-x-auto">
 
    <?php
        $cod = $_SESSION['cod'];
        $dia_atual = date("Y-m-d");
        $slq_res_prox = mysqli_query($conexao, "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, l.lab_nome as lab, r.res_data as dat FROM reserva as r INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.prof_cod='$cod'AND r.res_data > '".$dia_atual."' ORDER BY r.res_data DESC");
        $quantidade = $slq_res_prox->num_rows;
        if ($quantidade >= 1){
         echo '
         <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th colspan=2 scope="col" class="px-6 py-3">
                            Proximas Reservas
                        </th>
                    </tr>
            </thead>
            <tbody>';
            while ($reserva = mysqli_fetch_array($slq_res_prox)) {
               echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td scope="row" class="px-6 py-4 ">';
                    echo (new DateTime($reserva['dat']))->format('d/m/Y  ');
                '</td>
                <td class="px-6 py-4">';
                    echo $reserva['aula'].'ºAula - '.$reserva['descr'].' - '.$reserva['lab'];
                '</td>
                </tr>
                ';
                }
        }else{
            echo '<table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th colspan=2 scope="col" class="px-6 py-3">
                            Proximas Reservas
                        </th>
                    </tr>
            </thead>
            <tbody
               <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">
                    Você ainda não possui reservas Futuras
                </td>
                </tr>';
        }
        $slq_res_ant = mysqli_query($conexao, "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, l.lab_nome as lab, r.res_data as dat FROM reserva as r INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.prof_cod='$cod' AND r.res_data < '".$dia_atual."' ORDER BY r.res_data DESC");
        $quantidade = $slq_res_ant->num_rows;
        if ($quantidade >= 1){
         echo '
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th colspan=2 scope="col" class="px-6 py-3">
                            Reservas Antigas
                        </th>
                    </tr>
            </thead>
            <tbody>';
            while ($reserva = mysqli_fetch_array($slq_res_ant)) {
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
            echo '<table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th colspan=2 scope="col" class="px-6 py-3">
                            Proximas Reservas
                        </th>
                    </tr>
            </thead>
            <tbody
               <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="px-6 py-4">
                    Você não possui reservas antigas
                </td>
                </tr>';
        }
         ?>
       </tbody>
       </table>
</div>
</div>
</div>

</body>
</html>