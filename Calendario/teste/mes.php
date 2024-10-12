<?php
include_once("../../conexao.php");
include_once("../../navbar2.php");
date_default_timezone_set('America/Sao_Paulo');
$translate = array(
    0 => "Dom",
    1 => "Seg",
    2 => "Ter",
    3 => "Qua",
    4 => "Qui",
    5 => "Sex",
    6 => "Sab",
);
?>
<div class="row g-0 text-center">
    <div class="col-6 col-md-4">
        <div class="relative overflow-x-auto sm:rounded-lg">
            <table id="table-semana" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Domingo</th>

                        <th scope="col" class="px-6 py-3">
                            Segunda
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Terça
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quarta
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quinta
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Sexta
                        </th>
                        <th scope="col" class="px-6 py-3">Sabado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    $data = new DateTime('first day of this month');

                    // echo var_dump($data);
                    $diaN = date("w", strtotime($data->format('Y-m-d')));

                    $data->modify('-' . $diaN . ' day');
                    $data->modify('-1 day');
                    // ! Não mecher pois nem eu sei como essa parte ta funcionando !!!
                    $dia = array();
                    for ($n = 1; $n <= 5; $n++) {
                        // if ($dia_sem >= $sem_mes)  {
                        echo '
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

        ';
                        for ($i = 1; $i <= 7; $i++) {
                            array_push($dia, $data->format('Y-m-d'));
                            $data->modify('+1 day');
                            // echo var_dump($dia);
                            echo '    
        <td class="px-6 py-4"  onclick="modal(' . $data->format('Y-m-d') . ')" >
        ' . $data->format('d') . '
        </td>';
                        }
                        '
        </tr>
        
        
        
        </div>';
                    }

                    ?>
                </tbody>
        </div>
        </table>
    </div>
</div>
</div>

<!-- Modal toggle -->
<!-- <button data-modal-target="default-modal" data-modal-toggle="default-modal"
    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
    type="button">
    Toggle modal
</button> -->

