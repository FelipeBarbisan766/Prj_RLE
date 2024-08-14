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

<div class="container mx-auto px-3">

    <a href="../index.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
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
                   echo '<option value='.$labs['lab_cod'].'>'.$labs['lab_nome'].'</option>';
                }}; ?>
        </select>
    
             <script type="text/javascript">  
            function status_update(value){  
           let url = "cronograma2.php";  
           window.location.href= url+"?lab="+value;  
        }  
        </script>  
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
        <?php

        for ($aula = 1; $aula <= 6; $aula++) {
 
        // echo $dia;
        $slq = mysqli_query($conexao, "SELECT c.cro_aula as aula,c.cro_desc as descr,c.cro_sem as sem,c.cro_isActive as active, p.prof_nome as prof FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE c.cro_aula = '$aula' AND c.lab_cod='$lab' ORDER BY c.cro_aula ASC");
        while ($crono = mysqli_fetch_array($slq)) {
                switch ($crono["sem"]) {
                    case "1":
                        $seg = ['desc' => $crono['descr'],'prof' => $crono['prof']];
                        break;
                    case "2":
                        $ter = ['desc' => $crono['descr'],'prof' => $crono['prof']];
                        break;
                    case "3":
                        $qua = array('desc' => $crono['descr'],'prof' => $crono['prof']);
                        break;
                    case "4":
                        $qui = array('desc' => $crono['descr'],'prof' => $crono['prof']);
                        break;
                    case "5":
                        $sex = array('desc' => $crono['descr'],'prof' => $crono['prof']);
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
                    <?php if(!isset($seg)){echo "livre ";}else{echo $seg['desc'].' - professor(a)'.$seg['prof'];}?>
                </td>
                <td class="px-6 py-4">
                    <?php if(!isset($ter)){echo "livre ";}else{echo $ter['desc'].' - professor(a)'.$ter['prof'];}?>
                </td>
                <td class="px-6 py-4">
                    <?php if(!isset($qua)){echo "livre ";}else{echo $qua['desc'].' - professor(a)'.$qua['prof'];}?>
                </td>
                <td class="px-6 py-4">
                    <?php if(!isset($qui)){echo "livre ";}else{echo $qui['desc'].' - professor(a)'.$qui['prof'];}?>
                </td>
                <td class="px-6 py-4">
                    <?php if(!isset($sex)){echo "livre ";}else{echo $sex['desc'].' - professor(a)'.$sex['prof'];}?>
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

</div>