<?php
include_once('../conexao.php');
$lab = $_POST['lab'];
$data = date("Y-m-d", $_POST['data']);;
$sem = $_POST['sem'];
$per = $_POST['per'];
$aula = $_POST['aula'];
$cargo = $_POST['carg'];
$cod = $_POST['cod'];
$tranSem = ['Erro','Segunda','Terça','Quarta','Quinta','Sexta'];
$tranPer = ['Erro','Manhã','Tarde','Noite'];    


    $sql = mysqli_query($conexao,'SELECT * FROM laboratorio WHERE lab_cod = '.$lab.'');
    $result = mysqli_fetch_array($sql);
    echo '
    <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
    <div class="flex flex-col pb-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status</dt>
        <dd class="text-lg font-semibold">Livre</dd>
    </div>
    <div class="flex flex-col py-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Data</dt>
        <dd class="text-lg font-semibold">'; echo (new DateTime($data))->format('d/m/Y'); echo '</dd>
    </div>
    <div class="flex flex-col py-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Laboratorio</dt>
        <dd class="text-lg font-semibold">' . $result['lab_nome'] . '</dd>
    </div>
    <div class="flex flex-col pt-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Dia da Semana</dt>
        <dd class="text-lg font-semibold">' . $tranSem[$sem]. '</dd>
    </div>
    <div class="flex flex-col pt-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Periodo</dt>
        <dd class="text-lg font-semibold">' . $tranPer[$per] . '</dd>
    </div>
    </dl><br>
';
if(isset($cargo)&&$cargo>=1){
    echo'
    <a id="btnAdicionar" href="../Reserva/formReserva.php?data='.$data.'&lab='.$lab.'&sem='.$sem.'&per='.$per.'&aula='.$aula.'&prof='.$cod.'" class="focus:outline-none dark:text-gray-900 dark:bg-white dark:border dark:border-gray-300 dark:focus:outline-none dark:hover:bg-gray-100 dark:focus:ring-4 dark:focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-gray-800 text-white border-gray-600 hover:bg-gray-700 hover:border-gray-600 focus:ring-gray-700">
        Adicionar Cronograma
    </a>';
    
}
