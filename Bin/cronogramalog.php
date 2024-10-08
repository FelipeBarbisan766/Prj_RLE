<title>Cronograma</title>

<?php
    include_once ("../conexao.php");
    include_once ("navbarlog.php");
?>

<!-- TABELA 2 -->

<div class="container mx-auto px-4">

    <a href="../index.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
    </svg>
    
    </a>
    <form action="" method="get">
    <div class="grid grid-cols-2">
        <div>

            <label for="lab" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Local</label>
            <select name="lab" id="lab" required class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php
            include_once ("../conexao.php");
            $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
            while ($labs = mysqli_fetch_array($slq)) {
                if ($labs['lab_isActive'] == true) { 
                    echo '<option value='.$labs['lab_cod'].'>'.$labs['lab_nome'].'</option>';
                }}; ?>
        </select>
    </div>
        <a href="form2.php" class="m-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Adicionar novo Cronograma</a>
    </div>
    </form>

<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3"></th>

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
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" >
                    1ª Aula
                </th>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" >
                    2ª Aula
                </th>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" >
                    3ª Aula
                </th>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" >
                    4ª Aula
                </th>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
            </tr>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" >
                    5ª Aula
                </th>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
            </tr>
            <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" >
                    6ª Aula
                </th>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
                <td class="px-6 py-4">
                    Livre
                </td>
            </tr>
        </tbody>
    </table>
</div>

</div>

<!-- Precisamos puxar todas as funções do PHP aqui -->