<!-- Main modal -->
<div id="modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">

                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4">
                <?php

                $slq_reserva = mysqli_query($conexao, "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, p.prof_nome as prof FROM reserva as r INNER JOIN professor as p on r.prof_cod=p.prof_cod INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.res_data = '2024-11-06' AND l.lab_cod = '1' AND r.res_isActive IS TRUE ORDER BY r.res_aula ASC");
                $slq_cronograma = mysqli_query($conexao, "SELECT c.cro_aula as aula,c.cro_desc as descr,c.cro_isActive as active, p.prof_nome as prof FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE c.cro_sem = '3' AND l.lab_cod = '1'  AND c.cro_isActive IS TRUE ORDER BY c.cro_aula ASC");
                while ($reserva = mysqli_fetch_array($slq_reserva)) {

                    switch ($reserva["aula"]) {
                        case "1":
                            $aula1 = ['desc' => $reserva['descr'], 'prof' => $reserva['prof']];
                            break;
                        case "2":
                            $aula2 = ['desc' => $reserva['descr'], 'prof' => $reserva['prof']];
                            break;
                        case "3":
                            $aula3 = ['desc' => $reserva['descr'], 'prof' => $reserva['prof']];
                            break;
                        case "4":
                            $aula4 = ['desc' => $reserva['descr'], 'prof' => $reserva['prof']];
                            break;
                        case "5":
                            $aula5 = ['desc' => $reserva['descr'], 'prof' => $reserva['prof']];
                            break;
                        case "6":
                            $aula6 = ['desc' => $reserva['descr'], 'prof' => $reserva['prof']];
                            break;
                        default:
                            break;
                    }
                }
                // temos que achar um jeito de diminuir esse switch case 
                while ($cronograma = mysqli_fetch_array($slq_cronograma)) {
                    switch ($cronograma["aula"]) {
                        case "1":
                            $aula1 = ['desc' => $cronograma['descr']];
                            break;
                        case "2":
                            $aula2 = ['desc' => $cronograma['descr']];
                            break;
                        case "3":
                            $aula3 = ['desc' => $cronograma['descr']];
                            break;
                        case "4":
                            $aula4 = ['desc' => $cronograma['descr']];
                            break;
                        case "5":
                            $aula5 = ['desc' => $cronograma['descr']];
                            break;
                        case "6":
                            $aula6 = ['desc' => $cronograma['descr']];
                            break;
                        default:
                            break;
                    }
                }



                ?>

                <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4">';
                        if (!isset($aula1['desc'])) {
                            echo "Livre ";
                        } else {
                            echo $aula1['desc'];
                            if (isset($aula1['prof'])) {
                                echo ' - ' . $aula1['prof'];
                            }
                        }
                        echo '</td></tr>';
                        echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4">';
                        if (!isset($aula2['desc'])) {
                            echo "Livre ";
                        } else {
                            echo $aula2['desc'];
                            if (isset($aula2['prof'])) {
                                echo ' - ' . $aula2['prof'];
                            }
                        }
                        echo '</td></tr>';
                        echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4">';
                        if (!isset($aula3['desc'])) {
                            echo "Livre ";
                        } else {
                            echo $aula3['desc'];
                            if (isset($aula3['prof'])) {
                                echo ' - ' . $aula3['prof'];
                            }
                        }
                        echo '</td></tr>';
                        echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4">';
                        if (!isset($aula4['desc'])) {
                            echo "Livre ";
                        } else {
                            echo $aula4['desc'];
                            if (isset($aula4['prof'])) {
                                echo ' - ' . $aula4['prof'];
                            }
                        }
                        echo '</td></tr>';
                        echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4">';
                        if (!isset($aula5['desc'])) {
                            echo "Livre ";
                        } else {
                            echo $aula5['desc'];
                            if (isset($aula5['prof'])) {
                                echo ' - ' . $aula5['prof'];
                            }
                        }
                        echo '</td></tr>';
                        echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4">';
                        if (!isset($aula6['desc'])) {
                            echo "Livre ";
                        } else {
                            echo $aula6['desc'];
                            if (isset($aula6['prof'])) {
                                echo ' - ' . $aula6['prof'];
                            }
                        }
                        echo '</td></tr>';

                        ?>
                    </tbody>
                </table>

            </div>

            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="modal" type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                    accept</button>
                <button data-modal-hide="modal" type="button"
                    class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
            </div>
        </div>
    </div>
</div>




<br>
<script src="../js/table2excel.js"></script>

<button id="excel-button"
    class="flex flex-row gap-1 place-content-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Excel
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
        <path fill-rule="evenodd"
            d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 18.375V5.625ZM21 9.375A.375.375 0 0 0 20.625 9h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5ZM10.875 18.75a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5ZM3.375 15h7.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375Zm0-3.75h7.5a.375.375 0 0 0 .375-.375v-1.5A.375.375 0 0 0 10.875 9h-7.5A.375.375 0 0 0 3 9.375v1.5c0 .207.168.375.375.375Z"
            clip-rule="evenodd" />
    </svg>
</button>

<script>
    // set the modal menu element
    const $target = document.getElementById('modal');

    // options with default values
    const options = {
        placement: 'bottom-right',
        backdrop: 'dynamic',
        backdropClasses:
            'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
        closable: true,
        onHide: () => {
            console.log('modal is hidden');
        },
        onShow: () => {
            console.log('modal is shown');
        },
        onToggle: () => {
            console.log('modal has been toggled');
        },
    };

    // instance options object
    const instanceOptions = {
    id: 'modal',
    override: true
    };
    function modal(data) {
        const modal = new Modal($target, options, instanceOptions);
        modal.show();
    }


    document.getElementById("excel-button").addEventListener('click', function () {
        var excel = new Table2Excel();
        excel.export(document.querySelectorAll("#table-semana"), "Tabela-Semana");
    });
    //? https://github.com/rusty1s/table2excel/tree/master
</script>
</div>