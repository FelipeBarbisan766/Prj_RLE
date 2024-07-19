<?php
include_once ("../conexao.php");
include_once ("../navbar.php");
date_default_timezone_set('America/Sao_Paulo');

$translate = array(
    0 => "Dom",
    1 => "Seg",
    2 => "Ter",
    3 => "Qua",
    4 => "Qui",
    5 => "Sex",
    6 => "Sab",
);
?>
<a class="btn btn-primary" href="../"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/></svg> voltar</a>
<div class="container text-center">
<form action="" method="get">
            <label for="lab" >laboratorio:</label>
            <select name="lab" id="lab" required>
            <?php
            include_once ("../conexao.php");
            $slq = mysqli_query($conexao, "SELECT * FROM laboratorio");
            while ($labs = mysqli_fetch_array($slq)) {
                if ($labs['lab_isActive'] == true) { 
                   echo '<option value='.$labs['lab_cod'].'>'.$labs['lab_nome'].'</option>';
                }}; ?>
            </select>
            <input type="submit" value="Continuar">
        </form>
  <div class="row align-items-center">
<?php
if (isset($_GET['lab'])) {
    $lab = $_GET['lab'];
} else {
    $labs = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM laboratorio"));//tentar sumir com isso pq repete 
    $lab = $labs['lab_cod'];
}
$labnome = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM laboratorio WHERE lab_cod='$lab'"));
$nomelab = $labnome["lab_nome"];

for ($sem = 1; $sem <= 5; $sem++) {
 
        // echo $dia;
        $slq = mysqli_query($conexao, "SELECT c.cro_aula as aula,c.cro_desc as descr,c.cro_isActive as active, p.prof_nome as prof FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE c.cro_sem = '$sem' AND c.lab_cod='$lab' ORDER BY c.cro_aula ASC");
         while ($reserva = mysqli_fetch_array($slq)) {
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

        ; ?>

      <div class="col">
        <a class="list-group-item list-group-item-action" disabled><?php echo $translate[$sem]; ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=1"';}else{echo 'disabled';}?>>1ºAula - <?php if(!isset($aula1)){echo "livre ";}else{echo $aula1['desc'];}if(!isset($aula1)){echo "- Nenhum";}else{echo ' - professor(a)'.$aula1['prof'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=2"';}else{echo 'disabled';}?>>2ºAula - <?php if(!isset($aula2)){echo "livre ";}else{echo $aula2['desc'];}if(!isset($aula2)){echo "- Nenhum";}else{echo ' - professor(a)'.$aula2['prof'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=3"';}else{echo 'disabled';}?>>3ºAula - <?php if(!isset($aula3)){echo "livre ";}else{echo $aula3['desc'];}if(!isset($aula3)){echo "- Nenhum";}else{echo ' - professor(a)'.$aula3['prof'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=4"';}else{echo 'disabled';}?>>4ºAula - <?php if(!isset($aula4)){echo "livre ";}else{echo $aula4['desc'];}if(!isset($aula4)){echo "- Nenhum";}else{echo ' - professor(a)'.$aula4['prof'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=5"';}else{echo 'disabled';}?>>5ºAula - <?php if(!isset($aula5)){echo "livre ";}else{echo $aula5['desc'];}if(!isset($aula5)){echo "- Nenhum";}else{echo ' - professor(a)'.$aula5['prof'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=6"';}else{echo 'disabled';}?>>6ºAula - <?php if(!isset($aula6)){echo "livre ";}else{echo $aula6['desc'];}if(!isset($aula6)){echo "- Nenhum";}else{echo ' - professor(a)'.$aula6['prof'];}  ?></a>
      </div>

    <?php
    $aula1 = null;
    $aula2 = null;
    $aula3 = null;
    $aula4 = null;
    $aula5 = null;
    $aula6 = null;
}?>
  </div>
</div>
    

</div>
       