<?php
include_once ("../conexao.php");
include_once ("../navbar.php");
date_default_timezone_set('America/Sao_Paulo');
?>
<a class="btn btn-primary" href="pageProfessor.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5z"/></svg> voltar</a>
<div class="container text-center">
<div class="list-group">
    <?php
        $cod = $_SESSION['cod'];
        $slq_reserva = mysqli_query($conexao, "SELECT r.res_aula as aula,r.res_desc as descr,r.res_isActive as active, l.lab_nome as lab, r.res_data as dat FROM reserva as r INNER JOIN laboratorio as l on r.lab_cod=l.lab_cod WHERE r.prof_cod='$cod' ORDER BY r.res_aula DESC");
        $quantidade = $slq_reserva->num_rows;
        if ($quantidade >= 1){
        while ($reserva = mysqli_fetch_array($slq_reserva)) {
            if($reserva['dat']< (new DateTime)->format('Y-m-d')){
                echo '<h2>Reservas Antigas</h2>';
                echo '<hr>';
            }
            echo '<h3>'.(new DateTime($reserva['dat']))->format('d/m/Y').'</h3>';
            echo '<a class="list-group-item list-group-item-action"> '.$reserva['aula'].'ºAula - '.$reserva['descr'].' - '.$reserva['lab'].'</a>';
            echo '<br><hr>';
            }
        }else{
            echo '<h2> Você ainda não possui reservas </h2>';
        }
         ?>
    
</div>
</div>
</div>