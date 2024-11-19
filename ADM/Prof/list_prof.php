<?php
include_once ('../../navbar2.php');
include_once ('../protectAdm.php');
$link_back = '../pageControl.php';
include_once('../../button_back.php');
$total_reg = "5";
if(isset($_GET['pagina'])){
$pagina=$_GET['pagina'];
}
    if (!isset($pagina)) {
        $pc = "1";
    } else {
        $pc = $pagina;
}
$inicio = $pc - 1;
$inicio = $inicio * $total_reg;
?>


<div class="container mx-auto px-4">
<form class="flex items-center max-w-sm mx-auto" method="get">   
    <label for="simple-search" class="sr-only">Search</label>
    <div class="relative w-full">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
            </svg>
        </div>
        <input <?php if(isset($_GET['search'])&& $_GET['search'] != null){echo 'value='.$_GET['search'].'';} ?> type="text" name="search" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Procure por Nome"/>
    </div>
    <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-red-700 rounded-lg border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg>
        <span class="sr-only">Search</span>
    </button>
</form>
<br><br>
<form class="flex items-center max-w-sm mx-auto">   
<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white py-3 px-5 sm:ms-4 ">Filtros:</label>
  <select id="countries" name="filtro" onchange="status_update(this.options[this.selectedIndex].value)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  <?php  
    echo '<option value="N"';if(!isset($_GET['filtro'])){echo 'SELECTED';} echo '>Nenhum</option>';
    echo '<option value="NC"';if(isset($_GET['filtro'])&& $_GET['filtro'] == "NC"){echo 'SELECTED';} echo '>Nome Crescente</option>';
    echo '<option value="ND"';if(isset($_GET['filtro'])&& $_GET['filtro'] == "ND"){echo 'SELECTED';} echo '>Nome Decrescente</option>';
    echo '<option value="CA"';if(isset($_GET['filtro'])&& $_GET['filtro'] == "CA"){echo 'SELECTED';} echo '>Cargo</option>';
    echo '<option value="CO"';if(isset($_GET['filtro'])&& $_GET['filtro'] == "CO"){echo 'SELECTED';} echo '>Codigo</option>';
    ?> 
  </select>
</form>
</select>
    <br>
<script type="text/javascript">  
function status_update(value){  
let url = "list_prof.php";  
window.location.href= url+"?filtro="+value;  
}
</script>  


<a href="formAddProf.php" class="focus:outline-none dark:text-gray-900 dark:bg-white dark:border dark:border-gray-300 dark:focus:outline-none dark:hover:bg-gray-100 dark:focus:ring-4 dark:focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-gray-800 text-white border-gray-600 hover:bg-gray-700 hover:border-gray-600 focus:ring-gray-700">
    Adicionar professor
