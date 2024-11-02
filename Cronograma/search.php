<?php
include_once('../conexao.php');
if (isset($_POST['cod_search'])) {
    $cod_search = $_POST['cod_search'];
    $result = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod INNER JOIN curso as u ON c.cur_cod=u.cur_cod WHERE c.cro_cod = " . $cod_search . " "));

    echo '
    <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
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
if(isset($_POST['cargo'])){
 if($_POST['cargo'] == 'adm') {
        echo '
        <button href="" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Desativar</button>
        ';
}}

} else {
    echo 'erro';
}

?>