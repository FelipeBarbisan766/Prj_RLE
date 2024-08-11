<?php
    include_once ("../conexao.php");
    include_once ("../navbarlog.php");
?>

<!-- TABELA 2 -->

<div class="container mx-auto">

    <a href="../indexlog.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
    </svg>
    
    </a>




    

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div >
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semana</label>
            <div class="relative max-w-sm">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                </svg>
            </div>
            <input id="datepicker-autohide" datepicker datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Data">
            </div>
        </div>
        <div >
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Local</label>
        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Lab 01</option>
            <option value="US">Lab 02</option>
            <option value="CA">Lab 03</option>
            <option value="FR">Salão Nobre</option>
            <option value="DE">Banheiro</option>
        </select>
        </div>
    </div>
    <form class="max-w-sm mx-auto mb-3 mt-2">
    
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

<script src="../path/to/flowbite/dist/flowbite.min.js"></script>