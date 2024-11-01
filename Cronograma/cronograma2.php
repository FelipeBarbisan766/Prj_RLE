<?php
    include_once ("../conexao.php");
    include_once ("../navbar2.php");
    date_default_timezone_set('America/Sao_Paulo');
?>

<!-- TABELA 2 -->
<?php
if (isset($_GET['lab'])) {
    $lab = $_GET['lab'];
} else {
    $labs = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM laboratorio WHERE lab_isActive IS TRUE"));//tentar sumir com isso pq repete 
    $lab = $labs['lab_cod'];
}
if (isset($_GET['per'])) {
    $per = $_GET['per'];
} else {
    $per = 1;
}
$labnome = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM laboratorio WHERE lab_cod='$lab'"));
$nomelab = $labnome["lab_nome"];

?>

<div class="container mx-auto px-4">

    <a href="../index.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
    </svg>
    </a>
    <?php
    $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
    ?>
    
    <form class="max-w-sm mx-auto mb-3 mt-2" >  
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Local</label>
        <select id="countries" name="lab" onchange="status_update(this.options[this.selectedIndex].value)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <?php
            
            while ($labs = mysqli_fetch_array($slq)) {
                if ($labs['lab_isActive'] == true) { 
                    if(isset($_GET['lab'])){
                        if($_GET['lab'] != $labs['lab_cod']){
                            echo '<option value='.$labs['lab_cod'].'>'.$labs['lab_nome'].'</option>';
                        }else{
                            echo '<option value='.$_GET['lab'].' Selected>'.$nomelab.'</option>';
                        }
                    }else{
                        echo '<option value='.$labs['lab_cod'].'>'.$labs['lab_nome'].'</option>';
                    }
                }}; ?>
        </select>
    
        <script type="text/javascript">  
        function status_update(value){ 
            var per = <?= $per ?>;
            let url = "cronograma2.php";  
            window.location.href= url+"?lab="+value+"&per="+per;   
        }  
        </script>  
    </form>
    <form class="max-w-sm mx-auto mb-3 mt-2" >  
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Periodo</label>
        <select id="countries" name="per" onchange="update_per(this.options[this.selectedIndex].value)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <?php  
             echo '<option value="1"';if(!isset($_GET['per'])|| $_GET['per'] == "1"){echo 'SELECTED';} echo '>Manhã</option>';
             echo '<option value="2"';if(isset($_GET['per'])&& $_GET['per'] == "2"){echo 'SELECTED';} echo '>Tarde</option>';
             echo '<option value="3"';if(isset($_GET['per'])&& $_GET['per'] == "3"){echo 'SELECTED';} echo '>Noite</option>';
             ?> 
        </select>
    
        <script type="text/javascript">  
        function update_per(value){  
            var lab =  <?= $lab ?>;
            let url = "cronograma2.php";  
            window.location.href= url+"?lab="+lab+"&per="+value;  
        }  
        </script>  
    </form>
    

    <div class="relative overflow-x-auto sm:rounded-lg mb-2">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="table-crono">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Aulas
                    </th>
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
            <?php
            if($per == 1){
                $quant = 6;
            }elseif($per == 2){
                $quant = 2;
            }elseif($per = 3){
                $quant = 4;
            }else{
                $quant = 6; 
            }
            for ($aula = 1; $aula <= $quant; $aula++) {
    
            // echo $dia;
            $slq = mysqli_query($conexao, "SELECT c.cro_cod as cod,c.cro_aula as aula,c.cro_desc as descr,c.cro_sem as sem,c.cro_isActive as active, p.prof_nome as prof FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE c.cro_aula = '$aula' AND c.lab_cod='$lab' AND c.cro_periodo='$per' AND c.cro_isActive IS TRUE ORDER BY c.cro_aula ASC");
            while ($crono = mysqli_fetch_array($slq)) {
                    switch ($crono["sem"]) {
                        case "1":
                            $seg = [$crono['cod'],$crono['descr']];
                            break;
                        case "2":
                            $ter = [$crono['cod'],$crono['descr']];
                            break;
                        case "3":
                            $qua = [$crono['cod'],$crono['descr']];
                            break;
                        case "4":
                            $qui = [$crono['cod'],$crono['descr']];
                            break;
                        case "5":
                            $sex = [$crono['cod'],$crono['descr']];
                            break;
                        default:
                            break;
                        }
                }

                ; ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" >
                        <?php echo $aula;?>ª Aula
                    </th>
                    <?php echo '<td class="px-6 py-4" data-modal-target="modal-first" data-modal-toggle="modal-first" onclick="';
                        if(!isset($seg[1])){echo 'ModalLivre(1,'.$lab.')"> Livre';}else{echo 'OpenModal('.$seg[0].')">'.$seg[1];}?>
                    </td>
                    <?php echo '<td class="px-6 py-4" data-modal-target="modal-first" data-modal-toggle="modal-first" onclick="';
                        if(!isset($ter[1])){echo 'ModalLivre(2,'.$lab.')"> Livre';}else{echo 'OpenModal('.$ter[0].')">'.$ter[1];}?>
                    </td>
                    <?php echo '<td class="px-6 py-4" data-modal-target="modal-first" data-modal-toggle="modal-first" onclick="';
                        if(!isset($qua[1])){echo 'ModalLivre(3,'.$lab.')"> Livre';}else{echo 'OpenModal('.$qua[0].')">'.$qua[1];}?>
                    </td>
                    <?php echo '<td class="px-6 py-4" data-modal-target="modal-first" data-modal-toggle="modal-first" onclick="';
                        if(!isset($qui[1])){echo 'ModalLivre(4,'.$lab.')">Livre';}else{echo 'OpenModal('.$qui[0].')">'.$qui[1];}?>
                    </td>
                    <?php echo '<td class="px-6 py-4" data-modal-target="modal-first" data-modal-toggle="modal-first" onclick="';
                        if(!isset($sex[1])){echo 'ModalLivre(5,'.$lab.')"> Livre';}else{echo 'OpenModal('.$sex[0].')">'.$sex[1];}?>
                    </td>
                </tr>
                <?php
                $seg = null;
                $ter = null;
                $qua = null;
                $qui = null;
                $sex = null;
                }?> 
                
            </tbody>
        </table>
    </div>
    <script src="\Prj_RLE/Calendario/js/table2excel.js"></script>
    
    <div class="flex flex-row"> <!-- melhorar o visual e alinhar melhor os botões -->
    <button id="excel-button" class="flex flex-row gap-1 place-content-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Excel
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
    <path fill-rule="evenodd" d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 18.375V5.625ZM21 9.375A.375.375 0 0 0 20.625 9h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5a.375.375 0 0 0 .375-.375v-1.5ZM10.875 18.75a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h7.5ZM3.375 15h7.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-7.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375Zm0-3.75h7.5a.375.375 0 0 0 .375-.375v-1.5A.375.375 0 0 0 10.875 9h-7.5A.375.375 0 0 0 3 9.375v1.5c0 .207.168.375.375.375Z" clip-rule="evenodd" />
    </svg>
    </button>
    <?php
    if(isset($_SESSION['nome'])){
        if($_SESSION['cargo'] =='adm'){
            ?>
        <a href="form2.php" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Adicionar aula ao Cronograma</a>
        <a href="FormDelCronograma.php" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Deletar Cronograma</a>
        <a href="ResetCronograma.php" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Limpar Cronograma</a>
        <a href="FormEditCrono.php" type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Editar aula do cronograma</a> 
        
        <?php }}    ?>
    </div>



