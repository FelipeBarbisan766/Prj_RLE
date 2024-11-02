<title>Reserva</title>


<?php 
include_once ("../conexao.php");
include_once ('../navbar2.php'); 
include_once ('../protect.php');
include_once('../button_back.php');
?>
<head>
<!-- esse script está bugando o visual do select -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>

<style>
option:disabled {
    color: light-dark(graytext, rgb(255, 0, 0)) !important;
}
.select2-dropdown {
  @apply !form-select !block !mb-2 !font-medium !dark:text-white !bg-gray-50 !border !border-gray-300 !text-gray-900 !mb-6 !text-sm !rounded-lg !focus:ring-blue-500 !focus:border-blue-500 !block !w-full !p-2.5 !dark:bg-gray-700 !dark:border-gray-600 !dark:placeholder-gray-400 !dark:text-white !dark:focus:ring-blue-500 !dark:focus:border-blue-500 !important;
  }
  span.selection > span {
    @apply !bg-transparent !border-0 !important; /* adding ! make the class important */
}
.select2-container {
    @apply !w-full z-10  !bg-white !divide-y !divide-gray-100 !rounded-lg !shadow !w-44 !dark:bg-gray-700 !important;
}
.select2-dropdown {
  @apply absolute block w-auto box-border bg-white border-solid border-2 border-gray-600 z-50 float-left;
  }
</style>
<div class="">
<?php if(isset($_GET['data'])&& isset($_GET['lab'])) {?>

        <form action="reserva.php" method="post" class="max-w-sm mx-auto">

            <label for="description" class="flex px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Descrição</label>
            <input name="desc" id="description" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            <label for="prof" class="flex px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Professor</label>
            <select name="prof" id="prof" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php
                
                $slq = mysqli_query($conexao, "SELECT * FROM professor WHERE prof_isActive IS True");
                while ($prof = mysqli_fetch_array($slq)) {
                    ?>
                        <option value="<?php echo $prof['prof_cod']; ?>"><?php echo $prof['prof_nome']; ?></option>
                    <?php 
                }
                ; ?>            
            </select>
            
            <script>
                $(document).ready(function() {
                    $('#prof').select2();
                });
            </script>
            <!--  -->
            <label for="curso" class="flex px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Curso</label>
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
            <label for="Turma" class="flex px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Turma</label>
            <select name="turma" id="Turma" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="TURMA A E B">Turma A e B</option>
                <option value="TURMA A">Turma A</option>
                <option value="TURMA B">Turma B</option>
            </select>
            <?php
            $lab = $_GET['lab'];
            $data = $_GET['data'];
            $per = $_GET['per'];
            $timestamp = strtotime((new DateTime( $data))->format('d-m-Y')); 
            $arrydata = getdate($timestamp);
            $sem = $arrydata['wday']; 
            $slq_reserva = mysqli_query($conexao, "SELECT res_aula FROM reserva WHERE res_data = '$data' AND lab_cod = '$lab' AND res_periodo = '$per' AND res_isActive IS TRUE ");
            $slq_cronograma = mysqli_query($conexao, "SELECT cro_aula FROM cronograma WHERE cro_sem = '$sem' AND lab_cod = '$lab' AND cro_periodo = '$per' AND cro_isActive IS TRUE ");
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
            ?>


            <label for="aula" class="flex px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Aula</label>
            <select name="aula" id="aula" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1" <?php if(isset($aula1)){echo $aula1;} ?>>1º Aula</option>
                <option value="2" <?php if(isset($aula2)){echo $aula2;} ?>>2º Aula</option>
                <?php if($per == 1 || $per = 3){?>
                <option value="3" <?php if(isset($aula3)){echo $aula3;} ?>>3º Aula</option>
                <option value="4" <?php if(isset($aula4)){echo $aula4;} ?>>4º Aula</option>
                <?php }if($per == 1){?>
                <option value="5" <?php if(isset($aula5)){echo $aula5;} ?>>5º Aula</option>
                <option value="6" <?php if(isset($aula6)){echo $aula6;} ?>>6º Aula</option>
                <?php }?>
            </select><br>
            
            <input type="submit" value="Reservar" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        </form> 
        
        
    <?php }else{ ?>

        

<form class="max-w-sm mx-auto">
  <div class="mb-5">
    <label for="data" class="flex px-36 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Data</label>
  <input name="data" id="data" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" required min="<?php echo date('Y-m-d'); ?>" onchange="checkDate(this)">
  </div>
  
  <div class="mb-5">
    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-3xl px-28">Laboratorios</label>
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
        <label for="sem" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-3xl px-28">Periodo</label>
        <select name="per" id="per" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="1">Manhã</option>
            <option value="2">Tarde</option>
            <option value="3">Noite</option>
        </select>
    </div>
    <!-- botao nao ta aparecendo no meu pc (felipao) -->
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Continuar</button>
</form>
<?php }; ?>
    </div>

</body>

<!-- ----------------------------------------------------------------------------------------------------------------- -->