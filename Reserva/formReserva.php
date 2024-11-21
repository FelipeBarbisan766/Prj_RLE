<title>Reserva</title>


<?php 
include_once ("../conexao.php");
include_once ('../navbar2.php'); 
include_once ('../protect.php');
include_once('../button_back.php');
?>
<head>
</head>
<body>

<style>
option:disabled {
    color: light-dark(graytext, rgb(255, 0, 0)) !important;
}
</style>
<div class="">
<?php if(isset($_GET['data'])&& isset($_GET['lab'])) {
$lab = $_GET['lab'];
$data = $_GET['data'];
$per = $_GET['per'];
if(isset($_GET['prof'])){
    $prof = $_GET['prof'];
}else{
    $prof = $_SESSION['cod'];
}
$timestamp = strtotime((new DateTime( $data))->format('d-m-Y')); 
$arrydata = getdate($timestamp);
$sem = $arrydata['wday']; 
$slq_reserva = mysqli_query($conexao, "SELECT res_aula FROM reserva WHERE res_data = '$data' AND lab_cod = '$lab' AND res_periodo = '$per' AND res_isActive IS TRUE ");
$slq_cronograma = mysqli_query($conexao, "SELECT cro_aula FROM cronograma WHERE cro_sem = '$sem' AND lab_cod = '$lab' AND cro_periodo = '$per' AND cro_isActive IS TRUE ");
$quant = mysqli_num_rows($slq_reserva) + mysqli_num_rows($slq_cronograma);
if($quant >= 6){
echo '
<form class="max-w-sm mx-auto">
<div class="mb-5">
<label for="data" class="flex justify-center px-36 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Data</label>
<input name="data" id="data" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" value="'.$data.'" required min="'.date('Y-m-d').'" onchange="checkDate(this)">
</div>

<div class="mb-5">
<label for="password" class="flex justify-center block mb-2 text-sm font-medium text-gray-900 dark:text-white text-3xl px-28">Laboratorios</label>
<select name="lab" id="lab" class="form-select bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>';

    
    $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
    while ($labs = mysqli_fetch_array($slq)) {
        if ($labs['lab_isActive'] == true) { 
            echo '<option value="'; echo $labs['lab_cod'].'"'; if($labs['lab_cod'] == $lab){echo 'disabled';} echo '>';echo $labs['lab_nome']; echo '</option>';
        }
    }
    ; echo'
    </select>

</div>

<div class="mb-5">
<label for="sem" class="flex justify-center block mb-2 text-sm font-medium text-gray-900 dark:text-white text-3xl px-28">Periodo</label>
<select name="per" id="per" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option value="1">Manhã</option>
    <option value="2">Tarde</option>
    <option value="3">Noite</option>
</select>
</div>
<div class="flex justify-center">

<button type="submit" class="focus:outline-none dark:text-gray-900 dark:bg-white dark:border dark:border-gray-300 dark:focus:outline-none dark:hover:bg-gray-100 dark:focus:ring-4 dark:focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-gray-800 text-white border-gray-600 hover:bg-gray-700 hover:border-gray-600 focus:ring-gray-700">Continuar</button>
</div>
</form>
<br>
<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 max-w-sm mx-auto" role="alert">
<span class="font-medium">Laboratorio Indisponivel ! Tente Outro Laboratorio ou Escolha outra Data </span> 
</div>

';
}else{
?>
        <form action="reserva.php" method="post" class="max-w-sm mx-auto ">

            <label for="description" class="flex justify-center px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Descrição</label>
            <input name="desc" id="description" type="text" placeholder="Ex: TCC" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <br>
            <!-- https://www.creative-tim.com/twcomponents/component/dropdown-with-search -->
            <!--  -->
            <label for="curso" class="flex justify-center px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Curso</label>
            <select name="curso" id="curso" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php
                
                $slq = mysqli_query($conexao, "SELECT * FROM curso");
                while ($cur = mysqli_fetch_array($slq)) {
                    if ($cur['cur_isActive'] == true) { ?>
                        <option value="<?php echo $cur['cur_cod']; ?>"><?php echo $cur['cur_nome']; ?></option>
                    <?php }
                }
                ; ?>            
            </select>
            <label for="Turma" class="flex justify-center px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Turma</label>
            <select name="turma" id="Turma" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="TURMA A E B">Turma A e B</option>
                <option value="TURMA A">Turma A</option>
                <option value="TURMA B">Turma B</option>
            </select>
            <?php
            while ($reserva = mysqli_fetch_array($slq_reserva)){
                switch ($reserva["res_aula"]) {
                    case "1":
                        $aula1 = "disabled ";
                        break;
                    case "2":
                        $aula2 = "disabled ";
                        break;
                    case "3":
                        $aula3 = "disabled ";
                        break;
                    case "4":
                        $aula4 = "disabled ";
                        break;
                    case "5":
                        $aula5 = "disabled ";
                        break;
                    case "6":
                        $aula6 = "disabled ";
                        break;
                    default:
                        break;
                    }
             } while ($cronograma = mysqli_fetch_array($slq_cronograma )){
                switch ($cronograma["cro_aula"]) {
                    case "1":
                        $aula1 = "disabled ";
                        break;
                    case "2":
                        $aula2 = "disabled ";
                        break;
                    case "3":
                        $aula3 = "disabled ";
                        break;
                    case "4":
                        $aula4 = "disabled ";
                        break;
                    case "5":
                        $aula5 = "disabled ";
                        break;
                    case "6":
                        $aula6 = "disabled ";
                        break;
                    default:
                        break;
                    }
             } 
            echo '<input type="hidden" name="data" value="'.$data.'">';
            echo '<input type="hidden" name="lab" value="'.$lab.'">';
            echo '<input type="hidden" name="per" value="'.$per.'">';
            echo '<input type="hidden" name="prof" value="'.$prof.'">';
            ?>


            <label for="aula" class="flex justify-center px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Aula</label>
            <select name="aula" id="aula" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1" <?php if(isset($aula1)){echo $aula1;}if(isset($_GET['aula'])&& $_GET['aula'] == 1){echo 'Selected';} ?>>1º Aula</option>
                <option value="2" <?php if(isset($aula2)){echo $aula2;}if(isset($_GET['aula'])&& $_GET['aula'] == 2){echo 'Selected';} ?>>2º Aula</option>
                <?php if($per == 1 || $per == 3){?>
                <option value="3" <?php if(isset($aula3)){echo $aula3;}if(isset($_GET['aula'])&& $_GET['aula'] == 3){echo 'Selected';} ?>>3º Aula</option>
                <option value="4" <?php if(isset($aula4)){echo $aula4;}if(isset($_GET['aula'])&& $_GET['aula'] == 4){echo 'Selected';} ?>>4º Aula</option>
                <?php }if($per == 1){?>
                <option value="5" <?php if(isset($aula5)){echo $aula5;}if(isset($_GET['aula'])&& $_GET['aula'] == 5){echo 'Selected';} ?>>5º Aula</option>
                <option value="6" <?php if(isset($aula6)){echo $aula6;}if(isset($_GET['aula'])&& $_GET['aula'] == 6){echo 'Selected';} ?>>6º Aula</option>
                <?php }?>
            </select><br>
            <div class="flex justify-center">

                <input type="submit" value="Reservar" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center focus:outline-none dark:text-gray-900 dark:bg-white dark:border dark:border-gray-300 dark:focus:outline-none dark:hover:bg-gray-100 dark:focus:ring-4 dark:focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-gray-800 text-white border-gray-600 hover:bg-gray-700 hover:border-gray-600 focus:ring-gray-700">
            </div>
        </form> 
        
        
    <?php }}else{ ?>

        

<form class="max-w-sm mx-auto">
  <div class="mb-5">
    <label for="data" class="flex justify-center px-36 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Data</label>
    <input name="data" id="data" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" required min="<?php echo date('Y-m-d'); ?>" onchange="checkDate(this)">
  </div>
  
  <div class="mb-5">
    <label for="password" class="flex justify-center block mb-2 text-sm font-medium text-gray-900 dark:text-white text-3xl px-28">Laboratorios</label>
    <select name="lab" id="lab" class="form-select bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <?php
            
            $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
            while ($labs = mysqli_fetch_array($slq)) {
                if ($labs['lab_isActive'] == true) { ?>
                    <option value="<?php echo $labs['lab_cod']; ?>"><?php echo $labs['lab_nome']; ?></option>
                <?php }
            }
            ; ?>
            </select>

  </div>
  
  <div class="mb-5">
        <label for="sem" class="flex justify-center block mb-2 text-sm font-medium text-gray-900 dark:text-white text-3xl px-28">Periodo</label>
        <select name="per" id="per" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="1">Manhã</option>
            <option value="2">Tarde</option>
            <option value="3">Noite</option>
        </select>
    </div>
     <div class="flex justify-center">

         <button type="submit" class="focus:outline-none dark:text-gray-900 dark:bg-white dark:border dark:border-gray-300 dark:focus:outline-none dark:hover:bg-gray-100 dark:focus:ring-4 dark:focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-gray-800 text-white border-gray-600 hover:bg-gray-700 hover:border-gray-600 focus:ring-gray-700">Continuar</button>
     </div>
</form>
<?php }; ?>
    </div>

</body>

<!-- ----------------------------------------------------------------------------------------------------------------- -->