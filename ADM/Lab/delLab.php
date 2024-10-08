<?php
include_once ("../../navbar2.php");
include_once ('../protectAdm.php');
$link_back = 'pageLab.php';
include_once('../../button_back.php');
?>

<div class="container mx-auto px-4">

    

    <h1 class="mb-4 text-3xl text-center mt-2 font-extrabold tracking-tight leading-none text-gray-900 md:text-3xl lg:text-4xl dark:text-white">Deletar laboratorio</h1>

    <form class="max-w-sm mx-auto" method="POST">
        <div class="mb-5">
            <label for="lab" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecionar Local</label>
            <select id="lab" name="lab" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php
                $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
                while ($lab = mysqli_fetch_array($slq)) {
                    if ($lab['lab_isActive'] == true) { ?>
                        <option value="<?php echo $lab['lab_cod'].' codelab='.$lab['lab_cod']; ?>"><?php echo $lab['lab_nome']; ?></option>
                        <?php }
                }
                ; ?>
            </select>
        </div>
    </form>
    <div class="max-w-sm mx-auto">
        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Deletar</button>
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
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="modalTitle">Deseja deletar</h3>
                
                    <input type="hidden" name="cod" id="lab-form">
                
                <button onclick="deletarlaboratorio()" id="deactivate-btn" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Deletar
                </button>
                <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function deletarlaboratorio() {
    var labId = $('#lab').val().split('codelab=')[1];
    $.ajax({
    type: 'POST',
    url: 'delLab.php',
    data: { cod: labId },
    success: function() {
        $('[data-modal-hide="popup-modal"]').click();
        // console.log('deu certo');
        window.location.href = 'pageLab.php';
    }
  });
}
</script>
<?php
if(isset($_POST['cod'])){

$cod = $_POST['cod'];
$isActive = false;

$sql = mysqli_query($conexao,"UPDATE laboratorio SET lab_isActive='$isActive' WHERE lab_cod='$cod'");

if($sql){
    // echo "<script> window.location.href='pageLab.php'</script>";
}else{
    echo "Erro no Insert";
}}
?>
</body>
</html>
