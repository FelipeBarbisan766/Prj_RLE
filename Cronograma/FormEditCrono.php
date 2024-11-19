<?php
include_once ("../navbar2.php");
include_once ('../ADM/protectAdm.php');
include_once ("../conexao.php");
$link_back='cronograma2.php';
include_once ("../button_back.php");
?>
<div class="">
    

    <?php if(isset($_GET['crono'])) { ?>
        
        <form class="max-w-sm mx-auto" action="" method="POST">
        <div class="mb-5 mt-2">
                <?php
                $cod = $_GET['crono'];  
                $slq = mysqli_query($conexao, 'SELECT * FROM cronograma WHERE cro_cod=' . $cod . '');
                $crono = mysqli_fetch_array($slq);
                echo '<input type="hidden" name="cod" value="'.$cod.'">';
                ?>
             <label for="desc" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white flex justify-center flex justify-center">Descrição</label>
                <input type="text" name="desc" id="desc" value="<?php echo $crono['cro_desc'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required><br>
                <label for="curso" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white flex justify-center">Curso</label>
            <select name="curso" id="curso" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <?php
                
                $slq = mysqli_query($conexao, "SELECT * FROM curso WHERE cur_isActive is TRUE");
                while ($cur = mysqli_fetch_array($slq)) {
                    ?>
                        <option value="<?php echo $cur['cur_cod'];?>" <?php if ($cur['cur_cod'] == $crono['cur_cod']) { echo 'selected'; } ?>><?php echo $cur['cur_nome']; ?></option>
                    <?php
                }
                ; ?>   
                           
            </select>
            <label for="Turma" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white flex justify-center">Turma</label>
            <select name="turma" id="Turma" class="form-select block mb-2 font-medium dark:text-white bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="TURMA A E B" <?php if ($crono['cro_turma'] == 'TURMA A E B' ) { echo 'selected'; } ?>>Turma A e B</option>
                <option value="TURMA A" <?php if ($crono['cro_turma'] == 'TURMA A' ) { echo 'selected'; } ?>>Turma A</option>
                <option value="TURMA B" <?php if ($crono['cro_turma'] == 'TURMA B' ) { echo 'selected'; } ?>>Turma B</option>
            </select>
            <?php
            $slq_cronograma = mysqli_query($conexao, 'SELECT cro_aula FROM cronograma WHERE cro_sem = '.$crono['cro_sem'].' AND lab_cod = '.$crono['lab_cod'].' AND cro_periodo = '.$crono['cro_periodo'].' AND cro_isActive IS TRUE  ');

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
            ?>
            <div class="mb-5">
                <label for="aula" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white flex justify-center">Aula</label>
                <select name="aula" id="aula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1" <?php if($crono['cro_aula'] == 1){echo ' Selected';}elseif(isset($aula1)){echo $aula1;} ?>>1º Aula</option>
                    <option value="2" <?php if($crono['cro_aula'] == 2){echo ' Selected';}elseif(isset($aula2)){echo $aula2;}  ?>>2º Aula</option>
                    <?php if($crono['cro_periodo'] == 1 || $crono['cro_periodo'] == 3){?>
                    <option value="3" <?php if($crono['cro_aula'] == 3){echo ' Selected';}elseif(isset($aula3)){echo $aula3;}  ?>>3º Aula</option>
                    <option value="4" <?php if($crono['cro_aula'] == 4){echo ' Selected';}elseif(isset($aula4)){echo $aula4;} ?>>4º Aula</option>
                    <?php }if($crono['cro_periodo'] == 1){?>
                    <option value="5" <?php if($crono['cro_aula'] == 5){echo ' Selected';}elseif(isset($aula5)){echo $aula5;} ?>>5º Aula</option>
                    <option value="6" <?php if($crono['cro_aula'] == 6){echo ' Selected';}elseif(isset($aula6)){echo $aula6;}  ?>>6º Aula</option>
                    <?php }?>
                </select>
            </div>
            <div class="mb-5">
            <label for="sem" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white flex justify-center">Periodo</label>
            <select name="per" id="per" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1" <?php if ($crono['cro_periodo'] == 1 ) { echo 'selected'; } ?>>Manhã</option>
                <option value="2" <?php if ($crono['cro_periodo'] == 2 ) { echo 'selected'; } ?>>Tarde</option>
                <option value="3" <?php if ($crono['cro_periodo'] == 3 ) { echo 'selected'; } ?>>Noite</option>
            </select>
        </div>
        <div class="mb-5">
            <label for="sem" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white flex justify-center">Dia</label>
            <select name="sem" id="sem" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="1" <?php if ($crono['cro_sem'] == 1 ) { echo 'selected'; } ?>>Segunda</option>
                <option value="2" <?php if ($crono['cro_sem'] == 2 ) { echo 'selected'; } ?>>Terça</option>
                <option value="3" <?php if ($crono['cro_sem'] == 3 ) { echo 'selected'; } ?>>Quarta</option>
                <option value="4" <?php if ($crono['cro_sem'] == 4 ) { echo 'selected'; } ?>>Quinta</option>
                <option value="5" <?php if ($crono['cro_sem'] == 5 ) { echo 'selected'; } ?>>Sexta</option>
            </select>
        </div>
        <div class="mb-5">
            <label for="lab" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white flex justify-center">Laboratório</label>
            <select name="lab" id="lab" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <?php
            
            $slq = mysqli_query($conexao, "SELECT * FROM laboratorio WHERE lab_isActive is TRUE");
            while ($labs = mysqli_fetch_array($slq)) {
            ?>
                    <option value="<?php echo $labs['lab_cod'].'" '; if ($labs['lab_cod'] == $crono['lab_cod']) { echo 'selected'; } ?> "><?php echo $labs['lab_nome']; ?></option>
            <?php 
            }
            ; ?>
        </select>
        </div>
        <div class="mb-5 flex justify-center">
            <input type="submit" value="Atualizar" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center focus:outline-none dark:text-gray-900 dark:bg-white dark:border dark:border-gray-300 dark:focus:outline-none dark:hover:bg-gray-100 dark:focus:ring-4 dark:focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-gray-800 text-white border-gray-600 hover:bg-gray-700 hover:border-gray-600 focus:ring-gray-700">
        </div><br>
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
$sem = $_POST['sem'];
$lab = $_POST['lab'];
$prof = $_SESSION['cod'];

$sql = mysqli_query($conexao,"UPDATE cronograma SET cro_desc='$desc', cur_cod='$curso', cro_aula='$aula', cro_turma='$turma', cro_periodo='$per', cro_sem='$sem', lab_cod='$lab', prof_cod='$prof' WHERE cro_cod='$cod'");

if($sql){
    echo "<script> window.location.href='cronograma2.php'</script>";
}else{
    echo "Erro no alter";
}
}
?>

</body>
</html>