<?php
include_once ("../conexao.php");
include_once ("../navbar2.php");
include_once ("../protect.php");
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

<div class="px-4 mx-auto max-w-screen-xl ">

<a href="pageProfessor.php" class="my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
</svg>
</a>
</div>

<div class="container mx-auto px-3">
  <div class="row align-items-center">
<?php
$cod = $_SESSION['cod'];
for ($sem = 1; $sem <= 5; $sem++) {

        // echo $dia;
        $slq = mysqli_query($conexao, "SELECT c.cro_aula as aula,c.cro_desc as descr,c.cro_isActive as active, l.lab_nome as lab FROM cronograma as c INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod INNER JOIN professor as p on c.prof_cod=p.prof_cod WHERE c.cro_sem = '$sem' AND c.prof_cod='$cod' ORDER BY c.cro_aula ASC");
         while ($reserva = mysqli_fetch_array($slq)) {
                switch ($reserva["aula"]) {
                    case "1":
                        $aula1 = ['desc' => $reserva['descr'],'lab' => $reserva['lab']];
                        break;
                    case "2":
                        $aula2 = ['desc' => $reserva['descr'],'lab' => $reserva['lab']];
                        break;
                    case "3":
                        $aula3 = array('desc' => $reserva['descr'],'lab' => $reserva['lab']);
                        break;
                    case "4":
                        $aula4 = array('desc' => $reserva['descr'],'lab' => $reserva['lab']);
                        break;
                    case "5":
                        $aula5 = array('desc' => $reserva['descr'],'lab' => $reserva['lab']);
                        break;
                    case "6":
                        $aula6 = array('desc' => $reserva['descr'],'lab' => $reserva['lab']);
                        break;
                    default:
                        break;
                    }
            }

        ; ?>

      <div class="col">
        <a class="list-group-item list-group-item-action" disabled><?php echo $translate[$sem]; ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=1"';}else{echo 'disabled';}?>>1ºAula - <?php if(!isset($aula1)){echo "livre ";}else{echo $aula1['desc']." - ".$aula1['lab'];}?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=2"';}else{echo 'disabled';}?>>2ºAula - <?php if(!isset($aula2)){echo "livre ";}else{echo $aula2['desc']." - ".$aula2['lab'];}?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=3"';}else{echo 'disabled';}?>>3ºAula - <?php if(!isset($aula3)){echo "livre ";}else{echo $aula3['desc']." - ".$aula3['lab'];}?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=4"';}else{echo 'disabled';}?>>4ºAula - <?php if(!isset($aula4)){echo "livre ";}else{echo $aula4['desc']." - ".$aula4['lab'];}?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=5"';}else{echo 'disabled';}?>>5ºAula - <?php if(!isset($aula5)){echo "livre ";}else{echo $aula5['desc']." - ".$aula5['lab'];}?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=6"';}else{echo 'disabled';}?>>6ºAula - <?php if(!isset($aula6)){echo "livre ";}else{echo $aula6['desc']." - ".$aula6['lab'];}?></a>
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