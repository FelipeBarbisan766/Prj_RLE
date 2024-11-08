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
    <?php
                $cod = $_SESSION['cod'];
                $sql = "SELECT r.res_cod as cod, r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, l.lab_nome as lab, r.res_data as dat FROM reserva as r INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.prof_cod='$cod' AND r.res_isActive IS true  ORDER BY r.res_data DESC";
                $limite = mysqli_query($conexao, "$sql LIMIT $inicio,$total_reg");
                $todos = mysqli_query($conexao, "$sql");
                $tr = mysqli_num_rows($todos); // verifica o número total de registros
                $tp = $tr / $total_reg; // verifica o número total de páginas
                $dia_atual = date("Y-m-d");
                if(mysqli_num_rows($limite)<=0){
                    echo '
                    <h2 class="text-4xl font-bold dark:text-white">Você Não Possui Reservas</h2>
                    ';
                }
                ?>
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                <?php
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
                       
                        echo $reserva['aula'] . 'ºAula - ' . $reserva['descr'] . ' - ' . $reserva['lab'];
                        echo '</td>
                        <td class="px-6 py-4">

                            
                            
                            <a href="formEditRes.php?cod='.$reserva['cod'].'">
                                <button class="text-white bg-yellow-400 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-400 dark:hover:bg-yellow-600 dark:focus:ring-yellow-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="23" viewBox="0 0 32 32">
                                        <path d="M 23.90625 3.96875 C 22.859375 3.96875 21.8125 4.375 21 5.1875 L 5.1875 21 L 5.125 21.3125 L 4.03125 26.8125 L 3.71875 28.28125 L 5.1875 27.96875 L 10.6875 26.875 L 11 26.8125 L 26.8125 11 C 28.4375 9.375 28.4375 6.8125 26.8125 5.1875 C 26 4.375 24.953125 3.96875 23.90625 3.96875 Z M 23.90625 5.875 C 24.410156 5.875 24.917969 6.105469 25.40625 6.59375 C 26.378906 7.566406 26.378906 8.621094 25.40625 9.59375 L 24.6875 10.28125 L 21.71875 7.3125 L 22.40625 6.59375 C 22.894531 6.105469 23.402344 5.875 23.90625 5.875 Z M 20.3125 8.71875 L 23.28125 11.6875 L 11.1875 23.78125 C 10.53125 22.5 9.5 21.46875 8.21875 20.8125 Z M 6.9375 22.4375 C 8.136719 22.921875 9.078125 23.863281 9.5625 25.0625 L 6.28125 25.71875 Z"></path>
                                    </svg>
                                </button>
                            </a>

                            <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-modal-cod="'.$reserva['cod'].'" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </td>      
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
                        echo $reserva['aula'] . 'ºAula - ' . $reserva['descr'] . ' - ' . $reserva['lab'].
                        '</td><td></td>
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
<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Fechar</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="modal-title">Deseja deletar ?</h3>
                
                <input type="hidden" name="cod" id="res_cod">
                
                <button id="delete-btn" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Deletar
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
            </div>
    
        </div>
    </div>
</div>

<script>
const buttons = document.querySelectorAll('[data-modal-toggle="popup-modal"]');

buttons.forEach(button => {

  button.addEventListener('click', () => {
    const cod = button.getAttribute('data-modal-cod');

    document.getElementById('res_cod').value = cod;
  });

});

$('#delete-btn').on('click', function() {

const cod = $('#res_cod').val();

$.ajax({
  type: 'POST',
  url: 'delRes.php',
  data: {cod: cod},

  success: function(data) {
    window.location.reload();
  } 

});

});

</script>
</body>

</html>