<!-- Main modal -->
<div id="modal-first" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Informações do Cronograma
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modal-first">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-4" id="resultado">
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button data-modal-hide="modal-first" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Fechar</button>
                <!-- <button data-modal-hide="modal-first" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button> -->
            </div>
        </div>
    </div>
</div>

<script>
    function OpenModal(cod){
        $.ajax({
            url: 'search.php',  // O script PHP que irá processar o valor
            type: 'POST',
            data: {cod_search: cod},  // Enviando o valor 'cod' para o PHP
            success: function(response){
                // Lida com a resposta do PHP se necessário
                document.getElementById('resultado').innerHTML = response;
            },
            error: function() {
            // Caso ocorra um erro na requisição
            document.getElementById('resultado').innerHTML = "Erro ao processar a requisição.";
            }
        });

    };
    function ModalLivre(sem,lab){
        $.ajax({
            url: 'modalAdicionar.php',  // O script PHP que irá processar o valor
            type: 'POST',
            data: {cod_search: sem,lab},  // Enviando o valor 'cod' para o PHP
            success: function(response){
                // Lida com a resposta do PHP se necessário
                document.getElementById('resultado').innerHTML = response;
            },
            error: function() {
            // Caso ocorra um erro na requisição
            document.getElementById('resultado').innerHTML = "Erro ao processar a requisição.";
            }
        });

    };
    
    
    document.getElementById("excel-button").addEventListener('click',function() {
        var excel = new Table2Excel();
        excel.export(document.querySelectorAll("#table-crono"),"Cronograma");  
    });
    //? https://github.com/rusty1s/table2excel/tree/master
</script>
</div>