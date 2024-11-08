<?php include_once ('../navbar2.php');
include_once ("../protect.php"); 
include_once('../button_back.php');
?>

<style>
.form-label{
    font-size:45px;
}
option:disabled {
    color: light-dark(graytext, rgb(255, 0, 0)) !important;
}
</style>
<body>

<div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
<?php if(isset($_GET['lab'])) {?>
        <form action="registro.php" method="post" class="max-w-sm mx-auto">
            <div class="mb-5">

                <label for="desc" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white flex justify-center">Descrição</label>
                <input type="text" name="desc" id="desc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required><br>
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
            </div>
            
            <?php
            $lab = $_GET['lab'];
            $sem = $_GET['sem'];
            $per = $_GET['per'];
            // $data = $_GET['data'];
            // $timestamp = strtotime((new DateTime( $data))->format('d-m-Y')); 
            // $arrydata = getdate($timestamp);
            // $sem = $arrydata['wday']; 
            //

            $slq_cronograma = mysqli_query($conexao, "SELECT cro_aula FROM cronograma WHERE cro_sem = '$sem' AND lab_cod = '$lab' AND cro_periodo = '$per' AND cro_isActive IS TRUE  ");

            while ($cronograma = mysqli_fetch_array($slq_cronograma )){
                switch ($cronograma["cro_aula"]){
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
            echo '<input type="hidden" name="sem" value="'.$sem.'">';
            echo '<input type="hidden" name="lab" value="'.$lab.'">';
            echo '<input type="hidden" name="per" value="'.$per.'">';
            ?>
            <div class="mb-5">
                <label for="aula" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Aula</label>
                <select name="aula" id="aula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1" <?php if(isset($aula1)){echo $aula1;}if(isset($_GET['aula'])&& $_GET['aula'] == 1){echo 'Selected';} ?>>1º Aula</option>
                    <option value="2" <?php if(isset($aula2)){echo $aula2;}if(isset($_GET['aula'])&& $_GET['aula'] == 2){echo 'Selected';}  ?>>2º Aula</option>
                    <?php if($per == 1 || $per = 3){?>
                    <option value="3" <?php if(isset($aula3)){echo $aula3;}if(isset($_GET['aula'])&& $_GET['aula'] == 3){echo 'Selected';}  ?>>3º Aula</option>
                    <option value="4" <?php if(isset($aula4)){echo $aula4;}if(isset($_GET['aula'])&& $_GET['aula'] == 4){echo 'Selected';}  ?>>4º Aula</option>
                    <?php }if($per == 1){?>
                    <option value="5" <?php if(isset($aula5)){echo $aula5;}if(isset($_GET['aula'])&& $_GET['aula'] == 5){echo 'Selected';}  ?>>5º Aula</option>
                    <option value="6" <?php if(isset($aula6)){echo $aula6;}if(isset($_GET['aula'])&& $_GET['aula'] == 6){echo 'Selected';}  ?>>6º Aula</option>
                    <?php }?>
                </select>
            </div>
            <div class="mb-5">    
                <input type="submit" value="Reservar" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center focus:outline-none dark:text-gray-900 dark:bg-white dark:border dark:border-gray-300 dark:focus:outline-none dark:hover:bg-gray-100 dark:focus:ring-4 dark:focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-gray-800 text-white border-gray-600 hover:bg-gray-700 hover:border-gray-600 focus:ring-gray-700">
            </div>
            </form>
        
        
    <?php }else{ ?>
        <form action="" method="" class="max-w-sm mx-auto">
        <div class="mb-5">
            <label for="lab" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Laboratório</label>
            <select name="lab" id="lab" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <?php
            include_once ("../conexao.php");
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
            <label for="sem" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Semana</label>
            <select name="sem" id="sem" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1">Segunda</option>
                <option value="2">Terça</option>
                <option value="3">Quarta</option>
                <option value="4">Quinta</option>
                <option value="5">Sexta</option>
            </select>
        </div>
        <div class="mb-5">
            <label for="sem" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Periodo</label>
            <select name="per" id="per" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1">Manhã</option>
                <option value="2">Tarde</option>
                <option value="3">Noite</option>
            </select>
        </div>
        
        <div class="mb-5">
            <input type="submit" value="Continuar" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center focus:outline-none dark:text-gray-900 dark:bg-white dark:border dark:border-gray-300 dark:focus:outline-none dark:hover:bg-gray-100 dark:focus:ring-4 dark:focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-gray-800 text-white border-gray-600 hover:bg-gray-700 hover:border-gray-600 focus:ring-gray-700">
        </div>
    </form>
    <?php }; ?>
    </div>
</body>

<!-- ----------------------------------------------------------------------------------------------------------------- -->