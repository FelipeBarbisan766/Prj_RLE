    <?php
    include_once ('../navbar2.php');
    ?>


<div class="container mx-auto px-4">

<a href="pageControl.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
    </svg>    
</a>

<div class="relative overflow-x-auto sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Código
                </th>
                <th scope="col" class="px-6 py-3">
                    Nome
                </th>
                <th scope="col" class="px-6 py-3">
                    Cargo
                </th>
            </tr>
        </thead>
        <tbody>
                <?php
                $slq = mysqli_query($conexao, "SELECT * FROM professor");
                while ($prof = mysqli_fetch_array($slq)) {
                    if ($prof['prof_isActive'] == true) { ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4"><?php echo $prof['prof_cod']; ?></td>
                            <td class="px-6 py-4"><?php echo $prof['prof_nome']; ?></td>
                            <td class="px-6 py-4"><?php echo $prof['prof_cargo']; ?></td>
                        </tr>
                    <?php }
                }
                ; ?>
        </tbody>
    </table>
</div>

</div>

</body>
</html>