<?php
include_once('../conexao.php');
if(isset($_POST['cod_search'])){
    $cod_search = $_POST['cod_search'];
    $result = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod INNER JOIN curso as u ON c.cur_cod=u.cur_cod WHERE c.cro_cod = ".$cod_search." "));  

    echo '<dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
    <div class="flex flex-col pb-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Descrição</dt>
        <dd class="text-lg font-semibold">'. $result['cro_desc'] .'</dd>
    </div>
    <div class="flex flex-col py-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Laboratorio</dt>
        <dd class="text-lg font-semibold">'. $result['lab_nome'] .'</dd>
    </div>
    <div class="flex flex-col pt-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Curso</dt>
        <dd class="text-lg font-semibold">'. $result['cur_nome'] .'</dd>
    </div>
    <div class="flex flex-col pt-3">
        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Turma</dt>
        <dd class="text-lg font-semibold">'. $result['cro_turma'] .'</dd>
    </div>
</dl>
';

}elseif(isset($_POST['lab'])){
    ?><form action="registro.php" method="post" class="max-w-sm mx-auto">
            <div class="mb-5">

                <label for="desc" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Descrição</label>
                <input type="text" name="desc" id="desc" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"><br>
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
            </div>
            
            <?php
            $lab = $_POST['lab'];
            $sem = $_POST['sem'];
            // $data = $_GET['data'];
            // $timestamp = strtotime((new DateTime( $data))->format('d-m-Y')); 
            // $arrydata = getdate($timestamp);
            // $sem = $arrydata['wday']; 
            //
            $slq_cronograma = mysqli_query($conexao, "SELECT cro_aula FROM cronograma WHERE cro_sem = '$sem' AND lab_cod = '$lab' AND cro_isActive IS TRUE  ");

            while ($cronograma = mysqli_fetch_array($slq_cronograma )){
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
            echo '<input type="hidden" name="sem" value="'.$sem.'">';
            echo '<input type="hidden" name="lab" value="'.$lab.'">';
            ?>
            <div class="mb-5">
                <label for="aula" class="block mb-2 text-3xl font-medium text-gray-900 dark:text-white">Aula</label>
                <select name="aula" id="aula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1" <?php if(isset($aula1)){echo $aula1;} ?>>1º Aula</option>
                    <option value="2" <?php if(isset($aula2)){echo $aula2;} ?>>2º Aula</option>
                    <option value="3" <?php if(isset($aula3)){echo $aula3;} ?>>3º Aula</option>
                    <option value="4" <?php if(isset($aula4)){echo $aula4;} ?>>4º Aula</option>
                    <option value="5" <?php if(isset($aula5)){echo $aula5;} ?>>5º Aula</option>
                    <option value="6" <?php if(isset($aula6)){echo $aula6;} ?>>6º Aula</option>
                </select>
            </div>
            <div class="mb-5">    
                <input type="submit" value="Reservar" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
            </div>
            </form>
    
        <div class="mb-5">
            <input type="submit" value="Continuar" class="py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
        </div>
    </form><?php
}else{
    $lab = $_GET['lab'];
    $sem = $_GET['sem'];
    ?>
    <button onclick="OpenModal(<?php echo $lab.','.$sem.',teste'; ?>)">Adicionar Cronograma</button>
    <?php
}

?>