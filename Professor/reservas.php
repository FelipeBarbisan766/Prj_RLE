<?php
include_once("../conexao.php");
include_once("../navbar2.php");
include_once("../protect.php");
$link_back = 'pageProfessor.php';
include_once('../button_back.php');
date_default_timezone_set('America/Sao_Paulo');
$total_reg = "10";
if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
}
if (!isset($pagina)) {
    $pc = "1";
} else {
    $pc = $pagina;
}
$inicio = $pc - 1;
$inicio = $inicio * $total_reg;
// variaveis de virificação
$unic_fut = false;
$unic = false;

?>
<div class="px-4 mx-auto max-w-screen-xl ">

</div>
<div class=" py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
            
                <?php
                $cod = $_SESSION['cod'];
                $sql = "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, l.lab_nome as lab, r.res_data as dat FROM reserva as r INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.prof_cod='$cod' ORDER BY r.res_data DESC";
                $limite = mysqli_query($conexao, "$sql LIMIT $inicio,$total_reg");
                $todos = mysqli_query($conexao, "$sql");
                $tr = mysqli_num_rows($todos); // verifica o número total de registros
                $tp = $tr / $total_reg; // verifica o número total de páginas
                $dia_atual = date("Y-m-d");
                while ($reserva = mysqli_fetch_array($limite)) {
                if ($dia_atual <= $reserva['dat'] && $unic_fut == false){
                    echo '<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th colspan=2 scope="col" class="px-6 py-3">
                                Proximas Reservas
                            </th>
                        </tr>
                    </thead>
                    <tbody>';
                    $unic_fut = true;
                }
                if ($dia_atual <= $reserva['dat']) {
                        echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td scope="row" class="px-6 py-4 ">';
                        echo (new DateTime($reserva['dat']))->format('d/m/Y  ');
                        '</td>
                <td class="px-6 py-4">';
                        echo $reserva['aula'] . 'ºAula - ' . $reserva['descr'] . ' - ' . $reserva['lab'];
                        '</td>
                </tr>
                ';
                }
                
                if ($dia_atual > $reserva['dat'] && $unic == false) {
                    echo '
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th colspan=2 scope="col" class="px-6 py-3">
                                    Reservas Antigas
                                </th>
                            </tr>
                    </thead>
                    <tbody>';
                    $unic = true;
                }
                if ($dia_atual > $reserva['dat']) {

                        echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td scope="row" class="px-6 py-4 ">';
                        echo (new DateTime($reserva['dat']))->format('d/m/Y  ');
                        '</td>
                <td class="px-6 py-4">';
                        echo $reserva['aula'] . 'ºAula - ' . $reserva['descr'] . ' - ' . $reserva['lab'];
                        '</td>
                </tr>';
                }
                }

                ?>
            </tbody>
        </table>
    </div><br>
    <div class="flex">
        <!-- Previous Button -->
        <?php
        $anterior = $pc - 1;
        $proximo = $pc + 1;
        ?>
        <?php if ($pc > 1) {
            echo '<a href="reservas.php?pagina=' . $anterior . '" class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
            echo '<svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">';
            echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>';
            echo '</svg>';
            echo 'Previous';
            echo '</a>';
        }
        if ($pc < $tp) {
            echo '<a href="reservas.php?pagina=' . $proximo . '" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
            echo 'Next';
            echo '<svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">';
            echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>';
            echo '</svg>';
            echo '</a>';
        } ?>
    </div>
</div>
</div>
</body>

</html>