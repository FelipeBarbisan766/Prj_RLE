<?php
include_once('../conexao.php');
if (isset($_POST['cod_search'])) {
    $cod_search = $_POST['cod_search'];
    $result = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod INNER JOIN curso as u ON c.cur_cod=u.cur_cod WHERE c.cro_cod = " . $cod_search . " "));

    echo '<dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
    <div class="flex flex-col pb-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Descrição</dt>
        <dd class="text-lg font-semibold">' . $result['cro_desc'] . '</dd>
    </div>
    <div class="flex flex-col py-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Laboratorio</dt>
        <dd class="text-lg font-semibold">' . $result['lab_nome'] . '</dd>
    </div>
    <div class="flex flex-col pt-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Curso</dt>
        <dd class="text-lg font-semibold">' . $result['cur_nome'] . '</dd>
    </div>
    <div class="flex flex-col pt-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Turma</dt>
        <dd class="text-lg font-semibold">' . $result['cro_turma'] . '</dd>
    </div>
</dl>
';
// if(isset($_SESSION['cod'])){
//     if($_SESSION['cargo'] == 'adm') {
        echo '
        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Desativar</button>
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
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="modalTitle">Deseja desativar ?</h3>
                
                <button onclick="deletarCrono()" id="deactivate-btn" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Desativar
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
            </div>
        </div>
    </div>
</div>'; ?>

        <script>
            
            function deletarCrono() {
                var croId = <?= $cod_search ?>;
                $.ajax({
                    type: 'POST',
                    url: 'delCrono.php',
                    data: { cod: croId },
                    success: function () {
                        $('[data-modal-hide="popup-modal"]').click();
                        console.log('deu certo');
                        console.log(croId);
                        window.location.href = 'cronograma2.php';
                    }
                });
            }
        </script>
        <?php
    
// }}
} else {
    echo 'erro';
}

?>