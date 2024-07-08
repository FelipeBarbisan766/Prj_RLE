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
<div class="container text-center">
  <div class="row align-items-center">
<?php
for ($sem = 1; $sem <= 5; $sem++) {
 
        // echo $dia;
        $slq = mysqli_query($conexao, "SELECT c.cro_aula as aula,c.cro_desc as descr,c.cro_isActive as active, a.adm_nome as adm FROM cronograma as c INNER JOIN administrador as a on c.adm_cod=a.adm_cod INNER JOIN laboratorio as l on c.lab_cod=l.lab_cod WHERE c.cro_sem = '$sem' ORDER BY c.cro_aula ASC");
         while ($reserva = mysqli_fetch_array($slq)) {
                switch ($reserva["aula"]) {
                    case "1":
                        $aula1 = ['desc' => $reserva['descr'],'adm' => $reserva['adm']];
                        break;
                    case "2":
                        $aula2 = ['desc' => $reserva['descr'],'adm' => $reserva['adm']];
                        break;
                    case "3":
                        $aula3 = array('desc' => $reserva['descr'],'adm' => $reserva['adm']);
                        break;
                    case "4":
                        $aula4 = array('desc' => $reserva['descr'],'adm' => $reserva['adm']);
                        break;
                    case "5":
                        $aula5 = array('desc' => $reserva['descr'],'adm' => $reserva['adm']);
                        break;
                    case "6":
                        $aula6 = array('desc' => $reserva['descr'],'adm' => $reserva['adm']);
                        break;
                    default:
                        break;
                    }
            }

        ; ?>

      <div class="col">
        <a class="list-group-item list-group-item-action" disabled><?php echo $translate[$sem]; ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=1"';}else{echo 'disabled';}?>>1ºAula - <?php if(!isset($aula1)){echo "livre ";}else{echo $aula1['desc'];}if(!isset($aula1)){echo "- Nenhum";}else{echo '- admessor(a)'.$aula1['adm'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=2"';}else{echo 'disabled';}?>>2ºAula - <?php if(!isset($aula2)){echo "livre ";}else{echo $aula2['desc'];}if(!isset($aula2)){echo "- Nenhum";}else{echo '- admessor(a)'.$aula2['adm'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=3"';}else{echo 'disabled';}?>>3ºAula - <?php if(!isset($aula3)){echo "livre ";}else{echo $aula3['desc'];}if(!isset($aula3)){echo "- Nenhum";}else{echo '- admessor(a)'.$aula3['adm'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=4"';}else{echo 'disabled';}?>>4ºAula - <?php if(!isset($aula4)){echo "livre ";}else{echo $aula4['desc'];}if(!isset($aula4)){echo "- Nenhum";}else{echo '- admessor(a)'.$aula4['adm'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=5"';}else{echo 'disabled';}?>>5ºAula - <?php if(!isset($aula5)){echo "livre ";}else{echo $aula5['desc'];}if(!isset($aula5)){echo "- Nenhum";}else{echo '- admessor(a)'.$aula5['adm'];}  ?></a>
        <a class="list-group-item list-group-item-action" <?php if(!isset($aula1)){echo 'href="../Reserva/formReserva.php?sem='.$sem.'&aula=6"';}else{echo 'disabled';}?>>6ºAula - <?php if(!isset($aula6)){echo "livre ";}else{echo $aula6['desc'];}if(!isset($aula6)){echo "- Nenhum";}else{echo '- admessor(a)'.$aula6['adm'];}  ?></a>
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
       