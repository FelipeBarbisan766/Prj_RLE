<?php
include_once ("../conexao.php");
include_once ("../navbar.php");
date_default_timezone_set('America/Sao_Paulo');
?>
<div class="row g-0 text-center">
    <div class="col-6 col-md-4">
        <form action="" method="get">
            <label for="data">Data:</label>
            <input type="date" name="data" id="data">
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
        $slq_reserva = mysqli_query($conexao, "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, p.prof_nome as prof FROM reserva as r INNER JOIN professor as p on r.prof_cod=p.prof_cod INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.res_data = '$data' ORDER BY r.res_aula ASC");
        $slq_cronograma = mysqli_query($conexao, "SELECT c.cro_aula as aula,c.cro_desc as descr,c.cro_isActive as active, a.adm_nome as adm, p.prof_nome as prof FROM cronograma as c INNER JOIN administrador as a on c.adm_cod=a.adm_cod INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE c.cro_sem = '$sem' ORDER BY c.cro_aula ASC");
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
                        $aula1 = ['desc' => $cronograma['descr'],'prof' => $cronograma['prof']];
                        break;
                    case "2":
                        $aula2 = ['desc' => $cronograma['descr'],'prof' => $cronograma['prof']];
                        break;
                    case "3":
                        $aula3 = array('desc' => $cronograma['descr'],'prof' => $cronograma['prof']);
                        break;
                    case "4":
                        $aula4 = array('desc' => $cronograma['descr'],'prof' => $cronograma['prof']);
                        break;
                    case "5":
                        $aula5 = array('desc' => $cronograma['descr'],'prof' => $cronograma['prof']);
                        break;
                    case "6":
                        $aula6 = array('desc' => $cronograma['descr'],'prof' => $cronograma['prof']);
                        break;
                    default:
                        break;
                    }
            }

        ; ?>
        <h1><?php echo $data = (new DateTime( $data))->format('d/m/Y').' - '. $arrydata['weekday']; ?></h1> <!-- trocar para portugues o nome da semana ! -->
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?data='.$data.'&aula=1"';}else{echo 'disabled';}?>>1ºAula - <?php if(!isset($aula1)){echo "livre";}else{echo $aula1['desc'];}if(!isset($aula1)){echo "Nenhum";}else{echo '- Professor(a)'.$aula1['prof'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?data='.$data.'&aula=2"';}else{echo 'disabled';}?>>2ºAula - <?php if(!isset($aula2)){echo "livre";}else{echo $aula2['desc'];}if(!isset($aula2)){echo "Nenhum";}else{echo '- Professor(a)'.$aula2['prof'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?data='.$data.'&aula=3"';}else{echo 'disabled';}?>>3ºAula - <?php if(!isset($aula3)){echo "livre";}else{echo $aula3['desc'];}if(!isset($aula3)){echo "Nenhum";}else{echo '- Professor(a)'.$aula3['prof'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?data='.$data.'&aula=4"';}else{echo 'disabled';}?>>4ºAula - <?php if(!isset($aula4)){echo "livre";}else{echo $aula4['desc'];}if(!isset($aula4)){echo "Nenhum";}else{echo '- Professor(a)'.$aula4['prof'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?data='.$data.'&aula=5"';}else{echo 'disabled';}?>>5ºAula - <?php if(!isset($aula5)){echo "livre";}else{echo $aula5['desc'];}if(!isset($aula5)){echo "Nenhum";}else{echo '- Professor(a)'.$aula5['prof'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?data='.$data.'&aula=6"';}else{echo 'disabled';}?>>6ºAula - <?php if(!isset($aula6)){echo "livre";}else{echo $aula6['desc'];}if(!isset($aula6)){echo "Nenhum";}else{echo '- Professor(a)'.$aula6['prof'];}  ?></a>
        </div>
    </div>
</div>