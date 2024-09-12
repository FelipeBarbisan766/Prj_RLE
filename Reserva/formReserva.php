<title>Reserva</title>


<?php 
include_once ('../navbar2.php'); 
include_once ('../protect.php');
?>

<body>
<div class="px-4 mx-auto max-w-screen-xl ">
<a href="../index.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
        </a>
</div>
<div class="">
<?php if(isset($_GET['data'])&&isset($_GET['lab'])) {?>

        <form action="reserva.php" method="post" class="max-w-sm mx-auto">

            <label for="description" class="flex px-28 mb-2 text-sm font-medium text-gray-900 dark:text-white text-4xl">Descrição</label>
            <input name="desc" id="description" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
            
            <?php
            $lab = $_GET['lab'];
            $data = $_GET['data'];
            $timestamp = strtotime((new DateTime( $data))->format('d-m-Y')); 
            $arrydata = getdate($timestamp);
            $sem = $arrydata['wday']; 
            $slq_reserva = mysqli_query($conexao, "SELECT res_aula FROM reserva WHERE res_data = '$data' AND lab_cod = '$lab' ");
            $slq_cronograma = mysqli_query($conexao, "SELECT cro_aula FROM cronograma WHERE cro_sem = '$sem' AND lab_cod = '$lab' ");
            while ($reserva = mysqli_fetch_array($slq_reserva)){
                switch ($reserva["res_aula"]) {
                    case "1":
                        $aula1 = "disabled";
                        break;
                    case "2":
                        $aula2 = "disabled";
                        break;
                    case "3":
                        $aula3 = "disabled";
                        break;
                    case "4":
                        $aula4 = "disabled";
                        break;
                    case "5":
                        $aula5 = "disabled";
                        break;
                    case "6":
                        $aula6 = "disabled";
                        break;
                    default:
                        break;
                    }
             } while ($cronograma = mysqli_fetch_array($slq_cronograma )){
                switch ($cronograma["cro_aula"]) {
                    case "1":
                        $aula1 = "disabled";
                        break;
                    case "2":
                        $aula2 = "disabled";
                        break;
                    case "3":
                        $aula3 = "disabled";
                        break;
                    case "4":
                        $aula4 = "disabled";
                        break;
                    case "5":
                        $aula5 = "disabled";
                        break;
                    case "6":
                        $aula6 = "disabled";
                        break;
                    default:
                        break;
                    }
             } 
            echo '<input type="hidden" name="data" value="'.$data.'">';
            echo '<input type="hidden" name="lab" value="'.$lab.'">';
            ?>


            <label for="aula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white text-3xl px-40">Aula</label>
            <select name="aula" id="aula" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1" <?php if(isset($aula1)){echo $aula1;} ?>>1º Aula -
                    7h00/7h50</option>
                <option value="2" <?php if(isset($aula2)){echo $aula2;} ?>>2º Aula -
                    --/--</option>
                <option value="3" <?php if(isset($aula3)){echo $aula3;} ?>>3º Aula -
                    --/--</option>
                <option value="4" <?php if(isset($aula4)){echo $aula4;} ?>>4º Aula -
                    --/--</option>
                <option value="5" <?php if(isset($aula5)){echo $aula5;} ?>>5º Aula -
                    --/--</option>
                <option value="6" <?php if(isset($aula6)){echo $aula6;} ?>>6º Aula -
                    --/--</option>
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
            include_once ("../conexao.php");
            $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
            while ($labs = mysqli_fetch_array($slq)) {
                if ($labs['lab_isActive'] == true) { ?>
                    <option value="<?php echo $labs['lab_cod']; ?>"><?php echo $labs['lab_nome']; ?></option>
                <?php }
            }
            ; ?>
            </select><br>

  </div>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Continuar</button>
</form>

    <!-- <form action="" method="" class="container gap-8 grid-rows-1">
        <label for="data" class="text-4xl">Data</label><br><br>

        <input type="date" name="data" id="data" class="form-control" <?php if (isset($_GET['data'])) {echo 'value="' . $_GET['data'] . '"';} ?> required><br>

        <label for="lab" class="text-3xl">Laboratorio</label>
        <select name="lab" id="lab" class="form-select" required>
            <?php
            include_once ("../conexao.php");
            $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
            while ($labs = mysqli_fetch_array($slq)) {
                if ($labs['lab_isActive'] == true) { ?>
                    <option value="<?php echo $labs['lab_cod']; ?>"><?php echo $labs['lab_nome']; ?></option>
                <?php }
            }
            ; ?>
            </select><br>
            <input type="submit" value="Continuar" class="btn btn-primary">
    </form> -->
<?php }; ?>
    </div>

</body>

<!-- ----------------------------------------------------------------------------------------------------------------- -->