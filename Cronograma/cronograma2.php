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
    $labs = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM laboratorio"));//tentar sumir com isso pq repete 
    $lab = $labs['lab_cod'];
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
            include_once ("../conexao.php");
            
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
           let url = "cronograma2.php";  
           window.location.href= url+"?lab="+value;  
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

            for ($aula = 1; $aula <= 6; $aula++) {
    
            // echo $dia;
            $slq = mysqli_query($conexao, "SELECT c.cro_aula as aula,c.cro_desc as descr,c.cro_sem as sem,c.cro_isActive as active, p.prof_nome as prof FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE c.cro_aula = '$aula' AND c.lab_cod='$lab' ORDER BY c.cro_aula ASC");
            while ($crono = mysqli_fetch_array($slq)) {
                    switch ($crono["sem"]) {
                        case "1":
                            $seg = $crono['descr'];
                            break;
                        case "2":
                            $ter = $crono['descr'];
                            break;
                        case "3":
                            $qua = $crono['descr'];
                            break;
                        case "4":
                            $qui = $crono['descr'];
                            break;
                        case "5":
                            $sex = $crono['descr'];
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
                    <td class="px-6 py-4">
                        <?php if(!isset($seg)){echo "Livre ";}else{echo $seg;}?>
                    </td>
                    <td class="px-6 py-4">
                        <?php if(!isset($ter)){echo "Livre ";}else{echo $ter;}?>
                    </td>
                    <td class="px-6 py-4">
                        <?php if(!isset($qua)){echo "Livre ";}else{echo $qua;}?>
                    </td>
                    <td class="px-6 py-4">
                        <?php if(!isset($qui)){echo "Livre ";}else{echo $qui;}?>
                    </td>
                    <td class="px-6 py-4">
                        <?php if(!isset($sex)){echo "Livre ";}else{echo $sex;}?>
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
        <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Deletar Cronograma</button>
        <a href="#" type="button" class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900">Editar aula do cronograma</a>
    </div>
    <?php
        }   
    }
    ?>
<script>
    document.getElementById("excel-button").addEventListener('click',function() {
        var excel = new Table2Excel();
        excel.export(document.querySelectorAll("#table-crono"),"Cronograma");  
    });
    //? https://github.com/rusty1s/table2excel/tree/master
</script>
</div>