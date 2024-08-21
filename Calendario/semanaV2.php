<?php
include_once ("../conexao.php");
include_once ("../navbar2.php");
include_once ("../protect.php");
date_default_timezone_set('America/Sao_Paulo');
$translate = array(
    0 => "Dom",
    1 => "Seg",
    2 => "Ter",
    3 => "Qua",
    4 => "Qui",
    5 => "Sex",
    6 => "Sab",
);

?>
<div class="px-4 mx-auto max-w-screen-xl ">
    <a href="../" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">         
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">    
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
        </svg>
    </a>
</div>



<div class="container mx-auto px-3">
    <div class="inline-flex rounded-md shadow-sm float-right" role="group">
      <a href="diaV3.php" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white" selected>
        Dia
      </a>
      <a href="semanaV2.php" type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border-t border-b border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
        Semana
      </a>
      <a type="button" class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white" disabled>
        Mês
      </a>
    </div>
<div class="row g-0 text-center">
    <div class="col-6 col-md-4">
<form class="max-w-sm mx-auto mb-3 mt-2" >  
    <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data:</label>
    <input name="data" id="data" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
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
<?php
if(isset($_GET['data'])){
    $data = new DateTime($_GET['data']);
    $timestamp = strtotime($data->format('d-m-Y')); //* tem que converter a data pq essa merda n entende (┬┬﹏┬┬)
    $arrydata = getdate($timestamp);
    $sem = $arrydata['wday']; //? Dia da semana de 0 a 6
}else{  
    $data = new DateTime();
    $arrydata = getdate();
    $sem = $arrydata['wday'];
}  
if (isset($_GET['lab'])) {
    $lab = $_GET['lab'];
} else {
    $labs = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM laboratorio"));//* tentar sumir com isso pq repete 
    $lab = $labs['lab_cod'];
}
$labnome = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM laboratorio WHERE lab_cod='$lab'"));
$nomelab = $labnome["lab_nome"];
$diaN = date("w", strtotime($data->format('Y-m-d')));

$data->modify('-' . $diaN . ' day');
$data->modify('+1 day');
// ! Não mecher pois nem eu sei como essa parte ta funcionando !!!
$dia = array();
for($i = 1;$i <=5;$i++){
array_push($dia,$data->format('Y-m-d'));
$data->modify('+1 day');
// echo var_dump($dia);
}
for ($aula = 1; $aula <= 6; $aula++)  {
        
        
        $slq_reserva = mysqli_query($conexao, "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, p.prof_nome as prof, r.res_data as dia FROM reserva as r INNER JOIN professor as p on r.prof_cod=p.prof_cod INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.res_aula = '$aula' AND r.lab_cod='$lab' ORDER BY r.res_aula ASC");
        
        $slq_cronograma = mysqli_query($conexao, "SELECT c.cro_aula as aula,c.cro_desc as descr,c.cro_isActive as active,p.prof_nome as prof,c.cro_sem as sem FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE c.cro_aula = '$aula' AND c.lab_cod='$lab' ORDER BY c.cro_aula ASC");

        // echo $dia;
        while ($reserva = mysqli_fetch_array($slq_reserva)) {
                switch ($reserva["dia"]) {
                    case $dia['0'] :
                        $seg = ['desc' => $reserva['descr'],'prof' => $reserva['prof']];
                        break;
                    case $dia['1']:
                        $ter = ['desc' => $reserva['descr'],'prof' => $reserva['prof']];
                        break;
                    case $dia['2']:
                        $qua = array('desc' => $reserva['descr'],'prof' => $reserva['prof']);
                        break;
                    case $dia['3']:
                        $qui = array('desc' => $reserva['descr'],'prof' => $reserva['prof']);
                        break;
                    case $dia['4']:
                        $sex = array('desc' => $reserva['descr'],'prof' => $reserva['prof']);
                        break;
                    default:
                        break;
                    }
            }
        //! funcionou mas é macumba se bugar é normal 
        
            while ($crono = mysqli_fetch_array($slq_cronograma)) {
                switch ($crono["sem"]) {
                    case "1":
                        $seg = ['desc' => $crono['descr']];
                        break;
                    case "2":
                        $ter = ['desc' => $crono['descr']];
                        break;
                    case "3":
                        $qua = ['desc' => $crono['descr']];
                        break;
                    case "4":
                        $qui = ['desc' => $crono['descr']];
                        break;
                    case "5":
                        $sex = ['desc' => $crono['descr']];
                        break;
                    default:
                        break;
                    }
            }

        ; 
        // echo $data . ' - ' . $translate[$sem] . ' - '.$nomelab."<br>"; 
        //? depois tentar por a data na semana mas tem que mudar a ordem do HTML ('Conserteza alguma coisa vai da pal')
        ?>
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" >
                        <?php echo $aula; ?>ºAula
                    </th>
                    <td class="px-6 py-4">
                        <?php if(!isset($seg['desc'])){echo "Livre ";}else{echo $seg['desc'];if(isset($seg['prof'])){echo ' - '.$seg['prof'];}}?>
                    </td>
                    <td class="px-6 py-4">
                        <?php if(!isset($ter['desc'])){echo "Livre ";}else{echo $ter['desc'];if(isset($ter['prof'])){echo ' - '.$ter['prof'];}}?>
                    </td>
                    <td class="px-6 py-4">
                        <?php if(!isset($qua['desc'])){echo "Livre ";}else{echo $qua['desc'];if(isset($qua['prof'])){echo ' - '.$qua['prof'];}}?>
                    </td>
                    <td class="px-6 py-4">
                        <?php if(!isset($qui['desc'])){echo "Livre ";}else{echo $qui['desc'];if(isset($qui['prof'])){echo ' - '.$qui['prof'];}}?>
                    </td>
                    <td class="px-6 py-4">
                        <?php if(!isset($sex)){echo "Livre ";}else{echo $sex;}?>
                    </td>
                </tr>
        
    </div>
    <?php
    $seg = null;
    $ter = null;
    $qua = null;
    $qui = null;
    $sex = null;
}?>

</tbody>
  </div>
</div>
       