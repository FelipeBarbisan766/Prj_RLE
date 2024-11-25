<?php
include_once ('../../navbar2.php');
include_once ('../protectAdm.php');
$link_back = 'list_prof.php';
include_once('../../button_back.php');
?>

<div class="container mx-auto px-4">

    <h1 class="mb-4 text-3xl text-center mt-2 font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Informações sobre o Coordenador/ADM </h1>
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
    <?php
    if (isset($_GET['cod'])) {
    $cod_search = $_GET['cod'];
    $result = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM professor as p  WHERE p.prof_cod = " . $cod_search . " "));

    echo '
    <dl class=" text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
    <div class="flex flex-col pb-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nome</dt>
        <dd class="text-lg font-semibold">' . $result['prof_nome'] . '</dd>
    </div><br>
    <div class="flex flex-col pt-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nome de Usuario</dt>
        <dd class="text-lg font-semibold">' . $result['prof_user'] . '</dd>
    </div><br>
    <div class="flex flex-col py-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">E-mail</dt>
        <dd class="text-lg font-semibold">' . $result['prof_email'] . '</dd>
    </div>

    </dl>
';}
?>
</div>
</body>
</html>