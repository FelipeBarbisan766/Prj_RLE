<?php
include_once ("../conexao.php");
include_once ("../navbar2.php");
date_default_timezone_set('America/Sao_Paulo');
$translate = array(
    0 => "Domingo",
    1 => "Segunda",
    2 => "Terça",
    3 => "Quarta",
    4 => "Quinta",
    5 => "Sexta",
    6 => "Sabado",
);
if (isset($_GET['data'])) {
    $data = $_GET['data'];
    $timestamp = strtotime((new DateTime( $data))->format('d-m-Y')); //tem que converter a data pq essa merda n entende (┬┬﹏┬┬)
    $arrydata = getdate($timestamp);
    $sem = $arrydata['wday']; //Dia da semana de 0 a 6
} else {
    $data = date("Y-m-d");
    $arrydata = getdate();
    $sem = $arrydata['wday'];
}
if (isset($_GET['lab'])) {
    $lab = $_GET['lab'];
} else {
    $labs = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM laboratorio"));//tentar sumir com isso pq repete 
    $lab = $labs['lab_cod'];
}
if (isset($_GET['per'])) {
    $per = $_GET['per'];
} else {
    $per = 1;
}
$labnome = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM laboratorio WHERE lab_cod='$lab'"));
$nomelab = $labnome["lab_nome"];
include_once('../button_back.php');
?>

<div class="row g-0 text-center">
<div class="col-6 col-md-4">

