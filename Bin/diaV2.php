<?php
include_once ("../conexao.php");
include_once ("../navbar.php");
include_once ("../protect.php");
date_default_timezone_set('America/Sao_Paulo');
?>
<div class="row g-0 text-center">
    <div class="col-6 col-md-4">
        <form action="" method="get">
            <label for="data" class="form-label">Data:</label>
            <input type="date" name="data" id="data" <?php if (isset($_GET['data'])) {echo 'value="' . $_GET['data'] . '"';} ?>>
            <br>
            <label for="lab" >laboratorio:</label>
            <select name="lab" id="lab" required>
            <?php
            include_once ("../conexao.php");
            $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
            while ($labs = mysqli_fetch_array($slq)) {
                if ($labs['lab_isActive'] == true) { 
                    if(isset($_GET['lab'])){
                        if($_GET['lab'] != $labs['lab_cod']){
                            echo '<option value='.$labs['lab_cod'].'>'.$labs['lab_nome'].'</option>';
                        }else{
                            echo '<option value='.$_GET['lab'].' Selected>'.$_GET['lab'].'</option>';
                        }
                    }else{
                        echo '<option value='.$labs['lab_cod'].'>'.$labs['lab_nome'].'</option>';
                    }
                 }}; ?>
            </select>
            <input type="submit" value="Continuar">
        </form>
    </div>
    <div class="col-sm-6 col-md-8">
        <div class="list-group">
        <?php
        if (isset($_GET['data'])) {
            $data = $_GET['data'];
            $timestamp = strtotime((new DateTime( $data))->format('d-m-Y')); //tem que converter a data pq essa merda n entende (┬┬﹏┬┬)
            $arrydata = getdate($timestamp);
            $sem = $arrydata['wday']; //Dia da semana de 0 a 6
        } else {
            $data = date("Y-m-d");
            $arrydata = getdate();
            $sem = $arrydata['wday'];
        }
        if (isset($_GET['lab'])) {
            $lab = $_GET['lab'];
        } else {
            $labs = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM laboratorio"));//tentar sumir com isso pq repete 
            $lab = $labs['lab_cod'];
        }
        $labnome = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM laboratorio WHERE lab_cod='$lab'"));
        $nomelab = $labnome["lab_nome"];
        $slq_reserva = mysqli_query($conexao, "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, p.prof_nome as prof FROM reserva as r INNER JOIN professor as p on r.prof_cod=p.prof_cod INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.res_data = '$data' AND l.lab_cod = '$lab' ORDER BY r.res_aula ASC");
        $slq_cronograma = mysqli_query($conexao, "SELECT c.cro_aula as aula,c.cro_desc as descr,c.cro_isActive as active, p.prof_nome as prof FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE c.cro_sem = '$sem' AND l.lab_cod = '$lab' ORDER BY c.cro_aula ASC");
        while ($reserva = mysqli_fetch_array($slq_reserva)) {
            $aula1 = null;
            $aula2 = null;
            $aula3 = null;
            $aula4 = null;
            $aula5 = null;
            $aula6 = null;
            switch ($reserva["aula"]) {
                    case "1":
                        $aula1 = ['desc' => $reserva['descr'],'prof' => $reserva['prof']];
                        break;
                    case "2":
                        $aula2 = ['desc' => $reserva['descr'],'prof' => $reserva['prof']];
                        break;
                    case "3":
                        $aula3 = array('desc' => $reserva['descr'],'prof' => $reserva['prof']);
                        break;
                    case "4":
                        $aula4 = array('desc' => $reserva['descr'],'prof' => $reserva['prof']);
                        break;
                    case "5":
                        $aula5 = array('desc' => $reserva['descr'],'prof' => $reserva['prof']);
                        break;
                    case "6":
                        $aula6 = array('desc' => $reserva['descr'],'prof' => $reserva['prof']);
                        break;
                    default:
                        break;
                    }
            }
            // temos que achar um jeito de diminuir esse switch case 
            while ($cronograma = mysqli_fetch_array($slq_cronograma)) {
                switch ($cronograma["aula"]) {
                    case "1":
                        $aula1 = ['desc' => $cronograma['descr']];
                        break;
                    case "2":
                        $aula2 = ['desc' => $cronograma['descr']];
                        break;
                    case "3":
                        $aula3 = ['desc' => $cronograma['descr']];
                        break;
                    case "4":
                        $aula4 = ['desc' => $cronograma['descr']];
                        break;
                    case "5":
                        $aula5 = ['desc' => $cronograma['descr']];
                        break;
                    case "6":
                        $aula6 = ['desc' => $cronograma['descr']];
                        break;
                    default:
                        break;
                    }
            }

        ; ?>
        <h1><?php echo (new DateTime($data))->format('d/m/Y').' - '. $arrydata['weekday'].' - '.$nomelab; ?></h1> <!-- trocar para portugues o nome da semana ! -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-dia="<?php echo $data; ?>" data-bs-aula="1" data-bs-lab="<?php echo $lab; ?>" <?php if(isset($aula1)){echo 'disabled';}?>>1ºAula - <?php if(!isset($aula1)){echo "livre";}else{echo $aula1['desc'];}if(isset($aula1['prof'])){echo '- Professor(a) '.$aula1['prof'];} ?></button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-dia="<?php echo $data; ?>" data-bs-aula="2" data-bs-lab="<?php echo $lab; ?>" <?php if(isset($aula2)){echo 'disabled';}?>>2ºAula - <?php if(!isset($aula2)){echo "livre";}else{echo $aula2['desc'];}if(isset($aula2['prof'])){echo '- Professor(a) '.$aula2['prof'];} ?></button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-dia="<?php echo $data; ?>" data-bs-aula="3" data-bs-lab="<?php echo $lab; ?>" <?php if(isset($aula3)){echo 'disabled';}?>>3ºAula - <?php if(!isset($aula3)){echo "livre";}else{echo $aula3['desc'];}if(isset($aula3['prof'])){echo '- Professor(a) '.$aula3['prof'];} ?></button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-dia="<?php echo $data; ?>" data-bs-aula="4" data-bs-lab="<?php echo $lab; ?>" <?php if(isset($aula4)){echo 'disabled';}?>>4ºAula - <?php if(!isset($aula4)){echo "livre";}else{echo $aula4['desc'];}if(isset($aula4['prof'])){echo '- Professor(a) '.$aula4['prof'];} ?></button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-dia="<?php echo $data; ?>" data-bs-aula="5" data-bs-lab="<?php echo $lab; ?>" <?php if(isset($aula5)){echo 'disabled';}?>>5ºAula - <?php if(!isset($aula5)){echo "livre";}else{echo $aula5['desc'];}if(isset($aula5['prof'])){echo '- Professor(a) '.$aula5['prof'];} ?></button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-dia="<?php echo $data; ?>" data-bs-aula="6" data-bs-lab="<?php echo $lab; ?>" <?php if(isset($aula6)){echo 'disabled';}?>>6ºAula - <?php if(!isset($aula6)){echo "livre";}else{echo $aula6['desc'];}if(isset($aula6['prof'])){echo '- Professor(a) '.$aula6['prof'];} ?></button>
        </div>
        


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Reserva para </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../Reserva/reserva.php" method="post">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Descrição:</label>
                    <input type="text" name="desc" class="form-control" id="recipient-name">
                </div>
                <!-- <div class="mb-3">
                    <label for="message-text" class="col-form-label">Message:</label>
                    <textarea class="form-control" id="message-text"></textarea>
                </div> -->
                
                <input type="hidden" name="data" id="data_form">
                <input type="hidden" name="aula" id="aula_form">
                <input type="hidden" name="lab" id="lab_form">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary">
            </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</div>
<!-- Num ta aparecendo as reservas criadas por agui -->
<script>
const exampleModal = document.getElementById('exampleModal')
if (exampleModal) {
  exampleModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const dia = button.getAttribute('data-bs-dia')
    const aula = button.getAttribute('data-bs-aula')
    const lab = button.getAttribute('data-bs-lab')
    // If necessary, you could initiate an Ajax request here
    // and then do the updating in a callback.

    // Update the modal's content.
    const modalTitle = exampleModal.querySelector('.modal-title')
    const inputhiddendata = exampleModal.querySelector('#data_form')
    const inputhiddenaula = exampleModal.querySelector('#aula_form')
    const inputhiddenlab = exampleModal.querySelector('#lab_form')

    modalTitle.textContent = `Reserva do Dia ${dia} - Lab${lab} - Aula${aula}`
    inputhiddendata.value = dia
    inputhiddenaula.value = aula
    inputhiddenlab.value = lab
  })
}
</script>