</a><br> <br> 
    <div class="relative overflow-x-auto sm:rounded-lg mb-2">
        
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
                if(isset($_GET['search'])&& $_GET['search'] != null){
                    $search = strtoupper($_GET['search']);
                    $sql = "SELECT * FROM professor WHERE prof_isActive IS TRUE AND prof_nome LIKE '%".$search."%'";
                }elseif(isset($_GET['filtro'])){
                    switch($_GET['filtro']){
                        case "NC":
                            $sql = "SELECT * FROM professor WHERE prof_isActive IS TRUE ORDER BY prof_nome ASC";
                            break;
                        case "ND":
                            $sql = "SELECT * FROM professor WHERE prof_isActive IS TRUE ORDER BY prof_nome DESC";
                            break;
                        case "CA":
                            $sql = "SELECT * FROM professor WHERE prof_isActive IS TRUE ORDER BY prof_cargo ASC";
                            break;
                        case "CO":
                            $sql = "SELECT * FROM professor WHERE prof_isActive IS TRUE ORDER BY prof_cod ASC";
                            break;
                        default:
                            $sql = "SELECT * FROM professor WHERE prof_isActive IS TRUE";
                            break;
                    }
                }
                else{
                    $sql = "SELECT * FROM professor WHERE prof_isActive IS TRUE";
                }
                $limite = mysqli_query($conexao,"$sql LIMIT $inicio,$total_reg");
                $todos = mysqli_query($conexao, "$sql");
                $tr = mysqli_num_rows($todos); // verifica o número total de registros
                $tp = $tr / $total_reg; // verifica o número total de páginas
                
                while ($prof = mysqli_fetch_array($limite)) {
                        ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4"><?php echo $prof['prof_cod']; ?></td>
                    <td class="px-6 py-4"><?php echo $prof['prof_nome']; ?></td>
                    <td class="px-6 py-4"><?php echo $prof['prof_cargo']; ?></td>
                    <td class="px-6 py-4">
                        <a type="button" href="formEditProf.php?cod=<?php echo $prof['prof_cod']; ?>">
                        <button class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="23" viewBox="0 0 32 32">
                                <path d="M 23.90625 3.96875 C 22.859375 3.96875 21.8125 4.375 21 5.1875 L 5.1875 21 L 5.125 21.3125 L 4.03125 26.8125 L 3.71875 28.28125 L 5.1875 27.96875 L 10.6875 26.875 L 11 26.8125 L 26.8125 11 C 28.4375 9.375 28.4375 6.8125 26.8125 5.1875 C 26 4.375 24.953125 3.96875 23.90625 3.96875 Z M 23.90625 5.875 C 24.410156 5.875 24.917969 6.105469 25.40625 6.59375 C 26.378906 7.566406 26.378906 8.621094 25.40625 9.59375 L 24.6875 10.28125 L 21.71875 7.3125 L 22.40625 6.59375 C 22.894531 6.105469 23.402344 5.875 23.90625 5.875 Z M 20.3125 8.71875 L 23.28125 11.6875 L 11.1875 23.78125 C 10.53125 22.5 9.5 21.46875 8.21875 20.8125 Z M 6.9375 22.4375 C 8.136719 22.921875 9.078125 23.863281 9.5625 25.0625 L 6.28125 25.71875 Z"></path>
                            </svg>
                        </button>
                        </a>
                        <button type="button" data-modal-target="popup-modal"
                            data-modal-toggle="popup-modal" data-modal-codeProf="<?php echo $prof['prof_cod'];?>"
                            data-modal-name="<?php echo $prof['prof_nome'];?>"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </td>
                </tr>
                <?php 
                }
                ; ?>
            </tbody>
        </table>
    </div><br>


    <div class="flex">
  <!-- Previous Button -->
   <?php 
   $anterior = $pc -1;
   $proximo = $pc +1;
   ?>
    <?php if ($pc>1) { 
        echo '<a href="list_prof.php?pagina='.$anterior.'&'; if(isset($search)){echo 'search='.$search;}if(isset($_GET['filtro'])){echo 'filtro='.$_GET['filtro'];} echo '" class="flex items-center justify-center px-3 h-8 me-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        echo '<svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">';
        echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>';
        echo '</svg>';
        echo  'Anterior';
        echo '</a>';
    } 
    if ($pc<$tp) {
        echo '<a href="list_prof.php?pagina='.$proximo.'&'; if(isset($search)){echo 'search='.$search;}if(isset($_GET['filtro'])){echo 'filtro='.$_GET['filtro'];} echo '" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">';
        echo 'Próximo';
        echo '<svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">';
        echo '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>';
        echo '</svg>';
        echo '</a>';
}?>
<!--  -->
</div>
<div class="flex">



<div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="popup-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Fechar</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="modal-title">Deseja deletar ?</h3>
                <form action="delProf.php" method="post">
                    <input type="hidden" name="cod" id="prof_form">
                    <button type="submit" id="delete-btn" 
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Deletar
                    </button>
                    <button data-modal-hide="popup-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                </form>
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

</script>

</body>

</html>