<form class="max-w-sm mx-auto mb-3 mt-2" >  
    <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data:</label>
    <input name="data" id="data" type="date" <?php echo 'value="' . $data . '"'; ?> class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Local</label>
    <select id="countries" name="lab" onchange="status_update(this.options[this.selectedIndex].value)" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <?php
        $sql = mysqli_query($conexao, "SELECT * FROM laboratorio WHERE lab_isActive IS TRUE");
        while ($labs = mysqli_fetch_array($sql)) {
                if(isset($_GET['lab'])){
                    if($_GET['lab'] != $labs['lab_cod']){
                        echo '<option value='.$labs['lab_cod'].'>'.$labs['lab_nome'].'</option>';
                    }else{
                        echo '<option value='.$_GET['lab'].' Selected>'.$nomelab.'</option>';
                    }
                }else{
                    echo '<option value='.$labs['lab_cod'].'>'.$labs['lab_nome'].'</option>';
                }
            }; ?>
    </select>
      
        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Periodo</label>
        <select id="countries" name="per" onchange="update_per(this.options[this.selectedIndex].value)" class="mb-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <?php  
             echo '<option value="1"';if(!isset($_GET['per'])|| $_GET['per'] == "1"){echo 'SELECTED';} echo '>Manhã</option>';
             echo '<option value="2"';if(isset($_GET['per'])&& $_GET['per'] == "2"){echo 'SELECTED';} echo '>Tarde</option>';
             echo '<option value="3"';if(isset($_GET['per'])&& $_GET['per'] == "3"){echo 'SELECTED';} echo '>Noite</option>';
             ?> 
        </select>
        <div class="grid grid-rows-2 gap-4 place-content-center">
            <input type="submit" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg focus:outline-none dark:text-gray-900 dark:bg-white dark:border dark:border-gray-300 dark:focus:outline-none dark:hover:bg-gray-100 dark:focus:ring-4 dark:focus:ring-gray-100 font-medium rounded-lg text-sm bg-gray-800 text-white border-gray-600 hover:bg-gray-700 hover:border-gray-600 focus:ring-gray-700" value="Buscar">
            
            <div class="inline-flex rounded-md shadow-sm float-right" role="group">
            <?php echo '<a href="diaV3.php?data='.$data.'&lab='.$lab.'&per='.$per.'" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white" selected>
            Dia
            </a>'; 
            echo '<a href="semanaV2.php?data='.$data.'&lab='.$lab.'&per='.$per.'" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
            Semana
            </a>';?>
            <a href="calendario.php" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white" disabled>
            Mês
            </a>
            </div>

        </div>
    </form>
    </div>
   
    
        <?php
        
        $slq_reserva = mysqli_query($conexao, "SELECT r.res_cod as cod, r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, p.prof_nome as prof FROM reserva as r INNER JOIN professor as p on r.prof_cod=p.prof_cod INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.res_data = '$data' AND l.lab_cod = '$lab' AND r.res_periodo = '$per' AND r.res_isActive IS TRUE ORDER BY r.res_aula ASC");
        $slq_cronograma = mysqli_query($conexao, "SELECT c.cro_cod as cod, c.cro_aula as aula,c.cro_desc as descr,c.cro_isActive as active, p.prof_nome as prof FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE c.cro_sem = '$sem' AND l.lab_cod = '$lab' AND c.cro_periodo = '$per' AND c.cro_isActive IS TRUE ORDER BY c.cro_aula ASC");
        while ($reserva = mysqli_fetch_array($slq_reserva)) {

            switch ($reserva["aula"]) {
                case "1":
                    $aula1 = ['desc' => $reserva['descr'],'prof' => $reserva['prof'],'cod' => $reserva['cod'],'type' => '1'];
                    break;
                case "2":
                    $aula2 = ['desc' => $reserva['descr'],'prof' => $reserva['prof'],'cod' => $reserva['cod'],'type' => '1'];
                    break;
                case "3":
                    $aula3 = ['desc' => $reserva['descr'],'prof' => $reserva['prof'],'cod' => $reserva['cod'],'type' => '1'];
                    break;
                case "4":
                    $aula4 = ['desc' => $reserva['descr'],'prof' => $reserva['prof'],'cod' => $reserva['cod'],'type' => '1'];
                    break;
                case "5":
                    $aula5 = ['desc' => $reserva['descr'],'prof' => $reserva['prof'],'cod' => $reserva['cod'],'type' => '1'];
                    break;
                case "6":
                    $aula6 = ['desc' => $reserva['descr'],'prof' => $reserva['prof'],'cod' => $reserva['cod'],'type' => '1'];
                    break;
                default:
                    break;
                }
        }
            // temos que achar um jeito de diminuir esse switch case 
        while ($cronograma = mysqli_fetch_array($slq_cronograma)) {
            switch ($cronograma["aula"]) {
                case "1":
                    $aula1 = ['desc' => $cronograma['descr'],'cod' => $cronograma['cod'],'type' => '2'];
                    break;
                case "2":
                    $aula2 = ['desc' => $cronograma['descr'],'cod' => $cronograma['cod'],'type' => '2'];
                    break;
                case "3":
                    $aula3 = ['desc' => $cronograma['descr'],'cod' => $cronograma['cod'],'type' => '2'];
                    break;
                case "4":
                    $aula4 = ['desc' => $cronograma['descr'],'cod' => $cronograma['cod'],'type' => '2'];
                    break;
                case "5":
                    $aula5 = ['desc' => $cronograma['descr'],'cod' => $cronograma['cod'],'type' => '2'];
                    break;
                case "6":
                    $aula6 = ['desc' => $cronograma['descr'],'cod' => $cronograma['cod'],'type' => '2'];
                    break;
                default:
                    break;
                }
        }
        
           
            
        ?>
        <br>
