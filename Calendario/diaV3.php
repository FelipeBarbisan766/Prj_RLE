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
$labnome = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM laboratorio WHERE lab_cod='$lab'"));
$nomelab = $labnome["lab_nome"];

?>
<div class="px-4 mx-auto max-w-screen-xl ">
    <a href="../" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">         
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
</svg>

    </a>
</div>



<div class="container mx-auto px-3">
    <div class="inline-flex rounded-md shadow-sm float-right" role="group">
      <a href="diaV3.php" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white" selected>
        Dia
      </a>
      <a href="semanaV2.php" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white" disabled>
        Semana
      </a>
      <a type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white" disabled>
        Mês
      </a>
    </div><br>
<div class="row g-0 text-center">
    <div class="col-6 col-md-4">
<form class="max-w-sm mx-auto mb-3 mt-2" >  
    <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data:</label>
    <input name="data" id="data" type="date" <?php echo 'value="' . $data . '"'; ?> class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
    <label for="lab" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Local</label>
    <select id="lab" name="lab" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <?php
    $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
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
            </select><br>
            <input type="submit" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900" value="Buscar">
        </form>
    </div>
   
    
        <?php
        
        $slq_reserva = mysqli_query($conexao, "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, p.prof_nome as prof FROM reserva as r INNER JOIN professor as p on r.prof_cod=p.prof_cod INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.res_data = '$data' AND l.lab_cod = '$lab' ORDER BY r.res_aula ASC");
        $slq_cronograma = mysqli_query($conexao, "SELECT c.cro_aula as aula,c.cro_desc as descr,c.cro_isActive as active, p.prof_nome as prof FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE c.cro_sem = '$sem' AND l.lab_cod = '$lab' ORDER BY c.cro_aula ASC");
        while ($reserva = mysqli_fetch_array($slq_reserva)) {

            switch ($reserva["aula"]) {
                case "1":
                    $aula1 = ['desc' => $reserva['descr'],'prof' => $reserva['prof']];
                    break;
                case "2":
                    $aula2 = ['desc' => $reserva['descr'],'prof' => $reserva['prof']];
                    break;
                case "3":
                    $aula3 = ['desc' => $reserva['descr'],'prof' => $reserva['prof']];
                    break;
                case "4":
                    $aula4 = ['desc' => $reserva['descr'],'prof' => $reserva['prof']];
                    break;
                case "5":
                    $aula5 = ['desc' => $reserva['descr'],'prof' => $reserva['prof']];
                    break;
                case "6":
                    $aula6 = ['desc' => $reserva['descr'],'prof' => $reserva['prof']];
                    break;
                default:
                    break;
                }
        }
            // temos que achar um jeito de diminuir esse switch case 
        while ($cronograma = mysqli_fetch_array($slq_cronograma)) {
            switch ($cronograma["aula"]) {
                case "1":
                    $aula1 = ['desc' => $cronograma['descr']];
                    break;
                case "2":
                    $aula2 = ['desc' => $cronograma['descr']];
                    break;
                case "3":
                    $aula3 = ['desc' => $cronograma['descr']];
                    break;
                case "4":
                    $aula4 = ['desc' => $cronograma['descr']];
                    break;
                case "5":
                    $aula5 = ['desc' => $cronograma['descr']];
                    break;
                case "6":
                    $aula6 = ['desc' => $cronograma['descr']];
                    break;
                default:
                    break;
                }
        }
        
           
            
        ?>
        <hr><br>
<div class="relative overflow-x-auto sm:rounded-lg ">
<table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
            <th scope="col" class="px-6 py-3">
                <?php echo (new DateTime($data))->format('d/m/Y').' - '. $translate[$arrydata['wday']].' - '.$nomelab; ?>
            </th>
            
    </thead>
    <tbody>
   <div class="col-sm-6 col-md-8">  
   <?php
    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4">';
    if(!isset($aula1['desc'])){echo "Livre ";}else{echo $aula1['desc'];if(isset($aula1['prof'])){echo ' - '.$aula1['prof'];}}
    echo '</td></tr>';
    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4">';
    if(!isset($aula2['desc'])){echo "Livre ";}else{echo $aula2['desc'];if(isset($aula2['prof'])){echo ' - '.$aula2['prof'];}}
    echo '</td></tr>';
    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4">';
    if(!isset($aula3['desc'])){echo "Livre ";}else{echo $aula3['desc'];if(isset($aula3['prof'])){echo ' - '.$aula3['prof'];}}
    echo '</td></tr>';
    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4">';
    if(!isset($aula4['desc'])){echo "Livre ";}else{echo $aula4['desc'];if(isset($aula4['prof'])){echo ' - '.$aula4['prof'];}}
    echo '</td></tr>';
    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4">';
    if(!isset($aula5['desc'])){echo "Livre ";}else{echo $aula5['desc'];if(isset($aula5['prof'])){echo ' - '.$aula5['prof'];}}
    echo '</td></tr>';
    echo '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"><td class="px-6 py-4">';
    if(!isset($aula6['desc'])){echo "Livre ";}else{echo $aula6['desc'];if(isset($aula6['prof'])){echo ' - '.$aula6['prof'];}}
    echo '</td></tr>';
        
    ?>
    </tbody>
    </table>
</div>   
</div>
</div>
        

</script>