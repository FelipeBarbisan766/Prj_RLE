<?php
include_once('../conexao.php');
include_once ('../protect.php');
include_once('../navbar2.php');
include_once('../button_back.php');
?>
<form class="max-w-sm mx-auto" method="POST">
        <div class="mb-5 mt-2">
                <?php
                    $cod = $_GET['cod'];
                    $slq = mysqli_query($conexao, "SELECT * FROM reserva as r INNER JOIN laboratorio as l on r.lab_cod = l.lab_cod INNER JOIN professor as p on r.prof_cod = p.prof_cod WHERE r.res_cod = ".$cod."");
                    $res = mysqli_fetch_array($slq);
                    echo '<input type="hidden" name="cod" value="'.$cod.'">';
                ?>
                <label for="desc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                <input value="<?php echo $res['res_desc']; ?>" type="text" id="desc" name="desc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nome da Aula" required />
            </div>
            <?php
            $slq_reserva = mysqli_query($conexao, 'SELECT res_aula FROM reserva WHERE res_data = '.$res['res_data'].' AND lab_cod = '.$res['lab_cod'].' AND res_periodo = '.$res['res_periodo'].' AND res_isActive IS TRUE  ');

            while ($reserva = mysqli_fetch_array($slq_reserva)){
                switch ($reserva["res_aula"]){
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
            ?>
            <div class="mb-5">
                <label for="aula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Aula</label>
                <select name="aula" id="aula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1" <?php if($res['res_aula'] == 1){echo ' Selected';}elseif(isset($aula1)){echo $aula1;} ?>>1º Aula</option>
                    <option value="2" <?php if($res['res_aula'] == 2){echo ' Selected';}elseif(isset($aula2)){echo $aula2;}  ?>>2º Aula</option>
                    <?php if($res['res_periodo'] == 1 || $res['res_periodo'] = 3){?>
                    <option value="3" <?php if($res['res_aula'] == 3){echo ' Selected';}elseif(isset($aula3)){echo $aula3;}  ?>>3º Aula</option>
                    <option value="4" <?php if($res['res_aula'] == 4){echo ' Selected';}elseif(isset($aula4)){echo $aula4;} ?>>4º Aula</option>
                    <?php }if($res['res_periodo'] == 1){?>
                    <option value="5" <?php if($res['res_aula'] == 5){echo ' Selected';}elseif(isset($aula5)){echo $aula5;} ?>>5º Aula</option>
                    <option value="6" <?php if($res['res_aula'] == 6){echo ' Selected';}elseif(isset($aula6)){echo $aula6;}  ?>>6º Aula</option>
                    <?php }?>
                </select>
            </div>  
            <div class="mb-5">
                <label for="turma" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Turma</label>
                <select name="turma" id="turma" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="TURMA A E B">Turma A e B</option>
                <option value="TURMA A">Turma A</option>
                <option value="TURMA B">Turma B</option>
                </select> 
            </div>
            <div class="mb-5">
                <label for="per" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Periodo</label>
                <select name="per" id="per" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1" <?php if ($res['res_periodo'] == 1 ) { echo 'selected'; } ?>>Manhã</option>
                <option value="2" <?php if ($res['res_periodo'] == 2 ) { echo 'selected'; } ?>>Tarde</option>
                <option value="3" <?php if ($res['res_periodo'] == 3 ) { echo 'selected'; } ?>>Noite</option>
                </select> 
            </div>
            <div class="mb-5">
            <label for="curso" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Curso</label>
            <select id="curso" name="curso" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <?php
                
                $slq = mysqli_query($conexao, "SELECT * FROM curso");
                while ($cur = mysqli_fetch_array($slq)) {
                    if ($cur['cur_isActive'] == true) { ?>
                        <option value="<?php echo $cur['cur_cod']; if($res['cur_cod'] == $cur['cur_cod']){echo 'selected';}  ?> "><?php echo $cur['cur_nome']; ?></option>
                    <?php }
                }
                ; ?>            
            </select>
            </div>
            <div class="mb-5">
                <label for="data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                <input name="data" id="data" type="date" value="<?php echo $res['res_data']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date" required min="<?php echo date('Y-m-d'); ?>" onchange="checkDate(this)">
                </select> 
            </div>
            
            </div>

            <div class="mb-5">
            <label for="lab" class="block mb-2 text-sm font-medium text-gray-900 dark:text-whitex">Laboratório</label>
            <select name="lab" id="lab" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <?php
            
            $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
            while ($labs = mysqli_fetch_array($slq)) {
                if ($labs['lab_isActive'] == true) { ?>
                    <option value="<?php echo $labs['lab_cod'].'" '; if ($labs['lab_cod'] == $res['lab_cod']) { echo 'selected'; } ?> "><?php echo $labs['lab_nome']; ?></option>
                    <?php }
            }
            ; ?>
        </select>
        </div>
        <div class="flex-row mb-5 sm:space-x-2">    
                    <button href="pageControl.php" class="mb-2 text-white bg-danger-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancelar</button>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Confirmar</button>
            </div>
</form>
<?php
if(isset($_POST['cod'])){
$cod = $_POST["cod"];
$desc = strtoupper($_POST['desc']);
$curso = $_POST['curso'];
$turma = $_POST['turma'];
$aula = $_POST['aula'];
$per = $_POST['per'];
$data = $_POST['data'];
$lab = $_POST['lab'];

$sql = mysqli_query($conexao,"UPDATE reserva SET res_desc='$desc', cur_cod='$curso', res_aula='$aula', res_turma='$turma', res_periodo='$per', res_data='$data', lab_cod='$lab' WHERE res_cod='$cod'");

if($sql){
    echo "<script> window.location.href='reservas.php'</script>";
}else{
    echo "Erro no alter";
}
}
?>