<?php
include_once ("../navbar2.php");
include_once ('../ADM/protectAdm.php');
include_once ("../conexao.php");    
include_once('../button_back.php');
?>
<div class="">
    <?php if(isset($_GET['res'])) { ?>
        
        <form class="max-w-sm mx-auto" action="" method="POST">
        <div class="mb-5 mt-2">
                <?php
                $cod = $_GET['res'];  
                $slq = mysqli_query($conexao, 'SELECT * FROM reserva WHERE res_cod=' . $cod . '');
                $res = mysqli_fetch_array($slq);
                echo '<input type="hidden" name="cod" value="'.$cod.'">';
                ?>
             <label for="desc" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Descrição</label>
                <input type="text" name="desc" id="desc" value="<?php echo $res['res_desc'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required><br>
                <label for="curso" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Curso</label>
            <select name="curso" id="curso" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php
                
                $slq = mysqli_query($conexao, "SELECT * FROM curso");
                while ($cur = mysqli_fetch_array($slq)) {
                    ?>
                        <option value="<?php echo $cur['cur_cod'].'" ';if ($cur['cur_cod'] == $res['cur_cod']) { echo 'selected'; } ?>"><?php echo $cur['cur_nome']; ?></option>
                    <?php
                }
                ; ?>   
                           
            </select>
            <label for="Turma" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Turma</label>
            <select name="turma" id="Turma" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="TURMA A E B" <?php if ($res['res_turma'] == 'TURMA A E B' ) { echo 'selected'; } ?>>Turma A e B</option>
                <option value="TURMA A" <?php if ($res['res_turma'] == 'TURMA A' ) { echo 'selected'; } ?>>Turma A</option>
                <option value="TURMA B" <?php if ($res['res_turma'] == 'TURMA B' ) { echo 'selected'; } ?>>Turma B</option>
            </select>
            <?php
            $slq_reserva = mysqli_query($conexao, 'SELECT res_aula FROM reserva WHERE res_data = '.$res['res_data'].' AND lab_cod = '.$res['lab_cod'].' AND cro_periodo = '.$res['res_periodo'].' AND res_isActive IS TRUE  ');

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
                <label for="aula" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Aula</label>
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
            <label for="sem" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Periodo</label>
            <select name="per" id="per" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1" <?php if ($res['res_periodo'] == 1 ) { echo 'selected'; } ?>>Manhã</option>
                <option value="2" <?php if ($res['res_periodo'] == 2 ) { echo 'selected'; } ?>>Tarde</option>
                <option value="3" <?php if ($res['res_periodo'] == 3 ) { echo 'selected'; } ?>>Noite</option>
            </select>
        </div>
        <div class="mb-5">
            <label for="sem" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Dia</label>
            <select name="sem" id="sem" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1" <?php if ($res['res_data'] == 1 ) { echo 'selected'; } ?>>Segunda</option>
                <option value="2" <?php if ($res['res_data'] == 2 ) { echo 'selected'; } ?>>Terça</option>
                <option value="3" <?php if ($res['res_data'] == 3 ) { echo 'selected'; } ?>>Quarta</option>
                <option value="4" <?php if ($res['res_data'] == 4 ) { echo 'selected'; } ?>>Quinta</option>
                <option value="5" <?php if ($res['res_data'] == 5 ) { echo 'selected'; } ?>>Sexta</option>
            </select>
        </div>
        <div class="mb-5">
            <label for="lab" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Laboratório</label>
            <select name="lab" id="lab" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <?php
            
            $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
            while ($labs = mysqli_fetch_array($slq)) {
                if ($labs['lab_isActive'] == true) { ?>
                    <option value="<?php echo $labs['lab_cod'].'" '; if ($labs['lab_cod'] == $crono['lab_cod']) { echo 'selected'; } ?> "><?php echo $labs['lab_nome']; ?></option>
                    <?php }
            }
            ; ?>
        </select>
        </div>
        <div class="mb-5">
            <label for="prof" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Professor</label>
            <select name="prof" id="prof" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <?php
            $slq = mysqli_query($conexao, "SELECT * FROM professor");
            while ($prof = mysqli_fetch_array($slq)) {
                if ($prof['prof_isActive'] == true) { ?>
                    <option value="<?php echo $prof['prof_cod'].'" '; if ($prof['prof_cod'] == $crono['prof_cod']) { echo 'selected'; } ?> "><?php echo $prof['prof_nome']; ?></option>
                    <?php }
            }
            ; ?>
        </select>
        </div>
        <div class="mb-5">
            <input type="submit" value="Atualizar" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
        </div>
        </form>

    <?php } ?>    
</div>
<?php
if(isset($_POST['cod'])){
$cod = $_POST["cod"];
$desc = strtoupper($_POST['desc']);
$curso = $_POST['curso'];
$turma = $_POST['turma'];
$aula = $_POST['aula'];
$per = $_POST['per'];
$rdata = $_POST['data'];
$lab = $_POST['lab'];
$prof = $_POST['prof'];

$sql = mysqli_query($conexao,"UPDATE reserva SET res_desc='$desc', cur_cod='$curso', res_aula='$aula', res_turma='$turma', res_periodo='$per', rdata='$dia', lab_cod='$lab', prof_cod='$prof' WHERE res_cod='$cod'");

if($sql){
    echo "<script> window.location.href='cronograma2.php'</script>";
}else{
    echo "Erro no alter";
}
}
?>

</body>
</html>