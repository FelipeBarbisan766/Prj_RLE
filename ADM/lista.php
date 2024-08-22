    <?php
    include_once ('../navbar2.php');
    include_once ('protectAdm.php');
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
               <th scope="col" class="px-6 py-3"></th>
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
                            <td class="px-6 py-4"><button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-modal-codeProf="<?php echo $prof['prof_cod'];?>" data-modal-name="<?php echo $prof['prof_nome'];?>" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Deletar</button></td> 
                        </tr>
                    <?php }
                }
                ; ?>
        </tbody>
    </table>
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
                
                <input type="hidden" name="cod" id="prof_form">
                
                <button id="delete-btn" onclick="deleteProfessor()" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
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
    const cod = button.getAttribute('data-modal-codeProf');
    const name = button.getAttribute('data-modal-name');

    document.getElementById('prof_form').value = cod;
    document.getElementById('modal-title').textContent = `Deseja deletar ${name}?`;
  });

});

$('#delete-btn').on('click', function() {

const cod = $('#prof_form').val();

$.ajax({
  type: 'POST',
  url: 'delProf.php',
  data: {cod: cod},

  success: function(data) {
    window.location.reload();
  }

});

});

</script>

</body>
</html>