<div class="relative overflow-x-auto sm:rounded-lg | max-w-2xl mx-auto mb-3 mt-2">
<table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="uppercase text-xs text-white uppercase bg-red-700">
        <tr>
            <th scope="col" class="px-6 py-3">
                <?php echo (new DateTime($data))->format('d/m/Y').' - '. $translate[$arrydata['wday']].' - '.$nomelab; ?>
            </th>
            
    </thead>
    <tbody>
   <div class="col-sm-6 col-md-8">  
   <?php
   
    echo '
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4" data-modal-target="modal-first" data-modal-toggle="modal-first" onclick="';if(!isset($aula1['desc'])){echo 'ModalLivre(1,'.strtotime($data).','.$sem.')';}else{echo 'OpenModal('.$aula1['cod'].','.$aula1['type'].')';} echo'" >';
    if(!isset($aula1['desc'])){echo "Livre ";}else{echo $aula1['desc'];if(isset($aula1['prof'])){echo ' - '.$aula1['prof'];}}
    echo '</td></tr>';
    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4" data-modal-target="modal-first" data-modal-toggle="modal-first" onclick="';if(!isset($aula2['desc'])){echo 'ModalLivre(2,'.strtotime($data).','.$sem.')';}else{echo 'OpenModal('.$aula2['cod'].','.$aula2['type'].')';} echo'" >';
    if(!isset($aula2['desc'])){echo "Livre ";}else{echo $aula2['desc'];if(isset($aula2['prof'])){echo ' - '.$aula2['prof'];}}
    echo '</td></tr>';
    if($per == 1 || $per == 3){
    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4" data-modal-target="modal-first" data-modal-toggle="modal-first" onclick="';if(!isset($aula3['desc'])){echo 'ModalLivre(3,'.strtotime($data).','.$sem.')';}else{echo 'OpenModal('.$aula3['cod'].','.$aula3['type'].')';} echo'" >';
    if(!isset($aula3['desc'])){echo "Livre ";}else{echo $aula3['desc'];if(isset($aula3['prof'])){echo ' - '.$aula3['prof'];}}
    echo '</td></tr>';
    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4" data-modal-target="modal-first" data-modal-toggle="modal-first" onclick="';if(!isset($aula4['desc'])){echo 'ModalLivre(4,'.strtotime($data).','.$sem.')';}else{echo 'OpenModal('.$aula4['cod'].','.$aula4['type'].')';} echo'" >';
    if(!isset($aula4['desc'])){echo "Livre ";}else{echo $aula4['desc'];if(isset($aula4['prof'])){echo ' - '.$aula4['prof'];}}
    echo '</td></tr>';
    }if($per == 1){
    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4" data-modal-target="modal-first" data-modal-toggle="modal-first" onclick="';if(!isset($aula5['desc'])){echo 'ModalLivre(5,'.strtotime($data).','.$sem.')';}else{echo 'OpenModal('.$aula5['cod'].','.$aula5['type'].')';} echo'" >';
    if(!isset($aula5['desc'])){echo "Livre ";}else{echo $aula5['desc'];if(isset($aula5['prof'])){echo ' - '.$aula5['prof'];}}
    echo '</td></tr>';
    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4" data-modal-target="modal-first" data-modal-toggle="modal-first" onclick="';if(!isset($aula6['desc'])){echo 'ModalLivre(6,'.strtotime($data).','.$sem.')';}else{echo 'OpenModal('.$aula6['cod'].','.$aula6['type'].')';} echo'" >';
    if(!isset($aula6['desc'])){echo "Livre ";}else{echo $aula6['desc'];if(isset($aula6['prof'])){echo ' - '.$aula6['prof'];}}
    echo '</td></tr>';}
        
    ?>
    </tbody>
    </table>
</div>   
</div>
</div>
<div id="modal-first" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Informações da Aula
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
                <button data-modal-hide="modal-first" type="button" class="focus:outline-none dark:text-gray-900 dark:bg-white dark:border dark:border-gray-300 dark:focus:outline-none dark:hover:bg-gray-100 dark:focus:ring-4 dark:focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-gray-800 text-white border-gray-600 hover:bg-gray-700 hover:border-gray-600 focus:ring-gray-700">Fechar</button>
                <!-- <button data-modal-hide="modal-first" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button> -->
            </div>
        </div>
    </div>
</div>    
<script>
    function OpenModal(cod,type){
        var codigo = <?php if(isset($_SESSION['cod'])){echo $_SESSION['cod'];}else{echo 0;} ?>;

        $.ajax({
            url: 'search.php',  // PHP script to handle the request
            type: 'POST',
            data: {
                cod_search: cod,
                type: type,
                cod: codigo
            }, 
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
    function ModalLivre(aula,data,sem){
        var codigo = <?php if(isset($_SESSION['cod'])){echo $_SESSION['cod'];}else{echo 0;} ?>;
        var cargo = <?php if(isset($_SESSION['cargo'])){echo 1;}else{echo 0;} ?>;
        var lab = <?php echo $lab ?>;
        var per = <?php echo $per ?>;
        $.ajax({
            url: 'modalAdicionar.php',  // O script PHP que irá processar o valor
            type: 'POST',
            data: {
            data: data,
            sem:sem,
            lab:lab,
            per:per,
            aula:aula,
            carg: cargo,
            cod: codigo
            },  // Enviando o valor 'cod' para o PHP
            success: function(response){
                // Lida com a resposta do PHP se necessário
                document.getElementById('resultado').innerHTML = response;
            },
            error: function() {
            // Caso ocorra um erro na requisição
            document.getElementById('resultado').innerHTML = "Erro ao processar a requisição.";
            }
        });

    };</script>